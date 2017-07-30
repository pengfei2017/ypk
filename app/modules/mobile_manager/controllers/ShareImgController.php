<?php
/**
 * 设置手机端分享二维码背景图片
 * User: Administrator
 * Date: 2017/1/6
 * Time: 16:06
 */

namespace Ypk\Modules\MobileManager\Controllers;


use Ypk\Logic\SettingLogic;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;

class ShareImgController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,setting,layout');
    }

    public function indexAction()
    {
        $model_setting = new SettingLogic();
        $list_setting = $model_setting->getListSetting();
        $list = array();
        if ($list_setting['mobile_code_pic'] != '') {
            $list = unserialize($list_setting['mobile_code_pic']);
        }
        $this->view->setVar('list', $list);
        $this->view->setVar('list_setting', $list_setting);
    }

    /**
     * 保存上传的图片
     */
    public function saveImgAction()
    {
        //上传图片的存放位置 ATTACH_MOBILE.'/codeimg'
        $model_setting = new SettingLogic();
        $input = array();
        //上传图片
        $upload = new UploadFile();
        $upload->set('default_dir', ATTACH_MOBILE . '/codeimg');
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

        $upload->set('default_dir', ATTACH_MOBILE . '/codeimg');
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

        $upload->set('default_dir', ATTACH_MOBILE . '/codeimg');
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

        $upload->set('default_dir', ATTACH_MOBILE . '/codeimg');
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
            $update_array['mobile_code_pic'] = serialize($input);
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
}