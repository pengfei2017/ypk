<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 19:13
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\Cart;

class CartLogic extends Model
{
    /**
     * 购物车商品总金额
     */
    private $cart_all_price = 0;

    /**
     * 购物车商品总数
     */
    private $cart_goods_num = 0;

    /**
     * 计算购物车总商品数和总金额
     * @param string $type 购物车信息保存类型 db,cookie
     * @param array $condition 只有登录后操作购物车表时才会用到该参数
     * @return int
     */
    public function getCartNum($type, $condition = array())
    {
        if ($type == 'db') {
            $cart_all_price = 0;
            $cart_goods = $this->listCart('db', $condition);
            $this->cart_goods_num = count($cart_goods);
            if (!empty($cart_goods) && is_array($cart_goods)) {
                foreach ($cart_goods as $val) {
                    $cart_all_price += $val['goods_price'] * $val['goods_num'];
                }
            }
            $this->cart_all_price = ncPriceFormat($cart_all_price);
        } elseif ($type == 'cookie') {
            $cart_str = get_magic_quotes_gpc() ? stripslashes(cookie('cart')) : cookie('cart');
            $cart_str = base64_decode(decrypt($cart_str));
            $cart_array = @unserialize($cart_str);
            $cart_array = !is_array($cart_array) ? array() : $cart_array;
            $this->cart_goods_num = count($cart_array);
            $cart_all_price = 0;
            foreach ($cart_array as $v) {
                $cart_all_price += floatval($v['goods_price']) * intval($v['goods_num']);
            }
            $this->cart_all_price = $cart_all_price;
        }
        setcookie('cart_goods_num', $this->cart_goods_num, 2 * 3600);
        return $this->cart_goods_num;
    }

    /**
     * 购物车列表
     *
     * @param string $type 存储类型 db,cookie
     * @param array $condition
     * @param int|string $limit
     * @return array|mixed
     */
    public function listCart($type, $condition = array(), $limit = '')
    {
        $cart_list = array();
        if ($type == 'db') {
            $res = Cart::find(parseWhere($condition));
            if (count($res) > 0) {
                $cart_list = $res->toArray();
            }
            //$cart_list = $this->where($condition)->limit($limit)->select();
        } elseif ($type == 'cookie') {
            //去除斜杠
            $cart_str = get_magic_quotes_gpc() ? stripslashes(cookie('cart')) : cookie('cart');
            $cart_str = base64_decode(decrypt($cart_str));
            $cart_list = @unserialize($cart_str);
        }
        $cart_list = is_array($cart_list) ? $cart_list : array();
        //顺便设置购物车商品数和总金额
        $this->cart_goods_num = count($cart_list);
        $cart_all_price = 0;
        if (is_array($cart_list)) {
            foreach ($cart_list as $val) {
                $cart_all_price += $val['goods_price'] * $val['goods_num'];
            }
        }
        $this->cart_all_price = ncPriceFormat($cart_all_price);
        return !is_array($cart_list) ? array() : $cart_list;
    }

    /**
     * 登录之后,把登录前购物车内的商品加到购物车表
     * @param array $member_info
     * @param null $store_id
     */
    public function mergecart($member_info = array(), $store_id = null)
    {
        if (!$member_info['member_id']) return;
        // $save_type = getConfig('cache.type') != 'file' ? 'cache' : 'cookie';
        $save_type = 'cookie';
        $cart_new_list = $this->listCart($save_type);
        if (empty($cart_new_list)) return;
        //批量添加购物车
        $this->batchAddCart($cart_new_list, $member_info['member_id'], $store_id);
        //最后清空登录前购物车内容
        $this->clearCart($save_type);
    }
}