<?php
/**
 * 医生中心逻辑处理
 * User: Administrator
 * Date: 2016/12/8
 * Time: 11:49
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Tpl;

class SystemController extends BaseHomeController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 此页面只显示平台发布的产品
     */
    public function indexAction()
    {
        //读取语言包
        $lang = getTranslation('home_store_class_index');

        //医生类目快速搜索
        $class_list = ($h = read_file_cache('store_class')) ? $h : read_file_cache('store_class', true, 'file');
        if (!key_exists($_GET['cate_id'], $class_list)) $_GET['cate_id'] = 0;
        Tpl::output('class_list', $class_list);

        //医生搜索
        $model = Model();
        $condition = array();
        $keyword = trim($_GET['keyword']);
        if (getConfig('fullindexer.open') && !empty($keyword)) {
            //全文搜索
            $condition = $this->full_search($keyword);
        } else {
            if ($keyword != '') {
                $condition['store_name|store_zy'] = array('like', '%' . $keyword . '%');
            }

            if ($_GET['user_name'] != '') {
                $condition['member_name'] = trim($_GET['user_name']);
            }
        }
        if (!empty($_GET['area_info'])) {
            $tabs = preg_split("#\s+#", $_GET['area_info'], -1, PREG_SPLIT_NO_EMPTY);
            $len = count($tabs);
            $area_name = $tabs[$len - 1];
            if ($area_name) {
                $area_name = trim($area_name);
                $condition['area_info'] = array('like', '%' . $area_name . '%');
            }
        }
        if ($_GET['cate_id'] > 0) {
            $child = array_merge((array)$class_list[$_GET['cate_id']]['child'], array($_GET['cate_id']));
            $condition['sc_id'] = array('in', $child);
        }

        $condition['store_state'] = 1;

        if (!in_array($_GET['order'], array('desc', 'asc'))) {
            unset($_GET['order']);
        }
        if (!in_array($_GET['key'], array('store_sales', 'store_credit'))) {
            unset($_GET['key']);
        }

        $order = 'store_sort asc';

        if (isset($condition['store.store_id'])) {
            $condition['store_id'] = $condition['store.store_id'];
            unset($condition['store.store_id']);
        }
        $model_store = Model('store');
        $store_list = $model_store->where('store_id=1')->order($order)->page(10)->select();

        //获取医生商品数，推荐商品列表等信息
        $store_list = $model_store->getStoreSearchList($store_list);
        //print_r($store_list);exit();
        //信用度排序
        if ($_GET['key'] == 'store_credit') {
            if ($_GET['order'] == 'desc') {
                $store_list = sortClass::sortArrayDesc($store_list, 'store_credit_average');
            } else {
                $store_list = sortClass::sortArrayAsc($store_list, 'store_credit_average');
            }
        } else if ($_GET['key'] == 'store_sales') {//销量排行
            if ($_GET['order'] == 'desc') {
                $store_list = sortClass::sortArrayDesc($store_list, 'num_sales_jq');
            } else {
                $store_list = sortClass::sortArrayAsc($store_list, 'num_sales_jq');
            }
        }
        Tpl::output('store_list', $store_list);

        Tpl::output('show_page', $model->showpage(2));
        // 页面输出
        Tpl::output('index_sign', 'system_store');
        //当前位置
        if (intval($_GET['cate_id']) > 0) {
            $nav_link[1]['link'] = getUrl('shop/shop_search/index');
            $nav_link[1]['title'] = $lang['site_search_store'];
            $nav = $class_list[$_GET['cate_id']];
            //如果有父级
            if ($nav['sc_parent_id'] > 0) {
                $tmp = $class_list[$nav['sc_parent_id']];
                //存入父级
                $nav_link[] = array(
                    'title' => $tmp['sc_name'],
                    'link' => getUrl('shop/store_list/index', array('cate_id' => $nav['sc_parent_id']))
                );
            }
            //存入当前级
            $nav_link[] = array(
                'title' => $nav['sc_name']
            );
        } else {
            $nav_link[1]['link'] = 'index.php';
            $nav_link[1]['title'] = $lang['homepage'];
            $nav_link[2]['title'] = $lang['site_search_store'];
        }

        $purl = $this->getParam();
        Tpl::output('nav_link_list', $nav_link);
        //Tpl::output('purl', getUrl($purl['act'], $purl['op'], $purl['param']));
        Tpl::output('purl', getUrl("shop/" . $this->dispatcher->getControllerName() . "/" . $this->dispatcher->getActionName() . "?" . $purl['param']));

        //SEO
        Model('seo')->type('index')->show();
        Tpl::output('html_title', (empty($_GET['keyword']) ? '' : $_GET['keyword'] . ' - ') . getConfig('site_name') . $lang['nc_common_search']);

        //Tpl::showpage('store_list');
    }


    /**
     * 全文搜索
     *
     */
    private function full_search($search_txt)
    {
        $conf = getConfig('fullindexer');
        import('libraries.sphinx');
        $cl = new SphinxClient();
        $cl->SetServer($conf['host'], $conf['port']);
        $cl->SetConnectTimeout(1);
        $cl->SetArrayResult(true);
        $cl->SetRankingMode($conf['rankingmode'] ? $conf['rankingmode'] : 0);
        $cl->setLimits(0, $conf['querylimit']);

        $matchmode = $conf['matchmode'];
        $cl->setMatchMode($matchmode);
        $res = $cl->Query($search_txt, $conf['index_shop']);
        if ($res) {
            if (is_array($res['matches'])) {
                foreach ($res['matches'] as $value) {
                    $matchs_id[] = $value['id'];
                }
            }
        }
        if ($search_txt != '') {
            $condition['store.store_id'] = array('in', $matchs_id);
        }
        return $condition;
    }

    function getParam()
    {
        $param = $_GET;
        $purl = array();
        $purl['act'] = $param['act'];
        unset($param['act']);
        $purl['op'] = $param['op'];
        unset($param['op']);
        unset($param['curpage']);
        $purl['param'] = $param;
        return $purl;
    }
}