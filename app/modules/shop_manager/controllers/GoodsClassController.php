<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/27
 * Time: 13:26
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Phalcon\Db\Result\Pdo;
use Phalcon\Mvc\View;
use Phalcon\Queue\Beanstalk;
use Ypk\CacheRedis;
use Ypk\Db;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\GoodsClassNavLogic;
use Ypk\Logic\GoodsClassTagLogic;
use Ypk\Models\Brand;
use Ypk\Models\GoodsClass;
use Ypk\Models\GoodsClassNav;
use Ypk\Models\GoodsClassTag;
use Ypk\Models\Type;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\QueueClient;
use Ypk\QueueServer;
use Ypk\UploadFile;
use Ypk\Validate;

/**
 * Class GoodsClassController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商品分类管理
 */
class GoodsClassController extends ControllerBase
{
    private $links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'goods_class', 'action' => 'goods_class'), 'lang' => 'nc_manage'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'goods_class', 'action' => 'goods_class_import'), 'lang' => 'goods_class_index_import'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'goods_class', 'action' => 'tag'), 'lang' => 'goods_class_index_tag'),
    );
    private $show_type = array(
        1 => '颜色',
        2 => 'SPU'
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,goods_class');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->goods_classAction();
    }

    /**
     * 分类管理
     */
    public function goods_classAction()
    {
        $this->view->setVar('show_type', $this->show_type);
        $logic_goods_class = new GoodsClassLogic();

        //父ID
        $parent_id = 0;
        $parent_name = '';
        $gc_id = $_GET['gc_id'] ? intval($_GET['gc_id']) : 0;

        //列表
        $tmp_list = $logic_goods_class->getTreeClassList(3);
        $class_list = array();
        if (is_array($tmp_list)) {
            foreach ($tmp_list as $k => $v) {
                if ($v['gc_parent_id'] == $gc_id) {
                    //判断是否有子类
                    if ($tmp_list[$k + 1]['deep'] > $v['deep']) {
                        $v['have_child'] = 1;
                    }
                    $class_list[] = $v;
                }
                if ($v['gc_id'] == $gc_id) {
                    $parent_id = $v['gc_parent_id'];
                    $parent_name = $v['gc_name'];
                }
            }
        }
        if ($gc_id > 0) {
            if ($parent_id == 0) {
                $title = '"' . $parent_name . '"的下级列表(二级)';
                $deep = 2;
            } else {
                $grandparents_name = '';
                foreach ($tmp_list as $v) {
                    if ($v['gc_id'] == $parent_id) {
                        $grandparents_name = $v['gc_name'];
                    }
                }
                $title = '"' . $grandparents_name . ' - ' . $parent_name . '"的下级列表(三级)';
                $deep = 3;
            }
            $this->view->setVar('deep', 3);
            $this->view->setVar('title', $title);
            $this->view->setVar('parent_id', $parent_id);
            $this->view->setVar('gc_id', $gc_id);
            $this->view->setVar('class_list', $class_list);

            $this->view->pick('goods_class/child_list');
        } else {
            $this->view->setVar('class_list', $class_list);
            $this->view->setVar('top_link', $this->sublink($this->links, 'goods_class'));

            $this->view->pick('goods_class/goods_class');
        }
    }

    /**
     * 商品分类添加
     */
    public function goods_class_addAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["gc_name"], "require" => "true", "message" => $this->translation->_('goods_class_add_name_null')),
                array("input" => $_POST["gc_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('goods_class_add_sort_int')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $insert_array = array();
                $insert_array['gc_name'] = $_POST['gc_name'];
                $insert_array['type_id'] = intval($_POST['t_id']);
                $insert_array['type_name'] = $_POST['t_name'];
                $insert_array['gc_parent_id'] = intval($_POST['gc_parent_id']);
                $insert_array['commis_rate'] = $_POST['commis_rate']; //服务价格翻倍比例
                $insert_array['gc_sort'] = intval($_POST['gc_sort']);
                $insert_array['gc_virtual'] = intval($_POST['gc_virtual']);
                $insert_array['show_type'] = intval($_POST['show_type']);
                $insert_array['buy_points_rate'] = $_POST['buy_points_rate']; //赠送积分比例

                delete_file_cache('gc_class');
                delete_file_cache('all_categories');
                $goodsclass = new GoodsClass();
                $result = $goodsclass->save($insert_array);

                if ($result) {
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/goods_class/goods_class_add', array('gc_parent_id' => intval($_POST['gc_parent_id']))),
                            'msg' => $this->translation->_('goods_class_add_again'),
                        ),
                        array(
                            'url' => getUrl('shop_manager/goods_class/goods_class'),
                            'msg' => $this->translation->_('goods_class_add_back_to_list'),
                        )
                    );
                    $this->log($this->translation->_('nc_add') . $this->translation->_('goods_class_index_class') . '[' . $_POST['gc_name'] . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
                } else {
                    $this->log($this->translation->_('nc_add') . $this->translation->_('goods_class_index_class') . '[' . $_POST['gc_name'] . ']', 0);
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

        //父类列表，只取到第二级
        $model_class = new GoodsClassLogic();
        $parent_list = $model_class->getTreeClassList(2);
        $gc_list = array();
        if (is_array($parent_list)) {
            foreach ($parent_list as $k => $v) {
                $parent_list[$k]['gc_name'] = str_repeat("&nbsp;", $v['deep'] * 2) . $v['gc_name'];
                if ($v['deep'] == 1) $gc_list[$k] = $v; //得到一级分类
            }
        }
        $this->view->setVar('gc_list', $gc_list);
        //类型列表
        $type_list = Type::find(array('order' => 'type_sort asc'));
        $type_list = $type_list->toArray();
        $t_list = array();
        if (is_array($type_list) && !empty($type_list)) {
            foreach ($type_list as $k => $val) {
                $t_list[$val['class_id']]['type'][$k] = $val;
                $t_list[$val['class_id']]['name'] = $val['class_name'] == '' ? $this->translation->_('nc_default') : $val['class_name'];
            }
        }
        ksort($t_list);

        $this->view->setVar('show_type', $this->show_type);
        $this->view->setVar('type_list', $t_list);
        $this->view->setVar('gc_parent_id', $_GET['gc_parent_id']);
        $this->view->setVar('parent_list', $parent_list);
        $this->view->setVar('top_link', $this->sublink($this->links, 'goods_class_add'));
    }

    /**
     * 编辑
     */
    public function goods_class_editAction()
    {
        $this->view->setVar('show_type', $this->show_type);
        $logic_goods_class = new GoodsClassLogic();

        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["gc_name"], "require" => "true", "message" => $this->translation->_('goods_class_add_name_null')),
                array("input" => $_POST["commis_rate"], "require" => "true", 'validator' => 'range', 'max' => 100, 'min' => 0, "message" => $this->translation->_('goods_class_add_commis_rate_error')),
                array("input" => $_POST["gc_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('goods_class_add_sort_int')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            }

            // 更新分类信息
            $update_array = array();
            $update_array['gc_name'] = $_POST['gc_name'];
            $update_array['type_id'] = intval($_POST['t_id']);
            $update_array['type_name'] = trim($_POST['t_name']);
            $update_array['commis_rate'] = $_POST['commis_rate']; //服务类型翻倍比例
            $update_array['gc_sort'] = intval($_POST['gc_sort']);
            $update_array['gc_virtual'] = intval($_POST['gc_virtual']);
            $update_array['show_type'] = intval($_POST['show_type']);
            $update_array['buy_points_rate'] = $_POST['buy_points_rate']; //赠送积分比例

            delete_file_cache('gc_class');
            delete_file_cache('all_categories');
            $goods_class = GoodsClass::findFirst('gc_id = ' . intval($_POST['gc_id']));
            $result = $goods_class->save($update_array);

            if ($result == false) {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('goods_class_index_class') . '[' . $_POST['gc_name'] . ']', 0);
                $this->showMessage($this->translation->_('goods_class_batch_edit_fail'));
            }

            // 检测是否需要关联自己操作，统一查询子分类
            if ($_POST['t_commis_rate'] == '1' || $_POST['t_associated'] == '1' || $_POST['t_gc_virtual'] == '1' || $_POST['t_show_type'] == '1') {
                $gc_id_list = $logic_goods_class->getChildClass($_POST['gc_id']);
                $gc_ids = array();
                if (is_array($gc_id_list) && !empty($gc_id_list)) {
                    foreach ($gc_id_list as $val) {
                        $gc_ids[] = $val['gc_id'];
                    }
                }

                $update = array();
                // 更新该分类下子分类的所有分佣比例
                if ($_POST['t_commis_rate'] == '1') {
                    $update['commis_rate'] = $update_array['commis_rate'];
                }
                // 更新该分类下子分类的所有类型
                if ($_POST['t_associated'] == '1') {
                    $update['type_id'] = $update_array['type_id'];
                    $update['type_name'] = $update_array['type_name'];
                }
                // 虚拟商品
                if ($_POST['t_gc_virtual'] == '1') {
                    $update['gc_virtual'] = $update_array['gc_virtual'];
                }
                // 商品展示方式
                if ($_POST['t_show_type'] == '1') {
                    $update['show_type'] = $update_array['show_type'];
                }
                delete_file_cache('gc_class');
                delete_file_cache('all_categories');
                $goods_class_list = GoodsClass::find('gc_id in (' . implode(',', $gc_ids) . ')');
                if (count($goods_class_list) > 0) {
                    foreach ($goods_class_list as $goods_class) {
                        if ($goods_class->save($update) == false) {
                            $this->log($this->translation->_('nc_edit') . $this->translation->_('goods_class_index_class') . '[' . $goods_class->getGcName() . ']', 0);
                            $this->showMessage($this->translation->_('goods_class_batch_edit_fail'));
                        }
                    }
                }
            }

            $url = array(
                array(
                    'url' => getUrl('shop_manager/goods_class/goods_class_edit', array('gc_id' => intval($_POST['gc_id']))),
                    'msg' => $this->translation->_('goods_class_batch_edit_again'),
                ),
                array(
                    'url' => getUrl('shop_manager/goods_class/goods_class'),
                    'msg' => $this->translation->_('goods_class_add_back_to_list'),
                )
            );
            $this->log($this->translation->_('nc_edit') . $this->translation->_('goods_class_index_class') . '[' . $_POST['gc_name'] . ']', 1);
            $this->showMessage($this->translation->_('goods_class_batch_edit_ok'), $url, 'html', 'succ', 1, 5000);
        }

        $goods_class = $logic_goods_class->getGoodsClassInfoById(intval($_GET['gc_id']));
        if (empty($goods_class)) {
            $this->showMessage($this->translation->_('goods_class_batch_edit_paramerror'));
        }

        //类型列表
        $type_list = Type::find(array('order' => 'type_sort asc'));
        $type_list = $type_list->toArray();
        $t_list = array();
        if (is_array($type_list) && !empty($type_list)) {
            foreach ($type_list as $k => $val) {
                $t_list[$val['class_id']]['type'][$k] = $val;
                $t_list[$val['class_id']]['name'] = $val['class_name'] == '' ? $this->translation->_('nc_default') : $val['class_name'];
            }
        }
        ksort($t_list);
        // 一级分类列表
        $gc_list = $logic_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);

        $this->view->setVar('type_list', $t_list);
        $this->view->setVar('class_array', $goods_class);
        $this->links[] = array('url' => getUrl('shop_manager/goods_class/goods_class_edit'), 'lang' => 'nc_edit');
        $this->view->setVar('top_link', $this->sublink($this->links, 'goods_class_edit'));
    }

    /**
     * 分类导入
     */
    public function goods_class_importAction()
    {
        //导入
        if (chksubmit()) {
            //得到导入文件后缀名
            $csv_array = explode('.', $_FILES['csv']['name']);
            $file_type = end($csv_array);
            if (!empty($_FILES['csv']) && !empty($_FILES['csv']['name']) && $file_type == 'csv') {
                $fp = @fopen($_FILES['csv']['tmp_name'], 'rb');
                // 父ID
                $parent_id_1 = 0;

                while (!feof($fp)) {
                    $data = trim(fgets($fp, 4096));
                    switch (strtoupper($_POST['charset'])) {
                        case 'UTF-8':
                            if (strtoupper(CHARSET) !== 'UTF-8') {
                                $data = iconv('UTF-8', strtoupper(CHARSET), $data);
                            }
                            break;
                        case 'GBK':
                            if (strtoupper(CHARSET) !== 'GBK') {
                                $data = iconv('GBK', strtoupper(CHARSET), $data);
                            }
                            break;
                    }

                    if (!empty($data)) {
                        $data = str_replace('"', '', $data);
                        //逗号去除
                        $tmp_array = array();
                        $tmp_array = explode(',', $data);
                        if ($tmp_array[0] == 'sort_order') continue;
                        //第一位是序号，后面的是内容，最后一位名称
                        $tmp_deep = 'parent_id_' . (count($tmp_array) - 1);

                        $insert_array = array();
                        $insert_array['gc_sort'] = $tmp_array[0];
                        $insert_array['gc_parent_id'] = $$tmp_deep;
                        $insert_array['gc_name'] = $tmp_array[count($tmp_array) - 1];
                        delete_file_cache('gc_class');
                        delete_file_cache('all_categories');
                        $model_class = new GoodsClass();
                        $model_class->save($insert_array);
                        //赋值这个深度父ID
                        $tmp = 'parent_id_' . count($tmp_array);
                        $$tmp = $model_class->getGcId();
                    }
                }
                $this->log($this->translation->_('goods_class_index_import') . $this->translation->_('goods_class_index_class'), 1);
                $this->showMessage($this->translation->_('nc_common_op_succ'), getUrl('shop_manager/goods_class/goods_class'));
            } else {
                $this->log($this->translation->_('goods_class_index_import') . $this->translation->_('goods_class_index_class'), 0);
                $this->showMessage($this->translation->_('goods_class_import_csv_null'));
            }
        }
        $this->view->setVar('top_link', $this->sublink($this->links, 'goods_class_import'));
    }

    /**
     * 分类导出
     */
    public function goods_class_exportOp()
    {
        $model_class = Model('goods_class');
        $class_list = $model_class->getTreeClassList();

        @header("Content-type: application/unknown");
        @header("Content-Disposition: attachment; filename=goods_class.csv");
        if (is_array($class_list)) {
            foreach ($class_list as $k => $v) {
                $tmp = array();
                //序号
                $tmp['gc_sort'] = $v['gc_sort'];
                //深度
                for ($i = 1; $i <= ($v['deep'] - 1); $i++) {
                    $tmp[] = '';
                }
                //分类名称
                $tmp['gc_name'] = $v['gc_name'];
                $tmp_line = iconv('UTF-8', 'GB2312//IGNORE', join(',', $tmp));
                $tmp_line = str_replace("\r\n", '', $tmp_line);
                echo $tmp_line . "\r\n";
            }
        }
        $this->log(getLang('goods_class_index_export,goods_class_index_class'), 1);
        exit;
    }

    /**
     * 删除分类
     */
    public function goods_class_delAction()
    {
        if ($_GET['id'] != '') {
            //删除分类
            $logic_goods_class = Model('goods_class');
            if ($logic_goods_class->delGoodsClassByGcIdString($_GET['id'])) {
                $this->log($this->translation->_('nc_delete') . $this->translation->_('goods_class_index_class') . '[ID:' . $_GET['id'] . ']', 1);
                exit(json_encode(array('state' => true, 'msg' => '删除成功')));
            } else {
                exit(json_encode(array('state' => false, 'msg' => '删除失败')));
            }
        } else {
            exit(json_encode(array('state' => false, 'msg' => '删除失败')));
        }
    }

    /**
     * tag列表
     */
    public function tagAction()
    {
        $this->view->setVar('top_link', $this->sublink($this->links, 'tag'));
    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $query = GoodsClassTag::query();

        if ($_POST['query'] != '') {
            $query->where($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $model_tag = new GoodsClassTag();
        $metadata = $model_tag->getModelsMetaData();
        $param = $metadata->getAttributes($model_tag);

        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        //医生列表
        $total_num = GoodsClassTag::count(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));
        $tag_list = $query->limit($page, (($now_page - 1) * $page))->execute();
        if (count($tag_list->toArray()) > 0) {
            $tag_list = $tag_list->toArray();
        } else {
            $tag_list = array();
        }

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($tag_list as $value) {
            $param = array();
            $operation = "<a class='btn blue' href='javascript:void(0)' onclick=\"fg_edit(" . $value['gc_tag_id'] . ")\"><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $param['operation'] = $operation;
            $param['gc_tag_id'] = $value['gc_tag_id'];
            $param['gc_tag_name'] = $value['gc_tag_name'];
            $param['gc_tag_value'] = $value['gc_tag_value'];
            $param['gc_id_1'] = $value['gc_id_1'];
            $param['gc_id_2'] = $value['gc_id_2'];
            $param['gc_id_3'] = $value['gc_id_3'];
            $data['list'][$value['gc_tag_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 重置TAG，重新生成所有分类的TAG名称和TAG值
     */
    public function tag_resetAction()
    {
        //实例化模型
        $logic_goodsclass = new GoodsClassLogic();
        $logic_goodsclasstag = new GoodsClassTagLogic();
        $model_class_tag = new GoodsClassTag();

        //清空TAG表
        $return = $this->db->execute("TRUNCATE TABLE `" . $model_class_tag->getSource() . "`");
        if (!$return) {
            $this->showMessage($this->translation->_('goods_class_reset_tag_fail'), getUrl('shop_manager/goods_class/tag'));
        }

        //商品分类
        $goods_class = $logic_goodsclass->getTreeClassList(3);
        //格式化分类。组成三维数组
        if (is_array($goods_class) and !empty($goods_class)) {
            $goods_class_array = array();
            foreach ($goods_class as $val) {
                //一级分类
                if ($val['gc_parent_id'] == 0) {
                    $goods_class_array[$val['gc_id']]['gc_name'] = $val['gc_name'];
                    $goods_class_array[$val['gc_id']]['gc_id'] = $val['gc_id'];
                    $goods_class_array[$val['gc_id']]['type_id'] = $val['type_id'];
                } else {
                    //二级分类
                    if (isset($goods_class_array[$val['gc_parent_id']])) {
                        $goods_class_array[$val['gc_parent_id']]['sub_class'][$val['gc_id']]['gc_name'] = $val['gc_name'];
                        $goods_class_array[$val['gc_parent_id']]['sub_class'][$val['gc_id']]['gc_id'] = $val['gc_id'];
                        $goods_class_array[$val['gc_parent_id']]['sub_class'][$val['gc_id']]['gc_parent_id'] = $val['gc_parent_id'];
                        $goods_class_array[$val['gc_parent_id']]['sub_class'][$val['gc_id']]['type_id'] = $val['type_id'];
                    } else {
                        foreach ($goods_class_array as $v) {
                            //三级分类
                            if (isset($v['sub_class'][$val['gc_parent_id']])) {
                                $goods_class_array[$v['sub_class'][$val['gc_parent_id']]['gc_parent_id']]['sub_class'][$val['gc_parent_id']]['sub_class'][$val['gc_id']]['gc_name'] = $val['gc_name'];
                                $goods_class_array[$v['sub_class'][$val['gc_parent_id']]['gc_parent_id']]['sub_class'][$val['gc_parent_id']]['sub_class'][$val['gc_id']]['gc_id'] = $val['gc_id'];
                                $goods_class_array[$v['sub_class'][$val['gc_parent_id']]['gc_parent_id']]['sub_class'][$val['gc_parent_id']]['sub_class'][$val['gc_id']]['type_id'] = $val['type_id'];
                            }
                        }
                    }
                }
            }

            $return = $logic_goodsclasstag->tagAdd($goods_class_array);

            if ($return) {
                $this->log($this->translation->_('nc_reset') . 'tag', 1);
                $this->showMessage($this->translation->_('nc_common_op_succ'), getUrl('shop_manager/goods_class/tag'));
            } else {
                $this->log($this->translation->_('nc_reset') . 'tag', 0);
                $this->showMessage($this->translation->_('nc_common_op_fail'), getUrl('shop_manager/goods_class/tag'));
            }
        } else {
            $this->log($this->translation->_('nc_reset') . 'tag', 0);
            $this->showMessage($this->translation->_('goods_class_reset_tag_fail_no_class'), getUrl('shop_manager/goods_class/tag'));
        }
    }

    /**
     * 重置TAG名称,只是重新生成所有分类的TAG名称，TAG值保持不变
     */
    public function tag_updateAction()
    {
        $logic_goods_class = new GoodsClassLogic();
        $logic_tag = new GoodsClassTagLogic();

        //需要更新的TAG列表
        $tag_query = GoodsClassTag::query();
        $tag_query->orderBy('gc_tag_id asc');
        $tag_list = $tag_query->execute();
        $tag_list = $tag_list->toArray();

        if (is_array($tag_list) && !empty($tag_list)) {
            foreach ($tag_list as $val) {
                //查询分类信息
                $in_gc_id = array();
                if ($val['gc_id_1'] != '0') {
                    $in_gc_id[] = $val['gc_id_1'];
                }
                if ($val['gc_id_2'] != '0') {
                    $in_gc_id[] = $val['gc_id_2'];
                }
                if ($val['gc_id_3'] != '0') {
                    $in_gc_id[] = $val['gc_id_3'];
                }
                $gc_list = $logic_goods_class->getGoodsClassListByIds($in_gc_id);

                //更新TAG信息
                $update_tag = array();
                if (isset($gc_list['0']['gc_id']) && $gc_list['0']['gc_id'] != '0') {
                    $update_tag['gc_id_1'] = $gc_list['0']['gc_id'];
                    $update_tag['gc_tag_name'] .= $gc_list['0']['gc_name'];
                }
                if (isset($gc_list['1']['gc_id']) && $gc_list['1']['gc_id'] != '0') {
                    $update_tag['gc_id_2'] = $gc_list['1']['gc_id'];
                    $update_tag['gc_tag_name'] .= "&nbsp;&gt;&nbsp;" . $gc_list['1']['gc_name'];
                }
                if (isset($gc_list['2']['gc_id']) && $gc_list['2']['gc_id'] != '0') {
                    $update_tag['gc_id_3'] = $gc_list['2']['gc_id'];
                    $update_tag['gc_tag_name'] .= "&nbsp;&gt;&nbsp;" . $gc_list['2']['gc_name'];
                }
                unset($gc_list);
                $update_tag['gc_tag_id'] = $val['gc_tag_id'];
                $return = $logic_tag->updateTag($update_tag);
                if (!$return) {
                    $this->log($this->translation->_('nc_update') . 'tag', 0);
                    $this->showMessage($this->translation->_('nc_common_op_fail'), getUrl('shop_manager/goods_class/tag'));
                }
            }
            $this->log($this->translation->_('nc_update') . 'tag', 1);
            $this->showMessage($this->translation->_('nc_common_op_succ'), getUrl('shop_manager/goods_class/tag'));
        } else {
            $this->log($this->translation->_('nc_update') . 'tag', 0);
            $this->showMessage($this->translation->_('goods_class_update_tag_fail_no_class'), getUrl('shop_manager/goods_class/tag'));
        }

    }

    public function tag_editAction()
    {
        if ($_POST['form_submit']) {
            $logic_class_tag = new GoodsClassTagLogic();
            $return = $logic_class_tag->updateTag(array('gc_tag_id' => $_POST['id'], 'gc_tag_value' => $_POST['tag_value']));
            if ($return) {
                $this->log('编辑TAG值成功[' . $_POST['attr_name'] . ']', 1);
                $this->showDialog('编辑成功', '', 'succ', 'CUR_DIALOG.close();$("#flexigrid").flexReload()');
            } else {
                $this->log('编辑TAG值失败[' . $_POST['id'] . ']', 0);
                $this->showDialog('编辑失败', '', '', '', 'CUR_DIALOG.close();');
            }
        }
        $id = $_GET['id'];
        $tag = GoodsClassTag::findFirst('gc_tag_id = ' . $id);
        $this->view->setVar('tag_info', $tag->toArray());

        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }

    /**
     * 编辑分类导航
     */
    public function nav_editAction()
    {
        $gc_id = $_REQUEST['gc_id'];
        $logic_goods_class = new GoodsClassLogic();
        $class_info = $logic_goods_class->getGoodsClassInfoById($gc_id);
        $logic_goods_class_nav = new GoodsClassNavLogic();
        $nav_info = $logic_goods_class_nav->getGoodsClassNavInfoByGcId($gc_id);
        if (chksubmit()) {
            $update = array();
            $update['gc_id'] = $gc_id;
            $update['cn_alias'] = $_POST['cn_alias'];
            if (is_array($_POST['class_id'])) {
                $update['cn_classids'] = implode(',', $_POST['class_id']);
            }
            if (is_array($_POST['brand_id'])) {
                $update['cn_brandids'] = implode(',', $_POST['brand_id']);
            }
            $update['cn_adv1_link'] = $_POST['cn_adv1_link'];
            $update['cn_adv2_link'] = $_POST['cn_adv2_link'];
            if (!empty($_FILES['pic']['name'])) {//上传图片
                $upload = new UploadFile();
                @unlink(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_pic']);
                $upload->set('default_dir', ATTACH_GOODS_CLASS);
                $upload->upfile('pic');
                $update['cn_pic'] = $upload->file_name;
            }
            if (!empty($_FILES['adv1']['name'])) {//上传广告图片
                $upload = new UploadFile();
                @unlink(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv1']);
                $upload->set('default_dir', ATTACH_GOODS_CLASS);
                $upload->upfile('adv1');
                $update['cn_adv1'] = $upload->file_name;
            }
            if (!empty($_FILES['adv2']['name'])) {//上传广告图片
                $upload = new UploadFile();
                @unlink(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv2']);
                $upload->set('default_dir', ATTACH_GOODS_CLASS);
                $upload->upfile('adv2');
                $update['cn_adv2'] = $upload->file_name;
            }
            if (empty($nav_info)) {
                $class_nav = new GoodsClassNav();
                $result = $class_nav->save($update);
            } else {
                $class_nav = GoodsClassNav::findFirst('gc_id = ' . $gc_id);
                $result = $class_nav->save($update);
            }
            if ($result) {
                $this->log('编辑分类导航，' . $class_info['gc_name'], 1);
                $this->showMessage('编辑成功');
            } else {
                $this->log('编辑分类导航，' . $class_info['gc_name'], 0);
                $this->showMessage('编辑成功', '', '', 'error');
            }
        }

        $pic_name = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_pic'];
        if (file_exists($pic_name)) {
            $nav_info['cn_pic'] = UPLOAD_SITE_URL . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_pic'];
        }
        $pic_name = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv1'];
        if (file_exists($pic_name)) {
            $nav_info['cn_adv1'] = UPLOAD_SITE_URL . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv1'];
        }
        $pic_name = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv2'];
        if (file_exists($pic_name)) {
            $nav_info['cn_adv2'] = UPLOAD_SITE_URL . '/' . ATTACH_GOODS_CLASS . '/' . $nav_info['cn_adv2'];
        }
        $nav_info['cn_classids'] = explode(',', $nav_info['cn_classids']);
        $nav_info['cn_brandids'] = explode(',', $nav_info['cn_brandids']);
        $this->view->setVar('nav_info', $nav_info);
        $this->view->setVar('class_info', $class_info);
        // 一级分类列表
        $logic_goods_class = new GoodsClassLogic();
        $gc_list = $logic_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);

        // 全部三级分类
        $third_class = $logic_goods_class->getChildClassByFirstId($gc_id);
        $this->view->setVar('third_class', $third_class);

        // 品牌列表
        $brand_list = Brand::find(array('brand_apply = 1', 'order' => 'brand_sort asc, brand_id desc'));
        $brand_list = $brand_list->toArray();
        $b_list = array();
        if (is_array($brand_list) && !empty($brand_list)) {
            foreach ($brand_list as $k => $val) {
                $b_list[$val['class_id']]['brand'][$k] = $val;
                $b_list[$val['class_id']]['name'] = $val['brand_class'] == '' ? $this->translation->_('nc_default') : $val['brand_class'];
            }
        }
        ksort($b_list);
        $this->view->setVar('brand_list', $b_list);
    }

    /**
     * ajax操作
     */
    public function ajaxAction()
    {
        switch ($_GET['branch']) {
            /**
             * 更新分类名称
             */
            case 'gc_name':
                $model_class = Model('goods_class');
                $class_array = $model_class->getGoodsClassInfoById(intval($_GET['id']));
                $class_list = GoodsClass::find('gc_id <> ' . intval($_GET['id']) . ' and gc_parent_id = ' . $class_array['gc_parent_id'] . ' and gc_name = \'' . trim($_GET['value']) . '\'');
                if (count($class_list) == 0) {
                    $update_array = array();
                    $update_array['gc_name'] = trim($_GET['value']);
                    delete_file_cache('gc_class');
                    delete_file_cache('all_categories');
                    $goodsclass = GoodsClass::findFirst('gc_id = ' . intval($_GET['id']));
                    $return = $goodsclass->save($update_array);
                } else {
                    $return = false;
                }
                exit(json_encode(array('result' => $return)));
                break;
            /**
             * 分类 排序 显示 设置
             */
            case 'gc_sort':
                $update_array = array();
                $update_array['gc_sort'] = $_GET['value'];
                delete_file_cache('gc_class');
                delete_file_cache('all_categories');
                $goodsclass = GoodsClass::findFirst('gc_id = ' . intval($_GET['id']));
                $goodsclass->save($update_array);
                $return = 'true';
                exit(json_encode(array('result' => $return)));
                break;
            /**
             * 添加、修改操作中 检测类别名称是否有重复
             */
            case 'check_class_name':
                $class_list = GoodsClass::find('gc_id <> ' . intval($_GET['gc_id']) . ' and gc_parent_id = ' . intval($_GET['gc_parent_id']) . ' and gc_name = \'' . trim($_GET['gc_name']) . '\'');
                if (count($class_list) == 0) {
                    echo 'true';
                    exit;
                } else {
                    echo 'false';
                    exit;
                }
                break;
        }
    }
}