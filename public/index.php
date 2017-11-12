<?php

define("ICETEA_START", microtime(true));

require __DIR__."/../framework/icetea.php";
$app = require __DIR__."/../framework/init/web.php";
$app->terminate();
