<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 16:09
 */

namespace Ypk\Logic;

use Ypk\Model;
use Ypk\Models\Express;
use Ypk\Models\Waybill;

/**
 * Class ExpressLogic
 * @package Ypk\Logic
 *
 * 快递 逻辑处理类
 */
class ExpressLogic extends Model
{
    public function __construct()
    {
        parent::__construct('express');
    }

    /**
     * 从缓存中获取列表数据
     * @return Waybill[]|bool
     */
    public function getExpressList()
    {
        $arrList = read_file_cache('express', true);
        if (!$arrList) { //判断缓存中是否有数据
            $arrList = Express::find();
            if (count($arrList) > 0) {
                write_file_cache('express', $arrList);
            } else {
                return false;
            }
        }
        return $arrList;
    }

    /**
     * 根据编号查询快递列表
     * @param null $id
     * @return array|mixed
     */
    public function getExpressListByID($id = null)
    {
        $express_list = read_file_cache('express', true);

        if (!empty($id)) {
            $id_array = explode(',', $id);
            foreach ($express_list as $key => $value) {
                if (!in_array($key, $id_array)) {
                    unset($express_list[$key]);
                }
            }
            return $express_list;
        } else {
            return array();
        }
    }

    /**
     * 查询详细信息
     */
    public function getExpressInfo($id)
    {
        $express_list = $this->getExpressList();
        return $express_list[$id];
    }

    /**
     * 根据快递公司ecode获得快递公司信息
     * @param $ecode string 快递公司编号
     * @return array 快递公司详情
     */
    public function getExpressInfoByECode($ecode)
    {
        $ecode = trim($ecode);
        if (!$ecode) {
            return array('state' => false, 'msg' => '参数错误');
        }
        $express_list = $this->getExpressList();
        $express_info = array();
        if ($express_list) {
            foreach ($express_list as $v) {
                if ($v['e_code'] == $ecode) {
                    $express_info = $v;
                }
            }
        }
        if (!$express_info) {
            return array('state' => false, 'msg' => '快递公司信息错误');
        } else {
            return array('state' => true, 'data' => array('express_info' => $express_info));
        }
    }

    /**
     * 查询物流信息
     * @param unknown $e_code
     * @param unknown $shipping_code
     * @return multitype:
     */
    function get_express($e_code, $shipping_code)
    {
        $url = 'http://www.kuaidi100.com/query?type=' . $e_code . '&postid=' . $shipping_code . '&id=1&valicode=&temp=' . random(4) . '&sessionid=&tmp=' . random(4);
        import('function.ftp');
        $content = dfsockopen($url);
        $content = json_decode($content, true);

        if ($content['status'] != 200 || !is_array($content['data'])) {
            return array();
        }
        return $content['data'];
    }
}