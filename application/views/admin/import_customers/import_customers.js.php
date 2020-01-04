<script type="text/JavaScript">

$(document).ready(function(){ 
	$("#import_customers").click(function(){
	var data = new FormData();
	jQuery.each($('#csvFile')[0].files, function(i, file) {
		data.append('file-'+i, file);
	});
	//var file = $('#csvFile').val();

	var errorcount=0;
	
	if(errorcount ==0){
	$('<img id="imgProcess" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>').insertAfter("#import_customers");
	//$("#import_customers").hide();
	
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
					   url: "<?php echo base_url(); ?>admin/import_customers/import_customers_ajax",
					   //data: {'file': file},
					   data: data,
						cache: false,
						contentType: false,
						processData: false,
						success: function(rdata){ 
							$("#imgProcess").remove();
							//$("#import_customers").show();
							$("#msgInsert").html('Insert Successfull');
						}
					});
				}
			//check login end
			}  
		});
		
	}else{
		return false;
	}	
	})
})




	function import_customers()
	{
		var $formId = $('#form-import-cust');
		var formAction = $formId.attr('action');
		var $error = $('<span class="error" style="color:#FF0000;"></span>');
		var errorval = 1;
		
		$('li',$formId).removeClass('error');
		$('span.error').remove();							 
		$('.required',$formId).each(function(){
		//CB#SOG#15-11-2012#PR#S
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
		});	
		
		var file = $("#csvFile").val();
		
		$.ajax({
			  type: 'POST',
			  datatype:'html',
			  url: "<?php echo base_url(); ?>admin/import_customers/import_customers_ajax",
			  data: {'file' : $.trim(file)},
			  success:function(rdata)
			  { 
					if(rdata == 0)
					{
						$('.show_error').html('');
						$('#success').html('<span style="color:#FF0000;font-size:10px;">Password change failed!Try agnain later.</span>');
					}
					else if(rdata == 1)
					{
						$('.show_error').html('');
						$('#success').html('<span style="color:#063;font-size:10px;">Password change successful.</span>');
					}
					else if(rdata == 2)
					{
						$('.show_error').html('');
						$('#confirm_error').html('<span style="color:#FF0000;font-size:10px;">Confirm password does not match.</span>');
					}
					else if(rdata == 3)
					{
						$('.show_error').html('');
						$('#current_error').html('<span style="color:#FF0000;font-size:10px;">Current password does not match.</span>');
					}
			  }
		});
	}

</script>