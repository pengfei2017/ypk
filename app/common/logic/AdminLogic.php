<?php

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Admin;

/**
 * 管理员
 */
class AdminLogic extends Model
{
    /**
     * 管理员列表
     *
     * @param array $condition 检索条件
     * @param obj $obj_page 分页对象
     * @return array 数组类型的返回结果
     */
    public function getAdminList($condition, $obj_page)
    {
        $condition_str = $this->_condition($condition);
        $param = array(
            'table' => 'admin',
            'field' => '*',
            'where' => $condition_str
        );
        $result = Db::select($param);
        return $result;
    }

    /**
     * 构造检索条件
     *
     * @param array $condition 检索条件
     * @return string 字符串类型的返回结果
     */
    public function _condition($condition)
    {
        $condition_str = '';

        if ($condition['admin_id'] != '') {
            $condition_str .= " and admin_id = '" . $condition['admin_id'] . "'";
        }
        if ($condition['admin_name'] != '') {
            $condition_str .= " and admin_name = '" . $condition['admin_name'] . "'";
        }
        if ($condition['admin_password'] != '') {
            $condition_str .= " and admin_password = '" . $condition['admin_password'] . "'";
        }

        return $condition_str;
    }

    /**
     * 取单个管理员的内容
     *
     * @param int $admin_id 管理员ID
     * @return mixed 数组类型的返回结果
     */
    public function getOneAdmin($admin_id)
    {
        if (intval($admin_id) > 0) {
            $result = Admin::findFirst(array(
                "conditions" => getConditionsByParamArray(array('admin_id' => intval($admin_id))),
                "bind" => array('admin_id' => intval($admin_id))
            ));
            if ($result) {
                return $result->toArray();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * 获取管理员信息
     *
     * @param   array $paramArray 管理员条件
     * @return  mixed 数组格式的返回结果
     */
    public function infoAdmin($paramArray)
    {
        if (empty($paramArray)) {
            return false;
        }

        $admin_info = Admin::findFirst(array(
            "conditions" => getConditionsByParamArray($paramArray),
            "bind" => $paramArray
        ));
        if ($admin_info) {
            return $admin_info->toArray();
        } else {
            return false;
        }
    }

    /**
     * 新增
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function addAdmin($param)
    {
        if (empty($param)) {
            return false;
        }
        if (is_array($param)) {
            $admin = new Admin();
            return $admin->save($param);
        } else {
            return false;
        }
    }

    /**
     * 更新信息
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function updateAdmin($param)
    {
        if (empty($param)) {
            return false;
        }
        if (is_array($param)) {
            $admin = Admin::findFirst(array(
                "conditions" => getConditionsByParamArray(array('admin_id' => $param['admin_id'])),
                "bind" => array('admin_id' => $param['admin_id'])
            ));
            if ($admin) {
                return $admin->save($param);
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    /**
     * 删除
     *
     * @param int $id 记录ID
     * @return mixed $rs_row 返回数组形式的查询结果
     */
    public function delAdmin($id)
    {
        if (intval($id) > 0) {
            $where = " admin_id = '" . intval($id) . "'";
            $result = Db::delete('admin', $where);
            return $result;
        } else {
            return false;
        }
    }
}
