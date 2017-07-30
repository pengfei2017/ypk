<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/8
 * Time: 17:27
 */

namespace Ypk\Modules\Member\Controllers;


class IndexController extends BaseLoginController
{
    public function indexAction()
    {
        if (intval(getSession('is_login')) !== 1) {
            @header("Location:" . getUrl('member/login/index'));
            exit;
        } else {
            @header("Location:" . getUrl('shop/member/home'));
            exit;
        }
    }
}