<?php

namespace IceTea\Console;

use IceTea\Console\Input\Command;
use IceTea\Console\Input\Arguments;
use IceTea\Console\Input\OptionalArguments;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class Console
{

    private $argv = [];

    private $run = [];

    public function __construct()
    {
        $this->run = [];
    }

    public function run()
    {
        if ($this->parseInput()) {
            $this->parseCommand();
            $this->parseArguments();
            $this->parseOptionalArguments();
            $this->__run();
        }

    }//end run()


    private function parseCommand()
    {
        $parser = new Command($this->argv, $this->run);
        $parser->buildContext();
        $this->run = array_merge($this->run, $parser->getParseResult());

    }//end parseCommand()


    private function parseArguments()
    {
        $parser = new Arguments($this->argv, $this->run);
        $parser->buildContext();
        $this->run = array_merge($this->run, $parser->getParseResult());

    }//end parseArguments()


    private function parseOptionalArguments()
    {
        $parser = new OptionalArguments($this->argv, $this->run);
        $parser->buildContext();
        $this->run = array_merge($this->run, $parser->getParseResult());

    }//end parseOptionalArguments()


    private function __run()
    {
        $console = new MainHandler($this->run);
        return $console();

    }//end __run()


    private function parseInput()
    {
        $argv = $_SERVER['argv'];
        array_shift($argv);
        if (empty($argv)) {
            $this->intro();
            return false;
        }

        $this->argv = $argv;
        return true;

    }//end parseInput()


    private function intro()
    {
        $intro = new Intro();
        $intro->buildContext();
        $intro->show();

    }//end intro()


    public function terminate()
    {

    }//end terminate()
}//end class
