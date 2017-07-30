<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/8
 * Time: 21:40
 *
 * 验证码
 */

namespace Ypk\Modules\Admin\Controllers;


use Phalcon\Mvc\Controller;
use Ypk\Seccode;

class SeccodeController extends Controller
{
    /**
     * 产生验证码
     *
     */
    public function makecodeAction()
    {
        $seccode = makeSeccode($_GET['hash']); //获取生成的验证码，并把验证码写入cookie
        @header("Expires: -1");
        @header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
        @header("Pragma: no-cache");

        $width = 90;
        $height = 26;
        if ($_GET['type']) {
            $param = explode(',', $_GET['type']);
            $width = intval($param[1]);
            $height = intval($param[0]);
        }

        $code = new Seccode();
        $code->code = $seccode;
        $code->width = $width;
        $code->height = $height;
        $code->background = 1;
        $code->adulterate = 1;
        $code->scatter = '';
        $code->color = 1;
        $code->size = 0;
        $code->shadow = 1;
        $code->animator = 0;
        $code->datapath = BASE_PATH . '/public/resource/seccode/';
        $code->display();
        $this->view->disable();
    }

    /**
     * AJAX验证
     *
     */
    public function checkAction()
    {
        if (checkSeccode($_GET['hash'], $_GET['captcha'])) {
            exit('true');
        } else {
            exit('false');
        }
    }
}