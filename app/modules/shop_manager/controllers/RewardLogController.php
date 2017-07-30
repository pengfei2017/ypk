<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/6
 * Time: 16:17
 */

namespace Ypk\Modules\ShopManager\Controllers;

use Ypk\Models\MemberCommissionLog;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\MemberShareBenefitsLog;
use Ypk\Models\MemberStraightLog;
use Ypk\Models\PointsLog;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * 获取奖金日志
 *
 * Class RewardLogController
 * @package Ypk\Modules\ShopManager\Controllers
 */
class RewardLogController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,member');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->get_straight_logAction();
    }

    /**
     * 直荐奖日志
     */
    public function get_straight_logAction()
    {
        $this->view->pick('reward_log/straight_log');
    }

    /**
     * 输出直荐奖日志XML数据
     */
    public function get_straight_log_xmlAction()
    {
        $builder = $this->modelsManager->createBuilder();
        $builder->from(['log' => 'Ypk\Models\MemberStraightLog']);
        $builder->where('member.member_state = 1');
        $builder->columns(array('log.*', 'member.member_name'));
        $builder->leftJoin('Ypk\Models\Member', 'member.member_id = log.member_id', 'member');

        if ($_GET['member_name']) {
            $builder->where('member.member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $builder->andWhere('log.member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_POST['query'] != '') {
            if ($_POST['qtype'] == 'member_name') {
                $builder->andWhere('member.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            } else {
                $builder->andWhere('log.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            }
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $builder->betweenWhere('log.add_time', $start_unixtime, $end_unixtime);
        }

        $model_member_straight_log = new MemberStraightLog();
        $metadata = $model_member_straight_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_member_straight_log);
        $param[] = 'member_name';
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            if ($_POST['sortname'] == 'member_name') {
                $order = 'member.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            } else {
                $order = 'log.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            }
            $builder->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];
        $reward_log_total_list = $builder->getQuery()->execute();
        $total_num = count($reward_log_total_list->toArray());
        $reward_log_list = $builder->limit($page, (($now_page - 1) * $page))->getQuery()->execute();

        $reward_log_list = $reward_log_list->toArray();

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_log_list as $value) {
            $value_temp = $value->toArray();
            $value = array_merge($value_temp['log']->toArray(), array('member_name' => $value_temp['member_name']));
            $param = array();
            $param['id'] = $value['id'];
            $param['member_id'] = $value['member_id'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            $param['member_tree_type'] = $value['month_total'] == '0' ? '客户树直荐奖' : '医护人员树直荐奖';
            $param['buyer_id'] = $value['buyer_id'];
            $param['buyer_avatar'] = "<img src=" . getMemberAvatarForID($value['buyer_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['buyer_id']) . ">\")'>" . $value['buyer_name'];
            $param['order_id'] = $value['order_id'];
            $param['buy_money'] = ncPriceFormat($value['buy_money']);
            $param['member_straight_money'] = ncPriceFormat($value['member_straight_money']);
            $param['seller_id'] = $value['seller_id'];
            $param['seller_avatar'] = "<img src=" . getMemberAvatarForID($value['seller_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['seller_id']) . ">\")'>" . $value['seller_name'];
            $param['sale_money'] = ncPriceFormat($value['sale_money']);
            $param['store_straight_money'] = ncPriceFormat($value['store_straight_money']);
            $param['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $data['list'][$value['id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 积分碰撞奖日志
     */
    public function get_points_collision_logAction()
    {
        $this->view->pick('reward_log/points_collision_log');
    }

    /**
     * 输出积分碰撞奖日志XML数据
     */
    public function get_points_collision_log_xmlAction()
    {
        $builder = $this->modelsManager->createBuilder();
        $builder->from(['log' => 'Ypk\Models\MemberPointsCollisionLog']);
        $builder->where('member.member_state = 1');
        $builder->columns(array('log.*', 'member.member_name'));
        $builder->leftJoin('Ypk\Models\Member', 'member.member_id = log.member_id', 'member');

        if ($_GET['member_name']) {
            $builder->where('member.member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $builder->andWhere('log.member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_POST['query'] != '') {
            if ($_POST['qtype'] == 'member_name') {
                $builder->andWhere('member.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            } else {
                $builder->andWhere('log.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            }
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $builder->betweenWhere('log.add_time', $start_unixtime, $end_unixtime);
        }

        $model_member_points_collision_log = new MemberPointsCollisionLog();
        $metadata = $model_member_points_collision_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_member_points_collision_log);
        $param[] = 'member_name';
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            if ($_POST['sortname'] == 'member_name') {
                $order = 'member.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            } else {
                $order = 'log.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            }
            $builder->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];
        $reward_log_total_list = $builder->getQuery()->execute();
        $total_num = count($reward_log_total_list->toArray());
        $reward_log_list = $builder->limit($page, (($now_page - 1) * $page))->getQuery()->execute();

        $reward_log_list = $reward_log_list->toArray();

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_log_list as $value) {
            $value_temp = $value->toArray();
            $value = array_merge($value_temp['log']->toArray(), array('member_name' => $value_temp['member_name']));
            $param = array();
            $param['id'] = $value['id'];
            $param['member_id'] = $value['member_id'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            $param['order_id'] = $value['order_id'];
            $param['collision_log_type'] = $value['collision_log_type'] == 0 ? '客户树积分碰撞' : '医护人员树积分碰撞';
            $param['member_tree_id'] = $value['member_tree_id'];
            $param['member_points'] = $value['member_points'];
            $param['member_self_used_points'] = $value['member_self_used_points'];
            $param['member_left_used_points'] = $value['member_left_used_points'];
            $param['member_right_used_points'] = $value['member_right_used_points'];
            $param['member_collision_times'] = $value['member_collision_times'];
            $param['member_collision_money'] = ncPriceFormat($value['member_collision_money']);
            $param['store_tree_id'] = $value['store_tree_id'];
            $param['store_points'] = $value['store_points'];
            $param['store_self_used_points'] = $value['store_self_used_points'];
            $param['store_left_used_points'] = $value['store_left_used_points'];
            $param['store_right_used_points'] = $value['store_right_used_points'];
            $param['store_collision_times'] = $value['store_collision_times'];
            $param['store_collision_money'] = ncPriceFormat($value['store_collision_money']);
            $param['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $data['list'][$value['id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 分佣奖日志
     */
    public function get_commission_logAction()
    {
        $this->view->pick('reward_log/commission_log');
    }

    /**
     * 输出分佣奖日志XML数据
     */
    public function get_commission_log_xmlAction()
    {
        $builder = $this->modelsManager->createBuilder();
        $builder->from(['log' => 'Ypk\Models\MemberCommissionLog']);
        $builder->where('member.member_state = 1');
        $builder->columns(array('log.*', 'member.member_name'));
        $builder->leftJoin('Ypk\Models\Member', 'member.member_id = log.member_id', 'member');

        if ($_GET['member_name']) {
            $builder->where('member.member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $builder->andWhere('log.member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_POST['query'] != '') {
            if ($_POST['qtype'] == 'member_name') {
                $builder->andWhere('member.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            } else {
                $builder->andWhere('log.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            }
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $builder->betweenWhere('log.add_time', $start_unixtime, $end_unixtime);
        }

        $model_member_commission_log = new MemberCommissionLog();
        $metadata = $model_member_commission_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_member_commission_log);
        $param[] = 'member_name';
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            if ($_POST['sortname'] == 'member_name') {
                $order = 'member.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            } else {
                $order = 'log.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            }
            $builder->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];
        $reward_log_total_list = $builder->getQuery()->execute();
        $total_num = count($reward_log_total_list->toArray());
        $reward_log_list = $builder->limit($page, (($now_page - 1) * $page))->getQuery()->execute();

        $reward_log_list = $reward_log_list->toArray();

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_log_list as $value) {
            $value_temp = $value->toArray();
            $value = array_merge($value_temp['log']->toArray(), array('member_name' => $value_temp['member_name']));
            $param = array();
            $param['id'] = $value['id'];
            $param['member_id'] = $value['member_id'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            $param['order_id'] = $value['order_id'];
            $param['commission_tree_type'] = $value['commission_tree_type'] == 0 ? '客户树分佣' : '医护人员树分佣';
            $param['member_tree_id'] = $value['member_tree_id'];
            $param['member_tree_commission_money'] = ncPriceFormat($value['member_tree_commission_money']);
            $param['member_commission_level'] = $value['member_commission_level'] . '级分佣';
            $param['store_tree_id'] = $value['store_tree_id'];
            $param['store_tree_commission_money'] = ncPriceFormat($value['store_tree_commission_money']);
            $param['store_commission_level'] = $value['store_commission_level'] . '级分佣';
            $param['collision_member_id'] = $value['collision_member_id'];
            $param['collision_times'] = $value['collision_times'];
            $param['collision_money'] = ncPriceFormat($value['collision_money']);
            $param['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $data['list'][$value['id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 分利奖日志
     */
    public function get_share_benefits_logAction()
    {
        $this->view->pick('reward_log/share_benefits_log');
    }

    /**
     * 输出分利奖日志XML数据
     */
    public function get_share_benefits_log_xmlAction()
    {
        $builder = $this->modelsManager->createBuilder();
        $builder->from(['log' => 'Ypk\Models\MemberShareBenefitsLog']);
        $builder->where('member.member_state = 1');
        $builder->columns(array('log.*', 'member.member_name'));
        $builder->leftJoin('Ypk\Models\Member', 'member.member_id = log.member_id', 'member');

        if ($_GET['member_name']) {
            $builder->where('member.member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $builder->andWhere('log.member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_POST['query'] != '') {
            if ($_POST['qtype'] == 'member_name') {
                $builder->andWhere('member.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            } else {
                $builder->andWhere('log.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            }
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $builder->betweenWhere('log.add_time', $start_unixtime, $end_unixtime);
        }

        $model_member_share_benefits_log = new MemberShareBenefitsLog();
        $metadata = $model_member_share_benefits_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_member_share_benefits_log);
        $param[] = 'member_name';
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            if ($_POST['sortname'] == 'member_name') {
                $order = 'member.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            } else {
                $order = 'log.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            }
            $builder->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];
        $reward_log_total_list = $builder->getQuery()->execute();
        $total_num = count($reward_log_total_list->toArray());
        $reward_log_list = $builder->limit($page, (($now_page - 1) * $page))->getQuery()->execute();

        $reward_log_list = $reward_log_list->toArray();

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_log_list as $value) {
            $value_temp = $value->toArray();
            $value = array_merge($value_temp['log']->toArray(), array('member_name' => $value_temp['member_name']));
            $param = array();
            $param['id'] = $value['id'];
            $param['member_id'] = $value['member_id'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            $param['buyer_id'] = $value['buyer_id'];
            $param['buyer_avatar'] = "<img src=" . getMemberAvatarForID($value['buyer_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['buyer_id']) . ">\")'>" . $value['buyer_name'];
            $param['order_id'] = $value['order_id'];
            $param['goods_id'] = $value['goods_id'];
            $param['goods_name'] = $value['goods_name'];
            $param['doctor_private_price'] = ncPriceFormat($value['doctor_private_price']);
            $param['buy_num'] = $value['buy_num'];
            $param['share_benefits_money'] = ncPriceFormat($value['share_benefits_money']);
            $param['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $data['list'][$value['id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 积分生成日志
     */
    public function get_points_logAction()
    {
        $this->view->pick('reward_log/points_log');
    }

    /**
     * 输出积分生成日志XML数据
     */
    public function get_points_log_xmlAction()
    {
        $builder = $this->modelsManager->createBuilder();
        $builder->from(['log' => 'Ypk\Models\PointsLog']);
        $builder->where('member.member_state = 1');
        $builder->columns(array('log.*', 'member.member_name'));
        $builder->leftJoin('Ypk\Models\Member', 'member.member_id = log.pl_memberid', 'member');

        if ($_GET['member_name']) {
            $builder->where('member.member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['pl_memberid']) {
            $builder->andWhere('log.pl_memberid LIKE :member_id:', array('member_id' => '%' . $_GET['pl_memberid'] . '%'));
        }
        if ($_POST['query'] != '') {
            if ($_POST['qtype'] == 'member_name') {
                $builder->andWhere('member.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            } else {
                $builder->andWhere('log.' . $_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
            }
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $builder->betweenWhere('log.pl_addtime', $start_unixtime, $end_unixtime);
        }

        $model_points_log = new PointsLog();
        $metadata = $model_points_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_points_log);
        $param[] = 'member_name';
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            if ($_POST['sortname'] == 'member_name') {
                $order = 'member.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            } else {
                $order = 'log.' . $_POST['sortname'] . ' ' . $_POST['sortorder'];
            }
            $builder->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];
        $reward_log_total_list = $builder->getQuery()->execute();
        $total_num = count($reward_log_total_list->toArray());
        $reward_log_list = $builder->limit($page, (($now_page - 1) * $page))->getQuery()->execute();

        $reward_log_list = $reward_log_list->toArray();

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_log_list as $value) {
            $value_temp = $value->toArray();
            $value = array_merge($value_temp['log']->toArray(), array('member_name' => $value_temp['member_name']));
            $param = array();
            $param['pl_id'] = $value['pl_id'];
            $param['pl_memberid'] = $value['pl_memberid'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['pl_memberid']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['pl_memberid']) . ">\")'>" . $value['member_name'];
            $param['order_id'] = $value['order_id'];
            $param['tree_type'] = $value['tree_type'] == 0 ? '客户树积分' : '医护人员树积分';
            $param['pl_points'] = $value['pl_points'];
            $param['pl_desc'] = $value['pl_desc'];
            $param['pl_addtime'] = date('Y-m-d H:i:s', $value['pl_addtime']);
            $data['list'][$value['pl_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }
}
