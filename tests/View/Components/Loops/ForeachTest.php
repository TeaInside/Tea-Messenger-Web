<?php

namespace Tests\View\Components\Loops\View;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use PHPUnit\Framework\TestCase;


class ForeachTest extends TestCase
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


	public function testForeachWithArrow()
	{

		$context = 
			'@foreach($iterable as $key => $value)'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'@endforeach';
		$result =
			'<?php foreach($iterable as $key => $value): ?>'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'<?php endforeach; ?>';


		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\Loops'), $result
		);
	}




	public function testForeachWithoutArrow()
	{

		$context = 
			'@foreach($iterable as $value)'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'@endforeach';
		$result =
			'<?php foreach($iterable as $value): ?>'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'<?php endforeach; ?>';

		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\Loops'), $result
		);
	}



	public function testComplexForeach()
	{

		$context = 
			'@foreach(\App\User::get() as $value)'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'@endforeach';
		$result =
			'<?php foreach(\App\User::get() as $value): ?>'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'<?php endforeach; ?>';

		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\Loops'), $result
		);

		$context = 
			'@foreach(((\App\User::get())) as $value)'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'@endforeach';
		$result =
			'<?php foreach(((\App\User::get())) as $value): ?>'."\n".
			'
				<table>
				<tr><td></td></tr>
				</table>
			'.
			'<?php endforeach; ?>';
		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\Loops'), $result
		);


		$context = 
			'@foreach(((\App\User::get())) as $value)'."\n".
				'@foreach($q as $w)'."\n".
					'hello world'."\n".
				'@endforeach'."\n".
			'@endforeach';
		$result =
			'<?php foreach(((\App\User::get())) as $value): ?>'."\n".
				'<?php foreach($q as $w): ?>'."\n".
					'hello world'."\n".
				'<?php endforeach; ?>'."\n".
			'<?php endforeach; ?>';
		$this->assertEquals(
			static::isolator($context, '\IceTea\View\Compilers\Components\Loops'), $result
		);
	}
}