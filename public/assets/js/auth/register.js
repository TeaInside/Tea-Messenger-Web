class register
{
	constructor(to)
	{
		this.to = to;
	}
	listen()
	{
		var that = this;
		domId('form-register').addEventListener("submit", function () {
			var context = that.buildContext();
			if (context !== false) {
				that.action(context);
			}
		});
	}
	action(dt){
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					alert(this.responseText);
				}
			};
			ch.open("POST", this.to);
			ch.send(dt);
			alert(123);
	}
	buildContext()
	{
		var q = {
			"first_name": domId('fn').value,
			"last_name": domId('ln').value,
			"email": domId('email').value,
			"username": domId('uname').value,
			"password": domId('pass').value,
			"cpassword": domId('cpass').value
		};
		if (q['password']!==q['cpassword']) {
			alert("Confirm password does not match!");
			return false;
		}		
	}
}