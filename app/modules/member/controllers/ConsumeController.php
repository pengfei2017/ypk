<?php
/**
 * 消费记录
 * User: Administrator
 * Date: 2016/12/8
 * Time: 17:56
 *
 * 采用的布局页：member_layout
 */

namespace Ypk\Modules\Member\Controllers;

use Ypk\Tpl;

class ConsumeController extends BaseMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $model_consume = Model('consume');
        $consume_list = $model_consume->getConsumeList(array('member_id' => $_SESSION['member_id']), '*', 20);
        Tpl::output('show_page', $model_consume->showpage());
        Tpl::output('consume_list', $consume_list);
        Tpl::output('consume_type', $this->type);
        $this->profile_menu('consume', 'consume');
        //Tpl::showpage('consume.list');
        $this->view->render('consume', 'consume_list');
        $this->view->disable();
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     */
    private function profile_menu($menu_type, $menu_key = '')
    {
        $menu_array = array();
        switch ($menu_type) {
            case 'consume':
                $menu_array = array(
                    1 => array('menu_key' => 'consume', 'menu_name' => '消费记录', 'menu_url' => getUrl('member/consume')));
                break;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
    }
}