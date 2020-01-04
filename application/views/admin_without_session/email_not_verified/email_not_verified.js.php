<script>
function resendEmail()
{
	//alert("hi");
	$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url: "<?php echo base_url(); ?>admin/email_not_verified/resendEmailAjax",
			  /*data:"user_name="+user_name+"&password="+password,*/
			  //data: {user_name: user_name, password: password },
			  success:function(rdata)
				{ 
				   // alert(rdata);
				    if(rdata==1)
		            {
					alert("Email Successfully Send");
					}
				    else
					{ 
					 alert("Mail Sending Fail");
					}
				}
			});
}
</script>