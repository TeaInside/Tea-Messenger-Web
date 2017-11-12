<?php

namespace IceTea\Foundation;

abstract class ConsoleCommand
{


    abstract public function buildContext();


    abstract public function run();
}//end class
