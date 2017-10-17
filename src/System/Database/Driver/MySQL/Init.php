<?php

namespace System\Database\Driver\MySQL;

use PDO;
use Config;

class Init
{
	public static function pdo($cfg)
	{
		return new PDO(
			"mysql:host=".$cfg['host'].";dbname=".$cfg['dbname'].";port=".$cfg['port'], 
			$cfg['user'], 
			$cfg['pass']
		);
	}
}