<?php

function __icetea_start()
{
    defined("BASEPATH") or trigger_error("Konstanta BASEPATH belum terdefinisi!");
    include BASEPATH."/app/Routes/web.php";
    System\Router::apiFlag();
    include BASEPATH."/app/Routes/api.php";
}
