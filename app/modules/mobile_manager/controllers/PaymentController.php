<?php
/**
 * 手机支付方式
 */

namespace Ypk\Modules\MobileManager\Controllers;


use Ypk\Logic\SettingLogic;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Tpl;

class PaymentController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout');
    }

    public function indexAction()
    {
        $this->payment_listAction();
    }

    public function payment_listAction()
    {
        $model_mb_payment = Model('mb_payment');
        $mb_payment_list = $model_mb_payment->getMbPaymentList();
        Tpl::output('mb_payment_list', $mb_payment_list);
//        Tpl::setDirquna('mobile');
//        Tpl::showpage('mb_payment.list');
        $this->view->pick('payment/payment_list');
    }

    /**
     * 编辑
     */
    public function payment_editAction()
    {
        $model_setting = new SettingLogic();
        $list_setting = $model_setting->getListSetting();
        $this->view->setVar('list_setting', $list_setting);

        $payment_id = intval($_GET["payment_id"]);

        $model_mb_payment = Model('mb_payment');

        $mb_payment_info = $model_mb_payment->getMbPaymentInfo(array('payment_id' => $payment_id));
        if (!empty($mb_payment_info['payment_config']['apiclient_cert_p12']) && !file_exists(BASE_API_PATH . '/payment/wxpay_api/cert/' . $mb_payment_info['payment_config']['apiclient_cert_p12'])) {
            $mb_payment_info['payment_config']['apiclient_cert_p12'] = "";
        }
        if (!empty($mb_payment_info['payment_config']['apiclient_cert_pem']) && !file_exists(BASE_API_PATH . '/payment/wxpay_api/cert/' . $mb_payment_info['payment_config']['apiclient_cert_pem'])) {
            $mb_payment_info['payment_config']['apiclient_cert_pem'] = "";
        }
        if (!empty($mb_payment_info['payment_config']['apiclient_key_pem']) && !file_exists(BASE_API_PATH . '/payment/wxpay_api/cert/' . $mb_payment_info['payment_config']['apiclient_key_pem'])) {
            $mb_payment_info['payment_config']['apiclient_key_pem'] = "";
        }
        if (!empty($mb_payment_info['payment_config']['rootca_pem']) && !file_exists(BASE_API_PATH . '/payment/wxpay_api/cert/' . $mb_payment_info['payment_config']['rootca_pem'])) {
            $mb_payment_info['payment_config']['rootca_pem'] = "";
        }
        Tpl::output('payment', $mb_payment_info);
//        Tpl::setDirquna('mobile');
//        Tpl::showpage('mb_payment.edit');
        $this->view->pick('payment/payment_edit');
    }

    /**
     * 编辑保存
     */
    public function payment_saveAction()
    {
        $payment_id = intval($_POST["payment_id"]);

        $data = array();
        $data['payment_state'] = intval($_POST["payment_state"]);
        $payment_config = array();
        switch ($_POST['payment_code']) {
            case 'alipay_wap':
                $payment_config = array(
                    'app_id' => $_POST['app_id'],
                    'merchant_private_key' => $_POST['merchant_private_key'],
                    'alipay_public_key' => $_POST['alipay_public_key']
                );
                break;
            case 'wxpay':
                $payment_config = array(
                    'wxpay_appid' => $_POST['wxpay_appid'],
                    'wxpay_appsecret' => $_POST['wxpay_appsecret'],
                    'wxpay_appkey' => $_POST['wxpay_appkey'],
                    'wxpay_partnerid' => $_POST['wxpay_partnerid'],
                    'wxpay_partnerkey' => $_POST['wxpay_partnerkey']
                );
                break;
            case 'wxpay_jsapi':
                $model_mb_payment = Model('mb_payment');
                $mb_payment_info = $model_mb_payment->getMbPaymentInfo(array('payment_id' => $payment_id));
                $payment_config = array(
                    'appid' => $_POST['appid'],
                    'appsecret' => $_POST['appsecret'],
                    'mchid' => $_POST['mchid'],
                    'key' => $_POST['key'],
                    'apiclient_cert_p12' => empty($_FILES['apiclient_cert_p12']['name']) ? $mb_payment_info['payment_config']['apiclient_cert_p12'] : $_FILES['apiclient_cert_p12']['name'],
                    'apiclient_cert_pem' => empty($_FILES['apiclient_cert_pem']['name']) ? $mb_payment_info['payment_config']['apiclient_cert_pem'] : $_FILES['apiclient_cert_pem']['name'],
                    'apiclient_key_pem' => empty($_FILES['apiclient_key_pem']['name']) ? $mb_payment_info['payment_config']['apiclient_key_pem'] : $_FILES['apiclient_key_pem']['name'],
                    'rootca_pem' => empty($_FILES['rootca_pem']['name']) ? $mb_payment_info['payment_config']['rootca_pem'] : $_FILES['rootca_pem']['name'],
                );
                break;
            case 'alipay_native':
                $payment_config = array(
                    'alipay_account' => $_POST['alipay_account'],
                    'alipay_partner' => $_POST['alipay_partner']
                );
                break;
            default:
                showMessage(getLang('param_error'), '');
        }
        if (is_array($_FILES) && !empty($_FILES)) {
            foreach ($_FILES as $key => $value) {
                if (!file_exists($value['tmp_name'])) {
                    continue;
                }
                if ($value['type'] != "application/x-pkcs12" && $value['type'] != "application/octet-stream") {
                    continue;
                }
                if ($value['size'] < 20000) {
                    if (!is_dir(BASE_API_PATH . '/payment/wxpay_api/cert')) {
                        mkdir(BASE_API_PATH . '/payment/wxpay_api/cert');
                    }
                    if (file_exists(BASE_API_PATH . '/payment/wxpay_api/cert/' . $value["name"])) {
                        unlink(BASE_API_PATH . '/payment/wxpay_api/cert/' . $value["name"]);
                    }
                    move_uploaded_file($value["tmp_name"], BASE_API_PATH . '/payment/wxpay_api/cert/' . $value["name"]);
                } else {
                    showMessage('上传文件失败', getUrl('mobile_manager/payment/payment_list'));
                }
            }
        }
        $data['payment_config'] = $payment_config;

        $model_mb_payment = Model('mb_payment');

        $result = $model_mb_payment->editMbPayment($data, array('payment_id' => $payment_id));
        if ($result) {
            showMessage(getLang('nc_common_save_succ'), getUrl('mobile_manager/payment/payment_list'));
        } else {
            showMessage(getLang('nc_common_save_fail'), getUrl('mobile_mananger/payment/payment_list'));
        }
    }
}
