<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/21
 * Time: 15:21
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\Message;

class MessageLogic extends Model
{
    /**
     * 获取未读信息数量
     * @param $member_id 会员id
     * @return mixed
     */
    public function countNewMessage($member_id){
        $condition_arr = array();
        $condition_arr['to_member_id'] = "$member_id";
        $condition_arr['message_state'] = '2';
        $condition_arr['message_open'] = '0';
        $condition_arr['del_member_id'] = "$member_id";
        $condition_arr['read_member_id'] = "$member_id";
        $countnum = $this->countMessage($condition_arr);
        return $countnum;
    }

    /**
     * 站内信总数
     * @param array $condition
     * @return array mixed
     */
    public function countMessage($condition) {
        //得到条件语句
        $condition_str = parseWhere($condition);
        //$param  = array();
        //$param['table']     = 'message';
        //$param['where']     = $condition_str;
        //$param['field']     = ' count(message_id) as countnum ';
        //$message_list       = Db::select($param,$page);
        //return $message_list[0]['countnum'];
        return Message::count($condition_str);
    }
}