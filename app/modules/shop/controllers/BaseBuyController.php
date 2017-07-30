<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 15:10
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class BaseBuyController extends ControllerBase
{
    /**
     * 语言包翻译对象
     */
    protected $translation;

    protected $member_info = array();   // 会员信息

    protected function initialize()
    {
        parent::initialize();

        Tpl::output('setting_config',$GLOBALS['setting_config']);
        $this->view->setVar('setting_config',$GLOBALS['setting_config']);

        $lang = getTranslation('common,home_layout');
        $this->view->setVar('lang', $lang);
        //输出会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        $this->view->setVar('member_info', $this->member_info);

        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout("buy_layout");

        //Tpl::setLayout('buy_layout');
//        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
//            $_GET = Language::getGBK($_GET);
//        }
        if (!getConfig('site_status')) {
            $this->showMessage(getConfig('closed_reason'), '', '', 'exception');
        }
        //获取导航
        $this->view->setVar('nav_list', read_file_cache('nav', true));

        $this->view->setVar('contract_list', (new \Ypk\Logic\ContractLogic())->getContractItemByCache());
    }
}