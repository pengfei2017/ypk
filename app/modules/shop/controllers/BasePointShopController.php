<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/11
 * Time: 15:11
 */

namespace Ypk\Modules\Shop\Controllers;


use Phalcon\Mvc\Controller;
use Ypk\Tpl;

/**
 * 积分中心control父类
 */
class BasePointShopController extends ControllerBase
{
    protected $member_info;

    public function initialize()
    {
        parent::initialize();

        getTranslation('common,home_layout,home_pointprod');
        //输出头部的公用信息
        $this->showLayout();
        //输出会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        Tpl::output('member_info', $this->member_info);


        //Tpl::setDir('home');
        //Tpl::setLayout('home_layout');
        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout("home_layout");

//        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK') {
//            $_GET = Language::getGBK($_GET);
//        }
        if (!getConfig('site_status')) {
            $this->showMessage(getConfig('closed_reason'), '', '', 'exception');
        }

        //判断系统是否开启积分和积分中心功能
        if (getConfig('points_isuse') != 1 || getConfig('pointshop_isuse') != 1) {
            showMessage(getLang('pointshop_unavailable'), getUrl('shop/index/index'), 'html', 'error');
        }
        Tpl::output('index_sign', 'pointshop');
    }

    /**
     * 获得积分中心会员信息包括会员名、ID、会员头像、会员等级、经验值、等级进度、积分、已领代金券、已兑换礼品、礼品购物车
     */
    public function pointshopMInfo($is_return = false)
    {
        if (intval(getSession('is_login')) == 1) {
            $model_member = Model('member');
            if (!$this->member_info) {
                //查询会员信息
                $member_infotmp = $model_member->getMemberInfoByID(getSession('member_id'));
            } else {
                $member_infotmp = $this->member_info;
            }
            $member_infotmp['member_exppoints'] = intval($member_infotmp['member_exppoints']);

            //当前登录会员等级信息
            $membergrade_info = $model_member->getOneMemberGrade($member_infotmp['member_exppoints'], true);
            $member_info = array_merge($member_infotmp, $membergrade_info);
            Tpl::output('member_info', $member_info);

            //查询已兑换并可以使用的代金券数量
            $model_voucher = Model('voucher');
            $vouchercount = $model_voucher->getCurrentAvailableVoucherCount(getSession('member_id'));
            Tpl::output('vouchercount', $vouchercount);

            //购物车兑换商品数
            $pointcart_count = Model('pointcart')->countPointCart(getSession('member_id'));
            Tpl::output('pointcart_count', $pointcart_count);

            //查询已兑换商品数(未取消订单)
            $pointordercount = Model('pointorder')->getMemberPointsOrderGoodsCount(getSession('member_id'));
            Tpl::output('pointordercount', $pointordercount);
            if ($is_return) {
                return array('member_info' => $member_info, 'vouchercount' => $vouchercount, 'pointcart_count' => $pointcart_count, 'pointordercount' => $pointordercount);
            }
        }
    }
}