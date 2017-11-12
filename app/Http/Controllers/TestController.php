<?php

namespace App\Http\Controllers;

use IceTea\Http\Controller;

class TestController extends Controller
{
    public function index()
    {
        echo microtime(true) - ICETEA_START . PHP_EOL;
    }
}
