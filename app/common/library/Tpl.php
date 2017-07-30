<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/4
 * Time: 1:04
 */

namespace Ypk;

/**
 * ycg
 *
 * Class Tpl
 * @package Ypk
 */
class Tpl
{
    /**
     * 抛出变量
     * @param string $out
     * @param string $input
     */
    public static function output($out, $input = '')
    {
        $output = $GLOBALS['di']['view']->getVar('output');
        $output[$out] = $input;
        $GLOBALS['di']['view']->setVar('output', $output);
    }

//    /**
//     * 向前台抛出布局文件名称
//     * @param string $input
//     */
//    public static function setLayout($input = '')
//    {
//        $output = $GLOBALS['di']['view']->getVar('layout');
//        $output['layout'] = $input;
//        $GLOBALS['di']['view']->setVar('output', $output);
//    }
}