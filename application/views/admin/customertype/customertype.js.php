<!-- JavaScript -->
	<script type="text/javascript">
		var j = jQuery.noConflict();
		
		j(document).ready(function() {

			j('#tax_title').focus(function(){
				j('#qstn_err').html('');
			});

		});
	</script>


<script type="text/javascript">
function submit_tax()
{
	var type_status = '';
	var inputText = j('#type_name').val();
	inputText = j.trim(inputText);
	var hiddenId = j('#customertype_id').val();
	if(j("#type_status").prop('checked')==true){
		type_status = 'Y';
	}else{
		type_status = 'N';
	}
	var error = 0;

	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;font-size:10px;"><?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?></span>');
		error++;
	}


	if(error == 0)
	{
		params = { 'type_name':inputText,'type_id':hiddenId,'type_status':type_status};
		
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("admin/customertype/SaveTypeAjax"); ?>',
			   data: params,
			   success: function(data){

                                var url = window.location.protocol + "//" + window.location.host + "/" ;
                                window.location = url+"admin/customertype/index/IsPreserved/Y";

		           }
		});
	}
}
</script>

<script type="text/javascript">
function hide_show_tbl()
{
	j('.tab_listing').hide();
	j('#add_faq').show();
	j('#tax_title').val('');
	j('#tax_master_id').val('');



	j('#add_new_link').hide();
	j('#qstn_err').html('');



	j("#sub_tax").attr('value', '<?php echo $this->global_mod->db_parse($this->lang->line("add_btn"))?>');

}
</script>


<script type="text/javascript">
function edit_tax(id){
	j('.tab_listing').hide();
	
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/customertype/EditCustomerAjax"); ?>',
		   dataType: 'json',
		   data: { 'customertype_id' : id },
		   success: function(data){
			   //alert(data);
			    data = data.split('ccc');
			   
			    j('#add_faq').show();
				j('#customertype_id').val(data[0]);
				j('#type_name').val(data[1]);
				if(data[2] == 'Y'){
					j("#type_status").attr('checked',true);
				}
				else{
					j("#type_status").attr('checked',false);
				}
				j('#add_new_link').hide();
				j('#qstn_err').html('');
				j("#sub_tax").attr('value', '<?php echo $this->global_mod->db_parse($this->lang->line("update_btn"))?>');

			}
	});
}
</script>

<script type="text/javascript">
    /*
function del_tax(id)
{
	var r = confirm('Are you sure you want to delete this TAX ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/tax_manager/DelTAXAjax"); ?>',
			   data: { 'tax_master_id' : id },
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
}*/
</script>

<script type="text/javascript">
function cancl_tax()
{
	j("#type_name").val('');
	j('#type_status').prop('checked',true);
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();

}
</script>

<script type="text/javascript">
	function ManagerGeneralForm(url,formID){
	var frmID='#'+formID;
	var params ={
		'module': 'contact'
	};
	var paramsObj = j(frmID).serializeArray();
	j.each(paramsObj, function(i, field){
		params[field.name] = field.value;

	});
		
		//j('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');
		j.ajax({

				type: "POST",
				url: url,
				data: params,
				dataType: 'html',
				success: function(data){
                              // alert(data);                    //alert(data);
						j('#records_listing').html(data);
					
					
					//	if(j('#TransMsgDisplay'))
					//	{
					//		j('#TransMsgDisplay').html('');
					//	}
				}
		});
	}
	
	
	function ManagerGeneral(url){
	//	$('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');
		j.ajax({
			type: "POST",
			url: url,
			dataType: 'html',
			success: function(data){
					j('#records_listing').html(data);
				//	$('#TransMsgDisplay').html('');
			}
		});

	}
	
	
	function ConfirmDelete(url,delete_id,delete_name,delete_lebel_name,delete_category_id)
	{
		if (confirm("Are you sure to delete "+delete_lebel_name+" "+delete_name+" ?")) {
			url=url+'/record_id/'+delete_id+'/IsPreserved/Y';
			//$('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');
			var params ={
			'module': 'contact',
			'Is_Process':'Y',
			'action': 'delete'
			};
			j.ajax({
				type: "POST",
				url: url,
				data: params,
				dataType: 'text',
				success: function(data){
						j('#records_listing').html(data);
					//	j('#TransMsgDisplay').html('');
				}
			});
	   	}
	}
	
	
</script>


