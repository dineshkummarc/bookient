<script type="text/javascript">
function submit_servicecategory(){
	var inputText	= $('#categoryname').val();
	var hiddenId	= $('#category_id').val();

	var error = 0;

	if($.trim(inputText) == ''){
		$('#qstn_err').html('<span style="color:#FF0000;"><?php echo $this->lang->line("required_fld")?></span>');
		error = 1;
	}

	if(error == 0){
		params = { 'categoryname':$.trim(inputText),'category_id' : $.trim(hiddenId) };

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
			type: 'POST',
			url: '<?php echo site_url("admin/servicecategory/SaveSERVICECATEGORYAjax"); ?>',
			data: params,
			success: function(data){
				if($.trim(data) ==1){
					window.location.reload();
				}
				if($.trim(data) ==0){
					$('#qstn_err').html('<div align="left" style="color:#CC272A; margin-left:300px;"><?php echo $this->lang->line("unable_to_save")?></div>');
				}
			}
		});
		}
	//check login end
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


$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
					   type: 'POST',
					   url: '<?php echo site_url("admin/servicecategory/ChangeStatusSERVICECATEGORYAjax"); ?>',
					   data: { 'category_id' : id },
					   success: function(data){
							$('#replace_status_'+id).html(data);
						}
				});
		}
	//check login end
	}  
});
}
</script>

<script type="text/javascript">
function edit_servicecategory(id)
{
	$('#faq_listing').hide();
	
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
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
							$("#sub_servicecategory").attr('value', '<?php echo $this->global_mod->db_parse($this->lang->line("update_btn"))?>');
							//CB#SOG#5-12-2012#PR#E
						}
				});
			}
		//check login end
		}  
	});
}
function delete_servicecategory(id)
{
    var r = confirm('<?php echo $this->lang->line("del_cnfirm_text")?>');
    if(r == true){
	   
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			 $.ajax({
			    type: 'POST',
			    url: '<?php echo site_url("admin/servicecategory/DeleteSERVICECATEGORYAjax"); ?>',
			    data: { 'category_id' : id },
			    success: function(data){
	                window.location.reload();
				}
		    });
		}
	//check login end
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
	$('#add_new_link').show();
}
</script>