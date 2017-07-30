<?php
/**医生模型管理
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 11:04
 */

namespace Ypk\Logic;


use Phalcon\Db;
use Ypk\Model;
use Ypk\Models\Store;

class StoreLogic extends Model
{
    /**
     * 自营医生的ID
     *
     * array(
     *   '医生ID(int)' => '是否绑定了全部商品类目(boolean)',
     *   // ..
     * )
     */
    protected $ownShopIds;

    public function initialize()
    {
    }

    /**
     * 删除缓存自营医生的ID
     */
    public function dropCachedOwnShopIds()
    {
        $this->ownShopIds = null;
        delete_file_cache('own_shop_ids');
    }

    /**
     * 获取自营医生的ID
     *
     * @param boolean $bind_all_gc = false 是否只获取绑定全部类目的自营店 默认否（即全部自营店）
     * @return array
     */
    public function getOwnShopIds($bind_all_gc = false)
    {

        $data = $this->ownShopIds;

        // 属性为空则取缓存
        if (!$data) {
            $data = read_file_cache('own_shop_ids');

            // 缓存为空则查库
            if (!$data) {
                $data = array();
                $all_own_shops = $this->table('store')->field('store_id,bind_all_gc')->where(array(
                    'is_own_shop' => 1,
                ))->select();
                foreach ((array)$all_own_shops as $v) {
                    $data[$v['store_id']] = (int)(bool)$v['bind_all_gc'];
                }

                // 写入缓存
                write_file_cache('own_shop_ids', $data);
            }

            // 写入属性
            $this->ownShopIds = $data;
        }

        return array_keys($bind_all_gc ? array_filter($data) : $data);
    }

    /**
     * 查询医生列表
     *
     * @param array $condition 查询条件
     * @return array
     */
    public function getStoreList($condition = array())
    {
        $model = new Store();
        $result = $model->find($condition);
        if (count($result) > 0) {
            return $result->toArray();
        } else {
            return array();
        }
    }

    /**
     * 查询有效医生列表
     *
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 字段
     * @return array
     */
    public function getStoreOnlineList($condition, $page = null, $order = '', $field = '*')
    {
        $condition['store_state'] = 1;
        return $this->getStoreList($condition, $page, $order, $field);
    }

    /**
     * 医生数量
     * @param array $condition
     * @return int
     */
    public function getStoreCount($condition)
    {
        //return $this->where($condition)->count();
        $model = Store::find();
        return count($model);
    }

    /**
     * 按医生编号查询医生的信息
     *
     * @param array $storeid_array 医生编号
     * @return array
     */
    public function getStoreMemberIDList($storeid_array, $field = 'store_id,member_id,store_domain')
    {
        $store_list = $this->table('store')->where(array('store_id' => array('in', $storeid_array)))->field($field)->key('store_id')->select();
        return $store_list;
    }

    /**
     * 查询医生信息
     *
     * @param array $condition 查询条件
     * @return array
     */
    public function getStoreInfo($condition)
    {
        $model_store = new Store();
        $store_info = $model_store->find($condition);

        $store_info = $store_info->toArray();
        return $store_info;
//        if(!empty($store_info)) {
//            if(!empty($store_info['store_presales'])) $store_info['store_presales'] = unserialize($store_info['store_presales']);
//            if(!empty($store_info['store_aftersales'])) $store_info['store_aftersales'] = unserialize($store_info['store_aftersales']);
//
//            //商品数
//            $model_goods = new GoodsLogic();
//            $store_info['goods_count'] = $model_goods->getGoodsCommonOnlineCount(array('store_id' => $store_info['store_id']));
//
//            //医生评价
//            $model_evaluate_store = new EvaluateStoreLogic();
//            $store_evaluate_info = $model_evaluate_store->getEvaluateStoreInfoByStoreID($store_info['store_id'], $store_info['sc_id']);
//
//            $store_info = array_merge($store_info, $store_evaluate_info);
//        }
//        return $store_info;
    }

    /**
     * 判断医生是否存在
     */
    public function getNum($storename)
    {
        $model = Store::count($storename);
        return intVal($model);
    }

    /**
     * 通过医生编号查询医生信息
     *
     * @param int $store_id 医生编号
     * @return array
     *
     */
    public function getStoreInfoByID($store_id)
    {
        $prefix = 'store_info';

        $store_info = read_db_cache($store_id, $prefix);
        if (empty($store_info)) {
            $store_info = $this->getStoreInfo(array('store_id' => $store_id));
            $cache = array();
            $cache['store_info'] = serialize($store_info);
            write_db_cache($store_id, $cache, $prefix, 60 * 24);
        } else {
            $store_info = unserialize($store_info['store_info']);
        }
        return $store_info;
    }

    /**
     * 获取一行信息
     *
     */
    public function getStoreOne($id)
    {
        $model_store = new Store();
        $store_info = $model_store->findFirst($id);
        $store_info = $store_info->toArray();
        return $store_info;
    }

    public function getStoreOnlineInfoByID($store_id)
    {
        $store_info = $this->getStoreInfoByID($store_id);
        if (empty($store_info) || $store_info['store_state'] == '0') {
            return array();
        } else {
            return $store_info;
        }
    }

    public function getStoreIDString($condition)
    {
        $condition['store_state'] = 1;
        $store_list = $this->getStoreList($condition);
        $store_id_string = '';
        foreach ($store_list as $value) {
            $store_id_string .= $value['store_id'] . ',';
        }
        return $store_id_string;
    }

    /**
     * 添加医生
     *
     * @param array $param 医生信息
     * @return bool|Store
     */
    public function addStore($param)
    {
        if (empty($param)) {
            return false;
        }
        if (is_array($param)) {
            $tmp = array();
            foreach ($param as $k => $v) {
                $tmp[$k] = $v;
            }
            $model = new Store();
            if ($result = $model->save($tmp)) {
                return $model->getStoreId();
            };
        } else {
            return false;
        }
    }

    /**
     * 编辑医生
     * @param $data
     * @return bool|Store
     */
    public function editStore($data, $condition = array())
    {
        //清空缓存
        $update = Store::findFirst(array(
            "conditions" => getConditionsByParamArray(array('store_id' => $condition['store_id'])),
            "bind" => array('store_id' => $condition['store_id'])
        ));
        if ($update) {
            if ($update->save($data)) {
                delete_file_cache($update->getStoreId(), 'store/');
            } else {
                return false;
            }
        } else {
            return false;
        }
        // $store_list = $this->getStoreOne($condition);
//        $result = $this->getStoreOne($condition);
//        foreach ($result as $value) {
//            delete_file_cache($value['store_id'],'store/');
//        }
//        $store = new Store();
//        $metaData = $store->getModelsMetaData();
//        $param = $metaData->getAttributes($store);
//        $model = new Store();
//        $store_list = $model->findFirst($condition);
//        if($condition == $result['store_id']){
//
//        }
//        $array = array();
//        foreach($update as $k => $value){
//            $array[] = $k;
//        }
//
//        return $store_list->save($update,$array);
        //$this->where($condition)->update($update);
        return $update;
    }

    /**
     * 删除医生
     *
     * @param array $condition 条件
     * @return bool
     */
    public function delStore($condition)
    {
        $store_info = $this->getStoreInfo($condition);
        //删除医生相关图片
        @unlink(BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . $store_info['store_label']);
        @unlink(BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . $store_info['store_banner']);
        if ($store_info['store_slide'] != '') {
            foreach (explode(',', $store_info['store_slide']) as $val) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_SLIDE . DS . $val);
            }
        }

        //清空缓存
        delete_file_cache($store_info['store_id'], 'store_info/');
        return $this->where($condition)->delete();
    }

    /**
     * 完全删除医生 包括店主账号、医生的管理员账号、医生相册、医生扩展
     */
    public function delStoreEntirely($condition)
    {
        $this->delStore($condition);
        $model1 = new SellerLogic();
        $model1->delSeller($condition);
        $model2 = new SellerGroupLogic();
        $model2->delSellerGroup($condition);
        $model3 = new AlbumLogic();
        $model3->delAlbum($condition);
        $model4 = new StoreExtendLogic();
        $model4->delStoreExtend($condition);
    }

    /**
     * 获取商品销售排行(每天更新一次)
     *
     * @param int $store_id 医生编号
     * @param int $limit 数量
     * @return array    商品信息
     */
    public function getHotSalesList($store_id, $limit = 5, $isMobile = false)
    {
        $prefix = 'store_hot_sales_list_' . $limit;
        if ($isMobile) {
            $prefix .= '_mobile/';
        }
        $hot_sales_list = read_file_cache($store_id, false, null, $prefix);
        if (empty($hot_sales_list)) {
            $model_goods = Model('goods');
            $where = array(
                'store_id' => $store_id,
            );
            // 手机端不显示预订商品
            if ($isMobile) {
                $where['is_book'] = 0;
            }
            $hot_sales_list = $model_goods->getGoodsOnlineList($where, '*', 0, 'goods_salenum desc', $limit);
            $cache = array();
            $cache['hot_sales'] = serialize($hot_sales_list);
            write_file_cache($store_id, $cache, 60 * 60 * 24, $prefix);
        } else {
            $hot_sales_list = unserialize($hot_sales_list['hot_sales']);
        }
        return $hot_sales_list;
    }

    /**
     * 获取商品收藏排行(每天更新一次)
     *
     * @param int $store_id 医生编号
     * @param int $limit 数量
     * @return array    商品信息
     */
    public function getHotCollectList($store_id, $limit = 5)
    {
        $prefix = 'store_collect_sales_list_' . $limit . '/';
        $hot_collect_list = read_file_cache($store_id, false, 60 * 60 * 24, $prefix);
        if (empty($hot_collect_list)) {
            $model_goods = Model('goods');
            $hot_collect_list = $model_goods->getGoodsOnlineList(array('store_id' => $store_id), '*', 0, 'goods_collect desc', $limit);
            $cache = array();
            $cache['collect_sales'] = serialize($hot_collect_list);
            write_file_cache($store_id, $cache, 60 * 60 * 24, $prefix);
        } else {
            $hot_collect_list = unserialize($hot_collect_list['collect_sales']);
        }
        return $hot_collect_list;
    }
    //以下为医生列表新增项
    /**
     * 获取医生列表页附加信息
     *
     * @param array $store_array 医生数组
     * @return array $store_array 包含近期销量和8个推荐商品的医生数组
     */
    public function getStoreSearchList($store_array)
    {
        $store_array_new = array();
        if (!empty($store_array)) {
            $model = Model();
            $no_cache_store = array();
            foreach ($store_array as $value) {
                //$store_search_info = read_file_cache($value['store_id'],false,null,'store_search_info/');
                //print_r($store_array);exit();
                //if($store_search_info !== FALSE) {
                //	$store_array_new[$value['store_id']] = $store_search_info;
                //} else {
                //	$no_cache_store[$value['store_id']] = $value;
                //}
                $no_cache_store[$value['store_id']] = $value;
            }
            if (!empty($no_cache_store)) {
                //获取医生商品数
                $no_cache_store = $this->getStoreInfoBasic($no_cache_store);
                //获取医生近期销量
                $no_cache_store = $this->getGoodsCountJq($no_cache_store);
                //获取医生推荐商品
                $no_cache_store = $this->getGoodsListBySales($no_cache_store);
                //写入缓存
                foreach ($no_cache_store as $value) {
                    write_file_cache($value['store_id'], $value,null, 'store_search_info/');
                }
                $store_array_new = array_merge($store_array_new, $no_cache_store);
            }
        }
        return $store_array_new;
    }

    /**
     * 获得医生标志、信用、商品数量、医生评分等信息
     *
     * @param    array $param 医生数组
     * @return    array 数组格式的返回结果
     */
    public function getStoreInfoBasic($list, $day = 0)
    {
        $list_new = array();
        if (!empty($list) && is_array($list)) {
            foreach ($list as $key => $value) {
                if (!empty($value)) {
                    $value['store_logo'] = getStoreLogo($value['store_logo']);
                    //医生评价
                    $model_evaluate_store = Model('evaluate_store');
                    $store_evaluate_info = $model_evaluate_store->getEvaluateStoreInfoByStoreID($value['store_id'], $value['sc_id']);
                    $value = array_merge($value, $store_evaluate_info);

                    if (!empty($value['store_presales'])) $value['store_presales'] = unserialize($value['store_presales']);
                    if (!empty($value['store_aftersales'])) $value['store_aftersales'] = unserialize($value['store_aftersales']);
                    $list_new[$value['store_id']] = $value;
                    $list_new[$value['store_id']]['goods_count'] = 0;
                }
            }
            //全部商品数直接读取缓存
            if ($day > 0) {
                $store_id_string = implode(',', array_keys($list_new));
                //指定天数直接查询数据库
                $condition = array();
                $condition['goods_show'] = '1';
                $condition['store_id'] = array('in', $store_id_string);
                $condition['goods_add_time'] = array('gt', strtotime("-{$day} day"));
                $model = Model();
                $goods_count_array = $model->table('goods')->field('store_id,count(*) as goods_count')->where($condition)->group('store_id')->select();
                if (!empty($goods_count_array)) {
                    foreach ($goods_count_array as $value) {
                        $list_new[$value['store_id']]['goods_count'] = $value['goods_count'];
                    }
                }
            } else {
                $list_new = $this->getGoodsCountByStoreArray($list_new);
            }
        }
        return $list_new;
    }

    /**
     * 获取医生商品数
     *
     * @param array $store_array 医生数组
     * @return array $store_array 包含商品数goods_count的医生数组
     */
    public function getGoodsCountByStoreArray($store_array)
    {
        $store_array_new = array();
        $model = Model();
        $no_cache_store = '';

        foreach ($store_array as $value) {
            $goods_count = read_file_cache($value['store_id'],false,null, 'store_goods_count/');

            if (!empty($goods_count) && $goods_count !== FALSE) {
                //有缓存的直接赋值
                $value['goods_count'] = $goods_count;
            } else {
                //没有缓存记录store_id，统计从数据库读取
                $no_cache_store .= $value['store_id'] . ',';
                $value['goods_count'] = '0';
            }
            $store_array_new[$value['store_id']] = $value;
        }

        if (!empty($no_cache_store)) {

            //从数据库读取医生商品数赋值并缓存
            $no_cache_store = rtrim($no_cache_store, ',');
            $condition = array();
            $condition['goods_state'] = '1';
            $condition['store_id'] = array('in', $no_cache_store);
            $goods_count_array = $model->table('goods')->field('store_id,count(*) as goods_count')->where($condition)->group('store_id')->select();
            if (!empty($goods_count_array)) {
                foreach ($goods_count_array as $value) {
                    $store_array_new[$value['store_id']]['goods_count'] = $value['goods_count'];
                    write_file_cache($value['store_id'], $value['goods_count'],null, 'store_goods_count/');
                }
            }
        }
        return $store_array_new;
    }

    //获取近期销量
    private function getGoodsCountJq($store_array)
    {
        $model = Model();
        $order_count_array = $model->table('orders')->field('store_id,count(*) as order_count')->where(array('store_id' => array('in', implode(',', array_keys($store_array))), 'add_time' => array('gt', TIMESTAMP - 3600 * 24 * 90)))->group('store_id')->select();
        foreach ((array)$order_count_array as $value) {
            $store_array[$value['store_id']]['num_sales_jq'] = $value['order_count'];
        }
        return $store_array;
    }

    //获取医生8个销量最高商品
    private function getGoodsListBySales($store_array)
    {
        $model = Model();
        $field = 'goods_id,store_id,goods_name,goods_image,goods_price,goods_salenum';
        foreach ($store_array as $value) {
            $store_array[$value['store_id']]['search_list_goods'] = $model->table('goods')->field($field)->where(array('store_id' => $value['store_id'], 'goods_state' => 1))->order('goods_salenum desc')->limit(8)->select();
        }
        return $store_array;
    }

    /*获取符合指定多个值条件的*/
    public function getStoreIn($array = array())
    {
        $model = Store::query();
        if (empty($array)) {
            $result = $model->where(array('order' => desc));
        } else {
            $result = $model->inWhere('store_id', $array);
        }
        return $result->toArray();
    }
}
