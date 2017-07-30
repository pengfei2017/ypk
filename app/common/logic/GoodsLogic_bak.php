<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 21:22
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\Goods;

class GoodsLogic1 extends Model
{
    const STATE1 = 1;       // 出售中
    const STATE0 = 0;       // 下架
    const STATE10 = 10;     // 违规
    const VERIFY1 = 1;      // 审核通过
    const VERIFY0 = 0;      // 审核失败
    const VERIFY10 = 10;    // 等待审核

    /**
     * 获得商品子分类的ID
     * @param array $condition
     * @return array
     */
    private function _getRecursiveClass($condition)
    {
        if (isset($condition['gc_id']) && !is_array($condition['gc_id'])) {
            $gc_list = (new GoodsClassLogic())->getGoodsClassForCacheModel();
            if (!empty($gc_list[$condition['gc_id']])) {
                $gc_id[] = $condition['gc_id'];
                $gcchild_id = empty($gc_list[$condition['gc_id']]['child']) ? array() : explode(',', $gc_list[$condition['gc_id']]['child']);
                $gcchildchild_id = empty($gc_list[$condition['gc_id']]['childchild']) ? array() : explode(',', $gc_list[$condition['gc_id']]['childchild']);
                $gc_id = array_merge($gc_id, $gcchild_id, $gcchildchild_id);
                $condition['gc_id'] = array('in', $gc_id);
            }
        }
        return $condition;
    }

    /**
     * 出售中的商品SKU列表（只显示不同颜色的商品，前台商品索引，医生也商品列表等使用）
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param int|number $page
     * @param int|number $limit
     * @return array
     */
    public function getGoodsListByColorDistinct($condition, $field = '*', $order = 'goods_id asc', $page = 0, $limit = 0)
    {
        $condition['goods_state'] = self::STATE1; //出售中
        $condition['goods_verify'] = self::VERIFY1; //审核通过
        $condition = $this->_getRecursiveClass($condition); //获得商品子分类的ID
        $_field="";
        $_distinct="";
        $_field = "CONCAT(goods_commonid,',',color_id)";
        $_distinct = 'nc_distinct';


        // 只查询固定条数不分页时，不计算商品总数
        $count = 0;
        if ($limit == 0) {
            $count = $this->getGoodsOnlineCount($condition, "distinct " . $_field);
            if ($count == 0) {
                pagecmd('settotalpagebynum', 0);
                return array();
            }
        }
        $goods_list = array();
        $goods_list = $this->getGoodsOnlineList($condition, $_field.' nc_distinct,'.$field, $page, $order, $limit, $_distinct, false, $count);
        return $goods_list;
    }

    /**
     * 获得出售中商品SKU数量
     *
     * @param array $condition
     * @param string $field
     * @return int
     */
    public function getGoodsOnlineCount($condition, $field = '*')
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        $strWhere = parseWhere($condition);
        return Goods::count($strWhere);
        //return $this->table('goods')->where($condition)->group('')->count1($field);
    }

    /**
     * 在售商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页
     * @param boolean $lock 是否锁定
     * @return array
     */
    public function getGoodsOnlineList($condition, $field = '*', $page = 0, $order = 'goods_id desc', $limit = 0, $group = '', $lock = false, $count = 0)
    {
        $condition['goods_state'] = self::STATE1;
        $condition['goods_verify'] = self::VERIFY1;
        return $this->getGoodsList($condition, $field, $group, $order, $limit, $page, $count);
    }

    /**
     * 商品SKU列表
     *
     * @param array $condition 条件
     * @param string $field 字段
     * @param string $group 分组
     * @param string $order 排序
     * @param int $limit 限制
     * @param int $page 分页页码
     * @param int $count 页容量
     * @return array 二维数组
     */
    public function getGoodsList($condition, $field = '*', $group = '', $order = '', $limit = 0, $page = 0, $count = 0)
    {
        $condition = $this->_getRecursiveClass($condition);
        $condition = parseWhere($condition);
        $offset = intval($count) * (intval($page) - 1);
        $list = Goods::find(array('conditions' => $condition, 'columns' => $field, 'order' => $order, 'group' => $group, 'limit' => array('number' => $limit, 'offset' => $offset)));
        if (count($list) > 0) {
            $list = $list->toArray();
        } else {
            $list = array();
        }
        return $list;
        //return $this->table('goods')->field($field)->where($condition)->group($group)->order($order)->limit($limit)->page($page, $count)->select();
    }
}