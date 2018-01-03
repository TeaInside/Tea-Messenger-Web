<?php

namespace Tests\View;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use PHPUnit\Framework\TestCase;


class IfTest extends TestCase
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
		};
	}

	private static function isolator($context, $class)
	{

		$skeleton = self::makeSkeleton($context);

		$comp = new $class($skeleton);
        $comp->compile();

		return $comp->getSkeleton();
	}



	public function testSimpleIf()
	{
		$context = 
			'@if(true)'."\n".
				'<table></table>'.
			'@endif';
		$result =
			'<?php if(true): ?>'."\n".
				'<table></table>'.
			'<?php endif; ?>';

		$this->assertEquals(
			self::isolator($context, '\IceTea\View\Compilers\Components\Conditionals'), $result
		);
	}


	public function testConditionalIf()
	{
		$context = 
			'@if($x > 100)'."\n".
				'<table></table>'.
			'@endif';
		$result =
			'<?php if($x > 100): ?>'."\n".
				'<table></table>'.
			'<?php endif; ?>';

		$this->assertEquals(
			self::isolator($context, '\IceTea\View\Compilers\Components\Conditionals'), $result
		);
	}

	public function testOneLine()
	{
		$context = '@if($x > 100)ABCDEFG@endif';
		$result = '<?php if($x > 100): ?>ABCDEFG<?php endif; ?>';

		$this->assertEquals(
			self::isolator($context, '\IceTea\View\Compilers\Components\Conditionals'), $result
		);
	}

	public function testComplexIf()
	{

		// if with space in begining
		$context = '@if ($x === 1) hello world @endif';
		$result = '<?php if ($x === 1): ?> hello world <?php endif; ?>';

		// complex conditions
		$context = 
			'@if(sizeof($x) > 100 && ($y % 100 === 10) || ($is_superUser === true))'."\n".
				'<table></table>'.
			'@endif';
		$result =
			'<?php if(sizeof($x) > 100 && ($y % 100 === 10) || ($is_superUser === true)): ?>'."\n".
				'<table></table>'.
			'<?php endif; ?>';

		$this->assertEquals(
			self::isolator($context, '\IceTea\View\Compilers\Components\Conditionals'), $result
		);


		// complex condition in one line
		$context = '@if(sizeof($x) > 100 && ($y % 100 === 10) || ($is_superUser === true))---123123123123---@endif';
		$result = '<?php if(sizeof($x) > 100 && ($y % 100 === 10) || ($is_superUser === true)): ?>---123123123123---<?php endif; ?>';

		$this->assertEquals(
			self::isolator($context, '\IceTea\View\Compilers\Components\Conditionals'), $result
		);


		// nested if with complex conditions
		$context = '@if(sizeof($x) > 100 && ($y % 100 === 10) || ($is_superUser === true))'."\n".
						'@if(sizeof($array) > 1 && ($d % ($q + ($p/2) - 1)) <= 5)'."\n".
							'hello world!'."\n".
						'@endif'."\n".
					'@endif';

		$result = '<?php if(sizeof($x) > 100 && ($y % 100 === 10) || ($is_superUser === true)): ?>'."\n".
						'<?php if(sizeof($array) > 1 && ($d % ($q + ($p/2) - 1)) <= 5): ?>'."\n".
							'hello world!'."\n".
						'<?php endif; ?>'."\n".
					'<?php endif; ?>';

		$this->assertEquals(
			self::isolator($context, '\IceTea\View\Compilers\Components\Conditionals'), $result
		);
	}
}