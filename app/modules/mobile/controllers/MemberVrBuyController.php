<?php
/**
 * 虚拟商品购买
 */

namespace Ypk\Modules\Mobile\Controllers;

use Ypk\Models\Goods;
use Ypk\Models\GoodsBuyRecord;
use Ypk\Models\VrOrder;

class MemberVrBuyController extends MobileMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 虚拟商品购买第一步，设置购买数量
     * POST
     * 传入：cart_id:商品ID，quantity:购买数量
     */
    public function buy_step1Action()
    {
        $_POST['goods_id'] = $_POST['cart_id'];

        $logic_buy_virtual = Logic('buy_virtual');

		$goods_model=Goods::findFirst('goods_id='.$_POST['goods_id']);
        if($goods_model!==false){
            if (intval($goods_model->getGcId1()) == 1073) { //表示购买的是服务
                //先判断服务是否在当天已经被购买过
                $start_time = strtotime(date('Y-m-d 0:0:0.000')); //当天开始时间
                $end_time = strtotime(date('Y-m-d 23:59:59.999')); //当天结束时间
                $goods_buy_record_model = GoodsBuyRecord::findFirst("buyer_id=" . $this->member_info['member_id'] . " and goods_id=" . $_POST['goods_id'] . " and add_time>=" . $start_time . " and add_time<=" . $end_time);
                if ($goods_buy_record_model !== false) {
                    output_data(array(),array('res_msg' => 'have_buy'));
                    //showDialog('您今天已经购买此服务，请勿重复购买', getUrl('shop/goods/index', array('goods_id' => $result['goods_info']['goods_id'])));
                }
            }
        }

        $result = $logic_buy_virtual->getBuyStep2Data($_POST['goods_id'], $_POST['quantity'], $this->member_info['member_id']);
        if (!$result['state']) {
            output_error($result['msg']);
        } else {
            $result = $result['data'];
        }
        unset($result['member_info']);
        output_data($result);
    }

    /**
     * 虚拟商品购买第二步，设置接收手机号
     * POST
     * 传入：goods_id:商品ID，quantity:购买数量
     */
    public function buy_step2Action()
    {
        $logic_buy_virtual = Logic('buy_virtual');
        $result = $logic_buy_virtual->getBuyStep2Data($_POST['goods_id'], $_POST['quantity'], $this->member_info['member_id']);
        if (!$result['state']) {
            output_error($result['msg']);
        } else {
            $result = $result['data'];
            $member_info = array();
            $member_info['member_mobile'] = $result['member_info']['member_mobile'];
            $member_info['available_predeposit'] = $result['member_info']['available_predeposit'];
            $member_info['available_rc_balance'] = $result['member_info']['available_rc_balance'];
            unset($result['member_info']);
            $result['member_info'] = $member_info;
            output_data($result);
        }
    }

    /**
     * 虚拟订单第三步，产生订单
     * POST
     * 传入：goods_id:商品ID，quantity:购买数量，buyer_phone：接收手机，buyer_msg:下单留言,pd_pay:是否使用预存款支付0否1是，password：支付密码
     */
    public function buy_step3Action()
    {
		//先判断服务是否在当天已经被购买过
        $goods_info = Goods::findFirst("goods_id=" . $_POST['goods_id']);
        if ($goods_info !== false) {
            if (intval($goods_info->getGcId1()) == 1073) { //表示购买的是服务
                //先判断服务是否在当天已经被购买过
                $start_time = strtotime(date('Y-m-d 0:0:0.000')); //当天开始时间
                $end_time = strtotime(date('Y-m-d 23:59:59.999')); //当天结束时间
                $goods_buy_record_model = GoodsBuyRecord::findFirst("buyer_id=" . $this->member_info['member_id'] . " and goods_id=" . $_POST['goods_id'] . " and add_time>=" . $start_time . " and add_time<=" . $end_time);
                if ($goods_buy_record_model !== false) {
                    output_data(array(), array('res_msg' => 'have_buy'));
                    //showDialog('您今天已经购买此服务，请勿重复购买', getUrl('shop/goods/index', array('goods_id' => $result['goods_info']['goods_id'])));
                }
            }
        }

        $logic_buy_virtual = Logic('buy_virtual');
        $input = array();
        $input['goods_id'] = $_POST['goods_id'];
        $input['quantity'] = $_POST['quantity'];
        $input['buyer_phone'] = $_POST['buyer_phone'];
        $input['buyer_msg'] = $_POST['buyer_msg'];
        //支付密码
        $input['password'] = $_POST['password'];

        //是否使用充值卡支付0是/1否
        $input['rcb_pay'] = intval($_POST['rcb_pay']);

        //是否使用预存款支付0是/1否
        $input['pd_pay'] = intval($_POST['pd_pay']);

        $input['order_from'] = 2;
        $result = $logic_buy_virtual->buyStep3($input, $this->member_info['member_id']);
        if (!$result['state']) {
            output_error($result['msg']);
        } else {
            output_data($result['data']);
        }
    }

    /**
     * 虚拟订单支付(新接口)，返回应付金额和支付方式
     */
    public function payAction()
    {
        $order_sn = $_POST['pay_sn'];
        if (!preg_match('/^\d{18}$/', $order_sn)) {
            output_error('该订单不存在');
        }

        $model_vr_order = Model('vr_order');
        //取订单信息
        $condition = array();
        $condition['order_sn'] = $order_sn;
        $condition['buyer_id'] = $this->member_info['member_id'];
        $order_info = $model_vr_order->getOrderInfo($condition, '*', true);
        if (empty($order_info) || !in_array($order_info['order_state'], array(ORDER_STATE_NEW, ORDER_STATE_PAY))) {
            output_error('该订单不存在');
        }

        //定义输出数组
        $pay = array();
        //应支付金额
        $pay['pay_amount'] = 0;
        //已支付金额(之前支付中止，余额被锁定)
        $pay['payed_amount'] = 0;
        //账户可用金额
        $pay['member_available_pd'] = 0;
        $pay['member_available_rcb'] = 0;

        $logic_order = Logic('order');

        //计算相关支付金额
        $pay['payed_amount'] = $order_info['rcb_amount'] + $order_info['pd_amount'];
        $pay['pay_amount'] = $order_info['order_amount'] - $order_info['rcb_amount'] - $order_info['pd_amount'];
        if (empty($pay['pay_amount'])) {
            output_error('订单重复支付');
        }

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
        $pay['member_available_pd'] = $this->member_info['available_predeposit'];
        $pay['member_available_rcb'] = $this->member_info['available_rc_balance'];
        $pay['member_paypwd'] = $this->member_info['member_paypwd'] ? true : false;
//         $pay['order_sn'] = $order_sn;
        $pay['payment_list'] = $payment_list ? array_values($payment_list) : array();
        output_data(array('pay_info' => $pay));
    }
}


