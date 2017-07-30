<?php
/**
 * 我的订单
 */

namespace Ypk\Modules\Mobile\Controllers;


use Ypk\Models\Goods;
use Ypk\Process;
use Ypk\QueueClient;

class MemberVrOrderController extends MobileMemberController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 获取虚拟订单列表
     */
    public function order_listAction()
    {
        if(Process::islock('buy_vr_goods')){
            Process::clear('buy_vr_goods');
        }

        $ownShopIds = Model('store')->getOwnShopIds();

        $model_vr_order = Model('vr_order');

        $condition = array();
        $condition['buyer_id'] = $this->member_info['member_id'];
        if (preg_match('/^\d{10,20}$/', $_POST['order_key'])) {
            $condition['order_sn'] = $_POST['order_key'];
        } elseif ($_POST['order_key'] != '') {
            $condition['goods_name'] = array('like', '%' . $_POST['order_key'] . '%');
        }
        if ($_POST['state_type'] != '') {
            $condition['order_state'] = str_replace(
                array('state_new', 'state_pay'),
                array(ORDER_STATE_NEW, ORDER_STATE_PAY), $_POST['state_type']);
        }
        $order_list = $model_vr_order->getOrderList($condition, $this->page, '*', 'order_id desc');

        foreach ($order_list as $key => $order) {
            //显示取消订单
            $order_list[$key]['if_cancel'] = $model_vr_order->getOrderOperateState('buyer_cancel', $order);

            //显示支付
            $order_list[$key]['if_pay'] = $model_vr_order->getOrderOperateState('payment', $order);

            //----------------------------------------------判断是否可以退款-----------------------------------------------
            $order_list_arr = array();
            $order_list_arr[$order['order_id']] = $order;
            $order_list_arr = $model_vr_order->getCodeRefundList($order_list_arr);//没有使用的兑换码列表
            $order_info = $order_list_arr[$order['order_id']];

            //取兑换码列表
            $vr_code_list = $model_vr_order->getOrderCodeList(array('order_id' => $order['order_id']));
            $order_info['extend_vr_order_code'] = $vr_code_list;
            //显示退款
            $order_list[$key]['if_refund'] = $model_vr_order->getOrderOperateState('refund', $order_info);

            //显示上传病历
            if (intval($order_list[$key]['order_state']) == ORDER_STATE_SUCCESS) {
                $order_list[$key]['upload_case_history'] = "yes";
            } else {
                $order_list[$key]['upload_case_history'] = "no";
            }

            //显示评价
            $order_list[$key]['if_evaluation'] = $model_vr_order->getOrderOperateState('evaluation', $order);

            $order_list[$key]['goods_image_url'] = cthumb($order['goods_image'], 240, $order['store_id']);

            $order_list[$key]['ownshop'] = in_array($order['store_id'], $ownShopIds);
        }

        $page_count = $model_vr_order->gettotalpage();

        output_data(array('order_list' => $order_list), mobile_page($page_count));
    }

    /**
     * 获取单个订单的信息
     */
    public function order_infoAction()
    {
        $order_id = intval($_GET['order_id']);
        if ($order_id <= 0) {
            output_error('订单不存在');
        }
        $model_vr_order = Model('vr_order');
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = $this->member_info['member_id'];
        $order_info = $model_vr_order->getOrderInfo($condition);
        if (empty($order_info) || $order_info['delete_state'] == ORDER_DEL_STATE_DROP) {
            output_error('订单不存在');
        }
        $order_list = array();
        $order_list[$order_id] = $order_info;

        //显示取消订单
        $order_info['if_cancel'] = $model_vr_order->getOrderOperateState('buyer_cancel', $order_info);

        //显示评价
        $order_info['if_evaluation'] = $model_vr_order->getOrderOperateState('evaluation', $order_info);

        //-----------------------------------------判断是否可以退款-----------------------------------------
        $order_list_arr = array();
        $order_list_arr[$order_info['order_id']] = $order_info;
        $order_list_arr = $model_vr_order->getCodeRefundList($order_list_arr);//没有使用的兑换码列表
        $order_info = $order_list_arr[$order_info['order_id']];

        //取兑换码列表
        $vr_code_list = $model_vr_order->getOrderCodeList(array('order_id' => $order_info['order_id']));
        $order_info['extend_vr_order_code'] = $vr_code_list;
        //显示退款
        $order_info['if_refund'] = $model_vr_order->getOrderOperateState('refund', $order_info);

        $order_info['goods_image_url'] = cthumb($order_info['goods_image'], 240, $order_info['store_id']);

        $ownShopIds = Model('store')->getOwnShopIds();
        $order_info['ownshop'] = in_array($order_info['store_id'], $ownShopIds);

        $order_info['vr_indate'] = $order_info['vr_indate'] ? date('Y-m-d H:i:s', $order_info['vr_indate']) : '';
        $order_info['add_time'] = date('Y-m-d H:i:s', $order_info['add_time']);
        $order_info['payment_time'] = $order_info['payment_time'] ? date('Y-m-d H:i:s', $order_info['payment_time']) : '';
        $order_info['finnshed_time'] = $order_info['finnshed_time'] ? date('Y-m-d H:i:s', $order_info['finnshed_time']) : '';

        $order_info['if_resend'] = $order_info['order_state'] == ORDER_STATE_PAY ? true : false;
        //取兑换码列表
        $vr_code_list = $model_vr_order->getOrderCodeList(array('order_id' => $order_info['order_id']));
        $order_info['code_list'] = $vr_code_list ? $vr_code_list : array();

        //显示上传病历
        if (intval($order_info['order_state']) == ORDER_STATE_SUCCESS) {
            $order_info['upload_case_history'] = "yes";
        } else {
            $order_info['upload_case_history'] = "no";
        }

        $goods_model = Goods::findFirst('goods_id=' . $order_info['goods_id']);
        if ($goods_model !== false) {
            if ($goods_model->getGcId1() == 1076) { //表示聊天卡
                $order_info['is_chat_card']="yes";
            }else{
                $order_info['is_chat_card']="no";
            }
            $order_info['to_member_id']=$goods_model->getDoctorId();
        }


        output_data(array('order_info' => $order_info));
    }

    /**
     * 取消订单
     */
    public function order_cancelAction()
    {
        $model_vr_order = Model('vr_order');
        $condition = array();
        $condition['order_id'] = intval($_POST['order_id']);
        $condition['buyer_id'] = $this->member_info['member_id'];
        $order_info = $model_vr_order->getOrderInfo($condition);

        $if_allow = $model_vr_order->getOrderOperateState('buyer_cancel', $order_info);
        if (!$if_allow) {
            output_data('无权操作');
        }

        $logic_vr_order = Logic('vr_order');
        $result = $logic_vr_order->changeOrderStateCancel($order_info, 'buyer', '其它原因');

        if (!$result['state']) {
            output_data($result['msg']);
        } else {
            output_data('1');
        }
    }

    /**
     * 发送兑换码到手机
     */
    public function resendAction()
    {
        if (!preg_match('/^[\d]{11}$/', $_POST['buyer_phone'])) {
            output_error('请正确填写手机号');
        }
        $order_id = intval($_POST['order_id']);
        if ($order_id <= 0) {
            output_error('参数错误');
        }

        $model_vr_order = Model('vr_order');

        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = $this->member_info['member_id'];
        $order_info = $model_vr_order->getOrderInfo($condition);
        if (empty($order_info) && $order_info['order_state'] != ORDER_STATE_PAY) {
            output_error('订单信息发生错误');
        }
        if ($order_info['vr_send_times'] >= 5) {
            output_error('您发送的次数过多，无法发送');
        }

        //发送兑换码到手机
        $param = array('order_id' => $order_id, 'buyer_id' => $this->member_info['member_id'], 'buyer_phone' => $_POST['buyer_phone'], 'goods_name' => $order_info['goods_name']);
        QueueClient::push('sendVrCode', $param);

        $model_vr_order->editOrder(array('vr_send_times' => array('exp', 'vr_send_times+1')), array('order_id' => $order_id));

        output_data('1');
    }

    /**
     * 获取可以退款的兑换码列表
     */
    public function get_exchange_code_listAction()
    {
        $model_vr_refund = Model('vr_refund');
        $condition = array();
        $condition['buyer_id'] = $this->member_info['member_id'];
        $condition['order_id'] = $_POST['order_id'];
        $order = $model_vr_refund->getRightOrderList($condition); //此函数内部已经获取到了虚拟兑换码列表$order['code_list']
        if (!empty($order) && !empty($order['code_list'])) {
            output_data($order['code_list']);
        } else {
            echo "";
        }
        exit;
    }
}
