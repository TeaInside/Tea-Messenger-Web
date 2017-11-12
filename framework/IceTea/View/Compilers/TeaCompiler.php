<?php

namespace IceTea\View\Compilers;

use IceTea\View\Compilers\Components\Layout;

class TeaCompiler
{
    private $content = [];

    private $file;

    public function __construct($file)
    {
        $this->file = $file;
        if ($file) {
            ComponentState::setMainState($this->file, sha1_file($this->file));
        }
    }

    public function compile($content = null)
    {
        if ($content) {
            $this->content = explode("\n", $content);
        } else {
            $this->buildContent();
        }
        foreach ($this->content as $k => &$v) {
            $this->buildLayout($v, $k);
        }
    }

    private function buildContent()
    {
        $this->content = explode("\n", file_get_contents($this->file));
    }

    private function buildLayout(&$v, $k)
    {
        $a = trim($v);
        if (substr($a, 0, 9) === "@layout(\"" && substr($a, -2) === "\")") {
            $layout = new Layout(substr($a, 9, -2));
            $layout->build();
            $v = $layout;
        }
    }

    public function getContent()
    {
        return implode("\n", $this->content);
    }

    public function getComponent()
    {

    }

    public function getSelfHash()
    {

    }
}
