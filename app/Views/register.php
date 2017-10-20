<?php
    include_once('layouts/header.php');
?>
	<div class="container">
		<div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
               <div class="login-wall">
			   <h2 class="text-center login-tile">Tea Messenger</h2>
                  <div class="col-md-12">
					<img class="profile-img" src="<?php print img("logo-ice-tea"); ?>" alt="">
					<p class="text-center ice-tea">Register</p>
                  </div>
                  <form method="post" action="javascript:void(0);" id="form-login" class="form-horizontal form-signin">
			         <div class="form-group">
					 	<label>First Name</label>
				        <input type="text" name="firstName" id="first_name" class="form-control" placeholder="First Name" required>
					 </div>
					 <div class="form-group">
					 	<label>Last Name</label>
				        <input type="text" name="lastName" id="last_name" class="form-control" placeholder="Last Name" required>
					 </div>
					 <div class="form-group">
					 	<label>Email</label>
				        <input type="text" name="email" id="email" class="form-control" placeholder="email@domain.com" required>
					 </div>
					 <div class="form-group">
					 	<label>Phone Number</label>
				        <input type="text" name="phoneNumber" id="phone" class="form-control" placeholder="Phone number" required>
					 </div>
					 <div class="form-group">
						<label>Gender</label>
						<select name="" id="g" class="form-control" required>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					 </div>
					 <div class="form-group">
					 	<label>Username</label>
				        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
					 </div>
					 <div class="form-group">
					 	<label>Password</label>
				        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
					 </div>
					 <div class="form-group">
					 	<label>Confirm Password</label>
				        <input type="password" name="confPassword" id="cpassword" class="form-control" placeholder="Confirm Password" required>
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
<script>
	var wq = new XMLHttpRequest();
		wq.onreadystatechange = function(){
			if (this.readyState == 4) {
				try {
					var wd = JSON.parse(this.responseText);
					document.getElementById("csrf_field").innerHTML += '<input type="hidden" name="_csrf" value="' + wd['token'] + '" id="csrf">' + "\n" + '<input type="hidden" name="_valid_compare" value="' + wd['v_compare'] + '" id="validator">';
				} catch (e) {
					alert("Error CSRF : " + e.message);
					// window.location = "";
				}
			}
		}
		wq.open("GET", "<?php print API_URL; ?>/csrf");
		wq.send(null);
		document.getElementById('form-login').addEventListener("submit", function(){
			var q = new register();
			q.getInput();
			if (q.formValidator()) {
				q.buildData();
				q.send("<?php print API_URL; ?>/register", function(res){
					try {
						var q = JSON.parse(res);
						console.log(typeof q['error']);
						if (typeof q['error'] != 'undefined') {
							alert("Error ("+q['error']+") : "+q['message']);
						} else if (
							typeof q['message']  != 'undefined' &&
							typeof q['redirect'] != 'undefined'
						){
							alert(q['message']);
							window.location = q['redirect'];
						} else {
							alert("Unknown error : " + JSON.stringify(q));
						}
					} catch (e) {
						alert("Error " + e.message);
					}
				});
			}
		});
	/*document.getElementById('form-login').addEventListener("submit", function(){
		alert("Coming soon!");
	});*/
</script>
</body>
</html>