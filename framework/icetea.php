<?php

define('ICETEA_VERSION', '0.0.1');

if (file_exists(__DIR__.'/../vendor/autoload.php')) {
    define('__COMPOSER_AUTOLOAD__', realpath(__DIR__.'/../vendor/autoload.php'));
    include __COMPOSER_AUTOLOAD__;
} else {

    function ___loadClass($class)
    {
        $ex = explode('\\', $class, 2);
        if ($ex[0] === 'App') {
            include __DIR__.'/../app/'.str_replace('\\', '/', $ex[1]).'.php';
        } else {
            include __DIR__.'/'.str_replace('\\', '/', $class).'.php';
        }

    }

    // Load helpers
    $scan = scandir(__DIR__.'/helpers');
    unset($scan[0], $scan[1]);
    foreach ($scan as $file) {
        include __DIR__.'/helpers/'.$file;
    }
    spl_autoload_register('___loadClass');
}



$app = new IceTea\IceTea();
$app->build();
