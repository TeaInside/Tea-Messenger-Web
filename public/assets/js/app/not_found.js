/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class not_found extends Component
{
	constructor(props) {
		super(props);
		setTitle("Not Found");
		loadCss(asset("css/not_found.css"), 0, 1);
	}

	render() {
		var rax = crt("center"),
			rdx = crt("div"),
			rdi = crt("div"),
			r9 = crt("a"),
			r10 = crt("button"),
			rsi = crt("h1").ac(crn("404 Not Found"));

		r10.ac(crn("Back to home"));
		r10.set("class", "btn btn-primary");
		r9.set("href", "#home");
		rdi.ac(r9.ac(r10));
		rdi.id = "dfd";
		rdx.id = "fcg";
		rax.ac(rdi, rdx.ac(rsi));

		return (
			rax.el
		);
	}
}
