<?php

namespace IceTea\Utils;

use IceTea\Hub\Singleton;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
final class Config
{
    use Singleton;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $cfg       = ___viewIsolator(
            basepath(
                'config/main.php',
                ['that' => $this]
            )
        );
        $this->cfg = $cfg;

    }//end __construct()


    /**
     * Get config key.
     *
     * @param  string $key
     * @param  string $def
     * @return mixed
     */
    public static function get($key, $def=null)
    {
        $ins = self::getInstance();
        return isset($ins->cfg[$key]) ? $ins->cfg[$key] : $def;

    }//end get()


}//end class
