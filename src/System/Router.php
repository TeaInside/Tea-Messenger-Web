<?php

namespace System;

use Closure;
use Exception;
use System\Hub\Singleton;
use System\Exceptions\Http\MethodNotAllowedException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Router
{
    use Singleton;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $routes = [];

    /**
     * @var bool
     */
    private $apiFlag = false;

    public function __construct()
    {
    }

    public static function apiFlag()
    {
        self::getInstance()->apiFlag = true;
    }

    /**
     * @param string         $key
     * @param string|Closure $action
     * @return bool
     */
    public static function action($key, $action)
    {
        $ins = self::getInstance();
        if ($key === $ins->uri) {
            if (isset($action[$_SERVER['REQUEST_METHOD']])) {
                return self::__run($action[$_SERVER['REQUEST_METHOD']]);
            } else {
                throw new MethodNotAllowedException("Method not allowed!", 402);
                return true;
            }
        } else {
            if (strpos($key, "{") !== false) {
                $a = explode("/", trim($key, "/")) xor $rr = [];
                $b = explode("/", trim($ins->uri, "/"));
                if (count($a) === count($b)) {
                    foreach ($a as $key => $val) {
                        $rr[$key] = (strpos($val, "{") !== false) ? "var" : "route";
                    }
                    $param = [];
                    foreach ($b as $key => $val) {
                        if ($rr[$key] === "route") {
                            if ($val !== $a[$key]) {
                                return false;
                            }
                        } else {
                            $param[str_replace(["{","}"], "", $a[$key])] = $val;
                        }
                    }
                    if (isset($action[$_SERVER['REQUEST_METHOD']])) {
                        if ($action[$_SERVER['REQUEST_METHOD']] instanceof Closure) {
                            $action[$_SERVER['REQUEST_METHOD']]($param);
                        } else {
                            $act = explode("@", $action[$_SERVER['REQUEST_METHOD']]);
                            $app = "\\App\\Controllers\\".$act[0];
                            if (file_exists(BASEPATH."/app/Controllers/".$act[0].".php") and class_exists($app)) {
                                $app = new $app;
                                if (is_callable([$app, $act[1]])) {
                                    $app->{$act[1]}($param);
                                } else {
                                    throw new Exception("Not callable method ".$act[1]);
                                }
                            } else {
                                throw new Exception("Controller \"".$app."\" not found!");
                            }
                        }
                        return true;
                    } else {
                        throw new MethodNotAllowedException("Method not allowed!", 402);
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param string|Closure $action
     * @param array          $param
     * @return bool
     */
    private static function __run($action, $param = [null])
    {
        if ($action instanceof Closure) {
            return $action();
        } else {
            $act = explode("@", $action);
            $app = "\\App\\Controllers\\".$act[0];
            if (file_exists(BASEPATH."/app/Controllers/".$act[0].".php") and class_exists($app)) {
                $app = new $app;
                if (is_callable([$app, $act[1]])) {
                    $app->{$act[1]}($param);
                } else {
                    throw new Exception("Not callable method ".$act[1]);
                }
            } else {
                throw new Exception("Controller \"".$app."\" not found!");
            }
        }
        return true;
    }

    /**
     * Load all routes.
     */
    public static function loadRoutes()
    {
        $ins = self::getInstance();
        $ins->getUri();
        return $ins->routes;
    }

    /**
     * @param string            $route
     * @param string|Closure    $action
     * @param string            $method
     */
    public static function addRoute($route, $action, $method)
    {
        self::getInstance()->__addRoute($route, $action, $method);
    }

    /**
     * @param string            $route
     * @param string|Closure    $action
     * @param string            $method
     */
    private function __addRoute($route, $action, $method)
    {
        $this->routes[$route][$method] = $action;
    }

    /**
     * Get uri segments.
     */
    private function getUri()
    {
        if (!ROUTER_FILE) {
            $a = explode($_SERVER['DOCUMENT_ROOT'], $_SERVER['SCRIPT_FILENAME']);
            $a = explode("/", end($a), -1);
            if (isset($a[1])) {
                $a = explode(end($a), $_SERVER['REQUEST_URI']) xor (isset($a[1]) and $a = $a[1] or $a = "/");
            } else {
                $a = $_SERVER['REQUEST_URI'];
            }
        } else {
            $a = explode($b = substr($_SERVER['SCRIPT_FILENAME'], strlen($_SERVER['DOCUMENT_ROOT'])), $_SERVER['REQUEST_URI']);
            $a = implode("/", $a);
        }
        do {
            $a = str_replace("//", "/", $a, $n);
        } while ($n);
        $this->uri = "/".trim($a, "/");
    }
}
