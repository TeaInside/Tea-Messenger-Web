class profile
{
	constructor(url)
	{
		this.url = url;
	}
	saveInfoChange()
	{
		var context = this.buildContext('info');
		if (context !== false) {
			this.changeInfo(context);
		}
	}
	savePasswordChange()
	{
		var context = this.buildContext('password');
		if (context !== false) {
			this.changePassword(context);
		}
	}
	buildContext(wqr)
	{
		var rq;
		switch (wqr) {
			case 'info':
				rq = {
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
			case 'password':
				rq = {
					"old_password": domId('old_pwd').value,
					"new_password": domId('new_pwd').value,
					"new_cpassword": domId('new_cpwd').value,
					"csrf": domId('_csrf').value,
					"cost": domId('cost').value
				};
				if (rq['old_password']=="") {alert('Empty old password!');return false;}
				if (rq['new_cpassword']!==rq['new_password']) {alert('Confirm password does not match!');return false;}
				return JSON.stringify(rq);
		}
	}
	changeInfo(dt)
	{
		this.disableInfoForm();
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try	{
						var a = JSON.parse(this.responseText);
						if (a['message']!==null) {alert(a['message']);}
						if (a['redirect']!==null) {window.location=a['redirect']} else {
							that.enableInfoForm();
						}
					} catch (e) {
						alert(this.responseText);
						that.enableInfoForm();
					}
				}
			}
			ch.withCredentials = true;
			ch.open("POST", "/profile/change_info");
			ch.send(dt);
	}
	disableInfoForm()
	{
		var x, d = ['fn','ln','uname','email'];
		for (x in d) domId(d[x]).disabled = 1;
	}
	enableInfoForm()
	{
		var x, d = ['fn','ln','uname','email'];
		for (x in d) domId(d[x]).disabled = '';
	}
	disablePasswordForm()
	{
		var x, d = ['old_pwd','new_pwd','new_cpwd'];
		for (x in d) domId(d[x]).disabled = 1;
	}
	enablePasswordForm()
	{
		var x, d = ['old_pwd','new_pwd','new_cpwd'];
		for (x in d) domId(d[x]).disabled = '';
	}
	changePassword(dt)
	{
		this.disablePasswordForm();
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try	{
						var a = JSON.parse(this.responseText);
						if (a['message']!==null) {alert(a['message']);}
						if (a['redirect']!==null) {window.location=a['redirect']} else {
							that.enablePasswordForm();
						}
					} catch (e) {
						alert(this.responseText);
						that.enablePasswordForm();
					}
				}
			}
			ch.withCredentials = true;
			ch.open("POST", "/profile/change_password");
			ch.send(dt);
	}
}