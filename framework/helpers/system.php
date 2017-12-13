<?php

if (! function_exists('env')) {


    function env($key, $def = null)
    {
        return \IceTea\Utils\EnvirontmentVariables::get($key, $def);

    }


}

if (! function_exists('view')) {


    function view($file, $variable = [])
    {
        return \IceTea\View\View::buildView($file, $variable);

    }


}

if (! function_exists('___viewIsolator')) {


    function ___viewIsolator($____file, $____variables = [])
    {
        foreach ($____variables as $____key => $____value) {
            $$____key = $____value;
        }

        return include $____file;

    }


}

if (! function_exists('basepath')) {


    function basepath($file = '')
    {
        return rtrim(realpath(__DIR__.'/../../').'/'.$file, '/');

    }


}

if (! function_exists('asset')) {


    function asset($assetsFile = '')
    {
        return trim(\IceTea\Utils\Config::get('assets').'/'.$assetsFile, '/');

    }


}

if (! function_exists('e')) {
    function e($str = "")
    {
        print $str = htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
        return $str;
    }
}