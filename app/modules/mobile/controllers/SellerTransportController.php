<?php
/**
 * 商家运费模板
 */

namespace Ypk\Modules\Mobile\Controllers;


class SellerTransportController extends MobileSellerController {

    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->transport_listAction();
    }

    /**
     * 返回商家医生商品分类列表
     */
    public function transport_listAction() {
        $model_transport = Model('transport');
        $transport_list = $model_transport->getTransportList(array('store_id'=>$this->store_info['store_id']));
        output_data(array('transport_list' => $transport_list));
    }
}
