<?php

namespace IceTea\View\Compilers;

use IceTea\Hub\Singleton;

class ComponentState
{
	use Singleton;

	/**
	 * @var array
	 */
	private $state = [];

	/**
	 * Save filename and hash.
	 *
	 * @param string $file
	 * @param string $hash
	 */
	private function saveHash($file, $hash)
	{
		$this->state[$file] = $hash;
	}

	/**
	 * Get state.
	 */
	public static function getState()
	{
		return self::getInstance()->state;
	}

	/**
	 * Set state
	 *
	 * @param string $file
	 * @param string $hash
	 */
	public static function setState($file, $hash)
	{

	}

	/**
	 * Forget state.
	 */
	public static function forgetState()
	{
		return self::getInstance()->__forgetState();
	}

	private function __forgetState()
	{
		$this->state = [];
	}
}