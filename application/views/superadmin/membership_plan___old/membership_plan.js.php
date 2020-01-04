<script type="text/javascript">
$(document).ready(function() {

	CKEDITOR.instances.membership_description.on('focus', function() {
		$('#ans_err').html("");
	});
//	$("#faq_frm input[type=text]").val('');
//	CKEDITOR.instances.membership_description.setData('');
	
	$("#faq_frm input[type=text],#faq_frm #cke_membership_description").focus(function(){
		$(this).removeAttr('style');
	});
});

function submit_plan(){
	resetForm()
	var membr_ship_id			= $('#membership_type_id').val();
	var membership_name			= $('#membership_name').val();
	var membership_tagline		= $('#membership_tagline').val();
	var membership_amount		= $('#membership_amount').val();
	var membership_validity		= $('#membership_validity').val();
	var membership_description	= CKEDITOR.instances.membership_description.getData();;
	var error = 0;
	if(membership_name ==''){
		$('#membership_name').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(membership_tagline ==''){
		$('#membership_tagline').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(membership_amount ==''|| isNaN(membership_amount)== true){
		$('#membership_amount').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(membership_validity =='' || isNaN(membership_validity)== true){
		$('#membership_validity').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(membership_description ==''){
		$('#cke_membership_description').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(error!=0){
		return false;
	}else{
			var params ={'id' : membr_ship_id,'title' : membership_name };
			$.ajax({
                    type: 'POST',
                    url: '<?php  echo site_url("superadmin/membership_plan/Get_title_Ajax"); ?>',
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
								   url: '<?php  echo site_url("superadmin/membership_plan/SaveAjax"); ?>',
								   data: params,
								   success: function(data){
								       var url = window.location.protocol + "//" + window.location.host + "/" ;
								       window.location = url+"superadmin/membership_plan/index/IsPreserved/Y";
								        }
								});
                            }else{
								$('#membership_name').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
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
	$('.required').val('');
	$('#feature_num').val('1');
	$('.membership_feature_hide').html('');
	CKEDITOR.instances.membership_description.setData('');
	$('.tab_listing').show();
	$('#add_new_link').show();
	$('#add_faq').hide();
}

function hide_show_tbl(){
	$('#ans_err').html('');
	$('#add_new_link').hide();
	$('#sub_faq').val('ADD');
	$('#edit_mode').html('<input type="text" name="membership_feature_1" id="membership_feature_1" value="" />&nbsp;&nbsp;<div id="hide_link_1" class="hide_add" style="text-align:right; width:67%;"><a href="javascript:void(0);" onclick="add_another_box();" ><img src="<?php echo base_url(); ?>images/Add-feature.png" alt="" title="Add Feature" />Add Another Feature</a></div><div id="add_new_feature1"></div><input type="hidden" name="feature_num" id="feature_num" value="1" />');
	$('.tab_listing').hide();
	$('#add_faq').show();
	CKEDITOR.instances.membership_description.setData('');
	$('#membership_type_id').val('');
	//////////////////////////////
	resetForm();
	$("#faq_frm input[type=text]").val('');
	CKEDITOR.instances.membership_description.setData('');	
}

function change_status(membership_type_id){
	$.ajax({
	   type: 'POST',
	   url: '<?php echo site_url("superadmin/membership_plan/ChangeStatusAjax"); ?>',
	   data: { 'membership_type_id' : membership_type_id },
	   success: function(data){
			$('#replace_status_'+membership_type_id).html(data);
		}
	});
}

function edit_plan(membership_type_id){
	$('.tab_listing').hide();
	$.ajax({
	   type: 'POST',
	   url: '<?php echo site_url("superadmin/membership_plan/EditAjax"); ?>',
	   dataType: 'json',
	   data: { 'membership_type_id' : membership_type_id },
	   success: function(data){
		    $('#add_faq').show();
			$('#sub_faq').val('Update');
			$('#membership_type_id').val(membership_type_id);
			$('#membership_name').val(data.membership_name);
			$('#membership_tagline').val(data.membership_tagline);
			$('#membership_amount').val(data.membership_amount);
			$('#membership_validity').val(data.membership_validity);
			$('#edit_mode').html(data.rplc_id);
			CKEDITOR.instances.membership_description.setData(data.membership_description);
			var jformId = $('#faq_frm');
			$('.required',jformId).each(function(){
				var jparent = $(this).parent();
				jparent.removeClass('error');
				$('span.error',jparent).hide();
			});
			$('#ans_err').html('');
			$('#add_new_link').hide();
		}
	});
}

function del_plan(membership_type_id,item_name){    
	var url = '<?=base_url()?>superadmin/membership_plan/index';
	var val ='MEMBERSHIP:: ';
	$.prompt("Delete "+val+" "+item_name+" ?",{
		callback: function(v,m,f){
			if(v){
				$.ajax({
				   type: 'POST',
				   url: '<?php echo site_url("superadmin/membership_plan/FindChildAjax"); ?>',
				   data: { 'membership_type_id' : membership_type_id },
				   success:function(rdata){
			                if(rdata == 1){
			                        alert('You cannot delete this item as it has child elements.');
			                        return false;
			                }else{
			                   //alert('You can delete this.');return false;
			                   Con_firm_Delete(url,membership_type_id,item_name,val);
			                }
				       }
				});
			}else{
				return false;
			}
		}
		,
		buttons:{Ok:true,Cancel:false},
		prefix:'extblue'
	});
}

function add_another_box(id){
	var id = $('#feature_num').val();
	var new_id = eval(id)+1;
	$('.hide_add').hide();
	$('#add_new_feature'+id).html('<input type="text" name="membership_feature_'+new_id+'" id="membership_feature_'+new_id+'" value="" />&nbsp;&nbsp;<div id="hide_link_'+new_id+'" class="hide_add" style="text-align:right; width:67%;"><a href="javascript:void(0);" onclick="add_another_box();"><img src="<?php echo base_url(); ?>images/Add-feature.png" alt="" title="Add Feature" />Add Another Feature</a></div><div id="add_new_feature'+new_id+'" class="membership_feature_hide" >');
	$('#hide_link_'+new_id ).show();
	$('#feature_num').val(new_id );
}

function delete_feature(membership_plan_feature_id,membership_type_id){
	var r = confirm('Are you sure you want to delete this feature ?');
	if(r == true){
		$.ajax({
			type: 'POST',
			url: '<?php echo site_url("superadmin/membership_plan/DeleteFeatureAjax"); ?>',
			dataType: 'html',
			data: { 'membership_plan_feature_id' : membership_plan_feature_id, 'membership_type_id' : membership_type_id},
			success: function(data){
				$('#edit_mode').html(data);
			}
		});
	}
}

function change_status_subs(plan_subscriptions_id){
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url("superadmin/membership_plan/SubscriptionChangeStatusAjax"); ?>',
		dataType: 'html',
		data: { 'plan_subscriptions_id' : plan_subscriptions_id },
		success: function(data){
			if(data == 0){
				alert('Some error occured.');
			}else{
				$('#replace_status_subs_'+plan_subscriptions_id).html(data);
			}	
		}
	});
}

function edit_subs(plan_subscriptions_id){
	$('#listing_subscription').hide();
	$('#add_subs').show();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url("superadmin/membership_plan/GetSubscriptionDataAjax"); ?>',
		dataType: 'json',
		data: { 'plan_subscriptions_id' : plan_subscriptions_id },
		success: function(data){
			var jformId = $('#subs_frm');
			$('.required',jformId).each(function(){
				var jparent = $(this).parent();
				jparent.removeClass('error');
				$('span.error',jparent).hide();
			});
			$('#ans_err_subs').html('');
			$('#plan_subscriptions_id').val(plan_subscriptions_id);
			CKEDITOR.instances.sub_plan_desc.setData(data.sub_plan_desc);
			$('#amount').val(data.amount);
			$('#validity').val(data.validity);
			$('#extra_validity').val(data.extra_validity);
			$('#sub_subs').val('Update');
		}
	});
}

function add_subs_pnl(){
	$('#add_new_link').hide();
	$('#add_subs_link').show();
}

function add_subscription(membership_type_id){
	$('#faq_listing').hide();
	$('#listing_subscription').show();
	$('#add_new_link').hide();
	$('#add_subs_link').show();
	$('#membership_plan_id').val(membership_type_id);
	$.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/membership_plan/SubscriptionListingAjax"); ?>',
		   dataType: 'html',
		   data: { 'membership_type_id' : membership_type_id },
		   success: function(data){
				$('#faq_listing').hide();
				$('#listing_subscription').html(data);
			}
	});
}

function hide_show_subs(){
	$('.tab_listing').hide();
	$('#add_subs').show();
	$('#plan_subscriptions_id').val('');
	CKEDITOR.instances.sub_plan_desc.setData('');
	$('#amount').val('');
	$('#validity').val('');
	$('#extra_validity').val('');
	$('#sub_subs').val('Add');
	$('#add_subs_link').hide();
	var jformId = $('#subs_frm');
	$('.required',jformId).each(function(){
		var jparent = $(this).parent();
		jparent.removeClass('error');
		$('span.error',jparent).hide();
	});
	$('#ans_err_subs').html('');
}

function submit_subs(){
	var editorText = CKEDITOR.instances.sub_plan_desc.getData();
	var hiddenId = $('#plan_subscriptions_id').val();
	var membership_type_id = $('#membership_plan_id').val();
	var error = 0;
	if($.trim(editorText) == ''){
		$('#ans_err_subs').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
		error++;
	}
	var jformId = $('#subs_frm');
	var formAction = jformId.attr('action');
	var jerror = $('<span class="error" style="color:#FF0000;"></span>');
	$('li',jformId).removeClass('error');
	$('span.error').remove();
	$('.required',jformId).each(function(){
		var inputVal = $(this).val();
		var jparentTag = $(this).parent();
		if($.trim(inputVal) == ''){
			jparentTag.addClass('error').append(jerror.clone().text('Required Field'));
			error++;
		}
	});
    if(error > 0){
        return false;
    }
	$('.required').each(function(){
		if($(this).attr('id') == 'amount'){
			var curr_pattern = /^\d+(?:\.\d{0,2})$/ ;
			var value = $(this).val();
			if(curr_pattern.test(value) == false) {
				var jparentTag = $(this).parent();
				jparentTag.addClass('error').append(jerror.clone().text('Invalid Currency Format.It should be in 0.00 format.'));
				error++;
			}
		}
		if($(this).attr('id') == 'validity'){
			var numbers = /^[0-9]+$/;
			var value = $(this).val();
			if(numbers.test(value) == false){
				var jparentTag = $(this).parent();
				jparentTag.addClass('error').append(jerror.clone().text('Validity should be numeric.'));
				error++;
			}
		}
		if($(this).attr('id') == 'extra_validity'){
			var numbers = /^[0-9]+$/;
			var value = $(this).val();
			if(numbers.test(value) == false){
			   var jparentTag = $(this).parent();
			   jparentTag.addClass('error').append(jerror.clone().text('Extra Validity should be numeric.'));
			   error++;
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
	}else{
		if(error == 0){
			var frmID='#subs_frm';
			var params ={ 'membership_type_id' : membership_type_id };
			var paramsObj = $(frmID).serializeArray();
			$.each(paramsObj, function(i, field){
				if(field.name == 'sub_plan_desc'){
					params[field.name] = editorText;
				}else{
					params[field.name] = $.trim(field.value);
				}	
			});
			$.ajax({
				   type: 'POST',
				   url: '<?php echo site_url("superadmin/membership_plan/SaveSubsAjax"); ?>',
				   data: params,
				   success: function(data){
						$('#listing_subscription').show();
						$('#listing_subscription').html(data);
						$('#add_subs').hide();
						$('#add_subs_link').show();
					}
			});
		}
	}
}

function cancl_subs(){
	$('#plan_subscriptions_id').val('');
	CKEDITOR.instances.sub_plan_desc.setData('');
	$('#amount').val('');
	$('#validity').val('');
	$('#extra_validity').val('');
	$('#sub_subs').val('Add');
	$('#add_subs').hide();
	$('#listing_subscription').show();
	$('#add_subs_link').show();
}

function del_subs(plan_subscriptions_id){
	var r = confirm('Are you sure you want to delete this subscription ?');
	if(r == true){
	var membership_type_id = $('#membership_plan_id').val();
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url("superadmin/membership_plan/DeleteSubsAjax"); ?>',
		data: { 'plan_subscriptions_id' : plan_subscriptions_id, 'membership_type_id' : membership_type_id },
		success: function(data){
		            $('#listing_subscription').html(data);
		    }
		});
	}
}

function back_mem(){
	$('#listing_subscription').hide();
	$('#faq_listing').show();
	$('#membership_plan_id').val('');
	$('#add_new_link').show();
	$('#add_subs_link').hide();
}

</script>