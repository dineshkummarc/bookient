<!-- JavaScript -->
	<script type="text/javascript">
		$(document).ready(function() {

			
			$('.super-listing-tabl tbody').paginate({
				status: $('#status'),
				controls: $('#paginate'),
				itemsPerPage: 5
			});
			//CB#SOG#15-11-2012#PR#S
			$('#timezonename').focus(function(){
				$('#qstn_err').html('');
			});
		
			//CB#SOG#15-11-2012#PR#E
		});
	</script>

<script type="text/javascript">
function submit_timezone()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = $('#timezonename').val();
	var hiddenId = $('#eml_mrktn_templt_cat_id').val();
	var error = 0;
	
	if(inputText == '')
	{
		$('#qstn_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}
	
	
	if(error == 0)
	{
		params = { 'cat_name' :  inputText,'eml_mrktn_templt_cat_id' : hiddenId };
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/email_mkt_cat_manager/SaveTIMEZONEAjax"); ?>',
			   data: params,
			   success: function(data){
			   //alert(data);
				    $('#faq_listing').show();
					$('#faq_listing').html(data);
					$('#add_faq').hide();
					$('.super-listing-tabl tbody').paginate({
					status: $('#status'),
					controls: $('#paginate'),
					itemsPerPage: 5
					});
					//CB#SOG#15-11-2012#PR#S
					$('#add_new_link').show();
					//CB#SOG#15-11-2012#PR#E
				}
		});
	}
}
</script>

<script type="text/javascript">
function hide_show_tbl()
{
	$('#faq_listing').hide();
	$('#add_faq').show();
	$('#time_zone_id').val('');
	$('#timezonename').val('');
	//CKEDITOR.instances.answer.setData('');
	//CB#SOG#15-11-2012#PR#S
	$('#add_new_link').hide();
	$('#qstn_err').html('');
	//CB#SOG#15-11-2012#PR#E
	
	//CB#SOG#26-11-2012#PR#S
	$("#sub_timezone").attr('value', 'Add');
	//CB#SOG#26-11-2012#PR#E
}
</script>

<script type="text/javascript">
/*function change_status(id)
{
//alert(id);
	$.ajax({
		   type: 'POST',
		   url: '<?php //echo site_url("superadmin/timezone_manager/ChangeStatusTIMEZONEAjax"); ?>',
		   data: { 'time_zone_id' : id },
		   success: function(data){
				$('#replace_status_'+id).html(data);
			}
	});
}*/
</script>

<script type="text/javascript">
function edit_timezone(id)
{
	
	$('#faq_listing').hide();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/email_mkt_cat_manager/EditTIMEZONEAjax"); ?>',
		   dataType: 'json',
		   data: { 'time_zone_id' : id },
		   success: function(data){
			   //alert(data);
			    $('#add_faq').show();
				$('#add_faq').show();
				$('#eml_mrktn_templt_cat_id').val(data.eml_mrktn_templt_cat_id);
				$('#timezonename').val(data.cat_name);
				//CKEDITOR.instances.answer.setData(data.faq_answer);
				//CB#SOG#15-11-2012#PR#S
				$('#add_new_link').hide();
				$('#qstn_err').html('');
				//CB#SOG#15-11-2012#PR#E
				
					//CB#SOG#26-11-2012#PR#S
					$("#sub_timezone").attr('value', 'Update');
					//CB#SOG#26-11-2012#PR#E
			}
	});
}
</script>

<script type="text/javascript">
/*function del_timezone(id)
{
	var r = confirm('Are you sure you want to delete this TIMEZONE ?');
	
	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/timezone_manager/DelTIMEZONEAjax"); ?>',
			   data: { 'time_zone_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
					$('.super-listing-tabl tbody').paginate({
					status: $('#status'),
					controls: $('#paginate'),
					itemsPerPage: 5
					});
					//CB#SOG#15-11-2012#PR#S
					$('#add_new_link').show();
					//CB#SOG#15-11-2012#PR#E
				}
		});
	}
}*/
</script>

<script type="text/javascript">
function cancl_timezone()
{
	$('#faq_listing').show();
	$('#add_faq').hide();
	//CB#SOG#15-11-2012#PR#S
	$('#add_new_link').show();
	//CB#SOG#15-11-2012#PR#E
}
</script>