<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/10
 * Time: 2:10
 */

namespace Ypk;


/**
 * 连续操作验证
 * 默认如果两次操作间隔小于10分钟，系统会记录操作次数，超过N次将被锁定，10分钟以后才能提交表单
 * 超过10分钟提交表单，以前记录的数据将被清空，重新从1开始计数
 */
class Process
{

    const MAX_LOGIN = 8;    //密码连续输入多少次被暂时锁定
    const MAX_COMMIT = 3;    //连续评论多少次被暂时锁定
    const MAX_REG = 3;        //连续注册多少个账号被暂时锁定
    const MAX_FORGET = 6;    //找回密码输入多少次被暂时锁定
    const MAX_ADMIN = 3;    //后台管理员输入多少次被暂时锁定

    /**
     * 是否启用验证
     *
     * @var boolean
     */
    private static $ifopen = true;

    /**
     * 锁表对象
     *
     * @var object
     */
    private static $lock;

    /**
     * 记录ID
     *
     * @var array
     */
    private static $processid = array();

    /**
     * 锁ID
     *
     * @var array
     */
    private static $lockid = array();

    /**
     * 初始化，未启用内存保存时默认使用lock表存储
     *
     * @param string $type
     */
    private static function init($type)
    {
        self::$lock = new Lock();

        if (!isset(self::$processid[$type])) {
            $ip = sprintf('%u', ip2long(getIp()));
            self::$processid[$type] = str_pad($ip, 10, '0') . self::parsekey($type);
            self::$lockid[$type] = str_pad($ip, 11, '0') . self::parsekey($type);
        }
    }

    /**
     * 判断是否已锁
     *
     * @param string $type
     * @return boolean
     */
    public static function islock($type = null)
    {
        if (!self::$ifopen) return false;
        self::init($type);
        return self::$lock->get(self::$lockid[$type]);
    }

    /**
     * 添加锁
     *
     * @param string $type
     * @param int $ttl
     */
    private static function addlock($type = null, $ttl = 600)
    {
        if (!self::$ifopen) return;
        self::init($type);
        self::$lock->set(self::$lockid[$type], 1, '', $ttl);
    }

    /**
     * 删除锁
     *
     * @param string $type
     */
    public static function dellock($type = null)
    {
        if (!self::$ifopen) return;
        self::$lock->rm(self::$lockid[$type]);
    }

    /**
     * 添加记录
     *
     * @param string $type
     * @param int $ttl
     */
    public static function addprocess($type = null, $ttl = 600)
    {
        if (!self::$ifopen) return;
        self::init($type);
        $tims = self::parsetimes($type);
        $t = self::$lock->get(self::$processid[$type]);
        if ($t >= $tims - 1) {
            self::addlock($type, $ttl);
            self::$lock->rm(self::$processid[$type]);
        } else {
            if (empty($t)) $t = 0;
            self::$lock->set(self::$processid[$type], $t + 1, '', $ttl);
        }
    }

    /**
     * 删除记录
     *
     * @param string $type
     */
    public static function delprocess($type = null)
    {
        if (!self::$ifopen) return;
        self::$lock->rm(self::$processid[$type]);
    }

    /**
     * 清空
     * @param string $type
     */
    public static function clear($type = '')
    {
        if (!self::$ifopen) return;
        if (empty($type)) return;
        self::dellock($type);
        self::delprocess($type);
    }

    public static function parsekey($type)
    {
        return str_replace(array('login', 'commit', 'reg', 'forget', 'admin'), array(1, 2, 3, 4, 5), $type);
    }

    /**
     * 设置最多尝试次数
     *
     * @param string $type
     * @return mixed
     */
    public static function parsetimes($type)
    {
        return str_replace(array('login', 'commit', 'reg', 'forget', 'admin'), array(self::MAX_LOGIN, self::MAX_COMMIT, self::MAX_REG, self::MAX_FORGET, self::MAX_ADMIN), $type);
    }
}

/**
 * lock表 操作
 */
class Lock
{
    public function __construct()
    {

    }

    /**
     * 设置值
     *
     * @param mixed $key
     * @param mixed $value
     * @param string $type
     * @param int $ttl
     * @return bool
     */
    public function set($key, $value, $type = '', $ttl = SESSION_EXPIRE)
    {
        $info = \Ypk\Models\Lock::findFirst(array(
            "conditions" => getConditionsByParamArray(array('pid' => $key)),
            "bind" => array('pid' => $key)
        ));
        if ($info) {
            return $info->save(array(
                'pvalue' => $value,
                'expiretime' => TIMESTAMP + $ttl
            ));
        } else {
            $info = new \Ypk\Models\Lock();
            return $info->save(array(
                'pid' => $key,
                'pvalue' => $value,
                'expiretime' => TIMESTAMP + $ttl
            ));
        }
    }

    /**
     * 取得值
     *
     * @param mixed $key
     * @return mixed
     */
    public function get($key)
    {
        $info = \Ypk\Models\Lock::findFirst(array(
            "conditions" => getConditionsByParamArray(array('pid' => $key)),
            "bind" => array('pid' => $key)
        ));
        if ($info) {
            if ($info->getExpiretime() < TIMESTAMP) {
                $this->rm($key);
                return null;
            } else {
                return $info->getPvalue();
            }
        } else {
            return null;
        }
    }

    /**
     * 删除值
     *
     * @param mixed $key
     * @param string $type
     * @return bool
     */
    public function rm($key, $type = '')
    {
        $lock = \Ypk\Models\Lock::findFirst(array(
            "conditions" => getConditionsByParamArray(array('pid' => $key)),
            "bind" => array('pid' => $key)
        ));
        if ($lock) {
            return $lock->delete();
        } else {
            //数据记录不存在，相当于已经删了，删除成功
            return true;
        }
    }
}