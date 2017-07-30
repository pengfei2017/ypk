<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/29
 * Time: 21:14
 */

namespace Ypk\Modules\ShopManager\Controllers;

use Phalcon\Mvc\Model\Query;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\SpecLogic;
use Ypk\Models\Spec;
use Ypk\Models\SpecValue;
use Ypk\Models\TypeSpec;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

/**
 * Class SpecController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 规格栏目管理
 */
class SpecController extends ControllerBase
{
    const EXPORT_SIZE = 5000;

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,spec');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->specAction();
        $this->view->pick('spec/spec');
    }

    /**
     * 规格管理
     */
    public function specAction()
    {

    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $query = Spec::query();

        if ($_POST['query'] != '') {
            $query->where($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $model = new Spec();
        $metadata = $model->getModelsMetaData();
        $param = $metadata->getAttributes($model);

        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        //$page->setStyle('admin');
        //医生列表
        $count = Spec::count(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));
        $spec_list = $query->limit($page, (($now_page - 1) * $page))->execute();
        if (count($spec_list->toArray()) > 0) {
            $spec_list = $spec_list->toArray();
        } else {
            $spec_list = array();
        }

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $count;
        foreach ($spec_list as $value) {
            $param = array();
            $operation = '';
            if ($value['sp_id'] != DEFAULT_SPEC_COLOR_ID) {
                $operation .= "<a class='btn red' href='javascript:void(0);' onclick='fg_del(" . $value['sp_id'] . ")'><i class='fa fa-trash-o'></i>删除</a>";
            }
            $operation .= "<a class='btn blue' href='" . getUrl('shop_manager/spec/spec_edit', array('sp_id' => $value['sp_id'])) . "'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $param['operation'] = $operation;
            $param['sp_id'] = $value['sp_id'];
            $param['sp_name'] = $value['sp_name'];
            $param['sp_sort'] = $value['sp_sort'];
            $param['class_id'] = $value['class_id'];
            $param['class_name'] = $value['class_name'];
            $data['list'][$value['sp_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 添加规格
     */
    public function spec_addAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["s_name"], "require" => "true", "message" => $this->translation->_('spec_add_name_no_null'))
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $spec = array();
                $spec['sp_name'] = $_POST['s_name'];
                $spec['sp_sort'] = intval($_POST['s_sort']);
                $spec['class_id'] = intval($_POST['class_id']);
                $spec['class_name'] = $_POST['class_name'];
                $model_spec = new SpecLogic();
                $return = $model_spec->addSpec($spec);
                if ($return) {
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/spec/spec_add'),
                            'msg' => $this->translation->_('spec_index_continue_to_dd')
                        ),
                        array(
                            'url' => getUrl('shop_manager/spec/spec'),
                            'msg' => $this->translation->_('spec_index_return_type_list')
                        )
                    );
                    $this->log($this->translation->_('nc_add') . $this->translation->_('spec_index_spec_name') . '[' . $_POST['s_name'] . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
                } else {
                    $this->log($this->translation->_('nc_add') . $this->translation->_('spec_index_spec_name') . '[' . $_POST['s_name'] . ']', 0);
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }
        // 一级商品分类
        $goods_class = new GoodsClassLogic();
        $gc_list = $goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);
    }

    /**
     * 编辑规格
     */
    public function spec_editAction()
    {
        if (empty($_GET['sp_id'])) {
            $this->showMessage($this->translation->_('param_error'));
        }

        /**
         * 编辑保存
         */
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["s_name"], "require" => "true", "message" => $this->translation->_('spec_add_name_no_null'))
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                //更新规格表
                $param = array();
                $param['sp_name'] = trim($_POST['s_name']);
                $param['sp_sort'] = intval($_POST['s_sort']);
                $param['class_id'] = intval($_POST['class_id']);
                $param['class_name'] = $_POST['class_name'];
                $model_spec = Spec::findFirst('sp_id = ' . intval($_POST['s_id']));
                if ($model_spec != false) {
                    if ($model_spec->save($param)) {
                        $url = array(
                            array(
                                'url' => getUrl('shop_manager/spec/spec'),
                                'msg' => $this->translation->_('spec_index_return_type_list')
                            )
                        );
                        $this->log($this->translation->_('nc_edit') . $this->translation->_('spec_index_spec_name') . '[' . $_POST['s_name'] . ']', 1);
                        $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
                    } else {
                        $this->log($this->translation->_('nc_edit') . $this->translation->_('spec_index_spec_name') . '[' . $_POST['s_name'] . ']', 0);
                        $this->showMessage($this->translation->_('nc_common_save_fail'));
                    }
                } else {
                    $this->showMessage($this->translation->_('param_error'));
                }
            }
        }

        //规格列表
        $spec_list = Spec::findFirst('sp_id = ' . intval($_GET['sp_id']));
        if ($spec_list == false) {
            $this->showMessage($this->translation->_('param_error'));
        } else {
            $spec_list = $spec_list->toArray();
        }

        // 一级商品分类
        $logic_goods_class = new GoodsClassLogic();
        $gc_list = $logic_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);

        $this->view->setVar('sp_list', $spec_list);
    }

    /**
     * 删除规格
     */
    public function spec_delAction()
    {
        if (empty($_GET['id'])) {
            exit(json_encode(array('state' => false, 'msg' => $this->translation->_('param_error'))));
        }
        //规格模型
        $query_spec = Spec::query();
        if (is_array($_GET['id'])) {
            $id = "'" . implode("','", $_GET['id']) . "'";
            $query_spec->inWhere('sp_id', $_GET['id']);
        } else {
            $id = intval($_GET['id']);
            $query_spec->where('sp_id = :sp_id:', array('sp_id' => intval($_GET['id'])));
        }
        //规格列表
        $spec_list = Spec::find(array(
            "conditions" => $query_spec->getConditions(),
            "bind" => getBind($query_spec)
        ));
        if (count($spec_list) > 0) {
            // 删除类型与规格关联表
            $typespec_list = TypeSpec::find(array(
                "conditions" => $query_spec->getConditions(),
                "bind" => getBind($query_spec)
            ));
            if (count($typespec_list) > 0) {
                foreach ($typespec_list as $typespec) {
                    if ($typespec->delete() == false) {
                        exit(json_encode(array('state' => false, 'msg' => $this->translation->_('nc_common_save_fail'))));
                    }
                }
            }

            //删除规格值表
            $specvalue_list = SpecValue::find(array(
                "conditions" => $query_spec->getConditions(),
                "bind" => getBind($query_spec)
            ));
            if (count($specvalue_list) > 0) {
                foreach ($specvalue_list as $specvalue) {
                    if ($specvalue->delete() == false) {
                        exit(json_encode(array('state' => false, 'msg' => $this->translation->_('nc_common_save_fail'))));
                    }
                }
            }

            //删除规格表
            foreach ($spec_list as $spec) {
                if ($spec->delete() == false) {
                    exit(json_encode(array('state' => false, 'msg' => $this->translation->_('nc_common_save_fail'))));
                }
            }

            $this->log($this->translation->_('nc_delete') . $this->translation->_('spec_index_spec_name') . '[ID:' . $id . ']', 1);
            exit(json_encode(array('state' => true, 'msg' => $this->translation->_('nc_common_del_succ'))));
        } else {
            $this->log($this->translation->_('nc_delete') . $this->translation->_('spec_index_spec_name') . '[ID:' . $id . ']', 0);
            exit(json_encode(array('state' => false, 'msg' => $this->translation->_('param_error'))));
        }
    }

    /**
     * 验证规格名称是否已经被使用
     * ajax操作
     */
    public function ajaxAction()
    {
        switch ($_GET['branch']) {
            /**
             * 添加、修改操作中 检测规格名称是否有重复
             */
            case 'check_spec_name':
                $query_spec = Spec::query();
                if (isset($_GET['s_id']) && intval($_GET['s_id']) > 0) {
                    $query_spec->where('sp_id <> :sp_id:', array('sp_id' => intval($_GET['s_id'])));
                }

                if (isset($_GET['s_name']) && !empty(trim($_GET['s_name']))) {
                    $query_spec->andWhere('sp_name = :sp_name:', array('sp_name' => trim($_GET['s_name'])));
                }

                $class_list = $query_spec->execute();
                if (count($class_list->toArray()) > 0) {
                    echo 'false';
                    exit;
                } else {
                    echo 'true';
                    exit;
                }
                break;
        }
    }
}
