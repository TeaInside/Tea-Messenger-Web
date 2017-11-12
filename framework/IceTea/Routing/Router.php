<?php

namespace IceTea\Routing;

use Closure;
use IceTea\Utils\Config;
use IceTea\Hub\Singleton;
use IceTea\Exceptions\Http\NotFoundHttpException;
use IceTea\Exceptions\Http\MethodNotAllowedException;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Router
{
    use Singleton;

    /**
     * @var array|string
     */
    private $uri;

    /**
     * @var bool
     */
    private $isEndPointWithFile = false;


    /**
     * Constructor.
     */
    public function __construct()
    {

    }//end __construct()


    /**
     * Fire.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->urlGenerator();
        foreach (RouteCollector::getInstance()->getRoutes() as $route => $val) {
            if ($this->isMatch($route)) {
                $reqMethod = $_SERVER['REQUEST_METHOD'];
                if (isset($val[$reqMethod]) or (isset($val[true]) and $reqMethod = true)) {
                    if ($val[$reqMethod] instanceof Closure) {
                        return $val[$reqMethod](RouteBinding::getBindedValue());
                    } else {
                        $a = explode('@', $val[$reqMethod], 2);
                        if (count($a) < 2) {
                            throw new \InvalidArgumentException('Invalid route', 1);
                        } else {
                            $provider   = RouteCollector::getProviderInstance();
                            $controller = $provider->getControllerNamespace().'\\'.$a[0];
                            if (class_exists($controller)) {
                                $controller = new $controller();
                                return $controller->{$a[1]}(
                                        RouteBinding::getBindedValue()
                                    );
                                var_dump(123);
                            } else {
                                throw new \Exception("Class {$controller} does not exist", 1);
                            }
                        }
                    }
                } else {
                    throw new MethodNotAllowedException('Method not allowed', 1);
                }//end if
            }//end if
        }//end foreach

        throw new NotFoundHttpException('Not found');

    }//end fire()


    private function urlGenerator()
    {
        $a         = explode($_SERVER['SCRIPT_NAME'], $_SERVER['PHP_SELF'], 2);
        $this->uri = empty($a[1]) ? ['', ''] : explode('/', $a[1]);

    }//end urlGenerator()


    private function isMatch($route)
    {
        do {
            $route = str_replace('//', '/', $route, $n);
        } while ($n);
        $route = explode('/', $route);
        if (count($route) === count($this->uri)) {
            foreach ($route as $key => $val) {
                if (substr($val, 0, 1) === '{' && substr($val, -1) === '}') {
                    RouteBinding::bind(substr($val, 1, -1), $this->uri[$key]);
                } else {
                    if ($val !== $this->uri[$key]) {
                        RouteBinding::destroy();
                        return false;
                    }
                }
            }
        } else {
            RouteBinding::destroy();
            return false;
        }

        return true;

    }//end isMatch()
}//end class
