<?php

/**
 * 支付宝接口类
 *
 */
class alipay
{
    /**
     * 支付接口标识
     *
     * @var string
     */
    private $code = 'alipay';

    /**
     * 支付接口配置信息
     *
     * @var array
     */
    private $payment;

    /**
     * 订单信息
     *
     * @var array
     */
    private $order;

    public function __construct($payment_info = array(), $order_info = array())
    {
        if (!empty($payment_info) && !empty($order_info)) {
            $this->payment = $payment_info;
            $this->order = $order_info;
        }
    }

    /**
     * 获取支付接口的请求地址
     *
     * @return string
     */
    public function get_payurl()
    {
        $alipay_config = $this->get_alipay_config();

        require_once("lib/alipay_submit.class.php");

        //构造要请求的参数数组，无需改动
        $parameter = array(
            "service" => $alipay_config['service'],
            "partner" => $alipay_config['partner'],
            "seller_id" => $alipay_config['seller_id'],
            'seller_email' => $this->payment['payment_config']['alipay_account'],    //卖家邮箱
            "payment_type" => $alipay_config['payment_type'],
            "notify_url" => $alipay_config['notify_url'],
            "return_url" => $alipay_config['return_url'],
            "anti_phishing_key" => $alipay_config['anti_phishing_key'],
            "exter_invoke_ip" => $alipay_config['exter_invoke_ip'],
            "out_trade_no" => $this->order['pay_sn'],
            "subject" => $this->order['subject'],
            "_input_charset" => trim(strtolower($alipay_config['input_charset'])),
            ///////////////////////////////////////////////////////
            'extra_common_param' => json_encode(array(
                'order_type' => $this->order['order_type'],
                'payment_code' => $this->code,
                'logistics_type' => 'EXPRESS',                    //物流配送方式：POST(平邮)、EMS(EMS)、EXPRESS(其他快递)
                //'logistics_fee'     => 0,
                'logistics_payment' => 'BUYER_PAY',                     //物流费用付款方式：SELLER_PAY(卖家支付)、BUYER_PAY(买家支付)、BUYER_PAY_AFTER_RECEIVE(货到付款)
                //'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',                     //物流费用付款方式：SELLER_PAY(卖家支付)、BUYER_PAY(买家支付)、BUYER_PAY_AFTER_RECEIVE(货到付款)
                'receive_name' => $_SESSION['member_name'],//收货人姓名
                'receive_address' => 'N',    //收货人地址
                'receive_zip' => 'N',    //收货人邮编
                'receive_phone' => 'N',//收货人电话
                'receive_mobile' => 'N',//收货人手机

            )),
            'body' => $this->order['pay_sn'],    //商品描述
            'price' => $this->order['api_pay_amount'],//订单单价
            'quantity' => 1,//商品数量
            'total_fee' => $this->order['api_pay_amount'],//订单总价
            //其他业务参数根据在线开发文档，添加参数.文档地址:https://doc.open.alipay.com/doc2/detail.htm?spm=a219a.7629140.0.0.kiX33I&treeId=62&articleId=103740&docType=1
            //如"参数名"=>"参数值"
        );

        //建立请求
        $alipaySubmit = new AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestUrl($parameter);
        return $html_text;
    }

    /**
     * 通知地址验证
     *
     * @return bool
     */
    public function notify_verify()
    {
        $alipay_config = $this->get_alipay_config();

        require_once("lib/alipay_notify.class.php");
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();
        if ($verify_result) {//验证成功
            return true;
        } else {
            return false;
        }
    }

    /**
     * 返回地址验证
     *
     * @return bool
     */
    public function return_verify()
    {
        $alipay_config = $this->get_alipay_config();

        require_once("lib/alipay_notify.class.php");
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {//验证成功
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * 取得订单支付状态，成功或失败
     * @param array $param
     * @return bool
     */
    public function getPayResult($param)
    {
        return $param['trade_status'] == 'TRADE_SUCCESS';
    }


    /**
     * hpf
     *
     * 得到支付的配置信息数组
     *
     * @return array
     */
    public function get_alipay_config()
    {
        $alipay_config = array();

        //合作身份者ID，签约账号，以2088开头由16位纯数字组成的字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        $alipay_config['partner'] = $this->payment['payment_config']['alipay_partner'];

        //收款支付宝账号，以2088开头由16位纯数字组成的字符串，一般情况下收款账号就是签约账号
        $alipay_config['seller_id'] = $alipay_config['partner'];

        // MD5密钥，安全检验码，由数字和字母组成的32位字符串，查看地址：https://b.alipay.com/order/pidAndKey.htm
        $alipay_config['key'] = $this->payment['payment_config']['alipay_key'];

        // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        $alipay_config['notify_url'] = getDomainName() . getUrl('shop/payment/notify');

        // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        $alipay_config['return_url'] = getDomainName() . getUrl('shop/payment/return');

        //签名方式
        $alipay_config['sign_type'] = strtoupper('MD5');

        //字符编码格式 目前支持 gbk 或 utf-8
        $alipay_config['input_charset'] = strtolower(CHARSET);

        //ca证书路径地址，用于curl中ssl校验
        //请保证cacert.pem文件在当前文件夹目录中
        $alipay_config['cacert'] = BASE_API_PATH . '/payment/alipay/cacert.pem';

        //访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
        if (!extension_loaded('openssl')) {
            $alipay_config['transport'] = 'http';
        } else {
            $alipay_config['transport'] = 'https';
        }

        // 支付类型 ，无需修改
        $alipay_config['payment_type'] = "1";

        // 产品类型，无需修改
        $alipay_config['service'] = "create_direct_pay_by_user";

        // 防钓鱼时间戳  若要使用请调用类文件submit中的query_timestamp函数
        $alipay_config['anti_phishing_key'] = "";

        // 客户端的IP地址 非局域网的外网IP地址，如：221.0.0.1
        $alipay_config['exter_invoke_ip'] = $_SERVER['REMOTE_ADDR'];

        return $alipay_config;
    }
}