<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/13
 * Time: 21:48
 */

namespace Ypk\Modules\SystemManager\Controllers;

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Resultset\Simple;
use Ypk\Logic\AdminLogic;
use Ypk\Logic\GadminLogic;
use Ypk\Models\Admin;
use Ypk\Models\Gadmin;
use Ypk\Modules\Admin\Controllers\ControllerBase;

/**
 * Class AdminController
 * @package Ypk\Modules\System\Controllers
 *
 * 权限管理
 */
class AdminController extends ControllerBase
{
    private $links = array(
        array('url' => array('module' => 'system_manager', 'controller' => 'admin', 'action' => 'admin'), 'lang' => 'limit_admin'),
        array('url' => array('module' => 'system_manager', 'controller' => 'admin', 'action' => 'gadmin'), 'lang' => 'limit_gadmin'),
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,admin');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->adminAction();
        $this->view->render('admin', 'admin');
    }

    /**
     * 管理员列表
     */
    public function adminAction()
    {
        if (isset($_GET['curpage'])) {
            $curpage = $_GET['curpage'];
        } else {
            $curpage = 1;
        }

        //每页显示多少条记录
        $eachnum = 15;

        $model = $this->modelsManager->createBuilder();
        $admin_list = $model->columns('*')->from('Ypk\Models\Admin')->leftJoin('Ypk\Models\Gadmin', 'Ypk\Models\Gadmin.gid = Ypk\Models\Admin.admin_gid')->limit($eachnum, ($curpage - 1) * $eachnum)->orderBy('admin_id DESC')->getQuery()->execute();
        if (count($admin_list) > 0) {
            $admin_list = $admin_list->toArray();
            foreach ($admin_list as $key => $admin) {
                $admin_list[$key] = array_merge_recursive($admin['ypk\Models\Admin']->toArray(), $admin['ypk\Models\Gadmin']->toArray());
            }
        } else {
            $admin_list = array();
        }

        $this->view->setVar('admin_list', $admin_list);

        $count = Admin::count();

        $this->view->setVar('page', getPageShow($count, $eachnum));
        $this->view->setVar('top_link', $this->sublink($this->links, 'admin'));
    }

    /**
     * 管理员删除
     */
    public function admin_delAction()
    {
        if (!empty($_GET['admin_id'])) {
            if ($_GET['admin_id'] == 1) {
                $this->showMessage($this->translation->_('admin_index_not_allow_del'));
            }
            $admin = Admin::findFirst('admin_id=' . intval($_GET['admin_id']));
            if ($admin) {
                if ($admin->delete()) {
                    $this->log($this->translation->_('nc_delete') . $this->translation->_('limit_admin') . '[ID:' . intval($_GET['admin_id']) . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_del_succ'));
                } else {
                    $this->showMessage($this->translation->_('nc_common_del_fail'));
                }
            } else {
                $this->showMessage($this->translation->_('admin_index_admin_not_exist'));
            }

        } else {
            $this->showMessage($this->translation->_('nc_common_del_fail'));
        }
    }

    /**
     * 管理员添加
     */
    public function admin_addAction()
    {
        if (chksubmit()) {
            $model_admin = new AdminLogic();
            $param['admin_name'] = $_POST['admin_name'];
            $param['admin_gid'] = $_POST['gid'];
            $param['admin_password'] = md5($_POST['admin_password']);
            $rs = $model_admin->addAdmin($param);
            if ($rs) {
                $this->log($this->translation->_('nc_add') . $this->translation->_('limit_admin') . '[' . $_POST['admin_name'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('system_manager/admin/admin'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }

        //得到权限组
        $gadmin = Gadmin::find();
        if (count($gadmin) > 0) {
            $gadmin = $gadmin->toArray();
        } else {
            $gadmin = array();
        }
        $this->view->setVar('gadmin', $gadmin);
        $this->view->setVar('top_link', $this->sublink($this->links, 'admin_add'));
        $this->view->setVar('limit', $this->permission());
    }

    /**
     * ajax操作
     */
    public function ajaxAction()
    {
        switch ($_GET['branch']) {
            //管理人员名称验证
            case 'check_admin_name':
                $model_admin = new AdminLogic();
                $condition['admin_name'] = $_GET['admin_name'];
                $list = $model_admin->infoAdmin($condition);
                if (!empty($list)) {
                    exit('false');
                } else {
                    exit('true');
                }
                break;
            //权限组名称验证
            case 'check_gadmin_name':
                $condition = array();
                if (isset($_GET['gid']) && is_numeric($_GET['gid'])) {
                    $condition['gid'] = intval($_GET['gid']);
                }
                $condition['gname'] = $_GET['gname'];
                $info = Gadmin::find(array(
                    "conditions" => getConditionsByParamArray($condition),
                    "bind" => $condition
                ));

                if (count($info) > 0) {
                    exit('false');
                } else {
                    exit('true');
                }
                break;
        }
        $this->view->disable();
    }

    /**
     * 设置管理员权限
     */
    public function admin_editAction()
    {
        $admin_model = new AdminLogic();

        if (chksubmit()) {
            //没有更改密码
            if ($_POST['new_pw'] != '') {
                $data['admin_password'] = md5($_POST['new_pw']);
            }
            $data['admin_id'] = intval($_GET['admin_id']);
            $data['admin_gid'] = intval($_POST['gid']);
            //查询管理员信息
            $result = $admin_model->updateAdmin($data);
            if ($result) {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('limit_admin') . '[ID:' . intval($_GET['admin_id']) . ']', 1);
                $this->showMessage($this->translation->_('admin_edit_success'), getUrl('system_manager/admin/admin'));
            } else {
                $this->showMessage($this->translation->_('admin_edit_fail'), getUrl('system_manager/admin/admin'));
            }
        } else {
            //查询用户信息
            $admininfo = $admin_model->getOneAdmin(intval($_GET['admin_id']));
            if (!is_array($admininfo) || count($admininfo) <= 0) {
                $this->showMessage($this->translation->_('admin_edit_admin_error'), getUrl('system_manager/admin/admin'));
            }
            $this->view->setVar('admininfo', $admininfo);
            $this->view->setVar('top_link', $this->sublink($this->links, 'admin'));

            //得到权限组
            $gadmin = Gadmin::find();
            if (count($gadmin) > 0) {
                $gadmin = $gadmin->toArray();
            } else {
                $gadmin = array();
            }
            $this->view->setVar('gadmin', $gadmin);
        }
    }

    /**
     * 取得所有权限项
     *
     * @return array
     */
    private function permission()
    {
        return read_file_cache('admin_menu', true);
    }

    /**
     * 权限组
     */
    public function gadminAction()
    {
        if (chksubmit()) {
            if (@in_array(1, $_POST['del_id'])) {
                $this->showMessage($this->translation->_('admin_index_not_allow_del'));
            }

            if (!empty($_POST['del_id'])) {
                if (is_array($_POST['del_id'])) {
                    foreach ($_POST['del_id'] as $k => $v) {
                        $gadmin = Gadmin::findFirst('gid=' . intval($v));
                        if ($gadmin != false) {
                            $gadmin->delete();
                        }

                    }
                }
                $this->log($this->translation->_('nc_delete') . $this->translation->_('limit_gadmin') . '[ID:' . implode(',', $_POST['del_id']) . ']', 1);
                $this->showMessage($this->translation->_('nc_common_del_succ'));
            } else {
                $this->showMessage($this->translation->_('nc_common_del_fail'));
            }
        }

        if (isset($_GET['curpage'])) {
            $curpage = $_GET['curpage'];
        } else {
            $curpage = 1;
        }

        //每页显示多少条记录
        $eachnum = 15;

        $list = getModelArrayListByPaging('Ypk\Models\Gadmin', $total_num, '*', '', 'gid DESC', $curpage, $eachnum);

        $pageshow = getPageShow($total_num, $eachnum);

        $this->view->setVar('page', $pageshow);

        $this->view->setVar('list', $list);

        $this->view->setVar('top_link', $this->sublink($this->links, 'gadmin'));
    }

    /**
     * 添加权限组
     */
    public function gadmin_addAction()
    {
        if (chksubmit()) {
            $model = new Gadmin();
            $data['limits'] = encrypt(serialize($_POST['permission']), MD5_KEY . md5($_POST['gname']));
            $data['gname'] = $_POST['gname'];
            if ($model->save($data)) {
                $this->log($this->translation->_('nc_add') . $this->translation->_('limit_gadmin') . '[' . $_POST['gname'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('system_manager/admin/gadmin'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        $this->view->setVar('top_link', $this->sublink($this->links, 'gadmin_add'));
        $this->view->setVar('limit', $this->permission());
    }

    /**
     * 设置权限组权限
     */
    public function gadmin_editAction()
    {
        $gid = intval($_GET['gid']);

        $ginfo = Gadmin::findFirst('gid=' . $gid);
        if ($ginfo == false) {
            $this->showMessage($this->translation->_('admin_set_gadmin_not_exists'));
        }
        if (chksubmit()) {
            $limit_str = encrypt(serialize($_POST['permission']), MD5_KEY . md5($_POST['gname']));
            $data['limits'] = $limit_str;
            $data['gname'] = $_POST['gname'];
            $update = $ginfo->save($data);

            if ($update) {
                $this->log($this->translation->_('nc_edit') . $this->translation->_('limit_gadmin') . '[' . $_POST['gname'] . ']', 1);
                $this->showMessage($this->translation->_('nc_common_save_succ'), getUrl('system_manager/admin/gadmin'));
            } else {
                $this->showMessage($this->translation->_('nc_common_save_succ'));
            }
        }

        //解析已有权限
        $hlimit = decrypt($ginfo->getLimits(), MD5_KEY . md5($ginfo->getGname()));
        $ginfo->setLimits(unserialize($hlimit));
        $ginfo = $ginfo->toArray();
        $this->view->setVar('ginfo', $ginfo);
        $this->view->setVar('limit', $this->permission());
        $this->view->setVar('top_link', $this->sublink($this->links, 'gadmin'));
    }

    /**
     * 组删除
     */
    public function gadmin_delAction()
    {
        if (is_numeric($_GET['gid'])) {
            $gadmin = Gadmin::findFirst('gid=' . intval($_GET['gid']));
            if ($gadmin != false) {
                if ($gadmin->delete()) {
                    $this->log($this->translation->_('nc_delete') . $this->translation->_('limit_gadmin') . '[ID' . intval($_GET['gid']) . ']', 1);
                    $this->showMessage($this->translation->_('nc_common_op_succ'), getUrl('system_manager/admin/gadmin'));
                } else {
                    $this->showMessage($this->translation->_('nc_common_op_fail'));
                }
            } else {
                $this->showMessage($this->translation->_('nc_common_op_fail'));
            }

        } else {
            $this->showMessage($this->translation->_('nc_common_op_fail'));
        }
    }
}