<?php

namespace IceTea\Routing;

use IceTea\Hub\Singleton;
use App\Providers\RouteServiceProvider;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class RouteCollector
{
    use Singleton;

    /**
     * Routes
     *
     * @var array
     */
    private $routes = [];

    /**
     * Route service provider.
     *
     * @var \App\Providers\RouteServiceProvider
     */
    private $providerInstance;


    public function __construct()
    {

    }//end __construct()


    /**
     * Collect route.
     *
     * @return void
     */
    public static function collect($route, $action, $method)
    {
        $ins = self::getInstance();
        $ins->routes[$route][$method] = $action;

    }//end collect()


    /**
     * Load routes.
     *
     * @return void
     */
    public static function loadRoutes()
    {
        $ins = self::getInstance();
        $app = new RouteServiceProvider();
        $app->boot();
        $app->map();
        $ins->providerInstance = $app;

    }//end loadRoutes()


    /**
     * Get routes.
     *
     * @return array
     */
    public static function getRoutes()
    {
        return self::getInstance()->routes;

    }//end getRoutes()


    /**
     * Get provider instance.
     *
     * @return \App\Providers\RouteServiceProvider
     */
    public static function getProviderInstance()
    {
        return self::getInstance()->providerInstance;

    }//end getProviderInstance()


    /**
     * Prevent garbage collector.
     */
    public static function destroy()
    {
        $ins = self::getInstance();
        unset($ins->providerInstance, $ins->routes);

    }//end destroy()


}//end class
