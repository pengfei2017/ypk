<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/1
 * Time: 14:05
 */

namespace Ypk;


/**
 * hpf
 *
 * Class QueueDB
 * @package Ypk
 */
class QueueDB
{

    //定义对象
    private $_redis;

    //存储前缀
    private $_tb_prefix = 'QUEUE_';

    //存定义存储表的数量,系统会随机分配存储（既队列的数量，这里有两个队列，每个队列有一个key）
    private $_tb_num = 1;

    //临时存储表
    private $_tb_tmp = 'TMP_TABLE';

    /**
     * 初始化
     */
    public function __construct()
    {
        if (!extension_loaded('redis')) {
            throw_exception('phpredis扩展未加载或者未安装');
        }
        $this->_redis = new \Redis();
        $this->_redis->connect(getConfig('queue.host'), getConfig('queue.port'));
        $this->_redis->auth(getConfig('queue.auth'));
        $this->_tb_prefix = getConfig('redis.prefix') . $this->_tb_prefix;
    }

    /**
     * 入列
     * @param mixed $value
     * @return bool|int
     */
    public function push($value)
    {
        try {
            return $this->_redis->lPush($this->_tb_prefix . rand(1, $this->_tb_num), $value);
        } catch (\Exception $e) {
            throw_exception($e->getMessage());
            return false;
        }
    }

    /**
     * 取得所有的list key(表)
     */
    public function scan()
    {
        $list_key = array();
        for ($i = 1; $i <= $this->_tb_num; $i++) { //$this->_tb_num是队列的数量
            $list_key[] = $this->_tb_prefix . $i;
        }
        return $list_key;
    }

    /**
     * 出列
     * @param array $key
     * @param int $time
     * @return mixed
     */
    public function pop($key, $time)
    {
        try {
            if ($result = $this->_redis->brPop($key, $time)) { //block阻塞，right，pop,阻塞直到，Redis Brpop 命令移出并获取列表的最后一个元素， 如果列表没有元素会阻塞列表直到等待超时或发现可弹出元素为止
                return $result[1];
            } else {
                return null;
            }
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }

    /**
     * 清空,暂时无用
     */
    public function clear()
    {
        $this->_redis->flushAll();
    }
}