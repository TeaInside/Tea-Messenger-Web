<?php

namespace IceTea\Utils;

use IceTea\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class EnvirontmentVariables
{
    use Singleton;

    /**
     * @var array
     */
    private $env;


    /**
     * Constructor,
     */
    public function __construct()
    {
        $this->parseEnvFile();

    }


    /**
     * Parse .env file.
     */
    private function parseEnvFile()
    {
        if (file_exists($env = basepath('.env'))) {
            $env = explode("\n", file_get_contents($env));
            foreach ($env as $val) {
                $val = trim($val);
                if (! empty($val) and substr($val, 0, 1) !== '#') {
                    $val = explode('=', $val, 2);
                    if (isset($val[1])) {
                        if (substr($val[1], 0, 1) === '"' && substr($val[1], -1) === '"') {
                            $this->env[$val[0]] = substr($val[1], 1, -1);
                        } else {
                            $this->env[$val[0]] = $val[1];
                        }
                    } else {
                        $this->env[$val[0]] = '';
                    }
                }
            }
        } else {
            throw new \Exception('.env not set', 1);
        }

    }


    /**
     * Get environment variable.
     *
     * @param  string $key
     * @param  string $def
     * @return mixed
     */
    public static function get($key, $def = null)
    {
        $ins = self::getInstance();
        return isset($ins->env[$key]) ? $ins->env[$key] : $def;

    }
}
