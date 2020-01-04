<!-- JavaScript -->
<script>
function test()
{
	
	var editorText = CKEDITOR.instances.answer.getData();
			alert(editorText);	
	//alert("hiiiiiiii");	
	
}

</script>
	<script type="text/javascript">
		$(document).ready(function() {
			
			
			$('.super-listing-tabl tbody').paginate({
				status: $('#status'),
				controls: $('#paginate'),
				itemsPerPage: 5
			});
			
			/*$('.required').focus(function(){
				var $parent = $(this).parent();
				$parent.removeClass('error');
				$('span.error',$parent).hide();
			});*/
			
			$('#question').focus(function(){
				$('#qstn_err').html('');
				//$('#ans_err').html('');	
					
			});
			
			
			/*$('#answer').mouseover(function(){
				$('#ans_err').html('');	
				alert("hiiiiiiii");
					
			});*/
			
			/*if(editorText !='')
				{
					$('#ans_err').html('');	
					$('#cke_contents_answer').focus();	
				}*/
			
			/*$('#cke_contents_answer').focus(function(){
				$('#ans_err').html('');			
					
			});*/
			
			/*$('textarea').focus(function(){
				$('#ans_err').html('');
			});*/
			//.cke_contents_answer
			//.cke_show_borders
			
		
			var editorText = CKEDITOR.instances;
			//alert($(editorText).attr('id'));
			$(editorText).focus(function(){
				$('#ans_err').html('');
			});
			
		});
	</script>


<script type="text/javascript">
function submit_faq()
{
	var editorText = CKEDITOR.instances.answer.getData();
	var inputText = $('#question').val();
	var hiddenId = $('#faq_id').val();
	var error = 0;
	
	
	if($.trim(inputText) == '')
	{
		$('#qstn_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}
	if($.trim(editorText) == '')
	{
		$('#ans_err').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');	
		error = 1;
	}
	/*
	if(editorText == '')
	{
		$('#ans_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}*/
	
	if(error == 0)
	{
		params = { 'question' :  $.trim(inputText), 'answer' : $.trim(editorText), 'faq_id' : hiddenId };
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/webinfo_manager/SaveFAQAjax"); ?>',
			   data: params,
			   success: function(data){
				    $('#faq_listing').show();
					$('#faq_listing').html(data);
					$('#add_faq').hide();
					$('.super-listing-tabl tbody').paginate({
						status: $('#status'),
						controls: $('#paginate'),
						itemsPerPage: 5
			        });
					
					$('#add_new_link').show();
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
	$('#faq_id').val('');
	$('#question').val('');
	CKEDITOR.instances.answer.setData('');
	$('#add_new_link').hide();
	$('#qstn_err').html('');
	$('#ans_err').html('');
	//CB#SOG#26-11-2012#PR#S
	$("#sub_faq").attr('value', 'Add');
	//CB#SOG#26-11-2012#PR#E
	
	
}
</script>

<script type="text/javascript">
/*function change_status(id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php //echo site_url("superadmin/faq_manager/ChangeStatusFAQAjax"); ?>',
		   data: { 'faq_id' : id },
		   success: function(data){
				$('#replace_status_'+id).html(data);
			}
	});
}*/
</script>

<script type="text/javascript">
function edit_faq(id)
{
	//alert(id);
	$('#faq_listing').hide();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/webinfo_manager/EditFAQAjax"); ?>',
		   dataType: 'json',
		   data: { 'faq_id' : id },
		   success: function(data){
			    $('#add_faq').show();
				$('#add_faq').show();
				$('#faq_id').val(data.id);
				$('#question').val(data.name);
				CKEDITOR.instances.answer.setData(data.content);
				$('#add_new_link').hide();
				$('#qstn_err').html('');
				$('#ans_err').html('');				
				$("#sub_faq").attr('value', 'Update');
					//CB#SOG#26-11-2012#PR#S
					$("#sub_faq").attr('value', 'UPDATE');
					//CB#SOG#26-11-2012#PR#E
			}
	});
}
</script>

<script type="text/javascript">
function del_faq(id)
{
	var r = confirm('Are you sure you want to delete this item ?');
	
	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/webinfo_manager/DelFAQAjax"); ?>',
			   data: { 'faq_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
					$('.super-listing-tabl tbody').paginate({
						status: $('#status'),
						controls: $('#paginate'),
						itemsPerPage: 5
			        });
				}
		});
	}
}
</script>

<script type="text/javascript">
function cancl_faq()
{
	$('#faq_listing').show();
	$('#add_faq').hide();
	$('#add_new_link').show();
}
</script>