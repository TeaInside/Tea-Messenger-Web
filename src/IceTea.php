<?php

use System\Router;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

final class IceTea
{
    public static function run()
    {
        foreach (Router::loadRoutes() as $key => $route) {
            if (Router::action($key, $route)) {
                break;
            }
        }
    }
}
