<?php

namespace IceTea\View;

use InvalidArgumentException;
use IceTea\View\Compilers\TeaCompiler;

final class ViewSkeleton
{
	
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
	 * @param string $file
	 * @param array  $variables
	 */
	public function __construct($file, $variables = [])
	{
		$this->file = $file;
		$this->variables = $variables;	
		$this->compiler = new TeaCompiler($this->findFile());
	}

	private function findFile()
	{
		if (file_exists($file = basepath("app/Views/".$this->file.".tea.php"))) {
			return $file;
		} elseif (file_exists($file = basepath("app/Views/".$this->file.".php"))) {
			return $file;
		}
		throw new InvalidArgumentException("View");
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