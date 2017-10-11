<?php

namespace Console\Input;

use Console\CMDRoutes as C;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class ArgvInput
{
    private $command;

    private $input = [];

    private $param = [];

    public function __construct()
    {
        $this->getInput();
    }

    public function getCommand()
    {
        return $this->command;
    }

    private function getInput()
    {
        $a = $_SERVER['argv'];
        array_shift($a);
        $this->input = $a;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function execute()
    {
        if (count($this->input)) {
            if (strpos($this->input[0], ":")) {
                $cmd = explode(":", $this->input[0]);
                $this->param[] = $cmd[1];
                $cmd = $cmd[0];
            } else {
                $cmd = $this->input[0] ;
            }
            if (isset(C::$cmd[strtolower($cmd)])) {
                $this->command = C::$cmd[strtolower($cmd)];
            } else {
                $this->cmdNotFound();
                die;
            }
            array_shift($this->input);
            $i = 1;
            foreach ($this->input as $val) {
                $this->param[$i] = $val;
            }
            return true;
        } else {
            $this->showHelps();
        }
    }

    public function showHelps()
    {
    }
}
