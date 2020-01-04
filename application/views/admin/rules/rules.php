<?php include('rules.js.php'); ?>
<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>
<div class='error_msg_all' style="color: #ff0d0d;"></div>
<div class="rounded_corner_full">
<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('rules_heading'));?></h1>
<?php 
	if(count($SettingData) != 0){ 
		$local_admin_id                      =$SettingData['local_admin_id']; 
		$enable_system                       =$SettingData['enable_system']; 
		$aprvl_rqrd_pre_payin_mem            =$SettingData['aprvl_rqrd_pre_payin_mem']; 
		
		$aprvl_rqrd_mob_verfd_mem            =$SettingData['aprvl_rqrd_mob_verfd_mem']; 
		$aprvl_rqrd_mob_non_verfd_mem        =$SettingData['aprvl_rqrd_mob_non_verfd_mem']; 
		
		$no_of_booking                       =$SettingData['no_of_booking']; 
		$no_of_booking_period                =$SettingData['no_of_booking_period']; 
		$booking_starting_point              =$SettingData['booking_starting_point']; 
		$no_of_booking_period_from           =$SettingData['no_of_booking_period_from']; 
		$no_of_booking_period_to             =$SettingData['no_of_booking_period_to']; 
		$recurring_appointments              =$SettingData['recurring_admin']; 
		$recurring_admin                     =$SettingData['recurring_appointments']; 
		$quantity_appointment_setting        =$SettingData['quantity_appointment_setting']; 
		$quantity_appointment        		 =$SettingData['quantity_appointment']; 
		$allow_international_users           =$SettingData['allow_international_users']; 
		$detect_client_timezone              =$SettingData['detect_client_timezone']; 
		$show_service_cost                   =$SettingData['show_service_cost']; 
		$show_service_time_duration          =$SettingData['show_service_time_duration']; 
		
		$booked_times_striked                =$SettingData['booked_times_striked']; 
		$blocked_times_striked_out           =$SettingData['blocked_times_striked_out']; 
		
		$clients_name_with_reviews           =$SettingData['clients_name_with_reviews']; 
		$default_view                        =$SettingData['default_view']; 
		
		$cal_strting_weekday                 =$SettingData['cal_strting_weekday']; 
		$cal_strting_dt                      =$SettingData['cal_strting_dt']; 
		$admin_always_allowed				 =$SettingData['admin_always_allowed'];
		$admin_show_who				= $SettingData['admin_show_who'];
		$show_staff_customers                =$SettingData['show_staff_customers']; 
		$staff_selection_mandatory           =$SettingData['staff_selection_mandatory']; 
		$staff_order                         =$SettingData['staff_order']; 
		
		$default_language_id                 =$SettingData['default_language_id']; 
		$default_login_typ_id                =$SettingData['default_login_typ_id']; 
		$cal_time_interval_typ               =$SettingData['cal_time_interval_typ']; 
		$cal_time_interval_variable          =$SettingData['cal_time_interval_variable']; 
		
		
		$adv_bk_min_setting					=$SettingData['adv_bk_min_setting']; 
		$adv_bk_min_tim						=$SettingData['adv_bk_min_tim']; 
		$tim_intrvl_btwn_appo_settingin		=$SettingData['tim_intrvl_btwn_appo_settingin']; 
		$adv_bk_mx_tim						=$SettingData['adv_bk_mx_tim']; 
		$bkin_can_setin						=$SettingData['bkin_can_setin']; 
		$bkin_can_mx_tim					=$SettingData['bkin_can_mx_tim']; 
		$bkin_reschdl_setin					=$SettingData['bkin_reschdl_setin']; 
		$bkin_reschdl_mx_tim				=$SettingData['bkin_reschdl_mx_tim']; 
		$tim_intrvl_btwn_appo				=$SettingData['tim_intrvl_btwn_appo']; 
		$admn_tim_intrvl					=$SettingData['admn_tim_intrvl']; 
		
		$sms_alert							 =$SettingData['sms_alert']; 
		$sms_alrt_bfr_appo                   =$SettingData['sms_alrt_bfr_appo']; 
		$sms_thanks_aftrappo                 =$SettingData['sms_thanks_aftrappo']; 
		$send_sms_for                        =$SettingData['send_sms_for']; 
		$sms_alart_to_admin                  =$SettingData['sms_alart_to_admin']; 
		$sms_alart_to_staff                  =$SettingData['sms_alart_to_staff']; 
		$email_alert                         =$SettingData['email_alert']; 
		$email_alrt_bfr_appo                 =$SettingData['email_alrt_bfr_appo'];
		
		
		$sign_upinfo_item_Arr 				 = $SettingData['sign_upinfo_item']; 
		
		$edit_info_item_Arr 				 = $SettingData['edit_info_item_arr'];
		
		$admin_show_user_Arr				= $SettingData['user_show_field_arr'];

      	
		
		$language_list_Arr 					 = $SettingData['language_list']; 
		$login_typ_Arr 					     = $SettingData['login_typ']; 
		//$staff_order						 = $SettingData['staff_order']; 
		$hours_type							 = $SettingData['hours_type'];
		$show_block_timinig					 = $SettingData['show_block_timinig']; 
	}else{
		$local_admin_id						=""; 
		$enable_system 						=""; 
		$aprvl_rqrd_pre_payin_mem			=""; 
		
		$aprvl_rqrd_mob_verfd_mem			=""; 
		$aprvl_rqrd_mob_non_verfd_mem		=""; 
		
		$no_of_booking 						=""; 
		$no_of_booking_period				=""; 
		$booking_starting_point  			=""; 
		$no_of_booking_period_from			=""; 
		$no_of_booking_period_to 			=""; 
		$recurring_appointments  			=""; 
		$recurring_admin 					=""; 
		$quantity_appointment_setting		=""; 
		$quantity_appointment        		=""; 
		$allow_international_users			=""; 
		$detect_client_timezone  			=""; 
		$show_service_cost  				=""; 
		$show_service_time_duration  		=""; 
		
		$booked_times_striked				=""; 
		$blocked_times_striked_out			=""; 
		
		$clients_name_with_reviews			=""; 
		$default_view  						=""; 
		
		$cal_strting_weekday				=""; 
		$cal_strting_dt						=""; 
		$admin_always_allowed				="";
		$admin_show_who					="";
		$show_staff_customers				=""; 
		$staff_selection_mandatory			=""; 
		$staff_order						=""; 
		
		$default_language_id				=""; 
		$default_login_typ_id				=""; 
		$cal_time_interval_typ  			=""; 
		$cal_time_interval_variable  		=""; 
		
		
		$adv_bk_min_setting					=""; 
		$adv_bk_min_tim						="";
		$tim_intrvl_btwn_appo_settingin		="";
		$adv_bk_mx_tim						="";
		$bkin_can_setin						="";
		$bkin_can_mx_tim					="";
		$bkin_reschdl_setin					="";
		$bkin_reschdl_mx_tim				="";
		$tim_intrvl_btwn_appo				="";
		$admn_tim_intrvl					="";
		
		$sms_alert		  				    =""; 
		$sms_alrt_bfr_appo  				=""; 
		$sms_thanks_aftrappo				=""; 
		$send_sms_for  						=""; 
		$sms_alart_to_admin 				=""; 
		$sms_alart_to_staff					=""; 
		$email_alert  						=""; 
		$email_alrt_bfr_appo				=""; 
		
		$sign_upinfo_item_Arr 		    	= ""; 
		$language_list_Arr 					=""; 
		$login_typ_Arr 						=""; 
		$hours_type 						=""; 
		$show_block_timinig					="";
	}
?>

    

<form action="<?php echo base_url(); ?>admin/rules/add_rules" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
<div class="inner-div">
<table align="left" width="58%">

<tr>
<td width="35%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_enable_client'));?> :</td>
<td width="19%" align="left">
<input id="site_enb" type="radio" <?php if(($enable_system != "" && $enable_system == 1) || $enable_system == "" ){?>checked="checked" <?php } ?>  value="1" name="site_enb"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="site_enb" type="radio" <?php if($enable_system != "" && $enable_system == 0){ echo 'checked="checked"';  } ?> value="0" name="site_enb"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?> 
</td>
</tr>
</table>
</div>
<div style="height:30px;"></div>
<div class="inner-div">
<table id="TotalData" align="center" width="100%">




<tr><td colspan="3" align="left"><h2 style="margin:0px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_default_calender_head'));?></h2></td></tr>
<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_time_format'));?></td>
<td>
<input id="hours_type12" type="radio" <?php if(($hours_type != "" && $hours_type == 1) || $hours_type == "" ){?>checked="checked" <?php } ?>  value="1" name="hours_type"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_time_format_analog'));?>
<input id="hours_type24" type="radio" <?php if($hours_type != "" && $hours_type == 0){ echo 'checked="checked"';  } ?> value="0" name="hours_type"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_time_format_digital'));?>
<span contentId="25" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>





<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_default_view'));?></td>
<td>
<select id="default_view" name="default_view" style="width: 268px;">
<option value="0" <?php if(($default_view != "" && $default_view == 0) || $default_view !=""){?>selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_default_view_week'));?></option>
<option value="1" <?php if($default_view != "" && $default_view == 1){?>selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_default_view_month'));?></option>
<option value="2" <?php if($default_view != "" && $default_view == 2){?>selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_default_view_reviews'));?></option>
</select>
<span contentId="10" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>
<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_cal_weekday'));?></td>
<td><?php  //echo $cal_strting_weekday;?>
<select id="cal_strting_weekday" name="cal_strting_weekday" style="width: 268px;">
<option value="1" <?php if($cal_strting_weekday != "" && $cal_strting_weekday == 1){?>selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_cal_weekday_today'));?></option>
<option value="2" <?php if($cal_strting_weekday != "" && $cal_strting_weekday == 2){?>selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_cal_weekday_sunday'));?></option>
<option value="3" <?php if($cal_strting_weekday != "" && $cal_strting_weekday == 3){?>selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_cal_weekday_monday'));?></option>
</select>
<span contentId="11" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>
<tr>
	<td><?php echo $this->global_mod->db_parse($this->lang->line('rules_show_booked_front'));?></td>
	<td><input type="checkbox" id="show_block_timinig" value="1" name="show_block_timinig" <?php if($show_block_timinig ==1){?> checked="checked" <?php } ?>/></td>
</tr>
<tr>
	<td colspan="3" align="left"><h2 style="margin:0px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_book_appo_head'));?></h2></td>
</tr>
<tr>
	<td width="25%">
		<?php echo $this->global_mod->db_parse($this->lang->line('rules_prepaying_members'));?>
	</td>
	<td>
		<select id="aprvl_rqrd_pre_payin_mem"  name="aprvl_rqrd_pre_payin_mem">
			<option value="0" <?php if($aprvl_rqrd_pre_payin_mem != "" && $aprvl_rqrd_pre_payin_mem == 0 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_not_require_approval'));?></option>
			<option value="1" <?php if(($aprvl_rqrd_pre_payin_mem != "" && $aprvl_rqrd_pre_payin_mem == 1) || $aprvl_rqrd_pre_payin_mem == "" ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_require_approval'));?></option>
		</select>
	</td>
</tr>
<tr>
<td  width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_ph_verify_head'));?></td>
<td>
<select id="aprvl_rqrd_mob_verfd_mem"  name="aprvl_rqrd_mob_verfd_mem">
<option value="0" <?php if($aprvl_rqrd_mob_verfd_mem != "" && $aprvl_rqrd_mob_verfd_mem == 0 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_ph_verify_not_required'));?></option>
<option value="1" <?php if(($aprvl_rqrd_pre_payin_mem != "" && $aprvl_rqrd_pre_payin_mem == 1) || $aprvl_rqrd_pre_payin_mem == "" ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_ph_verify_required'));?></option>
</select>
</td>
</tr>
<tr>
<td  width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_nonph_verify_head'));?></td>
<td>
<select id="aprvl_rqrd_mob_non_verfd_mem"  name="aprvl_rqrd_mob_non_verfd_mem">
<option value="0"  <?php if($aprvl_rqrd_mob_non_verfd_mem != "" && $aprvl_rqrd_mob_non_verfd_mem == 0 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_ph_verify_not_required'));?></option>
<option value="1" <?php if(($aprvl_rqrd_mob_non_verfd_mem != "" && $aprvl_rqrd_mob_non_verfd_mem == 1) || $aprvl_rqrd_mob_non_verfd_mem == "" ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_ph_verify_required'));?></option>
</select>
</td>
</tr>

<tr><td colspan="3" align="left"><h2 style="margin:0px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_booking_restrictn_head'));?></h2></td></tr>

<tr>
<td  width="25%"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_restrictn_onno_head'));?> :</td>

<td>
<input id="applyAdvanceBookingRule" type="checkbox" onclick="DispDtls();" name="applyAdvanceBookingRule" value="1" <?php if($no_of_booking != "" && $no_of_booking != 0 ){?> checked="checked" <?php } ?>>
</td>
</tr>
<tr><td colspan="3" align="left">
<div id="AdvBookingDtlsShowHide" style="display:none;"><!--style="display:none;"-->
<table align="right" width="100%" bgcolor="#BFE0F9">
<tr>
<td width="25%"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_booking_aloowd_head'));?> </td>
<td >
<select id="no_of_booking_period" style="width: 280px;" onchange="DispDtlsControl()" name="no_of_booking_period">
<option value="3"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 3 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_booking_aloowd_daily'));?></option>
<option value="4"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 4 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_booking_aloowd_weekly'));?></option>
<option value="5"  <?php if(($no_of_booking_period != "" && $no_of_booking_period == 5) || $no_of_booking_period == "" ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_booking_aloowd_monthly'));?></option>
<option value="6"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_booking_aloowd_yearly'));?></option>
</select>

<span contentId="1" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>


<tr id="no_of_bookingRestrictyinTd">
<td width="25%"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_restriction'));?></td>
<td>
<input id="no_of_booking" type="text" value="<?php if($no_of_booking != ""){ echo $no_of_booking;  } ?>" name="no_of_booking" style="border:1px solid #B7B7B7;width: 268px;">
<span id="res_div" style="color:#F00" ></span>
<span contentId="2" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_no_of_booking" class="error"></span>
</td>
</tr>
</table>
</div>
</td></tr>

<tr>
<td width="25%"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_want_recurring_head'));?>  </td>
<td>
	<?php if (in_array(39, $this->global_mod->authArray())){	?>

<input id="recurring_appointments" type="radio" <?php if(($recurring_appointments != "" && $recurring_appointments == 1) || $recurring_appointments == "" ){?> checked="checked" <?php } ?> value="1" name="recurring_appointments"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="recurring_appointments" type="radio" <?php if($recurring_appointments != "" && $recurring_appointments == 0){?> checked="checked" <?php } ?> value="0" name="recurring_appointments"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>

<?php }else{ ?>
	
	<input id="recurring_appointments" type="radio" disabled="true"  value="1" name="recurring_appointments"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="recurring_appointments" type="radio" disabled="true" checked="true" value="0" name="recurring_appointments"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>

<?php } ?>
<span contentId="3" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>


<tr>
<td width="25%">  <?php echo $this->global_mod->db_parse($this->lang->line('rules_want_recurring_admin_head'));?> </td
><td>
<input id="recurring_admin" type="radio" <?php if(($recurring_admin != "" && $recurring_admin == 1) || $recurring_admin == "" ){?> checked="checked" <?php } ?>  value="1" name="recurring_admin"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="recurring_admin" type="radio" <?php if($recurring_admin != "" && $recurring_admin == 0){?> checked="checked" <?php } ?> value="0" name="recurring_admin"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="4" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>



<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_allow_client_quantity_head'));?> </td>
<td>
<input  id="quantity_appointment_setting" type="radio" value="1" <?php if(($quantity_appointment_setting != "" && $quantity_appointment_setting == 1) || $quantity_appointment_setting == "" ){?> checked="checked"  <?php } ?> name="quantity_appointment_setting"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="quantity_appointment_setting" type="radio" value="0"  <?php if($quantity_appointment_setting != "" && $quantity_appointment_setting == 0){?> checked="checked" <?php } ?>   name="quantity_appointment_setting"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="5" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>



<tr id="quantity_appointmentTd">
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_alias_quantity'));?></td>
<td>
<input id="quantity_appointment" type="text" value="<?php if($quantity_appointment != ""){ echo $quantity_appointment;  } ?>" name="quantity_appointment" style="border:1px solid #B7B7B7;width:268px;">
<span contentId="6" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_quantity_appointment" class="error"></span>
</td>
</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_allow_intrnatinl_user'));?> </td>
<td>
<input id="allow_international_users" type="radio" <?php if(($allow_international_users != "" && $allow_international_users == 1) || $allow_international_users == "" ){?> checked="checked" <?php } ?> value="1" name="allow_international_users"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="allow_international_users" type="radio" <?php if($allow_international_users != "" && $allow_international_users == 0){?> checked="checked" <?php } ?> value="0" name="allow_international_users"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
</td>
</tr>
<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_show_service_cost'));?></td>
<td>
<input id="show_service_cost" type="radio" <?php if(($show_service_cost != "" && $show_service_cost == 1) || $show_service_cost == "" ){?> checked="checked" <?php } ?> value="1" name="show_service_cost"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="show_service_cost" type="radio"  <?php if($show_service_cost != "" && $show_service_cost == 0){?> checked="checked" <?php } ?>  value="0" name="show_service_cost"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="7" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_show_service_time'));?></td>
<td>
<input id="show_service_time_duration" type="radio" <?php if(($show_service_time_duration != "" && $show_service_time_duration == 1) || $show_service_time_duration == "" ){?> checked="checked" <?php } ?> value="1" name="show_service_time_duration"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="show_service_time_duration" type="radio" <?php if($show_service_time_duration != "" && $show_service_time_duration == 0){?> checked="checked" <?php } ?> value="0" name="show_service_time_duration"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="8" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>
<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_show_client_name'));?></td>
<td>
<input id="clients_name_with_reviews" type="radio" value="1" name="clients_name_with_reviews"
<?php if(($clients_name_with_reviews != "" && $clients_name_with_reviews == 1) || $clients_name_with_reviews !=""){?> checked="checked"  <?php } ?>> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="clients_name_with_reviews" type="radio" value="0" name="clients_name_with_reviews" 
<?php if($clients_name_with_reviews != "" && $clients_name_with_reviews == 0){?> checked="checked"  <?php } ?>> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="9" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>

</tr>

<!--tr>
<td width="25%">What view should be shown by default?</td>
<td>
<select id="default_view" name="default_view" style="width: 268px;">
<option value="0" <?php if(($default_view != "" && $default_view == 0) || $default_view !=""){?>selected="selected" <?php } ?>>Week</option>
<option value="1" <?php if($default_view != "" && $default_view == 1){?>selected="selected" <?php } ?>>Month</option>
<option value="2" <?php if($default_view != "" && $default_view == 2){?>selected="selected" <?php } ?>>Reviews/About Us</option>
</select>
<span contentId="10" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>
<tr>
<td width="25%">What should be your calendar's starting weekday?</td>
<td><?php  //echo $cal_strting_weekday;?>
<select id="cal_strting_weekday" name="cal_strting_weekday" style="width: 268px;">
<option value="1" <?php if($cal_strting_weekday != "" && $cal_strting_weekday == 1){?>selected="selected" <?php } ?>>Today</option>
<option value="2" <?php if($cal_strting_weekday != "" && $cal_strting_weekday == 2){?>selected="selected" <?php } ?>>Sunday</option>
<option value="3" <?php if($cal_strting_weekday != "" && $cal_strting_weekday == 3){?>selected="selected" <?php } ?>>Monday</option>
</select>
<span contentId="11" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr-->

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_calender_strt_date'));?></td>
<td>
<input type="text" name="cal_strting_dt" id="cal_strting_dt" autocomplete="off" 
value="<?php if(($cal_strting_dt != "" && $cal_strting_dt == 1) || $cal_strting_dt !=""){ echo $cal_strting_dt; }?>" 
maxlength="30" style="border:1px solid #B7B7B7;width: 268px;" />
<span contentId="12" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>




<tr><td colspan="3" align="left"><h2><?php echo $this->global_mod->db_parse($this->lang->line('rules_staff_on_calender_head'));?> </h2></td></tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_staff_admin_always_allowed'));?></td>
<td>
<input id="admin_always_allowed" type="radio" <?php if(($admin_always_allowed != "" && $admin_always_allowed == 1) || $admin_always_allowed !=""){?> checked="checked"  <?php } ?> value="1" name="admin_always_allowed"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="admin_always_allowed" type="radio" value="0" <?php if($admin_always_allowed != "" && $admin_always_allowed == 0){?> checked="checked"  <?php } ?> name="admin_always_allowed"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="26" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_staff_admin_show_who_booked'));?></td>
<td>
<input id="admin_show_who" type="radio" <?php if(($admin_show_who != "" && $admin_show_who == 1) || $admin_show_who !=""){?> checked="checked"  <?php } ?> value="1" name="admin_show_who"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="admin_show_who" type="radio" value="0" <?php if($admin_show_who != "" && $admin_show_who == 0){?> checked="checked"  <?php } ?> name="admin_show_who"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
</td>
</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_show_staff'));?></td>
<td>
<input id="show_staff_customers" type="radio" <?php if(($show_staff_customers != "" && $show_staff_customers == 1) || $show_staff_customers !=""){?> checked="checked"  <?php } ?> value="1" name="show_staff_customers"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="show_staff_customers" type="radio" value="0" <?php if($show_staff_customers != "" && $show_staff_customers == 0){?> checked="checked"  <?php } ?> name="show_staff_customers"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="13" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>

<tr id="staff_selection_mandatoryTd"  <?php if($show_staff_customers == 0){?>  style="display: none;" <?php } ?>>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_staff_selectn_mandetory'));?></td>
<td>
<input id="staff_selection_mandatory" type="radio" <?php  if($staff_selection_mandatory != "" && $staff_selection_mandatory == 1 && $show_staff_customers == 1){?> checked="checked"  <?php }else{ ?>checked="checked"<?php } ?> value="1" name="staff_selection_mandatory"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_yes'));?>
<input id="staff_selection_mandatory" type="radio" <?php  if(($staff_selection_mandatory != "" && $staff_selection_mandatory == 0 && $show_staff_customers == 1) || $detect_client_timezone == "" ){?> checked="checked"  <?php } ?> value="0" name="staff_selection_mandatory"> <?php echo $this->global_mod->db_parse($this->lang->line('rules_option_no'));?>
<span contentId="14" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>




<tr id="staff_orderTd"   <?php if($staff_selection_mandatory == 1 && $show_staff_customers == 1 ){?>  style="display: none;" <?php } ?> >
<td width="25%">
<?php echo $this->global_mod->db_parse($this->lang->line('rules_appo_allocate_order'));?> </td>
<td>
<select id="staff_order" style="width: 180px;" name="staff_order">
	<?php 
	$c=1;
	foreach($staffOrder as $val){
	
	?>	
		<option  value="<?php echo $c; ?>" <?php echo ($staff_order==$c)?'selected="selected"':''; ?>><?php echo $val; ?></option>
		
		
	<?php 
	$c=$c+1;
	
	} 
	?>
</select>
</td>
</tr>
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_signup_details'));?></strong></td></tr>
<tr><td colspan="3" align="left" style="border:1px solid #C1C1C1; background:#BFE0F9;" class="sign_upinfo_itemClass">
<?php
$counter = 0;
foreach($clint_signup_info_arr as $clint_signup_info)
{
		if($sign_upinfo_item_Arr != "" && in_array($clint_signup_info['sign_upinfo_item_id'], $sign_upinfo_item_Arr)) 
		{
			$VarCheckedSi = 'checked="checked"';
		}
		else
		{
			$VarCheckedSi = '';
		}
		$counter++;
		
		if($clint_signup_info['info_item_name'] == "cus_address")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line('customr_address'));
		}
		else if($clint_signup_info['info_item_name'] == "cus_fname")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_1st_name"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_lname")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_last_name"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_mob")
		{
					$info_item_name= $this->global_mod->db_parse($this->lang->line("customr_mobileno"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_phn1")
		{
					$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph1"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_phn2")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph2"));
		}
		else if($clint_signup_info['info_item_name'] == "time_zone_id")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph2"));
		}
		
?>
    <input type="checkbox" name="sign_upinfo_item[]" id="sign_upinfo_item[]"  <?php echo $VarCheckedSi; ?>
	value="<?php echo  $clint_signup_info['sign_upinfo_item_id']; ?>" onclick="ErrorDispsignupinfopHide()" /> 
	<?php echo $info_item_name; ?> &nbsp;&nbsp;
    
<?php
}
?>
<span id="ErrorDispsignupinfop" style="color:#F00;"></span>
</td></tr>

<!--######################-->
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('do_u_requir_flwng_info'))?></strong></td></tr>
<tr><td colspan="3" align="left" style="border:1px solid #C1C1C1; background:#BFE0F9;" class="sign_upinfo_itemClass">
<?php
if(isset($clint_edit_info_arr)){
$counter = 0;
foreach($clint_edit_info_arr as $clint_signup_info)
{
		if($clint_edit_info_arr != "" && in_array($clint_signup_info['sign_upinfo_item_id'], $edit_info_item_Arr)) 
		{
			$VarCheckedSi = 'checked="checked"';
		}
		else
		{
			$VarCheckedSi = '';
		}
		$counter++;
		
		if($clint_signup_info['info_item_name'] == "cus_address")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_address"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_fname")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_1st_name"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_lname")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_last_name"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_mob")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_mobileno"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_phn1")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph1"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_phn2")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph2"));
		}
		else if($clint_signup_info['info_item_name'] == "time_zone_id")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_time_zone"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_countryid")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_country"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_regionid")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_region"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_cityid")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_city"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_zip")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_postcode"));
		}
		
		
?>
    <input type="checkbox" name="edit_info_item[]" id="edit_info_item[]"  <?php echo $VarCheckedSi; ?>
	value="<?php echo  $clint_signup_info['sign_upinfo_item_id']; ?>" onclick="ErrorDispsignupinfopHide()" /> 
	<?php echo $info_item_name; ?> &nbsp;&nbsp;
    
<?php
}
}
?>
<span id="ErrorDispsignupinfop" style="color:#F00;"></span>
</td></tr>

<!--TROLOLOLOLOLOLOLOLOLO-->
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('do_u_requir_a_u_info'))?></strong></td></tr>
<tr><td colspan="3" align="left" style="border:1px solid #C1C1C1; background:#BFE0F9;" class="sign_upinfo_itemClass">
<?php
if(isset($admin_user_show_field_info_arr)){
$counter = 0;
foreach($admin_user_show_field_info_arr as $clint_signup_info)
{
		if($admin_user_show_field_info_arr != "" && in_array($clint_signup_info['sign_upinfo_item_id'], $admin_show_user_Arr)) 
		{
			$VarCheckedSi = 'checked="checked"';
		}
		else
		{
			$VarCheckedSi = '';
		}
		$counter++;
		
		if($clint_signup_info['info_item_name'] == "cus_address")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_address"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_fname")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_1st_name"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_lname")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_last_name"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_mob")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_mobileno"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_phn1")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph1"));
		}
                else if($clint_signup_info['info_item_name'] == "cus_phn2")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_ph2"));
		}
		else if($clint_signup_info['info_item_name'] == "time_zone_id")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customr_time_zone"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_countryid")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_country"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_regionid")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_region"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_cityid")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_city"));
		}
		else if($clint_signup_info['info_item_name'] == "cus_zip")
		{
			$info_item_name = $this->global_mod->db_parse($this->lang->line("customer_postcode"));
		}
		
		
?>
    <input type="checkbox" name="edit_admin_user_info_item[]" id="edit_admin_user_info_item[]"  <?php echo $VarCheckedSi; ?>
	value="<?php echo  $clint_signup_info['sign_upinfo_item_id']; ?>" onclick="ErrorDispsignupinfopHide()" /> 
	<?php echo $info_item_name; ?> &nbsp;&nbsp;
    
<?php
}
}
?>
<span id="ErrorDispsignupinfop" style="color:#F00;"></span>
</td>
</tr>
<!--&&&&&&&&&&&&&&&&&&&&&&-->

<tr><td colspan="3" align="left"><h2><?php echo $this->global_mod->db_parse($this->lang->line('rules_language_head'));?></h2></td></tr>
<tr><td colspan="3" align="left" style="border:1px solid #C1C1C1; background:#BFE0F9;" class="language_listClass">



<?php foreach($language_list_arr as $language_list) { ?>
<?php 
if($language_list_Arr != "" && in_array($language_list['languages_id'], $language_list_Arr)) 
{
    $VarChecked = 'checked="checked"';
}
else
{
	$VarChecked = '';
}

if($language_list['languages_id'] == 1){
	$VarChecked = 'checked="checked"';
}
?>
    <input type="checkbox" name="language_list[]" id="language_list[]"  <?php echo $VarChecked; ?>
	value="<?php echo  $language_list['languages_id']; ?>" onclick="ErrorDisplanguage_listHide()" /> <?php echo $language_list['languages_name']; ?> &nbsp;&nbsp;
<?php } ?>
<span id="ErrorDisplanguage_list" style="color:#F00;"></span>
<br /><br />
<?php echo $this->global_mod->db_parse($this->lang->line('rules_default_language'));?>  
<select id="default_language_id" style="width: 180px;" name="default_language_id">
<?php foreach($language_list_arr as $language_list) { ?>
	<option value="<?php echo $language_list['languages_id'] ; ?>" 
	<?php if($default_language_id != "" && $default_language_id == $language_list['languages_id'] ){?> selected="selected" <?php } ?> >
	<?php echo $language_list['languages_name'] ; ?></option>
<?php } ?>
</select>
</td></tr>




<?php if (in_array(80, $this->global_mod->authArray())){ ?>
<tr><td colspan="3" align="left"><h2><?php echo $this->global_mod->db_parse($this->lang->line('rules_login_method'));?>: :</h2></td></tr>
<tr><td colspan="3" align="left" style="border:1px solid #C1C1C1; background:#BFE0F9;" class="checkBx">
<strong><?php echo $this->global_mod->db_parse($this->lang->line('rules_def_book_scrn'));?></strong>&nbsp;&nbsp;&nbsp;&nbsp;
<?php 
	$counter3 = 0;
	foreach($login_types_arr as $login_types) { 
	if($login_typ_Arr != "" &&  in_array($login_types['login_typ_id'], $login_typ_Arr)){
		$VarCheckedLogin = 'checked="checked"';
		$DispControl = '';
		
	}else{
		$VarCheckedLogin = '';
		$DispControl = 'style="display:none;"';
		
	}
	$counter3++;
	
	
?>
    <input type="checkbox" <?php if($counter3==1){ ?>checked="checked"<?php } ?> name="login_typ[]" id="<?php echo $login_types['login_identifier']; ?>" <?php echo $VarCheckedLogin; ?> 
	value="<?php echo $login_types['login_typ_id']; ?>" onclick="radiocontrol('<?php echo $login_types['login_identifier']; ?>',this)" /> <?php echo $login_types['login_name']; ?> &nbsp;&nbsp;
<?php } ?>

 <span id="ErrorDisp" style="color:#F00;"></span>
<span contentId="15" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<br/><br/>

<?php
$counter4 = 0;

foreach($login_types_arr as $login_types) { 
$counter4++;


	if($login_typ_Arr != "" &&  in_array($login_types['login_typ_id'], $login_typ_Arr)) 
	{
		$DispControl = ';display:block;';
		
	}
	else
	{
		$DispControl = ';display:none;';
		
	}

//echo in_array($login_types['login_typ_id'], $login_typ_Arr)."<<<<<<<<<<<<<<<";


?>
<div style="float:left;<?php echo $DispControl; ?>" id="<?php echo $login_types['login_identifier']; ?>_radiospan" >
<input type="radio" name="default_login_typ_id" id="default_login_typ_id" value="<?php echo $login_types['login_typ_id']; ?>" onclick="hideerror()" 

<?php if($default_login_typ_id != "" && $default_login_typ_id == $login_types['login_typ_id']){?>checked="checked" <?php } ?>/>
<?php echo $login_types['login_name']; ?>&nbsp;&nbsp;


<?php if($login_types['login_identifier'] == 'pardco_login') { ?>
<input type="radio" name="default_login_typ_id" id="default_login_typ_id" value="0" onclick="hideerror()" 

<?php if($default_login_typ_id != "" && $default_login_typ_id == 0){?>checked="checked" <?php } ?>/> <?php echo $this->global_mod->db_parse($this->lang->line('rules_signup_option'));?> &nbsp;&nbsp;
<?php } ?>
</div>
<?php } ?>
</p>
</td></tr>

<?php }else{ ?>
	<!--input type="hidden" name="default_login_typ_id" id="default_login_typ_id" value="1" / -->
	<input type="radio" name="default_login_typ_id" id="default_login_typ_id" value="1" checked="checked" style="display: none;"  />
<?php
	  }
	  ?>
<tr><td colspan="3" align="left"><h2><?php echo $this->global_mod->db_parse($this->lang->line('rules_appo_cancel_head'));?></h2></td></tr>
<tr>
<td colspan="2">
<input type="radio" name="cal_time_interval_typ" id="cal_time_interval_typ_1" value="1" 
<?php if($cal_time_interval_typ != "" && $cal_time_interval_typ == 1){ echo 'checked="checked"';  } ?> onclick="disabledAll();" />&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_time_slot_cal_auto'));?>
<span contentId="16" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="3">
<input type="radio" name="cal_time_interval_typ" id="cal_time_interval_typ_2" value="2" 
<?php if($cal_time_interval_typ != "" && $cal_time_interval_typ == 2){ echo 'checked="checked"';  } ?> onclick="disabledOne('cal_time_interval_variable_2','cal_time_interval_variable_3');" />&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_set_fix_time_intrvl'));?> 
	
<input type="text" name="cal_time_interval_variable_2" id="cal_time_interval_variable_2"  style="border:1px solid #B7B7B7;width: 180px;" 

value="<?php if($cal_time_interval_variable != "" && $cal_time_interval_typ == 2 ){ echo $cal_time_interval_variable;  } ?>"/><?php echo $this->global_mod->db_parse($this->lang->line('rules_mins'));?> 
<span contentId="17" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_radio2" style="color:#F00;"></span>

</td>
</tr>

<tr><td colspan="3">&nbsp;</td></tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_before_appo_book'));?></td>
<td>
<input type="text" maxlength="3" name="adv_bk_min_tim" id="adv_bk_min_tim"  style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($adv_bk_min_tim != ""){ echo $adv_bk_min_tim;  } ?>" />&nbsp;&nbsp;

<select id="adv_bk_min_setting" name="adv_bk_min_setting" style="width: 89px;">
<option value="1" <?php if($adv_bk_min_setting != "" && $adv_bk_min_setting == 1 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_days'));?></option>
<option value="2" <?php if($adv_bk_min_setting != "" && $adv_bk_min_setting == 2 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs'));?></option>
<option value="3" <?php if($adv_bk_min_setting != "" && $adv_bk_min_setting == 3 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_min'));?></option>
</select>
<span contentId="19" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_adv_bk_min_tim" class="error"></span>
</td>
</tr>


<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_before_appo_cancel'));?></td>
<td>
<input type="text" maxlength="3" name="bkin_can_mx_tim" id="bkin_can_mx_tim" style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($bkin_can_mx_tim != ""){ echo $bkin_can_mx_tim;  } ?>"/>&nbsp;&nbsp;
<select id="bkin_can_setin" name="bkin_can_setin" style="width: 89px;">
<option value="1" <?php if($bkin_can_setin != "" && $bkin_can_setin == 1 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_days'));?></option>
<option value="2" <?php if($bkin_can_setin != "" && $bkin_can_setin == 2 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs'));?></option>
</select>


<span contentId="20" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_bkin_can_mx_tim" class="error"></span>
</td>
</tr>



<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_before_appo_reschedule'));?></td>
<td>
<input type="text" maxlength="3" name="bkin_reschdl_mx_tim" id="bkin_reschdl_mx_tim"  style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($bkin_reschdl_mx_tim != ""){ echo $bkin_reschdl_mx_tim;  } ?>"/>&nbsp;&nbsp;
<select id="bkin_reschdl_setin" name="bkin_reschdl_setin" style="width: 89px;">
<option value="1" <?php if($bkin_reschdl_setin != "" && $bkin_reschdl_setin == 1 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_days'));?></option>
<option value="2" <?php if($bkin_reschdl_setin != "" && $bkin_reschdl_setin == 2 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs'));?></option>
</select>
<span contentId="21" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_bkin_reschdl_mx_tim" class="error"></span>
</td>
</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_appo_advance_book'));?></td>
<td>
<input type="text" name="adv_bk_mx_tim" maxlength="3" id="adv_bk_mx_tim"  style="border:1px solid #B7B7B7;width: 180px;" value="<?php if($adv_bk_mx_tim != ""){ echo $adv_bk_mx_tim;  } ?>"/>&nbsp;&nbsp;
<span contentId="22" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_adv_bk_mx_tim" class="error"></span>
</td>

</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_appo_intervl_time'));?></td>
<td>
<input type="text" maxlength="3" name="tim_intrvl_btwn_appo" id="tim_intrvl_btwn_appo"  style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($tim_intrvl_btwn_appo != ""){ echo $tim_intrvl_btwn_appo;  } ?>"/>&nbsp;&nbsp;
<select id="tim_intrvl_btwn_appo_settingin" name="tim_intrvl_btwn_appo_settingin" style="width: 89px;">
<option value="1" <?php if($tim_intrvl_btwn_appo_settingin != "" && $tim_intrvl_btwn_appo_settingin == 1 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_days'));?></option>
<option value="2" <?php if($tim_intrvl_btwn_appo_settingin != "" && $tim_intrvl_btwn_appo_settingin == 2 ){?> selected="selected" <?php } ?>><?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs'));?></option>
</select>
<span contentId="23" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
<span id="error_msg_tim_intrvl_btwn_appo" class="error"></span>
</td>
</tr>

<tr>
<td width="25%"><?php echo $this->global_mod->db_parse($this->lang->line('rules_administr_time_intrvl'));?> </td>
<td>
<select id="admn_tim_intrvl" name="admn_tim_intrvl" style="border:1px solid #B7B7B7;width: 180px;">
	<option value="5" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 5 ){?> selected="selected" <?php } ?>>5</option>
	<option value="10" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 10 ){?> selected="selected" <?php } ?>>10</option>
	<option value="15" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 15 ){?> selected="selected" <?php } ?>>15</option>
	<option value="20" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 20 ){?> selected="selected" <?php } ?>>20</option>
	<option value="30" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 30 ){?> selected="selected" <?php } ?>>30</option>
	<option value="60" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 60 ){?> selected="selected" <?php } ?>>60</option>
</select>
<span contentId="24" class="tooltips">&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>

<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><h2><?php echo $this->global_mod->db_parse($this->lang->line('rules_sms_alert_head'));?></h2></td></tr>

<?php if (in_array(35, $this->global_mod->authArray())){		?>
<!--**********************************************************************-->
<!--**********************************************************************-->
<!--**********************************************************************-->
<tr><td colspan="3" align="left"><?php echo $this->global_mod->db_parse($this->lang->line('rules_send_alert_clients'));?></td></tr>
<tr>
<td colspan="3">
<input type="checkbox" name="sms_alrt_bfr_appo_chk" id="sms_alrt_bfr_appo_chk" value="1" <?php if($sms_alert != "" && $sms_alert == 1 ){?> checked="checked" <?php } ?> />
<?php echo $this->global_mod->db_parse($this->lang->line('rules_send_alerts_to_clients'));?>  
<input type="text" maxlength="" name="sms_alrt_bfr_appo" id="sms_alrt_bfr_appo" style="border:1px solid #B7B7B7;width: 89px;" value="<?php if($sms_alrt_bfr_appo != ""){ echo $sms_alrt_bfr_appo;  } ?>"/>&nbsp;&nbsp;
 <?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs_prior_to'));?> 
 <span id="error_msg_sms_alrt_bfr_appo" class="error"></span>
</td>
</tr>
<tr>
<td colspan="3">
<input type="checkbox" name="sms_thanks_aftrappo" id="sms_thanks_aftrappo" value="1" <?php if($sms_thanks_aftrappo != "" && $sms_thanks_aftrappo == 1 ){?> checked="checked" <?php } ?>/>  
<?php echo $this->global_mod->db_parse($this->lang->line('rules_thnx_courtesy'));?>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><?php echo $this->global_mod->db_parse($this->lang->line('rules_alert_on_appo'));?></td></tr>
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_when_to_send'));?></strong></td></tr>
<tr>
<td>
<input type="radio" name="send_sms_for" id="send_sms_for" value="1"  <?php if(($send_sms_for != "" && $send_sms_for == 1) || $send_sms_for == "" ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_never_send_sms'));?> 
</td>
</tr>
<tr>
<td>
<input type="radio" name="send_sms_for" id="send_sms_for" value="2" <?php if($send_sms_for != "" && $send_sms_for == 2 ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_appo_require_approv'));?> 
</td>
</tr>
<tr>
<td>
<input type="radio" name="send_sms_for" id="send_sms_for" value="3" <?php if($send_sms_for != "" && $send_sms_for == 3 ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_every_time_appo_bk'));?>
</td>
</tr>
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_whom_to_send'));?></strong></td></tr>
<tr><td colspan="3">
<input type="checkbox" name="sms_alart_to_admin" id="sms_alart_to_admin" value="1" checked="checked" 
<?php if(($sms_alart_to_admin != "" && $sms_alart_to_admin == 1) || $sms_alart_to_admin == "" ){?>checked="checked" <?php } ?>/> <?php echo $this->global_mod->db_parse($this->lang->line('rules_whom_to_send_admin'));?> 
<input type="checkbox" name="sms_alart_to_staff" id="sms_alart_to_staff" value="1" checked="checked" 
<?php if(($sms_alart_to_staff != "" && $sms_alart_to_staff == 1) || $sms_alart_to_staff == "" ){?>checked="checked" <?php } ?>/>  <?php echo $this->global_mod->db_parse($this->lang->line('rules_whom_to_send_staff'));?>
</td>
</tr>
<tr>	
	<td colspan="6" align="left" >
	<?php echo $this->global_mod->db_parse($this->lang->line('rules_note_sms_alert'));?>
		<select id="sms_rate" style="border:1px solid #B7B7B7;width: 180px;" onchange="showRate(this.value)">
			<?php foreach($allSmsCountry as $country ){ ?>
				<option  value="<?php echo $country['country_id'];  ?>"  <?php echo ($local_admin_country==$country['country_id'])?'selected=""':''; ?>><?php echo $country['country_name'];  ?></option>
			<?php } ?>
		</select>
		<?php echo $this->global_mod->db_parse($this->lang->line('rules_costs'));?> 
		<span id="sms_cost_span"><?php echo $getSmsRate; ?></span>
		<?php echo $this->global_mod->db_parse($this->lang->line('rules_cents'));?>
	</td>
</tr>
<!--**********************************************************************-->
<!--**********************************************************************-->
<!--**********************************************************************-->
<?php }else{ ?>
<!--**********************************************************************-->
<!--**********************************************************************-->
<!--**********************************************************************-->
<tr><td colspan="3" align="left"><?php echo $this->global_mod->db_parse($this->lang->line('rules_send_alert_clients'));?></td></tr>
<tr>
<td colspan="3">
<input disabled="true" type="checkbox" name="sms_alrt_bfr_appo_chk" id="sms_alrt_bfr_appo_chk" value="1" <?php if($sms_alert != "" && $sms_alert == 1 ){?> checked="checked" <?php } ?> onfocus="authAlert()" />
<?php echo $this->global_mod->db_parse($this->lang->line('rules_send_alerts_to_clients'));?>  
<input readonly="true" type="text" maxlength="" name="sms_alrt_bfr_appo" id="sms_alrt_bfr_appo" style="border:1px solid #B7B7B7;width: 89px;" value="<?php if($sms_alrt_bfr_appo != ""){ echo $sms_alrt_bfr_appo;  } ?>" onfocus="authAlert()"/>&nbsp;&nbsp;
 <?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs_prior_to'));?> 
 <span id="error_msg_sms_alrt_bfr_appo" class="error"></span>
</td>
</tr>
<tr>
<td colspan="3">
<input disabled="true" type="checkbox" name="sms_thanks_aftrappo" id="sms_thanks_aftrappo" value="1" <?php if($sms_thanks_aftrappo != "" && $sms_thanks_aftrappo == 1 ){?> checked="checked" <?php } ?> onfocus="authAlert()"/>  
<?php echo $this->global_mod->db_parse($this->lang->line('rules_thnx_courtesy'));?>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><?php echo $this->global_mod->db_parse($this->lang->line('rules_alert_on_appo'));?></td></tr>
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_when_to_send'));?></strong></td></tr>
<tr>
<td>
<input disabled="true" type="radio" onfocus="authAlert()" name="send_sms_for" id="send_sms_for" value="1"  <?php if(($send_sms_for != "" && $send_sms_for == 1) || $send_sms_for == "" ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_never_send_sms'));?> 
</td>
</tr>
<tr>
<td>
<input disabled="true" type="radio" onfocus="authAlert()" name="send_sms_for" id="send_sms_for" value="2" <?php if($send_sms_for != "" && $send_sms_for == 2 ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_appo_require_approv'));?> 
</td>
</tr>
<tr>
<td>
<input disabled="true" type="radio" onfocus="authAlert()" name="send_sms_for" id="send_sms_for" value="3" <?php if($send_sms_for != "" && $send_sms_for == 3 ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
<?php echo $this->global_mod->db_parse($this->lang->line('rules_every_time_appo_bk'));?>
</td>
</tr>
<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_whom_to_send'));?></strong></td></tr>
<tr><td colspan="3">
<input disabled="true" type="checkbox" onfocus="authAlert()" name="sms_alart_to_admin" id="sms_alart_to_admin" value="1" checked="checked" 
<?php if(($sms_alart_to_admin != "" && $sms_alart_to_admin == 1) || $sms_alart_to_admin == "" ){?>checked="checked" <?php } ?>/> <?php echo $this->global_mod->db_parse($this->lang->line('rules_whom_to_send_admin'));?> 
<input disabled="true" type="checkbox" onfocus="authAlert()" name="sms_alart_to_staff" id="sms_alart_to_staff" value="1" checked="checked" 
<?php if(($sms_alart_to_staff != "" && $sms_alart_to_staff == 1) || $sms_alart_to_staff == "" ){?>checked="checked" <?php } ?>/>  <?php echo $this->global_mod->db_parse($this->lang->line('rules_whom_to_send_staff'));?>
</td>
</tr>
<tr>	
	<td colspan="6" align="left" >
	<?php echo $this->global_mod->db_parse($this->lang->line('rules_note_sms_alert'));?>
		<select id="sms_rate" style="border:1px solid #B7B7B7;width: 180px;" onchange="showRate(this.value)" onfocus="authAlert()" disabled="true">
			<?php foreach($allSmsCountry as $country ){ ?>
				<option  value="<?php echo $country['country_id'];  ?>"  <?php echo ($local_admin_country==$country['country_id'])?'selected=""':''; ?>><?php echo $country['country_name'];  ?></option>
			<?php } ?>
		</select>
		<?php echo $this->global_mod->db_parse($this->lang->line('rules_costs'));?> 
		<span id="sms_cost_span"><?php echo $getSmsRate; ?></span>
		<?php echo $this->global_mod->db_parse($this->lang->line('rules_cents'));?>
	</td>
</tr>	
<!--**********************************************************************-->
<!--**********************************************************************-->
<!--**********************************************************************-->
<?php } ?>

<tr>	
	<td colspan="3">&nbsp;</td>	
</tr>

<?php if (in_array(82, $this->global_mod->authArray())){ ?>

<tr><td colspan="3" align="left"><h2><?php echo $this->global_mod->db_parse($this->lang->line('rules_condition_for_email'));?>  </h2></td></tr>

<tr><td colspan="3" align="left"><strong style="font-size:13px;"><?php echo $this->global_mod->db_parse($this->lang->line('rules_email_alert_client'));?></strong></td></tr>



<tr>
<td colspan="3">
<input type="checkbox" name="email_alrt_bfr_appo_chk" id="email_alrt_bfr_appo_chk" value="1" 
<?php if(($email_alert != "" && $email_alert == 1) || $email_alert == "" ){?>checked="checked" <?php } ?> />
 <?php echo $this->global_mod->db_parse($this->lang->line('rules_email_alerts_clients'));?> 
<input type="text" maxlength="" name="email_alrt_bfr_appo" id="email_alrt_bfr_appo" style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($email_alrt_bfr_appo != ""){ echo $email_alrt_bfr_appo;  } ?>"/>&nbsp;&nbsp;
 <?php echo $this->global_mod->db_parse($this->lang->line('rules_hrs_prior_appo'));?> 
</td>
</tr>
<?php } ?>

 
</table>
</div>
<input style="margin:30px 30px 30px 100px;" type="submit" name="submit" id="submit" class="btn-blue" value="<?php echo $this->global_mod->db_parse($this->lang->line('rules_save_settingbtn'));?>" />
</div>

<input type="hidden" name="local_admin_id" id="local_admin_id" value="<?php echo $local_admin_id;?>" />
</form>
