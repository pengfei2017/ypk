<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/6
 * Time: 16:17
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Phalcon\Mvc\View;
use Ypk\Excel;
use Ypk\Log;
use Ypk\Models\Member;
use Ypk\Models\MemberCommissionLog;
use Ypk\Models\MemberExtend;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\MemberRewardGiveoutLog;
use Ypk\Models\MemberShareBenefitsLog;
use Ypk\Models\MemberStraightLog;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

/**
 * 奖金发放
 *
 * Class RewardGiveoutController
 * @package Ypk\Modules\ShopManager\Controllers
 */
class RewardGiveoutController extends ControllerBase
{
    const EXPORT_SIZE = 1000;

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,member,export');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->reward_giveoutAction();
    }

    /**
     * 奖金发放列表
     */
    public function reward_giveoutAction()
    {
        //获取当前的日期是不是15到20号，只有15到20号才显示发放奖金按钮，因为只有每月15到20号才能发放奖金
        $can_giveout_reward = false;
        $day = intval(date('d'));
        if ($day >= 15 && $day <= 20) {
            //奖金发放日期为每月15号--20号，所以只有在当月15号--20号才会显示发放按钮
            $can_giveout_reward = true;
        }
        $this->view->setVar('can_giveout_reward', $can_giveout_reward);
        $this->view->pick('reward_giveout/reward_giveout');
    }

    /**
     * 奖金发放日志记录
     */
    public function reward_giveout_logAction()
    {
        $this->view->pick('reward_giveout/reward_giveout_log');
    }

    /**
     * 输出奖金发放XML数据
     */
    public function get_xmlAction()
    {
        $query = Member::query();
        //人被封号就不发放奖金了
        $query->where('member_state = :member_state:', array('member_state' => 1));
        $query->andWhere('(member_straight_money_sum > 0 OR member_collision_sum_money > 0 OR member_commission_money_sum > 0 OR store_share_benefits_money_sum > 0 OR store_straight_money_sum > 0 OR store_collision_sum_money > 0 OR store_commission_money_sum > 0)');
        if ($_GET['member_name']) {
            $query->andWhere('member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $query->andWhere('member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_POST['query'] != '') {
            $query->andWhere($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }
        $model_member = new Member();
        $metadata = $model_member->getModelsMetaData();
        $param = $metadata->getAttributes($model_member);
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        $total_num = Member::count(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));
        $reward_list = $query->limit($page, (($now_page - 1) * $page))->execute();
        if (count($reward_list->toArray()) > 0) {
            $reward_list = $reward_list->toArray();
        } else {
            $reward_list = array();
        }

        //获取当前的日期是不是15到20号，只有15到20号才显示发放奖金按钮，因为只有每月15到20号才能发放奖金
        $can_giveout_reward = false;
        $day = intval(date('d'));
        if ($day >= 15 && $day <= 20) {
            $can_giveout_reward = true;
        }

        //上个月15号
        $start_time = strtotime(date('Y-m-15 00:00:00') . ' -1 month');
        //这个月14号
        $end_time = strtotime(date('Y-m-14 23:59:59'));

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_list as $value) {
            //该会员也可能其他月的奖金没有发放完
            $total = $value['member_straight_money_sum'] + $value['member_collision_sum_money'] + $value['member_commission_money_sum'] + $value['store_share_benefits_money_sum'] + $value['store_straight_money_sum'] + $value['store_collision_sum_money'] + $value['store_commission_money_sum'];
            if ($total <= 0) {
                //如果该会员账户奖金总和合计为零，说明奖金已经发放完毕，不进行显示和发放
                continue;
            }
            $param = array();
            if ($can_giveout_reward) {
                //奖金发放日期为每月15号--20号，所以只有在当月15号--20号才会显示发放按钮
                $operation = '';
                $operation .= "<a class='btn green' href='javascript:void(0)' onclick=\"ajax_form('do_reward_giveout','发放奖金“会员ID为" . $value['member_id'] . "”的奖金','" . getUrl('shop_manager/reward_giveout/do_reward_giveout', array('id' => $value['member_id'])) . "', '640')\"><i class='fa fa-list-alt'></i>发放奖金</a>";
                $param['operation'] = $operation;
            }
            $param['member_id'] = $value['member_id'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            //客户树直荐奖（元）
            $query_member_straight_log = MemberStraightLog::query();
            $query_member_straight_log->columns(array('SUM(member_straight_money) as sum_money'));
            $query_member_straight_log->where('member_tree_type = 0');
            $query_member_straight_log->andWhere('member_id = ' . $value['member_id']);
            $query_member_straight_log->betweenWhere('add_time', $start_time, $end_time);
            $member_straight_log = $query_member_straight_log->execute()->toArray();
            $param['member_straight_money_sum_log'] = ncPriceFormat($member_straight_log[0]['sum_money']);
            //客户树积分碰撞奖（元）
            $query_member_points_collision_log = MemberPointsCollisionLog::query();
            $query_member_points_collision_log->columns(array('SUM(member_collision_money) as sum_money'));
            $query_member_points_collision_log->where('collision_log_type = 0');
            $query_member_points_collision_log->andWhere('member_id = ' . $value['member_id']);
            $query_member_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
            $member_points_collision_log = $query_member_points_collision_log->execute()->toArray();
            $param['member_collision_sum_money_log'] = ncPriceFormat($member_points_collision_log[0]['sum_money']);
            //客户树分佣奖（元）
            $query_member_commission_log = MemberCommissionLog::query();
            $query_member_commission_log->columns(array('SUM(member_tree_commission_money) as sum_money'));
            $query_member_commission_log->where('commission_tree_type = 0');
            $query_member_commission_log->andWhere('member_id = ' . $value['member_id']);
            $query_member_commission_log->betweenWhere('add_time', $start_time, $end_time);
            $member_commission_log = $query_member_commission_log->execute()->toArray();
            $param['member_commission_money_sum_log'] = ncPriceFormat($member_commission_log[0]['sum_money']);
            //医护人员树分利所得（元）
            $query_store_share_benefits_log = MemberShareBenefitsLog::query();
            $query_store_share_benefits_log->columns(array('SUM(share_benefits_money) as sum_money'));
            $query_store_share_benefits_log->where('member_id = ' . $value['member_id']);
            $query_store_share_benefits_log->betweenWhere('add_time', $start_time, $end_time);
            $store_share_benefits_log = $query_store_share_benefits_log->execute()->toArray();
            $param['store_share_benefits_money_sum_log'] = ncPriceFormat($store_share_benefits_log[0]['sum_money']);
            //医护人员树直荐奖（元）
            $query_store_straight_log = MemberStraightLog::query();
            $query_store_straight_log->columns(array('SUM(store_straight_money) as sum_money'));
            $query_store_straight_log->where('member_tree_type = 1');
            $query_store_straight_log->andWhere('member_id = ' . $value['member_id']);
            $query_store_straight_log->betweenWhere('add_time', $start_time, $end_time);
            $store_straight_log = $query_store_straight_log->execute()->toArray();
            $param['store_straight_money_sum_log'] = ncPriceFormat($store_straight_log[0]['sum_money']);
            //医护人员树积分碰撞奖（元）
            $query_store_points_collision_log = MemberPointsCollisionLog::query();
            $query_store_points_collision_log->columns(array('SUM(store_collision_money) as sum_money'));
            $query_store_points_collision_log->where('collision_log_type = 1');
            $query_store_points_collision_log->andWhere('member_id = ' . $value['member_id']);
            $query_store_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
            $store_points_collision_log = $query_store_points_collision_log->execute()->toArray();
            $param['store_collision_sum_money_log'] = ncPriceFormat($store_points_collision_log[0]['sum_money']);
            //医护人员树分佣奖（元）
            $query_store_commission_log = MemberCommissionLog::query();
            $query_store_commission_log->columns(array('SUM(store_tree_commission_money) as sum_money'));
            $query_store_commission_log->where('commission_tree_type = 1');
            $query_store_commission_log->andWhere('member_id = ' . $value['member_id']);
            $query_store_commission_log->betweenWhere('add_time', $start_time, $end_time);
            $store_commission_log = $query_store_commission_log->execute()->toArray();
            $param['store_commission_money_sum_log'] = ncPriceFormat($store_commission_log[0]['sum_money']);

            //总计（元）
            $param['month_total_log'] = ncPriceFormat($member_straight_log[0]['sum_money'] + $member_points_collision_log[0]['sum_money'] + $member_commission_log[0]['sum_money'] + $store_share_benefits_log[0]['sum_money'] + $store_straight_log[0]['sum_money'] + $store_points_collision_log[0]['sum_money'] + $store_commission_log[0]['sum_money']);
            $param['total'] = ncPriceFormat($total);

            //支付宝帐号、微信帐号、银行卡帐号
            $member_extend_model=MemberExtend::findFirst("member_id=".$value['member_id']);
            if($member_extend_model!==false){
                $param['account_pay']=$member_extend_model->getAccountPay();
                $param['account_wx']=$member_extend_model->getAccountWx();
                $param['account_bank']=$member_extend_model->getAccountBank();
                $param['bank_type']=$member_extend_model->getBankType();
                $param['bank_class']=$member_extend_model->getBankClass();
                $param['bank_name']=$member_extend_model->getBankName();
                $param['bank_address']=$member_extend_model->getBankAddress();
            }

            $data['list'][$value['member_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 导出奖金发放单
     */
    public function export_step1Action()
    {
        $query = Member::query();
        if ($_GET['id'] != '') {
            $id_array = explode(',', $_GET['id']);
            $query->inWhere('member_id', $id_array);
        }

        //人被封号就不发放奖金了
        $query->where('member_state = :member_state:', array('member_state' => 1));
        $query->andWhere('(member_straight_money_sum > 0 OR member_collision_sum_money > 0 OR member_commission_money_sum > 0 OR store_share_benefits_money_sum > 0 OR store_straight_money_sum > 0 OR store_collision_sum_money > 0 OR store_commission_money_sum > 0)');
        if ($_GET['member_name']) {
            $query->where('member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $query->andWhere('member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_GET['query'] != '') {
            $query->andWhere($_GET['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_GET['query'] . '%'));
        }
        $model_member = new Member();
        $metadata = $model_member->getModelsMetaData();
        $param = $metadata->getAttributes($model_member);
        if (in_array($_GET['sortname'], $param) && in_array($_GET['sortorder'], array('asc', 'desc'))) {
            $order = $_GET['sortname'] . ' ' . $_GET['sortorder'];
            $query->orderBy($order);
        }

        if (!is_numeric($_GET['curpage'])) {
            $count = Member::count(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            $array = array();
            if ($count > self::EXPORT_SIZE) {   //显示下载链接
                $page = ceil($count / self::EXPORT_SIZE);
                for ($i = 1; $i <= $page; $i++) {
                    $limit1 = ($i - 1) * self::EXPORT_SIZE + 1;
                    $limit2 = $i * self::EXPORT_SIZE > $count ? $count : $i * self::EXPORT_SIZE;
                    $array[$i] = $limit1 . ' ~ ' . $limit2;
                }
                $this->view->setVar('list', $array);
                $this->view->setVar('murl', getUrl('shop_manager/reward_giveout/index'));
                $this->view->pick('common/export_excel');

            } else {  //如果数量小，直接下载
                $giveout = $query->execute();
                $giveout = $giveout->toArray();

                $this->createExcel($giveout);
                $this->view->disable();
                exit;
            }
        } else {  //下载
            $offset = ($_GET['curpage'] - 1) * self::EXPORT_SIZE;
            $limit = self::EXPORT_SIZE;
            $giveout = $query->limit($limit, $offset)->execute();
            $giveout = $giveout->toArray();

            $this->createExcel($giveout);
            $this->view->disable();
            exit;
        }
    }

    /**
     * 生成导出奖金发放的excel
     *
     * @param array $data
     */
    private function createExcel($data = array())
    {

        getTranslation('export');

        $excel_obj = new Excel();

        $excel_data = array();

        //header
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '会员ID');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '会员名称');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '客户树直荐奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '客户树积分碰撞奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '客户树分佣奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树分利所得（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树直荐奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树积分碰撞奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树分佣奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '月总计（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '账户总计（元）');

        //上个月15号
        $start_time = strtotime(date('Y-m-15 00:00:00') . ' -1 month');
        //这个月14号
        $end_time = strtotime(date('Y-m-14 23:59:59'));
        
        foreach ((array)$data as $k => $v) {
            //该会员也可能其他月的奖金没有发放完
            $total = $v['member_straight_money_sum'] + $v['member_collision_sum_money'] + $v['member_commission_money_sum'] + $v['store_share_benefits_money_sum'] + $v['store_straight_money_sum'] + $v['store_collision_sum_money'] + $v['store_commission_money_sum'];
            if ($total <= 0) {
                //如果该会员账户奖金总和合计为零，说明奖金已经发放完毕，不进行显示和发放
                continue;
            }
            $tmp = array();
            $tmp[] = array('data' => $v['member_id']);
            $tmp[] = array('data' => $v['member_name']);

            //客户树直荐奖（元）
            $query_member_straight_log = MemberStraightLog::query();
            $query_member_straight_log->columns(array('SUM(member_straight_money) as sum_money'));
            $query_member_straight_log->where('member_tree_type = 0');
            $query_member_straight_log->andWhere('member_id = ' . $v['member_id']);
            $query_member_straight_log->betweenWhere('add_time', $start_time, $end_time);
            $member_straight_log = $query_member_straight_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($member_straight_log[0]['sum_money']));

            //客户树积分碰撞奖（元）
            $query_member_points_collision_log = MemberPointsCollisionLog::query();
            $query_member_points_collision_log->columns(array('SUM(member_collision_money) as sum_money'));
            $query_member_points_collision_log->where('collision_log_type = 0');
            $query_member_points_collision_log->andWhere('member_id = ' . $v['member_id']);
            $query_member_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
            $member_points_collision_log = $query_member_points_collision_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($member_points_collision_log[0]['sum_money']));

            //客户树分佣奖（元）
            $query_member_commission_log = MemberCommissionLog::query();
            $query_member_commission_log->columns(array('SUM(member_tree_commission_money) as sum_money'));
            $query_member_commission_log->where('commission_tree_type = 0');
            $query_member_commission_log->andWhere('member_id = ' . $v['member_id']);
            $query_member_commission_log->betweenWhere('add_time', $start_time, $end_time);
            $member_commission_log = $query_member_commission_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($member_commission_log[0]['sum_money']));

            //医护人员树分利所得（元）
            $query_store_share_benefits_log = MemberShareBenefitsLog::query();
            $query_store_share_benefits_log->columns(array('SUM(share_benefits_money) as sum_money'));
            $query_store_share_benefits_log->where('member_id = ' . $v['member_id']);
            $query_store_share_benefits_log->betweenWhere('add_time', $start_time, $end_time);
            $store_share_benefits_log = $query_store_share_benefits_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($store_share_benefits_log[0]['sum_money']));

            //医护人员树直荐奖（元）
            $query_store_straight_log = MemberStraightLog::query();
            $query_store_straight_log->columns(array('SUM(store_straight_money) as sum_money'));
            $query_store_straight_log->where('member_tree_type = 1');
            $query_store_straight_log->andWhere('member_id = ' . $v['member_id']);
            $query_store_straight_log->betweenWhere('add_time', $start_time, $end_time);
            $store_straight_log = $query_store_straight_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($store_straight_log[0]['sum_money']));

            //医护人员树积分碰撞奖（元）
            $query_store_points_collision_log = MemberPointsCollisionLog::query();
            $query_store_points_collision_log->columns(array('SUM(store_collision_money) as sum_money'));
            $query_store_points_collision_log->where('collision_log_type = 1');
            $query_store_points_collision_log->andWhere('member_id = ' . $v['member_id']);
            $query_store_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
            $store_points_collision_log = $query_store_points_collision_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($store_points_collision_log[0]['sum_money']));

            //医护人员树分佣奖（元）
            $query_store_commission_log = MemberCommissionLog::query();
            $query_store_commission_log->columns(array('SUM(store_tree_commission_money) as sum_money'));
            $query_store_commission_log->where('commission_tree_type = 1');
            $query_store_commission_log->andWhere('member_id = ' . $v['member_id']);
            $query_store_commission_log->betweenWhere('add_time', $start_time, $end_time);
            $store_commission_log = $query_store_commission_log->execute()->toArray();
            $tmp[] = array('data' => ncPriceFormat($store_commission_log[0]['sum_money']));

            //总计（元）
            $tmp[] = array('data' => ncPriceFormat($member_straight_log[0]['sum_money'] + $member_points_collision_log[0]['sum_money'] + $member_commission_log[0]['sum_money'] + $store_share_benefits_log[0]['sum_money'] + $store_straight_log[0]['sum_money'] + $store_points_collision_log[0]['sum_money'] + $store_commission_log[0]['sum_money']));
            $tmp[] = array('data' => ncPriceFormat($total));

            $excel_data[] = $tmp;
        }
        $excel_data = $excel_obj->charset($excel_data, CHARSET);
        $curpage_name = '';
        if (!empty($_GET['curpage'])) {
            $curpage_name = $_GET['curpage'] . '-';
        }
        $excel_obj->generateXLS('奖金发放单-' . $curpage_name . date('Y-m-d-H', time()), $excel_data);
    }

    /**
     * 输出奖金发放日志XML数据
     */
    public function get_log_xmlAction()
    {
        $query = MemberRewardGiveoutLog::query();
        if ($_GET['member_name']) {
            $query->where('member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $query->andWhere('member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_POST['query'] != '') {
            $query->andWhere($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $query->betweenWhere('add_time', $start_unixtime, $end_unixtime);
        }

        $model_member_reward_giveout_log = new MemberRewardGiveoutLog();
        $metadata = $model_member_reward_giveout_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_member_reward_giveout_log);
        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $query->orderBy($order);
        }

        $page = $_POST['rp']; //页容量
        $now_page = $_POST['curpage'];

        $total_num = MemberRewardGiveoutLog::count(array(
            "conditions" => $query->getConditions(),
            "bind" => getBind($query)
        ));
        $reward_log_list = $query->limit($page, (($now_page - 1) * $page))->execute();
        if (count($reward_log_list->toArray()) > 0) {
            $reward_log_list = $reward_log_list->toArray();
        } else {
            $reward_log_list = array();
        }

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($reward_log_list as $value) {
            $param = array();
            $param['member_id'] = $value['member_id'];
            $param['member_avatar'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            $param['member_straight_money_sum'] = ncPriceFormat($value['member_straight_money_sum']);
            $param['member_collision_sum_money'] = ncPriceFormat($value['member_collision_sum_money']);
            $param['member_commission_money_sum'] = ncPriceFormat($value['member_commission_money_sum']);
            $param['store_share_benefits_money_sum'] = ncPriceFormat($value['store_share_benefits_money_sum']);
            $param['store_straight_money_sum'] = ncPriceFormat($value['store_straight_money_sum']);
            $param['store_collision_sum_money'] = ncPriceFormat($value['store_collision_sum_money']);
            $param['store_commission_money_sum'] = ncPriceFormat($value['store_commission_money_sum']);
            $param['month_total'] = ncPriceFormat($value['month_total']);
            $param['add_time'] = date('Y-m-d H:i:s', $value['add_time']);
            $data['list'][$value['id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit();
    }

    /**
     * 导出奖金发放记录
     */
    public function export_log_step1Action()
    {
        $query = MemberRewardGiveoutLog::query();
        if ($_GET['id'] != '') {
            $id_array = explode(',', $_GET['id']);
            $query->inWhere('id', $id_array);
        }

        if ($_GET['member_name']) {
            $query->where('member_name LIKE :member_name:', array('member_name' => '%' . $_GET['member_name'] . '%'));
        }
        if ($_GET['member_id']) {
            $query->andWhere('member_id LIKE :member_id:', array('member_id' => '%' . $_GET['member_id'] . '%'));
        }
        if ($_GET['query'] != '') {
            $query->andWhere($_GET['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_GET['query'] . '%'));
        }

        $if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_start_date']);
        $if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/', $_GET['query_end_date']);
        $start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : strtotime('1970-01-01');
        $end_unixtime = $if_end_date ? strtotime($_GET['query_end_date'] . ' 23:59:59') : time();
        if ($start_unixtime || $end_unixtime) {
            $query->betweenWhere('add_time', $start_unixtime, $end_unixtime);
        }

        $model_member_reward_giveout_log = new MemberRewardGiveoutLog();
        $metadata = $model_member_reward_giveout_log->getModelsMetaData();
        $param = $metadata->getAttributes($model_member_reward_giveout_log);
        if (in_array($_GET['sortname'], $param) && in_array($_GET['sortorder'], array('asc', 'desc'))) {
            $order = $_GET['sortname'] . ' ' . $_GET['sortorder'];
            $query->orderBy($order);
        }

        if (!is_numeric($_GET['curpage'])) {
            $count = MemberRewardGiveoutLog::count(array(
                "conditions" => $query->getConditions(),
                "bind" => getBind($query)
            ));
            $array = array();
            if ($count > self::EXPORT_SIZE) {   //显示下载链接
                $page = ceil($count / self::EXPORT_SIZE);
                for ($i = 1; $i <= $page; $i++) {
                    $limit1 = ($i - 1) * self::EXPORT_SIZE + 1;
                    $limit2 = $i * self::EXPORT_SIZE > $count ? $count : $i * self::EXPORT_SIZE;
                    $array[$i] = $limit1 . ' ~ ' . $limit2;
                }
                $this->view->setVar('list', $array);
                $this->view->setVar('murl', getUrl('shop_manager/reward_giveout/reward_giveout_log'));
                $this->view->pick('common/export_excel');

            } else {  //如果数量小，直接下载
                $giveout_log = $query->execute();
                $giveout_log = $giveout_log->toArray();

                $this->createLogExcel($giveout_log);
                $this->view->disable();
                exit;
            }
        } else {  //下载
            $offset = ($_GET['curpage'] - 1) * self::EXPORT_SIZE;
            $limit = self::EXPORT_SIZE;
            $giveout_log = $query->limit($limit, $offset)->execute();
            $giveout_log = $giveout_log->toArray();

            $this->createLogExcel($giveout_log);
            $this->view->disable();
            exit;
        }
    }

    /**
     * 生成导出奖金发放记录的excel
     *
     * @param array $data
     */
    private function createLogExcel($data = array())
    {

        getTranslation('export');

        $excel_obj = new Excel();

        $excel_data = array();

        //header
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '会员ID');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '会员名称');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '客户树直荐奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '客户树积分碰撞奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '客户树分佣奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树分利所得（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树直荐奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树积分碰撞奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '医护人员树分佣奖（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '总计（元）');
        $excel_data[0][] = array('styleid' => 's_title', 'data' => '发放时间');
        foreach ((array)$data as $k => $v) {
            $tmp = array();
            $tmp[] = array('data' => $v['member_id']);
            $tmp[] = array('data' => $v['member_name']);
            $tmp[] = array('data' => ncPriceFormat($v['member_straight_money_sum']));
            $tmp[] = array('data' => ncPriceFormat($v['member_collision_sum_money']));
            $tmp[] = array('data' => ncPriceFormat($v['member_commission_money_sum']));
            $tmp[] = array('data' => ncPriceFormat($v['store_share_benefits_money_sum']));
            $tmp[] = array('data' => ncPriceFormat($v['store_straight_money_sum']));
            $tmp[] = array('data' => ncPriceFormat($v['store_collision_sum_money']));
            $tmp[] = array('data' => ncPriceFormat($v['store_commission_money_sum']));
            $tmp[] = array('data' => ncPriceFormat($v['month_total']));
            $tmp[] = array('data' => date('Y-m-d H:i:s', $v['add_time']));
            $excel_data[] = $tmp;
        }
        $excel_data = $excel_obj->charset($excel_data, CHARSET);
        $curpage_name = '';
        if (!empty($_GET['curpage'])) {
            $curpage_name = $_GET['curpage'] . '-';
        }
        $excel_obj->generateXLS('奖金发放记录-' . $curpage_name . date('Y-m-d-H', time()), $excel_data);
    }

    /**
     * 执行发放奖金命令
     */
    public function do_reward_giveoutAction()
    {
        $member_id = $_GET['id'];
        if ($member_id < 1) {
            $this->showDialog('参数错误');
        }

        $member = Member::findFirst('member_id = ' . $member_id);
        if ($member === false) {
            $this->showDialog('用户不存在');
        }

        if ($member->getMemberState() == 0) {
            $this->showDialog('该用户已被关闭');
        }

        //上个月15号
        $start_time = strtotime(date('Y-m-15 00:00:00') . ' -1 month');
        //这个月14号
        $end_time = strtotime(date('Y-m-14 23:59:59'));

        //该会员也可能其他月的奖金没有发放完
        $total = $member->getMemberStraightMoneySum() + $member->getMemberCollisionSumMoney() + $member->getMemberCommissionMoneySum() + $member->getStoreShareBenefitsMoneySum() + $member->getStoreStraightMoneySum() + $member->getStoreCollisionSumMoney() + $member->getStoreCommissionMoneySum();
        if ($total <= 0) {
            //如果该会员账户奖金总和合计为零，说明奖金已经发放完毕，不进行显示和发放
            $this->showDialog('该用户账户奖金合计为零');
        }
        $param = array();
        $param['member_id'] = $member->getMemberId();
        $param['member_avatar'] = "<img width='30' style='margin-right:10px;' src=" . getMemberAvatarForID($member->getMemberId()) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($member->getMemberId()) . ">\")'>" . $member->getMemberName();
        //客户树直荐奖（元）
        $query_member_straight_log = MemberStraightLog::query();
        $query_member_straight_log->columns(array('SUM(member_straight_money) as sum_money'));
        $query_member_straight_log->where('member_tree_type = 0');
        $query_member_straight_log->andWhere('member_id = ' . $member->getMemberId());
        $query_member_straight_log->betweenWhere('add_time', $start_time, $end_time);
        $member_straight_log = $query_member_straight_log->execute()->toArray();
        //客户树积分碰撞奖（元）
        $query_member_points_collision_log = MemberPointsCollisionLog::query();
        $query_member_points_collision_log->columns(array('SUM(member_collision_money) as sum_money'));
        $query_member_points_collision_log->where('collision_log_type = 0');
        $query_member_points_collision_log->andWhere('member_id = ' . $member->getMemberId());
        $query_member_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
        $member_points_collision_log = $query_member_points_collision_log->execute()->toArray();
        //客户树分佣奖（元）
        $query_member_commission_log = MemberCommissionLog::query();
        $query_member_commission_log->columns(array('SUM(member_tree_commission_money) as sum_money'));
        $query_member_commission_log->where('commission_tree_type = 0');
        $query_member_commission_log->andWhere('member_id = ' . $member->getMemberId());
        $query_member_commission_log->betweenWhere('add_time', $start_time, $end_time);
        $member_commission_log = $query_member_commission_log->execute()->toArray();
        //医护人员树分利所得（元）
        $query_store_share_benefits_log = MemberShareBenefitsLog::query();
        $query_store_share_benefits_log->columns(array('SUM(share_benefits_money) as sum_money'));
        $query_store_share_benefits_log->where('member_id = ' . $member->getMemberId());
        $query_store_share_benefits_log->betweenWhere('add_time', $start_time, $end_time);
        $store_share_benefits_log = $query_store_share_benefits_log->execute()->toArray();
        //医护人员树直荐奖（元）
        $query_store_straight_log = MemberStraightLog::query();
        $query_store_straight_log->columns(array('SUM(store_straight_money) as sum_money'));
        $query_store_straight_log->where('member_tree_type = 1');
        $query_store_straight_log->andWhere('member_id = ' . $member->getMemberId());
        $query_store_straight_log->betweenWhere('add_time', $start_time, $end_time);
        $store_straight_log = $query_store_straight_log->execute()->toArray();
        //医护人员树积分碰撞奖（元）
        $query_store_points_collision_log = MemberPointsCollisionLog::query();
        $query_store_points_collision_log->columns(array('SUM(store_collision_money) as sum_money'));
        $query_store_points_collision_log->where('collision_log_type = 1');
        $query_store_points_collision_log->andWhere('member_id = ' . $member->getMemberId());
        $query_store_points_collision_log->betweenWhere('add_time', $start_time, $end_time);
        $store_points_collision_log = $query_store_points_collision_log->execute()->toArray();
        //医护人员树分佣奖（元）
        $query_store_commission_log = MemberCommissionLog::query();
        $query_store_commission_log->columns(array('SUM(store_tree_commission_money) as sum_money'));
        $query_store_commission_log->where('commission_tree_type = 1');
        $query_store_commission_log->andWhere('member_id = ' . $member->getMemberId());
        $query_store_commission_log->betweenWhere('add_time', $start_time, $end_time);
        $store_commission_log = $query_store_commission_log->execute()->toArray();

        //总计（元）
        $param['month_total_log'] = ncPriceFormat($member_straight_log[0]['sum_money'] + $member_points_collision_log[0]['sum_money'] + $member_commission_log[0]['sum_money'] + $store_share_benefits_log[0]['sum_money'] + $store_straight_log[0]['sum_money'] + $store_points_collision_log[0]['sum_money'] + $store_commission_log[0]['sum_money']);
        $param['total'] = ncPriceFormat($total);
        if (chksubmit()) {
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["month_total"], "require" => "true", 'validator' => 'double', "message" => "奖金发放金额必须是数字"),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showDialog($error);
            }
            if ($_POST["month_total"] <= 0) {
                $this->showDialog('发放金额必须大于零');
            }
            if ($_POST["month_total"] > $param['total']) {
                $this->showDialog('发放金额不能大于会员账户总计');
            }

            $giveout_data = array();
            if ($_POST["month_total"] > $member->getMemberStraightMoneySum()) {
                $giveout_data['member_straight_money_sum'] = $member->getMemberStraightMoneySum();
                $_POST["month_total"] = $_POST["month_total"] - $member->getMemberStraightMoneySum();
            } else {
                $giveout_data['member_straight_money_sum'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }
            if ($_POST["month_total"] > $member->getMemberCollisionSumMoney()) {
                $giveout_data['member_collision_sum_money'] = $member->getMemberCollisionSumMoney();
                $_POST["month_total"] = $_POST["month_total"] - $member->getMemberCollisionSumMoney();
            } else {
                $giveout_data['member_collision_sum_money'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }
            if ($_POST["month_total"] > $member->getMemberCommissionMoneySum()) {
                $giveout_data['member_commission_money_sum'] = $member->getMemberCommissionMoneySum();
                $_POST["month_total"] = $_POST["month_total"] - $member->getMemberCommissionMoneySum();
            } else {
                $giveout_data['member_commission_money_sum'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }
            if ($_POST["month_total"] > $member->getStoreShareBenefitsMoneySum()) {
                $giveout_data['store_share_benefits_money_sum'] = $member->getStoreShareBenefitsMoneySum();
                $_POST["month_total"] = $_POST["month_total"] - $member->getStoreShareBenefitsMoneySum();
            } else {
                $giveout_data['store_share_benefits_money_sum'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }
            if ($_POST["month_total"] > $member->getStoreStraightMoneySum()) {
                $giveout_data['store_straight_money_sum'] = $member->getStoreStraightMoneySum();
                $_POST["month_total"] = $_POST["month_total"] - $member->getStoreStraightMoneySum();
            } else {
                $giveout_data['store_straight_money_sum'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }
            if ($_POST["month_total"] > $member->getStoreCollisionSumMoney()) {
                $giveout_data['store_collision_sum_money'] = $member->getStoreCollisionSumMoney();
                $_POST["month_total"] = $_POST["month_total"] - $member->getStoreCollisionSumMoney();
            } else {
                $giveout_data['store_collision_sum_money'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }
            if ($_POST["month_total"] > $member->getStoreCommissionMoneySum()) {
                $giveout_data['store_commission_money_sum'] = $member->getStoreCommissionMoneySum();
                $_POST["month_total"] = $_POST["month_total"] - $member->getStoreCommissionMoneySum();
            } else {
                $giveout_data['store_commission_money_sum'] = $_POST["month_total"];
                $_POST["month_total"] = 0;
            }

            while (true) {
                $member = Member::findFirst('member_id = ' . $member->getMemberId());
                $new_member_straight_money_sum = $member->getMemberStraightMoneySum() - $giveout_data['member_straight_money_sum'];
                $new_member_collision_sum_money = $member->getMemberCollisionSumMoney() - $giveout_data['member_collision_sum_money'];
                $new_member_commission_money_sum = $member->getMemberCommissionMoneySum() - $giveout_data['member_commission_money_sum'];
                $new_store_share_benefits_money_sum = $member->getStoreShareBenefitsMoneySum() - $giveout_data['store_share_benefits_money_sum'];
                $new_store_straight_money_sum = $member->getStoreStraightMoneySum() - $giveout_data['store_straight_money_sum'];
                $new_store_collision_sum_money = $member->getStoreCollisionSumMoney() - $giveout_data['store_collision_sum_money'];
                $new_store_commission_money_sum = $member->getStoreCommissionMoneySum() - $giveout_data['store_commission_money_sum'];
                if ($this->db->execute("UPDATE member SET member_straight_money_sum = {$new_member_straight_money_sum}, member_collision_sum_money = {$new_member_collision_sum_money}, member_commission_money_sum = {$new_member_commission_money_sum}, store_share_benefits_money_sum = {$new_store_share_benefits_money_sum}, store_straight_money_sum = {$new_store_straight_money_sum}, store_collision_sum_money = {$new_store_collision_sum_money}, store_commission_money_sum = {$new_store_commission_money_sum} WHERE member_id = {$member->getMemberId()} AND member_straight_money_sum = {$member->getMemberStraightMoneySum()} AND member_collision_sum_money = {$member->getMemberCollisionSumMoney()} AND member_commission_money_sum = {$member->getMemberCommissionMoneySum()} AND store_share_benefits_money_sum = {$member->getStoreShareBenefitsMoneySum()} AND store_straight_money_sum = {$member->getStoreStraightMoneySum()} AND store_collision_sum_money = {$member->getStoreCollisionSumMoney()} AND store_commission_money_sum = {$member->getStoreCommissionMoneySum()}")) {
                    break;
                }
            }

            $member_reward_giveout_log_data['member_id'] = $member->getMemberId();
            $member_reward_giveout_log_data['member_name'] = $member->getMemberName();
            $member_reward_giveout_log_data['month_total'] = $_POST["month_total"];
            $member_reward_giveout_log_data['member_straight_money_sum'] = $giveout_data['member_straight_money_sum'];
            $member_reward_giveout_log_data['member_collision_sum_money'] = $giveout_data['member_collision_sum_money'];
            $member_reward_giveout_log_data['member_commission_money_sum'] = $giveout_data['member_commission_money_sum'];
            $member_reward_giveout_log_data['store_share_benefits_money_sum'] = $giveout_data['store_share_benefits_money_sum'];
            $member_reward_giveout_log_data['store_straight_money_sum'] = $giveout_data['store_straight_money_sum'];
            $member_reward_giveout_log_data['store_collision_sum_money'] = $giveout_data['store_collision_sum_money'];
            $member_reward_giveout_log_data['store_commission_money_sum'] = $giveout_data['store_commission_money_sum'];
            $member_reward_giveout_log_data['add_time'] = time();
            $member_reward_giveout_log = new MemberRewardGiveoutLog();
            if ($member_reward_giveout_log->save($member_reward_giveout_log_data) === false) {
                Log::record("添加会员member_id = {$member->getMemberId()}的奖金发放日志时添加失败，数据为：" . json_encode($member_reward_giveout_log_data));
            }

            $this->showDialog('奖金发放成功', '', 'succ', empty($_GET['inajax']) ? '' : 'CUR_DIALOG.close();');
        }
        $this->view->setVar('param', $param);
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->pick('reward_giveout/do_reward_giveout');
    }
}
