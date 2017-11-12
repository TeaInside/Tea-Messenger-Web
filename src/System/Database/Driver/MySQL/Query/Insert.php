<?php

namespace System\Database\Driver\MySQL\Query;

use PDO;
use Config;

class Insert
{
    private $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(PDO &$pdo)
    {
        $this->pdo = &$pdo;
    }
    
    public function data($data)
    {
        if (is_array($data)
            && isset($data[0])
            && is_array($data[0])
        ) {
        } elseif (is_array($data)) {
        }
    }
}
