<?php
/**
 * 医生发布服务的购买记录
 * User: Administrator
 * Date: 2016/12/27
 * Time: 17:45
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\Goods;
use Ypk\Models\Member;
use Ypk\Models\MemberBuyServiceNum;
use Ypk\Models\VrOrder;
use Ypk\Models\VrOrderCode;
use Ypk\Tpl;

class ServiceBuyRecordController extends BaseSellerController
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('member_home_index,common,msg');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        //获取医生发布的正常的并且未过时的服务
        $option_list = "";
        $goods_list = Goods::find("gc_id_1=1073 and doctor_id=" . getSession('member_id') . " and goods_state=1 and goods_verify=1 and doctor_service_end_time>=" . time());
        if (count($goods_list) > 0) {
            $goods_list = $goods_list->toArray();
            foreach ($goods_list as $goods_info) {
                $option_list .= "<option value=\"" . $goods_info['goods_id'] . "\">" . $goods_info['goods_name'] . "</option>";
            }
        }

        Tpl::output('option_list', $option_list);
    }

    /**
     * ajax获取列表数据
     */
    public function ajax_listAction()
    {
        $goods_id = $_REQUEST['serviceId']; //服务id
        $str = "";
        if (!empty($goods_id)) {
            if (intval($goods_id) == -1) {
                $member_buy_service_info_list = MemberBuyServiceNum::find("doctor_id=" . getSession('member_id') . " and is_use=1 and end_time>=" . time());
            } else {
                $member_buy_service_info_list = MemberBuyServiceNum::find("goods_id={$goods_id} and doctor_id=" . getSession('member_id') . " and is_use=1 and end_time>=" . time());
            }

            $str = $this->getListStr($member_buy_service_info_list);
        }
        if (empty($str)) {
            $str = "<tr><td colspan=\"9\">暂无购买记录</td></tr>";
        }
        echo $str;
        exit;
    }

    /**
     * 拼接字符串
     * @param $member_buy_service_info_list
     * @return string
     */
    public function getListStr($member_buy_service_info_list)
    {
        $str = "";
        if (count($member_buy_service_info_list) > 0) {
            $member_buy_service_info_list = $member_buy_service_info_list->toArray();
            foreach ($member_buy_service_info_list as $member_buy_service_info) {
                $goods_id = $member_buy_service_info['goods_id'];
                $goods_info = Goods::findFirst("goods_id=" . $goods_id);
                if ($goods_info === false) {
                    continue;
                }
                $member_info = Member::findFirst("member_id=" . $member_buy_service_info['buyer_id']);
                if ($member_info === false) {
                    continue;
                }
                $str .= "<tr id='" . $member_buy_service_info['id'] . "' data-goodsid='" . $goods_info->getGoodsId() . "'>";
                $str .= "<td>" . $goods_info->getGoodsName() . "</td>"; //服务名称
                $str .= "<td>" . $member_info->getMemberName() . "</td>"; //购买人
                $str .= "<td>" . date('Y-m-d H:i:s', $member_buy_service_info['add_time']) . "</td>"; //购买时间
                $str .= "<td>" . $member_buy_service_info['buyer_number'] . "</td>"; //编号
                $str .= "<td>" . date('Y-m-d H:i:s', $member_buy_service_info['start_time']) . "</td>"; //服务开始时间
                $str .= "<td>" . date('Y-m-d H:i:s', $member_buy_service_info['end_time']) . "</td>"; //服务结束时间
                $str .= "<td class='is_exchange'>" . ($member_buy_service_info['is_exchange'] == 0 ? "<span>否</span>" : "<span style='color: green;font-weight: bold;'>是</span>") . "</td>"; //是否已经兑换服务

                $order_sn = $member_buy_service_info['order_sn'];
                $vr_order = VrOrder::findFirst("order_sn=" . $order_sn);
                if (!empty($order_sn) && intval($member_buy_service_info['is_exchange']) !== 0) {
                    if ($vr_order !== false) {
                        $vr_order_code = VrOrderCode::findFirst("order_id=" . $vr_order->getOrderId());
                        if ($vr_order_code !== false) {
                            $vr_code = "<span style='color: green;font-weight: bold;'>" . $vr_order_code->getVrCode() . "";
                        }
                    }
                } else {
                    $vr_code = "尚无兑换";
                }
                $str .= "<td class='vr_code'>" . ($vr_code) . "</td>"; //兑换码
                $str .= "<td style='width: 100px;'>" . $vr_order->getBuyerMsg() . "</td>"; //买家留言
                $str .= "</tr>";
            }
        }
        return $str;
    }

    /**
     * 检测服务是否有新的购买记录
     */
    public function check_buyAction()
    {
        $str = "";
        $member_buy_service_info_list = MemberBuyServiceNum::find("doctor_id=" . getSession('member_id') . " and is_use=1 and is_new=1 and is_exchange=1 and end_time>=" . time());
        if (count($member_buy_service_info_list) > 0) {
            foreach ($member_buy_service_info_list as $member_buy_service_info) {
                //把is_new 更改为0，表示已经提醒过
                $member_buy_service_info->setIsNew(0);
                $member_buy_service_info->save();

                $member_info = Member::findFirst("member_id=" . $member_buy_service_info->getBuyerId());
                if ($member_info === false) {
                    continue;
                }
                $order_sn = $member_buy_service_info->getOrderSn();
                if (!empty($order_sn)) {
                    $vr_order = VrOrder::findFirst("order_sn=" . $order_sn);
                    if ($vr_order !== false) {
                        $vr_order_code = VrOrderCode::findFirst("order_id=" . $vr_order->getOrderId());
                        if ($vr_order_code !== false) {
                            $vr_code = $vr_order_code->getVrCode();
                        }
                    }
                } else {
                    $vr_code = "尚无兑换";
                }
                $res_arr[$member_buy_service_info->getId()] = array('id' => $member_buy_service_info->getId(), 'buyer_name' => $member_info->getMemberName(), 'vr_code' => $vr_code);

//                if (empty($str)) {
//                    $str .= $member_buy_service_info->getId();
//                } else {
//                    $str .= "," . $member_buy_service_info->getId();
//                }
            }
        }
        //$_GET['inajax']=1;
        //showDialog('ok');
//        echo $str;
        echo json_encode($res_arr);
        exit;
    }
}