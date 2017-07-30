<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 14:30
 */

namespace Ypk\Logic;

use Ypk\Model;

class StoreSnsSettingLogic extends Model {

    /**
     * 获取单条动态设置设置信息
     *
     * @param unknown $condition
     * @param string $field
     * @return array
     */
    public function getStoreSnsSettingInfo($condition, $field = '*') {
        return $this->field($field)->where($condition)->find();
    }

    /**
     * 保存医生动态设置
     *
     * @param unknown $insert
     * @return boolean
     */
    public function saveStoreSnsSetting($insert, $replace) {
        return $this->insert($insert, $replace);
    }
}