<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/13
 * Time: 18:06
 */

namespace Ypk\Modules\SystemManager\Controllers;

use Ypk\Logic\SettingLogic;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;
use Ypk\Validate;

/**
 * Class UploadController
 * @package Ypk\Modules\System\Controllers
 *
 * 上传设置
 */
class UploadController extends ControllerBase
{
    private $links = array(
        array('url' => array('module' => 'system_manager', 'controller' => 'upload', 'action' => 'param'), 'lang' => 'upload_param'),
        array('url' => array('module' => 'system_manager', 'controller' => 'upload', 'action' => 'default_thumb'), 'lang' => 'default_thumb'),
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,setting');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->paramAction();
        $this->view->render('upload', 'param');
    }

    /**
     * 上传参数设置
     *
     */
    public function paramAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["image_max_filesize"], "require" => "true", "validator" => "Number", "message" => $this->translation->_('upload_image_filesize_is_number')),
                array("input" => trim($_POST["image_allow_ext"]), "require" => "true", "validator" => "", "message" => $this->translation->_('image_allow_ext_not_null'))
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $model_setting = new SettingLogic();
                $result = $model_setting->updateSetting(array(
                        'image_max_filesize' => intval($_POST['image_max_filesize']),
                        'image_allow_ext' => $_POST['image_allow_ext'])
                );
                if ($result) {
                    $this->log($this->translation->_('nc_edit') . $this->translation->_('upload_param'), 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'));
                } else {
                    $this->log($this->translation->_('nc_edit') . $this->translation->_('upload_param'), 0);
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

        //获取默认图片设置属性
        $model_setting = new SettingLogic();
        $list_setting = $model_setting->getListSetting();
        $this->view->setVar('list_setting', $list_setting);

        //输出子菜单
        $this->view->setVar('top_link', $this->sublink($this->links, 'param'));
    }

    /**
     * 默认图设置
     */
    public function default_thumbAction()
    {
        $model_setting = new SettingLogic();
        if (chksubmit()) {
            //上传图片
            $upload = new UploadFile();
            $upload->set('default_dir', ATTACH_COMMON);
            //默认会员头像
            if (!empty($_FILES['default_user_portrait']['tmp_name'])) {
                $thumb_width = '32';
                $thumb_height = '32';

                $upload->set('thumb_width', $thumb_width);
                $upload->set('thumb_height', $thumb_height);
                $upload->set('thumb_ext', '_small');
                $upload->set('file_name', '');
                $result = $upload->upfile('default_user_portrait');
                if ($result) {
                    $_POST['default_user_portrait'] = $upload->file_name;
                } else {
                    $this->showMessage($upload->error, '', '', 'error');
                }
            }
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            if (!empty($_POST['default_user_portrait'])) {
                $update_array['default_user_portrait'] = $_POST['default_user_portrait'];
            }
            if (!empty($update_array)) {
                $result = $model_setting->updateSetting($update_array);
            } else {
                $result = true;
            }
            if ($result === true) {
                //判断有没有之前的图片，如果有则删除
                if (!empty($list_setting['default_user_portrait']) && !empty($_POST['default_user_portrait'])) {
                    @unlink(BASE_UPLOAD_PATH . DS . ATTACH_COMMON . DS . $list_setting['default_user_portrait']);
                    @unlink(BASE_UPLOAD_PATH . DS . ATTACH_COMMON . DS . str_ireplace(',', '_small.', $list_setting['default_user_portrait']));
                }
                $this->log($this->translation->_('nc_edit') . $this->translation->_('default_thumb'), 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'));
            } else {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('default_thumb'), 0);
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }

        $list_setting = $model_setting->getListSetting();

        //模板输出
        $this->view->setVar('list_setting', $list_setting);

        //输出子菜单
        $this->view->setVar('top_link', $this->sublink($this->links, 'default_thumb'));

        //Tpl::showpage('upload.thumb');
    }
}