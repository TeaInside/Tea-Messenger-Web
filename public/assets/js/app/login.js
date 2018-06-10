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
		loadCss("/assets/css/login.css");
	}
	render() {
		var a = crt("center"), b = crt("div"), c = crt("form"), d = crt("label"),
		e = crt("input"), f = crt("label"), g = crt("input"), h = crt("button"),
		i = crt("h1"), j = crt("a");
		c.id = "form"; c.action = "javascript:void(0);"; c.method = "POST";
			i.ac(crn("Login Tea Inside"));
			d.ac(crn("Username: "));
				e.id = "username";
				e.name = "username";
				e.type = "text";
				e.required = "";
			f.ac(crn("Password: "));
				g.id = "password";
				g.name = "password";
				g.type = "password";
				g.required = "";
			h.ac(crn("Login"));
				h.id = "btn";
				h.type = "submit";
		c.ac(i, d, br(), e, br(2), f, br(), g, br(2), h);
		b.set("class", "cage");
		b.ac(c);
		a.ac(b);
		return (
			a.el
		);
	}
}
