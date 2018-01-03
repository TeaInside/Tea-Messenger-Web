<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Contracts\View\Component;
use IceTea\Foundation\View\ComponentFoundation;

class Comments extends ComponentFoundation implements Component
{
    public function compile()
    {
        $this->createCommentBoundary();
    }

    private function createCommentBoundary()
    {
        $tmp = explode("\n", $this->skeleton->getRaw());
        foreach ($tmp as $key => &$val) {
        	$val = preg_replace('/{{--(.*?)--}}/s', '', $val);
        }
        $this->skeleton->setRaw(implode("\n", $tmp));
    }
}