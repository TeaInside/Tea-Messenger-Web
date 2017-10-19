<?php
    include_once('layouts/header.php');
?>
	<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
			   <h2 class="text-center login-tile">Tea Messenger</h2>
               <hr>
               <div class="login-wall">
                  <div class="col-md-12">
					<img class="profile-img" src="<?php print img("logo-ice-tea"); ?>" alt="">
					<p class="text-center ice-tea">Register</p>
                  </div>
                  <form method="post" action="javascript:void(0);" id="form-login" class="form-horizontal form-signin">
			         <div class="form-group">
					 	<label>First Name</label>
				        <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name">
					 </div>
					 <div class="form-group">
					 	<label>Last Name</label>
				        <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name">
					 </div>
					 <div class="form-group">
					 	<label>Email</label>
				        <input type="text" name="email" id="email" class="form-control" placeholder="tole@mail.com">
					 </div>
					 <div class="form-group">
					 	<label>Phone Number</label>
				        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Phone number">
					 </div>
					 <div class="form-group">
						<label>Gender</label>
						<select name="" id="" class="form-control">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					 </div>
					 <div class="form-group">
					 	<label>Username</label>
				        <input type="text" name="username" id="username" class="form-control" placeholder="Username">
					 </div>
					 <div class="form-group">
					 	<label>Password</label>
				        <input type="text" name="password" id="password" class="form-control" placeholder="Password">
					 </div>
					 <div class="form-group">
					 	<label>Confirm Password</label>
				        <input type="text" name="confPassword" id="confPassword" class="form-control" placeholder="Confirm Password">
					 </div>
					 <div class="form-group">
					 <img src="https://i.amz.mshcdn.com/5mfJr_n0-7H7kquE4C89u2ffiPg=/1200x627/2013%2F04%2F18%2F70%2Fcaptcha.ba000.jpg" class="img-responsive center-block" alt="Captcha" style="width:120px;padding:1em 0 1em 0;">
					 	<label>Captcha</label>
				        <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Captcha">
			         </div>
			         <div class="form-group">
				        <div id="csrf_field"></div>
				        <input type="submit" name="submit" value="Register" class="btn btn-lg btn-primary btn-block">
			         </div>
                     <p class="text-center">
						<span>
							<center> Already have account ? <a href="./">Sign in</a>. </center>
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