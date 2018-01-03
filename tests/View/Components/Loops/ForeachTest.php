<?php

namespace Tests\View;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use PHPUnit\Framework\TestCase;


class ForeachTest extends TestCase
{

	private static function makeSkeleton($context)
	{
		return new ViewSkeleton($context, new ViewVariables([]), "testing");
	}

	private static function isolator($context, $class)
	{
		$skeleton = static::makeSkeleton($context);	

		$comp = new $class($skeleton);
        $comp->compile();

		return $comp->getSkeleton();
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
	}
}