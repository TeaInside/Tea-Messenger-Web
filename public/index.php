<?php
ini_set('display_errors', true);

define("MYICETEA_START", microtime(true));

require __DIR__."/../vendor/autoload.php";
$app = require __DIR__."/../bootstrap/web.php";

$app->capture();

$app->sendResponse();

$app->terminate();