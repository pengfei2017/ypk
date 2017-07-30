<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/30
 * Time: 22:37
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\SellerGroup;

class SellerGroupLogic extends Model {

    /**
     * 读取列表
     * @param array $condition
     *
     */
    public function getSellerGroupList($condition, $page='', $order='', $field='*') {
        $result = $this->field($field)->where($condition)->page($page)->order($order)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     *
     */
    public function getSellerGroupInfo($condition) {
        $result = $this->where($condition)->find();
        return $result;
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function addSellerGroup($param){
        return $this->insert($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editSellerGroup($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delSellerGroup($condition){
        $model = new SellerGroup();
        if($model->delete()){
            return true;
        }else{
            return false;
        }
        //return $this->where($condition)->delete();
    }

}