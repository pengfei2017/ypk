<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/12/3
 * Time: 17:14
 */

namespace Ypk;

use Phalcon\Logger\Adapter\File as FileAdapter;

/**
 * 记录日志类
 * 记录日志到文件
 *
 * Class Log
 * @package Ypk
 */
class Log
{
    const SQL = 'SQL'; //sql语句
    const ERR = 'ERR'; //错误消息

    //保存日志处理类实例的静态成员变量
    private static $_logger;

    private static $log = array();

    public static function record($message, $level = self::ERR)
    {
        $now = @date('Y-m-d H:i:s', time());
        switch ($level) {
            case self::SQL:
                self::$log[] = "[{$now}] {$level}: {$message}\r\n";
                break;
            case self::ERR:
                // 生成日志新组件实例
                $logger = self::getLogger();

                // 开启事务
                $logger->begin();

                $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'];
                $url_arr = getUrlParamArray();
                $module_name = $url_arr['module'];
                $module_name_arr = explode('_', $url_arr['module']);
                foreach ($module_name_arr as $k => $module_name_v) {
                    if ($k == 0) {
                        $module_name = $module_name_v;
                    } else {
                        $module_name = ucfirst($module_name_v);
                    }
                }
                $controller_name = $url_arr['controller'];
                $controller_name_arr = explode('_', $url_arr['controller']);
                foreach ($controller_name_arr as $k => $controller_name_v) {
                    if ($k == 0) {
                        $controller_name = $controller_name_v;
                    } else {
                        $controller_name = ucfirst($controller_name_v);
                    }
                }
                $action_name = $url_arr['action'];
                $url .= " ( " . MODULES_PATH . "/{$module_name}/controllers/{$controller_name}Controller/{$action_name}Action ) ";
                $content = "[{$now}] {$url}\r\n{$level}: {$message}\r\n";

                // 添加消息
                $logger->error(str_to_utf8($content));

                // 保存消息到文件中
                $logger->commit();
                break;
        }
    }

    public static function read()
    {
        return self::$log;
    }

    public static function getLogger()
    {
        if (!(self::$_logger instanceof FileAdapter)) {
            $log_file = BASE_PATH . '/log/' . date('Ymd', TIMESTAMP) . '.log';
            if (!file_exists($log_file)) {
                if (!file_exists(dirname($log_file))) {
                    mkDirs(dirname($log_file));
                }
                $res = fopen($log_file, 'w');
                fclose($res);
            }
            self::$_logger = new FileAdapter($log_file);

        }

        return self::$_logger;
    }
}