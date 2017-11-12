<?php
require_once 'layouts/header.php';
?>
	<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
               <div class="login-wall">
				<h2 class="text-center login-tile">Tea Messenger</h2>
                  <div class="col-md-12">
                     <img class="profile-img" src="<?php print img("logo-ice-tea"); ?>" alt="">
                     <!-- <p class="text-center ice-tea">Sign in</p> -->
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
				        <input type="submit" name="submit" value="Sign In" class="btn btn-lg btn-primary btn-block">
			         </div>
                     <p class="text-center">
			            <a href="/forgotpassword">Forgot Password</a>
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
	document.getElementById('form-login').addEventListener("submit", function(){
		alert("Coming soon!");
	});
</script>
</body>
</html>