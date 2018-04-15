<?php

return [

	/**
	 * @link https://secure.php.net/manual/en/function.setcookie.php
	 */ 
	"cookie_name" => "esteh_session",
	"cookie_path" => "/",
	"cookie_domain" => "", // left empty for dynamic site
	"cookie_secure" => false, // https cookie
	"cookie_http_only" => false,
	
	"expired"   => 3600 * 24 * 14, // 14 days
	"session_storage" => storage_path("framework/sessions"),
];