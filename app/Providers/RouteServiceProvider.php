<?php

namespace App\Providers;

use EsTeh\Routing\Router;
use EsTeh\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var string
     */
    protected $namespace = "App\\Http\\Controllers";

    public function boot()
    {
    }

    public function register()
    {
    	$this->webRoutesFile = base_path("routes/web.php");
        $this->apiRoutesFile = base_path("routes/api.php");
        $this->loadRoutes();
    }
}
