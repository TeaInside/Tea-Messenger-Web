<?php

namespace IceTea\View;

use ArrayAccess;
use IceTea\Hub\Singleton;

class ViewVariables implements ArrayAccess
{
    use Singleton;

    /**
     * @var array
     */
    private $containter = [];

    /**
     * Constructor.
     *
     * @param array $variables
     */
    public function __construct($variables)
    {
        $this->containter = $variables;
    }

    public function toArray()
    {
        return $this->containter;
    }

    /**
     * Build
     */
    public static function build(...$parameters)
    {
        return self::getInstance(...$parameters);
    }

    /**
     * @param string\int $offset
     * @param any        $value
     */
    public function offsetSet($offset, $value)
    {
        $this->containter[$offset] = $value;
    }

    /**
     * @param string|int $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return array_key_exists($offset, $this->containter) ? $this->containter[$offset] : false;
    }

    /**
     * @param string|int $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->containter[$offset]);
    }

    /**
     * @param string|int $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->containter[$offset]);
    }
}
