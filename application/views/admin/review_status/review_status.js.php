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

$(document).ready(function() 
{
	$('.review-view-details-link').click(function(){
		$(this).parent().find('.review-view-details').toggle();
	});
});

</script>
