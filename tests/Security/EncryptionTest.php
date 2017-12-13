<?php

namespace Tests\Security;

use PHPUnit\Framework\TestCase;
use IceTea\Security\Encryption\IceCrypt;

class EncryptionTest extends TestCase
{
	private $r;

	public function setup()
	{
		$this->r = "";
		for ($i=1; $i < 255; $i++) { 
			$this->r .= chr($i);
		}
	}

	public function testConstantString()
	{
		$string = "Hello World";
		for ($i=0; $i < 200; $i++) { 
			// generate random key
			$key = rstr(32, $this->r);

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
			// generate random string
			$string = rstr(32, $this->r);

			for ($i=0; $i < 200; $i++) { 
				// generate random key
				$key = rstr(32, $this->r);

				$encrypted = IceCrypt::encrypt($string, $key);
				$this->assertEquals(
					IceCrypt::decrypt($encrypted, $key),
					$string
				);
			}
		}
	}

	public function testRandomAbsolute()
	{
		for ($i=0; $i < 100; $i++) { 
			$string = rstr(rand(1, 100), $this->r);
			$key    = rstr(rand(1, 100), $this->r);

			$encrypted = IceCrypt::encrypt($string, $key);
			$this->assertEquals(
				IceCrypt::decrypt($encrypted, $key),
				$string
			);
		}
	}
}