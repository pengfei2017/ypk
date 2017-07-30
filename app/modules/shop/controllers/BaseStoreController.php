<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 20:23
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\Goods;
use Ypk\Models\Store;
use Ypk\Tpl;

class BaseStoreController extends ControllerBase
{
    protected $store_info;
    protected $store_decoration_only = false;

    public function initialize()
    {
        parent::initialize();

        $this->translation = getTranslation('common,store_layout,store_show_store_index');
        $this->view->setVar('lang', $this->translation);

        if (!getConfig('site_status')) {
            $this->showMessage(getConfig('closed_reason'));
        }

        //输出头部的公用信息
        $this->showLayout();

        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR); //设置模版目录（必须在views目录之下）
        $this->view->setLayout("store_layout"); //设置模版文件

        $this->view->setVar('layout', 'store_layout');

        //输出会员信息
        $this->getMemberAndGradeInfo(false);

        $store_id = intval($_GET['store_id']);
        if (!$store_id) {
            $store_id = intval(getSession('store_id'));
            if (!$store_id) {
                $goods_id = intval($_REQUEST['goods_id']); //商品id
                if ($goods_id) {
                    $store_id = Goods::findFirst(array("conditions" => "goods_id=" . $goods_id, "columns" => "store_id"));
                    if ($store_id) {
                        $store_id = $store_id->toArray();
                        $storeInfo = Store::findFirst("store_id=" . $store_id['store_id']);
                        if ($storeInfo) {
                            $store_id = intval($store_id);
                        } else {
                            $store_id = -1;
                        }
                    }
                }
            }
        }

        if ($store_id <= 0) {
            $this->showMessage('该商品不存在', getUrl('shop/store_list/index',array('type'=>'login')), '', 'error');
            //@header("Location:" . getUrl('shop/seller_login/show_login', array('type' => 'login')));
        }

        $model_store = Model('store');
        $store_info = $model_store->getStoreOnlineInfoByID($store_id);
        if (empty($store_info)) {
            showMessage(getLang('nc_store_close'), '', '', 'error');
        } else {
            $this->store_info = $store_info;
        }
        if ($store_info['store_decoration_switch'] > 0 & $store_info['store_decoration_only'] == 1) {
            $this->store_decoration_only = true;
        }

        //医生装修
        $this->outputStoreDecoration($store_info['store_decoration_switch'], $store_id);

        $this->outputStoreInfo($this->store_info);
        $this->getStoreNavigation($store_id);
        $this->outputSeoInfo($this->store_info);
    }

    /**
     * 输出医生装修
     */
    protected function outputStoreDecoration($decoration_id, $store_id)
    {
        if ($decoration_id > 0) {
            $model_store_decoration = Model('store_decoration');

            $decoration_info = $model_store_decoration->getStoreDecorationInfoDetail($decoration_id, $store_id);
            if ($decoration_info) {
                $decoration_background_style = $model_store_decoration->getDecorationBackgroundStyle($decoration_info['decoration_setting']);
                Tpl::output('decoration_background_style', $decoration_background_style);
                Tpl::output('decoration_nav', $decoration_info['decoration_nav']);
                Tpl::output('decoration_banner', $decoration_info['decoration_banner']);

                $html_file = BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . 'decoration' . DS . 'html' . DS . md5($store_id) . '.html';
                if (is_file($html_file)) {
                    Tpl::output('decoration_file', $html_file);
                }
            }
            Tpl::output('store_theme', 'default');
        } else {
            Tpl::output('store_theme', $this->store_info['store_theme']);
        }
    }

    /**
     * 检查医生开启状态
     *
     * @param $store_info
     * @param null $goods_info
     * @internal param int $store_id 医生编号
     * @internal param string $msg 警告信息
     */
    protected function outputStoreInfo($store_info, $goods_info = null)
    {
        if (!$this->store_decoration_only) {

            // 自营店设置“显示商城相关数据”
            if ($goods_info && $store_info['is_own_shop'] && $store_info['left_bar_type'] == 2) {
                Tpl::output('left_bar_type_mall_related', true);

                // 推荐分类
                $mr_rel_gc = Model('goods_class')->getGoodsClassListBySiblingId($goods_info['gc_id']);
                Tpl::output('mr_rel_gc', $mr_rel_gc);

                // 分类 含所有父级分类
                $gcIds = array();
                $gcIds[(int)$goods_info['gc_id_1']] = null;
                $gcIds[(int)$goods_info['gc_id_2']] = null;
                $gcIds[(int)$goods_info['gc_id_3']] = null;
                unset($gcIds[0]);
                $gcIds = array_keys($gcIds);

                // 推荐品牌
                $mr_rel_brand = null;
                if ($gcIds) {
                    $mr_rel_brand = Model('brand')->getBrandPassedList(array(
                        'class_id' => array('in', $gcIds),
                    ));
                }
                Tpl::output('mr_rel_brand', $mr_rel_brand);

                // 同分类下销量排行
                $mr_hot_sales = null;
                if ($gcIds) {
                    $mr_hot_sales = Model('goods')->getGoodsOnlineList(array(
                        'gc_id' => array('in', $gcIds),
                        'goods_id' => array('neq', $goods_info['goods_id']),
                    ), '*', 0, 'goods_salenum desc', 6);
                }
                Tpl::output('mr_hot_sales', $mr_hot_sales);
                $gcArray = Model('goods_class')->getGoodsClassInfoById($goods_info['gc_id_1']);
                Tpl::output('mr_hot_sales_gc_name', $gcArray['gc_name']);

                // 推荐商品
                $mr_rec_products = null;
                if ($gcIds) {
                    $goodsIds = Model('p_booth')->getBoothGoodsIdRandList($gcIds, $goods_info['goods_id'], 6);
                    if ($goodsIds) {
                        $mr_rec_products = Model('goods')->getGoodsOnlineList(array(
                            'goods_id' => array('in', $goodsIds),
                        ), '*', 0, '', 6);
                    }
                }
                Tpl::output('mr_rec_products', $mr_rec_products);
            } else {
                $model_store = Model('store');
                $model_seller = Model('seller');

                //热销排行
                $hot_sales = $model_store->getHotSalesList($store_info['store_id'], 5);
                Tpl::output('hot_sales', $hot_sales);

                //收藏排行
                $hot_collect = $model_store->getHotCollectList($store_info['store_id'], 5);
                Tpl::output('hot_collect', $hot_collect);
            }
        }

        //医生分类
        $goodsclass_model = Model('store_goods_class');
        $goods_class_list = $goodsclass_model->getShowTreeList($store_info['store_id']);
        Tpl::output('goods_class_list', $goods_class_list);

        Tpl::output('store_info', $store_info);
        Tpl::output('page_title', $store_info['store_name']);
    }

    protected function getStoreNavigation($store_id)
    {
        $model_store_navigation = Model('store_navigation');
        $store_navigation_list = $model_store_navigation->getStoreNavigationList(array('sn_store_id' => $store_id));
        Tpl::output('store_navigation_list', $store_navigation_list);
    }

    protected function outputSeoInfo($store_info)
    {
        $seo_param = array();
        $seo_param['shopname'] = $store_info['store_name'];
        $seo_param['key'] = $store_info['store_keywords'];
        $seo_param['description'] = $store_info['store_description'];
        Model('seo')->type('shop')->param($seo_param)->show();
    }
}