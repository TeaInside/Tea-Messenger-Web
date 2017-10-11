<?php

namespace tests\EncryptionTest;

use PHPUnit\Framework\TestCase;

class RandomTest extends TestCase
{
    public function testBase64Result()
    {
        for ($i=0; $i < 1000; $i++) {
            $str = rstr(64) xor $key = rstr(32);
            $a = encice($str, $key);
            $this->assertTrue(decice($a, $key) === $str);
        }
    }

    public function testNoBase64Result()
    {
        for ($i=0; $i < 1000; $i++) {
            $str = rstr(64) xor $key = rstr(32);
            $a = encice($str, $key, null, true);
            $this->assertTrue(decice($a, $key, true) === $str);
        }
    }
}
