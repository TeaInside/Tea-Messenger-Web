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
            	$next_string = str_split($_val[1]);
            	$arguments = "";
            	$back = "";
            	$cost = 2;
            	$flag = 0;
            	foreach ($next_string as $string) {
            		if ($string === "(") {
            			$cost++;
            		} elseif ($string) {

            		}

            		if ($flag) {
            			$back .= $string;
            		} else {
            			$arguments .= $string;
            		}
            	}
            	$val = $_val[0]."<?php foreach".$arguments.": ?>";
            } else {
            	$_val = explode("@endforeach", $val, 2);
            	if (sizeof($_val) > 1) {
            		$val  = implode("<?php endforeach; ?>", $_val);
            	}
            }
		}
        $this->skeleton->setRaw(implode("\n", $tmp));
	}
}
