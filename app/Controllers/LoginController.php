<?php

/**
 * IceTea Framework
 * App\Controllers\LoginController
 *
 * Created at : 2017-10-15 19:45:30
 */

namespace App\Controllers;

use Error;
use Exception;
use Handler\IceTeaController;

class LoginController extends IceTeaController
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
		return view("login");
	}
}
