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
	<div class="container" style="width:40%;">
			<div id="frcg">
				<div class="panel panel-default">
					<div class="panel-heading text-center">
						<h1 class="panel-title">Register Tea Messenger</h3>
					</div>
					<div class="panel-body">
						<form method="post" action="javascript:void(0);" id="fr">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw">FN</i></span>
								<input class="form-control" type="text" name="fn" id="first_name" placeholder="First Name" required>
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw">LN</i></span>
								<input class="form-control" type="text" name="ln" id="last_name" placeholder="Last Name" required>
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-envelope"></i></span>
								<input class="form-control" type="email" name="e" id="email" placeholder="E-Mail" required>
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-phone"></i></span>
								<input class="form-control" type="text" name="p" id="phone" placeholder="Phone Number" required>
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-venus-mars"></i></span>
								<select class="form-control" style="font-family: 'FontAwesome', Helvetica;" id="g" required>
									<option value="">Choose</option>
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
								<input class="form-control" type="password" name="p" id="password" placeholder="Password" required>
							</div>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
								<input class="form-control" type="password" name="cp" id="cpassword" placeholder="Confirm Password" required>
							</div>
							<!-- captcha ini cuma mockup -->
							<img src="https://i.amz.mshcdn.com/5mfJr_n0-7H7kquE4C89u2ffiPg=/1200x627/2013%2F04%2F18%2F70%2Fcaptcha.ba000.jpg" class="img-responsive center-block" alt="Image" style="width:250px;padding:1em 0 1em 0;">							
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-fw fa-check"></i></span>
								<input class="form-control" placeholder="Captcha">
							</div>
							<div id="csrf_field"></div>
							<input type="submit" value="Sign Up" class="btn btn-primary btn-login" id="sbt"/>
							<span>
								<center> Already have account ? <a href="./">Sign in</a>. </center>
							</span>
						</form>
					</div>
				</div>
			</div>
	</div>
	<!-- </center> -->
	<script type="text/javascript">
		var wq = new XMLHttpRequest();
		wq.onreadystatechange = function(){
			if (this.readyState == 4) {
				try {
					var wd = JSON.parse(this.responseText);
					document.getElementById("csrf_field").innerHTML += '<input type="hidden" name="_csrf" value="' + wd['csrf'] + '" id="csrf">' + "\n" + '<input type="hidden" name="_valid_compare" value="' + wd['v_compare'] + '" id="validator">';
				} catch (e) {
					alert("Error CSRF : " + e.message);
					window.location = "";
				}
			}
		}
		wq.open("GET", "<?php print API_URL; ?>/csrf.php");
		wq.send(null);
		document.getElementById('fr').addEventListener("submit", function(){
			var q = new register();
			q.getInput();
			if (q.formValidator()) {
				q.buildData();
				q.send("<?php print API_URL; ?>/register.php", function(res){
					console.log(res);
				});
			}
		});
	</script>
</body>
</html>