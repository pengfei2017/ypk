<?php

namespace Ypk\Modules\Member\Controllers;

use Ypk\Email;
use Ypk\Logic\MailTemplatesLogic;
use Ypk\Logic\MemberLogic;
use Ypk\Models\MemberType;
use Ypk\Models\Seller;
use Ypk\Process;
use Ypk\QueueClient;

/**
 * 会员登录处理
 * Class LoginController
 * @package Ypk\Modules\Member\Controllers
 */
class LoginController extends BaseLoginController
{

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('home_login_index,home_login_register,msg');
        $this->view->setVar("lang", $this->translation);
    }

    /**
     * 登录操作
     *
     */
    public function indexAction()
    {
        $model_member = Model('member');
//        //检查登录状态，如果已经登录则直接跳转到商城首页
//        $model_member->checkloginMember();
        $script = "";
        if ($_GET['inajax'] == 1 && getConfig('captcha_status_login') == '1') {
            $script = "document.getElementById('codeimage').src='" . getUrl('admin/seccode/makecode', array('admin' => 1, 'hash' => getHash($this->dispatcher->getControllerName(), $this->dispatcher->getActionName()), 't' => time())) . "'";
        }
        //检测是否是提交表单
        $result = chksubmit(false, getConfig('captcha_status_login'), 'num');
        if ($result) {  //表示是提交登录数据
            if ($result === -11) {
                $this->showDialog($this->translation->_('login_index_login_illegal'), '', 'error', $script);
            } elseif ($result === -12) {
                $this->showDialog($this->translation->_('login_index_wrong_checkcode'), '', 'error', $script);
            }

            $login_info = array();
            $login_info['user_name'] = $_POST['user_name']; //提交的登录用户名
            $login_info['password'] = $_POST['password']; //提交的登录密码
            $member_info = $model_member->login($login_info); //验证登录

            if (isset($member_info['error'])) { //表示登录失败
                if (!empty(read_file_cache($_POST['user_name'], false, null, '../storejoin_cache/'))) {
                    $this->showDialog('账户正在审核中，请耐心等待短信通知审核结果', '', 'error', $script);
                } else {
                    $this->showDialog($member_info['error'], '', 'error', $script);
                }
            } else { //表示登录成功

                // 7天自动登录（$_POST['auto_login']值为1表示选择了自动登录）
                if (isset($_POST['auto_login'])) {
                    $member_info['auto_login'] = $_POST['auto_login'];
                }
                $model_member->createSession($member_info, true); //向session和cookies中写入相关的的登录信息
                if ($_GET['inajax'] == 1) {
                    showDialog('', $_POST['ref_url'] == '' ? 'reload' : $_POST['ref_url'], 'js');
                } else {
                    if (!empty($_POST['ref_url'])) {
                        redirect($_POST['ref_url']);
                    } else {
                        redirect(getUrl('shop/index'));
                    }
                }
            }
        } else {
            //获取4张登录界面的图片名称array('1.jpg','2.jpg','3.jpg','4.jpg')
            $_pic = @unserialize(getConfig('login_pic'));
            if ($_pic[0] != '') {
                //从设置的4张图片中随机获取一张进行显示
                $this->view->setVar('lpic', UPLOAD_SITE_URL_HTTPS . '/' . ATTACH_LOGIN . '/' . $_pic[array_rand($_pic)]);
            } else {
                $this->view->setVar('lpic', UPLOAD_SITE_URL_HTTPS . '/' . ATTACH_LOGIN . '/' . rand(1, 4) . '.jpg');
            }

            //判断是否是从其他页面跳转过来的
            if (!empty($_GET['ref_url'])) {
                $ref_url = getReferer();
            }
            $this->view->setVar('html_title', getConfig('site_name') . ' - ' . $this->translation->_('login_index_login'));
            if ($_GET['inajax'] == 1) {
                //Tpl::showpage('login_inajax','null_layout'); //ajax请求登录的时候调用
                $this->view->pick('login/login_inajax');
            } else {
                $this->view->setVar("hidden_login", "login");
                $this->view->pick('login/login');
            }
        }
    }

    /**
     * 退出操作
     * @return array $rs_row 返回数组形式的查询结果
     * @internal param int $id 记录ID
     */
    public function logoutAction()
    {
        // 清理COOKIE
        deleteMyCookie('msgnewnum' . $_SESSION['member_id']);
        deleteMyCookie('auto_login');
        deleteMyCookie('cart_goods_num');

        //清除session
        destroySession();
        //if(empty($_GET['ref_url'])){
        //    $ref_url = getReferer();
        //}else {
        //    $ref_url = $_GET['ref_url'];
        //}
        //跳转到会员登录页面
        @header("Location: " . getUrl('member/login'));
    }

    /**
     * 会员注册页面
     *
     */
    public function registerAction()
    {
        //$model_member = new MemberLogic();
        //$model_member->checkloginMember();
        $this->view->setVar('html_title', getConfig('site_name') . ' - ' . $this->translation->_('login_register_join_us'));
        $this->view->setVar("hidden_login", "register");
        if (isset($_GET['inviteId']) && !empty($_GET['inviteId'])) {
            $this->view->setVar("inviteId", $_GET['inviteId']); //获取邀请人id
        }

        $this->view->setVar('member_type_list_str', $this->getMemberTypeListStr());
    }

    /**
     * 获取会员类型列表
     * @return string
     */
    public function getMemberTypeListStr()
    {
        $member_type_list = MemberType::find("is_enable=1");
        $member_type_list_str = '';
        if (count($member_type_list) > 0) {
            $member_type_list = $member_type_list->toArray();
            $member_type_list_str .= '<select name="member_type">';
            foreach ($member_type_list as $key => $val) {
                $member_type_list_str .= '<option value=' . $val['type_id'] . '>' . $val['type_name'] . '</option>';
            }
            $member_type_list_str .= '</select><span>(注册成功后，身份不可修改)</span>';
        }
        return $member_type_list_str;
    }

    /**
     * 会员注册操作
     *
     * @internal param $
     */
    public function usersaveAction()
    {
        //重复注册验证
        //if (process::islock('reg')){
        //    showDialog(getLang('nc_common_op_repeat'));
        //}
        $model_member = Model('member');
        //$model_member->checkloginMember(); //检测是否登录
        $result = chksubmit(false, getConfig('captcha_status_register'), 'num'); //检测是否是表单提交
        if ($result) {
            if ($result === -11) {
                $this->showDialog($this->translation->_('invalid_request'), '', 'error');
            } elseif ($result === -12) {
                $this->showDialog($this->translation->_('login_usersave_wrong_code'), '', 'error');
            }
        } else {
            $this->showDialog($this->translation->_('invalid_request'), '', 'error');
        }

        $register_info = array(); //注册用户对象
        $register_info['username'] = $_POST['user_name']; //用户名
        $register_info['password'] = $_POST['password']; //密码
        $register_info['password_confirm'] = $_POST['password_confirm']; //确认密码
        $register_info['email'] = empty($_POST['email']) ? "" : $_POST['email']; //电子邮箱
        $register_info['member_type_id'] = $_POST['member_type']; //会员类型id


        if (isset($_REQUEST['inviteId']) && !empty($_REQUEST['inviteId'])) {
            $register_info['inviter_id'] = decrypt($_REQUEST['inviteId'], MD5_KEY); //邀请人id
        }

        //把会员基本信息插入数据库
        $member_info = $model_member->register($register_info); //注册添加新用户，并返回新添加的用户实体对象

        if (!isset($member_info['error'])) { //表示注册成功
            $model_member->createSession($member_info, true);
            //Process::addprocess('reg');

            if (intval($register_info['member_type_id']) != 1) { //表示注册的医务人员
                $this->showDialog('注册成功，请添加详细的注册信息', getUrl('shop/store_joininc/step0'), 'succ', '', 3); //跳转到商家入驻界面
            }

            $_POST['ref_url'] = (strstr($_POST['ref_url'], 'logout') === false && !empty($_POST['ref_url']) ? $_POST['ref_url'] : getUrl('shop/member_information/member'));
            if ($_GET['inajax'] == 1) {
                $this->showDialog('', $_POST['ref_url'] == '' ? 'reload' : $_POST['ref_url'], 'js');
            } else {
                @header("Location: " . $_POST['ref_url']);
            }
        } else {
            $this->showDialog($member_info['error']);
        }
    }

    /**
     * 会员名检测
     */
    public function check_memberAction()
    {
        $model_member = Model('member');

        $check_member_name = $model_member->getMemberInfo(array('member_name' => $_GET['user_name']));
        if (is_array($check_member_name) && count($check_member_name) > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit;
    }

    /**
     * 电子邮箱检测
     *
     */
    public function check_emailAction()
    {
        $model_member = Model('member');
        $check_member_email = $model_member->getMemberInfo(array('member_email' => $_GET['email']));
        if (is_array($check_member_email) && count($check_member_email) > 0) {
            echo 'false';
        } else {
            echo 'true';
        }
        exit;
    }

    /**
     * 忘记密码页面
     */
    public function forget_passwordAction()
    {
        $_pic = @unserialize(getConfig('login_pic'));
        if ($_pic[0] != '') {
            $this->view->setVar('lpic', UPLOAD_SITE_URL_HTTPS . '/' . ATTACH_LOGIN . '/' . $_pic[array_rand($_pic)]);
        } else {
            $this->view->setVar('lpic', UPLOAD_SITE_URL_HTTPS . '/' . ATTACH_LOGIN . '/' . rand(1, 4) . '.jpg');
        }
        $this->view->setVar('html_title', getConfig('site_name') . ' - ' . $this->translation->_('login_index_find_password'));
        $this->view->pick('login/find_password');
    }

    /**
     * 找回密码的发邮件处理
     */
    public function find_passwordAction()
    {
        $lang = $this->translation;
        $result = chksubmit(true, true, 'num');
        if ($result !== false) {
            if ($result === -11) {
                showDialog('非法提交', '', 'error');
            } elseif ($result === -12) {
                showDialog('验证码错误', '', 'error');
            }
        }

        if (empty($_POST['username'])) {
            showDialog($lang['login_password_input_username'], '', 'error');
        }

        if (Process::islock('forget')) {
            showDialog($lang['nc_common_op_repeat'], '', 'error');
        }

        $member_model = Model('member');
        $member = $member_model->getMemberInfo(array('member_name' => $_POST['username']));
        if (empty($member) or !is_array($member)) {
            Process::addprocess('forget');
            showDialog($lang['login_password_username_not_exists'], '', 'error');
        }

        if (empty($_POST['email'])) {
            showDialog($lang['login_password_input_email'], '', 'error');
        }

        if (strtoupper($_POST['email']) != strtoupper($member['member_email'])) {
            Process::addprocess('forget');
            showDialog($lang['login_password_email_not_exists'], '', 'error');
        }
        Process::clear('forget');
        //产生密码
        $new_password = random(15);
        if (!($member_model->editMember(array('member_id' => $member['member_id']), array('member_passwd' => md5($new_password))))) {
            showDialog($lang['login_password_email_fail'], '', 'error');
        }

        $model_tpl = Model('mail_templates');
        $tpl_info = $model_tpl->getTplInfo(array('code' => 'reset_pwd'));
        $param = array();
        $param['site_name'] = getConfig('site_name');
        $param['user_name'] = $_POST['username'];
        $param['new_password'] = $new_password;
        $param['site_url'] = SHOP_SITE_URL;
        $subject = ncReplaceText($tpl_info['title'], $param);
        $message = ncReplaceText($tpl_info['content'], $param);

        $email = new Email();
        $result = $email->send_sys_email($_POST["email"], $subject, $message);
        showDialog('新密码已经发送至您的邮箱，请尽快登录并更改密码！', '', 'succ', '', 5);
    }

    /**
     * 邮箱绑定验证
     */
    public function bind_emailAction()
    {
        $model_member = Model('member');
        $uid = @base64_decode($_GET['uid']);
        $uid = decrypt($uid, '');
        list($member_id, $member_email) = explode(' ', $uid);

        if (!is_numeric($member_id)) {
            $this->showMessage('验证失败', SHOP_SITE_URL, 'html', 'error');
        }

        $member_info = $model_member->getMemberInfo(array('member_id' => $member_id), 'member_email');
        if ($member_info['member_email'] != $member_email) {
            $this->showMessage('验证失败', SHOP_SITE_URL, 'html', 'error');
        }

        $member_common_info = $model_member->getMemberCommonInfo(array('member_id' => $member_id));
        if (empty($member_common_info) || !is_array($member_common_info)) {
            $this->showMessage('验证失败', SHOP_SITE_URL, 'html', 'error');
        }
        if (md5($member_common_info['auth_code']) != $_GET['hash'] || TIMESTAMP - $member_common_info['send_acode_time'] > 24 * 3600) {
            $this->showMessage('验证失败', SHOP_SITE_URL, 'html', 'error');
        }

        $update = $model_member->editMember(array('member_id' => $member_id), array('member_email_bind' => 1));
        if (!$update) {
            $this->showMessage('系统发生错误，如有疑问请与管理员联系', SHOP_SITE_URL, 'html', 'error');
        }

        $data = array();
        $data['auth_code'] = '';
        $data['send_acode_time'] = 0;
        $update = $model_member->editMemberCommon($data, array('member_id' => $_SESSION['member_id']));
        if (!$update) {
            $this->showDialog('系统发生错误，如有疑问请与管理员联系');
        }
        $this->showMessage('邮箱设置成功', getUrl('shop/member_security/index'));

    }
}