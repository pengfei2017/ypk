<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24
 * Time: 22:20
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\StoreGrade;

class StoreGradeLogic extends Model
{
    public function initialize(){
        //parent::initialize('store_grade');
    }
    /**
     * 列表
     *
     * @param array $condition 检索条件
     * @return array 数组结构的返回结果
     */
    public function getGradeList($condition = array()){
        $condition_str = $this->_condition($condition);
        $param = array();
        //$param['table'] = 'store_grade';
        $param['conditions'] = $condition_str;
        //$param['order'] = 'sg_id';
        $param['order'] = isset($condition['order']) ? $condition['order'] : 'sg_id';
        $result = StoreGrade::find($param);
        return $result->toArray();
    }
    /**
     * 构造检索条件
     *
     * @param int $id 记录ID
     * @return string 字符串类型的返回结果
     */
    private function _condition($condition){
        $condition_str = '';

        if (isset($condition['like_sg_name']) &&  $condition['like_sg_name'] != ''){
            if($condition_str == ''){
                $condition_str = " sg_name like '%". $condition['like_sg_name'] ."%'";
            }else{
                $condition_str .= " and sg_name like '%". $condition['like_sg_name'] ."%'";
            }
        }
        if (isset($condition['no_sg_id']) && $condition['no_sg_id']!= ''){
            if($condition_str == ''){
                $condition_str .= " sg_id != '". intval($condition['no_sg_id']) ."'";
            }else{
                $condition_str .= " and sg_id != '". intval($condition['no_sg_id']) ."'";
            }
        }
        if (isset($condition['sg_name']) && $condition['sg_name'] != ''){
            if($condition_str == ''){
                $condition_str = " sg_name like '%". $condition['sg_name'] ."%'";
            }else{
                $condition_str .= " and sg_name like '%". $condition['sg_name'] ."%'";
            }
        }
        if (isset($condition['sg_id']) && $condition['sg_id'] != ''){
            if($condition_str == ''){
                $condition_str = " and store_grade.sg_id = '". $condition['sg_id'] ."'";
            }else{
                $condition_str .= " and store_grade.sg_id = '". $condition['sg_id'] ."'";
            }
        }
        /*if($condition['store_id'] != '') {
            $condition_str .= " and store.store_id=".$condition['store_id'];
        }*/
        if(isset($condition['store_id'])) {
            if($condition_str == ''){
                $condition_str = " and store.store_id = '{$condition['store_id']}' ";
            }else{
                $condition_str .= " and store.store_id = '{$condition['store_id']}' ";
            }
        }
        if (isset($condition['sg_sort'])){
            if ($condition['sg_sort'] == '' && $condition_str == ''){
                $condition_str .= " and sg_sort = '' ";
            }else {
                $condition_str = " sg_sort = '{$condition['sg_sort']}'";
            }
        }
        return $condition_str;
    }

    /**
     * 取单个内容
     *
     * @param int $id 分类ID
     * @return array 数组类型的返回结果
     */
    public function getOneGrade($id){
        if (intval($id) > 0){
            $param = array();
//            $param['table'] = 'store_grade';
//            $param['field'] = 'sg_id';
//            $param['value'] = intval($id);
            $param['sg_id'] = intval($id);
            $model = new StoreGrade();
            $result = $model->findFirst(array('conditions'=>parseWhere($param)));
            return $result->toArray();
        }else {
            return array();
        }
    }

    /**
     * 新增
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function add($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $model = new StoreGrade();
            $result = $model->save($tmp);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 更新信息
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function updates($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
           // $where = " sg_id = '{$param['sg_id']}'";
            //$result = Db::update('store_grade',$tmp,$where);
            $model = new StoreGrade();
            $result = $model->findFirst(array("conditions"=> getConditionsByParamArray(array('sg_id' => $param['sg_id'])), "bind" => array('sg_id' => $param['sg_id'])));
            //return $result;
            if($result){
                if($result->save($param)){
                    return true;
                }
            }
        }else {
            return false;
        }
    }

    /**
     * 删除分类
     *
     * @param int $id 记录ID
     * @return bool 布尔类型的返回结果
     */
    public function del($id){
        if (intval($id) > 0){
            //$where = " sg_id = '". intval($id) ."'";
            $model = new StoreGrade();
            $result = $model->findFirst(array('conditions'=>'sg_id='.$id));
            //$result = Db::delete('store_grade',$where);
            if($result){
                if($result->delete());
            }
        }else {
            return false;
        }
    }


    /**
     * 等级对应的医生列表
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    public function getGradeShopList($condition,$page=''){
        $condition_str = $this->_condition($condition);
        $param = array(
            'table'=>'store_grade,store',
            'field'=>'store_grade.*,store.*',
            'where'=>$condition_str,
            'join_type'=>'left join',
            'join_on'=>array(
                'store_grade.sg_id = store.grade_id',
            )
        );
        $result = Db::select($param,$page);
        return $result;
    }
}
