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
                     <p class="text-center ice-tea">Forgot Password</p>
                  </div>
                  <form method="post" action="javascript:void(0);" id="form-login" class="form-horizontal form-signin">
			         <div class="form-group">
				        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
			         </div>
			         <div class="form-group">
				        <div id="csrf_field"></div>
				        <input type="submit" name="submit" value="Reset" class="btn btn-lg btn-primary btn-block">
                        <br>
                        <span>
                            <center>
                                <a href="./">Back</a>
                            </center>
                        </span>
			         </div>
		          </form>
               </div>
            </div>
		</div>
   </div>
<script type="text/javascript">
    var username = document.getElementById('username');
	document.getElementById('form-login').addEventListener("submit", function(){
		//alert("Coming soon!");
        // alert(username.value);
        if(username.value == 'admin'){
            alert("Email reset password telah dikirim ke email "+ username.value +"@etdah.com anda.");
        }
        else {
            alert("Username tidak terdaftar.");
        }
	});
</script>
</body>
</html>