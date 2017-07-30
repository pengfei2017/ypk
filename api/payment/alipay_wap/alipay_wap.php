<?php

/**
 * 支付宝手机网站支付接口
 *
 * Class alipay_wap
 */
class alipay_wap
{
    public function submit($param)
    {
        require_once __DIR__ . '/wappay/service/AlipayTradeService.php';
        require_once __DIR__ . '/wappay/buildermodel/AlipayTradeWapPayContentBuilder.php';
        require __DIR__ . '/config.php';

        $config['app_id'] = $param['app_id'];
        $config['merchant_private_key'] = $param['merchant_private_key'];
        $config['alipay_public_key'] = $param['alipay_public_key'];
        $config['notify_url'] = getDomainName() . getUrl('mobile/payment/notify');
        $config['return_url'] = getDomainName() . getUrl('mobile/payment/return');

        $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
        $payRequestBuilder->setBody($param['order_sn']);
        $payRequestBuilder->setSubject('商品订单' . $param['order_sn']);
        $payRequestBuilder->setOutTradeNo($param['order_sn'] . '_' . $param['order_type'] . '-' . $config['payment_code']);
        $payRequestBuilder->setTotalAmount($param['order_amount']);

        //超时时间
        $timeout_express = "1m";
        $payRequestBuilder->setTimeExpress($timeout_express);


        $payResponse = new AlipayTradeService($config);
        $result = $payResponse->wapPay($payRequestBuilder, $config['return_url'], $config['notify_url']);

        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html>
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
					<title>支付宝即时到账交易接口接口</title>
				</head>' . $result . '
				</body>
				</html>';;
    }

    /**
     * 获取return信息
     */
    public function getReturnInfo($payment_config)
    {
        if (empty($payment_config)) {
            return false;
        }

        $arr = $_GET;

        $arr['out_trade_no'] = $arr['out_trade_no'] . '-' . $arr['payment_code'];
        unset($arr['payment_code']);

        require_once(__DIR__ . "/config.php");
        require_once __DIR__ . '/wappay/service/AlipayTradeService.php';

        $config['app_id'] = $payment_config['app_id'];
        $config['merchant_private_key'] = $payment_config['merchant_private_key'];
        $config['alipay_public_key'] = $payment_config['alipay_public_key'];
        $config['notify_url'] = getDomainName() . getUrl('mobile/payment/notify');
        $config['return_url'] = getDomainName() . getUrl('mobile/payment/return');

        $alipaySevice = new AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        if ($result) {//验证成功

            return array(
                //商户订单号
                'out_trade_no' => htmlspecialchars($_GET['out_trade_no']),
                //支付宝交易号
                'trade_no' => htmlspecialchars($_GET['trade_no']),
            );
        }

        return false;
    }

    /**
     * 获取notify信息
     */
    public function getNotifyInfo($payment_config)
    {
        if (empty($payment_config)) {
            return false;
        }
        require_once(__DIR__ . "/config.php");
        require_once __DIR__ . '/wappay/service/AlipayTradeService.php';

        $config['app_id'] = $payment_config['app_id'];
        $config['merchant_private_key'] = $payment_config['merchant_private_key'];
        $config['alipay_public_key'] = $payment_config['alipay_public_key'];
        $config['notify_url'] = getDomainName() . getUrl('mobile/payment/notify');
        $config['return_url'] = getDomainName() . getUrl('mobile/payment/return');

        $arr = $_POST;

        $arr['out_trade_no'] = $arr['out_trade_no'] . '-' . $arr['payment_code'];
        unset($arr['payment_code']);

        $alipaySevice = new AlipayTradeService($config);
        $result = $alipaySevice->check($arr);

        if ($result) {//验证成功

            //商户订单号
            $out_trade_no = $_POST['out_trade_no'];

            //支付宝交易号
            $trade_no = $_POST['trade_no'];

            //交易状态
            $trade_status = $_POST['trade_status'];

            if ($trade_status == 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
                return array(
                    //商户订单号
                    'out_trade_no' => $out_trade_no,
                    //支付宝交易号
                    'trade_no' => $trade_no,
                );
            }
        }

        return false;
    }

}
