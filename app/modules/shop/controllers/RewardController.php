<?php
/**
 * 前端客户个人中心-我的收入
 * User: Administrator
 * Date: 2017/1/3
 * Time: 11:47
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\MemberCommissionLog;
use Ypk\Models\MemberExtend;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\MemberStraightLog;
use Ypk\Models\PointsLog;
use Ypk\Tpl;

class RewardController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('member_predeposit');
    }

    public function indexAction()
    {
        $this->straghtAction();
    }

    /**
     * 直荐奖
     */
    public function straghtAction()
    {
        $str = "";
        $staraght_log_list = MemberStraightLog::find(array('conditions' => 'member_tree_type=0 and member_id=' . getSession('member_id'), 'order' => 'add_time desc'));
        if (count($staraght_log_list) > 0) {
            $staraght_log_list = $staraght_log_list->toArray();
            foreach ($staraght_log_list as $staraght_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>客户圈直荐奖</td>";
                $str .= "<td>" . ncPriceFormat($staraght_log['member_straight_money']) . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $staraght_log['add_time']) . "</td>";
                $str .= "</tr>";
            }
        }

        if (empty($str)) {
            $str = "<tr><td colspan='4'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
        self::profile_menu('straght');
        $this->view->render('reward', 'straght');
        $this->view->disable();
    }

    /**
     * 积分碰撞奖
     */
    public function collisionAction()
    {
        $str = "";
        $collision_log_list = MemberPointsCollisionLog::find(array('conditions' => 'member_id=' . getSession('member_id') . ' and collision_log_type=0', 'order' => 'add_time desc'));
        if (count($collision_log_list) > 0) {
            $collision_log_list = $collision_log_list->toArray();
            foreach ($collision_log_list as $collision_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>客户圈碰撞</td>";
                $str .= "<td>" . ncPriceFormat($collision_log['member_collision_money']) . "</td>";
                $str .= "<td>" . $collision_log['member_collision_times'] . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $collision_log['add_time']) . "</td>";
                $str .= "</tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
        self::profile_menu('collision');
        $this->view->render('reward', 'collision');
        $this->view->disable();
    }

    /**
     * 分佣奖
     */
    public function commissionAction()
    {
        $str = "";
        $commission_log_list = MemberCommissionLog::find(array('conditions' => 'member_id=' . getSession('member_id') . ' and commission_tree_type=0', 'order' => 'add_time desc'));
        if (count($commission_log_list) > 0) {
            $commission_log_list = $commission_log_list->toArray();
            foreach ($commission_log_list as $commission_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>客户圈</td>";
                $str .= "<td>" . ncPriceFormat($commission_log['member_tree_commission_money']) . "</td>";
                $str .= "<td>" . $commission_log['member_commission_level'] . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $commission_log['add_time']) . "</td>";
                $str .= "<tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
        self::profile_menu('commission');
        $this->view->render('reward', 'commission');
        $this->view->disable();
    }

    /**
     * 我的积分
     */
    public function pointsAction()
    {
        $str = "";
        $points_log_list = PointsLog::find(array('conditions' => 'pl_memberid=' . getSession('member_id') . ' and tree_type=0', 'order' => 'pl_addtime desc'));
        if (count($points_log_list) > 0) {
            $points_log_list = $points_log_list->toArray();
            foreach ($points_log_list as $points_log) {
                $str .= "<tr>";
                $str .= "<td>" . $points_log['pl_membername'] . "</td>";
                $str .= "<td>客户圈</td>";
                $str .= "<td>" . $points_log['pl_points'] . "</td>";
                $str .= "<td>" . $points_log['pl_desc'] . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $points_log['pl_addtime']) . "</td>";
                $str .= "</tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
        self::profile_menu('points');
        $this->view->render('reward', 'points');
        $this->view->disable();
    }

    /**
     * 支付帐号
     */
    public function pay_acountAction()
    {
        if(!empty($_POST['form_submit']) && $_POST['form_submit']=='ok'){
            $member_extend_model=MemberExtend::findFirst("member_id=".getSession('member_id'));
            if($member_extend_model!==false){
                $member_extend_model->setAccountPay($_POST['account_pay']);
                $member_extend_model->setAccountWx($_POST['account_wx']);
                $member_extend_model->setAccountBank($_POST['account_bank']);
                $member_extend_model->setBankType($_POST['bank_type']);
                $member_extend_model->setBankClass($_POST['bank_class']);
                $member_extend_model->setBankName($_POST['bank_name']);
                $member_extend_model->setBankAddress($_POST['bank_address']);
                if($member_extend_model->save()===false){
                    showDialog('保存失败');
                }else{
                    showDialog('保存成功');
                }
            }else{
                $member_extend_model=new MemberExtend();
                $insert_array=array(
                    'member_id'=>getSession('member_id'),
                    'account_pay'=>$_POST['account_pay'],
                    'account_wx'=>$_POST['account_wx'],
                    'account_bank'=>$_POST['account_bank'],
                    'bank_type'=>$_POST['bank_type'],
                    'bank_class'=>$_POST['bank_class'],
                    'bank_name'=>$_POST['bank_name'],
                    'bank_address'=>$_POST['bank_address']
                );
                if($member_extend_model->save($insert_array)===false){
                    showDialog('保存失败');
                }else{
                    showDialog('保存成功');
                }
            }
        }else{
            $member_account_model=MemberExtend::findFirst("member_id=".getSession('member_id'));
            if($member_account_model!==false){
                $member_account_model=$member_account_model->toArray();
                Tpl::output('$member_account_model',$member_account_model);
            }
        }
        self::profile_menu('pay_acount');
    }


    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_key 当前导航的menu_key
     */
    private function profile_menu($menu_key = '')
    {
        $menu_array = array(
            array('menu_key' => 'straght', 'menu_name' => '直荐奖金', 'menu_url' => getUrl('shop/reward/straght')),
            array('menu_key' => 'collision', 'menu_name' => '积分奖奖金', 'menu_url' => getUrl('shop/reward/collision')),
            array('menu_key' => 'commission', 'menu_name' => '管理奖奖金', 'menu_url' => getUrl('shop/reward/commission')),
            array('menu_key' => 'points', 'menu_name' => '我的积分', 'menu_url' => getUrl('shop/reward/points')),
            array('menu_key' => 'pay_acount', 'menu_name' => '支付帐号', 'menu_url' => getUrl('shop/reward/pay_acount')),
        );
        $this->view->setVar('member_menu', $menu_array);
        $this->view->setVar('menu_key', $menu_key);
    }
}