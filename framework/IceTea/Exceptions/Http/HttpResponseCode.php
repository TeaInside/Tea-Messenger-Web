<?php

namespace IceTea\Exceptions\Http;

use IceTea\Exceptions\ExceptionInfo;
use IceTea\Exceptions\AbsoluteException;

class HttpResponseCode extends ExceptionInfo
{

    public static $code = [
                           AbsoluteException::class         => 500,
                           NotFoundHttpException::class     => 404,
                           MethodNotAllowedException::class => 405,
                          ];
}//end class
