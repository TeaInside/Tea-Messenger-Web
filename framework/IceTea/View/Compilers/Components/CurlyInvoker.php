<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class CurlyInvoker extends ComponentFoundation implements Component
{
	public function compile()
	{
		$this->createCurlyBoundary();
	}

	private function createCurlyBoundary()
	{
	}
}
