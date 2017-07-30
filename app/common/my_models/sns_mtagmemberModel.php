<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 23:40
 */

namespace Ypk\MyModels;

use Ypk\Model;
use Ypk\Db;
use Ypk\Tpl;

/**
 * 标签会员
 *
 */
class sns_mtagmemberModel extends Model {

    public function __construct(){
        parent::__construct('sns_mtagmember');
    }

    /**
     * 标签会员列表
     * @param array $condition
     * @param int $page
     * @param string $order
     */
    public function getSnsMTagMemberList($condition, $page, $order) {
        return $this->where($condition)->order($order)->page($page)->select();
    }
    
    /**
     * 更新标签会员
     * @param unknown $where
     * @param unknown $update
     */
    public function editSnsMTagMember($where, $update) {
        return $this->where($where)->update($update);
    }
    
    /**
     * 删除标签会员
     * @param unknown $where
     */
    public function delSnsMTagMember($where) {
        return $this->where($where)->delete();
    }
}