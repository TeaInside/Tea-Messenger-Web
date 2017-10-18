<?php

namespace Console\Commands;

use Console\ConsoleCommand;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Fixer extends ConsoleCommand
{
    /**
     * @var array
     */
    private $param = [];

    /**
     * @var string
     */
    private $what;

    /**
     * @param array $param
     */
    public function input($param)
    {
        if (!isset($param[0])) {
            // code...
        } else {
            $this->what = strtolower($param[0]);
            array_shift($param);
            $this->param = $param;
        }
    }

    public function execute()
    {
        print "Fixing...\n";
        print shell_exec(BASEPATH."/src/sys.vendor/bin/phpcbf ".BASEPATH."/app --standard=PSR2 >> /dev/null &");
        print shell_exec(BASEPATH."/src/sys.vendor/bin/phpcbf ".BASEPATH."/tests --standard=PSR2 >> /dev/null &");
        print shell_exec(BASEPATH."/src/sys.vendor/bin/phpcbf ".BASEPATH."/public --standard=PSR2  >> /dev/null &");
        print shell_exec(BASEPATH."/src/sys.vendor/bin/phpcbf ".BASEPATH."/src --standard=PSR2 >> /dev/null &");
        print "\nFixed!";
        die("\n");
    }

    public function result()
    {
    }
}
