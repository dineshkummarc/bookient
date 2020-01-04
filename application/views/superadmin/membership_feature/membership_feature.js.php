<script type="text/javascript">
$(document).ready(function() {

	$('#already_exist').remove();
	$("#faq_frm input[type=text],#faq_frm #cke_membership_description").focus(function(){
		$(this).removeAttr('style');
	});
});

function submit_plan(){
	resetForm();
	$('#already_exist').remove();	
	var membr_ship_id			= $('#feature_id').val();
	var feature_name			= $('#feature_name').val();
	var status					= $('#status').val();
	
	var error = 0;
	if(feature_name ==''){
		$('#feature_name').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(status ==''){
		$('#status').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	
	if(error!=0){
		return false;
	}else{
			var params ={'id' : membr_ship_id,'title' : feature_name };
			$.ajax({
	                type: 'POST',
	                url: '<?php  echo site_url("superadmin/membership_feature/Get_title_Ajax"); ?>',
	                data: params,
	                success: function(data){
                        if(data == 1){
							var frmID='#faq_frm';
							var params ={ 'action' : 'save' };
							var paramsObj = $(frmID).serializeArray();
							$.each(paramsObj, function(i, field){
							        if(field.name == 'membership_description'){
										params[field.name] = membership_description;
									}else{
										var regex = /(<([^>]+)>)/ig;
							                var input_Val = field.value;
							                input_Val = input_Val.replace(regex, "");
							                params[field.name] = $.trim(input_Val);
									}        
							});
							$.ajax({
							   type: 'POST',
							   url: '<?php  echo site_url("superadmin/membership_feature/SaveAjax"); ?>',
							   data: params,
							   success: function(data){
							       var url = window.location.protocol + "//" + window.location.host + "/" ;
							       window.location = url+"superadmin/membership_feature/index/IsPreserved/Y";
							   }
							});
                        }else{
							$('#feature_name').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
							$('#feature_name').after('<span id="already_exist" class="already-exist">Already Exist</span>');
							return false;
                        }
                     }
	        });
	}
}

function resetForm(){
	$("#faq_frm input[type=text]").removeAttr('style');
	$("#faq_frm #cke_membership_description").removeAttr('style');
}

function cancl_plan(){
	$('#already_exist').remove();	
	$('.required').val('');
	$('#feature_num').val('1');
	$('.membership_feature_hide').html('');
	$('.tab_listing').show();
	$('#add_new_link').show();
	$('#add_faq').hide();
}

function hide_show_tbl(){
	$('#already_exist').remove();	
	$('#ans_err').html('');
	$('#add_new_link').hide();
	$('#sub_faq').val('ADD');	
	$('.tab_listing').hide();
	$('#add_faq').show();
	$('#feature_id').val('');
	//////////////////////////////
	resetForm();
	$("#faq_frm input[type=text]").val('');
}


function edit_plan(feature_id){
	$('#already_exist').remove();	
	$('.tab_listing').hide();
	$.ajax({
	   type: 'POST',
	   url: '<?php echo site_url("superadmin/membership_feature/EditAjax"); ?>',
	   dataType: 'json',
	   data: { 'feature_id' : feature_id },
	   success: function(data){
		    $('#add_faq').show();
			$('#sub_faq').val('Update');
			$('#feature_id').val(feature_id);
			$('#feature_name').val(data.feature_name);			
			$('#status').val(data.status);			
			$('#ans_err').html('');
			$('#add_new_link').hide();
		}
	});
}

function back_mem(){
	$('#listing_subscription').hide();
	$('#faq_listing').show();
	$('#membership_feature_id').val('');
	$('#add_new_link').show();
	$('#add_subs_link').hide();
}

function ConfirmDelete(url,delete_id,delete_name,delete_lebel_name,delete_category_id)
	{
		
		if (confirm("Are you sure to delete "+delete_lebel_name+" "+delete_name+" ?")) {
			url=url+'/record_id/'+delete_id+'/IsPreserved/Y';
			//$('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');
			var params ={
			'module': 'membership_feature',
			'Is_Process':'Y',
			'action': 'delete'
			};
			j.ajax({
				type: "POST",
				url: url,
				data: params,
				dataType: 'text',
				success: function(data){
					
						j('#records_listing').html(data);
					//	j('#TransMsgDisplay').html('');
				}
			});
	   	}
	}

</script>