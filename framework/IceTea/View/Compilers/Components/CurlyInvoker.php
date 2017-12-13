<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class Layout extends ComponentFoundation implements Component
{
	public function compile()
	{
		$this->createLayoutBoundary();
	}

	private function createLayoutBoundary()
	{
		$tmp = explode("\n", $this->skeleton->getRaw());
		foreach ($tmp as $key => &$val) {
			$_val = trim($val);
			if (
				substr($_val, 0, 8) === "@layout(" &&
				substr($_val, -1) === ")"
			) {
				$val = "<?php require \IceTea\View\QuickMake::make('".substr($_val, 9, -2)."', 'layout');?>";
			}
		}
		$this->skeleton->setRaw(implode("\n", $tmp));
	}
}
