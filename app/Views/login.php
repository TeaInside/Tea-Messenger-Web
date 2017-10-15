<!DOCTYPE html>
<html>
<head>
	<title>Tea Messenger - Login</title>
	<script type="text/javascript" src="<?php print js("register"); ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php print css("login"); ?>">
</head>
<body>
<center>
	<div class="fcg">
		<div class="hd">
			<h2>Login Tea Messenger</h2>
		</div>
		<form method="post" action="javascript:void(0);" id="fr">
			<div class="icg">
				<div class="wdg">Username :</div>
				<div><input type="text" name="username" id="username"></div>
			</div>
			<div class="icg">
				<div class="wdg">Password :</div>
				<div><input type="text" name="username" id="password"></div>
			</div>
			<div class="icg">
				<div><input type="submit" name="submit" value="Login"></div>
			</div>
			<a href="/forgot-password">Forgot Password</a>
		</form>
	</div>
</center>
<script type="text/javascript">
	document.getElementById('fr').addEventListener("submit", function(){
		alert("Coming soon!");
	});
</script>
</body>
</html>