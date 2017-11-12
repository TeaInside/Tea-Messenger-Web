<?php

namespace IceTea\View\Compilers\Components;

use InvalidArgumentException;
use IceTea\View\Compilers\TeaCompiler;

class Layout
{

	private $name;

	private $file;

	public function __construct($name)
	{
		$this->name = $name;
	}

	public function build()
	{

	}

	public function __toString()
	{
		new TeaCompiler($this->file = $this->findFile());
	}

	private function findFile()
	{
		if (file_exists($file = basepath("app/Views/layout/". $this->name. ".tea.php"))) {
			$this->file = $file;
			return $file;
		} elseif (file_exists($file = basepath("app/Views/layout/". $this->name. ".tea.php"))) {
			$this->file = $file;
			return $file;
		}
		throw new InvalidArgumentException("Layout [$this->name] not found.");
	}
} 