<?php

use Console\Input\ArgvInput;

final class IceTeaConsole
{
    public static function run()
    {
        $app = new ArgvInput();
        if ($app->execute()) {
            $cmd = $app->getCommand();
            $cmd = new $cmd;
            $cmd->input($app->getParam());
            $cmd->execute();
            die($cmd->result());
        }
    }
}
