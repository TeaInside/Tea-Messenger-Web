<?php

/**
 * IceTea Framework
 * App\Controllers\HomeController
 *
 * Created at : 2017-10-11 15:49:08
 */

namespace App\Controllers;

use Error;
use Exception;
use System\Database\DB;
use Handler\IceTeaController;

class HomeController extends IceTeaController
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
		DB::table()->insert([]);
		die;
		$a = \Config::get("database");
		var_dump($a);
		return view("home");
	}
}
