<?php
/**
 * 医生动态评论
 */
namespace Ypk\MyModels;

use Ypk\Model;
use Ypk\Db;
use Ypk\Tpl;

class store_sns_commentModel extends Model {
    public function __construct(){
        parent::__construct('store_sns_comment');
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
    public function getStoreSnsCommentList($condition, $field = '*', $order = 'scomm_id desc', $limit = 0, $page = 0) {
        return $this->where($condition)->field($field)->order($order)->limit($limit)->page($page)->select();
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
    public function getStoreSnsCommentInfo($condition, $field = '*') {
        return $this->where($condition)->field($field)->find();
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

    public function editStoreSnsComment($update, $condition) {
        return $this->where($condition)->update($update);
    }

    /**
     * 删除医生动态评论
     *
     * @param array $condition
     * @return boolean
     */
    public function delStoreSnsComment($condition) {
        return $this->where($condition)->delete();
    }
}
