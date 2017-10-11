<?php

require __DIR__."/sys.vendor/init.map";

/**
 * If running without composer.
 */
if (! file_exists(__DIR__."/../vendor/autoload.php")) {
    /**
     * Load config.
     */
    require __DIR__."/../config.php";
    /**
     * Load helpers.
     */
    require __DIR__."/sys.vendor/helpers/rstr.php";
    require __DIR__."/sys.vendor/helpers/system.php";
    require __DIR__."/sys.vendor/helpers/encryption.php";
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

__icetea_start();
