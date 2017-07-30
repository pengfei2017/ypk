<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 14:28
 */

namespace Ypk;


/**
 * hpf
 *
 * Class QueueServer
 * @package Ypk
 */
class QueueServer
{

    private $_queuedb;

    public function __construct()
    {
        $this->_queuedb = new QueueDB();
    }

    /**
     * 取出队列
     * @param array $key
     * @param int $time
     * @return mixed
     */
    public function pop($key, $time)
    {
        return unserialize($this->_queuedb->pop($key, $time));
    }

    /**
     * @return array
     */
    public function scan()
    {
        return $this->_queuedb->scan();
    }
}