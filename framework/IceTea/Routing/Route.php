<?php

namespace IceTea\Routing;

use IceTea\Routing\RouteCollector as Collector;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Route
{


    /**
     * Set method get route.
     *
     * @param string          $route
     * @param string|\Closure $action
     */
    public static function get($route, $action)
    {
        Collector::collect($route, $action, 'GET');

    }


    /**
     * Set method post route.
     *
     * @param string          $route
     * @param string|\Closure $action
     */
    public static function post($route, $action)
    {
        Collector::collect($route, $action, 'POST');

    }


    /**
     * Set method post route.
     *
     * @param string          $route
     * @param string|\Closure $action
     */
    public static function any($route, $action)
    {
        Collector::collect($route, $action, true);

    }
}
