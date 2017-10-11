<?php

/*if (file_exists(__DIR__."/../vendor/autoload.php")) {
	require __DIR__."/../vendor/autoload.php";
} else {
	require __DIR__."/../src/autoload.php";
}
*/

require __DIR__."/../src/autoload.php";

try {
    IceTea::run();
} catch (\Exception $e) {
    ___icetea_error_handler(
        E_USER_ERROR,
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        []
    );
} catch (\Error $e) {
    ___icetea_error_handler(
        E_USER_ERROR,
        $e->getMessage(),
        $e->getFile(),
        $e->getLine(),
        []
    );
}
