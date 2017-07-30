<?php
/**
 * 系统文章
 * User: Administrator
 * Date: 2016/11/27
 * Time: 21:42
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Document;

class DocumentLogic extends Model
{
    /**
     * 查询所有系统文章
     */
    public function getList()
    {
        $param = array(
            'table' => 'document'
        );
        return Db::select($param);
    }

    /**
     * 根据编号查询一条
     *
     * @param $id
     * @return array
     */
    public function getOneById($id)
    {
        $param = array(
            'table' => 'document',
            'field' => 'doc_id',
            'value' => $id
        );
        return Db::getRow($param);
    }

    /**
     * 根据标识码查询一条
     *
     * @param $code
     * @return array
     */
    public function getOneByCode($code)
    {
        $info = Document::findFirst("doc_code='" . $code . "'");
        if ($info) {
            return $info->toArray();
        } else {
            return array();
        }
    }

    /**
     * 更新
     *
     * @param unknown_type $param
     */
    public function updates($param)
    {
        return Db::update('document', $param, "doc_id='{$param['doc_id']}'");
    }
}