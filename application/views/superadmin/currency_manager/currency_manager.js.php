<script type="text/javascript">
function submit_currency()
{
	
	var inputCurname = $('#currencyname').val();
	var inputCurabbri = $('#currencyabbriviation').val();
	var inputCursym = $('#currencysymbol').val();
	var hiddenId = $('#currency_id').val();
	var error = 0;
	
	if(inputCurname == '')
	{
		$('#curname_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}
	if(inputCurabbri == '')
	{
		$('#currabb_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}
	if(inputCursym == '')
	{
		$('#currsym_err').html('<span style="color:#FF0000;">Required Field</span>');	
		error = 1;
	}
	if(error == 0)
	{
params = { 'currency_name' :inputCurname, 'currency_abbriviation' : inputCurabbri,'currency_symbol' : inputCursym,'currency_id' : hiddenId };
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/currency_manager/SaveCURRENCYAjax"); ?>',
			   data: params,
			   success: function(data){
				    $('#faq_listing').show();
					$('#faq_listing').html(data);
					$('#add_faq').hide();
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
	$('#currency_id').val('');
	$('#currencyname').val('');
	$('#currencyabbriviation').val('');
	$('#currencysymbol').val('');
	
}
</script>

<script type="text/javascript">
function change_status(id)
{
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/currency_manager/ChangeStatusCURRENCYAjax"); ?>',
		   data: { 'currency_id' : id },
		   success: function(data){
		         //alert (data);
				$('#replace_status_'+id).html(data);
			}
	});
}
</script>

<script type="text/javascript">
function edit_currency(id)
{
	
	$('#faq_listing').hide();
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/currency_manager/EditCURRENCYAjax"); ?>',
		   dataType: 'json',
		   data: { 'currency_id' : id },
		   success: function(data){
			    $('#add_faq').show();
				$('#add_faq').show();
				$('#currency_id').val(data.currency_id);
				$('#currencyname').val(data.currency_name);
				$('#currencyabbriviation').val(data.currency_abbriviation);
				$('#currencysymbol').val(data.currency_symbol);
				
			}
	});
}
</script>

<script type="text/javascript">
function del_currency(id)
{
	var r = confirm('Are you sure you want to delete this Currency ?');
	
	if(r == true)
	{
		$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/currency_manager/DelCURRENCYAjax"); ?>',
			   data: { 'currency_id' : id },
			   success: function(data){
					$('#faq_listing').html(data);
				}
		});
	}
}
</script>

<script type="text/javascript">
function cancl_currency()
{
	$('#faq_listing').show();
	$('#add_faq').hide();
}
</script>