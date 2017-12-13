<?php

namespace IceTea\View;

use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;

class View
{

	/**
	 * @param string $file
	 * @param array  $variables
	 * @return \IceTea\View\ViewSkeleton
	 */
	public static function buildView($file, $variables)
	{
		ViewSkeleton::build($file, ViewVariables::build($variables));
	}
}