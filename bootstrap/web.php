<?php

define("BASEPATH", realpath(__DIR__."/.."), true);

$app = new EsTeh\Foundation\Application(
	[
		"base_path" => BASEPATH,
		"bootstrap_path" => __DIR__,
		"env_file" => BASEPATH."/.env.php",
		"config_path" => BASEPATH."/config",
		"public_path" => BASEPATH."/public",
		"resources_path" => BASEPATH."/resources",
		"storage_path" => BASEPATH."/storage"
	]
);

$app->init();

return $app;