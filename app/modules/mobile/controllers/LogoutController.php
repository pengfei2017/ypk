<?php
/**
 * 注销登录
 */


namespace Ypk\Modules\Mobile\Controllers;


class LogoutController extends MobileMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 注销登录
     */
    public function indexAction()
    {
        if (empty($_POST['username']) || !in_array($_POST['client'], $this->client_type_array)) {
            output_error('参数错误');
        }

        $model_mb_user_token = Model('mb_user_token');

        if ($this->member_info['member_name'] == $_POST['username']) {
            $condition = array();
            $condition['member_id'] = $this->member_info['member_id'];
            $condition['client_type'] = $_POST['client'];
            $model_mb_user_token->delMbUserToken($condition); //注销成功，从数据库中删除登录产生的key
            output_data('1');
        } else {
            output_error('参数错误');
        }
    }

}
