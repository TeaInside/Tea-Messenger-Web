
/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */
class register
{
	constructor()
	{
		this.input = null;
		this.data  = null;
		this.validator = {
			"first_name": function(str){
				return true;
			},
			"last_name": function(str){
				return true;
			},
			"email": function(str){
				// HTML auto validator (udah)
				return true;
			},
			"phone": function(str){
				if (str.length < 10 || str.length > 20) {
					alert("Invalid phone number!");
					return false;
				}
				return true;
			},
			"gender": function(str){
				if (str=="male" || str=="female") {
					return true;
				}
				alert("Invalid gender!"); // avoid inspect element 
				return false;
			},
			"username": function(str){
				// validasi username
				/**
				 * 1. Username minimal 4 karakter
				 * 2. Username maksimal 32 karakter
				 * 3. Username hanya boleh terdiri dari karakter A-Z a-z 0-9 dan underscore
				 */
				if(str.length < 4) {
					alert("Username too short, please provide username more than 3 chars!");
					return false;
				}
				if(str.length > 32) {
					alert("Username too long, please provide username not more than 32 chars!");
					return false;
				}
				if(!str.match(/^[a-zA-Z0-9_]+$/)){
					alert("Username can only contains alphanumeric and underscores");
					return false;
				}


				return true;
			},
			"password": function(str){
				// validasi password
				/**
				 * 1. Password minimal 6 karakter
				 * 2. Password maksimal tidak dibatasi
				 * 3. Password hanya boleh terdiri dari printable chars ASCII (32 - 127)
				 *
				 * Hint no 3 :
				 * cek public/assets/js/helpers.js
				 */
				// alert("Password too short, please provide password more than 5 digit chars!");
				// alert("Invalid password, non printable chars are not allowed!");
				if(str.length < 6) {
					alert("Password too short, please provide password more than 5 digit chars!");
					return false;
				}
				var arr= str.split("");
				for (let i=0; i<arr.length; i++) {
					if(ord(arr[i]) < 32 || ord(arr[i]) > 127){
						alert("Invalid password, non printable chars are not allowed!");
						return false;
					}
				}

				return true;
			},
			"cpassword": function(str){
				// special validator
				/**
				 * Karena di javascript pada closurenya mereferensikan var `this` pada closure itu sendiri, 
				 * maka kita tidak bisa menggunakan instance class register dengan var `this`.
				 * Karena itu kita diharuskan melakukan instansiasi class register pada self class.
				 * Hal ini tentunya akan boros memory. Maka khusus input cpassword kita perlakukan spesial.
				 * Validator input cpassword ada di method register.formValidator
				 */
				return true;		
			}
		};
	}

	gv(id){
		return document.getElementById(id).value;
	}

	getInput()
	{
		this.input = {
			"first_name": 	this.gv("first_name"), 
			"last_name": 	this.gv("last_name"), 
			"email": 		this.gv("email"), 
			"phone":		this.gv("phone"),
			"gender":		(function(){
								return document.getElementById("g").options[document.getElementById("g").selectedIndex].value;
							})(),
			"username":		this.gv("username"),
			"password":		this.gv("password"),
			"cpassword":	this.gv("cpassword")
		};
		console.log(this.input['gender']);
	}

	formValidator()
	{
		var g;
		for(g in this.validator) {
			if(! this.validator[g](this.input[g])) {
				return false;
			}
		}
		if (this.input['cpassword'] != this.input['password']) {
			alert("Password does not match the confirm password!");
			return false;
		}
		return true;
	}

	buildData()
	{
		this.data = JSON.stringify({
			"key_build": encrypt("icetea", "teainside"),
			"data": encrypt(JSON.stringify(this.input), "icetea")
		});
	}

	send(url, closure)
	{
		var a = new XMLHttpRequest();
		a.open("POST", url, true);
		a.onreadystatechange = function(){
			if (this.readyState == 4) {
				closure(this.responseText);
			}
		};
		a.send(this.data);
	}
}
