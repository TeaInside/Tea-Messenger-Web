<?php

namespace IceTea\View;

use IceTea\View\Compilers\TeaCompiler;

class ViewSkeleton
{
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var array
	 */
	private $variables = [];

	/**
	 * @var \IceTea\View\Compilers\TeaCompiler
	 */
	private $compiler;

	/**
	 * Constructor.
	 *
	 * @param string $name
	 * @param array  $variables
	 */
	public function __construct($name, $variables)
	{
		$this->name = $name;
		$this->variables = $variables;
		$this->compiler = new TeaCompiler($this->name);
	}

	public function buildBody()
	{
		$this->compiler->compile();
	}

	public function __call($method, $param)
	{
		return $this->compiler->{$method}(...$param);
	}
}