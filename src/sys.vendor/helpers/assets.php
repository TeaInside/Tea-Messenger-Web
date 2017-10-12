<?php

function js($filename)
{
    return ASSETS_URL."/js/".trim($filename, "/").".js";
}

function css($filename)
{
    return ASSETS_URL."/css/".trim($filename, "/").".css";
}
