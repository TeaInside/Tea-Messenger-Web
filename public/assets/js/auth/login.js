class login
{
	constructor(apiurl)
	{
		this.apiurl = apiurl;
	}
	send()
	{

	}
	listen()
	{
		var that = this;
		domId('form-login').addEventListener('submit', function () {
			var uname = domId('uname').value,
				pass  = domId('pass').value;
			if (uname=="") {alert('Empty username!');return;}
			if (pass=="") {alert('Empty password!');return;}
			that.action(uname,pass);
		});
	}
	action(u,p)
	{
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					alert(this.responseText);
				}
			};
			ch.open("GET", this.apiurl);
			ch.send(null);
	}
} 