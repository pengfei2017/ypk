<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/26
 * Time: 13:10
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Log;
use Ypk\Models\Goods;
use Ypk\Models\Member;
use Ypk\Models\MemberBuyServiceNum;
use Ypk\Models\MemberChatCard;
use Ypk\Models\OrderGoods;
use Ypk\Models\Orders;
use Ypk\Models\Store;
use Ypk\QueueClient;
use Ypk\Sms;
use Ypk\Tpl;
use Ypk\Validate;

class BuyController extends BaseBuyController
{

    public function initialize()
    {
        parent::initialize();
        getTranslation('home_cart_index');
        if (!getSession('member_id')) {
            redirect(getUrl('member/login/index'));
        }
        //验证该会员是否禁止购买
        if (!getSession('is_buy')) {
            showMessage(getLang('cart_buy_noallow'), '', 'html', 'error');
        }
        Tpl::output('hidden_rtoolbar_cart', 1);
        $this->view->setVar('hidden_rtoolbar_cart', 1);

        Tpl::output('setting_config', $GLOBALS['setting_config']);
        $this->view->setVar('setting_config', $GLOBALS['setting_config']);
    }

    /**
     * 实物商品 购物车、直接购买第一步:选择收获地址和配送方式
     */
    public function buy_step1Action()
    {

        //虚拟商品购买分流
        $this->_buy_branch($_POST);

        //得到购买数据
        $logic_buy = Logic('buy');
        $result = $logic_buy->buyStep1($_POST['cart_id'], $_POST['ifcart'], getSession('member_id'), getSession('store_id'), $_POST['jjg'], $this->member_info['orderdiscount'], $this->member_info['level'], $_POST['ifchain']);
        if (!$result['state']) {
            showMessage($result['msg'], '', 'html', 'error');
        } else {
            $result = $result['data'];
        }
        // 加价购
        Tpl::output('jjgValidSkus', $result['jjgValidSkus']);
        Tpl::output('jjgStoreCosts', $result['jjgStoreCosts']);
        $this->view->setVar('jjgValidSkus', $result['jjgValidSkus']);
        $this->view->setVar('jjgStoreCosts', $result['jjgStoreCosts']);

        //商品金额计算(分别对每个商品/优惠套装小计、每个医生小计)
        Tpl::output('store_cart_list', $result['store_cart_list']);
        Tpl::output('store_goods_total', $result['store_goods_total']);
        $this->view->setVar('store_cart_list', $result['store_cart_list']);
        $this->view->setVar('store_goods_total', $result['store_goods_total']);

        //取得医生优惠 - 满即送(赠品列表，医生满送规则列表)
        Tpl::output('store_premiums_list', $result['store_premiums_list']);
        Tpl::output('store_mansong_rule_list', $result['store_mansong_rule_list']);
        $this->view->setVar('store_premiums_list', $result['store_premiums_list']);
        $this->view->setVar('store_mansong_rule_list', $result['store_mansong_rule_list']);

        //返回医生可用的代金券
        Tpl::output('store_voucher_list', $result['store_voucher_list']);
        $this->view->setVar('store_voucher_list', $result['store_voucher_list']);

        //返回平台可用红包
        Tpl::output('rpt_list_json', json_encode($result['rpt_list']));
        $this->view->setVar('rpt_list_json', json_encode($result['rpt_list']));

        //输出符合满X元包邮条件的医生ID及包邮设置信息
        Tpl::output('cancel_calc_sid_list', $result['cancel_calc_sid_list']);
        $this->view->setVar('cancel_calc_sid_list', $result['cancel_calc_sid_list']);

        //将商品ID、数量、运费模板、运费序列化，加密，输出到模板，选择地区AJAX计算运费时作为参数使用
        Tpl::output('freight_hash', $result['freight_list']);
        $this->view->setVar('freight_hash', $result['freight_list']);

        //输出用户默认收货地址
        if (!$_POST['ifchain']) {
            Tpl::output('address_info', $result['address_info']);
            $this->view->setVar('address_info', $result['address_info']);
        }

        //输出有货到付款时，在线支付和货到付款及每种支付下商品数量和详细列表
        Tpl::output('pay_goods_list', $result['pay_goods_list']);
        Tpl::output('ifshow_offpay', $result['ifshow_offpay']);
        Tpl::output('deny_edit_payment', $result['deny_edit_payment']);
        $this->view->setVar('pay_goods_list', $result['pay_goods_list']);
        $this->view->setVar('ifshow_offpay', $result['ifshow_offpay']);
        $this->view->setVar('deny_edit_payment', $result['deny_edit_payment']);

        //输出是否有门店自提支付
        Tpl::output('ifshow_chainpay', $result['ifshow_chainpay']);
        Tpl::output('chain_store_id', $result['chain_store_id']);
        $this->view->setVar('ifshow_chainpay', $result['ifshow_chainpay']);
        $this->view->setVar('chain_store_id', $result['chain_store_id']);

        //不提供增值税发票时抛出true(模板使用)
        Tpl::output('vat_deny', $result['vat_deny']);
        $this->view->setVar('vat_deny', $result['vat_deny']);

        //增值税发票哈希值(php验证使用)
        Tpl::output('vat_hash', $result['vat_hash']);
        $this->view->setVar('vat_hash', $result['vat_hash']);

        //输出默认使用的发票信息
        Tpl::output('inv_info', $result['inv_info']);
        $this->view->setVar('inv_info', $result['inv_info']);

        //删除购物车无效商品
        $logic_buy->delCart($_POST['ifcart'], getSession('member_id'), $_POST['invalid_cart']);

        //标识购买流程执行步骤
        Tpl::output('buy_step', 'step2');
        $this->view->setVar('buy_step', 'step2');

        Tpl::output('ifcart', $_POST['ifcart']);
        $this->view->setVar('ifcart', $_POST['ifcart']);

        Tpl::output('ifchain', $_POST['ifchain']);
        $this->view->setVar('ifchain', $_POST['ifchain']);

        //输出会员折扣
        Tpl::output('zk_list', $result['zk_list']);
        $this->view->setVar('zk_list', $result['zk_list']);

        //医生信息
        $store_list = Model('store')->getStoreMemberIDList(array_keys($result['store_cart_list']), 'store_id,member_id,store_domain,is_own_shop');
        Tpl::output('store_list', $store_list);
        $this->view->setVar('store_list', $store_list);

        $current_goods_info = current($result['store_cart_list']);
        Tpl::output('current_goods_info', $current_goods_info[0]);
        $this->view->setVar('current_goods_info', $current_goods_info[0]);

        //Tpl::showpage('buy_step1'); //调用前端的显示模版
    }

    /**
     * 生成订单
     *
     */
    public function buy_step2Action()
    {
        $logic_buy = logic('buy');
        $result = $logic_buy->buyStep2($_POST, getSession('member_id'), getSession('member_name'), getSession('member_email'), $this->member_info['orderdiscount'], $this->member_info['level']);
        if (!$result['state']) {
            showMessage($result['msg'], getUrl('shop/cart'), 'html', 'error');
        }

        //转向到商城支付页面
        redirect(getUrl('shop/buy/pay', array('pay_sn' => $result['data']['pay_sn'])));
    }

    /**
     * 下单时支付页面
     */
    public function payAction()
    {
        $pay_sn = $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/', $pay_sn)) {
            showMessage(getLang('cart_order_pay_not_exists'), getUrl('shop/member_order'), 'html', 'error');
        }

        //查询支付单信息
        $model_order = Model('order');
        $pay_info = $model_order->getOrderPayInfo(array('pay_sn' => $pay_sn, 'buyer_id' => getSession('member_id')), true);
        if (empty($pay_info)) {
            showMessage(getLang('cart_order_pay_not_exists'), getUrl('shop/member_order'), 'html', 'error');
        }
        Tpl::output('pay_info', $pay_info);
        $this->view->setVar('pay_info', $pay_info);

        //取子订单列表
        $condition = array();
        $condition['pay_sn'] = $pay_sn;
        $condition['order_state'] = array('in', array(ORDER_STATE_NEW, ORDER_STATE_PAY));
        $order_list = $model_order->getOrderList($condition, '', '*', '', '', array(), true);
        if (empty($order_list)) {
            showMessage('未找到需要支付的订单', getUrl('shop/member_order'), 'html', 'error');
        }

        //取特殊类订单信息
        $this->_getOrderExtendList($order_list);
        //处理预订单重复支付问题
        if ($order_list[0]['if_buyer_repay'] && $order_list[0]['pay_sn1'] == '') {
            $pay_sn_new = Logic('buy_1')->makePaySn(getSession('member_id'));
            $order_pay = array();
            $order_pay['pay_sn'] = $pay_sn_new;
            $order_pay['buyer_id'] = getSession('member_id');
            $order_pay_id = $model_order->addOrderPay($order_pay);
            if (!$order_pay_id) {
                showMessage('支付失败', getUrl('shop/member_order'), 'html', 'error');
            }
            $update = $model_order->editOrder(array('pay_sn' => $pay_sn_new, 'pay_sn1' => $pay_sn), array('order_id' => $order_list[0]['order_id'], 'order_type' => 2));
            if (!$update) {
                showMessage('支付失败', getUrl('shop/member_order'), 'html', 'error');
            } else {
                redirect(getUrl('shop/buy/pay', array('pay_sn' => $pay_sn_new)));
                exit;
            }
        }

        //定义输出数组
        $pay = array();
        //支付提示主信息
        $pay['order_remind'] = '';
        //重新计算支付金额
        $pay['pay_amount_online'] = 0;
        $pay['pay_amount_offline'] = 0;
        //订单总支付金额(不包含货到付款)
        $pay['pay_amount'] = 0;
        //充值卡支付金额(之前支付中止，余额被锁定)
        $pay['payd_rcb_amount'] = 0;
        //预存款支付金额(之前支付中止，余额被锁定)
        $pay['payd_pd_amount'] = 0;
        //还需在线支付金额(之前支付中止，余额被锁定)
        $pay['payd_diff_amount'] = 0;
        //账户可用金额
        $pay['member_pd'] = 0;
        $pay['member_rcb'] = 0;

        $logic_order = Logic('order');

        //计算相关支付金额
        foreach ($order_list as $key => $order_info) {
            if (!in_array($order_info['payment_code'], array('offline', 'chain'))) {
                if ($order_info['order_state'] == ORDER_STATE_NEW) {
                    $pay['pay_amount_online'] += $order_info['order_amount'];
                    $pay['payd_rcb_amount'] += $order_info['rcb_amount'];
                    $pay['payd_pd_amount'] += $order_info['pd_amount'];
                    $pay['payd_diff_amount'] += $order_info['order_amount'] - $order_info['rcb_amount'] - $order_info['pd_amount'];
                }
                $pay['pay_amount'] += $order_info['order_amount'];
            } else {
                $pay['pay_amount_offline'] += $order_info['order_amount'];
            }
            //显示支付方式
            if ($order_info['payment_code'] == 'offline') {
                $order_list[$key]['payment_type'] = '货到付款';
            } elseif ($order_info['payment_code'] == 'chain') {
                $order_list[$key]['payment_type'] = '门店支付';
            } else {
                $order_list[$key]['payment_type'] = '在线支付';
            }
        }
        if ($order_info['chain_id'] && $order_info['payment_code'] == 'chain') {
            $order_list[0]['order_remind'] = '下单成功，请在' . CHAIN_ORDER_PAYPUT_DAY . '日内前往门店提货，逾期订单将自动取消。';
            $flag_chain = 1;
        }

        Tpl::output('order_list', $order_list);
        $this->view->setVar('order_list', $order_list);

        //如果线上线下支付金额都为0，转到支付成功页
        if (empty($pay['pay_amount_online']) && empty($pay['pay_amount_offline'])) {
            redirect(getUrl('shop/buy/pay_ok', array('pay_sn' => $pay_sn, 'is_chain' => $flag_chain, 'pay_amount' => ncPriceFormat($order_info['order_amount']))));
        }

        //是否显示站内余额操作(如果以前没有使用站内余额支付过且非货到付款)
        $pay['if_show_pdrcb_select'] = ($pay['pay_amount_offline'] == 0 && $pay['payd_rcb_amount'] == 0 && $pay['payd_pd_amount'] == 0);

        //输出订单描述
        if (empty($pay['pay_amount_online'])) {
            $pay['order_remind'] = '下单成功，我们会尽快为您发货，请保持电话畅通。';
        } elseif (empty($pay['pay_amount_offline'])) {
            $pay['order_remind'] = '请您在' . (ORDER_AUTO_CANCEL_TIME * 60) . '分钟内完成支付，逾期订单将自动取消。 ';
        } else {
            $pay['order_remind'] = '部分商品需要在线支付，请您在' . (ORDER_AUTO_CANCEL_TIME * 60) . '分钟内完成支付，逾期订单将自动取消。';
        }
        if (!empty($order_list[0]['order_remind'])) {
            $pay['order_remind'] = $order_list[0]['order_remind'];
        }

        if ($pay['pay_amount_online'] > 0) {
            //显示支付接口列表
            $model_payment = Model('payment');
            $condition = array();
            $payment_list = $model_payment->getPaymentOpenList($condition);
            if (!empty($payment_list)) {
                unset($payment_list['predeposit']);
                unset($payment_list['offline']);
            }
            if (empty($payment_list)) {
                showMessage('暂未找到合适的支付方式', getUrl('shop/member_order'), 'html', 'error');
            }
            Tpl::output('payment_list', $payment_list);
            $this->view->setVar('payment_list', $payment_list);
        }
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

        Tpl::output('pay', $pay);
        $this->view->setVar('pay', $pay);

        //标识 购买流程执行第几步
        Tpl::output('buy_step', 'step3');
        $this->view->setVar('buy_step', 'step3');
        //Tpl::showpage('buy_step2');

        $this->view->render('buy', 'buy_step2');
        $this->view->disable();
    }

    /**
     * 特殊订单支付最后一步界面展示（目前只有预定）
     * @param unknown $order_list
     */
    private function _getOrderExtendList(& $order_list)
    {
        //预定订单
        if ($order_list[0]['order_type'] == 2) {
            $order_info = $order_list[0];
            $result = Logic('order_book')->getOrderBookInfo($order_info);
            if (!$result['data']['if_buyer_pay']) {
                showMessage('未找到需要支付的订单', getUrl('shop/member_order'), 'html', 'error');
            }
            $order_list[0] = $result['data'];
            $order_list[0]['order_amount'] = $order_list[0]['pay_amount'];
            $order_list[0]['order_state'] = ORDER_STATE_NEW;
            if ($order_list[0]['if_buyer_repay']) {
                $order_list[0]['order_remind'] = '请您在 ' . date('Y-m-d H:i', $order_list[0]['book_list'][1]['book_end_time'] + 1) . ' 之前完成支付，否则订单会被自动取消。';
            }
        }
    }

    /**
     * 预存款充值下单时显示支付页面
     */
    public function pd_payAction()
    {
        $pay_sn = $_GET['pay_sn'];
        if (!preg_match('/^\d{18}$/', $pay_sn)) {
            showMessage(getLang('para_error'), getUrl('shop/predeposit'), 'html', 'error');
        }

        //查询支付单信息
        $model_order = Model('predeposit');
        $pd_info = $model_order->getPdRechargeInfo(array('pdr_sn' => $pay_sn, 'pdr_member_id' => getSession('member_id')));
        if (empty($pd_info)) {
            showMessage(getLang('para_error'), '', 'html', 'error');
        }
        if (intval($pd_info['pdr_payment_state'])) {
            showMessage('您的订单已经支付，请勿重复支付', getUrl('shop/predeposit'), 'html', 'error');
        }
        Tpl::output('pdr_info', $pd_info);
        $this->view->setVar('pdr_info', $pd_info);

        //显示支付接口列表
        $model_payment = Model('payment');
        $condition = array();
        $condition['payment_code'] = array('not in', array('offline', 'predeposit'));//'wxpay', 'tenpay'
        $condition['payment_state'] = 1;
        $payment_list = $model_payment->getPaymentList($condition);
        if (empty($payment_list)) {
            showMessage('暂未找到合适的支付方式', getUrl('shop/predeposit'), 'html', 'error');
        }
        Tpl::output('payment_list', $payment_list);
        $this->view->setVar('payment_list', $payment_list);

        //标识 购买流程执行第几步
        Tpl::output('buy_step', 'step3');
        $this->view->setVar('buy_step', 'step3');
        //Tpl::showpage('predeposit_pay');

        $this->view->render('buy', 'predeposit_pay');
        $this->view->disable();
    }

    /**
     * 支付成功页面
     */
    public function pay_okAction()
    {
        $pay_sn = $_GET['pay_sn'];

        //判断订单商品是否包含聊天卡，如果是则把购买聊天卡写入“member_chat_card”表
        $order_info = Orders::findFirst("pay_sn=" . $pay_sn);
        if ($order_info !== false) {
            $order_id = $order_info->getOrderId(); //获取订单id
            if (!empty($order_id)) {
                $order_goods_list = OrderGoods::find("order_id=" . $order_id);
                if (count($order_goods_list) > 0) {
                    $order_goods_list = $order_goods_list->toArray();
                    $is_vr_flag = false;
                    foreach ($order_goods_list as $order_goods) {
                        $goods_info = Goods::findFirst("goods_id=" . $order_goods['goods_id']);
                        $store_info = Store::findFirst("store_id=" . $order_info->getStoreId()); //店铺实体信息
                        if ($goods_info && $goods_info->getGcId1() == 1076) { //表示购买的是聊天卡
                            $is_vr_flag = true;
                            $member_chat_card = new MemberChatCard();
                            $member_chat_card_array = array(
                                'member_id' => $order_info->getBuyerId(),
                                'order_id' => $order_info->getOrderId(),
                                'doctor_id' => $store_info->getMemberId(),
                                'is_use' => 0,
                                'how_lang_time' => intval($goods_info->getSpecName()),
                                'add_time' => time(),
                                'card_type' => 0
                            );

                            if ($member_chat_card->save($member_chat_card_array) == false) {
                                Log::record("客户购买聊天卡时，插入member_chat_card表时失败，数据是：" . json_encode($member_chat_card_array));
                            }

                            $doctor_chat_card = new MemberChatCard();
                            $doctor_chat_card_array = array(
                                'member_id' => $store_info->getMemberId(),
                                'order_id' => $order_info->getOrderId(),
                                'doctor_id' => $order_info->getBuyerId(),
                                'is_use' => 0,
                                'how_lang_time' => intval($goods_info->getSpecName()) + (3600 * 1),
                                'add_time' => time(),
                                'card_type' => 1
                            );
                            if ($doctor_chat_card->save($doctor_chat_card_array) == false) {
                                Log::record("医生获取聊天卡时，插入member_chat_card表时失败，数据是：" . json_encode($doctor_chat_card_array));
                            }
                            $order_model = Orders::findFirst("order_id=" . $order_id);
                            if ($order_model) {
                                $order_model->save(array('order_state' => ORDER_STATE_SUCCESS)); //如果购买的是聊天卡，直接把订单状态改为“已收货”
                            }
                            //调用四大计算方法
                            $order_info['order_type']='vr_order';
                            QueueClient::push('update_points_and_reward', $order_info);
                        }
                        if ($goods_info && $goods_info->getGcId1() == 1073) { //表示购买的是医疗服务
                            $is_vr_flag = true;
                            $number_arr = array();

                            //循环生成用户编号
                            for ($i = 0; $i < $order_goods["goods_num"]; $i++) {
                                $min_id = MemberBuyServiceNum::minimum(array("goods_id = {$goods_info->getGoodsId()} and start_time = {$goods_info->getDoctorServiceStartTime()} and end_time = {$goods_info->getDoctorServiceEndTime()} and is_use = 0", 'column' => 'id'));
                                if (empty($min_id)) {
                                    break;
                                }
                                $member_buy_service_num_info = MemberBuyServiceNum::findFirst("id=" . $min_id);
                                if ($member_buy_service_num_info !== false) {
                                    $member_buy_service_num_array = array(
                                        'buyer_id' => $order_info->getBuyerId(),
                                        'is_use' => 1,
                                        'add_time' => time()
                                    );
                                    if ($member_buy_service_num_info->save($member_buy_service_num_array) == false) {
                                        Log::record("购买医疗服务时，插入member_buy_service_num表时失败，获取的编号是{$min_id}，数据是：" . json_encode($member_buy_service_num_array));
                                    }
                                }
                                $number_arr[] = $member_buy_service_num_info->getBuyerNumber() . '号';
                            }

                            //如果购买的是医疗服务，则把订单状态直接改为“已发货”
                            $order_model = Orders::findFirst("order_id=" . $order_id);
                            if ($order_model) {
                                $order_model->save(array('order_state' => ORDER_STATE_SEND)); //如果购买的是聊天卡，直接把订单状态改为“已收货”
                            }

                            //向用户发送手机短信
                            $member_info = Member::findFirst("member_id=" . $order_info->getBuyerId()); //买家个人信息
                            $doctor_info = Member::findFirst("member_id=" . $store_info->getMemberId()); //医生个人信息
                            if ($member_info !== false && !empty($member_info->getMemberMobile())) {
                                $send = new Sms();
                                $doctor_name = "该";
                                if ($doctor_info !== false) {
                                    $doctor_name = $doctor_info->getMemberName();
                                }
                                $msg_str = '欢迎您使用逸陪康在线医疗服务平台，您已成功购买' . $doctor_name . '医生的' . $goods_info->getGoodsName() . '服务，服务时间是：' . date('Y-m-d H:i:s', $goods_info->getDoctorServiceStartTime()) . '-' . date('Y-m-d H:i:s', $goods_info->getDoctorServiceEndTime()) . '，地点是：' . $goods_info->getHispitalAddress() . $goods_info->getDepartAddress() . '，您的编号是：' . implode('、', $number_arr) . '。【' . $goods_info->getGoodsName() . '】';
                                //$send->send($member_info->getMemberMobile(), '您已成功购买"' . $goods_info->getGoodsName() . '"服务，编号是：' . implode('、', $number_arr) . '【' . $goods_info->getGoodsName() . '】');
                                $send->send($member_info->getMemberMobile(), $msg_str);
                            }
                        }
                    }
                }
            }
        }

        if (!preg_match('/^\d{18}$/', $pay_sn)) {
            showMessage(getLang('cart_order_pay_not_exists'), getUrl('shop/member_order'), 'html', 'error');
        }

        //查询支付单信息
        $model_order = Model('order');
        $pay_info = $model_order->getOrderPayInfo(array('pay_sn' => $pay_sn, 'buyer_id' => getSession('member_id')));
        if (empty($pay_info)) {
            showMessage(getLang('cart_order_pay_not_exists'), getUrl('shop/member_order'), 'html', 'error');
        }
        Tpl::output('pay_info', $pay_info);
        $this->view->setVar('pay_info', $pay_info);

        Tpl::output('buy_step', 'step4');
        $this->view->setVar('buy_step', 'step4');
        //Tpl::showpage('buy_step3');

        $this->view->render('buy', 'buy_step3');
        $this->view->disable();
    }

    /**
     * 加载买家收货地址
     *
     */
    public function load_addrAction()
    {
        $model_addr = Model('address');
        //如果传入ID，先删除再查询
        if (!empty($_GET['id']) && intval($_GET['id']) > 0) {
            $model_addr->delAddress(array('address_id' => intval($_GET['id']), 'member_id' => getSession('member_id')));
        }
        $condition = array();
        $condition['member_id'] = getSession('member_id');
        if (!getConfig('delivery_isuse')) {
            $condition['dlyp_id'] = 0;
            $order = 'dlyp_id asc,address_id desc';
        }
        $list = $model_addr->getAddressList($condition, $order);
        Tpl::output('address_list', $list);
        $this->view->setVar('address_list', $list);
        //Tpl::showpage('buy_address.load', 'null_layout');

        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'buy_address_load');
        $this->view->disable();
    }

    /**
     * 载入门店自提点
     */
    public function load_chainAction()
    {
        $list = Model('chain')->getChainList(array('area_id' => intval($_GET['area_id']), 'store_id' => intval($_GET['store_id'])),
            'chain_id,chain_name,area_info,chain_address');
        echo $_GET['callback'] . '(' . json_encode($list) . ')';
    }

    /**
     * 选择不同地区时，异步处理并返回每个医生总运费以及本地区是否能使用货到付款
     * 如果医生统一设置了满免运费规则，则运费模板无效
     * 如果医生未设置满免规则，且使用运费模板，按运费模板计算，如果其中有商品使用相同的运费模板，则两种商品数量相加后再应用该运费模板计算（即作为一种商品算运费）
     * 如果未找到运费模板，按免运费处理
     * 如果没有使用运费模板，商品运费按快递价格计算，运费不随购买数量增加
     */
    public function change_addrAction()
    {
        $logic_buy = Logic('buy');
        if (empty($_POST['city_id'])) {
            $_POST['city_id'] = $_POST['area_id'];
        }

        $data = $logic_buy->changeAddr($_POST['freight_hash'], $_POST['city_id'], $_POST['area_id'], getSession('member_id'));

        if (!empty($data)) {
            exit(json_encode($data));
        } else {
            exit('error');
        }
    }

    /**
     * 根据门店自提站ID计算商品库存
     */
    public function change_chainAction()
    {
        $logic_buy = Logic('buy');
        $data = $logic_buy->changeChain($_POST['chain_id'], $_POST['product']);
        if (!empty($data)) {
            exit(json_encode($data));
        } else {
            exit('error');
        }
    }

    /**
     * 添加新的收货地址
     *
     */
    public function add_addrAction()
    {
        $model_addr = Model('address');
        if (chksubmit()) {
            $count = $model_addr->getAddressCount(array('member_id' => getSession('member_id')));
            if ($count >= 20) {
                exit(json_encode(array('state' => false, 'msg' => '最多允许添加20个有效地址')));
            }
            //验证表单信息
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["true_name"], "require" => "true", "message" => getLang('cart_step1_input_receiver')),
                array("input" => $_POST["area_id"], "require" => "true", "validator" => "Number", "message" => getLang('cart_step1_choose_area'))
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                exit(json_encode(array('state' => false, 'msg' => $error)));
            }
            $data = array();
            $data['member_id'] = getSession('member_id');
            $data['true_name'] = $_POST['true_name'];
            $data['area_id'] = intval($_POST['area_id']);
            $data['city_id'] = intval($_POST['city_id']);
            $data['area_info'] = $_POST['region'];
            $data['address'] = $_POST['address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $insert_id = $model_addr->addAddress($data);
            if ($insert_id) {
                exit(json_encode(array('state' => true, 'addr_id' => $insert_id)));
            } else {
                exit(json_encode(array('state' => false, 'msg' => '新地址添加失败')));
            }
        } else {
            //Tpl::showpage('buy_address.add', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('no_layout', 'buy_address_add');
            $this->view->disable();
        }
    }

    /**
     * 添加新的门店自提点
     *
     */
    public function add_chainAction()
    {
        //Tpl::showpage('buy_address.add_chain', 'null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'buy_address_add_chain');
        $this->view->disable();
    }

    /**
     * 加载买家发票列表，最多显示10条
     *
     */
    public function load_invAction()
    {
        $logic_buy = Logic('buy');

        $condition = array();
        if ($logic_buy->buyDecrypt($_GET['vat_hash'], getSession('member_id')) == 'allow_vat') {
        } else {
            Tpl::output('vat_deny', true);
            $this->view->setVar('vat_deny', true);
            $condition['inv_state'] = 1;
        }
        $condition['member_id'] = getSession('member_id');

        $model_inv = Model('invoice');
        //如果传入ID，先删除再查询
        if (intval($_GET['del_id']) > 0) {
            $model_inv->delInv(array('inv_id' => intval($_GET['del_id']), 'member_id' => getSession('member_id')));
        }
        $list = $model_inv->getInvList($condition, 10);
        if (!empty($list)) {
            foreach ($list as $key => $value) {
                if ($value['inv_state'] == 1) {
                    $list[$key]['content'] = '普通发票' . ' ' . $value['inv_title'] . ' ' . $value['inv_content'];
                } else {
                    $list[$key]['content'] = '增值税发票' . ' ' . $value['inv_company'] . ' ' . $value['inv_code'] . ' ' . $value['inv_reg_addr'];
                }
            }
        }
        Tpl::output('inv_list', $list);
        $this->view->setVar('inv_list', $list);
        //Tpl::showpage('buy_invoice.load', 'null_layout');

        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'buy_invoice_load');
        $this->view->disable();
    }

    /**
     * 新增发票信息
     *
     */
    public function add_invAction()
    {
        $model_inv = Model('invoice');
        if (chksubmit()) {
            //如果是增值税发票验证表单信息
            if ($_POST['invoice_type'] == 2) {
                if (empty($_POST['inv_company']) || empty($_POST['inv_code']) || empty($_POST['inv_reg_addr'])) {
                    exit(json_encode(array('state' => false, 'msg' => getLang('nc_common_save_fail'))));
                }
            }
            $data = array();
            if ($_POST['invoice_type'] == 1) {
                $data['inv_state'] = 1;
                $data['inv_title'] = $_POST['inv_title_select'] == 'person' ? '个人' : $_POST['inv_title'];
                $data['inv_content'] = $_POST['inv_content'];
            } else {
                $data['inv_state'] = 2;
                $data['inv_company'] = $_POST['inv_company'];
                $data['inv_code'] = $_POST['inv_code'];
                $data['inv_reg_addr'] = $_POST['inv_reg_addr'];
                $data['inv_reg_phone'] = $_POST['inv_reg_phone'];
                $data['inv_reg_bname'] = $_POST['inv_reg_bname'];
                $data['inv_reg_baccount'] = $_POST['inv_reg_baccount'];
                $data['inv_rec_name'] = $_POST['inv_rec_name'];
                $data['inv_rec_mobphone'] = $_POST['inv_rec_mobphone'];
                $data['inv_rec_province'] = $_POST['vregion'];
                $data['inv_goto_addr'] = $_POST['inv_goto_addr'];
            }
            $data['member_id'] = getSession('member_id');
            $insert_id = $model_inv->addInv($data);
            if ($insert_id) {
                exit(json_encode(array('state' => 'success', 'id' => $insert_id)));
            } else {
                exit(json_encode(array('state' => 'fail', 'msg' => getLang('nc_common_save_fail'))));
            }
        } else {
            //Tpl::showpage('buy_address . add', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('no_layout', 'buy_address_add');
            $this->view->disable();
        }
    }

    /**
     * AJAX验证支付密码
     */
    public function check_pd_pwdAction()
    {
        if (empty($_GET['password'])) exit('0');
        $buyer_info = Model('member')->getMemberInfoByID(getSession('member_id'), 'member_paypwd');
        echo ($buyer_info['member_paypwd'] != '' && $buyer_info['member_paypwd'] === md5($_GET['password'])) ? '1' : '0';
        exit;
    }

    /**
     * F码验证
     */
    public function check_fcodeAction()
    {
        $result = Logic('buy')->checkFcode($_GET['goods_id'], $_GET['fcode']);
        echo $result['state'] ? '1' : '0';
        exit;
    }

    /**
     * 得到所购买的id和数量
     *
     */
    private function _parseItems($cart_id)
    {
        //存放所购商品ID和数量组成的键值对
        $buy_items = array();
        if (is_array($cart_id)) {
            foreach ($cart_id as $value) {
                if (preg_match_all(' /^(\d{1,10})\|(\d{1,6})$/', $value, $match)) {
                    $buy_items[$match[1][0]] = $match[2][0];
                }
            }
        }
        return $buy_items;
    }

    /**
     * 购买分流
     */
    private function _buy_branch($post)
    {
        if (!$post['ifcart']) {
            //取得购买商品信息
            $buy_items = $this->_parseItems($post['cart_id']);
            $goods_id = key($buy_items);
            $quantity = current($buy_items);

            $goods_info = Model('goods')->getGoodsOnlineInfoAndPromotionById($goods_id);
            if ($goods_info['is_virtual']) {
                redirect(getUrl('shop/buy_virtual/buy_step1', array('goods_id' => $goods_id, 'quantity' => $quantity)));
            }
        }
    }

}