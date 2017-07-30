<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;



//error_reporting(E_ALL);
error_reporting(E_ALL & ~E_NOTICE); //不提示警告信息

//如果二级域名需要共享session，需要开启下面几个session有关的配置
/*ini_set('session.cookie_path', '/');
ini_set('session.cookie_domain', '.developer.site'); //注意domain.com换成你自己的域名
ini_set('session.cookie_lifetime', '1800');
@ini_set('session.name', 'PHPSESSID'); //session.name强制定制成PHPSESSID,不请允许更改 */

define('BASE_PATH', str_replace('\\', '/', dirname(__DIR__)));
define('APP_PATH', BASE_PATH . '/app');
define('MODULES_PATH', APP_PATH . '/modules');
define('BASE_API_PATH', BASE_PATH . '/api');
define('BASE_DATA_PATH', BASE_PATH . '/data');
define('BASE_CACHE_PATH', BASE_PATH . '/cache');
define('CHAT_RESOURCE_URL', '/chat_resource');

/************************************************************************/
/**
 *  注册管理员管理模块
 */
//后台管理要启用的管理模块，不启用的管理模块将下面数组中对应的模块路径删掉即可关闭对应模块
$admin_module_menus = array('modules/system_manager', 'modules/shop_manager', 'modules/mobile_manager');

/************************************************************************/

try {

    /**
     * The FactoryDefault Dependency Injector automatically registers the services that
     * provide a full stack framework. These default services can be overidden with custom ones.
     */
    $di = new FactoryDefault();

    /**
     * Include general services
     */
    require APP_PATH . '/config/services.php';

    /**
     * Include web environment specific services
     */
    require APP_PATH . '/config/services_web.php';

    /**
     * Get config service for use in inline setup below
     */
    $config = $di->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    /**
     * 加载全局配置信息
     */
    require_once BASE_PATH . '/app/config/global_const.php';

    /**
     * 调用一次getSession(),首次实例化$di中的session共享服务，开启全局SESSION，相当于session_start()函数的作用
     */
    getSession();

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
     * Handle the request
     */
    $application = new Application($di);

    /**
     * Register application modules
     */
    $application->registerModules([
        'admin' => ['className' => 'Ypk\Modules\Admin\Module'],
        'chat' => ['className' => 'Ypk\Modules\Chat\Module'],
        'system_manager' => ['className' => 'Ypk\Modules\SystemManager\Module'],
        'shop_manager' => ['className' => 'Ypk\Modules\ShopManager\Module'],
        'mobile_manager' => ['className' => 'Ypk\Modules\MobileManager\Module'],
        'shop' => ['className' => 'Ypk\Modules\Shop\Module'],
        'mobile' => ['className' => 'Ypk\Modules\Mobile\Module'],
        'member' => ['className' => 'Ypk\Modules\Member\Module'],
    ]);

    /**
     * Include routes
     */
    require APP_PATH . '/config/routes.php';

    //获取每个页面点击次数
    // $opcache_status = opcache_get_status();

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    //记录到错误日志
    \Ypk\Log::record('========== WEB ==========' . PHP_EOL . $e->getMessage() . PHP_EOL . $e->getTraceAsString());
    //给浏览器客户端返回异常消息
    echo $e->getMessage();
}
