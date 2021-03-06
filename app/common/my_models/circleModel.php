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
 * 圈子模型
 */
class circleModel extends Model {
    public function __construct(){
        parent::__construct('circle');
    }

    /**
     * 获取圈子数量
     * @param array $condition
     * @return int
     */
    public function getCircleCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 未审核的圈子数量
     * @param array $condition
     * @return int
     */
    public function getCircleUnverifiedCount($condition = array()) {
        $condition['circle_status'] = 2;
        return $this->getCircleCount($condition);
    }
}
