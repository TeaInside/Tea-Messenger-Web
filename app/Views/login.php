<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tea Messenger - Login</title>
    <link rel="stylesheet" href="<?php print css("bootstrap"); ?>">
	<link rel="stylesheet" type="text/css" href="<?php print css("login"); ?>">
</head>
<body>
	<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
			   <h2 class="text-center login-tile">Login Tea Messenger</h2>
               <hr>
               <div class="login-wall">
                  <div class="col-md-12">
                     <img class="profile-img" src="<?php print img("logo-ice-tea"); ?>" alt="">
                     <p class="text-center ice-tea">Tea Messenger</p>
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
                     <p class="text-center">
			            <a href="/forgot-password">Forgot Password</a>
                     </p>
		          </form>
               </div>
            </div>
		</div>
   </div>
<script type="text/javascript">
	document.getElementById('form-login').addEventListener("submit", function(){
		alert("Coming soon!");
	});
</script>
</body>
</html>