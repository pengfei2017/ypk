<?php
/**
 * 买家虚拟兑码退款
 * User: Administrator
 * Date: 2016/12/11
 * Time: 21:22
 *
 * 采用的布局页面：member_layout
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Models\Goods;
use Ypk\Models\VrOrder;
use Ypk\Models\VrOrderCode;
use Ypk\Tpl;

class MemberVrRefundController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('member_member_index,refund');
        $model_vr_refund = Model('vr_refund');
        $model_vr_refund->getRefundStateArray();
        Tpl::output('act', 'member_refund');
    }

    /**
     * 退款记录列表页
     *
     */
    public function indexAction()
    {
        $model_vr_refund = Model('vr_refund');
        $condition = array();
        $condition['buyer_id'] = getSession('member_id');

        $keyword_type = array('order_sn', 'refund_sn', 'goods_name');
        if (trim($_GET['key']) != '' && in_array($_GET['type'], $keyword_type)) {
            $type = $_GET['type'];
            $condition[$type] = array('like', '%' . $_GET['key'] . '%');
        }
        if (trim($_GET['add_time_from']) != '' || trim($_GET['add_time_to']) != '') {
            $add_time_from = strtotime(trim($_GET['add_time_from']));
            $add_time_to = strtotime(trim($_GET['add_time_to']));
            if ($add_time_from !== false || $add_time_to !== false) {
                $condition['add_time'] = array('time', array($add_time_from, $add_time_to));
            }
        }
        $refund_list = $model_vr_refund->getRefundList($condition, 10);
        Tpl::output('refund_list', $refund_list);
        Tpl::output('show_page', $model_vr_refund->showpage());
        $store_list = $model_vr_refund->getRefundStoreList($refund_list);
        Tpl::output('store_list', $store_list);
        self::profile_menu('member_order', 'buyer_vr_refund');
        //Tpl::showpage('member_vr_refund');
        $this->view->render('member_vr_refund', 'member_vr_refund');
        $this->view->disable();
    }

	/**
     * 发起投诉
     */
    public function add_tousuAction()
    {
        $model_vr_refund = Model('vr_refund');
        $order_id = intval($_GET['order_id']);
        if (chksubmit()){
            $content=$_POST['tousu']; //获取投诉内容
            $vr_order=VrOrder::findFirst("order_id=".$order_id." and order_state=20");
            if($vr_order===false){ //要投诉的订单不存在或状态错误
                $this->showDialog("要投诉的订单不存在或状态错误");
            }
            $vr_order_code=VrOrderCode::findFirst("order_id=".$order_id." and vr_state=0");
            if($vr_order_code===false){ //虚拟订单没有有效的兑换码
                $this->showDialog("虚拟订单没有有效的兑换码");
            }

            $goods_num=1; //兑换码数量
            $refund_amount = $vr_order->getOrderAmount();//退款金额
            $code_sn=$vr_order_code->getVrCode(); //兑换码

            $refund_array['code_sn'] = $code_sn;
            $refund_array['admin_state'] = '1';//状态:1为待审核,2为同意,3为不同意
            $refund_array['refund_amount'] = ncPriceFormat($refund_amount);
            $refund_array['goods_num'] = $goods_num;
            $refund_array['buyer_message'] = $content; //投诉理由
            $refund_array['add_time'] = time();
            $refund_array['order_id'] = $order_id;

            $state = $model_vr_refund->addRefund($refund_array, $vr_order->toArray());
            if ($state) {
                //修改虚拟订单状态
                $vr_order_model=VrOrder::findFirst("order_id=".$order_id);
                if($vr_order_model!==false){
                    $vr_order_model->setOrderState(ORDER_REFUND_LOCK); //设置为退款锁定状态
                    $vr_order_model->save();
                }

                $this->showDialog("投诉成功",getUrl('shop/member_vr_order/index'));
            } else {
                $this->showDialog("投诉失败");
            }
        }
        $this->view->render('member_vr_refund', 'member_vr_tousu_add');
        $this->view->disable();
    }

    /**
     * 添加兑换码退款
     *
     */
    public function add_refundAction()
    {
        $model_vr_refund = Model('vr_refund');
        $order_id = intval($_GET['order_id']);
        if ($order_id < 1) {//参数验证
            showDialog(getLang('wrong_argument'), getUrl('shop/member_vr_refund/index'), 'error');
        }
        $condition = array();
        $condition['buyer_id'] = getSession('member_id');
        $condition['order_id'] = $order_id;
        $order = $model_vr_refund->getRightOrderList($condition); //此函数内部已经获取到了虚拟兑换码列表$order['code_list']
        $order_id = $order['order_id'];
        if (!$order['if_refund']) {//检查状态,防止页面刷新不及时造成数据错误
            showDialog(getLang('wrong_argument'), getUrl('shop/member_vr_order/index'), 'error');
        }
        if (chksubmit() && $order['if_refund']) {  //提交退款申请
            //判断发起退款的时间是否小于服务规定的退款时间段
            $goods_id = $order['goods_id'];
            if (empty($goods_id)) {
                showDialog("要退款的订单不存在");
            }
            $goods_info = Goods::findFirst("goods_id=" . $goods_id);
            if ($goods_info === false) {
                showDialog("要退款的订单不存在");
            }
            if (empty($goods_info->getDoctorServiceStartTime())) {
                showDialog("订单不存在开始时间，无法退款");
            }
            if (($goods_info->getDoctorServiceStartTime() - time()) <= getConfig('service_refund_time_long') * 60) {
                showDialog("您发起退款的时间距离服务开始时间小于12小时，禁止退款");
            }

            $code_list = $order['code_list'];
            $refund_array = array();
            $goods_num = 0;//兑换码数量
            $refund_amount = 0;//退款金额
            $code_sn = '';
            $rec_id_array = $_POST['rec_id'];

            if (!empty($rec_id_array) && is_array($rec_id_array)) {//选择退款的兑换码
                foreach ($rec_id_array as $key => $value) {
                    $code = $code_list[$value];
                    if (!empty($code)) {
                        $goods_num += 1;
                        $refund_amount += $code['pay_price'];//实际支付金额
                        $code_sn .= $code['vr_code'] . ',';//兑换码编号
                    }
                }
            }
            if ($goods_num < 1) {
                showDialog(getLang('wrong_argument'), 'reload', 'error');
            }
            $refund_array['code_sn'] = rtrim($code_sn, ',');
            $refund_array['admin_state'] = '1';//状态:1为待审核,2为同意,3为不同意
            $refund_array['refund_amount'] = ncPriceFormat($refund_amount);
            $refund_array['goods_num'] = $goods_num;
            $refund_array['buyer_message'] = $_POST['buyer_message'];
            $refund_array['add_time'] = time();
            $state = $model_vr_refund->addRefund($refund_array, $order);

            if ($state) {
                //修改虚拟订单状态
                $vr_order_model=VrOrder::findFirst("order_id=".$order_id);
                if($vr_order_model!==false){
                    $vr_order_model->setOrderState(ORDER_REFUND_LOCK); //设置为退款锁定状态
                    $vr_order_model->save();
                }

                showDialog(getLang('nc_common_save_succ'), getUrl('shop/member_vr_refund/index'), 'succ');
            } else {
                showDialog(getLang('nc_common_save_fail'), 'reload', 'error');
            }
        }
        //Tpl::showpage('member_vr_refund_add');
        $this->view->render('member_vr_refund', 'member_vr_refund_add');
        $this->view->disable();
    }

    /**
     * 退款记录查看
     *
     */
    public function viewAction()
    {
        $model_vr_refund = Model('vr_refund');
        $condition = array();
        $condition['buyer_id'] = getSession('member_id');
        $condition['refund_id'] = intval($_GET['refund_id']);
        $refund_list = $model_vr_refund->getRefundList($condition);
        $refund = $refund_list[0];
        Tpl::output('refund', $refund);
        $code_array = explode(',', $refund['code_sn']);
        Tpl::output('code_array', $code_array);
        $detail_array = $model_vr_refund->getDetailInfo(array('refund_id' => $refund['refund_id']));
        Tpl::output('detail_array', $detail_array);
        $condition = array();
        $condition['order_id'] = $refund['order_id'];
        $model_vr_refund->getRightOrderList($condition);
        //Tpl::showpage('member_vr_refund_view');
        $this->view->render('member_vr_refund', 'member_vr_refund_view');
        $this->view->disable();
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     */
    private function profile_menu($menu_type, $menu_key = '')
    {
        $menu_array = array();
        switch ($menu_type) {
            case 'member_order':
                $menu_array = array(
                    array('menu_key' => 'buyer_refund', 'menu_name' => getLang('nc_member_path_buyer_refund'), 'menu_url' => getUrl('shop/member_refund')),
                    array('menu_key' => 'buyer_return', 'menu_name' => getLang('nc_member_path_buyer_return'), 'menu_url' => getUrl('shop/member_return')),
                    array('menu_key' => 'buyer_vr_refund', 'menu_name' => '虚拟兑码退款', 'menu_url' => getUrl('shop/member_vr_refund')));
                break;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu', $menu_array);
        $this->view->setVar('menu_key', $menu_key);
    }
}