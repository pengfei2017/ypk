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
 * 分类导航设置管理
 *
 */


class goods_class_navModel extends Model {
    
    public function __construct() {
        parent::__construct('goods_class_nav');
    }

    /**
     * 根据商品分类id取得数据
     * @param num $gc_id
     * @return array
     */
    public function getGoodsClassNavInfoByGcId($gc_id) {
        return $this->where(array('gc_id' => $gc_id))->find();
    }

    /**
     * 保存分类导航设置
     *
     * @param array $insert
     * @param boolean $replace
     * @return boolean
     */
    public function addGoodsClassNav($insert) {
        return $this->insert($insert);
    }
    /**
     * 编辑存分类导航设置
     *
     * @param unknown $update
     * @param unknown $gc_id
     * @return boolean
     */
    public function editGoodsClassNav($update, $gc_id) {
        return $this->where(array('gc_id' => $gc_id))->update($update);
    }

}
