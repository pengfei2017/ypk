<?php

/**
 * 财付通接口类
 *
 */
class tenpay
{
    /**
     * 支付接口标识
     *
     * @var string
     */
    private $code = 'tenpay';

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

    /**
     * 支付结果
     *
     * @var bool
     */
    private $pay_result = false;


    public function __construct($payment_info, $order_info)
    {
        $this->tenpay($payment_info, $order_info);
    }

    public function tenpay($payment_info = array(), $order_info = array())
    {
        if (!empty($payment_info) and !empty($order_info)) {
            $this->payment = $payment_info;
            $this->order = $order_info;
        }
    }

    /**
     * 获取支付地址
     *
     * @return array
     */
    public function get_payurl()
    {
        $tenpay_config = $this->get_tenpay_config();
        require_once(__DIR__ . "/classes/RequestHandler.class.php");

        /* 创建支付请求对象 */
        $reqHandler = new RequestHandler();
        $reqHandler->init();
        $reqHandler->setKey($tenpay_config['key']);
        $reqHandler->setGateUrl("https://gw.tenpay.com/gateway/pay.htm");

        //----------------------------------------
        //设置支付参数
        //----------------------------------------
        $reqHandler->setParameter("partner", $tenpay_config['partner']);
        $reqHandler->setParameter("out_trade_no", $this->order['pay_sn']);
        $reqHandler->setParameter("total_fee", floatval($this->order['api_pay_amount']) * 100);  /* 商品总金额（包含运费），以分为单位 */
        $reqHandler->setParameter("return_url", $tenpay_config['return_url']);
        $reqHandler->setParameter("notify_url", $tenpay_config['notify_url']);
        $reqHandler->setParameter("body", $this->order['pay_sn']);
        //用户ip
        $reqHandler->setParameter("fee_type", "1");               //币种
        $reqHandler->setParameter("subject", $this->order['subject']);          //商品名称，（中介交易时必填）

        //系统可选参数
        $reqHandler->setParameter("sign_type", "MD5");          //签名方式，默认为MD5，可选RSA
        $reqHandler->setParameter("input_charset", CHARSET);      //字符集

        //业务可选参数 //附件数据，原样返回就可以了
        $reqHandler->setParameter("attach", json_encode(array(
            'order_type' => $this->order['order_type'],
            'payment_code' => $this->code,
            "body" => $this->order['pay_sn'],
            "subject" => $this->order['subject'],
            "spbill_create_ip" => $_SERVER['REMOTE_ADDR'],
            'logistics_type' => 'EXPRESS',                    //物流配送方式：POST(平邮)、EMS(EMS)、EXPRESS(其他快递)
            //'logistics_fee'     => 0,
            'logistics_payment' => 'BUYER_PAY',                     //物流费用付款方式：SELLER_PAY(卖家支付)、BUYER_PAY(买家支付)、BUYER_PAY_AFTER_RECEIVE(货到付款)
            //'logistics_payment' => 'BUYER_PAY_AFTER_RECEIVE',                     //物流费用付款方式：SELLER_PAY(卖家支付)、BUYER_PAY(买家支付)、BUYER_PAY_AFTER_RECEIVE(货到付款)
            'receive_name' => $_SESSION['member_name'],//收货人姓名
            'receive_address' => 'N',    //收货人地址
            'receive_zip' => 'N',    //收货人邮编
            'receive_phone' => 'N',//收货人电话
            'receive_mobile' => 'N',//收货人手机
        )));

        $reqHandler->setParameter("spbill_create_ip", $_SERVER['REMOTE_ADDR']);//客户端IP
        $reqHandler->setParameter("product_fee", floatval($this->order['api_pay_amount']) * 100);              //商品费用
        $reqHandler->setParameter("transport_fee", "0");          //物流费用
        $reqHandler->setParameter("trade_mode", "1");              //交易模式（1.即时到帐模式，2.中介担保模式，3.后台选择（卖家进入支付中心列表选择））

        //请求的URL
        $reqUrl = $reqHandler->getRequestURL();

        //获取debug信息,建议把请求和debug信息写入日志，方便定位问题
//        $debugInfo = $reqHandler->getDebugInfo();
//        echo "<br/>" . $reqUrl . "<br/>";
//        echo "<br/>" . $debugInfo . "<br/>";

        return $reqUrl;
    }

    /**
     * 通知地址验证
     *
     * @return bool
     */
    public function notify_verify()
    {
        $tenpay_config = $this->get_tenpay_config();
        require(__DIR__ . "/classes/ResponseHandler.class.php");
        require(__DIR__ . "/classes/RequestHandler.class.php");
        require(__DIR__ . "/classes/client/ClientResponseHandler.class.php");
        require(__DIR__ . "/classes/client/TenpayHttpClient.class.php");
        require(__DIR__ . "/classes/function.php");

        //log_result("财付通-----notify_verify------开始" . PHP_EOL);

        /* 创建支付应答对象 */
        $resHandler = new ResponseHandler();
        $resHandler->setKey($tenpay_config['key']);

        //判断签名
        if ($resHandler->isTenpaySign()) {

            //通知id
            $notify_id = $resHandler->getParameter("notify_id");

            //通过通知ID查询，确保通知来至财付通
            //创建查询请求
            $queryReq = new RequestHandler();
            $queryReq->init();
            $queryReq->setKey($tenpay_config['key']);
            $queryReq->setGateUrl("https://gw.tenpay.com/gateway/simpleverifynotifyid.xml");
            $queryReq->setParameter("partner", $tenpay_config['partner']);
            $queryReq->setParameter("notify_id", $notify_id);

            //通信对象
            $httpClient = new TenpayHttpClient();
            $httpClient->setTimeOut(5);
            //设置请求内容
            $httpClient->setReqContent($queryReq->getRequestURL());

            //后台调用
            if ($httpClient->call()) {
                //设置结果参数
                $queryRes = new ClientResponseHandler();
                $queryRes->setContent($httpClient->getResContent());
                $queryRes->setKey($tenpay_config['key']);

                if ($resHandler->getParameter("trade_mode") == "1") {
                    //判断签名及结果（即时到帐）
                    //只有签名正确,retcode为0，trade_state为0才是支付成功
                    if ($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0" && $resHandler->getParameter("trade_state") == "0") {

                        //取结果参数做业务处理
                        $out_trade_no = $resHandler->getParameter("out_trade_no");
                        //财付通订单号
                        $transaction_id = $resHandler->getParameter("transaction_id");
                        //金额,以分为单位
                        $total_fee = $resHandler->getParameter("total_fee");
                        //如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
                        $discount = $resHandler->getParameter("discount");

                        //------------------------------
                        //处理业务开始
                        //------------------------------

                        //处理数据库逻辑
                        //注意交易单不要重复处理
                        //注意判断返回金额

                        //------------------------------
                        //处理业务完毕
                        //------------------------------

                        //判断返回金额
                        $order_amount = $total_fee / 100;
                        if (!empty($this->order['pdr_amount'])) {
                            $this->order['api_pay_amount'] = $this->order['pdr_amount'];
                        }
                        if ($this->order['api_pay_amount'] != $order_amount) {
                            log_result("即时到帐后台回调失败：付款金额不对 out_trade_no = {$out_trade_no}" . PHP_EOL);
                            return false;
                        }
                        $this->pay_result = true;
                        return true;
                    } else {
                        //错误时，返回结果可能没有签名，写日志trade_state、retcode、retmsg看失败详情。
                        //echo "验证签名失败 或 业务错误信息:trade_state=" . $resHandler->getParameter("trade_state") . ",retcode=" . $queryRes->                         getParameter("retcode"). ",retmsg=" . $queryRes->getParameter("retmsg") . "<br/>" ;
                        log_result("即时到帐后台回调失败：trade_state=" . $resHandler->getParameter("trade_state") . PHP_EOL);
                        return false;
                    }
                } elseif ($resHandler->getParameter("trade_mode") == "2") {
                    //判断签名及结果（中介担保）
                    //只有签名正确,retcode为0，trade_state为0才是支付成功
                    if ($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0") {
                        //log_result("中介担保验签ID成功");
                        //取结果参数做业务处理
                        $out_trade_no = $resHandler->getParameter("out_trade_no");
                        //财付通订单号
                        $transaction_id = $resHandler->getParameter("transaction_id");
                        //金额,以分为单位
                        $total_fee = $resHandler->getParameter("total_fee");
                        //如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
                        $discount = $resHandler->getParameter("discount");

                        //------------------------------
                        //处理业务开始
                        //------------------------------

                        //处理数据库逻辑
                        //注意交易单不要重复处理
                        //注意判断返回金额

                        //log_result("中介担保后台回调，trade_state=" + $resHandler->getParameter("trade_state"));
                        switch ($resHandler->getParameter("trade_state")) {
                            case "0":    //付款成功

                                break;
                            case "1":    //交易创建

                                break;
                            case "2":    //收获地址填写完毕

                                break;
                            case "4":    //卖家发货成功

                                break;
                            case "5":    //买家收货确认，交易成功

                                break;
                            case "6":    //交易关闭，未完成超时关闭

                                break;
                            case "7":    //修改交易价格成功

                                break;
                            case "8":    //买家发起退款

                                break;
                            case "9":    //退款成功

                                break;
                            case "10":    //退款关闭

                                break;
                            default:
                                //nothing to do
                                break;
                        }


                        //------------------------------
                        //处理业务完毕
                        //------------------------------
                        return true;
                    } else {
                        //错误时，返回结果可能没有签名，写日志trade_state、retcode、retmsg看失败详情。
                        //echo "验证签名失败 或 业务错误信息:trade_state=" . $resHandler->getParameter("trade_state") . ",retcode=" . $queryRes->             										       getParameter("retcode"). ",retmsg=" . $queryRes->getParameter("retmsg") . "<br/>" ;
                        log_result("中介担保后台回调失败：trade_state=" . $resHandler->getParameter("trade_state") . PHP_EOL);
                        return false;
                    }
                }

                //获取查询的debug信息,建议把请求、应答内容、debug信息，通信返回码写入日志，方便定位问题
                /*
                    echo "<br>------------------------------------------------------<br>";
                    echo "http res:" . $httpClient->getResponseCode() . "," . $httpClient->getErrInfo() . "<br>";
                    echo "query req:" . htmlentities($queryReq->getRequestURL(), ENT_NOQUOTES, "GB2312") . "<br><br>";
                    echo "query res:" . htmlentities($queryRes->getContent(), ENT_NOQUOTES, "GB2312") . "<br><br>";
                    echo "query reqdebug:" . $queryReq->getDebugInfo() . "<br><br>" ;
                    echo "query resdebug:" . $queryRes->getDebugInfo() . "<br><br>";
                    */
            } else {
                //通信失败
                //后台调用通信失败,写日志，方便定位问题
                log_result("通信失败call err：" . $httpClient->getResponseCode() . "," . $httpClient->getErrInfo() . PHP_EOL);
                return false;
            }

        } else {
            log_result("验证签名失败：" . $resHandler->getDebugInfo() . PHP_EOL);
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
        $tenpay_config = $this->get_tenpay_config();
        require_once(__DIR__ . "/classes/ResponseHandler.class.php");
        require_once(__DIR__ . "/classes/function.php");

        //log_result("财付通-----return_verify------开始" . PHP_EOL);

        /* 创建支付应答对象 */
        $resHandler = new ResponseHandler();
        $resHandler->setKey($tenpay_config['key']);

        //判断签名
        if ($resHandler->isTenpaySign()) {
            //通知id
            $notify_id = $resHandler->getParameter("notify_id");
            //商户订单号
            $out_trade_no = $resHandler->getParameter("out_trade_no");
            //财付通订单号
            $transaction_id = $resHandler->getParameter("transaction_id");
            //金额,以分为单位
            $total_fee = $resHandler->getParameter("total_fee");
            //如果有使用折扣券，discount有值，total_fee+discount=原请求的total_fee
            $discount = $resHandler->getParameter("discount");
            //支付结果
            $trade_state = $resHandler->getParameter("trade_state");
            //交易模式,1即时到账
            $trade_mode = $resHandler->getParameter("trade_mode");

            if ("1" == $trade_mode) {
                if ("0" == $trade_state) {
                    //判断返回金额
                    $order_amount = $total_fee / 100;
                    if (!empty($this->order['pdr_amount'])) {
                        $this->order['api_pay_amount'] = $this->order['pdr_amount'];
                    }
                    if ($this->order['api_pay_amount'] != $order_amount) {
                        log_result("即时到帐前台回调失败：返回金额不对 out_trade_no = {$out_trade_no}" . PHP_EOL);
                        return false;
                    }
                    $this->pay_result = true;
                    return true;

                } else {
                    log_result("即时到帐前台回调失败：trade_state=" . $resHandler->getParameter("trade_state") . PHP_EOL);
                    return false;
                }
            } elseif ("2" == $trade_mode) {
                if ("0" == $trade_state) {

                    //------------------------------
                    //处理业务开始
                    //------------------------------

                    //注意交易单不要重复处理
                    //注意判断返回金额

                    //------------------------------
                    //处理业务完毕
                    //------------------------------

                    $this->pay_result = true;
                    return true;

                } else {
                    //当做不成功处理
                    return false;
                }
            }

        } else {
            log_result("即时到帐前台回调失败：'财付通验证签名return_verify失败，调试信息：" . $resHandler->getDebugInfo() . PHP_EOL);
            return false;
        }
    }

    /**
     * 取得订单支付状态，成功或失败
     *
     * @param array $param
     * @return bool
     */
    public function getPayResult($param)
    {
        return $this->pay_result;
    }

    /**
     * hpf
     *
     * 得到支付的配置信息数组
     *
     * @return array
     */
    public function get_tenpay_config()
    {
        $tenpay_config = array();

        /* 商户号 */
        $tenpay_config['partner'] = $this->payment['payment_config']['tenpay_account'];
        //$tenpay_config['partner'] = "1900000109";
        //$tenpay_config['partner'] = "1223322601";

        /* 密钥 */
        $tenpay_config['key'] = $this->payment['payment_config']['tenpay_key'];
        //$tenpay_config['key'] = "8934e7d15453e97507ef794cf7b0519d";
        //$tenpay_config['key'] = "qazwsxedcrfvtgbyhnujmik123456789";

        // 页面跳转同步通知页面路径 需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        $tenpay_config['return_url'] = getDomainName() . getUrl('shop/payment/return');

        // 服务器异步通知页面路径  需http://格式的完整路径，不能加?id=123这类自定义参数，必须外网可以正常访问
        $tenpay_config['notify_url'] = getDomainName() . getUrl('shop/payment/notify');

        return $tenpay_config;
    }
}
