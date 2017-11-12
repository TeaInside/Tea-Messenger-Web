<?php

function __icetea_start()
{
    defined("BASEPATH") or trigger_error("Konstanta BASEPATH belum terdefinisi!");
    include BASEPATH."/app/Routes/web.php";
    System\Router::apiFlag();
    include BASEPATH."/app/Routes/api.php";
    if (is_dir(BASEPATH."/storage/init")) {
        $scan = scandir(BASEPATH."/storage/init");
        unset($scan[0], $scan[1]);
        foreach ($scan as $val) {
            include BASEPATH."/storage/init/".$val;
        }
    }
}
