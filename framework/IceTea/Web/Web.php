<?php

namespace IceTea\Web;

use Exception;
use IceTea\View\View;
use IceTea\Routing\Router;
use IceTea\View\ViewFoundation;
use IceTea\Routing\RouteBinding;
use IceTea\Routing\RouteCollector;
use IceTea\Exceptions\AbsoluteException;
use IceTea\Exceptions\Http\NotFoundException;
use IceTea\Foundation\Http\NotFoundFoundation;
use App\Exceptions\Handler as ExceptionHandler;
use IceTea\Foundation\Exceptions\Handler\HttpExceptionHandler;

final class Web
{


    public function __construct()
    {

    }//end __construct()


    public function routeHandle()
    {
        RouteCollector::loadRoutes();
        $route = new Router();
        try {
            $action = $route->fire();
        } catch (Exception $e) {
            $action = new ExceptionHandler($e);
        }

        RouteBinding::destroy();
        if ($action instanceof ViewFoundation) {
            View::make($action);
        } else if ($action instanceof ExceptionHandler) {
            $action->report();
        }

        RouteCollector::destroy();

    }//end routeHandle()


    public function terminate()
    {

    }//end terminate()


}//end class
