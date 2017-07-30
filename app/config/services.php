<?php

use Phalcon\Mvc\Model\Metadata\Redis as MetaDataAdapter;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Config\Adapter\Ini;
use Phalcon\Crypt;


/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return new Ini(APP_PATH . "/config/config.ini");
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();
    $class = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    try {
        $connection = new $class([
            'host' => $config->database->host,
            'username' => $config->database->username,
            'password' => $config->database->password,
            'dbname' => $config->database->dbname,
            'charset' => $config->database->charset
        ]);
        return $connection;
    } catch (Exception $e) {
        \Ypk\Log::record($e->getMessage(), \Ypk\Log::ERR);
        exit(str_to_utf8($e->getMessage()));
    }
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    $config = $this->getConfig();
    return new MetaDataAdapter([
        'host' => $config->redis->host,
        'port' => $config->redis->port,
        'auth' => $config->redis->auth,
        'persistent' => $config->redis->persistent,
        'statsKey' => '_PHCM_MM',
        'lifetime' => 172800,
        'index' => 2,
    ]);
});

/**
 * Configure the Volt service for rendering .volt templates
 */
$di->setShared('voltShared', function ($view) {
    $config = $this->getConfig();

    $volt = new VoltEngine($view, $this);
    $volt->setOptions([
        'compiledPath' => function ($templatePath) use ($config) {

            // Makes the view path into a portable fragment
            $templatePath = str_replace('\\', '/', $templatePath);
            $templateFrag = str_replace($config->application->appDir, '', $templatePath);

            // Replace '/' with a safe '%%'
            $templateFrag = str_replace('/', '%%', $templateFrag);

            return $config->application->cacheDir . 'volt/' . $templateFrag . '.php';
        }
    ]);

    return $volt;
});

/**
 * 默认情况下，cookie会在返回给客户端前自动加密并且在接收到后自动解密
 * 使用cookie自动加密的话，必须在“crypt”服务中设置一个全局的key
 */
$di->setShared('crypt', function () {
    $crypt = new Crypt();

    $crypt->setKey(MD5_KEY); // 使用你自己的key！

    return $crypt;
});