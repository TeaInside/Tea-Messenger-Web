<?php

namespace IceTea\View;

class CacheHandler
{

	/**
	 * @var \IceTea\View\ViewSkeleton
	 */
	private $skeleton;

	/**
	 * Constructor.
	 *
	 * @param \IceTea\View\ViewSkeleton $skeleton
	 */
	public function __construct(ViewSkeleton $skeleton)
	{
		$this->skeleton = $skeleton;
	}

	public function isCached()
	{
	}

	public function isPerfectCache()
	{
	}

	public function makeCache()
	{
		$this->skeleton->buildBody();
		$this->component = $this->skeleton->getComponent();
		$this->selfhash  = $this->skeleton->getSelfHash();
	}
}
