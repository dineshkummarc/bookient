<!-- JavaScript -->

	<script type="text/javascript">
		j(document).ready(function() {

			j('#regionname').focus(function(){
				j('#name_err').html('');
			});
			j('#regioncode').focus(function(){
				j('#code_err').html('');
			});

		});
	</script>


<script type="text/javascript">
function status_check()
{
	j('#con_select_err').html('');

}
</script>


<script type="text/javascript">
function submit_region()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = j('#regionname').val();
	var hiddenId = j('#region_id').val();
	var countryValue = j('#cus_countryid_5').find('option:selected').val();
	var inputCode = j('#regioncode').val();

	var error = 0;
	//alert (countryValue);
	if(j.trim(inputText) == '')
	{
		j('#name_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	if(j.trim(inputCode) == '')
	{
		j('#code_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}

	if(j.trim(countryValue) == '')
	{
		j('#con_select_err').html('<span style="color:#FF0000;font-size:10px;">Select a Country</span>');
		error = 1;
	}


	if(error == 0)
	{
 params = {'regionname':inputText,'region_id':hiddenId,'country_id':countryValue,'region_code':inputCode};
 
 j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/region_manager/saveREGIONAjax"); ?>',
			   dataType: 'html',
			   data: params,
			   success: function(data){
			   		
                                    var url = window.location.protocol + "//" + window.location.host + "/" ;
                                    window.location = url+"superadmin/region_manager/index/IsPreserved/Y";

				   /* j('.tab_listing').show();
					j('.tab_listing').html(data);
					j('#add_faq').hide();
					j('#add_new_link').show();*/

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
	j('#region_id').val('');
	j('#regionname').val('');
	j('#regioncode').val('');

	j('#add_new_link').hide();
	j('#name_err').html('');
        j('#code_err').html('');
        j('#con_select_err').html('');

	j("#sub_region").attr('value', 'Add');

        j("#src_hing_value").val('');
        j("#search_list").hide();

	/*j.ajax({
		   type: 'POST',
		   url: '<?php //echo site_url("superadmin/region_manager/addCountryListAjax"); ?>',
		   dataType: 'html',
		   success: function(data){
				j('#country').html(data);
			}
	});*/
}
</script>



<script type="text/javascript">
function edit_region(id)
{
	
	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/region_manager/EditREGIONAjax"); ?>',
		   dataType: 'html',
		   data: {'region_id':id},
		   success: function(data){
		   		
				var returnArr = data.split('@#@#');
				j('#add_faq').show();
			/*	j('#region_id').val(data.region_id);
				j('#regionname').val(data.region_name);
				j('#regioncode').val(data.region_code);
				j('#country').html(data.country);*/
				j('#region_id').val(returnArr[0]);
				j('#regionname').val(returnArr[1]);
				j('#regioncode').val(returnArr[2]);
				j('#country').html(returnArr[3]);


				j('#add_new_link').hide();
				j('#name_err').html('');
				j('#code_err').html('');
				j('#con_select_err').html('');

				j("#sub_region").attr('value', 'Update');
			}
	});
}
</script>

<script type="text/javascript">
/*function del_region(id)
{
	var r = confirm('Are you sure you want to delete this Region ?');

	if(r == true)
	{
		j.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/region_manager/DelREGIONAjax"); ?>',
			   data: { 'region_id' : id },
			   success: function(data){
					j('#faq_listing').html(data);
					j('.super-listing-tabl tbody').paginate({
					status: j('#status'),
					controls: j('#paginate'),
					itemsPerPage: 5
					});
				}
		});
	}
}*/
</script>

<script type="text/javascript">
function cancl_region()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
        j("#search_list").show();
}
</script>

<script type="text/ecmascript">
	function ConfirmDelete(url,delete_id,delete_name,deletee_lebel_name,delete_category_id){
		if($.trim(delete_id) != ''){                 
			j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/region_manager/checkregionForeign"); ?>',
			   dataType: 'html',
			   data: {'dataid':delete_id,'columnId1':'cus_regionid','columnId2':'region_id'},
			   success: function(data){
			   		
			   		if(data == 0){
						alert("The Region you trying to delete is holding by any customer or admin.You can not delete");
						return false;
					}else{
						if(confirm("Are you sure to delete "+deletee_lebel_name+" "+delete_name+" ?")) {
							url=url+'/record_id/'+delete_id+'/IsPreserved/Y';
							//$('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');
							var params ={
								'module':'contact',
								'Is_Process':'Y',
								'action':'delete'
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
					
			   	}
			}); 
		}
	}
</script>

