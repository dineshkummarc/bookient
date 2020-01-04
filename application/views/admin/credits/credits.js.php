<script language="javascript">
function SetLocalAdminPaymentSetting(val)
{
	
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
				  if(data == 1){
					if(val == 'N'){
						$('#HideShowSec').hide();
					}else{
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
</script>
<script type="text/javascript">
function OpenInfo(id)
{
	$('.info_tr').hide();
	$('#tr_'+id).show();	
	
	var credit_type = id;
	var country = $('#country').val();
	
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
			   url: '<?php echo site_url("admin/credits/GetRateInfoAjax"); ?>',
			   data: { 'credit_type' : credit_type, 'country_id' : country },
			   success: function(data){
				   
				    var ret_arr = data.split('(@$@)');
				   
					$('.info_tr').hide();
					$('#call_'+credit_type).html(ret_arr[1]);
					$('#sms_'+credit_type).html(ret_arr[0]);
					$('#tr_'+credit_type).show();	
			   }
		});
		}
	//check login end
	}  
});
}
</script>
<script type="text/javascript">
function GetInfo(country)
{
	var credit_type = $('input[name="credit_type"]:checked').val();
	
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
			   url: '<?php echo site_url("admin/credits/GetRateInfoAjax"); ?>',
			   data: { 'credit_type' : credit_type, 'country_id' : country },
			   success: function(data){
				   
				    var ret_arr = data.split('(@$@)');
				   
					$('.info_tr').hide();
					$('#call_'+credit_type).html(ret_arr[1]);
					$('#sms_'+credit_type).html(ret_arr[0]);
					$('#tr_'+credit_type).show();	
			   }
		});
		}
	//check login end
	}  
});
}
</script>
<script type="text/javascript">
function who_buy_credits_show()
{
	$('#who_buy_credits').show();
	$('#who_buy_credits_hide').html('<a href="javascript:void(0)" onclick="who_buy_credits_hide();" style="font-size:10px;">Why buy credits?</a>');
}
</script>
<script type="text/javascript">
function who_buy_credits_hide()
{
	$('#who_buy_credits').hide();
	$('#who_buy_credits_hide').html('<a href="javascript:void(0)" onclick="who_buy_credits_show();" style="font-size:10px;">Why buy credits?</a>');
}
</script>
<script type="text/javascript">
function download_reciept(id)
{   
    location.href="<?php echo site_url('admin/credits/DownloadPdfAjax'); ?>" +"?id="+id;	
}
</script>