<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class RawPhp extends ComponentFoundation implements Component
{
    public function compile()
    {
        $this->createPhpBoundary();
        $this->createEndPhpBoundary();
        $this->createUnsetBoundary();
    }

    private function createPhpBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $val = str_replace('@php', '<?php', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createEndPhpBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $val = str_replace('@endphp', '?>', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createUnsetBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("@unset(", $val);
            if (sizeof($_val) > 1) {
                foreach ($_val as $k => &$v) {
                    if ($k > 0) {
                        $a = explode(")", $v, 2);
                        if (sizeof($a) > 1) {
                            $v = "<?php unset(".$a[0].");?>".$a[1];
                        }
                    }
                }
                $val = implode("", $_val);
            }
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }
}