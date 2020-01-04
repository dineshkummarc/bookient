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
	var hiddenId = $('#eml_mrktn_templt_id').val();
	
	var cat_type = $('#cus_countryid_5').val();
	//var headcont = $('#headcont').val();
        
        var headcont = CKEDITOR.instances.headcont.getData();
	var head_bg_color = $('#head_bg_color').val();
	//var bodycont = $('#bodycont').val();
        var bodycont = CKEDITOR.instances.bodycont.getData();
	var body_bg_color = $('#body_bg_color').val();
	//var footcont = $('#footcont').val();
        var footcont = CKEDITOR.instances.footcont.getData();
	var foot_bg_color = $('#foot_bg_color').val();
	
	
	
	var error = 0;
	
	if(inputText == '')
	{
		$('#qstn_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}
	
	
	if(error == 0)
	{
		params = { 'tmplt_name' :  inputText,'eml_mrktn_templt_id' : hiddenId,'cat_type':cat_type ,'headcont':headcont,'head_bg_color':head_bg_color,'bodycont':bodycont,'body_bg_color':body_bg_color,'footcont':footcont,'foot_bg_color':foot_bg_color };
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/email_mkt_manager/SaveTIMEZONEAjax"); ?>',
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
	
	
	 $('#cus_countryid_5').val();
	 $('#headcont').val();
	 $('#head_bg_color').val();
	 $('#bodycont').val();
	 $('#body_bg_color').val();
     $('#footcont').val();
     $('#foot_bg_color').val();
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
		   url: '<?php echo site_url("superadmin/email_mkt_manager/EditTIMEZONEAjax"); ?>',
		   dataType: 'json',
		   data: { 'cat_zone_id' : id },
		   success: function(data){
			     //alert(data);
				// return false;
			    $('#add_faq').show();
				$('#add_faq').show();
				$('#eml_mrktn_templt_id').val(data.eml_mrktn_templt_id);
				$('#timezonename').val(data.tmplt_name);
                                CKEDITOR.instances.headcont.setData(data.tmplt_header_content);
				//$('#headcont').val(data.tmplt_header_content);
				$('#cus_countryid_5').html('');
				$('#cus_countryid_5').html(data.slect_val);
				$('#head_bg_color').html(data.tmplt_header_bgcolor.replace('#',''));
				//$('#bodycont').val(data.tmplt_body_content);
                                CKEDITOR.instances.bodycont.setData(data.tmplt_body_content);
                                //$('#footcont').val(data.tmplt_footer_content);
                                CKEDITOR.instances.footcont.setData(data.tmplt_footer_content);
				
		
				//CKEDITOR.instances.answer.setData(data.faq_answer);
				//CB#SOG#15-11-2012#PR#S
				$('#add_new_link').hide();
				
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