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
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("{{", $val);
            if (sizeof($_val) > 1) {
                foreach ($_val as $k => &$v) {
                    if ($k > 0) {
                        $a = explode("}}", $v, 2);
                        if (sizeof($a) > 1) {
                            $v = "<?php e(".$a[0].");?>".$a[1];
                        }
                    }
                }
                $val = implode("", $_val);
            }
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }
}
