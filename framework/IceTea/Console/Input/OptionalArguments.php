<?php

namespace IceTea\Console\Input;

use IceTea\Console\Input;
use IceTea\Contracts\Console\Input\Input as InputContract;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class OptionalArguments extends Input implements InputContract
{

    private $result = [];

    private $argv = [];

    private $run = [];


    public function __construct($argv, $run)
    {
        $this->argv   = $argv;
        $this->run    = $run;
        $this->result = [];

    }//end __construct()


    public function buildContext()
    {
        foreach ($this->argv as $k => $v) {
            $this->parseContext($v, $k);
        }

    }//end buildContext()


    private function parseContext($context, $offset)
    {
        if (substr($context, 0, 2) === '--') {
            $context = explode('=', $context, 2);
            if (count($context) === 2) {
                $this->result['optional-arguments'][] = [
                                                       'data'    => $context[0],
                                                       'offset'  => $offset,
                                                       'content' => $context[1],
                                                      ];
            } else {
                $this->result['optional-arguments'][] = [
                                                       'data'    => $context[0],
                                                       'offset'  => $offset,
                                                       'content' => null,
                                                      ];
            }
        }

    }//end parseContext()


    public function getParseResult()
    {
        return $this->result;

    }//end getParseResult()
}//end class
