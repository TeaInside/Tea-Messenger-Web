<?php

namespace IceTea\Support\View;

trait PosibleFile
{
	private function teaFile()
	{
		return 
			file_exists($file = basepath("app/Views/".$this->name.".tea.php")) ?
				$file : false;
	}

	private function bladeFile()
	{
		return 
			file_exists($file = basepath("app/Views/".$this->name.".blade.php")) ?
				$file : false;
	}

	private function nativePhpFile()
	{
		return 
			file_exists($file = basepath("app/Views/".$this->name.".php")) ?
				$file : false;	
	}
}