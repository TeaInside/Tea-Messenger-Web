<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php print isset($title) ? $title : "Tea Messenger"; ?></title>
    <link rel="shortcut icon" href="<?php print asset("assets/img/logo-ice-tea.png"); ?>" />
    <link rel="stylesheet" href="<?php print asset("assets/css/bootstrap.css"); ?>">
    <link rel="stylesheet" type="text/css" href="<?php print asset("assets/css/fontawesome.css"); ?>">
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/login.css")}}">
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
                  	 <div class="form-group">
				        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name">
			         </div>
			         <div class="form-group">
				        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name">
			         </div>
			         <div class="form-group">
				        <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail">
			         </div>
			         <div class="form-group">
				        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
			         </div>
			         <div class="form-group">
				        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
			         </div>
			         <div class="form-group">
				        <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm password">
			         </div>
			         <div id="captcha_field">
			         	<center>
			         		<img src="" height="60" width="150">
			         	</center>
			         </div>
			         <div class="form-group" style="margin-top:5%;">
				        <div id="csrf_field">
				        </div>
				        <input type="submit" name="submit" value="Sign Up" class="btn btn-lg btn-primary btn-block">
			         </div>
                     <!-- <p class="text-center">
			            <a href="/forgotpassword">Forgot Password</a>
						<br>
						<span>
							Need an account? <a href="/register">Sign up.</a>
						</span>
                     </p> -->
		          </form>
               </div>
            </div>
		</div>
   </div>
<script type="text/javascript">
	function buildContext(){
		var l = {
			'first_name': function(a){
				var q = false;
				if (a.length === 0) q = "Empty first name!";
				return q;
			},
			'last_name': function(){return false;},
			'email': function(a){
				var q = "";
				if (a.length === 0) q = "Empty email!";
				return q;
			},
			'username': function(a){
				var q = "";
				if (a.length === 0) q = "Empty username!";
				return q;
			},
			'password':function(a){
				var q = "";
				if (a.length < 6) q = "Password too short, please provide password more than 5 characters";
				return q;
			},
			'cpassword':function(){return false;},
			'_csrf':function(){return false;},
			'_key':function(){return false;}
		}; var v = "", r = "";
		for(x in l) {
			v = document.getElementById(x).value;
			r = l[x](v);
			if (!r) {
				l[x] = v;
			} else {
				alert(r);
				return false;
			}
		}
		if (l['password']!=l['cpassword']) {
			alert("Confirm password does not match!");
			return false;
		}
		return JSON.stringify(l);
	}
	window.onload = function(){
		var a = new XMLHttpRequest();
		a.open("GET", "<?php print env("API_URL"); ?>/register.php");
		a.onreadystatechange = function(){
			if (this.readyState === 4) {
				try	{
					var a = JSON.parse(this.responseText);
					document.getElementById('csrf_field').innerHTML = '<input type="hidden" name="_csrf" id="_csrf" value="'+a['csrf']+'"><input type="hidden" name="_key" id="_key" value="'+a['key']+'">';
				} catch (e) {
					alert(e.getMessage());
				}
			}
		};
		a.send(null);
	};
	document.getElementById('form-register').addEventListener("submit", function(){
		var context = buildContext();
		if (context !== false) {
			var a = new XMLHttpRequest();
			a.open("POST", "<?php print env("API_URL"); ?>/register.php");
			a.onreadystatechange = function(){
				if (this.readyState === 4) {
					try	{
						var a = JSON.parse(this.responseText);
						if (a['status'] === "error") {
							alert(a['message']);
						}
						if (a['redirect']) {
							window.location = a['redirect'];
						}
					} catch (e) {
						alert(e.getMessage());
					}
				}
			};
			a.send(context);
		}
	});
</script>
</body>
</html>