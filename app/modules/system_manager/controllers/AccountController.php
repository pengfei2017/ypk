<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/21
 * Time: 15:56
 */

namespace Ypk\Modules\SystemManager\Controllers;

use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Tpl;
use Ypk\Validate;

class AccountController extends ControllerBase
{
//    private $links = array(
//        array('url' => array('module' => 'system_manager', 'controller' => 'account', 'action' => 'sms'), 'text' => '手机短信')
//    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation("setting,common,layout");
    }

    public function indexAction()
    {
        $this->smsAction();
    }

    /**
     * QQ互联
     */
    public function qqAction()
    {
        $model_setting = Model('setting');
        if (chksubmit()) {
            $obj_validate = new Validate();
            if (trim($_POST['qq_isuse']) == '1') {
                $obj_validate->validateparam = array(
                    array("input" => $_POST["qq_appid"], "require" => "true", "message" => getLang('qq_appid_error')),
                    array("input" => $_POST["qq_appkey"], "require" => "true", "message" => getLang('qq_appkey_error'))
                );
            }
            $error = $obj_validate->validate();
            if ($error != '') {
                showMessage($error);
            } else {
                $update_array = array();
                $update_array['qq_isuse'] = $_POST['qq_isuse'];
                $update_array['qq_appcode'] = $_POST['qq_appcode'];
                $update_array['qq_appid'] = $_POST['qq_appid'];
                $update_array['qq_appkey'] = $_POST['qq_appkey'];
                $result = $model_setting->updateSetting($update_array);
                if ($result === true) {
                    $this->log(getLang('nc_edit,qqSettings'), 1);
                    showMessage(getLang('nc_common_save_succ'));
                } else {
                    $this->log(getLang('nc_edit,qqSettings'), 0);
                    showMessage(getLang('nc_common_save_fail'));
                }
            }
        }

        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting', $list_setting);

        //输出子菜单
        Tpl::output('top_link', $this->sublink($this->links, 'qq'));
        //Tpl::setDirquna('system');
        //Tpl::showpage('account.qq_setting');
        $this->view->render('account', 'account_qq_setting');
        $this->view->disable();
    }

    /**
     * sina微博设置
     */
    public function sinaAction()
    {
        $model_setting = Model('setting');
        if (chksubmit()) {
            $obj_validate = new Validate();
            if (trim($_POST['sina_isuse']) == '1') {
                $obj_validate->validateparam = array(
                    array("input" => $_POST["sina_wb_akey"], "require" => "true", "message" => getLang('sina_wb_akey_error')),
                    array("input" => $_POST["sina_wb_skey"], "require" => "true", "message" => getLang('sina_wb_skey_error'))
                );
            }
            $error = $obj_validate->validate();
            if ($error != '') {
                showMessage($error);
            } else {
                $update_array = array();
                $update_array['sina_isuse'] = $_POST['sina_isuse'];
                $update_array['sina_wb_akey'] = $_POST['sina_wb_akey'];
                $update_array['sina_wb_skey'] = $_POST['sina_wb_skey'];
                $update_array['sina_appcode'] = $_POST['sina_appcode'];
                $result = $model_setting->updateSetting($update_array);
                if ($result === true) {
                    $this->log(getLang('nc_edit,sinaSettings'), 1);
                    showMessage(getLang('nc_common_save_succ'));
                } else {
                    $this->log(getLang('nc_edit,sinaSettings'), 0);
                    showMessage(getLang('nc_common_save_fail'));
                }
            }
        }
        $is_exist = function_exists('curl_init');
        if ($is_exist) {
            $list_setting = $model_setting->getListSetting();
            Tpl::output('list_setting', $list_setting);
        }
        Tpl::output('is_exist', $is_exist);

        //输出子菜单
        Tpl::output('top_link', $this->sublink($this->links, 'sina'));
        //Tpl::setDirquna('system');
        //Tpl::showpage('account.sina_setting');
        $this->view->render('account', 'account_sina_setting');
        $this->view->disable();
    }

    /**
     * 手机短信设置
     */
    public function smsAction()
    {
        $model_setting = Model('setting');
        if (chksubmit()) {
            $update_array = array();
            $update_array['sms_register'] = $_POST['sms_register'];
            $update_array['sms_login'] = $_POST['sms_login'];
            $update_array['sms_password'] = $_POST['sms_password'];
            $result = $model_setting->updateSetting($update_array);
            if ($result) {
                $this->log('编辑账号同步，手机短信设置');
                showMessage(getLang('nc_common_save_succ'));
            } else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting', $list_setting);
        //输出子菜单
        Tpl::output('top_link', $this->sublink($this->links, 'sms'));
        //Tpl::setDirquna('system');
        //Tpl::showpage('account.sms_setting');
        $this->view->render('account', 'account_sms_setting');
        $this->view->disable();
    }

    /**
     * 微信登录设置
     */
    public function wxAction()
    {
        $model_setting = Model('setting');
        if (chksubmit()) {
            $update_array = array();
            $update_array['weixin_isuse'] = $_POST['weixin_isuse'];
            $update_array['weixin_appid'] = $_POST['weixin_appid'];
            $update_array['weixin_secret'] = $_POST['weixin_secret'];
            $result = $model_setting->updateSetting($update_array);
            if ($result) {
                $this->log('编辑账号同步，微信登录设置');
                showMessage(getLang('nc_common_save_succ'));
            } else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting', $list_setting);
        //输出子菜单
        Tpl::output('top_link', $this->sublink($this->links, 'wx'));
        //Tpl::setDirquna('system');
        //Tpl::showpage('account.wx_setting');
        $this->view->render('account', 'account_wx_setting');
        $this->view->disable();
    }

    /**
     * Ucenter整合设置
     *
     */
    public function ucAction()
    {
        /**
         * 读取语言包
         */
        $lang = $this->translation;

        /**
         * 实例化模型
         */
        $model_setting = Model('setting');
        /**
         * 保存信息
         */
        if (chksubmit()) {
            $update_array = array();
            $update_array['ucenter_status'] = trim($_POST['ucenter_status']);
            $update_array['ucenter_type'] = trim($_POST['ucenter_type']);
            $update_array['ucenter_app_id'] = trim($_POST['ucenter_app_id']);
            $update_array['ucenter_app_key'] = trim($_POST['ucenter_app_key']);
            $update_array['ucenter_ip'] = trim($_POST['ucenter_ip']);
            $update_array['ucenter_url'] = trim($_POST['ucenter_url']);
            $update_array['ucenter_connect_type'] = trim($_POST['ucenter_connect_type']);
            $update_array['ucenter_mysql_server'] = trim($_POST['ucenter_mysql_server']);
            $update_array['ucenter_mysql_username'] = trim($_POST['ucenter_mysql_username']);
            $update_array['ucenter_mysql_passwd'] = htmlspecialchars_decode(trim($_POST['ucenter_mysql_passwd']));
            $update_array['ucenter_mysql_name'] = trim($_POST['ucenter_mysql_name']);
            $update_array['ucenter_mysql_pre'] = trim($_POST['ucenter_mysql_pre']);

            $result = $model_setting->updateSetting($update_array);
            if ($result === true) {
                showMessage(getLang('nc_common_save_succ'));
            } else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        /**
         * 读取设置内容 $list_setting
         */
        $list_setting = $model_setting->getListSetting();
        /**
         * 模板输出
         */
        Tpl::output('list_setting', $list_setting);
        //输出子菜单
        Tpl::output('top_link', $this->sublink($this->links, 'uc'));
        //Tpl::setDirquna('system');
        //Tpl::showpage('account.uc_setting');
        $this->view->render('account', 'account_uc_setting');
        $this->view->disable();
    }

}