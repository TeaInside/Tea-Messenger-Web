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
		loadCss("/assets/css/bootstrap.min.css");
		loadCss("/assets/css/login.css");
	}
	render() {
		var dlogin = crt("div"), flogin = crt("form"), imgLogin = crt('img'),
		luser = crt("label"), iuser = crt("input"), lpass = crt("label"), ipass = crt("input"), 
		blogin = crt("button"), hlogin = crt("h3"), adaftar = crt("a"), dcoment = crt("div"), 
		plogin = crt("p"); 
		flogin.id = "form"; flogin.action = "javascript:void(0);"; flogin.method = "POST";
		flogin.set('class','form-signin');
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
			imgLogin.src ='image.PNG';
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
