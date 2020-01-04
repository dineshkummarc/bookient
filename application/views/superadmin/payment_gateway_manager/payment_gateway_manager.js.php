<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {


			j('#paymentgatewayname').focus(function(){
				j('#qstn_err').html('');
			});

		});
	</script>


<script type="text/javascript">
function payment_check()
{
	j('#utype_select_err').html('');

}
</script>



<script type="text/javascript">

function submit_paymentgateway()
{
	//var editorText = CKEDITOR.instances.answer.getData();
	var inputText = j('#paymentgatewayname').val();
	var hiddenId = j('#payment_gateways_id').val();
	var inputType = j('#payment_gateway').val();
	var error = 0;

	if(j.trim(inputText) == '')
	{
		j('#qstn_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}
	if(j.trim(inputType) == '')
	{
		j('#utype_select_err').html('<span style="color:#FF0000;font-size:10px;">Required Field</span>');
		error = 1;
	}

	if(error == 0)
	{
		params = { 'payment_gateways_name' :  inputText,'payment_gateways_id' : hiddenId,'type':inputType };
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/payment_gateway_manager/SavePAYMENTGATEWAYAjax"); ?>',
			   data: params,
			   success: function(data){

			           //alert(data);

                                   var url = window.location.protocol + "//" + window.location.host + "/" ;
                                   window.location = url+"superadmin/payment_gateway_manager/index/IsPreserved/Y";
                                    /*
				    $('#faq_listing').show();
					$('#faq_listing').html(data);
					$('#add_faq').hide();
					$('#add_new_link').show();
					*/
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
	j('#paymentgatewayname').val('');
	j('#payment_gateways_id').val('');
	j('#payment_gateway').val('');

	j('#add_new_link').hide();
	j('#qstn_err').html('');
        j('#utype_select_err').html('');

	j("#sub_paymentgateway").attr('value', 'Add');

}
</script>



<script type="text/javascript">
function edit_paymentgateway(id)
{

	j('.tab_listing').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/payment_gateway_manager/EditPAYMENTGATEWAYAjax"); ?>',
		   dataType: 'json',
		   data: { 'payment_gateways_id' : id },
		   success: function(data){
			   //alert(data);

				j('#add_faq').show();
				j('#paymentgatewayname').val(data.payment_gateways_name);
				j('#payment_gateways_id').val(data.payment_gateways_id);
				j('#payment_gateway').html(data.user_type);

				j('#add_new_link').hide();
				j('#qstn_err').html('');
				j('#utype_select_err').html('');
				j("#sub_paymentgateway").attr('value', 'Update');

		}
	});
}
</script>

<script type="text/javascript">
/*function del_paymentgateway(id)
{
	var r = confirm('Are you sure you want to delete this Payment Gateway ?');

	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php //echo site_url("superadmin/payment_gateway_manager/DelPAYMENTGATEWAYAjax"); ?>',
			   data: { 'payment_gateways_id' : id },
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
function cancl_paymentgateway()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
}
</script>