<?php

namespace Tests\View\Components\View\Loops;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use PHPUnit\Framework\TestCase;

class WhileTest extends TestCase
{

    private static function makeSkeleton($context)
    {
        return new class ($context) {

        private $raw;

        public function __construct($context)
        {
            $this->raw = $context;
        }

        public function getRaw()
        {
            return $this->raw;
        }

        public function setRaw($context)
        {
            $this->raw = $context;
        }

        public function __toString()
        {
            return $this->getRaw();
        }
        };
    }

    private static function isolator($context, $class)
    {

        $skeleton = self::makeSkeleton($context);

        $comp = new $class($skeleton);
        $comp->compile();

        return $comp->getSkeleton()->__toString();
    }


    public function testSingle()
    {

        $context =
            '@while(true)'."\n".
            '
				<table>
				<tr><td></td></tr>
				</table>
			'.
            '@endwhile';
        $result =
            '<?php while(true): ?>'."\n".
            '
				<table>
				<tr><td></td></tr>
				</table>
			'.
            '<?php endwhile; ?>';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );
    }


    public function testOneLine()
    {
        $context = 'aaaa @while( ($q() + 100 === (3002 + $b())) ) 123 @endwhile';
        $result  = 'aaaa <?php while( ($q() + 100 === (3002 + $b())) ): ?> 123 <?php endwhile; ?>';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );
    }

    public function testComplexWhile()
    {

        $context =
            '@while(\App\User::pointerIsNotAtEnd() && $a && ($b || ($c && (($f-100) === 200)) && $d))'."\n".
            '
				<table>
				<tr><td></td></tr>
				</table>
			'.
            '@endwhile';
        $result =
            '<?php while(\App\User::pointerIsNotAtEnd() && $a && ($b || ($c && (($f-100) === 200)) && $d)): ?>'."\n".
            '
				<table>
				<tr><td></td></tr>
				</table>
			'.
            '<?php endwhile; ?>';
        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );

        $context =
            '@while(((func_x())))'."\n".
                '@while(((func_y())))'."\n".
                    'hello world'."\n".
                '@endwhile'."\n".
            '@endwhile';
        $result =
            '<?php while(((func_x()))): ?>'."\n".
                '<?php while(((func_y()))): ?>'."\n".
                    'hello world'."\n".
                '<?php endwhile; ?>'."\n".
            '<?php endwhile; ?>';
        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );
    }
}
