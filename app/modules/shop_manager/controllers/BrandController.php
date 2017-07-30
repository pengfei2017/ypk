<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/1
 * Time: 22:39
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Csv;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Models\Brand;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

/**
 * Class BrandController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商品品牌管理
 */
class BrandController extends ControllerBase
{
    const EXPORT_SIZE = 1000;

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,brand,export');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->brandAction();
        $this->view->pick('brand/brand');
    }

    /**
     * 品牌列表
     */
    public function brandAction()
    {

    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $query = Brand::query();

        if ($_POST['query'] != '') {
            $query->where($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $model_brand = new Brand();
        $metadata = $model_brand->getModelsMetaData();
        $param = $metadata->getAttributes($model_brand);

        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        // 品牌列表
        if ($_GET['type'] == 'apply') {
            $query->andWhere('brand_apply = 0');
        } else {
            $query->andWhere('brand_apply = 1');
        }
        //$query->orderBy('brand_sort asc, brand_id desc');

        //医生列表
        $total_num = Brand::count(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));
        $brand_list = $query->limit($page, (($now_page - 1) * $page))->execute();
        if (count($brand_list->toArray()) > 0) {
            $brand_list = $brand_list->toArray();
        } else {
            $brand_list = array();
        }

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($brand_list as $value) {
            $param = array();
            $operation = "<a class='btn red' href='javascript:void(0);' onclick=\"fg_del(" . $value['brand_id'] . ")\"><i class='fa fa-trash-o'></i>删除</a>";
            if ($_GET['type'] == 'apply') {
                $operation .= "<a class='btn orange' href='javascript:void(0)' onclick=\"fg_apply(" . $value['brand_id'] . ")\"><i class='fa fa-check-square'></i>审核</a>";
            } else {
                $operation .= "<a class='btn blue' href='" . getUrl('shop_manager/brand/brand_edit', array('brand_id' => $value['brand_id'])) . "'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            }
            $param['operation'] = $operation;
            $param['brand_id'] = $value['brand_id'];
            $param['brand_name'] = $value['brand_name'];
            $param['brand_initial'] = $value['brand_initial'];
            $param['brand_pic'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . brandImage($value['brand_pic']) . ">\")'><i class='fa fa-picture-o'></i></a>";
            $param['brand_sort'] = $value['brand_sort'];
            $param['brand_recommend'] = $value['brand_recommend'] == '1' ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $param['show_type'] = $value['show_type'] == '1' ? '文字' : '图片';
            $data['list'][$value['brand_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * csv导出
     */
    public function export_csvAction()
    {
        $query = Brand::query();

        if ($_GET['id'] != '') {
            $id_array = explode(',', $_GET['id']);
            $query->inWhere('brand_id', $id_array);
        }
        if ($_GET['query'] != '') {
            $query->andWhere($_GET['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_GET['query'] . '%'));
        }

        $model_brand = new Brand();
        $metadata = $model_brand->getModelsMetaData();
        $param = $metadata->getAttributes($model_brand);

        if (in_array($_GET['sortname'], $param) && in_array($_GET['sortorder'], array('asc', 'desc'))) {
            $order = $_GET['sortname'] . ' ' . $_GET['sortorder'];
            $query->orderBy($order);
        }

        $query->andWhere('brand_apply = 1');

        //$query->orderBy('brand_sort asc, brand_id desc');
        if (!isset($_GET['curpage']) || !is_numeric($_GET['curpage'])) {
            $count = Brand::count(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            if ($count > self::EXPORT_SIZE) {   //显示下载链接
                $array = array();
                $page = ceil($count / self::EXPORT_SIZE);
                for ($i = 1; $i <= $page; $i++) {
                    $limit1 = ($i - 1) * self::EXPORT_SIZE + 1;
                    $limit2 = $i * self::EXPORT_SIZE > $count ? $count : $i * self::EXPORT_SIZE;
                    $array[$i] = $limit1 . ' ~ ' . $limit2;
                }
                $this->view->setVar('list', $array);
                $this->view->setVar('murl', getUrl('shop_manager/brand/index'));

                $this->view->render('common', 'export_excel');
                return;
            } else {
                //不需要分页下载
                $brand_list = $query->execute();
            }

        } else {
            $offset = ($_GET['curpage'] - 1) * self::EXPORT_SIZE;
            $limit = self::EXPORT_SIZE;
            $brand_list = $query->limit($limit, $offset)->execute();
        }

        $this->createCsv($brand_list->toArray());
        $this->view->disable();
        exit;
    }

    /**
     * 生成csv文件
     */
    private function createCsv($brand_list)
    {
        $data = array();
        foreach ($brand_list as $value) {
            $param = array();
            $param['brand_id'] = $value['brand_id'];
            $param['brand_name'] = $value['brand_name'];
            $param['brand_initial'] = $value['brand_initial'];
            $param['brand_pic'] = brandImage($value['brand_pic']);
            $param['brand_sort'] = $value['brand_sort'];
            $param['brand_recommend'] = $value['brand_recommend'] == '1' ? '是' : '否';
            $param['show_type'] = $value['show_type'] == '1' ? '文字' : '图片';
            $data[$value['brand_id']] = $param;
        }

        $header = array(
            'brand_id' => '品牌ID',
            'brand_name' => '品牌名称',
            'brand_initial' => '首字母',
            'brand_pic' => '品牌图片',
            'brand_sort' => '品牌排序',
            'brand_recommend' => '品牌推荐',
            'show_type' => '展示形式'
        );
        array_unshift($data, $header);
        $csv = new Csv();
        $export_data = $csv->charset($data, CHARSET, 'gbk');
        $csv->filename = $csv->charset('brand_list', CHARSET) . $_GET['curpage'] . '-' . date('Y-m-d');
        $csv->export($export_data);
    }

    /**
     * 增加品牌
     */
    public function brand_addAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["brand_name"], "require" => "true", "message" => $this->translation->_('brand_add_name_null')),
                array("input" => $_POST["brand_initial"], "require" => "true", "message" => '请填写首字母'),
                array("input" => $_POST["brand_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('brand_add_sort_int')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $insert_array = array();
                $insert_array['brand_name'] = trim($_POST['brand_name']);
                $insert_array['brand_initial'] = strtoupper($_POST['brand_initial']);
                $insert_array['brand_tjstore'] = intval(trim($_POST['brand_tjstore']));
                $insert_array['brand_bgpic'] = trim($_POST['brand_bgpic']);
                $insert_array['brand_xbgpic'] = trim($_POST['brand_xbgpic']);
                $insert_array['brand_introduction'] = trim($_POST['brand_introduction']);
                $insert_array['class_id'] = intval($_POST['class_id']);
                $insert_array['brand_class'] = trim($_POST['brand_class']);
                $insert_array['brand_pic'] = trim($_POST['brand_pic']);
                $insert_array['brand_recommend'] = intval(trim($_POST['brand_recommend']));
                $insert_array['brand_sort'] = intval($_POST['brand_sort']);
                $insert_array['show_type'] = intval($_POST['show_type']) == 1 ? 1 : 0;
                $model_brand = new Brand();
                $result = $model_brand->save($insert_array);
                if ($result) {
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/brand/brand_add'),
                            'msg' => $this->translation->_('brand_add_again'),
                        ),
                        array(
                            'url' => getUrl('shop_manager/brand/brand'),
                            'msg' => $this->translation->_('brand_add_back_to_list'),
                        )
                    );
                    $this->log($this->translation->_('nc_add') . $this->translation->_('brand_index_brand') . '[' . $_POST['brand_name'] . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
                } else {
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

        // 一级商品分类
        $logic_goods_class = new GoodsClassLogic();
        $gc_list = $logic_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);
    }

    /**
     * 品牌编辑
     */
    public function brand_editAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["brand_name"], "require" => "true", "message" => $this->translation->_('brand_add_name_null')),
                array("input" => $_POST["brand_initial"], "require" => "true", "message" => '请填写首字母'),
                array("input" => $_POST["brand_sort"], "require" => "true", 'validator' => 'Number', "message" => $this->translation->_('brand_add_sort_int')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $update_array = array();
                $update_array['brand_name'] = trim($_POST['brand_name']);
                $update_array['brand_initial'] = strtoupper($_POST['brand_initial']);
                $update_array['brand_tjstore'] = intval(trim($_POST['brand_tjstore']));
                $update_array['brand_bgpic'] = trim($_POST['brand_bgpic']);
                $update_array['brand_xbgpic'] = trim($_POST['brand_xbgpic']);
                $update_array['brand_introduction'] = trim($_POST['brand_introduction']);
                $update_array['class_id'] = intval($_POST['class_id']);
                $update_array['brand_class'] = trim($_POST['brand_class']);
                $update_array['brand_recommend'] = intval($_POST['brand_recommend']);
                $update_array['brand_sort'] = intval($_POST['brand_sort']);
                $update_array['show_type'] = intval($_POST['show_type']) == 1 ? 1 : 0;
                $model_brand = Brand::findFirst('brand_id = ' . intval($_POST['brand_id']));
                $brand_pic_del = '';
                if (!empty($_POST['brand_pic'])) {
                    $update_array['brand_pic'] = $_POST['brand_pic'];
                    $brand_pic_del = $model_brand->getBrandPic();
                }
                $result = $model_brand->save($update_array);
                if ($result) {
                    if (!empty($_POST['brand_pic'])) {
                        @unlink(BASE_UPLOAD_PATH . DS . ATTACH_BRAND . DS . $brand_pic_del);
                    }
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/brand/brand_edit', array('brand_id' => intval($_POST['brand_id']))),
                            'msg' => $this->translation->_('brand_edit_again'),
                        ),
                        array(
                            'url' => getUrl('shop_manager/brand/brand'),
                            'msg' => $this->translation->_('brand_add_back_to_list'),
                        )
                    );
                    $this->log($this->translation->_('nc_edit') . $this->translation->_('brand_index_brand') . '[' . $_POST['brand_name'] . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
                } else {
                    $this->log($this->translation->_('nc_edit') . $this->translation->_('brand_index_brand') . '[' . $_POST['brand_name'] . ']', 0);
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

        $brand_info = Brand::findFirst('brand_id = ' . intval($_GET['brand_id']));
        if ($brand_info == false) {
            $this->showMessage($this->translation->_('param_error'));
        }
        $this->view->setVar('brand_array', $brand_info->toArray());

        // 一级商品分类
        $logic_goods_class = new GoodsClassLogic();
        $gc_list = $logic_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);
    }

    /**
     * 删除品牌
     */
    public function brand_delAction()
    {
        $brand_id = intval($_GET['id']);
        if ($brand_id <= 0) {
            exit(json_encode(array('state' => false, 'msg' => '参数错误')));
        }
        $brand = Brand::findFirst('brand_id = ' . $brand_id);
        if ($brand != false) {
            if ($brand->delete()) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_BRAND . DS . $brand->getBrandPic());
            }
        }
        $this->log($this->translation->_('nc_delete') . $this->translation->_('brand_index_brand') . '[ID:' . $brand_id . ']', 1);
        exit(json_encode(array('state' => true, 'msg' => '删除成功')));
    }

    /**
     * 品牌申请
     */
    public function brand_applyAction()
    {

    }

    /**
     * 审核 申请品牌操作
     */
    public function brand_apply_setAction()
    {
        $brand_id = intval($_GET['id']);
        if ($brand_id <= 0) {
            exit(json_encode(array('state' => false, 'msg' => '参数错误')));
        }

        /**
         * 更新品牌 申请状态
         */
        $update_array = array();
        $update_array['brand_apply'] = 1;
        $brand = Brand::findFirst('brand_id = ' . $brand_id);
        $result = $brand->save($update_array);
        if ($result) {
            $this->log($this->translation->_('brand_apply_pass') . '[ID:' . $brand_id . ']', null);
            exit(json_encode(array('state' => true, 'msg' => '审核成功')));
        } else {
            $this->log($this->translation->_('brand_apply_pass') . '[ID:' . $brand_id . ']', 0);
            exit(json_encode(array('state' => false, 'msg' => '审核失败')));
        }

    }

    /**
     * ajax操作
     */
    public function ajaxAction()
    {
        $query_brand = Brand::query();

        switch ($_GET['branch']) {
            /**
             * 验证品牌名称是否有重复
             */
            case 'check_brand_name':
                $query_brand->where('brand_name = \'' . trim($_GET['brand_name']) . '\'');
                if (!empty($_GET['id'])) {
                    $query_brand->andWhere('brand_id <> ' . intval($_GET['id']));
                }
                $result = $query_brand->execute();
                if (count($result->toArray()) > 0) {
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