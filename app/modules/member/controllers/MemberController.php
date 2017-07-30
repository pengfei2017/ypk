<?php
/**
 * 会员中心
 * User: Administrator
 * Date: 2016/12/8
 * Time: 17:31
 *
 * 采用的布局页：member_layout
 */

namespace Ypk\Modules\Member\Controllers;

use Ypk\Tpl;

class MemberController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        $this->homeAction();
    }


    public function homeAction()
    {
        $model_consume = Model('consume');
        $consume_list = $model_consume->getConsumeList(array('member_id' => getSession('member_id')), '*', 0, 10);
        Tpl::output('consume_list', $consume_list);
        //Tpl::showpage('member_home');
    }
}