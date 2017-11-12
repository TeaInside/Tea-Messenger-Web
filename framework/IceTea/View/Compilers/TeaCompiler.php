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
    }

    public function compile()
    {
    	$this->buildContent();
    	foreach ($this->content as $k => $v) {
    		var_dump($v);
    	}die;
    }

    private function buildContent()
    {
    	$this->content = explode("\n", file_get_contents($this->file));
    }

    public function getComponent()
    {

    }

    public function getSelfHash()
    {

    }
}