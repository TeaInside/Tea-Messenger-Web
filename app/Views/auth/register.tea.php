<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta property="og:type" content="website">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta property="og:site_name" content="Tea Messenger">
    <meta property="og:title" content="Register Tea Messenger">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta property="og:url" content="https://messenger.teainside.ga/register">
	<meta property="og:image" content="{{ asset('assets/img/logo-ice-tea.png') }}">
    <meta property="og:description" content="Tea Messenger, encrypted chat for everyone.">
    <meta property="og:image:secure_url" content="{{ asset('assets/img/logo-ice-tea.png') }}">
    <title>Register Tea Messenger</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-ice-tea.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/authmain.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/auth/register.js') }}"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-4 col-md-offset-4">
				<div class="login-wall">
					<h2 class="text-center login-tile">Register Tea Messenger</h2>
					<div class="col-md-12">
					</div>
					<form method="post" action="javascript:void(0);" id="form-register" class="form-horizontal form-signin">
						<div class="form-group"><input type="text" name="first_name" id="fn" class="form-control" placeholder="First name"></div>
						<div class="form-group"><input type="text" name="last_name" id="ln" class="form-control" placeholder="Last name"></div>
						<div class="form-group"><input type="email" name="email" id="email" class="form-control" placeholder="E-Mail"></div>
						<div class="form-group"><input type="text" name="username" id="uname" class="form-control" placeholder="Username"></div>
						<div class="form-group"><input type="password" name="password" id="pass" class="form-control" placeholder="Password"></div>
						<div class="form-group"><input type="password" name="cpassword" id="cpass" class="form-control" placeholder="Confirm password"></div>
						<div class="form-group" style="margin-top:5%;">
							<input type="submit" name="submit" value="Sign Up" class="btn btn-lg btn-primary btn-block">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var rg = new register("/register/success");
			rg.listen();
	</script>
</body>
</html>
