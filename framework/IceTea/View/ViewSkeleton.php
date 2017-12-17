<?php

namespace IceTea\View;

use IceTea\Hub\Singleton;
use IceTea\View\ViewVariables;

class ViewSkeleton
{
    use Singleton;

    /**
     * @var string
     */
    private $rawfile;

    /**
     * @var \IceTea\ViewVariables
     */
    private $variables;

    /**
     * @var string
     */
    private $name;

    /**
     * @param string                $rawfile
     * @param \IceTea\ViewVariables $variables
     */
    public function __construct($rawfile, ViewVariables $variables, $name)
    {
        $this->rawfile = $rawfile;
        $this->variables = $variables;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getRaw()
    {
        return $this->rawfile;
    }

    /**
     * @param string
     */
    public function setRaw($string)
    {
        $this->rawfile = $string;
    }

    /**
     * @return self
     */
    public static function build(...$parameters)
    {
        return self::getInstance(...$parameters);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return self::getInstance()->rawfile;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function variables()
    {
        return $this->variables;
    }
}
