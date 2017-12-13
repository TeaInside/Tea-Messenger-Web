<?php

namespace IceTea\Exceptions;

class InternalExceptionList
{

    public static $list = [
                           \IceTea\Exceptions\Http\NotFoundHttpException::class,
                           \IceTea\Exceptions\Http\MethodNotAllowedException::class,
                          ];
}
