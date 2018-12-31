/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class login extends Component
{
	constructor(props) {
		super(props);
		setTitle("Login");
		loadCss(asset("css/login.css"), 0, 1);
	}
	render() {
		var dlogin = crt("div"), flogin = crt("form"), imgLogin = crt('img'),
		luser = crt("label"), iuser = crt("input"), lpass = crt("label"), ipass = crt("input"), 
		blogin = crt("button"), hlogin = crt("h3"), adaftar = crt("a"), dcoment = crt("div"), 
		plogin = crt("p"), csrf = crt("input");
		flogin.id = "form"; flogin.action = "javascript:void(0);"; flogin.method = "POST";
		flogin.set('class','form-signin');
			csrf.type = "hidden";
			csrf.value = "";
			csrf.id = "_token";
			flogin.ac(csrf);
			flogin.set("onsubmit", "submit_login();");
			hlogin.ac(crn("Login Tea Messenger"));
			hlogin.set('class', 'h3 mb-3 font-weight-normal')
			luser.set('class', 'sr-only')
			luser.ac(crn("Username: "));
				iuser.set("class","form-control");
				iuser.id = "username";
				iuser.name = "username";
				iuser.type = "text";
				iuser.required = "";
				iuser.placeholder = "Username...";
			lpass.set('class', 'sr-only')
			lpass.ac(crn("Password: "));
				ipass.set("class","form-control");
				ipass.id = "password";
				ipass.name = "password";
				ipass.type = "password";
				ipass.required = "";
				ipass.placeholder = "Password...";
			blogin.ac(crn("Login"));
				blogin.id = "btn";
				blogin.set("class", "btn btn-primary btn-block");
				blogin.type = "submit";
			plogin.set("class", "pp");
			plogin.ac(crn("Don't have an account? "));
			adaftar.href = "#register";
			imgLogin.set('class', 'mb-4');
			imgLogin.set('width', '150');
			imgLogin.set('height', '150');
			imgLogin.set("style", "border-radius:100%");
			imgLogin.src = asset('images/hg2.jpg');
			adaftar.ac(crn("Register"));
			dcoment.set("class", "cm");
			dlogin.set('class', 'login-wall')
			plogin.ac(adaftar); dcoment.ac(plogin);
		flogin.ac(hlogin, luser, iuser, lpass, br(), ipass, blogin, br(), dcoment);
		dlogin.ac(imgLogin, flogin);
		return (
			dlogin.el
		);
	}
}


const submit_login = function () {
	ed(true);
	xhr({
		before_send: function (ch) {
			ch.setRequestHeader("Authorization", "Bearer "+domId("_token").value);
		},
		type: "POST",
		url: config.api_url+"/login.php?action=login",
		complete: function (r) {
			try {
				r = JSON.parse(r.responseText);
				if (r["data"]["message"]["state"] === "login_success") {
					localStorage.setItem("token_session", r["data"]["message"]["token_session"]);
					reroute("home");
				} else {
					al(r["data"]["message"]["state"]);
					get_login_token();
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		},
		data: JSON.stringify({
			username: domId("username").value,
			password: domId("password").value
		})
	});
};

const get_login_token = function () {

	if (localStorage.getItem("token_session")) {
		reroute("home");
	} else {
		ed(true);
		xhr({
			type: "GET",
			url: config.api_url+"/login.php?action=get_token",
			complete: function (r) {
				try {
					ed(0);
					r = JSON.parse(r.responseText);
					domId("_token").value = r["data"]["token"];
				} catch (e) {
					al("Error: "+e.message);
				}
			},
			data: ""
		});
	}
};