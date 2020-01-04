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
	
	    //alert('he');		
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
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
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
						$parentTag.addClass('error').append($error.clone().text('Enter digit please'));
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
    
	
	  type: 'POST',
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/ajax_check'); ?>",
	  data:"id="+id,
       success:function(rdata)
        { var data = rdata.split("@@@");
         
		 $("#region_id").html(data[0]);
		 $("#city_id").html('<option value="">select</option>');
		  $("#hm1").val(data[1]);
		  $("#wp1").val(data[1]);
		  $("#mp1").val(data[1]);
		
		}
	

	});
	}
	function re(id){
//alert("hi");
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
	function changeEmail(name){
	//alert("hello");
	var email=$("#current_email").html();
	//alert(email);
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
	
   // $("#afterClick").show();
  
   }
   function change_password(){
	//alert("hello");
	//var email=$("#current_email").html();
	//alert(email);
	$.ajax({
    
	
	  type: 'POST',
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/change_password'); ?>",
	  //data:"name="+email,
      success:function(rdata)
        { 
			 $("#change_password").hide();
			 $("#afterClick_password").show();
			 $("#afterClick_password").html(rdata);
		}
	

	});
	
  
  
   }
   function cancel(){
	//alert("hello");
	
         $("#change_email").show();
		 $("#afterClick").hide();
		
		
	
   // $("#afterClick").show();
  
   }
   function cancel_change(){
	//alert("hello");
	
         $("#change_password").show();
		 $("#afterClick_password").hide();
		
		
	
   // $("#afterClick").show();
  
   }
   function save(){
   var email=$("#emailbox").val();
   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
   if(email=='')
   {$("#error").show();
   $("#error").html('please enter your email_id');
   }
	//alert(email);
	else if(!emailReg.test(email))
	{$("#error").show();
	$("#error").html('please enter valid email_id');
	}
	else
	{
	
         $.ajax({
    
	
	  type: 'POST',
	  datatype:'html',
	  url:"<?php echo site_url('admin/myaccount/save_email'); ?>",
	  data:"email="+email,
       success:function(rdata)
        {
			if(rdata == 0)
			{
				alert('Failed to update details!Try again later');
			}
			$("#error").hide();
			$("#afterClick").hide();
			$("#change_email").show();
			$("#current_email").html(rdata);
				
					 //$("#change_email").hide();
		 //$("#afterClick").show();
		 //$("#afterClick").html(rdata);
		
		}
	

	         });
	
		}
	
   // $("#afterClick").show();
  
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
	var old_password=$("#old").val();
    var new_password=$("#new").val();
	var confirm_password=$("#confirm").val();
    var minimum=5;
   if($.trim(old_password)=='')
   {
	   $("#error_old").show();
	   $("#error_old").html('Required Field');
   }
   else if($.trim(old_password).length<=minimum)
   {
	   $("#error_old").html('Password length should be minimum 6 characters');
   }
   else if($.trim(new_password)=='')
   {
	   $("#error_old").hide();
	   $("#error_new").show();
	   $("#error_new").html('Required Field');
   }
   else if($.trim(new_password).length<=minimum)
   {
	   $("#error_new").html('Password length should be minimum 6 characters');
   }
   else if($.trim(confirm_password)=='')
   {
		$("#error_new").hide()
		$("#error_confirm").show();
		$("#error_confirm").html('Required Field');
   }
   else if($.trim(confirm_password).length<=minimum)
   {
	   $("#error_confirm").html('Password length should be minimum 6 characters');
   }
   else if($.trim(confirm_password)!=new_password)
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
					$("#success").html("password changed");
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




<script type="text/javascript">


function show-pass(){
	("#show-pass").show();
}

</script>