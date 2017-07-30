<?php

/**
 * 微信 PC 端扫码支付
 *
 */
class wxpay
{
    /**
     * 存放支付订单信息
     * @var array
     */
    private $_order_info = array();

    /**
     * 支付信息初始化
     * @param array $payment_info
     * @param array $order_info
     */
    public function __construct($payment_info = array(), $order_info = array())
    {
        define('WXN_APPID', $payment_info['payment_config']['appid']);
        //define('WXN_APPID', 'wxc6db17459fed80db');
        define('WXN_MCHID', $payment_info['payment_config']['mchid']); //商户号
        //define('WXN_MCHID', '10028397');
        define('WXN_KEY', $payment_info['payment_config']['key']);
        //define('WXN_KEY', 'qazwsxedcrfvtgbyhnujmikolp123456');
        define('WXN_APPSECRET', $payment_info['payment_config']['appsecret']);
        //define('WXN_APPSECRET', '2214d8815d3cf9ba784e8e964d4da2df');
        //支付成功的异步通知地址
        define('WXN_NOTIFY_URL', getDomainName() . getUrl('shop/payment/wxpay_notify'));
        define('WXN_SSLCERT_PATH', BASE_API_PATH . '/payment/wxpay_api/cert/' . $payment_info['payment_config']['apiclient_cert_pem']);
        define('WXN_SSLKEY_PATH', BASE_API_PATH . '/payment/wxpay_api/cert/' . $payment_info['payment_config']['apiclient_key_pem']);
        $this->_order_info = $order_info;
    }

    /**
     * 扫码支付模式一必须在设置【return_url】需要在微信公众平台的【微信支付】->【开发配置】->【扫码支付】->【支付回调URL】设置为同步通知页面url【http://180.76.141.156/shop/payment/wxpay_return】
     * 组装包含支付信息的url(模式1)
     */
    public function get_payurls()
    {
        require_once __DIR__ . "/../wxpay_api/lib/WxPay.Api.php";
        require_once __DIR__ . "/../wxpay_api/example/WxPay.NativePay.php";
        require_once __DIR__ . '/../wxpay_api/example/log.php';

        $logHandler = new CLogFileHandler(BASE_PATH . '/log/wxpay/' . date('Y-m-d') . '.log');
        Log::Init($logHandler, 15);

        //模式一
        /**
         * 流程：
         * 1、组装包含支付信息的url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、确定支付之后，微信服务器会回调预先配置的回调地址，在【微信开放平台-微信支付-支付配置】中进行配置
         * 4、在接到回调通知之后，用户进行统一下单支付，并返回支付信息以完成支付（见：native_notify.php）
         * 5、支付完成之后，微信服务器会通知支付成功
         * 6、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $notify = new NativePay();
        /**警告：此URL仅适用于扫码支付模式一 【return_url】需要在微信公众平台的【微信支付】->【开发配置】->【扫码支付】->【支付回调URL】设置为同步通知统一下单页面url【http://180.76.141.156/shop/payment/wxpay_return】**/
        return $notify->GetPrePayUrl($this->_order_info['pay_sn']);
    }

    /**
     * 扫码支付模式二启用时，在微信公众平台的【微信支付】->【开发配置】->【扫码支付】->【支付回调URL】设置为同步通知统一下单页面【return_url】将失效
     * 组装包含支付信息的url(模式2)
     */
    public function get_payurl()
    {
        require_once __DIR__ . "/../wxpay_api/lib/WxPay.Api.php";
        require_once __DIR__ . "/../wxpay_api/example/WxPay.NativePay.php";
        require_once __DIR__ . '/../wxpay_api/example/log.php';

        $logHandler = new CLogFileHandler(BASE_PATH . '/log/wxpay/' . date('Y-m-d') . '.log');
        Log::Init($logHandler, 15);

        //模式二
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $input = new WxPayUnifiedOrder();
        $input->SetBody($this->_order_info['pay_sn'] . '订单');
        $input->SetAttach($this->_order_info['order_type'] == 'vr_order' ? 'v' : ($this->_order_info['order_type'] == 'pd_order' ? 'pd' : 'r'));
        $input->SetOut_trade_no($this->_order_info['pay_sn']);
        $input->SetTotal_fee($this->_order_info['api_pay_amount'] * 100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 3600));
        $input->SetGoods_tag("");
        $input->SetNotify_url(getDomainName() . getUrl('shop/payment/wxpay_notify'));
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id($this->_order_info['pay_sn']);
        $notify = new NativePay();
        $result = $notify->GetPayUrl($input);
        Log::DEBUG("unifiedorder:" . json_encode($result));
        return $result["code_url"];
    }
}
