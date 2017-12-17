<?php

namespace IceTea\View;

use IceTea\Hub\Singleton;
use IceTea\Support\View\PosibleFile;
use IceTea\Exceptions\ViewException;

class QuickMake
{
    use Singleton, PosibleFile;

    public static function make($name, $type)
    {
        switch ($type) {
            case 'layout':
                return self::probablility('layouts/'.$name);
                break;
            
            default:
                break;
        }
    }

    private static function probablility($name)
    {
        $ins = self::getInstance();
        if ($file = $ins->teaFile($name)) {
            return $file;
        } elseif ($file = $ins->bladeFile($name)) {
            return $file;
        } elseif ($file = $ins->phpNativeFile($name)) {
            return $file;
        }
        throw new ViewException("View [$name] not found");
    }
}
