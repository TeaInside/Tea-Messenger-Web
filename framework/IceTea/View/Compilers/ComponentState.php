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

    private $mainState = [];

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
        $ins = self::getInstance();
        return [
            "main" => $ins->mainState,
            "sub" => $ins->state
        ];
    }

    /**
     * Set state
     *
     * @param string $file
     * @param string $hash
     */
    public static function setState($file, $hash)
    {
        $ins = self::getInstance();
        $ins->state[$file] = $hash;
    }

    public static function setMainState($file, $hash)
    {
        $ins = self::getInstance();
        $ins->mainState = [
            "file" => $file,
            "hash" => $hash
        ];
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
        $this->mainState = [];
        $this->state = [];
    }
}
