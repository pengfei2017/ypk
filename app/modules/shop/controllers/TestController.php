<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/23
 * Time: 11:31
 */

namespace Ypk\Modules\Shop\Controllers;


use Phalcon\Mvc\Controller;
use Ypk\Models\Orders;
use Ypk\QueueClient;

class TestController extends Controller
{
    public function indexAction()
    {
        $a = 'attach={"order_type":"real_order","payment_code":"tenpay","body":"230536436386770105","subject":"\u5b9e\u7269\u8ba2\u5355_230536436386770105","spbill_create_ip":"123.149.127.185","logistics_type":"EXPRESS","logistics_payment":"BUYER_PAY","receive_name":"123456a","receive_address":"N","receive_zip":"N","receive_phone":"N","receive_mobile":"N"}&body=230536436386770105&fee_type=1&input_charset=UTF-8&notify_url=http://180.76.141.156/shop/payment/notify&out_trade_no=230536436386770105&partner=1900000109&product_fee=2&return_url=http://180.76.141.156/shop/payment/return&sign_type=MD5&spbill_create_ip=123.149.127.185&subject=实物订单_230536436386770105&total_fee=2&trade_mode=1&transport_fee=0&key=8934e7d15453e97507ef794cf7b0519d';
        $b = 'attach={"order_type":"real_order","payment_code":"tenpay","body":"230536436386770105","subject":"\u5b9e\u7269\u8ba2\u5355_230536436386770105","spbill_create_ip":"123.149.127.185","logistics_type":"EXPRESS","logistics_payment":"BUYER_PAY","receive_name":"123456a","receive_address":"N","receive_zip":"N","receive_phone":"N","receive_mobile":"N"}&body=230536436386770105&fee_type=1&input_charset=UTF-8&notify_url=http://180.76.141.156/shop/payment/notify&out_trade_no=230536436386770105&partner=1900000109&product_fee=2&return_url=http://180.76.141.156/shop/payment/return&sign_type=MD5&spbill_create_ip=123.149.127.185&subject=实物订单_230536436386770105&total_fee=2&trade_mode=1&transport_fee=0&key=8934e7d15453e97507ef794cf7b0519d';

        echo $a===$b;

//        $order_list=Orders::find();
//        if(count($order_list)>0){
//            $order_list=$order_list->toArray();
//            foreach ($order_list as $order){
//                update_points_and_reward($order);
//            }
//
//        }
//        echo "ok";
        exit;
    }
}