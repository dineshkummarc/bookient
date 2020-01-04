<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {



			j('.required').focus(function(){
				j('#qstn_err').html('');
			});
			
			
			
			$("#dial_prefix").bind("keypress", function(event) { 
		    	var charCode = event.which;
		   	 	if (charCode <= 13) return true; 
		   	 	var keyChar = String.fromCharCode(charCode); 
		   	 	return /[0-9]/.test(keyChar); 
		    });
		    $("#country_code").bind("keypress", function(event) { 
		    	var charCode = event.which;
		   	 	if (charCode <= 13) return true; 
		   	 	var keyChar = String.fromCharCode(charCode); 
		   	 	return /[A-Z]/.test(keyChar); 
		    });
		    
		    j('#dial_prefix').focus(function(){
				j('#qstn_err1').html('');
			}); 
			j('#country_code').focus(function(){
				j('#qstn_err2').html('');
			});

			

		});
	</script>



<script type="text/javascript">

function submit_country()
{


	var inputText = j('#countryname').val();
	var country_code = j('#country_code').val();
	country_code = j.trim(country_code);
	var dial_prefix = j('#dial_prefix').val();
	var hiddenId = j('#country_id').val();
	var error = 0;
	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	if(j.trim(dial_prefix) == ''){
		j('#qstn_err1').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	if(country_code == ''){
		j('#qstn_err2').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	
	if(error == 0)
	{
             params = { 'countryname' :  j.trim(inputText),'country_id' : hiddenId,'dial_prefix':dial_prefix,'country_code':country_code };
                          j.ajax({
                                    type: 'POST',
                                    url: '<?php  echo site_url("superadmin/country_manager/Get_Country_name_Ajax"); ?>',
                                    data: params,
                                    success: function(data){
                                    	data = data.split('_');
                                    	
                                        if(data[0] == 1 && data[1] == 1 && data[2] == 1)
                                        {
                                                params = { 'countryname' :  j.trim(inputText),'country_id' : hiddenId,'dial_prefix':dial_prefix,'country_code':country_code };
                                                j.ajax({
                                                           type: 'POST',
                                                           url: '<?php echo site_url("superadmin/country_manager/SaveCOUNTRYAjax"); ?>',
                                                           data: params,
                                                           success: function(data){
                                                           //alert(data);

                                                                    var url = window.location.protocol + "//" + window.location.host + "/" ;
                                                                    window.location = url+"superadmin/country_manager/index/IsPreserved/Y";

                                                                }
                                                });


                                        }
                                        else
                                        {
											if(data[0] == 0){
												j('#qstn_err').html('<span style="color:#FF0000; font-size:10px;">Country Name already exists.</span>');
											}
											
											if(data[1] == 0){
												j('#qstn_err1').html('<span style="color:#FF0000; font-size:10px;">Country Dial prefix already exists.</span>');
											}
											
											if(data[2] == 0){
												j('#qstn_err2').html('<span style="color:#FF0000; font-size:10px;">Country Code already exists.</span>');
											}
                                           //alert('already exists');
                                          
                                           return false;
                                        }

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
	j('#country_id').val('');
	j('#countryname').val('');
	j('#country_code').val('');
	j('#dial_prefix').val('');

	j('#add_new_link').hide();
	j('#qstn_err').html('');
	j('#qstn_err1').html('');
	j('#qstn_err2').html('');

	j("#sub_region").attr('value', 'Add');
	j("#country_code").attr("readonly", false);
        j("#src_hing_value").val('');
        j("#search_list").hide();
}
</script>

<script type="text/javascript">

function edit_country(id)
{


	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/country_manager/EditCOUNTRYAjax"); ?>',
		   dataType: 'json',
		   data: { 'country_id' : id },
		   success: function(data){

			        j('#add_faq').show();
				j('#country_id').val(data.country_id);
				j('#countryname').val(data.country_name);
				j('#country_code').val(data.country_code);
				j('#country_code').attr('readonly',true);
				j('#dial_prefix').val(data.country_dial_prefix);
				j('#add_new_link').hide();
				j('#qstn_err').html('');
				j("#sub_country").attr('value', 'Update');


			}
	});
}
</script>

<script type="text/javascript">
/*function del_country(id)
{
	var r = confirm('Are you sure you want to delete this COUNTRY ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/country_manager/DelCOUNTRYAjax"); ?>',
			   data: { 'country_id' : id },
			   success: function(data){

					$('#faq_listing').html(data);
					// Paginate table rows
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

function cancl_country()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
	j('#qstn_err2').html('');
	j('#qstn_err1').html('');
	


}
</script>
<script type="text/javascript">
	function checkCountryForeign(url,delete_id,delete_name,deletee_lebel_name,delete_category_id){
		
		if($.trim(delete_id) != ''){                 
			j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/country_manager/checkCountryForeign"); ?>',
			   dataType: 'html',
			   data: {'dataid':delete_id,'columnId1':'cus_countryid','columnId2':'country_id'},
			   success: function(data){
			   		if(data == 0){
						alert("The Country you trying to delete is holding by any customer or admin.You can not delete");
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


