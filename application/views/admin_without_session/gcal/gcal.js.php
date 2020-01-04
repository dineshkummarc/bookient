<script type="text/javascript">
$(document).ready(function(){ 
	$("#integrate_with_calendar").click(function(){
	var gcalEmail 		= $('#gcal_email').val();
	var gcalPassword 	= $('#gcal_password').val();
	var gcalStartDate	= $('#gcal_startDate').val();
	var gcalEndDate 	= $('#gcal_endDate').val();
	var errorcount=0;
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( gcalEmail ) ){
       $("#gcal_email").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
        errorcount++;
    }
	if($.trim(gcalEmail)==''){
		$("#gcal_email").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		errorcount++;
	}
	if($.trim(gcalPassword)==''){
		$("#gcal_password").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		errorcount++;
	}
	if($.trim(gcalStartDate)==''){
		$("#gcal_startDate").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		errorcount++;
	}
	if($.trim(gcalEndDate)==''){
		$("#gcal_endDate").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		errorcount++;
	}
	
	if(errorcount ==0){
	$('<img id="imgGcal" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>').insertAfter("#integrate_with_calendar");
	$("#integrate_with_calendar").hide();
	$.ajax({
	       type: 'POST',
	       url: "<?php echo base_url(); ?>admin/gcal/addCalender",
	       data: {'gcalEmail': gcalEmail, 'gcalPassword': gcalPassword,'gcalStartDate': gcalStartDate, 'gcalEndDate': gcalEndDate },
	       success: function(rdata){ 
				$("#imgGcal").remove();
				$("#integrate_with_calendar").show();
				$("#msgGcal").html('You booking successfully integrate with google calender.');
			}
	    });
	}else{
		return false;
	}	
	})
	
	
	$( "#gcal_startDate" ).datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,
	onClose: function( selectedDate ) {
		$( "#gcal_endDate" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#gcal_endDate" ).datepicker({
	dateFormat: 'yy-mm-dd',
	changeMonth: true,
	onClose: function( selectedDate ){
		$( "#gcal_startDate" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	
	$( ".text-input" ).focus(function() {
		$(this).removeAttr('style');
		$("#msgGcal").html('');
	});	
})
 
</script>