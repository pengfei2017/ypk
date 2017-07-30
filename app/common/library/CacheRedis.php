<?php
/**
 * Created by hpf.
 * User: 贺鹏飞
 * Date: 2016/12/5
 * Time: 10:25
 */

namespace Ypk;

use Phalcon\Cache\Frontend\Data;
use Phalcon\Cache\Backend\Redis;

/**
 * hpf
 *
 * redis 操作
 *
 * Class CacheRedis
 * @package Ypk
 */
class CacheRedis
{
    /**
     * redis缓存服务器配置
     * @var array
     */
    private $config;

    /**
     * 用户自定义键名前缀
     * @var string
     */
    private $user_prefix = '';

    /**
     * 系统定义键名前缀
     * @var string
     */
    private $sys_prefix = '';

    /**
     * redis实例
     * @var Redis
     */
    private $handler;

    public function __construct()
    {
        $this->config = getConfig('redis');
        if (empty($this->config)) {
            throw_exception('redis 服务器连接信息未配置');
        }
        $this->sys_prefix = $this->config['prefix'] ? $this->config['prefix'] : substr(md5($_SERVER['HTTP_HOST']), 0, 6) . '_';
        if (!extension_loaded('redis')) {
            throw_exception('phpredis扩展未加载或者未安装');
        }
        $this->init();
    }

    private function init()
    {
        static $_cache;
        if (isset($_cache)) {
            $this->handler = $_cache;
        } else {
            $frontCache = new Data(
                array(
                    "lifetime" => 31536000 //默认是一年
                )
            );

            $this->handler = new Redis(
                $frontCache,
                array(
                    'host' => $this->config['host'], //redis服务器ip
                    'port' => $this->config['port'], //端口号
                    'auth' => $this->config['auth'],
                    'persistent' => $this->config['persistent'], //是否长连接 false=短连接
                    'index' => 0,
                )
            );

            $_cache = $this->handler;
        }
    }

    public function get($key, $user_prefix = '')
    {
        $this->user_prefix = $user_prefix;
        return $this->handler->get($this->_key($key));
    }

    public function set($key, $value, $user_prefix = '', $expire = null)
    {
        $this->user_prefix = $user_prefix;
        if (is_int($expire)) {
            $result = $this->handler->save($this->_key($key), $value, $expire);
        } else {
            $result = $this->handler->save($this->_key($key), $value);
        }
        return $result;
    }

    /**
     * @param string $name
     * @param string $user_prefix
     * @param array $data
     * @return bool
     */
    public function hset($name, $user_prefix, $data)
    {
        if (is_array($data) && !empty($data)) {
            $this->user_prefix = $user_prefix;
            foreach ($data as $key => $value) {
                /**
                 * array(
                 *    'goods_hit'=>array('exp',1),
                 *    'goods_name'=>'小商品'
                 *    )
                 */
                if (is_array($value) && !empty($value)) {
                    if ($value[0] == 'exp') {
                        $value[1] = str_replace(' ', '', $value[1]);
                        preg_match('/^[A-Za-z_]+([+-]\d+(\.\d+)?)$/', $value[1], $matches);
                        if (is_numeric($matches[1])) {
                            $this->hIncrBy($name, $user_prefix, $key, $matches[1]);
                        }
                        unset($data[$key]);
                    }
                }
            }
            if (count($data) > 0) {
                $hash_array = $this->handler->get($this->_key($name));
                if (!empty($hash_array) && is_array($hash_array)) {
                    foreach ($data as $key => $val) {
                        $hash_array[$key] = $val;
                    }
                    return $this->handler->save($this->_key($name), $hash_array);
                } else {
                    return $this->handler->save($this->_key($name), $data);
                }
            } else {
                return true;
            }
        } else {
            throw_exception('要存储的数据必须是数组且不能为空');
            return false;
        }
    }

    public function hset_bak($name, $user_prefix, $data)
    {
        if (is_array($data)) {
            $this->user_prefix = $user_prefix;
            foreach ($data as $key => $value) {
                if ($value[0] == 'exp') {
                    $value[1] = str_replace(' ', '', $value[1]);
                    preg_match('/^[A-Za-z_]+([+-]\d+(\.\d+)?)$/', $value[1], $matches);
                    if (is_numeric($matches[1])) {
                        $this->hIncrBy($name, $user_prefix, $key, $matches[1]);
                    }
                    unset($data[$key]);
                }
            }
            if (count($data) > 0) {
                $hash_array = $this->handler->get($this->_key($name));
                if (!empty($hash_array) && is_array($hash_array)) {
                    foreach ($data as $key => $val) {
                        $hash_array[$key] = $val;
                    }
                    return $this->handler->save($this->_key($name), $hash_array);
                } else {
                    return $this->handler->save($this->_key($name), $data);
                }
            } else {
                return true;
            }
        } else {
            throw_exception('要存储的数据必须是数组');
            return false;
        }
    }

    /**
     * @param string $name
     * @param string $user_prefix
     * @param string $key
     * @return array|mixed|null
     */
    public function hget($name, $user_prefix, $key = null)
    {
        $this->user_prefix = $user_prefix;
        $hash_array = $this->handler->get($this->_key($name));
        if (!empty($hash_array) && is_array($hash_array)) {
            if ($key == '*' || is_null($key)) {
                return $hash_array;
            } elseif (strpos($key, ',') != false) {
                $keys = explode(',', $key);
                $array = array();
                foreach ($keys as $k) {
                    $array[$k] = $hash_array[$k];
                }
                return $array;
            } else {
                return $hash_array[$key];
            }
        } else {
            return false;
        }
    }

    public function hdel($name, $user_prefix, $key = null)
    {
        $this->user_prefix = $user_prefix;
        if (is_null($key)) {
            if (is_array($name)) {
                array_walk($name, array($this, '_key'));
                foreach ($name as $n) {
                    if ($this->handler->delete($n) == false) {
                        return false;
                    }
                }
                return true;
            } else {
                return $this->handler->delete($this->_key($name));
            }
        } else {
            if (is_array($name)) {
                foreach ($name as $n) {
                    $hash_array = $this->handler->get($this->_key($n));
                    if (!empty($hash_array) && is_array($hash_array)) {
                        unset($hash_array[$key]);
                        if ($this->handler->save($this->_key($n), $hash_array) == false) {
                            return false;
                        }
                    }
                }
                return true;
            } else {
                $hash_array = $this->handler->get($this->_key($name));
                if (!empty($hash_array) && is_array($hash_array)) {
                    unset($hash_array[$key]);
                    return $this->handler->save($this->_key($name), $hash_array);
                } else {
                    return true;
                }
            }
        }
    }

    public function hIncrBy($name, $user_prefix, $key, $num = 1)
    {
        $this->user_prefix = $user_prefix;
        $hash_array = $this->handler->get($this->_key($name));
        if (!empty($hash_array) && is_array($hash_array) && isset($hash_array[$key])) {
            $hash_array[$key] = floatval($hash_array[$key]) + floatval($num);
            return $this->handler->save($this->_key($name), $hash_array);
        }
        return true;
    }

    public function rm($key, $user_prefix = '')
    {
        $this->user_prefix = $user_prefix;
        return $this->handler->delete($this->_key($key));
    }

    public function clear()
    {
        return $this->handler->flush();
    }

    private function _key($str)
    {
        return $this->sys_prefix . $this->user_prefix . ":" . $str;
    }
}