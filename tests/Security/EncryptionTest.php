<?php

namespace Tests\Security;

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
		for ($l=0; $l < 5; $l++) { 
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
}