<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 0:19
 */

namespace Ypk\Logic;

use Ypk\Model;

/**
 * 红包逻辑处理
 *
 * Class RedpacketLogic
 * @package Ypk\Logic
 */
class RedpacketLogic extends Model
{
    /**
     * 取得当前有效红包数量
     * @param int $member_id
     * @return int
     */
    public function getCurrentAvailableRedpacketCount($member_id)
    {
        $info = read_file_cache($member_id, false, null, 'm_redpacket/');
        if (empty($info['redpacket_count']) && $info['redpacket_count'] !== 0) {
            $condition['rpacket_owner_id'] = $member_id;
            $condition['rpacket_end_date'] = array('gt', TIMESTAMP);
            $condition['rpacket_state'] = 1;
            $redpacket_count = $this->table('redpacket')->where($condition)->count();
            $redpacket_count = intval($redpacket_count);
            write_file_cache($member_id, array('redpacket_count' => $redpacket_count), null, 'm_redpacket/');
        } else {
            $redpacket_count = intval($info['redpacket_count']);
        }
        return $redpacket_count;
    }
}