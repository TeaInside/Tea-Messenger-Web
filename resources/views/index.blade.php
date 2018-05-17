<!DOCTYPE html>
<html>
<head>
	<title>{{ trans("index.welcome") }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/index.css') }}">
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/bootbox.min.js') }}"></script>
</head>
<body>
	<center>
	<div class="container">
		<div class="card card-container">
			<div>
				<h2>Tea Messenger</h2>
				<img class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png"/>
				<p class="profile-name-card"></p>
				<form class="form-signin" action="javascript:void(0);" id="form">
					<span id="reauth-email" class="reauth-email"></span>
					<input type="text" id="username" class="form-control" placeholder="{{ trans('index.username') }}" required autofocus>
					<input type="password" id="password" class="form-control" placeholder="{{ trans('index.password') }}" required>
					<div id="remember" class="checkbox">
						<label>
							<input type="checkbox" value="1" name="remember_me" style="cursor:pointer;"> {{ trans("index.remember_me") }}
						</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">{{ trans("index.login") }}</button>
				</form>
			</div>
			<div>
				<p><a href="#" class="forgot-password">{{ trans("index.forgot_password") }}</a></p>
				<p>{{ trans("index.dont_have_account") }}&nbsp;<a href="#" class="sign-up">Sign Up</a></p>
			</div>
		</div>
	</div>
	</center>
	<script type="text/javascript">
		function al(msg){
			bootbox.alert({
        		message: msg,
        		size: 'small'
    		});
		}
		$("#form").submit(function(fr) {
			var d = {
				"username":$("#username").val(),
				"password":$("#password").val()
			};
			if (d["username"]==""||d["password"]==""||d["password"].length<6) {
				al("Wrong username or password");
				return;
			}
			$.ajax({
				url: "{{ route('login') }}"
			});
		});
	</script>
</body>
</html>

