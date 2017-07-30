<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 23:14
 */

namespace Ypk\Logic;


use Ypk\Model;

class ArticleClassLogic extends Model
{
    /**
     * 类别列表
     *
     * @param array $condition 检索条件
     * @return array 数组结构的返回结果
     */
    public function getClassList($condition)
    {
        $condition_str = $this->_condition($condition);
        $param = array();
        //$param['table'] = 'article_class';
        //$param['where'] = $condition_str;
        $param['order'] = empty($condition['order']) ? 'ac_parent_id asc,ac_sort asc,ac_id asc' : $condition['order'];
        $result = getModelArrayList('Ypk\Models\ArticleClass', '*', '1=1 ' . $condition_str, $param['order']);
        if (count($result) > 0) {
            return $result;
        } else {
            return array();
        }
    }

    /**
     * 构造检索条件
     *
     * @param array $condition 条件数组
     * @return string 字符串类型的返回结果
     */
    private function _condition($condition)
    {
        $condition_str = '';

        if (isset($condition['ac_parent_id']) && $condition['ac_parent_id'] != '') {
            $condition_str .= " and ac_parent_id = '" . intval($condition['ac_parent_id']) . "'";
        }
        if (isset($condition['no_ac_id']) && $condition['no_ac_id'] != '') {
            $condition_str .= " and ac_id != '" . intval($condition['no_ac_id']) . "'";
        }
        if (isset($condition['ac_name']) && $condition['ac_name'] != '') {
            $condition_str .= " and ac_name = '" . $condition['ac_name'] . "'";
        }
        if (isset($condition['home_index']) && $condition['home_index'] != '') {
            $condition_str .= " and ac_id <= 7";
        }
        return $condition_str;
    }

}