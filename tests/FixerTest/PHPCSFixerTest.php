<?php

namespace tests\FixerTest;

use PHPUnit\Framework\TestCase;

class PHPCSFixerTest extends TestCase
{
    public function testFirst()
    {
    	$a = shell_exec(BASEPATH."/src/sys.vendor/bin/fixer fix ".BASEPATH."/src");
    	$this->assertTrue(!empty($a));
    }
}
