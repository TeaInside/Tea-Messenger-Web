<?php

namespace IceTea\Foundation\Providers;

class RouteServiceProvider
{

    protected $namespace = 'App\Http\Controllers';


    public function boot()
    {

    }


    public function getControllerNamespace()
    {
        return $this->namespace;

    }
}
