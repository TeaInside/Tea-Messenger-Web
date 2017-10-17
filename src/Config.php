<?php

use System\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class Config
{
	use Singleton;

	/**
	 * @var array
	 */
	private $config = [];

	/**
	 * Constructor.
	 *
	 */
	private function __construct()
	{
		require __DIR__."/../config.php";
		$this->config = [
			"database" => [
				"driver"  => $db['driver'],
				"host" 	  => $db['host'],
				"dbname"  => $db['dbname'],
				"port"	  => $db['port'],
				"user"	  => $db['user'],
				"pass"	  => $db['pass']
			],
			"base_url" 	=> $url['base_url'],
			"js_url"   	=> $url['js_url'],
			"css_url"  	=> $url['css_url'],
			"environment" => $env,
			"app_key"     => _i($app['key']),
			"router_file" => $router_file
		];
	}

	/**
	 * Init config.
	 */
	public static function init()
	{
		self::getInstance();
	}

	/**
	 * @param string $key
	 * @param mixed  $value
	 * @return mixed
	 */
	public static function set($key, $value)
	{
		$ins = self::getInstance();
		$ins->config[$key] = $value;
		return $value;
	}

	/**
	 * @param string $key
	 * @param string $default
	 * @return mixed
	 */
	public static function get($key, $default = null)
	{
		$ins = self::getInstance();
		return isset($ins->config[$key]) ? $ins->config[$key] : $default;
	}
}