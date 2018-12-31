const route_handle = function (me = null, qw = 0) {
	var p = me ? me : window.location.pathname.substr(1);

	if (p === "" || p === "login") {
		if (localStorage.getItem("token_session")) {
			reroute("home");
		} else {
			view("login", function () {
				if (localStorage.getItem("token_session")) {
					movpath("home");
				} else {
					get_login_token();
				}
			});
		}
		return 1;
	}

	if (p === "register") {
		view("register", function () {
			get_register_token();
		});
		return 1;
	}

	if (p === "home" || p.substr(0, 7) === "profile") {
		view("profile", function () {
			get_user_info();
		});
		return 1;
	}

	if (p === "logout") {
		localStorage.removeItem("token_session");
		movpath("login");
		return 1;
	}


	if (qw) {
		return 0;
	}

	if (!route_handle(window.location.hash.substr(1), 1)) {
		view("not_found");
	}
};