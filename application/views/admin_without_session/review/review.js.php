
<script type="text/javaScript">
//CB#SOG#28-11-2012#PR#S
function subbmit_comments()
{
	//alert('hii');
	var frmID='#frm_appointment';
	var params ={'module': 'appointment'};
	var paramsObj = $(frmID).serializeArray();
	$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
	});
	$.ajax({
		url: "<?php echo base_url(); ?>admin/review/getReportsAjax/",
		type: "POST",
		data: params,
		success: function(msg) {
			//alert(msg);
			//$('#show_result').html(msg);
			$('#comments').val('');
			location.reload();
			
		}
	});
}

//CB#SOG#28-11-2012#PR#E
</script>
