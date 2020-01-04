<script type="text/javascript">
function submit_servicecategory(){
	var inputText	= $('#categoryname').val()
	var hiddenId	= $('#category_id').val();

	var error = 0;

	if($.trim(inputText) == ''){
		$('#qstn_err').html('<span style="color:#FF0000;">Required Field</span>');
		error = 1;
	}

	if(error == 0){
		params = { 'categoryname':$.trim(inputText),'category_id' : $.trim(hiddenId) };
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("admin/servicecategory/SaveSERVICECATEGORYAjax"); ?>',
			data: params,
			success: function(data){
				if($.trim(data) ==1){
					window.location.reload();
				}
				if($.trim(data) ==0){
					$('#qstn_err').html('<div align="left" style="color:#CC272A; margin-left:300px;">Unable to save.</div>');
				}
			}
		});
	}
}
</script>

<script type="text/javascript">
function hide_show_tbl(){
	$('#faq_listing').hide();
	$('#add_faq').show();
	$('#categoryname').val('');
	$('#category_id').val('');
	$('#add_new_link').hide();
	$('#qstn_err').html('');
}
</script>

<script type="text/javascript">
function change_status(id)
{
//alert(id);
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/servicecategory/ChangeStatusSERVICECATEGORYAjax"); ?>',
		   data: { 'category_id' : id },
		   success: function(data){
				$('#replace_status_'+id).html(data);
			}
	});
}
</script>

<script type="text/javascript">
function edit_servicecategory(id)
{
	$('#faq_listing').hide();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/servicecategory/EditSERVICECATEGORYAjax"); ?>',
		   dataType: 'json',
		   data: { 'category_id' : id },
		   success: function(data){
			   //alert(data);
			    $('#add_faq').show();
				$('#add_faq').show();
				$('#categoryname').val(data.category_name);
				$('#category_id').val(data.category_id);
				//CB#SOG#17-11-2012#PR#S
				$('#add_new_link').hide();
				$('#qstn_err').html('');
				//CB#SOG#17-11-2012#PR#E

				//CKEDITOR.instances.answer.setData(data.faq_answer);

				//CB#SOG#5-12-2012#PR#S
				$("#sub_servicecategory").attr('value', 'Update');
				//CB#SOG#5-12-2012#PR#E
			}
	});
}
function delete_servicecategory(id)
{
    var r = confirm('All the services under this category will be deleted. Also all the appointments for these services will be deleted. Are you sure you want to continue?');
    if(r == true){
	    $.ajax({
		    type: 'POST',
		    url: '<?php echo site_url("admin/servicecategory/DeleteSERVICECATEGORYAjax"); ?>',
		    data: { 'category_id' : id },
		    success: function(data){
                window.location.reload();
			}
	    });
    }
}
</script>

<script type="text/javascript">
function cancl_servicecategory()
{
	$('#faq_listing').show();
	$('#add_faq').hide();
	//CB#SOG#17-11-2012#PR#S
	$('#add_new_link').show();
	//CB#SOG#17-11-2012#PR#E
}
</script>