<?php

namespace IceTea\View\Compilers;

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
}