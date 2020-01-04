<?php include('change_password.js.php'); ?>
<style>
   .new_styled {
    
    border-radius: 9px 9px 9px 9px;
    font: 15px Arial,sans-serif;
    margin:0px auto;
    padding: 20px;
    width: 65%;
    height: 280px;
    background-color:#fff;
} 
.fixedspace {
    
   padding:10px;
    
}   
</style>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Change Password</h1>
<div class="wrap" style="padding:-20px 0 0 0; width:85%; margin:0px auto;">
	     <form id="form-chng-pass"  action="" method="post">
	       <fieldset class="new_styled">
              
			  <ol style="">
                              <li>
                                  <!--<h4 align="center" style="text-decoration:underline">Change Password</h4>-->
                              
                                            <h5 style="font-size:11px;">
                                <span id="success" class="show_error"></span></h5>
                             
                                  
                              </li>
			    <li class="form-row fixedspace"><label>Current Password:</label>
				  <input name="current_pass" id="current_pass" type="password" class="text-input-staff required"  />
                                   <span id="current_error" class="show_error"></span>
				</li>
				
				<li class="form-row fixedspace"><label>New Password:</label>
				  <input name="new_pass" type="password" id="new_pass" class="text-input-staff required" />
				    <span id="new_error" class="show_error" style=""></span>
				</li>
                 
				<li class="form-row fixedspace"><label>Confirm New Password:</label>
				  <input name="confirm_pass" type="password" id="confirm_pass" class="text-input-staff required" style="" />
                  <span id="confirm_error" class="show_error"></span>
				</li>
				<li class="button-row fixedspace">
				  <input type="button" onclick="change_password();" alt="log in" value="OK" class="btn-blue" style="margin-left:152px;" />
				</li>
			  </ol>
			</fieldset>
		</form>
    </div>
</div>

