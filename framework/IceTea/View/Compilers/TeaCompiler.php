<?php

namespace IceTea\View\Compilers;

use IceTea\View\Compilers\Components\Layout;

class TeaCompiler
{
    public function __construct($name)
    {
        $this->name = $name;
    }
}