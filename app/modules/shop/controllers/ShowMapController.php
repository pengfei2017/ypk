<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/8
 * Time: 18:35
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Tpl;

class ShowMapController extends BaseHomeController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 店铺地址地图
     *
     */
    public function indexAction()
    {
        if (empty($_GET['w'])) {
            $_GET['w'] = 500;
        }
        if (empty($_GET['h'])) {
            $_GET['h'] = 500;
        }

        $model_store_map = Model('store_map');
        $store_id = intval($_GET['store_id']);
        if ($store_id > 0) {
            $condition = array();
            $condition['store_id'] = $store_id;
            $map_list = $model_store_map->getStoreMapList($condition, '', '', 'map_id asc');
            Tpl::output('map_list', $map_list);
            //Tpl::showpage('show_map', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        }
    }
}