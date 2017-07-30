<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/17
 * Time: 10:10
 */

namespace Ypk\Modules\Admin\Controllers;


use Phalcon\Mvc\View;

/**
 * Class AboutusController
 * @package Ypk\Modules\Admin\Controllers
 *
 * 关于我们页面
 */
class AboutusController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('dashboard');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->aboutusAction();
        $this->view->render('aboutus', 'aboutus');
    }

    /**
     * 关于我们
     */
    public function aboutusAction()
    {
        $version = getConfig('application.version');
        $v_date = substr($version, 0, 4) . "." . substr($version, 4, 2);
        $s_date = substr(getConfig('application.setup_date'), 0, 10);
        $this->view->setVar('v_date', $v_date);
        $this->view->setVar('s_date', $s_date);

        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
    }
}