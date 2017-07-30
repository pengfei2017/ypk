<?php
/**
 * 平台客服
 * User: Administrator
 * Date: 2016/12/12
 * Time: 20:02
 *
 * 采用的布局页面：member_layout
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Tpl;
use Ypk\Validate;

class MemberMallconsultController extends BaseMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 平台客服咨询首页
     */
    public function indexAction()
    {
        // 咨询列表
        $model_mallconsult = Model('mall_consult');
        $consult_list = $model_mallconsult->getMallConsultList(array('member_id' => getSession('member_id')), '*', '10');
        Tpl::output('consult_list', $consult_list);
        Tpl::output('show_page', $model_mallconsult->showpage());

        // 回复状态
        $this->typeState();

        $this->profile_menu('consult_list');
        //Tpl::showpage('member_mallconsult.list');
        $this->view->render('member_mallconsult', 'member_mallconsult_list');
        $this->view->disable();
    }

    /**
     * 平台咨询详细
     */
    public function mallconsult_infoAction()
    {
        $id = intval($_GET['id']);
        if ($id <= 0) {
            showMessage(getLang('wrong_argument'), '', '', 'error');
        }
        // 咨询详细信息
        $consult_info = Model('mall_consult')->getMallConsultInfo(array('mc_id' => $id, 'member_id' => getSession('member_id')));
        Tpl::output('consult_info', $consult_info);

        // 咨询类型列表
        $type_list = Model('mall_consult_type')->getMallConsultTypeList(array(), 'mct_id,mct_name', 'mct_id');
        Tpl::output('type_list', $type_list);

        // 回复状态
        $this->typeState();

        //Tpl::showpage('member_mallconsult.info');
        $this->view->render('member_mallconsult', 'member_mallconsult_info');
        $this->view->disable();
    }

    /**
     * 添加平台客服咨询
     */
    public function add_mallconsultAction()
    {
        // 咨询类型列表
        $type_list = Model('mall_consult_type')->getMallConsultTypeList(array());
        Tpl::output('type_list', $type_list);
        if ($_GET['inajax']) {
            //Tpl::showpage('member_mallconsult.add_inajax', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('member_mallconsult', 'member_mallconsult_add_inajax');
        } else {
            //Tpl::showpage('member_mallconsult.add');
            $this->view->render('member_mallconsult', 'member_mallconsult_add');
        }
        $this->view->disable();
    }

    /**
     * 保存平台咨询
     */
    public function save_mallconsultAction()
    {
        if (!chksubmit()) {
            showDialog(getLang('wrong_argument'), 'reload');
        }

        //验证表单信息
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input" => $_POST["type_id"], "require" => "true", "validator" => "Number", "message" => "请选择咨询类型"),
            array("input" => $_POST["consult_content"], "require" => "true", "message" => "请填写咨询内容")
        );
        $error = $obj_validate->validate();
        if ($error != '') {
            showDialog($error);
        }

        $insert = array();
        $insert['mct_id'] = $_POST['type_id'];
        $insert['member_id'] = getSession('member_id');
        $insert['member_name'] = getSession('member_name');
        $insert['mc_content'] = $_POST['consult_content'];

        $result = Model('mall_consult')->addMallConsult($insert);
        if ($result) {
            showDialog(getLang('nc_common_op_succ'), 'reload', 'succ');
        } else {
            showDialog(getLang('nc_common_op_fail'), 'reload');
        }
    }

    /**
     * 删除平台客服咨询
     */
    public function del_mallconsultAction()
    {
        $id = intval($_GET['id']);
        if ($id <= 0) {
            showDialog(getLang('wrong_argument'));
        }

        $result = Model('mall_consult')->delMallConsult(array('mc_id' => $id, 'member_id' => getSession('member_id')));
        if ($result) {
            showDialog(getLang('nc_common_del_succ'), 'reload', 'succ');
        } else {
            showDialog(getLang('nc_common_del_fail'));
        }
    }

    /**
     * 咨询的回复状态
     */
    private function typeState()
    {
        $state = array('0' => '未回复', '1' => '已回复');
        Tpl::output('state', $state);
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_key 当前导航的menu_key
     */
    private function profile_menu($menu_key = '')
    {
        $menu_array = array(
            1 => array('menu_key' => 'consult_list', 'menu_name' => '平台客服咨询列表', 'menu_url' => getUrl('shop/member_mallconsult/index')),
        );
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }
}