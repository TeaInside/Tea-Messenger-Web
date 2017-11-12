<?php

namespace System\Database;

use PDO;
use Config;
use System\Hub\Singleton;
use System\Database\DatabaseUtils;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class DB
{
    use Singleton, DatabaseUtils;

    /**
     * @var string
     */
    protected $errorInfo;

    /**
     * @var string
     */
    private $driverNS;

    /**
     * @var string
     */
    private $driverMain;

    /**
     * @var array
     */
    protected $config = [];

    /**
     * @var \PDO
     */
    protected $pdo;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->driverMap();
        $this->pdo = ($this->driverNS."\\Init")::pdo($this->config);
    }

    private function driverMap()
    {
        $this->config = Config::get("database");
        switch ($this->config['driver']) {
            case 'mysql':
                $this->driverNS = "\\System\\Database\\Driver\\MySQL";
                $this->driverMain = "\\System\\Database\\Driver\\MySQL\\MySQL";
                return ;
            break;
            default:
                throw new \Exception("Driver not found!", 1);
            break;
        }
    }
}
