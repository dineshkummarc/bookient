<!-- JavaScript -->
<script type="text/javascript">
        $(document).ready(function() {
                //CB#SOG#15-11-2012#PR#S
                $('#timeformat').focus(function(){
                        $('#qstn_err').html('');
                });
                //CB#SOG#15-11-2012#PR#E
        });
</script>
<script type="text/javascript">
function submit_timeformat()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = $.trim($('#timeformat').val());
	var hiddenId = $('#time_format_id').val();
	var error = 0;

	if(inputText == '')
	{
		$('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
        if(error > 0)
	{
            return false;
        }
        //CB#SOG#28-02-2013#PR#S
        var timeexp = /^\d{1,2}:\d{2}([ap]m)?$/;
        if(!inputText.match(timeexp))
        {
            $('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Invalid Time Format</span>');
	    error++;
            return false;
        }
        //CB#SOG#28-02-2013#PR#E

	if(error == 0)
	{
		params = { 'time_format' :  inputText,'time_format_id' : hiddenId };
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/timeformat_manager/SaveTIMEFORMATAjax"); ?>',
			   data: params,
			   success: function(data){
			   //alert(data);
				    $('#faq_listing').show();
					$('#faq_listing').html(data);
					$('#add_faq').hide();
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
	$('#timeformat').val('');
	$('#time_format_id').val('');
	//CKEDITOR.instances.answer.setData('');
	//CB#SOG#15-11-2012#PR#S
	$('#add_new_link').hide();
	$('#qstn_err').html('');
	//CB#SOG#15-11-2012#PR#E

	//CB#SOG#26-11-2012#PR#S
	$("#sub_timeformat").attr('value', 'Add');
	//CB#SOG#26-11-2012#PR#E

}
</script>
 
<script type="text/javascript">
function change_status(id)
{
//alert(id);
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/timeformat_manager/ChangeStatusTIMEFORMATAjax"); ?>',
		   data: { 'time_format_id' : id },
		   success: function(data){
				$('#replace_status_'+id).html(data);
			}
	});
}
</script>

<script type="text/javascript">
function edit_timeformat(id)
{

	$('#faq_listing').hide();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/timeformat_manager/EditTIMEFORMATAjax"); ?>',
		   dataType: 'json',
		   data: { 'time_format_id' : id },
		   success: function(data){
			   //alert(data);
			    $('#add_faq').show();
				$('#add_faq').show();
				$('#time_format_id').val(data.time_format_id);
				$('#timeformat').val(data.time_format);
				//CKEDITOR.instances.answer.setData(data.faq_answer);
				//CB#SOG#15-11-2012#PR#S
				$('#add_new_link').hide();
				$('#qstn_err').html('');
				//CB#SOG#15-11-2012#PR#E


				//CB#SOG#26-11-2012#PR#S
				$("#sub_timeformat").attr('value', 'Update');
				//CB#SOG#26-11-2012#PR#E
			}
	});
}
</script>

<script type="text/javascript">
function del_timeformat(id)
{
	var r = confirm('Are you sure you want to delete this TIME FORMAT ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/timeformat_manager/DelTIMEFORMATAjax"); ?>',
			   data: { 'time_format_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
				}
		});
	}
}
</script>

<script type="text/javascript">
function cancl_timeformat()
{
	$('#faq_listing').show();
	$('#add_faq').hide();
	//CB#SOG#15-11-2012#PR#S
	$('#add_new_link').show();
	//CB#SOG#15-11-2012#PR#E
}
</script>