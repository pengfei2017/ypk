<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 23:23
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\ExpressLogic;
use Ypk\Logic\WaybillLogic;
use Ypk\Models\Express;
use Ypk\Models\Waybill;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class WaybillController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-运单模版
 */
class WaybillController extends ControllerBase
{

    private $url_waybill_list;

    public function initialize()
    {
        parent::initialize();
        $this->url_waybill_list = getUrl('shop_manager/waybill/waybill_list');
        $this->translation = getTranslation('setting,layout,message,common');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->waybill_listAction();
        $this->view->render('waybill', 'waybill_list');
    }

    /**
     * 运单模板列表
     */
    public function waybill_listAction()
    {
        //write_file_cache("aaa","5566");
        //$a=read_file_cache("aaa");
//        $a=time();
    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $condition = array();
        $where = '';
        if ($_POST['query'] != '') {
            //$condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%'); //拼接搜索条件
            $where = $_POST['qtype'] . " like '%" . $_POST['query'] . "%'";//拼接搜索条件
        }
        $order = '';
        $param = array('waybill_id', 'waybill_name', 'express_name', 'express_id', 'waybill_image', 'waybill_width', 'waybill_height'
        , 'waybill_usable', 'waybill_top', 'waybill_left'
        );
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder']; //拼接排序条件
        }

        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
        $page = intval($_POST['rp']); //页容量
        $offset = $page * ($currentPageIndex - 1); //计算偏移量
        //分页查询记录集合
        $waybill_list = Waybill::find(array('conditions' => $where, 'order' => $order, 'limit' => array('number' => $page, 'offset' => $offset)));

        //$waybill_list = $model_waybill->getWaybillAdminList($condition, $page, $order);

        $data = array();
        $data['now_page'] = $_POST['curpage']; //$model_waybill->shownowpage(); 当前页码
        $data['total_num'] = Waybill::count(); //$model_waybill->gettotalnum(); 总记录数
        foreach ($waybill_list as $value) {
            $value = $value->toArray();
            $param = array();
            $operation = "<a class='btn red' href=\"javascript:void(0);\" onclick=\"fg_del('" . $value['waybill_id'] . "')\"><i class='fa fa-trash-o'></i>删除</a>";
            $operation .= "<span class='btn'><em><i class='fa fa-cog'></i>" . $this->translation['nc_set'] . " <i class='arrow'></i></em><ul>";
            //$operation .= "<li><a href='index.php?act=waybill&op=waybill_design&waybill_id=" . $value['waybill_id'] . "'>设计运单模板</a></li>";
            //$operation .= "<li><a href='index.php?act=waybill&op=waybill_test&waybill_id=" . $value['waybill_id'] . "' target=\"_blank\">测试运单模板</a></li>";
            //$operation .= "<li><a href='index.php?act=waybill&op=waybill_edit&waybill_id=" . $value['waybill_id'] . "'>编辑运单模板</a></li>";

            $url1 = getUrl('shop_manager/waybill/waybill_design', array('waybill_id' => $value['waybill_id']));
            $url2 = getUrl('shop_manager/waybill/waybill_test', array('waybill_id' => $value['waybill_id']));
            $url3 = getUrl('shop_manager/waybill/waybill_edit', array('waybill_id' => $value['waybill_id']));

            $operation .= "<li><a href='" . $url1 . "'>设计运单模板</a></li>";
            $operation .= "<li><a href='" . $url2 . "' target=\"_blank\">查看运单模板</a></li>";
            $operation .= "<li><a href='" . $url3 . "'>编辑运单模板</a></li>";

            $operation .= "</ul></span>";
            $param['operation'] = $operation;
            $param['waybill_name'] = $value['waybill_name'];
            $param['express_name'] = $value['express_name'];
            $param['waybill_image'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . $value['waybill_image_url'] . ">\")'><i class='fa fa-picture-o'></i></a>";
            $param['waybill_width'] = $value['waybill_width'];
            $param['waybill_height'] = $value['waybill_height'];
            $param['waybill_usable'] = $value['waybill_usable'] == 1 ? '是' : '否';
            $param['waybill_top'] = $value['waybill_top'];
            $param['waybill_left'] = $value['waybill_left'];
            $data['list'][$value['waybill_id']] = $param;
        }
        echo $this->flexigridXML($data);
        exit();
    }

    /**
     * 获取页面布局字符串
     * @param mixed $flexigridXML
     */
    public function flexigridXML($flexigridXML)
    {
        ob_clean(); //清空之前已经附加到响应流中的数据
        $page = $flexigridXML['now_page'];
        $total = $flexigridXML['total_num'];
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: text/xml");
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
        $xml .= "<rows>";
        $xml .= "<page>$page</page>";
        $xml .= "<total>$total</total>";
        if (empty($flexigridXML['list'])) {
            $xml .= "<row id=''>";
            $xml .= "<cell></cell>";
            $xml .= "</row>";
        } else {
            foreach ($flexigridXML['list'] as $k => $v) {
                $xml .= "<row id='" . $k . "'>";
                foreach ($v as $kk => $vv) {
                    $xml .= "<cell><![CDATA[" . $v[$kk] . "]]></cell>";
                }
                $xml .= "</row>";
            }
        }
        $xml .= "</rows>";
        echo $xml;
    }

    /**
     * 添加运单模板
     */
    public function waybill_addAction()
    {
        $model_express = new ExpressLogic();

        $this->view->setVar('express_list', $model_express->getExpressList());
        $this->show_menu('waybill_add');
    }

    /**
     * 保存运单模板
     */
    public function waybill_saveAction()
    {
        $model_waybill = new WaybillLogic();
        $result = $model_waybill->saveWaybill($_POST); //保存运单模版

        if ($result) {
            $this->log('保存运单模板' . '[ID:' . $result . ']', 1);
            $this->showMessage($this->translation['nc_common_save_succ'], $this->url_waybill_list);
        } else {
            $this->log('保存运单模板' . '[ID:' . $result . ']', 0);
            $this->showMessage($this->translation['nc_common_save_fail'], $this->url_waybill_list);
        }
    }

    /**
     * 编辑运单模板
     */
    public function waybill_editAction()
    {
        $model_express = new ExpressLogic();
        $model_waybill = new WaybillLogic();

        $waybill_info = $model_waybill->getWaybillInfoByID($_GET['waybill_id']); //根据id获取运单对象
        if (!$waybill_info) {
            $this->showMessage('运单模板不存在');
        }
        $waybill_info = $waybill_info->toArray();
        $this->view->setVar('waybill_info', $waybill_info);

        $express_list = $model_express->getExpressList(); //获取快递列表
        foreach ($express_list as $key => $value) {
            if ($value['id'] == $waybill_info['express_id']) {
                $express_list[$key]['selected'] = true;
            }
        }
        $this->view->setVar('express_list', $express_list);

        $this->show_menu('waybill_edit');
        $this->view->render('waybill', 'waybill_add');
    }

    /**
     * 设计运单模板
     */
    public function waybill_designAction()
    {
        //$model_waybill = Model('waybill');
        //$result = $model_waybill->getWaybillDesignInfo($_GET['waybill_id']);

        $modelLogic = new WaybillLogic();
        $result = $modelLogic->getWaybillDesignInfo($_GET['waybill_id']);
        if (isset($result['error'])) {
            $this->showMessage($result['error'], '', '', 'error');
        }

        $this->view->setVar('waybill_info', $result['waybill_info']);
        $this->view->setVar('waybill_info_data', $result['waybill_info_data']);
        $this->view->setVar('waybill_item_list', $result['waybill_item_list']);
        $this->show_menu('waybill_design');
    }

    /**
     * 设计运单模板保存
     */
    public function waybill_design_saveAction()
    {
        $model = Waybill::findFirst('waybill_id=' . $_POST['waybill_id']);
        $model->setWaybillData($_POST['waybill_data']);
        $result = $model->save();

        if ($result) {
            $this->log('保存运单模板设计' . '[ID:' . $_POST['waybill_id'] . ']', 1);
            $this->showMessage($this->translation['nc_common_save_succ'], $this->url_waybill_list);
        } else {
            $this->log('保存运单模板设计' . '[ID:' . $_POST['waybill_id'] . ']', 0);
            $this->showMessage($this->translation['nc_common_save_fail'], $this->url_waybill_list);
        }
    }

    /**
     * 删除运单模板
     */
    public function waybill_delAction()
    {
        $waybill_id = intval($_GET['id']); //运单id
        if ($waybill_id <= 0) {
            exit(json_encode(array('state' => false, 'msg' => getLang('param_error'))));
        }

        $model = Waybill::findFirst(array('conditions' => 'waybill_id=' . $waybill_id));
        $result = $model->delete();

        if ($result) {
            $this->log('删除运单模板' . '[ID:' . $waybill_id . ']', 1);
            exit(json_encode(array('state' => true, 'msg' => '删除成功')));
        } else {
            $this->log('删除运单模板' . '[ID:' . $waybill_id . ']', 0);
            exit(json_encode(array('state' => false, 'msg' => '删除失败')));
        }
    }

    /**
     * 打印测试
     */
    public function waybill_testAction()
    {
        //获取运单模版对象
        $waybill_info = Waybill::findFirst(array('conditions' => 'waybill_id=' . $_GET['waybill_id'] . ''));
        if (!$waybill_info) {
            $this->showMessage('运单模板不存在');
        }
        $waybill_info=$waybill_info->toArray();
        $this->view->setVar('waybill_info', $waybill_info);
    }

    /**
     * ajax操作
     */
    public function ajaxAction()
    {
        switch ($_GET['branch']) {
            case 'usable':
                $where = array('waybill_id' => intval($_GET['id']));
                $model = Waybill::findFirst($where);
                $model->setWaybillUsable(intval($_GET['value']));
                $model->save();
                echo 'true';
                exit;
                break;
        }
    }

    /**
     * 页面内导航菜单
     * @param string $menu_key 当前导航的menu_key
     * @internal param array $array 附加菜单
     */
    private function show_menu($menu_key = '')
    {
        $menu_array = array(
            1 => array('menu_key' => 'waybill_list', 'menu_name' => '列表', 'menu_url' => getUrl('shop_manager/waybill/waybill_list'))
        );
        if ($menu_key == 'waybill_edit') {
            $menu_array[] = array('menu_key' => 'waybill_edit', 'menu_name' => '编辑', 'menu_url' => 'javascript:;');
        }
        if ($menu_key == 'waybill_design') {
            $menu_array[] = array('menu_key' => 'waybill_design', 'menu_name' => '设计', 'menu_url' => 'javascript:;');
        }

        $this->view->setVar('menu', $menu_array);
        $this->view->setVar('menu_key', $menu_key);
    }
}