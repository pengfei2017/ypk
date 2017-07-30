<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 15:58
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Models\Payment;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class PaymentController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-支付设置
 */
class PaymentController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('setting,layout,payment,common');
        $this->view->setVar('lang', $this->translation);
    }

    /**
     * 支付方式
     */
    public function indexAction()
    {
        $payment_list = Payment::find(array('payment_code' => array('neq', 'predeposit')));
        $this->view->setVar('payment_list', $payment_list);
    }

    /**
     * 编辑
     */
    public function editAction()
    {
        //$model_payment = Model('payment');
        if (chksubmit()) {
            $payment_id = intval($_POST["payment_id"]);
            $data = array();
            $data['payment_state'] = intval($_POST["payment_state"]);
            $payment_config = '';
            $config_array = explode(',', $_POST["config_name"]);//配置参数
            if (is_array($config_array) && !empty($config_array)) {
                $config_info = array();
                foreach ($config_array as $k) {
                    $config_info[$k] = trim($_POST[$k]);
                }
                $payment_config = serialize($config_info);
            }
            $data['payment_config'] = $payment_config;//支付接口配置信息
            $model_payment = Payment::findFirst("payment_id=" . $payment_id); //根据id获取实体对象
            $model_payment->setPaymentState(intval($_POST["payment_state"]));
            $model_payment->setPaymentConfig($payment_config);
            $model_payment->save();
            $this->showMessage($this->translation['nc_common_save_succ'], getUrl('shop_manager/payment/index'));
        }

        $payment_id = intval($_GET["payment_id"]);
        $payment = Payment::findFirst("payment_id=" . $payment_id);
        if ($payment) {
            $payment = $payment->toArray();
            if ($payment['payment_config'] != '') {
                $this->view->setVar('config_array', unserialize($payment['payment_config']));
            }
        }
        $this->view->setVar('payment', $payment);
    }
}