<?php

namespace App\Http;

use EsTeh\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
	protected $webMiddleware = [
		\App\Http\Middleware\VerifyCsrfToken::class
	];

	protected $apiMiddleware = [
		// "api_middleware"
	];

	protected $middlewareAliases = [	
	];
}
