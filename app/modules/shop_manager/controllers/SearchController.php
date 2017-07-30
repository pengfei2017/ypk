<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 15:45
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\SettingLogic;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class SearchController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-搜索设置
 */

class SearchController extends ControllerBase{

    private $_links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'search', 'action' => 'index'), 'text' => '默认搜索'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'search', 'action' => 'hot'), 'text' => '热门搜索'),
    );

    public function initialize(){
        parent::initialize();
        $this->translation = getTranslation('setting,layout');
        $this->view->setVar('lang', $this->translation);
    }

    /**
     * 默认搜索
     */
    public function indexAction() {
        if (chksubmit()){
            $model_setting = new SettingLogic();
            $comma = '，';
//            if (strtoupper(CHARSET) == 'GBK'){
//                $comma = Language::getGBK($comma);
//            }
            $result = $model_setting->updateSetting(array(
                'hot_search'=>str_replace($comma,',',$_POST['hot_search'])));
            if ($result){
                $this->showMessage('保存成功');
            }else {
                $this->showMessage('保存失败');
            }
        }
        $model_setting = new SettingLogic();
        $list_setting = $model_setting->getListSetting();

        $this->view->setVar('list_setting',$list_setting);
        $this->view->setVar('top_link',$this->sublink($this->_links,'index'));
    }

    /**
     * 热门搜索词列表
     */
    public function hotAction() {
        $model_setting = new SettingLogic();
        $search_info = $model_setting->getRowSetting('rec_search');
        if ($search_info !== false) {
            $search_list = @unserialize($search_info['value']);
        }
        if (!$search_list && !is_array($search_list)) {
            $search_list = array();
        }
        $this->view->setVar('search_list',$search_list);
        $this->view->setVar('top_link',$this->sublink($this->_links,'hot'));
    }

    /**
     * 热搜词添加
     */
    public function hot_addAction() {
        $model_setting = new SettingLogic();
        $search_info = $model_setting->getRowSetting('rec_search');
        if ($search_info !== false) {
            $search_list = @unserialize($search_info['value']);
        }
        if (!$search_list && !is_array($search_list)) {
            $search_list = array();
        }
        if (chksubmit()) {
            if (count($search_list) >= 10) {
                $this->showMessage('最多可设置10个热搜词',getUrl('shop_manager/search/hot'));
            }
            if ($_POST['s_name'] != '' && $_POST['s_value'] != '') {
                $data = array('name'=>stripslashes($_POST['s_name']),'value'=>stripslashes($_POST['s_value']));
                array_unshift($search_list, $data);
            }
            $result = $model_setting->updateSetting(array('rec_search'=>serialize($search_list)));
            if ($result){
                $this->showMessage('保存成功',getUrl('shop_manager/search/hot'));
            }else {
                $this->showMessage('保存失败');
            }
        }
    }

    /**
     * 删除
     */
    public function hot_delAction() {
        $model_setting = new SettingLogic();
        $search_info = $model_setting->getRowSetting('rec_search');
        if ($search_info !== false) {
            $search_list = @unserialize($search_info['value']);
        }
        if (!empty($search_list) && is_array($search_list) && intval($_GET['id']) >= 0) {
            unset($search_list[intval($_GET['id'])]);
        }
        if (!is_array($search_list)) {
            $search_list = array();
        }
        $result = $model_setting->updateSetting(array('rec_search'=>serialize(array_values($search_list))));
        if ($result){
            $this->showMessage('删除成功');
        }
        $this->showMessage('删除失败');
    }

    /**
     * 编辑
     */
    public function hot_editOp() {
        $model_setting = new SettingLogic();
        $search_info = $model_setting->getRowSetting('rec_search');
        if ($search_info !== false) {
            $search_list = @unserialize($search_info['value']);
        }
        if (!is_array($search_list)) {
            $search_list = array();
        }
        if (!chksubmit()) {
            if (!empty($search_list) && is_array($search_list) && intval($_GET['id']) >= 0) {
                $current_info = $search_list[intval($_GET['id'])];
            }
            $this->view->setVar('current_info',is_array($current_info) ? $current_info : array());

        } else {
            if ($_POST['s_name'] != '' && $_POST['s_value'] != '' && $_POST['id'] != '' && intval($_POST['id']) >= 0) {
                $search_list[intval($_POST['id'])] = array('name'=>stripslashes($_POST['s_name']),'value'=>stripslashes($_POST['s_value']));
            }
            $result = $model_setting->updateSetting(array('rec_search'=>serialize($search_list)));
            if ($result){
                $this->showMessage('编辑成功',getUrl('shop_manager/search/hot'));
            }
            $this->showMessage('编辑失败');
        }
    }
}