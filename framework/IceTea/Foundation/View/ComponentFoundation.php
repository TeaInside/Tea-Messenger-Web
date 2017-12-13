<?php

namespace IceTea\Foundation\View;

use IceTea\View\ViewSkeleton;

abstract class ComponentFoundation
{	
	/**
	 * @var \IceTea\View\ViewSkeleton
	 */
	protected $skeleton;

	/**
	 * Constructor.
	 *
	 * @param \IceTea\View\ViewSkeleton $skeleton
	 */
	final public function __construct(ViewSkeleton $skeleton)
	{
		$this->skeleton = $skeleton;
	}
}