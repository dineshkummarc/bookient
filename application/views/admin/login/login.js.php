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
		       url: "<?php echo base_url(); ?>admin/login/login_ajax",
		       data: {'user_email': user_email, 'password': password },
		       success: function(rdata){ 
				    if(rdata==1){
					location.href="<?php echo base_url(); ?>admin/calender";
					}else if(rdata==2){
					location.href="<?php echo base_url(); ?>admin/email_not_verified";
					}else if(rdata==0){ 
					 $("#invalid_login").html("invalid login");
					}	
				}
		    });
		}else{
			return false;
		}
	});


	$("#re_pass").blur(function(){
		var re_pass	=$("#re_pass").val();
		if (re_pass == '') {
			$("#re_pass").removeAttr('class');
			$("#re_pass").attr('class','text-input-red');
		}else{
			$("#re_pass").removeAttr('class');
			$("#re_pass").attr('class','text-input-blue');
		}
	})
	$("#re_nw_pass").blur(function(){
		var re_nw_pass	=$("#re_nw_pass").val();
		if (re_nw_pass == '') {
			$("#re_nw_pass").removeAttr('class');
			$("#re_nw_pass").attr('class','text-input-red');
		}else{
			$("#re_nw_pass").removeAttr('class');
			$("#re_nw_pass").attr('class','text-input-blue');
		}
	})
	$("#re_nw_repass").blur(function(){
		var re_nw_repass	=$("#re_nw_repass").val();
		if (re_nw_repass == '') {
			$("#re_nw_repass").removeAttr('class');
			$("#re_nw_repass").attr('class','text-input-red');
		}else{
			$("#re_nw_repass").removeAttr('class');
			$("#re_nw_repass").attr('class','text-input-blue');
		}
	})
	$("#re_nw_repass").blur(function(){
		var re_nw_pass	=$("#re_nw_pass").val();
		var re_nw_repass	=$("#re_nw_repass").val();
		if (re_nw_pass == re_nw_repass) {
			$("#re_nw_repass").removeAttr('class');
			$("#re_nw_repass").attr('class','text-input-blue');
		}else{
			$("#re_nw_repass").removeAttr('class');
			$("#re_nw_repass").attr('class','text-input-red');
		}
	})


})

function submitResend(){
	var error=0;
	var re_pass	=$("#re_pass").val();
	if (re_pass == '') {
		$("#re_pass").removeAttr('class');
		$("#re_pass").attr('class','text-input-red');
		error++;
	}
	var re_nw_pass	=$("#re_nw_pass").val();
	if (re_nw_pass == '') {
		$("#re_nw_pass").removeAttr('class');
		$("#re_nw_pass").attr('class','text-input-red');
		error++;
	}
	var re_nw_repass	=$("#re_nw_repass").val();
	if (re_nw_repass == '') {
		$("#re_nw_repass").removeAttr('class');
		$("#re_nw_repass").attr('class','text-input-red');
		error++;
	}
	if (re_nw_repass != re_nw_pass) {
		$("#re_nw_repass").removeAttr('class');
		$("#re_nw_repass").attr('class','text-input-red');
		error++;
	}
	if(error == 0){
		$.ajax({
		   type: 'POST',
		   url: "<?php echo base_url(); ?>admin/login/changePassword",
		   data: {'re_pass': re_pass, 're_nw_pass': re_nw_pass},
		   success: function(rdata){ 
			    if(rdata==1){
				location.href="<?php echo base_url(); ?>admin";
				}else if(rdata==2){
					$('#msgPr').html('Plaese check your password.');
				}	
			}
		});
	}
}





</script>
