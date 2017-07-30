<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/8
 * Time: 22:20
 */

namespace Ypk\Modules\Chat\Controllers;

use Phalcon\Mvc\View;
use Ypk\Models\MemberChatCard;

/**
 * hpf
 *
 * 网页聊天
 *
 * Class WebChat
 * @package Ypk\Modules\Chat\Controllers
 */
class WebChatController extends ControllerBase
{
    public function initialize()
    {
        //parent::initialize();
        getTranslation('member_chat');
    }

    /**
     * add msg
     */
    public function send_msgAction()
    {
        $member = array();
        $model_chat = Model('web_chat');
        if (empty($_POST)) $_POST = $_GET;
        $member_id = getSession('member_id');
        $member_name = getSession('member_name');
        $f_id = intval($_POST['f_id']);
        $t_id = intval($_POST['t_id']);
        $t_name = trim($_POST['t_name']);
        if (($member_id < 1) || ($member_id != $f_id)) $this->error(getLang('nc_member_chat_login'));
        $member = $model_chat->getMember($t_id);
        if ($t_name != $member['member_name']) $this->error(getLang('nc_member_chat_name_error'));
        $msg = array();
        $msg['f_id'] = $f_id;
        $msg['f_name'] = $member_name;
        $msg['t_id'] = $t_id;
        $msg['t_name'] = $t_name;
        $msg['t_msg'] = trim($_POST['t_msg']);
        $msg['chat_card_id'] = intval($_POST['chat_card_id']);
        $chat_msg = array();
        if ($msg['t_msg'] != '') {
            $chat_msg = $model_chat->addMsg($msg);
        }
        if ($chat_msg['m_id']) {
            $this->json($chat_msg);
        } else {
            $this->error(getLang('nc_member_chat_add_error'));
        }
    }

    /**
     * friends info
     */
    public function get_user_listAction()
    {
        $member_list = array();
        $model_chat = Model('web_chat');
        /**
         * 这里千万要注意，在phalcon里以来注入的服务都是在第一次使用的时候才能实例化
         * 看如下代码
         *  $di->setShared('session', function () {
         *      $session = new SessionAdapter();
         *      $session->start();
         *      return $session;
         *  });
         * 在phalcon里注册了session服务，但是只有到首次使用session的时候才会执行setShared的第二个参数（回调函数）
         * 一次也没有使用之前是没有实例化new SessionAdapter()的，并且也没有开启$session->start()，所以一次也没有使用
         * 在phalcon里注册的session服务之前，session未开启，用$_SESSION['member_id']的方式是拿不到任何session的
         * 总结：最保险的办法是用getSession('member_id')的方法取session，在getSession函数里会首次调用di的session服务
         * ，从而开启了session
         */
        $member_id = getSession('member_id');
        $member_name = getSession('member_name');
        $f_id = intval($_GET['f_id']);
        if (($member_id < 1) || ($member_id != $f_id)) $this->error(getLang('nc_member_chat_login'));
        $n = intval($_GET['n']);
        if ($n < 1) $n = 50;
        $member_list = $model_chat->getFriendList(array('friend_frommid' => $f_id), $n, $member_list);
        $add_time = date("Y-m-d");
        $add_time30 = strtotime($add_time) - 60 * 60 * 24 * 30;
        $member_list = $model_chat->getRecentList(array('f_id' => $f_id, 'add_time' => array('egt', $add_time30)), 10, $member_list);
        $member_list = $model_chat->getRecentFromList(array('t_id' => $f_id, 'add_time' => array('egt', $add_time30)), 10, $member_list);

        $this->json($member_list);
    }

    /**
     * 商家客服
     */
    public function get_seller_listAction()
    {
        $member_list = array();
        $model_chat = Model('web_chat');
        $member_id = getSession('member_id');
        $member_name = getSession('member_name');
        $store_id = getSession('store_id');
        $f_id = intval($_GET['f_id']);
        if (($member_id < 1) || ($member_id != $f_id)) $this->error(getLang('nc_member_chat_login'));
        $n = intval($_GET['n']);
        if ($n < 1) $n = 50;
        if (empty(getSession('seller_list'))) {
            $member_list = $model_chat->getSellerList(array('store_id' => $store_id), $n, $member_list);
            setSession('seller_list', $member_list);
        } else {
            $member_list = getSession('seller_list');
        }
        $add_time = date("Y-m-d");
        $add_time30 = strtotime($add_time) - 60 * 60 * 24 * 30; //30天内的聊天人员列表
        $member_list = $model_chat->getRecentList(array('f_id' => $f_id, 'add_time' => array('egt', $add_time30)), 10, $member_list);
        $member_list = $model_chat->getRecentFromList(array('t_id' => $f_id, 'add_time' => array('egt', $add_time30)), 10, $member_list);

        $this->json($member_list);
    }

    /**
     * member info
     */
    public function get_infoAction()
    {
        if (getSession('member_id') < 1) $this->error(getLang('nc_member_chat_login'));
        $val = '';
        $member = array();
        $model_chat = Model('web_chat');
        $types = array('member_id', 'member_name', 'store_id', 'member');
        $key = $_GET['t'];
        $member_id = intval($_GET['u_id']);
        if (trim($key) != '' && in_array($key, $types)) {
            $member = $model_chat->getMember($member_id);
            $this->json($member);
        }
    }

    /**
     * chat log
     */
    public function get_chat_logAction()
    {
        $member_id = getSession('member_id');
        $f_id = intval($_GET['f_id']);
        $t_id = intval($_GET['t_id']);
        $page = intval($_GET['page']);
        if (($member_id < 1) || ($member_id != $f_id)) {
            $this->error(getLang('nc_member_chat_login'));
        }

        if ($page < 1) $page = 20;
        $add_time_to = date("Y-m-d");
        $time_from = array();
        $time_from['7'] = strtotime($add_time_to) - 60 * 60 * 24 * 7; //7天内聊天记录
        $time_from['15'] = strtotime($add_time_to) - 60 * 60 * 24 * 15; //15天内聊天记录
        $time_from['30'] = strtotime($add_time_to) - 60 * 60 * 24 * 30; //30天内聊天记录

        $key = $_GET['t'];

        if (trim($key) != '' && array_key_exists($key, $time_from)) {
            $model_chat = Model('web_chat');
            $chat_log = array();
            $list = array();
            $condition_sql = " add_time >= '" . $time_from[$key] . "' ";
            $condition_sql .= " and ((f_id = '" . $f_id . "' and t_id = '" . $t_id . "') or (f_id = '" . $t_id . "' and t_id = '" . $f_id . "'))";
            $list = $model_chat->getLogList($condition_sql, $page);
            $chat_log['list'] = $list;
            $chat_log['total_page'] = $model_chat->gettotalpage();
            $this->json($chat_log);
        }
    }

    /**
     * 商品图片和名称
     */
    public function get_goods_infoAction()
    {
        $model_chat = Model('web_chat');
        $goods_id = intval($_GET['goods_id']);
        $goods = $model_chat->getGoodsInfo($goods_id);

        $this->json($goods);
    }

    /**
     * 店铺推荐商品图片和名称
     */
    public function get_goods_listAction()
    {
        $s_id = intval($_GET['s_id']);

        if ($s_id > 0) {
            $model_goods = Model('goods');
            $list = $model_goods->getGoodsCommendList($s_id, 4);
            if (!empty($list) && is_array($list)) {
                foreach ($list as $k => $v) {
                    $v['goods_promotion_price'] = ncPriceFormat($v['goods_promotion_price']);
                    $v['url'] = getUrl('goods/index', array('goods_id' => $v['goods_id']));
                    $v['pic'] = thumb($v, 60);
                    $list[$k] = $v;
                }
            }

            $this->json($list);
        }
    }

    /**
     * get session
     */
    public function get_sessionAction()
    {
        $key = $_GET['key'];
        $val = '';
        if (!empty(getSession($key))) {
            $val = getSession($key);
        }
        echo $val;
        exit;
    }

    /**
     * json
     */
    public function json($json)
    {
        echo $_GET['callback'] . '(' . json_encode($json) . ')';
        exit;
    }

    /**
     * error
     */
    public function error($msg = '')
    {
        $this->json(array('error' => $msg));
    }

    /**
     * 获取与医护人员的聊天卡
     */
    public function member_chat_card_listAction()
    {
        if (chksubmit()) {
            $id = $_POST['id'];
            if ($id < 1) {
                exit(json_encode(array('status' => 0)));
            }
            $member_chat_card = MemberChatCard::findFirst('id = ' . $id);
            if ($member_chat_card === false) {
                exit(json_encode(array('status' => 0)));
            }
            if ($member_chat_card->save(array('is_use' => 1, 'start_time' => time())) === false) {
                exit(json_encode(array('status' => 0)));
            }
            exit(json_encode(array('status' => 1)));

        } else {
            $member_id = $_GET['member_id'];
            if ($member_id < 1) {
                $this->showDialog('参数错误');
            }
            $doctor_id = $_GET['doctor_id'];
            if ($doctor_id < 1) {
                $this->showDialog('参数错误');
            }

            $member_chat_card = MemberChatCard::find(array("member_id = {$member_id} and doctor_id = {$doctor_id} and is_use = 0 and card_type = 0 and chat_card_end_time > " . time(), "order" => "how_lang_time,id"));
            $member_chat_card = $member_chat_card->toArray();

            $this->view->setVar('member_chat_card', $member_chat_card);
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->pick('web_chat/member_chat_card_list');
        }
    }

    public function doctor_chat_card_listAction()
    {
        $member_id = $_POST['member_id'];
        $doctor_id = $_POST['doctor_id'];
        if ($member_id == $doctor_id) {
            //不能与自己聊天
            exit(json_encode(array('status' => 0)));
        }
        $chat_card_id = $_POST['chat_card_id'];
        if ($member_id < 1 || $doctor_id < 1 || $chat_card_id < 1) {
            exit(json_encode(array('status' => 0)));
        }
        $member_card = MemberChatCard::findFirst("id = {$chat_card_id}");
        if ($member_card === false) {
            exit(json_encode(array('status' => 0)));
        }
        //$doctor_card = MemberChatCard::findFirst("member_id = {$member_id} and order_id = {$member_card->getOrderId()} and doctor_id = {$doctor_id} and is_use = 0 and card_type = 1 and chat_card_end_time > " . time());
        $doctor_card = MemberChatCard::findFirst("member_id = {$member_id} and order_id = {$member_card->getOrderId()} and doctor_id = {$doctor_id} and card_type = 1 and chat_card_end_time > " . time());
        if ($doctor_card === false) {
            exit(json_encode(array('status' => 0)));
        }
        $doctor_card->setIsUse(1);
        $doctor_card->setStartTime(time());
        if ($doctor_card->save() === false) {
            exit(json_encode(array('status' => 0)));
        }

        //根据客户聊天卡的启用时间计算医生回复卡的剩余时间
        //客户已经使用时间(单位秒)
        $used = time() - $member_card->getStartTime();
        $doctor_card->setHowLangTime($doctor_card->getHowLangTime() - $used);
        if ($doctor_card->getHowLangTime() <= 0) {
            //被动聊天卡已经过期
            exit(json_encode(array('status' => 0)));
        }
        exit(json_encode(array('status' => 1, 'doctor_card' => $doctor_card->toArray())));
    }
}