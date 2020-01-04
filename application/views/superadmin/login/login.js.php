<script type="text/JavaScript">
$(document).ready(function(){ 

		$('#user_email').focus();
		//////////////cookie start//////////////
		var remember = $.cookie('remember');
        if (remember == 'true'){
            var email = $.cookie('email');
            var password = $.cookie('password');
            // autofill the fields
            $('#user_email').val(email);
            $('#password').val(password);
        }
		//////////////cookie end/////////////////

		document.onkeypress = function(evt) {
		    evt = evt || window.event;
		    var charCode = evt.which || evt.keyCode;
		    if (charCode == 13) {
		       $('#btn-submit-login').click();
				return false;
		    }
		};

                var emailexp = /^[_+.a-z0-9-+]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
		$("#user_email").blur(function(){
			var user_email=	$("#form-login #user_email").val();
			if (user_email =='' || !emailexp.test(user_email)){
				$("#user_email").removeAttr('class');
				$("#user_email").attr('class','text-input-red');
	   	 	}
		})
		$("#password").blur(function(){
			var password	=$("#form-login #password").val();
			if (password == '') {
			$("#password").removeAttr('class');
			$("#password").attr('class','text-input-red');
	   	 	}
		})
		
		$("#user_email").click(function(){
			$("#user_email").removeAttr('class');
			$("#user_email").attr('class','text-input-blue');
		})
		$("#password").click(function(){
			$("#password").removeAttr('class');
			$("#password").attr('class','text-input-blue');
		})
	
	$('#btn-submit-login').click(function(e){
	
                var emailexp = /^[_+.a-z0-9-+]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
		
		var user_email=	$("#user_email").val();
		var password	=$("#password").val();	
		var error=0;
		if (user_email=='' || !emailexp.test(user_email)){
			$("#user_email").removeAttr('class');
			$("#user_email").attr('class','text-input-red');
			error++;
	   	 }
		 if (password=='') {
		 	$("#password").removeAttr('class');
			$("#password").attr('class','text-input-red');
			error++;
	   	 }
		if(error == 0){
			////////////cookes start///////////
        if ($('#remember').is(':checked')) {
            var email = $('#user_email').val();
            var password = $('#password').val();

            // set cookies to expire in 14 days
            $.cookie('email', email, { expires: 14 });
            $.cookie('password', password, { expires: 14 });
            $.cookie('remember', true, { expires: 14 });                
        }else{
            // reset cookies
            $.cookie('email', null);
            $.cookie('password', null);
            $.cookie('remember', null);
        }
			/////////////cookes end//////////////
			$.ajax({
				type: 'POST',
				url: "<?php echo base_url(); ?>superadmin/login/login_ajax",
				data: {'user_email': user_email, 'password': password },
				success: function(data){
				  if($.trim(data) == 1){
					location.href="<?php echo base_url(); ?>superadmin/dashboard";
				  }else{
					  $('#invalid_login').html('<span>Authentication Failed</span>');
				  }
			   }
		});
		}else{
			return false;
		}
	});

})

</script>
