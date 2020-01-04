<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {

			j('#timezonename').focus(function(){
				j('#qstn_err').html('');
			});

		});
	</script>

<script type="text/javascript">
function submit_timezone()
{


	var inputText = j('#timezonename').val();
	var gmt_symbol = j('#gmt_symbol').val();
	var gmt_value = j('#gmt_value').val();
	var hiddenId = j('#time_zone_id').val();
	var error = 0;

	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('Required Field');
		error++;
       	return false;
	}
	if(j.trim(gmt_value) == '')
	{			
		j('#qstn_err').html('Required Field');
		error++;
       	return false;
	}
	if(j.trim(gmt_value) != '')
	{
			regularExpression = /^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]/;
			if (regularExpression.test(gmt_value)==false)
			{ 
				j('#qstn_err').html('Invalid Time');	
				return false;				
			}
			 	
	}

    if(error == 0)
	{


          var params = { 'time_zone_name' :  inputText,'time_zone_id' : hiddenId };
          j.ajax({
                    type: 'POST',
                    url: '<?php  echo site_url("superadmin/timezone_manager/Get_title_Ajax"); ?>',
                    data: params,
                    success: function(data){
                             //alert(data);
                            if(data == 1)
                            {
                                 var params1 = { 'time_zone_name' :  inputText,'gmt_symbol':gmt_symbol,'gmt_value':gmt_value,'time_zone_id' : hiddenId };
								 
                                 j.ajax({
                                                type: 'POST',
                                                url: '<?php echo site_url("superadmin/timezone_manager/SaveTIMEZONEAjax"); ?>',
                                                data: params1,
                                                success: function(data1){

                                                        //alert(data1);
                                                       var url = window.location.protocol + "//" + window.location.host + "/" ;
                                                        window.location = url+"superadmin/timezone_manager/index/IsPreserved/Y";

                                                     }
                                     });

                            }
                            else
                            {

                                    j('#qstn_err').html('Time Zone Name already exists.');
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
	j('#time_zone_id').val('');
	j('#timezonename').val('');
	j('#gmt_symbol').val(1);
	j('#gmt_value').val('');
	j('#add_new_link').hide();
	j('#qstn_err').html('');
	j("#sub_timezone").attr('value', 'Add');
    j("#src_hing_value").val('');
    j("#search_list").hide();
}
</script>



<script type="text/javascript">
function edit_timezone(id)
{

	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/timezone_manager/EditTIMEZONEAjax"); ?>',
		   dataType: 'json',
		   data: { 'time_zone_id' : id },
		   success: function(data){
			   //alert(data);

				j('#add_faq').show();
				j('#time_zone_id').val(data.time_zone_id);
				j('#timezonename').val(data.time_zone_name);
				j('#gmt_symbol').val(data.gmt_symbol);
				j('#gmt_value').val(data.gmt_value);

				j('#add_new_link').hide();
				j('#qstn_err').html('');

                                j("#sub_timezone").attr('value', 'Update');
                                j("#search_list").hide();
			}
	});
}
</script>

<script type="text/javascript">
/*
function del_timezone(id)
{
	var r = confirm('Are you sure you want to delete this TIMEZONE ?');
        var srch_itm = $('#src_hing_value').val();
	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/timezone_manager/DelTIMEZONEAjax"); ?>',
			   data: { 'time_zone_id' : id,'search_item':srch_itm },
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
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
        j("#search_list").show();
}
</script>

