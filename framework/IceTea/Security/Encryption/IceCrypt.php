<?php

namespace IceTea\Security\Encryption;

class IceCrypt
{
	/**
	 * @param string $str
	 * @param string $key
	 * @return string
	 */
	public static function encrypt($str, $key)
	{
		$key = (string) $key;
		
	}

	/**
	 * @param string $str
	 * @param string $key
	 * @return string
	 */
	public static function decrypt($str, $key)
	{

	}

	private static function makeSalt()
	{
		$r = "";
		for ($i=0; $i < 5; $i++) { 
			$r .= chr(rand(1, 255));
		}
		return $r;
	}
}
