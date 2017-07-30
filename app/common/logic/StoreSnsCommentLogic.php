<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/30
 * Time: 18:24
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\StoreSnsComment;

class StoreSnsCommentLogic extends Model
{
    public function initialize(){
       // parent::initialize('store_sns_comment');
    }

    /**
     * 医生动态评论列表
     *
     * @param array $condition
     * @param string $field
     * @param string $order
     * @param int $limit
     * @param int $page
     * @return array
     */
    public function getStoreSnsCommentList($condition)
    {
        $result = StoreSnsComment::find($condition);
        if(count($result) > 0){
            return $result->toArray();
        }else{
            return array();
        }
    }

    /**
     * 医生评论数量
     * @param array $condition
     * @return array
     */
    public function getStoreSnsCommentCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 获取单条评论
     *
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getStoreSnsCommentInfo($condition) {
        $result = StoreSnsComment::findFirst($condition);
        //return $this->where($condition)->field($field)->find();
        return $result->toArray();
    }

    /**
     * 保存医生评论
     *
     * @param array $insert
     * @return boolean
     */
    public function saveStoreSnsComment($insert) {
        return $this->insert($insert);
    }

    /**
     * 动态评论内容编辑
     * @param $update
     * @param $condition
     * @return mixed
     */
    public function editStoreSnsComment($update, $condition) {
        $result = StoreSnsComment::findFirst($condition);
        if($result->save($update)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 删除医生动态评论
     *
     * @param array $condition
     * @return boolean
     */
    public function delStoreSnsComment($condition) {
        $result = StoreSnsComment::findFirst($condition);
        if($result->delete()){
            return true;
        }else{
            return false;
        }
    }
}
