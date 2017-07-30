<?php
/**
 * 医生分类
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\StoreClassLogic;
use Ypk\Models\Store;
use Ypk\Models\StoreClass;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

class StoreclassController extends ControllerBase
{
    public function initialize()
    {
        $this->translation = getTranslation('layout,store_class,store_grade,common');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->store_classAction();
    }

    /**
     * 医生分类
     */
    public function store_classAction()
    {
        $model_class = new StoreClassLogic();

        //删除
        if (chksubmit()) {
            if (!empty($_POST['check_sc_id']) && is_array($_POST['check_sc_id'])) {
                $result = $model_class->delStoreClass(array('sc_id' => array('in', $_POST['check_sc_id'])));
                if ($result) {
                    $this->log($this->translation->_('nc_del,store_class') . '[ID:' . implode(',', $_POST['check_sc_id']) . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_del_succ'));
                }
            }
            $this->showMessage($this->translation->_('nc_common_del_fail'));
        }
//        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
//        $page = intval($_POST['rp']); //表示页容量
//        $offset = $page * ($currentPageIndex - 1); //计算偏移量
        $store_class_list = $model_class->getStoreClassList(array());
        $this->view->setVar('class_list', $store_class_list);
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_class.index');
        $this->view->pick('store_class/store_class');
    }

    /**
     * 商品分类添加
     */
    public function store_class_addAction()
    {
        $model_class = new StoreClassLogic();
        if (chksubmit()) {
            //验证
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["sc_name"], "require" => "true", "message" => $this->translation->_('store_class_name_no_null')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $insert_array = array();
                $insert_array['sc_name'] = $_POST['sc_name'];
                $insert_array['sc_bail'] = intval($_POST['sc_bail']);
                $insert_array['sc_sort'] = intval($_POST['sc_sort']);
                $result = $model_class->addStoreClass($insert_array);
                if ($result) {
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/store_class/store_class_add'),
                            'msg' => $this->translation->_('continue_add_store_class'),
                        ),
                        array(
                            'url' => getUrl('shop_manager/store_class/store_class'),
                            'msg' => $this->translation->_('back_store_class_list'),
                        )
                    );
                    $this->log($this->translation->_('nc_add,store_class') . '[' . $_POST['sc_name'] . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'), $url, 'html', 'succ', 1, 5000);
                } else {
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }
        $this->view->pick('store_class/store_class_add');
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_class.add');
    }

    /**
     * 编辑
     */
    public function store_class_editAction()
    {
        $model_class = new StoreClassLogic();
        if (chksubmit()) {
            //验证
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(array("input" => $_POST["sc_name"], "require" => "true", "message" => $this->translation->_('store_class_name_no_null')));
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $update_array = array();
                $update_array['sc_name'] = $_POST['sc_name'];
                $update_array['sc_bail'] = intval($_POST['sc_bail']);
                $update_array['sc_sort'] = intval($_POST['sc_sort']);
                $result = $model_class->editStoreClass($update_array, array('conditions'=>'sc_id='.intval($_POST['sc_id'])));
                if ($result) {
                    $this->log($this->translation->_('nc_edit').$this->translation->_('store_class') . '[' . $_POST['sc_name'] . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('shop_manager/store_class/store_class'));
                } else {
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

        $class_array = $model_class->getStoreClassInfo(array('conditions' => 'sc_id=' . intval($_GET['sc_id'])));
        if (empty($class_array)) {
            $this->showMessage($this->translation->_('illegal_parameter'));
        }

        $this->view->setVar('class_array', $class_array);
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_class.edit');
        $this->view->pick('store_class/store_class_edit');
    }

    /**
     * 删除分类
     */
    public function store_class_delAction()
    {
        $model_class = new StoreClassLogic();
        if (intval($_GET['sc_id']) > 0) {
            //$array =intval($_GET['sc_id']);
            $result = $model_class->delStoreClass('sc_id='.intval($_GET['sc_id']));
            if ($result) {
                $this->log($this->translation->_('nc_del,store_class') . '[ID:' . $_GET['sc_id'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_del_succ'), getReferer());
            }
        }
        $this->showMessage($this->translation->_('nc_common_del_fail'),getUrl('shop_manager/store_class/store_class'));
    }

    /**
     * ajax操作
     */

    public function ajaxAction()
    {
        $model_class = StoreClass::query();
        switch ($_GET['branch']) {
            //分类：添加、修改操作中 检测类别名称是否有重复
            case 'sc_name':
                $model_class->where('sc_name = \'' . trim($_GET['sc_name']) . '\'');
                if (!empty($_GET['sc_id'])) {
                    $model_class->andWhere('sc_id <> ' . intval($_GET['sc_id']));
                }
                $model_class = $model_class->execute();
                if (count($model_class->toArray()) > 0) {
                    echo 'false';
                    exit;
                } else {
                    echo 'true';
                    exit;
                }
                break;
            //分类： 排序 显示 设置
            case 'sc_sort':
                $model_class = Model('store_class');
                $update_array['sc_sort'] = intval($_GET['value']);
                $result = $model_class->editStoreClass($update_array, array('sc_id' => intval($_GET['id'])));
                $return = $result ? true : false;
                break;
        }
        exit(json_encode(array('result' => $return)));
    }

    /**
     * 验证分类名称
     */
    public function ajax_check_nameAction()
    {
        $query = StoreClass::query();
        $query->where('sc_name=\''.trim($_GET['sc_name']).'\'');
        if(!empty($_GET['sc_id'])){
            $query->andWhere('sc_id <>'.intval($_GET['sc_id']));
        }
        $model_class = $query->execute();
        if(count($model_class->toArray()) > 0){
            echo 'false';
        }else{
            echo 'true';
        }
        $this->view->disable();
//        $model_class = new StoreClassLogic();
//        $condition['conditions'] = "sc_name='" . $_GET['sc_name'] . "'";
//        $class_list = $model_class->getStoreClassList($condition);
//        $return = empty($class_list) ? 'true' : 'false';
//        echo $return;
//        $this->view->disable();
        //$condition['bind'] = intval($_GET['sc_id']));
    }
}
