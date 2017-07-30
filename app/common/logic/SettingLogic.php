<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/13
 * Time: 0:32
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Setting;

/**
 * Class SettingLogic
 * @package Ypk\Logic
 *
 * 系统设置内容
 */
class SettingLogic extends Model
{
    /**
     * 读取系统设置信息
     *
     * @param string $name 系统设置信息名称
     * @return array 数组格式的返回结果
     */
    public function getRowSetting($name)
    {
        $setting = Setting::findFirst(array(
            "conditions" => getConditionsByParamArray(array('name' => $name)),
            "bind" => array('name' => $name)
        ));
        if ($setting) {
            return $setting->toArray();
        } else {
            return null;
        }
    }

    /**
     * 读取系统设置列表
     *
     * @return array 数组格式的返回结果
     */
    public function getListSetting()
    {
        $result = Setting::find();
        /**
         * 整理
         */
        $list_setting = array();
        if (count($result) > 0) {
            foreach ($result as $v) {
                $list_setting[$v->getName()] = $v->getValue();
            }
        }
        return $list_setting;
    }

    /**
     * 更新信息
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function updateSetting($param)
    {
        if (empty($param)) {
            return false;
        }

        if (is_array($param)) {
            foreach ($param as $k => $v) {
                $specialkeys_arr = array('statistics_code');
                $value = (in_array($k, $specialkeys_arr) ? htmlentities($v, ENT_QUOTES) : $v);
                $setting = Setting::findFirst(array(
                    "conditions" => getConditionsByParamArray(array('name' => $k)),
                    "bind" => array('name' => $k)
                ));
                if (!$setting) {
                    $setting = new Setting();
                }
                $result = $setting->save(array(
                    'name' => $k,
                    'value' => $value
                ));
                if ($result !== true) {
                    return $result;
                }
            }

            delete_file_cache('setting');

            return true;
        } else {
            return false;
        }
    }
}