<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {

			j('#tax_title').focus(function(){
				j('#qstn_err').html('');
			});

		});
	</script>


<script type="text/javascript">
function submit_tax()
{

	var inputText = j('#tax_title').val();
	var hiddenId = j('#tax_master_id').val();
	var error = 0;

	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error++;
	}


	if(error == 0)
	{
		params = { 'tax_title' :  inputText,'tax_master_id' : hiddenId };
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/tax_manager/SaveTAXAjax"); ?>',
			   data: params,
			   success: function(data){

                                var url = window.location.protocol + "//" + window.location.host + "/" ;
                                window.location = url+"superadmin/tax_manager/index/IsPreserved/Y";

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



	j("#sub_tax").attr('value', 'Add');

}
</script>


<script type="text/javascript">
function edit_tax(id)
{

	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/tax_manager/EditTAXAjax"); ?>',
		   dataType: 'json',
		   data: { 'tax_master_id' : id },
		   success: function(data){
			   //alert(data);
			        j('#add_faq').show();
				j('#tax_master_id').val(data.tax_master_id);
				j('#tax_title').val(data.tax_title);

				j('#add_new_link').hide();
				j('#qstn_err').html('');

				j("#sub_tax").attr('value', 'Update');

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
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();

}
</script>


