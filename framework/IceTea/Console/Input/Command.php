<?php

namespace IceTea\Console\Input;

use IceTea\Console\Input;
use IceTea\Console\InternalRoutes;
use IceTea\Contracts\Console\Input\Input as InputContract;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class Command extends Input implements InputContract
{

    private $argv;

    private $result = [];

    private $cmd = [];

    private $run = [];


    public function __construct($argv, $run)
    {
        $this->argv    = $argv;
        $this->pointer = 0;
        $this->run     = $run;

    }


    public function buildContext()
    {
        foreach ($this->argv as $k => $v) {
            $this->parseContext($v, $k);
        }

    }


    private function parseContext($context, $offset)
    {
        $ex = explode(':', $context);
        if (count($ex) === 2) {
            array_walk(
                $ex,
                function (&$ar) {
                    $ar = strtolower($ar);
                }
            );
            if (!isset($this->result['cmd'])
                && isset(InternalRoutes::$routes['colon-separated'][$ex[0]][$ex[1]])
            ) {
                $this->result['cmd'] = [
                                        'action' => InternalRoutes::$routes['colon-separated'][$ex[0]][$ex[1]],
                                        'type'   => 'colon-separated',
                                        'offset' => $offset,
                                       ];
            }
        } else {
            if (!isset($this->result['cmd'])
                && isset(InternalRoutes::$routes['normal'][$ex[0]])
            ) {
                $this->result['cmd'] = [
                                       'action' => InternalRoutes::$routes['normal'][$ex[0]],
                                       'type'   => 'colon-separated',
                                       'offset' => $offset,
                                      ];
            } else {
                $this->result['parameter'][] = [
                                           'data'   => $context,
                                           'type'   => $this->typeGenerator($offset),
                                           'offset' => $offset,
                                          ];
            }
        }

    }


    private function typeGenerator($offset)
    {
        if (isset($this->result['cmd'])) {
            return $offset === ($this->result['cmd']['offset'] + 1) ? 'name' : 'parameter';
        } else {
            return 'normal';
        }

    }


    public function getParseResult()
    {
        return $this->result;

    }
}
