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
			$('#res_div').html("Value must be greater than zero");
                        error_msg +="<li>Value must be greater than zero</li>";
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
		if(quantity_appointmentVal =='')
		{
			$('#error_msg_quantity_appointment').html('Required Field');
                         error_msg +="<li>Alias for quantity is empty</li>";
			$('#quantity_appointment').focus();
			validate_return=0;
		}
		
	}
		if($('#no_of_booking').val() < 0)
		{
			$('#error_msg_no_of_booking').html('Field must have a positive value');
                         $error_msg +="<li>No. of quantity must have positive value</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#no_of_booking').val()) == false)
		{
			$('#error_msg_no_of_booking').html('Field Should be Numeric');
                         error_msg +="<li>No. of booking should be numeric.</li>";
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
		$('#ErrorDispsignupinfop').html('Please select one ');
                 error_msg +="<li>Please select one of the sign-up information.</li>";
		validate_return=0;
	}
	
	if($(".language_listClass input[type='checkbox']:checked").length == 0)
	{
		
		$('#ErrorDisplanguage_list').html('Please select one');
                error_msg +="<li>Please select one of the languages.</li>";
		validate_return=0;
	}
	
	if(default_login_typ_idVal ==undefined)
	{
	     $('#ErrorDisp').html('Please select one radio button');
		  error_msg +="<li>Please select default login type.</li>";
		 validate_return=0;
	}
	
	var checked_radio_2 = $('#cal_time_interval_typ_2').is(':checked');	
	if(checked_radio_2 == true)
	{
		if($('#cal_time_interval_variable_2').val() == '')
		{
			 $('#error_msg_radio2').html('Required Field');
			 error_msg +="<li>Please select calender time interval.</li>";
			 validate_return=0;
		}
		if($('#cal_time_interval_variable_2').val() < 0)
		{
			$('#error_msg_radio2').html('Field must have a positive value');
			 error_msg +="<li>Please select calender time interval.</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#cal_time_interval_variable_2').val()) == false)
		{
			$('#error_msg_radio2').html('Field Should be Numeric');
			 error_msg +="<li>Please select calender time interval.</li>";
			validate_return=0;	
		}
		
	}
		if($('#adv_bk_min_tim').val() < 0)
		{
			$('#error_msg_adv_bk_min_tim').html('Field must have a positive value');
			 error_msg +="<li>Please select how many days in advance can appointments be booked.</li>";
			validate_return=0;
		}
		if(IsNumeric($('#adv_bk_min_tim').val()) == false)
		{
			$('#error_msg_adv_bk_min_tim').html('Field Should be Numeric');
			 error_msg +="<li>Please select how many days in advance can appointments be booked.</li>";
			validate_return=0;
		}
		
		if($('#bkin_can_mx_tim').val() < 0)
		{
			$('#error_msg_bkin_can_mx_tim').html('Field must have a positive value');
			error_msg +="<li>Please select booking can max time.</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#bkin_can_mx_tim').val()) == false)
		{
			$('#error_msg_bkin_can_mx_tim').html('Field Should be Numeric');
			error_msg +="<li>Please select how long before appointments can be reschedule.</li>";
			validate_return=0;
		}
		
		if($('#bkin_reschdl_mx_tim').val() < 0)
		{
			$('#error_msg_bkin_reschdl_mx_tim').html('Field must have a positive value');
			error_msg +="<li>Please select how long before appointments can be reschedule.</li>";
			validate_return=0;
		}
		if(IsNumeric($('#bkin_reschdl_mx_tim').val()) == false)
		{
			$('#error_msg_bkin_reschdl_mx_tim').html('Field Should be Numeric');
			error_msg +="<li>Please select how long before appointments can be reschedule.</li>";
			validate_return=0;
		}
		if($('#adv_bk_mx_tim').val() < 0)
		{
			$('#error_msg_adv_bk_mx_tim').html('Field must have a positive value');
			 error_msg +="<li>Please select how many days in advance can appointments be booked.</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#adv_bk_mx_tim').val()) == false)
		{
			$('#error_msg_adv_bk_mx_tim').html('Field Should be Numeric');
			 error_msg +="<li>Please select How many days in advance can appointments be booked.</li>";
			validate_return=0;	
		}
		
		if($('#tim_intrvl_btwn_appo').val() < 0)
		{
			$('#error_msg_tim_intrvl_btwn_appo').html('Field must have a positive value');
			 error_msg +="<li>Please select time interval bitween appo.</li>";
			validate_return=0;
		}
		if(IsNumeric($('#tim_intrvl_btwn_appo').val()) == false)
		{
			$('#error_msg_tim_intrvl_btwn_appo').html('Field Should be Numeric');
			 error_msg +="<li>Please select time interval bitween appo.</li>";
			validate_return=0;	
		}
		if($('#sms_alrt_bfr_appo').val() < 0)
		{
			$('#error_msg_sms_alrt_bfr_appo').html('Field must have a positive value');
			 error_msg +="<li>Please select sms alert before appo.</li>";
			validate_return=0;	
		}
		if(IsNumeric($('#sms_alrt_bfr_appo').val()) == false)
		{
			$('#error_msg_sms_alrt_bfr_appo').html('Field Should be Numeric');
			error_msg +="<li>Please select sms alert before appo.</li>";
			validate_return=0;	
		}
		
		
		
	
	
	var checked_radio_3 = $('#cal_time_interval_typ_3').is(':checked');	
	if(checked_radio_3 == true)
	{
	 	//alert(timeToSecond("00:00am"));                                                                         	
		var valcal_time_interval1 = $('#cal_time_interval_variable_3').val().toLowerCase();
		if(valcal_time_interval1 =='')
		{
			$('#error_msg').html('Required Field');
			error_msg +="<li>Please select calender time interval.</li>";
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
				$('#error_msg').html('Invalid Time Format');	
				error_msg +="<li>Please select calender time interval.</li>";	
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
		            $('#error_msg').html('Invalid Time Format1');
					error_msg +="<li>Please select calender time interval.</li>";	
							
					validate_return=0;
		        }		
		    }
			if (meridian=='pm'){
		        if (hours==00){
		            $('#error_msg').html('Invalid Time Format2');
					error_msg +="<li>Please select calender time interval.</li>";			
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
			    $('#error_msg').html('time '+value1+' is gratter than '+ value2);
				error_msg +="<li>Please select calender time interval.</li>";	
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
	if ($('#applyAdvanceBookingRule').attr('checked')) 
	{
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
   $("#error_msg").html("Invalid time. Time format should be HH:MM AM/PM.");
     return false;
  }
  
  //Maximum length is 8. example 10:45 AM
  if(strval.lenght > 8)
  {
   $("#error_msg").html("invalid time. Time format should be HH:MM AM/PM.");
   return false;
  }
  
  //Removing all space
  strval = trimAllSpace(strval); 
  
  //Checking AM/PM
  if(strval.charAt(strval.length - 1) != "M" && strval.charAt(
      strval.length - 1) != "m")
  {
  // alert("Invalid time. Time shoule be end with AM or PM.");
   $("#error_msg").html("Invalid time. Time shoule be end with AM or PM.");
   return false;
   
  }
  else if(strval.charAt(strval.length - 2) != 'A' && strval.charAt(
      strval.length - 2) != 'a' && strval.charAt(
      strval.length - 2) != 'p' && strval.charAt(strval.length - 2) != 'P')
  {
  // alert("Invalid time. Time shoule be end with AM or PM.");
   $("#error_msg").html("Invalid time. Time shoule be end with AM or PM.");
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
   $("#error_msg").html("invlalid time. A color(:) is missing between hour and minute.");
   return false;
  }
  else if(pos1 > 2 || pos1 < 1)
  {
   //alert("invalid time. Time format should be HH:MM AM/PM.");
   $("#error_msg").html("invalid time. Time format should be HH:MM AM/PM.");
   return false;
  }
  
  //Checking hours
  var horval =  trimString(strval.substring(0,pos1));
  if(horval == -100)
  {
  // alert();
   $("#error_msg").html("Invalid time. Hour should contain only integer value (0-11).");
   return false;
  }
      
  if(horval > 12)
  {
     $("#error_msg").html("invalid time. Hour can not be greater that 12.");

  // alert();
   return false;
  }
  else if(horval < 0)
  {
     $("#error_msg").html("Invalid time. Hour can not be hours less than 0.");
   return false;
  }
  //Completes checking hours.
  
  //Checking minutes.
  var minval =  trimString(strval.substring(pos1+1,pos1 + 3));
  
  if(minval == -100)
  {
   	$("#error_msg").html("Invalid time. Minute should have only integer value (0-59).");
   	return false;
  }
    
  if(minval > 59)
  {
   $("#error_msg").html("Invalid time. Minute can not be more than 59.");
     return false;
  }   
  else if(minval < 0)
  {
  
   $("#error_msg").html("Invalid time. Minute can not be less than 0.");
   return false;
  }
   
  //Checking minutes completed.
  
  //Checking one space after the mintues 
  minpos = pos1 + minval.length + 1;
  if(strval.charAt(minpos) != ' ')
  {
    $("#error_msg").html("Invalid time. Space missing after minute. Time should have HH:MM AM/PM format.");

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
			 $('#error_msg').css({color:'red'}).html('Invalid Format');
			 
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

function disabledOne(id1,id2)
{
	$("#"+id1).prop("disabled",false);
	$("#"+id2).val('');
	$("#"+id2).prop("disabled",true);
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
			content	="Set booking rules for your clients.";	
		}
		else if(contentId==2)//Restriction
		{
			content	="Number of booking that a client can make.";			
		}
		else if(contentId==3)//Do you want to allow clients to book recurring appointments? 
		{
			content	="If you want your clients to be able to book same service on multiple days.";			
		}
		else if(contentId==4)//Do you want to show recurring option for Admin?
		{
			content	="If you want to book same service on multiple days on admin side.";			
		}
		else if(contentId==5)//Do you want to allow clients to select quantity for their appointment? 
		{
			content	="If you want your clients to be able to book same service at the same time for more than one person.</li></ul><br /><small><i>Note: This setting will work for all services which has capacity more than 1. ";			
		}
		else if(contentId==6)//Enter the alias for quantity
		{
			content	="For example if you enter seat as alias for quantity. At the time of booking clients will see 1 Seats, 2 Seats.....10 Seats against each appointment.";			
		}
		else if(contentId==7)//Do you want to show service cost to your clients?
		{
			content	="Select No,<ul><li>if you do not charge for any service.</li><li>if you do not want to accept pre-payments and service cost is variable.You can include the cost in service name and hide the cost.</li></ul>";			
		}
		else if(contentId==8)//Do you want to show service time duration to your clients?
		{
			content	="Select No,<ul><li>If you do not want to show service time.</li><li>If you have a buffer time.Put service time including buffer time and mention actual service time in service name.</li></ul><br/><i>Example:15 Mins consultation or Hair Color(30 mins)</i>";			
		}
		else if(contentId==9)//Do you want to show clients name with reviews?
		{
			content	="Select No, if you do not want to show names of your clients with review on DETAIL tab of your calendar.";			
		}
		else if(contentId==10) //What view should be shown by default?
		{
			content	="Select Month View,<ul><li>If you have service or event on certain days in a month</li><li>If you are always full for the upcoming week.It is better to show month view instead of showing full week view</li></ul>";			
		}
		else if(contentId==11)//What should be your calendar's starting weekday?
		{
			content	="Set starting day of the week. <br /> <small>Recommended setting: Today - Because setting it to Sunday or Monday will always show 6 days as unavailble on opening your calendar.</small>";			
		}
		else if(contentId==12) //What should be your calendar's starting date?
		{
			content	="Set starting date for the calendar. From which date you want your clients to start booking.";			
		}
		else if(contentId==13)  //Do you want to show staff to your customers?
		{
			content	="Select Yes, <ul><li>If you want to allow your clients to select staff.</li></ul>";			
		}
		else if(contentId==14)  //Do you want to make staff selection mandatory?
		{
			content	="Selecting yes, will make staff selection mandatory for clients at the time of booking. Otherwise staff will be allocated automaticlly.";			
		}
		else if(contentId==15)//What screen should be shown by default on booking? 
		{
			content	="This screen will be shown to user when he is booking appointment without login.";			
		}
		else if(contentId==16)//Allow Bookient to automatically calculate time slots on your calendar? 
		{
			content	="Selecting this option would allow system to automatically calculate best possible time slot.";			
		}
		else if(contentId==17)//Set a fix time interval to show on calendar
		{
			content	="Example:If you provide consultation from 10 AM to 6 PM then selecting<ul><li>15 minutes will show 10:00, 10:15,10:30 ...to...5:45</li><li>30 minutes will show 10:00, 10:30, 11:00 ...to... 5:30</li></ul>";			
		}
		else if(contentId==18)//Show only specific times on the calendar (comma separated)
		{
			content	="This setting will allow you to open your time slots at your will. Open precise times and even control the order in which time will open. <br /><br />For ex. if you set <b>9:00 AM,12:00 PM#3:00 PM,6:00 PM</b>, then 3:00 PM,6:00 PM will be displayed only when 9:00 AM and 12:00 PM are booked.";			
		}
		else if(contentId==19) //How long before appointments can be booked ?
		{
			content	="This setting allows you to set a time before an appointment can be booked.<i>For example:If today is 1st Jan 2008, and you have set 2 days here then your clients would be able to take appointments only from 3rd jan 2008.<br>setting this in hour will calculate exact time before an appointment can be booked.For example:If today is 1st Jan 2008 and time is 3:00 Pm,and you have set 27 hours here,then your client would not be able to book appointment untill 6:00 PM on 2nd Jan 2008.";			
		}
		else if(contentId==20)//How long before appointments can be cancelled?
		{
			content	="This setting allows you to set a time limit for cancelling an appointment.<i>For example:Setting this to 24 hours will not allow your clients to cancel an appointment if the time of appointment is less than 24 hours.</i>";			
		}
		else if(contentId==21)//How long before appointments can be reschedule?
		{
			content	="This setting allows you to set a time limit for rescheduling an appointment. <br /><i>For example: Setting this to 24 hours will not allow your clients to reschedule an appointment if the time of appointment is less than 24 hours.</i>";			
		}
		else if(contentId==22)//How many days in advance can appointments be booked?
		{
			content	="Setting this to 90days will allow your clients to see and book appointments upto 90 days from today.";		
		}
		else if(contentId==23)//How much time interval between each appointment?
		{
			content	="Setting this to 1 day will restrict your customers to book appointments in a gap of 1 day.Setting this to 27 hour will restrict your customers to book appointments in a gap of 27 hours.";			
		}
		else if(contentId==24)//Set time interval for Administrator 
		{
			content	="Example: If you provide consultation from 10AM to 6 PM then selecting<ul><li>15 minutes will show 10:00, 10:15 ,10:30 ...to... 5:45</li><li>30 minutes will show 10:00, 10:30, 11:00 ...to ... 5:30</li><ul>";			
		}
		else if(contentId==25)//Set time interval for Administrator 
		{
			content	="Booking time will display on that format.";			
		}		
		return content;
	}
</script>
