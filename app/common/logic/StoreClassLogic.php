<?php
/**
 * 医生类别模型
 *
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\StoreClass;

class StoreClassLogic extends Model
{
    public function initialize()
    {
        //parent::initialize('store_class');
    }

    /**
     * 取医生类别列表
     * @param $array
     * @return
     * @internal param unknown $condition
     * @internal param string $pagesize
     * @internal param string $order
     */
    public function getStoreClassList($array)
    {
        $model = new StoreClass();
        $result = $model->find($array);
//        if ($result == false) {
//            return null;
//        } else {
//            return $result->toArray();
//        }
        return $result->toArray();
    }

    /**
     * 取一行
     */
    public function getStoreClassOne($array)
    {
        $model = new StoreClass();
        $result = $model->findFirst($array);
        return $result->toArray();
    }

    /**
     * 取得单条信息
     * @param unknown $condition
     */
    public function getStoreClassInfo($condition = array())
    {
        $model = new StoreClass();
        $result = $model->findFirst($condition);
        return $result->toArray();
    }

    /**
     * 删除类别
     * @param unknown $condition
     */
    public function delStoreClass($id)
    {
        //$where = " sg_id = '". intval($id) ."'";
        $model = new StoreClass();
        $result = $model->findFirst(array('conditions' =>$id));
        //$result = Db::delete('store_grade',$where);
        if ($result) {
            if ($result->delete()){
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 增加医生分类
     * @param unknown $data
     * @return boolean
     */
    // return $this->insert($data);
    public function addStoreClass($param)
    {
        if (empty($param)) {
            return false;
        }
        if (is_array($param)) {
            $tmp = array();
            foreach ($param as $k => $v) {
                $tmp[$k] = $v;
            }
            $model = new StoreClass();
            $result = $model->save($tmp);
            return $result;
        } else {
            return false;
        }
    }


    /**
     * 更新分类
     * @param unknown $data
     * @param unknown $condition
     */
    public function editStoreClass($data = array(), $condition = array())
    {
        $result = StoreClass::findFirst($condition);
        if($result->save($data)){
            return true;
        }else{
            return false;
        }
        //return $this->where($condition)->update($data);
    }
}
