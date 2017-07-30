<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'Ypk\Models' => APP_PATH . '/common/models/',
    'Ypk\Logic' => APP_PATH . '/common/logic/',
    'Ypk\MyModels' => APP_PATH . '/common/my_models/',
    'Ypk\MyLogic' => APP_PATH . '/common/my_logic/',
    'Ypk' => APP_PATH . '/common/library/',
    'Ypk\Modules\Admin\Controllers' => APP_PATH . '/modules/admin/controllers/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'Ypk\Modules\Admin\Module' => APP_PATH . '/modules/admin/Module.php',
    'Ypk\Modules\Chat\Module' => APP_PATH . '/modules/chat/Module.php',
    'Ypk\Modules\SystemManager\Module' => APP_PATH . '/modules/system_manager/Module.php',
    'Ypk\Modules\ShopManager\Module' => APP_PATH . '/modules/shop_manager/Module.php',
    'Ypk\Modules\MobileManager\Module' => APP_PATH . '/modules/mobile_manager/Module.php',
    'Ypk\Modules\Shop\Module' => APP_PATH . '/modules/shop/Module.php',
    'Ypk\Modules\Mobile\Module' => APP_PATH . '/modules/mobile/Module.php',
    'Ypk\Modules\Cli\Module' => APP_PATH . '/modules/cli/Module.php',
    'Ypk\Modules\Member\Module' => APP_PATH . '/modules/member/Module.php'

]);

$loader->register();
