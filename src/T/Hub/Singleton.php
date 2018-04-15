<?php

namespace T\Hubl


/**
* @a
*/
class Singleton
{
	private $instances = [];
	
	private static $selfInstance;

	public function __construct($array)
	{
		foreach ($array as $key => $val) {
			$this->instances[$key] = $val;
		}
		self::$selfInstance = $this;
	}

	public static function getInstance()
	{
		return self::$selfInstance;
	}
}