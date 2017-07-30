<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/27
 * Time: 10:53
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\Member;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\PointsLog;
use Ypk\Tpl;

class SellerCenterTeamController extends BaseSellerController
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('member_home_index,common,msg');
        $this->view->setVar('lang', $this->translation);
    }

    /**
     * 医护圈位置族谱（表格展示）
     */
    public function table_dcotorAction()
    {
        $mapStr = "";
        if (!empty($_REQUEST['member_id'])) {
            $member_id = $_REQUEST['member_id']; //会员id
        } else {
            $member_id = getSession('member_id'); //会员id
        }

        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_info = $member_info->toArray();
            $member_wholeList = $member_wholeList = get_whole_store_tree($member_info['store_tree_id'], 3); //会员集合（包含自己）
            $mapStr .= "<tr>";
            $mapStr .= "<th colspan=\"8\">";
            $mapStr .= "<span class=\"member\" data-id=\"" . $member_info['member_id'] . "\" data-name=\"" . $member_info['member_name'] . "\" data-typeId=\"" . $member_info['member_type_id'] . "\">";
            $mapStr .= "<div class=\"member_name\">" . $member_info['member_name'] . "</div>";
            $mapStr .= "<div class=\"member_id\">(" . $member_info['member_id'] . ")</div>";
            $mapStr .= "</span>";
            $mapStr .= "</th>";
            $mapStr .= "</tr>";
            for ($i = 1; $i <= 3; $i++) { //生成行
                $mapStr .= "<tr>";
                for ($j = 1; $j <= pow(2, $i); $j++) {  //生成单元格
                    //$currentRow = intval($member_info['member_tree_row']) + $i; //计算出当前行row值
                    //$currTreeId = pow(2, $currentRow) + ($j - 1); //计算出当前节点的treeId
                    $currTreeId = pow(2, $i) * $member_info['store_tree_id'] + ($j - 1); //计算出当前节点的treeId

                    $member_find_info = $member_wholeList[$currTreeId]; //根据treeId找到节点
                    if (!$member_find_info || empty($member_find_info)) {
                        $mapStr .= "<td colspan=\"" . pow(2, 3 - $i) . "\" class=\"member_empty\">";
                        $mapStr .= "空位";
                        $mapStr .= "</td>";
                    } else {
                        $mapStr .= "<td colspan=\"" . pow(2, 3 - $i) . "\" >";
                        $mapStr .= "<span class=\"member\" data-id=\"" . $member_find_info['member_id'] . "\" data-name=\"" . $member_find_info['member_name'] . "\" data-typeId=\"" . $member_find_info['member_type_id'] . "\">";
                        $mapStr .= "<div class=\"member_name\">" . $member_find_info['member_name'] . "</div>";
                        $mapStr .= "<div class=\"member_id\">(" . $member_find_info['member_id'] . ")</div>";
                        $mapStr .= "</span>";
                        $mapStr .= "</td>";
                    }
                }
                $mapStr .= "</tr>";
            }
        }
        Tpl::output('mapStr', $mapStr);
        Tpl::output('member_info_str', $this->getMemberInfoStr($member_id));
    }

    /**
     * 医护圈位置族谱（树状展示）
     */
    public function tree_doctorAction()
    {
        $mapStr = "";
        if (!empty($_REQUEST['member_id'])) {
            $member_id = $_REQUEST['member_id']; //会员id
        } else {
            $member_id = getSession('member_id'); //会员id
        }
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_info = $member_info->toArray();
            $member_typeId = $member_info['member_type_id']; //会员身份id
            $member_wholeList = array(); //会员集合（包含自己）

            $mapStr .= "<tr>";
            $mapStr .= "<td colspan=\"3\" style=\"text-align: left;\">{$member_info['member_name']}:{$member_info['member_id']}</td>";
            $mapStr .= "</tr>";
            $mapStr .= "<tr style=\"background-color: #65d0ae;color: #fff;font-weight: bold;\">";
            $mapStr .= "<th>会员姓名</th>";
            $mapStr .= "<th>电话</th>";
            $mapStr .= "<th>总积分数(截至到当月15日)</th>";
            $mapStr .= "</tr>";
            $tmpStr = $this->recursion_get($member_info);
            if (empty($tmpStr)) {
                $tmpStr = "<tr><td colspan='3' style='height: 150px;'>该会员暂无下级位置节点</td></tr>";
            }
            $mapStr .= $tmpStr;
        }
        Tpl::output('mapStr', $mapStr);
    }

    /**
     * 医护圈直荐族谱
     */
    public function straight_doctorAction()
    {
        $mapStr = "";
        if (!empty($_REQUEST['member_id'])) {
            $member_id = $_REQUEST['member_id']; //会员id
        } else {
            $member_id = getSession('member_id'); //会员id
        }
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_list_first = Member::find("inviter_id=" . $member_id . " and member_type_id!=1");
            if (count($member_list_first) > 0) {
                $member_list_first = $member_list_first->toArray();
                $first_ids = "";
                $second_ids = "";
                $third_ids = "";

                for ($i = 0; $i < count($member_list_first); $i++) {
                    if ($i == 0) {
                        $mapStr .= "<tr>";
                        $mapStr .= "<td rowspan=\"" . count($member_list_first) . "\">第一代</td>";
                        $mapStr .= "<td class=\"member_no\">" . $member_list_first[$i]['member_id'] . "</td>";
                        $mapStr .= "<td class=\"member_name\">" . $member_list_first[$i]['member_name'] . "</td>";
                        $mapStr .= "</tr>";
                    } else {
                        $mapStr .= "<tr>";
                        $mapStr .= "<td class=\"member_no\">" . $member_list_first[$i]['member_id'] . "</td>";
                        $mapStr .= "<td class=\"member_name\">" . $member_list_first[$i]['member_name'] . "</td>";
                        $mapStr .= "</tr>";
                    }
                    if (empty($first_ids)) {
                        $first_ids .= $member_list_first[$i]['member_id'];
                    } else {
                        $first_ids .= ',' . $member_list_first[$i]['member_id'];
                    }
                }
                if (!empty($first_ids)) {
                    $member_list_second = Member::find('inviter_id in (' . $first_ids . ') and member_type_id!=1');
                    if (count($member_list_second) > 0) {
                        $member_list_second = $member_list_second->toArray();
                        for ($i = 0; $i < count($member_list_second); $i++) {
                            if ($i == 0) {
                                $mapStr .= "<tr>";
                                $mapStr .= "<td rowspan=\"" . count($member_list_second) . "\">第二代</td>";
                                $mapStr .= "<td class=\"member_no\">" . $member_list_second[$i]['member_id'] . "</td>";
                                $mapStr .= "<td class=\"member_name\">" . $member_list_second[$i]['member_name'] . "</td>";
                                $mapStr .= "</tr>";
                            } else {
                                $mapStr .= "<tr>";
                                $mapStr .= "<td class=\"member_no\">" . $member_list_second[$i]['member_id'] . "</td>";
                                $mapStr .= "<td class=\"member_name\">" . $member_list_second[$i]['member_name'] . "</td>";
                                $mapStr .= "</tr>";
                            }
                            if (empty($second_ids)) {
                                $second_ids .= $member_list_second[$i]['member_id'];
                            } else {
                                $second_ids .= ',' . $member_list_second[$i]['member_id'];
                            }
                        }
                    }
                }
                if (!empty($second_ids)) {
                    $member_list_third = Member::find('inviter_id in (' . $second_ids . ') and member_type_id!=1');
                    if (count($member_list_third) > 0) {
                        $member_list_third = $member_list_third->toArray();
                        for ($i = 0; $i < count($member_list_third); $i++) {
                            if ($i == 0) {
                                $mapStr .= "<tr>";
                                $mapStr .= "<td rowspan=\"" . count($member_list_third) . "\">第三代</td>";
                                $mapStr .= "<td class=\"member_no\">" . $member_list_third[$i]['member_id'] . "</td>";
                                $mapStr .= "<td class=\"member_name\">" . $member_list_third[$i]['member_name'] . "</td>";
                                $mapStr .= "</tr>";
                            } else {
                                $mapStr .= "<tr>";
                                $mapStr .= "<td class=\"member_no\">" . $member_list_third[$i]['member_id'] . "</td>";
                                $mapStr .= "<td class=\"member_name\">" . $member_list_third[$i]['member_name'] . "</td>";
                                $mapStr .= "</tr>";
                            }
                        }
                    }
                }
            }
        }
        if (empty($mapStr)) {
            $mapStr = "<tr><td colspan='3'>暂无数据记录</td></tr>";
        }
        Tpl::output('mapStr', $mapStr);
    }

    /**
     * 加盟商名册
     */
    public function memberlist_doctorAction()
    {
        $mapStr = "";
        if (empty($_POST['pageIndex'])) {
            $currentPageIndex = 1;
        } else {
            $currentPageIndex = intval($_POST['pageIndex']); //表示当前请求的页码
        }
        $page = 25; //页容量
        $totalCount = 0;
        $totalPage = 0;
        $offset = $page * ($currentPageIndex - 1); //计算偏移量

        if (!empty($_REQUEST['member_id'])) {
            $member_id = $_REQUEST['member_id']; //会员id
        } else {
            $member_id = getSession('member_id'); //会员id
        }
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $store_max_row = Member::maximum(array('column' => 'store_tree_row'));
            $childs = get_whole_tree_child_ids($member_info->getStoreTreeId(), $store_max_row); //获取子树的tree_id集合
            //$childs[] = $member_id;
            if (count($childs) > 0) {
                $str_ids = implode(',', $childs);
                if (!empty($str_ids)) {
                    $totalCount = Member::count(array('conditions' => 'store_tree_id in (' . $str_ids . ')'));
                    $totalPage = ceil($totalCount / $page);
                    $member_list = Member::find(array('conditions' => 'store_tree_id in (' . $str_ids . ')', 'order' => 'member_time desc', 'limit' => array('number' => $page, 'offset' => $offset)));
                    if (count($member_list) > 0) {
                        $member_list = $member_list->toArray();
                        foreach ($member_list as $member) {
                            if ($member['member_type_id'] == 1) {
                                continue;
                            }
                            $mapStr .= "<tr class='item'>";
                            $mapStr .= "<td>{$member['member_id']}</td>";
                            $mapStr .= "<td>{$member['member_name']}</td>";
                            $mapStr .= "<td>" . getConfig('member_tree_level')[$member['member_tree_level']]['name'] . "</td>";
                            $mapStr .= "<td><a href='" . getUrl('shop/seller_center_team/table_dcotor', array('member_id' => $member['member_id'])) . "'>查看位置节点</a></td>";
                            $mapStr .= "</tr>";
                        }
                    }
                }
            }
        }
        if (empty($mapStr)) {
            $mapStr = "<tr><td colspan='4'>暂无记录</td></tr>";
        }
        if ($_POST['type'] == "ajax") {
            echo $mapStr;
            exit;
        } else {
            Tpl::output("mapStr", $mapStr);
            Tpl::output('totalPage', $totalPage);
            Tpl::output('member_id', $member_id);
        }
    }

    /**
     * 获取加盟商（即会员）列表
     */
    public function get_xmlAction()
    {
        $currentPageIndex = intval($_POST['curpage']); //表示当前请求的页码
        $page = intval($_POST['rp']); //页容量
        $offset = $page * ($currentPageIndex - 1); //计算偏移量


        $member_list = Member::find(array('limit' => array('number' => 25, '' => $offset)));
        //$member_list = Model('member')->select();
        if (count($member_list) > 0) {
            $member_list = $member_list->toArray();
        }
        $list = array();
        $data['now_page'] = $currentPageIndex;
        $data['total_num'] = Member::count();
        $data['list'] = $member_list;
        echo flexigridXML($data);
        $this->view->disable();
        exit;
    }

    /**
     * 积分统计查看
     */
    public function score_count_doctorAction()
    {
        $mapStr = "";
        //2016.09.15-2016.10.14
        //2016.10.15-2016.11.14
        //2016.11.15-2016.12.15

        $currMonth = date('m', time()); //当前月份
        if (!empty($_REQUEST['member_id'])) {
            $member_id = $_REQUEST['member_id']; //会员id
        } else {
            $member_id = getSession('member_id'); //会员id
        }
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_info = $member_info->toArray();
            for ($i = 3; $i >= 1; $i--) {
                $startDate = date('Y-m-15', strtotime('-' . $i . ' month', time()));
                $endDate = date('Y-m-14 23:59:59', strtotime('-' . ($i - 1) . ' month', time()));
                $startTime = strtotime($startDate); //开始时间戳
                $endTime = strtotime($endDate); //结束时间戳

                $left_remain_points_sum = 0; //左区剩余积分
                $right_remain_points_sum = 0; //右区剩余积分
                $left_used_points_sum = 0; //左区消耗掉的积分
                $right_used_points_sum = 0; //右区消耗掉的积分
                $left_points_sum = 0; //左区总计
                $right_points_sum = 0; //右区总计
                $collision_count = 0; //碰撞次数


                $columns = "sum(store_left_used_points) as left_used_points,sum(store_right_used_points) as right_used_points,sum(store_collision_times) as collision_times";
                $member_log_info = MemberPointsCollisionLog::findFirst(array('conditions' => 'member_id=' . $member_id . ' and add_time between ' . $startTime . ' and ' . $endTime, "columns" => $columns));
                if ($member_log_info) {
                    $member_log_info = $member_log_info->toArray();
                    if (!empty($member_log_info['left_used_points'])) {
                        $left_used_points_sum = $member_log_info['left_used_points'];
                    }
                    if (!empty($member_log_info['right_used_points'])) {
                        $right_used_points_sum = $member_log_info['right_used_points'];
                    }
                    if (!empty($member_log_info['collision_times'])) {
                        $collision_count = $member_log_info['collision_times'];
                    }

                    $tree_id = $member_info['store_tree_id'];
                    $max_tree_row = Member::maximum(array("column" => "store_tree_row"));
                    if (!empty($max_tree_row)) {
                        $left_child_treeIds = get_left_tree_child_ids($tree_id, $max_tree_row); //获取当前用户左区所有的treeid的集合
                        $right_child_treeIds = get_right_tree_child_ids($tree_id, $max_tree_row); //获取当前用户左区所有的treeid的集合
                        $member_left_ids = get_member_ids($left_child_treeIds, 1);
                        $member_right_ids = get_member_ids($right_child_treeIds, 1);
                        if (!empty($member_left_ids)) {
                            //当月该用户左子树一共获取到的积分数
                            $left_points_sum = PointsLog::sum(array("pl_memberid in (" . $member_left_ids . ") and pl_addtime between " . $startTime . " and " . $endTime, "column" => "pl_points"));
                            if (!empty($left_points_sum)) {
                                $left_remain_points_sum = $left_points_sum - $left_used_points_sum; //计算出左子树剩余积分
                            } else {
                                $left_points_sum = 0;
                            }
                        }
                        if (!empty($member_right_ids)) {
                            //当月该用户右子树一共获取到的积分数
                            $right_points_sum = PointsLog::sum(array("pl_memberid in (" . $member_right_ids . ") and pl_addtime between " . $startTime . " and " . $endTime, "column" => "pl_points"));
                            if (!empty($right_points_sum)) {
                                $right_remain_points_sum = $right_points_sum - $right_used_points_sum; //计算出右子树剩余积分
                            } else {
                                $right_points_sum = 0;
                            }
                        }

                    }
                }


                $mapStr .= "<tr>";
                $mapStr .= "<td>{$startDate}&nbsp;/&nbsp;{$endDate}</td>";
                $mapStr .= "<td>{$left_remain_points_sum}</td>";
                $mapStr .= "<td>{$right_remain_points_sum}</td>";
                $mapStr .= "<td>{$left_used_points_sum}</td>";
                $mapStr .= "<td>{$right_used_points_sum}</td>";
                $mapStr .= "<td>{$left_points_sum}</td>";
                $mapStr .= "<td>{$right_points_sum}</td>";
                $mapStr .= "<td>{$collision_count}</td>";
                $mapStr .= "</tr>";

            }
        }
        Tpl::output('mapStr', $mapStr);
    }

    /**
     * 递归获取
     * @param $member_info
     * @return string
     */
    public function recursion_get($member_info)
    {
        $str = "";
        $tree_row = $member_info['store_tree_row'];
        $member_list = get_whole_store_tree($member_info['store_tree_id'], 10);

        if (count($member_list) > 0) {
            //对数组进行排序
            $temp_list = array();
            $temp_list[] = $member_info;
            foreach ($member_list as $key => $member) {
                if ($member['member_id'] == $member_info['member_id']) {
                    $temp_list[] = $member;
                    continue;
                }
                $parent_tree_id = get_one_parent($member['store_tree_id']);
                if ($member['store_tree_id'] % 2 == 0) {
                    //左节点放在父节点的后面
                    $key = array_search($member_list[$parent_tree_id], $temp_list);
                } else {
                    //右节点放在左节点的后面
                    $key = array_search($member_list[get_left_child($parent_tree_id)], $temp_list);
                    if ($key === false) {
                        //如果左节点不存在，放在父节点的后面
                        $key = array_search($member_list[$parent_tree_id], $temp_list);
                    }
                }
                array_splice($temp_list, $key + 1, 0, array($member));
            }
            foreach ($temp_list as $member) {
                if ($member['member_id'] == $member_info['member_id']) { //排除当前节点
                    continue;
                }
                $str .= "<tr>";
                $str .= "<td class=\"member_name\">";
                $str .= str_repeat('&nbsp;.&nbsp;', $member['store_tree_row'] - $tree_row);
                $str .= "<a href='" . getUrl('shop/seller_center_team/tree_doctor', array('member_id' => $member['member_id'])) . "'>" . $member['member_name'] . "</a>";
                $str .= "</td>";
                $str .= "<td>";
                $str .= empty($member['member_mobile']) ? "private" : $member['member_mobile'];
                $str .= "</td>";
                $str .= "<td>";
                $str .= $member['store_points'];
                $str .= "</td>";
                $str .= "</tr>";
            }
        }
        return $str;
    }

    /**
     * 获取会员个人信息
     */
    public function getMemberInfoAction()
    {
        if (!empty($_REQUEST['member_id'])) {
            $member_id = $_REQUEST['member_id'];
        } else {
            $member_id = getSession('member_id');
        }
        echo $this->getMemberInfoStr($member_id);
        exit;
    }

    /**
     * 获取个人信息字符串
     * @param int $member_id 会员id
     * @return string
     */
    public function getMemberInfoStr($member_id)
    {
        $str = "";
        $member_info = Member::findFirst("member_id = " . $member_id);
        if ($member_info) {
            $member_info = $member_info->toArray();
            $str .= "<tr>";
            $str .= "<td>电话：</td >";
            $str .= "<td colspan = \"2\">" . (empty($member_info['member_mobile']) ? "private" : $member_info['member_mobile']) . "</td>";
            $str .= "</tr>";
//            $str .= "<tr>";
//            $str .= "<td>电子邮箱：</td>";
//            $str .= "<td colspan=\"2\">" . (empty($member_info['member_email']) ? "private" : $member_info['member_email']) . "</td>";
//            $str .= "</tr>";
            $str .= "<tr>";
            $str .= "<td>会员级别：</td>";
            $str .= "<td colspan=\"2\">" . getConfig('member_tree_level')[$member_info['member_tree_level']]['name'] . "</td>";
            $str .= "</tr>";
            $str .= "<tr>";
            $str .= "<td>账户积分累计：</td>";
            $str .= "<td colspan=\"2\">" . $member_info['store_points'] . "</td>";
            $str .= "</tr>";
            $str .= "<tr>";
            $str .= "<td>注册日期/升级日期：</td>";
            $str .= "<td colspan=\"2\">" . date('Y-m-d', $member_info['member_time']) . "/" . (empty($member_info['upgrade_time']) ? "private" : date('Y-m-d', $member_info['upgrade_time'])) . "</td>";
            $str .= "</tr>";
            $str .= "<tr style=\"background-color:#65d0ae;color: #fff;font-weight: bold;\">";
            $str .= "<td>周期</td>";
            $str .= "<td>左区消费积分</td>";
            $str .= "<td>右区消费积分</td>";
            $str .= "</tr>";
            //向前查找三个月的积分消耗情况
            //2016.09.15-2016.10.15
            //2016.10.15-2016.11.14
            //2016.11.15-2016.12.14
            $currMonth = date('m', time()); //获取当前月份
            for ($i = 3; $i > 0; $i--) {
                $startDate = date('Y-m-15', strtotime('-' . $i . ' month')); //开始月份
                $endDate = date('Y-m-14', strtotime('-' . ($i - 1) . ' month')); //结束月份
                $startTimeStamp = strtotime($startDate);
                $endTimeStamp = strtotime(date('Y-m-14 23:59:59', strtotime('-' . ($i - 1) . ' month')));
                $leftCostPoints = 0; //当月左区消耗的总积分
                $rightCostPoints = 0; //当月右区消耗的总积分
                $tempLeft = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(store_left_used_points) as store_left_used_points_sum"));
                $tempRight = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(store_right_used_points) as store_right_used_points_sum"));
                if ($tempLeft) {
                    $leftCostPoints = $tempLeft['store_left_used_points_sum'];
                }
                if ($tempRight) {
                    $rightCostPoints = $tempRight['store_right_used_points_sum'];
                }
                $str .= "<tr>";
                $str .= "<td>" . $startDate . "-" . $endDate . "</td>";
                $str .= "<td>" . (empty($leftCostPoints) ? 0 : $leftCostPoints) . "</td>";
                $str .= "<td>" . (empty($rightCostPoints) ? 0 : $rightCostPoints) . "</td>";
                $str .= "</tr>";
            }


//            $startMonth = $currMonth - 3; //开始月份
//            $endMonth = $currMonth; //结束月份
//            for ($month = $startMonth; $month < $endMonth; $month++) {
//                $startDate = date('Y.' . $month . '.15'); //开始时间
//                $endDate = date('Y.' . ($month + 1) . '.14'); //结束时间
//                $startTimeStamp = strtotime(date('Y-' . $month . '-15 00:00:00')); //开始时间的时间戳
//                $endTimeStamp = strtotime(date('Y-' . $month . '-14 23:59:59', strtotime('+1 month'))); //结束时间的时间戳
//
//                $leftCostPoints = 0; //当月左区消耗的总积分
//                $rightCostPoints = 0; //当月右区消耗的总积分
//                $tempLeft = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(store_left_used_points) as store_left_used_points_sum"));
//                $tempRight = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(store_right_used_points) as store_right_used_points_sum"));
//                if ($tempLeft) {
//                    $leftCostPoints = $tempLeft['store_left_used_points_sum'];
//                }
//                if ($tempRight) {
//                    $rightCostPoints = $tempRight['store_right_used_points_sum'];
//                }
//                $str .= "<tr>";
//                $str .= "<td>" . $startDate . "-" . $endDate . "</td>";
//                $str .= "<td>" . (empty($leftCostPoints) ? 0 : $leftCostPoints) . "</td>";
//                $str .= "<td>" . (empty($rightCostPoints) ? 0 : $rightCostPoints) . "</td>";
//                $str .= "</tr>";
//            }
        }
        return $str;
    }
}