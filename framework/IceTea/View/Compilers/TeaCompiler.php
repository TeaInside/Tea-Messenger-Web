<?php

namespace IceTea\View\Compilers;

use IceTea\View\Compilers\Components\Layout;

final class TeaCompiler
{
    private $file;

    private $content;

    private $hash;

    public function __construct($file)
    {
        $this->file = $file;
        $this->content = file_get_contents($file);
    }

    public function selfHash()
    {

    }

    public function compile()
    {
        $this->explodeContent();
        foreach ($this->content as $k => &$v) {
            $this->layoutState($v);
        }
    }

    private function explodeContent()
    {
        $this->content = explode("\n", $this->content);
    }

    private function layoutState(&$v)
    {
        $a = trim($v);        
        if (substr($a, 0, 9) === "@layout(\"" && substr($a, -2) === "\")") {
            $ly = new Layout($a);
            $ly->build();
            $v = $ly->getResult();
        }
    }

    public function getContent()
    {

    }
}