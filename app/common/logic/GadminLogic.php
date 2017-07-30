<?php

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Gadmin;

/**
 * 管理员权限组
 */
class GadminLogic extends Model
{
    /**
     * 根据id查询后台管理员权限组
     * @param int $id
     * @return array
     */
    public function getGadminInfoById($id)
    {
        $gadmin = Gadmin::findFirst(array(
            "conditions" => getConditionsByParamArray(array('gid' => $id)),
            "bind" => array('gid' => $id)
        ));
        if ($gadmin) {
            return $gadmin->toArray();
        } else {
            return null;
        }
    }
}
