<?php
/**
 * 前台会员中心——账户概览
 * User: Administrator
 * Date: 2016/11/26
 * Time: 21:18
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Model;
use Ypk\Models\Member;
use Ypk\Models\MemberPointsCollisionLog;
use Ypk\Models\PointsLog;
use Ypk\QueueClient;
use Ypk\Tpl;
use Ypk\UploadFile;

class MemberController extends BaseMemberController
{

    public function homeAction()
    {
        $this->view->render('member', 'member_home');
        $this->view->disable();
    }

    /**
     * 异步加载会员信息
     */
    public function ajax_load_member_infoAction()
    {

        $member_info = $this->member_info;
        $member_info['security_level'] = Model('member')->getMemberSecurityLevel($member_info);

        //代金券数量
        $member_info['voucher_count'] = Model('voucher')->getCurrentAvailableVoucherCount(getSession('member_id'));
        Tpl::output('home_member_info', $member_info);

        //Tpl::showpage('member_home.member_info','null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'member_home_member_info');
        $this->view->disable();
    }

    /**
     * 异步加载订单信息
     */
    public function ajax_load_order_infoAction()
    {
        $model_order = Model('order');

        //交易提醒 - 显示数量
        $member_info['order_nopay_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'NewCount');
        $member_info['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'SendCount');
        $member_info['order_noeval_count'] = $model_order->getOrderCountByID('buyer', getSession('member_id'), 'EvalCount');
        Tpl::output('home_member_info', $member_info);

        //交易提醒 - 显示订单列表
        $condition = array();
        $condition['buyer_id'] = getSession('member_id');
        $condition['order_state'] = array('in', array(ORDER_STATE_NEW, ORDER_STATE_PAY, ORDER_STATE_SEND, ORDER_STATE_SUCCESS));
        $order_list = $model_order->getNormalOrderList($condition, '', '*', 'order_id desc', 3, array('order_goods'));

        foreach ($order_list as $order_id => $order) {
            //显示物流跟踪
            $order_list[$order_id]['if_deliver'] = $model_order->getOrderOperateState('deliver', $order);
            //显示评价
            $order_list[$order_id]['if_evaluation'] = $model_order->getOrderOperateState('evaluation', $order);
            //显示支付
            $order_list[$order_id]['if_payment'] = $model_order->getOrderOperateState('payment', $order);
            //显示收货
            $order_list[$order_id]['if_receive'] = $model_order->getOrderOperateState('receive', $order);
        }

        Tpl::output('order_list', $order_list);

        //取出购物车信息
        $model_cart = Model('cart');
        $cart_list = $model_cart->listCart('db', array('buyer_id' => getSession('member_id')), 3);
        Tpl::output('cart_list', $cart_list);
        //Tpl::showpage('member_home.order_info','null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'member_home_order_info');
        $this->view->disable();
    }

    /**
     * 异步加载商品信息
     */
    public function ajax_load_goods_infoAction()
    {
        //商品收藏
        $favorites_model = Model('favorites');
        $favorites_list = $favorites_model->getGoodsFavoritesList(array('member_id' => getSession('member_id')), '*', 7);
        if (!empty($favorites_list) && is_array($favorites_list)) {
            $favorites_id = array();//收藏的商品编号
            foreach ($favorites_list as $key => $fav) {
                $favorites_id[] = $fav['fav_id'];
            }
            $goods_model = Model('goods');
            $field = 'goods_id,goods_name,store_id,goods_image,goods_price,goods_promotion_price';
            $goods_list = $goods_model->getGoodsList(array('goods_id' => array('in', $favorites_id)), $field);
            Tpl::output('favorites_list', $goods_list);
        }

        //医生收藏
        $favorites_list = $favorites_model->getStoreFavoritesList(array('member_id' => getSession('member_id')), '*', 6);
        if (!empty($favorites_list) && is_array($favorites_list)) {
            $favorites_id = array();//收藏的医生编号
            foreach ($favorites_list as $key => $fav) {
                $favorites_id[] = $fav['fav_id'];
            }
            $store_model = Model('store');
            $store_list = $store_model->getStoreList(array('store_id' => array('in', $favorites_id)));
            Tpl::output('favorites_store_list', $store_list);
        }

        $goods_count_new = array();
        if (!empty($favorites_id)) {
            foreach ($favorites_id as $v) {
                $count = Model('goods')->getGoodsCommonOnlineCount(array('store_id' => $v));
                $goods_count_new[$v] = $count;
            }
        }
        Tpl::output('goods_count', $goods_count_new);
        //Tpl::showpage('member_home.goods_info','null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'member_home_goods_info');
        $this->view->disable();
    }

    /**
     * 加载“我的足迹”商品列表
     */
    public function ajax_load_sns_infoAction()
    {
        //我的足迹
        $goods_list = Model('goods_browse')->getViewedGoodsList(getSession('member_id'), 20);
        $viewed_goods = array();
        if (is_array($goods_list) && !empty($goods_list)) {
            foreach ($goods_list as $key => $val) {
                $goods_id = $val['goods_id'];
                $val['url'] = getUrl('shop/goods/index', array('goods_id' => $goods_id));
                $val['goods_image'] = thumb($val, 240);
                $viewed_goods[$goods_id] = $val;
            }
        }
        Tpl::output('viewed_goods', $viewed_goods);

        //我的圈子
        $model = Model();
        $circlemember_array = $model->table('circle_member')->where(array('member_id' => getSession('member_id')))->select();
        if (!empty($circlemember_array)) {
            $circlemember_array = array_under_reset($circlemember_array, 'circle_id');
            $circleid_array = array_keys($circlemember_array);
            $circle_list = $model->table('circle')->where(array('circle_id' => array('in', $circleid_array)))->limit(6)->select();
            Tpl::output('circle_list', $circle_list);
        }

        //好友动态
        $model_fd = Model('sns_friend');
        $fields = 'member.member_id,member.member_name,member.member_avatar';
        $follow_list = $model_fd->listFriend(array('limit' => 15, 'friend_frommid' => getSession('member_id')), $fields, '', 'detail');
        $member_ids = array();
        $follow_list_new = array();
        if (is_array($follow_list)) {
            foreach ($follow_list as $v) {
                $follow_list_new[$v['member_id']] = $v;
                $member_ids[] = $v['member_id'];
            }
        }
        $tracelog_model = Model('sns_tracelog');
        //条件
        $condition = array();
        $condition['trace_memberid'] = array('in', $member_ids);
        $condition['trace_privacy'] = 0;
        $condition['trace_state'] = 0;
        $tracelist = Model()->table('sns_tracelog')->where($condition)->field('count(*) as ccount,trace_memberid')->group('trace_memberid')->limit(5)->select();
        $tracelist_new = array();
        $follow_list = array();
        if (!empty($tracelist)) {
            foreach ($tracelist as $k => $v) {
                $tracelist_new[$v['trace_memberid']] = $v['ccount'];
                $follow_list[] = $follow_list_new[$v['trace_memberid']];
            }
        }
        Tpl::output('tracelist', $tracelist_new);
        Tpl::output('follow_list', $follow_list);
        //Tpl::showpage('member_home.sns_info','null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('no_layout', 'member_home_sns_info');
        $this->view->disable();
    }

    //================================================（客户圈）我的团队=================================================

    /**
     * 位置族谱（表格展示）
     */
    public function tableAction()
    {
        $mapStr = "";
        $member_id = $_REQUEST['member_id']; //会员id
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_info = $member_info->toArray();
            $member_wholeList = get_whole_member_tree($member_info['member_tree_id'], 3); //会员集合（包含自己）
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
                    $currTreeId = pow(2, $i) * $member_info['member_tree_id'] + ($j - 1); //计算出当前节点的treeId

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
     * 递归获取
     * @param $member_info
     * @return string
     */
    public function recursion_get($member_info)
    {
        $str = "";
        $tree_row = $member_info['member_tree_row'];
        $member_list = get_whole_member_tree($member_info['member_tree_id'], 10);
        if (count($member_list) > 0) {
            //对数组进行排序
            $temp_list = array();
            $temp_list[] = $member_info;
            foreach ($member_list as $key => $member) {
                if ($member['member_id'] == $member_info['member_id']) {
                    $temp_list[] = $member;
                    continue;
                }

                $parent_tree_id = get_one_parent($member['member_tree_id']);

                if ($member['member_tree_id'] % 2 == 0) {
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
                $str .= str_repeat('&nbsp;.&nbsp;', $member['member_tree_row'] - $tree_row);
                $str .= "<a href='" . getUrl('shop/member/tree', array('member_id' => $member['member_id'])) . "'>" . $member['member_name'] . "</a>";
                $str .= "</td>";
                $str .= "<td>";
                $str .= empty($member['member_mobile']) ? "private" : $member['member_mobile'];
                $str .= "</td>";
                $str .= "<td>";
                $str .= $member['member_points'];
                $str .= "</td>";
                $str .= "</tr>";
            }
        }
        return $str;
    }

    /**
     * 位置族谱（树状展示）
     */
    public function treeAction()
    {
        $mapStr = "";
        $member_id = $_REQUEST['member_id']; //会员id
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_info = $member_info->toArray();

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
        if (empty($mapStr)) {
            $mapStr = "<tr><td colspan='3'>暂无记录</td></tr>";
        }
        Tpl::output('mapStr', $mapStr);
    }

    /**
     * 直荐族谱（客户圈）
     */
    public function straightAction()
    {
        $mapStr = "";
        $member_id = $_REQUEST['member_id']; //会员id
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_list_first = Member::find("inviter_id=" . $member_id);
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
                    $member_list_second = Member::find('inviter_id in (' . $first_ids . ')');
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
                    $member_list_third = Member::find('inviter_id in (' . $second_ids . ')');
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
    public function memberlistAction()
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

        $member_id = $_REQUEST['member_id']; //会员id
        $member_info = Member::findFirst("member_id=" . $member_id);
        if ($member_info) {
            $member_max_row = Member::maximum(array('column' => 'member_tree_row'));
            $childs = get_whole_tree_child_ids($member_info->getMemberTreeId(), $member_max_row); //返回子树下面的用户tree_id集合
            //$childs[] = $member_id;
            if (count($childs) > 0) {
                $str_ids = implode(',', $childs);
                if (!empty($str_ids)) {
                    $totalCount = Member::count(array('conditions' => 'member_tree_id in (' . $str_ids . ')'));
                    $totalPage = ceil($totalCount / $page);
                    $member_list = Member::find(array('conditions' => 'member_tree_id in (' . $str_ids . ')', 'order' => 'member_time desc', 'limit' => array('number' => $page, 'offset' => $offset)));
                    if (count($member_list) > 0) {
                        $member_list = $member_list->toArray();
                        foreach ($member_list as $member) {
                            $mapStr .= "<tr class='item'>";
                            $mapStr .= "<td>{$member['member_id']}</td>";
                            $mapStr .= "<td>{$member['member_name']}</td>";
                            $mapStr .= "<td>" . getConfig('member_tree_level')[$member['member_tree_level']]['name'] . "</td>";
                            $mapStr .= "<td><a href='" . getUrl('shop/member/table', array('member_id' => $member['member_id'])) . "'>查看位置节点</a></td>";
                            $mapStr .= "</tr>";
                        }
                    }
                }
            }
        }
        if (empty($mapStr)) {
            $mapStr = "<tr><td colspan='4'>暂无数据记录</td></tr>";
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
    public function score_countAction()
    {
        $mapStr = "";
        //2016.09.15-2016.10.14
        //2016.10.15-2016.11.14
        //2016.11.15-2016.12.15

        $currMonth = date('m', time()); //当前月份
        $member_id = $_REQUEST['member_id']; //会员id
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

                $columns = "sum(member_left_used_points) as left_used_points,sum(member_right_used_points) as right_used_points,sum(member_collision_times) as collision_times";
                $member_log_info = MemberPointsCollisionLog::findFirst(array('conditions' => 'member_id=' . $member_id . ' and add_time between ' . $startTime . ' and ' . $endTime, "columns" => $columns));
                if ($member_log_info) {
                    $member_log_info = $member_log_info->toArray();
                    $left_used_points_sum = is_null($member_log_info['left_used_points']) ? 0 : $member_log_info['left_used_points'];
                    $right_used_points_sum = is_null($member_log_info['right_used_points']) ? 0 : $member_log_info['right_used_points'];
                    $collision_count = is_null($member_log_info['collision_times']) ? 0 : $member_log_info['collision_times'];
                    $tree_id = $member_info['member_tree_id'];
                    $max_tree_row = Member::maximum(array("column" => "member_tree_row"));
                    if (!empty($max_tree_row)) {
                        $left_child_treeIds = get_left_tree_child_ids($tree_id, $max_tree_row); //获取当前用户左区所有的treeid的集合
                        $right_child_treeIds = get_right_tree_child_ids($tree_id, $max_tree_row); //获取当前用户左区所有的treeid的集合
                        $member_left_ids = get_member_ids($left_child_treeIds, 0);
                        $member_right_ids = get_member_ids($right_child_treeIds, 0);
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
        if (empty($mapStr)) {
            $mapStr = "<tr><td colspan='8'>暂无数据记录</td></tr>";
        }
        Tpl::output('mapStr', $mapStr);
    }

    /**
     * 获取会员个人信息
     */
    public function getMemberInfoAction()
    {
        $member_id = $_REQUEST['member_id'];
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
            $str .= " <tr>";
            $str .= " <td>电话：</td > ";
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
            $str .= "<td colspan=\"2\">" . $member_info['member_points'] . "</td>";
            $str .= "</tr>";
            $str .= "<tr>";
            $str .= "<td>注册日期/升级日期：</td>";
            $str .= "<td colspan=\"2\">" . date('Y-m-d', $member_info['member_time']) . "/" . (empty($member_info['upgrade_time']) ? "private" : date('Y-m-d', $member_info['upgrade_time'])) . "</td>";
            $str .= "</tr>";
            $str .= "<tr style=\"background-color: #65d0ae;color: #fff;font-weight: bold;\">";
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
                $tempLeft = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(member_left_used_points) as member_left_used_points_sum"));
                $tempRight = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(member_right_used_points) as member_right_used_points_sum"));
                if ($tempLeft) {
                    $leftCostPoints = $tempLeft['member_left_used_points_sum'];
                }
                if ($tempRight) {
                    $rightCostPoints = $tempRight['member_right_used_points_sum'];
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
//                $tempLeft = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(member_left_used_points) as member_left_used_points_sum"));
//                $tempRight = MemberPointsCollisionLog::findFirst(array("conditions" => "member_id=" . $member_id . " and add_time between " . $startTimeStamp . " and " . $endTimeStamp . " ", "columns" => "SUM(member_right_used_points) as member_right_used_points_sum"));
//                if ($tempLeft) {
//                    $leftCostPoints = $tempLeft['member_left_used_points_sum'];
//                }
//                if ($tempRight) {
//                    $rightCostPoints = $tempRight['member_right_used_points_sum'];
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

    /**
     * 兑换码兑换
     */
    public function exchangeAction()
    {
        if (chksubmit()) {
            $data = $this->_exchange();
            exit(json_encode($data));
        } else {
            exit(json_encode(array('error' => '6', 'data' => '参数错误')));
        }
    }

    /**
     * 兑换码消费（兑换码完成兑换，订单流程走完，四大计算计算各种奖金和积分）
     */
    private function _exchange()
    {
        if (!preg_match('/^[a-zA-Z0-9]{15,18}$/', $_GET['vr_code'])) {
            return array('error' => '1', 'data' => '兑换码格式错误，请重新输入');
        }
        $model_vr_order = Model('vr_order');
        $vr_code_info = $model_vr_order->getOrderCodeInfo(array('vr_code' => $_GET['vr_code']));
        if (empty($vr_code_info) || $vr_code_info['buyer_id'] != getSession('member_id')) {
            return array('error' => '2', 'data' => '该兑换码不存在');
        }
        if ($vr_code_info['vr_state'] == '1') {
            return array('error' => '3', 'data' => '该兑换码已被使用');
        }
        if ($vr_code_info['vr_indate'] < TIMESTAMP) {
            return array('error' => '4', 'data' => '该兑换码已过期，使用截止日期为： ' . date('Y-m-d H:i:s', $vr_code_info['vr_indate']));
        }
        if ($vr_code_info['refund_lock'] > 0) {//退款锁定状态:0为正常,1为锁定(待审核),2为同意
            return array('error' => '5', 'data' => '该兑换码已申请退款，不能使用');
        }

        //更新兑换码状态
        $update = array();
        $update['vr_state'] = 1;
        $update['vr_usetime'] = TIMESTAMP;
        $update = $model_vr_order->editOrderCode($update, array('vr_code' => $_GET['vr_code']));

        //如果全部兑换完成，更新订单状态
        Logic('vr_order')->changeOrderStateSuccess($vr_code_info['order_id']);

        if ($update) { //表示兑换成功，整个订单流程完成
            //取得返回信息
            $order_info = $model_vr_order->getOrderInfo(array('order_id' => $vr_code_info['order_id']));
            if ($order_info['use_state'] == '0') { //更新使用状态
                $model_vr_order->editOrder(array('use_state' => 1), array('order_id' => $vr_code_info['order_id']));
            }

            //更新member_buy_service_num表中的提示信息
            update_member_buy_service_num($order_info);

            //todo 调用四大计算
            $order_info['goods_amount'] = $order_info['order_amount'];
            $order_info['order_type']='vr_order';
            QueueClient::push('update_points_and_reward', $order_info);

            $order_info['img_60'] = thumb($order_info, 60);
            $order_info['img_240'] = thumb($order_info, 240);
            $order_info['goods_url'] = getUrl('shop/goods/index', array('goods_id' => $order_info['goods_id']));
            $order_info['order_url'] = getUrl('shop/store_vr_order/show_order', array('order_id' => $order_info['order_id']));
            return array('error' => 0, 'data' => $order_info);
        }
    }

    /**
     * 图片上传
     */
    public function pic_uploadAction()
    {
        if (chksubmit()) {
            //上传图片
            $upload = new UploadFile();
            $upload->set('thumb_width', 500);
            $upload->set('thumb_height', 499);
            $upload->set('thumb_ext', '_small');
            $upload->set('max_size', getConfig('image_max_filesize') ? getConfig('image_max_filesize') : 1024);
            $upload->set('ifremove', true);
            $upload->set('default_dir', $_GET['uploadpath']);

            if (!empty($_FILES['_pic']['tmp_name'])) {
                $result = $upload->upfile('_pic');
                if ($result) {
                    exit(json_encode(array('status' => 1, 'url' => UPLOAD_SITE_URL . '/' . $_GET['uploadpath'] . '/' . $upload->thumb_image)));
                } else {
                    exit(json_encode(array('status' => 0, 'msg' => $upload->error)));
                }
            }
        }

        $this->view->disable();
    }
}