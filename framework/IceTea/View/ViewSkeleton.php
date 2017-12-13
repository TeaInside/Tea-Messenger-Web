<?php

namespace IceTea\View;

use IceTea\Hub\Singleton;
use IceTea\View\ViewVariables;

class ViewSkeleton
{
	use Singleton;

	/**
	 * @var string
	 */
	private $rawfile;

	/**
	 * @var \IceTea\ViewVariables
	 */
	private $variables;

	/**
	 * @param string			    $rawfile
	 * @param \IceTea\ViewVariables $variables
	 */
	public function __construct($rawfile, ViewVariables $variables)
	{
		$this->rawfile = $rawfile;
		$this->variables = $variables;
	}

	/**
	 * @return self
	 */
	public static function build(...$parameters)
	{
		return self::getInstance(...$parameters);
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		return self::getInstance()->rawfile;
	}
}