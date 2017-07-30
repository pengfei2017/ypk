<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 1:10
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Brand;

/**
 * Class BrandLogic
 * @package Ypk\Logic
 *
 * 品牌
 */
class BrandLogic extends Model
{
    /**
     * 通过的品牌列表
     *
     * @param array $condition
     * @param string $field
     * @param int $page 页容量
     * @param string $order
     * @param int $limit
     * @return array
     */
    public function getBrandPassedList($condition = array(), $field = '*', $page = 0, $order = 'brand_sort asc, brand_id desc', $limit = 0)
    {
        $condition['brand_apply'] = 1;
        return $this->getBrandList($condition, $field, $page, $order, $limit);
    }

    /**
     * hpf
     *
     * 品牌列表
     * @param array|string $condition
     * @param string $field
     * @param int|number $page 页容量
     * @param string $order
     * @param int $limit
     * @return array
     */
    public function getBrandList($condition, $field = '*', $page = 0, $order = 'brand_sort asc, brand_id desc', $limit = 0)
    {
        $condition = parseWhere($condition);
        if ($limit > 0) {
            $offset = intval($limit) * ($page - 1);
            $list = Brand::find(array('conditions' => $condition, 'columns' => $field, 'order' => $order, 'limit' => array('number' => $limit, 'offset' => $offset)));
        } else {
            $list = Brand::find(array('conditions' => $condition, 'columns' => $field, 'order' => $order));
        }

        if (count($list) > 0) {
            return $list->toArray();
        } else {
            return array();
        }
        //return $this->where($condition)->field($field)->order($order)->page($page)->limit($limit)->select();
    }
}