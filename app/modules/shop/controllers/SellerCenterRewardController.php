<?php
/**
 * 商家中心-我的收入
 * User: Administrator
 * Date: 2017/1/3
 * Time: 16:36
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\MemberCommissionLog;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\MemberShareBenefitsLog;
use Ypk\Models\MemberStraightLog;
use Ypk\Models\PointsLog;
use Ypk\Models\Transport;
use Ypk\Tpl;

class SellerCenterRewardController extends BaseSellerController
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('member_home_index,common,msg');
        $this->view->setVar('lang', $this->translation);
    }

    /**
     * 直荐奖金
     */
    public function straghtAction()
    {
        $str = "";
        $staraght_log_list = MemberStraightLog::find(array('conditions' => 'member_tree_type=1 and member_id=' . getSession('member_id'), 'order' => 'add_time desc'));
        if (count($staraght_log_list) > 0) {
            $staraght_log_list = $staraght_log_list->toArray();
            foreach ($staraght_log_list as $staraght_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>医护圈直荐奖</td>";
                $str .= "<td>" . ncPriceFormat($staraght_log['store_straight_money']) . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $staraght_log['add_time']) . "</td>";
                $str .= "</tr>";
            }
        }

        if (empty($str)) {
            $str = "<tr><td colspan='4'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
    }

    /**
     * 积分碰撞奖金
     */
    public function collisionAction()
    {
        $str = "";
        $collision_log_list = MemberPointsCollisionLog::find(array('conditions' => 'member_id=' . getSession('member_id') . ' and collision_log_type=1', 'order' => 'add_time desc'));
        if (count($collision_log_list) > 0) {
            $collision_log_list = $collision_log_list->toArray();
            foreach ($collision_log_list as $collision_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>医护圈碰撞</td>";
                $str .= "<td>" . ncPriceFormat($collision_log['store_collision_money']) . "</td>";
                $str .= "<td>" . $collision_log['store_collision_times'] . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $collision_log['add_time']) . "</td>";
                $str .= "</tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
    }

    /**
     * 分佣奖金
     */
    public function commissionAction()
    {
        $str = "";
        $commission_log_list = MemberCommissionLog::find(array('conditions' => 'member_id=' . getSession('member_id') . ' and commission_tree_type=1', 'order' => 'add_time desc'));
        if (count($commission_log_list) > 0) {
            $commission_log_list = $commission_log_list->toArray();
            foreach ($commission_log_list as $commission_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>医护圈</td>";
                $str .= "<td>" . ncPriceFormat($commission_log['store_tree_commission_money']) . "</td>";
                $str .= "<td>" . $commission_log['store_commission_level'] . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $commission_log['add_time']) . "</td>";
                $str .= "<tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='5'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
    }

    /**
     * 分利奖金
     */
    public function share_benefitsAction()
    {
        $str = "";
        $share_benifits_log_list = MemberShareBenefitsLog::find(array('conditions' => 'member_id=' . getSession('member_id'), 'order' => 'add_time desc'));
        if (count($share_benifits_log_list) > 0) {
            $share_benifits_log_list = $share_benifits_log_list->toArray();
            foreach ($share_benifits_log_list as $share_benifits_log) {
                $str .= "<tr>";
                $str .= "<td>" . getSession('member_name') . "</td>";
                $str .= "<td>" . ncPriceFormat($share_benifits_log['share_benefits_money']) . "</td>";
                $str .= "<td>" . date('Y-m-d H:i:s', $share_benifits_log['add_time']) . "</td>";
                $str .= "</tr>";
            }
        }
        if (empty($str)) {
            $str = "<tr><td colspan='3'>暂无记录</td></tr>";
        }
        Tpl::output('str', $str);
    }

    /**
     * 积分
     */
    public function pointsAction()
    {
        $str = "";
        $points_log_list = PointsLog::find(array('conditions' => 'pl_memberid=' . getSession('member_id') . ' and tree_type=1', 'order' => 'pl_addtime desc'));
        if (count($points_log_list) > 0) {
            $points_log_list = $points_log_list->toArray();
            foreach ($points_log_list as $points_log) {
                $str .= "<tr>";
                $str .= "<td>" . $points_log['pl_membername'] . "</td>";
                $str .= "<td>医护圈</td>";
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
    }
}