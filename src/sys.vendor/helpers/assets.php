<?php

function js($filename)
{
    return \Config::get("js_url")."/".trim($filename, "/").".js";
}

function css($filename)
{
    return \Config::get("css_url")."/".trim($filename, "/").".css";
}

function img($filename)
{
    return ASSETS_URL."/img/".trim($filename, "/").".png";
}
