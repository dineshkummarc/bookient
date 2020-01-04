<!-- JavaScript -->
<script type="text/javascript">
//CB#SOG#19-11-2012#PR#S
	$(document).ready(function() {
		$('.super-listing-tabl tbody').paginate({
			status: $('#status'),
			controls: $('#paginate'),
			itemsPerPage: 5
		});
		//CB#SOG#27-11-2012#PR#S
		$('#start_date').focus(function(){
				$('#start_date').next('span').html('');
		});
		$('#end_date').focus(function(){
				$('#end_date').next('span').html('');
		});
		$('#local_admin_id').focus(function(){
				$('#local_admin_id').next('span').html('');
		});
		$('#payment_type').focus(function(){
				$('#payment_type').next('span').html('');
		});

		//CB#SOG#27-11-2012#PR#E
                $("#local_admin_id option:lt(1)").attr("disabled", "disabled");
                $("#payment_type option:lt(1)").attr("disabled", "disabled");

	});
	//CB#SOG#19-11-2012#PR#E

</script>


<!--===========================================DATE-TIMEPICKER CODE===========================================-->
<script type="text/javascript">
$(function() {
	$("#start_date").datepicker();
	$("#end_date").datepicker();
});
</script>
<!--===========================================DATE-TIMEPICKER CODE===========================================-->

<script type="text/javascript">
function GetResultantData()
{
	//alert($('#start_date').val());return false;
	var $formId = $('#frm_payment');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');
	var errorcode = 0;

	$('li',$formId).removeClass('error');
	$('span.error').remove();
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		if(inputVal == ''){
			$parentTag.addClass('error').append($error.clone().text('Required Field'));
			errorcode++;
		}
	});



	if ($('span.error').length > 0) {
			$('span.error').each(function(){
				var distance = 5;
				var width = $(this).outerWidth();
				var start = width + distance;
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}

	var stDate = new Date($('#start_date').val());
    var enDate = new Date($('#end_date').val());
	var compDate = enDate - stDate;
	if(compDate <= 0)
	{
		//alert("Please Enter the correct date ");
		$('#end_date').after('<span class="error" style="color:#FF0000;">    End Date should be greater than Start Date.</span>');
		errorcode++;
		return false;
	}



	if(errorcode ==0)
	{
		var frmID='#frm_payment';
		var params ={ 'action' : 'search' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
				params[field.name] = field.value;
		});

		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/payment_manager/SearchFormAjax"); ?>',
			   data: params,
			   success: function(data){
				   	$('#payment_listing').html(data);
					//CB#SOG#19-11-2012#PR#S
					$('.super-listing-tabl tbody').paginate({
						status: $('#status'),
						controls: $('#paginate'),
						itemsPerPage: 5
					});
					//CB#SOG#19-11-2012#PR#E
				}
		});
	}
}
</script>

<script type="text/javascript">
function CancelData()
{
	$('.required').val('');
	location.reload();
}
</script>

<script type="text/javascript">
function change_status(membership_payment_history_id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/payment_manager/ChangeStatusAjax"); ?>',
		   data: { 'membership_payment_history_id' : membership_payment_history_id },
		   success: function(data){
				$('#replace_status_'+membership_payment_history_id).html(data);
			}
	});
}
</script>
<!--==================================================================================================================================================================--><script type="text/javascript">
function submit_credit()
{
	var editorText = CKEDITOR.instances.description.getData();
	var hiddenId = $('#smscall_dtls_id').val();
	var error = 0;

	if(editorText == '')
	{
		$('#ans_err').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
		error = 1;
	}

	var $formId = $('#faq_frm');
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
		if(error == 0)
		{
			var frmID='#faq_frm';
			var params ={ 'action' : 'save' };
			var paramsObj = $(frmID).serializeArray();
			$.each(paramsObj, function(i, field){
				if(field.name == 'description')
					params[field.name] = editorText;
				else
					params[field.name] = field.value;
			});

			$.ajax({
				   type: 'POST',
				   url: '<?php echo site_url("superadmin/credit_manager/SaveAjax"); ?>',
				   data: params,
				   success: function(data){
						$('#faq_listing').show();
						$('#faq_listing').html(data);
						$('#add_faq').hide();
					}
			});
		}
	}
}
</script>

<script type="text/javascript">
function hide_show_tbl()
{

	$('#faq_listing').hide();
	$('#credit_rate').hide();
	$('#new_rate').hide();
	$('#add_faq').show();
	$('.required').val('');
	CKEDITOR.instances.description.setData('');
}
</script>

<script type="text/javascript">
function edit_credit(id)
{
	$('#faq_listing').hide();

	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/EditAjax"); ?>',
		   dataType: 'json',
		   data: { 'smscall_dtls_id' : id },
		   success: function(data){
			    $('#add_faq').show();
				$('#sub_faq').val('Update');
				$('#smscall_dtls_id').val(data.smscall_dtls_id);
				$('#package_name').val(data.package_name);
				$('#amount').val(data.amount);
				$('#credit').val(data.credit);
				CKEDITOR.instances.description.setData(data.description);
			}
	});
}
</script>

<script type="text/javascript">
function del_credit(id)
{
	var r = confirm('Are you sure you want to delete this credit ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/credit_manager/DelAjax"); ?>',
			   data: { 'smscall_dtls_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
				}
		});
	}
}
</script>

<script type="text/javascript">
function cancl_credit()
{
	$('#faq_listing').show();
	$('#add_faq').hide();
}
</script>

<script type="text/javascript">
function add_credit_rate(id)
{
	$('#credit_rate').show();
	$('#faq_listing').hide();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/EditRateAjax"); ?>',
		   dataType: 'html',
		   data: { 'smscall_dtls_id' : id },
		   success: function(data){
				$('#credit_rate').html(data);
			}
	});
}
function back_credit()
{
	$('#credit_rate').hide();
	$('#faq_listing').show();

}
</script>

<script type="text/javascript">
function edit_rate(id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/GetRateValAjax"); ?>',
		   dataType: 'json',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				$('#edit_span_call_'+id).html('<input type="text" style="width:50px;" name="call_rate_e" id="call_rate_e" value="'+data.call_rate+'" />&nbsp;<a href="javascript:void(0);" onclick="save_edited_rate_call(\''+id+'\')"><img src="<?php echo base_url(); ?>images/save.png" alt="Edit" title="Edit" /></a>&nbsp;<a href="javascript:void(0);" onclick="cancel_edited_rate_call(\''+id+'\')"><img src="<?php echo base_url(); ?>images/cancel.png" alt="Edit" title="Edit" /></a>');
				$('#edit_span_sms_'+id).html('<input type="text" style="width:50px;" name="sms_rate_e" id="sms_rate_e" value="'+data.sms_rate+'" />&nbsp;<a href="javascript:void(0);" onclick="save_edited_rate_sms(\''+id+'\')"><img src="<?php echo base_url(); ?>images/save.png" alt="Edit" title="Edit" /></a>&nbsp;<a href="javascript:void(0);" onclick="cancel_edited_rate_sms(\''+id+'\')"><img src="<?php echo base_url(); ?>images/cancel.png" alt="Edit" title="Edit" /></a>');
			}
	});
}
</script>

<script type="text/javascript">
function delete_rate(id,dtls_id)
{
	var r = confirm('Are you sure you want to delete this credit ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/credit_manager/DeleteCreditRateAjax"); ?>',
			   dataType: 'html',
			   data: { 'smscall_rate_dtls_id' : id, 'smscall_dtls_id' : dtls_id },
			   success: function(data){
					$('#credit_rate').show();
					$('#credit_rate').html(data);
				}
		});
	}
}
</script>

<script type="text/javascript">
function add_new_rate(smscall_dtls_id)
{
	$('#package_id').val(smscall_dtls_id);
	$('#credit_rate').hide();
	$('#new_rate').show();
}
function hide_new_rate()
{
	$('#credit_rate').show();
	$('#new_rate').hide();
}
</script>

<script type="text/javascript">
function save_call_rate()
{
	var country_id = $('#country_id').val();
	var call_rate = $('#call_rate').val();
	var smscall_dtls_id = $('#package_id').val();
	var error=0;

	if(country_id == '')
	{
		$('#country_id_error').html('<span style="color:#FF0000;">Required Field</span>');
		error=1;
	}

	if(call_rate == '')
	{
		$('#call_rate_error').html('<span style="color:#FF0000;">Required Field</span>');
		error=1;
	}

	if(error==0)
	{
		$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/save_call_rate_ajax"); ?>',
		   dataType: 'html',
		   data: { 'smscall_dtls_id' : smscall_dtls_id, 'country_id' : country_id, 'call_rate' : call_rate },
		   success: function(data){
			    $('#new_rate').hide();
				$('#credit_rate').show();
				$('#credit_rate').html(data);
			}
		});
	}
}
</script>

<script type="text/javascript">
function cancel_call_rate()
{

}
</script>

<script type="text/javascript">
function save_sms_rate()
{
	var country_id = $('#country_id').val();
	var sms_rate = $('#sms_rate').val();
	var smscall_dtls_id = $('#package_id').val();
	var error=0;

	if(country_id == '')
	{
		$('#country_id_error').html('<span style="color:#FF0000;">Required Field</span>');
		error=1;
	}

	if(sms_rate == '')
	{
		$('#sms_rate_error').html('<span style="color:#FF0000;">Required Field</span>');
		error=1;
	}

	if(error==0)
	{
		$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/save_sms_rate_ajax"); ?>',
		   dataType: 'html',
		   data: { 'smscall_dtls_id' : smscall_dtls_id, 'country_id' : country_id, 'sms_rate' : sms_rate },
		   success: function(data){
			    $('#new_rate').hide();
				$('#credit_rate').show();
				$('#credit_rate').html(data);
			}
		});
	}
}
</script>

<script type="text/javascript">
function cancel_sms_rate()
{

}
</script>

<script type="text/javascript">
function change_status_rate(id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/ChangeStatusRateAjax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				$('#rate_status_'+id).html(data);
			}
	});
}
</script>

<script type="text/javascript">
function save_edited_rate_call(id)
{
	var call_val = $('#call_rate_e').val();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/save_edited_rate_call_ajax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id, 'call_rate' : call_val },
		   success: function(data){
				$('#edit_span_call_'+id).html(data);
		   }
	});
}
</script>

<script type="text/javascript">
function cancel_edited_rate_call(id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/cancel_edited_rate_call_ajax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				$('#edit_span_call_'+id).html(data);
		   }
	});
}
</script>

<script type="text/javascript">
function save_edited_rate_sms(id)
{
	var sms_val = $('#sms_rate_e').val();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/save_edited_rate_sms_ajax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id, 'sms_rate' : sms_val },
		   success: function(data){
				$('#edit_span_sms_'+id).html(data);
		   }
	});
}
</script>

<script type="text/javascript">
function cancel_edited_rate_sms(id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/cancel_edited_rate_sms_ajax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				$('#edit_span_sms_'+id).html(data);
		   }
	});
}
</script>
