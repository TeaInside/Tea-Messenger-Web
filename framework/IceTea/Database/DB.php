<?php

namespace IceTea\Database;

use IceTea\Utils\Config;
use IceTea\Hub\Singleton;

class DB
{
	use Singleton;

	/**
	 * @var \PDO
	 */
	protected $pdo;

	/**
	 * Constructor.
	 *
	 */
	public function __construct()
	{
		$config = Config::get('database');
		$this->pdo = new PDO(
			$config['driver'].":host=".$config['host'].";dbname=".$config['dbname'].";port=".$config['port'],
			$config['user'],
			$config['pass']
		);
	}

	/**
	 * @param string $method
	 * @param array  $parameters
	 */
	public static function __callStatic($method, $parameters)
	{
		return self::getInstance()->pdo->{$method}(...$parameters);
	}
}
