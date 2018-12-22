/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class register extends Component
{
	constructor(props) {
		super(props);
		setTitle("Register Tea Messenger");
		loadCss(asset("css/register.css"), 0, 1);
	}
	render() {
		var a = crt("center"), div = crt("div"), form = crt("form"),
			table = crt("table"), tbody = crt("tbody"),
			h11 = crt("h3"), h12 = crt("h3"), div3 = crt("div"),
			tbody1 = crt("tbody"), tbody2 = crt("tbody"), head1 = crt("thead"),
			tr1 = crt("tr"), tr2 = crt("tr"), td1 = crt("td"), td2 = crt("td"),
			tr3 = crt("tr"), td3 = crt("td"), tkn = crt("input"), rlc = crt("button"),
			div2 = crt("div"), btn = crt("button"), p = crt("p"), ah = crt("a"),
			captcha = crt("img"), tdd = crt("td"), P = "**********************", r9,
			col1 = {
				"First Name": ["First Name", "text", "first_name"],
				"Last Name": ["Last Name", "text", "last_name"],
				"Email": ["user@example.com", "email", "email"],
				"Phone": ["+6285123456789", "text", "phone"],
				"Password": [P, "password", "password"],
				"Confirm Password": [P, "password", "cpassword"]
			},
			col2 = {
				/*"Username": ["Username", "username", "username"],
				"Password": [P, "password", "password"],
				"Ketik Ulang Password": [P, "password", "cpassword"]*/
			}, ii, tmp = [];
			for(ii in col1) {
				if (ii === "Email") {
					r9 = {
						a: crt("tr"),
						b: crt("td"),
						c: crt("td"),
						d: crt("td"),
						e: crt("select")
					};
					r9.b.ac(crn("Gender"));
					r9.c.ac(crn(":"));
					r9.d.ac(r9.e);
					r9.a.ac(r9.b,r9.c,r9.d);
					tbody1.ac(r9.a);
					P = crt("option");
					P.set("value", "");
					r9.e.ac(P);
					P = crt("option");
					P.set("value", "male");
					P.ac(crn("Male"));
					r9.e.ac(P);
					P = crt("option");
					P.set("value", "female");
					P.ac(crn("Female"));
					r9.e.ac(P);
					r9.e.set("required", 1);
					r9.e.set("id", "gender");
				}
				tmp = {
					"tr": crt("tr"),
					"d1": crt("td"),
					"d2": crt("td"),
					"d3": crt("td"),
					"in": crt("input")
				};
				if (ii !== "Last Name") {
					tmp.in.required = "";
				}
				tmp.in.placeholder = col1[ii][0];
				tmp.in.type = col1[ii][1];
				tmp.in.id = col1[ii][2];
				tmp.in.required = "";
				tmp.d1.ac(crn(ii));
				tmp.d2.ac(crn(":"));
				tmp.d3.ac(tmp.in);
				tmp.tr.ac(tmp.d1, tmp.d2, tmp.d3);
				tbody1.ac(tmp.tr);
			}
			tmp = crt("tr");
			rlc.set("type", "button");
			rlc.set("id", "reload_captcha");
			rlc.set("class", "btn btn-primary");
			rlc.set("onclick", "get_register_token();");
			rlc.ac(crn("Reload Captcha"));
			tdd.set("colspan", 3);
			tdd.set("align", "center");
			tdd.ac(rlc);
			tmp.ac(tdd);
			tbody2.ac(tmp);
			tdd = crt("td");
			tmp = crt("tr");
			tdd.set("colspan", 3);
			tdd.set("align", "center");
			captcha.set("id", "captcha_image");
			tdd.ac(captcha);
			tmp.ac(tdd);
			tbody2.ac(tmp);
			tmp = crt("tr");
			tdd = crt("td");
			tdd.set("align", "center");
			tdd.set("colspan", 3);
			tdd.ac(crn("Enter the captcha: "));
			tmp.ac(tdd);
			tbody2.ac(tmp);
			tmp = crt("tr");
			tdd = crt("td");
			r9 = crt("input");
			r9.set("type", "text");
			r9.set("id", "captcha_input");
			r9.set("size", 10);
			r9.set("required", 1);
			tdd.ac(r9);
			tdd.set("align", "center");
			tdd.set("colspan", 3);
			tmp.ac(tdd);
			tbody2.ac(tmp);
			btn.type = "submit";
			btn.set("class", "btn btn-primary");
			btn.ac(crn("Submit"));
			div2.set("class", "btnhd");
			div2.ac(btn);
			p.ac(crn("Already have an account? "));
			ah.ac(crn("Login"));
			ah.href = "#login";
			p.ac(ah);
			div3.set("class", "lg");
			div3.ac(p);
			td3.ac(div2);
			td3.ac(div3);
			td3.set("colspan", "3");
			td3.set("align", "center");
			tr3.ac(td3);
			tbody2.ac(tr3);
			h11.ac(crn("Register Tea Messenger"));
			td1.ac(h11);
			td1.set("colspan", "3");
			td1.set("align", "center");
			tr1.ac(td1);
			h12.ac(crn("Buat Akun Tea Messenger"));
			td2.ac(h12);
			td2.set("colspan", "3");
			td2.set("align", "center");
			tr2.ac(td2);
			head1.ac(tr1);
			table.ac(head1, tbody1, tbody2);
			form.action = "javascript:void(0);";
			form.id = "form";
			form.method = "POST";
			form.set("onsubmit", "submit_register();");
			tkn.id = "_token";
			tkn.name = "_token";
			tkn.value = "";
			tkn.type = "hidden";
			form.ac(tkn, table);
			div.ac(form);
			div.set("class", "cage");
			a.ac(div);
		return (a.el);
	}
}

const submit_register = function () {
	ed(true);
	xhr({
		before_send: function (ch) {
			ch.setRequestHeader("Authorization", "Bearer "+domId("_token").value);
		},
		type: "POST",
		url: config.api_url+"/register.php?action=submit",
		complete: function (r) {
			ed(0);
			try {
				r = JSON.parse(r.responseText);
				if (r["status"] === "error") {
					get_register_token();
					domId("captcha_input").value = "";
					al(r["data"]["message"]);
				} else {
					if (r["data"]["message"] === "register_success") {
						reroute("login");
					} else {
						get_register_token();
						domId("captcha_input").value = "";
					}
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		},
		data: JSON.stringify({
			first_name: domId("first_name").value,
			last_name: domId("last_name").value,
			gender: domId("gender").value,
			email: domId("email").value,
			phone: domId("phone").value,
			password: domId("password").value,
			cpassword: domId("cpassword").value,
			captcha: domId("captcha_input").value
		})
	});
};

const get_register_token = function () {
	domId("captcha_image").src = "";
	ed(true);
	xhr({
		type: "GET",
		url: config.api_url+"/register.php?action=get_token",
		complete: function (r) {
			try {
				ed(0);
				r = JSON.parse(r.responseText);
				domId("_token").value = r["data"]["token"];
				domId("captcha_image").src = config.api_url+"/captcha.php?token="+encodeURIComponent(r["data"]["token"]);
			} catch (e) {
				al("Error: "+e.message);
			}
		},
		data: ""
	});
};