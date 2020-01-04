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
	<li class="form-row"><label>Email:</label>
	<input name="user_email" type="text" id="user_email" class="text-input required email" />
	</li>
	<li class="form-row">
	<div id="invalid_login" style="color:#990000" class="red"  align="center"></div>
	</li>
	<li class="button-row">
	<input type="button"  class="btn-submit-login img-swap btn-blue" value="Back" onclick="window.location.href='<?php echo base_url(); ?>admin/login'"/>
	&nbsp;&nbsp;
	<input type="button" class="btn-blue" value="&nbsp;&nbsp;Go&nbsp;&nbsp;"  alt="Go" class="btn-submit-login img-swap" id="btn-submit-login" /> 
	</li>
</ol>
			</fieldset>
		</form>
</div>


