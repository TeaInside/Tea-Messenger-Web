<?php

namespace IceTea\Contracts\Http\Controller;

interface InvokeableController
{


    public function __construct();


    public function __invoke();


}//end interface
