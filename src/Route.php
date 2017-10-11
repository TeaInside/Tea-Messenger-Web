<?php

use System\Router;
use System\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

final class Route
{
    use Singleton;

    /**
     * @param string            $route
     * @param string|Closure    $action
     * @param string            $method
     */
    public static function custom($route, $action, $method)
    {
        $ins->set_route($route, $action, $method);
    }

    /**
     * @param string            $route
     * @param string|Closure    $action
     */
    public static function postget($route, $action)
    {
        $ins = self::getInstance();
        $ins->set_route($route, $action, "GET");
        $ins->set_route($route, $action, "POST");
    }

    /**
     * @param string            $route
     * @param string|Closure    $action
     */
    public static function get($route, $action)
    {
        self::getInstance()->set_route($route, $action, "GET");
    }

    /**
     * @param string            $route
     * @param string|Closure    $action
     */
    public static function post($route, $action)
    {
        self::getInstance()->set_route($route, $action, "POST");
    }

    /**
     * @param string            $route
     * @param string|Closure    $action
     * @param string            $method
     */
    private function set_route($route, $action, $method = "GET")
    {
        Router::addRoute("/".ltrim($route, "/"), $action, $method);
    }
}
