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
		$salt = self::makeSalt();
		$key = $key.$salt;
		$l = strlen($str);
		$k = strlen($key);
		$j = 0;
		$r = "";
		for ($i=0; $i < $l; $i++) { 
			$r .= chr(
				ord($str[$i]) ^ ord($key[$j])
			);
			$j++;
			if ($j === $k) {
				$j = 0;
			}
		}
		return strrev(base64_encode($r.$salt));
	}

	/**
	 * @param string $str
	 * @param string $key
	 * @return string
	 */
	public static function decrypt($str, $key)
	{
		$key = (string) $key;
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