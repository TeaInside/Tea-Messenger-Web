<?php

return [
    /**
     * Application name
     */
    "name" => env("APP_NAME", "IceTea"),
    
    /**
     * Application environtment
     *
     * development|production
     */
    "env" => env("APP_ENV", "production"),
    
    /**
     * Debug.
     */
    "debug" => env("APP_DEBUG", false),
    
    /**
     * Application URL.
     */
    "url" => env("APP_URL", "http://localhost:8000"),
    
    /**
     * Timezone.
     */
    "timezone" => "UTC",
    
    /**
     * App locale.
     */
    "locale" => "en",
    
    /**
     * App key.
     */
    "key" => env("APP_KEY"),

    /**
     * Views path.
     */
    "views_path" => base_path("resources/views"),

    /**
     * Service provider.
     */
    "providers" => [
        App\Providers\RouteServiceProvider::class
    ],

    /**
     * Class aliases.
     */
    "aliases" => [
        "App" => EsTeh\Foundation\Application::class,
        "Route" => EsTeh\Routing\Route::class,
        "DB" => EsTeh\Database\DB::class,
        "Config" => EsTeh\Support\Config::class,
        "Request" => EsTeh\Http\Request::class,
        "Session" => EsTeh\Session\SessionHandler::class,

        /**
         * Singleton trait.
         */
        "Singleton" => EsTeh\Hub\Singleton::class,
    ],
];
