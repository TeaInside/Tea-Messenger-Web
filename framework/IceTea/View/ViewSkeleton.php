<?php

namespace IceTea\View;

use InvalidArgumentException;
use IceTea\View\Compilers\TeaCompiler;

final class ViewSkeleton
{
	
	/**
	 * @var string
	 */
	private $name;

	/**
	 * @var string
	 */
	private $file;

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
	public function __construct($name, $variables = [])
	{
		$this->name = $name;
		$this->variables = $variables;	
		$this->compiler = new TeaCompiler($this->file = $this->findFile());
	}

	private function findFile()
	{
		if (file_exists($file = basepath("app/Views/".$this->name.".tea.php"))) {
			return $file;
		} elseif (file_exists($file = basepath("app/Views/".$this->name.".php"))) {
			return $file;
		}
		throw new InvalidArgumentException("View [$this->name] not found.");
	}

	public function buildBody()
	{
		$this->compiler->compile();
	}

	public function getFileName()
	{
		return $this->file;
	}

	public function getSelfHash()
	{
		return $this->compiler->selfHash();
	}

	public function getComponent()
	{
		return $this->compiler->getComponent();
	}

	public function compilerInstance()
	{
		return $this->compiler;
	}
}