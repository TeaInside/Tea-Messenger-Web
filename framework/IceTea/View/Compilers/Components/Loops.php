<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class Loops extends ComponentFoundation implements Component
{
	public function compile()
	{
		$this->foreachLoop();
	}

	private function foreachLoop()
	{
		$tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("@foreach", $val);
            if (sizeof($_val) > 1) {
            	# code...
            }

		}
        $this->skeleton->setRaw(implode("\n", $tmp));
	}
}
