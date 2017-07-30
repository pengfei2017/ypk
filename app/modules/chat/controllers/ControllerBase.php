<?php
namespace Ypk\Modules\Chat\Controllers;

use Phalcon\Mvc\Controller;


/**
 * Class ControllerBase
 * @package Ypk\Modules\Chat\Controllers
 *
 * 前台chat父类
 */
class ControllerBase extends Controller
{
    protected function initialize()
    {
        getTranslation('common');
    }

    /**
     * 输出信息
     *
     * @param string $msg 输出信息
     * @param string /array $url 跳转地址 当$url为数组时，结构为 array('msg'=>'跳转连接文字','url'=>'跳转连接');
     * @param string $show_type 输出格式 默认为html
     * @param string $msg_type 信息类型 succ 为成功，error为失败/错误
     * @param int $is_show 是否显示跳转链接，默认是为1，显示
     * @param string $admin_index_extrajs 要传递到admin/index/index页面执行的扩展JS
     * @param int $time 跳转时间，默认为2秒
     */
    protected final function showMessage($msg, $url = '', $show_type = 'html', $msg_type = 'succ', $is_show = 1, $time = 2000, $admin_index_extrajs = '')
    {
        showMessage($msg, $url, $show_type, $msg_type, $is_show, $time, $admin_index_extrajs);
    }


    /**
     * 消息提示，主要适用于普通页面AJAX提交的情况
     *
     * @param string $message 消息内容
     * @param string $url 提示完后的URL去向
     * @param string $alert_type 提示类型 error/succ/notice 分别为错误/成功/警示
     * @param string $extrajs 扩展JS
     * @param int $time 停留时间
     */
    protected final function showDialog($message = '', $url = '', $alert_type = 'error', $extrajs = '', $time = 2)
    {
        showDialog($message, $url, $alert_type, $extrajs, $time);
    }

}
