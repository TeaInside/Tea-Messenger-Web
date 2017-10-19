<?php

/**
 * IceTea Framework
 * App\Controllers\RegisterController
 *
 * Created at : 2017-10-12 19:07:02
 */

namespace App\Controllers;

use Error;
use Exception;
use Handler\IceTeaController;

class RegisterController extends IceTeaController
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view("registerNew");
    }
}
