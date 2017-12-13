<?php

namespace IceTea\View;

use IceTea\Hub\Singleton;
use IceTea\View\ViewSkeleton;
use IceTea\View\ViewVariables;
use IceTea\Support\View\PosibleFile;
use IceTea\Exceptions\ViewException;
use IceTea\View\Compilers\TeaTemplateCompiler;

class View
{

	use Singleton, PosibleFile;

	/**
	 * @param string $file
	 * @param array  $variables
	 * @return \IceTea\View\ViewSkeleton
	 */
	public static function buildView($file, $variables)
	{
		$ins = self::getInstance();
		return ViewSkeleton::build($ins->getRawFile($file), ViewVariables::build($variables));
	}

	/**
	 * @param \IceTea\View\ViewSkeleton $skeleton
	 */
	public static function make(ViewSkeleton $skeleton)
	{
		$compiler = new TeaTemplateCompiler($skeleton);
		if ($compiler->isIceTeaHasCompiledViewPerfectly()) {
			
		} else {
			$compiler->compile();
			$compiler->writeMap();
			$compiler->isolator();
		}
	}

	/**
	 * @param string $name
	 * @return string
	 */
	private function getRawFile($name)
	{
		if ($file = $this->teaFile($name)) {
			return file_get_contents($file);
		} elseif ($file = $this->bladeFile($name)) {
			return file_get_contents($file);
		} elseif ($file = $this->phpNativeFile($name)) {
			return file_get_contents($file);
		}
		throw new ViewException("View [$name] not found");
	}
}