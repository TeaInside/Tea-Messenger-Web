<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript">
	</script>
	<script src="<?php print js("base64"); ?>" type="text/javascript"></script>
	<script src="<?php print js("helpers"); ?>" type="text/javascript"></script>
	<script src="<?php print js("IceCrypt"); ?>" type="text/javascript"></script>
</head>
<body>
<script type="text/javascript">
	var a = encrypt('{"first_name":"Ammar","last_name":"Faizi","email":"ammarfaizi2@gmail.com","phone":"085867152777","gender":"male","username":"ammarfaizi2","password":"123123","cpassword":"123123"}', "123123");
	var b = decrypt(a, "123123");
	console.log(a);
	console.log(b);
</script>
</body>
</html>