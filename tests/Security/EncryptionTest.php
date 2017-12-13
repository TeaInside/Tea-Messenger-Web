<?php

namespace tests\Security;

use PHPUnit\Framework\TestCase;
use IceTea\Security\Encryption\IceCrypt;

class EncryptionTest extends TestCase
{
	public function testConstantString()
	{
		$string = "Hello World";
		for ($i=0; $i < 200; $i++) { 
			// generate random key
			$key = rstr(32);

			$encrypted = IceCrypt::encrypt($string, $key);
			$this->assertEquals(
				IceCrypt::decrypt($encrypted, $key),
				$string
			);
		}
	}

	public function testRandomString()
	{
		$r = "";
		for ($i=1; $i < 255; $i++) { 
			$r .= chr($i);
		}
		// generate random string
		$string = rstr(32, $r);

		for ($i=0; $i < 200; $i++) { 
			// generate random key
			$key = rstr(32, $r);

			$encrypted = IceCrypt::encrypt($string, $key);
			$this->assertEquals(
				IceCrypt::decrypt($encrypted, $key),
				$string
			);
		}
	}
}