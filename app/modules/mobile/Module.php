<?php

namespace Ypk\Modules\Mobile;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Php as PhpEngine;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Config;

define('MODULE_PATH', __DIR__);
define('MODULE_RESOURCE', '/mobile_resource');
define('MODULE_LANGUAGE_PATH', MODULE_PATH . '/language');

//读取核心语言文件
getTranslation('core_lang_index');

define('APP_ID', 'mobile');
define('IGNORE_EXCEPTION', true);

if (!is_null($_GET['key']) && !is_string($_GET['key'])) {
    $_GET['key'] = null;
}
if (!is_null($_POST['key']) && !is_string($_POST['key'])) {
    $_POST['key'] = null;
}
if (!is_null($_REQUEST['key']) && !is_string($_REQUEST['key'])) {
    $_REQUEST['key'] = null;
}

/**
 * 加载自定义的mobile公共方法
 */
require_once MODULE_PATH . '/common/Function.php';

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers an autoloader related to the module
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces([
            'Ypk\Modules\Mobile\Controllers' => __DIR__ . '/controllers/',
            'Ypk\Modules\Mobile\Models' => __DIR__ . '/models/'
        ]);

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        /**
         * Try to load local configuration
         */
        if (file_exists(__DIR__ . '/config/config.ini')) {
            $override = new Ini(__DIR__ . '/config/config.ini');
            if (count($override) > 0) {
                $config = $di->getConfig();
                if ($config instanceof Config) {
                    $config->merge($override);
                } else {
                    $config = $override;
                }
            }
        }

        /**
         * Setting up the view component
         */
        $di['view'] = function () {
            $config = $this->getConfig();

            $view = new View();
            $view->setDI($this);
            $view->setViewsDir($config->get('application')->viewsDir);

            $view->registerEngines([
                '.volt' => 'voltShared',
                '.phtml' => PhpEngine::class
            ]);

            return $view;
        };
    }
}
