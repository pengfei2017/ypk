<?php

namespace Ypk\Modules\Mobile\Controllers;

use Phalcon\Mvc\View;
use Ypk\Tpl;

/**
 * 手机端首页控制器
 *
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/11
 * Time: 11:26
 */
class IndexController extends MobileHomeController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 首页
     */
    public function indexAction()
    {
        $model_mb_special = Model('mb_special');
        $data = $model_mb_special->getMbSpecialIndex();
        $this->_output_special($data, $_GET['type']);
    }

    /**
     * 专题
     */
    public function specialAction()
    {
        $model_mb_special = Model('mb_special');
        $info = $model_mb_special->getMbSpecialInfoByID($_GET['special_id']);
        $list = $model_mb_special->getMbSpecialItemUsableListByID($_GET['special_id']);
        $data = array_merge($info, array('list' => $list));
        $this->_output_special($data, $_GET['type'], $_GET['special_id']);
    }

    /**
     * 输出专题
     */
    private function _output_special($data, $type = 'json', $special_id = 0)
    {
        $model_special = Model('mb_special');
        if ($_GET['type'] == 'html') {
            $html_path = $model_special->getMbSpecialHtmlPath($special_id);
            if (!is_file($html_path)) {
                ob_start();
                Tpl::output('list', $data);
                $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
                $this->view->pick('common/mb_special');
                if (!file_exists(dirname($html_path))) {
                    mkDirs(dirname($html_path));
                }
                file_put_contents($html_path, ob_get_clean());
            }
            header('Location: ' . $model_special->getMbSpecialHtmlUrl($special_id));
            die;
        } else {
            output_data($data);
        }
    }

    /**
     * android客户端版本号
     */
    public function apk_versionAction()
    {
        $version = getConfig('mobile_apk_version');
        $url = getConfig('mobile_apk');
        if (empty($version)) {
            $version = '';
        }
        if (empty($url)) {
            $url = '';
        }

        output_data(array('version' => $version, 'url' => $url));
    }

    /**
     * 默认搜索词列表
     */
    public function search_key_listAction()
    {
        $list = @explode(',', getConfig('hot_search'));
        if (!$list || !is_array($list)) {
            $list = array();
        }
        if ($_COOKIE['hisSearch'] != '') {
            $his_search_list = explode('~', $_COOKIE['hisSearch']);
        }
        if (!$his_search_list || !is_array($his_search_list)) {
            $his_search_list = array();
        }
        output_data(array('list' => $list, 'his_list' => $his_search_list));
    }

    /**
     * 热门搜索列表
     */
    public function search_hot_infoAction()
    {
        $rec_search_list = null;
        if (getConfig('rec_search') != '') {
            $rec_search_list = @unserialize(getConfig('rec_search'));
        }
        $rec_search_list = is_array($rec_search_list) ? $rec_search_list : array();
        $result = $rec_search_list[array_rand($rec_search_list)];
        output_data(array('hot_info' => $result ? $result : array()));

        $this->view->disable();
    }

    /**
     * 高级搜索
     */
    public function search_advAction()
    {
        $area_list = Model('area')->getAreaList(array('area_deep' => 1), 'area_id,area_name');
        if (getConfig('contract_allow') == 1) {
            $contract_list = Model('contract')->getContractItemByCache();
            $_tmp = array();
            $i = 0;
            foreach ($contract_list as $k => $v) {
                $_tmp[$i]['id'] = $v['cti_id'];
                $_tmp[$i]['name'] = $v['cti_name'];
                $i++;
            }
        }
        output_data(array('area_list' => $area_list ? $area_list : array(), 'contract_list' => $_tmp));
    }

}