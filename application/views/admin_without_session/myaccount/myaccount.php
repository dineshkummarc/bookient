<?php include("myaccount.js.php");?>
<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>
<div class="rounded_corner_full">
	<h1 class="headign-main">MY ACCOUNT</h1>

<div class="inner-div">
<table width="99%" cellpadding="0" cellspacing="0">
<tr>
<td><div align="left"><?php echo $this->lang->line('myacc_basic_business_details'); ?></div></td>
<td width="30%" align="right"><div align="right"><a href=""><?php echo $this->lang->line('myacc_need_help'); ?></a></div></td>
</tr>
</table>
</div>
<div style="margin:8px 0 0 0;">
<form name="myaccount" id="myaccount"  action="" method="post">
<fieldset>
<ol>
<h2><?php echo $this->lang->line('myacc_heading_select_username'); ?></h2>

<div class="inner-div">

<div align="left"><?php echo $this->lang->line('myacc_div_Please_accurate'); ?></div>
<table>
<tr><td>
			    <li class="form-row"><label><?php echo $this->lang->line('myacc_username'); ?>:</label>
				  
				</li></td><td><?php echo $local_admin_username; ?></td></tr>
				<tr><td>
				<li class="form-row"><label><?php echo $this->lang->line('myacc_currency'); ?>:</label></td><td>
				  <?php echo $currency;  ?> 			
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_currency_format'); ?>:</label></td><td>
				  	 <?php echo $currency_format; ?> 				
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_profession'); ?>:</label></td><td>
				<div align="left"><?php echo $this->lang->line('myacc_div_Please_select_profession'); ?></div>
				  	<?php echo $profession; ?>			
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_time_zone'); ?>:</label></td><td>
				   <?php echo $time_zone;  ?>				
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_time_format'); ?>:</label></td><td>
				  <?php echo $time_format;  ?> 				
							
				</li></td></tr>
				
				<tr><td><li ><label><?php echo $this->lang->line('myacc_date_format'); ?>:</label></td><td>
				<?php echo $date_format;  ?> 						
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_country'); ?>:</label></td><td>
				  <?php echo  $country;   ?> 
				</li></td></tr>
				
				<tr><td><li ><label><?php echo $this->lang->line('myacc_region'); ?>:</label></td><td>
				  <?php echo  $region;   ?>
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_city'); ?>:</label></td><td>
				  <?php echo  $city;   ?>	
							
				</li></td></tr></table>
 </div>              
                
<h2 align="left"><?php echo $this->lang->line('myacc_heading_Update_your_personal_details'); ?> </h2>
<div class="inner-div">
<table cellpadding="0" cellspacing="0" class="chng-password-section">
<tr><td>
					<li ><label><?php echo $this->lang->line('myacc_name'); ?>:</label></td><td>
				  <input name="first_name" id="first_name" type="text" style="width:110px;;height:20px" class="text-input required" value="<?php echo  $first_name;   ?>" /> </td><td><input name="last_name" type="text" id="last_name" style="width:110px;;height:20px" class="text-input required" value="<?php echo  $last_name;   ?>" />	
							
				</li></td></tr>
				<tr><td style="width:29%"><li ><label><?php echo $this->lang->line('myacc_email'); ?>:</label></td><td><div id="change_email"><div id="current_email"><?php echo $local_admin_email; ?></div><a href="javascript: changeEmail('');">change email</a>
				 
				</div><div id="afterClick" ></div><div id="error" style="color:#FF0000"></div></td></li></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_password'); ?>:</label><td><div id="change_password"><a id="show-pass" onclick="show-pass()" href="javascript: change_password('');">change password</a>
<div id="success" style="display:none"></div>				 
				</div><div id="afterClick_password" ></div></li></td></tr></table>
</div>

<h2 align="left"><?php echo $this->lang->line('myacc_heading_Verify_your_business_account'); ?></h2>
<div class="inner-div">
				<div align="left"><?php echo $this->lang->line('myacc_div_receive_text_call_alerts'); ?></div><table class=" verify-acc">
<tr><td> 
				<li ><label><?php echo $this->lang->line('myacc_home_phone'); ?>:</label></td><td>
				<input name="home_phone1" id="hm1" type="text" style="width:40px;height:20px" value="<?php echo  $local_admin_phn_code;   ?>"/></td><td>
			<input name="home_phone2" id="hm2" type="text" value="<?php echo  $home_phone;   ?>" style="width:120px;;height:20px" />	
				 
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_work_phone'); ?>:</label></td><td>
				<input name="work_phone1" id="wp1" type="text" style="width:40px;height:20px" value="<?php echo  $local_admin_phn_code;   ?>" /></td><td>
			<input name="work_phone2" id="wp2" type="text" value="<?php echo  $work_phone;   ?>" style="width:120px;;height:20px" /> 
				 
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->lang->line('myacc_mobile_phone'); ?>:</label></td><td>
				<input name="mobile_phone1" id="mp1" type="text" style="width:40px;height:20px"  value="<?php echo  $local_admin_phn_code;   ?>" /></td><td>
			<input name="mobile_phone2" id="mp2" type="text" value="<?php echo  $mobile_phone;   ?>" style="width:120px;;height:20px" class="text-input required digit" />	
				 
				</li></td></tr>
				<tr><td>&nbsp;</td><td colspan="2"><input type="button"  onclick="submit_data()"  align="right" name="save" class="btn-blue" value="save"></td></tr></table>
                
                </div>
				
				</ol>
				</fieldset>
				</form>
				
</div>
</div>
