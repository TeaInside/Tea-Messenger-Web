
/**
 * @author Ammar Faizi
 * @license MIT
 */

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
		j = 0, i = 0;
	for(; j < str.length; j++){
		result += chr(ord(str[j]) ^ ord(key[i++]) ^ 1);
		if (i == key.length-1) {
			i = 0;
		}
	}
	result += salt;
	return strrev(Base64.encode(result));
}


function decrypt(str, key)
{
	str = Base64.decode(strrev(str));
	key = str.substr(str.length - 5) + key;
	str = str.substr(0, str.length - 5);
	var result = "", j = 0, i = 0;
	for(; j < str.length; j++){
		result += chr(ord(str[j]) ^ ord(key[i++]) ^ 1);
		if (i == key.length-1) {
			i = 0;
		}
	}
	return result;
}