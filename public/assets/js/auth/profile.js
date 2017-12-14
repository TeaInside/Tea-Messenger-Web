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
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					alert(this.responseText);
				}
			}
			ch.withCredentials = true;
			ch.open("POST", "/profile/change_info");
			ch.send(dt);
	}
}