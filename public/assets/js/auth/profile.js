class profile
{
	constructor(url)
	{
		this.url = url;
	}
	saveChange()
	{
		var context = this.buildContext();
		if (context !== false) {
			this.changeInfo(context);
		}
	}
	buildContext()
	{
		var rq = {
			"first_name": domId('fn').value,
			"last_name": domId('ln').value,
			"username": domId('uname').value,
			"email": domId('email').value,
			"csrf": domId('_csrf').value,
			"cost": domId('cost').value
		};
		if (rq['first_name']=="") {alert("Empty first name!"); return false}
		if (rq['username']=="") {alert("Empty username!");return false;}
		if (rq['email']=="") {alert("Empty email!");return false}
		return JSON.stringify(rq);
	}
	changeInfo(dt)
	{
		this.disableForm();
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try	{
						var a = JSON.parse(this.responseText);
						if (a['message']!==null) {alert(a['message']);}
						if (a['redirect']!==null) {window.location=a['redirect']} else {
							that.enableForm();
						}
					} catch (e) {
						alert(this.responseText);
					}
				}
			}
			ch.withCredentials = true;
			ch.open("POST", "/profile/change_info");
			ch.send(dt);
	}
	disableForm()
	{
		var x, d = ['fn','ln','uname','email'];
		for (x in d) domId(d[x]).disabled = 1;
	}
	enableForm()
	{
		var x, d = ['fn','ln','uname','email'];
		for (x in d) domId(d[x]).disabled = '';
	}
}