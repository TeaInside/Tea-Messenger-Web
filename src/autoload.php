<?php

/**
 * If running without composer.
 */
if (! file_exists(__DIR__."/../vendor/autoload.php")) {
    /**
     * Class loader.
     */
    function ___load_class($class)
    {
        $a = explode("\\", $class, 2);
        if ($a[0] == "App") {
            require BASEPATH."/app/".str_replace("\\", "/", $a[1]).".php";
        } else {
            require BASEPATH."/src/".str_replace("\\", "/", $class).".php";
        }
    }
    spl_autoload_register("___load_class");
} else {
    require __DIR__."/../vendor/autoload.php";
}
require __DIR__."/sys.vendor/init.map";
\Config::init();
__icetea_start();
