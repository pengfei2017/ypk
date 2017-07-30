<?php

namespace Ypk\Modules\Admin\Controllers;

use Phalcon\Mvc\View;
use Ypk\Logic\AdminLogic;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,index,admin');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        //输出管理员信息
        $this->view->setVar('admin_info', $this->getAdminInfo());

        //输出菜单
        $result = $this->getNav();
        list($top_nav, $left_nav, $map_nav, $quicklink) = $result;
        $this->view->setVar('html_title', $this->translation->_('homepage'));
        $this->view->setVar('top_nav', $top_nav);
        $this->view->setVar('left_nav', $left_nav);
        $this->view->setVar('map_nav', $map_nav);
        // 快捷菜单
        $this->view->setVar('quicklink', $quicklink);

        //检测是否有admin/message/index页面传递过来的额外的js脚本要在本页面运行
        if ($this->cookies->has('admin_index_extrajs') && !empty($this->cookies->get('admin_index_extrajs')->getValue())) {
            $this->view->setVar('admin_index_extrajs', decrypt($this->cookies->get('admin_index_extrajs')->getValue()));
            //$this->cookies->delete('admin_index_extrajs')和$this->cookies->get('admin_index_extrajs')->delete()这两个方法在保存cookie时，若设置了域名那个参数，这两个方法在删除对应cookie时失效，没作用，删不掉的，所以这是采用下面的任一方法删除
            //deleteMyCookie('admin_index_extrajs');
            $this->cookies->set('admin_index_extrajs', null, time() - 3153600000, '/', false, FIRST_LEVEL_DOMAIN_NAME);
        }
    }

    /**
     * 退出
     */
    public function logoutAction()
    {
        //$this->cookies->delete('sys_key')和$this->cookies->get('sys_key')->delete()这两个方法在保存cookie时，若设置了域名那个参数，这两个方法在删除对应cookie时失效，没作用，删不掉的，所以这是采用下面的任一方法删除
        deleteMyCookie('sys_key'); //phalcon自带的cookie操作方法一旦出现exit方法的调用，将失效，所以phalcon自带的cookie操作方法只能与$this->view->disable();return;搭配使用
        //php自带的cookie操作方法即使出现exit方法的调用，仍然能操作cookie成功，所以与exit搭配使用
        //$this->cookies->set('sys_key', null, time() - 3153600000, '/', false, FIRST_LEVEL_DOMAIN_NAME);
        @header("Location: " . getUrl('admin/login/login'));
        //$this->view->disable();
        //return;
        exit;
    }

    /**
     * 修改密码
     */
    public function modifypwAction()
    {
        if (chksubmit()) {
            if (trim($_POST['new_pw']) !== trim($_POST['new_pw2'])) {
                //showMessage('两次输入的密码不一致，请重新输入');
                $this->showMessage($this->translation->_('index_modifypw_repeat_error'));
            }
            $admininfo = $this->getAdminInfo();
            //查询管理员信息
            $admin_model = new AdminLogic();
            $admininfo = $admin_model->getOneAdmin($admininfo['id']);
            if (!$admininfo) {
                $this->showMessage($this->translation->_('index_modifypw_admin_error'));
            }
            //旧密码是否正确
            if ($admininfo['admin_password'] != md5(trim($_POST['old_pw']))) {
                $this->showMessage($this->translation->_('index_modifypw_oldpw_error'));
            }
            $new_pw = md5(trim($_POST['new_pw']));
            $update = array();
            $update['admin_password'] = $new_pw;
            $update['admin_id'] = $admininfo['admin_id'];
            $result = $admin_model->updateAdmin($update);
            if ($result) {
                $this->showDialog($this->translation->_('index_modifypw_success'), getUrl('admin/index/logout'), 'succ');
            } else {
                $this->showDialog($this->translation->_('index_modifypw_fail'), '', '', '$("#modifypw_btn").click();');
            }
        }

        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->disableLevel(View::LEVEL_LAYOUT);
    }

    public function save_avatarAction()
    {
        $admininfo = $this->getAdminInfo();
        $admin_model = new AdminLogic();
        $admininfo = $admin_model->getOneAdmin($admininfo['id']);
        if ($_GET['avatar'] == '') {
            echo false;
            die;
        }

        if (!empty(cookie('admin_avatar'))) {
            if (file_exists(BASE_UPLOAD_PATH . '/' . ATTACH_ADMIN_AVATAR . '/' . cookie('admin_avatar'))) {
                @unlink(BASE_UPLOAD_PATH . '/' . ATTACH_ADMIN_AVATAR . '/' . cookie('admin_avatar'));
            }
        }

        if (!realpath(BASE_UPLOAD_PATH . '/' . ATTACH_ADMIN_AVATAR . '/')) {
            mkDirs(BASE_UPLOAD_PATH . '/' . ATTACH_ADMIN_AVATAR . '/');
        }

        $update['admin_avatar'] = $_GET['avatar'];
        $update['admin_id'] = $admininfo['admin_id'];
        $result = $admin_model->updateAdmin($update);
        if ($result) {
            setMyCookie('admin_avatar', $_GET['avatar'], 86400 * 365, '/', FIRST_LEVEL_DOMAIN_NAME);
            //setMyCookie存的，用$this->cookies->get获取到的cookie对象取值一直为空，因为setMyCookie默认没加密，用$this->cookies->get获取到的无法解密，而$this->cookies->set存的默认加密了，所以用 $this->cookies->set存，也可以让setMyCookie默认也用和phalcon同样的加密函数，保持一致就可以互相解密了
            //$this->cookies->set('admin_avatar', $_GET['avatar'], time() + 86400 * 365, '/', false, FIRST_LEVEL_DOMAIN_NAME);
        }
        echo $result;
        die;
    }
}

