<?php

require_once __DIR__ . '/../wxpay_api/lib/WxPay.Api.php';
require_once __DIR__ . '/../wxpay_api/lib/WxPay.Notify.php';
require_once __DIR__ . '/../wxpay_api/example/log.php';


//初始化日志
$logHandler = new CLogFileHandler(BASE_PATH . '/log/wxpay_jsapi/' . date('Y-m-d') . '.log');
Log::Init($logHandler, 15);

/**
 * 异步通知页面业务逻辑
 * Class PayNotifyCallBack
 */
class PayNotifyCallBack extends WxPayNotify
{
    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        Log::DEBUG("query:" . json_encode($result));
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS"
        ) {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        Log::DEBUG("call back:" . json_encode($data));
        $notfiyOutput = array();

        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"])) {
            $msg = "订单查询失败";
            return false;
        }
        return $data;
    }
}

/*//微信浏览器jsapi支付成功的回调页面
Log::DEBUG("begin notify");
$notify = new PayNotifyCallBack();
$notify->Handle(false);*/
