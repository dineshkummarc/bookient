<script type="text/javascript">
<!--===========================================DATE-TIMEPICKER CODE===========================================-->
$(function() {
		$("#date_from").datepicker({
                     onClose: function( selectedDate ) {
                        $( "#date_to" ).datepicker( "option", "minDate", selectedDate );
                     }
                });
		$("#date_to").datepicker({
                     onClose: function( selectedDate ) {
                        $( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
                     }
                });
	});
<!--===========================================DATE-TIMEPICKER CODE===========================================-->        
</script>

<script type="text/javascript">
		$(document).ready(function() {
								   
			$('#date_from').focus(function(){
				$('#err_from').html('');
				$('#err_rep').html('');
			});	
			$('#date_to').focus(function(){
				$('#err_to').html('');
				$('#err_rep').html('');
			});	
			
		});
</script>

<script type="text/javascript">
SyntaxHighlighter.defaults['toolbar'] = false;
SyntaxHighlighter.all();
</script>

<script type="text/javaScript">
function show_hide_tr()
{
	$('#show_hide').show();
	$('#adv_search').hide();
}
</script>

<script type="text/javaScript">
function hide_show_tr()
{
	$('#show_hide').hide();
	$('#adv_search').show();
}
</script>

<script type="text/javaScript">
function serach_sales()
{
	var frmID='#frm_appointment';
	var params ={'module': 'appointment'};
	var paramsObj = $(frmID).serializeArray();
	
	
	$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
	});
	//CB#SOG#11-12-2012#PR#S
	var errorcount = 0;
	if($('#date_from').val() =="") {
		$('#err_from').html('<?php echo $this->lang->line("required_field");?>');
		errorcount++;		
	}
	if($('#date_to').val() =="") {
		$('#err_to').html('<?php echo $this->lang->line("required_field");?>');
		errorcount++;		
	}
	if(errorcount > 0) {
		return false;
	}
	
	//CB#SOG#11-12-2012#PR#E
	var startDate = new Date($('#date_from').val());
        var endDate = new Date($('#date_to').val());
	
	if (startDate <= endDate){	
                $('#show_result').html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif" height="30" width="30" /><br><?php echo $this->lang->line("loading");?></center>')
	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
			url: "<?php echo base_url(); ?>admin/sales_report/getReportsAjax/",
			type: "POST",
			data: params,
			success: function(msg) {
				//alert(msg);
				$('#show_result').html(msg);
			}
		});
		}
	//check login end
	}  
});
	} else {
		var msg = '<?php echo $this->lang->line("to_date_should_be_greater_than_from_date");?>';
		$('#err_rep').html(msg);
		return false;
	}
}
</script>

<script type="text/javascript">
function focusit()
{
	var value = $('#username').val();
	if(value == 'Client Username')	
	{
		$('#username').val('');
	}
}
function blurit()
{
	var value = $('#username').val();
	if(value == '')	
	{
		$('#username').val('Client Username');
	}
}
</script>
<script language="javascript" type="text/javascript">
function printon() 
{

	//$('#search_result').jqprint();
        window.print();
	
}

			 
function exporton() 
{

var currency_type=$("#currency_type").val();
var display_type=$("#display_type").val();
var date_from=$("#date_from").val();
var date_to=$("#date_to").val();
var service=$("#service").val();
var staff=$("#staff").val();
var status=$("#status").val();
var username=$("#username").val();
location.href="<?php echo site_url('admin/sales_report/export_excel_csv'); ?>" +"?currency_type="+currency_type+"&display_type="+display_type+"&date_from="+ date_from+"&date_to="+date_to+"&service="+service+"&staff="+staff+"&status="+status+"&username="+username;

}
</script>
