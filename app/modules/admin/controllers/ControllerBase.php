<?php
namespace Ypk\Modules\Admin\Controllers;

use Phalcon\Config\Adapter\Php;
use Phalcon\Mvc\Controller;
use Phalcon\Translate\Adapter\NativeArray;
use Ypk\Logic\AdminLogic;
use Ypk\Logic\GadminLogic;
use Ypk\Models\AdminLog;

/**
 * Class ControllerBase
 * @package Ypk\Modules\Admin\Controllers
 *
 * 系统后台公共方法
 * 包括系统后台父类
 */
class ControllerBase extends Controller
{
    /**
     * 管理员资料 name id group
     */
    protected $admin_info;

    /**
     * 权限内容
     */
    protected $permission;

    /**
     * 菜单
     */
    protected $menu;

    /**
     * 常用菜单
     */
    protected $quick_link;

    /**
     * 语言包翻译对象
     */
    protected $translation;

    protected function initialize()
    {
        /**
         * 验证用户是否登录
         * $admin_info 管理员资料 name id
         */
        $this->admin_info = $this->systemLogin();
        if ($this->admin_info['id'] == 1) {
            // 不是超级管理员，验证权限（admin_id为1是超级管理员）
            $this->checkPermission();
        }
    }

    /**
     * 输出信息
     *
     * @param string $msg 输出信息
     * @param string /array $url 跳转地址 当$url为数组时，结构为 array('msg'=>'跳转连接文字','url'=>'跳转连接');
     * @param string $show_type 输出格式 默认为html
     * @param string $msg_type 信息类型 succ 为成功，error为失败/错误
     * @param int $is_show 是否显示跳转链接，默认是为1，显示
     * @param string $admin_index_extrajs 要传递到admin/index/index页面执行的扩展JS
     * @param int $time 跳转时间，默认为2秒
     */
    protected final function showMessage($msg, $url = '', $show_type = 'html', $msg_type = 'succ', $is_show = 1, $time = 2000, $admin_index_extrajs = '')
    {
        showMessage($msg, $url, $show_type, $msg_type, $is_show, $time, $admin_index_extrajs);
    }


    /**
     * 消息提示，主要适用于普通页面AJAX提交的情况
     *
     * @param string $message 消息内容
     * @param string $url 提示完后的URL去向
     * @param string $alert_type 提示类型 error/succ/notice 分别为错误/成功/警示
     * @param string $extrajs 扩展JS
     * @param int $time 停留时间
     */
    protected final function showDialog($message = '', $url = '', $alert_type = 'error', $extrajs = '', $time = 2)
    {
        showDialog($message, $url, $alert_type, $extrajs, $time);
    }

    /**
     * 取得当前管理员信息
     *
     * @return array 数组类型的返回结果
     */
    protected final function getAdminInfo()
    {
        return $this->admin_info;
    }

    /**
     * 系统后台登录验证
     *
     * @return array 数组类型的返回结果
     */
    protected final function systemLogin()
    {
        //取得cookie内容，解密，和系统匹配
        if ($this->cookies->has('sys_key') && !empty($this->cookies->get('sys_key')->getValue())) {
            $user = unserialize(decrypt($this->cookies->get('sys_key')->getValue(), MD5_KEY));
            if ($user && is_array($user)) {
                if (!key_exists('gid', (array)$user) || !isset($user['sp']) || (empty($user['name']) || empty($user['id']) || empty($user['sign']))) {
                    //@header('Location: ' . getUrl('admin/login/login'));
                    //exit;
                    showDialog('登录凭证已失效，请重新登录！', getUrl('admin/login/login'), 'js');

                } else {
                    $array = array();
                    $array['admin_name'] = $user['name'];
                    $array['admin_password'] = decrypt($user['sign'], PASSWORD_ENCRYPT_KEY);
                    $logic_admin = new  AdminLogic();
                    $admin_info = $logic_admin->infoAdmin($array);
                    if (is_array($admin_info) and !empty($admin_info)) {
                        $this->systemSetKey($user);
                        return $user;
                    } else {
                        //@header('Location: ' . getUrl('admin/login/login'));
                        //exit;
                        showDialog('登录凭证已失效，请重新登录！', getUrl('admin/login/login'), 'js');

                    }
                }
            } else {
                //@header('Location: ' . getUrl('admin/login/login'));
                //exit;
                showDialog('登录凭证已失效，请重新登录！', getUrl('admin/login/login'), 'js');

            }

        } else {
            //@header('Location: ' . getUrl('admin/login/login'));
            //exit;
            showDialog('登录凭证已失效，请重新登录！', getUrl('admin/login/login'), 'js');

        }

        return null;
    }

    /**
     * 系统后台 会员登录后 将会员验证内容写入对应cookie中
     *
     * @param array $user 会员数据
     * @param string $avatar 会员头像
     * @param bool $avatar_compel 布尔类型的返回结果
     */
    protected final function systemSetKey($user, $avatar = '', $avatar_compel = false)
    {
        $this->cookies->set('sys_key', encrypt(serialize($user), MD5_KEY), time() + 3600, '/', false, FIRST_LEVEL_DOMAIN_NAME);
        if ($avatar_compel || $avatar != '') {
            $this->cookies->set('admin_avatar', $avatar, time() + 86400 * 365, '/', false, FIRST_LEVEL_DOMAIN_NAME);
        }
    }

    /**
     * 验证当前管理员权限是否可以进行操作
     * @param  array $url 要检测的路径 不为空的话检测访问指定页面的权限，为空的话检测访问当前页面的权限
     * @return boolean
     */
    protected final function checkPermission($url = array())
    {
        //sp即admin_is_super，是超级管理员的话就返回真
        if ($this->admin_info['sp'] == 1) return true;

        if (!defined('MODULE_NAME')) return true;//只有管理模块才会定义MODULE_NAME常量，管理模块之外的不需要验证管理权限

        if (empty($url)) {
            $module_name = $this->dispatcher->getModuleName();
            $controller = $this->dispatcher->getControllerName();
        } else {
            $module_name = $url['module'];
            $controller = $url['controller'];
        }
        $controller = $controller == '' ? 'index' : $controller;

        $permission = $this->getPermission();

        if (isset($permission[$module_name]) && is_array($permission[$module_name]) && in_array($controller, $permission[$module_name])) {
            return true;
        }
        if (empty($url)) {
            $translation = getTranslation('layout');
            $this->showMessage($translation->_('nc_assign_right'), '', 'html', 'succ', 0);
        }
        return false;
    }

    /**
     * 取得后台菜单的Html形式
     *
     * @return array
     */
    protected final function getNav()
    {
        $_menu = $this->getMenu();
        $_menu = $this->parseMenu($_menu);
        $quicklink = $this->getQuickLink();

        $top_nav = '';
        $left_nav = '';
        $map_nav = '';
        $map_top = '';
        $quick_array = array();
        foreach ($_menu as $key => $value) {
            $top_nav .= '<li data-param="' . $key . '"><a href="javascript:void(0);">' . $value['name'] . '</a></li>';
            $left_nav .= '<div id="admincpNavTabs_' . $key . '" class="nav-tabs">';
            $map_top .= '<li><a href="javascript:void(0);" data-param="map-' . $key . '">' . $value['name'] . '</a></li>';
            $map_nav .= '<div class="admincp-map-div" data-param="map-' . $key . '">';
            foreach ($value['child'] as $ke => $val) {
                if (!empty($val['child'])) {
                    $left_nav .= '<dl><dt><a href="javascript:void(0);"><span class="ico-' . $key . '-' . $ke . '"></span><h3>' . $val['name'] . '</h3></a></dt>';
                    $left_nav .= '<dd class="sub-menu"><ul>';
                    $map_nav .= '<dl><dt>' . $val['name'] . '</dt>';
                    foreach ($val['child'] as $k => $v) {
                        $left_nav .= '<li><a href="javascript:void(0);" data-param="' . $key . '|' . $k . '">' . $v . '</a></li>';
                        $selected = '';
                        if (in_array($key . '|' . $k, $quicklink)) {
                            $selected = 'selected';
                            $quick_array[$key . '|' . $k] = $v;
                        }
                        $map_nav .= '<dd class="' . $selected . '"><a href="javascript:void(0);" data-param="' . $key . '|' . $k . '">' . $v . '</a><i class="fa fa-check-square-o"></i></dd>';
                    }
                    $left_nav .= '</ul></dd></dl>';
                    $map_nav .= '</dl>';
                }
            }
            $left_nav .= '</div>';
            $map_nav .= '</dl></div>';
        }
        $map_nav = '<ul class="admincp-map-nav">' . $map_top . '</ul>' . $map_nav;
        return array($top_nav, $left_nav, $map_nav, $quick_array);
    }

    /**
     * 过滤掉无权查看的菜单
     *
     * @param array $menu
     * @return array
     */
    private final function parseMenu($menu)
    {
        if ($this->admin_info['sp'] == 1) return $menu;
        $permission = $this->getPermission();
        foreach ($menu as $key => $value) {
            if (!isset($permission[$key])) {
                unset($menu[$key]);
                continue;
            }
            foreach ($value['child'] as $ke => $val) {
                foreach ($val['child'] as $k => $v) {
                    if (!in_array($k, $permission[$key])) {
                        unset($menu[$key]['child'][$ke]['child'][$k]);
                    }
                }
            }
        }
        return $menu;
    }

    /**
     * 获取当前用户所在权限组的权限内容
     */
    private final function getPermission()
    {
        if (empty($this->permission)) {
            $logic_gadmin = new GadminLogic();
            $gadmin = $logic_gadmin->getGadminInfoById($this->admin_info['gid']);
            $permission = decrypt($gadmin['limits'], MD5_KEY . md5($gadmin['gname']));
            $this->permission = unserialize($permission);
        }
        return $this->permission;
    }

    /**
     * 获取菜单
     */
    protected final function getMenu()
    {
        if (empty($this->menu)) {
            $this->menu = read_file_cache('admin_menu', true);
        }
        return $this->menu;
    }

    /**
     * 获取快捷操作
     */
    protected final function getQuickLink()
    {
        if ($this->admin_info['qlink'] != '') {
            return explode(',', $this->admin_info['qlink']);
        } else {
            return array();
        }
    }

    /**
     * 取得顶部小导航
     *
     * @param array $links
     * @param string $actived 当前页
     * @return string 返回顶部小导航的html字符串
     */
    protected final function sublink($links = array(), $actived = '')
    {
        $linkstr = '';
        foreach ($links as $k => $v) {
            if (empty($v['url']['controller'])) $v['url']['controller'] = 'index';
            if (empty($v['url']['action'])) $v['url']['action'] = 'index';
            if (!$this->checkPermission($v['url'])) continue;
            $href = ($v['url']['action'] == $actived ? null : "href=\"/{$v['url']['module']}/{$v['url']['controller']}/{$v['url']['action']}\"");
            $class = ($v['url']['action'] == $actived ? "class=\"current\"" : null);
            $lang = isset($v['text']) && !empty($v['text']) ? $v['text'] : getLang($v['lang']);
            $linkstr .= sprintf('<li><a %s %s><span>%s</span></a></li>', $href, $class, $lang);
        }
        return "<ul class=\"tab-base nc-row\">{$linkstr}</ul>";
    }

    /**
     * 记录系统日志到日志数据表
     *
     * @param string $lang 日志语言包
     * @param integer $state 1成功0失败null不出现成功失败提示
     * @param string $admin_name
     * @param integer $admin_id
     * @return boolean
     */
    protected final function log($lang = '', $state = 1, $admin_name = '', $admin_id = 0)
    {
        $translate = getTranslation('common');
        if (!getConfig('sys_log') || !is_string($lang)) return false;
        if ($admin_name == '') {
            if (!empty(cookie('sys_key'))) {
                $sys_key = cookie('sys_key');
                if (!empty($sys_key)) {
                    $admin = unserialize(decrypt($sys_key, MD5_KEY));
                    $admin_name = $admin['name'];
                    $admin_id = $admin['id'];
                }
            }
        }
        $data = array();
        if (is_null($state)) {
            $state = null;
        } else {
            $state = $state ? '' : $translate->_('nc_fail');
        }
        $data['content'] = $lang . $state;
        $data['admin_name'] = $admin_name;
        $data['createtime'] = TIMESTAMP;
        $data['admin_id'] = $admin_id;
        $data['ip'] = getIp();
        $data['url'] = $this->dispatcher->getControllerName() . '&' . $this->dispatcher->getActionName();

        $admin_log = new AdminLog();
        return $admin_log->save($data);
    }

    /**
     * 输出JSON
     *
     * @param mixed $errorMessage 错误信息 为空则表示成功
     */
    protected function jsonOutput($errorMessage = false)
    {
        $data = array();

        if ($errorMessage === false) {
            $data['result'] = true;
        } else {
            $data['result'] = false;
            $data['message'] = $errorMessage;
        }

        $jsonFlag = $GLOBALS['debug'] && version_compare(PHP_VERSION, '5.4.0') >= 0
            ? JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            : 0;

        echo json_encode($data, $jsonFlag);
        exit;
    }
}
