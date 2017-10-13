<!DOCTYPE html>
<html>
<head>
	<title>Register Tea Messenger</title>
	<script src="<?php print js("base64"); ?>" type="text/javascript"></script>
	<script src="<?php print js("helpers"); ?>" type="text/javascript"></script>
	<script src="<?php print js("IceCrypt"); ?>" type="text/javascript"></script>
	<script src="<?php print js("register"); ?>" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php print css("register"); ?>">
</head>
<body>
	<!-- 
	Informasi :
	1. Penempatan assets
	   CSS 		public/assets/css
	   JS  		public/assets/js
	   Gambar	public/assets/img
	   Lainnya	public/assets/{buat folder sendiri}
	-->
	<center>
	<div id="frcg">
		<form method="post" action="javascript:void(0);" id="fr">
			<table>
				<thead>
					<tr><th colspan="3" align="center">Register Tea Messenger</th></tr>
				</thead>
				<tbody>
					<tr><td>First name</td><td>:</td><td><input type="text" name="fn" id="first_name"></td></tr>
					<tr><td>Last name</td><td>:</td><td><input type="text" name="ln" id="last_name"></td></tr>
					<tr><td>E-Mail</td><td>:</td><td><input type="email" name="e" id="email"></td></tr>
					<tr><td>Phone</td><td>:</td><td><input type="text" name="p" id="phone"></td></tr>
					<tr><td>Gender</td><td>:</td><td>
						<input type="radio" name="g" id="g1" value="male"> Male
						<input type="radio" name="g" id="g2" value="female"> Female
					</td></tr>
				</tbody>
				<thead>
					<tr><th colspan="3" align="center">Create Username</th></tr>
				</thead>
				<tbody>
					<tr><td>Username</td><td>:</td><td><input type="text" name="u" id="username"></td></tr>
					<tr><td>Password</td><td>:</td><td><input type="password" name="p" id="password"></td></tr>
					<tr><td>Confirm Password</td><td>:</td><td><input type="password" name="cp" id="cpassword"></td></tr>
				</tbody>
				<tfoot>
					<tr><td colspan="3" align="center">
						<div>
							<p>Captcha</p>
							<!-- Nantinya disini kita kasih captcha -->
						</div>
					</td></tr>
					<tr><td colspan="3" align="center">
						<button id="sbt">Register</button>
					</td></tr>
				</tfoot>
			</table>
		</form>
	</div>
	</center>
	<script type="text/javascript">
		document.getElementById('fr').addEventListener("submit", function(){
			var q = new register();
			q.getInput();
			if (q.formValidator()) {
				q.buildData();
				q.send("http://api.teainside.dev/register.php", function(res){
					try {
						res = JSON.parse(res);
						if (typeof res['error_message'] == undefined && res['status'] == true) {
							alert(res['message']);
							window.location = res['redirect_to'];
						} else if(typeof res['error_message'] != undefined) {
							alert(res['error_message']);
						} else {
							alert("Unknown error!");
							window.location = "";
						}
					} catch (e) {
						alert("Error : " + e.message);
						window.location = "";
					}
				});
			}
		});
	</script>
</body>
</html>