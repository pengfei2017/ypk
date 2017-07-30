<?php

/**
 * 贺鹏飞
 *
 * 微信JSAPI支付接口类
 */
class wxpay_jsapi
{
    const DEBUG = 0;

    protected $config;

    public function __construct()
    {
        $this->config = array(
            'appId' => '',
            'appSecret' => '',
            'partnerId' => '',
            'apiKey' => '',

            'notifyUrl' => MOBILE_SITE_URL . '/api/payment/wxpay_jsapi/notify_url.php',
            'finishedUrl' => WAP_SITE_URL . '/js_template/member/payment_result.html?_=2&attach=_attach_',
            'undoneUrl' => WAP_SITE_URL . '/js_template/member/payment_result_failed.html?_=2&attach=_attach_',

            'orderSn' => date('YmdHis'),
            'orderInfo' => 'Test wxpay js api',
            'orderFee' => 1,
            'orderAttach' => '_',
        );
    }

    public function setConfig($name, $value)
    {
        $this->config[$name] = $value;
    }

    public function setConfigs(array $params)
    {
        foreach ($params as $name => $value) {
            $this->setConfig($name, $value);
        }
    }

    public function notify()
    {
        try {
            $data = $this->onNotify();
            $resultXml = $this->arrayToXml(array(
                'return_code' => 'SUCCESS',
            ));

            if (self::DEBUG) {
                file_put_contents(__DIR__ . '/log.txt', var_export($data, true), FILE_APPEND | LOCK_EX);
            }

        } catch (Exception $ex) {

            $data = null;
            $resultXml = $this->arrayToXml(array(
                'return_code' => 'FAIL',
                'return_msg' => $ex->getMessage(),
            ));

            if (self::DEBUG) {
                file_put_contents(__DIR__ . '/log_err.txt', $ex . PHP_EOL, FILE_APPEND | LOCK_EX);
            }

        }

        return array(
            $data,
            $resultXml,
        );
    }

    public function onNotify()
    {
        $d = $this->xmlToArray(file_get_contents('php://input'));

        if (empty($d)) {
            throw new Exception(__METHOD__);
        }

        if ($d['return_code'] != 'SUCCESS') {
            throw new Exception($d['return_msg']);
        }

        if ($d['result_code'] != 'SUCCESS') {
            throw new Exception("[{$d['err_code']}]{$d['err_code_des']}");
        }

        if (!$this->verify($d)) {
            throw new Exception("Invalid signature");
        }

        return $d;
    }

    public function verify(array $d)
    {
        if (empty($d['sign'])) {
            return false;
        }

        $sign = $d['sign'];
        unset($d['sign']);

        return $sign == $this->sign($d);
    }

    protected $control;

    public function paymentHtml($control = null)
    {
        require_once __DIR__ . "/lib/WxPay.Api.php";
        require_once __DIR__ . "/example/WxPay.JsApiPay.php";
        require_once __DIR__ . '/example/log.php';

        //初始化日志
        $logHandler = new CLogFileHandler(BASE_PATH . "/log/wxpay_jsapi/" . date('Y-m-d') . '.log');
        $log = Log::Init($logHandler, 15);

        //①、获取用户openid
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        //②、统一下单
        $input = new WxPayUnifiedOrder();
        $input->SetBody($this->config["orderInfo"]);
        $input->SetAttach($this->config['orderAttach']);
        $input->SetOut_trade_no($this->config['orderSn']);
        $input->SetTotal_fee($this->config['orderFee']);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($this->config['orderInfo']);
        $input->SetNotify_url(getDomainName() . getUrl('mobile/payment/notify'));
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);

        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();

        //③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */

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
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				alert(res.err_code+res.err_desc+res.err_msg);
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
			<?php echo $editAddress; ?>,
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
	
	window.onload = function(){
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
	};
	
	</script>
</head>
<body>
    <br/>
    <font color="#9ACD32"><b>该笔订单支付金额为<span style="color:#f00;font-size:50px">1分</span>钱</b></font><br/><br/>
	<div align="center">
		<button style="width:210px; height:50px; border-radius: 15px;background-color:#FE6714; border:0px #FE6714 solid; cursor: pointer;  color:white;  font-size:16px;" type="button" onclick="callpay()" >立即支付</button>
	</div>
</body>
</html>
EOB;
    }
}
