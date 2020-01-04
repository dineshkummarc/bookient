<script type="text/JavaScript">
function SavePaymentGatewayValues()
{
	var $formId = $('#form-business');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
	$('li',$formId).removeClass('error');
	$('span.error').remove();							 
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		
		if(inputVal == ''){
			$parentTag.addClass('error').append($error.clone().text('Required Field'));
		}
		
		if($(this).hasClass('email') == true){
			if(!emailReg.test(inputVal)){
				$parentTag.addClass('error').append($error.clone().text('Enter valid email'));
			}
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
	else 
	{
		var frmID='#form-business';
		var params ={ 'action' : 'save' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});
		
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/payment_gateway_settings/SavePaymentGatewayValuesAjax"); ?>',
			   data: params,
			   success: function(data){
				   if(data==1)
				   {
					   $('#msg_span').html('<span style="color:#008040">Data saved successfully!</span>');
				   }
				   else
				   {
					   $('#msg_span').html('<span style="color:#FF0000">Can not save data!Please try again later.</span>');
				   }
			   }
		});
	}
}
</script>