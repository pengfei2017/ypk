<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/30
 * Time: 18:03
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Phalcon\Mvc\View;
use Ypk\Logic\BrandLogic;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\TypeLogic;
use Ypk\Models\Attribute;
use Ypk\Models\AttributeValue;
use Ypk\Models\Spec;
use Ypk\Models\Type;
use Ypk\Models\TypeBrand;
use Ypk\Models\TypeCustom;
use Ypk\Models\TypeSpec;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

/**
 * Class TypeController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 类型管理
 */
class TypeController extends ControllerBase
{
    const EXPORT_SIZE = 5000;

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,type');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->typeAction();
        $this->view->pick('type/type');
    }

    /**
     * 类型管理
     */
    public function typeAction()
    {

    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $query = Type::query();

        if ($_POST['query'] != '') {
            $query->where($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $model_type = new Type();
        $metadata = $model_type->getModelsMetaData();
        $param = $metadata->getAttributes($model_type);

        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        //医生列表
        $total_num = Type::count(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));
        $type_list = $query->limit($page, (($now_page - 1) * $page))->execute();
        if (count($type_list->toArray()) > 0) {
            $type_list = $type_list->toArray();
        } else {
            $type_list = array();
        }

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ((array)$type_list as $value) {
            $param = array();
            if (intval($value['type_id']) == 1) {
                $operation = "";
            } else {
                $operation = "<a class='btn red' href='javascript:void(0);' onclick='fg_del(" . $value['type_id'] . ")'><i class='fa fa-trash-o'></i>删除</a><a class='btn blue' href='" . getUrl('shop_manager/type/type_edit', array('t_id' => $value['type_id'])) . "'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            }
            $param['operation'] = $operation;
            $param['type_id'] = $value['type_id'];
            $param['type_name'] = $value['type_name'];
            $param['type_sort'] = $value['type_sort'];
            $param['class_id'] = $value['class_id'];
            $param['class_name'] = $value['class_name'];
            $data['list'][$value['type_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 添加类型
     */
    public function type_addAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["t_name"], "require" => "true", "message" => $this->translation->_('type_add_name_no_null')),
                array("input" => $_POST["t_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('type_add_sort_no_null')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            }

            $type_array = array();
            $type_array['type_name'] = trim($_POST['t_name']);
            $type_array['type_sort'] = trim($_POST['t_sort']);
            $type_array['class_id'] = intval($_POST['class_id']);
            $type_array['class_name'] = $_POST['class_name'];
            $model_type = new Type();
            $type_id = $model_type->save($type_array);

            if ($type_id == false) {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
            $type_id = $model_type->getTypeId();

            //添加类型与品牌对应
            $logic_type = new TypeLogic();
            if (!empty($_POST['brand_id'])) {
                $brand_array = $_POST['brand_id'];
                $return = $logic_type->typeBrandAdd($brand_array, $type_id);
                if (!$return) {
                    $this->showMessage($this->translation->_('type_index_related_fail'));
                }
            }
            //添加类型与规格对应
            if (!empty($_POST['spec_id'])) {
                $spec_array = $_POST['spec_id'];
                $return = $logic_type->typeSpecAdd($spec_array, $type_id);
                if (!$return) {
                    $this->showMessage($this->translation->_('type_index_related_fail'));
                }
            }
            //添加类型属性
            if (!empty($_POST['at_value'])) {
                $attribute_array = $_POST['at_value'];
                foreach ($attribute_array as $v) {
                    if ($v['value'] != '') {
                        // 转码  防止GBK下用中文逗号截取不正确
                        $comma = '，';
                        $v['value'] = str_replace($comma, ',', $v['value']);                      //把属性值中的中文逗号替换成英文逗号

                        //属性值
                        //添加属性
                        $attr_array = array();
                        $attr_array['attr_name'] = $v['name'];
                        $attr_array['attr_value'] = $v['value'];
                        $attr_array['type_id'] = $type_id;
                        $attr_array['attr_sort'] = $v['sort'];
                        $attr_array['attr_show'] = intval($v['show']);

                        $attribute = new Attribute();
                        $attr_id = $attribute->save($attr_array);
                        if ($attr_id == false) {
                            $this->showMessage($this->translation->_('type_index_related_fail'));
                        }
                        $attr_id = $attribute->getAttrId();
                        //添加属性值
                        $attr_value = explode(',', $v['value']);
                        if (!empty($attr_value)) {
                            foreach ($attr_value as $val) {
                                $tpl_array = array();
                                $tpl_array['attr_value_name'] = $val;
                                $tpl_array['attr_id'] = $attr_id;
                                $tpl_array['type_id'] = $type_id;
                                $tpl_array['attr_value_sort'] = 0;

                                $attribute_value = new AttributeValue();
                                if ($attribute_value->save($tpl_array) == false) {
                                    $this->showMessage($this->translation->_('type_index_related_fail'));
                                }
                            }
                        }
                    }
                }
            }
            // 添加自定义属性
            if (!empty($_POST['custom'])) {
                foreach ($_POST['custom'] as $val) {
                    if (empty($val)) {
                        continue;
                    }
                    $custom_insert = array();
                    $custom_insert['custom_name'] = $val;
                    $custom_insert['type_id'] = $type_id;

                    $type_custom = new TypeCustom();
                    if ($type_custom->save($custom_insert) == false) {
                        $this->showMessage($this->translation->_('type_index_related_fail'));
                    }
                }
            }
            $url = array(
                array(
                    'url' => getUrl('shop_manager/type/type_add'),
                    'msg' => $this->translation->_('type_index_continue_to_dd')
                ),
                array(
                    'url' => getUrl('shop_manager/type/type'),
                    'msg' => $this->translation->_('type_index_return_type_list')
                )
            );
            $this->log($this->translation->_('nc_add') . $this->translation->_('type_index_type_name') . '[' . $_POST['t_name'] . ']', 1);
            $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
        }

        // 品牌列表
        $model_brand = new BrandLogic();
        $brand_list = $model_brand->getBrandPassedList();
        $b_list = array();
        if (is_array($brand_list) && !empty($brand_list)) {
            foreach ($brand_list as $k => $val) {
                $b_list[$val['class_id']]['brand'][$k] = $val;
                $b_list[$val['class_id']]['name'] = $val['brand_class'] == '' ? $this->translation->_('nc_default') : $val['brand_class'];
            }
        }
        ksort($b_list);

        //规格列表
        $spec_list = Spec::find(array(
            "order" => "sp_sort asc"
        ));
        if (count($spec_list) > 0) {
            $spec_list = $spec_list->toArray();
        } else {
            $spec_list = array();
        }
        $s_list = array();
        if (is_array($spec_list) && !empty($spec_list)) {
            foreach ($spec_list as $k => $val) {
                $s_list[$val['class_id']]['spec'][$k] = $val;
                $s_list[$val['class_id']]['name'] = $val['class_name'] == '' ? $this->translation->_('nc_default') : $val['class_name'];
            }
        }
        ksort($s_list);
        // 一级分类列表
        $goods_class_logic = new GoodsClassLogic();
        $gc_list = $goods_class_logic->getGoodsClassListByParentId(0);

        $this->view->setVar('gc_list', $gc_list);

        $this->view->setVar('spec_list', $s_list);
        $this->view->setVar('brand_list', $b_list);
    }

    /**
     * 编辑类型
     */
    public function type_editAction()
    {
        if (empty($_GET['t_id'])) {
            $this->showMessage($this->translation->_('param_error'));
        }

        //编辑保存
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["t_name"], "require" => "true", "message" => $this->translation->_('type_add_name_no_null')),
                array("input" => $_POST["t_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('type_add_sort_no_null')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            }

            //更新属性关联表信息
            $type_id = intval($_POST['t_id']);

            $logic_type = new TypeLogic();

            //品牌
            if ($_POST['brand']['form_submit'] == 'ok') {
                $type_brand_list = TypeBrand::find('type_id = ' . $type_id);
                if (count($type_brand_list) > 0) {
                    foreach ($type_brand_list as $type_brand) {
                        $type_brand->delete();
                    }
                }

                if (!empty($_POST['brand_id'])) {
                    $brand_array = $_POST['brand_id'];
                    $return = $logic_type->typeBrandAdd($brand_array, $type_id);
                    if (!$return) {
                        $this->showMessage($this->translation->_('type_index_related_fail'));
                    }
                }

            }

            //规格
            if ($_POST['spec']['form_submit'] == 'ok') {
                $type_spec_list = TypeSpec::find('type_id = ' . $type_id);
                if (count($type_spec_list) > 0) {
                    foreach ($type_spec_list as $type_spec) {
                        $type_spec->delete();
                    }
                }

                if (!empty($_POST['spec_id'])) {
                    $spec_array = $_POST['spec_id'];
                    $return = $logic_type->typeSpecAdd($spec_array, $type_id);
                    if (!$return) {
                        $this->showMessage($this->translation->_('type_index_related_fail'));
                    }
                }
            }

            // 属性
            // 转码  防止用中文逗号截取不正确
            $comma = '，';
            if (is_array($_POST['at_value']) && !empty($_POST['at_value'])) {
                $attribute_array = $_POST['at_value'];

                // 要删除的属性id
                $del_array = array();
                if (!empty($_POST['a_del'])) {
                    $del_array = $_POST['a_del'];
                }

                foreach ($attribute_array as $v) {

                    $v['value'] = str_replace($comma, ',', $v['value']);                      //把属性值中的中文逗号替换成英文逗号

                    if (isset($v['form_submit']) && $v['form_submit'] == 'ok' && !in_array($v['a_id'], $del_array)) {             //原属性已修改
                        //有form_submit的是已经存在的，包括要修改和要删除的，勾选要删除的就不用修改了，直接删除了下边
                        // 属性
                        $attr_array = array();
                        $attr_array['attr_name'] = $v['name'];
                        $attr_array['type_id'] = $type_id;
                        $attr_array['attr_sort'] = $v['sort'];
                        $attr_array['attr_show'] = intval($v['show']);
                        $attribute = Attribute::findFirst('type_id = ' . $type_id . ' and attr_id = ' . intval($v['a_id']));
                        $return = $attribute->save($attr_array);
                        if ($return == false) {
                            $this->showMessage($this->translation->_('type_index_related_fail'));
                        }
                    } else if (!isset($v['form_submit'])) {                                   //新增属性
                        //没有form_submit的是新增的
                        if ($v['name'] == '') {
                            continue;
                        }
                        // 属性
                        $attr_array = array();
                        $attr_array['attr_name'] = $v['name'];
                        $attr_array['attr_value'] = $v['value'];
                        $attr_array['type_id'] = $type_id;
                        $attr_array['attr_sort'] = $v['sort'];
                        $attr_array['attr_show'] = intval($v['show']);
                        $attribute = new Attribute();
                        $attr_id = $attribute->save($attr_array);
                        if ($attr_id == false) {
                            $this->showMessage($this->translation->_('type_index_related_fail'));
                        }
                        $attr_id = $attribute->getTypeId();
                        // 添加属性值
                        $attr_value = explode(',', $v['value']);
                        if (!empty($attr_value)) {
                            $attr_array = array();
                            foreach ($attr_value as $val) {
                                if ($val == '') {
                                    continue;
                                }
                                $tpl_array = array();
                                $tpl_array['attr_value_name'] = $val;
                                $tpl_array['attr_id'] = $attr_id;
                                $tpl_array['type_id'] = $type_id;
                                $tpl_array['attr_value_sort'] = 0;
                                $attributevalue = new AttributeValue();
                                if ($attributevalue->save($tpl_array) == false) {
                                    $this->showMessage($this->translation->_('type_index_related_fail'));
                                }
                            }
                        }
                    }
                }

                // 删除属性
                if (!empty($_POST['a_del'])) {
                    $del_id = $_POST['a_del'];
                    //删除属性值
                    $attributevalue_del_list = AttributeValue::find('attr_id in (' . implode(',', $del_id) . ')');
                    if (count($attributevalue_del_list) > 0) {
                        foreach ($attributevalue_del_list as $attributevalue_del) {
                            $attributevalue_del->delete();
                        }
                    }
                    //删除属性
                    $attribute_del_list = Attribute::find('attr_id in (' . implode(',', $del_id) . ')');
                    if (count($attribute_del_list) > 0) {
                        foreach ($attribute_del_list as $attribute_del) {
                            $attribute_del->delete();
                        }
                    }
                }

            }

            // 更新原自定义属性
            if (!empty($_POST['custom'])) {
                $custom_del_array = array();
                foreach ($_POST['custom'] as $key => $val) {
                    if (intval($val['del']) == 1 || empty($val['name'])) {
                        $custom_del_array[] = $key;
                        continue;
                    }
                    $typecustom = TypeCustom::findFirst('custom_id = ' . $key);
                    $typecustom->save(array('custom_name' => $val['name']));
                }
                if (!empty($custom_del_array)) {
                    $typecustom_del_list = TypeCustom::find('custom_id in (' . implode(',', $custom_del_array) . ')');
                    if (count($typecustom_del_list) > 0) {
                        foreach ($typecustom_del_list as $typecustom_del) {
                            $typecustom_del->delete();
                        }
                    }
                }
            }

            // 添加自定义属性
            if (!empty($_POST['custom_new'])) {
                foreach ($_POST['custom_new'] as $val) {
                    if (empty($val)) {
                        continue;
                    }
                    $custom_insert = array();
                    $custom_insert['custom_name'] = $val;
                    $custom_insert['type_id'] = $type_id;
                    $typecustom = new TypeCustom();
                    $typecustom->save($custom_insert);
                }
            }

            // 更新类型信息
            $type_array = array();
            $type_array['type_name'] = trim($_POST['t_name']);
            $type_array['type_sort'] = trim($_POST['t_sort']);
            $type_array['class_id'] = intval($_POST['class_id']);
            $type_array['class_name'] = $_POST['class_name'];
            $model_type = Type::findFirst('type_id = ' . $type_id);
            $return = $model_type->save($type_array);
            if ($return) {
                $url = array(
                    array(
                        'url' => getUrl('shop_manager/type/type'),
                        'msg' => $this->translation->_('type_index_return_type_list')
                    )
                );
                $this->log($this->translation->_('nc_edit') . $this->translation->_('type_index_type_name') . '[' . $_POST['t_name'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
            } else {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('type_index_type_name') . '[' . $_POST['t_name'] . ']', 0);
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }

        // 属性列表
        $type_info = Type::findFirst('type_id = ' . intval($_GET['t_id']));
        if ($type_info == false) {
            $this->showMessage($this->translation->_('param_error'));
        }
        $this->view->setVar('type_info', $type_info->toArray());

        // 品牌
        $model_brand = new BrandLogic();
        $brand_list = $model_brand->getBrandPassedList();
        $b_list = array();
        if (is_array($brand_list) && !empty($brand_list)) {
            foreach ($brand_list as $k => $val) {
                $b_list[$val['class_id']]['brand'][$k] = $val;
                $b_list[$val['class_id']]['name'] = $val['brand_class'] == '' ? $this->translation->_('nc_default') : $val['brand_class'];
            }
        }
        ksort($b_list);
        unset($brand_list);
        // 类型与品牌关联列表
        $model_type = new TypeBrand();
        $brand_related = TypeBrand::find('type_id = ' . intval($_GET['t_id']));
        $b_related = array();
        if (count($brand_related) > 0) {
            foreach ($brand_related as $val) {
                $b_related[] = $val->getBrandId();
            }
        }
        unset($brand_related);
        $this->view->setVar('brang_related', $b_related);
        $this->view->setVar('brand_list', $b_list);

        // 规格表
        $spec_list = Spec::find(array('order' => 'sp_sort asc'));
        $s_list = array();
        if (count($spec_list) > 0) {
            foreach ($spec_list as $k => $val) {
                $s_list[$val->getClassId()]['spec'][$k] = $val->toArray();
                $s_list[$val->getClassId()]['name'] = $val->getClassName() == '' ? $this->translation->_('nc_default') : $val->getClassName();

            }
        }
        ksort($s_list);
        // 规格关联列表
        $spec_related = TypeSpec::find('type_id = ' . intval($_GET['t_id']));
        $sp_related = array();
        if (count($spec_related) > 0) {
            foreach ($spec_related as $val) {
                $sp_related[] = $val->getSpId();
            }
        }
        unset($spec_related);
        $this->view->setVar('spec_related', $sp_related);
        $this->view->setVar('spec_list', $s_list);

        $custom_list = TypeCustom::find('type_id = ' . intval($_GET['t_id']));
        $this->view->setVar('custom_list', $custom_list->toArray());

        // 一级分类列表
        $logic_goods_class = new GoodsClassLogic();
        $gc_list = $logic_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);

        // 属性
        $attr_list = Attribute::find(array('type_id = ' . intval($_GET['t_id']), 'order' => 'attr_sort asc'));
        $this->view->setVar('attr_list', $attr_list->toArray());
    }

    /**
     * 编辑属性
     */
    public function attr_editAction()
    {
        if ($_POST['form_submit'] == 'ok') {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["attr_name"], "require" => "true", "message" => $this->translation->_('type_edit_type_attr_name_no_null')),
                array("input" => $_POST["attr_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('type_edit_type_attr_sort_no_null')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showDialog($error);
            } else {
                //更新属性值表
                $attr_value = $_POST['attr_value'];

                // 要删除的规格值id
                $del_array = array();
                if (!empty($_POST['attr_del'])) {
                    $del_array = $_POST['attr_del'];
                }

                if (!empty($attr_value) && is_array($attr_value)) {
                    foreach ($attr_value as $key => $val) {
                        if ($val['name'] == '') {
                            continue;
                        }
                        if (isset($val['form_submit']) && $val['form_submit'] == 'ok' && !in_array(intval($key), $del_array)) {       // 属性已修改
                            //有form_submit说明是已经存在的属性值，包括要编辑的和要删除的，要删除的在下面的代码中直接删除就好了
                            $update = array();
                            $update['attr_value_name'] = $val['name'];
                            $update['attr_value_sort'] = intval($val['sort']);
                            $AttributeValue = AttributeValue::findFirst('attr_value_id = ' . intval($key));
                            $AttributeValue->save($update);
                        } else if (!isset($val['form_submit'])) {
                            //没有form_submit说明是新增的属性值
                            $insert = array();
                            $insert['attr_value_name'] = $val['name'];
                            $insert['attr_id'] = intval($_POST['attr_id']);
                            $insert['type_id'] = intval($_POST['type_id']);
                            $insert['attr_value_sort'] = intval($val['sort']);
                            $AttributeValue = new AttributeValue();
                            $AttributeValue->save($insert);
                        }
                    }

                    // 删除属性值
                    $attribute_value_del_list = AttributeValue::find('attr_value_id in (' . implode(',', $del_array) . ')');
                    if (count($attribute_value_del_list) > 0) {
                        foreach ($attribute_value_del_list as $attribute_value_del) {
                            $attribute_value_del->delete();
                        }
                    }
                }

                //获取属性值字符串，用于更新属性
                $attr_value_list = AttributeValue::find(array('attr_id = ' . intval($_POST['attr_id']), 'order' => 'attr_value_sort asc, attr_value_id asc'));
                $attr_array = array();
                foreach ($attr_value_list as $val) {
                    $attr_array[] = $val->getAttrValueName();
                }

                /**
                 * 更新属性
                 */
                $data = array();
                $data['attr_name'] = $_POST['attr_name'];
                $data['attr_value'] = implode(',', $attr_array);
                $data['attr_show'] = intval($_POST['attr_show']);
                $data['attr_sort'] = intval($_POST['attr_sort']);
                $model = Attribute::findFirst('attr_id = ' . intval($_POST['attr_id']));
                $return = $model->save($data);

                if ($return) {
                    $this->log($this->translation->_('type_edit_type_attr_edit') . '[' . $_POST['attr_name'] . ']', 1);
                    $this->showDialog($this->translation->_('type_edit_type_attr_edit_succ'), 'reload', 'succ');
                } else {
                    $this->log($this->translation->_('type_edit_type_attr_edit') . '[' . $_POST['attr_name'] . ']', 0);
                    $this->showDialog($this->translation->_('type_edit_type_attr_edit_fail'), 'reload');
                }
            }
        }

        $attr_id = intval($_GET['attr_id']);
        if ($attr_id == 0) {
            $this->showMessage($this->translation->_('param_error'));
        }
        $attr_info = Attribute::findFirst('attr_id = ' . $attr_id);

        $this->view->setVar('attr_info', $attr_info->toArray());

        $attr_value_list = AttributeValue::find(array('attr_id = ' . $attr_id, 'order' => 'attr_value_sort asc, attr_value_id asc'));

        $this->view->setVar('attr_value_list', $attr_value_list->toArray());

        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }

    /**
     * 删除类型
     */
    public function type_delAction()
    {
        if (empty($_GET['id'])) {
            exit(json_encode(array('state' => false, 'msg' => $this->translation->_('param_error'))));
        }

        //属性模型查询
        $query = Type::query();

        if (is_array($_GET['id'])) {
            $id = "'" . implode("','", $_GET['id']) . "'";
            $query->inWhere('type_id', $_GET['id']);
        } else {
            $id = intval($_GET['id']);
            $query->where('type_id = ' . $_GET['id']);
        }
        //属性列表
        $type_list = Type::find(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));

        if (count($type_list) > 0) {

            //删除属性值表
            $attr_list = Attribute::find(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            if (count($attr_list) > 0) {
                $attrs_id = array();
                foreach ($attr_list as $val) {
                    $attrs_id[] = $val->getAttrId();
                }
                $attributevalue_list = AttributeValue::find('attr_id in (' . implode(',', $attrs_id) . ')'); //删除属性值
                if (count($attributevalue_list) > 0) {
                    foreach ($attributevalue_list as $attributevalue) {
                        if ($attributevalue->delete() == false) {
                            exit(json_encode(array('state' => false, 'msg' => $this->translation->_('type_index_del_related_attr_fail'))));
                        }
                    }
                }
                foreach ($attr_list as $attr) {
                    if ($attr->delete() == false) {
                        exit(json_encode(array('state' => false, 'msg' => $this->translation->_('type_index_del_related_attr_fail'))));
                    }
                }
            }

            //删除对应品牌
            $typebrand_list = TypeBrand::find(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            if (count($typebrand_list) > 0) {
                foreach ($typebrand_list as $typebrand) {
                    if ($typebrand->delete() == false) {
                        exit(json_encode(array('state' => false, 'msg' => $this->translation->_('type_index_del_related_brand_fail'))));
                    }
                }
            }

            //删除对应规格
            $typespec_list = TypeSpec::find(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            if (count($typespec_list) > 0) {
                foreach ($typespec_list as $typespec) {
                    if ($typespec->delete() == false) {
                        exit(json_encode(array('state' => false, 'msg' => $this->translation->_('type_index_del_related_brand_fail'))));
                    }
                }
            }

            //删除类型
            foreach ($type_list as $type) {
                if ($type->delete() == false) {
                    exit(json_encode(array('state' => false, 'msg' => $this->translation->_('type_index_del_fail'))));
                }
            }

            // 删除自定义属性
            $typecustom_list = TypeCustom::find(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            if (count($typecustom_list) > 0) {
                foreach ($typecustom_list as $typecustom) {
                    if ($typecustom->delete() == false) {
                        exit(json_encode(array('state' => false, 'msg' => $this->translation->_('type_index_del_related_brand_fail'))));
                    }
                }
            }

            $this->log($this->translation->_('nc_delete') . $this->translation->_('type_index_type_name') . '[ID:' . $id . ']', 1);
            exit(json_encode(array('state' => true, 'msg' => $this->translation->_('type_index_del_succ'))));
        } else {
            $this->log($this->translation->_('nc_delete') . $this->translation->_('type_index_type_name') . '[ID:' . $id . ']', 0);
            exit(json_encode(array('state' => false, 'msg' => $this->translation->_('param_error'))));
        }
    }
}