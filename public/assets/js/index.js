


function login(user, pass, token, callback)
{
	xhr({
		url: "http://api.teainside.local/login.php",
		type: "POST",
		complete: function (a) {
			var status, x;
			a = JSON.parse(a.responseText);
			for(x in a["cookies"]) {
				setCookie(x, a["cookies"][x][0], a["cookies"][x][1]);
			}
			if (typeof a["status"] != "undefined" && a["status"] == "ok") {
				status = true;
			} else {
				status = false;
			}
			callback(status);
		},
		before_send: function (ch) {
			ch.setRequestHeader("Content-Type", "application/json");
		},
		data: JSON.stringify({username: user, password: pass, _token: token})
	});
}

login("ammarfaizi2", "test", "123123", function (status) {
	if (status) {
		alert("Login success!");
	} else {
		alert("Login failed!");
	}
});