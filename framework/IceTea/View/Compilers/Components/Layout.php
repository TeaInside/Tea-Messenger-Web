<?php

namespace IceTea\View\Compilers\Components;

use IceTea\Support\View\PosibleFile;
use IceTea\View\Compilers\TeaCompiler;
use IceTea\View\Compilers\ComponentState;

class Layout
{
    use PosibleFile;

    private $fixedContent;

    private $name;

    /**
     * Constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = "layouts/".$name;
    }

    /**
     * Build layout content.
     */
    public function build()
    {
        $this->fileHandle();
        $this->compiler = new TeaCompiler(null);
        ComponentState::setState($this->file, sha1_file($this->file));
        $this->compiler->compile(file_get_contents($this->file));
        $this->fixedContent = $this->compiler->getContent();
    }

    private function fileHandle()
    {
        if ($file = $this->teaFile()) {
            $this->file = $file;
        } elseif ($file = $this->bladeFile()) {
            $this->file = $file;
        } elseif ($file = $this->nativePhpFile()) {
            $this->file = $file;
        } else {
            throw new InvalidArgumentException("Layout [$this->name] not found.");
        }
    }

    public function __toString()
    {
        return $this->fixedContent;
    }
}
