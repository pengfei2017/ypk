<?php
/**
 * 商家入驻认证流程处理
 * User: Administrator
 * Date: 2016/11/27
 * Time: 14:33
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Logic\DocumentLogic;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\HelpLogic;
use Ypk\Logic\SellerLogic;
use Ypk\Logic\StoreClassLogic;
use Ypk\Logic\StoreGradeLogic;
use Ypk\Logic\StoreJoininLogic;
use Ypk\Logic\StoreLogic;
use Ypk\Models\Member;
use Ypk\Models\Seller;
use Ypk\Models\Store;
use Ypk\Models\StoreClass;
use Ypk\Models\StoreJoinin;
use Ypk\Tpl;
use Ypk\UploadFile;
use Ypk\Validate;

class StoreJoinincController extends BaseHomeController
{
    private $joinin_detail = NULL;

    public function initialize()
    {
        parent::initialize();
        //Tpl::setLayout('store_joinin_layout');

        $this->view->setLayoutsDir('/layouts/');
        $this->view->setLayout('store_joininc');

        $this->view->setVar('layout', 'store_joinin_layout');

        if (empty($_REQUEST['member_id']) && empty($_REQUEST['member_mobile'])) {
            //检测用户是否已经登录
            $this->checkLogin();

            //检测登录用户的身份
            if (intval(getSession('member_type_id')) <= 1) { //表示是普通用户
                showDialog('非法访问', getUrl('shop/index/index'));
            }

            //判断用户是否已经是医生则直接登录
            if (Seller::count("member_id=" . getSession('member_id')) > 0) {
                @header('location: ' . getUrl('shop/seller_login/show_login', array('type' => 'login')));
                exit;
            }

            //判断是否是查看入驻审核进度
            if ($this->dispatcher->getControllerName() != 'check_seller_name_exist' && $this->dispatcher->getActionName() != 'checkname') {
                $this->check_joinin_state();
            }
            $phone_array = explode(',', getConfig('site_phone'));
            $this->view->setVar('phone_array', $phone_array);
            //$model_help = new HelpLogic();
            //$condition = array();
            //$condition['type_id'] = '99';//默认显示入驻流程;
            //$list = $model_help->getShowStoreHelpList($condition);
            //$this->view->setVar('list',$list);//左侧帮助类型及帮助
            $this->view->setVar('show_sign', 'joinin');
            $this->view->setVar('html_title', getConfig('site_name') . ' - ' . '商家入驻');
            $this->view->setVar('article_list', '');//底部不显示文章分类
        }
    }

    public function indexAction()
    {
        $this->view->pick('store_joininc/step0');
    }

    /**
     * 查看入驻审核进度状态
     */
    private function check_joinin_state()
    {
        $model_store_joinin = new StoreJoininLogic();
        $joinin_detail = $model_store_joinin->getOne(array('member_id' => getSession('member_id')));
        if (!empty($joinin_detail)) {
            $this->joinin_detail = $joinin_detail;
            switch (intval($joinin_detail['joinin_state'])) { //判断开店状态
                case STORE_JOIN_STATE_NEW: //新申请(10)
                    $this->step4();
                    $this->show_join_message('开店申请已经提交，请等待管理员审核', FALSE, '3');
                    break;
                case STORE_JOIN_STATE_PAY: //完成付款(11)
                    $this->show_join_message('已经提交，请等待管理员核对后为您开通医生', FALSE, '4');
                    break;
                case STORE_JOIN_STATE_VERIFY_SUCCESS: //初审成功(20)
                    if (!in_array($_GET['op'], array('pay', 'pay_save'))) {
                        $this->payAction();
                    }
                    break;
                case STORE_JOIN_STATE_VERIFY_FAIL: //初审失败(30)
                    if (!in_array($_GET['op'], array('step1', 'step2', 'step3', 'step4'))) {
                        $this->show_join_message('审核失败:' . $joinin_detail['joinin_message'], getUrl('shop/store_joininc/step1'));
                    }
                    break;
                case STORE_JOIN_STATE_PAY_FAIL:
                    //付款审核失败(31)
                    if (!in_array($_GET['op'], array('pay', 'pay_save'))) {
                        $this->show_join_message('付款审核失败:' . $joinin_detail['joinin_message'], getUrl('shop/store_joininc/pay'));
                    }
                    break;
                case STORE_JOIN_STATE_FINAL: //开店成功(40)
                    @header('location: ' . getUrl('shop/seller_login'));
                    break;
            }
        }
    }

    public function uploadQualificationAction()
    {
        if (!empty($_REQUEST['member_mobile'])) {
            if (!empty($_POST['submit']) && $_POST['submit'] == 'ok') { //表示是提交保存数据
                $cache_arr = read_file_cache($_REQUEST['member_mobile'], false, null, '../storejoin_cache/');
                $param = array();
                $param['business_person_body'] = $this->upload_image('business_person_body'); //个人全身照
                $param['business_id_card'] = $this->upload_image('business_id_card'); //手持身份证半身照
                $param['business_qualification_certificate'] = $this->upload_image('business_qualification_certificate'); //医师资格证书
                $param['business_certified_certificate'] = $this->upload_image('business_certified_certificate'); //医师执业证书
                $param['seller_name'] = $cache_arr['member_name'];
                $param['store_name'] = $cache_arr['member_name'];
                $param['add_time'] = time(); //申请时间
                $cache_arr = array_merge($cache_arr, $param);
                write_file_cache($_REQUEST['member_mobile'], $cache_arr, null, '../storejoin_cache/'); //重新写入缓存
                $this->showMessage("申请已提交，请耐心等待短信通知", getUrl('member/login/index'), 'html', 'succ');
            }
            Tpl::output('member_mobile', $_REQUEST['member_mobile']);
        } else {
            $this->showDialog("提交的信息错误，请重新注册", getUrl('member/login/register'));
        }
    }

    /**
     * 医务人员上传资质证书
     */
    public function uploadQualificationAction1()
    {
        $member_id = $_REQUEST['member_id'];
        if (!empty($_POST['submit']) && $_POST['submit'] == 'ok') { //表示是提交保存数据
            $param = array();
            if (!empty($member_id)) {
                $member_info = Member::findFirst("member_id=" . $member_id); //判断用户是否存在
                if ($member_info !== false) {
                    $member_info = $member_info->toArray();
                    $param['member_id'] = $member_info['member_id']; //会员id
                    $param['business_person_body'] = $this->upload_image('business_person_body'); //个人全身照
                    $param['business_id_card'] = $this->upload_image('business_id_card'); //手持身份证半身照
                    $param['business_qualification_certificate'] = $this->upload_image('business_qualification_certificate'); //医师资格证书
                    $param['business_certified_certificate'] = $this->upload_image('business_certified_certificate'); //医师执业证书
                    $param['joinin_state'] = STORE_JOIN_STATE_NEW; //新的申请状态
                    if ($member_info !== false) {
                        $param['seller_name'] = $member_info['member_name'];
                        $param['store_name'] = $member_info['member_name'];
                    }

                    if (StoreJoinin::count("member_id=" . $member_info['member_id']) <= 0) { //表示新增
                        $store_join_model = new StoreJoinin();
                        if ($store_join_model->save($param) !== false) {
                            $this->showMessage("申请已提交，请耐心等待短信通知", getUrl('member/login/logout'), 'html', 'succ');
                        } else {
                            $this->showMessage("提交失败，请修改后再次提交", getUrl('shop/store_joininc/uploadQualification', array('member_id' => $member_info['member_id'])), 'html', 'error');
                        }
                    } else { //表示修改
                        $res = StoreJoinin::findFirst("member_id=" . $member_info['member_id']);
                        if ($res->save($param) !== false) {
                            $this->showMessage("申请已提交，请耐心等待短信通知", getUrl('member/login/logout'), 'html', 'succ');
                        } else {
                            $this->showMessage("提交失败，请修改后再次提交", getUrl('shop/store_joininc/uploadQualification', array('member_id' => $member_info['member_id'])), 'html', 'error');
                        }
                    }
                } else {
                    $this->showMessage("用户不存在，请重新注册", getUrl('member/login/index'), 'html', 'error');
                }
            } else {
                $this->showMessage("用户不存在，请重新注册", getUrl('member/login/index'), 'html', 'error');
            }
        }
        Tpl::output('member_id', $member_id);
    }

    /**
     * 第0步：阅读入驻协议
     */
    public
    function step0Action()
    {
        $model_document = new DocumentLogic();
        $document_info = $model_document->getOneByCode('open_store');
        if (!empty($document_info)) {
            $this->view->setVar('agreement', $document_info['doc_content']);
        }
        $this->view->setVar('step', 'step1');
        $this->view->setVar('sub_step', 'step0');
        //Tpl::showpage('store_joininc_apply');
        $this->view->render('Store_joininc', 'store_joininc_apply');
        $this->view->disable();
    }

    /**
     * 第一步：医生资质信息
     */
    public
    function step1Action()
    {
        $this->view->setVar('step', 'step2');
        $this->view->setVar('sub_step', 'step1');
        $this->view->pick('store_joininc/store_joininc_apply');
    }

    /**
     * 第二步：提交保存医生资质信息
     */
    public
    function step2Action()
    {
        if (!empty($_POST)) {
            $param = array();
            $param['member_name'] = getSession('member_name'); //用户名
            $param['company_name'] = $_POST['company_name']; //医生名称
            $param['company_address'] = $_POST['company_address']; //“省市县”三级地址
            $param['company_address_detail'] = $_POST['company_address_detail']; //详细地址
            $param['contacts_name'] = $_POST['contacts_name']; //联系人名称
            $param['contacts_phone'] = $_POST['contacts_phone']; //联系人电话
            $param['contacts_email'] = $_POST['contacts_email']; //电子邮箱

            $param['business_sphere'] = $_POST['business_sphere']; //个人真实姓名
            $param['business_departments'] = $_POST['business_departments']; //科室
            $param['business_professional'] = $_POST['business_professional']; //职称
            $param['business_lockHospital'] = $_POST['business_lockHospital']; //定点医院
            $param['business_activeHospital'] = empty($_POST['business_activeHospital']) ? " " : $_POST['business_activeHospital']; //活动医院
            $param['business_idcard_number'] = empty($_POST['business_idcard_number']) ? " " : $_POST['business_idcard_number']; //身份证号码
            $param['business_person_body'] = $this->upload_image('business_person_body'); //个人全身照
            $param['business_id_card'] = $this->upload_image('business_id_card'); //手持身份证半身照
            $param['business_qualification_certificate'] = $this->upload_image('business_qualification_certificate'); //医师资格证书
            $param['business_certified_certificate'] = $this->upload_image('business_certified_certificate'); //医师执业证书
            $param['mail_content'] = $_POST['mail_content']; //个人简介

            $this->step2_save_valid($param); //校验提交的数据的合法性

            //$model_store_joinin = new StoreJoininLogic();
            //$joinin_info = $model_store_joinin->getOne(array('member_id' => getSession('member_id')));
            if (StoreJoinin::count("member_id=" . getSession('member_id')) <= 0) { //表示新增
                $param['member_id'] = getSession('member_id');
                $store_join_model = new StoreJoinin();
                $store_join_model->save($param);
                //$model_store_joinin->save($param);
            } else { //表示修改
                $res = StoreJoinin::findFirst("member_id=" . getSession('member_id'));
                $res->save($param);
                //$model_store_joinin->modify($param, array('member_id' => getSession('member_id')));
            }

            //修改member表中的真实姓名
            $member_info = Member::findFirst("member_id=" . getSession('member_id'));
            if ($member_info !== false) {
                $member_info->save(array('member_truename' => $_POST['business_sphere']));
            }
            //if (empty($joinin_info)) {
            //    $param['member_id'] = getSession('member_id');
            //    $model_store_joinin->save($param);
            //} else {
            //    $model_store_joinin->modify($param, array('member_id' => getSession('member_id')));
            //}
        }
        $this->view->setVar('step', 'step2');
        $this->view->setVar('sub_step', 'step2');
        $this->view->pick('store_joininc/store_joininc_apply');
    }

    /**
     * 验证第二步提交数据的合法性操作
     * @param $param
     */
    private
    function step2_save_valid($param)
    {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input" => $param['company_name'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "50", "message" => "医生名称不能为空且必须小于50个字"),
            array("input" => $param['company_address'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "50", "message" => "所在地不能为空且必须小于50个字"),
            array("input" => $param['company_address_detail'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "50", "message" => "详细地址不能为空且必须小于50个字"),
            array("input" => $param['contacts_name'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "20", "message" => "联系人姓名不能为空且必须小于20个字"),
            array("input" => $param['contacts_phone'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "20", "message" => "联系人电话不能为空"),
            array("input" => $param['contacts_email'], "require" => "true", "validator" => "email", "message" => "电子邮箱不能为空"),

            array("input" => $param['business_sphere'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "500", "message" => "姓名不能为空且必须小于50个字"),
            array("input" => $param['business_departments'], "require" => "true", "message" => "科室不能为空"),
            array("input" => $param['business_professional'], "require" => "true", "message" => "职称不能为空"),
            array("input" => $param['business_lockHospital'], "require" => "true", "message" => "定点医院不能为空"),
            array("input" => $param['business_person_body'], "require" => "true", "message" => "个人全身照不能为空"),
            array("input" => $param['business_id_card'], "require" => "true", "message" => "身份证正面照不能为空"),
            array("input" => $param['business_qualification_certificate'], "require" => "true", "message" => "医师资格证书不能为空"),
            array("input" => $param['business_certified_certificate'], "require" => "true", "message" => "医师执业证书不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != '') {
            $this->showMessage($error);
        }
    }

    /**
     * 第三步：提交保存 财务资质信息
     */
    public
    function step3Action()
    {
        if (!empty($_POST)) {
            $param = array();

            $param['settlement_bank_account_name'] = $_POST['settlement_bank_account_name'];
            $param['settlement_bank_account_number'] = $_POST['settlement_bank_account_number'];
            $this->step3_save_valid($param); //验证提交的数据的合法性
            $res = StoreJoinin::findFirst("member_id=" . getSession('member_id'));
            if ($res === false) {
                $this->showMessage("该用户不存在");
            }
            $res->save($param);
        }

        //商品分类（第四步要用）
        $gc = new GoodsClassLogic();
        $gc_list = $gc->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);

        //医生等级（从缓存中读取,第四步要用）
        $grade_list = read_file_cache('store_grade', true);
        //附加功能
        if (!empty($grade_list) && is_array($grade_list)) {
            foreach ($grade_list as $key => $grade) {
                $sg_function = explode('|', $grade['sg_function']);
                if (!empty($sg_function[0]) && is_array($sg_function)) {
                    foreach ($sg_function as $key1 => $value) {
                        if ($value == 'editor_multimedia') {
                            $grade_list[$key]['function_str'] .= '富文本编辑器';
                        }
                    }
                } else {
                    $grade_list[$key]['function_str'] = '无';
                }
            }
        }
        $this->view->setVar('grade_list', $grade_list);

        //医生分类
        $model_store = new StoreClassLogic();
        $store_class = $model_store->getStoreClassList(array());
        $this->view->setVar('store_class', $store_class);

        $this->view->setVar('step', 'step3');
        $this->view->setVar('sub_step', 'step3');
        $this->view->pick('store_joininc/store_joininc_apply');
    }

    /**
     * 验证第三步提交的数据的合法性
     * @param $param
     */
    private
    function step3_save_valid($param)
    {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input" => $param['settlement_bank_account_name'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "50", "message" => "支付宝不能为空且必须小于50个字"),
            array("input" => $param['settlement_bank_account_number'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "20", "message" => "支付宝账号不能为空且必须小于20个字"),
        );
        $error = $obj_validate->validate();
        if ($error != '') {
            $this->showMessage($error);
        }
    }

    /**
     * 第四步：提交保存 医生经营信息
     */
    public
    function step4Action()
    {
        $store_class_ids = array();
        $store_class_names = array();

        //获取医生经营类目id集合
//        if (!empty($_POST['store_class_ids'])) {
//            foreach ($_POST['store_class_ids'] as $value) {
//                $store_class_ids[] = $value;
//            }
//        }
//
//        //获取医生经营类目名称集合
//        if (!empty($_POST['store_class_names'])) {
//            foreach ($_POST['store_class_names'] as $value) {
//                $store_class_names[] = $value;
//            }
//        }
//
//        //取最小级分类最新分佣比例
//        $sc_ids = array();
//        foreach ($store_class_ids as $v) {
//            $v = explode(',', trim($v, ','));
//            if (!empty($v) && is_array($v)) {
//                $sc_ids[] = end($v);
//            }
//        }
//        if (!empty($sc_ids)) {
//            $store_class_commis_rates = array();
//            $goodsGlassLogic = new GoodsClassLogic();
//            $goods_class_list = $goodsGlassLogic->getGoodsClassListByIds($sc_ids);
//            if (!empty($goods_class_list) && is_array($goods_class_list)) {
//                $sc_ids = array();
//                foreach ($goods_class_list as $v) {
//                    $store_class_commis_rates[] = $v['commis_rate'];
//                }
//            }
//        }

        $param = array();
        $param['seller_name'] = $_POST['seller_name']; //医生帐号
        $param['store_name'] = $_POST['store_name']; //医生名称
        $param['store_class_ids'] = '';//serialize($store_class_ids); //医生类别id集合
        $param['store_class_names'] = '';//serialize($store_class_names); //医生类别名称集合
        $param['joinin_year'] = 1;//intval($_POST['joinin_year']); //开店时长
        $param['joinin_state'] = STORE_JOIN_STATE_NEW; //申请状态（默认为10，即新申请的）
        $param['store_class_commis_rates'] = 0;//implode(',', $store_class_commis_rates); //分类佣金比例
        $param['sc_id'] = 0;//intval($_POST['sc_id']); //医生分类

        //取医生等级信息（从缓存中获取）
//        $grade_list = read_file_cache('store_grade', true);
//        if (!empty($grade_list[$_POST['sg_id']])) {
//            $param['sg_id'] = $_POST['sg_id'];
//            $param['sg_name'] = $grade_list[$_POST['sg_id']]['sg_name'];
//            $param['sg_info'] = serialize(array('sg_price' => $grade_list[$_POST['sg_id']]['sg_price']));
//        }

        //取最新医生分类信息
//        $store_class_info = StoreClass::findFirst("sc_id=" . $_POST['sc_id']);
//        if ($store_class_info) {
//            $store_class_info = $store_class_info->toArray();
//        }
//
//        if ($store_class_info) {
//            $param['sc_id'] = $store_class_info['sc_id'];
//            $param['sc_name'] = $store_class_info['sc_name'];
//            $param['sc_bail'] = $store_class_info['sc_bail'];
//        }

        //医生应付款
        $param['paying_amount'] = 0.0;//floatval($grade_list[$_POST['sg_id']]['sg_price']) * $param['joinin_year'] + floatval($param['sc_bail']);
        //$this->step4_save_valid($param);

        $res = StoreJoinin::findFirst("member_id=" . getSession('member_id'));
        $res->save($param);
        //$model_store_joinin = new StoreJoininLogic();
        //$model_store_joinin->modify($param, array('member_id' => getSession('member_id')));

        @header('location: ' . getUrl('shop/store_joininc'));
    }

    /**
     * 验证第四步提交数据的合法性
     * @param $param
     */
    private
    function step4_save_valid($param)
    {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input" => $param['store_name'], "require" => "true", "validator" => "Length", "min" => "1", "max" => "50", "message" => "医生名称不能为空且必须小于50个字"),
            array("input" => $param['sg_id'], "require" => "true", "message" => "医生等级不能为空"),
            array("input" => $param['sc_id'], "require" => "true", "message" => "医生分类不能为空"),
        );
        $error = $obj_validate->validate();
        if ($error != '') {
            $this->showMessage($error);
        }
    }

    /**
     * 倒数第二步：提交申请之后要调用的页面
     */
    private
    function step4()
    {
        $model_store_joinin = new StoreJoininLogic();
        $joinin_detail = $model_store_joinin->getOne(array('member_id' => getSession('member_id')));
        $joinin_detail['store_class_ids'] = unserialize($joinin_detail['store_class_ids']);
        $joinin_detail['store_class_names'] = unserialize($joinin_detail['store_class_names']);
        $joinin_detail['store_class_commis_rates'] = explode(',', $joinin_detail['store_class_commis_rates']);
        $joinin_detail['sg_info'] = unserialize($joinin_detail['sg_info']);
        $this->view->setVar('joinin_detail', $joinin_detail);
    }

    /**
     * 倒数第二步：初审成功之后要调用的视图
     */
    public
    function payAction()
    {
        if (!empty($this->joinin_detail['sg_info'])) {
            $storeGradeLogic = new StoreGradeLogic();
            $store_grade_info = $storeGradeLogic->getOneGrade($this->joinin_detail['sg_id']);
            $this->joinin_detail['sg_price'] = $store_grade_info['sg_price'];
        } else {
            $this->joinin_detail['sg_info'] = @unserialize($this->joinin_detail['sg_info']);
            if (is_array($this->joinin_detail['sg_info'])) {
                $this->joinin_detail['sg_price'] = $this->joinin_detail['sg_info']['sg_price'];
            }
        }
        $this->view->setVar('joinin_detail', $this->joinin_detail);
        $this->view->setVar('step', '4');
        $this->view->setVar('sub_step', 'pay');
        //Tpl::showpage('store_joinin_apply');
        $this->view->render('store_joininc', 'store_joininc_apply');
        $this->view->disable();
    }

    /**
     * 最后一步：上传并保存付款凭证
     */
    public
    function pay_saveAction()
    {
        $param = array();
        $param['paying_money_certificate'] = $this->upload_image('paying_money_certificate'); //付款凭证图片
        $param['paying_money_certif_exp'] = $_POST['paying_money_certif_exp']; //付款凭证说明
        $param['joinin_state'] = STORE_JOIN_STATE_PAY; //完成付款，即提交了付款凭证(11)

        if (empty($param['paying_money_certificate'])) {
            $this->showMessage('请上传付款凭证', '', '', 'error');
        }
        $res = StoreJoinin::findFirst("member_id=" . getSession('member_id'));
        $res->save($param);
        @header('location: ' . getUrl('shop/store_joininc'));
    }

    /**
     * 显示开店申请消息提示页面
     * @param $message
     * @param bool $btn_next
     * @param string $step
     */
    private
    function show_join_message($message, $btn_next = FALSE, $step = 'step2')
    {
        $this->view->setVar('joinin_message', $message);
        $this->view->setVar('btn_next', $btn_next);
        $this->view->setVar('step', $step);
        $this->view->setVar('sub_step', 'step4');
        $this->view->render('store_joininc', 'store_joininc_apply');
        exit;
    }

    /**
     * 向服务器保存上传的文件
     * @param string $file 浏览器提交的要上传的文件名
     * @return string 返回已经上传后的文件名称
     */
    private
    function upload_image($file)
    {
        $pic_name = '';
        $upload = new UploadFile();
        $uploaddir = ATTACH_PATH . DS . 'store_joinin' . DS;
        $upload->set('default_dir', $uploaddir);
        $upload->set('allow_type', array('jpg', 'jpeg', 'gif', 'png'));
        if (!empty($_FILES[$file]['name'])) {
            $result = $upload->upfile($file);
            if ($result) {
                $pic_name = $upload->file_name;
                $upload->file_name = '';
            }
        }
        return $pic_name;
    }

    /**
     * 检测卖家用户名是否已经存在
     */
    public
    function check_seller_name_existAction()
    {
        //$condition = array();
        //$condition['seller_name'] = $_GET['seller_name'];

        //$model_seller = new SellerLogic();
        //$result = $model_seller->isSellerExist($condition);

        if (Seller::count("seller_name='" . $_GET['seller_name'] . "'") > 0) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
    }

    /**
     * 检查医生名称是否存在
     *
     * @internal param $
     */
    public
    function checknameAction()
    {
        if (Store::count("store_name='" . $_GET['store_name'] . "'") > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit;
    }
}