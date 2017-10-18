<?php

namespace System\Database\Driver\MySQL;

use PDO;
use System\Contracts\Database\QueryBuilder;
use System\Database\Driver\MySQL\Query\Insert;
use System\Foundation\Database\DatabaseFactory;

class MySQL extends DatabaseFactory implements QueryBuilder
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Constructor.
     *
     * @param \PDO $pdo
     */
    public function __construct(PDO &$pdo)
    {
        $this->pdo = &$pdo;
    }

    public function insert($arr)
    {
        $st = new Insert($this->pdo);
        $st->data($arr);
        return $st->exec();
    }
}
