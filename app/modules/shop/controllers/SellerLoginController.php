<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 13:04
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View;
use Ypk\Logic\MemberLogic;
use Ypk\Logic\SellerGroupLogic;
use Ypk\Logic\SellerLogic;
use Ypk\Logic\StoreLogic;
use Ypk\Models\Member;
use Ypk\Models\Seller;
use Ypk\Models\SellerGroup;
use Ypk\Models\Store;
use Ypk\Tpl;

class SellerLoginController extends BaseSellerController
{

    public function initialize()
    {
        parent::initialize();
        if (!empty(getSession('is_login')) && intval(getSession('is_login')) == 1 && !empty(getSession('seller_id'))) {
            redirect(getUrl('shop/seller_center'));
        }
        //if (!empty(getSession('seller_id'))) {
        //    @header('location:' . getUrl('shop/seller_center'));
        //    die;
        //}
        //$this->translation=getTranslation('common,store_layout,member_layout');
        //$this->view->setVar('lang',$this->translation);
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        //$this->view->setLayoutsDir('/layouts/');
        //$this->view->setLayout('seller_login');
    }

    public function indexAction()
    {
        $this->show_loginAction();
    }

    /**
     * 展示医生登录页面
     */
    public function show_loginAction()
    {
        //$this->view->setVar('nchash', getHash($this->dispatcher->getControllerName(), $this->dispatcher->getActionName()));
        //Tpl::setLayout('null_layout');
        //Tpl::showpage('login');
        $this->view->pick('seller_login/login');
    }

    /**
     * 卖家医生登录处理
     */
    public function loginAction()
    {
        $result = chksubmit(false, true, 'num'); //判断是否是表单提交（里面校验验证码）
        if ($result) {
            if ($result === -11) {
                $this->showDialog('用户名或密码错误', '', 'error');
            } elseif ($result === -12) {
                $this->showDialog('验证码错误', '', 'error');
            }
        } else {
            $this->showDialog('非法提交', '', 'error');
        }

        $model_seller = new SellerLogic();

        //获取卖家医生实体对象或管理员对象
        $seller_info = Seller::findFirst("seller_name='" . $_POST['seller_name'] . "'");
        if ($seller_info) {
            $member_type_id = Member::findFirst(array("member_id" => $seller_info->getMemberId(), "columns" => "member_type_id"));
            if (count($member_type_id) <= 0 || !$member_type_id || intval($member_type_id['member_type_id']) == 1) {
                showDialog('非法登录', '', 'error');
            }

            $seller_info = $seller_info->toArray();
            $model_member = new MemberLogic();
            $member_info = $model_member->getMemberInfo(
                array(
                    'member_id' => $seller_info['member_id'],
                    'member_passwd' => md5($_POST['password'])
                )
            );

            if ($member_info) { //表示医生登录成功

                // 更新卖家的最后登陆时间
                $this->db->execute("update " . (new Seller())->getSource() . " set last_login_time=" . TIMESTAMP . " where seller_id=" . $seller_info['seller_id']);
                //$model_seller->editSeller(array('last_login_time' => TIMESTAMP), array('seller_id' => $seller_info['seller_id']));

                //获取卖家组
                //$model_seller_group = new SellerGroupLogic();
                //$seller_group_info = $model_seller_group->getSellerGroupInfo(array('group_id' => $seller_info['seller_group_id']));
                $model_seller_group = SellerGroup::findFirst("group_id=" . $seller_info['seller_group_id']);
                $seller_group_info = $model_seller_group ? $model_seller_group->toArray() : array();

                //获取卖家医生信息
                //$model_store = new StoreLogic();
                //$store_info = $model_store->getStoreInfoByID($seller_info['store_id']);
                $store_info = Store::findFirst("store_id=" . $seller_info['store_id']);
                if ($store_info) {
                    $store_info = $store_info->toArray();
                } else {
                    $this->showMessage('医生不存在', getUrl('shop/seller_login/show_login', array('type' => 'login')));
                }
                //保存一些医生及个人信息
                setSession('is_login', '1'); //用户登录标识
                setSession('member_id', $member_info['member_id']); //用户id
                setSession('member_name', $member_info['member_name']); //用户名
                setSession('member_email', $member_info['member_email']);
                setSession('is_buy', $member_info['is_buy']); //用户的购买权限（1开启，0关闭）
                setSession('avatar', $member_info['member_avatar']); //用户头像

                setSession('grade_id', $store_info['grade_id']); //医生等级
                setSession('seller_id', $seller_info['seller_id']); //卖家id
                setSession('seller_name', $seller_info['seller_name']); //卖家名称
                setSession('seller_is_admin', intval($seller_info['is_admin'])); //是否是管理员（0不是，1是）
                setSession('store_id', intval($seller_info['store_id'])); //医生id
                setSession('store_name', $store_info['store_name']); //医生名称
                setSession('store_avatar', $store_info['store_avatar']); //医生logo
                setSession('is_own_shop', (bool)$store_info['is_own_shop']); //是否是自营医生（0否，1是）
                setSession('bind_all_gc', (bool)$store_info['bind_all_gc']); //自营医生是否绑定全部分类（0否，1是）
                setSession('seller_limits', explode(',', $seller_group_info['limits'])); //卖家所在卖家组权限
                setSession('seller_group_id', $seller_info['seller_group_id']); //卖家组id
                setSession('seller_gc_limits', $seller_group_info['gc_limits']); //卖家组拥有的分类权限（1拥有所有分类权限，0拥有部分分类权限）

                //判断当前登录用户是否是医生管理员，不是管理员的账户属于某个卖家组
                if ($seller_info['is_admin']) {
                    setSession('seller_group_name', '管理员');
                    setSession('seller_smt_limits', false); //卖家组的消息权限范围
                } else {
                    setSession('seller_group_name', $seller_group_info['group_name']);
                    setSession('seller_smt_limits', explode(',', $seller_group_info['smt_limits'])); //卖家组的消息权限范围
                }
                if (!$seller_info['last_login_time']) {
                    $seller_info['last_login_time'] = TIMESTAMP;
                }
                setSession('seller_last_login_time', date('Y-m-d H:i', $seller_info['last_login_time']));
                //获取卖家帐号的拥有权限的菜单集合
                $seller_menu = $this->getSellerMenuList($seller_info['is_admin'], explode(',', $seller_group_info['limits']));
                setSession('seller_menu', $seller_menu['seller_menu']); //当前卖家帐号拥有操作权限的菜单集合
                setSession('seller_function_list', $seller_menu['seller_function_list']); //当前卖家帐号可以操作的功能集合

                //判断卖家快捷操作链接
                //if (!empty($seller_info['seller_quicklink'])) {
                //    $quicklink_array = explode(',', $seller_info['seller_quicklink']);
                //    foreach ($quicklink_array as $value) {
                //        $di = $GLOBALS['di'];
                //        $session = $di->getShared('session');
                //        $session['seller_quicklink'][$value] = $value;
                //    }
                //}
                setMyCookie('auto_login', '', -3600);
                //$this->recordSellerLog('登录成功');
                redirect(getUrl('shop/seller_center')); //跳转到卖家中心
            }
            else {
                $this->showMessage('用户名密码错误', '', '', 'error');
            }
        }
        else {
            $this->showMessage('您尚未通过审核', '', '', 'error');
        }
    }

    protected function getSellerMenuList($is_admin, $limits)
    {
        $seller_menu = array();
        if (intval($is_admin) !== 1) {
            $menu_list = $this->_getMenuList();
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
        $seller_function_list = $this->_getSellerFunctionList($seller_menu);
        return array('seller_menu' => $seller_menu, 'seller_function_list' => $seller_function_list);
    }

    private function _getMenuList()
    {
        $nav_name = intval(getSession('member_id')) == 1 ? "商品" : "服务";
        $menu_list = array(
            'goods' => array('name' => "{$nav_name}", 'child' => array(
                array('name' => "发布{$nav_name}", 'act' => 'store_goods_add', 'op' => 'index'),
                array('name' => "发布咨询卡", 'act' => 'store_goods_add', 'op' => 'addChatCard'),
//                array('name' => '淘宝CSV导入', 'act' => 'taobao_import', 'op' => 'index'),
                array('name' => "出售中的{$nav_name}和咨询卡", 'act' => 'store_goods_online', 'op' => 'index'),
//                array('name' => '仓库中的商品', 'act' => 'store_goods_offline', 'op' => 'index'),
//                array('name' => '预约/到货通知', 'act' => 'store_appoint', 'op' => 'index'),
//                array('name' => '关联版式', 'act' => 'store_plate', 'op' => 'index'),
                array('name' => '商品规格', 'act' => 'store_spec', 'op' => 'index'),
//                array('name' => '图片空间', 'act' => 'store_album', 'op' => 'album_cate'),
            )),
            'order' => array('name' => '订单物流', 'child' => array(
                array('name' => '实物交易订单', 'act' => 'store_order', 'op' => 'index'),
                array('name' => '虚拟交易订单', 'act' => 'store_vr_order', 'op' => 'index'),
                array('name' => '发货', 'act' => 'store_deliver', 'op' => 'index'),
                array('name' => '发货设置', 'act' => 'store_deliver_set', 'op' => 'daddress_list'),
                array('name' => '运单模板', 'act' => 'store_waybill', 'op' => 'waybill_manage'),
                array('name' => '评价管理', 'act' => 'store_evaluate', 'op' => 'list'),
                array('name' => '物流工具', 'act' => 'store_transport', 'op' => 'index'),
//                array('name' => '来单提醒', 'act' => 'order_call', 'op' => 'index'),
            )),
            'team' => array('name' => '我的团队', 'child' => array(
                array('name' => '位置族谱(表格展示)', 'act' => 'seller_center_team', 'op' => 'table_dcotor'),
                array('name' => '位置族谱(树状展示)', 'act' => 'seller_center_team', 'op' => 'tree_doctor'),
                array('name' => '直荐族谱', 'act' => 'seller_center_team', 'op' => 'straight_doctor'),
                array('name' => '加盟商名册', 'act' => 'seller_center_team', 'op' => 'memberlist_doctor'),
                array('name' => '积分统计查看', 'act' => 'seller_center_team', 'op' => 'score_count_doctor'),
            )),
            'reward'=>array('name'=>'我的收入','child'=>array(
                array('name' => '直荐奖金', 'act' => 'seller_center_reward', 'op' => 'straght'),
                array('name' => '积分碰撞奖金', 'act' => 'seller_center_reward', 'op' => 'collision'),
                array('name' => '分佣奖金', 'act' => 'seller_center_reward', 'op' => 'commission'),
                array('name' => '分利奖金', 'act' => 'seller_center_reward', 'op' => 'share_benefits'),
                array('name' => '我的积分', 'act' => 'seller_center_reward', 'op' => 'points')
            )),
            'serviceBuyRecord' => array('name' => '服务订单', 'child' => array(
                array('name' => '服务订单', 'act' => 'service_buy_record', 'op' => 'index')
            )),
            'caseHistory' => array(
                'name' => '移动病历', 'child' => array(
                    array('name' => '移动病历', 'act' => 'case_history', 'op' => 'index')
                )),
//            'promotion' => array('name' => '促销', 'child' => array(
//                array('name' => '抢购管理', 'act' => 'store_groupbuy', 'op' => 'index'),
//                array('name' => '加价购', 'act' => 'store_promotion_cou', 'op' => 'cou_list'),
//                array('name' => '限时折扣', 'act' => 'store_promotion_xianshi', 'op' => 'xianshi_list'),
//                array('name' => '满即送', 'act' => 'store_promotion_mansong', 'op' => 'mansong_list'),
//                array('name' => '优惠套装', 'act' => 'store_promotion_bundling', 'op' => 'bundling_list'),
//                array('name' => '推荐展位', 'act' => 'store_promotion_booth', 'op' => 'booth_goods_list'),
//                array('name' => '预售商品', 'act' => 'store_promotion_book', 'op' => 'index'),
//                array('name' => 'F码商品', 'act' => 'store_promotion_fcode', 'op' => 'index'),
//                array('name' => '推荐组合', 'act' => 'store_promotion_combo', 'op' => 'index'),
//                array('name' => '手机专享', 'act' => 'store_promotion_sole', 'op' => 'index'),
//                array('name' => '代金券管理', 'act' => 'store_voucher', 'op' => 'templatelist'),
//                array('name' => '活动管理', 'act' => 'store_activity', 'op' => 'store_activity'),
//            )),
//            'store' => array('name' => '医生', 'child' => array(
//                array('name' => '医生设置', 'act' => 'store_setting', 'op' => 'store_setting'),
//                array('name' => '医生装修', 'act' => 'store_decoration', 'op' => 'decoration_setting'),
//                array('name' => '医生导航', 'act' => 'store_navigation', 'op' => 'navigation_list'),
//                array('name' => '医生动态', 'act' => 'store_sns', 'op' => 'index'),
//                array('name' => '医生信息', 'act' => 'store_info', 'op' => 'bind_class'),
//                array('name' => '医生分类', 'act' => 'store_goods_class', 'op' => 'index'),
//                array('name' => '品牌申请', 'act' => 'store_brand', 'op' => 'brand_list'),
//                array('name' => '供货商', 'act' => 'store_supplier', 'op' => 'sup_list'),
//                array('name' => '实体医生', 'act' => 'store_map', 'op' => 'index'),
//                array('name' => '消费者保障服务', 'act' => 'store_contract', 'op' => 'index'),
//            )),
//            'consult' => array('name' => '售后服务', 'child' => array(
//                array('name' => '咨询管理', 'act' => 'store_consult', 'op' => 'consult_list'),
//                array('name' => '投诉管理', 'act' => 'store_complain', 'op' => 'list'),
//                array('name' => '退款记录', 'act' => 'store_refund', 'op' => 'index'),
//                array('name' => '退货记录', 'act' => 'store_return', 'op' => 'index'),
//            )),
//            'statistics' => array('name' => '统计结算', 'child' => array(
//                array('name' => '医生概况', 'act' => 'statistics_general', 'op' => 'general'),
//                array('name' => '商品分析', 'act' => 'statistics_goods', 'op' => 'goodslist'),
//                array('name' => '运营报告', 'act' => 'statistics_sale', 'op' => 'sale'),
//                array('name' => '行业分析', 'act' => 'statistics_industry', 'op' => 'hot'),
//                array('name' => '流量统计', 'act' => 'statistics_flow', 'op' => 'storeflow'),
//                array('name' => '实物结算', 'act' => 'store_bill', 'op' => 'index'),
//                array('name' => '虚拟结算', 'act' => 'store_vr_bill', 'op' => 'index'),
//            )),
            'message' => array('name' => '聊天记录查询', 'child' => array(
                //array('name' => '客服设置', 'act' => 'store_callcenter', 'op' => 'index'),
                //array('name' => '系统消息', 'act' => 'store_msg', 'op' => 'index'),
                array('name' => '聊天记录查询', 'act' => 'store_im', 'op' => 'index'),
            )),
//            'account' => array('name' => '账号', 'child' => array(
//                array('name' => '账号列表', 'act' => 'store_account', 'op' => 'account_list'),
//                array('name' => '账号组', 'act' => 'store_account_group', 'op' => 'group_list'),
//                array('name' => '账号日志', 'act' => 'seller_log', 'op' => 'log_list'),
//                array('name' => '医生消费', 'act' => 'store_cost', 'op' => 'cost_list'),
//                array('name' => '门店账号', 'act' => 'store_chain', 'op' => 'index'),
//            ))
            //临时注释
            /*'webchat' => array('name' => '微信', 'child' => array(
                array('name' => '微信接口管理', 'act'=>'seller_wechat', 'op'=>'index'),
                array('name' => '关注自动回复', 'act'=>'seller_wechat_follow', 'op'=>'follow_index'),
                array('name' => '关键词自动回复', 'act'=>'seller_wechat_keyword', 'op'=>'keyword_index'),
                array('name' => '消息自动回复', 'act'=>'seller_wechat_message', 'op'=>'message_index'),
                array('name' => '自定义菜单', 'act'=>'seller_wechat_menu', 'op'=>'index'),
            ))*/
        );
        return $menu_list;
    }

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
}