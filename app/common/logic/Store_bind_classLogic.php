<?php
/**
 * 医生分类分佣比例
 * */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\StoreBindClass;

class Store_bind_classLogic extends Model
{

    /**
     * 读取列表
     * @param $array
     * @internal param array $condition
     * @return array
     */
    public function getStoreBindClassList($array)
    {
        //$result = $this->table('store_bind_class')->field($field)->where($condition)->page($page)->order($order)->limit($limit)->select();
        $result = StoreBindClass::find($array);
        if ($result == false) {
            return array();
        } else {
            return $result->toArray();
        }
    }

    /**
     * 读取单条记录
     * @param array $condition
     * @return bool
     */
    public function getStoreBindClassInfo($condition)
    {
        $where = '';
        if (count($condition) == 1) {
            $where = $condition;
        } else {
            $where = parseWhere($condition);
        }
        $result = StoreBindClass::findFirst($where);
        if ($result) {
            return true;
        } else {
            return false;
        }
        //return $result->toArray();
    }

    /**
     * 增加
     * @param array $param
     * @return bool
     */
    public function addStoreBindClass($param)
    {
        if (empty($param)) {
            return false;
        }
        if (is_array($param)) {
            $tmp = array();
            foreach ($param as $k => $v) {
                $tmp[$k] = $v;
            }
            $model = new StoreBindClass();
            $result = $model->save($tmp);
            return $result;
        } else {
            return false;
        }
    }

    /*
     * 增加
     * @param array $param
     * @return bool
     */
    public function addStoreBindClassAll($param)
    {
        return $this->insertAll($param);
    }

    /*
     * 更新
     * @param array $update
     * @param array $condition
     * @return bool
     */
    public function editStoreBindClass($update, $condition)
    {
        $result = StoreBindClass::findFirst($condition);
        if ($result->save($update)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * hpf
     *
     * 删除
     * @param array $condition
     * @return bool
     */
    public function delStoreBindClass($condition)
    {
        return deleteAll('Ypk\Models\StoreBindClass', $condition);
    }

    /**
     * 总数量
     * @param unknown $condition
     */
    public function getStoreBindClassCount($condition = array())
    {
        return $this->where($condition)->count();
    }

    /**
     * 取得医生下商品分类佣金比例
     * @param array $goods_list
     * @return array 医生ID=>array(分类ID=>佣金比例)
     */
    public function getStoreGcidCommisRateList($goods_list)
    {
        if (empty($goods_list) || !is_array($goods_list)) return array();

        // 获取绑定所有类目的自营店
        $own_shop_ids = Model('store')->getOwnShopIds(true);

        //定义返回数组
        $store_gc_id_commis_rate = array();

        //取得每个医生下有哪些商品分类
        $store_gc_id_list = array();
        foreach ($goods_list as $goods) {
            if (!intval($goods['gc_id'])) continue;
            if (!in_array($goods['gc_id'], (array)$store_gc_id_list[$goods['store_id']])) {
                if (in_array($goods['store_id'], $own_shop_ids)) {
                    //平台医生佣金为0
                    $store_gc_id_commis_rate[$goods['store_id']][$goods['gc_id']] = 0;
                } else {
                    $store_gc_id_list[$goods['store_id']][] = $goods['gc_id'];
                }
            }
        }

        if (empty($store_gc_id_list)) return $store_gc_id_commis_rate;

        $condition = array();
        foreach ($store_gc_id_list as $store_id => $gc_id_list) {
            $condition['store_id'] = $store_id;
            $condition['class_1|class_2|class_3'] = array('in', $gc_id_list);
            $bind_list = $this->getStoreBindClassList($condition);
            if (!empty($bind_list) && is_array($bind_list)) {
                foreach ($bind_list as $bind_info) {
                    if ($bind_info['store_id'] != $store_id) continue;
                    //如果class_1,2,3有一个字段值匹配，就有效
                    $bind_class = array($bind_info['class_3'], $bind_info['class_2'], $bind_info['class_1']);
                    foreach ($gc_id_list as $gc_id) {
                        if (in_array($gc_id, $bind_class)) {
                            $store_gc_id_commis_rate[$store_id][$gc_id] = $bind_info['commis_rate'];
                        }
                    }
                }
            }
        }
        return $store_gc_id_commis_rate;
    }
}
