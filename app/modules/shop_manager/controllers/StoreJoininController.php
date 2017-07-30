<?php
/**
 * 商家入驻
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\HelpLogic;
use Ypk\Logic\SellerLogic;
use Ypk\Logic\SettingLogic;
use Ypk\Logic\UploadLogic;
use Ypk\Models\Help;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;

class StoreJoininController extends ControllerBase
{
    public function initialize(){
        parent::initialize();
        $this->translation = getTranslation('common,setting,layout');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction() {
        $this->edit_infoAction();
    }

    /**
     * 前台头部图片传
     */
    public function edit_infoAction() {
        $size = 3;//上传显示图片总数
        $i = 1;
        $info['pic'] = array();
        $info['show_txt'] = '';
        $model_setting = new SettingLogic();
        $code_info = $model_setting->getRowSetting('store_joinin_pic');
        if(!empty($code_info['value'])) {
            $info = unserialize($code_info['value']);
        }
        if (chksubmit()) {
            $info['show_txt'] = $_POST['show_txt'];
            for ($i;$i <= $size;$i++) {
                $file = 'pic'.$i;
                $info['pic'][$i] = $_POST['show_pic'.$i];
                if (!empty($_FILES[$file]['name'])) {//上传图片
                    $filename_tmparr = explode('.', $_FILES[$file]['name']);
                    $ext = end($filename_tmparr);
                    $file_name = 'store_joinin_'.$i.'.'.$ext;
                    $upload = new UploadFile();
                    $upload->set('default_dir',ATTACH_COMMON);
                    $upload->set('file_name',$file_name);
                    $result = $upload->upfile($file);
                    if ($result) {
                        $info['pic'][$i] = $file_name;
                    }
                }
            }
            $code_info = serialize($info);
            $update_array = array();
            $update_array['store_joinin_pic'] = $code_info;
            $result = $model_setting->updateSetting($update_array);
            $this->showMessage($this->translation->_('nc_common_save_succ'),getUrl('shop_manager/store_joinin/edit_info'));
        }
        $this->view->setVar('size',$size);
        $this->view->setVar('pic',$info['pic']);
        $this->view->setVar('show_txt',$info['show_txt']);
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_joinin_pic');
        $this->view->pick('store_joinin/store_joinin');
    }

    /**
     * 入驻指南
     *
     */
    public function help_listAction() {
        $model_help = new HelpLogic();
        $condition = array();
        $condition['type_id'] = '1';
        $help_list = $model_help->getStoreHelpList($condition);
        $this->view->setVar('help_list',$help_list);
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_joinin_help');
        $this->view->pick('store_joinin/store_joinin_help');
    }
    /**
     * 编辑入驻指南
     *
     */
    public function edit_helpAction() {
        $model_help = new HelpLogic();
        $condition = array();
        $help_id = intval($_GET['help_id']);
        $condition['help_id'] = $help_id;
        $help_list = $model_help->getStoreHelpList($condition);
        $help = $help_list[0];
        $this->view->setVar('help',$help);
        if (chksubmit()) {
            $help_array = array();
            $help_array['help_title'] = $_POST['help_title'];
            $help_array['help_info'] = $_POST['content'];
            $help_array['help_sort'] = intval($_POST['help_sort']);
            $help_array['update_time'] = time();
            $state = $model_help->editHelp($condition, $help_array);
            if ($state) {
                $this->log('编辑医生入驻指南，编号'.$help_id);
                $this->showMessage($this->translation->_('nc_common_save_succ'),getUrl('shop_manager/store_joinin/help_list'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $condition = array();
        $condition['item_id'] = $help_id;
        $pic_list = $model_help->getHelpPicList($condition);
        $this->view->setVar('pic_list',$pic_list);
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_joinin_help.edit');
        $this->view->pick('store_joinin/store_joinin_help_edit');
    }

    /**
     * 上传图片
     */
    public function upload_picAction() {
        $data = array();
        if (!empty($_FILES['fileupload']['name'])) {//上传图片
            $fprefix = 'help_store';
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_ARTICLE);
            $upload->set('fprefix',$fprefix);
            $upload->upfile('fileupload');
            $model_upload = new UploadLogic();
            $file_name = $upload->file_name;
            $insert_array = array();
            $insert_array['file_name'] = $file_name;
            $insert_array['file_size'] = $_FILES['fileupload']['size'];
            $insert_array['upload_time'] = time();
            $insert_array['item_id'] = intval($_GET['item_id']);
            $insert_array['upload_type'] = '2';
            $result = $model_upload->add($insert_array);
            if ($result) {
                $data['file_id'] = $result;
                $data['file_name'] = $file_name;
            }
        }
        echo json_encode($data);exit;
    }

    /**
     * 删除图片
     */
    public function del_picAction() {
        $condition = array();
        $condition['conditions'] = 'upload_id='.intval($_GET['file_id']);
        $model_help = new HelpLogic();
        $state = $model_help->delHelpPic($condition);
        if ($state) {
            echo 'true';exit;
        } else {
            echo 'false';exit;
        }
    }
}



