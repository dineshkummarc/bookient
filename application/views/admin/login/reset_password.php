<?php include('login.js.php'); ?>
<div class="wrap" >
  <h2 class="text-center"></h2>
  <form id="form-login" class="styled" action="" method="post">
    <fieldset>
      <h3></h3>
      <ol>
		<li class="form-row">         
		     Please Check your Email for password.      
		</li>
		<li id="msgPr" style="color: red;">           
		</li>
        <li class="form-row">         
            <input name="re_pass" class="span2 text-input" id="re_pass" type="password" placeholder="Password" />      
        </li>
        <li class="form-row">
            <input name="re_nw_pass" type="password" id="re_nw_pass" placeholder="New password" value="" class="span2 text-input"  />
        </li>
        <li class="form-row">
            <input name="re_nw_repass" type="password" id="re_nw_repass" placeholder="Re enter new password" value="" class="span2 text-input"  />
        </li>
        <li class="button-row">
            <input type="button" value="Reset" class="btn-submit-login img-swap btn-blue" id="reset_password" onclick="submitResend()"/><br>
            <a href="<?php echo base_url().'admin/forgot_password'; ?>">Click here</a> to re send password.
        </li>
      </ol>
    </fieldset>
  </form>
</div>