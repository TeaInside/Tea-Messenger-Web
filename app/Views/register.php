<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Register Tea Messenger</title>
	<script src="<?php print js("base64"); ?>" type="text/javascript"></script>
	<script src="<?php print js("helpers"); ?>" type="text/javascript"></script>
	<script src="<?php print js("IceCrypt"); ?>" type="text/javascript"></script>
	<script src="<?php print js("register"); ?>" type="text/javascript"></script>
	<script src="<?php print js("jquery"); ?>" type="text/javascript"></script>
	<script src="<?php print js("bootstrap"); ?>" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="<?php print css("bootstrap"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php print css("normalize"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php print css("fontawesome"); ?>">
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
	<!-- <center> -->
	<div class="container">
			<div id="frcg">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<h3 class="panel-title">Register Tea Messenger</h3>
					</div>
					<div class="panel-body">
						<form method="post" action="javascript:void(0);" id="fr">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw">FN</i></span>
								<input class="form-control" type="text" name="fn" id="first_name" placeholder="First Name">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw">LN</i></span>
								<input class="form-control" type="text" name="ln" id="last_name" placeholder="Last Name">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
								<input class="form-control" type="email" name="e" id="email" placeholder="E-Mail">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
								<input class="form-control" type="text" name="p" id="phone" placeholder="Phone Number">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-venus-mars"></i></span>
								<select class="form-control" style="font-family: 'FontAwesome', Helvetica;" id="g">
									<option name="g" id="g1" value="male">&#xf221; Male</option>
									<option name="g" id="g2" value="female">&#xf222; Female</option>
								</select>
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
								<input class="form-control" type="text" name="u" id="username" placeholder="Username">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
								<input class="form-control" type="password" name="p" id="password" placeholder="Password">
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
								<input class="form-control" type="password" name="cp" id="cpassword" placeholder="Confirm Password">
							</div>
							<!-- captcha ini cuma mockup -->
							<img src="https://i.amz.mshcdn.com/5mfJr_n0-7H7kquE4C89u2ffiPg=/1200x627/2013%2F04%2F18%2F70%2Fcaptcha.ba000.jpg" class="img-responsive center-block" alt="Image" style="width:250px;padding:1em 0 1em 0;">							
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-check"></i></span>
								<input class="form-control" placeholder="Captcha">
							</div>
							<input type="submit" value="Sign Up" class="btn btn-primary btn-login" id="sbt"/>
						</form>
					</div>
				</div>
			</div>
	</div>
	<!-- </center> -->
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