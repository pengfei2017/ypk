<?php
/**
 * 虚拟商品购买
 */

namespace Ypk\Modules\Mobile\Controllers;


class MemberPdBuyController extends MobileMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 虚拟订单第三步，产生订单
     * POST
     * 传入：goods_id:商品ID，quantity:购买数量，buyer_phone：接收手机，buyer_msg:下单留言,pd_pay:是否使用预存款支付0否1是，password：支付密码
     */
    public function buy_step3Action()
    {
        $pdr_sn = $_POST['pdr_sn'];
        $payment_code = $_POST['payment_code'];
        $url = getUrl('shop/predeposit');

        if (!preg_match('/^\d{18}$/', $pdr_sn)) {
            showMessage('参数错误', $url, 'html', 'error');
        }

        $logic_payment = Logic('payment');
        $result = $logic_payment->getPaymentInfo($payment_code);
        if (!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        $payment_info = $result['data'];

        $result = $logic_payment->getPdOrderInfo($pdr_sn, getSession('member_id'));
        if (!$result['state']) {
            showMessage($result['msg'], $url, 'html', 'error');
        }
        if ($result['data']['pdr_payment_state'] || empty($result['data']['api_pay_amount'])) {
            showMessage('该充值单不需要支付', $url, 'html', 'error');
        }

        //转到第三方API支付
        $this->_api_pay($result['data'], $payment_info);
        if (!$result['state']) {
            output_error($result['msg']);
        } else {
            output_data($result['data']);
        }
    }

    /**
     * 预存款充值下单时显示支付页面
     */
    public function pd_payAction()
    {
        $pay_sn = $_POST['pay_sn'];
        if (!preg_match('/^\d{18}$/', $pay_sn)) {
            output_error('参数错误');
        }

        //查询支付单信息
        $model_order = Model('predeposit');
        $pd_info = $model_order->getPdRechargeInfo(array('pdr_sn' => $pay_sn, 'pdr_member_id' => $this->member_info['member_id']));
        if (empty($pd_info)) {
            output_error('该充值单号不存在');
        }
        if (intval($pd_info['pdr_payment_state'])) {
            output_error('您的订单已经支付，请勿重复支付');
        }

        //定义输出数组
        $pay = array();
        $pay['pd_info'] = $pd_info;
        $pay['pay_amount'] = $pd_info['pdr_amount'];

        $payment_list = Model('mb_payment')->getMbPaymentOpenList();
        if (!empty($payment_list)) {
            foreach ($payment_list as $k => $value) {
                if ($value['payment_code'] == 'wxpay') {
                    unset($payment_list[$k]);
                    continue;
                }
                unset($payment_list[$k]['payment_id']);
                unset($payment_list[$k]['payment_config']);
                unset($payment_list[$k]['payment_state']);
                unset($payment_list[$k]['payment_state_text']);
            }
        }
        //显示预存款、支付密码、充值卡
        $pay['payment_list'] = $payment_list ? array_values($payment_list) : array();
        output_data(array('pay_info' => $pay));
    }

}


