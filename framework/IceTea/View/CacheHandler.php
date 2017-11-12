<?php

namespace IceTea\View;

class CacheHandler
{
	/**
	 * @var array
	 */
	private $selfHash = [];

	/**
	 * Constructor.
	 *
	 * @param array $selfHash
	 */
	public function __construct($selfHash)
	{
		$this->selfHash = $selfHash;
	}

	public function handle()
	{

	}

	public function isCached()
	{
		
	}
}