<?php

namespace IceTea\Http;

use IceTea\Http\Base\BaseController;
use IceTea\Exceptions\ControllerException\BadMethodCallException;

class Controller extends BaseController
{


    public function __construct()
    {
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $method
     * @param array  $parameters
     *
     * @throws \BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException("Method [{$method}] does not exist.");

    }
}
