
/**
 * @author Ammar Faizi
 * @license MIT
 */

function encrypt(str, key)
{
	salt = (function(){
		_ = "`1234567890-=~!@#\$%^&*()_+qwertyuiop[]\\QWERTYUIOP{}|asdfghjkl;'ASDFGHJKL:\"zxcvbnm,./ZXCVBNM<>?", __ = 0,r="";
		for(; __ < 5; __++) r+= _[rand(0,_.length)];
		return r;
	})();
	key = salt + key;
	var j = 0, i = 0, k = key.length - 1, result = "";
	for(; j < str.length; j++) {
		result += chr(ord(str[j]) ^ ord(key[i++]) ^ 15 ^ ord(key[k--]) ^ (j % (i+k)) ^ 26);
		if (i == key.length) {
			i = 0;
		}
		if (k == 0) {
			k = key.length - 1;
		}
	}
	return strrev(Base64.encode(result + salt));
}

function decrypt(str, key)
{
	str = Base64.decode(strrev(str));
	key    = str.substr(str.length - 5) + key;
	str	   = str.substr(0, str.length - 5);
	var	result = "",
		i = 0,j = 0,s = key.length, k = s - 1;
	for(; j < str.length; j++) {
		result += chr(ord(str[j]) ^ ord(key[i++]) ^ 15 ^ ord(key[k--]) ^ (j % (i+k)) ^ 26);
		if (i == s) {
			i = 0;
		}
		if (k == 0) {
			k = s -1;
		}
	}
	return result;
}