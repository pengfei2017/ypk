<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/19
 * Time: 1:36
 */

namespace Ypk\Logic;


use Phalcon\Mvc\Url;
use Ypk\Model;
use Ypk\Models\Groupbuy;

class GroupBuyLogic extends Model
{
    const GROUPBUY_STATE_REVIEW = 10;
    const GROUPBUY_STATE_NORMAL = 20;
    const GROUPBUY_STATE_REVIEW_FAIL = 30;
    const GROUPBUY_STATE_CANCEL = 31;
    const GROUPBUY_STATE_CLOSE = 32;

    private $groupbuy_state_array = array(
        0 => '全部',
        self::GROUPBUY_STATE_REVIEW => '审核中',
        self::GROUPBUY_STATE_NORMAL => '正常',
        self::GROUPBUY_STATE_CLOSE => '已结束',
        self::GROUPBUY_STATE_REVIEW_FAIL => '审核失败',
        self::GROUPBUY_STATE_CANCEL => '管理员关闭',
    );

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购活动，没有返回null
     * @param $goods_commonid_string
     * @return array $groupbuy_list
     * @internal param string $goods_string 商品编号字符串，例：'1,22,33'
     */
    public function getGroupbuyListByGoodsCommonIDString($goods_commonid_string) {
        $groupbuy_list = $this->_getGroupbuyListByGoodsCommon($goods_commonid_string);
        $groupbuy_list = array_under_reset($groupbuy_list, 'goods_commonid');
        return $groupbuy_list;
    }

    /**
     * 根据商品编号查询是否有可用抢购活动，如果有返回抢购活动，没有返回null
     * @param $goods_commonid_string
     * @return array $groupbuy_list
     * @internal param string $goods_id_string
     */
    private function _getGroupbuyListByGoodsCommon($goods_commonid_string) {
        $condition = array();
        $condition['state'] = self::GROUPBUY_STATE_NORMAL;
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $condition['goods_commonid'] = array('in', $goods_commonid_string);
        $xianshi_goods_list = $this->getGroupbuyExtendList($condition, null, 'groupbuy_id desc', '*');
        return $xianshi_goods_list;
    }

    /**
     * 读取抢购列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @return array 抢购列表
     *
     */
    public function getGroupbuyExtendList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        $groupbuy_list = $this->getGroupbuyList($condition, $page, $order, $field, $limit);
        if(!empty($groupbuy_list)) {
            for($i =0, $j = count($groupbuy_list); $i < $j; $i++) {
                $groupbuy_list[$i] = $this->getGroupbuyExtendInfo($groupbuy_list[$i]);
            }
        }
        return $groupbuy_list;
    }

    /**
     * 读取抢购列表
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 所需字段
     * @param int $limit 获取条数
     * @return array 抢购列表
     */
    public function getGroupbuyList($condition, $page = null, $order = 'state asc', $field = '*', $limit = 0) {
        $condition=parseWhere($condition);
        $offset=intval($limit)*($page-1);
        $list=Groupbuy::find(array('conditions'=>$condition,'columns'=>$field,'order'=>$order,'limit'=>array('number'=>$limit,'offset'=>$offset)));
        if(count($list)>0){
            return $list->toArray();
        }
        else{
            return array();
        }
        //return $this->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
    }

    /**
     * 获取抢购扩展信息
     *
     * @param $groupbuy_info
     * @return mixed
     */
    public function getGroupbuyExtendInfo($groupbuy_info) {
        $url=new Url();
        //$groupbuy_info['groupbuy_url'] = getUrl('shop/show_groupbuy/groupbuy_detail', array('group_id' => $groupbuy_info['groupbuy_id']));
        $groupbuy_info['groupbuy_url'] = $url->get(SHOP_SITE_URL."/show_groupbuy/groupbuy_detail",array('group_id'=>$groupbuy_info['groupbuy_id']));
        //$groupbuy_info['goods_url'] = getUrl('shop/goods/index', array('goods_id' => $groupbuy_info['goods_id']));
        $groupbuy_info['goods_url'] = $url->get(SHOP_SITE_URL."/goods/index",array('goods_id'=>$groupbuy_info['goods_id']));
        $groupbuy_info['start_time_text'] = date('Y-m-d H:i', $groupbuy_info['start_time']);
        $groupbuy_info['end_time_text'] = date('Y-m-d H:i', $groupbuy_info['end_time']);
        if(empty($groupbuy_info['groupbuy_image1'])) {
            $groupbuy_info['groupbuy_image1'] = $groupbuy_info['groupbuy_image'];
        }
        if($groupbuy_info['start_time'] > TIMESTAMP && $groupbuy_info['state'] == self::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['groupbuy_state_text'] = '正常(未开始)';
        } elseif ($groupbuy_info['end_time'] < TIMESTAMP && $groupbuy_info['state'] == self::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['groupbuy_state_text'] = '已结束';
        } else {
            $groupbuy_info['groupbuy_state_text'] = $this->groupbuy_state_array[$groupbuy_info['state']];
        }

        if($groupbuy_info['state'] == self::GROUPBUY_STATE_REVIEW) {
            $groupbuy_info['reviewable'] = 1;
        } else {
            $groupbuy_info['reviewable'] = 0;
        }

        if($groupbuy_info['state'] == self::GROUPBUY_STATE_NORMAL) {
            $groupbuy_info['cancelable'] = 1;
        } else {
            $groupbuy_info['cancelable'] = 0;
        }

        switch ($groupbuy_info['state']) {
            case self::GROUPBUY_STATE_REVIEW:
                $groupbuy_info['state_flag'] = 'not-verify';
                $groupbuy_info['button_text'] = '未审核';
                break;
            case self::GROUPBUY_STATE_REVIEW_FAIL:
            case self::GROUPBUY_STATE_CANCEL:
            case self::GROUPBUY_STATE_CLOSE:
                $groupbuy_info['state_flag'] = 'close';
                $groupbuy_info['button_text'] = '已结束';
                break;
            case self::GROUPBUY_STATE_NORMAL:
                if($groupbuy_info['start_time'] > TIMESTAMP) {
                    $groupbuy_info['state_flag'] = 'not-start';
                    $groupbuy_info['button_text'] = '未开始';
                    $groupbuy_info['count_down_text'] = '距抢购开始';
                    $groupbuy_info['count_down'] = $groupbuy_info['start_time'] - TIMESTAMP;
                } elseif ($groupbuy_info['end_time'] < TIMESTAMP) {
                    $groupbuy_info['state_flag'] = 'close';
                    $groupbuy_info['button_text'] = '已结束';
                } else {
                    $groupbuy_info['state_flag'] = 'buy-now';
                    $groupbuy_info['button_text'] = '我要团';
                    $groupbuy_info['count_down_text'] = '距抢购结束';
                    $groupbuy_info['count_down'] = $groupbuy_info['end_time'] - TIMESTAMP;
                }
                break;
        }
        return $groupbuy_info;
    }
}