<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class Conditionals extends ComponentFoundation implements Component
{
    public function compile()
    {
        $this->createIfBoundary();
        $this->createUnlessBoundary();
        $this->createElseIfBoundary();
        $this->createElseBoundary();
        $this->createEndIfBoundary();
        $this->createEndUnlessBoundary();
        $this->createIssetBoundary();
        $this->createEndIssetBoundary();
    }

    private function createIfBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("@if(", $val);
            if (sizeof($_val) > 1) {
                foreach ($_val as $k => &$v) {
                    if ($k > 0) {
                        $a = explode(")", $v, 2);
                        if (sizeof($a) > 1) {
                            $v = "<?php if(".$a[0]."): ?>".$a[1];
                        }
                    }
                }
                $val = implode("", $_val);
            }
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createUnlessBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("@unless(", $val);
            if (sizeof($_val) > 1) {
                foreach ($_val as $k => &$v) {
                    if ($k > 0) {
                        $a = explode(")", $v, 2);
                        if (sizeof($a) > 1) {
                            $v = "<?php if(!".$a[0]."): ?>".$a[1];
                        }
                    }
                }
                $val = implode("", $_val);
            }
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createElseIfBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("@elseif(", $val);
            if (sizeof($_val) > 1) {
                foreach ($_val as $k => &$v) {
                    if ($k > 0) {
                        $a = explode(")", $v, 2);
                        if (sizeof($a) > 1) {
                            $v = "<?php elseif(".$a[0]."): ?>".$a[1];
                        }
                    }
                }
                $val = implode("", $_val);
            }
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createElseBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $val = str_replace('@else', '<?php else: ?>', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createEndIfBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $val = str_replace('@endif', '<?php endif; ?>', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createEndUnlessBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $val = str_replace('@endunless', '<?php endif; ?>', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createIssetBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $_val = explode("@isset(", $val);
            if (sizeof($_val) > 1) {
                foreach ($_val as $k => &$v) {
                    if ($k > 0) {
                        $a = explode(")", $v, 2);
                        if (sizeof($a) > 1) {
                            $v = "<?php if(isset(".$a[0].")): ?>".$a[1];
                        }
                    }
                }
                $val = implode("", $_val);
            }
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }

    private function createEndIssetBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
            $val = str_replace('@endisset', '<?php endif; ?>', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }
}