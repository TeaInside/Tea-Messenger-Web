<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print isset($title) ? $title : "Tea Messenger"; ?></title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-ice-tea.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
               <div class="login-wall">
				<h2 class="text-center login-tile">Tea Messenger</h2>
                  <div class="col-md-12">
                     <img class="profile-img" src="<?php print asset("assets/img/logo-ice-tea.png"); ?>" alt="">
                     <p class="text-center ice-tea">Sign in</p>
                  </div>
                  <form method="post" action="javascript:void(0);" id="form-login" class="form-horizontal form-signin">
			         <div class="form-group">
				        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
			         </div>
			         <div class="form-group">
				        <input type="password" name="username" id="password" class="form-control" placeholder="Password">
			         </div>
			         <div class="form-group">
				        <div id="csrf_field">
				        </div>
				        <input type="submit" name="submit" value="Sign In" class="btn btn-lg btn-primary btn-block">
			         </div>
                     <p class="text-center">
			            <a href="{{'fer'}}"></a><a href="{{'forgot'}}">Forgot Password</a>
						<br>
						<span>
							Need an account? <a href="/register">Sign up.</a>
						</span>
                     </p>
		          </form>
               </div>
            </div>
		</div>
   </div>
<script type="text/javascript">
	/*function buildContext(){
		var u = document.getElementById("username").value,
			p =	document.getElementById("password").value
			c = document.getElementById("_csrf").value,
			k = document.getElementById("_key").value;
		if (u == "") {
			alert("Empty username!");
			return false;
		}
		if (p == "") {
			alert("Empty password!");
			return false;
		}
		if (c == "") {
			alert("Empty csrf!");
			window.location = "";
			return false;
		}
		if (k == "") {
			alert("Empty key!");
			window.location = "";
			return false;
		}
		return JSON.stringify({
			"username":u,
			"password":p,
			"_csrf":c,
			"_key":k
		});
	}
	window.onload = function(){
		var a = new XMLHttpRequest();
		a.open("GET", "<?php print env("API_URL"); ?>/login.php");
		a.onreadystatechange = function(){
			if (this.readyState === 4) {
				try	{
					var a = JSON.parse(this.responseText);
					document.getElementById('csrf_field').innerHTML = '<input type="hidden" name="_csrf" id="_csrf" value="'+a['csrf']+'"><input type="hidden" name="_key" id="_key" value="'+a['key']+'">';
				} catch (e) {
					alert(e.getMessage);
				}
			}
		};
		a.send(null);
	};
	document.getElementById('form-login').addEventListener("submit", function(){
		var context = buildContext();
		if (context !== false) {
			var a = new XMLHttpRequest();
			a.open("POST", "<?php print env("API_URL"); ?>/login.php");
			a.onreadystatechange = function(){

			};
			a.send(context);
		}
	});*/
</script>
</body>
</html>