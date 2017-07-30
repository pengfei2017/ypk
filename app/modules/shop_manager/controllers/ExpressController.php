<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/15
 * Time: 17:08
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Models\Express;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class ExpressController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-快递公司
 */
class ExpressController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('setting,layout,express,common');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {

    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        //qtype 搜索类型（公司名称|公司编号|首字母）
        //query 搜索内容
        //curpage 当前页码
        //rp 页容量
        //sortname 排序的字段名称
        //sortorder 排序方式（asc or desc）

        //$condition = array(); //查询条件
        $where = '';
        if ($_POST['query'] != '') {
            //$condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%'); //拼接搜索条件
            $where = $_POST['qtype'] . " like '%" . $_POST['query'] . "%'"; //拼接搜索条件
        }
        $order = ''; //排序方式
        $param = array('id', 'e_name', 'e_code', 'e_letter', 'e_url', 'e_order', 'e_state', 'e_zt_state');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
        $page = intval($_POST['rp']); //表示页容量
        $offset = $page * ($currentPageIndex - 1); //计算偏移量

        //$list = $model->table('express')->where($condition)->page($page)->order($order)->select();
        //$list = Express::find($condition, array('order' => $order, 'limit' => array('number'=>$page,'offset'=>$offset))); //分页查询

        //分页查询记录集合
        $list = Express::find(array('conditions' => $where, 'order' => $order, 'limit' => array('number' => $page, 'offset' => $offset)));

        $data = array();
        $data['now_page'] = $_POST['curpage']; //$model->shownowpage(); //当前页
        $data['total_num'] = Express::count();// $model->gettotalnum(); //总条数
        foreach ($list as $value) {
            $param = array();
            $operation = "<span class='btn'><em><i class='fa fa-cog'></i>" . $this->translation['nc_set'] . " <i class='arrow'></i></em><ul>";
            $value = $value->toArray();
            $operation .= "<li><a href='javascript:void(0);' onclick='ajaxget(\"" . getUrl('shop_manager/express/ajax', array('id' => $value['id'], 'column' => 'e_state', 'value' => ($value['e_state'] == 1 ? 0 : 1))) . "\")'>" . ($value['e_state'] == 1 ? '禁用快递公司' : '启用快递公司') . "</a></li>";
            $operation .= "<li><a href='javascript:void(0);' onclick='ajaxget(\"" . getUrl('shop_manager/express/ajax', array('id' => $value['id'], 'column' => 'e_order', 'value' => ($value['e_order'] == 1 ? 0 : 1))) . "\")'>" . ($value['e_order'] == 1 ? '取消常用快递' : '设为常用快递') . "</a></li>";
            $operation .= "<li><a href='javascript:void(0);' onclick='ajaxget(\"" . getUrl('shop_manager/express/ajax', array('id' => $value['id'], 'column' => 'e_zt_state', 'value' => ($value['e_zt_state'] == 1 ? 0 : 1))) . "\")'>" . ($value['e_zt_state'] == 1 ? '取消自提配送' : '设为自提配送') . "</a></li>";
            $operation .= "</ul></span>";
            $param['operation'] = $operation;
            $param['e_name'] = $value['e_name'];
            $param['e_code'] = $value['e_code'];
            $param['e_letter'] = $value['e_letter'];
            $param['e_url'] = $value['e_url'];
            $param['e_state'] = $value['e_state'] == 1 ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $param['e_order'] = $value['e_order'] == 1 ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $param['e_zt_state'] = $value['e_zt_state'] == 1 ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $data['list'][$value['id']] = $param;
        }
        echo $this->flexigridXML($data);
        exit();
    }

    public function flexigridXML($flexigridXML)
    {
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
     * ajax操作
     */
    public function ajaxAction()
    {
        switch ($_GET['column']) {
            case 'e_state':
//                $model_brand = Model('express');
//                $update_array = array();
//                $update_array['e_state'] = trim($_GET['value']);
//                $model_brand->where(array('id'=>intval($_GET['id'])))->update($update_array);

                $model = Express::findFirst(array('id' => intval($_GET['id'])));
                $model->setEState(trim($_GET['value']));
                $model->save();

                delete_file_cache('express'); //删除缓存
                $this->log($this->translation->_('nc_edit') . $this->translation->_('express_name') . $this->translation->_('express_state') . '[ID:' . intval($_GET['id']) . ']', 1);
                $this->showDialog($this->translation['nc_common_op_succ'], '', 'succ', '$("#flexigrid").flexReload();');
                break;
            case 'e_order':
                $_GET['value'] = $_GET['value'] == 0 ? 2 : 1;

                //$model_brand = Model('express');
                //$update_array = array();
                //$update_array['e_order'] = trim($_GET['value']);
                //$model_brand->where(array('id' => intval($_GET['id'])))->update($update_array);

                $model = Express::findFirst(array('id' => intval($_GET['id'])));
                $model->setEOrder(trim($_GET['value']));
                $model->save();

                delete_file_cache('express'); //删除缓存
                $this->log($this->translation->_('nc_edit') . $this->translation->_('express_name') . $this->translation->_('express_state') . '[ID:' . intval($_GET['id']) . ']', 1);
                $this->showDialog($this->translation['nc_common_op_succ'], '', 'succ', '$("#flexigrid").flexReload();');
                break;
            case 'e_zt_state':
                //$model_brand = Model('express');
                //$update_array = array();
                //$update_array['e_zt_state'] = trim($_GET['value']);
                //$model_brand->where(array('id' => intval($_GET['id'])))->update($update_array);

                $model = Express::findFirst(array('id' => intval($_GET['id'])));
                $model->setEZtState(trim($_GET['value']));
                $model->save();

                delete_file_cache('express'); //删除缓存
                $this->log($this->translation->_('nc_edit') . $this->translation->_('express_name') . $this->translation->_('express_state') . '[ID:' . intval($_GET['id']) . ']', 1);
                $this->showDialog($this->translation['nc_common_op_succ'], '', 'succ', '$("#flexigrid").flexReload();');
                break;
        }
        delete_file_cache('express'); //删除缓存
    }
}