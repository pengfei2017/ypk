<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 13:09
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\SettingLogic;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;

/**
 * Class UploadController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-图片设置
 */
class UploadController extends ControllerBase{
    private $links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'upload', 'action' => 'param'), 'lang' => 'upload_param'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'upload', 'action' => 'default_thumb'), 'lang' => 'default_thumb'),
//        array('url' => array('module' => 'shop_manager', 'controller' => 'upload', 'action' => 'font'), 'lang' => 'font_set'),
    );

    public function initialize(){
        parent::initialize();
        $this->translation = getTranslation('setting,layout');
        $this->view->setVar('lang', $this->translation); //设置语言包
    }

    public function indexAction() {
        $this->paramAction();
        $this->view->render('upload','param');
    }

    /**
     * 上传参数设置
     *
     */
    public function paramAction(){
        if (chksubmit()){
            $model_setting = new SettingLogic();
            $result = $model_setting->updateSetting(array('image_dir_type'=>intval($_POST['image_dir_type'])));
            if ($result){
                $this->log($this->translation['nc_edit,upload_param'],1);
                $this->showMessage($this->translation['nc_common_save_succ']);
            }else {
                $this->log($this->translation['nc_edit,upload_param'],0);
                $this->showMessage($this->translation['nc_common_save_fail']);
            }
        }

        //获取默认图片设置属性
        $model_setting = new SettingLogic();
        $list_setting = $model_setting->getListSetting();

        $this->view->setVar('list_setting',$list_setting);

        //输出子菜单
        $this->view->setVar('top_link',$this->sublink($this->links,'param'));
    }

    /**
     * 默认图设置
     */
    public function default_thumbAction(){
        $model_setting = new SettingLogic();
        if (chksubmit()){
            //上传图片
            $upload = new UploadFile();
            $upload->set('default_dir',ATTACH_COMMON);
            //默认商品图片
            if (!empty($_FILES['default_goods_image']['tmp_name'])){
                $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->set('thumb_ext', GOODS_IMAGES_EXT);
                $upload->set('filling',false);
                $result = $upload->upfile('default_goods_image');
                if ($result){
                    $_POST['default_goods_image'] = $upload->file_name;
                }else {
                    $this->showMessage($upload->error);
                }
            }
            //默认医生标志
            if (!empty($_FILES['default_store_logo']['tmp_name'])){
                $upload->set('file_name', '');
                $upload->set('thumb_width', 0);
                $upload->set('thumb_height',0);
                $upload->set('thumb_ext',   false);
                $result = $upload->upfile('default_store_logo');
                if ($result){
                    $_POST['default_store_logo'] = $upload->file_name;
                }else {
                    $this->showMessage($upload->error);
                }
            }
            //默认医生头像
            if (!empty($_FILES['default_store_avatar']['tmp_name'])){
                $upload->set('file_name', '');
                $upload->set('thumb_width', 0);
                $upload->set('thumb_height',0);
                $upload->set('thumb_ext',   false);
                $result = $upload->upfile('default_store_avatar');
                if ($result){
                    $_POST['default_store_avatar'] = $upload->file_name;
                }else {
                    $this->showMessage($upload->error);
                }
            }
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            if (!empty($_POST['default_goods_image'])){
                $update_array['default_goods_image'] = $_POST['default_goods_image'];
            }
            if (!empty($_POST['default_store_logo'])){
                $update_array['default_store_logo'] = $_POST['default_store_logo'];
            }
            if (!empty($_POST['default_store_avatar'])){
                $update_array['default_store_avatar'] = $_POST['default_store_avatar'];
            }
            if (!empty($update_array)){
                $result = $model_setting->updateSetting($update_array);
            }else{
                $result = true;
            }
            if ($result === true){
                //判断有没有之前的图片，如果有则删除
                if (!empty($list_setting['default_goods_image']) && !empty($_POST['default_goods_image'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['default_goods_image']);
                    $img_ext = explode(',', GOODS_IMAGES_EXT);
                    foreach ($img_ext as $val) {
                        @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.str_ireplace('.', $val . '.', $list_setting['default_goods_image']));
                    }
                }
                if (!empty($list_setting['default_store_logo']) && !empty($_POST['default_store_logo'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['default_store_logo']);
                }
                $this->log($this->translation['nc_edit,default_thumb'],1);
                $this->showMessage($this->translation['nc_common_save_succ']);
            }else {
                $this->log($this->translation['nc_edit,default_thumb'],0);
                $this->showMessage($this->translation['nc_common_save_fail']);
            }
        }

        $list_setting = $model_setting->getListSetting();

        //模板输出
        $this->view->setVar('list_setting',$list_setting);

        //输出子菜单
        $this->view->setVar('top_link',$this->sublink($this->links,'default_thumb'));
    }

    /**
     * 水印字体
     */
    public function fontAction(){
        //获取水印字体
        $dir_list = array();
        readFileList(RESOURCE_SITE_URL.DS.'font',$dir_list);
        if (!empty($dir_list) && is_array($dir_list)){
            $fontInfo = array();
            include RESOURCE_SITE_URL.DS.'font'.DS.'font.info.php';
            foreach ($dir_list as $value){
                $file_ext_array = explode('.',$value);
                if (strtolower(end($file_ext_array)) == 'ttf' && file_exists($value)){
                    $file_path_array = explode('/', $value);
                    $value = array_pop($file_path_array);
                    $tmp = explode('.',$value);
                    $file_list[$value] = $fontInfo[$tmp[0]];
                }
            }
            $this->view->setVar('file_list',$file_list);
        }
        $this->view->setVar('top_link',$this->sublink($this->links,'font'));
    }

}