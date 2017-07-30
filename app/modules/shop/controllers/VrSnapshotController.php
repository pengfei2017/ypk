<?php
/**
 * 交易快照
 * User: Administrator
 * Date: 2016/12/10
 * Time: 21:00
 *
 * 采用的布局页面：home_layout（和首页一样的布局页）
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Tpl;

class VrSnapshotController extends BaseHomeController {

    public function initialize() {
        parent::initialize();
        //Tpl::setLayout('home_layout');
        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout("home_layout");
    }

    public function indexAction() {
        $order_id = intval($_GET['order_id']);
        if ($order_id <= 0) {
            showMessage('参数错误', '', 'html', 'error');
        }
        $model_order = Model('vr_order');
        $order_goods_info = $model_order->getOrderInfo(array('order_id' => $order_id));
        if (empty($order_goods_info)) {
            showMessage('参数错误，或者不是本人购买的商品', '', 'html', 'error');
        }
        $spec_array = array();
        if ($order_goods_info['goods_spec'] != '') {
            $spec = explode('，', $order_goods_info['goods_spec']);
            foreach ($spec as $key=>$val) {
                $param = explode('：', $val);
                $spec_array[$param[0]] = $param[1];
            }
        }
        $order_goods_info['goods_spec'] = $spec_array;

        //查询消费者保障服务
        if (getConfig('contract_allow') == 1 && !empty($order_goods_info['goods_contractid'])) {
            $contract_item = Model('contract')->getContractItemByCache();

            $goods_contractid_arr = explode(',',$order_goods_info['goods_contractid']);
            foreach ((array)$goods_contractid_arr as $gcti_v) {
                $order_goods_info['contractlist'][] = $contract_item[$gcti_v];
            }
        }

        $sp_hot_info = Model('vr_order_snapshot')->getSnapshotInfoByOrderid($order_id,$order_goods_info['goods_id']);
        $sp_hot_info['goods_attr'] = unserialize($sp_hot_info['goods_attr']);
        Tpl::output('goods', array_merge($order_goods_info,$sp_hot_info));


        $store_info = Model('store')->getStoreInfo(array('store_id' => $order_goods_info['store_id']));
        if (!empty($store_info) && $store_info['is_own_shop'] == 0) {
            Tpl::output('store_info', $store_info);
        }

        //Tpl::showpage('vr_snapshot');
        $this->view->render('vr_snapshot','vr_snapshot');
        $this->view->disable();
    }
}