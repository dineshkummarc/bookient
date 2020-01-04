
<script language="javascript" type="text/javascript">
  
$(document).ready(function() { 
    $('.all').click(function(){
        if(!$(this).is(":checked")){
            $('#super').attr('checked', false); 
        }
    });
    
    $('.children').click(function(){
        if(!$(this).is(":checked")){           
            $(this).parent().parent().siblings('.all').attr('checked', false); 
            $('#super').attr('checked', false); 
        }
    });
});


jQuery.extend({
    stringify  : function stringify(obj) {         
        if ("JSON" in window) {
            return JSON.stringify(obj);
        }

        var t = typeof (obj);
        if (t != "object" || obj === null) {
            // simple data type
            if (t == "string") obj = '"' + obj + '"';

            return String(obj);
        } else {
            // recurse array or object
            var n, v, json = [], arr = (obj && obj.constructor == Array);

            for (n in obj) {
                v = obj[n];
                t = typeof(v);
                if (obj.hasOwnProperty(n)) {
                    if (t == "string") {
                        v = '"' + v + '"';
                    } else if (t == "object" && v !== null){
                        v = jQuery.stringify(v);
                    }

                    json.push((arr ? "" : '"' + n + '":') + String(v));
                }
            }

            return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
        }
    }
});

function show_service()
{
	$("#update_text").hide();
	$("#details").show();
	$("#details_div").show();
}

function close_service(){
		$('#details_div').hide();	
		$('#update_text').show();
		$('#suss_msg').html('');	
}

function toggleChecked(status) {
	$(".checkbox").each( function() {
		if ($('#super').is(':checked')) {
			$(this).prop('checked', true);
		} else {
			$(this).prop('checked', false);
		}
	})


}

$(document).ready(function() {
$(".all").change(function() {
	   $(this).siblings().find(':checkbox').attr('checked', this.checked);
	   });
});



$(document).ready(function() { 
   
						   
	$('#btn_biz_hour').click(function(e){
			
		var $formId = $('#form-biz-hour');//$(this).parents('form');
		var formAction = $formId.attr('action');
		var $error = $('<span class="error"></span>');

		// Prepare the form for validation - remove previous errors
		$('li',$formId).removeClass('error');
		$('span.error').remove();							 
			
		$('#form-biz-hour .required').each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			if(inputVal == ''){
				$parentTag.addClass('error').append($error.clone().text('<?php echo $this->lang->line("required_fld");?>'));
				
			}
		});	
		
		var servicesSelected =  $('#services').children().find('input[type=checkbox]:checked').not("input[value='']").size();
		var staffSelected 	 =  $('#staff').children().find('input[type=checkbox]:checked').not("input[value='']").size();
		var daysSelected 	 =  $('#days').children().find('input[type=checkbox]:checked').not("input[value='']").size();
		
		
		if(servicesSelected == 0)
		{
			$('#servicemsg').html('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("select_one_chkbx");?>'+'</span>');
		}
		if(staffSelected == 0)
		{
			$('#staffmsg').html('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("select_one_chkbx");?>'+'</span>');
		}
		if(daysSelected == 0)
		{
			$('#daysmsg').html('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("select_one_chkbx");?>'+'</span>');
		}
		
				

		var localArray = $('#expense_table').find('input').serializeArray();
		var lsdata = 0;
		var start=0;
		var end=0;
		var timeError=0;
		localArray.forEach(function(entry){
		if(entry['value'] !=''){
			var localIndex = entry['name'].split('_');
			if(lsdata ==localIndex[1]){
				end = minFromMidnight(entry['value']);
				if(start == end){
					$('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("strt_time_end_time");?>'+'</span>').insertAfter('#'+entry['name']);
					timeError++;
				}
				if(start>end){
					$('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("sml_strt_end_time")?>'+'</span>').insertAfter('#'+entry['name']);
					timeError++;
				}
			}else{
				lsdata =localIndex[1];
				start = minFromMidnight(entry['value']);
			}
		}
	})
//////////////////////////////////////////////////////////
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
			 var serviceVals = new Array;
			 $('#services :checked').not("input[value='']").each(function() {
			   serviceVals.push($(this).val());
			 });
			 
			 var staffVals =  new Array;
			 $('#staff :checked').not("input[value='']").each(function() {
			   staffVals.push($(this).val());
			 });
			 
			 var daysVals =  new Array;
			 $('#days :checked').not("input[value='']").each(function() {
			   daysVals.push($(this).val());
			 });
			 
			 			 
			 result = new Array;
			 result['service'] = new Array;
			 result['service'] = serviceVals;
			 result['staff'] = new Array;
			 result['staff'] = staffVals;
			 result['days'] = new Array;
			 result['days'] = daysVals;
			
			var timeArray = $('#expense_table').find('input').serializeArray();
			var jObject={};
			for(i in result){
				jObject[i] = result[i];
			}
			jObject= $.stringify(jObject);
			
/*  ########## */ 		
	var rowCount = $('#expense_table tr:last').attr("id").split('_');
	if($("#timepickerFrom_"+rowCount[1]).val() != '' && $("#timepickerTo_"+rowCount[1]).val() != '' && timeError == 0){	
	
	$('#err-dt-st-end').html('<img src="'+SITE_URL+'/asset/admin_small_loader.gif"/><span class="error" style="color:#F00;">Checking time.</span>');
	var startTime = $("#timepickerFrom_"+rowCount[1]).val();
	var endTime = $("#timepickerTo_"+rowCount[1]).val();	
	
	
	$.ajax({
		url: "<?php echo base_url(); ?>admin/business_hour/fn_chlbizHrtime",
		type: "POST",
		data: { 'startTime': startTime, 'endTime': endTime, jsondata: jObject },
		success: function(result){
			
			var result1 = result.trim();
			if(result1 == 'done'){
				//start
				$('#err-dt-st-end').html('');

			 
			 $.ajax({//alert("test_2");
					url: "<?php echo base_url(); ?>admin/business_hour/add_biz_hour/",
					type: "POST",
					data: {jsondata: jObject,timeArray:timeArray},
					dataType: 'html',
					success: function(msg) {
						
						//alert(msg);
						//alert($('#DispStaffHourDetails').html());
						$('#suss_msg').html(msg);
					}
				});
				
				//end
			}else{
				$('#err-dt-st-end').html('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("sry_tm_range_in_sys");?>'+' </span>');
			}
		}
	});
}
/*  ########## */
			 
		}
//////////////////////////////////////////////////////////
	});
});
function serviceResetMsg()
{
	$('#servicemsg').html("");
}
function staffResetMsg()
{
	$('#staffmsg').html("");
}
function daysResetMsg()
{
	$('#daysmsg').html("");
}

function showStaffHourDetails(employee_id,employee_name)
{
	$('.down-arrow').hide();
	$('.right-arrow').show();
	$('.business-hour').hide();
	$('.right-arrow').show();
	$('#arrowdown'+employee_id).show();
	$('#DispStaffHourDetails'+employee_id).show();
	$('#arrowright'+employee_id).hide();
	lightbox_body('lightPrBox');
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
				$.ajax({
				url: "<?php echo base_url(); ?>admin/business_hour/show_biz_hour/"+employee_id,
				type: "POST",
				data: { 'employee_name': employee_name},
				success: function(msg) {
							var result = msg.split('@|^_^|@');
							if(result[1] == 'done'){
								closeLightbox_body()
								$('#DispStaffHourDetails'+employee_id).html(result[0]);
								after_ajax_addi();
							}
				}
			});	
			}
		//check login end
		}  
	});
}

function DeleteSchedule(emp_id,id){
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
			var r=confirm("<?php echo $this->lang->line('r_u_want_to_del');?>");
			if (r==true){
					$.ajax({
						url: "<?php echo base_url(); ?>admin/business_hour/del_biz_hour",
						type: "POST",
						data: { 'emp_id': emp_id, 'id': id },
						success: function(msg) {
							var result = msg.split('@|^_^|@');
							if(result[1] == 'done'){
								$('#DispStaffHourDetails'+emp_id).html(result[0]);
								$('#suss_msg').html("");
								$('#resultContenar').html('<lable id="del_scc" style="color:#007A00; font-size: 18px;font-weight: bold;">'+'<?php echo $this->lang->line("time_del_succ")?>'+'</lable>')
								$('#del_scc').fadeOut(5000);
							}else{
								$('#resultContenar').html('<lable id="del_scc" style="color:#F00; font-size: 18px;font-weight: bold;">'+'<?php echo $this->lang->line("time_del_unsucc");?>'+'</lable>')
								$('#del_scc').fadeOut(5000);
							}
							after_ajax_addi();
						}
					});
				}
			}
		//check login end
		}  
	});
	
}

function DeleteServiceRow(emp_id,service_id){
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
			url: "<?php echo base_url(); ?>admin/business_hour/del_emp_service",
			type: "POST",
			data: { 'emp_id': emp_id, 'service_id': service_id },
			success: function(msg) {
				$('#DispStaffHourDetails'+emp_id).html(msg);
				//alert(msg);
			}
		});	
		}
	//check login end
	}  
});	

}

</script>

<script>
function hideStaffHourDetails(employee_id){	
	$('#DispStaffHourDetails'+employee_id).hide();
	$('#arrowright'+employee_id).show();
	$('#arrowdown'+employee_id).hide();
	
}

</script>
<script>
$(function() {	
	$('#timepickerFrom').keypress(function(event) {
        event.preventDefault();
	});
	$('#timepickerTo').keypress(function(event) {
        event.preventDefault();
	});
});
</script>

<!--palash start-->
<script>
function AddAdditionalTime()
{
$('#div_addi_time').toggle();
//alert('Hello');
	
}
function after_ajax_addi(){
	$('#div_addi_time').hide();
	$('.show_staff_addi_content').hide();
	
	$('#show_staff_addi').click(function(){
		$('.show_staff_addi_content').toggle();
		$('#show_staff_addi_tr').hide();
	})
	
	$(".del div").hover(
		function () {
		//	$(this).addClass("activLi");
			$(this).children('a.del-icon').show();
		},
		function () {
		//	$(this).removeClass("activLi");
		$(this).children('a.del-icon').hide();
		}
	);
	
	
};

function addTime(){
	var rowCount = $('#expense_table tr:last').attr("id").split('_');
	if($("#timepickerFrom_"+rowCount[1]).val() == '' || $("#timepickerTo_"+rowCount[1]).val() == ''){
		$('#err-dt-st-end').html('<lable style="color:#F00;">'+'<?php echo $this->lang->line("fil_last_strt_end_time")?>'+'</lable>');
	}else{
		
		$('#err-dt-st-end').html('<img src="'+SITE_URL+'/asset/admin_small_loader.gif"/> &nbsp; <span class="error" style="color:#3571A3;">'+'<?php echo $this->lang->line("chking_time")?>'+'</span>');
		var serviceVals = new Array;
		 $('#services :checked').not("input[value='']").each(function() {
		   serviceVals.push($(this).val());
		 });
		 
		 var staffVals =  new Array;
		 $('#staff :checked').not("input[value='']").each(function() {
		   staffVals.push($(this).val());
		 });
		 
		 var daysVals =  new Array;
		 $('#days :checked').not("input[value='']").each(function() {
		   daysVals.push($(this).val());
		 });
		 var myStr='';
		 if(serviceVals.length == 0){
		 	myStr+='<?php echo $this->lang->line("pls_sel_ser");?><br>';
		 }
		 if(staffVals.length == 0){
		 	myStr+='<?php echo $this->lang->line("pls_sel_staff");?><br>';
		 }
		 if(daysVals.length == 0){
		 	myStr+='<?php echo $this->lang->line("pls_sel_day")?><br>';
		 }
	if(myStr == ''){
		result = new Array;
		result['service'] = new Array;
		result['service'] = serviceVals;
		result['staff'] = new Array;
		result['staff'] = staffVals;
		result['days'] = new Array;
		result['days'] = daysVals;

		var timeArray = $('#expense_table').find('input').serializeArray();
		var jObject={};
		for(i in result){
			jObject[i] = result[i];
		}
		jObject= $.stringify(jObject);
		var startTime = $("#timepickerFrom_"+rowCount[1]).val();
		var endTime = $("#timepickerTo_"+rowCount[1]).val();
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'admin/login';
				}else{
					$.ajax({
					url: "<?php echo base_url(); ?>admin/business_hour/fn_chlbizHrtime",
					type: "POST",
					data: { 'startTime': startTime, 'endTime': endTime, jsondata: jObject },
					success: function(result){
						var result1 = result.trim();
						if(result1 == 'done'){
								$('#err-dt-st-end').html('');
								var newId=parseInt(rowCount[1])+1;
								var str='';
								str+='<tr id="trId_'+newId+'">';
								str+='<td>&nbsp;<lable style="font-size: 13px;font-weight: bold;">'+newId+'.</lable>&nbsp;</td>';
							    str+='<td>'+'<?php echo $this->lang->line("busi_time_from");?>'+'</td>';
								str+='<td>&nbsp;:&nbsp;</td>';
								str+='<td><input type="text" id="timepickerFrom_'+newId+'" name="timepickerFrom_'+newId+'" value="" class="text-input-bizhours pickTime required"/></td>';
								str+='<td>'+'<?php echo $this->lang->line("busi_time_to");?>'+'</td>';
								str+='<td>&nbsp;:&nbsp;</td>';
								str+='<td><input type="text" id="timepickerTo_'+newId+'" name="timepickerTo_'+newId+'" value="" class="text-input-bizhours pickTime required"/></td>';
								str+='<td><img style="cursor: pointer;" onclick="deleteTime('+newId+')" src="'+SITE_URL+'/asset/deletetime.png"/></td>';
								str+='</tr>';
								$('#expense_table').append(str);
								$('.pickTime').timepicker({showSecond: true,timeFormat: 'hh:mm:ss'});
								$('.pickTime').focus(function(){
								var localId = $(this).attr('id');
									removeError(localId)
								})
						}else{
							$('#err-dt-st-end').html('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("sry_tm_range_in_sys")?>'+' </span>');
						}
					}
				});
				}
			//check login end
			}  
		});			
		
	}else{
		$('#err-dt-st-end').html('<lable style="color:#F00;">'+myStr+'</lable>');	
	}	 
	}
}

function deleteTime(trId){
	$('#trId_' + trId).remove();
}


$(function() {
	$('.pickTime').timepicker({showSecond: true,timeFormat: 'hh:mm:ss'});//,second: 59
	$('.pickTime').focus(function(){
		var localId = $(this).attr('id');
		removeError(localId);
	})
});

function timeCheckAjax(data){
	$('#err-dt-st-end').html('<img src="'+SITE_URL+'/asset/admin_small_loader.gif"/><span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("chking_time");?>'+'</span>');
	var startTime = $("#timepickerFrom_"+data).val();
	var endTime = $("#timepickerTo_"+data).val();	
$.ajax({
	url: SITE_URL+"page/fn_checkLogInAdmin",
	type: "post",
	success: function(result){
	//check login start
		if(result == 0){
			window.location.href = SITE_URL+'admin/login';
		}else{
			$.ajax({
			url: "<?php echo base_url(); ?>admin/business_hour/fn_chlbizHrtime",
			type: "POST",
			data: { 'startTime': startTime, 'endTime': endTime },
			success: function(result){
				var result1 = result.trim();
				if(result1 == 'done'){
					$('#err-dt-st-end').html('');
				}else{
					$('#err-dt-st-end').html('<span class="error" style="color:#F00;">'+'<?php echo $this->lang->line("sry_tm_range_in_sys");?>'+' </span>');
				}
			}
		});
		}
	//check login end
	}  
});	

}

function removeError(localId){
	$('#'+localId+' ~ span:first').remove();
	$('#err-dt-st-end').html('');
}

function minFromMidnight(time){
tt=time.split(":");
sec=tt[0]*3600+tt[1]*60+tt[2]*1;
 return sec;
}

function editSchedule(empId,bizHrId){
	pr_popup(400)
	$('#admin_popup_content').html('<img style="margin: 0 0 0 218px;" src="'+SITE_URL+'/asset/wait_a_min.gif"/>');
	$.ajax({
		url: SITE_URL+"page/fn_checkLogInAdmin",
		type: "post",
		success: function(result){
		//check login start
			if(result == 0){
				window.location.href = SITE_URL+'admin/login';
			}else{
					$.ajax({
					url: "<?php echo base_url(); ?>admin/business_hour/editBusinessHour",
					type: "POST",
					data: { 'empId': empId, 'bizHrId': bizHrId },
					success: function(result){
						
						$('#admin_popup_content').html(result.trim());
						callUpdateFunction();
					}
				});
			}
		//check login end
		}  
	});	

}
function callUpdateFunction(){
    $('.pickTime').timepicker({showSecond: true,timeFormat: 'hh:mm:ss'});
    $('.pickTime').focus(function(){
        var localId = $(this).attr('id');
        $('#'+localId+' ~ span:first').remove();
    })
    $('#update_btn_biz_hour').click(function(){
        $('.err').remove();
        $('#biz_hr_pop_update').html('');
        var start	= $('#timepickerFrom_update').val();
        var end		= $('#timepickerTo_update').val();
        var bizHrId	= $('#bizHrId').val();
        var empId	= $('#empId').val();
        var day_id	= $('#day_id').val();
       
        var timeError = 0;
        if(start == ''){
            $('<span class="err" style="color:#F00;">'+'<?php echo $this->global_mod->db_parse($this->lang->line("strt_time_req"))?>'+'</span>').insertAfter('#timepickerFrom_update');
            timeError++;
        }
        if(end == ''){
            $('<span class="err" style="color:#F00;">'+'<?php echo $this->global_mod->db_parse($this->lang->line("end_time_req"));?>'+'</span>').insertAfter('#timepickerTo_update');
            timeError++;
        }
        if(start == end && end != '' && start != ''){
            $('<span class="err" style="color:#F00;">'+'<?php echo $this->global_mod->db_parse($this->lang->line("strt_time_end_time"));?>'+'</span>').insertAfter('#timepickerTo_update');
            timeError++;
        }
        if(start>end  && end != '' && start != ''){
            $('<span class="err" style="color:#F00;">'+'<?php echo $this->global_mod->db_parse($this->lang->line("sml_strt_end_time"))?>'+'</span>').insertAfter('#timepickerTo_update');
            timeError++;
        }
        if(timeError ==0){
            $('#biz_hr_pop_update').html('<img src="'+SITE_URL+'/asset/admin_small_loader.gif"/> &nbsp; <span style="color:#3571A3;">Updating...</span>');
            //$('#biz_hr_pop_update').html('<img src="'+SITE_URL+'/asset/small_loader.gif" height="20" width="20"/>&nbsp;<span style="color:#3571A3;">Updating...</span>');
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'admin/login';
					}else{
						 $.ajax({
			                url: "<?php echo base_url(); ?>admin/business_hour/editBusinessHourUpdate",
			                type: "POST",
			                data: { 'startTime': start, 'endTime': end, 'bizHrId':bizHrId, 'empId':empId,'day_id':day_id},
			                success: function(msg){
			                    var result = msg.split('@|^_^|@');
			                    if(result[1] == 'done'){
			                        pr_popup_close()
			                        $('#DispStaffHourDetails'+empId).html(result[0]);
			                        $('#resultContenar').html('<lable id="scc_scc" style="color:#007A00;font-size: 18px;font-weight: bold;"> '+'<?php echo $this->global_mod->db_parse($this->lang->line("update_success"));?>'+'</lable>');
			                        $('#scc_scc').fadeOut(5000);
									after_ajax_addi();
			                    }else{
			                        $('#biz_hr_pop_update').html('<lable style="color:#F00;">'+result[0]+'</lable>');
			                    }
			                }
			            });
					}
				//check login end
				}  
			});
           
        }
    })
}



function pr_popup(popWidth) {
	//popWidth --- width of popup
	if ($("#front_popup").length == 0 ) {
        	$('<div id="front_popup" class="popup_block"><span id="admin_popup_content"></span></div>').insertAfter($(".maincontainer"));
    	}
	var popID = 'front_popup'; //id of popup

    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="pr_popup_close()" src="'+SITE_URL+'/asset/front_image/close_pop.png" class="btn_close" border="0" />');

	if($('#' + popID).height()==0){
		var popMargTop = 200;
	}else{
		var popMargTop = ($('#' + popID).height() + 80) / 2;
	}
    var popMargLeft = ($('#' + popID).width() + 80) / 2;

    $('#' + popID).css({
        'margin-top' : -popMargTop,
        'margin-left' : -popMargLeft
    });

    $('body').append('<div id="fade"></div>');
    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
    return false;
}
//Close Popups and Fade Layer
function pr_popup_close() {
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    return false;
}
</script>
<style>
	
#fade { /*--Transparent background layer--*/
	display: none; /*--hidden by default--*/
	background: #969696;
	position: fixed; left: 0; top: 0;
	width: 100%; height: 100%;
	opacity: .80;
	z-index: 9999;
}
.popup_block{
	display: none; /*--hidden by default--*/
	background: #fff;
	padding: 20px;
	border: 6px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top:120px; left: 50%;
	z-index: 99999;
	/*--CSS3 Box Shadows--*/
	-webkit-box-shadow: 0px 0px 20px #000;
	-moz-box-shadow: 0px 0px 20px #000;
	box-shadow: 0px 0px 20px #000;
	/*--CSS3 Rounded Corners--*/
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	border-radius: 10px;
	margin-top:0px!important;
}
img.btn_close {
	float: right;
	margin:  -40px -36px 0 0;
	cursor: pointer;
	background:#01539D;
	padding:3px 5px;
	border-radius:5em;
}
/*--Making IE6 Understand Fixed Positioning--*/
*html #fade {
	position: absolute;
}
*html .popup_block {
	position: absolute;
}

</style>
<!--palash start-->