<?php

namespace IceTea\Container;

use ReleflectionClass;
use IceTea\Contracts\Container\ObjectContainer as ObjectContainerContract;

class ObjectContainer implements ObjectContainerContract
{

    /**
     * An object name.
     *
     * @var string
     */
    private $objectName;


    /**
     * Constructor.
     *
     * @param string $objectName
     */
    public function __construct($objectName)
    {
        $this->objectName = $objectName;

    }//end __construct()


    public function buildClass()
    {
        return new ReleflectionClass($this->objectName);

    }//end buildClass()


}//end class
