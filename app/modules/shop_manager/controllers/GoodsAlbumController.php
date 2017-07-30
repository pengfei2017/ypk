<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/28
 * Time: 23:09
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\StoreLogic;
use Ypk\Models\AlbumClass;
use Ypk\Models\AlbumPic;
use Ypk\Models\Store;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class GoodsAlbumController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 相册管理
 */
class GoodsAlbumController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,goods_album');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->listAction();
        $this->view->pick('goods_album/list');
    }

    /**
     * 相册列表
     */
    public function listAction()
    {

    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $query_model = AlbumClass::query();

        if ($_POST['query'] != '') {
            $query_model->where($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $albumclass = new AlbumClass();
        $metadata = $albumclass->getModelsMetaData();
        $param = $metadata->getAttributes($albumclass);

        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query_model->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        //医生列表
        $total_num = AlbumClass::count(array(
            "conditions" => $query_model->getConditions(),
            "bind" => getBind($query_model)
        ));
        $album_list = $query_model->limit($page, (($now_page - 1) * $page))->execute();
        if (count($album_list->toArray()) > 0) {
            $album_list = $album_list->toArray();
        } else {
            $album_list = array();
        }

        $storeid_array = array();
        $aclassid_array = array();
        foreach ($album_list as $val) {
            $storeid_array[] = $val['store_id'];
            $aclassid_array[] = $val['aclass_id'];
        }

        // 医生名称
        $store_array = array();
        if (!empty($storeid_array)) {
            $store_list = Store::find('store_id in (' . implode(',', $storeid_array) . ')');
            if (count($store_list) > 0) {
                $store_list = $store_list->toArray();
            } else {
                $store_list = array();
            }
            foreach ($store_list as $val) {
                $store_array[$val['store_id']] = $val['store_name'];
            }
        }

        // 图片数量
        $count_array = array();
        if (!empty($aclassid_array)) {
            $count_list = AlbumPic::find(array(
                "conditions" => "aclass_id in (" . implode(',', $aclassid_array) . ")",
                "columns" => "count(*) as count, aclass_id",
                "group" => "aclass_id"
            ));
            if (count($count_list) > 0) {
                $count_list = $count_list->toArray();
            } else {
                $count_list = array();
            }
            foreach ($count_list as $val) {
                $count_array[$val['aclass_id']] = $val['count'];
            }
        }

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($album_list as $value) {
            $param = array();
            $operation = "<a class='btn red' href='javascript:void(0);' onclick='fg_del(" . $value['aclass_id'] . ")'><i class='fa fa-trash-o'></i>删除</a><a class='btn green' href='" . getUrl('shop_manager/goods_album/pic_list', array('aclass_id' => $value['aclass_id'])) . "'><i class='fa fa-list-alt'></i>查看</a>";
            $param['operation'] = $operation;
            $param['aclass_id'] = $value['aclass_id'];
            $param['aclass_name'] = $value['aclass_name'];
            $param['store_id'] = $value['store_id'];
            $param['store_name'] = "<a href='" . getUrl('shop/show_store/index', array('store_id' => $value['store_id'])) . "' target='blank'>" . $store_array[$value['store_id']] . "<i class='fa fa-external-link ' title='新窗口打开'></i></a>";
            $param['aclass_cover'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . ($value['aclass_cover'] != '' ? cthumb($value['aclass_cover'], 60, $value['store_id']) : MODULE_RESOURCE . '/images/member/default_image.png') . ">\")'><i class='fa fa-picture-o'></i></a>";
            $param['pic_count'] = intval($count_array[$value['aclass_id']]);
            $param['aclass_des'] = $value['aclass_des'];
            $data['list'][$value['aclass_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 图片列表
     */
    public function pic_listAction()
    {
        if (isset($_GET['curpage'])) {
            $curpage = $_GET['curpage'];
        } else {
            $curpage = 1;
        }

        //每页显示多少条记录
        $eachnum = 36;

        $title = '查看全部图片';
        if (is_numeric($_GET['aclass_id'])) {
            $aclass_info = AlbumClass::findFirst('aclass_id = ' . $_GET['aclass_id']);
            if ($aclass_info != false) {
                $aclass_info = $aclass_info->toArray();
            }
            $logic_store = new StoreLogic();
            $store_info = $logic_store->getStoreInfoByID($aclass_info['store_id']);
            $title = '查看“' . $store_info['store_name'] . '--' . $aclass_info['aclass_name'] . '”的图片';
            $count = AlbumPic::count('aclass_id = ' . $_GET['aclass_id']);
            $list = AlbumPic::find(array(
                "conditions" => 'aclass_id = ' . $_GET['aclass_id'],
                "order" => "apic_id DESC",
                "limit" => $eachnum,
                "offset" => ($curpage - 1) * $eachnum
            ));
        } else {
            $count = AlbumPic::count();
            $list = AlbumPic::find(array(
                "order" => "apic_id DESC",
                "limit" => $eachnum,
                "offset" => ($curpage - 1) * $eachnum
            ));
        }


        if (count($list) > 0) {
            $list = $list->toArray();
        } else {
            $list = array();
        }

        $show_page = getPageShow($count, $eachnum);
        $this->view->setVar('page', $show_page);
        $this->view->setVar('list', $list);
        $this->view->setVar('title', $title);
    }

    /**
     * 删除相册
     */
    public function aclass_delAction()
    {
        $aclass_id = intval($_GET['id']);
        if (!is_numeric($aclass_id)) {
            exit(json_encode(array('state' => false, 'msg' => $this->translation->_('param_error'))));
        }
        $pic = AlbumPic::find('aclass_id = ' . $aclass_id);
        if (count($pic) > 0) {
            foreach ($pic as $v) {
                $this->del_file($v->getApicCover());
                $v->delete();
            }
        }
        $albumclass = AlbumClass::findFirst('aclass_id = ' . $aclass_id);
        if ($albumclass != false) {
            $albumclass->delete();
        }
        $this->log($this->translation->_('nc_delete') . $this->translation->_('g_album_one') . '[ID:' . intval($_GET['aclass_id']) . ']', 1);
        exit(json_encode(array('state' => true, 'msg' => $this->translation->_('nc_common_del_succ'))));
    }

    /**
     * 删除一张图片及其对应记录
     *
     */
    public function del_album_picAction()
    {
        list($apic_id, $filename) = @explode('|', $_GET['key']);
        if (!is_numeric($apic_id) || empty($filename)) exit('0');
        $this->del_file($filename);
        $albumpic = AlbumPic::findFirst('apic_id = ' . $apic_id);
        if ($albumpic != false) {
            $albumpic->delete();
        }
        $this->log($this->translation->_('nc_delete') . $this->translation->_('g_album_pic_one') . '[ID:' . $apic_id . ']', 1);
        exit('1');
    }

    /**
     * 删除多张图片
     */
    public function del_more_picAction()
    {
        $list = AlbumPic::find('apic_id in (' . implode(',', $_POST['delbox']) . ')');
        if (count($list) > 0) {
            foreach ($list as $v) {
                $this->del_file($v->getApicCover());
                $v->delete();
            }
        }
        $this->log($this->translation->_('nc_delete') . $this->translation->_('g_album_pic_one') . '[ID:' . implode(',', $_POST['delbox']) . ']', 1);
        redirect();
    }

    /**
     * 删除图片文件
     */
    private function del_file($filename)
    {
        //取医生ID
        if (preg_match('/^(\d+_)/', $filename)) {
            $store_id = substr($filename, 0, strpos($filename, '_'));
        } else {
            $albumpic = AlbumPic::findFirst('apic_cover = ' . $filename);
            $store_id = $albumpic->getStoreId();
        }

        $path = BASE_UPLOAD_PATH . '/' . ATTACH_GOODS . '/' . $store_id . '/' . $filename;

        $ext = strrchr($path, '.');
        $type = explode(',', GOODS_IMAGES_EXT);
        foreach ($type as $v) {
            if (is_file($fpath = str_replace('.', $v . '.', $path))) {
                @unlink($fpath);
            }
        }
        if (is_file($path)) @unlink($path);
    }
}