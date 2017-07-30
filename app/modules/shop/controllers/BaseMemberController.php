<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 15:11
 *
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class BaseMemberController extends ControllerBase
{
    /**
     * 语言包翻译对象
     */
    protected $translation;

    protected $member_info = array();   // 会员信息

    public function initialize()
    {
        parent::initialize();

        Tpl::output('setting_config', $GLOBALS['setting_config']);
        $this->view->setVar('setting_config', $GLOBALS['setting_config']);
        if (!getConfig('site_status')) {
            $this->showMessage(getConfig('closed_reason'), '', '', 'exception');
        }

        getTranslation('common,member_layout');

//        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
//            $_GET = Language::getGBK($_GET);
//        }
        //会员验证
        $this->checkLogin();
        //输出头部的公用信息
        $this->showLayout();
        //Tpl::setDir('member');
        //Tpl::setLayout('member_layout');

        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout("member_layout");


        //获得会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        //$this->member_info['voucher_count'] = (new \Ypk\Logic\VoucherLogic())->getCurrentAvailableVoucherCount($_SESSION['member_id']);
        //$this->member_info['redpacket_count'] = (new \Ypk\Logic\RedpacketLogic())->getCurrentAvailableRedpacketCount($_SESSION['member_id']);
        $this->view->setVar('member_info', $this->member_info);
        Tpl::output('member_info', $this->member_info);

        // 常用操作及导航
        $menu_list = $this->_getNavLink();

        //系统公告
        $this->system_notice();

        // 交易数量提示
        $this->order_tip();

        // 页面高亮
        $this->view->setVar('act', $_GET['act']);
        Tpl::output('act', $_GET['act']);
    }

    /**
     * 交易数量提示
     */
    private function order_tip()
    {
        $model_order = Model('order');
        //交易提醒 - 显示数量
        $order_tip['order_nopay_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'NewCount');
        $order_tip['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'SendCount');
        $order_tip['order_noeval_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'EvalCount');
        $order_tip['order_notakes_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'TakesCount');
        $this->view->setVar('order_tip', $order_tip);
    }

    /**
     * 系统公告
     */
    private function system_notice()
    {
        $model_message = Model('article');
        $condition = array();
        $condition['ac_id'] = 1;
        $condition['article_position_in'] = ARTICLE_POSIT_ALL . ',' . ARTICLE_POSIT_BUYER;
        $condition['limit'] = 5;
        $article_list = $model_message->getArticleList($condition);
        Tpl::output('system_notice', $article_list);
        $this->view->setVar('system_notice', $article_list);
    }

    /**
     * 常用操作
     *
     * @param string $act
     * 如果菜单中的切换卡不在一个菜单中添加$act参数，值为当前菜单的下标
     *
     */
    protected function _getNavLink($act = '')
    {
        // 左侧导航
        $menu_list = $this->_getMenuList();
        $this->view->setVar('menu_list', $menu_list);
    }

    /**
     * 会员中心的左侧导航
     * 菜单数组中child的下标要和其链接的act对应。否则面包屑不能正常显示
     * @return array
     */
    private function _getMenuList()
    {
        $menu_list = array(
            'trade' => array('name' => '交易中心', 'child' => array(
                'member_order' => array('name' => '交易订单', 'url' => getUrl('shop/member_order/index')),
                'member_vr_order' => array('name' => '虚拟订单', 'url' => getUrl('shop/member_vr_order/index')),
                'member_evaluate' => array('name' => '交易评价/晒单', 'url' => getUrl('shop/member_evaluate/list')),
//                'member_appoint' => array('name' => '预约/到货通知', 'url' => getUrl('shop/member_appoint/list'))
            )),
            'follow' => array('name' => '关注中心', 'child' => array(
                'member_favorite_goods' => array('name' => '商品收藏', 'url' => getUrl('shop/member_favorite_goods/index')),
                'member_favorite_store' => array('name' => '医生收藏', 'url' => getUrl('shop/member_favorite_store/index')),
                'member_goodsbrowse' => array('name' => '我的足迹', 'url' => getUrl('shop/member_goodsbrowse/list'))
            )),
            'client' => array('name' => '客户服务', 'child' => array(
                'member_refund' => array('name' => '退款及退货', 'url' => getUrl('shop/member_refund/index')),
//                'member_complain' => array('name' => '交易投诉', 'url' => getUrl('shop/member_complain/index')),
                'member_consult' => array('name' => '商品咨询', 'url' => getUrl('shop/member_consult/my_consult')),
//                'member_inform' => array('name' => '违规举报', 'url' => getUrl('shop/member_inform/index')),
                'member_mallconsult' => array('name' => '平台客服', 'url' => getUrl('shop/member_mallconsult/index'))
            )),
            'info' => array('name' => '会员资料', 'child' => array(
                'member_information' => array('name' => '个人信息', 'url' => getUrl('shop/member_information/member')),
                'member_address' => array('name' => '收货地址', 'url' => getUrl('shop/member_address/address'))
            )),
            'property' => array('name' => '财产中心', 'child' => array(
                'predeposit' => array('name' => '账户余额', 'url' => getUrl('shop/predeposit/pd_log_list')),
                'reward' => array('name' => '我的收入', 'url' => getUrl('shop/reward/index')),
                //'member_voucher'    => array('name' => '我的代金券', 'url'=>getUrl('shop/member_voucher/index')),
                //'member_redpacket'  => array('name' => '我的红包', 'url'=>getUrl('shop/member_redpacket/index'))
            )),
        );

        if (intval(getSession('member_type_id')) > 1) { //表示是医务人员
            $arr = array('member_computeinfo' => array('name' => '完善资料', 'url' => getUrl('shop/compute_info/computeinfo')));
            $menu_list['info']['child'] = array_merge($menu_list['info']['child'], $arr);
        }
        return $menu_list;
    }
}