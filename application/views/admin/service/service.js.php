<script language="javascript">
$(function(){
		  $(".switch").click(function(){
									  $(".fld").hide()
									  $(this).parent().find("a").show()
									  $(this).hide()
									  $("#"+$(this).attr("rel")).show()
									  if($(this).attr("rel") == "category_1")
									  {

										  $('#hdn').val(1);
									  }else{
										   $('#hdn').val(0);
									  }
									  });
		  /*$(".switch_1").click(function(){
									  $(".hid").hide()
									  $(this).parent().find("a").show()
									  $(this).hide()
									  $("#"+$(this).attr("rel")).show()
									  });
		  $("#no_cost").click(function(){
									   if ($('#no_cost').attr('checked')) {
										   $('#service_cost').attr('readonly', 'readonly');
										   $('#service_cost').val(0);
									   }
									   else{
										   $('#service_cost').removeAttr('readonly');
										   $('#service_cost').removeAttr('value');
									   }
									  });*/
		  });
		  
	function changeme(){
		if ($('#no_cost').is(':checked')) {
		   $('#service_cost').attr('readonly', 'readonly');
		   $('#service_cost').val(0);
		}else{
		   $('#service_cost').removeAttr('readonly');
		   $('#service_cost').val('');
		}
	}
</script>
<script language="javascript" type="text/javascript">
function change_status(status,id,name)
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
		url: "<?php echo base_url(); ?>admin/service/service_status_ajax/",
		type: "POST",
		dataType : 'json',
		data: { is_active: status, service_id: id, service_name: name},
		cache: false,
		success: function(data) {
			if (data.flag) {
					//$('.wrap').html('');
					//$('#service_list').html(html);
                    $('.save-success').html('<?php echo $this->global_mod->db_parse($this->lang->line("status_chngd"))?>');
					$('.statusdis').hide();
					$('#enadis_'+id).html(data.enadishtml);
					$('#enadisrow_'+id).html(data.ddd);
			}
		}
	});
		}
	//check login end
	}  
});
}


function change_hide(status,id,name)
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
		url: "<?php echo base_url(); ?>admin/service/service_hide_ajax/",
		type: "POST",
		dataType : 'json',
		data: { is_active: status, service_id: id, service_name: name},
		cache: false,
		success: function(data) {
			if (data.flag) {
					//$('.wrap').html('');
					//$('#service_list').html(html);
                    $('.save-success').html('<?php echo $this->global_mod->db_parse($this->lang->line("update_success"))?>');
					$('.ishide').hide();
					$('#is_hide_'+id).html(data.enadishtml);
					$('#ishiderow_'+id).html(data.ddd);
			}
		}
	});
		}
	//check login end
	}  
});
}

function delete_ajax(id)
{
	//alert('row_'+id);
	$('#row_'+id).hide();
	$('#del_'+id).hide();

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
		url: "<?php echo base_url(); ?>admin/service/service_delete_ajax/",
		type: "POST",
		dataType : 'json',
		data: { service_id: id},
		cache: false,
		success: function(data) {
			if (data) { 
                    $('.save-success').html('<?php echo $this->global_mod->db_parse($this->lang->line("staff_delete_success"))?>');
					$('.wrap').html('');
					$('#service_list').html(data);
					/*$('.statusdis').hide();
					$('#enadis_'+id).html(data.enadishtml);
					$('#enadisrow_'+id).html(data.ddd);*/
			}
		}
	});	
		}
	//check login end
	}  
});
}
</script>
<SCRIPT LANGUAGE="JavaScript">
<!-- Dynamic Version by: Nannette Thacker -->
<!-- http://www.shiningstar.net -->
<!-- Original by :  Ronnie T. Moore -->
<!-- Web Site:  The JavaScript Source -->
<!-- Use one function for multiple text areas on a page -->
<!-- Limit the number of characters per textarea -->
<!-- Begin
function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}
//  End -->
</script>



<script type="text/JavaScript">
$(document).ready(function() {
	$('#service_tags').val('');
	$('#service_description').val('');
        $('#category_2 option:first-child').attr("selected", "selected");
});
</script>




<script type="text/JavaScript">
$(document).ready(function() {
	$('.btn-submit').click(function(e){
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();


                $('.required',$formId).each(function(){
                    var inputVal = $(this).val();
                    var $parentTag = $(this).parent();
                    if($.trim(inputVal) == '')
                    {
                       $parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?>'));
                    }
		});




		// All validation complete - Check if any errors exist
		// If has errors
		if ($('span.error').length > 0) {

			$('span.error').each(function(){

				// Set the distance for the error animation
				var distance = 5;

				// Get the error dimensions
				var width = $(this).outerWidth();

				// Calculate starting position
				var start = width + distance;

				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				// Animate the error message
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');

			});
		} else {


			$formId.submit();
		}
		// Prevent form submission
			e.preventDefault();
	});
	// Fade out error message when input field gains focus
	$('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		//$('span.error',$parent).fadeOut();
                $('span.error',$parent).html("");
	});

        $('#category_2').focus(function(){
		$('#cat_div').html("");
	});
        $('#category_1').focus(function(){
		$('#cat_div').html("");
	});
});
</script><!--<div class="formbox register">-->

<script language="javascript" type="text/javascript">
function del_confirm(service_id)
{
	var service_id;
	$('.deldis').hide();
	$('.statusdis').hide();
	$('#del_'+service_id).show();
	//document.getElementById("del_"+service_id).style.display = "";
}
function hide(service)
{
	var service;
	document.getElementById("del_"+service).style.display = "none";
}
function hide_status(service)
{
	var service;
	document.getElementById("hide_"+service).style.display = "none";
}

function hide_hide_field(service)
{
	var service;
	document.getElementById("hide_"+service).style.display = "none";
}
function status_confirm(status,id)
{
	
	var status;
	var id;
	$('.statusdis').hide();
	$('.deldis').hide();
	$('#status_'+id).show();
        $('.save-success').html('');
	//alert("id : "+id+" status : "+status);
	//document.getElementById("status_"+id).style.display = "block";
}

function hide_confirm(status,id)
{
	
	var status;
	var id;
	$('.ishide').hide();
	//$('.deldis').hide();
	$('#hide_'+id).show();
        $('.save-success').html('');
	//alert("id : "+id+" status : "+status);
	//document.getElementById("status_"+id).style.display = "block";
}

function GetServiceDetails(id)
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
		url: "<?php echo base_url(); ?>admin/service/GetServiceDetailsAjax/",
		type: "POST",
		dataType : 'json',
		data: { service_id: id },
		success: function(data) {
                        $("#btn-submit").text("<?php echo $this->global_mod->db_parse($this->lang->line('update_btn'));?>");

			$('#service_update_id').val(data.service_id);
			$('#category_2').val(data.category_id);
			$('#service_name').val(data.service_name);
			if(data.no_cost == 'N')
			{
				$('#no_cost').prop('checked', true);
				document.getElementById('service_cost').value='';
			}
			else
				$('#service_cost').val(data.service_cost);

			$('#service_duration').val(data.service_duration);
			$('#service_duration_unit').val(data.service_duration_unit);
			$('#service_capacity').val(data.service_capacity);
			$('#service_description').val(data.service_description);
			$('#service_tags').val(data.service_tags);
			$("html, body").animate({ scrollTop: 0 }, 600);
		}
	});	
		}
	//check login end
	}  
});
}

function SaveServiceDetails(){

	var $formId = $('#add_service');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');


        if($.trim($("#category_2").val()) == ''){
                $('#cat_div').html("<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'))?>");
        }

	$('li',$formId).removeClass('error');
	$('span.error').remove();
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		if(inputVal == ''){
			$parentTag.addClass('error').append($error.clone().text("<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'))?>"));
		}


			if($(this).hasClass('cost') == true){

				if(inputVal !="" && $.isNumeric(inputVal)== false){
					$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("numeric_fld"))?>'));
				}
			}
			if($(this).hasClass('duration') == true){

				if(inputVal !="" && $.isNumeric(inputVal)== false){
					$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("numeric_fld"))?>'));
				}
			}
			if($(this).hasClass('capacity') == true){

				if(inputVal !="" &&  $.isNumeric(inputVal)== false){
					$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("numeric_fld"))?>'));
				}
			}

	});
         if($('#service_duration_unit').val()== 'M'){
            if ($('#service_duration').val() >1380){
                $('#service_duration').parent().addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("duratn_must_nt_excd"))?>'));
            }

         }else{
            if ($('#service_duration').val() > 23){
                $('#service_duration').parent().addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("duratn_must_nt_excd_23"))?>'));
            }

         }
      

	if ($('span.error').length > 0) {
			$('span.error').each(function(){
				// Set the distance for the error animation
				var distance = 5;
				// Get the error dimensions
				var width = $(this).outerWidth();
				// Calculate starting position
				var start = width + distance;
				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				// Animate the error message
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}else{
		var frmID = '#add_service';
		var params ={ 'action' : 'save' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});

		var cat=$('#hdn').val();
		if(cat == 1){

			var category_1=$('#category_1').val();
			if(category_1 =="")
			{
				$('#cat_div').html("<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'))?>");
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
			   url: '<?php echo base_url(); ?>admin/service/add_service',
			   data: params,
			   success: function(data){
					if(data == 0)
						location.reload();
			   		}
				});
		}
	//check login end
	}  
});
			}

		}else{
			var category_2= $('#category_2').val();
			if(category_2 =="")
			{
				$('#cat_div').html("<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'))?>");
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
			   url: '<?php echo base_url(); ?>admin/service/add_service',
			   data: params,
			   success: function(data){
					if(data == 0)
						location.href="<?php echo base_url(); ?>admin/service/index/success";
			   		}
				});
		}
	//check login end
	}  
});
			}
		}

	}
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
		if(contentId==1)//Free service
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('ser_free_explain'));?>";	
		}
		else if(contentId==2)//Capacity
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('ser_capacity_explain'));?>";			
		}
		else if(contentId==3)//category
		{
			content	="<?php echo $this->global_mod->db_parse($this->lang->line('ser_category_explain'));?>";			
		}
		return content;
	}
</script>