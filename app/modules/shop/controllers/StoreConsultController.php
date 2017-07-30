<?php
/**
 * 卖家商品咨询管理
 * User: Administrator
 * Date: 2016/12/13
 * Time: 17:42
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\QueueClient;
use Ypk\Tpl;

class StoreConsultController extends BaseSellerController
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
        $this->consult_listAction();
    }

    /**
     * 商品咨询列表页
     */
    public function consult_listAction()
    {
        $consult = Model('consult');
        $list_consult = array();
        $where = array();
        if (trim($_GET['type']) == 'to_reply') {
            $where['consult_reply'] = array('eq', '');
        } elseif (trim($_GET['type'] == 'replied')) {
            $where['consult_reply'] = array('neq', '');
        }
        if (intval($_GET['ctid']) > 0) {
            $where['ct_id'] = intval($_GET['ctid']);
        }
        $where['store_id'] = getSession('store_id');
        $list_consult = $consult->getConsultList($where, '*', 0, 10);
        Tpl::output('show_page', $consult->showpage());
        Tpl::output('list_consult', $list_consult);

        // 咨询类型
        $consult_type = read_file_cache('consult_type', true);
        Tpl::output('consult_type', $consult_type);

        $_GET['type'] = empty($_GET['type']) ? 'consult_list' : $_GET['type'];
        self::profile_menu('consult', $_GET['type']);
        //Tpl::showpage('store_consult_manage');
        $this->view->render('store_consult','store_consult_manage');
        $this->view->disable();
    }

    /**
     * 商品咨询删除处理
     */
    public function drop_consultAction()
    {
        $ids = trim($_GET['id']);
        if (!preg_match('/^[\d,]+$/i', $ids)) {
            showDialog(getLang('para_error'), '', 'error');
        }
        $consult = Model('consult');
        $id_array = explode(',', trim($_GET['id']));
        $where = array();
        $where['store_id'] = getSession('store_id');
        $where['consult_id'] = array('in', $id_array);
        $state = $consult->delConsult($where);
        if ($state) {
            showDialog(getLang('store_consult_drop_success'), 'reload', 'succ');
        } else {
            showDialog(getLang('store_consult_drop_fail'));
        }
    }

    /**
     * 回复商品咨询表单页
     */
    public function reply_consultAction()
    {
        $consult = Model('consult');
        $list_consult = array();
        $search_array = array();
        $search_array['consult_id'] = intval($_GET['id']);
        $search_array['store_id'] = getSession('store_id');
        $consult_info = $consult->getConsultInfo($search_array);
        Tpl::output('consult', $consult_info);
        //Tpl::showpage('store_consult_form', 'null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('store_consult','store_consult_form');
        $this->view->disable();
    }

    /**
     * 商品咨询回复内容的保存处理
     */
    public function reply_saveAction()
    {
        $consult_id = intval($_POST['consult_id']);
        if ($consult_id <= 0) {
            showDialog(getLang('wrong_argument'));
        }
        $consult = Model('consult');
        $update = array();
        $update['consult_reply'] = $_POST['content'];
        $condtion = array();
        $condtion['store_id'] = getSession('store_id');
        $condtion['consult_id'] = $consult_id;
        $state = $consult->editConsult($condtion, $update);
        if ($state) {
            $consult_info = $consult->getConsultInfo(array('consult_id' => $consult_id));
            // 发送用户消息
            $param = array();
            $param['code'] = 'consult_goods_reply';
            $param['member_id'] = $consult_info['member_id'];
            $param['param'] = array(
                'goods_name' => $consult_info['goods_name'],
                'consult_url' => getUrl('shop/member_consult/my_consult')
            );
            QueueClient::push('sendMemberMsg', $param);
            showDialog(getLang('nc_common_op_succ'), 'reload', 'succ', empty($_GET['inajax']) ? '' : 'CUR_DIALOG.close();');
        } else {
            showDialog(getLang('nc_common_op_fail'));
        }
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
            case 'consult':
                $menu_array = array(
                    1 => array('menu_key' => 'consult_list', 'menu_name' => getLang('nc_member_path_all_consult'), 'menu_url' => getUrl('shop/store_consult/consult_list')),
                    2 => array('menu_key' => 'to_reply', 'menu_name' => getLang('nc_member_path_unreplied_consult'), 'menu_url' => getUrl('shop/store_consult/consult_list',array('type'=>'to_reply'))),
                    3 => array('menu_key' => 'replied', 'menu_name' => getLang('nc_member_path_replied_consult'), 'menu_url' => getUrl('shop/store_consult/consult_list',array('type'=>'replied')))
                );
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