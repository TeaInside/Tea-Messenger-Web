<?php

namespace Tests\View\Components\View\Loops;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use PHPUnit\Framework\TestCase;

class ForTest extends TestCase
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


    public function testSimpleFor()
    {

        $context =
            '@for($i=0 ; $i < 100; $i++)'."\n".
                '<tr><td>$i</td></tr>'."\n".
            '@endfor';
        $result =
            '<?php for($i=0 ; $i < 100; $i++): ?>'."\n".
                '<tr><td>$i</td></tr>'."\n".
            '<?php endfor; ?>';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );
    }

    public function testOneLineFor()
    {
        $context = '@for($i=0,$a=0,$b=0;$i<100;$i++)<tr><td>$i</td></tr>@endfor';
        $result = '<?php for($i=0,$a=0,$b=0;$i<100;$i++): ?><tr><td>$i</td></tr><?php endfor; ?>';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );

        $context = 'aaa @for($i=0,$a=0,$b=0;$i<100;$i++)<tr><td>$i</td></tr>@endfor bbb';
        $result = 'aaa <?php for($i=0,$a=0,$b=0;$i<100;$i++): ?><tr><td>$i</td></tr><?php endfor; ?> bbb';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );
    }

    public function testComplexFor()
    {

        $context =
            '@for($i=0,$a=0,$b=0;$i<100;$i++)'."\n".
                '<tr><td>$i</td></tr>'."\n".
            '@endfor';
        $result =
            '<?php for($i=0,$a=0,$b=0;$i<100;$i++): ?>'."\n".
                '<tr><td>$i</td></tr>'."\n".
            '<?php endfor; ?>';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );


        $context =
            '@for($i=0,$a=0,$b=0;$i<100;$i++)'."\n".
                '@for($j=0,$g=0,$h=0;$j<100;$j++)'."\n".
                    '@for($g=0;$g<strlen($q);$g++)'."\n".
                        '<tr><td>$i</td></tr>'."\n".
                    '@endfor'."\n".
                '@endfor'."\n".
            '@endfor';
        $result =
            '<?php for($i=0,$a=0,$b=0;$i<100;$i++): ?>'."\n".
                '<?php for($j=0,$g=0,$h=0;$j<100;$j++): ?>'."\n".
                    '<?php for($g=0;$g<strlen($q);$g++): ?>'."\n".
                        '<tr><td>$i</td></tr>'."\n".
                    '<?php endfor; ?>'."\n".
                '<?php endfor; ?>'."\n".
            '<?php endfor; ?>';

        $this->assertEquals(
            static::isolator($context, '\IceTea\View\Compilers\Components\Loops'),
            $result
        );
    }
}
