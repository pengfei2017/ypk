<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/20
 * Time: 12:08
 */

//todo 这个MD5_KEY 必须与配置里边的保持一致
define('MD5_KEY', md5('d8c1b72a46ad859ec78cec5cf4f547e2'));

/**
 * @return mixed
 */
function check_login()
{
    //取得cookie内容，解密，和系统匹配
    if ($_GET['user_type'] == "user" || $_GET['user_type'] == "store") {
        if (!empty($_SESSION['is_login']) && intval($_SESSION['is_login']) == 1) {
            //session用户前台登录验证
            return $_SESSION['member_id'] . '_' . $_SESSION['member_name'];
        } else {
            alert('你还没有登录,没有上传权限!');
            return false;
        }
    } elseif ($_GET['user_type'] == "admin") {
        if (cookie('sys_key') && !empty(cookie('sys_key'))) {
            //cookie用于后台登录验证
            $user = unserialize(decrypt(cookie('sys_key'), MD5_KEY));
            if ($user && is_array($user) && !empty($user['id'])) {
                return $user['id'] . '_' . $user['name'];
            } else {
                alert('你还没有登录,没有上传权限!');
                return false;
            }
        }
    } else {
        alert('该用户身份无操作权限!');
        return false;
    }
}