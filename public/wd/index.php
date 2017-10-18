<?php

if (file_exists(__DIR__."/../../vendor/autoload.php")) {
    include __DIR__."/../../vendor/autoload.php";
} else {
    include __DIR__."/../../src/autoload.php";
}

try {
    IceTea::run();
} catch (Exception $e) {
    http_response_code(500);
    print "<pre>";
    var_dump($e);
    print "<pre>";
} catch (Error $e) {
    http_response_code(500);
    print "<pre>";
    var_dump($e);
    print "<pre>";
}
