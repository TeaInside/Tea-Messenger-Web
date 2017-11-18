@layout("header")
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
			         <div class="form-group">
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