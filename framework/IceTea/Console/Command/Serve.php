<?php

namespace IceTea\Console\Command;

use IceTea\Console\Color;
use IceTea\Foundation\ConsoleCommand;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Serve extends ConsoleCommand
{


    public function __construct()
    {

    }

    public function buildContext()
    {
    }

    public function run()
    {
        print Color::clr("IceTea development server started:", "green"). " <http://127.0.0.1:8001>" . PHP_EOL;
        shell_exec(PHP_BINARY." -S 127.0.0.1:8001 -t ".basepath("public"));
    }
}
