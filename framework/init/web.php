<?php

require __DIR__.'/error_handler/web.php';

$app = new IceTea\Web\Web();
$app->routeHandle();

return $app;
