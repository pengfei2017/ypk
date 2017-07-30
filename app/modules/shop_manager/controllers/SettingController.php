<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/13
 * Time: 0:06
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\SeoLogic;
use Ypk\Logic\SettingLogic;
use Ypk\Models\Seo;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;

/**
 * Class SettingController
 * @package Ypk\Modules\Shop_manager\Controllers
 *
 * 商城-设置-商城设置
 */

class SettingController extends ControllerBase{
    private $links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'setting', 'action' => 'base'), 'lang' => 'web_set'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'setting', 'action' => 'dump'), 'lang' => 'dis_dump')
    );

    public function initialize(){
        parent::initialize();
        $this->translation = getTranslation('layout,setting,common');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction() {
        $this->baseAction();
        $this->view->render('setting', 'base');
    }

    /**
     * 基本信息
     */
    public function baseAction(){
        $model_setting = new SettingLogic();
        if (chksubmit()){
            //上传网站Logo
            if (!empty($_FILES['site_logo']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_COMMON);
                $result = $upload->upfile('site_logo');
                if ($result){
                    $_POST['site_logo'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            if (!empty($_FILES['member_logo']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_COMMON);
                $result = $upload->upfile('member_logo');
                if ($result){
                    $_POST['member_logo'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            if (!empty($_FILES['seller_center_logo']['name'])){
                $upload = new UploadFile();
                $upload->set('default_dir',ATTACH_COMMON);
                $result = $upload->upfile('seller_center_logo');
                if ($result){
                    $_POST['seller_center_logo'] = $upload->file_name;
                }else {
                    showMessage($upload->error,'','','error');
                }
            }
            $list_setting = $model_setting->getListSetting();
            $update_array = array();
            $update_array['site_phone'] = $_POST['site_phone'];
            $update_array['site_email'] = $_POST['site_email'];
            if (!empty($_POST['site_logo'])){
                $update_array['site_logo'] = $_POST['site_logo'];
            }
            if (!empty($_POST['member_logo'])){
                $update_array['member_logo'] = $_POST['member_logo'];
            }
            if (!empty($_POST['seller_center_logo'])){
                $update_array['seller_center_logo'] = $_POST['seller_center_logo'];
            }
            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                //判断有没有之前的图片，如果有则删除
                if (!empty($list_setting['site_logo']) && !empty($_POST['site_logo'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['site_logo']);
                }
                if (!empty($list_setting['member_logo']) && !empty($_POST['member_logo'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['member_logo']);
                }
                if (!empty($list_setting['seller_center_logo']) && !empty($_POST['seller_center_logo'])){
                    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['seller_center_logo']);
                }
                $this->log(getLang('nc_edit,web_set'),1);
                showMessage(getLang('nc_common_save_succ'));
            }else {
                $this->log(getLang('nc_edit,web_set'),0);
                showMessage(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();

        $this->view->setVar('list_setting',$list_setting);

        //输出子菜单
        $this->view->setVar('top_link',$this->sublink($this->links,'base'));
    }

    /**
     * 防灌水设置
     */
    public function dumpAction(){
        $model_setting = new SettingLogic();
        if (chksubmit()){
            $update_array = array();
            $update_array['guest_comment'] = $_POST['guest_comment'];
            $update_array['captcha_status_goodsqa'] = $_POST['captcha_status_goodsqa'];
            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                $this->log($this->translation['nc_edit,dis_dump'],1);
                $this->showMessage($this->translation['nc_common_save_succ']);
            }else {
                $this->log($this->translation['nc_edit,dis_dump'],0);
                $this->showMessage($this->translation['nc_common_save_fail']);
            }
        }
        $list_setting = $model_setting->getListSetting();
        $this->view->setVar('list_setting',$list_setting);
        $this->view->setVar('top_link',$this->sublink($this->links,'dump'));
    }

    /**
     * SEO与rewrite设置
     */
    public function seoAction(){
        $model_setting = new SettingLogic();
        if (chksubmit()){
            $update_array = array();
            $update_array['rewrite_enabled'] = $_POST['rewrite_enabled'];
            $result = $model_setting->updateSetting($update_array);
            if ($result === true){
                $this->log($this->translation['nc_edit,nc_seo_set'],1);
                $this->showMessage($this->translation['nc_common_save_succ']);
            }else {
                $this->log($this->translation['nc_edit,nc_seo_set'],0);
                $this->showMessage($this->translation['nc_common_save_fail']);
            }
        }
        $list_setting = $model_setting->getListSetting();

        //读取SEO信息
        $list = (new SeoLogic())->getAllList();
        $seo = array();
        if($list){
            foreach ((array)$list as $value) {
                $seo[$value['type']] = $value;
            }
        }

        $this->view->setVar('list_setting',$list_setting);
        $this->view->setVar('seo',$seo);

        $category = Model('goods_class')->getGoodsClassForCacheModel();
        $this->view->setVar('category',$category);
    }

    public function ajax_categoryAction(){
        $bulder=$this->modelsManager->createBuilder();
        $list=$bulder->columns(array('gc_title','gc_keywords','gc_description'))
                     ->from('\Phalcon\Mvc\Model\GoodsClass')
                     ->where('gc_id=:id:',array('id'=>intval($_GET['id'])));
        echo json_encode($list);exit();
    }

    /**
     * SEO设置保存
     */
    public function seo_updateAction(){
        $model_seo = new Seo();
        if (chksubmit()){
            $update = array();
            if (is_array($_POST['SEO'][0])){
                $seo = $_POST['SEO'][0];
            }else{
                $seo = $_POST['SEO'];
            }
            foreach ((array)$seo as $key=>$value) {
                $model_seo->where(array('type'=>$key))->update($value);
                $seo=Seo::findFirst("type=$key");
                $seo->setType($value);
                $seo->save();
            }
            delete_file_cache('seo');
            showMessage(getLang('nc_common_save_succ'));
        }else{
            showMessage(getLang('nc_common_save_fail'));
        }
    }

    /**
     * 分类SEO保存
     *
     */
    public function seo_categoryAction(){
        if (chksubmit()){
            $where = array('gc_id' => intval($_POST['category']));
            $input = array();
            $input['gc_title'] = $_POST['cate_title'];
            $input['gc_keywords'] = $_POST['cate_keywords'];
            $input['gc_description'] = $_POST['cate_description'];
            if (Model('goods_class')->editGoodsClass($input, $where)){
                delete_file_cache('goods_class_seo');
                showMessage(getLang('nc_common_save_succ'));
            }
        }
        showMessage(getLang('nc_common_save_fail'));
    }

    /**
     * 设置时区
     * @param mixed $time_zone 时区键值
     * @return mixed|string
     */
    private function setTimeZone($time_zone){
        $zonelist = $this->getTimeZone();
        return empty($zonelist[$time_zone]) ? 'Asia/Shanghai' : $zonelist[$time_zone];
    }

    private function getTimeZone(){
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
}