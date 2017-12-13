<?php

namespace IceTea\View;

use InvalidArgumentException;
use IceTea\Support\View\PosibleFile;
use IceTea\View\Compilers\TeaCompiler;

class ViewSkeleton
{

    use PosibleFile;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $variables = [];

    /**
     * @var \IceTea\View\Compilers\TeaCompiler
     */
    private $compiler;

    /**
     * @var string
     */
    private $file;

    /**
     * Constructor.
     *
     * @param string $name
     * @param array  $variables
     */
    public function __construct($name, $variables)
    {
        $this->name = $name;
        $this->filename = "/".$name.".php";
        $this->variables = $variables;
        $this->compiler = new TeaCompiler($this->file = $this->findFile());
    }

    public function getVariables()
    {
        return $this->variables;
    }

    /**
     *
     */
    public function findFile()
    {
        if ($file = $this->found()) {
            return $file;
        }
        


        throw new InvalidArgumentException("View [$this->name] not found.", 1);
    }

    /**
     * Compiler handle.
     *
     * @param string $mehtod
     * @param array  $param
     */
    public function __call($method, $param)
    {
        return $this->compiler->{$method}(...$param);
    }

    /**
     * Build view.
     *
     */
    public function buildBody()
    {
        $this->compiler->compile();
    }

    private function found()
    {
        if ($file = $this->teaFile()) {
            return $file;
        } elseif ($file = $this->bladeFile()) {
            return $file;
        } elseif ($file = $this->nativePhpFile()) {
            return $file;
        }
        return false;
    }
}
