<?php

use Phalcon\Di\FactoryDefault\Cli as FactoryDefault;
use Phalcon\Cli\Console as ConsoleApp;

//error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE); //不提示警告信息

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

/**
 * The FactoryDefault Dependency Injector automatically registers the services that
 * provide a full stack framework. These default services can be overidden with custom ones.
 */
try {
    $di = new FactoryDefault();
} catch (\Exception $e) {
    $di = new FactoryDefault();
}

/**
 * Include general services
 */
include APP_PATH . '/config/services.php';

/**
 * Include cli environment specific services
 */
include APP_PATH . '/config/services_cli.php';

/**
 * Include Autoloader
 */
include APP_PATH . '/config/loader.php';

/**
 * Get config service for use in inline setup below
 */
$config = $di->getConfig();

/**
 * 加载全局配置信息
 */
require_once BASE_PATH . '/app/config/global_const.php';

/**
 * 加载数据库setting表自定义的配置参数
 */
$setting_config = read_file_cache('setting', true);
if (isset($config) && $config instanceof \Phalcon\Config\Adapter\Ini) {
    //如果系统配置文件存在，将系统配置文件与$setting_config合并
    $setting_config = array_merge_recursive($setting_config, $config->toArray());
}
if (isset($global_config) && is_array($global_config)) {
    //如果系统配置文件存在，将系统配置文件与$setting_config合并
    $setting_config = array_merge_recursive($setting_config, $global_config);
}

define('MD5_KEY', md5($setting_config['md5_key']));

if (function_exists('date_default_timezone_set')) {
    if (is_numeric($setting_config['time_zone'])) {
        @date_default_timezone_set('Asia/Shanghai');
    } else {
        @date_default_timezone_set($setting_config['time_zone']);
    }
}

/**
 * Create a console application
 */
$console = new ConsoleApp($di);

/**
 * Register console modules
 */
$console->registerModules([
    'cli' => ['className' => 'Ypk\Modules\Cli\Module']
]);

/**
 * Setup the arguments to use the 'cli' module
 */
$arguments = ['module' => 'cli'];

/**
 * Process the console arguments
 */
foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

try {

    /**
     * Handle
     */
    $console->handle($arguments);

    /**
     * If configs is set to true, then we print a new line at the end of each execution
     *
     * If we dont print a new line,
     * then the next command prompt will be placed directly on the left of the output
     * and it is less readable.
     *
     * You can disable this behaviour if the output of your application needs to don't have a new line at end
     */
    if (isset($config->application->printNewLine) && $config->application->printNewLine) {
        echo PHP_EOL;
    }

} catch (Exception $e) {
    //记录到错误日志
    \Ypk\Log::record('========== CLI ==========' . PHP_EOL . $e->getMessage() . PHP_EOL . $e->getTraceAsString());

    echo $e->getMessage() . PHP_EOL;
    echo $e->getTraceAsString() . PHP_EOL;
    exit(255);
}
