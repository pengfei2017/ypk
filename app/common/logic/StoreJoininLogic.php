<?php
/**
 * 医生入驻模型
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\Member;
use Ypk\Models\StoreJoinin;

class StoreJoininLogic extends  Model
{
    public function __construct()
    {
        //  parent::__construct('store_joinin');
    }

    /**
     * 读取列表
     * @param $array
     * @return
     * @internal param array $condition
     */
    public function getList($array)
    {
        $model = new StoreJoinin();
        $result = $model->find($array);
        $array = $result->toArray();
        return $array;
    }
    
    /**
     * 医生入驻数量
     * @param string $where
     * @return mixed
     */
    public function getStoreJoininCount($where)
    {
        $model = StoreJoinin::count($where);
        return $model;
    }

    /**
     * 读取单条记录
     * @param array $condition
     * @return array
     */
    public function getOne($condition)
    {
        $result = StoreJoinin::findFirst(array('conditions' => parseWhere($condition)));
        if ($result) {
            return $result->toArray();
        } else {
            return array();
        }
    }

    /*
     *  判断是否存在
     *  @param array $condition
     *
     */
    public function isExist($condition)
    {
        $result = $this->getOne($condition);
        if (empty($result)) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * 增加
     * @param array $param
     * @return bool
     */
    public function save($param)
    {
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $model = new StoreJoinin();
            $result = $model->save($tmp);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 增加
     * @param array $param
     * @return bool
     */
    public function saveAll($param)
    {
        return $this->insertAll($param);
    }

    /**
     * 更新
     * @param array $update 更新的数据集合
     * @param array $condition 查找条件
     * @return bool
     */
    public function modify($update, $condition)
    {
        $result = StoreJoinin::findFirst($condition);
        if($result->save($update)){
            return true;
        }else{
            return false;
        }
    }

    /*
     * 删除
     * @param array $condition
     * @return bool
     */
    public function drop($condition)
    {
        return $this->where($condition)->delete();
    }

    /**
     * 编辑
     * @param array $condition
     * @param array $update
     * @return bool
     */
    public function editStoreJoinin($condition, $update)
    {
        return $this->where($condition)->update($update);
    }
}
