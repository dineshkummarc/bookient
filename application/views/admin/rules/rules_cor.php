<?php include('rules.js.php'); ?>

<div class="rounded_corner">
<h1 class="headign-main"><?php echo $this->lang->line('rules');?></h1>
<?php 
	if(count($SettingData) != 0) 
	{ 
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
		$language_list_Arr 					 = $SettingData['language_list']; 
		$login_typ_Arr 					     = $SettingData['login_typ']; 
	}
	else
	{
		$local_admin_id					=""; 
		$enable_system 					=""; 
		$aprvl_rqrd_pre_payin_mem		=""; 
		
		$aprvl_rqrd_mob_verfd_mem		=""; 
		$aprvl_rqrd_mob_non_verfd_mem	=""; 
		
		$no_of_booking 					=""; 
		$no_of_booking_period			=""; 
		$booking_starting_point  		=""; 
		$no_of_booking_period_from		=""; 
		$no_of_booking_period_to 		=""; 
		$recurring_appointments  		=""; 
		$recurring_admin 				=""; 
		$quantity_appointment_setting	=""; 
		$quantity_appointment        	=""; 
		$allow_international_users		=""; 
		$detect_client_timezone  		=""; 
		$show_service_cost  			=""; 
		$show_service_time_duration  	=""; 
		
		$booked_times_striked			=""; 
		$blocked_times_striked_out		=""; 
		
		$clients_name_with_reviews		=""; 
		$default_view  					=""; 
		
		$cal_strting_weekday			=""; 
		$cal_strting_dt					=""; 
		$show_staff_customers			=""; 
		$staff_selection_mandatory		=""; 
		$staff_order					=""; 
		
		$default_language_id			=""; 
		$default_login_typ_id			=""; 
		$cal_time_interval_typ  		=""; 
		$cal_time_interval_variable  	=""; 
		
		
		$adv_bk_min_setting				=""; 
		$adv_bk_min_tim					="";
		$tim_intrvl_btwn_appo_settingin	="";
		$adv_bk_mx_tim					="";
		$bkin_can_setin					="";
		$bkin_can_mx_tim				="";
		$bkin_reschdl_setin				="";
		$bkin_reschdl_mx_tim			="";
		$tim_intrvl_btwn_appo			="";
		$admn_tim_intrvl				="";
		
		$sms_alert		  			    =""; 
		$sms_alrt_bfr_appo  			=""; 
		$sms_thanks_aftrappo			=""; 
		$send_sms_for  					=""; 
		$sms_alart_to_admin 			=""; 
		$sms_alart_to_staff				=""; 
		$email_alert  					=""; 
		$email_alrt_bfr_appo			=""; 
		
		$sign_upinfo_item_Arr 		    = ""; 
		$language_list_Arr 				=""; 
		$login_typ_Arr 					=""; 
	}
?>

    

<form action="<?php echo base_url(); ?>admin/rules/add_rules" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
<div class="inner-div">
<table align="left" width="58%">

<tr>
<td width="35%">Do you want to enable clients to book appointments directly from the site? :</td>
<td width="19%" align="left">
<input id="site_enb" type="radio" <?php if(($enable_system != "" && $enable_system == 1) || $enable_system == "" ){?>checked="checked" <?php } ?>  value="1" name="site_enb"> Yes
<input id="site_enb" type="radio" <?php if($enable_system != "" && $enable_system == 0){ echo 'checked="checked"';  } ?> value="0" name="site_enb"> No
</td>
</tr>
</table>
</div>
<div style="height:30px;"></div>

<h2>Who can book appointments?</h2>
<div class="inner-div">
<table id="TotalData" align="center" width="100%">
<tr>
<td width="25%">Pre-Paying Members :</td>
<td>
<select id="aprvl_rqrd_pre_payin_mem"  name="aprvl_rqrd_pre_payin_mem">
<option value="0" <?php if($aprvl_rqrd_pre_payin_mem != "" && $aprvl_rqrd_pre_payin_mem == 0 ){?> selected="selected" <?php } ?>>Does not require Approval</option>
<option value="1" <?php if(($aprvl_rqrd_pre_payin_mem != "" && $aprvl_rqrd_pre_payin_mem == 1) || $aprvl_rqrd_pre_payin_mem == "" ){?> selected="selected" <?php } ?>>Requires Approval</option>
</select>
</td>
</tr>



<tr>
<td  width="25%">Phone Verified Members</td>
<td>
<select id="aprvl_rqrd_mob_verfd_mem"  name="aprvl_rqrd_mob_verfd_mem">
<option value="0" <?php if($aprvl_rqrd_mob_verfd_mem != "" && $aprvl_rqrd_mob_verfd_mem == 0 ){?> selected="selected" <?php } ?>>Does not require Approval</option>
<option value="1" <?php if(($aprvl_rqrd_pre_payin_mem != "" && $aprvl_rqrd_pre_payin_mem == 1) || $aprvl_rqrd_pre_payin_mem == "" ){?> selected="selected" <?php } ?>>Requires Approval</option>
</select>
</td>
</tr>

<tr>
<td  width="25%">Non Phone Verified Members</td>
<td>
<select id="aprvl_rqrd_mob_non_verfd_mem"  name="aprvl_rqrd_mob_non_verfd_mem">
<option value="0"  <?php if($aprvl_rqrd_mob_non_verfd_mem != "" && $aprvl_rqrd_mob_non_verfd_mem == 0 ){?> selected="selected" <?php } ?>>Does not require Approval</option>
<option value="1" <?php if(($aprvl_rqrd_mob_non_verfd_mem != "" && $aprvl_rqrd_mob_non_verfd_mem == 1) || $aprvl_rqrd_mob_non_verfd_mem == "" ){?> selected="selected" <?php } ?>>Requires Approval</option>
</select>
</td>
</tr>

<tr><td colspan="3" align="left"><h2 style="margin:0px;">Booking Restrictions</h2></td></tr>

<tr>
<td  width="25%"> Apply restriction on number of bookings. :</td>

<td>
<input id="applyAdvanceBookingRule" type="checkbox" onclick="DispDtls();" name="applyAdvanceBookingRule" value="1" <?php if($no_of_booking != "" && $no_of_booking != 0 ){?> checked="checked" <?php } ?>>
</td>
</tr>








<tr><td colspan="3" align="left">
<div id="AdvBookingDtlsShowHide" style="display:none;"><!--style="display:none;"-->
<table align="right" width="100%">
<tr>
<td width="25%"> Bookings Allowed </td>
<td >
<select id="no_of_booking_period" style="width: 280px;" onchange="DispDtlsControl()" name="no_of_booking_period">
<option value="1"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 1 ){?> selected="selected" <?php } ?>>Unlimited</option>
<option value="2"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 2 ){?> selected="selected" <?php } ?>>Not allowed</option>
<option value="3"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 3 ){?> selected="selected" <?php } ?>>Daily</option>
<option value="4"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 4 ){?> selected="selected" <?php } ?>>Weekly</option>
<option value="5"  <?php if(($no_of_booking_period != "" && $no_of_booking_period == 5) || $no_of_booking_period == "" ){?> selected="selected" <?php } ?>>Monthly</option>
<option value="6"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>Yearly</option>
<option value="7"  <?php if($no_of_booking_period != "" && $no_of_booking_period == 7 ){?> selected="selected" <?php } ?>>Fixed Date</option>
</select>
</td>
</tr>


<tr id="no_of_bookingRestrictyinTd">
<td width="25%"> Restriction</td>
<td>
<input id="no_of_booking" type="text" value="<?php if($no_of_booking != ""){ echo $no_of_booking;  } ?>" name="no_of_booking" style="border:1px solid #B7B7B7;width: 268px;">
</td>
</tr>


<tr id="MonthDateSelectionTd">
<td width="25%"> Start Week Day</td>
<td>
<select id="weekDaySelection" style="width:277px;" name="weekDaySelection">
<?php for($i=1; $i<=30; $i++) { ?>
<option value="<?php echo $i;?>" <?php if($booking_starting_point != "" && $booking_starting_point == $i && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>><?php echo $i; ?></option> 
<?php } ?>
</select>
</td>
</tr>

<tr  id="weekDaySelectionTd">
<td width="25%"> Start Month Date</td>
<td>
<select id="MonthDateSelection" style="width:268px;" name="MonthDateSelection">
<option value="1"  <?php if($booking_starting_point != "" && $booking_starting_point == 1 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Sunday</option>
<option value="2"  <?php if($booking_starting_point != "" && $booking_starting_point == 2 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Monday</option>
<option value="3"  <?php if($booking_starting_point != "" && $booking_starting_point == 3 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Tuesday</option>
<option value="4"  <?php if($booking_starting_point != "" && $booking_starting_point == 4 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Wednesday</option>
<option value="5"  <?php if($booking_starting_point != "" && $booking_starting_point == 5 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Thursday</option>
<option value="6"  <?php if($booking_starting_point != "" && $booking_starting_point == 6 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Friday</option>
<option value="7"  <?php if($booking_starting_point != "" && $booking_starting_point == 7 && $no_of_booking_period == 5 ){?> selected="selected" <?php } ?>>Saturday</option>
</select>
</td>
</tr>



<tr id="MonthSelectionTd">
<td width="25%"> Start Month</td>
<td>
<select id="MonthSelection" style="width:268px;" name="MonthSelection">
<option value="1"  <?php if($booking_starting_point != "" && $booking_starting_point == 1 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>January</option>
<option value="2"  <?php if($booking_starting_point != "" && $booking_starting_point == 2 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>February</option>
<option value="3"  <?php if($booking_starting_point != "" && $booking_starting_point == 3 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>March</option>
<option value="4"  <?php if($booking_starting_point != "" && $booking_starting_point == 4 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>April</option>
<option value="5"  <?php if($booking_starting_point != "" && $booking_starting_point == 5 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>May</option>
<option value="6"  <?php if($booking_starting_point != "" && $booking_starting_point == 6 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>June</option>
<option value="7"  <?php if($booking_starting_point != "" && $booking_starting_point == 7 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>July</option>
<option value="8"  <?php if($booking_starting_point != "" && $booking_starting_point == 8 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>August</option>
<option value="9"  <?php if($booking_starting_point != "" && $booking_starting_point == 9 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>September</option>
<option value="10" <?php if($booking_starting_point != "" && $booking_starting_point == 10 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>October</option>
<option value="11" <?php if($booking_starting_point != "" && $booking_starting_point == 11 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>November</option>
<option value="12" <?php if($booking_starting_point != "" && $booking_starting_point == 12 && $no_of_booking_period == 6 ){?> selected="selected" <?php } ?>>December</option>
</select>
</td>
</tr>

<tr id="no_of_booking_period_fromTd">
<td width="25%"> From</td>
<td>
<input type="text" name="no_of_booking_period_from" id="no_of_booking_period_from" autocomplete="off" value="<?php if($no_of_booking_period_from != ""){ echo $no_of_booking_period_from;  } ?>" maxlength="30" style="border:1px solid #B7B7B7;width:268px;" />
</td>
</tr>



<tr id="no_of_booking_period_toTd">
<td width="25%"> Till</td>
<td>
<input type="text" name="no_of_booking_period_to" id="no_of_booking_period_to" autocomplete="off" value="<?php if($no_of_booking_period_to != ""){ echo $no_of_booking_period_to;  } ?>" maxlength="30" style="border:1px solid #B7B7B7;width:268px;" />
</td>
</tr>


</table>
</div>
</td></tr>

<tr>
<td width="25%"> Do you want to allow clients to book recurring appointments?  </td>
<td>
<input id="recurring_appointments" type="radio" <?php if(($recurring_appointments != "" && $recurring_appointments == 1) || $recurring_appointments == "" ){?> checked="checked" <?php } ?> value="1" name="recurring_appointments"> Yes
<input id="recurring_appointments" type="radio" <?php if($recurring_appointments != "" && $recurring_appointments == 0){?> checked="checked" <?php } ?> value="0" name="recurring_appointments"> No
</td>
</tr>


<tr>
<td width="25%">  Do you want to show recurring option for Admin? </td
><td>
<input id="recurring_admin" type="radio" <?php if(($recurring_admin != "" && $recurring_admin == 1) || $recurring_admin == "" ){?> checked="checked" <?php } ?>  value="1" name="recurring_admin"> Yes
<input id="recurring_admin" type="radio" <?php if($recurring_admin != "" && $recurring_admin == 0){?> checked="checked" <?php } ?> value="0" name="recurring_admin"> No
</td>
</tr>



<tr>
<td width="25%">Do you want to allow clients to select quantity for their appointment? </td>
<td>
<input  id="quantity_appointment_setting" type="radio" value="1" <?php if(($quantity_appointment_setting != "" && $quantity_appointment_setting == 1) || $quantity_appointment_setting == "" ){?> checked="checked"  <?php } ?> name="quantity_appointment_setting"> Yes
<input id="quantity_appointment_setting" type="radio" value="0"  <?php if($quantity_appointment_setting != "" && $quantity_appointment_setting == 0){?> checked="checked" <?php } ?>   name="quantity_appointment_setting"> No
</td>
</tr>



<tr id="quantity_appointmentTd">
<td width="25%">Enter the alias for quantity</td>
<td>
<input id="quantity_appointment" type="text" maxlength="20" value="<?php if($quantity_appointment != ""){ echo $quantity_appointment;  } ?>" name="quantity_appointment" style="border:1px solid #B7B7B7;width:268px;">
</td>
</tr>

<tr>
<td width="25%">Do you want to allow international users (outside your country) to book appointments? </td>
<td>
<input id="allow_international_users" type="radio" <?php if(($allow_international_users != "" && $allow_international_users == 1) || $allow_international_users == "" ){?> checked="checked" <?php } ?> value="1" name="allow_international_users"> Yes
<input id="allow_international_users" type="radio" <?php if($allow_international_users != "" && $allow_international_users == 0){?> checked="checked" <?php } ?> value="0" name="allow_international_users"> No
</td>
</tr>

<tr id="detect_client_timezoneTd">
<td width="25%">Do you want to detect client's timezone automatically and show your availability accordingly?</td>
<td>
<input id="detect_client_timezone" type="radio"  <?php if(($detect_client_timezone != "" && $detect_client_timezone == 1 && $allow_international_users == 1) || $detect_client_timezone == "" ){?> checked="checked"  <?php } ?>  value="1" name="detect_client_timezone"> Yes
<input id="detect_client_timezone" type="radio" <?php if($detect_client_timezone != "" && $detect_client_timezone == 0 && $allow_international_users == 1){?> checked="checked" <?php } ?>  value="0" name="detect_client_timezone"> No
</td>
</tr>

<tr>
<td width="25%">Do you want to show service cost to your clients?</td>
<td>
<input id="show_service_cost" type="radio" <?php if(($show_service_cost != "" && $show_service_cost == 1) || $show_service_cost == "" ){?> checked="checked" <?php } ?> value="1" name="show_service_cost"> Yes
<input id="show_service_cost" type="radio"  <?php if($show_service_cost != "" && $show_service_cost == 0){?> checked="checked" <?php } ?>  value="0" name="show_service_cost"> No
</td>
</tr>

<tr>
<td width="25%">Do you want to show service time duration to your clients?</td>
<td>
<input id="show_service_time_duration" type="radio" <?php if(($show_service_time_duration != "" && $show_service_time_duration == 1) || $show_service_time_duration == "" ){?> checked="checked" <?php } ?> value="1" name="show_service_time_duration"> Yes
<input id="show_service_time_duration" type="radio" <?php if($show_service_time_duration != "" && $show_service_time_duration == 0){?> checked="checked" <?php } ?> value="0" name="show_service_time_duration"> No
</td>
</tr>

<tr>
<td width="25%">Do you want to show booked times as striked out? </td>
<td>
<input id="booked_times_striked" type="radio"<?php if(($booked_times_striked != "" && $booked_times_striked == 1) || $booked_times_striked == "" ){?> checked="checked" <?php } ?> value="1" name="booked_times_striked"> Yes
<input id="booked_times_striked" type="radio"  <?php if($booked_times_striked != "" && $booked_times_striked == 0){?> checked="checked" <?php } ?> value="0" name="booked_times_striked"> No
</td>
</tr>

<tr id="blocked_times_striked_outTd">
<td width="25%">Do you also want to show blocked times as striked out? </td>
<td>
<input id="blocked_times_striked_out" type="radio"  value="1" name="blocked_times_striked_out"
<?php if(($blocked_times_striked_out != "" && $blocked_times_striked_out == 1 && $booked_times_striked == 1) || $detect_client_timezone == "" || $booked_times_striked == "" || $booked_times_striked == 0  ){?> checked="checked"  <?php } ?>  > Yes
<input id="blocked_times_striked_out" type="radio"  name="blocked_times_striked_out" value="0"
<?php if($blocked_times_striked_out != "" && $blocked_times_striked_out == 0 && $booked_times_striked == 1){?> checked="checked" <?php } ?> > No
</td>
</tr>

<tr>
<td width="25%">Do you want to show clients name with reviews?</td>
<td>
<input id="clients_name_with_reviews" type="radio" value="1" name="clients_name_with_reviews"
<?php if(($clients_name_with_reviews != "" && $clients_name_with_reviews == 1) || $clients_name_with_reviews !=""){?> checked="checked"  <?php } ?>> Yes
<input id="clients_name_with_reviews" type="radio" value="0" name="clients_name_with_reviews" 
<?php if($clients_name_with_reviews != "" && $clients_name_with_reviews == 0){?> checked="checked"  <?php } ?>> No
</td>
</tr>

<tr>
<td width="25%">What view should be shown by default?</td>
<td>
<select id="default_view" name="default_view" style="width: 268px;">
<option value="0" <?php if(($default_view != "" && $default_view == 0) || $default_view !=""){?>selected="selected" <?php } ?>>Week</option>
<option value="1" <?php if($default_view != "" && $default_view == 1){?>selected="selected" <?php } ?>>Month</option>
<option value="2" <?php if($default_view != "" && $default_view == 2){?>selected="selected" <?php } ?>>Reviews/About Us</option>
</select>
</td>
</tr>

<tr>
<td width="25%">What should be your calendar's starting weekday?</td>
<td>
<select id="cal_strting_weekday" name="cal_strting_weekday" style="width: 268px;">
<option value="1" <?php if((!empty($cal_strting_weekday) && $cal_strting_weekday == 1) || $cal_strting_weekday !=""){?>selected="selected" <?php } ?>>Today</option>
<option value="2" <?php if(($cal_strting_weekday != "" && $cal_strting_weekday == 2) || $cal_strting_weekday !=""){?>selected="selected" <?php } ?>>Sunday</option>
<option value="3" <?php if(($cal_strting_weekday != "" && $cal_strting_weekday == 3) || $cal_strting_weekday !=""){?>selected="selected" <?php } ?>>Monday</option>
</select>
</td>
</tr>

<tr>
<td width="25%">What should be your calendar's starting date?</td>
<td>
<input type="text" name="cal_strting_dt" id="cal_strting_dt" autocomplete="off" 
value="<?php if(($cal_strting_dt != "" && $cal_strting_dt == 1) || $cal_strting_dt !=""){ }?>" 
maxlength="30" style="border:1px solid #B7B7B7;width: 268px;" />
</td>
</tr>




<tr><td colspan="3" align="left"><strong style="font-size:12px;">Staff setting on calendar </strong></td></tr>

<tr>
<td width="25%">Do you want to show staff to your customers?</td>
<td>
<input id="show_staff_customers" type="radio" <?php if(($show_staff_customers != "" && $show_staff_customers == 1) || $show_staff_customers !=""){?> checked="checked"  <?php } ?> value="1" name="show_staff_customers"> Yes
<input id="show_staff_customers" type="radio" value="0" <?php if($show_staff_customers != "" && $show_staff_customers == 0){?> checked="checked"  <?php } ?> name="show_staff_customers"> No
</td>
</tr>

<tr id="staff_selection_mandatoryTd">
<td width="25%">Do you want to make staff selection mandatory?</td>
<td>
<input id="staff_selection_mandatory" type="radio" <?php  if($staff_selection_mandatory != "" && $staff_selection_mandatory == 1 && $show_staff_customers == 1){?> checked="checked"  <?php } ?>  value="1" name="staff_selection_mandatory"> Yes
<input id="staff_selection_mandatory" type="radio" <?php  if(($staff_selection_mandatory != "" && $staff_selection_mandatory == 0 && $show_staff_customers == 1) || $detect_client_timezone == "" ){?> checked="checked"  <?php } ?> value="0" name="staff_selection_mandatory"> No
</td>
</tr>

<tr id="staff_orderTd">
<td width="25%">In what order should appointments be allocated to staff?</td>
<td>
<select id="staff_order" style="width: 180px;" name="staff_order">
<option value="1" <?php  if($staff_order== 1){?> selected="selected" <?php } ?>>Most free staff (Timewise)</option>
<option value="2" <?php  if($staff_order== 2){?> selected="selected" <?php } ?>>Most free staff (Appointmentwise)</option>
<option value="3" <?php  if($staff_order== 3){?> selected="selected" <?php } ?>>Most busy staff (Timewise)</option>
<option value="4" <?php  if($staff_order== 4){?> selected="selected" <?php } ?> >Most busy staff (Appointmentwise)</option>
<option value="5" <?php  if($staff_order== 5){?> selected="selected" <?php } ?>>Order in which staff are displayed</option>
</select>
</td>
</tr>
<tr>

<table cellpadding="0" cellspacing="0">

<td colspan="3" align="left"><strong style="font-size:13px;">Do you require the following information from client at the time of signup?</strong></td></tr>
<tr><td colspan="3" align="left"  class="sign_upinfo_itemClass">
<?php
$counter = 0;
foreach($clint_signup_info_arr as $clint_signup_info)
{
		if(in_array($clint_signup_info['sign_upinfo_item_id'], $language_list_Arr)) 
		{
			$VarCheckedSi = 'checked="checked"';
		}
		else
		{
			$VarCheckedSi = '';
		}
		$counter++;
?>
    <input type="checkbox" name="sign_upinfo_item[]" id="sign_upinfo_item[]"  <?php echo $VarCheckedSi; ?>
	value="<?php echo  $clint_signup_info['sign_upinfo_item_id']; ?>" onclick="ErrorDispsignupinfopHide()" /> <?php echo $clint_signup_info['info_item_name']; ?> &nbsp;&nbsp;
    
<?php
}
?>
<span id="ErrorDispsignupinfop" style="color:#F00;"></span>
</td>

</tr>


</tr>

<tr><td colspan="3" align="left"><strong style="font-size:13px;">Select languages for your client calendar:</strong></td></tr>
<tr><td colspan="3" align="left" class="language_listClass">



<?php foreach($language_list_arr as $language_list) { ?>
<?php 
if(in_array($language_list['languages_id'], $language_list_Arr)) 
{
    $VarChecked = 'checked="checked"';
}
else
{
	$VarChecked = '';
}
?>
    <input type="checkbox" name="language_list[]" id="language_list[]"  <?php echo $VarChecked; ?>
	value="<?php echo  $language_list['languages_id']; ?>" onclick="ErrorDisplanguage_listHide()" /> <?php echo $language_list['languages_name']; ?> &nbsp;&nbsp;
<?php } ?>
<span id="ErrorDisplanguage_list" style="color:#F00;"></span>
<br /><br />
Which language you want as your default language?  
<select id="default_language_id" style="width: 180px;" name="default_language_id">
<?php foreach($language_list_arr as $language_list) { ?>
	<option value="<?php echo $language_list['languages_id'] ; ?>" 
	<?php if($default_language_id != "" && $default_language_id == $language_list['languages_id'] ){?> selected="selected" <?php } ?> >
	<?php echo $language_list['languages_name'] ; ?></option>
<?php } ?>
</select>
</td></tr>


<tr><td colspan="3" align="left"><strong style="font-size:13px;">Select Login methods: :</strong></td></tr>
<tr><td colspan="3" align="left"  class="checkBx">

<?php 
	$counter3 = 0;
	foreach($login_types_arr as $login_types) { 
	if(in_array($login_types['login_typ_id'], $login_typ_Arr)) 
	{
		$VarCheckedLogin = 'checked="checked"';
	}
	else
	{
		$VarCheckedLogin = '';
	}
	$counter3++;
?>
    <input type="checkbox" <?php if($counter3==1){ ?>checked="checked"<?php } ?> name="login_typ[]" id="<?php echo $login_types['login_identifier']; ?>" <?php echo $VarCheckedLogin; ?> 
	value="<?php echo $login_types['login_typ_id']; ?>" onclick="radiocontrol('<?php echo $login_types['login_identifier']; ?>',this)" /> <?php echo $login_types['login_name']; ?> &nbsp;&nbsp;
<?php } ?>

<p align="left">
<strong>What screen should be shown by default on booking?</strong> <span id="ErrorDisp" style="color:#F00;"></span>
<br/><br/>

<?php 
$counter4 = 0;
foreach($login_types_arr as $login_types) { 
$counter4++;
?>
<span id="<?php echo $login_types['login_identifier']; ?>_radiospan" <?php if($counter4!=1){ ?>style="display:none;"<?php } ?>>
<input type="radio" name="default_login_typ_id" id="default_login_typ_id" value="<?php echo $login_types['login_typ_id']; ?>" onclick="hideerror()" 

<?php if($default_login_typ_id != "" && $default_login_typ_id == $login_types['login_typ_id']){?>checked="checked" <?php } ?>/>
<?php echo $login_types['login_name']; ?>&nbsp;&nbsp;


<?php if($login_types['login_identifier'] == 'pardco_login') { ?>
<input type="radio" name="default_login_typ_id" id="default_login_typ_id" value="0" onclick="hideerror()" 

<?php if($default_login_typ_id != "" && $default_login_typ_id == 0){?>checked="checked" <?php } ?>/> Sign Up &nbsp;&nbsp;
<?php } ?>
</span>
<?php } ?>
</p>
</td></tr>

<tr><td colspan="3" align="left"><h2>Appointment / Cancellation:</h2></td></tr>
<tr>
<td colspan="2">
<input type="radio" name="cal_time_interval_typ" id="cal_time_interval_typ_1" value="1" 
<?php if($cal_time_interval_typ != "" && $cal_time_interval_typ == 1){ echo 'checked="checked"';  } ?> onclick="disabledAll();" />&nbsp;&nbsp;
Allow Appointy to automatically calculate time slots on your calendar?
</td>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="2">
<input type="radio" name="cal_time_interval_typ" id="cal_time_interval_typ_2" value="2" 
<?php if($cal_time_interval_typ != "" && $cal_time_interval_typ == 2){ echo 'checked="checked"';  } ?> onclick="disabledOne('cal_time_interval_variable_2','cal_time_interval_variable_3');" />&nbsp;&nbsp;
Set a fix time interval to show on calendar 
</td>
<td><input type="text" name="cal_time_interval_variable_2" id="cal_time_interval_variable_2"  style="border:1px solid #B7B7B7;width: 180px;" 

value="<?php if($cal_time_interval_variable != "" && $cal_time_interval_typ == 2 ){ echo $cal_time_interval_variable;  } ?>"/>Mins
<br /><span id="error_msg_radio2" style="color:#F00;"></span>
</td>
</tr>

<tr>
<td colspan="2">
<input type="radio" name="cal_time_interval_typ" id="cal_time_interval_typ_3" value="3" 

<?php if($cal_time_interval_typ != "" && $cal_time_interval_typ == 3){ echo 'checked="checked"';  } ?> onclick="disabledOne('cal_time_interval_variable_3','cal_time_interval_variable_2');" />&nbsp;&nbsp;
Show only specific times on the calendar (comma separated)
</td>
<td>
<input type="text" onblur="checkit(this)"  name="cal_time_interval_variable_3" id="cal_time_interval_variable_3"  style="border:1px solid #B7B7B7;width: 180px;" 

value="<?php if($cal_time_interval_variable != "" && $cal_time_interval_typ == 3 ){ echo $cal_time_interval_variable;  } ?>"/>
<br /><span id="error_msg"></span>
</td>
</tr>
<tr>
<td colspan="3">
<span style="font-size:9px; color:#9F9F9F">
Please add times separated by comma(,). Ex. 09:00 AM, 12:00 PM, 03:00 PM, 06:00 PM.
If you want to open times in an orderly manner then use hash(#) as a separator.<br />
For example: If you don't want to open at 03:00 PM unless 09:00 AM and 12:00 PM are booked,
then enter 09:00 AM, 12:00 PM # 3:00 PM.
</span>
</td>
</tr>

<tr><td colspan="3">&nbsp;</td></tr>

<tr>
<td width="25%">How long before appointments can be booked ?</td>
<td>
<input type="text" name="adv_bk_min_tim" id="adv_bk_min_tim"  style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($adv_bk_min_tim != ""){ echo $adv_bk_min_tim;  } ?>" />&nbsp;&nbsp;

<select id="adv_bk_min_setting" name="adv_bk_min_setting" style="width: 89px;">
<option value="1" <?php if($adv_bk_min_setting != "" && $adv_bk_min_setting == 1 ){?> selected="selected" <?php } ?>>Days</option>
<option value="2" <?php if($adv_bk_min_setting != "" && $adv_bk_min_setting == 2 ){?> selected="selected" <?php } ?>>Hrs</option>
<option value="3" <?php if($adv_bk_min_setting != "" && $adv_bk_min_setting == 3 ){?> selected="selected" <?php } ?>>Min</option>
</select>
</td>
</tr>


<tr>
<td width="25%">How long before appointments can be cancelled?</td>
<td>
<input type="text" name="bkin_can_mx_tim" id="bkin_can_mx_tim" style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($bkin_can_mx_tim != ""){ echo $bkin_can_mx_tim;  } ?>"/>&nbsp;&nbsp;
<select id="bkin_can_setin" name="bkin_can_setin" style="width: 89px;">
<option value="1" <?php if($bkin_can_setin != "" && $bkin_can_setin == 1 ){?> selected="selected" <?php } ?>>Days</option>
<option value="2" <?php if($bkin_can_setin != "" && $bkin_can_setin == 2 ){?> selected="selected" <?php } ?>>Hrs</option>
</select>
</td>
</tr>



<tr>
<td width="25%">How long before appointments can be reschedule?</td>
<td>
<input type="text" name="bkin_reschdl_mx_tim" id="bkin_reschdl_mx_tim"  style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($bkin_reschdl_mx_tim != ""){ echo $bkin_reschdl_mx_tim;  } ?>"/>&nbsp;&nbsp;
<select id="bkin_reschdl_setin" name="bkin_reschdl_setin" style="width: 89px;">
<option value="1" <?php if($bkin_reschdl_setin != "" && $bkin_reschdl_setin == 1 ){?> selected="selected" <?php } ?>>Days</option>
<option value="2" <?php if($bkin_reschdl_setin != "" && $bkin_reschdl_setin == 2 ){?> selected="selected" <?php } ?>>Hrs</option>
</select>
</td>
</tr>

<tr>
<td width="25%">How many days in advance can appointments be booked?</td>
<td>
<input type="text" name="adv_bk_mx_tim" id="adv_bk_mx_tim"  style="border:1px solid #B7B7B7;width: 180px;" value="<?php if($adv_bk_mx_tim != ""){ echo $adv_bk_mx_tim;  } ?>"/>&nbsp;&nbsp;
</td>
</tr>

<tr>
<td width="25%">How much time interval between each appointment?</td>
<td>
<input type="text" name="tim_intrvl_btwn_appo" id="tim_intrvl_btwn_appo"  style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($tim_intrvl_btwn_appo != ""){ echo $tim_intrvl_btwn_appo;  } ?>"/>&nbsp;&nbsp;
<select id="tim_intrvl_btwn_appo_settingin" name="tim_intrvl_btwn_appo_settingin" style="width: 89px;">
<option value="1" <?php if($tim_intrvl_btwn_appo_settingin != "" && $tim_intrvl_btwn_appo_settingin == 1 ){?> selected="selected" <?php } ?>>Days</option>
<option value="2" <?php if($tim_intrvl_btwn_appo_settingin != "" && $tim_intrvl_btwn_appo_settingin == 2 ){?> selected="selected" <?php } ?>>Hrs</option>
</select>
</td>
</tr>

<tr>
<td width="25%">Set time interval for Administrator </td>
<td>
<select id="admn_tim_intrvl" name="admn_tim_intrvl" style="border:1px solid #B7B7B7;width: 180px;">
	<option value="5" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 5 ){?> selected="selected" <?php } ?>>5</option>
	<option value="10" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 10 ){?> selected="selected" <?php } ?>>10</option>
	<option value="15" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 15 ){?> selected="selected" <?php } ?>>15</option>
	<option value="20" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 20 ){?> selected="selected" <?php } ?>>20</option>
	<option value="30" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 30 ){?> selected="selected" <?php } ?>>30</option>
	<option value="60" <?php if($admn_tim_intrvl != "" && $admn_tim_intrvl == 60 ){?> selected="selected" <?php } ?>>60</option>
</select>
</td>
</tr>

<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><strong style="font-size:16px;">Send Alerts to clients (Requires you to purchase Credits):</strong></td></tr>

<tr>
<td colspan="3">
<input type="checkbox" name="sms_alrt_bfr_appo_chk" id="sms_alrt_bfr_appo_chk" value="1" <?php if($sms_alert != "" && $sms_alert == 1 ){?> checked="checked" <?php } ?> />
Send alerts to clients  
<input type="text" name="sms_alrt_bfr_appo" id="sms_alrt_bfr_appo"  style="border:1px solid #B7B7B7;width: 89px;" 

value="<?php if($sms_alrt_bfr_appo != ""){ echo $sms_alrt_bfr_appo;  } ?>"/>&nbsp;&nbsp;
 Hrs prior to their appointment. (This would prevent no-shows) 
</td>
</tr>

<tr>
<td colspan="3">
<input type="checkbox" name="sms_thanks_aftrappo" id="sms_thanks_aftrappo" value="1" <?php if($sms_thanks_aftrappo != "" && $sms_thanks_aftrappo == 1 ){?> checked="checked" <?php } ?>/>  
Send a courtesy "Thank You" text after appointment.
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><strong style="font-size:16px;">Alerts on Appointment (Requires you to purchase Credits):</strong></td></tr>
<tr><td colspan="3" align="left"><strong style="font-size:13px;">When to send?:</strong></td></tr>




<tr>
<td>
<input type="radio" name="send_sms_for" id="send_sms_for" value="1"  <?php if(($send_sms_for != "" && $send_sms_for == 1) || $send_sms_for == "" ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
Never send any SMS 
</td>
</tr>




<tr>
<td>
<input type="radio" name="send_sms_for" id="send_sms_for" value="2" <?php if($send_sms_for != "" && $send_sms_for == 2 ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
Whenever an appointment requires approval 
</td>
</tr>







<tr>
<td>
<input type="radio" name="send_sms_for" id="send_sms_for" value="3" <?php if($send_sms_for != "" && $send_sms_for == 3 ){?>checked="checked" <?php } ?>/>&nbsp;&nbsp;
Every time an appointment is booked
</td>
</tr>






<tr><td colspan="3" align="left"><strong style="font-size:13px;">Whom to send?</strong></td></tr>
<tr><td colspan="3">
<input type="checkbox" name="sms_alart_to_admin" id="sms_alart_to_admin" value="1" checked="checked" 
<?php if(($sms_alart_to_admin != "" && $sms_alart_to_admin == 1) || $sms_alart_to_admin == "" ){?>checked="checked" <?php } ?>/> Admin 
<input type="checkbox" name="sms_alart_to_staff" id="sms_alart_to_staff" value="1" checked="checked" 
<?php if(($sms_alart_to_staff != "" && $sms_alart_to_staff == 1) || $sms_alart_to_staff == "" ){?>checked="checked" <?php } ?>/>  Staff
</td></tr>





<tr><td colspan="3" align="left"><strong style="font-size:13px;">Send Email Alerts to clients</strong></td></tr>
<td colspan="3">
<input type="checkbox" name="email_alrt_bfr_appo_chk" id="email_alrt_bfr_appo_chk" value="1" 
<?php if(($email_alert != "" && $email_alert == 1) || $email_alert == "" ){?>checked="checked" <?php } ?> />
 Send E-mail alerts to clients 
<input type="text" name="email_alrt_bfr_appo" id="email_alrt_bfr_appo" style="border:1px solid #B7B7B7;width: 89px;" 
value="<?php if($email_alrt_bfr_appo != ""){ echo $email_alrt_bfr_appo;  } ?>"/>&nbsp;&nbsp;
 Hrs prior to their appointment. (This would prevent no-shows) 
</td>
</tr>


 
</table>
</div>
</div>
<table>
<input type="submit" name="submit" id="submit" class="btn-blue" value="SAVE SETTING" />
<!--<div id="rounded-corners">
<p><a href="URL.htm">Checkout</a></p>
</div>-->
</td></tr>
</table>

<input type="hidden" name="local_admin_id" id="local_admin_id" value="<?php echo $local_admin_id;?>" />
</form>
