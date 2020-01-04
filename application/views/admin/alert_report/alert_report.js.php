<script type="text/javascript">

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

function hide_show_tr()
{
	$('#show_hide').hide();
	$('#adv_search').show();
	$('#sent_to').val('');
	$('#phone_no').val('');
	$('#message_type').val('');
}


function serach_appointment()
{
	var frmID='#frm_sms';
	var params ={'module': 'appointment'};
	var paramsObj = $(frmID).serializeArray();
	
	
	$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
	});
	var errorcount = 0;
	if($('#date_from').val() ==""){
		$('#err_from').html('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"));?>');
		errorcount++;		
	}
	if($('#date_to').val() ==""){
		$('#err_to').html('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"));?>');		
		errorcount++;	
	}
	if(errorcount > 0){
		return false;
	}
	var startDate = new Date($('#date_from').val());
    var endDate = new Date($('#date_to').val());
	
	if (startDate <= endDate){
        $('#show_result').html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif" height="30" width="30" /><br>Loding...</center>')
	    $.ajax({
		    url: SITE_URL+"page/fn_checkLogInAdmin",
		    type: "post",
		    success: function(result){
		    //check login start
			    if(result == 0){
				    window.location.href = SITE_URL+'admin/login';
			    }else{
				    $.ajax({
				        url: "<?php echo base_url(); ?>admin/alert_report/getSms/",
				        type: "POST",
				        data: params,
				        success: function(msg) {
					        $('#show_result').html(msg);
				        }
			        });	
			    }
		        //check login end
		    }  
	    });
    } else {
		var msg = "<?php echo $this->global_mod->db_parse($this->lang->line('to_dt_shld_b_grtr_thn_frm_dt'));?>";
		$('#err_rep').html(msg);
		return false;
	}
}




<!--===========================================DATE-TIMEPICKER CODE===========================================-->
$(function() {
	$("#date_from").datepicker();
	$("#date_to").datepicker();
	$('#timepickerFrom').timepicker({});
	$('#timepickerTo').timepicker({});
	$("#date_of_time_block").datepicker();
});
<!--===========================================DATE-TIMEPICKER CODE===========================================-->        


</script>


<script language="javascript" type="text/javascript">
function printon() 
{

	//$('#search_result').jqprint();
	//$('#search_result').window.print();
}

			 
function exporton1() 
{	
	var appoint_type=$("#appointment_type").val();
	var display_type=$("#display_type").val();
	var date_from=$("#date_from").val();
	var date_to=$("#date_to").val();
	var service=$("#service").val();
	var staff=$("#staff").val();
	var status=$("#status").val();
	var username=$("#username").val();
	location.href="<?php echo site_url('admin/appointment_report/export_excel_csv'); ?>" +"?app_type="+appoint_type+"&display_type="+display_type+"&date_from="+ date_from+"&date_to="+date_to+"&service="+service+"&staff="+staff+"&status="+status+"&username="+username;
}

function exporton()
{	
	var appoint_type=$("#appointment_type").val();
	var display_type=$("#display_type").val();
	var date_from=$("#date_from").val();
	var date_to=$("#date_to").val();
	var service=$("#service").val();
	var staff=$("#staff").val();
	var status=$("#status").val();
	var username=$("#username").val();
	location.href="<?php echo site_url('admin/appointment_report/getAppointmentsExcel'); ?>" +"?appointment_type="+appoint_type+"&display_type="+display_type+"&date_from="+ date_from+"&date_to="+date_to+"&service="+service+"&staff="+staff+"&status="+status+"&username="+username;

}
</script>