<?php
/**
 * 个人中心
 */

namespace Ypk\Modules\Mobile\Controllers;

use Ypk\Log;
use Ypk\Logic\AreaLogic;
use Ypk\Models\Area;
use Ypk\Models\Article;
use Ypk\Models\ArticleClass;
use Ypk\Models\ArticleCollect;
use Ypk\Models\CaseHistory;
use Ypk\Models\Goods;
use Ypk\Models\GoodsClass;
use Ypk\Models\GoodsCommon;
use Ypk\Models\Member;
use Ypk\Models\MemberBuyServiceNum;
use Ypk\Models\MemberCommissionLog;
use Ypk\Models\MemberExtend;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\MemberShareBenefitsLog;
use Ypk\Models\MemberStraightLog;
use Ypk\Models\Orders;
use Ypk\Models\Seller;
use Ypk\Models\Store;
use Ypk\Models\StoreJoinin;
use Ypk\Models\VrOrder;
use Ypk\Models\VrOrderCode;
use Ypk\QueueClient;
use Ypk\UploadFile;

class MemberIndexController extends MobileMemberController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 个人中心
     */
    public function indexAction()
    {
        //如果是医务人员的话先验证其店铺是否已经开通并且可以正常经营
        $member_type_id = $this->member_info['member_type_id'];
        if (intval($member_type_id) > 1) {
            $store_info = Store::findFirst("member_id=" . $this->member_info['member_id'] . " and store_state=1");
            if ($store_info === false) {
                output_data(array('resMsg' => 'nostore'));
            }
        }

        $member_info = array();
        $member_info['member_id'] = $this->member_info['member_id'];
        $member_info['user_name'] = $this->member_info['member_name'];
        $member_info['avatar'] = getMemberAvatarForID($this->member_info['member_id']);

        $member_gradeinfo = Model('member')->getOneMemberGrade(intval($this->member_info['member_exppoints']));
        $member_info['level_name'] = $member_gradeinfo['level_name'];
        $member_info['favorites_store'] = Model('favorites')->getStoreFavoritesCountByMemberId($this->member_info['member_id']);
        $member_info['favorites_goods'] = Model('favorites')->getGoodsFavoritesCountByMemberId($this->member_info['member_id']);
        // 交易提醒
        $model_order = Model('order');
        $member_info['order_nopay_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'NewCount');
        $member_info['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'SendCount');
        $member_info['order_notakes_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'TakesCount');
        $member_info['order_noeval_count'] = $model_order->getOrderCountByID('buyer', $this->member_info['member_id'], 'EvalCount');

        // 售前退款
        $condition = array();
        $condition['buyer_id'] = $this->member_info['member_id'];
        $condition['refund_state'] = array('lt', 3);
        $member_info['return'] = Model('refund_return')->getRefundReturnCount($condition);

        //等级
        $member_info['member_tree_level'] = $this->member_info['member_tree_level'];
        $member_tree_level_name = "<div><img style='width: 45px;' src='/resource/images/member_level/" . $member_info['member_tree_level'] . ".png' /></div>";
        $member_info['member_tree_level_name'] = $member_tree_level_name;

        output_data(array('member_info' => $member_info, 'login' => 1, 'member_type_id' => $this->member_info['member_type_id']));
        //output_data(array('member_info' => $member_info, 'login' => 1, 'member_type_id' => 1));
    }

    /**
     * 我的资产
     */
    public function my_assetAction()
    {
        $param = $_GET;
        $fields_arr = array('point', 'predepoit', 'available_rc_balance', 'redpacket', 'voucher');
        $fields_str = trim($param['fields']);
        if ($fields_str) {
            $fields_arr = explode(',', $fields_str);
        }
        $member_info = array();
        if (in_array('point', $fields_arr)) {
            $member_info['point'] = $this->member_info['member_points'];
            $member_info['store_points'] = $this->member_info['store_points'];
        }
        if (in_array('predepoit', $fields_arr)) {
            $member_info['predepoit'] = $this->member_info['available_predeposit'];
        }
        if (in_array('available_rc_balance', $fields_arr)) {
            $member_info['available_rc_balance'] = $this->member_info['available_rc_balance'];
        }
        if (in_array('redpacket', $fields_arr)) {
            $member_info['redpacket'] = Model('redpacket')->getCurrentAvailableRedpacketCount($this->member_info['member_id']);
        }
        if (in_array('voucher', $fields_arr)) {
            $member_info['voucher'] = Model('voucher')->getCurrentAvailableVoucherCount($this->member_info['member_id']);
        }
        output_data($member_info);
    }

    /**
     * 客户客户人员完善资料
     */
    public function complete_info_customAction()
    {
        if (!empty($_POST)) {
            $member_model = $this->member_info;
            $member_array = array();
            $member_array['member_truename'] = $_POST['member_truename'];
            $member_array['member_sex'] = $_POST['member_sex'];
            $member_array['member_qq'] = $_POST['member_qq'];
            $member_array['member_provinceid'] = $_POST['province'];
            $member_array['member_areaid'] = $_POST['city'];
            $member_array['member_cityid'] = $_POST['county'];
            $member_array['member_areainfo'] = $_POST['company_address'];
            $model_member = Model('member');
            $update = $model_member->editMember(array('member_id' => $member_model['member_id']), $member_array);
            if ($update == true) {
                @header("Location:/h5_web/js_template/member/member_info_custom.html?op=ok");
            } else {
                @header("Location:/h5_web/js_template/member/member_info_custom.html?op=err");
            }
        }
        exit;
    }

    /**
     * 加载客户人员信息
     */
    public function load_doctor_info_customAction()
    {
        if (!empty($this->member_info)) {
            echo json_encode($this->member_info);
        } else {
            echo "err";
        }
        exit;
    }

    /**
     * 医务人员完善资料（保存）
     */
    public function complete_infoAction()
    {
        if (!empty($_POST)) {
            $member_model = $this->member_info;
            $param = array();
            $param['member_name'] = $member_model['member_name']; //用户名
            $param['business_sphere'] = $_POST['member_truename']; //医生真实姓名
            $param['contacts_name'] = $_POST['member_truename']; //联系人姓名
            $param['business_departments'] = $_POST['business_departments']; //科室
            $param['business_professional'] = $_POST['business_professional']; //职称
            $param['business_lockHospital'] = $_POST['business_lockHospital']; //定点医院
            $param['company_name'] = $_POST['business_lockHospital']; //单位名称
            $param['business_activeHospital'] = empty($_POST['business_activeHospital']) ? " " : $_POST['business_activeHospital']; //活动医院
            $param['company_address'] = $_POST['company_address']; //地区（省市县三级形式）
            $param['company_address_detail'] = $_POST['company_address_detail']; //详细地址
            $param['business_idcard_number'] = empty($_POST['business_idcard_number']) ? " " : $_POST['business_idcard_number']; //身份证号码
            $param['mail_content'] = $_POST['mail_content']; //个人简介
            $param['seller_name'] = $member_model['member_name']; //医务中心登录帐号
            $param['store_name'] = $member_model['member_name']; //医务中心名称
            $param['joinin_year'] = 1; //加入时长（单位：年）
            $param['store_class_commis_rates'] = 0;
            $param['sc_id'] = 0;

            if (StoreJoinin::count("member_id=" . $member_model['member_id']) <= 0) { //表示新增
                $param['member_id'] = $member_model['member_id'];
                $store_join_model = new StoreJoinin();
                if ($store_join_model->save($param) === false) {
                    Log::record("手机端新增医生申请失败，数据是：" . json_encode($param));
                    @header("Location:/h5_web/js_template/member/member_info.html?op=err");
                    exit;
                }
                //修改member表中的真实姓名
                $member_info = Member::findFirst("member_id=" . $member_model['member_id']);
                if ($member_info !== false) {
                    $update_arr = array(
                        'member_truename' => $_POST['member_truename'],
                        'member_provinceid' => $_POST['province'],
                        'member_areaid' => $_POST['city'],
                        'member_cityid' => $_POST['county'],
                        'member_areainfo' => $_POST['company_address'],
                    );
                    $member_info->save($update_arr);
                }
                @header("Location:/h5_web/js_template/member/member_info.html?op=ok");
            } else { //表示修改
                $res = StoreJoinin::findFirst("member_id=" . $member_model['member_id']);
                if ($res->save($param) === false) {
                    Log::record("手机端修改医生申请失败，数据是：" . json_encode($param));
                    @header("Location:/h5_web/js_template/member/member_info.html?op=err");
                    exit;
                }
                //修改member表中的真实姓名
                $member_info = Member::findFirst("member_id=" . $member_model['member_id']);
                if ($member_info !== false) {
                    $update_arr = array(
                        'member_truename' => $_POST['member_truename'],
                        'member_provinceid' => $_POST['province'],
                        'member_areaid' => $_POST['city'],
                        'member_cityid' => $_POST['county'],
                        'member_areainfo' => $_POST['company_address'],
                    );
                    $member_info->save($update_arr);
                }
                @header("Location:/h5_web/js_template/member/member_info.html?op=ok");
            }
        }
        exit;
    }

    /**
     * 加载医生信息
     */
    public function load_doctor_infoAction()
    {
        $member_model = $this->member_info;
        $store_join_info = StoreJoinin::findFirst("member_id=" . $member_model['member_id']);
        if ($store_join_info != false) {
            $store_join_info = $store_join_info->toArray();
            echo json_encode(array_merge($store_join_info, $member_model));
        } else {
            echo "err";
        }
        exit;
    }

    /**
     * 向服务器保存上传的文件
     * @param string $file 浏览器提交的要上传的文件名
     * @return string 返回已经上传后的文件名称
     */
    private function upload_image($file)
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
     * 加载行政单位列表
     */
    public function loadAreaListAction()
    {
        $str = "";
        $parent_id = intval($_POST['parent_id']);
        $area_list = Area::find("area_parent_id=" . $parent_id);
        $str .= "<option value=\"-1\">-请选择-</option>";
        if (count($area_list) > 0) {
            $area_list = $area_list->toArray();
            foreach ($area_list as $area_info) {
                $str .= "<option value='" . $area_info['area_id'] . "'>" . $area_info['area_name'] . "</option>";
            }
        }
        echo $str;
        exit;
    }

    /**
     * 检测卖家用户名是否已经存在
     */
    public function check_seller_name_existAction()
    {
        if (Seller::count("seller_name='" . $_POST['seller_name'] . "'") > 0) {
            echo 'true';
        } else {
            echo 'false';
        }
        exit;
    }

    /**
     * 检查医生名称是否存在
     *
     */
    public function checknameAction()
    {
        if (Store::count("store_name='" . $_GET['store_name'] . "'") > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit;
    }

    /**
     * 加载医生服务列表
     */
    public function load_service_listAction()
    {
        $str = "";
        $member_model = $this->member_info;
        $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
        if ($store_info !== false) {
            $goods_list = Goods::find("store_id=" . $store_info->getStoreId() . " and gc_id_1=1073");
            if (count($goods_list) > 0) {
                $goods_list = $goods_list->toArray();
                foreach ($goods_list as $goods_info) {
                    $str .= "<dl class=\"mt5 news_list\" style='height: 55px;line-height: 55px;'>";
                    $str .= "<dt>";
                    $str .= "<h3>" . $goods_info['goods_name'] . "</h3>";
                    $str .= "<a href=\"service_set_add.html?goods_id=" . $goods_info['goods_id'] . "\" style=\"display: inline-block;margin-top: 5px;font-size: 0.8rem;\">编辑</a>";
                    $str .= "</dt>";
                    $str .= "</dl>";
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * 加载服务类别列表
     */
    public function load_service_categoryAction()
    {
        $str = "";
        $goods_class_list = GoodsClass::find("gc_parent_id=1073");
        if (count($goods_class_list) > 0) {
            $goods_class_list = $goods_class_list->toArray();
            foreach ($goods_class_list as $good_class) {
                $str .= "<option value='" . $good_class['commis_rate'] . "' data-id='" . $good_class['gc_id'] . "' data-pointrate='" . $good_class['buy_points_rate'] . "'>" . $good_class['gc_name'] . "</option>";
            }
        }
        echo $str;
        exit;
    }

    public function load_service_category2Action()
    {

        $str = "";
        $goods_class_list = GoodsClass::find();
        if (count($goods_class_list) > 0) {
            $goods_class_list = $goods_class_list->toArray();
            foreach ($goods_class_list as $good_class) {
                if ($good_class['gc_name'] == $_POST['g_name']) {
                    $gc_id = $good_class['gc_id'];
                    break;
                }
            }
            $i = 0;
            foreach ($goods_class_list as $good_class1) {
                if ($gc_id == $good_class1['gc_parent_id']) {
                    $i++;
                    if ($i == 1) {
                        $str .= "<option selected = 'selected' value='" . $good_class1['gc_name'] . "' data-id='" . $good_class1['gc_id'] . "' data-pointrate='" . $good_class1['buy_points_rate'] . "'>" . $good_class1['gc_name'] . "</option>";
                        $i++;
                    } else {
                        $str .= "<option value='" . $good_class1['gc_name'] . "' data-id='" . $good_class1['gc_id'] . "' data-pointrate='" . $good_class1['buy_points_rate'] . "'>" . $good_class1['gc_name'] . "</option>";
                    }
//              $str .= "<option selected = 'selected' value='". $good_class1['commis_rate']."' data-id='" . $good_class1['gc_id'] . "' data-pointrate='" . $good_class1['buy_points_rate'] . "'>" . $good_class1['gc_name'] . "</option>";
                }
            }
        }
        echo $str;
        exit;
    }

    public function load_service_category3Action()
    {

        $str = "";
        $goods_class_list = GoodsClass::find();
        if (count($goods_class_list) > 0) {
            $goods_class_list = $goods_class_list->toArray();
            foreach ($goods_class_list as $good_class) {
                if ($good_class['gc_name'] == $_POST['g_lingle']) {
                    $gc_id = $good_class['gc_id'];
                    break;
                }
            }
            $goods_class_list = GoodsClass::findFirst("gc_id=" . $gc_id);
            if (!empty($goods_class_list)) {
                $goods_class_list = $goods_class_list->toArray();
                $str .= "<option selected = 'selected' value='" . $goods_class_list['goods_jingle'] . "' data-id='" . $goods_class_list['gc_id'] . "' data-pointrate='" . $goods_class_list['buy_points_rate'] . "'>" . $goods_class_list['goods_jingle'] . "</option>";
            }
            echo $str;
            exit;
        }
    }

    /**
     * 验证当前用户是否有发布服务的权限
     */
    public function validate_memberAction()
    {
        $member_model = $this->member_info;
        if ($member_model['member_type_id'] < 2) { //表示是普通用户
            output_data(array('msg' => 'illegal'));
            exit;
        }
        $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
        if ($store_info === false) {
            output_data(array('msg' => 'nopass'));
            exit;
        }
        output_data(array('msg' => 'ok'));
        exit;
    }

    /**
     * 获取医院地点和科室地点
     */
    public function get_addressAction()
    {
        $str = "";
        $member_model = $this->member_info;
        //获取医院地点和科室地点
        $store_join_model = Model('store_joinin');
        $store_join_info = $store_join_model->getOne('member_id=' . $member_model['member_id']);
        if (!empty($store_join_info)) {
            if (!empty($store_join_info['company_address_detail'])) {
                $address_tem = explode(',', $store_join_info['company_address_detail']);
                if (!empty($address_tem)) {
                    if (!empty($address_tem[0])) {
                        $arr['hispital_address'] = $address_tem[0];
                    }
                    if (!empty($address_tem[1])) {
                        $arr['depart_address'] = $address_tem[1];
                    }
                    echo json_encode($arr);
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * 获取服务商品对象信息
     */
    public function get_goods_infoAction()
    {
        if (!empty($_POST['goods_id'])) {
            $goods_id = $_POST['goods_id'];
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if ($goods_info === false) {
                echo "nogoods";
            } else {
                $goods_info = $goods_info->toArray();
                $arr = $goods_info;
                $arr['doctor_service_start_time'] = date("Y-m-d H:i:s", $goods_info['doctor_service_start_time']);
                $arr['doctor_service_end_time'] = date("Y-m-d H:i:s", $goods_info['doctor_service_end_time']);

                //获取聊天卡的翻倍比例
                $goods_class = GoodsClass::findFirst("gc_id=1076");
                if ($goods_class !== false) {
                    $arr['commis_rate'] = $goods_class->getCommisRate();
                } else {
                    $arr['commis_rate'] = 0;
                }
                echo json_encode($arr);
            }
        } else {
            echo "nogoods";
        }
        exit;
    }

    /**
     * 添加保存服务
     */
    public function service_setAction()
    {
        $member_model = $this->member_info;
        $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
        $store_info = $store_info->toArray();
        if (!empty($_POST['opType']) && $_POST['opType'] == "add") { //表示是新增
            $insertArray = array();
            $insertArray['gc_id'] = $_POST['gc_id']; //服务二级类型id
            $insertArray['gc_id_1'] = 1073; //服务类型id
            $insertArray['gc_id_2'] = $_POST['gc_id']; //服务二级类型id
            $insertArray['gc_id_3'] = 0;
            $buy_points_rate = $_POST['buy_points_rate']; //服务赠送积分比例
            $insertArray['goods_name'] = $_POST['g_name']; //服务名称
            $insertArray['goods_jingle'] = $_POST['goods_jingle']; //服务卖点
            $insertArray['doctor_private_price'] = $_POST['private_price']; //医生发布的服务的私有价格
            $insertArray['goods_price'] = $_POST['system_price']; //医生发布的服务的平台价格
            $insertArray['goods_promotion_price'] = $_POST['system_price'];
            $insertArray['goods_marketprice'] = $_POST['system_price'];
            $insertArray['goods_storage'] = intval($_POST['goods_storage']); //服务数量
            $insertArray['goods_points'] = floor($_POST['system_price'] * $buy_points_rate); //购买该服务或商品时，购买者可以得到的积分数量
            $insertArray['doctor_service_start_time'] = strtotime($_POST['sart_time']);  //服务开始时间
            $insertArray['doctor_service_end_time'] = strtotime($_POST['end_time']); //服务结束时间
            $insertArray['hispital_address'] = $_POST['hispital_address']; //医院地点
            $insertArray['hispital_zuozhen'] = $_POST['hispital_zuozhen']; //坐诊医院
            $insertArray['depart_address'] = $_POST['depart_address']; //科室地点
            $insertArray['is_virtual'] = 1; //属于虚拟产品
            $insertArray['virtual_indate'] = strtotime($_POST['end_time']); //服务的失效时间
            $insertArray['virtual_limit'] = 1; //每人每次限购1个
            $insertArray['virtual_invalid_refund'] = 0; //是否允许过期退款
            if (!empty($_POST['server_img'])) {//上传服务主图
                $base64_image_content = $_POST['server_img'];
                //匹配出图片的格式
                if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
                    // $temp = tempnam(ini_get("upload_tmp_dir"), 'PHP'); //tempnam — 建立一个具有唯一文件名的文件  ini_get("upload_tmp_dir") — 返回用于apache临时文件的目录
                    // $temp_file = fopen($temp, "w");
                    // $fileSize = fwrite($temp_file, base64_decode(str_replace($result[1], '', $base64_image_content)));
                    $tempfile = tmpfile(); // create temporary file
                    $fileSize = fwrite($tempfile, base64_decode(str_replace($result[1], '', $base64_image_content))); // fill data to temporary file
                    $metaDatas = stream_get_meta_data($tempfile);
                    $tmpFilename = $metaDatas['uri'];
                    //倒回文件的开头
                    rewind($tempfile);

                    $_FILES['image_path']['name'] = basename($tmpFilename, '.tmp') . '.jpg';
                    $_FILES['image_path']['type'] = 'image/jpeg';
                    $_FILES['image_path']['tmp_name'] = $tmpFilename;
                    $_FILES['image_path']['error'] = 0;
                    $_FILES['image_path']['size'] = $fileSize;
                    $_FILES['image_path']['isUploadBase64File'] = true;
                    if ($fileSize > 0) {
                        $upload = new UploadFile();
                        @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $insertArray['goods_image']);
                        $upload->set('default_dir', ATTACH_GOODS . DS . $store_info['store_id'] . DS . $upload->getSysSetPath());
                        $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                        $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                        $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                        $upload->set('fprefix', $store_info['store_id']);
                        $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
                        $upload->upfile('image_path');
                        $insertArray['goods_image'] = $upload->getSysSetPath() . $upload->file_name;
                    }

                    //删除文件
                    fclose($tempfile);
                }
            }
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body']; //服务详情描述
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']); //服务详情描述

            //======================================先往goods_common中保存数据

            $goods_common_model = new GoodsCommon();
            $goodsCommonArray = array();
            $goodsCommonArray['goods_name'] = $_POST['g_name'];
            $goodsCommonArray['goods_jingle'] = $_POST['g_jingle'];
            $goodsCommonArray['gc_id'] = $_POST['gc_id'];
            $goodsCommonArray['gc_id_1'] = 1073;
            $goodsCommonArray['gc_id_2'] = $_POST['gc_id'];
            $goodsCommonArray['gc_id_3'] = 0;
            $gc_name = GoodsClass::findFirst(array("conditions" => "gc_id=" . $_POST['gc_id'], "columns" => "gc_name"));
            if ($gc_name) {
                $goodsCommonArray['gc_name'] = $gc_name['gc_name'];
            } else {
                $goodsCommonArray['gc_name'] = "未分类";
            }
            $goodsCommonArray['store_id'] = $store_info['store_id'];
            $goodsCommonArray['store_name'] = $store_info['store_name'];
            $goodsCommonArray['spec_name'] = '医疗服务';
            $goodsCommonArray['spec_value'] = '医疗服务';
            $goodsCommonArray['goods_image'] = $insertArray['goods_image'];
            $goodsCommonArray['goods_attr'] = '医疗';
            $goodsCommonArray['goods_custom'] = '医疗';
            $goodsCommonArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'];
            $goodsCommonArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']);
            $goodsCommonArray['goods_state'] = 1;
            $goodsCommonArray['goods_verify'] = 10;
            $goodsCommonArray['goods_addtime'] = time();
            $goodsCommonArray['goods_selltime'] = time();
            $goodsCommonArray['goods_price'] = empty($_POST['system_price']) ? 0.00 : $_POST['system_price']; //平台价格
            $goodsCommonArray['goods_marketprice'] = 0;
            $goodsCommonArray['goods_costprice'] = 0;
            $goodsCommonArray['goods_discount'] = 0;
            $goodsCommonArray['goods_storage_alarm'] = 1;
            $goodsCommonArray['areaid_1'] = 0;
            $goodsCommonArray['areaid_2'] = 0;
            $goodsCommonArray['sup_id'] = 0;
            $goodsCommonArray['doctor_id'] = $member_model['member_id'];
            $goodsCommonArray['is_virtual'] = 1; //属于虚拟产品
            $goodsCommonArray['virtual_indate'] = strtotime($_POST['end_time']); //服务的失效时间
            $goodsCommonArray['virtual_limit'] = 1; //每人每次限购1个
            $goodsCommonArray['virtual_invalid_refund'] = 0; //是否允许过期退款

            $res_common = $goods_common_model->save($goodsCommonArray);

            //==============往goods表中添加数据
            $insertArray['goods_commonid'] = $goods_common_model->getGoodsCommonid();
            $insertArray['store_id'] = $store_info['store_id'];
            $insertArray['store_name'] = $store_info['store_name'];
            $insertArray['goods_storage_alarm'] = 0;
            $insertArray['spec_name'] = '医疗服务';
            $insertArray['goods_spec'] = '医疗服务';
            $insertArray['goods_state'] = 1; //正常
            $insertArray['goods_verify'] = 10; //审核中
            $insertArray['goods_addtime'] = time();
            $insertArray['goods_edittime'] = time();
            $insertArray['areaid_1'] = 0;
            $insertArray['areaid_2'] = 0;
            $insertArray['color_id'] = 0;
            $insertArray['transport_id'] = 0;
            $insertArray['doctor_id'] = $member_model['member_id'];
            $model = new Goods();
            $res = $model->save($insertArray);
            if ($res === false) {
                @header("location:/h5_web/js_template/member/service_set_add.html?resdata=savefail");
                exit;
            }

            //更新医院地址和科室地址
            $store_join_model = Model('store_joinin');
            if (!empty($store_join_model)) {
                $address_str = $_POST['hispital_address'] . "," . $_POST['depart_address'];
                $store_join_model->modify(array('company_address_detail' => $address_str), array('member_id' => $member_model["member_id"]));
            }

            //如果发布的商品是服务，生成相应服务编号
            if ($model->getGcId1() == 1073) {
                for ($i = 1; $i <= $model->getGoodsStorage(); $i++) {
                    $member_buy_service_num_data['goods_id'] = $model->getGoodsId();
                    $member_buy_service_num_data['start_time'] = $model->getDoctorServiceStartTime();
                    $member_buy_service_num_data['end_time'] = $model->getDoctorServiceEndTime();
                    $member_buy_service_num_data['buyer_number'] = $i;
                    $member_buy_service_num_data['doctor_id'] = $member_model['member_id'];
                    $member_buy_service_num_data['is_use'] = 0;
                    $member_buy_service_num = new MemberBuyServiceNum();
                    $member_buy_service_num->save($member_buy_service_num_data);
                }
            }
            @header("location:/h5_web/js_template/member/service_set_add.html?resdata=ok");
        } elseif (!empty($_POST['opType']) && $_POST['opType'] == "edit") { //表示是编辑服务
            $goods_id = $_POST['goods_id']; //获取服务id
            if (empty($goods_id)) {
                @header("location:/h5_web/js_template/member/service_set_add.html?resdata=nogoods");
                exit;
            }
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if (empty($goods_info) || $goods_info === false) {
                @header("location:/h5_web/js_template/member/service_set_add.html?resdata=nogoods");
                exit;
            }
            $goods_commonid = $goods_info->getGoodsCommonid();
            $goods_common_info = GoodsCommon::findFirst("goods_commonid=" . $goods_commonid);
            if (empty($goods_common_info)) {
                @header("location:/h5_web/js_template/member/service_set_add.html?resdata=nogoods");
                exit;
            }
            $buy_points_rate = $_POST['buy_points_rate']; //服务赠送积分比例
            $goods_update_array = array(
                'gc_id_1' => 1073,
                'gc_id_2' => $_POST['gc_id'],
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'doctor_private_price' => $_POST['private_price'],
                'goods_price' => $_POST['system_price'],
                'goods_promotion_price' => $_POST['system_price'],
                'goods_storage' => $_POST['goods_storage'],
                'goods_points' => floor($_POST['system_price'] * $buy_points_rate), //计算服务赠送的积分
                'goods_verify' => 10,
                'doctor_service_start_time' => strtotime($_POST['sart_time']),
                'doctor_service_end_time' => strtotime($_POST['end_time']),
                'virtual_indate' => strtotime($_POST['end_time']),
                'hispital_address' => $_POST['hispital_address'],
                'hispital_zuozhen' => $_POST['hispital_zuozhen'], //坐诊医院
                'depart_address' => $_POST['depart_address']
            );
            if (!empty($_POST['server_img'])) {//上传服务主图
                $base64_image_content = $_POST['server_img'];
                //匹配出图片的格式
                if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
                    // $temp = tempnam(ini_get("upload_tmp_dir"), 'PHP'); //tempnam — 建立一个具有唯一文件名的文件  ini_get("upload_tmp_dir") — 返回用于apache临时文件的目录
                    // $temp_file = fopen($temp, "w");
                    // $fileSize = fwrite($temp_file, base64_decode(str_replace($result[1], '', $base64_image_content)));
                    $tempfile = tmpfile(); // create temporary file
                    $fileSize = fwrite($tempfile, base64_decode(str_replace($result[1], '', $base64_image_content))); // fill data to temporary file
                    $metaDatas = stream_get_meta_data($tempfile);
                    $tmpFilename = $metaDatas['uri'];
                    //倒回文件的开头
                    rewind($tempfile);

                    $_FILES['image_path']['name'] = basename($tmpFilename, '.tmp') . '.jpg';
                    $_FILES['image_path']['type'] = 'image/jpeg';
                    $_FILES['image_path']['tmp_name'] = $tmpFilename;
                    $_FILES['image_path']['error'] = 0;
                    $_FILES['image_path']['size'] = $fileSize;
                    $_FILES['image_path']['isUploadBase64File'] = true;
                    if ($fileSize > 0) {
                        $upload = new UploadFile();
                        @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $insertArray['goods_image']);
                        $upload->set('default_dir', ATTACH_GOODS . DS . $store_info['store_id'] . DS . $upload->getSysSetPath());
                        $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                        $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                        $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                        $upload->set('fprefix', $store_info['store_id']);
                        $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
                        $upload->upfile('image_path');
                        $goods_update_array['goods_image'] = $upload->getSysSetPath() . $upload->file_name;
                    }

                    //删除文件
                    fclose($tempfile);
                }
            }
            if (!empty($_POST['g_body'])) {
                $goods_update_array['goods_body'] = $_POST['g_body']; //服务详情描述
            }
            if (!empty($_POST['m_body'])) {
                $goods_update_array['mobile_body'] = serialize($_POST['m_body']); //服务详情描述
            }
            $old_start_time = $goods_info->getDoctorServiceStartTime(); //该服务原先的开始时间
            $old_end_time = $goods_info->getDoctorServiceEndTime(); //该服务原先的结束时间
            $old_goods_nums = intval($goods_info->getGoodsStorage()); //该服务原先的库存

            $res = $goods_info->save($goods_update_array);
            //----------------------------------------------------修改goods_common------------------------------------------
            $goods_common_update_array = array(
                'gc_id_1' => 1073,
                'gc_id_2' => $_POST['gc_id'],
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['system_price'],
                'goods_image' => $goods_info->getGoodsImage(),
                'virtual_indate' => strtotime($_POST['end_time']),
                'goods_verify' => 10
            );
            if (!empty($goods_update_array['goods_image'])) {
                $goods_common_update_array['goods_image'] = $goods_update_array['goods_image'];
            }
            if (!empty($_POST['g_body'])) {
                $goods_common_update_array['goods_body'] = $_POST['g_body']; //服务详情描述
            }
            if (!empty($_POST['m_body'])) {
                $goods_common_update_array['mobile_body'] = serialize($_POST['m_body']); //服务详情描述
            }
            $res = $goods_common_info->save($goods_common_update_array);
            if ($res === false) {
                @header("location:/h5_web/js_template/member/service_set_add.html?resdata=err");
                exit;
            }

            //更新医院地址和科室地址
            $store_join_model = Model('store_joinin');
            if (!empty($store_join_model)) {
                $address_str = $_POST['hispital_address'] . "," . $_POST['depart_address'];
                $store_join_model->modify(array('company_address_detail' => $address_str), array('member_id' => $member_model["member_id"]));
            }

            //如果修改的是服务，且服务时间发生变化，则重新生成服务编号
            if ($goods_info->getGcId1() == 1073) {
                $new_start_time = strtotime($_POST['sart_time']); //修改后的开始时间
                $new_end_time = strtotime($_POST['end_time']); //修改后的结束时间
                $new_goods_nums = intval($_POST['goods_storage']); //修改后的库存
                if ($new_start_time != $old_start_time || $new_end_time != $old_end_time || $new_goods_nums != $old_goods_nums) {
                    for ($i = 1; $i <= $goods_info->getGoodsStorage(); $i++) {
                        $member_buy_service_num_data['goods_id'] = $goods_info->getGoodsId();
                        $member_buy_service_num_data['start_time'] = $goods_info->getDoctorServiceStartTime();
                        $member_buy_service_num_data['end_time'] = $goods_info->getDoctorServiceEndTime();
                        $member_buy_service_num_data['buyer_number'] = $i;
                        $member_buy_service_num_data['doctor_id'] = $member_model['member_id'];
                        $member_buy_service_num_data['is_use'] = 0;
                        $member_buy_service_num = new MemberBuyServiceNum();
                        $member_buy_service_num->save($member_buy_service_num_data);
                    }
                }
            }
            @header("location:/h5_web/js_template/member/service_set_add.html?resdata=ok");
        } else {
            @header("location:/h5_web/js_template/member/service_set_add.html?resdata=err");
        }
        exit;
    }

    /**
     * 获取聊天卡的翻倍比例
     */
    public function get_commis_rateAction()
    {
        $goods_class = GoodsClass::findFirst("gc_id=1076");
        if ($goods_class !== false) {
            echo $goods_class->getCommisRate();
        } else {
            echo 0;
        }
        exit;
    }

    /**
     * 已发布聊天卡列表
     */
    public function chat_cardAction()
    {
        $str = "";
        $member_model = $this->member_info;
        $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
        if ($store_info !== false) {
            $goods_list = Goods::find("store_id=" . $store_info->getStoreId() . " and gc_id_1=1076 and goods_state=1 and goods_verify=1");
            if (count($goods_list) > 0) {
                $goods_list = $goods_list->toArray();
                foreach ($goods_list as $goods_info) {
                    $str .= "<dl class=\"mt5 news_list\" style='height: 55px;line-height: 55px;'>";
                    $str .= "<dt>";
                    $str .= "<h3 style='width: 11rem;'>" . $goods_info['goods_name'] . "</h3>";
                    $str .= "<a href=\"chat_card_add.html?goods_id=" . $goods_info['goods_id'] . "\" style=\"display: inline-block;margin-top: 5px;font-size: 0.7rem;\">编辑</a>";
                    $str .= "<a href=\"javascript:if(confirm('确实要删除吗?'))location='" . getUrl('mobile/member_indexat_card_del', array('goods_id' => $goods_info['goods_id'], 'key' => $_POST['key'])) . "'\" style=\"display: inline-block; margin-left:8px;font-size: 0.7rem; \" >删除</a>";
                    $str .= "</dt>";
                    $str .= "</dl>";
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * 聊天卡下拉列表
     */
    public function chat_card_selectAction()
    {
        $str = "";
        $goods_class_list = GoodsClass::find("gc_id=1076");
        if (count($goods_class_list) > 0) {
            $goods_class_list = $goods_class_list->toArray();
            foreach ($goods_class_list as $good_class) {
                $str .= "<option value='" . $good_class['commis_rate'] . "' data-id='" . $good_class['gc_id'] . "' data-pointrate='" . $good_class['buy_points_rate'] . "'>" . $good_class['gc_name'] . "</option>";
            }
        }
        echo $str;
        exit;
    }

    /**
     * 聊天卡保存
     */
    public function chat_card_saveAction()
    {
        //获取聊天卡的获取积分翻倍比例
        $goods_class_model = GoodsClass::findFirst("gc_id=1076");
        if ($goods_class_model !== false) {
            $buy_points_rate = $goods_class_model->getBuyPointsRate();
        } else {
            $buy_points_rate = 0;
        }

        $member_model = $this->member_info;
        if (!empty($_REQUEST['opType']) && $_REQUEST['opType'] == 'edit') { //表示是编辑信息
            $goods_id = $_REQUEST['goods_id']; //服务id
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if ($goods_info === false) {
                @header("location:/h5_web/js_template/member/chat_card_add.html?resdata=savefail");
            }
            $goods_commonid = $goods_info->getGoodsCommonid();
            $goods_common_info = GoodsCommon::findFirst("goods_commonid=" . $goods_commonid);
            $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
            if ($goods_common_info === false || $store_info === false) {
                @header("location:/h5_web/js_template/member/chat_card_add.html?resdata=savefail");
            }
            $store_info = $store_info->toArray();
            $goods_update_array = array(
                'gc_id_1' => 1076,
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'doctor_private_price' => $_POST['private_price'], //私有价格
                'goods_price' => $_POST['goods_price'], //平台价格
                'goods_points' => floor($_POST['goods_price'] * $buy_points_rate), //计算聊天卡赠送的积分
                'goods_promotion_price' => $_POST['goods_price'], //促销价格
                'goods_storage' => $_POST['goods_storage'], //库存数量
                //'spec_name' => (strtotime($_POST['end_time']) - strtotime($_POST['sart_time'])),  //时长（单位：秒）
                'spec_name' => intval($_POST['goods_spec']) * 60,  //时长（单位：秒）
                'goods_body' => empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'],
                'goods_verify' => 10,
                'doctor_service_start_time' => strtotime($_POST['sart_time']),
                'doctor_service_end_time' => strtotime($_POST['end_time']),
                'virtual_indate' => strtotime($_POST['end_time']), //失效时间
                'mobile_body' => empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body'])
            );
            if (!empty($_FILES['image_path']['name'])) {//上传聊天卡主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $goods_update_array['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS . DS . $store_info['store_id'] . DS . $upload->getSysSetPath());
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('fprefix', $store_info['store_id']);
                $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
                $upload->upfile('image_path');
                $goods_update_array['goods_image'] = $upload->getSysSetPath() . $upload->file_name;
            }
            $res = $goods_info->save($goods_update_array);

            //----------------------------------------------修改goods_common--------------------------------------------
            $goods_common_update_array = array(
                'gc_id_1' => 1076,
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['goods_price'],
                'goods_body' => empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'],
                'goods_verify' => 10,
                'virtual_indate' => strtotime($_POST['end_time']), //失效时间
                //'spec_name'=>strtotime($_POST['end_time']) - strtotime($_POST['sart_time']),
                'spec_name' => intval($_POST['goods_spec']) * 60,
                //'spec_value'=>strtotime($_POST['end_time']) - strtotime($_POST['sart_time']),
                'spec_value' => intval($_POST['goods_spec']) * 60,
                'mobile_body' => empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body'])
            );
            $res = $goods_common_info->save($goods_common_update_array);
            if ($res == true) {
                @header("location:/h5_web/js_template/member/chat_card.html?resdata=ok");
            } else {
                @header("location:/h5_web/js_template/member/chat_card_add.html?resdata=err");
            }
        } else {  //表示新增聊天卡
            $member_model = $this->member_info;
            $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
            $store_info = $store_info->toArray();
            $insertArray = array();
            $insertArray['gc_id'] = 1076; //服务类型id
            $insertArray['gc_id_1'] = 1076; //一级聊天卡类型id
            $insertArray['goods_name'] = $_POST['g_name']; //名称
            $insertArray['goods_jingle'] = $_POST['g_jingle']; //卖点
            $insertArray['doctor_private_price'] = $_POST['private_price']; //聊天卡私有价格
            $insertArray['goods_price'] = $_POST['goods_price']; //聊天卡平台翻倍后的价格
            $insertArray['goods_points'] = floor($_POST['goods_price'] * $buy_points_rate); //计算聊天卡赠送的积分
            $insertArray['goods_promotion_price'] = $_POST['goods_price']; //促销价格
            $insertArray['goods_marketprice'] = $_POST['goods_price']; //市场价格
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body']; //电脑端详情描述
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']); //手机端详情描述
            $insertArray['is_virtual'] = 1; //属于虚拟产品
            $insertArray['doctor_service_start_time'] = strtotime($_POST['sart_time']);  //开始时间
            $insertArray['doctor_service_end_time'] = strtotime($_POST['end_time']); //结束时间
            $insertArray['virtual_indate'] = strtotime($_POST['end_time']); //聊天卡失效时间
            $insertArray['virtual_limit'] = 1; //每人每次限购1个
            $insertArray['virtual_invalid_refund'] = 0; //是否允许过期退款
            if (!empty($_FILES['image_path'])) {//上传服务主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $insertArray['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS . DS . $store_info['store_id'] . DS . $upload->getSysSetPath());
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('fprefix', $store_info['store_id']);
                $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
                $upload->upfile('image_path');
                $insertArray['goods_image'] = $upload->getSysSetPath() . $upload->file_name;
            }
            //===================================================================================================================================================
            //先往goods_common中保存数据
            $goods_common_model = new GoodsCommon();
            $goodsCommonArray = array();
            $goodsCommonArray['goods_name'] = $_POST['g_name'];
            $goodsCommonArray['goods_jingle'] = $_POST['g_jingle'];
            $goodsCommonArray['gc_id'] = 1076;
            $goodsCommonArray['gc_id_1'] = 1076;
            $goodsCommonArray['gc_id_2'] = 0;
            $goodsCommonArray['gc_id_3'] = 0;
            $gc_name = GoodsClass::findFirst(array("conditions" => "gc_id=1076", "columns" => "gc_name"));
            if ($gc_name) {
                $goodsCommonArray['gc_name'] = $gc_name['gc_name'];
            } else {
                $goodsCommonArray['gc_name'] = "未分类";
            }
            $goodsCommonArray['store_id'] = $store_info['store_id'];
            $goodsCommonArray['store_name'] = $store_info['store_name'];
            //$goodsCommonArray['spec_name'] = strtotime($_POST['end_time']) - strtotime($_POST['sart_time']);
            $goodsCommonArray['spec_name'] = intval($_POST['goods_spec']) * 60;
            //$goodsCommonArray['spec_value'] = strtotime($_POST['end_time']) - strtotime($_POST['sart_time']);
            $goodsCommonArray['spec_value'] = intval($_POST['goods_spec']) * 60;
            $goodsCommonArray['goods_attr'] = '聊天';
            $goodsCommonArray['goods_custom'] = '聊天';
            $goodsCommonArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'];
            $goodsCommonArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']);
            $goodsCommonArray['goods_state'] = 1;
            $goodsCommonArray['goods_verify'] = 10;
            $goodsCommonArray['goods_addtime'] = time();
            $goodsCommonArray['goods_selltime'] = time();
            $goodsCommonArray['goods_price'] = empty($_POST['goods_price']) ? 0.00 : $_POST['goods_price']; //商品价格
            $goodsCommonArray['goods_marketprice'] = 0;
            $goodsCommonArray['goods_costprice'] = 0;
            $goodsCommonArray['goods_discount'] = 0;
            $goodsCommonArray['goods_storage_alarm'] = 100;
            $goodsCommonArray['areaid_1'] = 0;
            $goodsCommonArray['areaid_2'] = 0;
            $goodsCommonArray['sup_id'] = 0;
            $goodsCommonArray['doctor_id'] = $member_model['member_id'];
            $goodsCommonArray['is_virtual'] = 1; //属于虚拟产品
            $goodsCommonArray['virtual_indate'] = strtotime($_POST['end_time']); //聊天卡失效时间
            $goodsCommonArray['virtual_limit'] = 1; //每人每次限购1个
            $goodsCommonArray['virtual_invalid_refund'] = 0; //是否允许过期退款

            $res_common = $goods_common_model->save($goodsCommonArray);

            $insertArray['goods_commonid'] = $goods_common_model->getGoodsCommonid();
            $insertArray['store_id'] = $store_info['store_id'];
            $insertArray['store_name'] = $store_info['store_name'];
            $insertArray['gc_id'] = 1076; //分类id
            $insertArray['gc_id_1'] = 1076;
            $insertArray['gc_id_2'] = 0;
            $insertArray['gc_id_3'] = 0;
            $insertArray['goods_storage_alarm'] = 0;
            //$insertArray['spec_name'] = strtotime($_POST['end_time']) - strtotime($_POST['sart_time']); //聊天时长（单位：秒）
            $insertArray['spec_name'] = intval($_POST['goods_spec']) * 60; //聊天时长（单位：秒）
            $insertArray['goods_spec'] = '聊天卡';
            $insertArray['goods_storage'] = intval($_POST['goods_storage']); //数量
            $insertArray['goods_state'] = 1;
            $insertArray['goods_verify'] = 10;
            $insertArray['goods_addtime'] = time();
            $insertArray['goods_edittime'] = time();
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'];
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']);
            $insertArray['areaid_1'] = 0;
            $insertArray['areaid_2'] = 0;
            $insertArray['color_id'] = 0;
            $insertArray['transport_id'] = 0;
            $insertArray['doctor_id'] = $member_model['member_id'];

            $model = new Goods();
            $res = $model->save($insertArray);
            if (!$res) {
//                showMessage('聊天卡保存失败', getUrl('mobile/member_index/'), 'html', 'error');
                @header("location:/h5_web/js_template/chat_card.html");
            }

            //如果发布的商品是服务，生成相应服务编号
            if ($model->getGcId1() == 1076) {
                for ($i = 1; $i <= $model->getGoodsStorage(); $i++) {
                    $member_buy_service_num_data['goods_id'] = $model->getGoodsId();
                    $member_buy_service_num_data['start_time'] = $model->getDoctorServiceStartTime();
                    $member_buy_service_num_data['end_time'] = $model->getDoctorServiceEndTime();
                    $member_buy_service_num_data['buyer_number'] = $i;
                    $member_buy_service_num_data['doctor_id'] = $member_model['member_id'];
                    $member_buy_service_num = new MemberBuyServiceNum();
                    $member_buy_service_num->save($member_buy_service_num_data);
                }
            }

            //redirect(getUrl('mobile/chat_card_add/add_step_four', array('commonid' => $insertArray['goods_commonid'])));
            @header("location:/h5_web/js_template/member/chat_card.html");
        }
    }

    /**
     * 聊天卡删除
     */
    public function chat_card_delAction()
    {
        //$where = " sg_id = '". intval($id) ."'";
        $id = $_GET['goods_id'];
        $result = Goods::findFirst(array('conditions' => $id));
        $result_common = GoodsCommon::findFirst(array('conditions' => $result->getGoodsCommonid()));
        //$result = Db::delete('store_grade',$where);
        if ($result && $result_common) {
            if ($result->delete() && $result_common->delete()) {
                @header("location:/h5_web/js_template/member/chat_card.html?resdata=del");
            } else {
                @header("location:/h5_web/js_template/member/chat_card.html?resdata=false");
            }
        } else {
            @header("location:/h5_web/js_template/member/chat_card.html?resdata=false");
        }
    }

    /**
     * 获取当前医生的服务列表
     */
    public function load_doctor_service_listAction()
    {
        $member_model = $this->member_info;
        $option_list = "";
        $goods_list = Goods::find("gc_id_1=1073 and doctor_id=" . $member_model['member_id'] . " and goods_state=1 and goods_verify=1 and doctor_service_end_time<" . time());
        if (count($goods_list) > 0) {
            $goods_list = $goods_list->toArray();
            foreach ($goods_list as $goods_info) {
                $option_list .= "<option value=\"" . $goods_info['goods_id'] . "\">" . $goods_info['goods_name'] . "</option>";
            }
        }
        echo $option_list;
        exit;
    }

    /**
     * 加载医生服务的购买记录
     */
    public function load_doctor_service_record_listAction()
    {
        $member_model = $this->member_info;
        $goods_id = $_REQUEST['serviceId']; //服务id
        $str = "";
        if (!empty($goods_id)) {
            if (intval($goods_id) == -1) {
                $member_buy_service_info_list = MemberBuyServiceNum::find("doctor_id=" . $member_model['member_id'] . " and is_use=1 and end_time>=" . time());
            } else {
                $member_buy_service_info_list = MemberBuyServiceNum::find("goods_id={$goods_id} and doctor_id=" . $member_model['member_id'] . " and is_use=1 and end_time>=" . time());
            }

            $str = $this->getListStr($member_buy_service_info_list);
        }
        if (empty($str)) {
            $str .= "<ul class=\"ulArea\">";
            $str .= "<li class=\"item\" style='text-align: center;'>暂无购买记录";
            $str .= "</li>";
            $str .= "</ul>";
        }
        echo $str;
        exit;
    }

    /**
     * 拼接字符串
     * @param $member_buy_service_info_list
     * @return string
     */
    public function getListStr($member_buy_service_info_list)
    {
        $str = "";
        if (count($member_buy_service_info_list) > 0) {
            $member_buy_service_info_list = $member_buy_service_info_list->toArray();
            foreach ($member_buy_service_info_list as $member_buy_service_info) {
                $goods_id = $member_buy_service_info['goods_id'];
                $goods_info = Goods::findFirst("goods_id=" . $goods_id);
                if ($goods_info === false) {
                    continue;
                }
                $member_info = Member::findFirst("member_id=" . $member_buy_service_info['buyer_id']);
                if ($member_info === false) {
                    continue;
                }
                $str .= "<ul class=\"ulArea\" id='" . $member_buy_service_info['id'] . "' data-goodsid='" . $goods_info->getGoodsId() . "'>";
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">服务名称：</span>";
                $str .= "<span class=\"content\">" . $goods_info->getGoodsName() . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">购买者：</span>";
                $str .= "<span class=\"content\">" . $member_info->getMemberName() . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">购买时间：</span>";
                $str .= "<span class=\"content\">" . date('Y-m-d H:i:s', $member_buy_service_info['add_time']) . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">编号：</span>";
                $str .= "<span class=\"content\">" . $member_buy_service_info['buyer_number'] . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">服务开始时间：</span>";
                $str .= "<span class=\"content\">" . date('Y-m-d H:i:s', $member_buy_service_info['start_time']) . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">服务结束时间：</span>";
                $str .= "<span class=\"content\">" . date('Y-m-d H:i:s', $member_buy_service_info['end_time']) . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item is_exchange\">";
                $str .= "<span class=\"title\">是否已兑换：</span>";
                $str .= "<span class=\"content\">" . ($member_buy_service_info['is_exchange'] == 0 ? "<span>否</span>" : "<span style='color: green;font-weight: bold;'>是</span>") . "</span>";
                $str .= "</li>";

                $order_sn = $member_buy_service_info['order_sn'];
                $vr_order = VrOrder::findFirst("order_sn=" . $order_sn);
                if (!empty($order_sn) && intval($member_buy_service_info['is_exchange']) !== 0) {
                    if ($vr_order !== false) {
                        $vr_order_code = VrOrderCode::findFirst("order_id=" . $vr_order->getOrderId());
                        if ($vr_order_code !== false) {
                            $vr_code = "<span style='color: green;font-weight: bold;'>" . $vr_order_code->getVrCode() . "";
                        }
                    }
                } else {
                    $vr_code = "尚无兑换";
                }
                $str .= "<li class=\"item\">";
                $str .= "<span class=\"title\">买家留言：</span>";
                $str .= "<span class=\"content\" style='font-size: 0.6rem;display: block;padding-left: 4rem;'>" . $vr_order->getBuyerMsg() . "</span>";
                $str .= "</li>";
                $str .= "<li class=\"item vr_code\">";
                $str .= "<span class=\"title\">兑换码：</span>";
                $str .= "<span class=\"content\">" . $vr_code . "</span></span>";
                $str .= "</li>";
                $str .= "</ul>";


//                $str .= "<tr>";
//                $str .= "<td>" . $goods_info->getGoodsName() . "</td>"; //服务名称
//                $str .= "<td>" . $member_info->getMemberName() . "</td>"; //购买人
//                $str .= "<td>" . date('Y-m-d H:i:s', $member_buy_service_info['add_time']) . "</td>"; //购买时间
//                $str .= "<td>" . $member_buy_service_info['buyer_number'] . "</td>"; //编号
//                $str .= "<td>" . date('Y-m-d H:i:s', $member_buy_service_info['start_time']) . "</td>"; //服务开始时间
//                $str .= "<td>" . date('Y-m-d H:i:s', $member_buy_service_info['end_time']) . "</td>"; //服务结束时间
//                $str .= "</tr>";
            }
        }
        return $str;
    }

    /**
     * 检测服务是否有新的购买记录
     */
    public function check_buyAction()
    {
        $str = "";
        $member_buy_service_info_list = MemberBuyServiceNum::find("doctor_id=" . $this->member_info['member_id'] . " and is_use=1 and is_new=1 and is_exchange=1 and end_time>=" . time());
        if (count($member_buy_service_info_list) > 0) {
            $res_arr = array();
            foreach ($member_buy_service_info_list as $member_buy_service_info) {
                //把is_new 更改为0，表示已经提醒过
                $member_buy_service_info->setIsNew(0);
                $member_buy_service_info->save();

                $member_info = Member::findFirst("member_id=" . $member_buy_service_info->getBuyerId());
                if ($member_info === false) {
                    continue;
                }

                $order_sn = $member_buy_service_info->getOrderSn();
                if (!empty($order_sn)) {
                    $vr_order = VrOrder::findFirst("order_sn=" . $order_sn);
                    if ($vr_order !== false) {
                        $vr_order_code = VrOrderCode::findFirst("order_id=" . $vr_order->getOrderId());
                        if ($vr_order_code !== false) {
                            $vr_code = $vr_order_code->getVrCode();
                        }
                    }
                } else {
                    $vr_code = "尚无兑换";
                }
                $res_arr[$member_buy_service_info->getId()] = array('id' => $member_buy_service_info->getId(), 'buyer_name' => $member_info->getMemberName(), 'vr_code' => $vr_code);

//                if (empty($str)) {
//                    $str .= $member_buy_service_info->getId();
//                } else {
//                    $str .= "," . $member_buy_service_info->getId();
//                }
            }
        }
//        echo $str;
        echo json_encode($res_arr);
        exit;
    }

    /**
     * 加载产品订单
     */
    public function custom_order_listAction()
    {
        $str = "";
        $member_model = $this->member_info;
        if (empty($member_model)) {
            echo "nologin";
            exit;
        }
        if ($member_model['member_type_id'] < 2) { //表示是普通用户
            echo "illegal";
            exit;
        }
        $store_info = Store::findFirst("member_id=" . $member_model['member_id'] . " and store_state=1");
        if ($store_info === false) {
            echo "nopass";
            exit;
        }
        $model_order = Model('order');
        $_GET['state_type'] = 'state_pay';
        $order_list = $model_order->getStoreOrderList($store_info->getStoreId(), $_GET['order_sn'], $_GET['buyer_name'], $_GET['state_type'], $_GET['query_start_date'], $_GET['query_end_date'], $_GET['skip_off'], '*', array('order_goods', 'order_common', 'member'));
        if (count($order_list) > 0) {
            foreach ($order_list as $order_info) {
                $str .= "<div class=\"order\">";
                $str .= "<div style=\"background-color: #ddd;font-size: 0.7rem;padding-left: 10px;padding-bottom: 5px;\">";
                $str .= "<div>订单编号：" . $order_info['order_sn'] . "</div>";
                $str .= "<div>下单时间：" . date('Y-m-d H:i:s', $order_info['add_time']) . "</div>";
                $str .= "<div><input type=\"button\" value=\"发货\" data-id=\"" . $order_info['order_id'] . "\" onclick=\"sendGoods(this)\" style=\"width: 85px;height: 30px;border-radius: 5px;background-color: #938c8c;color: #fff;\"/></div>";
                $str .= "</div>";
                if (count($order_info['goods_list']) > 0) {
                    foreach ($order_info['goods_list'] as $goods_info) {
                        $str .= "<ul class=\"ulArea\">";
                        $str .= "<li class=\"item\">";
                        $str .= "<span class=\"title\">商品名称：</span>";
                        $str .= "<span class=\"content\">" . $goods_info['goods_name'] . "</span>";
                        $str .= "</li>";
                        $str .= "<li class=\"item\">";
                        $str .= "<span class=\"title\">单价：</span>";
                        $str .= "<span class=\"content\">" . $goods_info['goods_price'] . "</span>";
                        $str .= "</li>";
                        $str .= "<li class=\"item\">";
                        $str .= "<span class=\"title\">数量：</span>";
                        $str .= "<span class=\"content\">" . $goods_info['goods_num'] . "</span>";
                        $str .= "</li>";
                        $str .= "<li class=\"item\">";
                        $str .= "<span class=\"title\">买家：</span>";
                        $str .= "<span class=\"content\">" . $order_info['buyer_name'] . "</span>";
                        $str .= "</li>";
                        $str .= "<li class=\"item\">";
                        $str .= "<span class=\"title\">订单金额：</span>";
                        $str .= "<span class=\"content\">" . $order_info['goods_amount'] . "</span>";
                        $str .= "</li>";
                        $str .= "<li class=\"item\">";
                        $str .= "<span class=\"title\">交易状态：</span>";
                        $str .= "<span class=\"content\">待发货</span>";
                        $str .= "</li>";
                        $str .= "</ul>";
                    }
                }
                $str .= "</div>";
            }
        } else {
            $str .= "<ul class=\"ulArea\">";
            $str .= "<li class=\"item\" style='text-align: center;'>暂无待发货记录";
            $str .= "</li>";
            $str .= "</ul>";
        }
        echo $str;
        exit;
    }

    /**
     * 发货设置
     */
    public function send_orderAction()
    {
        $order_id = $_POST['order_id']; //获取订单id
        $order_info = Orders::findFirst("order_id=" . $order_id);
        if ($order_info !== false) {
            $order_info->save(array(
                'order_state' => ORDER_STATE_SEND
            ));
        }
        echo "ok";
        exit;
    }

    /**
     * 收藏新闻资讯
     */
    public function collect_newsAction()
    {
        $member_model = $this->member_info;
        if (empty($member_model)) {
            echo "nologin";
        } else {
            if (!empty($_POST['newsId'])) {
                $article_info = Article::findFirst("article_id=" . $_POST['newsId']);
                if ($article_info === false) {
                    echo "nonews";
                } else {
                    if (ArticleCollect::count("article_id=" . $_POST['newsId'] . " and member_id=" . $member_model['member_id']) > 0) {
                        echo "ok";
                    } else {
                        $arr = array(
                            'article_id' => $_POST['newsId'],
                            'member_id' => $member_model['member_id'],
                            'add_time' => time()
                        );
                        $article_collect_info = new ArticleCollect();
                        if ($article_collect_info->save($arr) === false) {
                            echo "err";
                        } else {
                            echo "ok";
                        }
                    }
                }
            } else {
                echo "argerr";
            }
        }
        exit;
    }

    /**
     * 加载会员收藏的新闻列表
     */
    public function ajax_collect_article_listAction()
    {
        $str = "";
        $member_model = $this->member_info;
        if (empty($member_model)) {
            echo "nologin";
        } else {
            $article_collect_ids = ArticleCollect::find(array('conditions' => "member_id=" . $member_model['member_id'], 'columns' => 'article_id'));
            if (count($article_collect_ids) > 0) {
                $article_collect_ids = $article_collect_ids->toArray();
                $ids = array();
                foreach ($article_collect_ids as $id) {
                    $ids[] = $id['article_id'];
                }
                $ids = implode(',', $ids); //获取所有的收藏的新闻id集合
                if (!empty($ids)) {
                    $ac_info = ArticleClass::findFirst("ac_code='news'");
                    if ($ac_info) {
                        $ac_id = $ac_info->getAcId();
                        $article_list = Article::find("ac_id=" . $ac_id . " and article_id in (" . $ids . ") and article_show=1");
                        if (count($article_list) > 0) {
                            $article_list = $article_list->toArray();
                            foreach ($article_list as $article) {
                                $str .= "<dl class=\"mt5 news_list\">";
                                $str .= " <dt>";
                                $str .= " <a href=\"news_detail.html?news_id=" . $article['article_id'] . "\">";
                                $title = mb_strlen($article['article_title'], 'UTF-8') > 26 ? (mb_substr($article['article_title'], 0, 26, 'UTF-8') . "...") : $article['article_title'];
                                $str .= "<h3>" . $title . "</h3>";
                                $str .= "<span>";
                                $str .= "<img class=\"news_img\" src=\"/public/h5_web/images/news/news_ico.png\" />";
                                $str .= "</span>";
                                $str .= "</a>";
                                $str .= "</dt>";
                                $str .= "</dl>";
                            }
                        }
                    }
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * 加载购买该医生的服务的用户列表
     */
    public function load_buy_service_user_liatAction()
    {
        $str = "";
        $member_model = $this->member_info;
        if (empty($member_model)) {
            echo "nologin";
        } else {
            $store_info = Store::findFirst("member_id=" . $member_model['member_id']);
            if ($store_info !== false) {
                $member_ids = CaseHistory::find(array('conditions' => 'store_id=' . $store_info->getStoreId(), 'columns' => 'member_id'));
                if (count($member_ids) > 0) {
                    $user_ids = array();
                    foreach ($member_ids as $member_id) {
                        $user_ids[] = $member_id['member_id'];
                    }
                    if (!empty($user_ids)) {
                        $ids = implode(',', $user_ids);
                        if (!empty($ids)) {
                            $member_list = Member::find("member_id in (" . $ids . ") and member_state=1");
                            if (count($member_list) > 0) {
                                $member_list = $member_list->toArray();
                                foreach ($member_list as $member) {
                                    $str .= "<option value='" . $member['member_id'] . "'>" . $member['member_name'] . "</option>";
                                }
                            }
                        }
                    }
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * 获取用户的病历列表
     */
    public function load_case_history_listAction()
    {
        $str = "";
        $buyer_id = $_POST['member_id'];
        $member_model = $this->member_info;
        if (!empty($buyer_id)) {
            $store_info = Store::findFirst("member_id=" . $member_model['member_id']);
            if ($store_info !== false) {
                if (intval($buyer_id) == -1) { //查出该医生的客户的全部病历
                    $case_list = CaseHistory::find("store_id=" . $store_info->getStoreId() . " and is_public=1");
                } else {
                    $case_list = CaseHistory::find("member_id=" . $buyer_id . " and store_id=" . $store_info->getStoreId() . " and is_public=1");
                }
                if (count($case_list) > 0) {
                    $case_list = $case_list->toArray();
                    foreach ($case_list as $case_info) {
                        $str .= "<li class=\"item\"><a href=\"case_history_detail.html?case_id=" . $case_info['id'] . "\">" . $case_info['title'] . "</a></li>";
                    }
                }
            }
        }
        if (empty($str)) {
            $str = "<li class=\"item\">暂无病历记录</li>";
        }
        echo $str;
        exit;
    }

    /**
     * 根据客户id获取客户病历详情
     */
    public function load_case_history_contentAction()
    {
        $str = "";
        $case_id = $_POST['case_id'];
        if (!empty($case_id)) {
            $case_info = CaseHistory::findFirst("id=" . $case_id);
            if ($case_info !== false) {
                $str = json_encode(array('title' => $case_info->getTitle(), 'content' => $case_info->getCaseContent()));
            }
        }
        echo $str;
        exit;
    }

    /**
     * 加载直荐奖日志明细
     */
    public function load_straght_listAction()
    {
        $member_model = $this->member_info;
        $str = "";
        if (!empty($_POST['member_type']) && $_POST['member_type'] == "doctor") { //表示是医务人员
            $staraght_log_list = MemberStraightLog::find(array('conditions' => 'member_tree_type=1 and member_id=' . $member_model['member_id'], 'order' => 'add_time desc'));
            if (count($staraght_log_list) > 0) {
                $staraght_log_list = $staraght_log_list->toArray();
                foreach ($staraght_log_list as $staraght_log) {
                    $str .= "<tr>";
                    $str .= "<td>" . $member_model['member_name'] . "</td>";
                    $str .= "<td>医护圈直荐奖</td>";
                    $str .= "<td>" . ncPriceFormat($staraght_log['store_straight_money']) . "</td>";
                    $str .= "<td>" . date('Y-m-d H:i:s', $staraght_log['add_time']) . "</td>";
                    $str .= "</tr>";
                }
            }
        } else { //表示是普通客户
            $staraght_log_list = MemberStraightLog::find(array('conditions' => 'member_tree_type=0 and member_id=' . $member_model['member_id'], 'order' => 'add_time desc'));
            if (count($staraght_log_list) > 0) {
                $staraght_log_list = $staraght_log_list->toArray();
                foreach ($staraght_log_list as $staraght_log) {
                    $str .= "<tr>";
                    $str .= "<td>" . $member_model['member_name'] . "</td>";
                    $str .= "<td>客户圈直荐奖</td>";
                    $str .= "<td>" . ncPriceFormat($staraght_log['member_straight_money']) . "</td>";
                    $str .= "<td>" . date('Y-m-d H:i:s', $staraght_log['add_time']) . "</td>";
                    $str .= "</tr>";
                }
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='4'>暂无记录</td></tr>";
        }
        echo $str;
        exit;
    }

    /**
     * 加载积分碰撞奖日志明细
     */
    public function load_collision_listAction()
    {
        $member_model = $this->member_info;
        $str = "";
        if (!empty($_POST['member_type']) && $_POST['member_type'] == "doctor") { //表示是医务人员
            $collision_log_list = MemberPointsCollisionLog::find(array('conditions' => 'member_id=' . $member_model['member_id'] . ' and collision_log_type=1', 'order' => 'add_time desc'));
            if (count($collision_log_list) > 0) {
                $collision_log_list = $collision_log_list->toArray();
                foreach ($collision_log_list as $collision_log) {
                    $str .= "<tr>";
                    $str .= "<td>" . $member_model['member_name'] . "</td>";
                    $str .= "<td>医护圈碰撞</td>";
                    $str .= "<td>" . ncPriceFormat($collision_log['store_collision_money']) . "</td>";
                    $str .= "<td>" . $collision_log['store_collision_times'] . "</td>";
                    $str .= "<td>" . date('Y-m-d H:i:s', $collision_log['add_time']) . "</td>";
                    $str .= "</tr>";
                }
            }
        } else { //表示是普通客户
            $collision_log_list = MemberPointsCollisionLog::find(array('conditions' => 'member_id=' . $member_model['member_id'] . ' and collision_log_type=0', 'order' => 'add_time desc'));
            if (count($collision_log_list) > 0) {
                $collision_log_list = $collision_log_list->toArray();
                foreach ($collision_log_list as $collision_log) {
                    $str .= "<tr>";
                    $str .= "<td>" . $member_model['member_name'] . "</td>";
                    $str .= "<td>客户圈碰撞</td>";
                    $str .= "<td>" . ncPriceFormat($collision_log['member_collision_money']) . "</td>";
                    $str .= "<td>" . $collision_log['member_collision_times'] . "</td>";
                    $str .= "<td>" . date('Y-m-d H:i:s', $collision_log['add_time']) . "</td>";
                    $str .= "</tr>";
                }
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        echo $str;
        exit;
    }

    /**
     * 加载分佣奖日志明细
     */
    public function load_commission_listAction()
    {
        $member_model = $this->member_info;
        $str = "";
        if (!empty($_POST['member_type']) && $_POST['member_type'] == "doctor") { //表示是医务人员
            $commission_log_list = MemberCommissionLog::find(array('conditions' => 'member_id=' . $member_model['member_id'] . ' and commission_tree_type=1', 'order' => 'add_time desc'));
            if (count($commission_log_list) > 0) {
                $commission_log_list = $commission_log_list->toArray();
                foreach ($commission_log_list as $commission_log) {
                    $str .= "<tr>";
                    $str .= "<td>" . $member_model['member_name'] . "</td>";
                    $str .= "<td>医护圈</td>";
                    $str .= "<td>" . ncPriceFormat($commission_log['store_tree_commission_money']) . "</td>";
                    $str .= "<td>" . $commission_log['store_commission_level'] . "</td>";
                    $str .= "<td>" . date('Y-m-d H:i:s', $commission_log['add_time']) . "</td>";
                    $str .= "<tr>";
                }
            }
        } else { //表示是普通客户
            $commission_log_list = MemberCommissionLog::find(array('conditions' => 'member_id=' . $member_model['member_id'] . ' and commission_tree_type=0', 'order' => 'add_time desc'));
            if (count($commission_log_list) > 0) {
                $commission_log_list = $commission_log_list->toArray();
                foreach ($commission_log_list as $commission_log) {
                    $str .= "<tr>";
                    $str .= "<td>" . $member_model['member_name'] . "</td>";
                    $str .= "<td>客户圈</td>";
                    $str .= "<td>" . ncPriceFormat($commission_log['member_tree_commission_money']) . "</td>";
                    $str .= "<td>" . $commission_log['member_commission_level'] . "</td>";
                    $str .= "<td>" . date('Y-m-d H:i:s', $commission_log['add_time']) . "</td>";
                    $str .= "<tr>";
                }
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        echo $str;
        exit;
    }

    /**
     * 加载分利奖日志明细
     */
    public function load_share_benefits_listAction()
    {
        $member_model = $this->member_info;
        $str = "";
        $share_benifits_log_list = MemberShareBenefitsLog::find(array('conditions' => 'member_id=' . $member_model['member_id'], 'order' => 'add_time desc'));
        if (count($share_benifits_log_list) > 0) {
            $share_benifits_log_list = $share_benifits_log_list->toArray();
            foreach ($share_benifits_log_list as $share_benifits_log) {
                $str .= "<tr>";
                $str .= "<td>" . $member_model['member_name'] . "</td>";
                $str .= "<td>" . ncPriceFormat($share_benifits_log['share_benefits_money']) . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $share_benifits_log['add_time']) . "</td>";
                $str .= "</tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='3'>暂无记录</td></tr>";
        }
        echo $str;
        exit;
    }

    /**
     * 检测医生是否已经通过审核并且已经完善资料
     */
    public function check_doctor_ispassAction()
    {
        $flag = "err";
        $member_model = $this->member_info;
        if (!empty($member_model)) {
            //判断是否是开启状态，并且是医务人员类别
            if (intval($member_model['member_state']) == 1 && intval($member_model['member_type_id']) > 1) {
                //判断是否拥有店铺
                $store_info = Store::findFirst("member_id=" . $member_model['member_id']);
                if ($store_info !== false && $store_info->getStoreState() == 1) {
                    $flag = "pass";
                    if (check_info_complete($member_model['member_id']) != true) {
                        $flag = "nocomplete";
                    }
                }
            }
        }
        echo $flag;
        exit;
    }

    /**
     * 兑换码兑换
     */
    public function exchangeAction()
    {
        if (!empty($_POST['vr_code'])) {
            $data = $this->_exchange();
            output_data($data);
        } else {
            output_data(array('error' => '6', 'data' => '参数错误'));
        }
    }

    /**
     * 兑换码消费（兑换码完成兑换，订单流程走完，四大计算计算各种奖金和积分）
     */
    private function _exchange()
    {
        if (!preg_match('/^[a-zA-Z0-9]{15,18}$/', $_POST['vr_code'])) {
            return array('error' => '1', 'data' => '兑换码格式错误，请重新输入');
        }
        $model_vr_order = Model('vr_order');
        $vr_code_info = $model_vr_order->getOrderCodeInfo(array('vr_code' => $_POST['vr_code']));
        if (empty($vr_code_info) || $vr_code_info['buyer_id'] != $this->member_info['member_id']) {
            return array('error' => '2', 'data' => '该兑换码不存在');
        }
        if ($vr_code_info['vr_state'] == '1') {
            return array('error' => '3', 'data' => '该兑换码已被使用');
        }
        if ($vr_code_info['vr_indate'] < TIMESTAMP) {
            return array('error' => '4', 'data' => '该兑换码已过期，使用截止日期为： ' . date('Y-m-d H:i:s', $vr_code_info['vr_indate']));
        }
        if ($vr_code_info['refund_lock'] > 0) {//退款锁定状态:0为正常,1为锁定(待审核),2为同意
            return array('error' => '5', 'data' => '该兑换码已申请退款，不能使用');
        }

        //更新兑换码状态
        $update = array();
        $update['vr_state'] = 1;
        $update['vr_usetime'] = TIMESTAMP;
        $update = $model_vr_order->editOrderCode($update, array('vr_code' => $_POST['vr_code']));

        //如果全部兑换完成，更新订单状态
        Logic('vr_order')->changeOrderStateSuccess($vr_code_info['order_id']);

        if ($update) { //表示兑换成功，整个订单流程完成
            //取得返回信息
            $order_info = $model_vr_order->getOrderInfo(array('order_id' => $vr_code_info['order_id']));
            if ($order_info['use_state'] == '0') { //更新使用状态
                $model_vr_order->editOrder(array('use_state' => 1), array('order_id' => $vr_code_info['order_id']));
            }

            //更新member_buy_service_num表中的提示信息
            update_member_buy_service_num($order_info);

            //todo 调用四大计算
            $order_info['goods_amount'] = $order_info['order_amount'];
            $order_info['order_type'] = 'vr_order';
            QueueClient::push('update_points_and_reward', $order_info);

            $order_info['img_60'] = thumb($order_info, 60);
            $order_info['img_240'] = thumb($order_info, 240);
            $order_info['goods_url'] = getUrl('shop/goods/index', array('goods_id' => $order_info['goods_id']));
            $order_info['order_url'] = getUrl('shop/store_vr_order/show_order', array('order_id' => $order_info['order_id']));
            return array('error' => 0, 'data' => $order_info);
        }
    }

    /**
     * 图片上传
     */
    public function pic_uploadAction()
    {
        if (chksubmit()) {
            //上传图片
            $upload = new UploadFile();
            $upload->set('thumb_width', 500);
            $upload->set('thumb_height', 499);
            $upload->set('thumb_ext', '_small');
            $upload->set('max_size', getConfig('image_max_filesize') ? getConfig('image_max_filesize') : 1024);
            $upload->set('ifremove', true);
            $upload->set('default_dir', $_GET['uploadpath']);

            if (!empty($_FILES['_pic']['tmp_name'])) {
                $result = $upload->upfile('_pic');
                if ($result) {
                    exit(json_encode(array('status' => 1, 'url' => UPLOAD_SITE_URL . '/' . $_GET['uploadpath'] . '/' . $upload->thumb_image)));
                } else {
                    exit(json_encode(array('status' => 0, 'msg' => $upload->error)));
                }
            }
        }

        $this->view->disable();
    }

    /**
     * 发起投诉
     */
    public function add_vr_tousuAction()
    {
        $model_vr_refund = Model('vr_refund');
        $order_id = intval($_POST['order_id']); //订单id
        $buyer_id = $this->member_info['member_id']; //投诉人id
        $content = $_POST['tousu']; //获取投诉内容
        $vr_order = VrOrder::findFirst("order_id=" . $order_id . " and order_state=20");
        if ($vr_order === false) { //要投诉的订单不存在或状态错误
            @header("location:/h5_web/js_template/member/vr_order_tousu.html?resdata=noorder");
            exit;
        }
        $vr_order_code = VrOrderCode::findFirst("order_id=" . $order_id . " and vr_state=0");
        if ($vr_order_code === false) { //虚拟订单没有有效的兑换码
            @header("location:/h5_web/js_template/member/vr_order_tousu.html?resdata=nocode");
            exit;
        }

        $goods_num = 1; //兑换码数量
        $refund_amount = $vr_order->getOrderAmount();//退款金额
        $code_sn = $vr_order_code->getVrCode(); //兑换码

        $refund_array['code_sn'] = $code_sn;
        $refund_array['admin_state'] = '1';//状态:1为待审核,2为同意,3为不同意
        $refund_array['refund_amount'] = ncPriceFormat($refund_amount);
        $refund_array['goods_num'] = $goods_num;
        $refund_array['buyer_message'] = $content; //投诉理由
        $refund_array['add_time'] = time();
        $refund_array['order_id'] = $order_id;

        $state = $model_vr_refund->addRefund($refund_array, $vr_order->toArray());
        if ($state) {
            //修改虚拟订单状态
            $vr_order_model = VrOrder::findFirst("order_id=" . $order_id);
            if ($vr_order_model !== false) {
                $vr_order_model->setOrderState(ORDER_REFUND_LOCK); //设置为退款锁定状态
                $vr_order_model->save();
            }

            @header("location:/h5_web/js_template/member/vr_order_tousu.html?resdata=ok");
        } else {
            @header("location:/h5_web/js_template/member/vr_order_tousu.html?resdata=err");
        }
        exit;
    }

    /**
     * 添加退款说明，发起退款
     */
    public function add_vr_refundAction()
    {
        $model_vr_refund = Model('vr_refund');
        $order_id = intval($_POST['order_id']); //订单id
        $condition = array();
        $condition['buyer_id'] = $this->member_info['member_id'];
        $condition['order_id'] = $order_id;
        $order = $model_vr_refund->getRightOrderList($condition); //此函数内部已经获取到了虚拟兑换码列表$order['code_list']

        //判断发起退款的时间是否小于服务规定的退款时间段
        $goods_id = $order['goods_id'];
        if (empty($goods_id)) {
            @header("location:/h5_web/js_template/member/vr_order_refund.html?resdata=noorder");
            exit;
        }
        $goods_info = Goods::findFirst("goods_id=" . $goods_id);
        if ($goods_info === false) {
            @header("location:/h5_web/js_template/member/vr_order_refund.html?resdata=noorder");
            exit;
        }
        if (empty($goods_info->getDoctorServiceStartTime())) {
            @header("location:/h5_web/js_template/member/vr_order_refund.html?resdata=no_begin_time");
            exit;
        }
        if (($goods_info->getDoctorServiceStartTime() - time()) <= getConfig('service_refund_time_long') * 60) {
            @header("location:/h5_web/js_template/member/vr_order_refund.html?resdata=forbidden");
            exit;
        }

        $code_list = $order['code_list'];
        $refund_array = array();
        $goods_num = 0;//兑换码数量
        $refund_amount = 0;//退款金额
        $code_sn = '';
        $rec_id_array = $_POST['rec_id'];
        if (!empty($rec_id_array) && is_array($rec_id_array)) {//选择退款的兑换码
            foreach ($rec_id_array as $key => $value) {
                $code = $code_list[$value];
                if (!empty($code)) {
                    $goods_num += 1;
                    $refund_amount += $code['pay_price'];//实际支付金额
                    $code_sn .= $code['vr_code'] . ',';//兑换码编号
                }
            }
        }
        $refund_array['code_sn'] = rtrim($code_sn, ',');
        $refund_array['admin_state'] = '1';//状态:1为待审核,2为同意,3为不同意
        $refund_array['refund_amount'] = ncPriceFormat($refund_amount);
        $refund_array['goods_num'] = $goods_num;
        $refund_array['buyer_message'] = $_POST['buyer_message'];
        $refund_array['add_time'] = time();
        $state = $model_vr_refund->addRefund($refund_array, $order);
        if ($state) {
            //修改虚拟订单状态
            $vr_order_model = VrOrder::findFirst("order_id=" . $order_id);
            if ($vr_order_model !== false) {
                $vr_order_model->setOrderState(ORDER_REFUND_LOCK); //设置为退款锁定状态
                $vr_order_model->save();
            }

            @header("location:/h5_web/js_template/member/vr_order_refund.html?resdata=ok");
        } else {
            @header("location:/h5_web/js_template/member/vr_order_refund.html?resdata=err");
        }
        exit;
    }

    /**
     * 处理支付帐号
     */
    public function account_payAction()
    {
        $member_model = $this->member_info;
        if (!empty($_POST['type']) && $_POST['type'] == 'init') {
            $member_account_model = MemberExtend::findFirst("member_id=" . $member_model['member_id']);
            if ($member_account_model !== false) {
                $member_account_model = $member_account_model->toArray();
                output_data($member_account_model);
            } else {
                echo "";
            }
        } else {
            $member_extend_model = MemberExtend::findFirst("member_id=" . $member_model['member_id']);
            if ($member_extend_model !== false) {
                $member_extend_model->setAccountPay($_POST['account_pay']);
                $member_extend_model->setAccountWx($_POST['account_wx']);
                $member_extend_model->setAccountBank($_POST['account_bank']);
                $member_extend_model->setBankType($_POST['bank_type']);
                $member_extend_model->setBankClass($_POST['bank_class']);
                $member_extend_model->setBankName($_POST['bank_name']);
                $member_extend_model->setBankAddress($_POST['bank_address']);
                if ($member_extend_model->save() === false) {
                    @header("Location:/h5_web/js_template/member/account_pay.html?resdata=err");
                } else {
                    @header("Location:/h5_web/js_template/member/account_pay.html?resdata=ok");
                }
            } else {
                $member_extend_model = new MemberExtend();
                $insert_array = array(
                    'member_id' => $member_model['member_id'],
                    'account_pay' => $_POST['account_pay'],
                    'account_wx' => $_POST['account_wx'],
                    'account_bank' => $_POST['account_bank'],
                    'bank_type' => $_POST['bank_type'],
                    'bank_class' => $_POST['bank_class'],
                    'bank_name' => $_POST['bank_name'],
                    'bank_address' => $_POST['bank_address']
                );
                if ($member_extend_model->save($insert_array) === false) {
                    @header("Location:/h5_web/js_template/member/account_pay.html?resdata=err");
                } else {
                    @header("Location:/h5_web/js_template/member/account_pay.html?resdata=ok");
                }
            }
        }
        exit;
    }

    /**
     * 上传病历
     */
    public function upload_case_historyAction()
    {
        $member_model = $this->member_info;
        $arr = array(
            'member_id' => $member_model['member_id'],
            'store_id' => $_POST['store_id'],
            'case_content' => $_POST['g_body'],
            'is_public' => $_POST['privacy'],
            'order_id' => $_POST['order_id'],
            'title' => empty($_POST['title']) ? "匿名" : $_POST['title'],
            'add_time' => time()
        );
        $model = CaseHistory::findFirst("member_id=" . $member_model['member_id'] . " and order_id=" . $_POST['order_id']);
        if ($model === false) {
            $model = new CaseHistory();
        }
        if ($model->save($arr) === false) {
            Log::record($member_model['member_id'] . "上传病历失败，数据是：" . json_encode($arr));
            @header("location:/h5_web/js_template/member/upload_case_history.html?res_msg=err");
        }
        @header("location:/h5_web/js_template/member/upload_case_history.html?res_msg=ok");
    }

    /**
     * 获取每月奖金记录
     */
    public function month_rewardAction()
    {
        $member_model = $this->member_info;

        $query = Member::query();
        //人被封号就不发放奖金了
        $query->where('member_state = :member_state:', array('member_state' => 1));
        $query->andWhere('(member_straight_money_sum > 0 OR member_collision_sum_money > 0 OR member_commission_money_sum > 0 OR store_share_benefits_money_sum > 0 OR store_straight_money_sum > 0 OR store_collision_sum_money > 0 OR store_commission_money_sum > 0)');
        $query->andWhere('member_id=' . $member_model['member_id']);
        $model_member = new Member();
        $metadata = $model_member->getModelsMetaData();
        $param = $metadata->getAttributes($model_member);
        //获取当前的日期是不是15到20号，只有15到20号才显示发放奖金按钮，因为只有每月15到20号才能发放奖金
        $can_giveout_reward = false;
        $day = intval(date('d'));
        if ($day >= 15 && $day <= 20) {
            $can_giveout_reward = true;
        }

        $value = $query->execute();
        if (count($value->toArray()) > 0) {
            $value = $value->toArray();
        } else {
            $value = array();
        }

        //上个月15号
        $start_time = strtotime(date('Y-m-15 00:00:00') . ' -1 month');
        //这个月14号
        $end_time = strtotime(date('Y-m-14 23:59:59'));


        //该会员也可能其他月的奖金没有发放完
        $total = $value['member_straight_money_sum'] + $value['member_collision_sum_money'] + $value['member_commission_money_sum'] + $value['store_share_benefits_money_sum'] + $value['store_straight_money_sum'] + $value['store_collision_sum_money'] + $value['store_commission_money_sum'];
        //客户树直荐奖（元）
        $query_member_straight_log = MemberStraightLog::query();
        $query_member_straight_log->columns(array('SUM(member_straight_money) as sum_money'));
        $query_member_straight_log->where('member_tree_type = 0');
        $query_member_straight_log->andWhere('member_id = ' . $member_model['member_id']);
        $query_member_straight_log->betweenWhere('add_time', $start_time, $end_time);
        $member_straight_log = $query_member_straight_log->execute()->toArray();
        $param['member_straight_money_sum_log'] = ncPriceFormat($member_straight_log[0]['sum_money']);
        //客户树积分碰撞奖（元）
        $query_member_points_collision_log = MemberPointsCollisionLog::query();
        $query_member_points_collision_log->columns(array('SUM(member_collision_money) as sum_money'));
        $query_member_points_collision_log->where('collision_log_type = 0');
        $query_member_points_collision_log->andWhere('member_id = ' . $member_model['member_id']);
        $query_member_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
        $member_points_collision_log = $query_member_points_collision_log->execute()->toArray();
        $param['member_collision_sum_money_log'] = ncPriceFormat($member_points_collision_log[0]['sum_money']);
        //客户树分佣奖（元）
        $query_member_commission_log = MemberCommissionLog::query();
        $query_member_commission_log->columns(array('SUM(member_tree_commission_money) as sum_money'));
        $query_member_commission_log->where('commission_tree_type = 0');
        $query_member_commission_log->andWhere('member_id = ' . $member_model['member_id']);
        $query_member_commission_log->betweenWhere('add_time', $start_time, $end_time);
        $member_commission_log = $query_member_commission_log->execute()->toArray();
        $param['member_commission_money_sum_log'] = ncPriceFormat($member_commission_log[0]['sum_money']);
        //医护人员树分利所得（元）
        $query_store_share_benefits_log = MemberShareBenefitsLog::query();
        $query_store_share_benefits_log->columns(array('SUM(share_benefits_money) as sum_money'));
        $query_store_share_benefits_log->where('member_id = ' . $member_model['member_id']);
        $query_store_share_benefits_log->betweenWhere('add_time', $start_time, $end_time);
        $store_share_benefits_log = $query_store_share_benefits_log->execute()->toArray();
        $param['store_share_benefits_money_sum_log'] = ncPriceFormat($store_share_benefits_log[0]['sum_money']);
        //医护人员树直荐奖（元）
        $query_store_straight_log = MemberStraightLog::query();
        $query_store_straight_log->columns(array('SUM(store_straight_money) as sum_money'));
        $query_store_straight_log->where('member_tree_type = 1');
        $query_store_straight_log->andWhere('member_id = ' . $member_model['member_id']);
        $query_store_straight_log->betweenWhere('add_time', $start_time, $end_time);
        $store_straight_log = $query_store_straight_log->execute()->toArray();
        $param['store_straight_money_sum_log'] = ncPriceFormat($store_straight_log[0]['sum_money']);
        //医护人员树积分碰撞奖（元）
        $query_store_points_collision_log = MemberPointsCollisionLog::query();
        $query_store_points_collision_log->columns(array('SUM(store_collision_money) as sum_money'));
        $query_store_points_collision_log->where('collision_log_type = 1');
        $query_store_points_collision_log->andWhere('member_id = ' . $member_model['member_id']);
        $query_store_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
        $store_points_collision_log = $query_store_points_collision_log->execute()->toArray();
        $param['store_collision_sum_money_log'] = ncPriceFormat($store_points_collision_log[0]['sum_money']);
        //医护人员树分佣奖（元）
        $query_store_commission_log = MemberCommissionLog::query();
        $query_store_commission_log->columns(array('SUM(store_tree_commission_money) as sum_money'));
        $query_store_commission_log->where('commission_tree_type = 1');
        $query_store_commission_log->andWhere('member_id = ' . $member_model['member_id']);
        $query_store_commission_log->betweenWhere('add_time', $start_time, $end_time);
        $store_commission_log = $query_store_commission_log->execute()->toArray();
        $param['store_commission_money_sum_log'] = ncPriceFormat($store_commission_log[0]['sum_money']);

        //总计（元）
        $param['month_total_log'] = ncPriceFormat($member_straight_log[0]['sum_money'] + $member_points_collision_log[0]['sum_money'] + $member_commission_log[0]['sum_money'] + $store_share_benefits_log[0]['sum_money'] + $store_straight_log[0]['sum_money'] + $store_points_collision_log[0]['sum_money'] + $store_commission_log[0]['sum_money']);
        $param['total'] = ncPriceFormat($total);

        //用户类型
        $param['member_type_id'] = $member_model['member_type_id'];
        output_data(array(), $param);
    }
}
