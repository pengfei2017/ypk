<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/11
 * Time: 16:10
 */

namespace Ypk\Modules\Mobile\Controllers;

/**
 * 手机端前台首页父类
 * Class MobileHomeController
 * @package Ypk\Modules\Mobile\Controllers
 */
class MobileHomeController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
    }

    protected function getMemberIdIfExists()
    {
        $key = $_POST['key'];
        if (empty($key)) {
            $key = $_GET['key'];
        }

        $model_mb_user_token = Model('mb_user_token');
        $mb_user_token_info = $model_mb_user_token->getMbUserTokenInfoByToken($key);
        if (empty($mb_user_token_info)) {
            return 0;
        }

        return $mb_user_token_info['member_id'];
    }
}