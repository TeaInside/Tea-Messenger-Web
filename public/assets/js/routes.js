const route_handle = function () {
	var p = window.location.hash.substr(1);

	if (p === "" || p === "login") {
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
		return;
	}

	if (p === "register") {
		view("register", function () {
			get_register_token();
		});
		return;
	}

	if (p === "home" || p.substr(0, 8) === "profile") {
		view("profile", function () {
			get_user_info();
		});
		return;
	}

	if (p === "logout") {
		localStorage.removeItem("token_session");
		reroute("login");
	}
};