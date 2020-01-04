<!-- JavaScript -->
<script type="text/javascript">
	j(document).ready(function() {
		j('#dateformat').focus(function(){
			j('#qstn_err').html('');
		});
                    j("#dateformat option:lt(1)").attr("disabled", "disabled");

	});
</script>
<script type="text/javascript">
function hide_show_tbl()
{
	j('.tab_listing').hide();
	j('#add_faq').show();
	j('#dateformat').val('');
	j('#date_format_id').val('');
	j('#add_new_link').hide();
	j('#qstn_err').html('');
	j("#sub_dateformat").attr('value', 'Add');

}
</script>




<script type="text/javascript">
    /*
function del_dateformat(id)
{
	var r = confirm('Are you sure you want to delete this DATE FORMAT ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/dateformat_manager/DelDATEFORMATAjax"); ?>',
			   data: { 'date_format_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
				}
		});
	}
}*/
</script>

<script type="text/javascript">
function cancl_dateformat()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();

}
</script>