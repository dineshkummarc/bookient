<script type="text/javascript">
		$(document).ready(function() {			
			//CB#SOG#21-11-2012#PR#S			
			$('.required').focus(function(){
				var $parent = $(this).parent();
				$parent.removeClass('error');
				$('span.error',$parent).hide();
			});
			
			//CB#SOG#21-11-2012#PR#E			
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
					$parentTag.addClass('error').append($error.clone().text('Required Field'));
				}
				else if($(this).hasClass('email') == true)
				{
					if(!emailReg.test(inputVal)){
						$parentTag.addClass('error').append($error.clone().text('Enter valid email'));
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
			alert('Please select a pre payment option.');
			$('#msg_label_4').html('Please select a pre payment option.')
		}
		else
		{
			if($('#service_type_2').is(':checked'))
			{
				if($('#fixed_amount_val').val() == "")
				{
					check_err++;
					alert('Required Field.');
					$('#msg_label_2').html('Required Field.');
				}
				else if($('#fixed_amount_val').val() != "" && eval($('#fixed_amount_val').val()) == 0)
				{
					check_err++;
					alert('Amount can not be zero.');
				}
			}
			if($('#service_type_3').is(':checked'))
			{
				if($('#percent_amount_val').val() == "")
				{
					check_err++;
					alert('Required Field.');
					$('#msg_label_3').html('Required Field.');
				}
				else if($('#percent_amount_val').val() != "")
				{
					if(eval($('#percent_amount_val').val()) == 0 || $('#percent_amount_val').val() > 100)
					{
						check_err++;
						alert('Enter proper value.');
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
					   type: 'POST',
					   url: '<?php echo site_url("admin/prepayment/SavePaymentSettingAjax"); ?>',
					   data: params,
					   success: function(data){
						   if(data == 1)
						   {
							 alert('Record Saved');
							 $('#msg_label_0').html('Record Saved');
						   }
						   else
						   {
							 alert('Cannot save data');
							 //alert(data);
							 $('#msg_label_4').html('Cannot save data');
						   }
					   }
				});	
			}
		}
	}
	else
		alert('Please select at least one payment gateway.');
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
			$parentTag.addClass('error').append($error.clone().text('Required Field'));
		}
		else if($(this).hasClass('email') == true)
		{
			if(!emailReg.test(inputVal)){
				$parentTag.addClass('error').append($error.clone().text('Enter valid email'));
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
			   type: 'POST',
			   url: '<?php echo site_url("admin/prepayment/SavePaymentGatewayValuesAjax"); ?>',
			   data: params,
			   success: function(data){
				   if(data==0)
				   {
					   $('#msg_'+ID).html('<span style="color:#008040">Data saved successfully!</span>');
				   }
				   else
				   {
					   $('#msg_'+ID).html('<span style="color:#FF0000">Can not save data!Please try again later.</span>');
				   }
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
		   type: 'POST',
		   url: '<?php echo site_url("admin/prepayment/SaveTaxValuesAjax"); ?>',
		   data: params,
		   success: function(data){
			   var data_arr = data.split('(@)');
			   $('#tax_details_tbl').html(data_arr[0]);
			   var len = data_arr.length;
			   var length = eval(len);
			  
			   for(var i=1; i < length ; i++)
			   { 
				   if(data_arr[i] == 0)
				   {
					 $('#show_msg_0').html('<span style="color:#008040;">Record Saved</span>');
					 $('#show_msg_1').html('');
					 $('#show_msg_2').html('');
					 $('#show_msg_3').html('');
					 $('#show_msg_4').html('');
				   }
				   if(data_arr[i] == 1)
				   {
					   $('#show_msg_1').html('<span style="color:#FF0000;">Required Field</span>');
				   }
				   if(data_arr[i] == 2)
				   {
					   $('#show_msg_2').html('<span style="color:#FF0000;">Required Field</span>');
				   }
				   if(data_arr[i] == 3)
				   {
					   $('#show_msg_2').html('');
					   $('#show_msg_3').html('<span style="color:#FF0000;">Enter Proper Tax Amount</span>');
				   }
				   if(data_arr[i] == 4)
				   {
					   $('#show_msg_4').html('<span style="color:#FF0000;">Can not save data!Please try again later</span>');
				   } 
			   }
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
		   type: 'POST',
		   url: '<?php echo site_url("admin/prepayment/SetTaxCategorySelectAjax"); ?>',
		   data: params,
		   success: function(data){
			   $('#set_list').html(data);
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
			   type: 'POST',
			   url: '<?php echo site_url("admin/prepayment/DeleteTaxDetailsAjax"); ?>',
			   data: params,
			   success: function(data){
				   //alert(data);
				   $('#tax_details_tbl').html(data);
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
	//CB#SOG#20-11-2012#PR#S

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
					$parentTag.addClass('error').append($error.clone().text('Required Field'));
					errorcount++;
					$('#payment_gateways_enabled_'+i).attr('checked', false);
				}
				else if($(this).hasClass('email') == true)
				{
					if(!emailReg.test(inputVal)){
						$parentTag.addClass('error').append($error.clone().text('Enter valid email'));
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
					   type: 'POST',
					   url: '<?php  echo site_url("admin/prepayment/SavePaymentSettingAjax"); ?>',
					   data: params,
					   success: function(data){						   
					   }
				});	
	    }		 
	 } else {		
		alert('You must select atleast one payment gateway');
		$(obj).attr('checked', true);		
		return false;		 
	 }
	
	//CB#SOG#20-11-2012#PR#E

	
	
}
</script>