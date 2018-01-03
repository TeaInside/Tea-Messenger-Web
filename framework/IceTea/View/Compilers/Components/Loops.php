<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class Loops extends ComponentFoundation implements Component
{
	public function compile()
	{
            $this->whileLoop();
		$this->foreachLoop();
            $this->forLoop();
	}

      private function forLoop()
      {

            $tmp = explode("\n", $this->skeleton->getRaw());

            foreach ($tmp as $k => &$v) {
                  if (strpos($v, "@for") !== false) {
                        if (preg_match('/(.*)(for\((.*)\))(.*)$/is', $v, $matches)) {
                              $v = substr($matches[1], 0, strlen($matches[1]) - 1)."<?php {$matches[2]}: ?>".$matches[sizeof($matches) - 1];
                        }
                  }
                  $v = str_replace("@endfor", "<?php endfor; ?>", $v);
            }
            $this->skeleton->setRaw(implode("\n", $tmp));
      }      

      private function whileLoop()
      {

            $tmp = explode("\n", $this->skeleton->getRaw());

            foreach ($tmp as $k => &$v) {
                  if (strpos($v, "@while") !== false) {
                        if (preg_match('/(.*)(while\((.*)\))(.*)$/is', $v, $matches)) {
                              $v = substr($matches[1], 0, strlen($matches[1]) - 1)."<?php {$matches[2]}: ?>".$matches[sizeof($matches) - 1];
                        }
                  }
                  $v = str_replace("@endwhile", "<?php endwhile; ?>", $v);
            }
            $this->skeleton->setRaw(implode("\n", $tmp));
      }

      private function foreachLoop()
      {

            $tmp = explode("\n", $this->skeleton->getRaw());

            foreach ($tmp as $k => &$v) {
                  if (strpos($v, "@foreach") !== false) {
                        if (preg_match('/(.*)(foreach(.*)(\( *(.*) +as *(.*)\)))(.*)$/is', $v, $matches)) {
                              $v = substr($matches[1], 0, strlen($matches[1]) - 1)."<?php {$matches[2]}: ?>".$matches[sizeof($matches) - 1];
                        }
                  }
                  $v = str_replace("@endforeach", "<?php endforeach; ?>", $v);
            }
            $this->skeleton->setRaw(implode("\n", $tmp));
      }
}
