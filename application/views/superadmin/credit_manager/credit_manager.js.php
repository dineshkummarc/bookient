<!-- JavaScript -->
	<script type="text/javascript">
		j(document).ready(function() {


			
			j('.required').focus(function(){
				var jparent = j(this).parent();
				jparent.removeClass('error');
				j('span.error',jparent).hide();
			});

			j('#package_name').focus(function(){
				j('#ans_err').html('');
			});

		

			j('#amount').focus(function(){
				j('#ans_err2').html('');
			});
			
			j('#credit').focus(function(){
				j('#ans_err3').html('');
			});



	        CKEDITOR.instances.description.on('focus', function() {
	            j('#ans_err1').html("");
	        });
			
			
			$("#amount,#credit").bind("keypress", function(event) { 
    			var charCode = event.which;
   				if (charCode <= 13) return true; 
   	 				var keyChar = String.fromCharCode(charCode); 
   	 			return /[0-9.]/.test(keyChar); 
   			});






		});
	</script>


<script type="text/javascript">



	function submit_credit(){
		var action = j("#action").val();
		var id = j('#credit_id').val();
		
		var regex = /(<([^>]+)>)/ig;
		var error = 0;
		var	credit_title = j("#package_name").val();
		credit_title = credit_title.replace(regex, "").replace(/&nbsp;/gi,'');
        credit_title = j.trim(credit_title);
		
		var editorText = CKEDITOR.instances.description.getData();
		var editorText = editorText.replace(regex, "").replace(/&nbsp;/gi,'');
        editorText = j.trim(editorText);
		
		var amount = j("#amount").val();
		var credit = j("#credit").val();
		
		if(credit_title == '' || editorText == '' || amount == '' || credit == ''){
		
			if(credit_title == ''){
				j('#ans_err').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
			}
			if(editorText == '')
			{
				j('#ans_err1').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
				error = 1;
			}
			if(amount == ''){
				j('#ans_err2').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
			}
			if(credit == ''){
				j('#ans_err3').html('<span style="color:#FF0000; font-size:10px;">Required Field</span>');
			}
			return false;
		}
		else{
			
			var params;
			if(action == "Add"){
				var params = {credit_title:credit_title,editorText:editorText,amount:amount,credit:credit,action:action};
			}
			if(action == "Edit"){
				var credit_id = j("#credit_id").val();
				var params = {credit_title:credit_title,editorText:editorText,amount:amount,credit:credit,action:action,credit_id:credit_id};
			}
			
			j.ajax({
				   type: 'POST',
				   url: '<?php echo site_url("superadmin/credit_manager/SaveAjax"); ?>',
				   data: params,
				   success: function(data){
				 
                              var url = window.location.protocol + "//" + window.location.host + "/" ;
                              window.location = url+"superadmin/credit_manager/index/IsPreserved/Y";


					}
							});
		}
		
		
		
		
		
	}

</script>

<script type="text/javascript">
function hide_show_tbl()
{

	j('#credit_id').val('');
	j('.tab_listing').hide();
	j('#credit_rate').hide();
	j('#new_rate').hide();
	j('#add_faq').show();
	j('.required').val('');
	CKEDITOR.instances.description.setData('');

    var jformId = j('#faq_frm');
	j('.required',jformId).each(function(){
		var jparent = j(this).parent();
		jparent.removeClass('error');
		j('span.error',jparent).hide();
	});
	j('#ans_err').html('');
	j('#ans_err1').html('');
	j('#add_new_link').hide();



	j("#sub_faq").attr('value', 'Add');
	j("#action").attr('value', 'Add');
	j("#credit_id").attr('value', '');




}
</script>

<script type="text/javascript">
function change_status(id)
{
	/*j.ajax({
		   type: 'POST',
		   url: '<?php //echo site_url("superadmin/credit_manager/ChangeStatusAjax"); ?>',
		   data: { 'smscall_dtls_id' : id },
		   success: function(data){
				j('#replace_status_'+id).html(data);
			}
	});*/
}
</script>

<script type="text/javascript">

function edit_credit(id)
{         
	
	j('.tab_listing').hide();
	j('span .error').text('');



	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/EditAjax"); ?>',
		   dataType: 'json',
		   data: { 'credit_id' : id },
		   success: function(data){
		   		//alert(data);
				//return false;
			    j('#add_faq').css('display','block');
				j('#sub_faq').val('Update');
				j('#credit_id').val(data.credit_id);
				j('#package_name').val(data.package_name);
				j('#amount').val(data.base_amt);
				j('#credit').val(data.credits);
			
				CKEDITOR.instances.description.setData(data.package_desc);
				
				j('#add_new_link').hide();
				var frmID='#faq_frm';
				j('.required',frmID).each(function(){
						//alert ( j(this).next().text());
						j(this).next().text('');
						j('#ans_err').html('');
				});



				j("#sub_faq").attr('value', 'Update');
				j("#action").attr('value','Edit');


			}
	});
}
</script>



<script type="text/javascript">
function cancl_credit()
{
	j('.tab_listing').show();
	j('#add_faq').hide();
	j('#add_new_link').show();
}
</script>

<script type="text/javascript">
function add_credit_rate(id)
{

	j('#credit_rate').show();
	j('#faq_listing').hide();
	j('#add_new_link').hide();
	j.ajax({
		   type: 'POST',
		   url: '<?php //echo site_url("superadmin/credit_manager/EditRateAjax"); ?>',
		   dataType: 'html',
		   data: { 'smscall_dtls_id' : id },
		   success: function(data){
				j('#credit_rate').html(data);
				j('#show-tab tbody').paginate({
					status: j('#status'),
					controls: j('#paginate'),
					itemsPerPage: 5
			    });

			}
	});
}
function back_credit()
{
	j('#credit_rate').hide();
	j('#faq_listing').show();
	j('#add_new_link').show();

}
</script>

<script type="text/javascript">
function edit_rate(id)
{

	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/GetRateValAjax"); ?>',
		   dataType: 'json',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				j('#edit_span_call_'+id).html('<input type="text" style="width:50px;" name="call_rate_e" id="call_rate_e" value="'+data.call_rate+'" />&nbsp;<a href="javascript:void(0);" onclick="save_edited_rate_call(\''+id+'\')" style="position:relative; top:2px;"><img src="<?php echo base_url(); ?>images/save.png" alt="Edit" title="Edit" /></a>&nbsp;<a href="javascript:void(0);" onclick="cancel_edited_rate_call(\''+id+'\')" style="position:relative; top:2px;"><img src="<?php echo base_url(); ?>images/cancel.png" alt="Edit" title="Edit" /></a>');
				j('#edit_span_sms_'+id).html('<input type="text" style="width:50px;" name="sms_rate_e" id="sms_rate_e" value="'+data.sms_rate+'" />&nbsp;<a href="javascript:void(0);" onclick="save_edited_rate_sms(\''+id+'\')" style="position:relative; top:2px;"><img src="<?php echo base_url(); ?>images/save.png" alt="Edit" title="Edit" /></a>&nbsp;<a href="javascript:void(0);" onclick="cancel_edited_rate_sms(\''+id+'\')" style="position:relative; top:2px;"><img src="<?php echo base_url(); ?>images/cancel.png" alt="Edit" title="Edit" /></a>');

                                j("#sms_rate_e").maskMoney();
                                j("#call_rate_e").maskMoney();

	           }
	});

}
</script>

<script type="text/javascript">
function delete_rate(id,dtls_id)
{
	var r = confirm('Are you sure you want to delete this credit ?');

	if(r == true)
	{
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/credit_manager/DeleteCreditRateAjax"); ?>',
			   dataType: 'html',
			   data: { 'smscall_rate_dtls_id' : id, 'smscall_dtls_id' : dtls_id },
			   success: function(data){
					j('#credit_rate').show();
					j('#credit_rate').html(data);
				}
		});
	}
}
</script>


<script type="text/javascript">
function add_new_rate(smscall_dtls_id)
{
	j('#package_id').val(smscall_dtls_id);
	j('#credit_rate').hide();
	j('#new_rate').show();

	j('#sms_rate').val('');
	j('#call_rate').val('');

	//j('#country_id option:selected').text('');
	//j("#yourdropdownid option:selected").text();
	j('#country_id option:first-child').attr("selected", "selected");
	j('#country_id_error').html('');
	j('#sms_rate_error').html('');
	j('#call_rate_error').html('');
        j('#sms_rate').maskMoney();
	j('#call_rate').maskMoney();


}
function hide_new_rate()
{
	j('#credit_rate').show();
	j('#new_rate').hide();
}
</script>
<script type="text/javascript">
function save_call_rate()
{
	var country_id = j('#country_id').val();
	var call_rate = j('#call_rate').val();
	var smscall_dtls_id = j('#package_id').val();
	var error=0;

	if(country_id == '')
	{
		j('#country_id_error').html('<span id="err_coun" style="color:#FF0000;">Required Field</span>');
		error=1;
	}

	if(j.trim(call_rate) == '')
	{
		j('#call_rate_error').html('<span id="err_cll_rate" style="color:#FF0000;">Required Field</span>');
		error=1;
		return false;
	}

	 var curr_pattern = /^\d+(?:\.\d{0,2})j/ ;
	 if(curr_pattern.test(call_rate) == false)
	 {
		j('#call_rate_error').html('<span style="color:#FF0000;">Invalid Currency Format.It should be in 0.00 format.</span>');
		error=1;
	 }

	if(error==0)
	{
		j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/save_call_rate_ajax"); ?>',
		   dataType: 'html',
		   data: { 'smscall_dtls_id' : smscall_dtls_id, 'country_id' : country_id, 'call_rate' : call_rate },
		   success: function(data){
			    j('#new_rate').hide();
				j('#credit_rate').show();
				j('#credit_rate').html(data);
			}
		});
	}
}
</script>

<script type="text/javascript">
function cancel_call_rate()
{

}
</script>

<script type="text/javascript">
function save_sms_rate()
{
	var country_id = j('#country_id').val();
	var sms_rate = j('#sms_rate').val();
	var smscall_dtls_id = j('#package_id').val();
	var error=0;

	if(country_id == '')
	{
		j('#country_id_error').html('<span style="color:#FF0000;">Required Field</span>');
		error=1;
	}

	if(j.trim(sms_rate) == '')
	{
		j('#sms_rate_error').html('<span style="color:#FF0000;">Required Field</span>');
		error=1;
		return false;

	}
	 var curr_pattern = /^\d+(?:\.\d{0,2})j/ ;
	 if(curr_pattern.test(sms_rate) == false)
	 {
		j('#sms_rate_error').html('<span style="color:#FF0000;">Invalid Currency Format.It should be in 0.00 format.</span>');
		error=1;
	 }

	if(error==0)
	{
		j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/save_sms_rate_ajax"); ?>',
		   dataType: 'html',
		   data: { 'smscall_dtls_id' : smscall_dtls_id, 'country_id' : country_id, 'sms_rate' : sms_rate },
		   success: function(data){
			    j('#new_rate').hide();
				j('#credit_rate').show();
				j('#credit_rate').html(data);
			}
		});
	}
}
</script>

<script type="text/javascript">
function cancel_sms_rate()
{

}
</script>

<script type="text/javascript">
function change_status_rate(id)
{
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/ChangeStatusRateAjax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				j('#rate_status_'+id).html(data);
			}
	});
}
</script>

<script type="text/javascript">
function save_edited_rate_call(id)
{
	var call_val = j('#call_rate_e').val();
	var error_count = 0;
	if(j.trim(call_val) == ""){
		alert('Required Field');
		error_count++;
		return false;
	}
	 var curr_pattern = /^\d+(?:\.\d{0,2})j/ ;
	 if(curr_pattern.test(call_val) == false)
	 {
		alert('Invalid Currency Format.It should be in 0.00 format.');
		error_count++;

	 }

	if(error_count == 0) {
		j.ajax({
			   type: 'POST',
			   url: '<?php echo site_url("superadmin/credit_manager/save_edited_rate_call_ajax"); ?>',
			   data: { 'smscall_rate_dtls_id' : id, 'call_rate' : call_val },
			   success: function(data){
					j('#edit_span_call_'+id).html(data);
			   }
		});
	}
}
</script>

<script type="text/javascript">
function cancel_edited_rate_call(id)
{
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/cancel_edited_rate_call_ajax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				j('#edit_span_call_'+id).html(data);
		   }
	});
}
</script>

<script type="text/javascript">
function save_edited_rate_sms(id)
{

	var sms_val = j('#sms_rate_e').val();
        var error_count = 0;
        if(j.trim(sms_val) == ""){
		alert('Required Field');
		error_count++;
		return false;
	}
	 var curr_pattern = /^\d+(?:\.\d{0,2})j/ ;
	 if(curr_pattern.test(sms_val) == false)
	 {
		alert('Invalid Currency Format.It should be in 0.00 format.');
		error_count++;

	 }
        if(error_count == 0) {
            j.ajax({
                       type: 'POST',
                       url: '<?php echo site_url("superadmin/credit_manager/save_edited_rate_sms_ajax"); ?>',
                       data: { 'smscall_rate_dtls_id' : id, 'sms_rate' : sms_val },
                       success: function(data){
                                    j('#edit_span_sms_'+id).html(data);
                       }
            });
        }
}
</script>

<script type="text/javascript">
function cancel_edited_rate_sms(id)
{
	j.ajax({
		   type: 'POST',
		   url: '<?php echo site_url("superadmin/credit_manager/cancel_edited_rate_sms_ajax"); ?>',
		   data: { 'smscall_rate_dtls_id' : id },
		   success: function(data){
				j('#edit_span_sms_'+id).html(data);
		   }
	});
}




	function del_credit(url,id,item_name){
		
		//var url = '<?=base_url()?>superadmin/credit_manager/index';
   		var val ='PACKAGE:: ';
		
		if (confirm("Are you sure to delete "+val+" "+item_name+" ?")) {
		
					j.ajax({
                           type: 'POST',
                         //  url: '<?php echo site_url("superadmin/credit_manager/FindChildAjax"); ?>',
						 	url: url,
                           data: { 'credit_id' : id,'action':'delete'},
                           success: function(rdata){
                                    alert(rdata);

                                      /*  if(rdata == 1)
                                        {
                                                alert('You cannot delete this item as it has child elements.');
                                                return false;
                                        }
                                        else {
                                           //alert('You can delete this.');return false;
                                           Con_firm_Delete(url,id,item_name,val);
                                        }*/
                                }
                     });
			
		}
	}

</script>


