<?php

namespace IceTea\Hub;

trait Singleton
{

    private static $__instance;


    /**
     * Get self instance staticaly.
     */
    public static function getInstance(...$param)
    {
        if (self::$__instance === null) {
            self::$__instance = new self(...$param);
        }

        return self::$__instance;

    }


    /**
     * Prevent cloning instance.
     */
    final private function __clone()
    {
        throw new \Exception('Cannot clone instance with Singleton pattern.', 1);

    }
}
