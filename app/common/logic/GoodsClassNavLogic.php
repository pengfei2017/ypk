<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 19:01
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\GoodsClassNav;

class GoodsClassNavLogic extends Model
{
    /**
     * 根据商品分类id取得数据
     * @param int $gc_id
     * @return array
     */
    public function getGoodsClassNavInfoByGcId($gc_id)
    {
        $res = array();
        $result = GoodsClassNav::findFirst('gc_id = ' . $gc_id);
        if ($result) {
            $res = $result->toArray();
        }
        return $res;
    }
}