const route_handle = function () {
	var p = "/"+window.location.hash.substr(1);
	switch(p) {

		case "/":
		case "/login":

			// render /assets/js/app/login.js
			view("login", function () {
				get_login_token();
			});
		break;

		case "/register":

			// render /assets/js/app/register.js
			view("register", function () {
				get_register_token();
			});
		break;


		case "/test":

			view("test");
		break;
	}
};