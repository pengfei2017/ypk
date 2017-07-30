<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/11
 * Time: 15:59
 */

namespace Ypk\Modules\Mobile\Controllers;


use Phalcon\Mvc\Controller;

/**
 * mobile父类
 *
 * Class ControllerBase
 * @package Ypk\Modules\Mobile\Controllers
 */
class ControllerBase extends Controller
{
    //客户端类型列表
    protected $client_type_array = array('android', 'h5_web', 'wechat', 'ios', 'windows');

    //列表默认分页数
    protected $page = 5;

    public function initialize()
    {
        getTranslation('mobile');

        //分页数处理
        $page = intval($_GET['page']);
        if ($page > 0) {
            $this->page = $page;
        }
    }
}