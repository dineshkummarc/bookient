<script type="text/javascript">
		$(document).ready(function() {

			$('#date_from').focus(function(){
				$('#err_date_to').html('');

			});
			$('#date_to').focus(function(){
				$('#err_date_to').html('');

			});
			$('#timepickerFrom').focus(function(){
				$('#err_time_to').html('');

			});
			$('#timepickerTo').focus(function(){
				$('#err_time_to').html('');

			});
			/* Fade out error message when input field gains focus */
			$('.required').focus(function(){
					var $parent = $(this).parent();
					$parent.removeClass('error');
					$('span.error',$parent).fadeOut();
			});

		});
</script>
<script type="text/JavaScript">
//CB#SOG#22-1-2013#PR#S
$(document).ready(function() {
	$('#add_new_staff').hide();
	$('#blockTimings').hide();
	$('#no_empEmail').change(function(){
		$('#staffEmailCont').toggle();
		if ($('#no_empEmail').is(':checked')) {
			$('#no_empEmailContent').html('<?php echo $this->global_mod->db_parse($this->lang->line("click_chkbox_stf_log_dis"))?>');
			$('#email').addClass('required email');
		} else {
			$('#no_empEmailContent').html('<?php echo $this->global_mod->db_parse($this->lang->line("click_chkbox_stf_log_enbl"))?>');
			$('#email').removeClass('required email');
			$('#email').val('');
		}
	})
	$('#btn-submit').click(function(e){
		var $formId = $(this).parents('form');
		var formAction = $formId.attr('action');
		var emailReg = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
                var numexp = /^[0-9]+$/;
		var $error = $('<span class="error"></span>');
                var errorcount = 0;
		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();
                $('.required',$formId).each(function(){
				
                        var inputVal = $(this).val();
						var $parentTag = $(this).parent();
						if($.trim(inputVal) == ''){
							$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?>'));
							errorcount++;
						}

                });
                if(errorcount > 0){
                    return false;
                }

				if ($('#no_empEmail').is(':checked')) {
					if(!emailReg.test($('#email').val())){
					        var $parentTag = $('#email').parent();
					        $parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("entr_valid_email"))?>'));
					        errorcount++;
					        return false;
					}
				}               
                if(!numexp.test($('#employee_mobile_no').val())){
                        var $parentTag = $('#employee_mobile_no').parent();
                        $parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("mob_numeric"))?>'));
                        errorcount++;
                        return false;
                }
				
				if(errorcount == 0){
					$formId.submit();
				}
				/*if(errorcount == 0){
                    var employee_id 	  = $('#employee_id').val();
					var employee_username = $('#employee_username').val();
                    var $parent_Tag = $('#employee_username').parent();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>admin/staff/check_user_name_ajax",
                        data: { uname: employee_username, curusrid: employee_id}
					}).done(function( msg ){
					if(msg != 0){
						$parent_Tag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("usr_name_exist"))?>'));
					  	return false;
					}else{
					  	$formId.submit();
					}
					});
				}*/
	 });

});
//CB#SOG#22-1-2013#PR#E



	function displayPreview(files) {
	   var file = files[0]
	   var img = new Image();
	   var sizeKB = file.size / 1024;
	   if(sizeKB >50){
	   		alert("Image Size is greater than 50 KB.Image will not be uploaded");
	   		$("#userfile").val('');
	   		
	   }
	   
	 /*  img.onload = function() {
	      $('#preview').append(img);
	      alert("Size: " + sizeKB + "KB\nWidth: " + img.width + "\nHeight: " + img.height);
	   }
	   img.src = _URL.createObjectURL(file);*/
	}


function change_status(status,id)
{
	//alert('sssssssssssssssss');
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/change_status/",
		type: "POST",
		data: { status: status, id: id},
		success: function(msg) {
			if (msg == 1)
			{
				alert('<?php echo $this->global_mod->db_parse($this->lang->line("status_updated_succss"))?>');
				window.location.reload();
			}
			else
			{
				alert('<?php echo $this->global_mod->db_parse($this->lang->line("req_proc_err"))?>');
			}
		}
	});
}


function delete_staff(id)
{
    $('.save-success').html('');
	var r = confirm('<?php echo $this->global_mod->db_parse($this->lang->line("all_appo_stf_del"))?>');

	if(r == true)
	{

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
					$.ajax({//alert("test_2");
			url: "<?php echo base_url(); ?>admin/staff/staff_delete/"+id,
			type: "POST",
			//data: {id: id},
			success: function(msg) { 
				if (msg == 1)
				{
					//alert('staff deleted sucessfully!');
                                        window.location.href = '<?php echo base_url(); ?>admin/staff/';
					//window.location.reload();
				}
				else
				{
					alert('<?php echo $this->global_mod->db_parse($this->lang->line("req_proc_err"))?>');
				}
			}
		});
		}
	//check login end
	}  
});
	}
}

function Send_Password(id)
{

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/send_password/"+id,
		type: "POST",
		//data: {id: id},
		success: function(msg) {
			if (msg == 1)
			{
				alert('<?php echo $this->global_mod->db_parse($this->lang->line("psswrd_send_succss"))?>');
				//window.location.reload();
			}
			else
			{
				alert('<?php echo $this->global_mod->db_parse($this->lang->line("req_proc_err"))?>');
			}
		}
	});
		}
	//check login end
	}  
});
}

function GetStaffData(id)
{
	lightbox_body()
    $('.add-customer').hide();
	$('#add_new_staff').show();
        $('.save-success').html('');
	//$('.required').focus();

	//$('#add_new_staff_link').hide();
	$('#blockTimings').hide();


$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/staff_data/"+id,
		type: "POST",
		success: function(msg) {
			var obj = JSON.parse(msg);
			
			$('#staffEmailCont').show();
			$('#no_empEmailContent').html('<?php echo $this->global_mod->db_parse($this->lang->line("click_chkbox_stf_log_dis"))?>');
			$('#email').addClass('required email');
			$('#employee_name').focus();
			$('#employee_name').val(obj.employee_name);
			$('#employee_username').focus();
			$('#employee_username').val(obj.user_name);
			$('#password-1').focus();
			$('#password-1').val(obj.password);
			$('#password-2').focus();
			$('#email').focus();
			
			if(obj.user_email != ''){
				document.getElementById('no_empEmail').checked = true;
				$('#email').val(obj.user_email);
			}else{
				$('#staffEmailCont').css('display','none');
				$('#email').removeClass('required email');
				$('#email').val('');
			}
			
			$('#employee_mobile_no').focus();
			$('#employee_mobile_no').val(obj.employee_mobile_no);
			$('#employee_description').focus();
			$('#employee_description').val(obj.employee_description);
			$('#employee_education').focus();
			$('#employee_education').val(obj.employee_education);
			$('#employee_languages').focus();
			$('#employee_languages').val(obj.employee_languages);
			$('#employee_membership').focus();
			$('#employee_membership').val(obj.employee_membership);
			$('#employee_awards').focus();
			$('#employee_awards').val(obj.employee_awards);
			$('#employee_publications').focus();
			$('#employee_publications').val(obj.employee_publications);
			$('#employee_id').focus();
			$('#employee_id').val(obj.employee_id);
			$('#password-1').attr('readonly', true);
                        $('#employee_username').attr('readonly', true);
                        $('#userfile').val("");
                        $('#chan_pas_word').show();

			var staffImgSrc  = "<?php echo base_url(); ?>uploads/staff/"+obj.employee_image
			$("#staffImg").attr("src", staffImgSrc);
			$('#staffImg').show();
                        if(obj.employee_image == 'noimage.jpg')
                        {
                            $('#rem_photo').hide();
                            //alert(obj.employee_image);
                        }
                        else {
                            $('#rem_photo').show();
                        }


			var frmAction = "<?php echo base_url(); ?>admin/staff/update_staff/"+obj.employee_id;
			$("#form-staff").attr("action", frmAction);

			$('#btn-submit').val('<?php echo $this->global_mod->db_parse($this->lang->line("update_btn"))?>');
			closeLightbox_body();
		}
	});
		}
	//check login end
	}  
});
}


<!--===========================================DATE-TIMEPICKER CODE===========================================-->
$(function() {
		$("#date_from").datepicker();
		$("#date_to").datepicker();
		$('#timepickerFrom').timepicker({});
		$('#timepickerTo').timepicker({});
	});
<!--===========================================DATE-TIMEPICKER CODE===========================================-->


$(document).ready(function() {

	$('#btn_blck_dt').click(function(e){

		var $formId = $('#form-blok-dt');//$(this).parents('form');
		var formAction = $formId.attr('action');

		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();

		//alert($('#form-blok-dt .required').size());
		//return;
		$('#form-blok-dt .required').each(function(){

			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if($.trim(inputVal) == ''){ //<--CB#SOG#11-12-2012#PR#S-E
				$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?>'));
			}

			var startDate = new Date($('#date_from').val());
			var endDate   = new Date($('#date_to').val());
			if (startDate > endDate){
				$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("strt_date_laess_end_date"))?>'));

			}
		});

		// Prevent form submission
			e.preventDefault();




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
	});
});

$(document).ready(function() {
	$('#btn_blck_time').click(function(e){

		var $formId = $('#form-blok-time');//$(this).parents('form');
		var formAction = $formId.attr('action');

		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();

		//alert($('#form-blok-time .required').size());
	     //return;
		$('#form-blok-time .required').each(function(){

			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if($.trim(inputVal) == ''){
				$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?>'));
			}
		});

		// Prevent form submission
			e.preventDefault();

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
	});
});

function blockTimingsData(blk_dt_employee_id)
{

	$('#date_from').val('');
	$('#date_to').val('');
	$('#timepickerFrom').val('');
	$('#timepickerTo').val('');
	$('#date_of_time_block').val('');
	
	
	$('#add_new_staff').hide();
	$('#add_new_staff_link').show();
	$('#bloceddatedisp').html(" ");
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/show_blocked_dates/"+blk_dt_employee_id,
		type: "POST",
		//data: {id: id},
		dataType: 'text',
		success: function(msg) {
			var string = " ";
			var data_split=msg.split('#####');
			var staff_name=$.trim(data_split[0]);
			$("#staff_name_date").html(staff_name);
			$("#staff_name_date_time").html(staff_name);

			var staff_date=data_split[1];
			var data_date_arr=staff_date.split('@@@');
			//var arr_len=data_date_arr.length;
			var m=0;
			var div_close=0;
			
			string+='<div><div><dd>';
			
			//alert(data_date_arr.length);
			var counter=1;
			var arr_len=data_date_arr.length-1;
			//alert(arr_len);
			//var len 
			for(var i in data_date_arr)
			{
				var DateString = data_date_arr[i];
				
				if(DateString !="")
				{
					var month_num=DateString.split('-');
					//var mydate = new Date(month_num[0],month_num[1],month_num[2]);
					var mydate = new Date(DateString);
					var str = mydate.toString("MMMM yyyy");
					var month=str.split(' ');
					if(m !=month_num[1])
					{
						string+='</dd></div></div>';
						string+='<div class="rounded-corner">';
						string+='<div class="surround-div">';
                        string+='<dd class="cal-left"><span class="calendar-icon" id="calender"><span class="mnth">';
						string+=month[1];
						string+='</span><span class="date">'+month[3]+'</span><a href="#" id="del-icon" style="display:none;"></a></span></dd>';
						string+='<dd class="cal-right">';
						m=month_num[1];
						div_close=1;
						str=1;
					}
					if(str != 1){
						string+='<span class="seperator">,</span><span class="date-display">'+month_num[2]+'/'+month_num[1]+'/'+month_num[0]+'';
					}
					else{
						string+='<span class="date-display">'+month_num[2]+'/'+month_num[1]+'/'+month_num[0];						
					}
					str=0;
					
					string+='<a href="javascript:void(0);" id="trash-icon'+DateString+'" class="trash-icon" style="display:none;" onclick="DeleteDate('+blk_dt_employee_id+',\''+DateString+'\');"><img src="'+SITE_URL+'images/trash.gif"></a>';
					string+= '</span>';

				}
				counter = counter+1;
			}
			string+='</dd></div></div>';
			$('#bloceddatedisp').html(string);
			fn_blocking();

			$(".date-display").hover(function()
			{
				$('.trash-icon', this).show();
			},function()
			{
				$('.trash-icon').hide();
			});
			
	
			blockCalen();
			
			
			

		}
	});
	
	

function blockCalen(){

	var dateArr = new Array;
        var newday;	
        var newmonth;
		var unavailableDates = [];	
         $('span.date-display').each(function(){
		 //alert($(this).html().substring(0, 10).split('/').join('-'));
		 
		dateArr = $(this).html().substring(0, 10).split('/');
		 if(dateArr[0]){
		     
				
				newday = dateArr[0];
				
				if(dateArr[0].substring(0, 1)=="0"){
					newday = dateArr[0].substring(2, 1)
				}
		  
		  }
		
		  if(dateArr[1]){
		  
		  		//var str1 = dateArr[1].substring(1, 1);
				newmonth = dateArr[1];
				if(dateArr[1].substring(0, 1)=="0"){
					newmonth = dateArr[1].substring(2, 1)
				}

		  }
		 
		  unavailableDates.push(newday+"-"+newmonth+"-"+dateArr[2]);
	    });
		
		/*var unavailableDates = ["10-6-2013", "14-6-2013", "20-6-2013"];*/
         
		// Holiday List
		//var unavailableDates = ["10-6-2013", "14-6-2013", "20-6-2013"];

		// Exeptions if some Weekends are Working days
		var enableDay = [];

		// Weekend Days Sunday = 0 ... Sat =6
		var weekend = [];

		function nationalDays(date) {
		
			// get date
			dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();


			// if Holiday then block it    
			if ($.inArray(dmy, unavailableDates) > -1) {
				return [false, "", "Unavailable"];

			}
			// if Exception then Enable it
			if ($.inArray(dmy, enableDay) > -1) {
				return [true, ""];

			}

			//if Weekend then block it
			if ($.inArray(date.getDay(), weekend) > -1) {
				return [false, "", "Unavailable"];
			}

			return [true, ""];
		}
         $("#date_of_time_block").datepicker( "destroy" );
    	$("#date_of_time_block").datepicker({ 	beforeShowDay: nationalDays });
}

	$('#BlockedTimingsDisp').html(" ");

$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
				$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>admin/staff/show_blocked_times/"+blk_dt_employee_id,
		type: "POST",
		//data: {id: id},
		//dataType: 'json',
		success: function(msg) {
			var data_time_arr=msg.split('#####');

			//$('#staff_name_date_time').html(data_time_arr[0]);
			$('#BlockedTimingsDisp').html(data_time_arr[1]);
		}
	});
		}
	//check login end
	}  
});


	$('#blk_dt_employee_id').val(blk_dt_employee_id);
	$('#blk_time_employee_id').val(blk_dt_employee_id);
	$('#blockTimings').show();
}

function DeleteDate(employee_id,date){
	var didConfirm = confirm("<?php echo $this->global_mod->db_parse($this->lang->line('r_u_sure'))?>");
	if(didConfirm != true){
		return false;
	}
	 
	$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			  $.ajax({
		url: "<?php echo base_url(); ?>admin/staff/delete_block_dt/"+employee_id+"/"+date,
		type: "POST",
		success: function(msg) {
			$('#bloceddatedisp').html(" ");
			$.ajax({
			url: "<?php echo base_url(); ?>admin/staff/show_blocked_dates/"+employee_id,
			type: "text",
			success: function(msg) {
							var string = " ";
							var data_split=msg.split('#####');//Active staff 5#####2013-06-17@@@2013-06-18@@@2013-06-19@@@
							var staff_name=$.trim(data_split[0]);
							$("#staff_name_date").html(staff_name);
							var staff_date=data_split[1];
							var data_date_arr=staff_date.split('@@@');

							var counter=1;
							var arr_len=data_date_arr.length-1;
							var m=0;
							var div_close=0;
							string+='<div><div><dd>';
							for(var i in data_date_arr){
								var DateString = data_date_arr[i];
								
								if(DateString !=""){
	                                var month_num=DateString.split('-');
	                                var mydate = new Date(DateString);
	                                var str = mydate.toString("MMMM yyyy");
	                                var month=str.split(' ');
	                                if(m !=month_num[1]){
	                                    string+='</dd></div></div>';
	                                    string+='<div class="rounded-corner">';
	                                    string+='<div class="surround-div">';
                                        //alert(month[1]);
	                                    string+='<dd class="cal-left"><span class="calendar-icon" id="calender"><span class="mnth">';
	                                    string+=month[1];
	                                    string+='</span><span class="date">'+month[3]+'</span><a href="#" id="del-icon" style="display:none;"></a></span></dd>';
	                                    string+='<dd class="cal-right">';
	                                    m=month_num[1];
	                                    div_close=1;
										str=1;
	                                }
									datObj=	DateString.split('-');
									if(str != 1){
										 string+='<span class="seperator">,</span><span class="date-display">'+datObj[2]+'/'+datObj[1]+'/'+datObj[0]+'';
									}
									else{
										string+='<span class="date-display">'+datObj[2]+'/'+datObj[1]+'/'+datObj[0];
										
									}
									str=0;
	                                //string+='<span class="date-display">'+datObj[2]+'/'+datObj[1]+'/'+datObj[0]+'<span class="seperator">,</span>';
	                                string+='<a href="javascript:void(0);" id="trash-icon'+DateString+'" class="trash-icon" style="display:none;" onclick="DeleteDate('+employee_id+',\''+DateString+'\');"><img src="'+SITE_URL+'images/trash.gif"></a>';
	                                string+= '</span>';
								}
								counter = counter+1;
							}
							string+='</dd></div></div>';
							$('#bloceddatedisp').html(string);
							$('html,body').animate({scrollTop: $('#bloceddatedisp').offset().top},'slow');

							$(".date-display").hover(function(){
								$('.trash-icon', this).show();
							},function(){
								$('.trash-icon').hide();
							});
							
						/* Block clean start  here */
						
					var dateArr = new Array;
					var newday;	
					var newmonth;
					var unavailableDates = [];	
					$('span.date-display').each(function(){
				
						dateArr = $(this).html().substring(0, 10).split('/');
						if(dateArr[0]){
							newday = dateArr[0];
							if(dateArr[0].substring(0, 1)=="0"){
								newday = dateArr[0].substring(2, 1)
							}

						}

						if(dateArr[1]){
							newmonth = dateArr[1];
							if(dateArr[1].substring(0, 1)=="0"){
								newmonth = dateArr[1].substring(2, 1)
							}

					}

					unavailableDates.push(newday+"-"+newmonth+"-"+dateArr[2]);
					});

					// Exeptions if some Weekends are Working days
					var enableDay = [];

					// Weekend Days Sunday = 0 ... Sat =6
					var weekend = [];

					function nationalDays(date) {

					// get date
					dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();


					// if Holiday then block it    
					if ($.inArray(dmy, unavailableDates) > -1) {
					return [false, "", "Unavailable"];

					}
					// if Exception then Enable it
					if ($.inArray(dmy, enableDay) > -1) {
					return [true, ""];

					}

					//if Weekend then block it
					if ($.inArray(date.getDay(), weekend) > -1) {
					return [false, "", "Unavailable"];
					}

					return [true, ""];
					}
					$("#date_of_time_block").datepicker( "destroy" );
					$("#date_of_time_block").datepicker({ 	beforeShowDay: nationalDays });		
						
						/* Block clean ends here */
						
	
						}
			});
		}
	});
		}
	//check login end
	}  
});
	
}


function DeleteTimeBlockData(deletetimeId, employee_id)
{
	var didConfirm = confirm("<?php echo $this->global_mod->db_parse($this->lang->line('r_u_sure'))?>");
	if(didConfirm != true){
		return false;
	}
	
	//alert(deletetimeId);
	$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
				url: "<?php echo base_url(); ?>admin/staff/delete_time_block_data/"+deletetimeId,
				type: "POST",
					success: function(msg) {
								$('#BlockedTimingsDisp').html(" ");
								$.ajax({
									url: "<?php echo base_url(); ?>admin/staff/show_blocked_times/"+employee_id,
									type: "POST",
									success: function(msg) {
										var data_time_arr=msg.split('#####');
										$('#BlockedTimingsDisp').html(data_time_arr[1]);
									}
								});
								
					}
				});
		}
	//check login end
	}  
});
}
</script>
<script>
function DisplayAddNewStaff()
{

	$('#add_new_staff').show();



	$('#staffImg').attr('src', '');


        $('#userfile').val("");
        $('#rem_photo').hide();

	$('#employee_username').attr('readonly', false);
	$('#add_img').html('');
	$('#employee_id').val('');
	$('#employee_name').focus();
	$('#employee_name').val('');
	$('#employee_username').focus();
	$('#employee_username').val('');
	$('#password-1').focus();
	$('#password-1').val('');
	$('#password-2').focus();
	$('#password-2').val('');
	$('#email').focus();
	$('#email').val('');
	$('#employee_mobile_no').focus();
	$('#employee_mobile_no').val('');
	$('#employee_description').focus();
	$('#employee_description').val('');
	$('#employee_education').focus();
	$('#employee_education').val('');
	$('#employee_languages').focus();
	$('#employee_languages').val('');
	$('#employee_membership').focus();
	$('#employee_membership').val('');
	$('#employee_awards').focus();
	$('#employee_awards').val('');
	$('#employee_publications').focus();
	$('#employee_publications').val('');
	$('#employee_name').focus();
	$('#password-1').attr('readonly', false);
	$('#chan_pas_word').hide();
	//$('.required').val('');
	$('#blockTimings').hide();

	$('#btn-submit').val('<?php echo $this->global_mod->db_parse($this->lang->line("Staff_adddatestaffbtn"))?>');
}
function CancelAddNewStaff()
{
        $('.add-customer').show();
	$('#add_new_staff').hide();
         //$("add_new_staff_link").show();
	$('#add_new_staff_link').show();
	$('#blockTimings').hide();
	$('#btn-submit').val('<?php echo $this->global_mod->db_parse($this->lang->line("Staff_adddatestaffbtn"))?>');
        $('#employee_id').val('');
        var frmAction = "<?php echo base_url(); ?>admin/staff/add_staff/";
        $("#form-staff").attr("action", frmAction);
        $('#userfile').val("");
        $('#rem_photo').hide();

}
</script>
<script type="text/javascript">
function AddDateStaff()
{
	var $formId = $('#form-blok-dt');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error" style="color:#FF0000;"></span>');
	var errorcount = 0;
	$('li',$formId).removeClass('error');
	$('span.error').remove();
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		if($.trim(inputVal) == ''){
			$parentTag.addClass('error').append($error.clone().text('<?php echo $this->global_mod->db_parse($this->lang->line("required_fld"))?>'));
			errorcount++;
		}
	});

	if(errorcount > 0) {
		return false;
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
	}
	var startDate = new Date($('#date_from').val());
        var endDate = new Date($('#date_to').val());

	if (startDate < endDate)
	{
		var frmID = '#form-blok-dt';
		var params ={ 'action' : 'bolck_date' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});

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
		   url: '<?php echo base_url(); ?>admin/staff/add_block_date/',
		   data: params,
		   success: function(data){
				$('#blockTimings').hide();

		   }
		});
		}
	//check login end
	}  
});
	} else {
		//alert('hh000');
		var msg = "<?php echo $this->global_mod->db_parse($this->lang->line('end_date_grtr_srt_date'))?>";
		$('#err_date_to').html(msg);
		return false;
	}
}
</script>
<script type="text/javascript">
function minFromMidnight(time){
tt=time.split(":");
sec=tt[0]*3600+tt[1]*60;
 return sec;
}
function fn_blocking(){
	$('.block_slot').focus(function(){
		var localId = $(this).attr('id');
		$('#'+localId+' ~ span:first').remove();
	})
}

function AddTimingStaff(){
	////////////////
/*	$('.date-display').each(function(){
		alert($(this).html());
	})
*/	
	
	
	
	///////////
	var $formId = $('#form-blok-time');
	var formAction = $formId.attr('action');
	var timeFrom	= $('#timepickerFrom').val();
	var timeTo		= $('#timepickerTo').val();
	var blockDate	= $('#date_of_time_block').val();
	$('.error').remove();
	var error=0;
	if(timeFrom == ''){
		$('<span class="error" style="color:#F00;">'+"<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'));?>"+'</span>').insertAfter('#timepickerFrom');
		error++;
	}
	if(timeTo == ''){
		$('<span class="error" style="color:#F00;">'+"<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'));?>"+'</span>').insertAfter('#timepickerTo');
		error++;
	}
	if(blockDate == ''){
		$('<span class="error" style="color:#F00;">'+"<?php echo $this->global_mod->db_parse($this->lang->line('required_fld'));?>"+'</span>').insertAfter('#date_of_time_block');
		error++;
	}
	if(error == 0){
		var exError=0
		if(minFromMidnight(timeFrom) > minFromMidnight(timeTo)){
		$('<span class="error" style="color:#F00;">'+"<?php echo $this->global_mod->db_parse($this->lang->line('end_time_grtr_srt_time'))?>"+'</span>').insertAfter('#timepickerTo');
		exError++;
		}
		if(timeFrom == timeTo){
		$('<span class="error" style="color:#F00;">'+'<?php echo $this->global_mod->db_parse($this->lang->line("strt_time_laess_end_time"))?>'+'</span>').insertAfter('#timepickerTo');
		exError++;
		}
		if(exError == 0){
				var frmID = '#form-blok-time';
				var params ={ 'action' : 'bolck_time' };
				var paramsObj = $(frmID).serializeArray();
				$.each(paramsObj, function(i, field){
					params[field.name] = field.value;
				});
			
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
				url: '<?php echo base_url(); ?>admin/staff/add_block_time/',
				data: params,
				success: function(data){
					$('#blockTimings').hide();
					}
				});
		}
	//check login end
	}  
});
		}else{
			return false;
		}
	}else{
		return false;
	}
	
}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('#change_pass').change(function() {
        //alert($(this).is(':checked'));
		//$('#password-1').attr('readonly', false);
		if($(this).is(':checked') == true)
		{
			//alert('on');
			$('#password-1').attr('readonly', false);
			$('#password-1').focus();
		} else {
			//alert('off');
			$('#password-1').attr('readonly', true);
		}

    });
});
</script>
<script type="text/javascript">
function Remove_Pic()
{
  var e_id = $('#employee_id').val();
  var params ={'empl_Id' : e_id };

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
		   url: '<?php echo base_url(); ?>admin/staff/Remove_pic/',
		   data: params,
		   success: function(data){
                                if(data == 1)
                                {
                                    var staffImgSrc  = "<?php echo base_url(); ?>uploads/staff/noimage.jpg";
                                    $("#staffImg").attr("src",staffImgSrc);
			            			$('#staffImg').show();
                                    $('#rem_photo').hide();
                                }
		   }
		});
		}
	//check login end
	}  
});
}
//CB#SOG#5-3-2013#PR#E
</script>
