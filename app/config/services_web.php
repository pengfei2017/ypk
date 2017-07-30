<?php

use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Flash\Direct as Flash;

/**
 * Registering a router
 */
$di->setShared('router', function () {
    $router = new Router();

    $router->setDefaultModule('shop');
    $router->setDefaultNamespace('Ypk\Modules\Shop\Controllers');

    return $router;
});

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di->setShared('url', function () {
    $config = $this->getConfig();

    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);

    return $url;
});

/**
 * Starts the session the first time some component requests the session service
 *
 * 这里千万要注意，在phalcon里以来注入的服务都是在第一次使用的时候才能实例化
 * 看如下代码
 *  $di->setShared('session', function () {
 *      $session = new SessionAdapter();
 *      $session->start();
 *      return $session;
 *  });
 * 在phalcon里注册了session服务，但是只有到首次使用session的时候才会执行setShared的第二个参数（回调函数）
 * 一次也没有使用之前是没有实例化new SessionAdapter()的，并且也没有开启$session->start()，所以一次也没有使用
 * 在phalcon里注册的session服务之前，session未开启，用$_SESSION['member_id']的方式是拿不到任何session的
 * 总结：最保险的办法是用getSession('member_id')的方法取session，在getSession函数里会首次调用di的session服务
 * ，从而开启了session
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});

/**
 * Register the session flash service with the Twitter Bootstrap classes
 */
$di->set('flash', function () {
    return new Flash([
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
        'warning' => 'alert alert-warning'
    ]);
});

/**
 * Set the default namespace for dispatcher
 */
$di->setShared('dispatcher', function () {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('Ypk\Modules\Shop\Controllers');
    return $dispatcher;
});
