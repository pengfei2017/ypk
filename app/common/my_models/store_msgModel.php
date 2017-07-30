<?php
/**
 * 医生消息模板模型
 */

namespace Ypk\MyModels;

use Ypk\Model;
use Ypk\Db;
use Ypk\Tpl;

class store_msgModel extends Model{
    public function __construct() {
        parent::__construct('store_msg');
    }
    /**
     * 新增医生消息
     * @param unknown $insert
     */
    public function addStoreMsg($insert) {
        $time = time();
        $insert['sm_addtime'] = $time;
        $sm_id = $this->insert($insert);
        if (getConfig('node_chat')) {
            @file_get_contents(NODE_SITE_URL.'/store_msg/?id='.$sm_id.'&time='.$time);
        }
        return $sm_id;
    }

    /**
     * 更新医生消息表
     * @param unknown $condition
     * @param unknown $update
     */
    public function editStoreMsg($condition, $update) {
        return $this->where($condition)->update($update);
    }

    /**
     * 查看医生消息详细
     * @param unknown $condition
     * @param string $field
     */
    public function getStoreMsgInfo($condition, $field = '*') {
        return $this->field($field)->where($condition)->find();

    }

    /**
     * 医生消息列表
     * @param unknown $condition
     * @param string $field
     * @param string $page
     * @param string $order
     */
    public function getStoreMsgList($condition, $field = '*', $page = '0', $order = 'sm_id desc') {
        return $this->field($field)->where($condition)->order($order)->page($page)->select();
    }

    /**
     * 计算消息数量
     * @param unknown $condition
     */
    public function getStoreMsgCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 删除医生消息
     * @param unknown $condition
     */
    public function delStoreMsg($condition) {
        $this->where($condition)->delete();
    }
}