<script type="text/javascript">
function change_status()
{
   //alert('hi');
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/cancelaccount/ChangeAdminStatusAjax"); ?>',			   
		   success: function(data){				
				window.location = "/admin/logout";				
			}
			
	});
	
 }
</script>


