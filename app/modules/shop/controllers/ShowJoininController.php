<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/27
 * Time: 22:36
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Logic\HelpLogic;
use Ypk\Tpl;

class ShowJoininController extends BaseHomeController
{

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('home_login_index');
        $this->view->setVar('lang', $this->translation);
    }

    /**
     * 医生开店页
     *
     */
    public function indexAction()
    {
        $code_info = getConfig('store_joinin_pic');
        $info['pic'] = array();
        if (!empty($code_info)) {
            $info = unserialize($code_info);
        }
        $this->view->setVar('pic_list', $info['pic']);//首页图片
        $this->view->setVar('show_txt', $info['show_txt']);//贴心提示
        $model_help = new HelpLogic();
        $condition['type_id'] = '1';//入驻指南
        $help_list = $model_help->getHelpList($condition, '', 4);//显示4个
        $this->view->setVar('help_list', $help_list);
        $this->view->setVar('article_list', '');//底部不显示文章分类
        $this->view->setVar('show_sign', 'joinin');
        $this->view->setVar('html_title', getConfig('site_name') . ' - ' . '商家入驻');

        //Tpl::setLayout('store_joinin_layout');
        $this->view->setVar('layout', 'store_joinin_layout');

        $this->view->render('Show_joinin', 'store_joinin');
    }

}