<?php include('login.js.php'); ?>

<div class="wrap" >
  <h2 class="text-center"></h2>
  <form id="form-login" class="styled" action="" method="post">
    <fieldset>
      <h3></h3>
      <ol>
        <!--  <?php //echo $this->lang->line('headign-main'); ?>-->
        <li class="form-row">         
            <input name="user_email" class="span2 text-input" id="user_email" type="text" placeholder="Email" />      
        </li>
        <li class="form-row">
            <input name="password" type="password" id="password" placeholder="Password" value="" class="span2 text-input"  />
        </li>
        <li class="form-row">
          <div id="invalid_login" style="color:#990000" class="red"  align="center"></div>
        </li>
		<li class="form-row">
			<input type="checkbox" name="remember" id="remember" checked="true" /> Remember me ?
		</li>
        <li class="button-row">
          <input type="button"  value="Login"  alt="Go" class="btn-submit-login img-swap btn-blue" id="btn-submit-login" /> &nbsp; <a href="<?php echo base_url().'admin/forgot_password'; ?>">Forgot Password</a>
        </li>
      </ol>
    </fieldset>
  </form>
</div>
