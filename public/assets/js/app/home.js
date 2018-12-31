
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
	}
	render() {
		var 
			rax = crt("center"),
			rdi = crt("div"), 
			rsi = crt("h2"), rdx, r8, r9, r10, r11, r12, r13, r14, r15;

		rsi.id = "hll";
		rdi.ac(rsi);
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
				al(r.responseText);
				r = JSON.parse(r.responseText);
				domId();
				if (r["status"] !== "success") {
					localStorage.removeItem("token_session");
					reroute("login");
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		}
	});
};
