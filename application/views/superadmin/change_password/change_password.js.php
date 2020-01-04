
<script type="text/javascript">
//CB#SOG#15-11-2012#PR#S
		$(document).ready(function() {		
			
			$('.required').focus(function(){			
				$(this).next().text('');
			});
		});
//CB#SOG#15-11-2012#PR#E
</script>



<script type="text/JavaScript">

	function change_password()
	{
		var $formId = $('#form-chng-pass');
		var formAction = $formId.attr('action');
		var $error = $('<span class="error" style="color:#FF0000;"></span>');
		var errorval = 1;
		
		$('li',$formId).removeClass('error');
		$('span.error').remove();							 
		$('.required',$formId).each(function(){
		//CB#SOG#15-11-2012#PR#S
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if($.trim(inputVal) == ''){
				//$parentTag.addClass('error').append($error.clone().text('Required Field'));
				//$parentTag.addClass('error').append('<span class="error1" style="color:#FF0000;">eee</span>');
				//alert($(this).attr('id'));
				if($(this).attr('id') =='current_pass') {
					$('#current_error').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
					errorval++;
				}
				
				if($(this).attr('id') =='new_pass') {
					$('#new_error').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
					errorval++;
				}
				if($(this).attr('id') =='confirm_pass') {
					$('#confirm_error').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
					errorval++;
				}
			//CB#SOG#15-11-2012#PR#E				
				
			}
			
		});	
	
		/*if ($('span.error').length > 0) {
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
		}*/
		
		//else 
		if(errorval == 1)
		{
			var current_pass = $("#current_pass").val();
			var new_pass = $("#new_pass").val();
			var confirm_pass = $("#confirm_pass").val();
			
			$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url: "<?php echo base_url(); ?>superadmin/change_password/change_password_ajax",
				  data: {'current_pass' : $.trim(current_pass), 'new_pass' : $.trim(new_pass), 'confirm_pass' : $.trim(confirm_pass)},
				  success:function(rdata)
				  { 
						if(rdata == 0)
						{
							$('.show_error').html('');
							$('#success').html('<span style="color:#FF0000;font-size:10px;">Password change failed!Try agnain later.</span>');
						}
						else if(rdata == 1)
						{
							$('.show_error').html('');
							$('#success').html('<span style="color:#063;font-size:10px;">Password change successful.</span>');
						}
						else if(rdata == 2)
						{
							$('.show_error').html('');
							$('#confirm_error').html('<span style="color:#FF0000;font-size:10px;">Confirm password does not match.</span>');
						}
						else if(rdata == 3)
						{
							$('.show_error').html('');
							$('#current_error').html('<span style="color:#FF0000;font-size:10px;">Current password does not match.</span>');
							/*var $parentTag = $('#current_pass').parent();
							$parentTag.addClass('error').append($error.clone().text('Current password does not match.'));
							$('#current_error').show().css({
								display: 'block',
								opacity: 0,
								right: -start+'px'
							})
							.animate({
									right: -width+'px',
									opacity: 1
								}, 'slow');
							//current_pass*/
						}
				  }
			});
		}
	}

</script>