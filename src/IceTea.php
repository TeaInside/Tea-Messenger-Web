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
            if ($not_found = Router::action($key, $route)) {
                break;
            }
        }
        if (! $not_found) {
            http_response_code(404);
            return view("errors/404");
        }
    }
}
