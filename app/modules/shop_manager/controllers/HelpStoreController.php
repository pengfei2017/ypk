<?php
/**
 * 医生帮助
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\HelpLogic;
use Ypk\Logic\UploadLogic;
use Ypk\Models\Help;
use Ypk\Models\HelpType;
use Ypk\Models\StoreBindClass;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\UploadFile;

class HelpStoreController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->help_storeAction();
    }

    /**
     * 帮助列表
     */
    public function help_storeAction()
    {
        $this->view->pick('help_store/help_store');
//        Tpl::setDirquna('shop');
//        Tpl::showpage('help_store.list');
    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $model_help = new HelpLogic();
        $where = '';
//        $condition = array();
//        $condition['help_id'] = array('gt','99');//内容列表不显示系统自动添加的数据
        if (isset($_POST['query']) && $_POST['query'] != '') {
            $where = $_POST['qtype'] . " like '%" . $_POST['query'] . "%' and page_show=1";
        } else {
            $where = " page_show=1";
        }
        $order = '';
        $param = array('help_id', 'help_sort', 'help_title', 'update_time', 'type_id');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
        $page = intval($_POST['rp']); //表示页容量
        $offset = $page * ($currentPageIndex - 1); //计算偏移量
        $help_list = $model_help->getStoreHelpList(array('conditions' => $where, 'order' => $order, 'limit' => array('number' => $page, 'offset' => $offset)));
        //帮助类型字段
//        $helptype = new HelpType();
//        $metaData = $helptype->getModelsMetaData();
//        $paramtype = $metaData->getAttributes($helptype);
//        $order1='';
        //医生page_show=1 会员page_show=2;
        $where1 = "page_show=1";
//        if (in_array($_POST['sortname'], $paramtype) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
//            $order1 = $_POST['sortname'] . ' ' . $_POST['sortorder'];
//        }
        $type_list = $model_help->getStoreHelpTypeList(array('conditions' => $where1, 'order' => $order1, 'limit' => array('number' => $page, 'offset' => $offset)));
        $type_array = array();
        if (!empty($type_list)) {
            foreach ($type_list as $v) {
                $type_array[$v['type_id']] = $v['type_name'];
            }
        }

        $data = array();
        $data['now_page'] = $_POST['curpage'];
        $data['total_num'] = Help::count();
        foreach ($help_list as $value) {
            $param = array();
            $param['operation'] = "<a class='btn red' href=\"javascript:void(0);\" onclick=\"fg_del('" . $value['help_id'] . "')\"><i class='fa fa-trash-o'></i>删除</a><a class='btn blue' href='".getUrl('shop_manager/help_store/edit_help',array('help_id'=>$value['help_id']))."' class='url'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $param['help_id'] = $value['help_id'];
            $param['help_sort'] = $value['help_sort'];
            $param['help_title'] = $value['help_title'];
            $param['type_id'] = $type_array[$value['type_id']];
            $param['update_time'] = date('Y-m-d H:i:s', $value['update_time']);
            $data['list'][$value['help_id']] = $param;
        }
        ob_clean();
        echo flexigridXML($data);
        exit();
    }

    /**
     * 帮助类型
     */
    public function help_typeAction()
    {
        $this->view->pick('help_store/help_store_type');
//        Tpl::setDirquna('shop');
//        Tpl::showpage('help_store_type.list');
    }

    /**
     * 输出XML数据
     */
    public function get_type_xmlAction()
    {
        $model_help = new HelpLogic();
        $where = '';
        if (isset($_POST['query']) && $_POST['query'] != '') {
            if ($where == '') {
                $where = $_POST['qtype'] . " like '%" . $_POST['query'] . "%'";
            } else {
                $where .= " and " . $_POST['qtype'] . " like '%" . $_POST['query'] . "%'";
            }
        }
        $order = '';
//        $param = array('help_id','help_sort','help_title','update_time','type_id');
        $type = new HelpType();
        $metaData = $type->getModelsMetaData();
        $param = $metaData->getAttributes($type);
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
        $page = intval($_POST['rp']); //表示页容量
        $offset = $page * ($currentPageIndex - 1); //计算偏移量
        $type_list = $model_help->getStoreHelpTypeList(array('conditions' => $where, 'order' => $order, 'limit' => array('number' => $page, 'offset' => $offset)));

        $data = array();
        $data['now_page'] = $_POST['curpage']; //$model->shownowpage(); //当前页
        $data['total_num'] = HelpType::count();
        foreach ($type_list as $value) {
            $param = array();
            $operation = '';
            if ($value['help_code'] == 'auto') {
                $operation .= "<a class='btn red' href='javascript:void(0);' onclick=\"fg_del('" . $value['type_id'] . "')\"><i class='fa fa-trash-o'></i>删除</a>";
            }
            $operation .= "<a class='btn blue' href='".getUrl('shop_manager/help_store/edit_type',array('type_id'=>$value['type_id']))."'class='url'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $param['operation'] = $operation;
            $param['type_id'] = $value['type_id'];
            $param['type_name'] = $value['type_name'];
            $param['type_sort'] = $value['type_sort'];
            $param['help_show'] = $value['help_show'] == 1 ? '显示' : '隐藏';
            $data['list'][$value['type_id']] = $param;
        }
        ob_clean();
        echo flexigridXML($data);
        exit();
    }

    /**
     * 新增帮助
     *
     */
    public function add_helpAction()
    {
        $model_help = new HelpLogic();
        if (chksubmit()) {
            $help_array = array();
            $help_array['help_title'] = $_POST['help_title'];
            $help_array['help_url'] = $_POST['help_url'];
            $help_array['help_info'] = $_POST['content'];
            $help_array['help_sort'] = intval($_POST['help_sort']);
            $help_array['type_id'] = intval($_POST['type_id']);
            $help_array['update_time'] = time();
            $help_array['page_show'] = '1';//页面类型:1为医生,2为会员
            $state = $model_help->addHelp($help_array);
            if ($state) {
//                if (!empty($_POST['file_id']) && is_array($_POST['file_id'])) {
//                    $model_help->editHelpPic($state, $_POST['file_id']);
//                }
                $this->log('新增医生帮助，编号' . $state);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('shop_manager/help_store/help_store'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $type_list = $model_help->getStoreHelpTypeList();
        $this->view->setVar('type_list', $type_list);
//        $condition = array();
//        $condition['item_id'] = '0';
//        $condition['upload_type'] = '2';
        $where = " item_id=0 and upload_type=2";
        $pic_list = $model_help->getHelpPicList($where);
        $this->view->setVar('pic_list', $pic_list);
        $this->view->pick('help_store/help_store_edit');
//        Tpl::setDirquna('shop');
//        Tpl::showpage('help_store.add');
    }

    /**
     * 编辑帮助
     *
     */
    public function edit_helpAction()
    {
        $model_help = new HelpLogic();
        $condition = array();
        $help_id = intval($_GET['help_id']);
        $condition['conditions'] = "help_id=$help_id";
        $help_list = $model_help->getStoreHelpList($condition);
        $help = $help_list[0];
        $this->view->setVar('help', $help);
        if (chksubmit()) {
            $help_array = array();
            $help_array['help_title'] = $_POST['help_title'];
            $help_array['help_url'] = $_POST['help_url'];
            $help_array['help_info'] = $_POST['content'];
            $help_array['help_sort'] = intval($_POST['help_sort']);
            $help_array['type_id'] = intval($_POST['type_id']);
            $help_array['update_time'] = time();
            $state = $model_help->editHelp($condition, $help_array);
            if ($state) {
                $this->log('编辑医生帮助，编号' . $help_id);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('shop_manager/help_store/help_store'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $type_list = $model_help->getStoreHelpTypeList();
        $this->view->setVar('type_list', $type_list);
        $condition = array();
        $condition['item_id'] = $help_id;
        $pic_list = $model_help->getHelpPicList($condition);
        $this->view->setVar('pic_list', $pic_list);
        $this->view->pick('help_store/help_store_edit');

//        Tpl::setDirquna('shop');
//        Tpl::showpage('help_store.edit');
    }

    /**
     * 删除帮助
     *
     */
    public function del_helpAction()
    {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $model_help = new HelpLogic();
            $condition = array();
            $condition['help_id'] = $id;
            $state = $model_help->delHelp($condition, array($id));
            if($state){
                $this->log('删除医生帮助，ID' . $id);
                exit(json_encode(array('state' => true, 'msg' => '删除成功')));
            }else{
                exit(json_encode(array('state' => false, 'msg' => '删除失败')));
            }
        } else {
            exit(json_encode(array('state' => false, 'msg' => '删除失败')));
        }
    }

    /**
     * 新增帮助类型
     *
     */
    public function add_typeAction()
    {
        $model_help = new HelpLogic();
        if (chksubmit()) {
            $type_array = array();
            $type_array['type_name'] = $_POST['type_name'];
            $type_array['type_sort'] = intval($_POST['type_sort']);
            $type_array['help_show'] = intval($_POST['help_show']);//是否显示,0为否,1为是
            $type_array['page_show'] = '1';//页面类型:1为医生,2为会员

            $state = $model_help->addHelpType($type_array);
            if ($state) {
                $this->log('新增医生帮助类型，编号' . $state);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('shop_manager/help_store/help_type'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $this->view->pick('help_store/help_store_type_add');
//
//        Tpl::setDirquna('shop');
//        Tpl::showpage('help_store_type.add');
    }

    /**
     * 编辑帮助类型
     *
     */
    public function edit_typeAction()
    {
        $model_help = new HelpLogic();
        $condition = array();
        $condition['conditions'] = 'type_id='.intval($_GET['type_id']);
        $type_list = $model_help->getHelpTypeList($condition);
        $type = $type_list[0];
        if (chksubmit()) {
            $type_array = array();
            $type_array['type_name'] = $_POST['type_name'];
            $type_array['type_sort'] = intval($_POST['type_sort']);
            $type_array['help_show'] = intval($_POST['help_show']);//是否显示,0为否,1为是
            $state = $model_help->editHelpType($condition, $type_array);
            if ($state) {
                $this->log('编辑医生帮助类型，编号' . $condition['type_id']);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('shop_manager/help_store/help_type'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $this->view->setVar('type', $type);
//        Tpl::setDirquna('shop');
//        Tpl::showpage('help_store_type.edit');
        $this->view->pick('help_store/help_store_type_edit');
    }

    /**
     * 删除帮助类型
     *
     */
    public function del_typeAction()
    {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $model_help = new HelpLogic();
            $condition['help_code'] = 'auto';
            $condition['type_id'] = $id;
            $result = $model_help->delHelpType($condition);
            if($result){
                $this->log('删除医生帮助类型，ID' . $id);
                exit(json_encode(array('state' => true, 'msg' => '删除成功')));
            }else{
                exit(json_encode(array('state' => false, 'msg' => '删除失败')));
            }
        } else {
            exit(json_encode(array('state' => false, 'msg' => '删除失败')));
        }
    }

    /**
     * 上传图片
     */
    public function upload_picAction()
    {
        $data = array();
        if (!empty($_FILES['fileupload']['name'])) {//上传图片
            $fprefix = 'help_store';
            $upload = new UploadFile();
            $upload->set('default_dir', ATTACH_ARTICLE);
            $upload->set('fprefix', $fprefix);
            $upload->upfile('fileupload');
            $model_upload = new UploadLogic();
            $file_name = $upload->file_name;
            $insert_array = array();
            $insert_array['file_name'] = $file_name;
            $insert_array['file_size'] = $_FILES['fileupload']['size'];
            $insert_array['upload_time'] = time();
            $insert_array['item_id'] = intval($_GET['item_id']);
            $insert_array['upload_type'] = '2';
            $result = $model_upload->add($insert_array);
            if ($result) {
                $data['file_id'] = $result;
                $data['file_name'] = $file_name;
            }
        }
        echo json_encode($data);
        exit;
    }

    /**
     * 删除图片
     */
    public function del_picAction()
    {
        $condition = array();
        $condition['upload_id'] = intval($_GET['file_id']);
        $model_help = Model('help');
        $state = $model_help->delHelpPic($condition);
        if ($state) {
            echo 'true';
            exit;
        } else {
            echo 'false';
            exit;
        }
    }
}
