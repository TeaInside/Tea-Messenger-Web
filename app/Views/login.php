<!DOCTYPE html>
<html>
<head>
	<title>Tea Messenger - Login</title>
	<script type="text/javascript" src="<?php print js("register"); ?>"></script>
    <link rel="stylesheet" href="<?php print css("bootstrap"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php print css("login"); ?>">
</head>
<body>
<center>
	<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
			   <h2 class="login-tile">Login Tea Messenger</h2>
               <hr>
               <div class="login-wall">
                  <div class="col-md-12">
                     <img class="profile-img" src="<?php print img("logo-ice-tea"); ?>" alt="">
                     <p class="ice-tea">Tea Messeger</p>
                  </div>
                  <div class="col-md-5">
                  </div>
                  <form method="post" action="javascript:void(0);" id="form-login" class="form-horizontal form-signin">
			         <div class="form-group">
				        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
			         </div>
			         <div class="form-group">
				        <input type="text" name="username" id="password" class="form-control" placeholder="Password">
			         </div>
			         <div class="form-group">
				        <div id="csrf_field"></div>
				        <input type="submit" name="submit" value="Login" class="btn btn-lg btn-primary btn-block">
			         </div>
			         <a href="/forgot-password">Forgot Password</a>
		          </form>
               </div>
            </div>
		</div>
   </div>
</center>
<script type="text/javascript">
	document.getElementById('fr').addEventListener("submit", function(){
		alert("Coming soon!");
	});
</script>
</body>
</html>
