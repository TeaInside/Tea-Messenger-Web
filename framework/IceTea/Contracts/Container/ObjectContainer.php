<?php

namespace IceTea\Contracts\Container;

interface ObjectContainer
{


    /**
     *
     * @param string $objectName
     */
    public function __construct($objectName);


    /**
     * Build object.
     */
    public function build();
}
