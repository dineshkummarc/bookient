<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>css/scrollbar.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tinyscrollbar.min.js"></script>
<script type='text/javascript' src='<?php  echo base_url(); ?>js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>css/jquery.autocomplete.css" />
<script type="text/javascript">
		$(document).ready(function() {
								   
			$('#afterClick_password #old').focus(function(){
				alert('gg');
				$("#error_old").html('');				
			});	
			/*$('#date_to').focus(function(){
				$('#err_to').html('');
				$('#err_rep').html('');
			});	*/
			
		});
</script>
<script language="javascript" type="text/javascript">
	
	function clr_reg_values(obe8)
        {           
          $(obe8).next().html('');          
	  //$(obe8).next().next('span').html('');	 
	}
</script>
<script type="text/javascript">
$().ready(function() {
	$("#cus_name_search").autocomplete([
	<?php 
	$val1='';
	foreach($showAllCustomerNameForSearch as $value)
			{
				$val= '"'.$value.'"'.',';
				$val1=$val1.$val;
			}
			echo $val1; 
			?>], {
	width: 320,
	max: 4,
	highlight: false,
	multiple: true,
	multipleSeparator: " ",
	scroll: true,
	scrollHeight: 300
	});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
	$('#scrollbar1').tinyscrollbar();
	$("#add_customer").hide();
	$("#select_customer").hide();
	$("#add_tag_text").hide();
	$("#add_info_text").hide();
	$("#history").hide();
});
</script>
<script>
function st(id)
{
	//alert(id);
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customer/ajax_check1'); ?>",
		data:"id="+id,
		success:function(rdata)
		{ 
			var data = rdata.split("@@@");
			$("#cus_regionid_6").html(data[0]);
			$("#cus_cityid_7").html(data[1]);
			
		}
	});
}
</script>
<script>
function re(id)
{
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customer/ajax_region_check1'); ?>",
		data:"id="+id,
		success:function(rdata)
		{ 
			$("#cus_cityid_7").html(rdata);
		}
		});
}
</script>
<script>
function search_customer()
{
var cus_name_search1=$("#cus_name_search").val();


var cus_name_search=$.trim(cus_name_search1);
	if(cus_name_search != '')
	{
		
                $.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/searchCustomerAjax'); ?>",
			  data:"cus_name_search="+cus_name_search,
			  success:function(rdata)
			  { 
				 //alert(rdata);
                                 $('#scrollbar1').tinyscrollbar();
				 $("#show_all_customer").html(rdata);
			  }
		});
	}
	else
	{
	alert("Plese Enter Something");
	}

}
</script>	
<script>
function addCustomer()
{
	$("#history").hide();
	$("#select_customer").hide();
	$("#add_customer_link").hide();
	$("#add_customer").show();
	$("#edit_cus_btn").hide();
	$("#add_cus_btn").show();
	$("#add_tag_text").hide();
	$("#add_info_text").hide();
	$(".required_div").html(" ");
	$("#cus_fname_2").val('First Name');
	$("#cus_lname_3").val('Last Name');
	$("#user_email_p").val('');
	$("#cus_address_4").val('');
	$("#cus_zip_8").val('Zip');
	$("#cus_phn1_10").val('');
	$("#customer_id").val(0);
}
</script>
 <!-- //CB#SOG#4-12-2012#PR#S-->
<script>
function verify_customer(id)
{
	$.ajax({
		type: 'POST',
		data:"id="+id,
		url:"<?php echo site_url('admin/customer/verify_customerAjax'); ?>",		
		success:function(rdata)
		{ 
			//$("#cus_cityid_7").html(rdata);
			if(rdata == 1)
			{
				$("#verify_status").html('');
				$("#verify_status").html('<span>Verified</span>');
			}
			
		}
	});
	
}				
</script>

<script>
function send_pass_to_customer(id)
{
	$.ajax({
		type: 'POST',
		data:"id="+id,
		url:"<?php echo site_url('admin/customer/send_passAjax'); ?>",		
		success:function(rdata)
		{ 
			//$("#cus_cityid_7").html(rdata);
			if(rdata == 1)
			{
				alert('Mail Sent');
			}
			
		}
	});
	
}				
</script>
 <!-- //CB#SOG#4-12-2012#PR#E-->
<script>
function displayEditCustomer(customer_id)
{
<?php $this->session->userdata('user_name_customer'); ?>
	$("#select_customer").hide();
	$("#history").hide();
	$("#add_customer_link").hide();
	$("#add_customer").show();
	$("#add_cus_btn").hide();
	$("#edit_cus_btn").show();
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/customer/displayEditCustomerAjax'); ?>",
		  data:"customer_id="+customer_id,
		   success:function(rdata)
			{ 
			var data = rdata.split("@@@");
			 $("#cus_fname_2").val(data[0]);
			 $("#cus_lname_3").val(data[1]);
			 $("#user_email_p").val(data[2]);
			 $("#cus_address_4").val(data[4]);
			 $("#cus_zip_8").val(data[8]);
			 $("#cus_mob_9").val(data[9]);
			 $("#cus_phn1_10").val(data[10])
			 $("#cus_phn2_11").val(data[11])
			 $("#time_zone_id_21").val(data[12])
			 $("#cus_cityid_7").html(data[17]);
			 $("#cus_regionid_6").html(data[16]);
			 $("#cus_countryid_5").html(data[15]);
			 $("#customer_id").val(customer_id);
			 }
	});
}
</script>
<script>
function hideAddCustomer()
{
	$("#add_customer").hide();
	$("#add_customer_link").show();
	$("#select_customer").hide();
}
</script>
<script>
function addTagShow()
{
	$("#add_tag_text").show();
	$("#add_tag_div").hide();
	$("#tag_div").hide();
}
function cancelTag()
{
	$("#add_tag_text").hide();
	$("#add_tag_div").show();
	$("#tag_div").show();
}
</script>
<script>
function addinfoShow()
{
	$("#add_info_text").show();
	$("#add_info_div").hide();
	$("#info_div").hide();
}
function cancelinfo()
{
	$("#add_info_text").hide();
	$("#add_info_div").show();
	$("#info_div").show();
}
</script>
<script>
function selectCustomer(customer_id)
{
	//alert(customer_id);
	
	$("#upcoming_appointments_link1").addClass("select");
	$("#add_tag_text").hide();
	$("#add_info_text").hide();
	$("#add_info_div").show();
	$("#add_tag_div").show();
	$("#history").show();
	$("#past_appointments").hide();
	$("#payments").hide();
	$("#tag_div").show();
	$("#info_div").show();
	$("#past_appointments").html("");
	
	//alert(customer_id);
	$.ajax({
		  type: 'POST',
		  datatype:'html',
		  url:"<?php echo site_url('admin/customer/selectCustomerAjax'); ?>",
		  data:"customer_id="+customer_id,
		  success:function(rdata)
		  { 
			 $("#add_customer").hide();
			 $("#add_customer_link").show();
                         $("#select_customer").show();
			 var data = rdata.split("@@@");
			 $("#1st_name").html(data[0]);
			 $("#last_name").html(data[1]);
			 $("#user_email").html(data[2]);
			 $("#link").html(data[3]);
			 $("#cus_address").html(data[4]);
			 $("#cus_city").html(data[5]);
			 $("#cus_region").html(data[6]);
			 $("#cus_country").html(data[7]);
			 $("#cus_zip").html(data[8]);
			 $("#cus_mob").html(data[9]);
			 $("#cus_phn1").html(data[10]);
			 $("#cus_phn2").html(data[11]);
			 $("#tag_div").html(data[13]);
			 $("#tag").val(data[13]);
			 $("#info_div").html(data[14]);
			 $("#info").val(data[14]);
			 $("#customer_id").val(customer_id);
		   }
		});
	
	
		$("#upcoming_appointments").show();
		$("#past_appointments").hide();
		$("#payments").hide();
		$("#upcoming_appointments_link1").addClass("select");
		$("#past_appointments_link1").removeClass('select');
		$("#payments_link1").removeClass('select');
		
		//var customer_id=$("#customer_id").val();
		//alert(customer_id);
		$.ajax({
					  type: 'POST',
					  datatype:'html',
					  url:"<?php echo site_url('admin/customer/upcomingAppointmentsAjax'); ?>",
					  data:"customer_id="+customer_id,
					  success:function(rdata)
					  { 
						 $("#upcoming_appointments").html(rdata);
					  }
				});
}
	
</script>


<script>
function inviteCustomer(customer_id)
{
//alert(customer_id);
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customer/inviteCustomerAjax'); ?>",
		data:"customer_id="+customer_id,
		success:function(rdata)
		{ 
		  	alert("successfully mail send");
		}
	});

}
</script>



<script>

function addNewCustomer()
{
	
	var ajaxDataString = "";
	var user_email=$("#user_email_p").val();
	ajaxDataString = ajaxDataString+"user_email="+$.trim(user_email);
	var customer_id=$("#customer_id").val();
	ajaxDataString = ajaxDataString+"&customer_id="+customer_id;
	$('.required').focus(function(){
	$(".required_div").html(" ");
	});
	
	<?php if($checkFieldstatus['cus_fname'] == 1 ){ ?>
	
	var cus_fname_2=$("#cus_fname_2").val();
	if(cus_fname_2 == "First Name" || $.trim(cus_fname_2) == "" )
	{
		$("#cus_fname_div").html("Required Field");
		return false;
	}
        var charexp = /^[a-zA-Z ]+$/;
        if(!charexp.test(cus_fname_2))
        {
                $("#cus_fname_div").html("Only characters are allowed.");
		return false;
        }
	ajaxDataString = ajaxDataString+"&cus_fname_2="+$.trim(cus_fname_2);
	
	<?php } ?>
	
	<?php if($checkFieldstatus['cus_lname'] == 1 ){ ?>
	var cus_lname_3=$("#cus_lname_3").val();
	if(cus_lname_3 =="Last Name" || $.trim(cus_lname_3) =="" )
	{		
		$("#cus_lname_div").html("Required Field");
		return false;
	}
        if(!charexp.test(cus_lname_3))
        {
                $("#cus_lname_div").html("Only characters are allowed.");
		return false;
        }
	ajaxDataString = ajaxDataString+"&cus_lname_3="+$.trim(cus_lname_3);
	<?php } ?>
	
	if($.trim(user_email) == "")
	{
		$("#user_email_p_div").html("Required Field");
		return false;
	} 
	else
	{
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if( !emailReg.test( user_email ) )
		{
			$("#user_email_p_div").html("Enter a valid Email");
			return false;
		}
	}
	
	
	
	<?php if($checkFieldstatus['cus_address'] == 1 ){ ?>
	var cus_address_4=$("#cus_address_4").val();
	ajaxDataString = ajaxDataString+"&cus_address_4="+$.trim(cus_address_4);
	<?php } ?>
	
	<?php //if($checkFieldstatus['cus_country'] == 1 ){ ?>
	var cus_countryid_5=$("#cus_countryid_5").val();
	if($.trim(cus_countryid_5) == "")
	{
			
		$("#cus_countryid_5_div").html("Required Field");
		return false;
	} 
	ajaxDataString = ajaxDataString+"&cus_countryid_5="+$.trim(cus_countryid_5);
	<?php //} ?>
	
	<?php //if($checkFieldstatus['cus_region'] == 1 ){ ?>
	var cus_regionid_6=$("#cus_regionid_6").val();
	if($.trim(cus_regionid_6) == "")
	{
			
		$("#cus_regionid_6_div").html("Required Field");
		return false;
	} 
	ajaxDataString = ajaxDataString+"&cus_regionid_6="+$.trim(cus_regionid_6);
	<?php //} ?>
	
	<?php //if($checkFieldstatus['cus_city'] == 1 ){ ?>
	var cus_cityid_7=$("#cus_cityid_7").val();
	if($.trim(cus_cityid_7) == "")
	{
			
		$("#cus_cityid_7_div").html("Required Field");
		return false;
	}
	
	ajaxDataString = ajaxDataString+"&cus_cityid_7="+$.trim(cus_cityid_7);
	<?php //} ?>
	
	
	
	<?php if($checkFieldstatus['cus_mob'] == 1 ){ ?>
	var cus_mob_9=$("#cus_mob_9").val();
        if($.trim($("#cus_mob_9").val())!=='')
        {             
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_mob_9').val()))
            {
                $('#cus_phn1_10_div').html('Mobile has to be Numeric.');               
                return false;

            }
        }
        
	ajaxDataString = ajaxDataString+"&cus_mob_9="+$.trim(cus_mob_9);
	<?php } ?>
	
	
	<?php if($checkFieldstatus['cus_phn1'] == 1 ){ ?>
	var cus_phn1_10=$("#cus_phn1_10").val();
        if($.trim($("#cus_phn1_10").val())!=='')
        {             
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn1_10').val()))
            {
                $('#cus_phn1_11_div').html('Phone has to be Numeric.');               
                return false;

            }
        }
	ajaxDataString = ajaxDataString+"&cus_phn1_10="+$.trim(cus_phn1_10);
	<?php } ?>
	
	
	<?php if($checkFieldstatus['cus_phn2'] == 1 ){ ?>
	var cus_phn2_11=$("#cus_phn2_11").val();
        if($.trim($("#cus_phn2_11").val())!=='')
        {             
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn2_11').val()))
            {
                $('#cus_phn1_12_div').html('Phone has to be Numeric.');               
                return false;

            }
        }
	ajaxDataString = ajaxDataString+"&cus_phn2_11="+$.trim(cus_phn2_11);
	<?php } ?>
	<?php //if($checkFieldstatus['cus_zip'] == 1 ){ ?>
            
	var cus_zip_8=$("#cus_zip_8").val();
        if($.trim($("#cus_zip_8").val())!=='')
        {             
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_zip_8').val()))
            {
                $('#cus_zip_8_div').html('Zip has to be Numeric.');             
                return false;

            }
        }
	ajaxDataString = ajaxDataString+"&cus_zip_8="+$.trim(cus_zip_8);
	<?php //} ?>
	
	<?php //if($checkFieldstatus['time_zone_id_21'] == 1 ){ ?>
	var time_zone_id_21=$("#time_zone_id_21").val();
	ajaxDataString = ajaxDataString+"&time_zone_id_21="+$.trim(time_zone_id_21);
	<?php //} ?>
	
	//alert(ajaxDataString);
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/customer/customerAddajax'); ?>",
		data:ajaxDataString,
		success:function(rdata)
		{ 
		  alert("successfully inserted");
		  $("#add_customer").hide();
		  $("#add_customer_link").show();
		  $("#show_all_customer").html(rdata);
		  $('#scrollbar1').tinyscrollbar();
		// alert(rdata);
		}
	});
}
</script>
<script>
function deleteCustomer(customer_id)
{
	var conBox = confirm("Are you sure you want to delete: " + name);
	if(conBox)
	{
		$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/deleteCustomerAjax'); ?>",
			  data:"customer_id="+customer_id,
			  success:function(rdata)
			  { 
				 $("#history").hide();
				 $("#select_customer").hide();
				 alert("Deleted successfully");
				 $("#show_all_customer").html(rdata);
				 $('#scrollbar1').tinyscrollbar();
				 //alert(rdata);
			  }
		});
	}
	else
	{
		return;
	}
}
</script>
<script>
function addTag()
{
	$("#add_tag_text").hide();
	$("#tag_div").show();
	$("#add_tag_div").show();
	var tag=$("#tag").val();
	var customer_id=$("#customer_id").val();
	$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url:"<?php echo site_url('admin/customer/addTagAjax'); ?>",
				  data:"tag="+tag+"&customer_id="+customer_id,
				  success:function(rdata)
				  { 
					 $("#tag_div").html(rdata);
				  }
			});

}
</script>
<script>
function addInfo()
{
	$("#info_div").show();
	$("#add_info_text").hide();
	$("#add_info_div").show();
	var info=$("#info").val();
	var customer_id=$("#customer_id").val();
	$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url:"<?php echo site_url('admin/customer/addInfoAjax'); ?>",
				  data:"info="+info+"&customer_id="+customer_id,
				  success:function(rdata)
				  { 
					 $("#info_div").html(rdata);
				  }
			});
}
</script>
<script>
function upcomingAppointments()
{
	$("#upcoming_appointments").show();
	$("#past_appointments").hide();
	$("#payments").hide();
	$("#upcoming_appointments_link1").addClass("select");
	$("#past_appointments_link1").removeClass('select');
	$("#payments_link1").removeClass('select');
	
	var customer_id=$("#customer_id").val();
	//alert(customer_id);
	$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url:"<?php echo site_url('admin/customer/upcomingAppointmentsAjax'); ?>",
				  data:"customer_id="+customer_id,
				  success:function(rdata)
				  { 
					 $("#upcoming_appointments").html(rdata);
				  }
			});
}
</script>
<script>
function pastAppointments()
{
	$("#past_appointments").show();
	$("#upcoming_appointments").hide();
	$("#payments").hide();
	$("#past_appointments_link1").addClass("select");
	$("#payments_link1").removeClass('select');
	$("#upcoming_appointments_link1").removeClass('select');
	var customer_id=$("#customer_id").val();
	$.ajax({
				  type: 'POST',
				  datatype:'html',
				  url:"<?php echo site_url('admin/customer/pastAppointmentsAjax'); ?>",
				  data:"customer_id="+customer_id,
				  success:function(rdata)
				  { 
					 $("#past_appointments").html(rdata);
				  }
			});
}
</script>
<script>
function payments()
{
	$("#payments").show();
	$("#upcoming_appointments").hide();
	$("#past_appointments").hide();
	$("#payments_link1").addClass("select");
	$("#past_appointments_link1").removeClass('select');
	$("#upcoming_appointments_link1").removeClass('select');
}


</script>
<script type="text/javascript">
function change_password(){
	
	$.ajax({	
	  type: 'POST',
	  datatype:'html',
	  url:"<?php echo site_url('admin/customer/change_password'); ?>",
	  //data:"name="+email,
      success:function(rdata)
        { 
		
		    //alert(rdata); return false;
			 $("#change_password").hide();
			 $("#afterClick_password").show();
			 $("#afterClick_password").html(rdata);
		}
	

	});
}
//CB#SOG#11-12-2012#PR#S
function cancel_change(){
	 $("#change_password").show();
	 $("#afterClick_password").hide();  
 }
 
 function hide_err_or(val){	
	 //alert(val);
	 if(val == "old"){
		  $("#error_old").html('');
	 }
	 if(val == "new"){
		  $("#error_new").html('');
	 }
	 if(val == "confirm"){
		  $("#error_confirm").html('');
	 }
 }



function confirm_password()
{
	
	var customer_id = $("#customer_id_val").val(); 
	var old_password=$("#old").val();
    var new_password=$("#new").val();
	var confirm_password=$("#confirm").val();
    var minimum=5;
  /* if($.trim(old_password)=='')
   {
	   $("#error_old").show();
	   $("#error_old").html('Required Field');
   }
   else if($.trim(old_password).length<=minimum)
   {
	   $("#error_old").html('Password length should be minimum 6 characters');
   }*/
   //else if($.trim(new_password)=='')
   if($.trim(new_password)=='')
   {
	   $("#error_old").hide();
	   $("#error_new").show();
	   $("#error_new").html('Required Field');
   }
   else if(new_password.length<=minimum)
   {
	   $("#error_new").html('Password length should be minimum 6 characters');
   }
   else if(confirm_password=='')
   {
		$("#error_new").hide()
		$("#error_confirm").show();
		$("#error_confirm").html('Required Field');
   }
   else if(confirm_password.length<=minimum)
   {
	   $("#error_confirm").html('Password length should be minimum 6 characters');
   }
   else if(confirm_password!=new_password)
   {
		$("#error_new").show();
		$("#error_new").html('New password does not match');
		$("#error_confirm").html('Confirm password does not match');
   }
	else
	{
		 $.ajax({
			  type: 'POST',
			  datatype:'html',
			  url:"<?php echo site_url('admin/customer/save_password'); ?>",
			  /*data:"old="+old_password+"&new="+new_password+"&customer_id="+customer_id,*/
                          data:"new="+new_password+"&customer_id="+customer_id,
			  success:function(rdata)
			  {         
				//alert(rdata);
				$("#error_old").hide();
				$("#error_new").hide();
				$("#error_confirm").hide();
				if(rdata==1)
				{
					$("#change_password").show();
					$("#afterClick_password").hide();
					$("#success").show();
					alert("Password Changed");
					//$("#success").html("password changed");
				}
				else
				{
					$("#error_old").show();
					$("#error_old").html('Please correctly enter your current password');
				}
			}
			});
		}
	
   }
//CB#SOG#11-12-2012#PR#E
</script>
	