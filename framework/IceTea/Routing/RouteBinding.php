<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class RouteBinding
{
    use Singleton;

    /**
     * @var array
     */
    private $binded = [];


    public function __construct()
    {

    }


    /**
     * @param string $key
     * @param string $val
     */
    public static function bind($key, $val)
    {
        $ins               = self::getInstance();
        $ins->binded[$key] = $val;

    }


    /**
     * @return \IceTea\Routing\BindedValue
     */
    public static function getBindedValue()
    {
        return new BindedValue(self::getInstance()->binded);

    }


    /**
     * Destroy binded data.
     */
    public static function destroy()
    {
        $ins         = self::getInstance();
        $ins->binded = [];

    }
}
