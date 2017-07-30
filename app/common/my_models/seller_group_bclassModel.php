<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 23:40
 */

namespace Ypk\MyModels;

use Ypk\Model;
use Ypk\Db;
use Ypk\Tpl;

/**
 * 卖家账号组绑定分类模型
 */
class seller_group_bclassModel extends Model{

    public function __construct(){
        parent::__construct('seller_group_bclass');
    }

    /**
     * 读取列表
     * @param array $condition
     *
     */
    public function getSellerGroupBclasList($condition, $page='', $order='', $field='*', $key = '', $group = '') {
        $result = $this->field($field)->where($condition)->page($page)->group($group)->order($order)->limit(false)->key($key)->select();
        return $result;
    }

    /**
     * 读取单条记录
     * @param array $condition
     *
     */
    public function getSellerGroupBclassInfo($condition) {
        $result = $this->where($condition)->find();
        return $result;
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function addSellerGroupBclass($param){
        return $this->insertAll($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editSellerGroupBclass($update, $condition){
        return $this->where($condition)->update($update);
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delSellerGroupBclass($condition){
        return $this->where($condition)->delete();
    }

}
