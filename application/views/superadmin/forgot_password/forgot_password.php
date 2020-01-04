<?php require('forgot_password.js.php'); ?>
<style type="text/css">
            .back_forgot
            {
            background: url(<?php  echo base_url(); ?>images/prev.png) no-repeat;
            cursor:pointer;border: none; height:30px; width:45px;
            }
 </style>
<div class="wrap">
	<h2 class="text-center"></h2>
		<form id="form-login" class="styled" action="" method="post">
	  	    <fieldset>
			  <h5 style="font-size:12px; font-family:Verdana, Geneva, sans-serif"><span id="invalid_login"></span></h5>
			  <ol>
			    <li class="form-row"><label>User Name:</label>
				  <input name="user_name" id="user_name" type="text" class="text-input required" />
				</li>

				<li class="form-row"><label>Email:</label>
				  <input name="user_email" type="text" id="user_email" class="text-input required email" />
				</li>

			    <li class="form-row">
				<div id="invalid_login" style="color:#990000" class="red"  align="center"></div>
				</li>
				<li class="button-row">
               	 <input type="button" id="user_email" onclick="window.location.href='<?php  echo base_url(); ?>superadmin/login'" value="Back" class="btn-gray"/>
                 &nbsp;
				 <!--<input type="image" src="<?php  echo base_url(); ?>images/login2.jpg" alt="Go" value="OK" class="btn-submit-login img-swap" />-->
                 <input type="button" alt="Ok" value="Go" class="btn-blue btn-submit-login img-swap" />
				</li>

			  </ol>
			</fieldset>
		</form>
</div>


