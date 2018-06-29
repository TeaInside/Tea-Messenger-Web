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
		plogin = crt("p"), csrf = crt("input"), valid = crt("input");
		flogin.id = "form"; flogin.action = "javascript:void(0);"; flogin.method = "POST";
		flogin.set('class','form-signin');
			csrf.type = "hidden";
			csrf.value = "";
			csrf.id = "_token";
			valid.type = "hidden";
			valid.value = "";
			valid.id = "_valid";
			flogin.ac(csrf, valid);
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
			plogin.ac(crn("Belum punya akun? "));
			adaftar.href = "#register";
			imgLogin.set('class', 'mb-4');
			imgLogin.set('width', '75');
			imgLogin.set('height', '75');
			imgLogin.src = asset('images/logo.png');
			adaftar.ac(crn("Daftar"));
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
		type: "POST",
		url: config.api_url+"/login.php",
		complete: function (r) {
			ed(0);
			try {
				r = JSON.parse(r.responseText);
				if (r["status"] === "error") {
					al(r["alert"]);
				} else if(r["status"] == "ok") {
					setCookie("login_session", r["credentials"], 14);
					al("Login success!");
				} else {
					al("Unknown response");
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		},
		data: JSON.stringify({
			token: domId("_token").value,
			valid: domId("_valid").value,
			data: {
				username: domId("username").value,
				password: domId("password").value
			}
		})
	});
};

const get_login_token = function () {
	ed(true);
	xhr({
		type: "GET",
		url: config.api_url+"/login.php",
		complete: function (r) {
			try {
				ed(0);
				r = JSON.parse(r.responseText);
				domId("_token").value = r["token"];
				domId("_valid").value = r["valid"];
			} catch (e) {
				al("Error: "+e.message);
			}
		},
		data: ""
	});
};