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
	var a = "hello world";
	var en = encrypt(a, "123");
	var de = decrypt(en, "123");
	document.write(en + "<br>");
	document.write(de);
</script>
</body>
</html>