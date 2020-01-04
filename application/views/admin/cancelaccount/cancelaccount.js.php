<script type="text/javascript">
function change_status()
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
				   url: '<?php echo site_url("admin/cancelaccount/ChangeAdminStatusAjax"); ?>',			   
				   success: function(data){				
						window.location = "/admin/logout";				
					}
			});
		}
	//check login end
	}  
});
	
	
 }
</script>


