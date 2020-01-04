<script type="text/JavaScript">
$(document).ready(function() { 
	blockTimingsData( <?php echo  $user_id_staff;?>);

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
	$('#form-blok-dt input[type=text],#form-blok-time input[type=text]').focus(function(){
			$(this).removeAttr('style');
	});
});

function change_status(status,id){
	
	$.ajax({
		url: "<?php echo base_url(); ?>staff/staff_manage/change_status/",
		type: "POST",
		data: { status: status, id: id},
		success: function(msg) {
			if (msg == 1)
			{
				alert('Status updated sucessfully!');
				window.location.reload();
			}
			else
			{
				alert('There is some error processing your request');
			}
		}
	});
}

function delete_staff(id){
    $('.save-success').html('');
	var r = confirm('Are you sure you want to delete this Staff ?');

	if(r == true)
	{
		$.ajax({//alert("test_2");
			url: "<?php echo base_url(); ?>staff/staff_manage/staff_delete/"+id,
			type: "POST",
			//data: {id: id},
			success: function(msg) { 
				if (msg == 1){
                   window.location.href = '<?php echo base_url(); ?>staff/staff_manage/';
				}else{
					alert('There is some error processing your request');
				}
			}
		});
	}
}

function Send_Password(id){
	$.ajax({
		url: "<?php echo base_url(); ?>staff/staff_manage/send_password/"+id,
		type: "POST",
		success: function(msg) {
			if (msg == 1){
				alert('Password sent sucessfully!');
			}else{
				alert('There is some error processing your request');
			}
		}
	});
}
/*
function GetStaffData(id){
	$('.add-customer').hide();
	$('#add_new_staff').show();
	$('.save-success').html('');
	$('#blockTimings').hide();
	$.ajax({
		url: "<?php echo base_url(); ?>staff/staff_manage/staff_data/"+id,
		type: "POST",
		success: function(msg) {
			var obj = JSON.parse(msg);

			$('#employee_name').focus();
			$('#employee_name').val(obj.employee_name);
			$('#employee_username').focus();
			$('#employee_username').val(obj.user_name);
			$('#password-1').focus();
			$('#password-1').val(obj.password);
			$('#password-2').focus();
			$('#email').focus();
			$('#email').val(obj.user_email);
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
                        if(obj.employee_image == 'noimage.jpg'){
                            $('#rem_photo').hide();
                            //alert(obj.employee_image);
                        }else {
                            $('#rem_photo').show();
                        }
			var frmAction = "<?php echo base_url(); ?>staff/staff_manage/update_staff/"+obj.employee_id;
			$("#form-staff").attr("action", frmAction);

			$('#btn-submit').val('Update');
		}
	});
}
*/
$(function() {
		$("#date_from").datepicker();
		$("#date_to").datepicker();
		$('#timepickerFrom').timepicker({});
		$('#timepickerTo').timepicker({});
	});

$(document).ready(function() {

	$('#btn_blck_dt').click(function(e){

		var $formId = $('#form-blok-dt');//$(this).parents('form');
		var formAction = $formId.attr('action');

		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();
		$('#form-blok-dt .required').each(function(){

			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if($.trim(inputVal) == ''){ 
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
			}

			var startDate = new Date($('#date_from').val());
			var endDate   = new Date($('#date_to').val());
			if (startDate > endDate){
				$parentTag.addClass('error').append($error.clone().text('Start date should be less than end date'));

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
		$('#form-blok-time .required').each(function(){

			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if($.trim(inputVal) == ''){
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
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

function blockTimingsData(blk_dt_employee_id){

	$('#add_new_staff').hide();
	$('#add_new_staff_link').show();
	$('#bloceddatedisp').html(" ");
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>staff/staff_manage/show_blocked_dates/"+blk_dt_employee_id,
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
			//var len 
			for(var i in data_date_arr)
			{
				var DateString = data_date_arr[i];
				
				if(DateString !="")
				{
					var month_num=DateString.split('-');
				
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
	$.ajax({//alert("test_2");
		url: "<?php echo base_url(); ?>staff/staff_manage/show_blocked_times/"+blk_dt_employee_id,
		type: "POST",
		success: function(msg) {
			var data_time_arr=msg.split('#####');
			$('#BlockedTimingsDisp').html(data_time_arr[1]);
		}
	});


	$('#blk_dt_employee_id').val(blk_dt_employee_id);
	$('#blk_time_employee_id').val(blk_dt_employee_id);
	$('#blockTimings').show();
}

function DeleteDate(employee_id,date){

	   $.ajax({
		url: "<?php echo base_url(); ?>staff/staff_manage/delete_block_dt/"+employee_id+"/"+date,
		type: "POST",
		success: function(msg) {
			$('#bloceddatedisp').html(" ");
			$.ajax({
			url: "<?php echo base_url(); ?>staff/staff_manage/show_blocked_dates/"+employee_id,
			type: "text",
			success: function(msg) {
							var string = " ";
							var data_split=msg.split('#####');//Active staff 5#####2013-06-17@@@2013-06-18@@@2013-06-19@@@
							var staff_name=$.trim(data_split[0]);
							$("#staff_name_date").html(staff_name);
							var staff_date=data_split[1];
							var data_date_arr=staff_date.split('@@@');

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
	                                //string+='<span class="date-display">'+datObj[2]+'/'+datObj[1]+'/'+datObj[0]+'<span class="seperator">,</span>';
									
									
									if(str != 1){
										 string+='<span class="seperator">,</span><span class="date-display">'+datObj[2]+'/'+datObj[1]+'/'+datObj[0]+'';
									}
									else{
										string+='<span class="date-display">'+datObj[2]+'/'+datObj[1]+'/'+datObj[0];
										
									}
									str=0;
																								
	                                string+='<a href="javascript:void(0);" id="trash-icon'+DateString+'" class="trash-icon" style="display:none;" onclick="DeleteDate('+employee_id+',\''+DateString+'\');"><img src="'+SITE_URL+'images/trash.gif"></a>';
	                                string+= '</span>';
								}
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

function DeleteTimeBlockData(deletetimeId, employee_id){
	$.ajax({
	url: "<?php echo base_url(); ?>staff/staff_manage/delete_time_block_data/"+deletetimeId,
	type: "POST",
		success: function(msg) {
					$('#BlockedTimingsDisp').html(" ");
					$.ajax({
						url: "<?php echo base_url(); ?>staff/staff_manage/show_blocked_times/"+employee_id,
						type: "POST",
						success: function(msg) {
							$('#BlockedTimingsDisp').html(msg);
						}
					});
					
		}
	});
	//alert(deletetimeId);
}

function AddDateStaff(){
	var date_from1 = $("#date_from").val();
	var date_to1 = $("#date_to").val();
	$('#err_date_to').html('');
	var error = 0;
	if(date_from1 == ''){
		$("#date_from").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(date_to1 == ''){
		$("#date_to").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	
if(error == 0){
	var date_from = new Date($("#date_from").val());
	var date_to = new Date($("#date_to").val());
	if (date_from < date_to){
		var frmID = '#form-blok-dt';
		var params ={ 'action' : 'bolck_date' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});
		$.ajax({
		   type: 'POST',
		   url: '<?php echo base_url(); ?>staff/staff_manage/add_block_date/',
		   data: params,
		   success: function(data){
				blockTimingsData( <?php echo  $user_id_staff;?>);
		   }
		});
	}else{
		var msg = "<span style='color:#ff0000;'>End Date should be greater than Start date.</span>";
		$('#err_date_to').html(msg);
		return false;
	}
}else{
	return false;
}
}

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
	var $formId = $('#form-blok-time');
	var formAction = $formId.attr('action');
	var timeFrom	= $('#timepickerFrom').val();
	var timeTo		= $('#timepickerTo').val();
	var blockDate	= $('#date_of_time_block').val();
	$('.error').remove();
	var error=0;
	if(timeFrom == ''){
		$("#timepickerFrom").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(timeTo == ''){
		$("#timepickerTo").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(blockDate == ''){
		$("#date_of_time_block").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		error++;
	}
	if(error == 0){
		var exError=0
		if(minFromMidnight(timeFrom) > minFromMidnight(timeTo)){
		$('<span class="error" style="color:#F00;">End Time should be greater than Start Time.</span>').insertAfter('#timepickerTo');
		exError++;
		}
		if(timeFrom == timeTo){
		$('<span class="error" style="color:#F00;">Start time and end time can not be same.</span>').insertAfter('#timepickerTo');
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
				type: 'POST',
				url: '<?php echo base_url(); ?>staff/staff_manage/add_block_time/',
				data: params,
				success: function(data){
					blockTimingsData( <?php echo  $user_id_staff;?>);
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

