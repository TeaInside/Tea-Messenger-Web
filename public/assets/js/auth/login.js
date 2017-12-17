class login
{
	constructor(apiurl)
	{
		this.apiurl = apiurl;
	}
	listen()
	{
		var that = this;
		domId('form-login').addEventListener('submit', function () {
			var context = that.buildContext();
			if (context !== false) {
				that.action(context);
			}
		});
	}
	action(dt)
	{
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try	{
						var a = JSON.parse(this.responseText);
						if (a['message']!==null) {alert(a['message'])}
						if (a['redirect']!==null) {window.location=a['redirect']}
					} catch (e) {
						alert(this.responseText);
					}
				}
			};
			ch.withCredentials = true;
			ch.open("POST", this.apiurl);
			ch.send(dt);
	}
	buildContext()
	{
		var jq = {
			"username": domId('uname').value,
			"password": domId('pass').value,
			"csrf": domId('csrf').value,
			"cost": domId('cost').value
		};
		if (jq['username']=="") {alert("Empty username!");return false}
		if (jq['password']=="") {alert("Empty password!");return false}
		return JSON.stringify(jq);
	}
} 