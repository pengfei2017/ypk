<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/13
 * Time: 0:06
 */

namespace Ypk\Modules\SystemManager\Controllers;


use Ypk\Logic\SettingLogic;
use \Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;

/**
 * Class SettingController
 * @package Ypk\Modules\System\Controllers
 *
 * 网站设置
 */
class SettingController extends ControllerBase
{
    private $links = array(
        array('url' => array('module' => 'system_manager', 'controller' => 'setting', 'action' => 'base'), 'lang' => 'web_set'),
        array('url' => array('module' => 'system_manager', 'controller' => 'setting', 'action' => 'dump'), 'lang' => 'dis_dump'),
        array('url' => array('module' => 'system_manager', 'controller' => 'setting', 'action' => 'login'), 'lang' => 'loginSettings'),
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,setting,layout');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->baseAction();
        //因为调用了baseAction，而没有index.phtml模板页面，调用的是baseAction模板页面，所以要指定用base.phtml模板页面
        $this->view->render('setting', 'base');
    }

    /**
     * 基本信息
     */
    public function baseAction()
    {
        $model_setting = new SettingLogic();
        if (chksubmit()) {
            $update_array = array();
            $update_array['time_zone'] = $this->setTimeZone($_POST['time_zone']);
            $update_array['site_name'] = $_POST['site_name'];
            $update_array['statistics_code'] = $_POST['statistics_code'];
            $update_array['icp_number'] = $_POST['icp_number'];
            $update_array['site_status'] = $_POST['site_status'];
            $update_array['closed_reason'] = $_POST['closed_reason'];
            $result = $model_setting->updateSetting($update_array);
            if ($result === true) {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('web_set'), 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'));
            } else {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('web_set'), 0);
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        foreach ($this->getTimeZone() as $k => $v) {
            if ($v == $list_setting['time_zone']) {
                $list_setting['time_zone'] = $k;
                break;
            }
        }
        $this->view->setVar('list_setting', $list_setting);

        //输出子菜单
        $this->view->setVar('top_link', $this->sublink($this->links, 'base'));
    }

    /**
     * 防灌水设置
     */
    public function dumpAction()
    {
        $model_setting = new SettingLogic();
        if (chksubmit()) {
            $update_array = array();
            $update_array['captcha_status_login'] = $_POST['captcha_status_login'];
            $update_array['captcha_status_register'] = $_POST['captcha_status_register'];
            $result = $model_setting->updateSetting($update_array);
            if ($result === true) {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('dis_dump'), 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'));
            } else {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('dis_dump'), 0);
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        $this->view->setVar('list_setting', $list_setting);
        $this->view->setVar('top_link', $this->sublink($this->links, 'dump'));
    }

    /**
     * 设置时区
     * @param int $time_zone 时区键值
     * @return mixed|string
     */
    private function setTimeZone($time_zone)
    {
        $zonelist = $this->getTimeZone();
        return (!isset($zonelist[$time_zone]) || empty($zonelist[$time_zone])) ? 'Asia/Shanghai' : $zonelist[$time_zone];
    }

    private function getTimeZone()
    {
        return array(
            '-12' => 'Pacific/Kwajalein',
            '-11' => 'Pacific/Samoa',
            '-10' => 'US/Hawaii',
            '-9' => 'US/Alaska',
            '-8' => 'America/Tijuana',
            '-7' => 'US/Arizona',
            '-6' => 'America/Mexico_City',
            '-5' => 'America/Bogota',
            '-4' => 'America/Caracas',
            '-3.5' => 'Canada/Newfoundland',
            '-3' => 'America/Buenos_Aires',
            '-2' => 'Atlantic/St_Helena',
            '-1' => 'Atlantic/Azores',
            '0' => 'Europe/Dublin',
            '1' => 'Europe/Amsterdam',
            '2' => 'Africa/Cairo',
            '3' => 'Asia/Baghdad',
            '3.5' => 'Asia/Tehran',
            '4' => 'Asia/Baku',
            '4.5' => 'Asia/Kabul',
            '5' => 'Asia/Karachi',
            '5.5' => 'Asia/Calcutta',
            '5.75' => 'Asia/Katmandu',
            '6' => 'Asia/Almaty',
            '6.5' => 'Asia/Rangoon',
            '7' => 'Asia/Bangkok',
            '8' => 'Asia/Shanghai',
            '9' => 'Asia/Tokyo',
            '9.5' => 'Australia/Adelaide',
            '10' => 'Australia/Canberra',
            '11' => 'Asia/Magadan',
            '12' => 'Pacific/Auckland'
        );
    }

    /**
     * 登录主题图片
     */
    public function loginAction()
    {
        $model_setting = new SettingLogic();
        if (chksubmit()) {
            $input = array();
            //上传图片
            $upload = new UploadFile();
            $upload->set('default_dir', ATTACH_PATH . '/login');
            $upload->set('thumb_ext', '');
            $upload->set('file_name', '1.jpg');
            $upload->set('ifremove', false);
            if (!empty($_FILES['login_pic1']['name'])) {
                $result = $upload->upfile('login_pic1');
                if (!$result) {
                    $this->showMessage($upload->error, '', '', 'error');
                } else {
                    $input[] = $upload->file_name;
                }
            } elseif ($_POST['old_login_pic1'] != '') {
                $input[] = $_POST['old_login_pic1'];
            }

            $upload->set('default_dir', ATTACH_PATH . '/login');
            $upload->set('thumb_ext', '');
            $upload->set('file_name', '2.jpg');
            $upload->set('ifremove', false);
            if (!empty($_FILES['login_pic2']['name'])) {
                $result = $upload->upfile('login_pic2');
                if (!$result) {
                    $this->showMessage($upload->error, '', '', 'error');
                } else {
                    $input[] = $upload->file_name;
                }
            } elseif ($_POST['old_login_pic2'] != '') {
                $input[] = $_POST['old_login_pic2'];
            }

            $upload->set('default_dir', ATTACH_PATH . '/login');
            $upload->set('thumb_ext', '');
            $upload->set('file_name', '3.jpg');
            $upload->set('ifremove', false);
            if (!empty($_FILES['login_pic3']['name'])) {
                $result = $upload->upfile('login_pic3');
                if (!$result) {
                    $this->showMessage($upload->error, '', '', 'error');
                } else {
                    $input[] = $upload->file_name;
                }
            } elseif ($_POST['old_login_pic3'] != '') {
                $input[] = $_POST['old_login_pic3'];
            }

            $upload->set('default_dir', ATTACH_PATH . '/login');
            $upload->set('thumb_ext', '');
            $upload->set('file_name', '4.jpg');
            $upload->set('ifremove', false);
            if (!empty($_FILES['login_pic4']['name'])) {
                $result = $upload->upfile('login_pic4');
                if (!$result) {
                    $this->showMessage($upload->error, '', '', 'error');
                } else {
                    $input[] = $upload->file_name;
                }
            } elseif ($_POST['old_login_pic4'] != '') {
                $input[] = $_POST['old_login_pic4'];
            }

            $update_array = array();
            if (count($input) > 0) {
                $update_array['login_pic'] = serialize($input);
            }

            $result = $model_setting->updateSetting($update_array);
            if ($result === true) {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('loginSettings'), 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'));
            } else {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('loginSettings'), 0);
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        $list = array();
        if ($list_setting['login_pic'] != '') {
            $list = unserialize($list_setting['login_pic']);
        }
        $this->view->setVar('list', $list);
        $this->view->setVar('list_setting', $list_setting);
        $this->view->setVar('top_link', $this->sublink($this->links, 'login'));
    }
}