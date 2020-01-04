<script>
function resendEmail()
{
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
		$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url: "<?php echo base_url(); ?>admin/email_not_verified/resendEmailAjax",
			  /*data:"user_name="+user_name+"&password="+password,*/
			  //data: {user_name: user_name, password: password },
			  success:function(rdata){   
			  if(rdata==1){
					alert("Email Successfully Send");
				}else{ 
					 alert("Mail Sending Fail");
				}
				}
			});	
		}
	//check login end
	}  
});
	
}
</script>