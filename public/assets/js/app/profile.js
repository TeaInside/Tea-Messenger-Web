/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class profile extends Component
{
	constructor(props) {
		super(props);
		setTitle("Tea Messenger");
		loadCss(asset("css/home.css"), 0, 1);
	}
	render() {
		var 
			rax = crt("center"),
			rdi = crt("div"),
			rdx = crt("div"),
			r8 = crt("img"),
			r9 = crt("div"),
			r10 = crt("table"), r11, r12, r13, r14, r15,
			rbp = {
				"First Name": "first_name",
				"Last Name": "last_name",
				"Email": "email",
				"Phone": "phone",
				"Registered Date": "registered_at"
			};
		r15 = crt("div");
		r15.id = "navbar";
		r14 = crt("a");
		r14.set("href", "javascript:movpath('logout');");
		r13 = crt("button").ac(crn("Logout"));
		r13.set("class", "btn btn-danger");
		r15.ac(r14.ac(r13));
		r10.id = "profile_info";
		r12 = crt("tr");
		r11 = crt("td");
		r11.set("colspan", 3);
		r11.set("align","center");
		r10.ac(r12.ac(r11.ac(crt("h4").ac(crn("Profile Info")))));
		for(r11 in rbp) {
			r12 = crt("tr");
			r13 = crt("td");
			r13.id = rbp[r11];
			r12.ac(crt("b").ac(crt("td").ac(crn(r11))), crt("td").ac(crn(":")), r13);
			r10.ac(r12);
		}
		r9.ac(r10);
		r8.src = "";
		r8.id = "uimg";
		rdx.ac(r8);
		rdi.ac(rdx, r9);
		rdi.id = "caged";
		rax.ac(r15, rdi);
		return (
			rax.el
		);
	}
}

const get_user_info = function (id = null) {
	xhr({
		before_send: function (ch) {
			ch.setRequestHeader("Authorization", "Bearer "+localStorage.getItem("token_session"));
		},
		type: "GET",
		url: config.api_url+"/profile.php?action=get_user_info",
		complete: function (r) {
			try {
				r = JSON.parse(r.responseText);
				if (r["status"] === "success") {
					r = r["data"];
					var i, rbp = ["first_name","last_name","email","phone","registered_at"];
					for (i in rbp) {
						domId(rbp[i]).innerHTML = r[rbp[i]];
					}

					if (r["photo"] !== "") {
						domId("uimg").src = r["photo"];
					} else {
						if (r["gender"] === "m") {
							domId("uimg").src = asset("images/default_m_user.png");
						} else {
							domId("uimg").src = asset("images/default_fm_user.png");
						}
					}
				} else {
					localStorage.removeItem("token_session");
					movpath("login");
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		}
	});
};
