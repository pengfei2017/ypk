<?php
/**
 * 商家医生商品分类
 */

namespace Ypk\Modules\Mobile\Controllers;


class SellerStoreGoodsClassController extends MobileSellerController {

    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->class_listAction();
    }

    /**
     * 返回商家医生商品分类列表
     */
    public function class_listAction() {
        $store_goods_class = Model('store_goods_class')->getStoreGoodsClassPlainList($this->store_info['store_id']);
        output_data(array('class_list' => $store_goods_class));
    }
}
