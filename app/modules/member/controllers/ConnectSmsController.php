<?php
/**
 * 手机登录及验证操作
 * User: Administrator
 * Date: 2016/11/30
 * Time: 12:56
 */

namespace Ypk\Modules\Member\Controllers;

use Ypk\Logic\ConnectApiLogic;
use Ypk\Logic\MemberLogic;
use Ypk\MyLogic\buy_1Logic;

class ConnectSmsController extends BaseLoginController
{

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation("home_login_register,home_login_index");
        $this->view->setVar('lang', $this->translation);

        $this->view->setVar('hidden_nctoolbar', 1);
        //$model_member = new MemberLogic();
        //$model_member->checkloginMember();
    }

    /**
     * 手机号码注册
     */
    public function indexAction()
    {
        $this->registerAction();
    }

    /**
     * 手机号码注册
     */
    public function registerAction()
    {
        $model_member = Model('member');
        $phone = $_POST['register_phone']; //手机号码
        $captcha = $_POST['register_captcha']; //验证码
        if (chksubmit() && strlen($phone) == 11 && strlen($captcha) == 6) {
            if (getConfig('sms_register') != 1) {
                $this->showDialog('系统没有开启手机注册功能', '', 'error');
            }
            $member_name = $_POST['member_name']; //用户名
            $member = $model_member->getMemberInfo(array('member_name' => $member_name));//检查重名
            if (!empty($member)) {
                $this->showDialog('用户名已被注册', '', 'error');
            }
            $member = $model_member->getMemberInfo(array('member_mobile' => $phone));//检查手机号是否已被注册
            if (!empty($member)) {
                $this->showDialog('手机号已被注册', '', 'error');
            }
            $logic_connect_api = new ConnectApiLogic();
            $state_data = $logic_connect_api->checkSmsCaptcha($phone, $captcha, 1);
            if ($state_data['state'] == false) {
                $this->showDialog('验证码错误或已过期，重新输入', '', 'error');
            }

            $member = array();
            $member['member_name'] = $member_name; //用户名
            $member['member_passwd'] = $_POST['password'];
            $member['member_email'] = '输入常用邮箱作为验证及找回密码使用';
            $member['member_mobile'] = $phone;
            $member['member_mobile_bind'] = 1;
            $member['member_type_id'] = $_POST['member_type']; //会员类型id
            if (isset($_REQUEST['inviteId']) && !empty($_REQUEST['inviteId'])) {
                $member['inviter_id'] = decrypt($_REQUEST['inviteId'], MD5_KEY); //邀请人id
            }
            if (intval($_POST['member_type']) > 1) {
                //$member['member_state'] = 0;
                write_file_cache($_POST['register_phone'], $member, null, '../storejoin_cache/');
                $this->showDialog('下一步：上传资质证明', getUrl('shop/store_joininc/uploadQualification', array('member_mobile' => $_POST['register_phone'])), 'succ');
            } else {
                //注册用户到数据库,$result接收的是刚注册的用户的member_id
                $member['member_state'] = 1;
                $result = $model_member->addMember($member);
                if ($result) {
                    $this->showDialog('注册成功', getUrl('member/login/index'), 'succ'); //普通用户注册成功后跳转到登录页面
                    //$member = $model_member->getMemberInfo("member_name='" . $member_name . "'");
                    //$model_member->createSession($member, true);//自动登录
//                if (intval($_POST['member_type']) > 1) { //表示是医务人员，注册成功后跳转到上传证件页面
//                    $this->showDialog('注册成功', getUrl('shop/store_joininc/uploadQualification', array('member_id' => $member['member_id'])), 'succ'); //医护人员用户注册成功后跳转到上传证件照页面
//                } else {
//                    $this->showDialog('注册成功', getUrl('member/login/index'), 'succ'); //普通用户注册成功后跳转到登录页面
//                }
                } else {
                    $this->showDialog($this->translation->_('nc_common_save_fail'), '', 'error');
                }
            }
        } else {
            $phone = $_GET['phone'];
            $num = substr($phone, -4);
            $logic_connect_api = new ConnectApiLogic();
            $member_name = $logic_connect_api->getMemberName('mb', $num);
            $this->view->setVar('member_name', $member_name);
            $this->view->setVar('password', rand(100000, 999999));
            $this->view->pick("Login/connect_sms_register");
        }
    }

    /**
     * 短信验证码
     */
    public function get_captchaAction()
    {
        $state = '发送失败';
        $phone = $_GET['phone'];
        if (checkSeccode($_GET['nchash'], $_GET['captcha']) && strlen($phone) == 11) {
            $log_type = $_GET['type'];//短信类型:1为注册,2为登录,3为找回密码
            $state = 'true';
            $logic_connect_api = Logic('connect_api');
            $state_data = $logic_connect_api->sendCaptcha($phone, $log_type);

            if ($state_data['state'] == false) {
                $state = $state_data['msg'];
            }
        } else {
            $state = '验证码错误';
        }
        exit($state);
    }

    /**
     * 验证注册验证码
     */
    public function check_captchaAction()
    {
        $state = '验证失败';
        $phone = $_GET['phone'];
        $captcha = $_GET['sms_captcha'];
        if (strlen($phone) == 11 && strlen($captcha) == 6) {
            $state = 'true';
            $logic_connect_api = new ConnectApiLogic();
            $state_data = $logic_connect_api->checkSmsCaptcha($phone, $captcha, 1);
            if ($state_data['state'] == false) {
                $state = '验证码错误或已过期，重新输入';
            }
        }
        exit($state);
    }

    /**
     * 登录
     */
    public function loginAction()
    {
        if (checkSeccode($_POST['nchash'], $_POST['captcha'])) {
            if (getConfig('sms_login') != 1) {
                $this->showDialog('系统没有开启手机登录功能', '', 'error');
            }
            $phone = $_POST['phone'];
            $captcha = $_POST['sms_captcha'];
            $logic_connect_api = new ConnectApiLogic();
            $state_data = $logic_connect_api->checkSmsCaptcha($phone, $captcha, 2);
            if ($state_data['state'] == false) {//半小时内进行验证为有效
                $this->showDialog('验证码错误或已过期，重新输入', '', 'error');
            }
            $model_member = new MemberLogic();
            $member = $model_member->getMemberInfo(array('member_mobile' => $phone));//检查手机号是否已被注册
            if (!empty($member)) {
                $model_member->createSession($member);//自动登录
                $reload = $_POST['ref_url'];
                if (empty($reload)) {
                    $reload = getUrl('shop/member/home');
                }
                $this->showDialog('登录成功', $reload, 'succ');
            }
        }
    }

    /**
     * 重置密码操作
     */
    public function find_passwordAction()
    {
        if (checkSeccode($_POST['nchash'], $_POST['captcha'])) {
            if (getConfig('sms_password') != 1) {
                $this->showDialog('系统没有开启手机找回密码功能', '', 'error');
            }
            $phone = $_POST['phone'];
            $captcha = $_POST['sms_captcha'];
            $logic_connect_api = new ConnectApiLogic();
            $state_data = $logic_connect_api->checkSmsCaptcha($phone, $captcha, 3);
            if ($state_data['state'] == false) {//半小时内进行验证为有效
                $this->showDialog('验证码错误或已过期，重新输入', '', 'error');
            }
            $model_member = new MemberLogic();
            $member = $model_member->getMemberInfo(array('member_mobile' => $phone));//检查手机号是否已被注册
            if (!empty($member)) {
                $new_password = md5($_POST['password']);
                //$model_member->editMember(array('member_id' => $member['member_id']), array('member_passwd' => $new_password, 'member_mobile' => $phone, 'member_mobile_bind' => 1));
                $model_member->editMember(array('member_id' => $member['member_id'], 'member_passwd' => $new_password, 'member_mobile' => $phone, 'member_mobile_bind' => 1));
                $model_member->createSession($member);//自动登录
                $this->showDialog('密码修改成功', getUrl('shop/member_information/member'), 'succ');
            }
        }
    }
}