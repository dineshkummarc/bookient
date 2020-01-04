<script type="text/JavaScript">

 $(document).ready(function(){ 

		$('#user_email').focus();

		document.onkeypress = function(evt) {
		    evt = evt || window.event;
		    var charCode = evt.which || evt.keyCode;
		    if (charCode == 13) {
		       $('#btn-submit-login').click();
				return false;
		    }
		};

		var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
		$("#user_email").blur(function(){
			var user_email=	$("#form-login #user_email").val();
			if (user_email =='' || !emailexp.test(user_email)){
				$("#user_email").removeAttr('class');
				$("#user_email").attr('class','text-input-red');
	   	 	}
		})
		
		$("#user_email").click(function(){
			$("#user_email").removeAttr('class');
			$("#user_email").attr('class','text-input-blue');
		})
	
	$('#btn-submit-login').click(function(e){
	
		var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
		
		var user_email=	$("#user_email").val();	
		var error=0;
		if (user_email=='' || !emailexp.test(user_email)){
			$("#user_email").removeAttr('class');
			$("#user_email").attr('class','text-input-red');
			error++;
	   	 }
		 
		if(error == 0){
		lightbox_body();	
		$.ajax({
		       type: 'POST',
		       url: "<?php echo base_url(); ?>admin/forgot_password/ForgotPasswordAjax",
		       data: {'user_email': user_email},
		       success: function(rdata){ 
		       		closeLightbox_body();
				    if(rdata==1){
						$("#invalid_login").html('<span style="color:#036">Your password has been sent to your email.</span>');
					}else{ 
					 	$("#invalid_login").html('<span style="color:#FF0000">Invalid emailID.</span>');
					}	
				}
		    });
		}else{
			return false;
		}
	});


})

</script>
