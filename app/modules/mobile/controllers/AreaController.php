<?php
/**
 * 地区
 *
 */
namespace Ypk\Modules\Mobile\Controllers;


class AreaController extends MobileHomeController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $this->area_listAction();
    }

    /**
     * 地区列表
     */
    public function area_listAction()
    {
        $area_id = intval($_GET['area_id']);

        $model_area = Model('area');

        $condition = array();
        if ($area_id > 0) {
            $condition['area_parent_id'] = $area_id;
        } else {
            $condition['area_deep'] = 1;
        }
        $area_list = $model_area->getAreaList($condition, 'area_id,area_name');
        output_data(array('area_list' => $area_list));
    }

}
