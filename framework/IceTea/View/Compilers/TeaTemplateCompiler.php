<?php

namespace IceTea\View\Compilers;

use IceTea\View\ViewSkeleton;

class TeaTemplateCompiler
{

	/**
	 * @var \IceTea\View\ViewSkeleton $skeleton
	 */
	private $skeleton;

	/**
	 * @var string
	 */
	private $rawViewFileHash;

	/**
	 * Constructor.
	 *
	 * @param \IceTea\View\ViewSkeleton $skeleton
	 */
	public function __construct(ViewSkeleton $skeleton)
	{
		$this->skeleton = $skeleton;
		$this->rawViewFileHash = sha1($skeleton->__toString());
	}

	/**
	 * @return bool
	 */
	public function isIceTeaHasCompiledViewPerfectly()
	{
	}

	/**
	 * @return bool
	 */
	public function compile()
	{
		
	}
}