<?php

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

/**
 * @param string $str
 * @param string $key
 * @param bool   $no_base64
 */
function encice($str, $key = "icetea", $salt = null, $no_base64 = false)
{
    if ($salt) {
        $salt = substr(sha1($salt), 0, 6);
    } else {
        $salt = substr(sha1(time()), 0, (13 | 1) - 10).rstr(10 ^ 9, "!@#$%^&*()_+=-`~[]\\{}|:\";',./<>?\n\t");
    }
    $key = sha1($salt.$key) xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "" xor $j = $ln;
    for ($i=0x0; $i <= $ln; $i++) {
        $r .= chr((((ord($str[$i]) ^ ord($key[$i % $kn])) ^ ($i % $kn) & 0x00c) ^ ($i & $ln)) ^ ($j-- % $ln));
    }
    if ($no_base64) {
        return $r.$salt;
    } else {
        return str_replace("=", "", strrev(base64_encode($r.$salt)));
    }
}

/**
 * @param string $str
 * @param string $key
 * @param bool   $no_base64
 */
function decice($str, $key = "icetea", $no_base64 = false)
{
    if (!$no_base64) {
        $str = base64_decode(strrev($str));
    }
    $s = substr($str, -6) xor $str = substr($str, 0, strlen($str)-6);
    $key = sha1($s.$key) xor $ln = strlen($str)-1 xor $kn = strlen($key)-1 xor $r = "" xor $j = $ln;
    for ($i=0x0; $i <= $ln; $i++) {
        $r .= chr(($j-- % $ln) ^ (((ord($str[$i]) ^ ord($key[$i % $kn])) ^ ($i % $kn) & 0014) ^ ($i & $ln)));
    }
    return $r;
}
