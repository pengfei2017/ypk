<?php
/**
 * 医生总父类
 * User: Administrator
 * Date: 2016/12/1
 * Time: 13:06
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Logic\SellerLogLogic;
use Ypk\Logic\StoreCostLogic;
use Ypk\Logic\StoreLogic;
use Ypk\Logic\StoreMsgLogic;
use Ypk\Logic\StoreSnsSettingLogic;
use Ypk\Logic\StoreSnsTracelogLogic;
use Ypk\Models\Store;
use Ypk\Models\StoreMsg;
use Ypk\QueueClient;
use Ypk\Tpl;

class BaseSellerController extends ControllerBase
{

    //医生信息
    protected $store_info = array();
    //医生等级
    protected $store_grade = array();

    public function initialize()
    {
        parent::initialize();

        $this->translation = getTranslation('common,store_layout,member_layout');
        $this->view->setVar('lang', $this->translation);

        if (!getConfig('site_status')) {
            $this->showMessage(getConfig('closed_reason'));
        }
        //Tpl::setLayout('seller_layout');
        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout('seller_layout');

        $this->view->setVar('layout', 'seller_layout');
        $this->view->setVar('nav_list', read_file_cache('nav', true));

        //如果不是显示页面和登录操作
        if ($_GET['type'] !== 'login' && $_POST['form_submit'] != "ok") {
            if (empty(getSession('seller_id'))) {
                @header('location: ' . getUrl('shop/seller_login/show_login', array('type' => 'login')));
                die;
            }

            // 验证医生是否存在
            //$model_store = new StoreLogic();
            //$this->store_info = $model_store->getStoreInfoByID(getSession('store_id'));
            //if (empty($this->store_info)) {
            //    @header('location: ' . getUrl('shop/seller_login/show_login', array('type' => 'login')));
            //    die;
            //}
            //如果没查找到医生则直接跳转到登录页面
            if (Store::count("store_id=" . getSession('store_id')) <= 0) {
                @header('location: ' . getUrl('shop/seller_login/show_login', array('type' => 'login')));
                die;
            }
            $res = Store::findFirst("store_id=" . getSession('store_id'));
            $this->store_info = $res->toArray();
            // 医生关闭标志
            if (intval($this->store_info['store_state']) === 0) {
                $this->view->setVar('store_closed', true);
                $this->view->setVar('store_close_info', $this->store_info['store_close_info']);
            }

            // 医生等级
            if (checkPlatformStore()) {
                $this->store_grade = array(
                    'sg_id' => '0',
                    'sg_name' => '自营医生专属等级',
                    'sg_goods_limit' => '0',
                    'sg_album_limit' => '0',
                    'sg_space_limit' => '999999999',
                    'sg_template_number' => '6',
                    // see also store_settingControl.themeOp()
                    // 'sg_template' => 'default|style1|style2|style3|style4|style5',
                    'sg_price' => '0.00',
                    'sg_description' => '',
                    'sg_function' => 'editor_multimedia',
                    'sg_sort' => '0',
                );
            } else {
                $store_grade = read_file_cache('store_grade', true);
                $this->store_grade = $store_grade[$this->store_info['grade_id']];
            }

            if (getSession('seller_is_admin') !== 1 && $_GET['act'] !== 'seller_center' && $_GET['act'] !== 'seller_logout') {
                if (!in_array($_GET['act'], getSession('seller_limits'))) {
                    $this->showMessage('没有权限', '', '', 'error');
                }
            }

            // 卖家菜单
            $this->view->setVar('menu', getSession('seller_menu'));
            // 当前菜单
            $current_menu = $this->_getCurrentMenu(getSession('seller_function_list'));
            $this->view->setVar('current_menu', $current_menu);
            // 左侧菜单
            $left_menu = array();
            if ($this->dispatcher->getActionName() == 'seller_center') {
                if (!empty(getSession('seller_quicklink'))) {
                    foreach (getSession('seller_quicklink') as $value) {
                        $left_menu[] = getSession('seller_function_list')[$value];
                    }
                }
            } else {
                $left_menu = getSession('seller_menu')[$current_menu['model']]['child'];
            }
            $this->view->setVar('left_menu', $left_menu);
            $this->view->setVar('seller_quicklink', getSession('seller_quicklink'));

            $this->checkStoreMsg();
        }
    }

    /**
     * 记录卖家日志
     *
     * @param string $content 日志内容
     * @param int $state 1成功 0失败
     */
    protected function recordSellerLog($content = '', $state = 1)
    {
        $seller_info = array();
        $seller_info['log_content'] = $content;
        $seller_info['log_time'] = TIMESTAMP;
        $seller_info['log_seller_id'] = getSession('seller_id');
        $seller_info['log_seller_name'] = getSession('seller_name');
        $seller_info['log_store_id'] = getSession('store_id');
        $seller_info['log_seller_ip'] = getIp();
        $seller_info['log_url'] = $_GET['act'] . '&' . $_GET['op'];
        $seller_info['log_state'] = $state;
        $model_seller_log = new SellerLogLogic();
        $model_seller_log->addSellerLog($seller_info);
    }

    /**
     * 记录医生费用
     *
     * @param $cost_price 费用金额
     * @param $cost_remark 费用备注
     * @return bool
     */
    protected function recordStoreCost($cost_price, $cost_remark)
    {
        // 平台医生不记录医生费用
        if (checkPlatformStore()) {
            return false;
        }
        $model_store_cost = new StoreCostLogic();
        $param = array();
        $param['cost_store_id'] = getSession('store_id');
        $param['cost_seller_id'] = getSession('seller_id');
        $param['cost_price'] = $cost_price;
        $param['cost_remark'] = $cost_remark;
        $param['cost_state'] = 0;
        $param['cost_time'] = TIMESTAMP;
        $model_store_cost->addStoreCost($param);

        // 发送医生消息
        $param = array();
        $param['code'] = 'store_cost';
        $param['store_id'] = getSession('store_id');
        $param['param'] = array(
            'price' => $cost_price,
            'seller_name' => getSession('seller_name'),
            'remark' => $cost_remark
        );

        QueueClient::push('sendStoreMsg', $param);
    }

    /**
     * 获取卖家帐号的拥有权限的菜单集合
     * @param string $is_admin 是否是管理员的标识
     * @param array $limits 卖家帐号权限集合
     * @return array
     */
    protected function getSellerMenuList($is_admin, $limits)
    {
        $seller_menu = array();
        if (intval($is_admin) !== 1) {
            $menu_list = $this->_getMenuList(); //获取所有的卖家中心顶部功能菜单集合
            foreach ($menu_list as $key => $value) {
                foreach ($value['child'] as $child_key => $child_value) {
                    if (!in_array($child_value['act'], $limits)) {
                        unset($menu_list[$key]['child'][$child_key]);
                    }
                }

                if (count($menu_list[$key]['child']) > 0) {
                    $seller_menu[$key] = $menu_list[$key];
                }
            }
        } else {
            $seller_menu = $this->_getMenuList();
        }
        $seller_function_list = $this->_getSellerFunctionList($seller_menu); //获取当前卖家帐号可以操作的功能集合
        return array('seller_menu' => $seller_menu, 'seller_function_list' => $seller_function_list);
    }

    private function _getCurrentMenu($seller_function_list)
    {
        $current_menu = $seller_function_list[$_GET['act']];
        if (empty($current_menu)) {
            $current_menu = array(
                'model' => 'index',
                'model_name' => '首页'
            );
        }
        return $current_menu;
    }

    /**
     * 获取所有的卖家中心顶部功能菜单集合
     * @return array
     */
    private function _getMenuList()
    {
        $nav_name = intval(getSession('member_id')) == 1 ? "商品" : "服务";
        $s = intval(getSession('member_id')) == 1 ? "" : "发布时间卡";

        $menu_list = array(
            'goods' => array('name' => "{$nav_name}", 'child' => array(
                array('name' => "发布{$nav_name}", 'act' => 'store_goods_add', 'op' => 'index'),
//                array('name' => '淘宝CSV导入', 'act' => 'taobao_import', 'op' => 'index'),
                array('name' => "出售中的{$nav_name}", 'act' => 'store_goods_online', 'op' => 'index'),
//                array('name' => '仓库中的商品', 'act' => 'store_goods_offline', 'op' => 'index'),
//                array('name' => '预约/到货通知', 'act' => 'store_appoint', 'op' => 'index'),
//                array('name' => '关联版式', 'act' => 'store_plate', 'op' => 'index'),
//                array('name' => '商品规格', 'act' => 'store_spec', 'op' => 'index'),
//                array('name' => '图片空间', 'act' => 'store_album', 'op' => 'album_cate'),
            )),
            'order' => array('name' => '订单物流', 'child' => array(
                array('name' => '交易订单', 'act' => 'store_order', 'op' => 'index'),
                //array('name' => '虚拟兑码订单', 'act' => 'store_vr_order', 'op' => 'index'),
//                array('name' => '发货', 'act' => 'store_deliver', 'op' => 'index'),
//                array('name' => '发货设置', 'act' => 'store_deliver_set', 'op' => 'daddress_list'),
//                array('name' => '运单模板', 'act' => 'store_waybill', 'op' => 'waybill_manage'),
//                array('name' => '评价管理', 'act' => 'store_evaluate', 'op' => 'list'),
//                array('name' => '物流工具', 'act' => 'store_transport', 'op' => 'index'),
//                array('name' => '来单提醒', 'act' => 'order_call', 'op' => 'index'),
            )),
            'team' => array('name' => '我的团队', 'child' => array(
                array('name' => '位置族谱(表格展示)', 'act' => 'seller_center', 'op' => 'table_dcotor'),
                array('name' => '位置族谱(树状展示)', 'act' => 'seller_center', 'op' => 'tree_doctor'),
                array('name' => '直荐族谱', 'act' => 'seller_center', 'op' => 'straight_doctor'),
                array('name' => '加盟商名册', 'act' => 'seller_center', 'op' => 'memberlist_doctor'),
                array('name' => '积分统计查看', 'act' => 'seller_center', 'op' => 'score_count_doctor'),
            )),
            //'promotion' => array('name' => '促销', 'child' => array(
            //    array('name' => '抢购管理', 'act'=>'store_groupbuy', 'op'=>'index'),
            //    array('name' => '加价购', 'act'=>'store_promotion_cou', 'op'=>'cou_list'),
            //    array('name' => '限时折扣', 'act'=>'store_promotion_xianshi', 'op'=>'xianshi_list'),
            //    array('name' => '满即送', 'act'=>'store_promotion_mansong', 'op'=>'mansong_list'),
            //    array('name' => '优惠套装', 'act'=>'store_promotion_bundling', 'op'=>'bundling_list'),
            //    array('name' => '推荐展位', 'act' => 'store_promotion_booth', 'op' => 'booth_goods_list'),
            //    array('name' => '预售商品', 'act' => 'store_promotion_book', 'op' => 'index'),
            //    array('name' => 'F码商品', 'act' => 'store_promotion_fcode', 'op' => 'index'),
            //    array('name' => '推荐组合', 'act' => 'store_promotion_combo', 'op' => 'index'),
            //    array('name' => '手机专享', 'act' => 'store_promotion_sole', 'op' => 'index'),
            //    array('name' => '代金券管理', 'act'=>'store_voucher', 'op'=>'templatelist'),
            //    array('name' => '活动管理', 'act'=>'store_activity', 'op'=>'store_activity'),
            //)),
            //'store' => array('name' => '医生', 'child' => array(
            //    array('name' => '医生设置', 'act'=>'store_setting', 'op'=>'store_setting'),
            //    array('name' => '医生装修', 'act'=>'store_decoration', 'op'=>'decoration_setting'),
            //    array('name' => '医生导航', 'act'=>'store_navigation', 'op'=>'navigation_list'),
            //    array('name' => '医生动态', 'act'=>'store_sns', 'op'=>'index'),
            //    array('name' => '医生信息', 'act'=>'store_info', 'op'=>'bind_class'),
            //    array('name' => '医生分类', 'act'=>'store_goods_class', 'op'=>'index'),
            //    array('name' => '品牌申请', 'act'=>'store_brand', 'op'=>'brand_list'),
            //    array('name' => '供货商', 'act'=>'store_supplier', 'op'=>'sup_list'),
            //    array('name' => '实体医生', 'act'=>'store_map', 'op'=>'index'),
            //    array('name' => '消费者保障服务', 'act'=>'store_contract', 'op'=>'index'),
            //)),
            //'consult' => array('name' => '售后服务', 'child' => array(
            //    array('name' => '咨询管理', 'act'=>'store_consult', 'op'=>'consult_list'),
            //    array('name' => '投诉管理', 'act'=>'store_complain', 'op'=>'list'),
            //    array('name' => '退款记录', 'act'=>'store_refund', 'op'=>'index'),
            //    array('name' => '退货记录', 'act'=>'store_return', 'op'=>'index'),
            //)),
//            'statistics' => array('name' => '统计结算', 'child' => array(
//                array('name' => '医生概况', 'act' => 'statistics_general', 'op' => 'general'),
//                array('name' => '商品分析', 'act' => 'statistics_goods', 'op' => 'goodslist'),
//                array('name' => '运营报告', 'act' => 'statistics_sale', 'op' => 'sale'),
//                array('name' => '行业分析', 'act' => 'statistics_industry', 'op' => 'hot'),
//                array('name' => '流量统计', 'act' => 'statistics_flow', 'op' => 'storeflow'),
//                array('name' => '实物结算', 'act' => 'store_bill', 'op' => 'index'),
//                array('name' => '虚拟结算', 'act' => 'store_vr_bill', 'op' => 'index'),
//            )),
//            'message' => array('name' => '客服消息', 'child' => array(
//                array('name' => '客服设置', 'act' => 'store_callcenter', 'op' => 'index'),
//                array('name' => '系统消息', 'act' => 'store_msg', 'op' => 'index'),
//                array('name' => '聊天记录查询', 'act' => 'store_im', 'op' => 'index'),
//            )),
//            'account' => array('name' => '账号', 'child' => array(
//                array('name' => '账号列表', 'act' => 'store_account', 'op' => 'account_list'),
//                array('name' => '账号组', 'act' => 'store_account_group', 'op' => 'group_list'),
//                array('name' => '账号日志', 'act' => 'seller_log', 'op' => 'log_list'),
//                array('name' => '医生消费', 'act' => 'store_cost', 'op' => 'cost_list'),
//                array('name' => '门店账号', 'act' => 'store_chain', 'op' => 'index'),
//            )),
            //'webchat' => array('name' => '微信', 'child' => array(
            //    array('name' => '微信接口管理', 'act'=>'seller_wechat', 'op'=>'index'),
            //    array('name' => '关注自动回复', 'act'=>'seller_wechat_follow', 'op'=>'follow_index'),
            //    array('name' => '关键词自动回复', 'act'=>'seller_wechat_keyword', 'op'=>'keyword_index'),
            //    array('name' => '消息自动回复', 'act'=>'seller_wechat_message', 'op'=>'message_index'),
            //    array('name' => '自定义菜单', 'act'=>'seller_wechat_menu', 'op'=>'index'),
            //))
        );
        return $menu_list;
    }

    /**
     * 获取当前卖家帐号可以操作的功能集合
     * @param $menu_list
     * @return array
     */
    private function _getSellerFunctionList($menu_list)
    {
        $format_menu = array();
        foreach ($menu_list as $key => $menu_value) {
            foreach ($menu_value['child'] as $submenu_value) {
                $format_menu[$submenu_value['act']] = array(
                    'model' => $key,
                    'model_name' => $menu_value['name'],
                    'name' => $submenu_value['name'],
                    'act' => $submenu_value['act'],
                    'op' => $submenu_value['op'],
                );
            }
        }
        return $format_menu;
    }

    /**
     * 自动发布医生动态
     *
     * @param array $data 相关数据
     * @param string $type 类型 'new','coupon','xianshi','mansong','bundling','groupbuy'
     *            所需字段
     *            new       goods表'             goods_id,store_id,goods_name,goods_image,goods_price,goods_freight
     *            xianshi   p_xianshi_goods表'   goods_id,store_id,goods_name,goods_image,goods_price,goods_freight,xianshi_price
     *            mansong   p_mansong表'         mansong_name,start_time,end_time,store_id
     *            bundling  p_bundling表'        bl_id,bl_name,bl_img,bl_discount_price,bl_freight_choose,bl_freight,store_id
     *            groupbuy  goods_group表'       group_id,group_name,goods_id,goods_price,groupbuy_price,group_pic,rebate,start_time,end_time
     *            coupon在后台发布
     * @return bool
     */
    public function storeAutoShare($data, $type)
    {
        $param = array(
            3 => 'new',
            4 => 'coupon',
            5 => 'xianshi',
            6 => 'mansong',
            7 => 'bundling',
            8 => 'groupbuy'
        );
        $param_flip = array_flip($param);
        if (!in_array($type, $param) || empty($data)) {
            return false;
        }

        $auto_setting = Model('store_sns_setting')->getStoreSnsSettingInfo(array('sauto_storeid' => getSession('store_id')));
        $auto_sign = false; // 自动发布开启标志

        if ($auto_setting['sauto_' . $type] == 1) {
            $auto_sign = true;
//            if (CHARSET == 'GBK') {
//                foreach ((array)$data as $k => $v) {
//                    $data[$k] = Language::getUTF8($v);
//                }
//            }
            $goodsdata = addslashes(json_encode($data));
            if ($auto_setting['sauto_' . $type . 'title'] != '') {
                $title = $auto_setting['sauto_' . $type . 'title'];
            } else {
                $auto_title = 'nc_store_auto_share_' . $type . rand(1, 5);
                $title = $this->translation->_($auto_title);
            }
        }
        if ($auto_sign) {
            // 插入数据
            $stracelog_array = array();
            $stracelog_array['strace_storeid'] = $this->store_info['store_id'];
            $stracelog_array['strace_storename'] = $this->store_info['store_name'];
            $stracelog_array['strace_storelogo'] = empty($this->store_info['store_avatar']) ? '' : $this->store_info['store_avatar'];
            $stracelog_array['strace_title'] = $title;
            $stracelog_array['strace_content'] = '';
            $stracelog_array['strace_time'] = TIMESTAMP;
            $stracelog_array['strace_type'] = $param_flip[$type];
            $stracelog_array['strace_goodsdata'] = $goodsdata;
            //添加跟踪日志
            Model('store_sns_tracelog')->saveStoreSnsTracelog($stracelog_array);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 商家消息数量
     */
    private function checkStoreMsg()
    {
        //判断cookie是否存在
        $cookie_name = 'storemsgnewnum' . getSession('seller_id');
        if (cookie($cookie_name) != null && intval(cookie($cookie_name)) >= 0) {
            $countnum = intval(cookie($cookie_name));
        } else {
            $where = array();
            $where['store_id'] = getSession('store_id');
            $where['sm_readids'] = array('exp', 'sm_readids NOT LIKE \'%,' . getSession('seller_id') . ',%\' OR sm_readids IS NULL');
            if (getSession('seller_smt_limits') !== false) {
                $where['smt_code'] = array('in', getSession('seller_smt_limits'));
            }
            //$countnum = (new StoreMsgLogic())->getStoreMsgCount($where);
            $countnum = StoreMsg::count(parseWhere($where));

            setMyCookie($cookie_name, (string)$countnum, 2 * 3600);//保存2小时
        }
        $this->view->setVar('store_msg_num', $countnum);
    }

}