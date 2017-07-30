<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/3
 * Time: 16:17
 */

namespace Ypk;

/**
 * hpf
 *
 * 自定义数据模型类
 *
 * 警告：该数据模型类必须在ypk\app\config\services.php中的$di->setShared('db', function () {})方法执行完之后才能使用
 *
 * Class Model
 * @package Ypk
 */
class Model
{
    protected $name = '';
    protected $table_prefix = '';
    protected $init_table = null;
    protected $table_name = '';
    protected $options = array();
    protected $pk = 'id';
    protected $db = null;
    protected $fields = array();
    protected $unoptions = true;    //是否清空参数项，默认清除

    public function __construct($table = null)
    {
        if (!is_null($table)) {
            $this->table_name = $table;
            $this->tableInfo($table);
        }
        $this->table_prefix = DBPRE;
        if (!is_object($this->db)) {
            $this->db = new ModelDb();
        }
    }

    /**
     * 删除表主键缓存
     */
    public static function dropTablePkArrayCache()
    {
        delete_file_cache('_pk', 'field/');
    }

    /**
     * 生成表结构信息
     *
     * @param string $table
     * @return bool|mixed
     */
    public function tableInfo($table)
    {
        if (empty($table)) return false;
        //只取主键,find(2)等自动匹配主键时使用
        if (file_exists(BASE_PATH . '/cache/fields/_pk')) {
            $this->fields = read_file_cache('_pk', false, null, 'fields/');
        } else {
            $_pk_array = self::fetchTablePkArray();
            write_file_cache('_pk', $_pk_array, null, 'fields/');
            $this->fields = $_pk_array;
        }

        return $this->fields[$table];
    }

    public static function fetchTablePkArray()
    {
        $full_table = Db::showTables();
        $_pk_array = array();
        $count = strlen(getConfig('tablepre'));
        foreach ($full_table as $v_table) {
            $v = array_values($v_table);
            if (substr($v[0], 0, $count) != getConfig('tablepre')) continue;
            $tb = preg_replace('/^' . getConfig('tablepre') . '/', '', $v[0]);
            $fields = Db::showColumns($tb);
            foreach ((array)$fields as $k => $v) {
                if ($v['primary']) {
                    $_pk_array[$tb] = $k;
                    break;
                }
            }
        }
        return $_pk_array;
    }

    public function __call($method, $args)
    {
        if (in_array(strtolower($method), array('table', 'order', 'where', 'on', 'limit', 'having', 'group', 'lock', 'master', 'distinct', 'index', 'attr', 'key'), true)) {
            $this->options[strtolower($method)] = $args[0];
            if (strtolower($method) == 'table') {
                if (strpos($args[0], ',') !== false) {
                    $args[0] = explode(',', $args[0]);
                    $this->table_name = '';
                    foreach ((array)$args[0] as $value) {
                        $this->tableInfo($value);
                    }
                } else {
                    $this->table_name = $args[0];
                    $this->fields = array();
                    $this->tableInfo($args[0]);
                }
            }
            return $this;
        } elseif (in_array(strtolower($method), array('page'), true)) {
            if ($args[0] == null) {
                return $this;
            } elseif (!is_numeric($args[0]) || $args[0] <= 0) {
                $args[0] = 10;
            }

            if (is_numeric($args[1]) && $args[1] > 0) {
                //page(15,200)形式，传入了每页显示数据和总记录数
                if ($args[0] > 0) {
                    $this->options[strtolower($method)] = $args[0];
                    pagecmd('setEachNum', $args[0]);
                    $this->unoptions = false;
                    pagecmd('setTotalNum', $args[1]);
                    return $this;
                } else {
                    $args[0] = 10;
                }
            }
            $this->options[strtolower($method)] = $args[0];
            pagecmd('setEachNum', $args[0]);
            $this->unoptions = false;
            pagecmd('setTotalNum', $this->get_field('COUNT(*) AS nc_count'));
            return $this;
        } elseif (in_array(strtolower($method), array('min', 'max', 'count', 'sum', 'avg'), true)) {
            $field = isset($args[0]) ? $args[0] : '*';
            return $this->get_field(strtoupper($method) . '(' . $field . ') AS nc_' . $method);
        } elseif (strtolower($method) == 'count1') {
            $field = isset($args[0]) ? $args[0] : '*';
            $options['field'] = ('count(' . $field . ') AS nc_count');
            $options = $this->parse_options($options);
            $options['limit'] = 1;
            $result = $this->db->select($options);
            if (!empty($result)) {
                return reset($result[0]);
            } else {
                //todo 这个返回值还不知道怎么改，用到时再改
                return 0;
            }
        } elseif (strtolower(substr($method, 0, 6)) == 'getby_') {
            $field = substr($method, 6);
            $where[$field] = $args[0];
            return $this->where($where)->find();
        } elseif (strtolower(substr($method, 0, 7)) == 'getfby_') {
            $name = substr($method, 7);
            $where[$name] = $args[0];
            //getfby_方法只返回第一个字段值
            if (strpos($args[1], ',') !== false) {
                $args[1] = substr($args[1], 0, strpos($args[1], ','));
            }
            return $this->where($where)->get_field($args[1]);
        } else {
            $error = 'Model Error:  Function ' . $method . ' is not exists!';
            throw_exception($error);
            return false;
        }
    }

    /**
     * 查询
     *
     * @param array|string|int $options
     * @return null/array
     */
    public function select($options = array())
    {
        if (is_string($options) || is_numeric($options)) {
            // 默认根据主键查询
            $pk = $this->get_pk();
            if (strpos($options, ',')) {
                $where[$pk] = array('IN', $options);
            } else {
                $where[$pk] = $this->fields[$this->table_name]['_pk_type'] == 'int' ? intval($options) : $options;
            }
            $options = array();
            $options['where'] = $where;
        }
        $options = $this->parse_options($options);
        if ($options['limit'] !== false) {
            if (empty($options['where']) && empty($options['limit'])) {
                //如果无条件，默认检索30条数据
                $options['limit'] = 30;
            } elseif ($options['where'] !== true && empty($options['limit'])) {
                //如果带WHERE，但无LIMIT，最多只检索1000条记录
                $options['limit'] = 1000;
            }
        }

        $resultSet = $this->db->select($options);

        if (empty($resultSet)) {
            return array();
        }
        if ($options['key'] != '' && is_array($resultSet)) {
            $tmp = array();
            foreach ($resultSet as $value) {
                $tmp[$value[$options['key']]] = $value;
            }
            $resultSet = $tmp;
        }
        return $resultSet;
    }

    /**
     * 取得第N列内容
     *
     * @param int $col
     * @return null/array
     */
    public function getfield($col = 1)
    {
        if (intval($col) <= 1) $col = 1;
        $options = $this->parse_options();
        if (empty($options['where']) && empty($options['limit'])) {
            //如果无条件，默认检索30条数据
            $options['limit'] = 30;
        } elseif ($options['where'] !== true && empty($options['limit'])) {
            //如果带WHERE，但无LIMIT，最多只检索1000条记录
            $options['limit'] = 1000;
        }

        $resultSet = $this->db->select($options);
        if (false === $resultSet) {
            return false;
        }
        if (empty($resultSet)) {
            return null;
        }
        $return = array();
        $cols = array_keys($resultSet[0]);
        foreach ((array)$resultSet as $k => $v) {
            $return[$k] = $v[$cols[intval($col) - 1]];
        }
        return $return;
    }

    protected function parse_options($options = array())
    {
        if (is_array($options)) $options = array_merge($this->options, $options);
        if (!isset($options['table'])) {
            $options['table'] = $this->getTableName();
        } elseif (false !== strpos(trim($options['table'], ', '), ',')) {
            $tmp = array();
            foreach (explode(',', trim($options['table'], ', ')) as $val) {
                $tmp[] = $this->getTableName($val) . ' AS `' . $val . '`';
            }
            $options['table'] = implode(',', $tmp);
        } else {
            $options['table'] = $this->getTableName($options['table']);
        }
        if ($this->unoptions === true) {
            $this->options = array();
        } else {
            $this->unoptions = true;
        }
        return $options;
    }

    public function get_field($field, $sepa = null)
    {
        $options['field'] = $field;
        $options = $this->parse_options($options);
        if (strpos($field, ',')) { // 多字段
            $resultSet = $this->db->select($options);
            if (!empty($resultSet)) {
                $_field = explode(',', $field);
                $field = array_keys($resultSet[0]);
                $move = $_field[0] == $_field[1] ? false : true;
                $key = array_shift($field);
                $key2 = array_shift($field);
                $cols = array();
                $count = count($_field);
                foreach ($resultSet as $result) {
                    $name = $result[$key];
                    if ($move) { // 删除键值记录
                        unset($result[$key]);
                    }
                    if (2 == $count) {
                        $cols[$name] = $result[$key2];
                    } else {
                        $cols[$name] = is_null($sepa) ? $result : implode($sepa, $result);
                    }
                }
                return $cols;
            }
        } else {
            $options['limit'] = 1;
            $result = $this->db->select($options);
            if (!empty($result)) {
                return reset($result[0]);
            }
        }
        return null;
    }

    /**
     * 返回一条记录
     *
     * @param string /int $options
     * @return null/array
     */
    public function find($options = null)
    {
        if (is_numeric($options) || is_string($options)) {
            $where[$this->get_pk()] = $options;
            $options = array();
            $options['where'] = $where;
        } elseif (!empty($options)) {
            return false;
        }
        $options['limit'] = 1;
        $options = $this->parse_options($options);
        $result = $this->db->select($options);
        if (empty($result)) {
            return array();
        }
        return $result[0];
    }

    /**
     * 删除
     *
     * @param array|string|int $options
     * @return bool/int
     */
    public function delete($options = array())
    {
        if (is_numeric($options) || is_string($options)) {
            // 根据主键删除记录
            $pk = $this->get_pk();
            if (strpos($options, ',')) {
                $where[$pk] = array('IN', $options);
            } else {
                $where[$pk] = $this->fields['_pk_type'] == 'int' ? intval($options) : $options;
            }
            $options = array();
            $options['where'] = $where;
        }
        $options = $this->parse_options($options);
        $result = $this->db->delete($options);
        if (false !== $result) {
            return true;
        }
        return $result;
    }

    /**
     * 更新
     *
     * @param array $data
     * @param array $options
     * @return boolean
     */
    public function update($data = array(), $options = array())
    {
        if (empty($data)) return false;
        // 分析表达式
        $options = $this->parse_options($options);
        if (!isset($options['where'])) {
            // 如果存在主键,自动作为更新条件
            if (isset($data[$this->get_pk()])) {
                $pk = $this->get_pk();
                $where[$pk] = $data[$pk];
                $options['where'] = $where;
                unset($data[$pk]);
            } else {
                return false;
            }
        }
        $result = $this->db->update($data, $options);
        if (false !== $result) {
            return true;
        }
        return $result;
    }

    /**
     * 插入
     *
     * @param array $data
     * @param bool $replace
     * @param array $options
     * @return mixed int/false
     */
    public function insert($data = array(), $replace = false, $options = array())
    {
        if (empty($data)) return false;
        $options = $this->parse_options($options);
        $result = $this->db->insert($data, $options, $replace);
        if (false !== $result) {
            $insertId = $this->getLastId();
            if ($insertId) {
                return $insertId;
            }
        }
        return $result;
    }

    /**
     * 批量插入
     *
     * @param array $dataList
     * @param array $options
     * @param bool $replace
     * @return boolean
     */
    public function insertAll($dataList, $options = array(), $replace = false)
    {
        if (empty($dataList)) return false;
        // 分析表达式
        $options = $this->parse_options($options);
        // 写入数据到数据库
        $result = $this->db->insertAll($dataList, $options, $replace);
        if (false !== $result) return true;
        return $result;
    }

    /**
     * 直接SQL查询,返回查询结果
     *
     * @param string $sql
     * @return array
     */
    public function query($sql)
    {
        return Db::getAll($sql);
    }

    /**
     * 执行SQL，用于 更新、写入、删除操作
     *
     * @param string $sql
     * @return bool
     */
    public function execute($sql)
    {
        return Db::execute($sql);
    }

    /**
     * 开始事务
     */
    public static function beginTransaction()
    {
        Db::beginTransaction();
    }

    /**
     * 提交事务
     */
    public static function commit()
    {
        Db::commit();
    }

    /**
     * 回滚事务
     */
    public static function rollback()
    {
        Db::rollback();
    }

    /**
     * 清空表
     *
     * @return boolean
     */
    public function clear()
    {
        if (!$this->table_name && !$this->options['table']) return false;
        $options = $this->parse_options();
        return $this->db->clear($options);
    }

    /**
     * 取得表名
     *
     * @param string $table
     * @return string
     */
    protected function getTableName($table = null)
    {
        if (is_null($table)) {
            $return = '`' . $this->table_prefix . $this->table_name . '`';
        } else {
            $return = '`' . $this->table_prefix . $table . '`';
        }
        return $return;
    }

    /**
     * 取得最后插入的ID
     *
     * @return int
     */
    public function getLastId()
    {
        return $this->db->getLastId();
    }

    /**
     * 指定查询字段 支持字段排除
     *
     * @param mixed $field
     * @param boolean $except
     * @return Model
     */
    public function field($field, $except = false)
    {
        if (true === $field) {// 获取全部字段
            $fields = $this->getFields();
            $field = $fields ? $fields : '*';
        } elseif ($except) {// 字段排除
            if (is_string($field)) {
                $field = explode(',', $field);
            }
            $fields = $this->getFields();
            $field = $fields ? array_diff($fields, $field) : $field;
        }
        $this->options['field'] = $field;
        return $this;
    }

    /**
     * 取得数据表字段信息
     *
     * @return mixed
     */
    public function getFields()
    {
        if ($this->fields) {
            $fields = $this->fields;
            unset($fields['_autoinc'], $fields['_pk'], $fields['_type']);
            return $fields;
        }
        return false;
    }

    /**
     * 组装join
     *
     * @param string $join
     * @return Model
     */
    public function join($join)
    {
        if (false !== strpos($join, ',')) {
            foreach (explode(',', $join) as $key => $val) {
                if (in_array(strtolower($val), array('left', 'inner', 'right'))) {
                    $this->options['join'][] = strtoupper($val) . ' JOIN';
                } else {
                    $this->options['join'][] = 'LEFT JOIN';
                }
            }
        } elseif (in_array(strtolower($join), array('left', 'inner', 'right'))) {
            $this->options['join'][] = strtoupper($join) . ' JOIN';
        }
        return $this;
    }

    /**
     * 取得主键
     *
     * @return string
     */
    public function get_pk()
    {
        return isset($this->fields[$this->table_name]) ? $this->fields[$this->table_name] : $this->pk;
    }

    /**
     * 检查非数据字段
     *
     * @param array $data
     * @return array
     */
    protected function chk_field($data)
    {
        if (!empty($this->fields[$this->table_name])) {
            foreach ($data as $key => $val) {
                if (!in_array($key, $this->fields[$this->table_name], true)) {
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }

    public function setInc($field, $step = 1)
    {
        return $this->set_field($field, array('exp', $field . '+' . $step));
    }

    public function setDec($field, $step = 1)
    {
        return $this->set_field($field, array('exp', $field . '-' . $step));
    }

    public function set_field($field, $value = '')
    {
        if (is_array($field)) {
            $data = $field;
        } else {
            $data[$field] = $value;
        }
        return $this->update($data);
    }

    /**
     * 显示分页链接
     *
     * @param int $style 分页风格
     * @return string
     */
    public function showpage($style = null)
    {
        return pagecmd('show', $style);
    }

    /**
     * 获取分页总数
     *
     * @return string
     */
    public function gettotalnum()
    {
        return pagecmd('gettotalnum');
    }

    public function shownowpage()
    {
        return pagecmd('getnowpage');
    }

    /**
     * 获取总页数
     *
     * @return string
     */
    public function gettotalpage()
    {
        return pagecmd('gettotalpage');
    }

    /**
     * 清空MODEL中的options、table_name属性
     *
     */
    public function cls()
    {
        $this->options = array();
        $this->table_name = '';
        return $this;
    }

    public function checkActive()
    {
        $this->db->checkActive();
    }

}
