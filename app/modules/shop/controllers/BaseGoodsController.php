<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 20:24
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Logic\StoreLogic;
use Ypk\Tpl;

class BaseGoodsController extends BaseStoreController
{
    public function initialize()
    {
        parent::initialize();

        $this->translation = getTranslation('common,store_layout');
        $this->view->setVar('lang', $this->translation);

        Tpl::output('setting_config',$GLOBALS['setting_config']);
        $this->view->setVar('setting_config',$GLOBALS['setting_config']);

        if (!getConfig('site_status')) {
            $this->showMessage(getConfig('closed_reason'));
        }

        //Tpl::setLayout('home_layout');
        //$this->view->setRenderLevel(SHOP_LAYOUT_DIR);
        //$this->view->setLayout("home_layout");

        //输出头部的公用信息
        $this->showLayout();
        //输出会员信息
        $this->getMemberAndGradeInfo(false);
    }

    /**
     * 获取店铺信息
     * @param $store_id
     * @param null $goods_info
     */
    protected function getStoreInfo($store_id, $goods_info = null)
    {
        $model_store = Model('store');
        $store_info = $model_store->getStoreOnlineInfoByID($store_id);
        if (empty($store_info)) {
            $this->showMessage($this->translation->_('nc_store_close'), '', '', 'error');
        }
        if ($_COOKIE['dregion']) {
            $store_info['deliver_region'] = $_COOKIE['dregion'];
        }
        if (strpos($store_info['deliver_region'], '|')) {
            $store_info['deliver_region'] = explode('|', $store_info['deliver_region']);
            $store_info['deliver_region_ids'] = explode(' ', $store_info['deliver_region'][0]);
            $store_info['deliver_region_names'] = explode(' ', $store_info['deliver_region'][1]);
        }
        $this->outputStoreInfo($store_info, $goods_info);
    }
}