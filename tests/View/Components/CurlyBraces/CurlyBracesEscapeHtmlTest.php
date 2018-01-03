<?php

namespace Tests\View\Components\CurlyBraces;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use PHPUnit\Framework\TestCase;


class CurlyBracesEscapeHtmlTest extends TestCase
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


	public function testSimple()
	{

		$context = '{{ $a }}';
		$result = '<?php echo e( $a ); ?>';

		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\CurlyInvoker'), $result
		);

		$context = '{{sin(30)}}';
		$result = '<?php echo e(sin(30)); ?>';

		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\CurlyInvoker'), $result
		);
	}

	public function testComplex()
	{
		$context = '<a href="{{$a}}">Home</a><a href="{{$b}}">Profile</a><a href="{{route(\'logout\')}}">Profile</a>';
		$result = '<a href="<?php echo e($a); ?>">Home</a><a href="<?php echo e($b); ?>">Profile</a><a href="<?php echo e(route(\'logout\')); ?>">Profile</a>';

		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\CurlyInvoker'), $result
		);

		$context = '{{ $a === 10 ? "Ten" : "Unknown" }}';
		$result = '<?php echo e( $a === 10 ? "Ten" : "Unknown" ); ?>';

		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\CurlyInvoker'), $result
		);

		$context = '{{ (($a === 10 ? "Ten" : ($a === 9 ? "Nine" : ($a === 8 ? "Eight" : "Unknown")))) }}';
		$result = '<?php echo e( (($a === 10 ? "Ten" : ($a === 9 ? "Nine" : ($a === 8 ? "Eight" : "Unknown")))) ); ?>';
		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\CurlyInvoker'), $result
		);
	}
}