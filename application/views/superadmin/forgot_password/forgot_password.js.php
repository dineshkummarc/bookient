<script type="text/JavaScript">
$(document).ready(function() { 

		$('.btn-submit-login').click(function(e){
		
		// Declare the function variables:
		// Parent form, form URL, email regex and the error HTML
		//if(pin_code_check ==1)
		//{
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var $error = $('<span class="error"></span>');
        var user_name=$("#user_name").val();
		var email=$("#user_email").val();
		//alert(password);
		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();

		// Validate all inputs with the class "required"
		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if(inputVal == ''){
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
			}
			
			// Run the email validation using the regex for those input items also having class "email"
			
		});

		// All validation complete - Check if any errors exist
		// If has errors
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
		} else {
			//$formId.submit();
			
				$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url: "<?php echo base_url(); ?>superadmin/forgot_password/ForgotPasswordAjax",
				  data: { 'user_name': user_name, 'user_email': email },
				  success:function(rdata)
				  { 
						if(rdata==1)
						{
							$("#invalid_login").html('<span style="color:#036">Your password has been sent to your email.</span>');
						}
						else if(rdata==0)
						{ 
							$("#invalid_login").html('<span style="color:#FF0000">Invalid user details.</span>');
						}
					
				  }
				
			
				});
				
					
			
			
		}
		// Prevent form submission
			e.preventDefault();

	
	});
	
	// Fade out error message when input field gains focus
	$('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});
 });
</script>
