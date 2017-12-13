<?php

namespace IceTea\Contracts\View;

use IceTea\View\ViewSkeleton;

interface Component
{
	public function __construct(ViewSkeleton $skeleton);
}
