<?php

namespace IceTea\Security\Encryption;

class IceCrypt
{
    /**
     * @param string $str
     * @param string $key
     * @return string
     */
    public static function encrypt($str, $key)
    {
        $key = (string) $key;
        $salt = self::makeSalt();
        $key  = sha1($key.$salt);
        $klen = strlen($key);
        $slen = strlen($str);
        $k = $klen - 1;
        $j = 0;
        $h = $slen - 1;
        $r = "";
        for ($i=0; $i < $slen; $i++) {
            $r .= chr(
                ord($str[$i]) ^ ($posibly = ord($key[$j])) ^ ($cost = ord($key[$k])) ^ ($i | (($k & $j) ^ $h)) ^ (($i + $k + $j + $h) % 2) ^ ($cost % 2) ^ ($posibly ^ 2) ^ (($posibly + $cost) % 3) ^ (abs(~$cost + $posibly) % 2)
            );
            $j++;
            $k--;
            $h--;
            if ($j === $klen) {
                $j = 0;
            }
            if ($k === -1) {
                $k = $klen - 1;
            }
            if ($h === 0) {
                $h = $slen - 1;
            }
        }
        return strrev(base64_encode($r.$salt));
    }

    /**
     * @param string $str
     * @param string $key
     * @return string
     */
    public static function decrypt($str, $key)
    {
        $key = (string) $key;
        $str = base64_decode(strrev($str));
        if (strlen($str) < 6) {
            return false;
        }
        $salt = substr($str, -5);
        $str  = substr($str, 0, -5);
        $key  = sha1($key.$salt);
        $klen = strlen($key);
        $slen = strlen($str);
        $k = $klen - 1;
        $j = 0;
        $h = $slen - 1;
        $r = "";
        for ($i=0; $i < $slen; $i++) {
            $r .= chr(
                ord($str[$i]) ^ ($posibly = ord($key[$j])) ^ ($cost = ord($key[$k])) ^ ($i | (($k & $j) ^ $h)) ^ (($i + $k + $j + $h) % 2) ^ ($cost % 2) ^ ($posibly ^ 2) ^ (($posibly + $cost) % 3) ^ (abs(~$cost + $posibly) % 2)
            );
            $j++;
            $k--;
            $h--;
            if ($j === $klen) {
                $j = 0;
            }
            if ($k === -1) {
                $k = $klen - 1;
            }
            if ($h === 0) {
                $h = $slen - 1;
            }
        }
        return $r;
    }

    private static function makeSalt()
    {
        $r = "";
        for ($i=0; $i < 5; $i++) {
            $r .= chr(rand(1, 255));
        }
        return $r;
    }
}
