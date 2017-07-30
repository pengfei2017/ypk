<?php

/**
 * 贺鹏飞
 *
 * 微信手机端微信浏览器内JSAPI支付接口类
 */
class wxpay_jsapi
{
    /**
     * 存放支付订单信息
     * @var array
     */
    private $_order_info = array();

    public function __construct($payment_info = array(), $order_info = array())
    {
        define('WXN_APPID', $payment_info['appid']);
        //define('WXN_APPID', 'wxc6db17459fed80db');
        define('WXN_MCHID', $payment_info['mchid']); //商户号
        //define('WXN_MCHID', '10028397');
        define('WXN_KEY', $payment_info['key']);
        //define('WXN_KEY', 'qazwsxedcrfvtgbyhnujmikolp123456');
        define('WXN_APPSECRET', $payment_info['appsecret']);
        //define('WXN_APPSECRET', '2214d8815d3cf9ba784e8e964d4da2df');
        define('WXN_NOTIFY_URL', getDomainName() . getUrl('mobile/payment/wxpay_jsapi_notify'));
        define('WXN_SSLCERT_PATH', BASE_API_PATH . '/payment/wxpay_api/cert/' . $payment_info['apiclient_cert_pem']);
        define('WXN_SSLKEY_PATH', BASE_API_PATH . '/payment/wxpay_api/cert/' . $payment_info['apiclient_key_pem']);

        $order_info['finishedUrl'] = getDomainName() . WAP_SITE_URL . '/js_template/member/payment_result.html?_=2&attach=_attach_';
        $order_info['undoneUrl'] = getDomainName() . WAP_SITE_URL . '/js_template/member/payment_result_failed.html?_=2&attach=_attach_';
        $this->_order_info = $order_info;
    }

    public function paymentHtml()
    {
        require_once __DIR__ . "/../wxpay_api/lib/WxPay.Api.php";
        require_once __DIR__ . "/../wxpay_api/example/WxPay.JsApiPay.php";
        require_once __DIR__ . '/../wxpay_api/example/log.php';

        //初始化日志
        $logHandler = new CLogFileHandler(BASE_PATH . "/log/wxpay_jsapi/" . date('Y-m-d') . '.log');
        Log::Init($logHandler, 15);

        //①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($this->_order_info["orderInfo"]);
        $input->SetAttach($this->_order_info['orderAttach']);
        //$input->SetOut_trade_no($this->_order_info['orderSn'] . '-wxpay_jsapi');
        $input->SetOut_trade_no($this->_order_info['orderSn']);
        $input->SetTotal_fee($this->_order_info['orderFee']);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($this->_order_info['orderInfo']);
        $input->SetNotify_url(getDomainName() . getUrl('mobile/payment/wxpay_jsapi_notify'));
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input, 6);
        Log::DEBUG('_order_info为：'.json_encode($this->_order_info));
        Log::DEBUG('order为：'.json_encode($order));
        $jsApiParameters = $tools->GetJsApiParameters($order);
        Log::DEBUG('jsApiParameters为：'.json_encode($jsApiParameters));
        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */
        $tip_fee = $this->_order_info['orderFee'] / 100;
        return <<<EOB
        <html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/> 
    <title>微信安全支付</title>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			{$jsApiParameters},
			function(res){
			    //下面这个alert是调试微信jsapi的方法，因为这个是在手机微信浏览器中js调用微信app支付的过程，所以只有通过js弹出错误消息来调试，唯一的方法
			    //alert(res.err_code+res.err_desc+res.err_msg);
				var h;
                if (res && res.err_msg == "get_brand_wcpay_request:ok") {
                    // success;
                    h = '{$this->_order_info['finishedUrl']}';
                } else {
                    // fail;
                    WeixinJSBridge.log(res.err_msg);
                    h = '{$this->_order_info['undoneUrl']}';
                }
                //alert(h.replace('_attach_', '{$this->_order_info['orderAttach']}'))
                location.href = h.replace('_attach_', '{$this->_order_info['orderAttach']}');
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
	<script type="text/javascript">
	//获取共享地址
	function editAddress()
	{
		WeixinJSBridge.invoke(
			'editAddress',
			{$editAddress},
			function(res){
				var value1 = res.proviceFirstStageName;
				var value2 = res.addressCitySecondStageName;
				var value3 = res.addressCountiesThirdStageName;
				var value4 = res.addressDetailInfo;
				var tel = res.telNumber;
				
				alert(value1 + value2 + value3 + value4 + ":" + tel);
			}
		);
	}
	
	/*window.onload = function(){
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', editAddress, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', editAddress); 
		        document.attachEvent('onWeixinJSBridgeReady', editAddress);
		    }
		}else{
			editAddress();
		}
	};*/
	
	</script>
</head>
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">{$tip_fee}元</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
</body>
</html>
EOB;
    }

    public function notify()
    {
        require_once __DIR__ . "/notify.php";

        //微信浏览器jsapi支付成功的回调页面
        Log::DEBUG("begin notify");
        $notify = new PayNotifyCallBack();
        return $notify->Handle(false);
    }
}
