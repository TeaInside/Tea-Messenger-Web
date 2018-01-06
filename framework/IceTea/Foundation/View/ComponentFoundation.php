<?php

namespace IceTea\Foundation\View;

abstract class ComponentFoundation
{
   
    /**
     * @var \IceTea\View\ViewSkeleton
     */
    protected $skeleton;

    /**
     * Constructor.
     *
     * @param string $skeleton
     */
    final public function __construct($skeleton)
    {
        $this->skeleton = $skeleton;
    }

    /**
     * @return \IceTea\View\ViewSkeleton
     */
    final public function getSkeleton()
    {
        return $this->skeleton;
    }
}
