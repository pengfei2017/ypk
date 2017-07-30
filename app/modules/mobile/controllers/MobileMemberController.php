<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/11
 * Time: 16:13
 */

namespace Ypk\Modules\Mobile\Controllers;

/**
 * 前台首页用户父类
 *
 * Class MobileMemberController
 * @package Ypk\Modules\Mobile\Controllers
 */
class MobileMemberController extends ControllerBase
{

    protected $member_info = array();

    public function initialize()
    {
        parent::initialize();

        $agent = $_SERVER['HTTP_USER_AGENT'];
        if (strpos($agent, "MicroMessenger") && $_GET["act"] == 'auto') {
            $this->appId = getConfig('app_weixin_appid');
            $this->appSecret = getConfig('app_weixin_secret');
        } else {
            $model_mb_user_token = Model('mb_user_token');
            $key = $_POST['key']; //获取用户令牌
            if (empty($key)) {
                $key = $_GET['key'];
            }

            //验证用户的登录时产生的令牌
            $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);
            if (empty($mb_user_token_info)) {
                output_error('请登录', array('login' => '0'));
            }

            //获取登录用户对象信息
            $model_member = Model('member');
            $this->member_info = $model_member->getMemberInfoByID($mb_user_token_info['member_id']);

            if (empty($this->member_info)) {
                output_error('请登录', array('login' => '0'));
            } else {
                $this->member_info['client_type'] = $mb_user_token_info['client_type'];
                $this->member_info['openid'] = $mb_user_token_info['openid'];
                $this->member_info['token'] = $mb_user_token_info['token'];
                $level_name = $model_member->getOneMemberGrade($mb_user_token_info['member_id']); //获取会员等级（原来的）
                $this->member_info['level_name'] = $level_name['level_name'];
                //读取卖家信息
                $seller_info = Model('seller')->getSellerInfo(array('member_id' => $this->member_info['member_id']));
                $this->member_info['store_id'] = $seller_info['store_id'];
            }
        }
    }

    public function getOpenId()
    {
        return $this->member_info['openid'];
    }

    public function setOpenId($openId)
    {
        $this->member_info['openid'] = $openId;
        Model('mb_user_token')->updateMemberOpenId($this->member_info['token'], $openId);
    }
}