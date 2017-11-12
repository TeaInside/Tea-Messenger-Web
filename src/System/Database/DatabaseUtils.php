<?php

namespace System\Database;

trait DatabaseUtils
{
    public static function table($table)
    {
        $ins = self::getInstance();
        $driver = $ins->driverMain;
        return new $driver($ins->pdo, $table);
    }
}
