<script language="javascript" type="text/javascript">
    $(function() {
	<?php $counter=1; ?>
	<?php foreach($ResArr as $result){ ?>
		var val="<?php echo $counter; ?>"
        $("#rating_simple"+val).webwidget_rating_sex({
            rating_star_length: '5',
            rating_initial_value: '<?php echo $result["rating"]; ?>',
            rating_function_name: '',//this is function name for click
            directory: '<?php echo base_url(); ?>images'
        });
	<?php $counter=$counter+1; } ?>
    });
</script>
<script type="text/javaScript">
/*
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
		url: "<?php //echo base_url(); ?>admin/review/getReportsAjax/",
		type: "POST",
		data: params,
		success: function(msg) {
			//alert(msg);
			$('#show_result').html(msg);
		}
	});
}
*/
$(document).ready(function() 
{
	$('.review-view-details-link').click(function(){
		$(this).parent().find('.review-view-details').toggle();
	});
});

</script>
