<script type="text/JavaScript">
$(document).ready(function() { 

   $('#btn-submit1').click(function(e){ 
	
	    // Declare the function variables:
		// Parent form, form URL, email regex and the error HTML
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$($formId).removeClass('error');
		$('span.error').remove();

		// Validate all inputs with the class "required"
		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			//CB#SOG#14-12-2012#PR#S
			if($.trim(inputVal) == ''){
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
			}
		    //CB#SOG#14-12-2012#PR#E
		
			
			
		});

		// All validation complete - Check if any errors exist
		// If has errors
		if ($('span.error').length > 0) {
			
			$('span.error').each(function(){
				
				// Set the distance for the error animation
				/*var distance = 10;
				
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
				}, 'slow');*/
				
			});
		} else {
			$formId.submit();
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


