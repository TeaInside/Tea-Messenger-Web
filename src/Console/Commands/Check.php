<?php

namespace Console\Commands;

use Console\ConsoleCommand;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Check extends ConsoleCommand
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
        print "Checking syntax...\n";
        $err = [];
        $verbose = strpos(implode(" ", $_SERVER['argv']), "--verbose") || strpos(implode(" ", $_SERVER['argv']), "-v");
        foreach (explode("\n", shell_exec("cd ".BASEPATH." && find | grep \".php\"")) as $val) {
            $a = explode(".", $val);
            if (/*substr($val, 0, 9) != "./vendor/" && */strtolower(end($a)) === "php") {
                $q = shell_exec("php -l ".$val. " 2>&1");
                if ($verbose) {
                    print $q;
                }
                if (substr($q, 0, 28) !== "No syntax errors detected in") {
                    $err[] = [$val,$q];
                }
            }
        }
        print "\n";
        if ($err) {
            print "Found ".count($err)." error : \n";
            array_walk(
                $err,
                function ($arr) {
                    print $arr[1];
                }
            );
        } else {
            print "No syntax errors detected!";
        }
        die("\n");
    }

    public function result()
    {
    }
}
