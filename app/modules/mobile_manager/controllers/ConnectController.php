<?php
/**
 * 手机端微信公众账号二维码设置
 */

namespace Ypk\Modules\MobileManager\Controllers;


use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Tpl;

class ConnectController extends ControllerBase {
    private $links = array(
        array('url' => array('module' => 'mobile_manager', 'controller' => 'connect', 'action' => 'wx'), 'text' => '微信登录'),
        array('url' => array('module' => 'mobile_manager', 'controller' => 'connect', 'action' => 'wap_wx'), 'text' => 'WAP微信登录'),
        array('url' => array('module' => 'mobile_manager', 'controller' => 'connect', 'action' => 'qq'), 'text' => 'QQ互联'),
        array('url' => array('module' => 'mobile_manager', 'controller' => 'connect', 'action' => 'sina'), 'text' => '新浪微博'),
    );
    public function initialize(){
        parent::initialize();
        $this->translation = getTranslation('common,layout,setting');
    }

    public function indexAction() {
        $this->wxAction();
    }

    /**
     * 微信登录
     */
    public function wxAction() {
        $model_setting = Model('setting');
        if (chksubmit()){
            $update_array = array();
            $update_array['app_weixin_isuse']   = $_POST['app_weixin_isuse'];
            $update_array['app_weixin_appid']   = $_POST['app_weixin_appid'];
            $update_array['app_weixin_secret']  = $_POST['app_weixin_secret'];
            $result = $model_setting->updateSetting($update_array);
            if ($result){
                $this->log('第三方账号登录，微信登录设置');
                showMessage(getLang('nc_common_save_succ'));
            }else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'wx'));
//	Tpl::setDirquna('mobile');
//        Tpl::showpage('mb_connect_wx.edit');
        $this->view->pick('connect/connect_wx_edit');

    }

    /**
     * WAP微信登录
     */
    public function wap_wxAction() {
        $model_setting = Model('setting');
        if (chksubmit()){
            $update_array = array();
            $update_array['wap_weixin_isuse']   = $_POST['wap_weixin_isuse'];
            $update_array['wap_weixin_appid']   = $_POST['wap_weixin_appid'];
            $update_array['wap_weixin_secret']  = $_POST['wap_weixin_secret'];
            $result = $model_setting->updateSetting($update_array);
            if ($result){
                $this->log('第三方账号登录，WAP微信登录设置');
                showMessage(getLang('nc_common_save_succ'));
            }else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'wap_wx'));
//	Tpl::setDirquna('mobile');
//        Tpl::showpage('mb_connect_wap_wx.edit');
        $this->view->pick('connect/connect_wap_wx_edit');

    }

    /**
     * QQ互联登录
     */
    public function qqAction() {
        $model_setting = Model('setting');
        if (chksubmit()){
            $update_array = array();
            $update_array['app_qq_isuse']   = $_POST['app_qq_isuse'];
            $update_array['app_qq_akey']   = $_POST['app_qq_akey'];
            $update_array['app_qq_skey']  = $_POST['app_qq_skey'];
            $result = $model_setting->updateSetting($update_array);
            if ($result){
                $this->log('第三方账号登录，QQ互联登录设置');
                showMessage(getLang('nc_common_save_succ'));
            }else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'qq'));
//	Tpl::setDirquna('mobile');
//        Tpl::showpage('mb_connect_qq.edit');
        $this->view->pick('connect/connect_qq_edit');

    }

    /**
     * 新浪微博登录
     */
    public function sinaAction() {
        $model_setting = Model('setting');
        if (chksubmit()){
            $update_array = array();
            $update_array['app_sina_isuse']   = $_POST['app_sina_isuse'];
            $update_array['app_sina_akey']   = $_POST['app_sina_akey'];
            $update_array['app_sina_skey']  = $_POST['app_sina_skey'];
            $result = $model_setting->updateSetting($update_array);
            if ($result){
                $this->log('第三方账号登录，新浪微博登录设置');
                showMessage(getLang('nc_common_save_succ'));
            }else {
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting',$list_setting);
        //输出子菜单
        Tpl::output('top_link',$this->sublink($this->links,'sina'));
//	Tpl::setDirquna('mobile');
//        Tpl::showpage('mb_connect_sn.edit');
        $this->view->pick('connect/connect_sn_edit');
    }
}
