<?php
/**
 * 医生管理界面
 */

namespace Ypk\Modules\ShopManager\Controllers;

use Ypk\Csv;
use Ypk\Logic\AlbumLogic;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\GoodsLogic;
use Ypk\Logic\MemberLogic;
use Ypk\Logic\SellerLogic;
use Ypk\Logic\Store_bind_classLogic;
use Ypk\Logic\StoreClassLogic;
use Ypk\Logic\StoreExtendLogic;
use Ypk\Logic\StoreGradeLogic;
use Ypk\Logic\StoreLogic;
use Ypk\Models\AlbumClass;
use Ypk\Models\Member;
use Ypk\Models\MemberCommon;
use Ypk\Models\Seller;
use Ypk\Models\SnsAlbumclass;
use Ypk\Models\Store;
use Ypk\Models\StoreBindClass;
use Ypk\Models\StoreClass;
use Ypk\Models\StoreExtend;
use Ypk\Models\StoreGrade;
use Ypk\Models\StoreJoinin;
use Ypk\Logic\StoreJoininLogic;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\QueueClient;
use Ypk\Sms;
use Ypk\Tpl;
use Ypk\UploadFile;
use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
use Phalcon\Mvc\Model\Transaction\Manager as TxManager;

class StoreController extends ControllerBase
{
    const EXPORT_SIZE = 1000;

    private $_links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'store', 'action' => 'store'), 'text' => '管理'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'store', 'action' => 'store_joinin'), 'text' => '医生申请'),
        //array('url' => array('module' => 'shop_manager', 'controller' => 'store', 'action' => 'reopen_list'), 'text' => '续签申请'),
        //array('url' => array('module' => 'shop_manager', 'controller' => 'store', 'action' => 'store_bind_class_applay_list'), 'text' => '经营类目申请')
        //array('url' => array('module' => 'shop_manager', 'controller' => 'store', 'action' => 'bill_cycle'), 'text' => '结算周期设置'),
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('layout,store,store_grade,common');
        $this->view->setVar('lang', $this->translation);
        //$this->translation->_()
    }

    public function indexAction()
    {
        $this->storeAction();
        $this->view->render('store', 'store');
    }

    /**
     * 医生
     */
    public function storeAction()
    {
        //医生等级
        $model_grade = new StoreGrade();
        $grade_list = $model_grade->find(array());
        if ($grade_list == false) {
            $this->view->setVar('top_link', $this->sublink($this->_links, 'store'));
        } else {
            $grade_list1 = $grade_list->toArray();
            $this->view->setVar('grade_list', $grade_list1);
            //输出子菜单
            $this->view->setVar('top_link', $this->sublink($this->_links, 'store'));
        }
    }

    /**
     * 医生结算周期
     */
    /* public function bill_cycleAction()
     {

         $this->view->setVar('top_link', $this->sublink($this->_links, 'bill_cycle'));
     }*/

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $model_store = Model('store');
        // 设置页码参数名称
        $condition = array();
        $condition['is_own_shop'] = 0;
        if ($_GET['store_name'] != '') {
            $condition['store_name'] = array('like', '%' . $_GET['store_name'] . '%');
        }
        if ($_GET['member_name'] != '') {
            $condition['member_name'] = array('like', '%' . $_GET['member_name'] . '%');
        }
        if ($_GET['seller_name'] != '') {
            $condition['seller_name'] = array('like', '%' . $_GET['seller_name'] . '%');
        }
        if ($_GET['grade_id'] != '') {
            $condition['grade_id'] = $_GET['grade_id'];
        }
        if ($_GET['store_state'] != '') {
            $condition['store_state'] = $_GET['store_state'];
        }
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('store_id', 'store_name', 'member_name', 'seller_name', 'store_time', 'store_end_time', 'store_state', 'grade_id', 'sc_id');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $store_list = $model_store->getStoreList($condition, $page, $order);

        //店铺等级
        $model_grade = Model('store_grade');
        $grade_list = $model_grade->getGradeList(array());
        $grade_array = array();
        if (!empty($grade_list)) {
            foreach ($grade_list as $v) {
                $grade_array[$v['sg_id']] = $v['sg_name'];
            }
        }

        //店铺分类
        $model_store_class = Model('store_class');
        $class_list = $model_store_class->getStoreClassList(array(), '', false);
        $class_array = array();
        if (!empty($class_list)) {
            foreach ($class_list as $v) {
                $class_array[$v['sc_id']] = $v['sc_name'];
            }
        }

        $data = array();
        $data['now_page'] = $model_store->shownowpage();
        $data['total_num'] = $model_store->gettotalnum();
        foreach ($store_list as $value) {
            $param = array();
            $store_state = $this->getStoreState($value);
            $operation = "<a class='btn green' href='" . getUrl('shop_manager/store/store_db_joinin_detail', array('member_id' => $value['member_id'])) . "'><i class='fa fa-list-alt'></i>查看</a><span class='btn'><em><i class='fa fa-cog'></i>" . getLang('nc_set') . " <i class='arrow'></i></em><ul><li><a href='" . getUrl('shop_manager/store/store_edit', array('store_id' => $value['store_id'])) . "'>编辑店铺信息</a></li><li><a href='" . getUrl('shop_manager/store/store_bind_class', array('store_id' => $value['store_id'])) . "'>修改经营类目</a></li>";
            if (str_cut($store_state, 6) == 'expire' && cookie('remindRenewal' . $value['store_id']) == null) {
                $operation .= "<li><a class='expire' href=" . getUrl('shop_manager/store/remind_renewal', array('store_id' => $value['store_id'])) . ">提醒商家续费</a></li>";
            }
            $operation .= "</ul></span>";
            $param['operation'] = $operation;
            $param['store_id'] = $value['store_id'];
            $store_name = "<a class='" . $store_state . "' href='" . getUrl('shop/show_store/index', array('store_id' => $value['store_id'])) . "' target='blank'>";
            if ($store_state == 'expired') {
                $store_name .= "<i class='fa fa-clock-o' title='该店铺已过期，可从编辑菜单提醒续费'></i>";
            } else if ($store_state == 'expire') {
                $store_name .= "<i class='fa fa-bell-o' title='该店铺即将到期，可从编辑菜单提醒续费'></i>";
            }
            $store_name .= $value['store_name'] . "<i class='fa fa-external-link ' title='新窗口打开'></i></a>";
            $param['store_name'] = $store_name;
            $param['member_id'] = $value['member_name'];
            $param['seller_name'] = $value['seller_name'];
            $param['store_avatar'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getStoreLogo($value['store_avatar']) . ">\")'><i class='fa fa-picture-o'></i></a>";
            $param['store_label'] = "<a href='javascript:void(0);' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getStoreLogo($value['store_label'], 'store_logo') . ">\")'><i class='fa fa-picture-o'></i></a>";
            $param['grade_id'] = $grade_array[$value['grade_id']];
            $param['store_time'] = date('Y-m-d', $value['store_time']);
            $param['store_end_time'] = $value['store_end_time'] ? date('Y-m-d', $value['store_end_time']) : getLang('no_limit');
            $param['store_state'] = $value['store_state'] ? getLang('open') : getLang('close');
            $param['sc_id'] = $class_array[$value['sc_id']];
            $param['area_info'] = $value['area_info'];
            $param['store_address'] = $value['store_address'];
            $param['store_qq'] = $value['store_qq'];
            $param['store_ww'] = $value['store_ww'];
            $param['store_phone'] = $value['store_phone'];
            $data['list'][$value['store_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    function str_cut($string, $length, $dot = '')
    {
        $string = str_replace(array('&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array(' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
        $strlen = strlen($string);
        if ($strlen <= $length) return $string;
        $maxi = $length - strlen($dot);
        $strcut = '';
        if (strtolower(CHARSET) == 'utf-8') {
            $n = $tn = $noc = 0;
            while ($n < $strlen) {
                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                    $tn = 1;
                    $n++;
                    $noc++;
                } elseif (194 <= $t && $t <= 223) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif (224 <= $t && $t < 239) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }
                if ($noc >= $maxi) break;
            }
            if ($noc > $maxi) $n -= $tn;
            $strcut = substr($string, 0, $n);
        } else {
            $dotlen = strlen($dot);
            $maxi = $length - $dotlen;
            for ($i = 0; $i < $maxi; $i++) {
                $strcut .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
            }
        }
        $strcut = str_replace(array('&', '"', "'", '<', '>'), array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;'), $strcut);
        return $strcut . $dot;
    }

    /**
     * 输出XML数据
     */
    public function get_bill_cycle_xmlAction()
    {
        $model_store = Model('store');
        $condition = array();
        if ($_GET['store_name'] != '') {
            $condition['store_name'] = array('like', '%' . $_GET['store_name'] . '%');
        }
        if ($_GET['member_name'] != '') {
            $condition['member_name'] = array('like', '%' . $_GET['member_name'] . '%');
        }
        if ($_GET['seller_name'] != '') {
            $condition['seller_name'] = array('like', '%' . $_GET['seller_name'] . '%');
        }
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('store_id', 'store_name', 'member_name', 'seller_name', 'store_time', 'store_end_time', 'store_state', 'grade_id', 'sc_id');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $store_list = $model_store->getStoreList($condition, $page, $order);

        //店铺分类
        $model_store_class = Model('store_class');
        $class_list = $model_store_class->getStoreClassList(array(), '', false);
        $class_array = array();
        if (!empty($class_list)) {
            foreach ($class_list as $v) {
                $class_array[$v['sc_id']] = $v['sc_name'];
            }
        }

        //店铺结算周期
        $store_id_list = array();
        foreach ($store_list as $store_info) {
            $store_id_list[] = $store_info['store_id'];
        }
        $store_ext_list = Model('store_extend')->getStoreExendList(array('store_id' => array('in', $store_id_list)));
        $store_bill_cycle = array();
        if ($store_ext_list) {
            foreach ($store_ext_list as $v) {
                $store_bill_cycle[$v['store_id']] = $v['bill_cycle'] ? $v['bill_cycle'] : '';
            }
        }

        $data = array();
        $data['now_page'] = $model_store->shownowpage();
        $data['total_num'] = $model_store->gettotalnum();
        foreach ($store_list as $value) {
            $param = array();
            $store_state = $this->getStoreState($value);
            $operation = "<a class='btn blue' href='" . getUrl('shop_manager/store/bill_cycyle_edit', array('store_id' => $value['store_id'])) . "'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $operation .= "</ul></span>";
            $param['operation'] = $operation;
            $param['store_id'] = $value['store_id'];
            $store_name = "<a class='" . $store_state . "' href='" . getUrl('shop/show_store/index', array('store_id' => $value['store_id'])) . "' target='blank'>";

            $store_name .= $value['store_name'] . "<i class='fa fa-external-link ' title='新窗口打开'></i></a>";
            $param['store_name'] = $store_name;
            $param['seller_name'] = $value['seller_name'];
            $param['bill_cycle'] = $store_bill_cycle[$value['store_id']];
            $param['sc_id'] = $class_array[$value['sc_id']];
            $param['store_phone'] = $value['store_phone'];
            $data['list'][$value['store_id']] = $param;
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
        $model_store = Store::query();
        if ($_GET['id'] != '') {
            $id_array = explode(',', $_GET['id']);
            $model_store->inWhere('store_id', $id_array);
        }
        if (isset($_GET['store_name']) && $_GET['store_name'] != '') {
            $model_store->andWhere(' store_name LIKE :store_name:', array('store_name' => '%' . $_GET['store_name'] . '%'));
        }
        if (isset($_GET['member_name']) && $_GET['member_name'] != '') {
            $model_store->andWhere(' member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if (isset($_GET['seller_name']) && $_GET['seller_name'] != '') {
            $model_store->andWhere(' seller_name LIKE :seller_name:', array('seller_name' => '%' . $_GET['seller_name'] . '%'));
        }
        if (isset($_GET['grade_id']) && $_GET['grade_id'] != '') {
            $model_store->andWhere(' grade_id LIKE :grade_id:', array('grade_id' => '%' . $_GET['grade_id'] . '%'));
        }
        if (isset($_GET['store_state']) && $_GET['store_state'] != '') {
            $model_store->andWhere(' store_state LIKE :store_state:', array('store_state' => '%' . $_GET['store_state'] . '%'));
        }
        if (isset($_REQUEST['query']) && $_REQUEST['query'] != '') {
            $model_store->andWhere($_REQUEST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_REQUEST['query'] . '%'));
        }
        //$param = array('store_id', 'store_name', 'member_name', 'seller_name', 'store_time', 'store_end_time', 'store_state', 'grade_id', 'sc_id');
        $store = new Store();
        $metaData = $store->getModelsMetaData();
        $param = $metaData->getAttributes($store);
        if (in_array($_REQUEST['sortname'], $param) && in_array($_REQUEST['sortorder'], array('asc', 'desc'))) {
            $order = $_REQUEST['sortname'] . ' ' . $_REQUEST['sortorder'];
            $model_store->orderBy($order);
        }
        if (!isset($_GET['curpage']) || !is_numeric($_GET['curpage'])) {
            $result = $model_store->execute()->toArray();
            $count = count($result);
            if ($count > self::EXPORT_SIZE) {   //显示下载链接
                $array = array();
                $page = ceil($count / self::EXPORT_SIZE);
                for ($i = 1; $i <= $page; $i++) {
                    $limit1 = ($i - 1) * self::EXPORT_SIZE + 1;
                    $limit2 = $i * self::EXPORT_SIZE > $count ? $count : $i * self::EXPORT_SIZE;
                    $array[$i] = $limit1 . ' ~ ' . $limit2;
                }
                $this->view->setVar('list', $array);
                $this->view->setVar('murl', getUrl('shop_manager/store/index'));
                $this->view->render('common', 'export.excel');
                return;
            } else {
                //不需要分页下载
                $store_list = $model_store->execute();
            }
        } else {
            $offset = ($_GET['curpage'] - 1) * self::EXPORT_SIZE;
            $limit = self::EXPORT_SIZE;
            $store_list = $model_store->limit($limit, $offset)->execute();
        }
        $this->createCsv($store_list->toArray());
        $this->view->disable();
        exit;
    }

    /**
     * 生成csv文件
     */
    private function createCsv($store_list)
    {
        //医生等级
        $model_grade = new StoreGradeLogic();
        $grade_list = $model_grade->getGradeList(array());
        $grade_array = array();
        if (!empty($grade_list)) {
            foreach ($grade_list as $v) {
                $grade_array[$v['sg_id']] = $v['sg_name'];
            }
        }
//        $model_grade = new StoreGrade();
//        $grade_list = $model_grade->find(array());
//        $grade_list = $grade_list->toArray();
//        $grade_array = array();
        if (!empty($grade_list)) {
            foreach ($grade_list as $v) {
                $grade_array[$v['sg_id']] = $v['sg_name'];
            }
        }

        //医生分类
        $model_store_class = new StoreClass();
        $class_list = $model_store_class->find();
        $class_list = $class_list->toArray();
        $class_array = array();
        if (!empty($class_list)) {
            foreach ($class_list as $v) {
                $class_array[$v['sc_id']] = $v['sc_name'];
            }
        }

        $data = array();
        foreach ($store_list as $value) {
            $param = array();
//            if((int)$value['grade_id'] == 0){
//                $value['grade_id'] = 1;
//            }
//            if((int)$value['grade_id'] == 0){
//                $value['sc_id'] = 1;
            //           }
            $param['store_id'] = $value['store_id'];
            $param['store_name'] = $value['store_name'];
            $param['member_name'] = $value['member_name'];
            $param['seller_name'] = $value['seller_name'];
            $param['store_avatar'] = getStoreLogo($value['store_avatar']);
            $param['store_label'] = getStoreLogo($value['store_label'], 'store_logo');
            $param['grade_id'] = $grade_array[$value['grade_id']];
            $param['store_time'] = date('Y-m-d', $value['store_time']);
            $param['store_end_time'] = $value['store_end_time'] ? date('Y-m-d', $value['store_end_time']) : $this->translation['no_limit'];
            $param['store_state'] = $value['store_state'] ? $this->translation['open'] : $this->translation['close'];
            $param['sc_id'] = $class_array[$value['sc_id']];
            $param['area_info'] = $value['area_info'];
            $param['store_address'] = $value['store_address'];
            $param['store_qq'] = $value['store_qq'];
            $param['store_ww'] = $value['store_ww'];
            $param['store_phone'] = $value['store_phone'];
            $data[$value['store_id']] = $param;
        }

        $header = array(
            'store_id' => '医生ID',
            'store_name' => '医生名称',
            'member_name' => '店主账号',
            'seller_name' => '商家账号',
            'store_avatar' => '医生头像',
            'store_label' => '医生LOGO',
            'grade_id' => '医生等级',
            'store_time' => '开店时间',
            'store_end_time' => '到期时间',
            'store_state' => '当前状态',
            'sc_id' => '医生分类',
            'area_info' => '所在地区',
            'store_address' => '详细地址',
            'store_qq' => 'QQ',
            'store_ww' => '旺旺',
            'store_phone' => '商家电话'
        );
        array_unshift($data, $header);
        $csv = new Csv();
        $export_data = $csv->charset($data, CHARSET, 'gbk');
        $csv->filename = $csv->charset('store_list', CHARSET) . (isset($_GET['curpage']) ? $_GET['curpage'] : '') . '-' . date('Y-m-d');
        $csv->export($export_data);
    }

    /**
     * 获得医生状态
     *  open\正常
     *  close\关闭
     *  expire\即将到期
     *  expired\过期
     */
    private function getStoreState($store_info)
    {
        $result = 'open';
        // $store_info = $store_info->toArray();
        if (intval($store_info['store_state']) == 1) {
            $store_end_time = intval($store_info['store_end_time']);
            if ($store_end_time > 0) {
                if ($store_end_time < TIMESTAMP) {
                    $result = 'expired';
                } elseif (($store_end_time - 864000) < TIMESTAMP) {
                    //距离到期10天
                    $result = 'expire';
                }
            }
        } else {
            $result = 'close';
        }
        return $result;
    }

    /**
     * 医生编辑
     */
    public function store_editAction()
    {
        $model_store = new StoreLogic();
        //保存
        if (chksubmit()) {
            //取医生等级的审核
            $model_grade = new StoreGradeLogic();
            $grade_array = $model_grade->getOneGrade(intval($_POST['grade_id']));
            if (empty($grade_array)) {
                $this->showMessage($this->translation->_('please_input_store_level'));
            }
            //结束时间
            $time = '';
            if (trim($_POST['end_time']) != '') {
                $time = strtotime($_POST['end_time']);
            }
            $update_array = array();
            $update_array['store_id'] = intval($_POST['store_id']);
            $update_array['store_name'] = trim($_POST['store_name']);
            $update_array['sc_id'] = intval($_POST['sc_id']);
            $update_array['grade_id'] = intval($_POST['grade_id']);
            $update_array['store_end_time'] = $time;
            $update_array['store_state'] = intval($_POST['store_state']);
            $update_array['area_info'] = isset($_POST['area_info']) ? trim($_POST['area_info']) : "河南 郑州市 平顶山";
            $update_array['store_address'] = isset($_POST['store_address']) ? trim($_POST['store_address']) : "光明路";
            $update_array['store_zip'] = isset($_POST['store_zip']) ? trim($_POST['store_zip']) : "文件";
            $update_array['store_keywords'] = isset($_POST['store_keywords']) ? trim($_POST['store_keywords']) : "医生";
            $update_array['store_description'] = isset($_POST['store_description']) ? trim($_POST['store_description']) : "医院";
            if ($update_array['store_state'] == 0) {
                //根据医生状态修改该医生所有商品状态
                $model_goods = new GoodsLogic();
                $model_goods->editProducesOffline(array('store_id' => $_POST['store_id']));
                $update_array['store_close_info'] = trim($_POST['store_close_info']);
                $update_array['store_recommend'] = 0;
            } else {
                //医生开启后商品不在自动上架，需要手动操作
                $update_array['store_close_info'] = '';
                $update_array['store_recommend'] = intval($_POST['store_recommend']);
            }
            $result = $model_store->editStore($update_array, array('store_id' => intval($_POST['store_id'])));
            if ($result) {
                $url = array(
                    array(
                        'url' => getUrl('shop_manager/store/store'),
                        'msg' => $this->translation->_('back_store_list'),
                    ),
                    array(
                        'url' => getUrl('shop_manager/store/store_edit') . '?store_id=' . intval($_POST['store_id']),
                        'msg' => $this->translation->_('countinue_add_store'),
                    ),
                );
                $this->log($this->translation->_('nc_edit') . '[' . $_POST['store_name'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'), $url);
            } else {
                $this->log($this->translation->_('nc_edit') . '[' . $_POST['store_name'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }

        } else {
            //取医生信息
            $store_array = $model_store->getStoreOne($_GET['store_id']);
            if (empty($store_array)) {
                $this->showMessage($this->translation->_('store_no_exist'));
            }
            //整理医生内容
            $store_array['store_end_time'] = $store_array['store_end_time'] ? date('Y-m-d', $store_array['store_end_time']) : '';
            //医生分类
            $model_store_class = new StoreClassLogic();
            //$store_list = $model_store->getStoreList($condition, $page, $order);
            $parent_list = $model_store_class->getStoreClassList(array('conditions' => '', 'order' => 'sc_sort asc,sc_id asc', 'limit' => array('number' => $page, 'offset' => $offset)));
            //医生等级
            $model_grade = new StoreGradeLogic();
            $grade_list = $model_grade->getGradeList();
            $this->view->setVar('grade_list', $grade_list);
            $this->view->setVar('class_list', $parent_list);
            $this->view->setVar('store_array', $store_array);

            $joinin_detail = new StoreJoininLogic();
            $joinin_detail = $joinin_detail->getOne(array('member_id' => $store_array['member_id']));
            $this->view->setVar('joinin_detail', $joinin_detail);
        }
    }

    /**
     * 医生结算周期编辑
     */
    /*public function bill_cycyle_editAction()
    {
        $lang = Language::getLangContent();

        $model_store = Model('store');
        $model_store_ext = Model('store_extend');
        //保存
        if (chksubmit()) {
            $result = $model_store_ext->editStoreExtend(array('bill_cycle' => intval($_POST['bill_cycle'])), array('store_id' => $_POST['store_id']));
            if ($result) {
                $this->log('设置医生结算周期[' . $_POST['store_name'] . ']', 1);
                showMessage($lang['nc_common_save_succ'], <?php getUrl('shop_manager/store/bill_cycle')?>);
            } else {
                $this->log('设置医生结算周期[' . $_POST['store_name'] . ']', 1);
                showMessage($lang['nc_common_save_fail'], <?php getUrl('shop_manager/store/bill_cycle')?>);
            }
        }

        //取医生信息
        $store_array = $model_store->getStoreInfoByID($_GET['store_id']);
        if (empty($store_array)) {
            showMessage($lang['store_no_exist']);
        }
        $store_ext = $model_store_ext->getStoreExtendInfo(array('store_id' => $_GET['store_id']));
        if ($store_ext['bill_cycle']) {
            $store_array['bill_cycle'] = $store_ext['bill_cycle'];
        }

        $this->view->setVar('store_array', $store_array);
    }*/

    /**
     * 编辑保存注册信息
     */
    public function edit_save_joininAction()
    {
        if (chksubmit()) {
            $member_id = $_POST['member_id'];
            if ($member_id <= 0) {
                $this->showMessage($this->translation->_('param_error'));
            }
            $param = array();
            $param['company_name'] = $_POST['company_name'];
            $param['company_province_id'] = intval($_POST['province_id']);
            $param['company_address'] = $_POST['company_address'];
            $param['company_address_detail'] = $_POST['company_address_detail'];
            $param['company_phone'] = $_POST['company_phone'];
            $param['company_employee_count'] = intval($_POST['company_employee_count']);
            $param['company_registered_capital'] = intval($_POST['company_registered_capital']);
            $param['contacts_name'] = $_POST['contacts_name'];
            $param['contacts_phone'] = $_POST['contacts_phone'];
            $param['contacts_email'] = $_POST['contacts_email'];
            $param['business_licence_number'] = $_POST['business_licence_number'];
            $param['business_licence_address'] = $_POST['business_licence_address'];
            $param['business_licence_start'] = $_POST['business_licence_start'];
            $param['business_licence_end'] = $_POST['business_licence_end'];
            $param['business_sphere'] = $_POST['business_sphere'];
            if ($_FILES['business_licence_number_elc']['name'] != '') {
                $param['business_licence_number_elc'] = $this->upload_image($_FILES['business_licence_number_elc']['name']);
            }
            $param['organization_code'] = $_POST['organization_code'];
            if ($_FILES['organization_code_electronic']['name'] != '') {
                $param['organization_code_electronic'] = $this->upload_image($_FILES['organization_code_electronic']);
            }
            if ($_FILES['general_taxpayer']['name'] != '') {
                $param['general_taxpayer'] = $this->upload_image('general_taxpayer');
            }
            $param['bank_account_name'] = $_POST['bank_account_name'];
            $param['bank_account_number'] = $_POST['bank_account_number'];
            $param['bank_name'] = $_POST['bank_name'];
            $param['bank_code'] = $_POST['bank_code'];
            $param['bank_address'] = $_POST['bank_address'];
            if ($_FILES['bank_licence_electronic']['name'] != '') {
                $param['bank_licence_electronic'] = $this->upload_image('bank_licence_electronic');
            }
            $param['settlement_bank_account_name'] = $_POST['settlement_bank_account_name'];
            $param['settlement_bank_account_number'] = $_POST['settlement_bank_account_number'];
            $param['settlement_bank_name'] = $_POST['settlement_bank_name'];
            $param['settlement_bank_code'] = $_POST['settlement_bank_code'];
            $param['settlement_bank_address'] = $_POST['settlement_bank_address'];
            $param['tax_registration_certificate'] = $_POST['tax_registration_certificate'];
            $param['taxpayer_id'] = $_POST['taxpayer_id'];
            if ($_FILES['tax_registration_certif_elc']['name'] != '') {
                $param['tax_registration_certif_elc'] = $this->upload_image('tax_registration_certif_elc');
            }
            $result = new StoreJoininLogic();
            $result->editStoreJoinin(array('member_id' => $member_id), $param);
            if ($result) {
                $this->showMessage($this->translation->_('nc_common_op_succ'), getUrl('shop_manager/store/store'));
            } else {
                $this->showMessage($this->translation->_('nc_common_op_fail'));
            }
        }
    }

    /**
     * 上传图片
     */
    private function upload_image($file_name)
    {
        $pic_name = '';
        if (!empty($file_name)) {
            if (!empty($_FILES['business_licence_number_elc']['name'])) {//上传图片
                $upload = new UploadFile();
                $filename_tmparr = explode('.', $_FILES['business_licence_number_elc']['name']);
                $ext = end($filename_tmparr);
                $upload->set('default_dir', ATTACH_EDITOR);
                $upload->set('file_name', $file_name . "." . $ext);
                $result = $upload->upfile('pic');
                if ($result) {
                    $pic_name = ATTACH_EDITOR . "/" . $upload->file_name . '?' . mt_rand(100, 999);//加随机数防止浏览器缓存图片
                }
            }
        }
        return $pic_name;
    }

    /**
     * 医生经营类目管理
     */
//    public function store_bind_classAction()
//    {
//        //$store_id = intval($_GET['store_id']);
//        $store_id = 'store_id=' . intval($_GET['store_id']);
//        $model_store = new StoreLogic();
//        $model_store_bind_class = new Store_bind_classLogic();
//        $model_goods_class = new GoodsClassLogic();
//        $gc_list = $model_goods_class->getGoodsClassListByParentId(0);
//        $this->view->setVar('gc_list', $gc_list);
//        $store_info = $model_store->getStoreInfoByID($store_id);
//        if (empty($store_info)) {
//            $this->showMessage($this->translation->_('param_error'), '', '', 'error');
//        }
//        $this->view->setVar('store_info', $store_info);
//        // 获取存储绑定类列表
//        $store_bind_class_list = $model_store_bind_class->getStoreBindClassList(array('conditions' => $store_id));
//        $goods_class = $model_goods_class->getGoodsClassIndexedListAll();
//        for ($i = 0, $j = count($store_bind_class_list); $i < $j; $i++) {
//            $store_bind_class_list[$i]['class_1'] = $goods_class[$store_bind_class_list[$i]['class_1']]['gc_name'];
//            $store_bind_class_list[$i]['class_2'] = $goods_class[$store_bind_class_list[$i]['class_2']]['gc_name'];
//            $store_bind_class_list[$i]['class_3'] = $goods_class[$store_bind_class_list[$i]['class_3']]['gc_name'];
//        }
//        $this->view->setVar('store_bind_class_list', $store_bind_class_list);
////        Tpl::setDirquna('shop');
////
////        Tpl::showpage('store.bind_class');s
//    }
    public function store_bind_classAction()
    {
        $store_id = intval($_GET['store_id']);

        $model_store = Model('store');
        $model_store_bind_class = Model('store_bind_class');
        $model_goods_class = Model('goods_class');

        $gc_list = $model_goods_class->getGoodsClassListByParentId(0);
        $this->view->setVar('gc_list', $gc_list);

        $store_info = $model_store->getStoreInfoByID($store_id);
        if (empty($store_info)) {
            showMessage(getLang('param_error'), '', '', 'error');
        }
        $this->view->setVar('store_info', $store_info);

        $store_bind_class_list = $model_store_bind_class->getStoreBindClassList(array('store_id' => $store_id, 'state' => array('in', array(1, 2))), null);
        $goods_class = Model('goods_class')->getGoodsClassIndexedListAll();
        for ($i = 0, $j = count($store_bind_class_list); $i < $j; $i++) {
            $store_bind_class_list[$i]['class_1_name'] = $goods_class[$store_bind_class_list[$i]['class_1']]['gc_name'];
            $store_bind_class_list[$i]['class_2_name'] = $goods_class[$store_bind_class_list[$i]['class_2']]['gc_name'];
            $store_bind_class_list[$i]['class_3_name'] = $goods_class[$store_bind_class_list[$i]['class_3']]['gc_name'];
        }
        $this->view->setVar('store_bind_class_list', $store_bind_class_list);
//        Tpl::setDirquna('shop');
//
//        Tpl::showpage('store.bind_class');
        $this->view->pick('store/store_bind_class');
    }

    /**
     * 添加经营类目
     */
//    public function store_bind_class_addAction()
//    {
//        $store_id = intval($_POST['store_id']);
//        $commis_rate = intval($_POST['commis_rate']);
//        if ($commis_rate < 0 || $commis_rate > 100) {
//            $this->showMessage($this->translation->_('param_error'), '');
//        }
//        list($class_1, $class_2, $class_3) = explode(',', $_POST['goods_class']);
//        $model_store_bind_class = new Store_bind_classLogic();
//        $param = array();
//        $param['store_id'] = $store_id;
//        $param['class_1'] = $class_1;
//        $param['state'] = 1;
//        if (!empty($class_2)) {
//            $param['class_2'] = $class_2;
//        }
//        if (!empty($class_3)) {
//            $param['class_3'] = $class_3;
//        }
//        // 检查类目是否已经存在
//        // 查询数据库对比存不存在不存在返回空
//        $store_bind_class_info = $model_store_bind_class->getStoreBindClassInfo($param);
//        if (!empty($store_bind_class_info)) {
//            $this->showMessage('该类目已经存在', '', '', 'error');
//        }
//        $param['commis_rate'] = $commis_rate;
//        $result = $model_store_bind_class->addStoreBindClass($param);
//        if ($result) {
//            $this->log('删除医生经营类目，类目编号:' . $result . ',医生编号:' . $store_id);
//            $this->showMessage($this->translation->_('nc_common_save_succ'), '');
//        } else {
//            $this->showMessage($this->translation->_('nc_common_save_fail'), '');
//        }
//    }
    public function store_bind_class_addAction()
    {
        $store_id = intval($_POST['store_id']);
        $commis_rate = intval($_POST['commis_rate']);
        if ($commis_rate < 0 || $commis_rate > 100) {
            showMessage(getLang('param_error'), '');
        }
        list($class_1, $class_2, $class_3) = explode(',', $_POST['goods_class']);

        $model_store_bind_class = Model('store_bind_class');

        $param = array();
        $param['store_id'] = $store_id;
        $param['class_1'] = $class_1;
        $param['state'] = 1;
        if (!empty($class_2)) {
            $param['class_2'] = $class_2;
        }
        if (!empty($class_3)) {
            $param['class_3'] = $class_3;
        }

        // 检查类目是否已经存在
        $store_bind_class_info = $model_store_bind_class->getStoreBindClassInfo($param);
        if (!empty($store_bind_class_info)) {
            showMessage('该类目已经存在', '', '', 'error');
        }

        $param['commis_rate'] = $commis_rate;
        $result = $model_store_bind_class->addStoreBindClass($param);

        if ($result) {
            $this->log('删除医生经营类目，类目编号:' . $result . ',医生编号:' . $store_id);
            showMessage(getLang('nc_common_save_succ'), '');
        } else {
            showMessage(getLang('nc_common_save_fail'), '');
        }
    }

    /**
     * 删除经营类目
     */
//    public function store_bind_class_delAction()
//    {
//        $bid = intval($_POST['bid']);
//
//        $data = array();
//        $data['result'] = true;
//
//        $model_store_bind_class = new Store_bind_classLogic();
//        $model_goods = new GoodsLogic();
//
//        $store_bind_class_info = $model_store_bind_class->getStoreBindClassInfo(array('condetions' => "bid=$bid"));
//        if (empty($store_bind_class_info)) {
//            $data['result'] = false;
//            $data['message'] = '经营类目删除失败';
//            echo json_encode($data);
//            die;
//        }
//
//        // 商品下架
//        $condition = array();
//        $condition['conditions'] = 'store_id' . $store_bind_class_info['store_id'];
//        $gc_id = $store_bind_class_info['class_1'] . ',' . $store_bind_class_info['class_2'] . ',' . $store_bind_class_info['class_3'];
//        $update = array();
//        $update['goods_stateremark'] = '管理员删除经营类目';
//        $condition['gc_id'] = array('in', rtrim($gc_id, ','));
//        $model_goods->editProducesLockUp($update, $condition);
//        $result = $model_store_bind_class->delStoreBindClass(array('conditions' => "bid => $bid"));
//        if (!$result) {
//            $data['result'] = false;
//            $data['message'] = '经营类目删除失败';
//        }
//        $this->log('删除医生经营类目，类目编号:' . $bid . ',医生编号:' . $store_bind_class_info['store_id']);
//        echo json_encode($data);
//        die;
//    }

    public function store_bind_class_delAction()
    {
        $bid = intval($_POST['bid']);

        $data = array();
        $data['result'] = true;

        $model_store_bind_class = Model('store_bind_class');
        $model_goods = Model('goods');

        $store_bind_class_info = $model_store_bind_class->getStoreBindClassInfo(array('bid' => $bid));
        if (empty($store_bind_class_info)) {
            $data['result'] = false;
            $data['message'] = '经营类目删除失败';
            echo json_encode($data);
            die;
        }

        // 商品下架
        $condition = array();
        $condition['store_id'] = $store_bind_class_info['store_id'];
        $gc_id = $store_bind_class_info['class_1'] . ',' . $store_bind_class_info['class_2'] . ',' . $store_bind_class_info['class_3'];
        $update = array();
        $update['goods_stateremark'] = '管理员删除经营类目';
        $condition['gc_id'] = array('in', rtrim($gc_id, ','));
        $model_goods->editProducesLockUp($update, $condition);

        $result = $model_store_bind_class->delStoreBindClass(array('bid' => $bid));

        if (!$result) {
            $data['result'] = false;
            $data['message'] = '经营类目删除失败';
        }
        $this->log('删除医生经营类目，类目编号:' . $bid . ',医生编号:' . $store_bind_class_info['store_id']);
        echo json_encode($data);
        die;
    }

    public function store_bind_class_updateAction()
    {
        $bid = intval($_GET['id']);
        if ($bid <= 0) {
            echo json_encode(array('result' => FALSE, 'message' => getLang('param_error')));
            die;
        }
        $new_commis_rate = intval($_GET['value']);
        if ($new_commis_rate < 0 || $new_commis_rate >= 100) {
            echo json_encode(array('result' => FALSE, 'message' => getLang('param_error')));
            die;
        } else {
            $update = array('commis_rate' => $new_commis_rate);
            $condition = array('bid' => $bid);
            $model_store_bind_class = Model('store_bind_class');
            $result = $model_store_bind_class->editStoreBindClass($update, $condition);
            if ($result) {
                $this->log('更新医生经营类目，类目编号:' . $bid);
                echo json_encode(array('result' => TRUE));
                die;
            } else {
                echo json_encode(array('result' => FALSE, 'message' => getLang('nc_common_op_fail')));
                die;
            }
        }
    }

    public function haoshop_addAction()
    {
        if (chksubmit()) {
            $memberName = $_POST['member_name'];
            $memberPasswd = (string)$_POST['member_passwd'];

            if (strlen($memberName) < 3 || strlen($memberName) > 15
                || strlen($_POST['seller_name']) < 3 || strlen($_POST['seller_name']) > 15
            )
                $this->showMessage('账号名称必须是3~15位', '', 'html', 'error');

            if (strlen($memberPasswd) < 6)
                $this->showMessage('登录密码不能短于6位', '', 'html', 'error');

            if (!$this->checkMemberName($memberName))
                $this->showMessage('店主账号已被占用', '', 'html', 'error');

            if (!$this->checkSellerName($_POST['seller_name']))
                $this->showMessage('店主卖家账号名称已被其它医生占用', '', 'html', 'error');

            try {
                $member = new MemberLogic();
                $memberId = $member->addMember(array(
                    'member_name' => $memberName,
                    'member_passwd' => $memberPasswd,
                    'member_email' => '111@qq.com',));
            } catch (\Exception $ex) {
                $this->showMessage('店主账号新增失败', '', 'html', 'error');
            }
            $storeModel = new StoreLogic();
            $saveArray = array();
            $saveArray['store_name'] = $_POST['store_name'];
            $saveArray['grade_id'] = 1;
            $saveArray['member_id'] = $memberId;
            $saveArray['member_name'] = $memberName;
            $saveArray['seller_name'] = $_POST['seller_name'];
            $saveArray['bind_all_gc'] = 1;
            $saveArray['store_state'] = 1;
            $saveArray['store_time'] = time();
            $saveArray['is_own_shop'] = 0;

            $storeId = $storeModel->addStore($saveArray);
            $seller_model = new SellerLogic();
            $seller_model->addSeller(array(
                'seller_name' => $_POST['seller_name'],
                'member_id' => $memberId,
                'store_id' => $storeId,
                'seller_group_id' => 0,
                'is_admin' => 1,
            ));
            $store_joinin = new StoreJoininLogic();
            $store_joinin->save(array(
                'seller_name' => $_POST['seller_name'],
                'store_name' => $_POST['store_name'],
                'member_name' => $memberName,
                'member_id' => $memberId,
                'joinin_state' => 40,
                'company_province_id' => 0,
                'sc_bail' => 0,
                'joinin_year' => 1,
            ));

            // 添加相册默认
            $album_model = new AlbumLogic();
            $album_arr = array();
            $album_arr['aclass_name'] = '默认相册';
            $album_arr['store_id'] = $storeId;
            $album_arr['aclass_des'] = '';
            $album_arr['aclass_sort'] = '255';
            $album_arr['aclass_cover'] = '';
            $album_arr['upload_time'] = time();
            $album_arr['is_default'] = '1';
            $album_model->addClass($album_arr);

            //插入医生扩展表
//            $extend_model = new StoreExtendLogic();
//            $extend_model->addStoreExtend(array('conditions'=>"store_id => $storeId"));
            // 删除自营店id缓存
            $storeModel->dropCachedOwnShopIds();

            $this->log("新增外驻医生: {$saveArray['store_name']}");
            $this->showMessage('操作成功', getUrl('shop_manager/store/store'));
            return;
        }
//        $model = new Store();
//        $storeArray = $model->find();
//        $storeArray = $storeArray->toArray();
//        $this->view->setVar('store_array', $storeArray['store_id']);
//        //$this->view->render('store', 'haoshop_add');
    }

    public function check_seller_nameAction()
    {
//        echo "true";
//        exit;
        echo json_encode($this->checkSellerName($_GET['seller_name'], $_GET['id']));
        exit;
    }

    private function checkSellerName($sellerName, $storeId = 0)
    {
        // 判断数据库中是否存在商家账号
        $model = new StoreJoininLogic();
//        $count = $model->getStoreJoininCount(array(
//            'conditions'=> "seller_name="."'$sellerName'",
//        ));
        $count = $model->getStoreJoininCount("seller_name=" . "'$sellerName'");
        if ($count > 0)
            return false;

        $seller_model = new SellerLogic();
        $seller = $seller_model->getSellerInfo(array(
            'conditions' => "seller_name=" . "'$sellerName'",
        ));

        if (empty($seller))
            return true;

        if (!$storeId)
            return false;

        if ($storeId == $seller['store_id'] && $seller['seller_group_id'] == 0 && $seller['is_admin'] == 1)
            return true;

        return false;
    }

    public function check_member_nameAction()
    {
        echo json_encode($this->checkMemberName($_GET['member_name']));
        exit;
//        $Boolean = $this->checkMemberName($_GET['member_name']);
//        if ($Boolean == 0) {
//            return true;
//        } else {
//            return false;
//        }
    }

    private function checkMemberName($memberName)
    {
        // 判断store_joinin是否存在记录
        $model = new StoreJoininLogic();
        $count = $model->getStoreJoininCount("member_name=" . "'$memberName'");
        if ($count > 0) {
            return false;
        }
        // $member_count = Member::count("member_name='" . $memberName . "'");
        return true;
        //return $member_count;
    }

    /**
     * 医生 待审核列表
     */
    public function store_joininAction()
    {
        //输出子菜单
        $this->view->setVar('top_link', $this->sublink($this->_links, 'store_joinin'));
        // $this->view->render('store', 'store_joinin');
    }

    /**
     * 输出XML数据
     */
    public function get_joinin_xmlAction()
    {
        $cache_arr_list = array();
        if (readFileList(BASE_PATH . '/storejoin_cache', $file_list) !== false) {
            readFileList(BASE_PATH . '/storejoin_cache', $file_list); //读取所有的缓存文件列表
            if (count($file_list) > 0) {

                //循环遍历缓存文件，获取所有的缓存列表
                foreach ($file_list as $item) {
                    $cache_name = substr($item, strrpos($item, '/') + 1); //获取缓存名称
                    $cache_arr_list[] = read_file_cache($cache_name, false, null, '../storejoin_cache/');
                }
                if (!empty($cache_arr_list) && count($cache_arr_list) > 0) {
                    $data = array();
                    $data['now_page'] = $_POST['curpage']; //$model->shownowpage(); //当前页
                    $data['total_num'] = count($cache_arr_list);
                    foreach ($cache_arr_list as $cache_arr) {
                        $param = array();
                        $param['operation'] = "<a class='btn orange' href=" . getUrl('shop_manager/store/store_joinin_detail') . '?member_mobile=' . $cache_arr['member_mobile'] . "><i class=\"fa fa-check-circle\"></i>审核</a>";
                        $param['member_name'] = $cache_arr['member_name'];
                        $param['joinin_state'] = "待审核";
                        $param['contacts_name'] = ""; //联系人姓名
                        $param['contacts_phone'] = $cache_arr['member_mobile']; //联系人电话
                        $param['add_time'] = date('Y-m-d H:i:s', $cache_arr['add_time']);
                        $param['company_name'] = ""; //单位名称
                        $param['company_province_id'] = ""; //单位地址
                        $data['list'][$cache_arr['member_mobile']] = $param;
                    }
                } else {
                    $data['list'] = null;
                }
            } else {
                $data['list'] = null;
            }
        } else {
            $data['list'] = null;
        }
        echo flexigridXML($data);
        exit();
    }

    /**
     * 输出XML数据
     */
    public function get_joinin_xmlAction2()
    {
        //$model_store_joinin = new StoreJoinin();
        // 设置页码参数名称
//        $condition = array();
//        $condition['joinin_state'] = array('gt', 0);
        $where = '';
        if (isset($_POST['query']) && $_POST['query'] != '') {
            //$condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
            $where = $_POST['qtype'] . " like '%" . $_POST['query'] . "%'";
        }
        $order = '';
//        $param = array('member_id', 'member_name', 'sg_id', 'paying_amount', 'joinin_state', 'joinin_year', 'contacts_name', 'contacts_phone'
//        , 'contacts_email', 'company_name', 'company_province_id', 'company_phone', 'company_employee_count', 'company_registered_capital'
//        );
        $store = new StoreJoinin();
        $metaData = $store->getModelsMetaData();
        $param = $metaData->getAttributes($store);
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }
        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
        $page = intval($_POST['rp']); //表示页容量
        $offset = $page * ($currentPageIndex - 1); //计算偏移量

        //医生列表
        $model_store = new StoreJoininLogic();
        //$store_list = $model_store->getStoreList($condition, $page, $order);
        $store_list = $model_store->getList(array('conditions' => $where, 'order' => $order, 'limit' => array('number' => $page, 'offset' => $offset)));
        // 开店状态
        $joinin_state_array = $this->get_store_joinin_state();

        $data = array();
        $data['now_page'] = $_POST['curpage']; //$model->shownowpage(); //当前页
        $data['total_num'] = Store::count();
        foreach ($store_list as $value) {
            $param = array();
            if (in_array(intval($value['joinin_state']), array(STORE_JOIN_STATE_NEW, STORE_JOIN_STATE_PAY))) {
                $operation = "<a class='btn orange' href=" . getUrl('shop_manager/store/store_joinin_detail') . '?member_id=' . $value['member_id'] . "\"><i class=\"fa fa-check-circle\"></i>审核</a>";
            } else {
                $operation = "<a class='btn green' href=" . getUrl('shop_manager/store/store_joinin_detail') . '?member_id=' . $value['member_id'] . "\"><i class=\"fa fa-list-alt\"></i>查看</a>";
            }
            $param['operation'] = $operation;
            $param['member_id'] = $value['member_id'];
            $param['member_name'] = $value['member_name'];
            //$param['sg_id'] = $value['sg_name'];
            //$param['paying_amount'] = ncPriceFormat($value['paying_amount']);
            $param['joinin_state'] = $joinin_state_array[$value['joinin_state']];
            //$param['joinin_year'] = $value['joinin_year'];
            $param['contacts_name'] = $value['contacts_name'];
            $param['contacts_phone'] = $value['contacts_phone'];
            //$param['contacts_email'] = $value['contacts_email'];
            $param['company_name'] = $value['company_name'];
            $param['company_province_id'] = $value['company_address'] . ' ' . $value['company_address_detail'];
            $param['company_phone'] = $value['company_phone'];
            //$param['company_employee_count'] = $value['company_employee_count'];
            //$param['company_registered_capital'] = $value['company_registered_capital'];
            $data['list'][$value['member_id']] = $param;
        }
        ob_clean();
        echo flexigridXML($data);
        exit();
    }

    /**
     * 经营类目申请列表
     */
    public function store_bind_class_applay_listAction()
    {
        $this->view->setVar('top_link', $this->sublink($this->_links, 'store_bind_class_applay_list'));
    }

    /**
     * 输出XML数据
     */
    public function get_bind_class_applay_xmlAction()
    {
        $model_store_bind_class = Model('store_bind_class');
        // 设置页码参数名称
        $condition = array();

        $condition['state'] = array('in', array('0', '1'));
        if ($_GET['state'] != '') {
            $condition['state'] = $_GET['state'];
        }
        if ($_GET['store_id'] != '') {
            $condition['store_id'] = array('like', '%' . $_GET['store_id'] . '%');
        }

        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('bid', 'store_id', 'commis_rate', 'class_1', 'class_2', 'class_3', 'state');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //店铺列表
        $store_bind_class_list = $model_store_bind_class->getStoreBindClassList($condition, $page, $order);
        $storeid_array = array();
        foreach ($store_bind_class_list as $value) {
            $storeid_array[] = $value['store_id'];
        }
        $store_list = Model('store')->getStoreList(array('store_id' => array('in', $storeid_array)));
        $store_array = array();
        foreach ($store_list as $value) {
            $store_array[$value['store_id']]['store_name'] = $value['store_name'];
            $store_array[$value['store_id']]['seller_name'] = $value['seller_name'];
        }

        //商品分类
        $goods_class = Model('goods_class')->getGoodsClassIndexedListAll();

        // 申请类目状态
        $apply_state = $this->getClassApplyState();

        $data = array();
        $data['now_page'] = $model_store_bind_class->shownowpage();
        $data['total_num'] = $model_store_bind_class->gettotalnum();
        foreach ($store_bind_class_list as $value) {
            $param = array();
            if ($value['state'] == '0') {
                $operation = "<a class='btn orange' href=\"javascript:if(confirm('确认审核吗？'))window.location = '" . getUrl('shop_manager/store/store_bind_class_applay_check', array('bid' => $value['bid'], 'store_id' => $value['store_id'])) . "'\"><i class=\"fa fa-check-circle\"></i>审核</a>";
            } else {
                $operation = "<a class='btn red' href=\"javascript:if(confirm('" . ($value['state'] == '1' ? '该类目已经审核通过，删除它可能影响到商家的使用，' : null) . "确认删除吗？'))window.location = '" . getUrl('shop_manager/store/store_bind_class_applay_del', array('bid' => $value['bid'], 'store_id' => $value['store_id'])) . "'\"><i class=\"fa fa-trash-o\"></i>删除</a>";
            }
            $param['operation'] = $operation;
            $param['store_id'] = $value['store_id'];
            $param['store_name'] = $store_array[$value['store_id']]['store_name'];
            $param['seller_name'] = $store_array[$value['store_id']]['seller_name'];
            $param['commis_rate'] = $value['commis_rate'] . '%';
            $param['state'] = $apply_state[$value['state']];
            $param['class'] = $goods_class[$value['class_1']]['gc_name'] . '(ID:' . $value['class_1'] . ')';
            if ($value['class_2'] > 0) {
                $param['class'] .= '   > ' . $goods_class[$value['class_2']]['gc_name'] . '(ID:' . $value['class_2'] . ')';
            }
            if ($value['class_3'] > 0) {
                $param['class'] .= '   > ' . $goods_class[$value['class_3']]['gc_name'] . '(ID:' . $value['class_3'] . ')';
            }
            $data['list'][$value['bid']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    private function getClassApplyState()
    {
        return array('0' => '审核中', '1' => '已审核', '2' => '自营店');
    }

    /**
     * 审核经营类目申请
     */
    public function store_bind_class_applay_checkAction()
    {
        $model_store_bind_class = Model('store_bind_class');
        $condition = array();
        $condition['bid'] = intval($_GET['bid']);
        $condition['state'] = 0;
        $update = $model_store_bind_class->editStoreBindClass(array('state' => 1), $condition);
        if ($update) {
            $this->log('审核新经营类目申请，医生ID：' . $_GET['store_id'], 1);
            showMessage('审核成功', getReferer());
        } else {
            showMessage('审核失败', getReferer(), 'html', 'error');
        }
    }

    /**
     * 删除经营类目申请
     */
    public function store_bind_class_applay_delAction()
    {
        $model_store_bind_class = Model('store_bind_class');
        $condition = array();
        $condition['bid'] = intval($_GET['bid']);
        $del = $model_store_bind_class->delStoreBindClass($condition);
        if ($del) {
            $this->log('删除经营类目，店铺ID：' . $_GET['store_id'], 1);
            showMessage('删除成功', getReferer());
        } else {
            showMessage('删除失败', getReferer(), 'html', 'error');
        }
    }

    private function get_store_joinin_state()
    {
        $joinin_state_array = array(
            STORE_JOIN_STATE_NEW => '新申请',
            STORE_JOIN_STATE_PAY => '已付款',
            STORE_JOIN_STATE_VERIFY_SUCCESS => '待付款',
            STORE_JOIN_STATE_VERIFY_FAIL => '审核失败',
            STORE_JOIN_STATE_PAY_FAIL => '付款审核失败',
            STORE_JOIN_STATE_FINAL => '医生申请成功',
        );
        return $joinin_state_array;
    }

    /**
     * 医生续签申请列表
     */
//    public function reopen_listAction()
//    {
//        $this->view->setVar('top_link', $this->sublink($this->_links, 'reopen_list'));
//        Tpl::setDirquna('shop');
//        Tpl::showpage('store_reopen.list');
//    }
    /**
     * 输出XML数据
     */
    public function get_reopen_xmlAction()
    {
        $model_store_reopen = Model('store_reopen');
        // 设置页码参数名称
        $condition = array();
        if ($_POST['query'] != '') {
            $condition[$_POST['qtype']] = array('like', '%' . $_POST['query'] . '%');
        }
        $order = '';
        $param = array('re_id', 're_grade_id', 're_grade_price', 're_year', 're_pay_amount', 're_store_id', 're_store_name', 're_state'
        , 're_create_time', 're_start_time', 're_end_time', 're_pay_cert', 're_pay_cert_explain');
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
        }

        $page = $_POST['rp'];

        //医生列表
        $reopen_list = $model_store_reopen->getStoreReopenList($condition, $page, $order);

        // 续签状态
        $reopen_state_array = $this->getReopenState();

        $data = array();
        $data['now_page'] = $model_store_reopen->shownowpage();
        $data['total_num'] = $model_store_reopen->gettotalnum();
        foreach ($reopen_list as $value) {
            $param = array();
            $operation = '';
            if ($value['re_state'] == 1) {
                $operation .= "<a class='btn orange' href=\"javascript:void(0);\" onclick=\"reopen_check('" . $value['re_id'] . "')\"><i class=\"fa fa-check-circle-o\"></i>审核</a>";
            }
            if ($value['re_state'] != 2) {
                $operation .= "<a class='btn green' href=\"javascript:void(0);\" onclick=\"reopen_del('" . $value['re_id'] . "', '" . $value['re_store_id'] . "')\"><i class=\"fa fa-list-alt\"></i>删除</a>";
            }
            if ($value['re_state'] == 2) {
                $operation .= "<span>--</span>";
            }
            $param['operation'] = $operation;
            $param['re_id'] = $value['re_id'];
            $param['re_grade_id'] = $value['re_grade_name'];
            $param['re_grade_price'] = ncPriceFormat($value['re_grade_price']);
            $param['re_year'] = $value['re_year'];
            $param['re_pay_amount'] = ncPriceFormat($value['re_pay_amount']);
            $param['re_store_id'] = $value['re_store_id'];
            $param['re_store_name'] = $value['re_store_name'];
            $param['re_state'] = $reopen_state_array[$value['re_state']];
            $param['re_create_time'] = date('Y-m-d', $value['re_create_time']);
            $param['re_pay_cert'] = "<a href='" . getStoreJoininImageUrl($value['re_pay_cert']) . "' target=\"blank\" class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getStoreJoininImageUrl($value['re_pay_cert']) . ">\")'><i class='fa fa-picture-o'></i></a>";
            $param['re_pay_cert_explain'] = $value['re_pay_cert_explain'];
            $param['re_start_time'] = $value['re_start_time'] != '' ? date('Y-m-d', $value['re_start_time']) : '';
            $param['re_end_time'] = $value['re_end_time'] != '' ? date('Y-m-d', $value['re_end_time']) : '';
            $data['list'][$value['re_id']] = $param;
        }
        echo Tpl::flexigridXML($data);
        exit();
    }

    private function getReopenState()
    {
        return array('0' => '待付款', '1' => '待审核', '2' => '通过审核');
    }

    /**
     * 审核医生续签申请
     */
    public function reopen_checkAction()
    {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $model_store_reopen = Model('store_reopen');
            $condition = array();
            $condition['re_id'] = $id;
            $condition['re_state'] = 1;
            //取当前申请信息
            $reopen_info = $model_store_reopen->getStoreReopenInfo($condition);

            //取目前医生有效截止日期
            $store_info = Model('store')->getStoreInfoByID($reopen_info['re_store_id']);
            $data = array();
            $data['re_start_time'] = strtotime(date('Y-m-d 0:0:0', $store_info['store_end_time'])) + 24 * 3600;
            $data['re_end_time'] = strtotime(date('Y-m-d 23:59:59', $data['re_start_time']) . " +" . intval($reopen_info['re_year']) . " year");
            $data['re_state'] = 2;
            $update = $model_store_reopen->editStoreReopen($data, $condition);
            if ($update) {
                //更新医生有效期
                Model('store')->editStore(array('store_end_time' => $data['re_end_time']), array('store_id' => $reopen_info['re_store_id']));
                $msg = '审核通过医生续签申请，医生ID：' . $reopen_info['re_store_id'] . '，续签时间段：' . date('Y-m-d', $data['re_start_time']) . ' - ' . date('Y-m-d', $data['re_end_time']);
                $this->log($msg, 1);
                exit(json_encode(array('state' => true, 'msg' => '审核成功')));
            } else {
                exit(json_encode(array('state' => false, 'msg' => '审核失败')));
            }
        } else {
            exit(json_encode(array('state' => false, 'msg' => '审核失败')));
        }
    }

    /**
     * 删除医生续签申请
     */
    public function reopen_delAction()
    {
        $id = intval($_GET['id']);
        if ($id > 0) {
            $model_store_reopen = Model('store_reopen');
            $condition = array();
            $condition['re_id'] = $id;
            $condition['re_state'] = array('in', array(0, 1));

            //取当前申请信息
            $reopen_info = $model_store_reopen->getStoreReopenInfo($condition);
            $cert_file = BASE_UPLOAD_PATH . DS . ATTACH_STORE_JOININ . DS . $reopen_info['re_pay_cert'];
            $del = $model_store_reopen->delStoreReopen($condition);
            if ($del) {
                if (is_file($cert_file)) {
                    @unlink($cert_file);
                }
                $this->log('删除医生续签目申请，医生ID：' . $_GET['store_id'], 1);
                exit(json_encode(array('state' => true, 'msg' => '审核成功')));
            } else {
                exit(json_encode(array('state' => false, 'msg' => '审核失败')));
            }
        } else {
            exit(json_encode(array('state' => false, 'msg' => '删除失败')));
        }
    }

    /**
     * 展示审核详细页
     */
    public function store_joinin_detailAction()
    {
        $member_mobile = $_REQUEST['member_mobile']; //缓存名称（即注册的手机号）
        $cache = read_file_cache($member_mobile, false, null, '../storejoin_cache/');
        if (!empty($cache) && count($cache) > 0) {
            $cache['joinin_state'] = STORE_JOIN_STATE_NEW;
        }
        $this->view->setVar('joinin_detail', $cache);
        $this->view->render('store', 'store_joinin_detail');
        $this->view->disable();
    }

    /**
     * 展示审核详细页（审核成功后使用）
     */
    public function store_db_joinin_detailAction()
    {
        $model_store_joinin = new StoreJoininLogic();
        $joinin_detail = $model_store_joinin->getOne(array('member_id' => $_GET['member_id']));
        $joinin_detail_title = '查看';
        if (in_array(intval($joinin_detail['joinin_state']), array(STORE_JOIN_STATE_NEW, STORE_JOIN_STATE_PAY))) {
            $joinin_detail_title = '审核';
        }
        if (!empty($joinin_detail['sg_info'])) {
            $store_grade_info = new StoreGradeLogic();
            $store_grade_info = $store_grade_info->getOneGrade($joinin_detail['sg_id']);
            $joinin_detail['sg_price'] = $store_grade_info['sg_price'];
        } else {
            $joinin_detail['sg_info'] = @unserialize($joinin_detail['sg_info']);
            if (is_array($joinin_detail['sg_info'])) {
                $joinin_detail['sg_price'] = $joinin_detail['sg_info']['sg_price'];
            }
        }
        $this->view->setVar('joinin_detail_title', $joinin_detail_title);
        $this->view->setVar('joinin_detail', $joinin_detail);
        $this->view->render('store', 'store_joinin_detail');
        exit();
    }

    /**
     * 医生审核
     */
    public function store_joinin_verifyAction()
    {
        if ($_POST['verify_type'] === 'pass') { //表示通过审核
            $member_mobile = $_REQUEST['member_mobile'];
            if (!empty($member_mobile)) {
                if (Member::count("member_mobile='" . $member_mobile . "'") > 0) {
                    $this->showMessage('该医生已经通过审核，无需重新审核', getUrl('shop_manager/store/store'));
                }
                $cache = read_file_cache($member_mobile, false, null, '../storejoin_cache/');
                if (!empty($cache) && count($cache) > 0) {
                    try {
                        //创建一个事务管理器
                        $manager = new TxManager();
                        //获取一个新的事务
                        $transaction = $manager->get();

                        //1、添加用户
                        $param = $cache;
                        $member_info = array();
                        $member_info['member_id'] = $param['member_id'];
                        $member_info['member_name'] = $param['member_name'];
                        $member_info['member_passwd'] = md5(trim($param['member_passwd']));
                        $member_info['member_email'] = $param['member_email'];
                        $member_info['member_time'] = TIMESTAMP;
                        $member_info['member_login_time'] = TIMESTAMP;
                        $member_info['member_old_login_time'] = TIMESTAMP;
                        $member_info['member_login_ip'] = getIp();
                        $member_info['member_old_login_ip'] = $member_info['member_login_ip'];

                        $member_info['member_truename'] = $param['member_truename'];
                        $member_info['member_qq'] = $param['member_qq'];
                        $member_info['member_sex'] = $param['member_sex'];
                        $member_info['member_avatar'] = $param['member_avatar'];
                        $member_info['member_qqopenid'] = $param['member_qqopenid'];
                        $member_info['member_qqinfo'] = $param['member_qqinfo'];
                        $member_info['member_sinaopenid'] = $param['member_sinaopenid'];
                        $member_info['member_sinainfo'] = $param['member_sinainfo'];
                        $member_info['member_type_id'] = empty($param['member_type_id']) ? 1 : $param['member_type_id'];
                        $member_info['member_state'] = $param['member_state'];
                        if (intval($param['member_type_id']) != 1) { //表示是医务人员
                            $member_info['member_tree_level'] = 3; //医务人员默认都是金卡会员
                        } else {
                            $member_info['member_tree_level'] = 1; //普通会员默认都是铜卡会员
                        }
                        $member_info['upgrade_time'] = time(); //升级时间默认为注册时间

                        //添加邀请人(推荐人)
                        if (empty($param['inviter_id'])) {
                            $member_info['inviter_id'] = 1; //如果邀请人不能存在，则默认为平台推荐，值为1
                        } else {
                            $member_info['inviter_id'] = $param['inviter_id'];
                        }
                        if ($param['member_mobile_bind']) {
                            $member_info['member_mobile'] = $param['member_mobile'];
                            $member_info['member_mobile_bind'] = $param['member_mobile_bind'];
                        }
                        if ($param['weixin_unionid']) {
                            $member_info['weixin_unionid'] = $param['weixin_unionid'];
                            $member_info['weixin_info'] = $param['weixin_info'];
                        }
                        $member = new Member();
                        $member->setTransaction($transaction);
                        if ($member->save($member_info) == false) {
                            $transaction->rollback("添加会员失败!");
                        }

                        // 2、添加默认相册
                        $insert = array();
                        $insert['ac_name'] = '买家秀';
                        $insert['member_id'] = $member->getMemberId();
                        $insert['ac_des'] = '买家秀默认相册';
                        $insert['ac_sort'] = 1;
                        $insert['is_default'] = 1;
                        $insert['upload_time'] = TIMESTAMP;
                        $sns_albumclass = new SnsAlbumclass();
                        $sns_albumclass->setTransaction($transaction);
                        if ($sns_albumclass->save($insert) == false) {
                            $transaction->rollback("添加默认相册失败!");
                        }

                        // 3、添加store_joinc
                        $store_joinc_arr = array();
                        $store_joinc_arr['member_id'] = $member->getMemberId(); //会员id
                        $store_joinc_arr['member_name'] = $member->getMemberName(); //会员名称
                        $store_joinc_arr['company_phone'] = $member->getMemberMobile();
                        $store_joinc_arr['contacts_phone'] = $member->getMemberMobile();
                        $store_joinc_arr['seller_name'] = $member->getMemberName();
                        $store_joinc_arr['store_name'] = $member->getMemberName();
                        $store_joinc_arr['paying_amount'] = 0;
                        $store_joinc_arr['business_person_body'] = $param['business_person_body']; //个人全身照
                        $store_joinc_arr['business_id_card'] = $param['business_id_card']; //手持身份证半身照
                        $store_joinc_arr['business_qualification_certificate'] = $param['business_qualification_certificate']; //医师资格证书
                        $store_joinc_arr['business_certified_certificate'] = $param['business_certified_certificate']; //医师执业证书
                        $store_joinc_arr['joinin_state'] = STORE_JOIN_STATE_FINAL; //申请成功状态
                        $store_joinc_model = new StoreJoinin();
                        $store_joinc_model->setTransaction($transaction);
                        if ($store_joinc_model->save($store_joinc_arr) == false) {
                            $transaction->rollback("添加注册流程失败!");
                        }

                        // 3、添加store
                        $shop_array = array();
                        $shop_array['member_id'] = $member->getMemberId();
                        $shop_array['member_name'] = $member->getMemberName();
                        $shop_array['seller_name'] = $member->getMemberName();
                        $shop_array['grade_id'] = -1;//$joinin_detail['sg_id']; //医生等级id
                        $shop_array['store_name'] = $member->getMemberName();
                        $shop_array['sc_id'] = 0; //医生分类id
                        $shop_array['province_id'] = 0; //单位所在省id
                        $shop_array['area_info'] = " "; //“省市县”三级地址
                        $shop_array['store_address'] = ""; //详细地址
                        $shop_array['store_zip'] = ''; //邮政编码
                        $shop_array['store_zy'] = ''; //医生主营商品
                        $shop_array['store_state'] = 1; //医生状态（0关闭，1开启，2审核中）
                        $shop_array['store_time'] = time(); //医生开启时间
                        $store_model = new Store();
                        $store_model->setTransaction($transaction);
                        if ($store_model->save($shop_array) == false) { //新增医生
                            $transaction->rollback("新增store失败");
                        }

                        // 4、添加seller
                        $seller_array = array();
                        $seller_array['seller_name'] = $member->getMemberName(); //卖家帐号
                        $seller_array['member_id'] = $member->getMemberId(); //会员id
                        $seller_array['seller_group_id'] = 0; //卖家组编号
                        $seller_array['store_id'] = $store_model->getStoreId(); //医生id
                        $seller_array['is_admin'] = 1; //是否是管理员（0不是，1是）
                        $seller_model = new Seller();
                        $seller_model->setTransaction($transaction);
                        if ($seller_model->save($seller_array) == false) {
                            $transaction->rollback("添加seller帐号失败");
                        }

                        //5、添加默认相册
                        $album_arr = array();
                        $album_arr['aclass_name'] = $this->translation->_('store_save_defaultalbumclass_name'); //相册名称
                        $album_arr['store_id'] = $store_model->getStoreId(); //所属医生id
                        $album_arr['aclass_des'] = " "; //相册描述
                        $album_arr['aclass_sort'] = 255; //相册默认排序
                        $album_arr['aclass_cover'] = " "; //相册封面
                        $album_arr['upload_time'] = time(); //图片上传时间
                        $album_arr['is_default'] = 1; //是否是默认相册（0不是，1是）
                        $albumClass_model = new AlbumClass();
                        $albumClass_model->setTransaction($transaction);
                        if ($albumClass_model->save($album_arr) == false) {
                            $transaction->rollback("添加相册失败");
                        }

                        // 6、新增StoreExtend store的扩展表
                        $storeExtend_model = new StoreExtend();//插入医生扩展表
                        $storeExtend_model->setTransaction($transaction);
                        if ($storeExtend_model->save(array('store_id' => $store_model->getStoreId())) == false) {
                            $transaction->rollback("添加医生扩展失败");
                        }

                        //插入节点树
                        $res = create_member_tree_info($member->getMemberId());
                        if ($res['state'] != true) {
                            $transaction->rollback("添加节点树信息失败");
                        }

                        $transaction->commit(); //提交事务

                        //删除缓存
                        delete_file_cache($member->getMemberMobile(), '../storejoin_cache/');

                        //添加会员扩展表
                        $member_common = MemberCommon::findFirst("member_id=" . $member->getMemberId());
                        if ($member_common === false) {
                            $member_common = new MemberCommon();
                            $member_common->save(array('member_id' => $member->getMemberId()));
                        }

                        //向医生发送短信，提示申请已通过审核
                        $send = new Sms();
                        $msg_str = "欢迎您使用逸陪康在线医疗服务平台(" . getDomainName() . ")，您的申请已经通过审核【逸陪康系统通知】";
                        $send->send($member->getMemberMobile(), $msg_str);
                        $this->showMessage('医生审核成功', getUrl('shop_manager/store/store_joinin'));
                    } catch (TxFailed $e) {
                        $this->showMessage('医生审核失败', getUrl('shop_manager/store/store_joinin'));
                    }
                }
            }
        } else { //表示拒绝审核
            //拒绝审核后直接删除缓存
            delete_file_cache($_REQUEST['member_mobile'], '../storejoin_cache/');
            //向医生发送短信，提示申请审核未通过，需要医生重新申请
            $send = new Sms();
            $msg_str = "您的医生注册申请未通过系统审核，请重新提交资料进行申请【逸陪康系统通知】";
            $send->send($_REQUEST['member_mobile'], $msg_str);
            $this->showMessage('已拒绝审核', getUrl('shop_manager/store/store_joinin'));
        }
    }

    /**
     * 医生审核（过时）
     */
    public function store_joinin_verifyAction2()
    {
        $model_store_joinin = new StoreJoininLogic();
        $joinin_detail = $model_store_joinin->getOne(array('member_id' => $_POST['member_id']));

        //判断医生状态
        switch (intval($joinin_detail['joinin_state'])) {
            case STORE_JOIN_STATE_NEW: //10 新申请提交后变为此状态
                $this->store_joinin_verify_pass($joinin_detail);
                break;
            case STORE_JOIN_STATE_PAY: //11 前台最后一步提交付款凭证之后变为此状态
                $this->store_joinin_verify_open($joinin_detail);
                break;
            default:
                $this->showMessage('参数错误', '');
                break;
        }
    }

    /**
     *初审处理
     * @param array $joinin_detail
     */
    private function store_joinin_verify_pass($joinin_detail)
    {
        $param = array();
        //判断是“通过”还是“拒绝”
        $param['joinin_state'] = $_POST['verify_type'] === 'pass' ? STORE_JOIN_STATE_VERIFY_SUCCESS : STORE_JOIN_STATE_VERIFY_FAIL;
        $param['joinin_message'] = $_POST['joinin_message']; //审核意见
        $param['paying_amount'] = 0;//abs(floatval($_POST['paying_amount'])); //应付总金额
        $param['store_class_commis_rates'] = '';//implode(',', $_POST['commis_rate']); //经营类别的比例

        $model_store_joinin = new StoreJoininLogic();
        $model_store_joinin->modify($param, array('conditions' => 'member_id=' . $_POST['member_id']));
        if ($param['paying_amount'] > 0) {
            $this->showMessage('医生入驻申请审核完成', getUrl('shop_manager/store/store_joinin'));
        } else {
            //如果开店支付费用为零，则审核通过后直接开通，无需再上传付款凭证
            $this->store_joinin_verify_open($joinin_detail);
        }
    }

    /**
     * 复审处理
     * @param array $joinin_detail
     */
    private function store_joinin_verify_open($joinin_detail)
    {
        //此处一共操作6张表：
        //store_joinin：开店流程表（修改）
        //store：医生表（新增）
        //seller：卖家信息表（新增）
        //store_extend：医生信息扩展表（新增）
        //album_class：相册表（新增）
        //store_bind_class：医生可发布商品类目表（新增）

        try {
            //创建一个事务管理器
            $manager = new TxManager();
            //获取一个新的事务
            $transaction = $manager->get();

            $model_store_joinin = new StoreJoininLogic();
            $model_store = new StoreLogic();
            $model_seller = new SellerLogic();

            //验证商家用户名是否已经存在
            //if ($model_seller->isSellerExist(array('conditions' => 'seller_name=' . $joinin_detail['seller_name']))) {
            //    $this->showMessage('商家用户名已存在', '');
            //}
            if (Seller::count("seller_name='" . $joinin_detail['seller_name'] . "'") > 0) {
                $this->showMessage('商家用户名已存在', '');
            }

            $param = array();

            //判断是“通过”还是“拒绝”
            $param['joinin_state'] = $_POST['verify_type'] === 'pass' ? STORE_JOIN_STATE_FINAL : STORE_JOIN_STATE_PAY_FAIL;
            $param['joinin_message'] = $_POST['joinin_message'];
            $model_store_joinin = StoreJoinin::findFirst("member_id=" . $_POST['member_id']);
            $model_store_joinin->setTransaction($transaction);
            if ($model_store_joinin->save($param) == false) {
                $transaction->rollback("修改进度失败");
            }

            if ($_POST['verify_type'] === 'pass') {
                //开店
                $shop_array = array();
                $shop_array['member_id'] = $joinin_detail['member_id'];
                $shop_array['member_name'] = empty($joinin_detail['member_name']) ? "匿名" : $joinin_detail['member_name'];
                $shop_array['seller_name'] = $joinin_detail['seller_name'];
                $shop_array['grade_id'] = -1;//$joinin_detail['sg_id']; //医生等级id
                $shop_array['store_name'] = empty($joinin_detail['store_name']) ? "匿名" : $joinin_detail['store_name'];
                $shop_array['sc_id'] = $joinin_detail['sc_id']; //医生分类id
                $shop_array['store_company_name'] = $joinin_detail['company_name']; //单位名称
                $shop_array['province_id'] = $joinin_detail['company_province_id']; //单位所在省id
                $shop_array['area_info'] = $joinin_detail['company_address']; //“省市县”三级地址
                $shop_array['store_address'] = $joinin_detail['company_address_detail']; //详细地址
                $shop_array['store_zip'] = ''; //邮政编码
                $shop_array['store_zy'] = ''; //医生主营商品
                $shop_array['store_state'] = 1; //医生状态（0关闭，1开启，2审核中）
                $shop_array['store_time'] = time(); //医生开启时间
                $shop_array['store_end_time'] = strtotime(date('Y-m-d 23:59:59', strtotime('+1 day')) . " +" . intval($joinin_detail['joinin_year']) . " year"); //医生关闭时间
                $store_model = new Store();
                $store_model->setTransaction($transaction);
                if ($store_model->save($shop_array) == false) { //新增医生
                    $transaction->rollback("新增医生失败");
                }
                $store_id = $store_model->getStoreId(); //获取添加成功后的医生id
                //$res = $model_store->addStore($shop_array);
                //if ($res) {
                //    $store_id = $res->getStoreId(); //获取添加成功后的医生id
                //}

                if ($store_id) {
                    //写入商家账号
                    $seller_array = array();
                    $seller_array['seller_name'] = empty($joinin_detail['seller_name']) ? "匿名" : $joinin_detail['seller_name']; //卖家帐号
                    $seller_array['member_id'] = $joinin_detail['member_id']; //会员id
                    $seller_array['seller_group_id'] = 0; //卖家组编号
                    $seller_array['store_id'] = $store_id; //医生id
                    $seller_array['is_admin'] = 1; //是否是管理员（0不是，1是）
                    $seller_model = new Seller();
                    $seller_model->setTransaction($transaction);
                    if ($seller_model->save($seller_array) == false) {
                        $transaction->rollback("添加卖家帐号失败");
                    }
                }
                $state = true;
                if ($state) {
                    // 添加默认相册
                    $album_model = new AlbumLogic();
                    $album_arr = array();
                    $album_arr['aclass_name'] = $this->translation->_('store_save_defaultalbumclass_name'); //相册名称
                    $album_arr['store_id'] = $store_id; //所属医生id
                    $album_arr['aclass_des'] = " "; //相册描述
                    $album_arr['aclass_sort'] = 255; //相册默认排序
                    $album_arr['aclass_cover'] = " "; //相册封面
                    $album_arr['upload_time'] = time(); //图片上传时间
                    $album_arr['is_default'] = 1; //是否是默认相册（0不是，1是）
                    $albumClass_model = new AlbumClass();
                    $albumClass_model->setTransaction($transaction);
                    if ($albumClass_model->save($album_arr) == false) {
                        $transaction->rollback("添加相册失败");
                    }
                    //$album_model->addClass($album_arr);

                    $storeExtend_model = new StoreExtend();//插入医生扩展表
                    $storeExtend_model->setTransaction($transaction);
                    if ($storeExtend_model->save(array('store_id' => $store_id)) == false) {
                        $transaction->rollback("添加医生扩展失败");
                    } else {
                        $msg = $this->translation->_('store_save_create_success');
                    }

                    //插入医生绑定分类表
//                    $store_bind_class_array = array();
//                    $store_bind_class = unserialize($joinin_detail['store_class_ids']);
//                    $store_bind_commis_rates = explode(',', $joinin_detail['store_class_commis_rates']);
//                    for ($i = 0, $length = count($store_bind_class); $i < $length; $i++) {
//                        list($class1, $class2, $class3) = explode(',', $store_bind_class[$i]);
//                        $store_bind_class_array[] = array(
//                            'store_id' => $store_id,
//                            'commis_rate' => $store_bind_commis_rates[$i],
//                            'class_1' => $class1,
//                            'class_2' => $class2,
//                            'class_3' => $class3,
//                            'state' => 1
//                        );
//
//                        $store_bind_class_model = new StoreBindClass();
//                        $store_bind_class_model->setTransaction($transaction);
//                        if ($store_bind_class_model->save($store_bind_class_array[$i]) == false) {
//                            $transaction->rollback("添加医生类别绑定失败");
//                        }
//                    }


                    $transaction->commit(); //提交事务

                    $member_id = $joinin_detail['member_id']; //获取申请的医生的member_id
                    $member_info = Member::findFirst("member_id=" . $member_id);
                    if ($member_info !== false) {
                        $member_info->save(array('member_state' => 1)); //更改医生帐号状态为“开启”状态

                        //向申请的医生发送通知短信
                        $send = new Sms();
                        $msg_str = "欢迎您使用逸陪康在线医疗服务平台(" . getDomainName() . ")，您的申请已经通过审核【" . $member_info->getMemberName() . "】";
                        $send->send($member_info->getMemberMobile(), $msg_str);
                    }

                    $this->showMessage('医生审核成功', getUrl('shop_manager/store/store_joinin'));
                } else {
                    $this->showMessage('医生审核失败', getUrl('shop_manager/store/store_joinin'));
                }
            } else {
                $this->showMessage('医生审核拒绝', getUrl('shop_manager/store/store_joinin'));
            }
        } catch (TxFailed $e) {
            $this->showMessage('医生开通失败', getUrl('shop_manager/store/store_joinin'));
        }
    }

    /**
     * 提醒续费
     */
    public function remind_renewalAction()
    {
        $store_id = intval($_GET['store_id']);
        $model = new StoreLogic();
        $store_info = $model->getStoreInfoByID($store_id);
        if (!empty($store_info) && $store_info['store_end_time'] < (TIMESTAMP + 864000) && cookie('remindRenewal' . $store_id) == null) {
            // 发送商家消息
            $param = array();
            $param['code'] = 'store_expire';
            $param['store_id'] = intval($_GET['store_id']);
            $param['param'] = array();
            QueueClient::push('sendStoreMsg', $param);
            setMyCookie('remindRenewal' . $store_id, '1', 86400 * 10);  // 十天
            $this->showMessage('消息发送成功');
        }
        $this->showMessage('消息发送失败');
    }

    /**
     * 验证医生名称是否存在
     */
    public function ckeck_store_nameAction()
    {
        $query = Store::query();
        $query->where('store_name = \'' . trim($_GET['store_name']) . '\'');
        if (!empty($_GET['store_id'])) {
            $query->andWhere('store_id <>' . intval($_GET['store_id']));
        }
        $model_store = $query->execute();
        if (count($model_store->toArray()) > 0) {
            echo 'false';
            exit;
        } else {
            echo 'true';
            exit;
        }
    }
}

