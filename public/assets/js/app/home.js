
delete home;
/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class home extends Component
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
			rsi = crt("h2"),
			rdx = crt("div"),
			r8 = crt("img"),
			r9 = crt("div"),
			r10 = crt("table"), r11, r12, r13, r14, r15,
			rbp = {
				"First Name": "first_name",
				"Last Name": "last_name",
				"Email": "email",
				"Phone": "phone",
				"Registered At": "registered_at"
			};
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
		rsi.id = "hll";
		rdi.ac(rsi, rdx, r9);
		rdi.id = "caged";
		rax.ac(rdi);

		return (
			rax.el
		);
	}
}

const usrTkn = localStorage.getItem("token_session");

const get_user_info = function () {
	xhr({
		before_send: function (ch) {
			ch.setRequestHeader("Authorization", "Bearer "+usrTkn);
		},
		type: "GET",
		url: config.api_url+"/home.php?action=get_user_info",
		complete: function (r) {
			try {
				r = JSON.parse(r.responseText);
				if (r["status"] === "success") {
					r = r["data"];
					domId("hll").innerHTML = "Hello "+r["first_name"]+" "+r["last_name"]+"!";
					var i, rbp = ["first_name","last_name","email","phone","registered_at"];
					for (i in rbp) {
						domId(rbp[i]).innerHTML = r[rbp[i]];
					}
				} else {
					localStorage.removeItem("token_session");
					reroute("login");
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		}
	});
};
