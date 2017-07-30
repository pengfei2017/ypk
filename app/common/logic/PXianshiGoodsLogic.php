<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 21:59
 */

namespace Ypk\Logic;
use Phalcon\Mvc\Url;
use Ypk\Model;
use Ypk\Models\PXianshiGoods;

/**
 * 限时折扣商品
 *
 * Class PXianshiGoodsLogic
 * @package Ypk\Logic
 */

class PXianshiGoodsLogic extends Model
{
    const XIANSHI_GOODS_STATE_CANCEL = 0;
    const XIANSHI_GOODS_STATE_NORMAL = 1;

    /**
     * 根据商品编号查询是否有可用限时折扣活动，如果有返回限时折扣活动，没有返回null
     * @param string $goods_string 商品编号字符串，例：'1,22,33'
     * @return array $xianshi_goods_list
     *
     */
    public function getXianshiGoodsListByGoodsString($goods_string) {
        $xianshi_goods_list = $this->_getXianshiGoodsListByGoods($goods_string);
        $xianshi_goods_list = array_under_reset($xianshi_goods_list, 'goods_id');
        return $xianshi_goods_list;
    }

    /**
     * 根据商品编号查询是否有可用限时折扣活动，如果有返回限时折扣活动，没有返回null
     * @param string $goods_id_string
     * @return array $xianshi_info
     *
     */
    private function _getXianshiGoodsListByGoods($goods_id_string) {
        $condition = array();
        $condition['state'] = self::XIANSHI_GOODS_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $condition['goods_id'] = array('in', $goods_id_string);
        $xianshi_goods_list = $this->getXianshiGoodsExtendList($condition, null, 'xianshi_goods_id desc', '*');
        return $xianshi_goods_list;
    }

    /**
     * 读取限时折扣商品列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @param int $limit 个数限制
     * @return array 限时折扣商品列表
     *
     */
    public function getXianshiGoodsExtendList($condition, $page=null, $order='', $field='*', $limit = 0) {
        $xianshi_goods_list = $this->getXianshiGoodsList($condition, $page, $order, $field, $limit);
        if(!empty($xianshi_goods_list)) {
            for($i=0, $j=count($xianshi_goods_list); $i < $j; $i++) {
                $xianshi_goods_list[$i] = $this->getXianshiGoodsExtendInfo($xianshi_goods_list[$i]);
            }
        }
        return $xianshi_goods_list;
    }

    /**
     * 读取限时折扣商品列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @param int $limit 个数限制
     * @return PXianshiGoods[] 返回限时折扣商品列表
     *
     */
    public function getXianshiGoodsList($condition, $page=null, $order='', $field='*', $limit = 0) {
        $condition=parseWhere($condition);
        $offset=intval($limit)*(intval($page)-1);
        return PXianshiGoods::find(array('conditions'=>$condition,'columns'=>$field,'order'=>$order,'limit'=>array('number'=>$limit,'offset'=>$offset)));
        //return $xianshi_goods_list = $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
    }

    /**
     * 获取限时折扣商品扩展信息
     * @param array $xianshi_info
     * @return array 扩展限时折扣信息
     *
     */
    public function getXianshiGoodsExtendInfo($xianshi_info) {
        //$xianshi_info['goods_url'] = getUrl('shop/goods/index', array('goods_id' => $xianshi_info['goods_id']));
        $xianshi_info['goods_url'] = (new Url())->get('shop_manager/goods/index',array('goods_id'=>$xianshi_info['goods_id']));
        $xianshi_info['image_url'] = cthumb($xianshi_info['goods_image'], 60, $xianshi_info['store_id']);
        $xianshi_info['xianshi_price'] = ncPriceFormat($xianshi_info['xianshi_price']);
        $xianshi_info['xianshi_discount'] = number_format($xianshi_info['xianshi_price'] / $xianshi_info['goods_price'] * 10, 1).'折';
        return $xianshi_info;
    }
}