<script type="text/javascript">
		$(document).ready(function() {				
			$('.required').focus(function(){
				var $parent = $(this).parent();
				$parent.removeClass('error');
				$('span.error',$parent).hide();
			});			
		});
</script>

<script language="javascript">

function SetLocalAdminPaymentSetting(val)
{
	$('#service_type_1').prop('checked', false);
	$('#service_type_2').prop('checked', false);
	$('#service_type_3').prop('checked', false);
	$('#fixed_amount_val').val('');
	$('#percent_amount_val').val('');
	
	

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/prepayment/SetPaymentSettingAjax"); ?>',
		   data: { 'pre_pmnt_setting' : val },
		   success: function(data){
			  if(data == 1)
			  {
				if(val == '0')
				{
					$('#HideShowSec').hide();
				}
			    else
			  	{
					$('#HideShowSec').show();
				}
			  }
		   }
	});
		}
	//check login end
	}  
});
}

function SetFocusOn(txt_id)
{
	$('#'+txt_id).focus();
}

function SetChecked(radio_id)
{
	$('#'+radio_id).attr("checked", true);
}



function SaveValue()
{
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var num = $('#total_paymentgateway_num').val();
	var flag=0;
	var store = new Array();
	var str = '';

	for(var i=0; i < num; i++)
	{
		var check_selected = $('#payment_gateways_enabled_'+i).attr('checked');
		if(check_selected == 'checked')
		{
			var $formId = $('#amount_frm_'+i);
			var formAction = $formId.attr('action');
			var $error = $('<span class="error" style="color:#FF0000;"></span>');
	
			$('li',$formId).removeClass('error');
			$('span.error').remove();							 
			$('.required',$formId).each(function(){
				var inputVal = $(this).val();
				var $parentTag = $(this).parent();
				if(inputVal == ''){
					$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("required_fld");?>'));
				}
				else if($(this).hasClass('email') == true)
				{
					if(!emailReg.test(inputVal)){
						$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("entr_valid_email");?>'));
					}
				}
			});	
	
			if ($('span.error').length > 0) 
			{
				store[i] = 1;
				$('span.error').each(function(){
					var distance = 5;
					var width = $(this).outerWidth();
					var start = width + distance;
					$(this).show().css({
						display: 'block',
						opacity: 0,
						right: -start+'px'
					})
					.animate({
						right: -width+'px',
						opacity: 1
					}, 'slow');
				});
			}
			else 
			{
				store[i] = 0;
				str = str+','+i;
			}
		}
		else
			store[i] = 1;
	}
	
	for(var i=0; i < num; i++)
	{
		if(store[i] == 0)
		{
			flag++;
		}
	}
	
	if(flag != 0)
	{
		var check_err = 0;
		if(!$("input[name='service_type']:checked").val())
		{
			check_err++;
			alert('<?php echo $this->lang->line("slct_pre_payment_optn");?>');
			$('#msg_label_4').html('<?php echo $this->lang->line("slct_pre_payment_optn");?>');
		}
		else
		{
			if($('#service_type_2').is(':checked'))
			{
				if($('#fixed_amount_val').val() == "")
				{
					check_err++;
					alert('<?php echo $this->lang->line("required_fld");?>');
					$('#msg_label_2').html('<?php echo $this->lang->line("required_fld");?>');
				}
				else if($('#fixed_amount_val').val() != "" && eval($('#fixed_amount_val').val()) == 0)
				{
					check_err++;
					alert('<?php echo $this->lang->line("amnt_cn_nt_b_zero");?>');
				}
			}
			if($('#service_type_3').is(':checked'))
			{
				if($('#percent_amount_val').val() == "")
				{
					check_err++;
					alert('<?php echo $this->lang->line("required_fld");?>');
					$('#msg_label_3').html('<?php echo $this->lang->line("required_fld");?>');
				}
				else if($('#percent_amount_val').val() != "")
				{
					if(eval($('#percent_amount_val').val()) == 0 || $('#percent_amount_val').val() > 100)
					{
						check_err++;
						alert('<?php echo $this->lang->line("entr_proper_val")?>');
					}
				}
			}
			if(check_err == 0)
			{
				var str_arr = str.split(',');
				str_arr.shift();
				var arr_len = str_arr.length;
				
				for(var j=0; j < arr_len; j++)
				{
					SavePaymentGatewayValue(str_arr[j]);
				}
				
				var frmID='#amount_frm';
				var params ={ 'action' : 'save' };
				var paramsObj = $(frmID).serializeArray();
				$.each(paramsObj, function(i, field){
					params[field.name] = field.value;
				});
				
				
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
					   type: 'POST',
					   url: '<?php echo site_url("admin/prepayment/SavePaymentSettingAjax"); ?>',
					   data: params,
					   success: function(data){
						   if(data == 1)
						   {
							 alert('<?php echo $this->lang->line("record_saved");?>');
							 $('#msg_label_0').html('<?php echo $this->lang->line("record_saved");?>');
						   }
						   else
						   {
							 alert('<?php echo $this->lang->line("cn_nt_sv_data")?>');
							 //alert(data);
							 $('#msg_label_4').html('<?php echo $this->lang->line("cn_nt_sv_data")?>');
						   }
					   }
				});
		}
	//check login end
	}  
});	
			}
		}
	}
	else
		alert('<?php echo $this->lang->line("pls_slct_one_payment_gatwy")?>');
}

function SavePaymentGatewayValue(ID)
{
	var $formId = $('#amount_frm_'+ID);
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
	$('li',$formId).removeClass('error');
	$('span.error').remove();							 
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		
		if(inputVal == '')
		{
			$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("required_fld");?>'));
		}
		else if($(this).hasClass('email') == true)
		{
			if(!emailReg.test(inputVal)){
				$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("entr_valid_email")?>'));
			}
		}
	});	
	
	if ($('span.error').length > 0) {
			$('span.error').each(function(){
				var distance = 5;
				var width = $(this).outerWidth();
				var start = width + distance;
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}
	else 
	{
		var frmID='#amount_frm_'+ID;
		var params ={ 'action' : 'save' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
								 
			params[field.name] = field.value;
		});
		
		var total_paymentgateway_num = $('#total_paymentgateway_num').val();
		//alert(total_paymentgateway_num);
		//payment_gateways_enabled_
		var newPaymentArr = new Array();
		for(var i=0; i<total_paymentgateway_num; i++){
			
			if($('#payment_gateways_enabled_'+i+':checked').val())
				newPaymentArr.push($('#payment_gateways_enabled_'+i+':checked').val());
			
		}
		//alert(newPaymentArr.join(','));
		params['strPmntGtwyenbld'] = newPaymentArr.join(',');
		
	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
		    $.ajax({
		    type: 'POST',
		    url: '<?php echo site_url("admin/prepayment/SavePaymentGatewayValuesAjax"); ?>',
		    data: params,
		    success: function(data){
				if(data==0)
				{
					$('#msg_'+ID).html('<span style="color:#008040">'+'<?php echo $this->lang->line("data_savd_succ")?>'+'</span>');
				}
				else
				{
					$('#msg_'+ID).html('<span style="color:#FF0000">'+'<?php echo $this->lang->line("cn_nt_save_data_pls_try");?>'+'</span>');
				}
			}
		});
		}
	//check login end
	}  
});
	}
}

function SaveTax()
{
	var frmID='#tax_frm';
	var params ={ 'action' : 'save' };
	var paramsObj = $(frmID).serializeArray();
	$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
	});
	

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/prepayment/SaveTaxValuesAjax"); ?>',
		   data: params,
		   success: function(data){
                $("#tax_rate").val('');
			   var data_arr = data.split('(@)');
			   $('#tax_details_tbl').html(data_arr[0]);
			   var len = data_arr.length;
			   var length = eval(len);
			  
			   for(var i=1; i < length ; i++)
			   { 
				   if(data_arr[i] == 0)
				   {
					 $('#show_msg_0').html('<span style="color:#008040;">'+'<?php echo $this->lang->line("record_saved")?>'+'</span>');
					 $('#show_msg_1').html('');
					 $('#show_msg_2').html('');
					 $('#show_msg_3').html('');
					 $('#show_msg_4').html('');
				   }
				   if(data_arr[i] == 1)
				   {
					   $('#show_msg_1').html('<span style="color:#FF0000;">'+'<?php echo $this->lang->line("required_fld")?>'+'</span>');
				   }
				   if(data_arr[i] == 2)
				   {
					   $('#show_msg_2').html('<span style="color:#FF0000;">'+'<?php echo $this->lang->line("required_fld")?>'+'</span>');
				   }
				   if(data_arr[i] == 3)
				   {
					   $('#show_msg_2').html('');
					   $('#show_msg_3').html('<span style="color:#FF0000;">'+'<?php echo $this->lang->line("entr_prper_tx_amnt")?>'+'</span>');
				   }
				   if(data_arr[i] == 4)
				   {
					   $('#show_msg_4').html('<span style="color:#FF0000;">'+'<?php echo $this->lang->line("cn_nt_save_data_pls_try")?>'+'</span>');
				   } 
			   }
		   }
	});	
		}
	//check login end
	}  
});
}

function focus_tax_rate()
{
	$('#show_msg_2').html('');
	$('#show_msg_3').html('');
}

function focus_tax_type()
{
	$('#show_msg_1').html('');
}

function not_in_list_textbox()
{
	$('#set_list').html('<input type="text" name="tax_cat_not_in_list" id="tax_cat_not_in_list" onkeypress="focus_tax_type();" /><input type="hidden" name="tax_cat" id="tax_cat" value="0"><a href="javascript:void(0);" onclick="in_list_select();">Show List</a>');
}

function in_list_select()
{
	var params = { 'action' : 'tax_cat_select'};

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("admin/prepayment/SetTaxCategorySelectAjax"); ?>',
		   data: params,
		   success: function(data){
			   $('#set_list').html(data);
		   }
	});
		}
	//check login end
	}  
});
}

function DeleteTaxRecord(id)
{
	var r=confirm("Are you sure you want to delete?");
	if (r==true)
	{
		var params = { 'action' : 'del', 'id' : id};

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("admin/prepayment/DeleteTaxDetailsAjax"); ?>',
			   data: params,
			   success: function(data){
				   //alert(data);
				   $('#tax_details_tbl').html(data);
			   }
		});	
		}
	//check login end
	}  
});
	}
}

$('#save_type').click(function(){
		$('.msg-saved').hide().fadeIn(2000);
});

function floatnumbersonly(myfield, e, dec)
{
	var key;
	var keychar;

	if(window.event)
		key = window.event.keyCode;
	else if(e)
		key = e.which;
	else
		return true;

	keychar = String.fromCharCode(key);

	// control keys
	if((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27)|| (key==46))
		return true;	
	// numbers
	else if((("0123456789").indexOf(keychar) > -1))
		return true;	
	// decimal point jump
	else if(dec && (keychar == "."))
	{
		myfield.form.elements[dec].focus();
		return false;
	}
	else
		return false;
}

function check_available(obj)
{
	 $count_ck_box = $(":checkbox:checked").length;	 
	 //alert($(":checkbox:checked").length);
	 
	if($count_ck_box > 0) {	
	
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var num = $('#total_paymentgateway_num').val();
	var flag=0;
	var store = new Array();
	//var list = new Array();
	var str = '';

	for(var i=0; i < num; i++)
	{
		var check_selected = $('#payment_gateways_enabled_'+i).attr('checked');
		if(check_selected == 'checked')
		{
			var $formId = $('#amount_frm_'+i);
			var formAction = $formId.attr('action');
			var $error = $('<span class="error" style="color:#FF0000;"></span>');
			var errorcount = 0;
	
			$('li',$formId).removeClass('error');
			$('span.error').remove();							 
			$('.required',$formId).each(function(){
				var inputVal = $(this).val();
				var $parentTag = $(this).parent();
				if(inputVal == ''){
					$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("required_fld")?>'));
					errorcount++;
					$('#payment_gateways_enabled_'+i).attr('checked', false);
				}
				else if($(this).hasClass('email') == true)
				{
					if(!emailReg.test(inputVal)){
						$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("entr_valid_email")?>'));
						errorcount++;
						$('#payment_gateways_enabled_'+i).attr('checked', false);
					}
				}
			});	
			
			
	
			if ($('span.error').length > 0) 
			{
				//store[i] = 1;
				$('span.error').each(function(){
					var distance = 5;
					var width = $(this).outerWidth();
					var start = width + distance;
					$(this).show().css({
						display: 'block',
						opacity: 0,
						right: -start+'px'
					})
					.animate({
						right: -width+'px',
						opacity: 1
					}, 'slow');
				});
			}
			
			
		}
		
  }
		 
	if(errorcount == 0)
	{    		
		$("input:checkbox[name=payment_gateways_enabled]:checked").each(function()
		{
			 var value1= $(this).val();
			  store.push(value1);
		});		
		params = {'title':store}; 
	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({
					   type: 'POST',
					   url: '<?php  echo site_url("admin/prepayment/SavePaymentSettingAjax"); ?>',
					   data: params,
					   success: function(data){						   
					   }
				});
		}
	//check login end
	}  
});	
	    }		 
	 } else {		
		alert('<?php echo $this->lang->line("must_sect_one_paymnt_optn")?>');
		$(obj).attr('checked', true);		
		return false;		 
	 }
	
}
</script>