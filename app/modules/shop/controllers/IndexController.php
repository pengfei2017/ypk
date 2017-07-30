<?php
namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Ypk\Logic\AreaLogic;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\WebconfigLogic;
use Ypk\Models\Goods;
use Ypk\Models\Member;
use Ypk\Models\OrderGoods;
use Ypk\Sms;
use Ypk\Tpl;

/**
 * 商城首页逻辑处理
 * Class IndexController
 * @package Ypk\Modules\Shop\Controllers
 */
class IndexController extends BaseHomeController
{
    public function initialize()
    {
		//exit('系统升级中......');
//        $a=new Sms();
//        $a->send('15890614693','您已成功购买"测试支付宝支付"服务，编号是：260号【测试支付宝支付】');
//        exit;
//        $a=date('Y-m-d H:i:s',strtotime('+1 year')); //当前时间加1年
//        echo $a;
//        echo time();
//        echo "<br/>";
//        echo strtotime('+1 year');

//        write_file_cache('test','aaa',null,'../storejoin_cache/');
//        echo "ok";
//        exit;
        parent::initialize();
        $this->translation = getTranslation('home_index_index,member_groupbuy,home_layout,common');
        $this->view->setVar('lang', $this->translation);
    }

    /**
     * 商城首页初始化
     */
    public function indexAction()
    {
        $this->view->setVar('index_sign', 'index');

        //$this->view->setVar("is_goods ",false);

        //抢购专区
//        $model_groupbuy = Model('groupbuy');
//        $group_list = $model_groupbuy->getGroupbuyCommendedList(4);
//        $this->view->setVar('group_list', $group_list);

        //专题获取
//        $model_special = Model('cms_special');
//        $special_list = $model_special->getShopindexList($conition);
//        Tpl::output('special_list', $special_list);

        //友情链接
        $model_link = Model('link');
        $link_list = $model_link->getLinkList($condition, $page);
        if (is_array($link_list)) {
            foreach ($link_list as $k => $v) {
                if (!empty($v['link_pic'])) {
                    $link_list[$k]['link_pic'] = UPLOAD_SITE_URL . '/' . ATTACH_PATH . '/common/' . DS . $v['link_pic'];
                }
            }
        }
        $this->view->setVar('link_list', $link_list);

        //限时折扣
        $model_xianshi_goods = Model('p_xianshi_goods');
        $xianshi_item = $model_xianshi_goods->getXianshiGoodsCommendList(6);
        $this->view->setVar('xianshi_item', $xianshi_item);

        //直达楼层信息
        $lc_list = array();
        if (getConfig('hao_lc') != '') {
            $lc_list = @unserialize(getConfig('hao_lc'));
        }
        $this->view->setVar('lc_list', is_array($lc_list) ? $lc_list : array());

        //首页推荐词链接
//        if (getConfig('hao_rc') != '') {
//            $rc_list = @unserialize(getConfig('hao_rc'));
//        }
//        Tpl::output('rc_list',is_array($rc_list) ? $rc_list : array());

        //推荐品牌
        $brand_r_list = Model('brand')->getBrandPassedList(array('brand_recommend' => 1), 'brand_id,brand_name,brand_pic,brand_xbgpic,brand_tjstore', 0, 'brand_sort asc, brand_id desc', 16);
        $this->view->setVar('brand_r', $brand_r_list);


        //评价信息
        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsList(8);
        $this->view->setVar('goods_evaluate_info', $goods_evaluate_info);

        //板块信息
        $model_web_config = new WebconfigLogic();
        $web_html = $model_web_config->getWebHtml('index');
        $this->view->setVar('web_html', $web_html);
        //Model('seo')->type('index')->show();
    }

    /**
     * hpf
     * json输出商品分类
     */
    public function josn_classAction()
    {
        $model_class = new GoodsClassLogic();
        $goods_class = $model_class->getGoodsClassListByParentId(intval($_GET['gc_id']));
        $array = array();
        if (is_array($goods_class) and count($goods_class) > 0) {
            foreach ($goods_class as $val) {
                $array[$val['gc_id']] = array('gc_id' => $val['gc_id'], 'gc_name' => htmlspecialchars($val['gc_name']), 'gc_parent_id' => $val['gc_parent_id'], 'commis_rate' => $val['commis_rate'], 'gc_sort' => $val['gc_sort']);
            }
        }

        $array = array_values($array);
        echo $_GET['callback'] . '(' . json_encode($array) . ')';
        $this->view->disable();
        exit();
    }

    /**
     * json输出地址数组 获取所有的省级行政单位
     */
    public function json_areaAction()
    {
        $_GET['src'] = $_GET['src'] != 'db' ? 'cache' : 'db';
        echo $_GET['callback'] . '(' . json_encode((new AreaLogic())->getAreaArrayForJson($_GET['src'])) . ')';
        exit;
    }

    /**
     * 根据ID返回所有父级地区名称
     */
    public function json_area_showAction()
    {
        $area_info['text'] = (new AreaLogic())->getTopAreaName(intval($_GET['area_id']));
        echo $_GET['callback'] . '(' . json_encode($area_info) . ')';
        exit;
    }

    /**
     * 判断是否登录
     */
    public function loginAction()
    {
        echo (getSession('is_login') == '1') ? '1' : '0';
    }

    /**
     * 头部最近浏览的商品
     */
    public function viewed_infoAction()
    {
        $info = array();
        if (intval(getSession('is_login')) == 1) {
            $member_id = getSession('member_id');
            $info['m_id'] = $member_id;
            if (getConfig('voucher_allow') == 1) {
                $time_to = time();//当前日期
                $info['voucher'] = Model()->table('voucher')->where(array('voucher_owner_id' => $member_id, 'voucher_state' => 1,
                    'voucher_start_date' => array('elt', $time_to), 'voucher_end_date' => array('egt', $time_to)))->count();
            }
            $time_to = strtotime(date('Y-m-d'));//当前日期
            $time_from = date('Y-m-d', ($time_to - 60 * 60 * 24 * 7));//7天前
            $info['consult'] = Model()->table('consult')->where(array('member_id' => $member_id,
                'consult_reply_time' => array(array('gt', strtotime($time_from)), array('lt', $time_to + 60 * 60 * 24), 'and')))->count();
        }
        $goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'], 5);
        if (is_array($goods_list) && !empty($goods_list)) {
            $viewed_goods = array();
            foreach ($goods_list as $key => $val) {
                $goods_id = $val['goods_id'];
                $val['url'] = getUrl('shop/goods/index', array('goods_id' => $goods_id));
                $val['goods_image'] = thumb($val, 60);
                $viewed_goods[$goods_id] = $val;
            }
            $info['viewed_goods'] = $viewed_goods;
        }

        echo json_encode($info);
        exit;
    }

    /**
     * 查询每月的周数组
     */
    public function getweekofmonthAction()
    {
        //import('function.datehelper');
        $year = $_GET['y'];
        $month = $_GET['m'];
        $week_arr = getMonthWeekArr($year, $month);
        echo json_encode($week_arr);
        die;
    }
}