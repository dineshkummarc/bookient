<script>

 //CB#SOG#15-1-2013#PR#S    
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

//CB#SOG#15-1-2013#PR#E
</script>

<script language="javascript" type="text/javascript">
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
	$(this).attr("checked",status);
	})
}

$(document).ready(function() {
$(".all").change(function() {
	   $(this).siblings().find(':checkbox').attr('checked', this.checked);
	   });
});

$(function() {
	$('#timepickerFrom').timepicker({});
	$('#timepickerTo').timepicker({});
});


$(document).ready(function() { 
$('td.del').live("mouseover", function(){
			//alert("asdlkhas");						 
			$(this).children('a.del-icon').show();
});
		
$('td.del').live("mouseout", function(){
			$(this).children('a.del-icon').hide();
});				   
						   
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
				$parentTag.addClass('error').append($error.clone().text('Required Field'));
			}
		});	
		
		var servicesSelected =  $('#services').children().find('input[type=checkbox]:checked').not("input[value='']").size();
/*		var staffSelected 	 =  $('#staff').children().find('input[type=checkbox]:checked').not("input[value='']").size();
*/		var daysSelected 	 =  $('#days').children().find('input[type=checkbox]:checked').not("input[value='']").size();

                 //CB#SOG#17-12-2012#PR#S

                    var time_from = $('#timepickerFrom').val();
                    var start = time_from.split(":");
                    var start_time = parseInt(start[0])*60 +parseInt(start[1]);
                    var time_to = $('#timepickerTo').val();
                    var end = time_to.split(":");
                    var end_time = parseInt(end[0])*60 +parseInt(end[1]);

                  //alert(start_time); return false;
                    //alert(end_time); return false;

                    if(end_time < start_time)
                    {
                         $('#timepickerTo').after('<span class="error" style="color:#FF0000;">End time should be greater than Start time.</span>');
                         
                    }
                   //CB#SOG#17-12-2012#PR#E

		
		
		if(servicesSelected == 0)
		{
			$('#servicemsg').html('<span class="error" style="color:#F00;">Plaese select atleat one checkbox</span>');
		}
		/*if(staffSelected == 0)
		{
			$('#staffmsg').html('<span class="error" style="color:#F00;">Plaese select atleat one checkbox</span>');
		}*/
		if(daysSelected == 0)
		{
			$('#daysmsg').html('<span class="error" style="color:#F00;">Plaese select atleat one checkbox</span>');
		}
		
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
			 
			/* var staffVals =  new Array;
			 $('#staff :checked').not("input[value='']").each(function() {
			   staffVals.push($(this).val());
			 });*/
			 
			 var daysVals =  new Array;
			 $('#days :checked').not("input[value='']").each(function() {
			   daysVals.push($(this).val());
			 });
			 
			 
			 var timeFrom =  new Array;
			 timeFrom[0]  =  $("#timepickerFrom").val();
			 
			 
			 var timeTo =  new Array;
			 timeTo[0]  =  $("#timepickerTo").val();
			 
					 
			 
			 
			 result = new Array;
			 result['service'] = new Array;
			 result['service'] = serviceVals;
			/* result['staff'] = new Array;
			 result['staff'] = staffVals;*/
			 result['days'] = new Array;
			 result['days'] = daysVals;
			 
			 result['timeFrom'] = new Array;
			 result['timeFrom'] = timeFrom;
			 
			 result['timeTo'] = new Array;
			 result['timeTo'] = timeTo;
			 
			 var jObject={};
			 for(i in result)
			 {
				jObject[i] = result[i];
			 }
			 jObject= $.stringify(jObject);
			 $.ajax({//alert("test_2");
					url: "<?php echo base_url(); ?>staff/business_hour/add_biz_hour/",
					type: "POST",
					data: {jsondata: jObject},
					dataType: 'html',
					success: function(msg) {
						
						//alert(msg);
						//alert($('#DispStaffHourDetails').html());
						$('#suss_msg').html(msg);
					}
				});
		}
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

function showStaffHourDetails(employee_id)
{
	$('.down-arrow').hide();
	$('.right-arrow').show();
	$('.business-hour').hide();
	$('.right-arrow').show();
	$('#arrowdown'+employee_id).show();
	$('#DispStaffHourDetails'+employee_id).show();
	$('#arrowright'+employee_id).hide();
	
	$.ajax({
		url: "<?php echo base_url(); ?>staff/business_hour/show_biz_hour/"+employee_id,
		type: "POST",
		//data: {jsondata: jObject},
		//dataType: 'json',
		success: function(msg) {
			//$('#DispStaffHourDetails').html('');
			$('#DispStaffHourDetails'+employee_id).html(msg);
			//alert(msg);
		}
	});
}

function DeleteSchedule(emp_id,id)
{
	$.ajax({
		url: "<?php echo base_url(); ?>staff/business_hour/del_biz_hour",
		type: "POST",
		data: { 'emp_id': emp_id, 'id': id },
		success: function(msg) {
			$('#DispStaffHourDetails'+emp_id).html(msg);
			$('#suss_msg').html("");
		}
	});
}

function DeleteServiceRow(emp_id,service_id)
{
	$.ajax({
		url: "<?php echo base_url(); ?>staff/business_hour/del_emp_service",
		type: "POST",
		data: { 'emp_id': emp_id, 'service_id': service_id },
		success: function(msg) {
			$('#DispStaffHourDetails'+emp_id).html(msg);
			//alert(msg);
		}
	});
}

</script>
<script>
$(document).ready(function() { 
$('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});
});


</script>
<script>
function hideStaffHourDetails(employee_id)
{
	
	$('#DispStaffHourDetails'+employee_id).hide();
	$('#arrowright'+employee_id).show();
	$('#arrowdown'+employee_id).hide();
	
}

</script>