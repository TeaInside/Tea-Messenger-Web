<?php

namespace System\Exceptions\Http;

use Exception;

class MethodNotAllowedException extends Exception
{
    public function __construct(...$a)
    {
        http_response_code(402);
        parent::__construct(...$a);
    }
}
