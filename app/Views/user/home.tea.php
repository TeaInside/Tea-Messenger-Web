<!DOCTYPE html>
<html>
<head>
	<title>Welcome, {{ $info['first_name'] }}!</title>
	<style type="text/css">
		h1 {
			font-family: Helvetica;
		}
	</style>
</head>
<body>
<center>
	<h1>Welcome to Tea Messenger</h1>
	<a href="{{ route('profile') }}"><h2>Profile</h2></a>
	<a href="{{ route('chat') }}"><h2>Chat</h2></a>
	<a href="{{ route('logout') }}"><h2>Logout</h2></a>
</center>
</body>
</html>