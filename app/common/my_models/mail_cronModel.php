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
 * 邮件任务队列模型
 */
class mail_cronModel extends Model
{
    public function __construct()
    {
        parent::__construct('mail_cron');
    }

    /**
     * 新增商家消息任务计划
     * @param string $insert
     * @return mixed
     */
    public function addMailCron($insert)
    {
        return $this->insert($insert);
    }

    /**
     * 查看商家消息任务计划
     *
     * @param mixed $condition
     * @param int|number $limit
     * @param string $order
     * @return
     */
    public function getMailCronList($condition, $limit = 0, $order = 'mail_id asc')
    {
        return $this->where($condition)->limit($limit)->order($order)->select();
    }

    /**
     * 删除商家消息任务计划
     * @param unknown $condition
     */
    public function delMailCron($condition)
    {
        return $this->where($condition)->delete();
    }
}
