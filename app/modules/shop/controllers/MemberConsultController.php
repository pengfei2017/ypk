<?php
/**
 * 买家商品咨询
 * User: Administrator
 * Date: 2016/12/12
 * Time: 20:21
 *
 * 采用的布局页面：member_layout
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Page;
use Ypk\Tpl;

class MemberConsultController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('member_store_consult_index,member_layout');
    }

    /**
     * 商品咨询首页
     */
    public function indexAction()
    {
        $this->my_consultAction();
    }

    /**
     * 查询买家商品咨询
     */
    public function my_consultAction()
    {
        //实例化商品咨询模型
        $consult = Model('consult');
        $page = new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        $list_consult = array();
        $search_array = array();
        if ($_GET['type'] != '') {
            if ($_GET['type'] == 'to_reply') {
                $search_array['consult_reply'] = '';
            }
            if ($_GET['type'] == 'replied') {
                $search_array['consult_reply'] = array('neq', '');
            }
        }
        $search_array['member_id'] =  getSession('member_id');
        $list_consult = $consult->getConsultList($search_array, $page);
        Tpl::output('show_page', $page->show());
        Tpl::output('list_consult', $list_consult);
        $_GET['type'] = empty($_GET['type']) ? 'consult_list' : $_GET['type'];
        self::profile_menu('my_consult', $_GET['type']);
        //Tpl::showpage('member_my_consult');
        $this->view->render('member_consult', 'member_my_consult');
        $this->view->disable();
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     * @param array $array 附加菜单
     */
    private function profile_menu($menu_type, $menu_key = '', $array = array())
    {
        $menu_array = array();
        switch ($menu_type) {
            case 'my_consult':
                $menu_array = array(
                    1 => array('menu_key' => 'consult_list', 'menu_name' => getLang('nc_member_path_all_consult'), 'menu_url' => getUrl('shop/member_consult/my_consult')),
                    2 => array('menu_key' => 'to_reply', 'menu_name' => getLang('nc_member_path_unreplied_consult'), 'menu_url' => getUrl('shop/member_consult/my_consult', array('type' => 'to_reply'))),
                    3 => array('menu_key' => 'replied', 'menu_name' => getLang('nc_member_path_replied_consult'), 'menu_url' => getUrl('shop/member_consult/my_consult', array('type' => 'replied'))));
                break;
        }
        if (!empty($array)) {
            $menu_array[] = $array;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }
}