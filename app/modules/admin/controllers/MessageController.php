<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/9
 * Time: 20:37
 */

namespace Ypk\Modules\Admin\Controllers;
use Phalcon\Mvc\View;

/**
 * Class MessageController
 * @package Ypk\Modules\Admin\Controllers
 *
 * 输出系统消息
 */
class MessageController extends ControllerBase
{
    public function initialize()
    {
        //这里重载父类initialize方法，就不会调用父类的initialize方法,除非重载后又调用parent::initialize()方法
        //不重载父类initialize方法，默认会调用父类initialize方法
        //这里父类initialize方法的目的是不执行父类initialize方法，就不会在父类调用验证是否登录的检验
        $this->translation = getTranslation('layout,msg');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $param = $this->request->get('param');
        $paramArr = unserialize(decrypt($param));

        //接受参数
        $msg = $paramArr['msg'];
        $url = $paramArr['url'];
        $show_type = $paramArr['show_type'];
        $msg_type = $paramArr['msg_type'];
        $is_show = $paramArr['is_show'];
        $admin_index_extrajs = $paramArr['admin_index_extrajs'];
        $time = $paramArr['time'];

        if ($admin_index_extrajs != '' && substr(trim($admin_index_extrajs), 0, 7) != '<script') {
            $admin_index_extrajs = '<script type="text/javascript" reload="1">' . $admin_index_extrajs . '</script>';
            $this->cookies->set('admin_index_extrajs', encrypt($admin_index_extrajs), time() + 36000, '/', false, FIRST_LEVEL_DOMAIN_NAME);
        }

        $msg_type = in_array($msg_type, array('succ', 'error')) ? $msg_type : 'error';
        /**
         * 输出类型
         */
        switch ($show_type) {
            case 'json':
                $return = '{';
                $return .= '"msg":"' . $msg . '",';
                $return .= '"url":"' . $url . '"';
                $return .= '}';
                echo $return;
                $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
                break;
            case 'exception':
                echo '<!DOCTYPE html>';
                echo '<html>';
                echo '<head>';
                echo '<meta http-equiv="Content-Type" content="text/html; charset=' . CHARSET . '" />';
                echo '<title></title>';
                echo '<style type="text/css">';
                echo 'body { font-family: "Verdana";padding: 0; margin: 0;}';
                echo 'h2 { font-size: 12px; line-height: 30px; border-bottom: 1px dashed #CCC; padding-bottom: 8px;width:800px; margin: 20px 0 0 150px;}';
                echo 'dl { float: left; display: inline; clear: both; padding: 0; margin: 10px 20px 20px 150px;}';
                echo 'dt { font-size: 14px; font-weight: bold; line-height: 40px; color: #333; padding: 0; margin: 0; border-width: 0px;}';
                echo 'dd { font-size: 12px; line-height: 40px; color: #333; padding: 0px; margin:0;}';
                echo '</style>';
                echo '</head>';
                echo '<body>';
                echo '<h2>' . $this->translation->_('error_info') . '</h2>';
                echo '<dl>';
                echo '<dd>' . $msg . '</dd>';
                echo '<dt><p /></dt>';
                echo '<dd>' . $this->translation->_('error_notice_operate') . '</dd>';
                echo '<dd><p /><p /><p /><p /></dd>';
                echo '</dl>';
                echo '</body>';
                echo '</html>';
                $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
                exit;
                break;
            case 'javascript':
                echo "<script>";
                echo "alert('" . $msg . "');";
                echo "location.href='" . $url . "'";
                echo "</script>";
                $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
                exit;
                break;
            case 'tenpay':
                echo "<html><head>";
                echo "<meta name=\"TENCENT_ONLINE_PAYMENT\" content=\"China TENCENT\">";
                echo "<script language=\"javascript\">";
                echo "window.location.href='" . $url . "';";
                echo "</script>";
                echo "</head><body></body></html>";
                $this->view->setRenderLevel(View::LEVEL_NO_RENDER);
                exit;
                break;
            default:
                /**
                 * 不显示右侧工具条
                 */
                $this->view->setVar("hidden_nctoolbar", 1);
                if (is_array($url)) {
                    foreach ($url as $k => $v) {
                        $url[$k]['url'] = $v['url'] ? $v['url'] : getReferer();
                    }
                }

                $this->view->setVar('html_title', $this->translation->_('nc_html_title'));
                $this->view->setVar('msg', $msg);
                $this->view->setVar('url', $url);
                $this->view->setVar('msg_type', $msg_type);
                $this->view->setVar('is_show', $is_show);
                $this->view->setVar('time', $time);
        }
    }
}