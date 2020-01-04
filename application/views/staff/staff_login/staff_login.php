<?php include('staff_login.js.php'); ?>

<div class="wrap" >
	<h2 class="text-center"></h2>
		<form id="form-login" class="styled" action="" method="post">
	  	    <fieldset>
			  <h3></h3>
			  <ol>
			    <li class="form-row"><label>Email:</label>
				  <input name="user_email" id="user_email" type="text" class="text-input" />
				</li>
				
				<li class="form-row"><label>Password:</label>
				  <input name="password" type="password" id="password" value="" class="text-input" />
				</li>
				
			    <li class="form-row">
				<div id="invalid_login" style="color:#990000" class="red"  align="center"></div>
				</li>
				
				<li class="form-row">
					<input type="checkbox" name="remember" id="remember" checked="true" /> Remember me ?
				</li>
				<li class="button-row">
			 <input type="button" class="btn-blue" value="Login"  alt="Go" class="btn-submit-login img-swap" id="btn-submit-login" /> 	  
				</li>
				 <li class="form-row">
				<a href="<?php echo base_url().'admin/forgot_password'; ?>">Forgot Password</a>
				</li>
			  </ol>
			</fieldset>
		</form>
</div>

