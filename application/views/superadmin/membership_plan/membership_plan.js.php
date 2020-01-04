<script type="text/javascript">
$(document).ready(function() {
	
	CKEDITOR.instances.membership_description.on('focus', function() {
		$('#ans_err').html("");
	});
//	$("#faq_frm input[type=text]").val('');
//	CKEDITOR.instances.membership_description.setData('');
	
	$("#faq_frm input[type=text],select,#faq_frm #cke_membership_description").focus(function(){
		$(this).removeAttr('style');
	});
	$('#already_exist').remove();
	
	
	
});

function submit_plan(){
	resetForm();
	$('#already_exist').remove();
	var membr_ship_id			= $('#plan_id').val();
	var membership_name			= $('#membership_name').val();
	var status					= $('#status').val();
	//var membership_validity		= $('#membership_validity').val();
	var is_multilocation		= $('#is_multilocation').val();
	//alert(is_multilocation);
	
	//var membership_description	= CKEDITOR.instances.membership_description.getData();
	var membership_description	= CKEDITOR.instances['membership_description'].getData();
	//var membership_amount		= $('#membership_amount').val();
	
	
	var error = 0;
	
	if(membership_name ==''){
		$('#membership_name').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	
	if(membership_description ==''){
		$('#cke_membership_description').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	
	
	if(status ==''){
		$('#status').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	
	/*
	if(membership_amount ==''|| isNaN(membership_amount)== true){
		$('#membership_amount').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(membership_validity =='' || isNaN(membership_validity)== true){
		$('#membership_validity').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	*/
	
	
	/*if(is_multilocation ==''){
		$('#is_multilocation').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}*/
	if(is_multilocation =='0'){
		$(".mul_loc_no").each(function (i){
			if($(this).val()==''){
				$(this).attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
				error++;	
				
			}					
		});	
	}
	if(is_multilocation =='1'){
		$(".mul_loc").each(function (i){
			if($(this).val()==''){
				$(this).attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
				error++;	
								
			}					
		});	
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
							$('#membership_name').after('<span id="already_exist" class="already-exist">Already Exist</span>');
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
	CKEDITOR.instances.membership_description.setData('');
	$('.tab_listing').show();
	$('#add_new_link').show();
	$('#add_faq').hide();
}

function hide_show_tbl(){
	$("#faq_frm input[type=text],select,#faq_frm #cke_membership_description").removeAttr('style');
	$('#already_exist').remove();
	$('.after-fst-tr').remove();
	$('#ans_err').html('');
	$('#add_new_link').hide();
	$('#sub_faq').val('ADD');
	$('.tab_listing').hide();
	$('#add_faq').show();
	$("#mul_loc_yes" ).hide();
	$("#location_num_3").hide();
	$("#location_num_2").hide();
	
	//$("#mul_loc_no" ).hide();
	$('#is_multilocation').val('');
	CKEDITOR.instances.membership_description.setData('');
	$('#plan_id').val('');
	//////////////////////////////
	resetForm();
	$("#faq_frm input[type=text]").val('');
	CKEDITOR.instances.membership_description.setData('');	
}



function edit_plan(plan_id){
	$('#already_exist').remove();
	$('.tab_listing').hide();
	$('.after-fst-tr').remove();
	$('.after-fst-tr-no').remove();
	$("#faq_frm input[type=text],select,#faq_frm #cke_membership_description").removeAttr('style');
	
	$.ajax({
	   type: 'POST',
	   url: '<?php echo site_url("superadmin/membership_plan/EditAjax"); ?>',
	   dataType: 'json',
	   data: { 'plan_id' : plan_id },
	   success: function(data){
		    $('#add_faq').show();
			$('#sub_faq').val('Update');
			$('#plan_id').val(plan_id);
			$('#membership_name').val(data.plan_name);
			//$('#membership_amount').val(data.plan_cost );
			//$('#membership_validity').val(data.plan_validity);
			$('#status').val(data.status);
			$('#is_multilocation').val(data.is_multilocation);
			var value1='';
			var set1='';
			var display='';
			obj=data.tierprice;
			if(data.is_multilocation ==1){
				$("#mul_loc_yes" ).show();
				$("#mul_loc_no" ).hide();
				$.each( obj, function( key, value ) {
					//alert( key + ": " + value.billing_cycle );
					var option_val=$("#loc_clone" ).clone().html();
					/*
					if(key == 3){
					alert('hiii');
						var set1=key;
						var value1='after-fst-tr-set-'+set1;
					}
					else{
						var value1='after-fst-tr-set-'+set1;
					}
					*/
					if(key !=1 && key !=2 && key !=3){
															
						if(value.billing_cycle =="monthly"){
							var label=	"Monthly";
							var billing_cycle_val="monthly";
						}
						else if(value.billing_cycle =="helf_yearly"){
							var label=	"Helf yearly";
							var billing_cycle_val="helf_yearly";
						}
						else if(value.billing_cycle =="yearly"){
							var label=	"Yearly";
							var billing_cycle_val="yearly";
						}
					
						var billing_cycle_val_html='<span>'+label+'</span><input type="hidden" value="'+value.billing_cycle+'" class="mul_loc" name="mul_loc['+key+'][billing_cycle]" id="billing_cycle_'+key+'">';
														
										
						$("#mul_loc_yes_table tr:last").after('<tr class="after-fst-tr '+value1+'" id="mul_loc_yes_tr_'+key+'"><td>'+billing_cycle_val_html+'</td><td><input class="mul_loc" onkeyup="updateOtherLocation(this.value,'+key+')" type="'+display+'" name="mul_loc['+key+'][location_num]" id="location_num_'+key+'"/></td><td><input class="mul_loc" type="'+display+'" onkeyup="updateOtherStaff(this.value,'+key+')" name="mul_loc['+key+'][staff_per_location]"  id="staff_per_location_'+key+'"/></td><td><input class="mul_loc" type="text" name="mul_loc['+key+'][price]" id="price_'+key+'"/></td><td><input class="mul_loc" type="text" name="mul_loc['+key+'][additional_cost_location]" id="additional_cost_location_'+key+'"/></td><td><input  type="'+del+'" id="del_'+key+'" class="remove_btn" onclick="delRow('+set1+')"  value="Delete"/></td></tr>');
					}
					if(key % 3 == 0){						
						set1= parseInt(key)+1;
						value1='after-fst-tr-set-'+set1;
						display		='text';
						del		='button';
					}
					else{
						value1='after-fst-tr-set-'+set1;
						display		='hidden';
						del			='hidden';
					}	
					$('#billing_cycle_'+key).val(value.billing_cycle);
					$('#location_num_'+key).val(value.location_num);
					$('#price_'+key).val(value.price);
					$('#staff_per_location_'+key).val(value.staff_per_location);
					$('#additional_cost_location_'+key).val(value.additional_cost_location);
					
					var next_value= parseInt(key)+1;
					$('#mul_loc_yes_hdn').val(next_value);
				});				
			}
			else if(data.is_multilocation ==0){
				$("#mul_loc_yes" ).hide();
				$("#mul_loc_no" ).show();
				hdn_val='';
				$.each( obj, function( key, value ) {
					//alert( key + ": " + value.billing_cycle );
					var option_val=$("#loc_clone" ).clone().html();
					/*if(key !=1){					
						$("#mul_loc_no_table tr:last").after('<tr class="after-fst-tr-no" id="mul_loc_no_tr_'+key+'"><td><select class="mul_loc_no" name="mul_loc_no['+key+'][billing_cycle]" id="billing_cycle_no_'+key+'">'+option_val+'</select></td><td><input class="mul_loc_no" type="text" name="mul_loc_no['+key+'][price]" id="price_no_'+key+'"/></td><td><input  type="button" id="del_no'+key+'" class="remove_btn" onclick="delRowNo('+key+')"  value="Delete"/></td></tr>');	
					}	
					*/
					$('#billing_cycle_no_'+key).val(value.billing_cycle);					
					$('#price_no_'+key).val(value.price);
					$('#staff_per_location_no_'+key).val(value.staff_per_location);
					$('#additional_cost_location_no_'+key).val(value.additional_cost_location);
					
					var next_value= parseInt(key)+1;
					$('#mul_loc_no_hdn').val(next_value);
				});
				//alert(obj.length);				
			}	
												 		
			//alert(data.tierprice.tierprice_id)			
			CKEDITOR.instances.membership_description.setData(data.plan_desc);			
			$('#ans_err').html('');
			$('#add_new_link').hide();
		}
	});
}

function prepareMultilocation(value){	
	if(value ==1){		
		$('#mul_loc_yes').show();
		$('#mul_loc_no').hide();
	}
	else if(value ==0){
		$('#mul_loc_no').show();
		$('#mul_loc_yes').hide();		
	}
	
}
function addNext(){	
	var value1=$('#mul_loc_yes_hdn').val();	
	//var option_val=$("#loc_clone" ).clone().html();	
	
	var last_value= parseInt(value1)+3;
	//alert(last_value);
	//return false;
	var counter=1;
	for ( var value = value1; value < last_value; value++ ) {
	
		if(counter ==1){
			var label=	"Monthly";
			var billing_cycle_val="monthly";
			var display		='text';
			var del		='button';
			
		}
		else if(counter ==2){
			var label=	"Helf yearly";
			var billing_cycle_val="helf_yearly";
			var display		='hidden';
			var del		='hidden';
		}
		else if(counter ==3){
			var label=	"Yearly";
			var billing_cycle_val="yearly";
			var display		='hidden';
			var del		='hidden';
		}
		
		var billing_cycle_val_html='<span>'+label+'</span><input type="hidden" value="'+billing_cycle_val+'" class="mul_loc" name="mul_loc['+value+'][billing_cycle]" id="billing_cycle_'+value+'">';
		
			
		$("#mul_loc_yes_table tr:last").after('<tr class="after-fst-tr after-fst-tr-set-'+value1+'" id="mul_loc_yes_tr_'+value+'"><td>'+billing_cycle_val_html+'</td><td><input  onkeyup="updateOtherLocation(this.value,'+value+');checkNum(event,this.id)" class="mul_loc" type="'+display+'" name="mul_loc['+value+'][location_num]" id="location_num_'+value+'"/></td><td><input class="mul_loc" type="'+display+'" onkeyup="updateOtherStaff(this.value,'+value+');checkNum(event,this.id)"  name="mul_loc['+value+'][staff_per_location]" id="staff_per_location_'+value+'"/></td><td><input class="mul_loc" type="text" name="mul_loc['+value+'][price]" id="price_'+value+'" onkeyup="checkNum(event,this.id)"/></td><td><input class="mul_loc" type="text" name="mul_loc['+value+'][additional_cost_location]" id="additional_cost_location_'+value+'" onkeyup="checkNum(event,this.id)"/></td><td><input  type="'+del+'" id="del_'+value+'" class="remove_btn" onclick="delRow('+value1+')"  value="Delete"/></td></tr>');
		counter=counter + 1;	
	}
		
	var next_value= parseInt(value)+1;
	$('#mul_loc_yes_hdn').val(next_value);
	$("#faq_frm input[type=text],select,#faq_frm #cke_membership_description").focus(function(){
		$(this).removeAttr('style');
	});
}
function addNextNo(){	
	var value=$('#mul_loc_no_hdn').val();	
	var option_val=$("#billing_cycle_no_1" ).clone().html();		
	$("#mul_loc_no_table tr:last").after('<tr class="after-fst-tr-no" id="mul_loc_no_tr_'+value+'"><td><select class="mul_loc_no" name="mul_loc_no['+value+'][billing_cycle]" id="billing_cycle_'+value+'">'+option_val+'</select></td><td><input class="mul_loc_no" type="text" name="mul_loc_no['+value+'][price]" id="price_'+value+'"/></td><td><input  type="button" id="del_no'+value+'" class="remove_btn" onclick="delRowNo('+value+')"  value="Delete"/></td></tr>');		
	var next_value= parseInt(value)+1;
	$('#mul_loc_no_hdn').val(next_value);
	$("#faq_frm input[type=text],select,#faq_frm #cke_membership_description").focus(function(){
		$(this).removeAttr('style');
	});
}
function delRow(value){	
	$('.after-fst-tr-set-'+value).remove();	
}	
function delRowNo(value){	
	$('#mul_loc_no_tr_'+value).remove();	
}
function back_mem(){
	$('#listing_subscription').hide();
	$('#faq_listing').show();
	$('#membership_plan_id').val('');
	$('#add_new_link').show();
	$('#add_subs_link').hide();
}

</script>
<script>
	function updateOtherLocation(loc_val,loc_id){
		var loc_id1=parseInt(loc_id)+1;
		var loc_id2=parseInt(loc_id)+2;
		$('#location_num_'+loc_id1).val(loc_val);
		$('#location_num_'+loc_id2).val(loc_val);
		
	}
	function updateOtherStaff(loc_val,loc_id){
		var loc_id1=parseInt(loc_id)+1;
		var loc_id2=parseInt(loc_id)+2;
		$('#staff_per_location_'+loc_id1).val(loc_val);
		$('#staff_per_location_'+loc_id2).val(loc_val);
		
	}
	
	function ConfirmDelete(url,delete_id,delete_name,delete_lebel_name,delete_category_id)
	{
		
		if (confirm("Are you sure to delete "+delete_lebel_name+" "+delete_name+" ?")) {
			url=url+'/record_id/'+delete_id+'/IsPreserved/Y';
			//$('#TransMsgDisplay').html('<img src="'+admin_fpath+'images/indicator.gif" align="center">');
			var params ={
			'module': 'membership_plan',
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
<script type="text/javascript">
	function checkNum(key,id){
		 //getting key code of pressed key
		var keycode = (key.which) ? key.which : key.keyCode;
		//comparing pressed keycodes
		if (!(keycode==8 || keycode==46)&&(keycode < 48 || keycode > 57)&&(keycode<96 || keycode>105))
		{
			$('#'+id).val('');
		}
		
		
		
	}
</script>