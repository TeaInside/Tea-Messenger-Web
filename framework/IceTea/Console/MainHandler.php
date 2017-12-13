<?php

namespace IceTea\Console;

final class MainHandler
{
    private $run = [];

    public function __construct($run)
    {
        $this->run = $run;
    }

    public function __invoke()
    {
        if (isset($this->run['cmd']['action'])) {
            $this->run['cmd']['action'] = "\\".$this->run['cmd']['action'];
            $console = new $this->run['cmd']['action']($this->run);
            $console->buildContext();
            $console->run();
        }
    }
}
