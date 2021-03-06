<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/23
 * Time: 23:09
 */

namespace Ypk\Logic;


use Ypk\Model;

class EvaluateStoreLogic extends Model
{

//    public function __construct(){
//        parent::__construct('evaluate_store');
//    }

    /**
     * 查询医生评分列表
     *
     * @param array $condition 查询条件
     * @param int $page 分页数
     * @param string $order 排序
     * @param string $field 字段
     * @return array
     */
    public function getEvaluateStoreList($condition, $page = null, $order = 'seval_id desc', $field = '*')
    {
        $list = $this->field($field)->where($condition)->page($page)->order($order)->select();
        return $list;
    }

    /**
     * 获取医生评分信息
     */
    public function getEvaluateStoreInfo($condition, $field = '*')
    {
        $list = $this->field($field)->where($condition)->find();
        return $list;
    }

    /**
     * 根据医生编号获取医生评分数据
     *
     * @param int @store_id 医生编号
     * @param int @sc_id 分类编号，如果传入分类编号同时返回行业对比数据
     */
    public function getEvaluateStoreInfoByStoreID($store_id, $sc_id = 0)
    {
        $dir = 'evaluate_store_info/';
        $info = read_file_cache($store_id, false, 60 * 60 * 24, $dir);
        if (empty($info)) {
            $info = array();
            $info['store_credit'] = $this->_getEvaluateStore(array('seval_storeid' => $store_id));
            $info['store_credit_average'] = number_format(round((($info['store_credit']['store_desccredit']['credit'] + $info['store_credit']['store_servicecredit']['credit'] + $info['store_credit']['store_deliverycredit']['credit']) / 3), 1), 1);
            $info['store_credit_percent'] = intval($info['store_credit_average'] / 5 * 100);
            if ($sc_id > 0) {
                $sc_info = $this->getEvaluateStoreInfoByScID($sc_id);
                foreach ($info['store_credit'] as $key => $value) {
                    if ($sc_info[$key]['credit'] > 0) {
                        $info['store_credit'][$key]['percent'] = intval(($info['store_credit'][$key]['credit'] - $sc_info[$key]['credit']) / $sc_info[$key]['credit'] * 100);
                    } else {
                        $info['store_credit'][$key]['percent'] = 0;
                    }
                    if ($info['store_credit'][$key]['percent'] > 0) {
                        $info['store_credit'][$key]['percent_class'] = 'high';
                        $info['store_credit'][$key]['percent_text'] = '高于';
                        $info['store_credit'][$key]['percent'] .= '%';
                    } elseif ($info['store_credit'][$key]['percent'] == 0) {
                        $info['store_credit'][$key]['percent_class'] = 'equal';
                        $info['store_credit'][$key]['percent_text'] = '持平';
                        $info['store_credit'][$key]['percent'] = '--';
                    } else {
                        $info['store_credit'][$key]['percent_class'] = 'low';
                        $info['store_credit'][$key]['percent_text'] = '低于';
                        $info['store_credit'][$key]['percent'] = abs($info['store_credit'][$key]['percent']);
                        $info['store_credit'][$key]['percent'] .= '%';
                    }
                }
            }
            $cache = array();
            $cache['evaluate'] = serialize($info);
            write_file_cache($store_id, $cache, 60 * 60 * 24, $dir);
        } else {
            $info = unserialize($info['evaluate']);
        }
        return $info;
    }

    /**
     * 根据分类编号获取分类评分数据
     */
    public function getEvaluateStoreInfoByScID($sc_id)
    {
        $prefix = 'sc_evaluate_store_info/';
        $info = read_file_cache($sc_id, false, 60 * 60 * 24, $prefix);
        if (empty($info)) {
            $model_store = Model('store');
            $store_id_string = $model_store->getStoreIDString(array('sc_id' => $sc_id));
            $info = $this->_getEvaluateStore(array('seval_storeid' => array('in', $store_id_string)));
            $cache = array();
            $cache['evaluate_store_info'] = serialize($info);
            write_file_cache($sc_id, $cache, 60 * 60 * 24, $prefix);
        } else {
            $info = unserialize($info['evaluate_store_info']);
        }
        return $info;
    }

    /**
     * 获取医生评分数据
     */
    private function _getEvaluateStore($condition)
    {
        $result = array();
        $field = 'AVG(seval_desccredit) as store_desccredit,';
        $field .= 'AVG(seval_servicecredit) as store_servicecredit,';
        $field .= 'AVG(seval_deliverycredit) as store_deliverycredit,';
        $field .= 'COUNT(seval_id) as count';
        $info = $this->getEvaluateStoreInfo($condition, $field);
        $result['store_desccredit']['text'] = '描述';
        $result['store_servicecredit']['text'] = '服务';
        $result['store_deliverycredit']['text'] = '物流';
        if (intval($info['count']) > 0) {
            $result['store_desccredit']['credit'] = number_format(round($info['store_desccredit'], 1), 1);
            $result['store_servicecredit']['credit'] = number_format(round($info['store_servicecredit'], 1), 1);
            $result['store_deliverycredit']['credit'] = number_format(round($info['store_deliverycredit'], 1), 1);
        } else {
            $result['store_desccredit']['credit'] = number_format(5, 1);
            $result['store_servicecredit']['credit'] = number_format(5, 1);
            $result['store_deliverycredit']['credit'] = number_format(5, 1);
        }
        return $result;
    }


    /**
     * 添加医生评分
     */
    public function addEvaluateStore($param)
    {
        return $this->insert($param);
    }

    /**
     * 删除医生评分
     */
    public function delEvaluateStore($condition)
    {
        return $this->where($condition)->delete();
    }
}