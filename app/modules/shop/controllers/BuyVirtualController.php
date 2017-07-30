<?php
/**
 * 虚拟商品购买
 * User: Administrator
 * Date: 2016/12/10
 * Time: 20:53
 *
 * 采用的布局页面：buy_layout
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Models\Goods;
use Ypk\Models\GoodsBuyRecord;
use Ypk\Models\Orders;
use Ypk\Models\VrOrder;
use Ypk\QueueClient;
use Ypk\Tpl;

class BuyVirtualController extends BaseBuyController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('home_cart_index');
        if (!getSession('member_id')) {
            redirect(getUrl('member/login/index', array('ref_url' => getReferer())));
        }
        //验证该会员是否禁止购买
        if (!getSession('is_buy')) {
            showMessage(getLang('cart_buy_noallow'), '', 'html', 'error');
        }
        Tpl::output('hidden_rtoolbar_cart', 1);
    }

    /**
     * 虚拟商品购买第一步
     */
    public function buy_step1Action()
    {
        $logic_buy_virtual = Logic('buy_virtual');
        $result = $logic_buy_virtual->getBuyStep1Data($_GET['goods_id'], $_GET['quantity'], getSession('member_id'));
        if (!$result['state']) {
            showMessage($result['msg'], '', 'html', 'error');
        }

        if (intval($result['data']['goods_info']['gc_id_1']) == 1073) { //表示购买的是服务
            //先判断服务是否在当天已经被购买过
            $start_time = strtotime(date('Y-m-d 0:0:0.000')); //当天开始时间
            $end_time = strtotime(date('Y-m-d 23:59:59.999')); //当天结束时间
            $goods_buy_record_model = GoodsBuyRecord::findFirst("buyer_id=" . getSession('member_id') . " and goods_id=" . $result['data']['goods_info']['goods_id'] . " and add_time>=" . $start_time . " and add_time<=" . $end_time);
            if ($goods_buy_record_model !== false) {
                showDialog('您今天已经购买此服务，请勿重复购买', getUrl('shop/goods/index', array('goods_id' => $result['data']['goods_info']['goods_id'])));
            }
        }

        //标识购买流程执行步骤
        Tpl::output('buy_step', 'step1');

        Tpl::output('goods_info', $result['data']['goods_info']);
        Tpl::output('store_info', $result['data']['store_info']);

        //Tpl::showpage('buy_virtual_step1');
        $this->view->render('buy_virtual', 'buy_virtual_step1');
        $this->view->disable();
    }

    /**
     * 虚拟商品购买第二步
     */
    public function buy_step2Action()
    {
        $logic_buy_virtual = Logic('buy_virtual');
        $result = $logic_buy_virtual->getBuyStep2Data($_POST['goods_id'], $_POST['quantity'], getSession('member_id'));
        if (!$result['state']) {
            showMessage($result['msg'], '', 'html', 'error');
        }

        //处理会员信息
        $member_info = array_merge($this->member_info, $result['data']['member_info']);

        //标识购买流程执行步骤
        Tpl::output('buy_step', 'step2');
        Tpl::output('goods_info', $result['data']['goods_info']);
        Tpl::output('store_info', $result['data']['store_info']);
        Tpl::output('member_info', $member_info);
        //Tpl::showpage('buy_virtual_step2');
        $this->view->render('buy_virtual', 'buy_virtual_step2');
        $this->view->disable();
    }

    /**
     * 虚拟商品购买第三步
     */
    public function buy_step3Action()
    {
        $logic_buy_virtual = Logic('buy_virtual');
        $_POST['order_from'] = 1;
        $result = $logic_buy_virtual->buyStep3($_POST, getSession('member_id'));
        if (!$result['state']) {
            //showMessage($result['msg'], 'index.php', 'html', 'error');
            showMessage($result['msg'], getUrl('shop'), 'html', 'error');
        }
        //转向到商城支付页面
        redirect(getUrl('shop/buy_virtual/pay', array('order_id' => $result['data']['order_id'])));
    }

    /**
     * 显示支付页面，在这个页面选择支付方式后，确认支付，然后跳转到 shop/payment/vr_order 进行支付处理
     */
    public function payAction()
    {
        $order_id = intval($_GET['order_id']);
        if ($order_id <= 0) {
            showMessage('该订单不存在', getUrl('shop/member_vr_order'), 'html', 'error');
        }

        $model_vr_order = Model('vr_order');
        //取订单信息
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['buyer_id'] = getSession('member_id');
        $order_info = $model_vr_order->getOrderInfo($condition, '*', true);
        if (empty($order_info) || !in_array($order_info['order_state'], array(ORDER_STATE_NEW, ORDER_STATE_PAY))) {
            showMessage('未找到需要支付的订单', getUrl('shop/member_order'), 'html', 'error');
        }

        //定义输出数组
        $pay = array();
        //订单总支付金额
        $pay['pay_amount_online'] = 0;
        //充值卡支付金额(之前支付中止，余额被锁定)
        $pay['payd_rcb_amount'] = 0;
        //预存款支付金额(之前支付中止，余额被锁定)
        $pay['payd_pd_amount'] = 0;
        //还需在线支付金额(之前支付中止，余额被锁定)
        $pay['payd_diff_amount'] = 0;
        //账户可用金额
        $pay['member_pd'] = 0;
        $pay['member_rcb'] = 0;

        $pay['pay_amount_online'] = floatval($order_info['order_amount']);
        $pay['payd_rcb_amount'] = floatval($order_info['rcb_amount']);
        $pay['payd_pd_amount'] = floatval($order_info['pd_amount']);
        $pay['payd_diff_amount'] = $order_info['order_amount'] - $order_info['rcb_amount'] - $order_info['pd_amount'];

        Tpl::output('order_info', $order_info);

        //如果所需支付金额为0，转到支付成功页
        if ($pay['payd_diff_amount'] == 0) {
            redirect(getUrl('shop/buy_virtual/pay_ok') . '?order_sn=' . $order_info['order_sn'] . '&order_id=' . $order_info['order_id'] . '&order_amount=' . ncPriceFormat($order_info['order_amount']));
        }

        //是否显示站内余额操作(如果以前没有使用站内余额支付过且非货到付款)
        $pay['if_show_pdrcb_select'] = ($pay['payd_rcb_amount'] == 0 && $pay['payd_pd_amount'] == 0);

        //显示支付接口列表
        $model_payment = Model('payment');
        $condition = array();
        $payment_list = $model_payment->getPaymentOpenList($condition);
        if (!empty($payment_list)) {
            unset($payment_list['predeposit']);
            unset($payment_list['offline']);
        }
        if (empty($payment_list)) {
            showMessage('暂未找到合适的支付方式', getUrl('shop/member_vr_order'), 'html', 'error');
        }
        Tpl::output('payment_list', $payment_list);

        if ($pay['if_show_pdrcb_select']) {
            //显示预存款、支付密码、充值卡
            $available_predeposit = $available_rc_balance = 0;
            $buyer_info = Model('member')->getMemberInfoByID(getSession('member_id'));
            if (floatval($buyer_info['available_predeposit']) > 0) {
                $pay['member_pd'] = $buyer_info['available_predeposit'];
            }
            if (floatval($buyer_info['available_rc_balance']) > 0) {
                $pay['member_rcb'] = $buyer_info['available_rc_balance'];
            }
            $pay['member_paypwd'] = $buyer_info['member_paypwd'] ? true : false;
        }
        //标识购买流程执行步骤
        Tpl::output('buy_step', 'step3');

        Tpl::output('pay', $pay);

        //Tpl::showpage('buy_virtual_step3');
        $this->view->render('buy_virtual', 'buy_virtual_step3');
        $this->view->disable();
    }

    /**
     * 支付成功页面
     */
    public function pay_okAction()
    {
        $order_sn = $_GET['order_sn'];
        if (!preg_match('/^\d{18}$/', $order_sn)) {
            showMessage('该订单不存在', getUrl('shop/member_vrorder'), 'html', 'error');
        }

        //处理服务和聊天卡
        $vr_order_info = VrOrder::findFirst("order_sn=" . $order_sn);
        if ($vr_order_info !== false) {
            if ($vr_order_info->getOrderState() == ORDER_STATE_PAY) {
                $vr_order_info = $vr_order_info->toArray();
                change_vr_order_state($vr_order_info);
            }
        }


        //Tpl::showpage('buy_virtual_step4');
        $this->view->render('buy_virtual', 'buy_virtual_step4');
        $this->view->disable();
    }
}