<?php
/**
 * 积分管理.
 * User: Administrator
 * Date: 2016/12/8
 * Time: 17:54
 *
 * 采用的布局页：member_layout
 */

namespace Ypk\Modules\Member\Controllers;

use Ypk\Tpl;

class MemberPointsController extends BaseMemberController
{

    public function initialize()
    {
        parent::initialize();
        /**
         * 读取语言包
         */
        getTranslation('member_member_points,member_pointorder');
        /**
         * 判断系统是否开启积分功能
         */
        if (getConfig('points_isuse') != 1) {
            showMessage(getLang('points_unavailable'), getUrl('shop/member/home'), 'html', 'error');
        }
    }

    public function indexAction()
    {
        $this->points_logAction();
        exit;
    }

    /**
     * 积分日志列表
     */
    public function points_logAction()
    {
        $where = array();
        $where['pl_memberid'] = $_SESSION['member_id'];
        if ($_GET['stage']) {
            $where['pl_stage'] = $_GET['stage'];
        }
        if (trim($_GET['stime']) && trim($_GET['etime'])) {
            $stime = strtotime($_GET['stime']);
            $etime = strtotime($_GET['etime']);
            $where['pl_addtime'] = array('between', "$stime,$etime");
        } elseif (trim($_GET['stime'])) {
            $stime = strtotime($_GET['stime']);
            $where['pl_addtime'] = array('egt', $stime);
        } elseif (trim($_GET['etime'])) {
            $etime = strtotime($_GET['etime']);
            $where['pl_addtime'] = array('elt', $etime);
        }
        $where['pl_desc'] = array('like', "%{$_GET['description']}%");
        //查询积分日志列表
        $points_model = Model('points');
        $list_log = $points_model->getPointsLogList($where, '*', 0, 10);
        //信息输出
        self::profile_menu('points');
        Tpl::output('show_page', $points_model->showpage());
        Tpl::output('list_log', $list_log);
        //Tpl::showpage('member_points');
        $this->view->render('member_points', 'member_points');
        $this->view->disable();
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_key 当前导航的menu_key
     * @param array $array 附加菜单
     * @internal param string $menu_type 导航类型
     */
    private function profile_menu($menu_key = '', $array = array())
    {
        $menu_array = array(
            1 => array('menu_key' => 'points', 'menu_name' => '积分明细', 'menu_url' => getUrl('member/member_points')),
            2 => array('menu_key' => 'orderlist', 'menu_name' => '积分兑换', 'menu_url' => getUrl('member/member_pointorder/orderlist'))
        );
        if (!empty($array)) {
            $menu_array[] = $array;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }
}