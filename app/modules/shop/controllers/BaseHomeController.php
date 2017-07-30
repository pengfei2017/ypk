<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 15:09
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class BaseHomeController extends ControllerBase
{
    /**
     * 语言包翻译对象
     */
    protected $translation;

    protected function initialize()
    {
        parent::initialize();

        Tpl::output('setting_config',$GLOBALS['setting_config']);
        $this->view->setVar('setting_config',$GLOBALS['setting_config']);

        //输出头部的公用信息
        $this->showLayout();
        //输出会员信息
        $this->getMemberAndGradeInfo(false);

        $lang=getTranslation('common,home_layout,store_layout');
        $this->view->setVar('lang',$lang);

        //Tpl::setDir('home');

        //Tpl::setLayout('home_layout');
        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout('home_layout');

//        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK') {
//            $_GET = Language::getGBK($_GET);
//        }
        if (!getConfig('site_status'))
        {
            $this->showMessage(getConfig('closed_reason'),'', '','exception');
        }
        // 自动登录
        $this->auto_login();
    }
}