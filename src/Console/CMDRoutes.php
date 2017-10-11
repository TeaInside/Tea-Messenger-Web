<?php

namespace Console;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class CMDRoutes
{
    public static $cmd = [
        "make" => "\\Console\\Commands\\Make",
        "delete" => "\\Console\\Commands\\Delete",
        "export" => "\\Console\\Commands\\Export",
        "import" => "\\Console\\Commands\\Import"
    ];
}
