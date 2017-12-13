<?php

namespace IceTea\Contracts\Console\Input;

interface Input
{


    public function __construct($argv, $run);


    public function buildContext();


    public function getParseResult();
}
