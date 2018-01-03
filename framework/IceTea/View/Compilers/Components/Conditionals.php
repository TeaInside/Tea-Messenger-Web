<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class Conditionals extends ComponentFoundation implements Component
{
    public function compile()
    {
        $this->if();
    }

    public function if()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());

            foreach ($tmp as $k => &$v) {
                  if (strpos($v, "@if") !== false) {
                        if (preg_match('/(.*)(if\((.*)\))(.*)$/is', $v, $matches)) {
                              $v = substr($matches[1], 0, strlen($matches[1]) - 1)."<?php {$matches[2]}: ?>".$matches[sizeof($matches) - 1];
                        }
                  }
                  $v = str_replace("@endif", "<?php endif; ?>", $v);
            }

        $this->skeleton->setRaw(implode("\n", $tmp));
    }  
}