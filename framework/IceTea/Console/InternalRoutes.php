<?php

namespace IceTea\Console;

final class InternalRoutes
{

    public static $routes = [
            'normal' => [
                'serve' =>  \IceTea\Console\Command\Serve::class
            ],
            'colon-separated' => [
                'make' => [
                    'model'      => \IceTea\Console\Command\Make\Model::class,
                    'controller' => \IceTea\Console\Command\Make\Controller::class,
                ],
            ],
    ];
}//end class
