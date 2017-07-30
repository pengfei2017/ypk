<?php
/**
 * 卖家医生注销登录
 * User: Administrator
 * Date: 2016/12/3
 * Time: 23:26
 */

namespace Ypk\Modules\Shop\Controllers;


class SellerLogoutController extends BaseSellerController
{
    public function initialize() {
        parent::initialize();
    }

    public function indexAction() {
        $this->logoutAction();
    }

    public function logoutAction() {
        //$this->recordSellerLog('注销成功');
        // 清除医生消息数量缓存
        setMyCookie('storemsgnewnum'.getSession('seller_id'),"0",-3600);
        session_destroy();
        redirect(getUrl('shop/seller_login/show_login',array("type"=>"login")));
    }
}