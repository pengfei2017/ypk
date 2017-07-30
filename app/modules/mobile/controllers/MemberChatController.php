<?php
/**
 * 会员聊天
 */

namespace Ypk\Modules\Mobile\Controllers;

use Ypk\Models\MemberChatCard;

class MemberChatController extends MobileMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * node连接参数
     */
    public function get_node_infoAction()
    {
        $output_data = array('node_chat' => getConfig('node_chat'), 'node_site_url' => NODE_SITE_URL, 'resource_site_url' => RESOURCE_SITE_URL);
        $model_chat = Model('web_chat');
        $member_id = $this->member_info['member_id'];
        $member_info = $model_chat->getMember($member_id);
        $output_data['member_info'] = $member_info;
        $u_id = intval($_GET['u_id']);
        if ($u_id > 0) {
            $member_info = $model_chat->getMember($u_id);
            $output_data['user_info'] = $member_info;
            //看有没有与该医生聊天的主动聊天卡
            $member_chat_card = MemberChatCard::find(array('member_id = ' . $member_id . ' and doctor_id = ' . $u_id . ' and is_use = 0 and card_type = 0 and chat_card_end_time > ' . time(), 'order' => 'how_lang_time,id'));
            $output_data['member_chat_card'] = $member_chat_card->toArray();
        }
        $goods_id = intval($_GET['chat_goods_id']);
        if ($goods_id > 0) {
            $goods = $model_chat->getGoodsInfo($goods_id);
            $output_data['chat_goods'] = $goods;
        }
        output_data($output_data);
    }

    /**
     * 最近联系人
     */
    public function get_user_listAction()
    {
        $member_list = array();
        $model_chat = Model('web_chat');

        $member_id = $this->member_info['member_id'];
        $member_name = $this->member_info['member_name'];
        $n = intval($_POST['n']);
        if ($n < 1) $n = 50;
        if (intval($_POST['recent']) != 1) {
            $member_list = $model_chat->getFriendList(array('friend_frommid' => $member_id), $n, $member_list);
        }
        $add_time = date("Y-m-d");
        $add_time30 = strtotime($add_time) - 60 * 60 * 24 * 30;
        $member_list = $model_chat->getRecentList(array('f_id' => $member_id, 'add_time' => array('egt', $add_time30)), 10, $member_list);
        $member_list = $model_chat->getRecentFromList(array('t_id' => $member_id, 'add_time' => array('egt', $add_time30)), 10, $member_list);
        $member_info = array();
        $member_info = $model_chat->getMember($member_id);

        $node_info = array();
        $node_info['node_chat'] = getConfig('node_chat');
        $node_info['node_site_url'] = NODE_SITE_URL;
        output_data(array('node_info' => $node_info, 'member_info' => $member_info, 'list' => $member_list));
    }

    /**
     * 会员信息
     *
     */
    public function get_infoAction()
    {
        $val = '';
        $member = array();
        $model_chat = Model('web_chat');
        $types = array('member_id', 'member_name', 'store_id', 'member');
        $key = $_POST['t'];
        $member_id = intval($_POST['u_id']);
        if ($member_id > 0 && trim($key) != '' && in_array($key, $types)) {
            $member_info = $model_chat->getMember($member_id);
            output_data(array('member_info' => $member_info));
        } else {
            output_error('参数错误');
        }
    }

    /**
     * 发消息
     *
     */
    public function send_msgAction()
    {
        $member = array();
        $model_chat = Model('web_chat');
        $member_id = $this->member_info['member_id'];
        $member_name = $this->member_info['member_name'];
        $t_id = intval($_POST['t_id']);
        $t_name = trim($_POST['t_name']);
        $member = $model_chat->getMember($t_id);
        if ($t_name != $member['member_name']) output_error('接收消息会员账号错误');

        $msg = array();
        $msg['f_id'] = $member_id;
        $msg['f_name'] = $member_name;
        $msg['t_id'] = $t_id;
        $msg['t_name'] = $t_name;
        $msg['t_msg'] = trim($_POST['t_msg']);
        $msg['chat_card_id'] = trim($_POST['chat_card_id']);
        if ($msg['t_msg'] != '') $chat_msg = $model_chat->addMsg($msg);
        if ($chat_msg['m_id']) {
            $goods_id = intval($_POST['chat_goods_id']);
            if ($goods_id > 0) {
                $goods = $model_chat->getGoodsInfo($goods_id);
                $chat_msg['chat_goods'] = $goods;
            }
            output_data(array('msg' => $chat_msg));
        } else {
            output_error('发送失败，请稍后重新发送');
        }
    }

    /**
     * 删除最近联系人消息
     *
     */
    public function del_msgAction()
    {
        $model_chat = Model('web_chat');
        $member_id = $this->member_info['member_id'];
        $t_id = intval($_POST['t_id']);
        $condition = array();
        $condition['f_id'] = $member_id;
        $condition['t_id'] = $t_id;
        $model_chat->delChatMsg($condition);
        $condition = array();
        $condition['t_id'] = $member_id;
        $condition['f_id'] = $t_id;
        $model_chat->delChatMsg($condition);
        output_data(1);
    }

    /**
     * 商品图片和名称
     *
     */
    public function get_goods_infoAction()
    {
        $model_chat = Model('web_chat');
        $goods_id = intval($_POST['goods_id']);
        $goods = $model_chat->getGoodsInfo($goods_id);
        output_data(array('goods' => $goods));
    }

    /**
     * 未读消息查询
     *
     */
    public function get_msg_countAction()
    {
        $model_chat = Model('web_chat');
        $member_id = $this->member_info['member_id'];
        $condition = array();
        $condition['t_id'] = $member_id;
        $condition['r_state'] = 2;
        $n = $model_chat->getChatMsgCount($condition);
        output_data($n);
    }

    /**
     * 聊天记录查询
     *
     */
    public function get_chat_logAction()
    {
        $member_id = $this->member_info['member_id'];
        $t_id = intval($_POST['t_id']);
        $add_time_to = date("Y-m-d");
        $time_from = array();
        $time_from['7'] = strtotime($add_time_to) - 60 * 60 * 24 * 7;
        $time_from['15'] = strtotime($add_time_to) - 60 * 60 * 24 * 15;
        $time_from['30'] = strtotime($add_time_to) - 60 * 60 * 24 * 30;

        $key = $_POST['t'];
        if (trim($key) != '' && array_key_exists($key, $time_from)) {
            $model_chat = Model('web_chat');
            $list = array();
            $condition_sql = " add_time >= '" . $time_from[$key] . "' ";
            $condition_sql .= " and ((f_id = '" . $member_id . "' and t_id = '" . $t_id . "') or (f_id = '" . $t_id . "' and t_id = '" . $member_id . "'))";
            $list = $model_chat->getLogList($condition_sql, $this->page);

            $total_page = $model_chat->gettotalpage();
            output_data(array('list' => $list), mobile_page($total_page));
        }
    }

    public function set_card_usedAction()
    {
        $chat_card_id = intval($_POST['chat_card_id']);
        if ($chat_card_id <= 0) {
            output_error('参数错误');
        }
        $member_chat_card = MemberChatCard::findFirst("id  = {$chat_card_id}");
        if ($member_chat_card === false) {
            output_error('聊天卡不存在');
        }
        $member_chat_card->setIsUse(1);
        $member_chat_card->setStartTime(time());
        if ($member_chat_card->save() === false) {
            output_error('聊天卡设置为使用状态失败');
        }
        output_data($member_chat_card->toArray());
    }

    public function doctor_chat_card_listAction()
    {
        $member_id = $this->member_info['member_id'];
        $doctor_id = $_POST['u_id'];
        if ($member_id == $doctor_id) {
            output_error('不能与自己聊天');
        }
        $chat_card_id = $_POST['chat_card_id'];
        if ($member_id < 1 || $doctor_id < 1 || $chat_card_id < 1) {
            output_error('参数错误');
        }
        $member_card = MemberChatCard::findFirst("id = {$chat_card_id}");
        if ($member_card === false) {
            output_error('主动聊天卡不存在');
        }

        //看该医生有没有被动聊天卡
        //$doctor_card = MemberChatCard::findFirst("member_id = {$member_id} and order_id = {$member_card->getOrderId()} and doctor_id = {$doctor_id} and is_use = 0 and card_type = 1 and chat_card_end_time > " . time());
        $doctor_card = MemberChatCard::findFirst("member_id = {$member_id} and order_id = {$member_card->getOrderId()} and doctor_id = {$doctor_id} and card_type = 1 and chat_card_end_time > " . time());
        if ($doctor_card === false) {
            output_error('被动聊天卡不存在');
        }
        $doctor_card->setIsUse(1);
        $doctor_card->setStartTime(time());
        if ($doctor_card->save() === false) {
            output_error('被动聊天卡状态设置失败');
        }

        //根据客户聊天卡的启用时间计算医生回复卡的剩余时间
        //客户已经使用时间(单位秒)
        $used = time() - $member_card->getStartTime();
        $doctor_card->setHowLangTime($doctor_card->getHowLangTime() - $used);
        if ($doctor_card->getHowLangTime() <= 0) {
            output_error('被动聊天卡已经过期');
        }
        output_data($doctor_card->toArray());
    }
}
