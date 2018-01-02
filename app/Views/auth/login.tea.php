<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="Tea Messenger">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta property="og:site_name" content="Tea Messenger">
    <meta property="og:url" content="https://messenger.teainside.ga">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="{{ asset('assets/img/logo-ice-tea.png') }}">
    <meta property="og:description" content="Tea Messenger, encrypted chat for everyone.">
    <meta property="og:image:secure_url" content="{{ asset('assets/img/logo-ice-tea.png') }}">
	<title>Tea Messenger</title>
	<link rel="shortcut icon" href="{{ asset('assets/img/logo-ice-tea.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/authmain.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/login.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/cookies.js') }}"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
				<div class="login-wall">
					<h3 class="text-center login-title">Tea Messenger</h3>
					<div class="col-md-12">
						<img class="profile-img" src="{{ asset('assets/img/logo-ice-tea.png') }}" alt="Tea Messenger">
                 		<p class="text-center ice-tea">Sign in</p>
					</div>
					<form method="post" action="javascript:void(0);" id="form-login" class="form-horizontal form-signin">
						<div class="form-group"><input type="text" name="username" id="uname" class="form-control" placeholder="Username" required></div>
						<div class="form-group"><input type="password" name="username" id="pass" class="form-control" placeholder="Password" required></div>
						<div class="form-group"><input type="submit" name="submit" value="Sign In" class="btn btn-lg btn-primary btn-block"></div>
						<div>
							<input type="hidden" name="_csrf" value="{{ $that->csrf_token() }}" id="csrf">
							<input type="hidden" name="cost" value="{{ rstr(32) }}" id="cost">
						</div>
						<p class="text-center">
							<a href="{{ route('forgot-password') }}">Forgot Password</a><br>
							<span>Need an account? <a href="{{ route('register') }}">Sign up.</a></span>
                     	</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var lg = new login("/login");
			lg.listen();
	</script>
</body>
</html>
 
