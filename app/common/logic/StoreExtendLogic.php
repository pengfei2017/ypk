<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 14:08
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\StoreExtend;

class StoreExtendLogic extends Model
{
    public function __construct(){
       // parent::__construct('store_extend');
    }

    /**
     * 查询医生扩展信息
     *
     * @param int $store_id 医生编号
     * @param string $field 查询字段
     * @return array
     */
    public function getStoreExtendInfo($condition, $field = '*') {
        return $this->field($field)->where($condition)->find();
    }

    /*
     * 编辑医生扩展信息
     *
     * @param array $update 更新信息
     * @param array $condition 条件
     * @return bool
     */
    public function editStoreExtend($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除医生扩展信息
     */
    public function delStoreExtend($condition)
    {
        $result = StoreExtend::findFirst($condition);
        if($result){
            if($result->delete()){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

        //return $this->where($condition)->delete();
    }

    /**
     * 新增
     * @param unknown $data
     * @return Ambigous <mixed, boolean>
     */
    public function addStoreExtend($data) {
        $model = new StoreExtend();
        if($model->save($data)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 列表查询
     * @param unknown $condition
     */
    public function getStoreExendList($condition = array(), $limit = '') {
        return $this->where($condition)->limit($limit)->select();
    }

    /**
     * 取数量
     * @param unknown $condition
     */
    public function getStoreExtendCount($condition = array()) {
        return $this->where($condition)->count();
    }

}
