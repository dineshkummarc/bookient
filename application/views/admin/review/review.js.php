
<script type="text/javaScript">

function subbmit_comments()
{

	var frmID='#frm_appointment';
	var params ={'module': 'appointment'};
	var paramsObj = $(frmID).serializeArray();
	$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
	});

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
		url: "<?php echo base_url(); ?>admin/review/getReportsAjax/",
		type: "POST",
		data: params,
		success: function(msg) {

			$('#comments').val('');
			location.reload();
			
		}
	});	
		}
	//check login end
	}  
});
}


</script>
