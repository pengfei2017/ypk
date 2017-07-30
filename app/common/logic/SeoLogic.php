<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/14
 * Time: 2:17
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\Seo;

class SeoLogic extends Model
{
    /**
     * @return array
     *
     * 获取全部的seo设置信息
     */
    public function getAllList()
    {
        $seoList = Seo::find();
        if (count($seoList) > 0) {
            return $seoList->toArray();
        } else {
            return null;
        }
    }
}