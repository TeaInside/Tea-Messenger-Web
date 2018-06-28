/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @version 0.0.1
 * @license MIT
 */
class register extends Component
{
	constructor(props) {
		super(props);
		setTitle("Daftar Tea Messenger");
		loadJs("/assets/js/third_party/bootbox.min.js");
		loadCss("/assets/css/register.css");
	}
	render() {
		var a = crt("center"), div = crt("div"), form = crt("form"),
			table = crt("table"), tbody = crt("tbody"),
			h11 = crt("h3"), h12 = crt("h3"), div3 = crt("div"),
			tbody1 = crt("tbody"), tbody2 = crt("tbody"), head1 = crt("thead"),
			tr1 = crt("tr"), tr2 = crt("tr"), valid = crt("input"),
			td1 = crt("td"), td2 = crt("td"),
			tr3 = crt("tr"), td3 = crt("td"), tkn = crt("input"),
			head2 = crt("thead"), div2 = crt("div"),
			btn = crt("button"), p = crt("p"), ah = crt("a"),
			col1 = {
				"Nama Depan": ["Nama Depan", "text", "first_name"],
				"Nama Belakang": ["Nama Belakang", "text", "last_name"],
				"Email": ["user@example.com", "email", "email"],
				"Nomor HP": ["+6285123456789", "text", "phone"],
			}, P = "**********************",
			col2 = {
				"Username": ["Username", "username", "username"],
				"Password": [P, "password", "password"],
				"Ketik Ulang Password": [P, "password", "cpassword"]
			}, ii, tmp = [];
			for(ii in col1) {
				tmp = {
					"tr": crt("tr"),
					"d1": crt("td"),
					"d2": crt("td"),
					"d3": crt("td"),
					"in": crt("input")
				};
				if (ii !== "Nama Belakang") {
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
			for(ii in col2) {
				tmp = {
					"tr": crt("tr"),
					"d1": crt("td"),
					"d2": crt("td"),
					"d3": crt("td"),
					"in": crt("input")
				};
				tmp.in.required = "";
				tmp.in.placeholder = col2[ii][0];
				tmp.in.type = col2[ii][1];
				tmp.in.id = col2[ii][2];
				tmp.in.required = "";
				tmp.d1.ac(crn(ii));
				tmp.d2.ac(crn(":"));
				tmp.d3.ac(tmp.in);
				tmp.tr.ac(tmp.d1, tmp.d2, tmp.d3);
				tbody2.ac(tmp.tr);
			}
			btn.type = "submit";
			btn.set("class", "btn btn-primary");
			btn.ac(crn("Daftar"));
			div2.set("class", "btnhd");
			div2.ac(btn);
			p.ac(crn("Sudah punya akun? "));
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
			h11.ac(crn("Daftar Tea Messenger"));
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
			head2.ac(tr2);
			table.ac(head1, tbody1, head2, tbody2);
			form.action = "javascript:void(0);";
			form.id = "form";
			form.method = "POST";
			form.set("onsubmit", "submit_register();");
			tkn.id = "_token";
			tkn.name = "_token";
			tkn.value = "";
			tkn.type = "hidden";
			valid.name = "_valid";
			valid.id = "_valid";
			valid.type = "hidden";
			form.ac(tkn, valid, table);
			div.ac(form);
			div.set("class", "cage");
			a.ac(div);
		return (
			a.el
		);
	}
}

const al = function (msg, rr){
	bootbox.alert({
		message: msg,
		size: 'small',
		callback: function() {
			if (typeof rr == "string") {
				rerouting(rr);
			}
		}
	});
};
const submit_register = function () {
	ed(true);
	xhr({
		type: "POST",
		url: config.api_url,
		complete: function (r) {
			ed(0);
			try {
				r = JSON.parse(r.responseText);
				if (r["status"] === "error") {
					al(r["alert"]);
				} else {
					al("Pendaftaran berhasil, silahkan cek email Anda untuk verifikasi!", "login");
				}
			} catch (e) {
				al("Error: "+e.message);
			}
		},
		data: JSON.stringify({
			token: domId("_token").value,
			valid: domId("_valid").value,
			data: {
				first_name: domId("first_name").value,
				last_name: domId("last_name").value,
				phone: domId("phone").value,
				email: domId("email").value,
				username: domId("username").value,
				password: domId("password").value,
				cpassword: domId("cpassword").value
			}
		})
	});
};

const get_token = function () {
	ed(true);
	xhr({
		type: "GET",
		url: "http://api.teainside.local/register.php",
		complete: function (r) {
			ed(0);
			try {
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