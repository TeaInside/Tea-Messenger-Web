<?php

namespace IceTea\Console\Command;

use IceTea\Foundation\ConsoleCommand;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Make extends ConsoleCommand
{


    public function __construct()
    {

    }//end __construct()

    public function buildContext()
    {
        throw new \Exception("Must override!", 1);
    }

    public function run()
    {
        throw new \Exception("Must override!", 1);	
    }


}//end class
