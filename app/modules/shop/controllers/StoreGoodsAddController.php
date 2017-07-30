<?php
/**
 * 医生商品管理
 * User: Administrator
 * Date: 2016/12/4
 * Time: 0:00
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\CacheRedis;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\GoodsClassStapleLogic;
use Ypk\Logic\GoodsLogic;
use Ypk\Model;
use Ypk\Models\Goods;
use Ypk\Models\GoodsClass;
use Ypk\Models\GoodsCommon;
use Ypk\Models\Member;
use Ypk\Models\MemberBuyServiceNum;
use Ypk\Models\Spec;
use Ypk\Models\SpecValue;
use Ypk\Models\Store;
use Ypk\Models\StoreJoinin;
use Ypk\Tpl;
use Ypk\MyModels;
use Ypk\UploadFile;

class StoreGoodsAddController extends BaseSellerController
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('member_store_goods_index');
        $this->view->setVar('lang', $this->translation);
        $storeinfo = Store::findFirst("member_id=" . getSession('member_id'));
        if ($storeinfo) {
            $this->store_info = $storeinfo->toArray();
        }
    }

    /**
     * 三方医生验证，商品数量，有效期
     */
    private function checkStore()
    {
        $goodsLimit = (int)$this->store_grade['sg_goods_limit'];

        if ($goodsLimit > 0) {
            // 是否到达商品数上限
            $goods_num = Model('goods')->getGoodsCommonCount(array('store_id' => getSession('store_id')));
            if ($goods_num >= $goodsLimit) {
                $this->showMessage($this->translation->_('store_goods_index_goods_limit') . $goodsLimit . $this->translation->_('store_goods_index_goods_limit1'), getUrl('shop/store_goods_online/goods_list'), 'html', 'error');
            }
        }
    }

    /**
     * 发布服务的第1步
     */
    public function serviceAddAction()
    {
        //获取所有的服务类型
        $goods_class_list = GoodsClass::find("gc_parent_id=1073");
        $goods_class_list_str = "";
        if (count($goods_class_list) > 0) {
            $goods_class_list = $goods_class_list->toArray();
            foreach ($goods_class_list as $good_class) {
                $goods_class_list_str .= "<option value='" . $good_class['gc_name'] . "' data-id='" . $good_class['gc_id'] . "' data-pointrate='" . $good_class['buy_points_rate'] . "'>" . $good_class['gc_name'] . "</option>";
            }
        }
        Tpl::output('goods_class_list_str', $goods_class_list_str);

        if (!empty($_REQUEST['type']) && $_REQUEST['type'] == "edit") { //表示是编辑服务
            $goods_commonid = $_REQUEST['commonid'];
            $model_goods = Model('goods');
            //获取商品对象
            $goodscommon_info = $model_goods->getGoodsCommonInfoByID($goods_commonid);
            if (empty($goodscommon_info) || $goodscommon_info['store_id'] != getSession('store_id') || $goodscommon_info['goods_lock'] == 1) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_info = Goods::findFirst("goods_commonid=" . $goods_commonid);
            if (empty($goods_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_info = $goods_info->toArray();

            if ($goods_info['mobile_body'] != '') {
                $goods_info['mb_body'] = unserialize($goods_info['mobile_body']);
                $tempStr = ltrim($goods_info['mb_body'], "[{");
                $tempStr = rtrim($tempStr, "}]");
                $temparr = explode(',', $tempStr);
                $arr = array();
                foreach ($temparr as $item) {
                    $temparr2 = explode(':', $item);
                    $arr[$temparr2[0]] = $temparr2[1];
                }

//                if (is_array($goods_info['mb_body'])) {
//                    $mobile_body = '[';
//                    foreach ($goods_info['mb_body'] as $val) {
//                        $mobile_body .= '{"type":"' . $val['type'] . '","value":"' . $val['value'] . '"},';
//                    }
//                    $mobile_body = rtrim($mobile_body, ',') . ']';
//                }
//                $goods_info['mobile_body'] = $mobile_body;
                //$goods_info['mobile_body'] = $arr;
            }

            Tpl::output('opType', 'edit'); //标识是修改操作
            Tpl::output('goods_info', $goods_info);
        }

        //获取医院地点和科室地点
        $store_join_model = Model('store_joinin');
        $store_join_info = $store_join_model->getOne('member_id=' . getSession('member_id'));
        if (!empty($store_join_info)) {
            if (!empty($store_join_info['company_address_detail'])) {
                $address_tem = explode(',', $store_join_info['company_address_detail']);
                if (!empty($address_tem)) {
                    if (!empty($address_tem[0])) {
                        $goods_info['hispital_address'] = $address_tem[0];
                    }
                    if (!empty($address_tem[1])) {
                        $goods_info['depart_address'] = $address_tem[1];
                    }
                }
            }
        }
        Tpl::output('goods_info', $goods_info);
        $this->view->render('seller_center', 'store_service_add');
        $this->view->disable();
    }
    /**
     * ajax判断二级分类
     */
    public function load_service_category2Action(){

        $str = "";
        $goods_class_list = GoodsClass::find();
        if (count($goods_class_list) > 0) {
            $goods_class_list = $goods_class_list->toArray();
            foreach ($goods_class_list as $good_class) {
                if($good_class['gc_name'] == $_POST['g_name']){
                    $gc_id = $good_class['gc_id'];break;
                }
            }
            $i =0;
            foreach ($goods_class_list as $good_class1){
                if($gc_id == $good_class1['gc_parent_id']){
                    $i++;
                    if($i==1){
                        $str .= "<option selected = 'selected' value='". $good_class1['gc_name']."' data-id='" . $good_class1['gc_id'] . "' data-pointrate='" . $good_class1['buy_points_rate'] . "'>" . $good_class1['gc_name'] . "</option>";
                        $i++;
                    }else{
                        $str .= "<option value='" . $good_class1['gc_name'] . "' data-id='" . $good_class1['gc_id'] . "' data-pointrate='" . $good_class1['buy_points_rate'] . "'>" . $good_class1['gc_name'] . "</option>";
                    }
//              $str .= "<option selected = 'selected' value='". $good_class1['commis_rate']."' data-id='" . $good_class1['gc_id'] . "' data-pointrate='" . $good_class1['buy_points_rate'] . "'>" . $good_class1['gc_name'] . "</option>";
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * 保存服务（走实物流程）
     */
    public function saveServiceAction()
    {
        if (!empty($_REQUEST['opType']) && $_REQUEST['opType'] == 'edit') {  //表示编辑信息
            $goods_id = $_REQUEST['goods_id']; //服务id
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if (empty($goods_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_commonid = $goods_info->getGoodsCommonid();
            $goods_common_info = GoodsCommon::findFirst("goods_commonid=" . $goods_commonid);
            if (empty($goods_common_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $buy_points_rate = $_POST['buy_points_rate']; //服务赠送积分比例
            $goods_update_array = array(
                'gc_id_1' => 1073,
                'gc_id_2' => $_POST['gc_id'],
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'doctor_private_price' => $_POST['private_price'],
                'goods_price' => $_POST['system_price'], //价格
                'goods_promotion_price' => $_POST['system_price'], //促销价格
                'goods_storage' => $_POST['goods_storage'],
                'goods_points' => floor($_POST['system_price'] * $buy_points_rate),
                'goods_verify' => 10,
                'doctor_service_start_time' => strtotime($_POST['sart_time']),
                'doctor_service_end_time' => strtotime($_POST['end_time']),
                'hispital_address' => $_POST['hispital_address'], //医院地点
                'depart_address' => $_POST['depart_address'] //科室地点
            );
            if (!empty($_FILES['image_path'])) {//上传服务主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $goods_update_array['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS . '/' . getSession('store_id'));
                $upload->upfile('image_path');
                $goods_update_array['goods_image'] = $upload->file_name;
            }
            if (!empty($_POST['g_body'])) {
                $goods_update_array['goods_body'] = $_POST['g_body']; //服务详情描述
            }
            if (!empty($_POST['m_body'])) {
                $goods_update_array['mobile_body'] = serialize($_POST['m_body']); //服务详情描述
            }
            $old_start_time = $goods_info->getDoctorServiceStartTime(); //该服务原先的开始时间
            $old_end_time = $goods_info->getDoctorServiceEndTime(); //该服务原先的结束时间

            $res = $goods_info->save($goods_update_array);

            //----------------------------------------------------修改goods_common------------------------------------------

            $goods_common_update_array = array(
                'gc_id_1' => 1073,
                'gc_id_2' => $_POST['gc_id'],
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['system_price'],
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
            if ($res == true) {
                showMessage('修改成功', '', 'html', 'succ');
            } else {
                showMessage('修改失败', '', 'html', 'error');
            }

            //更新医院地址和科室地址
            $store_join_model = Model('store_joinin');
            if (!empty($store_join_model)) {
                $address_str = $_POST['hispital_address'] . "," . $_POST['depart_address'];
                $store_join_model->modify(array('company_address_detail' => $address_str), array('member_id' => getSession("member_id")));
            }

            //如果修改的是服务，且服务时间发生变化，则重新生成服务编号
            if ($goods_info->getGcId1() == 1073) {
                $new_start_time = strtotime($_POST['sart_time']); //修改后的开始时间
                $new_end_time = strtotime($_POST['end_time']); //修改后的结束时间
                if ($new_start_time != $old_start_time || $new_end_time != $old_end_time) {
                    for ($i = 1; $i <= $goods_info->getGoodsStorage(); $i++) {
                        $member_buy_service_num_data['goods_id'] = $goods_info->getGoodsId();
                        $member_buy_service_num_data['start_time'] = $goods_info->getDoctorServiceStartTime();
                        $member_buy_service_num_data['end_time'] = $goods_info->getDoctorServiceEndTime();
                        $member_buy_service_num_data['buyer_number'] = $i;
                        $member_buy_service_num_data['doctor_id'] = getSession('member_id');
                        $member_buy_service_num_data['is_use'] = 0;
                        $member_buy_service_num = new MemberBuyServiceNum();
                        $member_buy_service_num->save($member_buy_service_num_data);
                    }
                }
            }
        } else {  //表示新增服务
            $insertArray = array();
            $insertArray['gc_id'] = $_POST['gc_id']; //服务二级类型id
            $insertArray['gc_id_1'] = 1073; //服务类型id
            $insertArray['gc_id_2'] = $_POST['gc_id']; //服务二级类型id
            $insertArray['gc_id_3'] = 0;
            $buy_points_rate = $_POST['buy_points_rate']; //服务赠送积分比例
            $insertArray['goods_name'] = $_POST['g_name']; //服务名称
            $insertArray['goods_jingle'] = $_POST['g_jingle']; //服务卖点
            $insertArray['doctor_private_price'] = $_POST['private_price']; //医生发布的服务的私有价格
            $insertArray['goods_price'] = $_POST['system_price']; //医生发布的服务的平台价格
            $insertArray['goods_promotion_price'] = $_POST['system_price']; //促销价
            $insertArray['goods_marketprice'] = $_POST['system_price']; //市场价
            $insertArray['goods_points'] = floor($_POST['system_price'] * $buy_points_rate); //购买该服务或商品时，购买者可以得到的积分数量
            $insertArray['goods_storage'] = intval($_POST['goods_storage']); //服务发布的数量
            $insertArray['doctor_service_start_time'] = strtotime($_POST['sart_time']);  //开始时间
            $insertArray['doctor_service_end_time'] = strtotime($_POST['end_time']); //结束时间
            $insertArray['hispital_address'] = $_POST['hispital_address']; //医院地点
            $insertArray['depart_address'] = $_POST['depart_address']; //科室地点
            if (!empty($_FILES['image_path'])) {//上传服务主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $insertArray['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS);
                $upload->upfile('image_path');
                $insertArray['goods_image'] = $upload->file_name;
            }
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body']; //服务详情描述
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']); //服务详情描述

            //===================================================================================================================================================
            //先往goods_common中保存数据
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
            $goodsCommonArray['store_id'] = $this->store_info['store_id'];
            $goodsCommonArray['store_name'] = $this->store_info['store_name'];
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
            $goodsCommonArray['doctor_id'] = getSession('member_id');

            $res_common = $goods_common_model->save($goodsCommonArray);

            $insertArray['goods_commonid'] = $goods_common_model->getGoodsCommonid();
            $insertArray['store_id'] = $this->store_info['store_id'];
            $insertArray['store_name'] = $this->store_info['store_name'];
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
            $insertArray['virtual_indate'] = time();
            $insertArray['virtual_limit'] = 0;
            $insertArray['doctor_id'] = getSession('member_id');
            $model = new Goods();
            $res = $model->save($insertArray);
            if (!$res) {
                $this->showMessage('服务保存失败', getUrl('shop/seller_center'), 'html', 'error');
            }

            //更新医院地址和科室地址
            $store_join_model = Model('store_joinin');
            if (!empty($store_join_model)) {
                $address_str = $_POST['hispital_address'] . "," . $_POST['depart_address'];
                $store_join_model->modify(array('company_address_detail' => $address_str), array('member_id' => getSession("member_id")));
            }

            //如果发布的商品是服务，生成相应服务编号
            if ($model->getGcId1() == 1073) {
                for ($i = 1; $i <= $model->getGoodsStorage(); $i++) {
                    $member_buy_service_num_data['goods_id'] = $model->getGoodsId();
                    $member_buy_service_num_data['start_time'] = $model->getDoctorServiceStartTime();
                    $member_buy_service_num_data['end_time'] = $model->getDoctorServiceEndTime();
                    $member_buy_service_num_data['buyer_number'] = $i;
                    $member_buy_service_num_data['doctor_id'] = getSession('member_id');
                    $member_buy_service_num_data['is_use'] = 0;
                    $member_buy_service_num = new MemberBuyServiceNum();
                    $member_buy_service_num->save($member_buy_service_num_data);
                }
            }
            redirect(getUrl('shop/store_goods_add/add_step_four', array('commonid' => $insertArray['goods_commonid'])));
        }
    }

    /**
     * 保存服务（走虚拟流程）
     */
    public function saveVrServiceAction()
    {
        if (!empty($_REQUEST['opType']) && $_REQUEST['opType'] == 'edit') {  //表示编辑信息
            $goods_id = $_REQUEST['goods_id']; //服务id
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if (empty($goods_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_commonid = $goods_info->getGoodsCommonid();
            $goods_common_info = GoodsCommon::findFirst("goods_commonid=" . $goods_commonid);
            if (empty($goods_common_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $buy_points_rate = $_POST['buy_points_rate']; //服务赠送积分比例
            $goods_update_array = array(
                'gc_id_1' => 1073,
                'gc_id_2' => $_POST['gc_id'],
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'doctor_private_price' => $_POST['private_price'], //私有价格
                'goods_price' => $_POST['system_price'], //平台价格
                'goods_promotion_price' => $_POST['system_price'], //促销价格
                'goods_storage' => $_POST['goods_storage'],
                'goods_points' => floor($_POST['system_price'] * $buy_points_rate), //计算服务积分
                'goods_verify' => 10,
                'doctor_service_start_time' => strtotime($_POST['sart_time']),
                'doctor_service_end_time' => strtotime($_POST['end_time']),
                'virtual_indate' => strtotime($_POST['end_time']), //失效时间
                'hispital_address' => $_POST['hispital_address'],
				'hispital_zuozhen'=>$_POST['hispital_zuozhen'], //坐诊医院
                'depart_address' => $_POST['depart_address']
            );
            if (!empty($_FILES['image_path']['name'])) {//上传服务主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $goods_update_array['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS . DS . getSession('store_id') . DS . $upload->getSysSetPath());
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('fprefix', getSession('store_id'));
                $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
                $upload->upfile('image_path');
                $goods_update_array['goods_image'] = $upload->getSysSetPath() . $upload->file_name;
            }
            if (!empty($_POST['g_body'])) {
                $goods_update_array['goods_body'] = $_POST['g_body']; //服务详情描述
            }
            if (!empty($_POST['m_body'])) {
                $goods_update_array['mobile_body'] = serialize($_POST['m_body']); //服务详情描述
            }
            $old_start_time = $goods_info->getDoctorServiceStartTime(); //该服务原先的开始时间
            $old_end_time = $goods_info->getDoctorServiceEndTime(); //该服务原先的结束时间

            $res = $goods_info->save($goods_update_array);

            //----------------------------------------------------修改goods_common------------------------------------------

            $goods_common_update_array = array(
                'gc_id_1' => 1073,
                'gc_id_2' => $_POST['gc_id'],
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['system_price'],
                'goods_image' => $goods_info->getGoodsImage(),
                'virtual_indate' => strtotime($_POST['end_time']), //失效时间
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
            if ($res == true) {
                //更新医院地址和科室地址
                $store_join_model = Model('store_joinin');
                if (!empty($store_join_model)) {
                    $address_str = $_POST['hispital_address'] . "," . $_POST['depart_address'];
                    $store_join_model->modify(array('company_address_detail' => $address_str), array('member_id' => getSession("member_id")));
                }

                //如果修改的是服务，且服务时间发生变化，则重新生成服务编号
                if ($goods_info->getGcId1() == 1073) {
                    $new_start_time = strtotime($_POST['sart_time']); //修改后的开始时间
                    $new_end_time = strtotime($_POST['end_time']); //修改后的结束时间
                    if ($new_start_time != $old_start_time || $new_end_time != $old_end_time) {
                        for ($i = 1; $i <= $goods_info->getGoodsStorage(); $i++) {
                            $member_buy_service_num_data['goods_id'] = $goods_info->getGoodsId();
                            $member_buy_service_num_data['start_time'] = $goods_info->getDoctorServiceStartTime();
                            $member_buy_service_num_data['end_time'] = $goods_info->getDoctorServiceEndTime();
                            $member_buy_service_num_data['buyer_number'] = $i;
                            $member_buy_service_num_data['doctor_id'] = getSession('member_id');
                            $member_buy_service_num_data['is_use'] = 0;
                            $member_buy_service_num = new MemberBuyServiceNum();
                            $member_buy_service_num->save($member_buy_service_num_data);
                        }
                    }
                }
                showMessage('修改成功，请等待管理员审核', '', 'html', 'succ');
            } else {
                showMessage('修改失败', '', 'html', 'error');
            }
        }
        else {  //表示新增服务
            $insertArray = array();
            $insertArray['gc_id'] = $_POST['gc_id']; //服务二级类型id
            $insertArray['gc_id_1'] = 1073; //服务类型id
            $insertArray['gc_id_2'] = $_POST['gc_id']; //服务二级类型id
            $insertArray['gc_id_3'] = 0;
            $buy_points_rate = $_POST['buy_points_rate']; //服务赠送积分比例
            $insertArray['goods_name'] = $_POST['g_name']; //服务名称
            $insertArray['goods_jingle'] = $_POST['g_jingle']; //服务卖点
            $insertArray['doctor_private_price'] = $_POST['private_price']; //医生发布的服务的私有价格
            $insertArray['goods_price'] = $_POST['system_price']; //医生发布的服务的平台价格
            $insertArray['goods_promotion_price'] = $_POST['system_price']; //促销价格
            $insertArray['goods_marketprice'] = $_POST['system_price']; //市场价格
            $insertArray['goods_points'] = floor($_POST['system_price'] * $buy_points_rate); //购买该服务或商品时，购买者可以得到的积分数量
            $insertArray['goods_storage'] = intval($_POST['goods_storage']); //服务发布的数量
            $insertArray['doctor_service_start_time'] = strtotime($_POST['sart_time']);  //开始时间
            $insertArray['doctor_service_end_time'] = strtotime($_POST['end_time']); //结束时间
            $insertArray['is_virtual'] = 1; //属于虚拟产品
            $insertArray['virtual_indate'] = strtotime($_POST['end_time']); //服务失效时间
            $insertArray['virtual_limit'] = 1; //每人每次限购1个
            $insertArray['virtual_invalid_refund'] = 0; //是否允许过期退款
            $insertArray['hispital_address'] = $_POST['hispital_address']; //医院地点
			$insertArray['hispital_zuozhen']=$_POST['hispital_zuozhen']; //坐诊医院
            $insertArray['depart_address'] = $_POST['depart_address']; //科室地点
            if (!empty($_FILES['image_path'])) {//上传服务主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $insertArray['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS . DS . getSession('store_id') . DS . $upload->getSysSetPath());
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('fprefix', getSession('store_id'));
                $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
                $upload->upfile('image_path');
                $insertArray['goods_image'] = $upload->getSysSetPath() . $upload->file_name;
            }
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body']; //服务详情描述
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']); //服务详情描述

            //===================================================================================================================================================
            //先往goods_common中保存数据
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
            $goodsCommonArray['store_id'] = $this->store_info['store_id'];
            $goodsCommonArray['store_name'] = $this->store_info['store_name'];
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
            $goodsCommonArray['doctor_id'] = getSession('member_id');
            $goodsCommonArray['is_virtual'] = 1; //属于虚拟产品
            $goodsCommonArray['virtual_indate'] = strtotime($_POST['end_time']); //服务失效时间
            $goodsCommonArray['virtual_limit'] = 1; //每人每次限购1个
            $goodsCommonArray['virtual_invalid_refund'] = 0; //是否允许过期退款

            $res_common = $goods_common_model->save($goodsCommonArray);

            $insertArray['goods_commonid'] = $goods_common_model->getGoodsCommonid();
            $insertArray['store_id'] = $this->store_info['store_id'];
            $insertArray['store_name'] = $this->store_info['store_name'];
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
            $insertArray['doctor_id'] = getSession('member_id');
            $model = new Goods();
            $res = $model->save($insertArray);
            if ($res===false) {
                $this->showMessage('服务保存失败', getUrl('shop/seller_center'), 'html', 'error');
            }

            //更新医院地址和科室地址
            $store_join_model = Model('store_joinin');
            if (!empty($store_join_model)) {
                $address_str = $_POST['hispital_address'] . "," . $_POST['depart_address'];
                $store_join_model->modify(array('company_address_detail' => $address_str), array('member_id' => getSession("member_id")));
            }

            //如果发布的商品是服务，生成相应服务编号
            if ($model->getGcId1() == 1073) {
                for ($i = 1; $i <= $model->getGoodsStorage(); $i++) {
                    $member_buy_service_num_data['goods_id'] = $model->getGoodsId();
                    $member_buy_service_num_data['start_time'] = $model->getDoctorServiceStartTime();
                    $member_buy_service_num_data['end_time'] = $model->getDoctorServiceEndTime();
                    $member_buy_service_num_data['buyer_number'] = $i;
                    $member_buy_service_num_data['doctor_id'] = getSession('member_id');
                    $member_buy_service_num_data['is_use'] = 0;
                    $member_buy_service_num_data['add_time'] = time();
                    $member_buy_service_num = new MemberBuyServiceNum();
                    $member_buy_service_num->save($member_buy_service_num_data);
                }
            }
            redirect(getUrl('shop/store_goods_add/add_step_four', array('commonid' => $insertArray['goods_commonid'])));
        }
    }

    public function indexAction()
    {
        if (intval(getSession('member_id')) == 1) { //表示是管理员发布商品
            $this->add_step_oneAction();
        } else { //表示是医生发布服务

            //判断资料是否已经完善
            $res = check_info_complete(getSession('member_id'));
            if ($res !== false) {
                $this->serviceAddAction();
            } else {
                showMessage("请先完善资料后再发布服务", getUrl('shop/compute_info/computeinfo'));
            }
        }
    }

    /**
     * 医务人员发布聊天卡
     */
    public function addChatCardAction()
    {
        //判断资料是否已经完善
        $res = check_info_complete(getSession('member_id'));
        if ($res !== false) {
            if (intval(getSession('member_id')) == 1) { //表示是管理员身份
                $this->showDialog("只有医务人员才能发布咨询卡", getUrl('shop/seller_center'));
            }
            //获取聊天卡的翻倍比例
            $goods_class = GoodsClass::findFirst("gc_id=1076");
            if ($goods_class !== false) {
                Tpl::output('commis_rate', $goods_class->getCommisRate());
            } else {
                Tpl::output('commis_rate', 0);
            }

            if (!empty($_REQUEST['type']) && $_REQUEST['type'] == "edit") { //表示是编辑聊天卡
                $goods_commonid = $_REQUEST['commonid'];
                $model_goods = Model('goods');
                //获取商品对象
                $goodscommon_info = $model_goods->getGoodsCommonInfoByID($goods_commonid);
                if (empty($goodscommon_info) || $goodscommon_info['store_id'] != getSession('store_id') || $goodscommon_info['goods_lock'] == 1) {
                    showMessage(getLang('wrong_argument'), '', 'html', 'error');
                }
                $goods_info = Goods::findFirst("goods_commonid=" . $goods_commonid);
                if (empty($goods_info)) {
                    showMessage('要修改的聊天卡不存在', '', 'html', 'error');
                }
                $goods_info = $goods_info->toArray();
                Tpl::output('opType', 'edit'); //标识是修改操作
                Tpl::output('goods_info', $goods_info);
                $this->view->render('seller_center', 'store_chatCard_add');
                $this->view->disable();
            } else {
                $this->view->render('seller_center', 'store_chatCard_add');
                $this->view->disable();
            }
        } else {
            showMessage("请先完善资料后再发布咨询卡", getUrl('shop/compute_info/computeinfo'));
        }
    }

    /**
     * 保存聊天卡（走实物流程）
     */
    public function saveChatCardAction()
    {
        if (!empty($_REQUEST['opType']) && $_REQUEST['opType'] == 'edit') {
            $goods_id = $_REQUEST['goods_id']; //服务id
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if (empty($goods_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_commonid = $goods_info->getGoodsCommonid();
            $goods_common_info = GoodsCommon::findFirst("goods_commonid=" . $goods_commonid);
            if (empty($goods_common_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_update_array = array(
                'gc_id_1' => 1076,
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['goods_price'], //价格
                'goods_promotion_price' => $_POST['goods_price'], //促销价格
                'goods_storage' => $_POST['goods_storage'], //库存数量
                'spec_name' => intval($_POST['goods_spec']) * 60,  //时长（单位：秒）
                'goods_verify' => 10,
                'goods_body' => empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'],
                'mobile_body' => empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body'])
            );
            $res = $goods_info->save($goods_update_array);

            //----------------------------------------------修改goods_common--------------------------------------------
            $goods_common_update_array = array(
                'gc_id_1' => 1076,
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['goods_price'], //价格
                'goods_body' => empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'],
                'mobile_body' => empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']),
                'goods_verify' => 10
            );
            $res = $goods_common_info->save($goods_common_update_array);
            if ($res == true) {
                showMessage('修改成功', '', 'html', 'succ');
            } else {
                showMessage('修改失败', '', 'html', 'error');
            }
        } else {  //表示新增聊天卡
            $insertArray = array();
            $insertArray['gc_id'] = 1076; //聊天卡类型id
            $insertArray['gc_id_1'] = 1076; //一级聊天卡类型id
            $insertArray['goods_name'] = $_POST['g_name']; //名称
            $insertArray['goods_jingle'] = $_POST['g_jingle']; //卖点
            $insertArray['goods_price'] = $_POST['goods_price']; //服务价格
            $insertArray['goods_promotion_price'] = $_POST['goods_price']; //促销价格
            $insertArray['goods_marketprice'] = $_POST['goods_price']; //市场价格
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body']; //电脑端详情描述
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']); //手机端详情描述

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
            $goodsCommonArray['store_id'] = $this->store_info['store_id'];
            $goodsCommonArray['store_name'] = $this->store_info['store_name'];
            $goodsCommonArray['spec_name'] = intval($_POST['goods_spec']) * 60;
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
            $goodsCommonArray['spec_value'] = (string)intval($_POST['goods_spec']) * 60; //聊天时长（单位：秒）
            $goodsCommonArray['doctor_id'] = getSession('member_id');

            $res_common = $goods_common_model->save($goodsCommonArray);

            $insertArray['goods_commonid'] = $goods_common_model->getGoodsCommonid();
            $insertArray['store_id'] = $this->store_info['store_id'];
            $insertArray['store_name'] = $this->store_info['store_name'];
            $insertArray['gc_id'] = 1076; //分类id
            $insertArray['gc_id_1'] = 1076;
            $insertArray['gc_id_2'] = 0;
            $insertArray['gc_id_3'] = 0;
            $insertArray['goods_storage_alarm'] = 0;
            $insertArray['spec_name'] = intval($_POST['goods_spec']) * 60; //聊天时长（单位：秒）
            $insertArray['goods_spec'] = '聊天卡';
            $insertArray['goods_storage'] = intval($_POST['goods_storage']); //数量
            $insertArray['goods_state'] = 1; //状态
            $insertArray['goods_verify'] = 10; //审核中
            $insertArray['goods_addtime'] = time();
            $insertArray['goods_edittime'] = time();
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'];
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']);
            $insertArray['areaid_1'] = 0;
            $insertArray['areaid_2'] = 0;
            $insertArray['color_id'] = 0;
            $insertArray['transport_id'] = 0;
            $insertArray['virtual_indate'] = time();
            $insertArray['virtual_limit'] = 0;
            $insertArray['doctor_id'] = getSession('member_id');

            $model = new Goods();
            $res = $model->save($insertArray);
            if (!$res) {
                $this->showMessage('聊天卡保存失败', getUrl('shop/seller_center'), 'html', 'error');
            }

            //如果发布的商品是服务，生成相应服务编号
            if ($model->getGcId1() == 1073) {
                for ($i = 1; $i <= $model->getGoodsStorage(); $i++) {
                    $member_buy_service_num_data['goods_id'] = $model->getGoodsId();
                    $member_buy_service_num_data['start_time'] = $model->getDoctorServiceStartTime();
                    $member_buy_service_num_data['end_time'] = $model->getDoctorServiceEndTime();
                    $member_buy_service_num_data['buyer_number'] = $i;
                    $member_buy_service_num_data['doctor_id'] = getSession('member_id');
                    $member_buy_service_num = new MemberBuyServiceNum();
                    $member_buy_service_num->save($member_buy_service_num_data);
                }
            }

            redirect(getUrl('shop/store_goods_add/add_step_four', array('commonid' => $insertArray['goods_commonid'])));
        }
    }

    /**
     * 保存聊天卡（走虚拟流程）
     */
    public function saveVrChatCardAction()
    {
        //获取聊天卡的获取积分翻倍比例
        $goods_class_model=GoodsClass::findFirst("gc_id=1076");
        if($goods_class_model!==false){
            $buy_points_rate=$goods_class_model->getBuyPointsRate();
        }else{
            $buy_points_rate=0;
        }

        if (!empty($_REQUEST['opType']) && $_REQUEST['opType'] == 'edit') { //表示编辑信息
            $goods_id = $_REQUEST['goods_id']; //服务id
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if (empty($goods_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_commonid = $goods_info->getGoodsCommonid();
            $goods_common_info = GoodsCommon::findFirst("goods_commonid=" . $goods_commonid);
            if (empty($goods_common_info)) {
                showMessage(getLang('wrong_argument'), '', 'html', 'error');
            }
            $goods_update_array = array(
                'gc_id_1' => 1076,
                'goods_name' => $_POST['g_name'],
                'goods_jingle' => $_POST['g_jingle'],
                'goods_price' => $_POST['goods_price'], //平台价格
                'goods_points'=>floor($_POST['goods_price']*$buy_points_rate), //计算聊天卡赠送的积分
                'doctor_private_price' => $_POST['private_price'], //私有价格
                'goods_promotion_price' => $_POST['goods_price'], //促销价格
                'goods_storage' => $_POST['goods_storage'], //库存数量
                //'spec_name' => (strtotime($_POST['end_time']) - strtotime($_POST['sart_time'])),  //时长（单位：秒）
                'spec_name' => intval($_POST['goods_spec']) * 60,  //时长（单位：秒）
                'goods_verify' => 10,
                'doctor_service_start_time' => strtotime($_POST['sart_time']),
                'doctor_service_end_time' => strtotime($_POST['end_time']),
                'virtual_indate' => strtotime($_POST['end_time']), //失效时间
                'goods_body' => empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'],
                'mobile_body' => empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body'])
            );
            if (!empty($_FILES['image_path']['name'])) {//上传服务主图
                $upload = new UploadFile();
                @unlink(UPLOAD_SITE_URL . '/' . ATTACH_GOODS . '/' . $goods_update_array['goods_image']);
                $upload->set('default_dir', ATTACH_GOODS . DS . getSession('store_id') . DS . $upload->getSysSetPath());
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('fprefix', getSession('store_id'));
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
                'mobile_body' => empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']),
                'virtual_indate' => strtotime($_POST['end_time']), //失效时间
                //'spec_name' => strtotime($_POST['end_time']) - strtotime($_POST['sart_time']),
                'spec_name' => intval($_POST['goods_spec']) * 60,
                'spec_value' => intval($_POST['goods_spec']) * 60,
                //'spec_value' => strtotime($_POST['end_time']) - strtotime($_POST['sart_time']),
                'goods_verify' => 10
            );
            $res = $goods_common_info->save($goods_common_update_array);
            if ($res == true) {
                showMessage('修改成功', '', 'html', 'succ');
            } else {
                showMessage('修改失败', '', 'html', 'error');
            }
        } else {  //表示新增聊天卡
            $insertArray = array();
            $insertArray['gc_id'] = 1076; //聊天卡类型id
            $insertArray['gc_id_1'] = 1076; //一级聊天卡类型id
            $insertArray['goods_name'] = $_POST['g_name']; //名称
            $insertArray['goods_jingle'] = $_POST['g_jingle']; //卖点
            $insertArray['doctor_private_price'] = $_POST['private_price']; //聊天卡私有价格
            $insertArray['goods_price'] = $_POST['goods_price']; //聊天卡价格
            $insertArray['goods_points'] = floor($_POST['goods_price'] * $buy_points_rate); //购买聊天卡时赠送的积分
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
                $upload->set('default_dir', ATTACH_GOODS . DS . getSession('store_id') . DS . $upload->getSysSetPath());
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('fprefix', getSession('store_id'));
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
            $goodsCommonArray['store_id'] = $this->store_info['store_id'];
            $goodsCommonArray['store_name'] = $this->store_info['store_name'];
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
            $goodsCommonArray['doctor_id'] = getSession('member_id');
            $goodsCommonArray['is_virtual'] = 1; //属于虚拟产品
            $goodsCommonArray['virtual_indate'] = strtotime($_POST['end_time']); //聊天卡失效时间
            $goodsCommonArray['virtual_limit'] = 1; //每人每次限购1个
            $goodsCommonArray['virtual_invalid_refund'] = 0; //是否允许过期退款

            $res_common = $goods_common_model->save($goodsCommonArray);

            $insertArray['goods_commonid'] = $goods_common_model->getGoodsCommonid();
            $insertArray['store_id'] = $this->store_info['store_id'];
            $insertArray['store_name'] = $this->store_info['store_name'];
            $insertArray['gc_id'] = 1076; //分类id
            $insertArray['gc_id_1'] = 1076;
            $insertArray['gc_id_2'] = 0;
            $insertArray['gc_id_3'] = 0;
            $insertArray['goods_storage_alarm'] = 0;
            //$insertArray['spec_name'] = strtotime($_POST['end_time']) - strtotime($_POST['sart_time']); //聊天时长（单位：秒）
            $insertArray['spec_name'] = intval($_POST['goods_spec']) * 60; //聊天时长（单位：秒）
            $insertArray['goods_spec'] = '聊天卡';
            $insertArray['goods_storage'] = intval($_POST['goods_storage']); //数量
            $insertArray['goods_state'] = 1; //状态
            $insertArray['goods_verify'] = 10; //审核中
            $insertArray['goods_addtime'] = time();
            $insertArray['goods_edittime'] = time();
            $insertArray['goods_body'] = empty($_POST['g_body']) ? "暂无内容" : $_POST['g_body'];
            $insertArray['mobile_body'] = empty($_POST['m_body']) ? "暂无内容" : serialize($_POST['m_body']);
            $insertArray['areaid_1'] = 0;
            $insertArray['areaid_2'] = 0;
            $insertArray['color_id'] = 0;
            $insertArray['transport_id'] = 0;
            $insertArray['doctor_id'] = getSession('member_id');

            $model = new Goods();
            $res = $model->save($insertArray);
            if (!$res) {
                $this->showMessage('聊天卡保存失败', getUrl('shop/seller_center'), 'html', 'error');
            }

            //如果发布的商品是服务，生成相应服务编号
            if ($model->getGcId1() == 1073) {
                for ($i = 1; $i <= $model->getGoodsStorage(); $i++) {
                    $member_buy_service_num_data['goods_id'] = $model->getGoodsId();
                    $member_buy_service_num_data['start_time'] = $model->getDoctorServiceStartTime();
                    $member_buy_service_num_data['end_time'] = $model->getDoctorServiceEndTime();
                    $member_buy_service_num_data['buyer_number'] = $i;
                    $member_buy_service_num_data['doctor_id'] = getSession('member_id');
                    $member_buy_service_num = new MemberBuyServiceNum();
                    $member_buy_service_num->save($member_buy_service_num_data);
                }
            }

            redirect(getUrl('shop/store_goods_add/add_step_four', array('commonid' => $insertArray['goods_commonid'])));
        }
    }

    /**
     * 第1步：选择分类
     */
    public function add_step_oneAction()
    {
        if (isset($_POST['submit']) && $_POST['submit'] == "ok") {
            @header("Location:" . getUrl('shop/StoreGoodsAdd/add_step_two', array('class_id' => $_POST['class_id'], 't_id' => $_POST['t_id'])));
            exit;
        } else {
            $model_goodsclass = Model('goods_class');
            if (intval(getSession('member_id')) == 1) { //表示是管理员发布商品
                // 获取商品分类
//                $goods_class = $model_goodsclass->getGoodsClass(getSession('store_id'), 0, 1, getSession('seller_group_id'), getSession('seller_gc_limits'));
//                for ($i = 0; $i < count($goods_class); $i++) {
//                    if (intval($goods_class[$i]['gc_virtual']) == 1) {
//                        unset($goods_class[$i]); //删除虚拟分类
//                    }
//                }
                $goods_class = GoodsClass::find("gc_id!=1076 and gc_id!=1073 and gc_parent_id=0");
                if (count($goods_class) > 0) {
                    $goods_class = $goods_class->toArray();
                } else {
                    $goods_class = array();
                }
            } else { //表示是医务人员发布服务
                // 获取服务分类
                //$goods_class = $model_goodsclass->getGoodsClass(getSession('store_id'), 0, 1, getSession('seller_group_id'), getSession('seller_gc_limits'));
                $goods_class = GoodsClass::find("gc_parent_id=1073");
                if (count($goods_class) > 0) {
                    $goods_class = $goods_class->toArray();
                } else {
                    $goods_class = array();
                }
            }


            // 获取已经添加的常用商品分类
            $model_staple = Model('goods_class_staple');
            $param_array = array();
            $param_array['member_id'] = getSession('member_id');
            $staple_array = $model_staple->getStapleList($param_array); //获取医生常用分类列表

            $this->view->setVar('staple_array', $staple_array);
            $this->view->setVar('goods_class', $goods_class);
            $this->view->render('seller_center', 'store_goods_add.step1');
            $this->view->disable();
        }
    }

    /**
     * 第2步：展示添加商品页面
     */
    public function add_step_twoAction()
    {
        // 实例化商品分类模型
        $model_goodsclass = Model('goods_class');
        // 现暂时改为从匿名“自营医生专属等级”中判断
        $editor_multimedia = false;
        if ($this->store_grade['sg_function'] == 'editor_multimedia') {
            $editor_multimedia = true;
        }
        Tpl::output('editor_multimedia', $editor_multimedia);

        $gc_id = intval($_REQUEST['class_id']);

        // 验证商品分类是否存在且商品分类是否为最后一级
        $data = Model('goods_class')->getGoodsClassForCacheModel();
        if (!isset($data[$gc_id]) && !isset($data[$gc_id]['child']) && !isset($data[$gc_id]['childchild'])) {
            $this->showDialog($this->translation->_('store_goods_index_again_choose_category1'));
        }

        // 如果不是自营医生或者自营医生未绑定全部商品类目，读取绑定分类
//        if (!checkPlatformStoreBindingAllGoodsClass()) {
//
//            //商品分类 支持批量显示分类
//            $model_bind_class = Model('store_bind_class');
//            $goods_class = Model('goods_class')->getGoodsClassForCacheModel();
//            $where['store_id'] = getSession('store_id');
//            $class_2 = $goods_class[$gc_id]['gc_parent_id'];
//            $class_1 = $goods_class[$class_2]['gc_parent_id'];
//            $where['class_1'] = $class_1;
//            $where['class_2'] = $class_2;
//            $where['class_3'] = $gc_id;
//            $bind_info = $model_bind_class->getStoreBindClassInfo($where);
//            if (empty($bind_info)) {
//                $where['class_3'] = 0;
//                $bind_info = $model_bind_class->getStoreBindClassInfo($where);
//                if (empty($bind_info)) {
//                    $where['class_2'] = 0;
//                    $where['class_3'] = 0;
//                    $bind_info = $model_bind_class->getStoreBindClassInfo($where);
//                    if (empty($bind_info)) {
//                        $where['class_1'] = 0;
//                        $where['class_2'] = 0;
//                        $where['class_3'] = 0;
//                        $bind_info = Model('store_bind_class')->getStoreBindClassInfo($where);
//                        if (empty($bind_info)) {
//                            $this->showDialog($this->translation->_('store_goods_index_again_choose_category2'));
//                        }
//                    }
//
//                }
//
//            }
//        }

        //权限组对应分类权限判断
//        if (!getSession('seller_gc_limits') && getSession('seller_group_id')) {
//            $rs = Model('seller_group_bclass')->getSellerGroupBclassInfo(array('group_id' => getSession('seller_group_id'), 'gc_id' => $gc_id));
//            if (!$rs) {
//                $this->showMessage('您所在的组无权操作该分类下的商品', '', 'html', 'error');
//            }
//        }

        // 更新常用分类信息
        $goods_class = $model_goodsclass->getGoodsClassLineForTag($gc_id);
        Tpl::output('temp', 2);
        Tpl::output('goods_class', $goods_class);
        Model('goods_class_staple')->autoIncrementStaple($goods_class, getSession('member_id'));

        // 获取类型相关数据
        $typeinfo = Model('type')->getAttr($goods_class['type_id'], getSession('store_id'), $gc_id);
        list($spec_json, $spec_list, $attr_list, $brand_list) = $typeinfo;
        Tpl::output('sign_i', count($spec_list));
        Tpl::output('spec_list', $spec_list);
        Tpl::output('attr_list', $attr_list);
        Tpl::output('brand_list', $brand_list);
        // 自定义属性
        $custom_list = Model('type_custom')->getTypeCustomList(array('type_id' => $goods_class['type_id']));
        Tpl::output('custom_list', $custom_list);

        // 实例化医生商品分类模型
        $store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => getSession('store_id'), 'stc_state' => '1'));
        Tpl::output('store_goods_class', $store_goods_class);

        // 小时分钟显示
        $hour_array = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23');
        Tpl::output('hour_array', $hour_array);
        $minute_array = array('05', '10', '15', '20', '25', '30', '35', '40', '45', '50', '55');
        Tpl::output('minute_array', $minute_array);

        // 关联版式
        $plate_list = Model('store_plate')->getStorePlateList(array('store_id' => getSession('store_id')), 'plate_id,plate_name,plate_position');
        $plate_list = array_under_reset($plate_list, 'plate_position', 2);
        Tpl::output('plate_list', $plate_list);

        // 供货商
        $supplier_list = Model('store_supplier')->getStoreSupplierList(array('sup_store_id' => getSession('store_id')));
        Tpl::output('supplier_list', $supplier_list);

        $this->view->render('seller_center', 'store_goods_add.step2');
        $this->view->disable();
        //Tpl::showpage('store_goods_add.step2');
    }

    /**
     * 保存商品（商品发布第二步使用）
     */
    public function save_goodsAction()
    {
        $logic_goods = Logic('goods');

//        $result = $logic_goods->saveGoods(
//            $_POST,
//            getSession('store_id'),
//            getSession('store_name'),
//            $this->store_info['store_state'],
//            getSession('seller_id'),
//            getSession('seller_name'),
//            getSession('bind_all_gc')
//
//        );
        $result = $logic_goods->saveGoods(
            $_POST,
            $_SESSION['store_id'],
            $_SESSION['store_name'],
            $this->store_info['store_state'],
            $_SESSION['seller_id'],
            $_SESSION['seller_name'],
            $_SESSION['bind_all_gc']
        );

        if (!$result['state']) {
            $this->showMessage($this->translation->_('error') . $result['msg'], getUrl('shop/seller_center'), 'html', 'error');
        }

        redirect(getUrl('shop/store_goods_add/add_step_three', array('commonid' => $result['data'])));
    }

    /**
     * 第3步：添加颜色图片
     */
    public function add_step_threeAction()
    {
        $common_id = intval($_GET['commonid']);
        if ($common_id <= 0) {
            $this->showMessage($this->translation->_('wrong_argument'), getUrl('shop/seller_center'), 'html', 'error');
        }

        $model_goods = Model('goods');
        $img_array = $model_goods->getGoodsList(array('goods_commonid' => $common_id), 'color_id,min(goods_image) as goods_image', 'color_id');
        // 整理，更具id查询颜色名称
        if (!empty($img_array)) {
            $colorid_array = array();
            $image_array = array();
            foreach ($img_array as $val) {
                $image_array[$val['color_id']][0]['goods_image'] = $val['goods_image'];
                $image_array[$val['color_id']][0]['is_default'] = 1;
                $colorid_array[] = $val['color_id'];
            }
            Tpl::output('img', $image_array);
        }

        $common_list = $model_goods->getGoodsCommonInfoByID($common_id, 'spec_value');
        $spec_value = unserialize($common_list['spec_value']);
        Tpl::output('value', $spec_value['1']);

        $model_spec = Model('spec');
        $value_array = $model_spec->getSpecValueList(array('sp_value_id' => array('in', $colorid_array), 'store_id' => getSession('store_id')), 'sp_value_id,sp_value_name');
        if (empty($value_array)) {
            $value_array[] = array('sp_value_id' => '0', 'sp_value_name' => '无颜色');
        }
        Tpl::output('value_array', $value_array);

        Tpl::output('commonid', $common_id);
        //Tpl::showpage('store_goods_add.step3');
        $this->view->render('seller_center', 'store_goods_add.step3');
        $this->view->disable();
    }

    /**
     * 保存第3步提交的商品颜色图片
     */
    public function save_imageAction()
    {
        if (chksubmit()) {
            $common_id = intval($_POST['commonid']);
            if ($common_id <= 0 || empty($_POST['img'])) {
                $this->showMessage($this->translation->_('wrong_argument'));
            }
            $model_goods = Model('goods');
            // 保存
            $insert_array = array();
            foreach ($_POST['img'] as $key => $value) {
                $k = 0;
                foreach ($value as $v) {
                    if ($v['name'] == '') {
                        continue;
                    }
                    // 商品默认主图
                    $update_array = array();        // 更新商品主图
                    $update_where = array();
                    $update_array['goods_image'] = $v['name'];
                    $update_where['goods_commonid'] = $common_id;
                    $update_where['color_id'] = $key;
                    if ($k == 0 || $v['default'] == 1) {
                        $k++;
                        $update_array['goods_image'] = $v['name'];
                        $update_where['goods_commonid'] = $common_id;
                        $update_where['color_id'] = $key;
                        // 更新商品主图
                        $model_goods->editGoods($update_array, $update_where);
                    }
                    $tmp_insert = array();
                    $tmp_insert['goods_commonid'] = $common_id;
                    $tmp_insert['store_id'] = getSession('store_id');
                    $tmp_insert['color_id'] = $key;
                    $tmp_insert['goods_image'] = $v['name'];
                    $tmp_insert['goods_image_sort'] = ($v['default'] == 1) ? 0 : intval($v['sort']);
                    $tmp_insert['is_default'] = $v['default'];
                    $insert_array[] = $tmp_insert;
                }
            }
            $rs = $model_goods->addGoodsImagesAll($insert_array);
            if ($rs) {
                redirect(getUrl('shop/store_goods_add/add_step_four', array('commonid' => $common_id)));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
    }

    /**
     * 第4步：商品发布
     */
    public function add_step_fourAction()
    {
        // 单条商品信息
        $goods_info = Model('goods')->getGoodsInfo(array('goods_commonid' => $_GET['commonid']));

        // 自动发布动态
        $data_array = array();
        $data_array['goods_id'] = $goods_info['goods_id'];
        $data_array['store_id'] = $goods_info['store_id'];
        $data_array['goods_name'] = $goods_info['goods_name'];
        $data_array['goods_image'] = $goods_info['goods_image'];
        $data_array['goods_price'] = $goods_info['goods_price'];
        $data_array['goods_transfee_charge'] = $goods_info['goods_freight'] == 0 ? 1 : 0;
        $data_array['goods_freight'] = $goods_info['goods_freight'];
        $this->storeAutoShare($data_array, 'new');

        Tpl::output('allow_gift', Model('goods')->checkGoodsIfAllowGift($goods_info));
        Tpl::output('goods_id', $goods_info['goods_id']);
        //Tpl::showpage('store_goods_add.step4');

//        $member=Member::findFirst("member_id=".getSession('member_id'));
//        if($member){
//            if($member->getMemberTypeId()>1){
//                Tpl::output('')
//            }
//        }

        $this->view->render('seller_center', 'store_goods_add.step4');
        $this->view->disable();
    }

    /**
     * 上传商品图片
     */
    public function image_uploadAction()
    {
        $logic_goods = Logic('goods');

        $result = $logic_goods->uploadGoodsImage(
            $_POST['name'], //前端页面input=file控件的name名称
            getSession('store_id'),
            $this->store_grade['sg_album_limit']
        );

        if (!$result['state']) {
            echo json_encode(array('error' => $result['msg']));
            die;
        }

        echo json_encode($result['data']);
        die;
    }

    /**
     * ajax获取商品分类的子级数据的json格式字符串
     */
    public function ajax_goods_classAction()
    {
        $gc_id = intval($_GET['gc_id']); //父类id
        $deep = intval($_GET['deep']); //深度
        if ($gc_id <= 0 || $deep <= 0 || $deep >= 4) {
            exit();
        }
        $model_goodsclass = Model('goods_class');
        //if (intval(getSession('member_id')) == 1) { //表示是管理员发布商品
            //$list = GoodsClass::find("gc_virtual=0 and gc_parent_id=" . $gc_id);
        //} else {
            //$list = GoodsClass::find("gc_virtual=1 and gc_parent_id=" . $gc_id);
        //}
		$list = GoodsClass::find("gc_parent_id=" . $gc_id);
        if (count($list) > 0) {
            $list = $list->toArray();
        } else {
            $list = array();
        }
        //$list = $model_goodsclass->getGoodsClass(getSession('store_id'), $gc_id, $deep, getSession('seller_group_id'), getSession('seller_gc_limits'));
        if (empty($list)) {
            exit();
        }
        echo json_encode($list);
        exit;
    }

    /**
     * ajax删除常用分类
     */
    public function ajax_stapledelAction()
    {
        $staple_id = intval($_GET ['staple_id']);
        if ($staple_id < 1) {
            echo json_encode(array(
                'done' => false,
                'msg' => $this->translation->_('wrong_argument')
            ));
            die ();
        }
        /**
         * 实例化模型
         */
        $model_staple = Model('goods_class_staple');

        $result = $model_staple->delStaple(array('staple_id' => $staple_id, 'member_id' => getSession('member_id')));
        if ($result) {
            echo json_encode(array(
                'done' => true
            ));
            die ();
        } else {
            echo json_encode(array(
                'done' => false,
                'msg' => ''
            ));
            die ();
        }
    }

    /**
     * ajax选择常用商品分类
     */
    public function ajax_show_commAction()
    {
        $staple_id = intval($_GET['stapleid']);

        /**
         * 查询相应的商品分类id
         */
        $model_staple = Model('goods_class_staple');
        $staple_info = $model_staple->getStapleInfo(array('staple_id' => intval($staple_id)), 'gc_id_1,gc_id_2,gc_id_3');
        if (empty ($staple_info) || !is_array($staple_info)) {
            echo json_encode(array(
                'done' => false,
                'msg' => ''
            ));
            die ();
        }

        $list_array = array();
        $list_array['gc_id'] = 0;
        $list_array['type_id'] = $staple_info['type_id'];
        $list_array['done'] = true;
        $list_array['one'] = '';
        $list_array['two'] = '';
        $list_array['three'] = '';

        $gc_id_1 = intval($staple_info['gc_id_1']);
        $gc_id_2 = intval($staple_info['gc_id_2']);
        $gc_id_3 = intval($staple_info['gc_id_3']);

        /**
         * 查询同级分类列表
         */
        $model_goods_class = Model('goods_class');
        // 1级
        if ($gc_id_1 > 0) {
            $list_array['gc_id'] = $gc_id_1;
            $class_list = $model_goods_class->getGoodsClass(getSession('store_id'), 0, 1, getSession('seller_group_id'), getSession('seller_gc_limits'));
            if (empty ($class_list) || !is_array($class_list)) {
                echo json_encode(array(
                    'done' => false,
                    'msg' => ''
                ));
                die ();
            }
            foreach ($class_list as $val) {
                if ($val ['gc_id'] == $gc_id_1) {
                    $list_array ['one'] .= '<li class="" onclick="selClass($(this));" data-param="{gcid:' . $val ['gc_id'] . ', deep:1, tid:' . $val ['type_id'] . '}" nctype="selClass"> <a class="classDivClick" href="javascript:void(0)"><span class="has_leaf"><i class="icon-double-angle-right"></i>' . $val ['gc_name'] . '</span></a> </li>';
                } else {
                    $list_array ['one'] .= '<li class="" onclick="selClass($(this));" data-param="{gcid:' . $val ['gc_id'] . ', deep:1, tid:' . $val ['type_id'] . '}" nctype="selClass"> <a class="" href="javascript:void(0)"><span class="has_leaf"><i class="icon-double-angle-right"></i>' . $val ['gc_name'] . '</span></a> </li>';
                }
            }
        }
        // 2级
        if ($gc_id_2 > 0) {
            $list_array['gc_id'] = $gc_id_2;
            $class_list = $model_goods_class->getGoodsClass(getSession('store_id'), $gc_id_1, 2, getSession('seller_group_id'), getSession('seller_gc_limits'));
            if (empty ($class_list) || !is_array($class_list)) {
                echo json_encode(array(
                    'done' => false,
                    'msg' => ''
                ));
                die ();
            }
            foreach ($class_list as $val) {
                if ($val ['gc_id'] == $gc_id_2) {
                    $list_array ['two'] .= '<li class="" onclick="selClass($(this));" data-param="{gcid:' . $val ['gc_id'] . ', deep:2, tid:' . $val ['type_id'] . '}" nctype="selClass"> <a class="classDivClick" href="javascript:void(0)"><span class="has_leaf"><i class="icon-double-angle-right"></i>' . $val ['gc_name'] . '</span></a> </li>';
                } else {
                    $list_array ['two'] .= '<li class="" onclick="selClass($(this));" data-param="{gcid:' . $val ['gc_id'] . ', deep:2, tid:' . $val ['type_id'] . '}" nctype="selClass"> <a class="" href="javascript:void(0)"><span class="has_leaf"><i class="icon-double-angle-right"></i>' . $val ['gc_name'] . '</span></a> </li>';
                }
            }
        }
        // 3级
        if ($gc_id_3 > 0) {
            $list_array['gc_id'] = $gc_id_3;
            $class_list = $model_goods_class->getGoodsClass(getSession('store_id'), $gc_id_2, 3, getSession('seller_group_id'), getSession('seller_gc_limits'));
            if (empty ($class_list) || !is_array($class_list)) {
                echo json_encode(array(
                    'done' => false,
                    'msg' => ''
                ));
                die ();
            }
            foreach ($class_list as $val) {
                if ($val ['gc_id'] == $gc_id_3) {
                    $list_array ['three'] .= '<li class="" onclick="selClass($(this));" data-param="{gcid:' . $val ['gc_id'] . ', deep:3, tid:' . $val ['type_id'] . '}" nctype="selClass"> <a class="classDivClick" href="javascript:void(0)"><span class="has_leaf"><i class="icon-double-angle-right"></i>' . $val ['gc_name'] . '</span></a> </li>';
                } else {
                    $list_array ['three'] .= '<li class="" onclick="selClass($(this));" data-param="{gcid:' . $val ['gc_id'] . ', deep:3, tid:' . $val ['type_id'] . '}" nctype="selClass"> <a class="" href="javascript:void(0)"><span class="has_leaf"><i class="icon-double-angle-right"></i>' . $val ['gc_name'] . '</span></a> </li>';
                }
            }
        }
//        // 转码
//        if (strtoupper(CHARSET) == 'GBK') {
//            $list_array = Language::getUTF8($list_array);
//        }
        echo json_encode($list_array);
        die ();
    }

    /**
     * AJAX添加商品规格值
     */
    public function ajax_add_specAction()
    {
        $name = trim($_GET['name']);
        $gc_id = intval($_GET['gc_id']);
        $sp_id = intval($_GET['sp_id']);
        if ($name == '' || $gc_id <= 0 || $sp_id <= 0) {
            echo json_encode(array('done' => false));
            die();
        }
        $insert = array(
            'sp_value_name' => $name,
            'sp_id' => $sp_id,
            'gc_id' => $gc_id,
            'store_id' => getSession('store_id'),
            'sp_value_color' => null,
            'sp_value_sort' => 0,
        );
        $value_id = Model('spec')->addSpecValue($insert);
        if ($value_id) {
            echo json_encode(array('done' => true, 'value_id' => $value_id));
            die();
        } else {
            echo json_encode(array('done' => false));
            die();
        }
    }

    /**
     * AJAX查询品牌
     */
    public function ajax_get_brandAction()
    {
        $type_id = intval($_GET['tid']);
        $initial = trim($_GET['letter']);
        $keyword = trim($_GET['keyword']);
        $type = trim($_GET['type']);
        if (!in_array($type, array('letter', 'keyword')) || ($type == 'letter' && empty($initial)) || ($type == 'keyword' && empty($keyword))) {
            echo json_encode(array());
            die();
        }

        // 实例化模型
        $model_type = Model('type');
        $where = array();
        $where['type_id'] = $type_id;
        // 验证类型是否关联品牌
        $count = $model_type->getTypeBrandCount($where);
        if ($type == 'letter') {
            switch ($initial) {
                case 'all':
                    break;
                case '0-9':
                    $where['brand_initial'] = array('in', array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9));
                    break;
                default:
                    $where['brand_initial'] = $initial;
                    break;
            }
        } else {
            $where['brand_name|brand_initial'] = array('like', '%' . $keyword . '%');
        }
        if ($count > 0) {
            $brand_array = $model_type->typeRelatedJoinList($where, 'brand', 'brand.brand_id,brand.brand_name,brand.brand_initial');
        } else {
            unset($where['type_id']);
            $brand_array = Model('brand')->getBrandPassedList($where, 'brand_id,brand_name,brand_initial', 0, 'brand_initial asc, brand_sort asc');
        }
        echo json_encode($brand_array);
        die();
    }
}