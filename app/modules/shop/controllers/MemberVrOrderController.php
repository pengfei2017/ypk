<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/10
 * Time: 15:01
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Models\Goods;
use Ypk\QueueClient;
use Ypk\Tpl;

class MemberVrOrderController extends BaseMemberController
{

    public function initialize()
    {
        parent::initialize();
        getTranslation('member_member_index,member_layout');
    }

    /**
     * 买家我的订单
     *
     */
    public function indexAction()
    {
        $model_vr_order = Model('vr_order');

        //搜索
        $condition = array();
        $condition['buyer_id'] = getSession('member_id');
        if (preg_match('/^\d{10,20}$/', $_GET['keyword'])) {
            $condition['order_sn'] = $_GET['keyword'];
        } elseif ($_GET['keyword'] != '') {
            $condition['goods_name'] = array('like', '%' . $_GET['keyword'] . '%');
        }
        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : null;
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date']) : null;
        if ($start_unixtime || $end_unixtime) {
            $condition['add_time'] = array('time', array($start_unixtime, $end_unixtime));
        }
        if ($_GET['state_type'] != '') {
            $condition['order_state'] = str_replace(
                array('state_new', 'state_pay', 'state_success', 'state_cancel'),
                array(ORDER_STATE_NEW, ORDER_STATE_PAY, ORDER_STATE_SUCCESS, ORDER_STATE_CANCEL), $_GET['state_type']);
        }

        $order_list = $model_vr_order->getOrderList($condition, 20, '*', 'order_id desc');
        //没有使用的兑换码列表
        $order_list = $model_vr_order->getCodeRefundList($order_list);
        //查询消费者保障服务
        if (getConfig('contract_allow') == 1) {
            $contract_item = Model('contract')->getContractItemByCache();
        }
        foreach ($order_list as $key => $order) {
            //处理消费者保障服务
            if (trim($order['goods_contractid']) && $contract_item) {
                $goods_contractid_arr = explode(',', $order['goods_contractid']);
                foreach ((array)$goods_contractid_arr as $gcti_v) {
                    $order['contractlist'][] = $contract_item[$gcti_v];
                }
            }
            $order_list[$key] = $order;

            //显示取消订单
            $order_list[$key]['if_cancel'] = $model_vr_order->getOrderOperateState('buyer_cancel', $order);

            //显示支付
            $order_list[$key]['if_pay'] = $model_vr_order->getOrderOperateState('payment', $order);

            //显示删除订单(放入回收站)
            $order_list[$key]['if_delete'] = $model_vr_order->getOrderOperateState('delete', $order);

            //显示永久删除
            $order_list[$key]['if_drop'] = $model_vr_order->getOrderOperateState('drop', $order);

            //显示还原订单
            $order_list[$key]['if_restore'] = $model_vr_order->getOrderOperateState('restore', $order);

            //显示退款
            $order_list[$key]['if_refund'] = $model_vr_order->getOrderOperateState('refund', $order);

            //显示评价
            $order_list[$key]['if_evaluation'] = $model_vr_order->getOrderOperateState('evaluation', $order);
            $order_list[$key]['is_service'] = "no";
            $goods_id = $order_list[$key]['goods_id'];
            if (!empty($goods_id)) {
                $goods_info = Goods::findFirst("goods_id=" . $goods_id);
                if ($goods_info !== false && $goods_info->getGcId1() == 1073) {
                    $order_list[$key]['is_service'] = "yes";
                }
            }
//            if ($order_list[$key]['if_evaluation'] === true) {
//                $goods_id = $order_list[$key]['goods_id'];
//                if (!empty($goods_id)) {
//                    $goods_info = Goods::findFirst("goods_id=" . $goods_id);
//                    if ($goods_info !== false && $goods_info->getGcId1() == 1073) {
//                        $order_list[$key]['is_service'] = "yes";
//                    }
//                }
//            }

            //显示分享
            $order_list[$key]['if_share'] = $model_vr_order->getOrderOperateState('share', $order);

            //显示商家信息(QQ,WW)
            $order_list[$key]['extend_store'] = Model('store')->getStoreInfoByID($order['store_id']);
        }

        Tpl::output('order_list', $order_list);
        Tpl::output('show_page', $model_vr_order->showpage());

        self::profile_menu($_GET['recycle'] ? 'member_order_recycle' : 'member_order');
        //Tpl::showpage('member_vr_order.index');
        $this->view->render('member_vrorder', 'member_vr_order_index');
        $this->view->disable();
    }

    /**
     * 兑换码消费（兑换码完成兑换，订单流程走完，四大计算计算各种奖金和积分）
     */
    public function exchangeAction()
    {
        if (!preg_match('/^[a-zA-Z0-9]{15,18}$/', $_GET['vr_code'])) {
            return array('error' => '兑换码格式错误，请重新输入');
        }
        $model_vr_order = Model('vr_order');
        $vr_code_info = $model_vr_order->getOrderCodeInfo(array('vr_code' => $_GET['vr_code']));
        if (empty($vr_code_info) || empty($vr_code_info['vr_code']) || $vr_code_info['buyer_id'] != getSession('member_id')) {
            showDialog("该兑换码不存在", getUrl('shop/member_vrorder/show_order', array('order_id' => $vr_code_info['order_id'])));
        }
        if ($vr_code_info['vr_state'] == '1') {
            showDialog("该兑换码已被使用", getUrl('shop/member_vrorder/show_order', array('order_id' => $vr_code_info['order_id'])));
        }
        if ($vr_code_info['vr_indate'] < TIMESTAMP) {
            showDialog('该兑换码已过期，使用截止日期为： ' . date('Y-m-d H:i:s', $vr_code_info['vr_indate']), getUrl('shop/member_vrorder/show_order', array('order_id' => $vr_code_info['order_id'])));
        }
        if ($vr_code_info['refund_lock'] > 0) {//退款锁定状态:0为正常,1为锁定(待审核),2为同意
            showDialog("该兑换码已申请退款，不能使用", getUrl('shop/member_vrorder/show_order', array('order_id' => $vr_code_info['order_id'])));
        }

        //更新兑换码状态
        $update = array();
        $update['vr_state'] = 1;
        $update['vr_usetime'] = TIMESTAMP;
        $update = $model_vr_order->editOrderCode($update, array('vr_code' => $_GET['vr_code']));

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
            showDialog("兑换成功", getUrl('shop/member_vrorder/show_order', array('order_id' => $vr_code_info['order_id'])));
        } else {
            showDialog("兑换失败", getUrl('shop/member_vrorder/show_order', array('order_id' => $vr_code_info['order_id'])));
        }
    }

    /**
     * 订单详细
     *
     */
    public function show_orderAction()
    {
        $order_id = intval($_GET['order_id']);
        if ($order_id <= 0) {
            showMessage(getLang('member_order_none_exist'), '', 'html', 'error');
        }
        $model_vr_order = Model('vr_order');
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = getSession('member_id');
        $order_info = $model_vr_order->getOrderInfo($condition);
        if (empty($order_info) || $order_info['delete_state'] == ORDER_DEL_STATE_DROP) {
            showMessage(getLang('member_order_none_exist'), '', 'html', 'error');
        }

        $order_list = array();
        $order_list[$order_id] = $order_info;
        $order_list = $model_vr_order->getCodeRefundList($order_list);//没有使用的兑换码列表
        $order_info = $order_list[$order_id];

        $store_info = Model('store')->getStoreInfo(array('store_id' => $order_info['store_id']));

        //取兑换码列表
        $vr_code_list = $model_vr_order->getOrderCodeList(array('order_id' => $order_info['order_id']));
        $order_info['extend_vr_order_code'] = $vr_code_list;

        //显示取消订单
        $order_info['if_cancel'] = $model_vr_order->getOrderOperateState('buyer_cancel', $order_info);

        //显示订单进行步骤
        $order_info['step_list'] = $model_vr_order->getOrderStep($order_info);

        //显示退款
        $order_info['if_refund'] = $model_vr_order->getOrderOperateState('refund', $order_info);

        //显示评价
        $order_info['if_evaluation'] = $model_vr_order->getOrderOperateState('evaluation', $order_info);

        //显示分享
        $order_info['if_share'] = $model_vr_order->getOrderOperateState('share', $order_info);

        //显示系统自动取消订单日期
        if ($order_info['order_state'] == ORDER_STATE_NEW) {
            $order_info['order_cancel_day'] = $order_info['add_time'] + ORDER_AUTO_CANCEL_TIME * 3600;
        }
        //查询消费者保障服务
        if (getConfig('contract_allow') == 1) {
            $contract_item = Model('contract')->getContractItemByCache();
        }
        //处理消费者保障服务
        if (trim($order_info['goods_contractid']) && $contract_item) {
            $goods_contractid_arr = explode(',', $order_info['goods_contractid']);
            foreach ((array)$goods_contractid_arr as $gcti_v) {
                $order_info['contractlist'][] = $contract_item[$gcti_v];
            }
        }
        Tpl::output('order_info', $order_info);
        Tpl::output('store_info', $store_info);

        //Tpl::showpage('member_vr_order.show');
        $this->view->render('member_vrorder', 'member_vr_order_show');
        $this->view->disable();
    }

    /**
     * 买家订单状态操作
     *
     */
    public function change_stateAction()
    {
        $model_vr_order = Model('vr_order');
        $condition = array();
        $condition['order_id'] = intval($_GET['order_id']);
        $condition['buyer_id'] = getSession('member_id');
        $order_info = $model_vr_order->getOrderInfo($condition);

        if ($_GET['state_type'] == 'order_cancel') {
            $result = $this->_order_cancel($order_info, $_POST);
        }

        if (!$result['state']) {
            showDialog($result['msg'], '', 'error');
        } else {
            showDialog($result['msg'], 'reload', 'js');
        }
    }

    /**
     * 取消订单
     */
    private function _order_cancel($order_info, $post)
    {
        if (!chksubmit()) {
            Tpl::output('order_info', $order_info);
            //Tpl::showpage('member_vr_order.cancel', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('no_layout', 'member_vr_order_cancel');
            //$this->view->disable();
            exit();
        } else {
            $model_vr_order = Model('vr_order');
            $logic_vr_order = Logic('vr_order');
            $if_allow = $model_vr_order->getOrderOperateState('buyer_cancel', $order_info);
            if (!$if_allow) {
                return queue_callback(false, '无权操作');
            }
            if (TIMESTAMP - 86400 < $order_info['api_pay_time']) {
                $_hour = ceil(($order_info['api_pay_time'] + 86400 - TIMESTAMP) / 3600);
                return queue_callback(false, '该订单曾尝试使用第三方支付平台支付，须在' . $_hour . '小时以后才可取消');
            }
            $msg = $post['state_info1'] != '' ? $post['state_info1'] : $post['state_info'];
            return $logic_vr_order->changeOrderStateCancel($order_info, 'buyer', $msg);
        }
    }

    /**
     * 发送兑换码到手机
     */
    public function resendAction()
    {
        if (!chksubmit()) {
            //Tpl::showpage('member_vr_order.resend', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('no_layout', 'member_vr_order_resend');
            //$this->view->disable();
            exit();
        }
        if (!preg_match('/^[\d]{11}$/', $_POST['buyer_phone'])) {
            showDialog('请正确填写手机号');
        }
        $order_id = intval($_POST['order_id']);
        if ($order_id <= 0) {
            showDialog('参数错误');
        }

        $model_vr_order = Model('vr_order');

        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = getSession('member_id');
        $order_info = $model_vr_order->getOrderInfo($condition);
        if (empty($order_info) && $order_info['order_state'] != ORDER_STATE_PAY) {
            showDialog('订单信息发生错误');
        }
        if ($order_info['vr_send_times'] >= 5) {
            showDialog('您发送的次数过多，无法发送');
        }

        //发送兑换码到手机
        $param = array('order_id' => $order_id, 'buyer_id' => getSession('member_id'), 'buyer_phone' => $_POST['buyer_phone'], 'goods_name' => $order_info['goods_name']);
        QueueClient::push('sendVrCode', $param);

        $model_vr_order->editOrder(array('vr_send_times' => array('exp', 'vr_send_times+1')), array('order_id' => $order_id));

        showDialog('发送成功', '', 'succ', "DialogManager.close('vr_code_resend');");
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_key 当前导航的menu_key
     * @internal param string $menu_type 导航类型
     */
    private function profile_menu($menu_key = '')
    {
        $menu_array = array(
            array('menu_key' => 'member_order', 'menu_name' => getLang('nc_member_path_order_list'), 'menu_url' => getUrl('shop/member_vr_order')),
        );
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu', $menu_array);
        $this->view->setVar('menu_key', $menu_key);
    }
}