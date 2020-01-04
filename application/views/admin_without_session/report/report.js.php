<script type="text/javascript">
<!--===========================================DATE-TIMEPICKER CODE===========================================-->
$(function() {
		$("#date_from").datepicker({
                     onClose: function( selectedDate ) {
                        $( "#date_to" ).datepicker( "option", "minDate", selectedDate );
                     }
                });
		$("#date_to").datepicker({
                     onClose: function( selectedDate ) {
                        $( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
                     }
                });
	});
<!--===========================================DATE-TIMEPICKER CODE===========================================-->        
</script>

<script type="text/javascript">
		$(document).ready(function() {
								   
			$('#date_from').focus(function(){
				$('#err_from').html('');
				$('#err_rep').html('');
			});	
			$('#date_to').focus(function(){
				$('#err_to').html('');
				$('#err_rep').html('');
			});	
			
		});
</script>

<script type="text/javascript">
SyntaxHighlighter.defaults['toolbar'] = false;
SyntaxHighlighter.all();
</script>

<script type="text/javaScript">
function show_hide_tr()
{
	$('#show_hide').show();
	$('#adv_search').hide();
}

function hide_show_tr()
{
	$('#show_hide').hide();
	$('#adv_search').show();
}

function ask_review(id,cus_id)
{
	//alert(cus_id);
	var r = confirm('Are you sure you want to ask for review ?');
	if(r == true)
	{
		$.ajax({
			url: "<?php echo base_url(); ?>admin/appointment_report/Ask_ReviewAjax/",
			type: "POST",
			data: {b_s_id: id,cus_id: cus_id},
			success: function(msg) {
				alert(msg);
				/*
				if (msg == 1) 
				{
					alert('Status updated sucessfully!');
					window.location.reload();
				} 
				else 
				{
					alert('There is some error processing your request');
				}
				*/
			}
		});
	}
	
}

function serach_appointment()
{
	var frmID='#frm_appointment';
	var params ={'module': 'appointment'};
	var paramsObj = $(frmID).serializeArray();
	
	
	$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
	});
	//CB#SOG#11-12-2012#PR#S
	var errorcount = 0;
	if($('#date_from').val() =="") {
		$('#err_from').html('Required Field');
		errorcount++;		
	}
	if($('#date_to').val() =="") {
		$('#err_to').html('Required Field');		
		errorcount++;	}
	if(errorcount > 0) {
		return false;
	}
	//CB#SOG#11-12-2012#PR#E
	var startDate = new Date($('#date_from').val());
    var endDate = new Date($('#date_to').val());
	
	if (startDate <= endDate){
                $('#show_result').html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif" height="30" width="30" /><br>Loding...</center>')
		$.ajax({
			url: "<?php echo base_url(); ?>admin/appointment_report/getAppointments/",
			type: "POST",
			data: params,
			success: function(msg) {
				//alert(msg);
				
				$('#show_result').html(msg);
				
				/*if (msg == 1) 
				{
					alert('Status updated sucessfully!');
					window.location.reload();
				} 
				else 
				{
					alert('There is some error processing your request');
				}*/
			}
		});
    } else {
		var msg = "To Date should be greater than From Date.";
		$('#err_rep').html(msg);
		return false;
	}
}

function change_status(status,id)
{
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>staff/change_status/",
		type: "POST",
		data: { status: status, id: id},
		success: function(msg) {
			if (msg == 1) 
			{
				alert('Status updated sucessfully!');
				window.location.reload();
			} 
			else 
			{
				alert('There is some error processing your request');
			}
		}
	});
}

function Send_Password(id)
{
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/send_password/"+id,
		type: "POST",
		//data: {id: id},
		success: function(msg) {
			if (msg == 1) 
			{
				alert('Password sent sucessfully!');
				//window.location.reload();
			} 
			else 
			{
				alert('There is some error processing your request');
			}
		}
	});
}

function GetStaffData(id)
{
	//alert('2222222222222');
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/staff_data/"+id,
		type: "POST",
		success: function(msg) {
			var obj = JSON.parse(msg);
			
			$('#employee_name').val(obj.employee_name);
			$('#employee_username').val(obj.user_name);
			$('#password-1').val(obj.password);
			$('#email').val(obj.user_email);
			$('#employee_mobile_no').val(obj.employee_mobile_no);
			$('#employee_description').val(obj.employee_description);
			$('#employee_education').val(obj.employee_education);
			$('#employee_languages').val(obj.employee_languages);
			$('#employee_membership').val(obj.employee_membership);
			$('#employee_awards').val(obj.employee_awards);
			$('#employee_publications').val(obj.employee_publications);
			$('#employee_id').val(obj.employee_id);
			
			var staffImgSrc  = "<?php echo base_url(); ?>uploads/staff/"+obj.employee_image
			$("#staffImg").attr("src", staffImgSrc);
			$('#staffImg').show();
			
			var frmAction = "<?php echo base_url(); ?>admin/staff/update_staff/"+obj.employee_id;
			$("#form-staff").attr("action", frmAction);
		}
	});
}


<!--===========================================DATE-TIMEPICKER CODE===========================================-->
$(function() {
		$("#date_from").datepicker();
		$("#date_to").datepicker();
		$('#timepickerFrom').timepicker({});
		$('#timepickerTo').timepicker({});
		$("#date_of_time_block").datepicker();
	});
<!--===========================================DATE-TIMEPICKER CODE===========================================-->        

function blockTimingsData(blk_dt_employee_id)
{
	$('#bloceddatedisp').html(" ");
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/show_blocked_dates/"+blk_dt_employee_id,
		type: "POST",
		//data: {id: id},
		//dataType: 'json',
		success: function(msg) {
			var string = " ";
			var obj = JSON.parse(msg);
			for(var i in obj)
			{
				var DateString = obj[i];
				var hrefstart = '<a href="javascript:void(0);" onclick="DeleteDate('+blk_dt_employee_id+',\''+DateString+'\');">';
				var hrefend = '</a>';
				string+=  hrefstart+DateString+hrefend+"; ";
			}
			//alert(string);
			$('#bloceddatedisp').html(string);
		}
	});
	
	
	
	$('#BlockedTimingsDisp').html(" ");
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/show_blocked_times/"+blk_dt_employee_id,
		type: "POST",
		//data: {id: id},
		//dataType: 'json',
		success: function(msg) {
			$('#BlockedTimingsDisp').html(msg);
		}
	});
	
	
	$('#blk_dt_employee_id').val(blk_dt_employee_id);
	$('#blk_time_employee_id').val(blk_dt_employee_id);
	$('#blockTimings').show();
}

function DeleteDate(employee_id,date)
{
	   $.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/delete_block_dt/"+employee_id+"/"+date,
		type: "POST",
		success: function(msg) {
						$('#bloceddatedisp').html(" ");
						$.ajax({
						url: "<?php echo base_url(); ?>admin/staff/show_blocked_dates/"+employee_id,
						type: "POST",
						success: function(msg) {
							var string = " ";
							var obj = JSON.parse(msg);
							for(var i in obj)
							{
								var DateString = obj[i];
								var hrefstart = '<a href="javascript:void(0);" onclick="DeleteDate('+employee_id+',\''+DateString+'\');">';
								var hrefend = '</a>';
								string+=  hrefstart+DateString+hrefend+"; ";
							}
							$('#bloceddatedisp').html(string);
							$('html,body').animate({scrollTop: $('#bloceddatedisp').offset().top},'slow');
						}
					});
		}
	});
}


function DeleteTimeBlockData(deletetimeId, employee_id)
{
	$.ajax({
	url: "<?php echo base_url(); ?>admin/staff/delete_time_block_data/"+deletetimeId,
	type: "POST",
		success: function(msg) {
					$('#BlockedTimingsDisp').html(" ");
					$.ajax({
						url: "<?php echo base_url(); ?>admin/staff/show_blocked_times/"+employee_id,
						type: "POST",
						success: function(msg) {
							$('#BlockedTimingsDisp').html(msg);
						}
					});
		}
	});
	//alert(deletetimeId);
}
</script>
<script type="text/javascript">
function focusit()
{
	var value = $('#username').val();
	if(value == 'Client Username')	
	{
		$('#username').val('');
	}
}
function blurit()
{
	var value = $('#username').val();
	if(value == '')	
	{
		$('#username').val('Client Username');
	}
}
</script>

<script language="javascript" type="text/javascript">
function printon() 
{

	//$('#search_result').jqprint();
	//$('#search_result').window.print();
}

			 
function exporton1() 
{
	
var appoint_type=$("#appointment_type").val();
var display_type=$("#display_type").val();
var date_from=$("#date_from").val();
var date_to=$("#date_to").val();
var service=$("#service").val();
var staff=$("#staff").val();
var status=$("#status").val();
var username=$("#username").val();
location.href="<?php echo site_url('admin/appointment_report/export_excel_csv'); ?>" +"?app_type="+appoint_type+"&display_type="+display_type+"&date_from="+ date_from+"&date_to="+date_to+"&service="+service+"&staff="+staff+"&status="+status+"&username="+username;

}

function exporton()
{	
	var appoint_type=$("#appointment_type").val();
	var display_type=$("#display_type").val();
	var date_from=$("#date_from").val();
	var date_to=$("#date_to").val();
	var service=$("#service").val();
	var staff=$("#staff").val();
	var status=$("#status").val();
	var username=$("#username").val();
	location.href="<?php echo site_url('admin/appointment_report/getAppointmentsExcel'); ?>" +"?appointment_type="+appoint_type+"&display_type="+display_type+"&date_from="+ date_from+"&date_to="+date_to+"&service="+service+"&staff="+staff+"&status="+status+"&username="+username;

}
</script>