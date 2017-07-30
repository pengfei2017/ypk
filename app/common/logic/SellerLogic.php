<?php
/**
 * 卖家帐号处理逻辑
 * User: Administrator
 * Date: 2016/11/27
 * Time: 20:52
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Seller;

class SellerLogic extends Model {

    /**
     * 读取列表
     * @param $condition
     * @param string $page
     * @param string $order
     * @param string $field
     * @return mixed
     */
    public function getSellerList($condition, $page='', $order='', $field='*') {
        $result = $this->field($field)->where($condition)->page($page)->order($order)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     * @return array
     */
    public function getSellerInfo($condition) {
        $result=Seller::findFirst($condition);
        if($result){
            return $result->toArray();
        }
        else{
            return array();
        }
    }

    /**
     *  判断是否存在
     * @param array $condition
     * @return bool
     */
    public function isSellerExist($condition) {
        $result = $this->getSellerInfo($condition);
        if(empty($result)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 增加
     * @param array $param
     * @return bool|Seller
     */
    public function addSeller($param){
        if (empty($param)){
            return false;
        }
        if(is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $model = new Seller();
            $result = $model->save($tmp);
            return $result;
        }
        else{
            return false;
        }
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editSeller($update, $condition){
        $result = Seller::findFirst($condition);
        if($result->save($update)){
            return true;
        }else{
            return false;
        }
       // return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delSeller($condition){
        $model = new Seller($condition);
        if($model->delete()){
            return true;
        }else{
            return false;
        }
        //return $this->where($condition)->delete();
    }

}