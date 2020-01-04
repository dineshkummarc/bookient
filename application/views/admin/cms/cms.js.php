<script type="text/javascript">
$(function() {
$( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
$( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
});

function update_info(type){
var comment = $("#"+type).val();
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
				  data: {'cmsType':type, 'comment':comment},
				  url:BASE_URL+"/admin/cms/updateInfo",
				  success:function(datas){
						alert("<?php echo $this->lang->line('update_success');?>")
					}
				});
		}
	//check login end
	}  
});
}

</script>