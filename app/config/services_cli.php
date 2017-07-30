<?php

use Phalcon\Cli\Dispatcher;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
* Set the default namespace for dispatcher
*/
$di->setShared('dispatcher', function() {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('Ypk\Modules\Cli\Tasks');
    return $dispatcher;
});

$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});