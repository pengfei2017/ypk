<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/6
 * Time: 12:10
 * 登录
 * 包括 登录 验证 退出 操作
 */

namespace Ypk\Modules\Admin\Controllers;


use Ypk\Logic\AdminLogic;
use Ypk\Logic\GadminLogic;
use Ypk\Process;
use Ypk\Validate;

class LoginController extends ControllerBase
{
    /**
     * 不进行父类的登录验证，所以增加构造方法重写了父类的构造方法
     */
    public function initialize()
    {
        $this->translation = getTranslation('common,layout,login');
        $this->view->setVar('lang', $this->translation);
    }

    public function loginAction()
    {
        $result = chksubmit(true, true, 'num');
        if ($result) {
            if ($result === 'token_error') {
                $this->showDialog($this->translation->_('login_index_token_wrong'));
            } elseif ($result === -11) {
                $this->showMessage($this->translation->_('login_index_token_wrong'));
            } elseif ($result === 'seccode_error') {
                $this->showDialog($this->translation->_('login_index_checkcode_wrong'));
            } elseif ($result === -12) {
                $this->showMessage($this->translation->_('login_index_checkcode_wrong'));
            }
            if (Process::islock('admin')) {
                $this->showMessage($this->translation->_('nc_common_op_repeat'));
            }
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["user_name"], "require" => "true", "validator" => "", "message" => $this->translation->_('login_index_username_null')),
                array("input" => $_POST["password"], "require" => "true", "validator" => "", "message" => $this->translation->_('login_index_password_null')),
                array("input" => $_POST["captcha"], "require" => "true", "validator" => "", "message" => $this->translation->_('login_index_checkcode_null')),
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($this->translation->_('error') . $error);
            } else {
                $logic_admin = new AdminLogic();
                $array = array();
                $array['admin_name'] = $this->request->getPost('user_name');
                $array['admin_password'] = md5(trim($this->request->getPost('password')));
                $admin_info = $logic_admin->infoAdmin($array);
                if (is_array($admin_info) and !empty($admin_info)) {
                    if ($admin_info['admin_gid'] > 0) {
                        $logic_gamdin = new GadminLogic();
                        $gamdin_info = $logic_gamdin->getGadminInfoById($admin_info['admin_gid']);
                        $group_name = $gamdin_info['gname'];
                    } else {
                        $group_name = '超级管理员';
                    }
                    $array = array();
                    $array['name'] = $admin_info['admin_name'];
                    $array['sign'] = encrypt($admin_info['admin_password'], PASSWORD_ENCRYPT_KEY);
                    $array['id'] = $admin_info['admin_id'];
                    $array['time'] = $admin_info['admin_login_time'];
                    $array['ip'] = getIp();
                    $array['gid'] = $admin_info['admin_gid'];
                    $array['gname'] = $group_name;
                    $array['sp'] = $admin_info['admin_is_super'];
                    $array['qlink'] = $admin_info['admin_quick_link'];
                    $this->systemSetKey($array, $admin_info['admin_avatar'], true);
                    $update_info = array(
                        'admin_id' => $admin_info['admin_id'],
                        'admin_login_num' => ($admin_info['admin_login_num'] + 1),
                        'admin_login_time' => TIMESTAMP
                    );
                    $logic_admin->updateAdmin($update_info);
                    $this->log($this->translation->_('nc_login'), 1);
                    Process::clear('admin');

                    //@header('Location和exit搭配，能实现跳转，任何地方都能用，但是由于使用exit，cookies不能写入浏览器
                    //$this->view->disable()和return搭配，只能在action中使用，可以实现exit的功能，只使用return，仍然会渲染html页面
                    //使用$this->view->disable()，仍然可以写入浏览器cookies
                    //$this->dispatcher->forward()和$this->response->redirect()都不能和exit搭配使用，一旦和exit搭配，页面将不会跳转了
                    @header('Location: ' . getUrl('admin/index/index'));

                    //这里要写入登录后的用户信息到cookies，所以不能使用exit
                    $this->view->disable();
                    return;
                } else {
                    Process::addprocess('admin');
                    $this->showMessage($this->translation->_('login_index_username_password_wrong'), getUrl('admin/login/login'));
                }
            }
        }
        $this->view->setVar('html_title', $this->translation->_('login_index_need_login'));
    }

    public function indexAction()
    {
    }
}