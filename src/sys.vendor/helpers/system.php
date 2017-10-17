<?php

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

function view($___view, $___var = null)
{
    if (is_array($___var)) {
        foreach ($___var as $___k => $___v) {
            $$___k = $___v;
        }
    }
    unset($___v, $___var, $___v);
    require BASEPATH."/app/Views/".$___view.".php";
}

function dd()
{
    foreach (func_get_args() as $val) {
        var_dump($val);
        print "\n\n";
    }
}

function _i(&$a)
{
    return $a;
}