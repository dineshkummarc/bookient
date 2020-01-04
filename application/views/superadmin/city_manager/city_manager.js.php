<!-- JavaScript -->
<script type="text/javascript">
j(document).ready(function() {
	j('#cityname').focus(function(){
		j('#name_err').html('');
	});
	j('#citykey').focus(function(){
		j('#key_err').html('');
	});
	j('#latt').focus(function(){
		j('#latt_err').html('');
	});
	j('#longi').focus(function(){
		j('#longi_err').html('');
	});
});
</script>
<script type="text/javascript">
function submit_region()
{
	var inputName = j('#cityname').val();
	//alert("HHH : "+inputName);
	var inputKey = j('#citykey').val();
	var hiddenId = j('#city_id').val();

	var countryValue = j('#cus_countryid').find('option:selected').val();
	var regionValue = j('#cus_regionid_5').find('option:selected').val();
	var inputLatt = j('#latt').val();
	var inputLongi = j('#longi').val();

	var error = 0;
	//alert (countryValue);
	if(j.trim(inputName) == '')
	{
		j('#name_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	if(j.trim(inputKey) == '')
	{
		j('#key_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}

	if(j.trim(countryValue) == '')
	{
		j('#con_select_err').html('<span style="color:#FF0000;font-size:10px;">Select a Country</span>');
		error = 1;
	}
	if(j.trim(regionValue) == '')
	{
		j('#region_select_err').html('<span style="color:#FF0000;font-size:10px;">Select a Region</span>');
		error = 1;
	}
	if(j.trim(inputLatt) == '')
	{
		j('#latt_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	if(j.trim(inputLongi) == '')
	{
		j('#longi_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}

	if(error == 0)
	{
	//alert("RRR : "+inputName);
        params = { 'city_name' : inputName,'city_id' : hiddenId,'city_key' : inputKey,'country_id' : countryValue,'region_id':regionValue,'lat':inputLatt,'long':inputLongi };
    //alert("WWW : "+params);
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/city_manager/SaveCITYAjax"); ?>',
               contentType: "application/x-www-form-urlencoded;charset=ISO-8859-1",
			   data: params,
			   success: function(data){
			        //alert(data);
                    var url = window.location.protocol + "//" + window.location.host + "/" ;
                    window.location = url+"superadmin/city_manager/index/IsPreserved/Y";
			   }
		});
	}
}
</script>
<script type="text/javascript">
function country_name_change(id)
{
   //alert (id);
   j('#con_select_err').html('');
   params = {'country_id' :id};
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/city_manager/showRegionAjax"); ?>',
			   data: params,
			   success: function(data){
			   //alert(data);
				   /* j('#faq_listing').show();
					j('#faq_listing').html(data);
					j('#add_faq').hide();*/

					j('#cus_regionid_5').html(data);
				}
		});

}
</script>
<script type="text/javascript">
function region_change()
{
  j('#region_select_err').html('');
}
</script>
<script type="text/javascript">
function hide_show_tbl()
{
	j('.tab_listing').hide();
	j('#add_faq').show();
	/*j('#region_id').val('');
	j('#regionname').val('');
	j('#regioncode').val('');*/

	j('#cityname').val('');
        j('#citykey').val('');
	j('#city_id').val('');
	//cus_regionid_5
	j('#cus_countryid').val('');
	j('#cus_regionid_5').html('');
	j('#cus_regionid_5').html('<option value="" >----Region---</option>');
	j('#latt').val('');
	j('#longi').val('');


	j('#add_new_link').hide();
	j('#con_select_err').html('');
	j('#region_select_err').html('');
	j('#name_err').html('');
	j('#key_err').html('');
	j('#latt_err').html('');
	j('#longi_err').html('');

	j("#sub_region").attr('value', 'Add');

        j("#src_hing_value").val('');
        j("#search_list").hide();

	/*j.ajax({
		   type: 'POST',
		   url: '<?php //echo site_url("superadmin/city_manager/addCountryListAjax"); ?>',
		   dataType: 'html',
		   success: function(data){
				//j('#country').html(data);
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
		   url: '<?php echo site_url("superadmin/city_manager/EditCITYAjax"); ?>',
		   dataType: 'json',
		   data: { 'city_id' : id },
		   success: function(data){
                       //alert(data.country);

				j('#add_faq').show();
				j('#region_id').val(data.region_id);
				j('#regionname').val(data.region_name);

				j('#faq_listing').hide();
				j('#cityname').val(data.city_name);
                j('#citykey').val(data.city_key);
                j('#city_id').val(data.city_id);

				j('#region_id').val('');
				j('#regionname').val('');
				j('#regioncode').val('');


				j('#add_new_link').hide();
				j('#con_select_err').html('');
				j('#region_select_err').html('');
				j('#name_err').html('');
				j('#key_err').html('');
				j('#latt_err').html('');
				j('#longi_err').html('');



				j('#country').html(data.country);
				j('#cus_regionid_5').html(data.regions);
				j('#latt').val(data.lat);
				j('#longi').val(data.long);
				j("#sub_region").attr('value', 'Update');


			}
	});
}
</script>
<script type="text/javascript">
/*function del_region(id)
{
	var r = confirm('Are you sure you want to delete this City ?');

	if(r == true)
	{
		j.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/city_manager/DelCITYAjax"); ?>',
			   data: { 'city_id' : id },
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
			   data: {'dataid':delete_id,'columnId1':'cus_cityid','columnId2':'city_id'},
			   success: function(data){
			   		
			   		if(data == 0){
						alert("The City you trying to delete is holding by any customer or admin.You can not delete");
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