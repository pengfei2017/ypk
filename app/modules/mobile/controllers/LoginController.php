<?php
/**
 * 前台登录 退出操作
 */

namespace Ypk\Modules\Mobile\Controllers;


use Ypk\Process;

class LoginController extends MobileHomeController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 登录
     */
    public function indexAction()
    {
        if (empty($_POST['username']) || empty($_POST['password']) || !in_array($_POST['client'], $this->client_type_array)) {
            output_error('登录失败');
        }

        $model_member = Model('member');

        $login_info = array();
        $login_info['user_name'] = $_POST['username'];
        $login_info['password'] = $_POST['password'];
        $member_info = $model_member->login($login_info);
        if (isset($member_info['error'])) {
            if (!empty(read_file_cache($_POST['username'], false, null, '../storejoin_cache/'))) {
                output_error('cache');
            } else {
                output_error($member_info['error']);
            }
        } else {
            //生成登录令牌
            $token = $this->_get_token($member_info['member_id'], $member_info['member_name'], $_POST['client']);
            if ($token) {
				$_SESSION['is_login']=1;
                $_SESSION['member_id']=$member_info['member_id'];
                $_SESSION['member_name']=$member_info['member_name'];
                output_data(array('username' => $member_info['member_name'], 'userid' => $member_info['member_id'], 'member_type_id' => $member_info['member_type_id'], 'key' => $token));
            } else {
                output_error('登录失败');
            }
        }
    }

    /**
     * 登录生成token
     */
    private function _get_token($member_id, $member_name, $client)
    {
        $model_mb_user_token = Model('mb_user_token');

        //重新登录后以前的令牌失效
        //暂时停用
        //$condition = array();
        //$condition['member_id'] = $member_id;
        //$condition['client_type'] = $client;
        //$model_mb_user_token->delMbUserToken($condition);

        //生成新的token
        $mb_user_token_info = array();
        $token = md5($member_name . strval(TIMESTAMP) . strval(rand(0, 999999)));
        $mb_user_token_info['member_id'] = $member_id;
        $mb_user_token_info['member_name'] = $member_name;
        $mb_user_token_info['token'] = $token;
        $mb_user_token_info['login_time'] = TIMESTAMP;
        $mb_user_token_info['client_type'] = $client;

        $result = $model_mb_user_token->addMbUserToken($mb_user_token_info);

        if ($result) {
            return $token;
        } else {
            return null;
        }

    }

    /**
     * 注册
     */
    public function registerAction()
    {
        if (Process::islock('reg')) {
            output_error('您的操作过于频繁，请稍后再试');
        }
        $model_member = Model('member');

        $register_info = array();
        $register_info['username'] = $_POST['username'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['password_confirm'];
        $register_info['email'] = $_POST['email'];
        //添加奖励积分
        $register_info['inviter_id'] = intval(base64_decode($_COOKIE['uid'])) / 1;
        $member_info = $model_member->register($register_info);
        if (!isset($member_info['error'])) {
            Process::addprocess('reg');
            $token = $this->_get_token($member_info['member_id'], $member_info['member_name'], $_POST['client']);
            if ($token) {
                output_data(array('username' => $member_info['member_name'], 'userid' => $member_info['member_id'], 'key' => $token));
            } else {
                output_error('注册失败');
            }
        } else {
            output_error($member_info['error']);
        }

    }
}
