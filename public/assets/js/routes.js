const route_handle = function () {
	var p = "/"+window.location.hash.substr(1);
	switch(p) {

		case "/":
		case "/login":

			// render /assets/js/app/login.js

			if (localStorage.getItem("token_session")) {
				reroute("home");
			} else {
				view("login", function () {
					if (localStorage.getItem("token_session")) {
						reroute("home");
					} else {
						get_login_token();
					}
				});
			}
		break;

		case "/register":

			// render /assets/js/app/register.js
			view("register", function () {
				get_register_token();
			});
		break;

		case "/home":
			view("home", function () {
				get_user_info();
			});
		break;

		case "/test":

			view("test");
		break;
	}
};