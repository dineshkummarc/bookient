<script language="javascript" type="text/javascript">
<!--===========================================DATE-TIMEPICKER CODE===========================================-->
$(function() {
		$("#no_of_booking_period_from").datepicker();
		$("#no_of_booking_period_to").datepicker();
		$("#cal_strting_dt").datepicker();
	});
<!--===========================================DATE-TIMEPICKER CODE===========================================--> 
$(document).ready(function() 
{ 
	$("#no_of_bookingRestrictyinTd").show();
	$("#weekDaySelectionTd").hide();
	$("#MonthDateSelectionTd").show();
	$("#MonthSelectionTd").hide();
	$("#no_of_booking_period_fromTd").show();
	$("#no_of_booking_period_toTd").show();
	$("input[name=quantity_appointment_setting]").change(function(){
			var quantity_appointment_settingVal = $("#quantity_appointment_setting:checked").val();
			if(quantity_appointment_settingVal == 1)
			{
				$("#quantity_appointmentTd").show();
			}
			else
			{
				$("#quantity_appointmentTd").hide();
			}
	});
	$("input[name=allow_international_users]").change(function(){
			var allow_international_usersVal = $("#allow_international_users:checked").val();
			if(allow_international_usersVal == 1)
			{
				$("#detect_client_timezoneTd").show();
			}
			else
			{
				$("#detect_client_timezoneTd").hide();
			}
	});
	$("input[name=booked_times_striked]").change(function(){
			var booked_times_strikedVal = $("#booked_times_striked:checked").val();
			if(booked_times_strikedVal == 1)
			{
				$("#blocked_times_striked_outTd").show();
			}
			else
			{
				$("#blocked_times_striked_outTd").hide();
			}
	});
	$("input[name=staff_selection_mandatory]").change(function(){
					var show_staff_customersVal = $("#show_staff_customers:checked").val();
					var staff_selection_mandatoryVal = $("#staff_selection_mandatory:checked").val();
					if(staff_selection_mandatoryVal == 1 && show_staff_customersVal ==1)
					{
						$("#staff_orderTd").hide();
					}
					else
					{
						$("#staff_orderTd").show();
					}
	});
	var site_enbVal = $("#site_enb:checked").val();
	if(site_enbVal == 1)
	{
		$("#TotalData").show();
	}
	else
	{
		$("#TotalData").hide();
	}
	$("input[name=site_enb]").change(function(){
			var site_enbVal = $("#site_enb:checked").val();
			if(site_enbVal == 1)
			{
				$("#TotalData").show();
			}
			else
			{
				$("#TotalData").hide();
			}
	});
	
	
	
	
	
	$("input[name=show_staff_customers]").change(function(){
			var show_staff_customersVal = $("#show_staff_customers:checked").val();
			var staff_selection_mandatoryVal = $("#staff_selection_mandatory:checked").val();
			if(show_staff_customersVal == 1)
			{
				$("#staff_selection_mandatoryTd").show();
				if(staff_selection_mandatoryVal == 1)
				{
					$("#staff_orderTd").hide();
				}
				else
				{
					$("#staff_orderTd").show();
				}
			}
			else if(show_staff_customersVal == 0 && staff_selection_mandatoryVal == 1)
			{
				$("#staff_orderTd").show();
				$("#staff_selection_mandatoryTd").hide();
			}
			else
			{
				$("#staff_selection_mandatoryTd").hide();
			}
	});
	
	
	
	
	var applyAdvanceBookingRuleVal = $("#applyAdvanceBookingRule:checked").val(); 
	if(applyAdvanceBookingRuleVal == 1)
	{
		$("#AdvBookingDtlsShowHide").show();
		var no_of_booking_periodVal =  $('#no_of_booking_period').val();
		if(no_of_booking_periodVal == 1 || no_of_booking_periodVal == 2)
		{
			$("#no_of_bookingRestrictyinTd").hide();
			$("#weekDaySelectionTd").hide();
			$("#MonthDateSelectionTd").hide();
			$("#MonthSelectionTd").hide();
			$("#no_of_booking_period_fromTd").hide();
			$("#no_of_booking_period_toTd").hide();
		}
		else if(no_of_booking_periodVal == 3)
		{
			$("#no_of_bookingRestrictyinTd").show();
			$("#weekDaySelectionTd").hide();
			$("#MonthDateSelectionTd").hide();
			$("#MonthSelectionTd").hide();
			$("#no_of_booking_period_fromTd").show();
			$("#no_of_booking_period_toTd").show();
		}
		else if(no_of_booking_periodVal == 4)
		{
			$("#no_of_bookingRestrictyinTd").show();
			$("#weekDaySelectionTd").show();
			$("#MonthDateSelectionTd").hide();
			$("#MonthSelectionTd").hide();
			$("#no_of_booking_period_fromTd").show();
			$("#no_of_booking_period_toTd").show();
		}
		else if(no_of_booking_periodVal == 5)
		{
			$("#no_of_bookingRestrictyinTd").show();
			$("#weekDaySelectionTd").hide();
			$("#MonthDateSelectionTd").show();
			$("#MonthSelectionTd").hide();
			$("#no_of_booking_period_fromTd").show();
			$("#no_of_booking_period_toTd").show();
		}
		else if(no_of_booking_periodVal == 6)
		{
			$("#no_of_bookingRestrictyinTd").show();
			$("#weekDaySelectionTd").hide();
			$("#MonthDateSelectionTd").show();
			$("#MonthSelectionTd").show();
			$("#no_of_booking_period_fromTd").show();
			$("#no_of_booking_period_toTd").show();
		}
		else if(no_of_booking_periodVal == 7)
		{
			$("#no_of_bookingRestrictyinTd").show();
			$("#weekDaySelectionTd").hide();
			$("#MonthDateSelectionTd").hide();
			$("#MonthSelectionTd").hide();
			$("#no_of_booking_period_fromTd").show();
			$("#no_of_booking_period_toTd").show();
		}
		else
		{
			$("#no_of_bookingRestrictyinTd").show();
			$("#weekDaySelectionTd").hide();
			$("#MonthDateSelectionTd").show();
			$("#MonthSelectionTd").hide();
			$("#no_of_booking_period_fromTd").show();
			$("#no_of_booking_period_toTd").show();
		}
	}
	
	
	
	
});


function validateForm()
{
	var error_msg = "";
	var validate_return=1;
	var res=$('#no_of_booking').val();
	var applyAdvanceBookingRuleVal = $("#applyAdvanceBookingRule:checked").val();
	if(applyAdvanceBookingRuleVal == 1)
	{
	//applyAdvanceBookingRule
		if(res ==0)
		{
			$('#res_div').html("<?php echo $this->global_mod->db_parse($this->lang->line('val_must_b_grtr_than_zero'));?>");
                        error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('val_must_b_grtr_than_zero'));?>"+"</li>";
			validate_return=0;
			
		}
	}
	var quantity_appointment_settingVal = $("#quantity_appointment_setting:checked").val();
	var default_login_typ_idVal = $("#default_login_typ_id:checked").val();
	if(quantity_appointment_settingVal == 1)
	{
		var quantity_appointmentVal =  $('#quantity_appointment').val();
		/*
		if($.isNumeric(quantity_appointmentVal) == false)
		{
			alert('Field must be numeric');
			$('#quantity_appointment').focus();
			return false;
		}
		*/
		/*if(quantity_appointmentVal =='')
		{
			$('#error_msg_quantity_appointment').html('<?php echo $this->lang->line("required_fld");?>');
                         error_msg +="<li>"+"<?php echo $this->lang->line('alias_fr_qntity_is_empty');?>"+"</li>";
			$('#quantity_appointment').focus();
			validate_return=0;
		}*/
		
	}
		if($('#no_of_booking').val() < 0)
		{
			$('#error_msg_no_of_booking').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
                         $error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('quantity_must_have_pos_val'));?>"+"</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#no_of_booking').val()) == false)
		{
			$('#error_msg_no_of_booking').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
                         error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('booking_shld_b_numeric'));?>"+".</li>";
			validate_return=0;
		}
		/*
		if($('#quantity_appointment').val() < 0)
		{
			$('#error_msg_quantity_appointment').html('Field must have a positive value');
			return false;		
		}
		if(IsNumeric($('#quantity_appointment').val()) == false)
		{
			$('#error_msg_quantity_appointment').html('Field Should be Numeric');
			return false;		
		}
		*/
		
	
	
	if($(".sign_upinfo_itemClass input[type='checkbox']:checked").length == 0)
	{
		$('#ErrorDispsignupinfop').html('<?php echo $this->global_mod->db_parse($this->lang->line("pls_slct_one"));?> ');
                 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_one_signup_info'));?>"+".</li>";
		validate_return=0;
	}
	
	if($(".language_listClass input[type='checkbox']:checked").length == 0)
	{
		
		$('#ErrorDisplanguage_list').html('Please select one');
                error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_one_lang'));?>"+".</li>";
		validate_return=0;
	}
	
	if(default_login_typ_idVal ==undefined)
	{
	     $('#ErrorDisp').html('<?php echo $this->global_mod->db_parse($this->lang->line("pls_slct_one_radio"));?>');
		  error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_dflt_login_type'));?>"+".</li>";
		 validate_return=0;
	}
	
	var checked_radio_2 = $('#cal_time_interval_typ_2').is(':checked');	
	if(checked_radio_2 == true)
	{
		if($('#cal_time_interval_variable_2').val() == '')
		{
			 $('#error_msg_radio2').html('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";
			 validate_return=0;
		}
		if($('#cal_time_interval_variable_2').val() < 0)
		{
			$('#error_msg_radio2').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#cal_time_interval_variable_2').val()) == false)
		{
			$('#error_msg_radio2').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";
			validate_return=0;	
		}
		
	}
		if($('#adv_bk_min_tim').val() < 0)
		{
			$('#error_msg_adv_bk_min_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_advnce_bool_appo'));?>"+".</li>";
			validate_return=0;
		}
		if(IsNumeric($('#adv_bk_min_tim').val()) == false)
		{
			$('#error_msg_adv_bk_min_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_advnce_bool_appo'));?>"+".</li>";
			validate_return=0;
		}
		
		if($('#bkin_can_mx_tim').val() < 0)
		{
			$('#error_msg_bkin_can_mx_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_bkking_cn_max_time'));?>"+".</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#bkin_can_mx_tim').val()) == false)
		{
			$('#error_msg_bkin_can_mx_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_how_long_bfor_appo_reschdlu'));?>"+".</li>";
			validate_return=0;
		}
		
		if($('#bkin_reschdl_mx_tim').val() < 0)
		{
			$('#error_msg_bkin_reschdl_mx_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_how_long_bfor_appo_reschdlu'));?>"+".</li>";
			validate_return=0;
		}
		if(IsNumeric($('#bkin_reschdl_mx_tim').val()) == false)
		{
			$('#error_msg_bkin_reschdl_mx_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_how_long_bfor_appo_reschdlu'));?>"+".</li>";
			validate_return=0;
		}
		if($('#adv_bk_mx_tim').val() < 0)
		{
			$('#error_msg_adv_bk_mx_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_advnce_bool_appo'));?>"+".</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#adv_bk_mx_tim').val()) == false)
		{
			$('#error_msg_adv_bk_mx_tim').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_advnce_bool_appo'));?>"+".</li>";
			validate_return=0;	
		}
		
		if($('#tim_intrvl_btwn_appo').val() < 0)
		{
			$('#error_msg_tim_intrvl_btwn_appo').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_time_intvl_btween_appo'));?>"+".</li>";
			validate_return=0;
		}
		if(IsNumeric($('#tim_intrvl_btwn_appo').val()) == false)
		{
			$('#error_msg_tim_intrvl_btwn_appo').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_time_intvl_btween_appo'));?>"+".</li>";
			validate_return=0;	
		}
		if($('#sms_alrt_bfr_appo').val() < 0)
		{
			$('#error_msg_sms_alrt_bfr_appo').html('<?php echo $this->global_mod->db_parse($this->lang->line("field_must_have_positive_val"));?>');
			 error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_sms_alrt_before_appo'));?>"+".</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#sms_alrt_bfr_appo').val()) == false)
		{
			$('#error_msg_sms_alrt_bfr_appo').html('<?php echo $this->global_mod->db_parse($this->lang->line("fld_shld_b_numeric"));?>');
			error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_sms_alrt_before_appo'));?>"+".</li>";
			validate_return=0;	
		}
		
		
		
	
	
	var checked_radio_3 = $('#cal_time_interval_typ_3').is(':checked');	
	if(checked_radio_3 == true)
	{
	 	//alert(timeToSecond("00:00am"));                                                                         	
		var valcal_time_interval1 = $('#cal_time_interval_variable_3').val().toLowerCase();
		if(valcal_time_interval1 =='')
		{
			$('#error_msg').html('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"));?>');
			error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";
			validate_return=0;
		}
		valcal_time_interval = valcal_time_interval1.replace(/\s/g, '');
		var valArr = valcal_time_interval.split(/[,#]+/).filter(function(e) { return e; });		
		for(var i=0; i<valArr.length;i++)
		{
			var value=valArr[i];
			regularExpression = /^(\d{1,2}):(\d{2})(:00)?([ap]m)?$/;
			if (regularExpression.test(value)==false)
			{ 
				$('#error_msg').html('<?php echo $this->global_mod->db_parse($this->lang->line("invalid_tm_frmt"));?>');	
				error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'))?>"+".</li>";	
				validate_return=0;
			}	    	
		}
		for(var i=0; i<valArr.length;i++)
		{
			var timeStr=valArr[i];
			var meridian = timeStr.substr(timeStr.length-2).toLowerCase();;
		    var hours =  timeStr.substr(0, timeStr.indexOf(':'));
		    //var minutes = timeStr.substring(timeStr.indexOf(':')+1, timeStr.indexOf(' '));
			var rw_min = timeStr.split(":");
		    if (meridian=='am'){
		        if (hours==12){
		            $('#error_msg').html('<?php echo $this->global_mod->db_parse($this->lang->line("invalid_tm_frmt1"));?>');
					error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";	
							
					validate_return=0;
		        }		
		    }
			if (meridian=='pm'){
		        if (hours==00){
		            $('#error_msg').html('<?php echo $this->global_mod->db_parse($this->lang->line("invalid_tm_frmt2"));?>');
					error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";			
					validate_return=0;
		        }		
		    }			
				    	
		}
		for(var i=0; i<valArr.length;i++)
		{
			if(i==0)
			{
				var value1 ="00:00am";					
			}
			else{				
				var value1 =valArr[i-1];
			}
			
			var value2=valArr[i];
			var start_time = timeToSecond(value1);
			//end time
			var end_time = timeToSecond(value2);
			//convert both time into timestamp
			var stt = new Date("November 13, 2013 " + start_time);
			stt = stt.getTime();
			var endt = new Date("November 13, 2013 " + end_time);
			endt = endt.getTime();				
			//by this you can see time stamp value in console via firebug
			console.log("Time1: "+ start_time + " Time2: " + end_time);
			if(stt > endt) {
			    $('#error_msg').html('<?php echo $this->global_mod->db_parse($this->lang->line("time"));?> '+value1+' <?php echo $this->global_mod->db_parse($this->lang->line("is_grtr_thn"));?> '+ value2);
				error_msg +="<li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pls_slct_calndr_time_intrvl'));?>"+".</li>";	
				validate_return=0;
			}						
		} 
		/*
		Arr1 = valcal_time_interval.split(',');
		valArr=new Array();
		for(var i=0; i<Arr1.length;i++)
		{
			var arrValue=Arr1[i];
			if(arrValue.indexOf('#') === -1){
				valArr.push(arrValue);
				//valArr[]=arrValue;				
			}
			else{
				Arr2 = arrValue.split('#');
				valArr.push(Arr2[0]);
				valArr.push(Arr2[1]);
			}
			
			
		}
		*/  	
	}
//validatetime()
	if(error_msg != "" && validate_return ==0){
		$('.error_msg_all').html(error_msg);	
		return false;	
	}
	

}
function timeToSecond(timeStr){
    var meridian = timeStr.substr(timeStr.length-2).toLowerCase();;
    var hours =  timeStr.substr(0, timeStr.indexOf(':'));
    //var minutes = timeStr.substring(timeStr.indexOf(':')+1, timeStr.indexOf(' '));
	var rw_min = timeStr.split(":");
	var minutes = rw_min[1].substr(0, rw_min[1].length - 2);
    if (meridian=='pm'){
        if (hours!=12){
            hours=hours*1+12;
        }
		//else{
           // hours = (minutes!='00') ? '0' : '24' ;
       // }
    }
	ls_time = hours+':'+minutes;

    return ls_time;
}

function ErrorDispsignupinfopHide()
{
	$('#ErrorDispsignupinfop').html('');
}

function ErrorDisplanguage_listHide()
{
	$('#ErrorDisplanguage_list').html('');
}


function hideerror()
{
	$('#ErrorDisp').html('');
}






function DispDtls()
{
	if($('#applyAdvanceBookingRule:checked').val() == 1){
		$("#AdvBookingDtlsShowHide").show();
	}
	else
	{
		$("#AdvBookingDtlsShowHide").hide();
	}
}
function DispDtlsControl()
{
	var no_of_booking_periodVal =  $('#no_of_booking_period').val();
	if(no_of_booking_periodVal == 1 || no_of_booking_periodVal == 2)
	{
		$("#no_of_bookingRestrictyinTd").hide();
		$("#weekDaySelectionTd").hide();
		$("#MonthDateSelectionTd").hide();
		$("#MonthSelectionTd").hide();
		$("#no_of_booking_period_fromTd").hide();
		$("#no_of_booking_period_toTd").hide();
	}
	else if(no_of_booking_periodVal == 3)
	{
		$("#no_of_bookingRestrictyinTd").show();
		$("#weekDaySelectionTd").hide();
		$("#MonthDateSelectionTd").hide();
		$("#MonthSelectionTd").hide();
		$("#no_of_booking_period_fromTd").show();
		$("#no_of_booking_period_toTd").show();
	}
	else if(no_of_booking_periodVal == 4)
	{
		$("#no_of_bookingRestrictyinTd").show();
		$("#weekDaySelectionTd").show();
		$("#MonthDateSelectionTd").hide();
		$("#MonthSelectionTd").hide();
		$("#no_of_booking_period_fromTd").show();
		$("#no_of_booking_period_toTd").show();
	}
	else if(no_of_booking_periodVal == 5)
	{
		$("#no_of_bookingRestrictyinTd").show();
		$("#weekDaySelectionTd").hide();
		$("#MonthDateSelectionTd").show();
		$("#MonthSelectionTd").hide();
		$("#no_of_booking_period_fromTd").show();
		$("#no_of_booking_period_toTd").show();
	}
	else if(no_of_booking_periodVal == 6)
	{
		$("#no_of_bookingRestrictyinTd").show();
		$("#weekDaySelectionTd").hide();
		$("#MonthDateSelectionTd").show();
		$("#MonthSelectionTd").show();
		$("#no_of_booking_period_fromTd").show();
		$("#no_of_booking_period_toTd").show();
	}
	else if(no_of_booking_periodVal == 7)
	{
		$("#no_of_bookingRestrictyinTd").show();
		$("#weekDaySelectionTd").hide();
		$("#MonthDateSelectionTd").hide();
		$("#MonthSelectionTd").hide();
		$("#no_of_booking_period_fromTd").show();
		$("#no_of_booking_period_toTd").show();
	}
	else
	{
		$("#no_of_bookingRestrictyinTd").show();
		$("#weekDaySelectionTd").hide();
		$("#MonthDateSelectionTd").show();
		$("#MonthSelectionTd").hide();
		$("#no_of_booking_period_fromTd").show();
		$("#no_of_booking_period_toTd").show();
	}
}
function radiocontrol(checkBxId, ele)
{
	$('#default_login_typ_id').attr('checked',false);
	if($(".checkBx input[type='checkbox']:checked").length >= 1){
		var SpanIdRadio = checkBxId+"_radiospan";
		if ($('#'+checkBxId).is(':checked')) 
		{
			$("#"+SpanIdRadio).show();
		}
		else
		{
			$("#"+SpanIdRadio).hide();
		}
	}else{
		$(ele).attr("checked","checked")
		return false;	
	}
}











function  validatetime(date)
{
  var strval = date;
  var strval1;
 $("#error_msg").html('');
    
  //minimum lenght is 6. example 1:2 AM
  if(strval.length < 6)
  {
    // alert();
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('time_frmt_shld_b'));?>");
     return false;
  }
  
  //Maximum length is 8. example 10:45 AM
  if(strval.lenght > 8)
  {
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('time_frmt_shld_b'));?>");
   return false;
  }
  
  //Removing all space
  strval = trimAllSpace(strval); 
  
  //Checking AM/PM
  if(strval.charAt(strval.length - 1) != "M" && strval.charAt(
      strval.length - 1) != "m")
  {
  // alert("Invalid time. Time shoule be end with AM or PM.");
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('time_frmt_shld_b_end_with'));?>");
   return false;
   
  }
  else if(strval.charAt(strval.length - 2) != 'A' && strval.charAt(
      strval.length - 2) != 'a' && strval.charAt(
      strval.length - 2) != 'p' && strval.charAt(strval.length - 2) != 'P')
  {
  // alert("Invalid time. Time shoule be end with AM or PM.");
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('time_frmt_shld_b_end_with'));?>");
   return false;
  }
  
  //Give one space before AM/PM
  
  strval1 =  strval.substring(0,strval.length - 2);
  strval1 = strval1 + ' ' + strval.substring(strval.length - 2,strval.length)
  strval = strval1;
      
  var pos1 = strval.indexOf(':');
 // document.Form1.TextBox1.value = strval;
  
  if(pos1 < 0 )
  {
  // alert();
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('a_clr_missing_betwen'));?>");
   return false;
  }
  else if(pos1 > 2 || pos1 < 1)
  {
   //alert("invalid time. Time format should be HH:MM AM/PM.");
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('time_frmt_shld_b'));?>");
   return false;
  }
  
  //Checking hours
  var horval =  trimString(strval.substring(0,pos1));
  if(horval == -100)
  {
  // alert();
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('hr_shld_cntain_int'));?>");
   return false;
  }
      
  if(horval > 12)
  {
     $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('hr_cn_nt_b_grtr_thn_12'));?>");

  // alert();
   return false;
  }
  else if(horval < 0)
  {
     $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('hr_cn_nt_b_less_thn_12'));?>");
   return false;
  }
  //Completes checking hours.
  
  //Checking minutes.
  var minval =  trimString(strval.substring(pos1+1,pos1 + 3));
  
  if(minval == -100)
  {
   	$("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('min_shld_hv_only_int'));?>");
   	return false;
  }
    
  if(minval > 59)
  {
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('min_cn_nt_b_more_thn_59'));?>");
     return false;
  }   
  else if(minval < 0)
  {
  
   $("#error_msg").html("<?php echo $this->global_mod->db_parse($this->lang->line('min_cn_nt_b_less_thn_0'));?>");
   return false;
  }
   
  //Checking minutes completed.
  
  //Checking one space after the mintues 
  minpos = pos1 + minval.length + 1;
  if(strval.charAt(minpos) != ' ')
  {
    $("#error_msg").html("I<?php echo $this->global_mod->db_parse($this->lang->line('space_misng_aftr_min'));?>");

   return false;
  }
 
  return true;
}
function trimAllSpace(str) 
{ 
    var str1 = ''; 
    var i = 0; 
    while(i != str.length) 
    { 
        if(str.charAt(i) != ' ') 
            str1 = str1 + str.charAt(i); i ++; 
    } 
    return str1; 
}
function trimString(str) 
{ 
     var str1 = ''; 
     var i = 0; 
     while ( i != str.length) 
     { 
         if(str.charAt(i) != ' ') str1 = str1 + str.charAt(i); i++; 
     }
     var retval = IsNumeric(str1); 
     if(retval == false) 
         return -100; 
     else 
         return str1; 
}
function IsNumeric(strString) 
{ 
    var strValidChars = "0123456789"; 
    var strChar; 
    var blnResult = true; 
    //var strSequence = document.frmQuestionDetail.txtSequence.value; 
    //test strString consists of valid characters listed above 
    if (strString.length == 0) 
        return false; 
    for (i = 0; i < strString.length && blnResult == true; i++) 
    { 
        strChar = strString.charAt(i); 
        if (strValidChars.indexOf(strChar) == -1) 
        { 
            blnResult = false; 
        } 
     }
     return blnResult; 
}

//function timeValidation(){
//val = $('#TextBox1').val();
//
// valArr = val.split(',');
//	for(var i=0; i<valArr.length;i++){
//		//var t = trimString(valArr[i]);
//		validatetime(valArr[i]);
//		//alert(valArr[i]);
//	}
////validatetime()
//}


 function validateTime(field)
 {
 var timeReg=/^(?:(?:00:[0-5][0-9](?::[0-5][0-9])?(?:am|AM)|(?:0[1-9]|1[01]):[0-5][0-9](?::[0-5][0-9])?(?:[ap]m|[AP]M)|12:[0-5][0-9](?::[0-5][0-9])?(?:pm|PM))|(?:[01][0-9]|2[0-3]):[0-5][0-9](?::[0-5][0-9])?)$/
 //var timeReg=/^(1[012]|0[1-9]):[0-5][0-9](\\s)? (am|pm)+$/;
//var timeReg = /^(([0-1]?[0-2])|([2][0-3])):([0-5]?[0-9])(a|p)m?$/;

 return (timeReg.test(field)) ? true : false;
 }
 
function checkit(obj)
{
	var checked_radio = $('#cal_time_interval_typ_3').is(':checked');	
	if(checked_radio == true)
	{
		var time=$('#'+obj.id).val();
		var timeexact=time.split(" ").join("");
		//alert(timeexact);
		var ind=true;
		var time1=timeexact.split(/(?:,|#)+/);
		 for(var i = 0;i < time1.length;i++)
			{ //alert(time1[i]);
			if(!validateTime(time1[i])) 
				{
				//alert("enter valid time");
				ind= false;
				}
				
		//var timeReg = /^(([0-1]?[0-2])|([2][0-3])):([0-5]?[0-9])(a|p)m?$/;
			if(!ind)
			  break;
			}
			
			if(!ind)
			{
			//alert("invalid");
			 $('#error_msg').css({color:'red'}).html('<?php echo $this->global_mod->db_parse($this->lang->line("invalid_frmt"));?>');
			 
			}
			else{
				$('#error_msg').html('');
			}
	}
}

function disabledAll()
{
	$("#cal_time_interval_variable_2").val('');
	$("#cal_time_interval_variable_2").attr("disabled", "disabled");
	$("#cal_time_interval_variable_3").val('');
	$("#cal_time_interval_variable_3").attr("disabled", "disabled");
}

function disabledOne(country_id)
{
	$("#"+id1).prop("disabled",false);
	$("#"+id2).val('');
	$("#"+id2).prop("disabled",true);
}
function showRate(country_id)
{
	$.ajax({
			type: 'POST',
			url: "<?php echo base_url(); ?>admin/rules/showRate",
			data: {'country_id': country_id},
			success: function(rdata){ 				    
				$('#sms_cost_span').html(rdata);
			}
	});
}

</script>

<!--==========================================Tool Tips==============================-->
<script>
	$(function() {
		$('.tooltips').mouseover(function() {			
			var contentId	=$(this).attr('contentId');		
			var content		=tooltipsContent(contentId);
			var contentHtml	='<span class="tooltips-content" ><span class="t-arrow1"></span>'+content+'</span>';		
			$(this).append(contentHtml);
		});
		$('.tooltips').mouseout(function()
	    {
	       $(this).find("span").remove();
	    });
		
	});

	function tooltipsContent(contentId)
	{
		if(contentId==1)//Bookings Allowed
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('st_booking_rules_fr_yr_client'));?>";	
		}
		else if(contentId==2)//Restriction
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('no_of_bking_client_cn_mk'));?>";			
		}
		else if(contentId==3)//Do you want to allow clients to book recurring appointments? 
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('book_same_srvice_on_mltipl_day'));?>";			
		}
		else if(contentId==4)//Do you want to show recurring option for Admin?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('book_same_srvice_on_mltipl_day_on_admin_side'));?>";			
		}
		else if(contentId==5)//Do you want to allow clients to select quantity for their appointment? 
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('able_yo_bk_sm_ser_fr_more_thn_1_prsn'));?>"+"</li></ul><br /><small><i>"+"<?php echo $this->global_mod->db_parse($this->lang->line('settng_wrk_fr_all_srvice'));?>";			
		}
		else if(contentId==6)//Enter the alias for quantity
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('entr_seat_as_alias_fr_qntity'));?>";			
		}
		else if(contentId==7)//Do you want to show service cost to your clients?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('slct_no'));?>"+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('u_do_nt_chrg_fr_ny_srvice'));?>"+"</li><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('u_do_nt_accpt_pre_pymnts_nd_ser'));?>"+"</li></ul>";			
		}
		else if(contentId==8)//Do you want to show service time duration to your clients?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('slct_no'));?>"+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('if_u_do_nt_wnt_to_shw_ser_time'));?>"+"</li><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('pt_srvice_time_including_buffer'));?>"+"</li></ul><br/><i>"+"<?php echo $this->global_mod->db_parse($this->lang->line('cnsultatn_or_hair_clr'));?>"+"</i>";			
		}
		else if(contentId==9)//Do you want to show clients name with reviews?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('slct_no'));?> "+"<?php echo $this->global_mod->db_parse($this->lang->line('dont_show_nm_of_client'));?>";			
		}
		else if(contentId==10) //What view should be shown by default?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('slct_mnth_view'));?>"+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('srvice_or_event_on_crtain_days_in_mnth'));?>"+"</li><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('if_u_r_always_full_fr_upcmng_wk'));?>"+"</li></ul>";			
		}
		else if(contentId==11)//What should be your calendar's starting weekday?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('set_strting_day_of_the_wk'));?>"+" <br /> <small>"+"<?php echo $this->global_mod->db_parse($this->lang->line('recommended_setting'));?>"+"</small>";			
		}
		else if(contentId==12) //What should be your calendar's starting date?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('set_srting_date_fr_cal'));?>";			
		}
		else if(contentId==13)  //Do you want to show staff to your customers?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('selct_yes'));?> "+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('allow_client_to_slct_staff'));?>"+"</li></ul>";			
		}
		else if(contentId==14)  //Do you want to make staff selection mandatory?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('selct_yes'));?> "+"<?php echo $this->global_mod->db_parse($this->lang->line('staf_sel_mandetory'));?>";			
		}
		else if(contentId==15)//What screen should be shown by default on booking? 
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('scrn_wl_b_shown_to_usr'));?>";			
		}
		else if(contentId==16)//Allow Bookient to automatically calculate time slots on your calendar? 
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('allow_sys_to_automtc_cal'));?>";			
		}
		else if(contentId==17)//Set a fix time interval to show on calendar
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('provide_consultatn_frm'));?>"+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('15min_wl_show'));?>"+"</li><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('30min_wl_show'));?>"+"</li></ul>";			
		}
		else if(contentId==18)//Show only specific times on the calendar (comma separated)
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('settng_wl_allow_u_to_open'));?>"+" <br /><br />"+"<?php echo $this->global_mod->db_parse($this->lang->line('for_ex_u_set'));?>";			
		}
		else if(contentId==19) //How long before appointments can be booked ?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('setting_allow_u_to_set_time_bfr_appo'));?>"+"<i>"+"<?php echo $this->global_mod->db_parse($this->lang->line('setting_allow_u_to_set_time_bfr_appo'));?>"+"<br>"+"<?php echo $this->global_mod->db_parse($this->lang->line('setting_this_hr_wl_cal_exact_tm'));?>";			
		}
		else if(contentId==20)//How long before appointments can be cancelled?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('setting_allow_u_to_set_a_limit'));?>"+"<i>"+"<?php echo $this->global_mod->db_parse($this->lang->line('fr_ex_setting_this_to_24_hr_will_not'));?>"+"</i>";			
		}
		else if(contentId==21)//How long before appointments can be reschedule?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('setting_allow_u_to_limt_reschdl'));?>"+" <br /><i>"+"<?php echo $this->global_mod->db_parse($this->lang->line('setting_this_to_24hrs'));?>"+"</i>";			
		}
		else if(contentId==22)//How many days in advance can appointments be booked?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('setting_this_to_90days'));?>";		
		}
		else if(contentId==23)//How much time interval between each appointment?
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('setting_this_to_1day_wl_restrict'));?>";			
		}
		else if(contentId==24)//Set time interval for Administrator 
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('provide_cnsltatn_frm_10am_to_6pm'));?>"+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('15min_will_show'));?>"+"</li><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('30min_will_show'));?>"+"</li><ul>";			
		}
		else if(contentId==25)//Set time interval for Administrator 
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('bkking_time_wl_display_on_tht_frmt'));?>";			
		}		
		else if(contentId==26)  //Do you want to allow booking always
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('selct_yes'));?> "+"<ul><li>"+"<?php echo $this->global_mod->db_parse($this->lang->line('allow_staff_book_always'));?>"+"</li></ul>";			
		}
		return content;
	}
</script>
