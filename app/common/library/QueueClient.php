<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/6
 * Time: 1:30
 */

namespace Ypk;


/**
 * hpf
 *
 * 队列处理
 *
 * Class QueueClient
 * @package Ypk
 */
class QueueClient
{

    private static $queuedb;

    /**
     * 入列
     * @param $key
     * @param mixed $value
     * @return bool|int|void
     */
    public static function push($key, $value)
    {
        if (!getConfig('queue.open')) {
            Logic('queue')->$key($value);
            return true;
        }
        if (!is_object(self::$queuedb)) {
            self::$queuedb = new QueueDB();
        }
        return self::$queuedb->push(serialize(array($key => $value)));
    }
}