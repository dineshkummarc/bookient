<script type="text/javascript">
function reset_page()
{
	$('#rightpanel_profile').show();
	//$('#rightpanel_edit').hide();
}

function SaveData()
{
    
	var $formId = $('#frm-staff-profile');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');
	
	$('li',$formId).removeClass('error');
	$('span.error').remove();							 
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		if(inputVal == ''){
			$parentTag.addClass('error').append($error.clone().text('Required Field'));
		}
	});	
	
	if ($('span.error').length > 0) {
			$('span.error').each(function(){
				// Set the distance for the error animation
				var distance = 5;
				// Get the error dimensions
				var width = $(this).outerWidth();
				// Calculate starting position
				var start = width + distance;
				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				// Animate the error message
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}
	else 
	{
		var frmID = '#frm-staff-profile';
		var params ={ 'action' : 'save' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});
		
		$.ajaxFileUpload({
				url:'<?php echo base_url(); ?>staff/staff_home/StaffSaveDataAjax',
				secureuri:false,
				fileElementId:'employee_image',
				dataType:'json',
				data:params,
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						} else {
						
							if(data.msg != '')
								$('#replace_img').html('<img src="<?php echo base_url(); ?>uploads/staff/'+data.msg+'" alt="Image" height="115" width="" />');
								//alert('hh');
								$('#staffmsg').html('Profile sucessfully updated.');
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
	}
}

function OpenEditPanel()
{
	$('#rightpanel_profile').hide();
	$('#rightpanel_edit').show();
}

function change_label(id)
{
	if(id != '')
	{
		var val = $('#input_'+id).val();
		$('#id_'+id).html('<span style="background-color:#F1F4FA onclick="change_label(\''+id+'\');"">'+val+'<a href="#" onclick="delete_biz('+id+')"><img src="<?php echo base_url(); ?>images/trash.gif"></a></span>');
	}
}

function change_back(id)
{
	if(id != '')
	{
		var val = $('#input_'+id).val();
		$('#id_'+id).html('<span style="background-color:#FFFFFF" onclick="change_label(\''+id+'\');">'+val+'</span>');
	}
}

function delete_biz(id)
{
	var r=confirm("Are you sure?");
	if(r==true)
	{
		$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("staff/staff_home/BizDeleteAjax"); ?>',
		   data: { 'id' : id },
		   success: function(data){
				$('#id_'+id).html('');
		   }
		});
	}
}

function show_add_schedule()
{
	
	$('#add_schedule_img').html('<a href="#" onclick="hide_add_schedule();"><img src="<?php echo base_url(); ?>images/timeicon.png" />&nbsp;<strong style="font-size:12px;">Add or update schedule</strong></a>');
	$('#add_schedule').show();
}

function hide_add_schedule()
{
	$('#add_schedule_img').html('<a href="#" onclick="show_add_schedule();"><img src="<?php echo base_url(); ?>images/timeicon.png" />&nbsp;<strong style="font-size:12px;">Add or update schedule</strong></a>');
	$('#add_schedule').hide();
}

$(function(){
	$('#timepickerFrom').timepicker({});
	$('#timepickerTo').timepicker({});
});

function AddUpdateSchedule()
{
	var error = 0;
	var $formId = $('#add_work_schedule');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');
	
	$('li',$formId).removeClass('error');
	$('span.error').remove();							 
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		if(inputVal == ''){
			$parentTag.addClass('error').append($error.clone().text('Required Field'));
		}
	});	

	if($('input[name=service]:checked').length > 0)
	{
		$('#radio_err').html('');
	}
	else
	{
		error = 1;
		$('#radio_err').html('Required Field');
	}
	if ($('span.error').length > 0) 
	{
		error = 1;		
		$('span.error').each(function(){
				// Set the distance for the error animation
				var distance = 5;
				// Get the error dimensions
				var width = $(this).outerWidth();
				// Calculate starting position
				var start = width + distance;
				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				// Animate the error message
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}
	var n = $("input[name='day[]']:checked").length;
	if(n == 0)
	{
		error = 1;
		$('#check_err').html('Required Field');
	}
	if(n > 0)
	{
		$('#check_err').html('');
	}
	if(error == 0)
	{
        var values = new Array();
		$.each($("input[name='day[]']:checked"), function() {
		  values.push($(this).val());
		});

		var frmID = '#add_work_schedule';
		var params ={ 'action' : 'save', 'day' : values };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});
		
		$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("staff/staff_home/UpdateServicesAjax"); ?>',
		   data: params,
		   success: function(data){
				
				if(data == 1)
					location.reload();
		   }
		});
	}
}

function get_staff_details(id)
{
	$.ajax({
	   type: 'POST',
	   url: '<?php echo site_url("staff/staff_home/GetStaffServiceDetilsAjax"); ?>',
	   data: { 'id' : id },
	   success: function(data){
			$('#days').html(data);;
	   }
	});
}
</script>