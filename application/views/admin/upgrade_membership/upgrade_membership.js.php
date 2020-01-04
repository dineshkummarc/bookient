<script type="text/javascript">
$(document).ready(function(){
	$(".membership_feature").hide();
	});
</script>
<script>
function showMembershipFeature(membership_type_id)
{
	$(".membership_feature").hide();
	$(".local_admin_membership_feature").hide();
	
	$("#membership_feature"+membership_type_id).show();

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
		  url:"<?php echo site_url('admin/upgrade_membership/featureDetailsAjax'); ?>",
		  data:"membership_type_id="+membership_type_id,
		  success:function(rdata)
		  { 
			$("#membership_feature"+membership_type_id).html(rdata);
			//alert(rdata); 
		  }
	});
		}
	//check login end
	}  
});

}

</script>
<script>
function subcribe(membership_type_id)
{
	var membership_plan_feature_id=$("#membership_feature_select"+membership_type_id+":checked").val();
	alert(membership_plan_feature_id);
}
</script>