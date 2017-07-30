<?php
/**
 * wdb
 * 前台品牌分类
 */

namespace Ypk\Modules\Mobile\Controllers;


class brandController extends MobileHomeController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function recommend_listAction()
    {
        $brand_list = Model('brand')->getBrandPassedList(array('brand_recommend' => '1'), 'brand_id,brand_name,brand_pic');
        if (!empty($brand_list)) {
            foreach ($brand_list as $key => $val) {
                $brand_list[$key]['brand_pic'] = brandImage($val['brand_pic']);
            }
        }
        output_data(array('brand_list' => $brand_list));
    }
}
