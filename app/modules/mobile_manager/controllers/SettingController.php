<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/13
 * Time: 3:51
 */

namespace Ypk\Modules\MobileManager\Controllers;

use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Tpl;


/**
 * 手机端微信公众账号二维码设置
 *
 * Class SettingController
 * @package Ypk\Modules\MobileManager\Controllers
 */
class SettingController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout');
    }

    public function indexAction()
    {
        $this->settingAction();
        $this->view->pick('setting/setting');
    }

    /**
     * 基本设置
     */
    public function settingAction()
    {
        $model_setting = Model('setting');
        if (chksubmit()) {
            $update_array = array();
            $update_array['signin_isuse'] = intval($_POST['signin_isuse']) == 1 ? 1 : 0;
            $update_array['points_signin'] = intval($_POST['points_signin']) ? $_POST['points_signin'] : 0;
            $result = $model_setting->updateSetting($update_array);
            if ($result === true) {
                $this->log('编辑手机端设置', 1);
                showDialog(getLang('nc_common_save_succ'));
            } else {
                showDialog(getLang('nc_common_save_fail'));
            }
        }
        $list_setting = $model_setting->getListSetting();
        Tpl::output('list_setting', $list_setting);
    }
}