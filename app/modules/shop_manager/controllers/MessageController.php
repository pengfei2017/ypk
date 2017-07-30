<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 16:33
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Models\Admin;
use Ypk\Models\MemberMsgTpl;
use Ypk\Models\StoreMsgTpl;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class MessageController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-消息设置
 */
class MessageController extends ControllerBase
{
    private $links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'message', 'action' => 'seller_tpl'), 'lang' => 'seller_tpl'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'message', 'action' => 'member_tpl'), 'lang' => 'member_tpl'),
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('setting,layout,message,common');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->seller_tplAction();
        $this->view->render('message', 'seller_tpl');
    }

    /**
     * 商家消息模板
     */
    public function seller_tplAction()
    {
        //$mstpl_list = Model('store_msg_tpl')->getStoreMsgTplList(array());
        $mstpl_list = StoreMsgTpl::find();
        if ($mstpl_list) {
            $this->view->setVar('mstpl_list', $mstpl_list);
        }
        $this->view->setVar('top_link', $this->sublink($this->links, 'seller_tpl'));
    }

    /**
     * 商家消息模板编辑
     */
    public function seller_tpl_editAction()
    {
        if (chksubmit()) {
            $code = trim($_POST['code']);
            $type = trim($_POST['type']);
            if (empty($code) || empty($type)) {
                $this->showMessage($this->translation['param_error']);
            }
            switch ($type) {
                case 'message':
                    $this->seller_tpl_update_message();
                    break;
                case 'short':
                    $this->seller_tpl_update_short();
                    break;
                case 'mail':
                    $this->seller_tpl_update_mail();
                    break;
            }
        }
        $code = trim($_GET['code']);
        if (empty($code)) {
            $this->showMessage($this->translation['param_error']);
        }

        $where = array();
        $where['smt_code'] = $code;
        //$smtpl_info = Model('store_msg_tpl')->getStoreMsgTplInfo($where);
        $smtpl_info = StoreMsgTpl::findFirst($where)->toArray();
        $this->view->setVar('smtpl_info', $smtpl_info);
        //$this->links[] = array('url' => 'act=message&op=seller_tpl_edit', 'lang' => 'seller_tpl_edit');
        //$this->links[] = array('url' => getUrl('shop_manager/message/seller_tpl_edit'), 'lang' => 'seller_tpl_edit');
        //$this->links[] = array('url' => array('module' => 'shop_manager', 'controller' => 'message', 'action' => 'seller_tpl_edit'), 'lang' => 'seller_tpl_edit');
        $this->view->setVar('top_link', $this->sublink($this->links, 'seller_tpl_edit'));
    }

    /**
     * 商家消息模板更新站内信
     */
    private function seller_tpl_update_message()
    {
        $message_content = trim($_POST['message_content']);
        if (empty($message_content)) {
            $this->showMessage('请填写站内信模板内容。');
        }
        // 条件
        $where = array();
        $where['smt_code'] = trim($_POST['code']);
        // 数据
//        $update = array();
//        $update['smt_message_switch'] = intval($_POST['message_switch']);
//        $update['smt_message_content'] = $message_content;
//        $update['smt_message_forced'] = intval($_POST['message_forced']);
        //$result = Model('store_msg_tpl')->editStoreMsgTpl($where, $update);
        //$this->seller_tpl_update_showmessage($result);

        $storeMsgTpl = StoreMsgTpl::findFirst($where);
        $storeMsgTpl->setSmtMessageSwitch(intval($_POST['message_switch']));
        $storeMsgTpl->setSmtMessageContent($message_content);
        $storeMsgTpl->setSmtMessageForced(intval($_POST['message_forced']));
        $result = $storeMsgTpl->save();
        $this->seller_tpl_update_showmessage($result);
    }

    /**
     * 商家消息模板更新短消息
     */
    private function seller_tpl_update_short()
    {
        $short_content = trim($_POST['short_content']);
        if (empty($short_content)) {
            $this->showMessage('请填写短消息模板内容。');
        }
        // 条件
        $where = array();
        $where['smt_code'] = trim($_POST['code']);
        // 数据
//        $update = array();
//        $update['smt_short_switch'] = intval($_POST['short_switch']);
//        $update['smt_short_content'] = $short_content;
//        $update['smt_short_forced'] = intval($_POST['short_forced']);
//        $result = Model('store_msg_tpl')->editStoreMsgTpl($where, $update);
//        $this->seller_tpl_update_showmessage($result);

        $storeMsgTpl = StoreMsgTpl::findFirst($where);
        $storeMsgTpl->setSmtShortSwitch(intval($_POST['short_switch']));
        $storeMsgTpl->setSmtShortContent($short_content);
        $storeMsgTpl->setSmtShortForced(intval($_POST['short_forced']));
        $result = $storeMsgTpl->save(); //返回值 true/false
        $this->seller_tpl_update_showmessage($result);
    }

    /**
     * 商家消息模板更新邮件
     */
    private function seller_tpl_update_mail()
    {
        $mail_subject = trim($_POST['mail_subject']);
        $mail_content = trim($_POST['mail_content']);
        if ((empty($mail_subject) || empty($mail_content))) {
            $this->showMessage('请填写邮件模板内容。');
        }
        // 条件
        $where = array();
        $where['smt_code'] = trim($_POST['code']);
        // 数据
//        $update = array();
//        $update['smt_mail_switch'] = intval($_POST['mail_switch']);
//        $update['smt_mail_subject'] = $mail_subject;
//        $update['smt_mail_content'] = $mail_content;
//        $update['smt_mail_forced'] = intval($_POST['mail_forced']);
//        $result = Model('store_msg_tpl')->editStoreMsgTpl($where, $update); //返回值 true/false
//        $this->seller_tpl_update_showmessage($result);

        $storeMsgTpl = StoreMsgTpl::findFirst($where);
        $storeMsgTpl->setSmtMailSwitch(intval($_POST['mail_switch']));
        $storeMsgTpl->setSmtMailSubject($mail_subject);
        $storeMsgTpl->setSmtMailContent($mail_content);
        $storeMsgTpl->setSmtMailForced(intval($_POST['mail_forced']));
        $result = $storeMsgTpl->save(); //返回值 true/false
        $this->seller_tpl_update_showmessage($result);
    }

    private function seller_tpl_update_showmessage($result)
    {
        if ($result) {
            $this->showMessage($this->translation['nc_common_op_succ'],getUrl('shop_manager/message/seller_tpl'));
        } else {
            $this->showMessage($this->translation['nc_common_op_succ']);
        }
    }

    /**
     * 用户消息模板
     */
    public function member_tplAction()
    {
//        $mmtpl_list = Model('member_msg_tpl')->getMemberMsgTplList(array());
        $mmtpl_list = MemberMsgTpl::find();
        $this->view->setVar('mmtpl_list', $mmtpl_list);
        $this->view->setVar('top_link', $this->sublink($this->links, 'member_tpl'));
    }

    /**
     * 用户消息模板编辑
     */
    public function member_tpl_editAction()
    {
        if (chksubmit()) {
            $code = trim($_POST['code']);
            $type = trim($_POST['type']);
            if (empty($code) || empty($type)) {
                $this->showMessage($this->translation['param_error']);
            }
            switch ($type) {
                case 'message':
                    $this->member_tpl_update_message();
                    break;
                case 'short':
                    $this->member_tpl_update_short();
                    break;
                case 'mail':
                    $this->member_tpl_update_mail();
                    break;
            }
        }
        $code = trim($_GET['code']);
        if (empty($code)) {
            $this->showMessage($this->translation['param_error']);
        }

        $where = array();
        $where['mmt_code'] = $code;
        //$mmtpl_info = Model('member_msg_tpl')->getMemberMsgTplInfo($where);
        $mmtpl_info = MemberMsgTpl::findFirst($where)->toArray();
        $this->view->setVar('mmtpl_info', $mmtpl_info);
        //$this->links[] = array('url' => 'shop_manage/message/member_tpl_edit', 'lang' => 'member_tpl_edit');
        //$this->links[] = array('url' => array('module' => 'shop_manager', 'controller' => 'message', 'action' => 'member_tpl_edit'), 'lang' => 'member_tpl_edit');
        $this->view->setVar('top_link', $this->sublink($this->links, 'member_tpl_edit'));
    }

    /**
     * 商家消息模板更新站内信
     */
    private function member_tpl_update_message()
    {
        $message_content = trim($_POST['message_content']);
        if (empty($message_content)) {
            $this->showMessage('请填写站内信模板内容。');
        }
        // 条件
        $where = array();
        $where['mmt_code'] = trim($_POST['code']);
        // 数据
//        $update = array();
//        $update['mmt_message_switch'] = intval($_POST['message_switch']);
//        $update['mmt_message_content'] = $message_content;
//        $result = Model('member_msg_tpl')->editMemberMsgTpl($where, $update);
//        $this->member_tpl_update_showmessage($result);

        $memberMsgTpl = MemberMsgTpl::findFirst($where);
        $memberMsgTpl->setMmtMessageSwitch(intval($_POST['message_switch']));
        $memberMsgTpl->setMmtMessageContent($message_content);
        $result = $memberMsgTpl->save(); //返回值 true/false
        $this->member_tpl_update_showmessage($result);
    }

    /**
     * 商家消息模板更新短消息
     */
    private function member_tpl_update_short()
    {
        $short_content = trim($_POST['short_content']);
        if (empty($short_content)) {
            $this->showMessage('请填写短消息模板内容。');
        }
        // 条件
        $where = array();
        $where['mmt_code'] = trim($_POST['code']);
        // 数据
//        $update = array();
//        $update['mmt_short_switch'] = intval($_POST['short_switch']);
//        $update['mmt_short_content'] = $short_content;
//        $result = Model('member_msg_tpl')->editMemberMsgTpl($where, $update);
//        $this->member_tpl_update_showmessage($result);

        $memberMsgTpl = MemberMsgTpl::findFirst($where);
        $memberMsgTpl->setMmtShortSwitch(intval($_POST['short_switch']));
        $memberMsgTpl->setMmtShortContent($short_content);
        $result = $memberMsgTpl->save(); //返回值 true/false
        $this->member_tpl_update_showmessage($result);
    }

    /**
     * 商家消息模板更新邮件
     */
    private function member_tpl_update_mail()
    {
        $mail_subject = trim($_POST['mail_subject']);
        $mail_content = trim($_POST['mail_content']);
        if ((empty($mail_subject) || empty($mail_content))) {
            $this->showMessage('请填写邮件模板内容。');
        }
        // 条件
        $where = array();
        $where['mmt_code'] = trim($_POST['code']);
        // 数据
//        $update = array();
//        $update['mmt_mail_switch'] = intval($_POST['mail_switch']);
//        $update['mmt_mail_subject'] = $mail_subject;
//        $update['mmt_mail_content'] = $mail_content;
//        $result = Model('member_msg_tpl')->editMemberMsgTpl($where, $update);
//        $this->member_tpl_update_showmessage($result);

        $memberMsgTpl = MemberMsgTpl::findFirst($where);
        $memberMsgTpl->setMmtMailSwitch(intval($_POST['mail_switch']));
        $memberMsgTpl->setMmtMailSubject($mail_subject);
        $memberMsgTpl->setMmtMailContent($mail_content);
        $result = $memberMsgTpl->save(); //返回值 true/false
        $this->member_tpl_update_showmessage($result);
    }

    private function member_tpl_update_showmessage($result)
    {
        if ($result) {
            $this->showMessage($this->translation['nc_common_op_succ'],getUrl('shop_manager/message/member_tpl'));
        } else {
            $this->showMessage($this->translation['nc_common_op_fail']);
        }
    }
}