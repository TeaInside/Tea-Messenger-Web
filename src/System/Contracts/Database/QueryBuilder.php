<?php

namespace System\Contracts\Database;

use PDO;

interface QueryBuilder
{
    public function __construct(PDO &$pdo);
}
