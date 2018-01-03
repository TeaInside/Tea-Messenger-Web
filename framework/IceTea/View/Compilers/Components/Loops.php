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

            foreach ($tmp as $k => &$v) {
                  if (strpos($v, "@foreach") !== false) {
                        if (preg_match('/(.*)(foreach(\( *(.*) +as *(.*)\)))(.*)$/is', $v, $matches)) {
                              $v = substr($matches[1], 0, strlen($matches[1]) - 1)."<?php {$matches[2]}: ?>".$matches[sizeof($matches) - 1];
                        }
                  }
                  $v = str_replace("@endforeach", "<?php endforeach; ?>", $v);
            }
            $this->skeleton->setRaw(implode("\n", $tmp));
	}
}
