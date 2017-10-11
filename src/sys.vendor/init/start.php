<?php

function __icetea_start()
{
    defined("BASEPATH") or trigger_error("Konstanta BASEPATH belum terdefinisi!");
    require BASEPATH."/app/Routes/web.php";
    System\Router::apiFlag();
    require BASEPATH."/app/Routes/api.php";
}
