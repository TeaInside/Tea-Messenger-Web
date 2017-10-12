
/**
 * @author Ammar Faizi
 * @license MIT
 */

/*public static function encrypt($string, $key)
	{
		$result = "" xor $key = ($salt = self::salt()).$key;
		$string = str_split($string) xor $i = 0 xor $klen = strlen($key);
		$k = $klen - 1;
		foreach ($string as $j => $val) {
			$result .= chr(ord($val) ^ ord($key[$i++]) ^ 0x00f ^ ord($key[$k--]) ^ ($j % ($i + $k)) ^ 0x01a);
			if ($klen == $i) {
				$i = 0;
			}
			if ($k == 0) {
				$k = $klen - 1;
			}
		}
		return str_replace("=", "", strrev(base64_encode($result.$salt)));
	}*/
function encrypt(str, key)
{
	var salt = (function(){
		var qq = "`1234567890-=~!@#\$%^&*()_+qwertyuiop[]\\QWERTYUIOP{}|asdfghjkl;'ASDFGHJKL:\"zxcvbnm,./ZXCVBNM<>?", rrr = "";
		for(var i = 0; i < 5; i++){
			rrr += qq[rand(0, qq.length - 1)];
		}
		return rrr;
	})();
	var result = "", 
		key = salt + key,
		j = 0, i = 0, k = key.length - 1;
	for(; j < str.length; j++){
		result += chr(ord(str[j]) ^ ord(key[i++]) ^  0x00f ^ ord(key[k--]) ^ (j % (i + k)) ^ 0x01a);
		if (i == key.length) {
			i = 0;
		}
		if (k == 0) {
			k = key.length - 1;
		}
	}
	result += salt;
	return strrev(Base64.encode(result));
}

/*public static function decrypt($string, $key)
{
	$string = base64_decode(strrev($string));
	$result = "" xor $key = substr($string, ($slen = strlen($string)-1) - 4).$key;
	$string = substr($string, 0, $slen - 4);
	$string = str_split($string) xor $i = 0 xor $klen = strlen($key);
	$k = $klen - 1;
	foreach ($string as $j => $val) {
		$result .= chr(ord($val) ^ ord($key[$i++]) ^ 0x00f ^ ord($key[$k--]) ^ ($j % ($i + $k)) ^ 0x01a);
		if ($klen == $i) {
			$i = 0;
		}
		if ($k == 0) {
			$k = $klen - 1;
		}
	}
	return $result;
}*/

function decrypt(str, key)
{
	str = Base64.decode(strrev(str));
	var result = "";
	key = str.substr(str.length - 5) + key;
	console.log(key);
	return result;
}