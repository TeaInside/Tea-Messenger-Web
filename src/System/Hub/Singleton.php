<?php

namespace System\Hub;

trait Singleton
{
    private static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(...func_get_args());
        }
        return self::$instance;
    }

    /**
     * Avoid cloning instance.
     */
    private function __clone()
    {
    }

    private function __sleep()
    {
    }

    private function __wakeup()
    {
    }
}
