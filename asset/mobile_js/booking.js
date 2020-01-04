function get_staff(){
		var i=0;
		var ls_staff=[];		
		$( "#activeStaff input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_staff[i] = $(this).val();
				i++;
		   	 }
		});
	return ls_staff;
}

function get_service(){
		var j=0;
		var ls_services=[];
		$( "#activeService input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});	
	return ls_services;
}

function mobileInvoiceFormGenerator(){
	$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
	params = {};
	params['bDate'] 	= $('#selectedDate').val();
	params['bTime'] 	= $('#selectedTime').val();
	params['staffArr'] 	= get_staff();
	params['srvArr'] 	= get_service();
	$.ajax({
	      url: SITE_URL+"page/mobile_genaratBookingInvoicAndRepBooking",
	      type: "post",
	      data: params,
	      success: function(invosSlot){ 
	      console.log(invosSlot);
				$("#inVoisCont").html(invosSlot);
				$("#inVoisCont").trigger('create');
				$('.bookingContent').show('slow');
				$(".loader").remove();
				//if($('#serviceCounter').val() > 0){
				//	$('#booked').hide();
				//}
				mobileBooking();
	      		}  
		});
}

function mobileBooking(){
	$('#repSelect').change(function(){
		var repType = $(this).val();
		if(repType == 0){
			$('.repCont').hide();
		}
		if(repType == 1){
			$('.repCont').hide();
			$('#dailyCont').show();
		}
		if(repType == 2){
			$('.repCont').hide();
			$('#weekCont').show();
		}
		if(repType == 3){
			$('.repCont').hide();
			$('#monthCont').show();
		}
		if(repType == 4){
			$('.repCont').hide();
			$('#yearCont').show();
		}
	})
	
	$(".repDatepicker").datepicker({
					minDate: new Date(),
					changeMonth: false,
					changeYear: false,
					inline: true,
					dateFormat: 'dd-mm-yy',
                    onSelect: function(selectedDate) {
								var repetType = $(this).attr('id');
								if(repetType =='dayPicker'){
									var repetMode = $('#daySelectRep').val();
									var extraInfo = '';
									mobileRepetBooking('day',selectedDate,repetMode,extraInfo);	
								}
								if(repetType =='weekPicker'){
									var repetMode = $('#weekSelectRep').val();
									var extraInfo = new Array();

									$(".dayOfWeek").find("input:checked").each(function (i, ob) { 
									    extraInfo.push($(ob).attr('id')); 
									});
									mobileRepetBooking('week',selectedDate,repetMode,extraInfo);	
								}
								if(repetType =='monthPicker'){
									var repetMode = $('#monthSelectRep').val();
									var extraInfo = '';
									mobileRepetBooking('month',selectedDate,repetMode,extraInfo);
								}
								if(repetType =='yearPicker'){
									var repetMode = $('#yearSelectRep').val();
									var extraInfo = '';
									mobileRepetBooking('year',selectedDate,repetMode,extraInfo);	
								}
                              }
	});
	
	$("#dicsShow").click(function(){
		$("#discuntValue").val('')
		$("#dicsShow").hide();
		$("#dicsHide").show();
	})
	
	$('#discuntValueBtn').click(function(){
	
	
	
		$(".couponMsg").remove();
		var bookingDetails = $(this).attr('bookingDetails');
		var dCupon = $("#discuntValue").val().trim();
		if(dCupon == ''){
			$("#discuntValue").attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
			return false;
		}else{
		apply_coupon(dCupon,bookingDetails);
		/*
			$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
			params = {};
			params['dCupon'] 	= dCupon;
			$.ajax({
			      url: SITE_URL+"page/mobile_BookingDisCupon",
			      type: "post",
			      data: params,
			      success: function(returnCupon){ 
						$(".loader").remove();
						$('#dicsShow').html('<label style="color: red;">Invalid or expired code.</label> change code');
						$("#dicsShow").show();
						$("#dicsHide").hide();
			      }  
			});
			*/
		}
	})
	$("#discuntValue").focus(function(){
		$(this).removeAttr('style');
		$(".couponMsg").remove();
	});
	
	$("#discuntValue").click(function(){$(this).removeAttr('style');})
	
	$('.accepyBook span').click(function(){
		$(".accepyBook").removeAttr('style');
		if($("#termsConditions").is(':checked')){ 
			$("#termsConditions").removeAttr('checked');
			$('.payCont').hide();
		}else{
			$("#termsConditions").attr('checked','checked');
			$('.payCont').show();
		}
	})
	
	$('#termsConditions').change(function(){
		if($("#termsConditions").is(':checked')){ 
			$('.payCont').show();
		}else{
			$('.payCont').hide();
		}
	})

	$('#booked').click(function () {
	    if ($("#termsConditions").is(':checked')) {
			$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
	        var paymentType = $(".payCont input[type='radio'][name='payMood']:checked").val().trim();
	        //alert(paymentType)
	        var frmID = '#bookingShowFrm';
	        params = {};
	        var paramsObj = $(frmID).serializeArray();
	        $.each(paramsObj, function (i, field) {
	            params[field.name] = field.value;
	        });
	        params['bDate'] = $('#selectedDate').val();
	        params['bTime'] = $('#selectedTime').val();
	        params['staffArr'] = get_staff();
	        params['srvArr'] = get_service();
	        params['paymentType'] = paymentType;
	        $.ajax({
	            url: SITE_URL + "page/mobileSaveBooking",
	            type: "post",
	            data: params,
	            success: function (invosSlot) {
	                if (invosSlot > 0) {
						$(".loader").remove();
	                   	var MyMsg ='Your booking successfully completed. Please check your appointment to view the booking. <p style="margin-left:50px;"> <button data-role="button" data-icon="refresh" data-theme="e" data-iconpos="right" data-inline="true" data-mini="true" onclick="bookingRefresh()">Continue</button> </p>';
						pr_popup(200);
						$('.btn_close').hide();
					    $('#front_popup_content').html(MyMsg);
						$("#front_popup_content").trigger('create');
	                }
	            }
	        });
	    } else {
	        $(".accepyBook").attr('style', 'border: 1px solid #E50000; background: #efcbcb !important;');
	    }

	})
	
}

function bookingRefresh(){
	location.reload();
}

function mobileRepetBooking(repetType,selectedDate,repetMode,extraInfo){
	$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
	var frmID = '#bookingShowFrm';
	params = {};
	params['bDate'] 	= $('#selectedDate').val();
	params['bTime'] 	= $('#selectedTime').val();
	params['staffArr'] 	= get_staff();
	params['srvArr'] 	= get_service();
	//for repet booking
	params['repetType'] 	= repetType;
	params['selectedDate'] 	= selectedDate;
	params['repetMode'] 	= repetMode;
	params['extraInfo'] 	= extraInfo;
	var paramsObj = $(frmID).serializeArray();
	$.each(paramsObj, function(i, field){
	  params[field.name] = field.value;
	});
	$.ajax({
	      url: SITE_URL+"page/mobile_genaratBookingInvoicAndRepBooking",
	      type: "post",
	      data: params,
	      success: function(invosSlot){ 
				$("#inVoisCont").html(invosSlot);
				$("#inVoisCont").trigger('create');
				$('.bookingContent').show('slow');
				$(".loader").remove();
				mobileBooking();
	      }  
	});
}

function mobileSetStatus(action,changeId){
    var didConfirm = confirm("Are you sure to cancel?");
    if (didConfirm == true) {
        var hidden = $("#counter").val();
        hidden++;
        $('#counter').val(hidden);
        $.ajax({
            type: "post",
            url: SITE_URL+"page/changeAppointmentStatus",
            data: { 'status' : action, 'serviceId' : changeId },
            success: function(result){
                if($.trim(result) == 1){
                    $('#status_'+changeId).html('<span class="succesAlert">Appointment cancelled successfully</span>');
                }
            }  	
        })
    }
}

function mobileAvilableTimeSlot(){
			$('.calenderContent').slideUp('slow');
			$(".start-popup").remove();
			$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
			params = {};
			params['bDate'] 	= $('#selectedDate').val();
			params['staffArr'] 	= get_staff();
			params['srvArr'] 	= get_service();
			$.ajax({
			      url: SITE_URL+"page/mobile_availBookingTime",
			      type: "post",
			      data: params,
			      success: function(TimeSlot){ 
				  		if(TimeSlot.trim() == ''){
							var dataStr  = '<div class="SmallTopBook">';
								dataStr += pLang['dayalert_mob'];
								dataStr += '</div>';
							$("#curTimeSlot").html(dataStr);
							$("#timeNext").parent().hide();
							$('.timeContent').show('slow');
							$(".loader").remove();
						}else{
							$("#curTimeSlot").html(TimeSlot);
							$('.timeContent').show('slow');
							if($("#selectTime").length == 0 ) {
								$('<div class="start-popup" id="selectTime"><p>'+pLang['selectTime_mob']+'</p></div>').insertAfter($("#mainContent"));
								$( "#selectTime" ).animate({bottom: "85px"},1000);
							}
							$(".loader").remove();
							timeContener();
						}	
			      }  
			});
}
















/*

 $("#discuntValueBtn").click(function(){
 alert("hiiii");
	 	$(".couponMsg").remove();
	 	var couponCode = $('#discuntValue').val();
		var bookingDetails = $(this).attr('bookingDetails');
		
		if(couponCode != ''){
			apply_coupon(couponCode,bookingDetails);
		}else{
			$('#discuntValue').attr('style','width:110px; border: 1px solid #FF0000; background: #FFE6E6 !important;');
		}
	 }) 
 $("#discuntValue").focus(function(){
	$('#discuntValue').attr('style','width:110px;');
	$(".couponMsg").remove();
 })
 */
 
 
 function apply_coupon(couponCode,bookingDetails){

	//var booking_grand_total= $('#booking_grand_total').val();
	var booking_grand_total= $('#subtotal').val();
	var total= $('#for_coupon_total').val();
	$.ajax({
		url: SITE_URL+"page/fnp_applyCouponCode",
		data:{'couponCode':couponCode,'bookingDetails':bookingDetails ,'booking_grand_total':booking_grand_total,'total':total},
		type: "post",
		success: function(result){
			//alert(result);
			obj = jQuery.parseJSON(result);
			if(obj.error == 1){
				$('#coupon_msg_mobile').html('<div class="couponMsg" style="color:#FF0000">'+obj.msg+'</div>');
				$('#discount_coupon_tr').hide();
				$('#discount_coupon').val('');
				$('#final_total_td').html(obj.currency_type+" "+obj.total);
				$('#total').val(total);
			}else{
				$('#coupon_msg_mobile').html('<div class="couponMsg" style="color:#396B03">'+obj.msg+'</div>');
				$('#discount_coupon_tr').show();
				$('#discount_coupon_td').html("-"+obj.currency_type+" "+obj.coupon_amount);			
				$('#discount_coupon').val(obj.coupon_amount);
				$('#final_total_td').html(obj.currency_type+" "+obj.total);
				$('#total').val(obj.total);
				console.log(result);
			}
		}  	
	})
}