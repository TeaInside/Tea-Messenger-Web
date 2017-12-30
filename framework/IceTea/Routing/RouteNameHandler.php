<?php

namespace IceTea\Routing;

use ArrayAccess;
use IceTea\Hub\Singleton;
use IceTea\Exceptions\UrlGenerationException;

class RouteNameHandler implements ArrayAccess
{
    use Singleton;
    
    private $container = [];
    
    private $latestRoute;
    
    public function __construct()
    {
    }
    
    public static function getRoute($routeName, ...$bindVal)
    {
        $ins = self::getInstance();
        $a = explode("/", $ins[$routeName]);
        $i = 0;
        $binder = (isset($bindVal[0]) && is_array($bindVal[0])) ? $bindVal[0] : $bindVal;
        foreach ($a as &$bc) {
            if (substr($bc, 0, 1) === "{" && substr($bc, -1) === "}") {
                if (! array_key_exists($i, $binder)) {
                    throw new UrlGenerationException(
                        "Missing required parameters for [Route: {$routeName}] [URI: {$ins[$routeName]}]"
                    );
                } else {
                    $bc = (string) $binder[$i];
                    $i++;
                }
            }
        }
        unset($bc);
        return implode("/", $a);
    }
    
    public static function SaveName($route)
    {
        $ins = self::getInstance();
        $ins->latestRoute = $route;
        return $ins;
    }
    
    public function name($name)
    {
        $this->container[$name] = $this->latestRoute;
    }
    
    public function offsetGet($offset)
    {
        if (isset($this->container[$offset])) {
            return $this->container[$offset];
        } else {
            throw new \Exception("Route [{$offset}] doesn't exists");
        }
    }
    
    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }
    
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }
    
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}
