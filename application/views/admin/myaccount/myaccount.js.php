<script src="<?php  echo base_url(); ?>js/jquery-1.7.1.min.js"></script>
<script type="text/JavaScript">
$(document).ready(function(){
    $('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});
}); 
</script>
<script type="text/JavaScript">
   function submit_data() { 
		var $formId = '#myaccount';
		//var formAction = $formId.attr('action');
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var intRegex = /^\d+$/;
		var $error = $('<span class="error"></span>');
		var errorcount = 0;

		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();

		// Validate all inputs with the class "required"
		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if($.trim(inputVal) == ''){
				$parentTag.addClass('error').append($error.clone().text("<?php echo $this->global_mod->db_parse($this->lang->line('req_fld')); ?>"));
				errorcount++;
			}		
		});
		if(errorcount < 1) {
			$('.required',$formId).each(function(){
				var inputVal = $(this).val();
				var $parentTag = $(this).parent();
				
				if($(this).hasClass('digit') == true){
				var value = inputVal.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
					if(!intRegex.test(inputVal)){
						$parentTag.addClass('error').append($error.clone().text("<?php echo  $this->global_mod->db_parse($this->lang->line('enter_digit_pls')); ?>"));
						errorcount++;
					}
				}
			});
		}	
		if(errorcount == 0) {
			$('#myaccount').submit();
		}
		// Prevent form submission
			//e.preventDefault();
	
	
	
}
</script>
<script>
function st(id){
//alert("hi");

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
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/ajax_check'); ?>",
	  data:"id="+id,
       success:function(rdata)
        { var data = rdata.split("@@@");
         
		 $("#region_id").html(data[0]);
		 $("#city_id").html('<option value="">select</option>');
		  $("#hm1").html(data[1]);
		  $("#wp1").html(data[1]);
		  $("#mp1").html(data[1]);
		
		}
	

	});
		}
	//check login end
	}  
});
	}
	function re(id){

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
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/ajax_region_check'); ?>",
	  data:"id="+id,
       success:function(rdata)
        { 
         
		 $("#city_id").html(rdata);
		
		}
	

	});
		}
	//check login end
	}  
});
	}
	function changeEmail(name){

	var email=$("#current_email").html();


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
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/change_email'); ?>",
	  data:"name="+email,
       success:function(rdata)
        { 
         $("#change_email").hide();
		 $("#afterClick").show();
		
		 $("#afterClick").html(rdata);
		
		}
	

	});
		}
	//check login end
	}  
});
  
   }
   function change_password(){
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
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/change_password'); ?>",
      success:function(rdata)
        { 
			 $("#change_password").hide();
			 $("#afterClick_password").show();
			 $("#afterClick_password").html(rdata);
		}
	});
		}
	//check login end
	}  
});
	

   }
   function cancel(){

         $("#change_email").show();
		 $("#afterClick").hide();

   }
   function cancel_change(){

         $("#change_password").show();
		 $("#afterClick_password").hide();

   }
   function save(){
   var email=$("#emailbox").val();
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
   if(email=='')
   {$("#error").show();
   $("#error").html("<?php echo  $this->global_mod->db_parse($this->lang->line('pls_entr_emailid')); ?>");
   }
	//alert(email);
	else if(!emailReg.test(email))
	{$("#error").show();
	$("#error").html("<?php echo  $this->global_mod->db_parse($this->lang->line('pls_entr_valid_emailid')); ?>");
	}else{
	
        
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
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/save_email'); ?>",
	  data:"email="+email,
       success:function(rdata)
        {
			if(rdata == 0)
			{
				alert("<?php echo  $this->global_mod->db_parse($this->lang->line('failed_update_details')); ?>");
			}
			$("#error").hide();
			$("#afterClick").hide();
			$("#change_email").show();
			$("#current_email").html(rdata);

		}
	

	         });
		}
	//check login end
	}  
});
	
		}  
   }

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
	var old_password=$("#old").val();
    var new_password=$("#new").val();
	var confirm_password=$("#confirm").val();
    var minimum=5;
   if($.trim(old_password)=='')
   {
	   $("#error_old").show();
	   $("#error_old").html("<?php echo  $this->global_mod->db_parse($this->lang->line('req_fld')); ?>");
   }
   else if($.trim(old_password).length<=minimum)
   {
	   $("#error_old").html("<?php echo  $this->global_mod->db_parse($this->lang->line('passrd_lngth')); ?>");
   }
   else if($.trim(new_password)=='')
   {
	   $("#error_old").hide();
	   $("#error_new").show();
	   $("#error_new").html("<?php echo  $this->global_mod->db_parse($this->lang->line('req_fld')); ?>");
   }
   else if($.trim(new_password).length<=minimum)
   {
	   $("#error_new").html("<?php echo  $this->global_mod->db_parse($this->lang->line('passrd_lngth')); ?>");
   }
   else if($.trim(confirm_password)=='')
   {
		$("#error_new").hide()
		$("#error_confirm").show();
		$("#error_confirm").html("<?php echo  $this->global_mod->db_parse($this->lang->line('req_fld')); ?>");
   }
   else if($.trim(confirm_password).length<=minimum)
   {
	   $("#error_confirm").html("<?php echo  $this->global_mod->db_parse($this->lang->line('passrd_lngth')); ?>");
   }
   else if($.trim(confirm_password)!=new_password)
   {
		$("#error_new").show();
		$("#error_new").html("<?php echo  $this->global_mod->db_parse($this->lang->line('new_passrd_nt_match')); ?>");
		$("#error_confirm").html("<?php echo  $this->global_mod->db_parse($this->lang->line('cnfrm_passrd_nt_match')); ?>");
   }else{
		
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
			  datatype:'html',
			  url:"<?php echo site_url('admin/myaccount/save_password'); ?>",
			  data:"old="+$.trim(old_password)+"&new="+$.trim(new_password),
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
					$("#success").html("<?php echo  $this->global_mod->db_parse($this->lang->line('passwrd_changd')); ?>");
				}
				else
				{
					$("#error_old").show();
					$("#error_old").html("<?php echo  $this->global_mod->db_parse($this->lang->line('pls_entr_passwrd_crrectly')); ?>");
				}
			}
			});
		}
	//check login end
	}  
});
	}
   }

</script>




<script type="text/javascript">


function show_pass(){
	("#show-pass").show();
}

</script>
<script>
	$(function() {
		$('.tooltips').mouseover(function() {			
			var contentId	=$(this).attr('contentId');		
			var content		=tooltipsContent(contentId);
			var contentHtml	='<span class="tooltips-content" ><span class="t-arrow1"></span>'+content+'</span>';		
			$(this).append(contentHtml);
		});
		$('.tooltips').mouseout(function()
	    {
	       $(this).find("span").remove();
	    });
		
	});

	function tooltipsContent(contentId)
	{
		if(contentId==1)
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('myacc_email_explain'));?>";	
		}

		return content;
	}
</script>