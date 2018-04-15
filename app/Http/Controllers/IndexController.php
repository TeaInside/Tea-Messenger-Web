<?php

namespace App\Http\Controllers;

use DB;
use Request;

class IndexController extends Controller
{
    public function __construct(Request $request)
    {
    }

    public function index(Request $r)
    {	
    	return view("welcome");
    }
}
