<?php

namespace IceTea\Console\Input;

use IceTea\Console\Input;
use IceTea\Contracts\Console\Input\Input as InputContract;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Arguments extends Input implements InputContract
{

    private $argv = [];

    private $run = [];

    private $result = [];


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
        if (substr($context, 0, 1) === '-'
            && substr($context, 1, 1) !== '-'
        ) {
            $context = str_split(substr($context, 1));
            foreach ($context as $key => $val) {
                $this->result['arguments'][] = [
                                                'data'   => $val,
                                                'offset' => "{$offset},{$key}",
                                                'type'   => 'normal',
                                               ];
            }
        }

    }//end parseContext()


    public function getParseResult()
    {
        return $this->result;

    }//end getParseResult()


}//end class
