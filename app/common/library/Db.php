<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/3
 * Time: 18:14
 */

namespace Ypk;

use Phalcon\Db\Adapter\Pdo\Mysql;

/**
 * hpf
 *
 * 自定义数据操作类
 *
 * 警告：该数据操作类必须在ypk\app\config\services.php中的$di->setShared('db', function () {})方法执行完之后才能使用
 *
 * Class Db
 * @package Ypk
 */
class Db
{
    /**
     * 是否自动提交事务
     * @var bool true为自动提交事务，false为手动提交事务
     */
    private static $iftransacte = true;

    private function __construct()
    {

    }

    /**
     * 获取phalcon框架的全局数据库连接对象
     * @return Mysql
     */
    public static function getDb()
    {
        return $GLOBALS['di']->getShared('db');
    }

    /**
     * 检查数据库是否关闭，没关闭的话关闭
     */
    public static function ping()
    {
        $db = self::getDb();
        if (is_object($db)) {
            $db->close();
        }
    }

    /**
     * 执行查询
     *
     * @param string $sql
     * @return bool|\Phalcon\Db\ResultInterface
     */
    public static function query($sql, $host = '')
    {
        $db = self::getDb();

        if (getConfig('debug')) addUpTime('queryStartTime');
        $query = $db->query($sql);
        if (getConfig('debug')) addUpTime('queryEndTime');

        if ($query === false) {
            $error = 'Db Error: ' . $db->getErrorInfo();
            if (getConfig('debug')) {
                throw_exception($error . '<br/>' . $sql);
                return false;
            } else {
                Log::record($error . "\r\n" . $sql, Log::ERR);
                Log::record($sql, Log::SQL);
                return false;
            }
        } else {
            Log::record($sql . " [ RunTime:" . addUpTime('queryStartTime', 'queryEndTime', 6) . "s ]", Log::SQL);
            return $query;
        }
    }

    /**
     * 取得数组
     *
     * @param string $sql
     * @return array
     */
    public static function getAll($sql)
    {
        $result = self::query($sql);

        if ($result === false) return array();

        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        return $array = $result->fetchAll();
    }

    /**
     * SELECT查询
     *
     * @param array $param 参数
     * @param Page $obj_page 分类对象
     * @return array
     */
    public static function select($param, $obj_page = null)
    {
        static $_cache = array();

        if (empty($param)) throw_exception('Db Error: select param is empty!');

        if (empty($param['field'])) {
            $param['field'] = '*';
        }
        if (empty($param['count'])) {
            $param['count'] = 'count(*)';
        }

        if (isset($param['index'])) {
            $param['index'] = 'USE INDEX (' . $param['index'] . ')';
        }

        if (trim($param['where']) != '') {
            if (strtoupper(substr(trim($param['where']), 0, 5)) != 'WHERE') {
                if (strtoupper(substr(trim($param['where']), 0, 3)) == 'AND') {
                    $param['where'] = substr(trim($param['where']), 3);
                }
                $param['where'] = 'WHERE ' . $param['where'];
            }
        } else {
            $param['where'] = '';
        }
        $param['where_group'] = '';
        if (!empty($param['group'])) {
            $param['where_group'] .= ' group by ' . $param['group'];
        }
        $param['where_order'] = '';
        if (!empty($param['order'])) {
            $param['where_order'] .= ' order by ' . $param['order'];
        }

        //判断是否是联表
        $tmp_table = explode(',', $param['table']);
        if (!empty($tmp_table) && count($tmp_table) > 1) {
            //判断join表数量和join条件是否一致
            if ((count($tmp_table) - 1) != count($param['join_on'])) {
                throw_exception('Db Error: join number is wrong!');
            }

            //trim 掉空白字符
            foreach ($tmp_table as $key => $val) {
                $tmp_table[$key] = trim($val);
            }

            //拼join on 语句
            $tmp_sql = '';
            for ($i = 1; $i < count($tmp_table); $i++) {
                $tmp_sql .= $param['join_type'] . ' `' . DBPRE . $tmp_table[$i] . '` as `' . $tmp_table[$i] . '` ON ' . $param['join_on'][$i - 1] . ' ';
            }
            $sql = 'SELECT ' . $param['field'] . ' FROM `' . DBPRE . $tmp_table[0] . '` as `' . $tmp_table[0] . '` ' . $tmp_sql . ' ' . $param['where'] . $param['where_group'] . $param['where_order'];

            //如果有分页，那么计算信息总数
            $count_sql = 'SELECT ' . $param['count'] . ' as count FROM `' . DBPRE . $tmp_table[0] . '` as `' . $tmp_table[0] . '` ' . $tmp_sql . ' ' . $param['where'] . $param['where_group'];
        } else {
            $sql = 'SELECT ' . $param['field'] . ' FROM `' . DBPRE . $param['table'] . '` as `' . $param['table'] . '` ' . $param['index'] . ' ' . $param['where'] . $param['where_group'] . $param['where_order'];
            $count_sql = 'SELECT ' . $param['count'] . ' as count FROM `' . DBPRE . $param['table'] . '` as `' . $param['table'] . '` ' . $param['index'] . ' ' . $param['where'];
        }
        //limit ，如果有分页对象的话，那么优先分页对象
        if ($obj_page instanceof Page) {
            $count_query = self::query($count_sql);
            $count_query->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $count_fetch = $count_query->fetchArray();
            $obj_page->setTotalNum($count_fetch['count']);
            $param['limit'] = $obj_page->getLimitStart() . "," . $obj_page->getEachNum();
        }
        if ($param['limit'] != '') {
            $sql .= ' limit ' . $param['limit'];
        }

        $key = isset($param['cache_key']) && is_string($param['cache_key']) ? $param['cache_key'] : md5($sql);
        if ($param['cache'] !== false) {

            if (isset($_cache[$key])) return $_cache[$key];
        }
        $result = self::query($sql);
        if ($result === false) $result = array();
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $array = $result->fetchAll();
        if ($param['cache'] !== false && !isset($_cache[$key])) {
            $_cache[$key] = $array;
        }
        return $array;
    }

    /**
     * 插入单条数据操作
     *
     * @param string $table_name 表名
     * @param array $insert_array 待插入数据
     * @return mixed
     */
    public static function insert($table_name, $insert_array = array())
    {
        if (!is_array($insert_array)) return false;
        $fields = array();
        $value = array();
        foreach ($insert_array as $key => $val) {
            //$fields[] = self::parseKey($key);
            $fields[] = $key;
            //$value[] = self::parseValue($val);
            $value[] = $val;
        }

        //当数据库没有自增ID的情况下，返回 是否成功
        $db = self::getDb();
        $result = $db->insert(DBPRE .$table_name, $value, $fields);
        $insert_id = $db->lastInsertId();
        return $insert_id ? $insert_id : $result;
    }

    /**
     * 批量插入
     *
     * @param string $table_name 表名
     * @param array $insert_array 待插入数据
     * @return mixed
     */
    public static function insertAll($table_name, $insert_array = array())
    {
        if (!is_array($insert_array[0])) return false;
        $fields = array_keys($insert_array[0]);
        array_walk($fields, array(self, 'parseKey'));
        $values = array();
        foreach ($insert_array as $data) {
            $value = array();
            foreach ($data as $key => $val) {
                $val = self::parseValue($val);
                if (is_scalar($val)) {
                    $value[] = $val;
                }
            }
            $values[] = '(' . implode(',', $value) . ')';
        }
        $sql = 'INSERT INTO `' . DBPRE . $table_name . '` (' . implode(',', $fields) . ') VALUES ' . implode(',', $values);
        $result = self::query($sql);
        $insert_id = self::getLastId();
        return $insert_id ? $insert_id : false;
    }

    /**
     * 更新操作
     *
     * @param string $table_name 表名
     * @param array $update_array 待更新数据
     * @param string $where 执行条件
     * @return bool
     */
    public static function update($table_name, $update_array = array(), $where = '')
    {
        if (!is_array($update_array)) return false;
        $string_value = '';
        foreach ($update_array as $k => $v) {
            if (is_array($v)) {
                switch ($v['sign']) {
                    case 'increase':
                        $string_value .= " $k = $k + " . $v['value'] . ",";
                        break;
                    case 'decrease':
                        $string_value .= " $k = $k - " . $v['value'] . ",";
                        break;
                    case 'calc':
                        $string_value .= " $k = " . $v['value'] . ",";
                        break;
                    default:
                        $string_value .= " $k = " . self::parseValue($v['value']) . ",";
                }
            } else {
                $string_value .= " $k = " . self::parseValue($v) . ",";
            }
        }

        $string_value = trim(trim($string_value), ',');
        if (trim($where) != '') {
            if (strtoupper(substr(trim($where), 0, 5)) != 'WHERE') {
                if (strtoupper(substr(trim($where), 0, 3)) == 'AND') {
                    $where = substr(trim($where), 3);
                }
                $where = ' WHERE ' . $where;
            }
        }
        $sql = 'UPDATE `' . DBPRE . $table_name . '` AS `' . $table_name . '` SET ' . $string_value . ' ' . $where;
        $result = self::query($sql);
        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * 删除操作
     *
     * @param string $table_name 表名
     * @param string $where 执行条件
     * @return bool
     */
    public static function delete($table_name, $where = '')
    {
        if (trim($where) != '') {
            if (strtoupper(substr(trim($where), 0, 5)) != 'WHERE') {
                if (strtoupper(substr(trim($where), 0, 3)) == 'AND') {
                    $where = substr(trim($where), 3);
                }
                $where = ' WHERE ' . $where;
            }
            $sql = 'DELETE FROM `' . DBPRE . $table_name . '` ' . $where;
            $result = self::query($sql);
            if ($result == false) {
                return false;
            } else {
                return true;
            }
        } else {
            throw_exception('Db Error: the condition of delete is empty!');
            return false;
        }
    }

    /**
     * 取得上一步插入产生的ID
     *
     * @return int
     */
    public static function getLastId()
    {
        $db = self::getDb();
        $id = $db->lastInsertId();

        if ($id == false) {
            $result = self::query('SELECT last_insert_id() as id');
            if ($result === false) return false;
            $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
            $id = $result->fetchArray();
            $id = $id['id'];
        }
        return $id;
    }

    /**
     * 取得一行信息
     *
     * @param array $param
     * @param string $fields
     * @return array
     */
    public static function getRow($param, $fields = '*')
    {
        $table = $param['table'];
        $wfield = $param['field'];
        $value = $param['value'];

        if (is_array($wfield)) {
            $where = array();
            foreach ($wfield as $k => $v) {
                $where[] = $v . "='" . $value[$k] . "'";
            }
            $where = implode(' and ', $where);
        } else {
            $where = $wfield . "='" . $value . "'";
        }

        $sql = "SELECT " . $fields . " FROM `" . DBPRE . $table . "` WHERE " . $where;
        $result = self::query($sql);
        if ($result === false) return array();
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        return $result->fetchArray();
    }

    /**
     * 执行REPLACE操作,如果主键或者是唯一索引已经存在，则更新数据行，如果不存在，则新插入一条数据
     *
     * @param string $table_name 表名
     * @param array $replace_array 待更新的数据
     * @return bool
     */
    public static function replace($table_name, $replace_array = array())
    {
        if (!empty($replace_array)) {
            $string_field = '';
            $string_value = '';
            foreach ($replace_array as $k => $v) {
                $string_field .= " $k ,";
                $string_value .= " '" . $v . "',";
            }
            $sql = 'REPLACE INTO `' . DBPRE . $table_name . '` (' . trim($string_field, ', ') . ') VALUES(' . trim($string_value, ', ') . ')';
            $result = self::query($sql);
            if ($result == false) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * 返回单表查询记录数量
     *
     * @param string $table 表名
     * @param $condition mixed 查询条件，可以为空，也可以为数组或字符串
     * @return int
     */
    public static function getCount($table, $condition = null)
    {
        if (!empty($condition) && is_array($condition)) {
            $where = '';
            foreach ($condition as $key => $val) {
                self::parseKey($key);
                $val = self::parseValue($val);
                $where .= ' AND ' . $key . '=' . $val;
            }
            $where = ' WHERE ' . substr($where, 4);
        } elseif (is_string($condition)) {
            if (strtoupper(substr(trim($condition), 0, 3)) == 'AND') {
                $where = ' WHERE ' . substr(trim($condition), 4);
            } else {
                $where = ' WHERE ' . $condition;
            }
        }
        $sql = 'SELECT COUNT(*) as `count` FROM `' . DBPRE . $table . '` as `' . $table . '` ' . (isset($where) ? $where : '');
        $result = self::query($sql);
        if ($result === false) return 0;
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $result = $result->fetchArray();
        return $result['count'];
    }

    /**
     * 执行SQL语句
     *
     * @param string $sql 待执行的SQL
     * @return bool
     */
    public static function execute($sql)
    {
        $db = self::getDb();
        $result = $db->execute($sql);
        return $result;
    }

    /**
     * 列出所有表
     *
     * @return array
     */
    public static function showTables()
    {
        $sql = 'SHOW TABLES';
        $result = self::query($sql);
        if ($result === false) return array();

        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        return $result->fetchAll();
    }

    /**
     * 显示建表语句
     *
     * @param string $table
     * @return string
     */
    public static function showCreateTable($table)
    {
        $sql = 'SHOW CREATE TABLE `' . DBPRE . $table . '`';
        $result = self::query($sql);
        if ($result === false) return '';
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $result = $result->fetchArray();
        return $result['Create Table'];
    }

    /**
     * 显示表结构信息
     *
     * @param string $table
     * @return array
     */
    public static function showColumns($table)
    {
        $sql = 'SHOW COLUMNS FROM `' . DBPRE . $table . '`';
        $result = self::query($sql);
        if ($result === false) return array();

        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $array = array();
        while ($tmp = $result->fetchArray()) {
            $array[$tmp['Field']] = array(
                'name' => $tmp['Field'],
                'type' => $tmp['Type'],
                'null' => $tmp['Null'],
                'default' => $tmp['Default'],
                'primary' => (strtolower($tmp['Key']) == 'pri'),
                'autoinc' => (strtolower($tmp['Extra']) == 'auto_increment'),
            );
        }
        return $array;
    }

    /**
     * 取得服务器版本信息
     *
     * @return string
     */
    public static function getServerInfo()
    {
        $result = self::query('show variables like \'%version%\'');
        $result->setFetchMode(\Phalcon\Db::FETCH_ASSOC);
        $result = $result->fetchAll();
        foreach ($result as $res) {
            if ($res['Variable_name'] == "version") {
                return $res['Value'];
                break;
            }
        }
        return '';
    }

    /**
     * 格式化字段
     *
     * @param string $key 字段名
     * @return string
     */
    public static function parseKey(&$key)
    {
        $key = trim($key);
        if (!preg_match('/[,\'\"\*\(\)`.\s]/', $key)) {
            $key = '`' . $key . '`';
        }
        return $key;
    }

    /**
     * 格式化值
     *
     * @param mixed $value
     * @return mixed
     */
    public static function parseValue($value)
    {
        $value = addslashes(stripslashes($value));//重新加斜线，防止从数据库直接读取出错
        return "'" . $value . "'";
    }

    /**
     * 开启事务
     */
    public static function beginTransaction()
    {
        if (self::$iftransacte) {
            //事务自动提交时，关闭自动提交，改为手动提交
            $db = self::getDb();
            $result = $db->begin(); //关闭自动提交
            if (!$result) {
                throw_exception("Db Error: " . $db->getErrorInfo());
            } else {
                self::$iftransacte = false;
            }
        }
    }

    /**
     * 提交事务
     */
    public static function commit()
    {
        if (!self::$iftransacte) {
            //手动提交事务时
            $db = self::getDb();
            $result = $db->commit();
            self::$iftransacte = true;
            if (!$result) throw_exception("Db Error: " . $db->getErrorInfo());
        }
    }

    /**
     * 回滚事务
     */
    public static function rollback()
    {
        if (!self::$iftransacte) {
            //手动提交事务时
            $db = self::getDb();
            $result = $db->rollback();
            self::$iftransacte = true;
            if (!$result) throw_exception("Db Error: " . $db->getErrorInfo());
        }
    }
}