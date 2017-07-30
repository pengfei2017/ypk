<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 18:45
 */

namespace Ypk\Logic;

use Ypk\Model;

class StoreDistributionLogic extends Model {

    /**
     * 取得列表
     * @param array $condition
     * @param string $pagesize
     * @param string $order
     * @return mixed
     */
    public function getStoreDistributionList($condition = array(), $pagesize = '', $order = 'distri_id desc') {
        return $this->where($condition)->order($order)->page($pagesize)->select();
    }

    /**
     * 增加新记录
     * @param unknown $data
     * @return
     */
    public function addStoreDistribution($data) {
        return $this->insert($data);
    }

    /**
     * 取单条信息
     * @param unknown $condition
     */
    public function getStoreDistributionInfo($condition) {
        return $this->where($condition)->find();
    }

    /**
     * 更新记录
     * @param unknown $condition
     * @param unknown $data
     */
    public function editStoreDistribution($data,$condition) {
        return $this->where($condition)->update($data);
    }

    /**
     * 取得数量
     * @param unknown $condition
     */
    public function getStoreDistributionCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 删除记录
     * @param unknown $condition
     */
    public function delStoreDistribution($condition) {
        return $this->where($condition)->delete();
    }
}