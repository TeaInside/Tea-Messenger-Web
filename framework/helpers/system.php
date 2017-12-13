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

if (! function_exists('pc')) {
    function pc($exe, $st)
    {
        if (! $exe) {
            throw new \Exception(get_class($st).": ".json_encode($st->errorInfo()), 1);
        }
    }
}

if (! function_exists('abort')) {
    function abort($httpCode)
    {
        \IceTea\View\View::make(view('errors/'.$httpCode));
        exit($httpCode);
    }
}

if (! function_exists('rstr')) {
    function rstr($n = 32, $l = null)
    {
        $q = "";
        $l = is_string($l) ? $l : "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
        $len = strlen($l) - 1;
        for ($i=0; $i < $n; $i++) { 
            $q .= $l[rand(0, $len)];
        }
        return $q;
    }
}

if (! function_exists('ice_encrypt')) {
    function ice_encrypt($str, $key)
    {
        return \IceTea\Security\Encryption\IceCrypt::encrypt($str, $key);
    }
}

if (! function_exists('ice_decrypt')) {
    function ice_decrypt($str, $key)
    {
        return \IceTea\Security\Encryption\IceCrypt::decrypt($str, $key);
    }
}