<?php

namespace Console\Exceptions;

use Exception;

class InvalidArgumentException extends Exception
{
    public function __construct(...$par)
    {
        parent::__construct(...$par);
    }
}
