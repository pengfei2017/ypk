<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 19:09
 */

namespace Ypk\Logic;


use Ypk\Model;

class ContractLogic extends Model
{
    private $itemstate_arr;
    private $contract_auditstate_arr;
    private $contract_joinstate_arr;
    private $contract_closestate_arr;
    private $contract_quitstate_arr;
    private $join_auditstate_arr;
    private $quit_auditstate_arr;
    private $goods_contractstate_arr;
    private $log_role_arr;

    /**
     * 通过缓存获得保障项目列表
     * @param string $state 显示的保障项目状态 'all'为全部记录，'open'为仅显示开启的项目，'close'为仅显示关闭的项目
     * @return array|mixed
     */
    public function getContractItemByCache($state = 'open') {
        $list_tmp = read_file_cache('contractitem', true);
        if ($state == 'all') {//返回全部记录
            return $list_tmp;
        }
        $list = array();
        if ($list_tmp) {
            foreach ($list_tmp as $k=>$v) {
                if ($v['cti_state_key'] == $state) {
                    $list[$k] = $v;
                }
            }
        }
        return $list;
    }

    /**
     * 获取保障项目状态数组
     */
    public function getItemState(){
        return $this->itemstate_arr;
    }
}