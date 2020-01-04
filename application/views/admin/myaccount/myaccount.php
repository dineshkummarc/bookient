<?php include("myaccount.js.php");?>
<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>
<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_heading')); ?></h1>

<div class="inner-div">
<table width="99%" cellpadding="0" cellspacing="0">
<tr>
<td><div align="left"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_basic_business_details')); ?></div></td>
<td width="30%" align="right"><div align="right"><a href=""><?php //echo $this->lang->line('myacc_need_help'); ?></a></div></td>
</tr>
</table>
</div>
<div style="margin:8px 0 0 0;">
<form name="myaccount" id="myaccount"  action="" method="post">
<fieldset>
<ol>
<h2><?php echo $this->global_mod->db_parse($this->lang->line('myacc_heading_select_username')); ?></h2>

<div class="inner-div">

<div align="left"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_div_Please_accurate')); ?></div>
<table>
<tr><td>
			    <li class="form-row"><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_username')); ?>:</label>
				  
				</li></td><td><?php echo $local_admin_username; ?></td></tr>
				
<?php if (in_array(69, $this->global_mod->authArray())){ ?>
				
<tr>
	<td><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_currency')); ?>:</label></td>
	<td><?php echo $currency;  ?></td>
</tr>
<tr>
	<td><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_profession')); ?>:</label></td>
	<td><div align="left"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_div_Please_select_profession')); ?></div><?php echo $this->global_mod->show_to_control($profession); ?></td>
</tr>
<?php }else{ ?>	
	<input type="hidden" id="currency_id" name="currency_id" value="1">
	<input type="hidden" id="profession_id" name="profession_id" value="0">
<?php  } ?>		
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_time_zone')); ?>:</label></td><td>
				   <?php echo $time_zone;  ?>				
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_time_format')); ?>:</label></td><td>
				  <?php echo $time_format;  ?> 				
							
				</li></td></tr>
				
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_date_format')); ?>:</label></td><td>
				<?php echo $date_format;  ?> 						
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_country')); ?>:</label></td><td>
				  <?php echo $country;   ?> 
				</li></td></tr>
				
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_region')); ?>:</label></td><td>
				  <?php echo $region;   ?>
							
				</li></td></tr>
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_city')); ?>:</label></td><td>
				  <?php echo $city;   ?>	
							
				</li></td></tr></table>
 </div>              
                
<h2 align="left"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_heading_Update_your_personal_details')); ?> </h2>
<div class="inner-div">
<table cellpadding="0" cellspacing="0" class="chng-password-section">
<tr><td>
					<li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_name')); ?>:</label></td><td>
				  <input name="first_name" id="first_name" type="text" style="width:110px;;height:20px" class="text-input required" value="<?php echo  $first_name;   ?>" /> </td><td><input name="last_name" type="text" id="last_name" style="width:110px;;height:20px" class="text-input required" value="<?php echo  $last_name; ?>" />	
							
				</li></td></tr>
				<tr><td style="width:29%"><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_email')); ?>:</label></td><td><div id="change_email"><div id="current_email"><?php echo $this->global_mod->show_to_control($local_admin_email); ?>  <span contentId="1" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span></div><a href="javascript: changeEmail('');"><?php echo $this->global_mod->db_parse($this->lang->line('chng_email')); ?></a>
				 
				</div><div id="afterClick" ></div><div id="error" style="color:#FF0000"></div></td></li></tr>
				<tr><td><li ><label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_password')); ?>:</label><td><div id="change_password"><a id="show-pass" onclick="show_pass()" href="javascript: change_password('');"><?php echo $this->global_mod->db_parse($this->lang->line('chng_pass')); ?></a>
<div id="success" style="display:none"></div>				 
				</div><div id="afterClick_password" ></div></li></td></tr></table>
</div>

<h2 align="left"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_heading_Verify_your_business_account')); ?></h2>
<div class="inner-div">
				<div align="left"><?php echo $this->global_mod->db_parse($this->lang->line('myacc_div_receive_text_call_alerts')); ?></div>
    <table class=" verify-acc">
        <tr>
            <td> 
				<label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_home_phone')); ?>:</label>
            </td>
            <td align="right">
                <label id="hm1"><?php echo $local_admin_phn_code; ?></label>
            </td>
            <td>
			    <input name="home_phone2" id="hm2" type="text" value="<?php echo  $home_phone;   ?>" style="width:120px;;height:20px" />	
			</td>
        </tr>
		<tr>
            <td>
                <label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_work_phone')); ?>:</label>
            </td>
            <td align="right">
                <label id="wp1"><?php echo $local_admin_phn_code; ?></label>
            </td>
            <td>
			    <input name="work_phone2" id="wp2" type="text" value="<?php echo  $work_phone;   ?>" style="width:120px;;height:20px" /> 
			</td>
        </tr>
		<tr>
            <td>
                <label><?php echo $this->global_mod->db_parse($this->lang->line('myacc_mobile_phone')); ?>:</label>
            </td>
            <td>
                <label id="mp1"><?php echo $local_admin_phn_code; ?></label>
            </td>
            <td>
			    <input name="mobile_phone2" id="mp2" type="text" value="<?php echo  $mobile_phone;   ?>" style="width:120px;;height:20px" class="text-input digit" />	
			</td>
        </tr>
				<tr><td>&nbsp;</td><td colspan="2"><input type="button" onclick="submit_data()" align="right" name="save" class="btn-blue" value="<?php echo $this->global_mod->db_parse($this->lang->line('myacc_save_btn')); ?>"></td></tr></table>
                
                </div>
				
				</ol>
				</fieldset>
				</form>
				
</div>
</div>
