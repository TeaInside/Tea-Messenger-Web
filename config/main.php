<?php

return [
	"database" => [
		"driver" => env("DB_CONNECTION", "mysql"),
		"host"	 => env("DB_HOST", "localhost"),
		"user"	 => env("DB_USERNAME", "root"),
		"pass"	 => env("DB_PASSWORD", ""),
		"port"	 => env("DB_PORT", "3306"),
		"dbname" => env("DB_DATABASE", "")
	],
	"assets" => env("APP_URL"),
	"views_cache_dir" 	=> basepath("storage/framework/views"),
	"views_cache_map"	=> basepath("storage/framework/handler/view.map")
];