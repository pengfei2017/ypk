<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/3
 * Time: 23:41
 */

namespace Ypk\Modules\Member\Controllers;


use Ypk\Tpl;

class BaseMemberController extends ControllerBase
{
    protected $member_info = array();   // 会员信息
    protected function initialize(){
        if(!getConfig('site_status'))
        {
            showMessage(getConfig('closed_reason'), '', 'exception');
        }

        $lang = getTranslation('common,member_layout');

        //会员验证
        $this->checkLogin();
        //输出头部的公用信息
        $this->showLayout();
        //Tpl::setLayout('member_layout');

        //获得会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        Tpl::output('member_info', $this->member_info);

        // 左侧导航
        $menu_list = $this->_getMenuList();
        Tpl::output('menu_list', $menu_list);

        // 系统消息
        $this->system_notice();
        // 页面高亮
        Tpl::output('act', $_GET['act']);
        /**
         * 文章
         */
        $this->article();
    }

    /**
     * 左侧导航
     * 菜单数组中child的下标要和其链接的act对应。否则面包屑不能正常显示
     * @return array
     */
    private function _getMenuList() {
        $menu_list = array(
            'info' => array('name' => '会员资料', 'child' => array(
                'member_information'=> array('name' => '账户信息', 'url'=>getUrl('shop/member_information/member')),
                'member_security'   => array('name' => '账户安全', 'url'=>getUrl('shop/member_security/index')),
                'member_address'    => array('name' => '收货地址', 'url'=>getUrl('shop/member_address/address')),
                'member_message'    => array('name' => '我的消息', 'url'=>getUrl('shop/member_message/message')),
                'member_snsfriend'  => array('name' => '我的好友', 'url'=>getUrl('shop/member_snsfriend/find')),
                'member_bind'       => array('name' => '第三方账号登录', 'url'=>getUrl('shop/member_bind/qqbind')),
                'member_sharemanage'=> array('name' => '分享绑定', 'url'=>getUrl('shop/member_sharemanage/index'))
            )),
            'property' => array('name' => '财产中心', 'child' => array(
                'consume'           => array('name' => '消费记录', 'url'=>getUrl('shop/consume')),
                'predeposit'        => array('name' => '账户余额', 'url'=>getUrl('shop/predeposit/pd_log_list')),
                'member_points'     => array('name' => '我的积分', 'url'=>getUrl('shop/member_points/index')),
                'member_voucher'    => array('name' => '我的代金券', 'url'=>getUrl('shop/member_voucher/index')),
                'member_redpacket'  => array('name' => '我的红包', 'url'=>getUrl('shop/member_redpacket/index'))

            ))
        );
        return $menu_list;
    }
}