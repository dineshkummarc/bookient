$(document).ready(function () {
		var scrollStatus = false;
	//###################################################################################################
	//######################################  On Start end  #############################################
	//################################################################################################### 
	if($('#srvArrMSec').val() != ''){
		var srvArr 	= $("#srvArrMSec").val().split(",");
		srvArr.forEach(function(index) {
			$("#activeService input[type='checkbox'][id='srv_"+index+"']").attr("checked",true).checkboxradio("refresh");
		});
	}
	
	if($('#staffArrMSec').val() != ''){
		var staffArr 	= $("#staffArrMSec").val().split(",");
		staffArr.forEach(function(index) {
			$("#activeStaff input[type='checkbox'][id='staff_"+index+"']").attr("checked",true).checkboxradio("refresh");
			
		});
	}
		
	if($('#timeMSec').val() != ''){
		var localTime = $('#timeMSec').val();
		$('#selectedTime').val(localTime);
		$("#mAvl_"+localTime).addClass('activeTime');
	}
	
	if($('#dateMSec').val() != ''){
		var localDate = $('#dateMSec').val()
		$("#mainCalender").datepicker( "setDate", localDate);
		$('#selectedDate').val(localDate);
	}
	
	if($('#latestContent').val()==''){
		if($("#isLoginM").val() != ''){
			$(".myAppointmentContent").show();
		}else{
			$(".serviceContent").show(); //serviceContent 
		}
	}else{
		var contentType = $('#latestContent').val();
		if(contentType == 'bookingContent'){
			mobileInvoiceFormGenerator()
		}else if(contentType == 'timeContent'){					
			if($("#isLoginM").val() != ''){
				mobileInvoiceFormGenerator()
			}else{
				mobileAvilableTimeSlot();
			}
		}else{
			$('.'+contentType).show();
		}
	}

	/*setTimeout(function(){
		if($(".start-popup").length == 0 ) {
			$('<div class="start-popup" id="selectService"><p>Please select service.</p></div>').insertAfter($("#mainContent"));
			$( "#selectService" ).animate({bottom: "85px"},1000);
		}
	}, 2000);*/

    $(window).scroll(function(){
	    if($('#serviceNext').is(':visible')){
		    var scrollValue=($(document).height()-$(this).height())-60;
			
		    var scrollTopVal=$(this).scrollTop();
		    var serviceCount = $("#activeService input[type=checkbox]:checked").size();
		    if(scrollValue < scrollTopVal){
				scrollStatus = true;
			    $(".black-popup").remove();
		    }else if(scrollTopVal != 0 && $("#selectService").length == 0 && serviceCount !=0 && $(".start-popup").length == 0) {
		        $('<div class="start-popup black-popup" id="selectServiceNext"><p>'+pLang['scroll_next_mob']+'</p></div>').insertAfter($("#mainContent"));
		        $( "#selectServiceNext" ).animate({bottom: "85px"},1000);
		    }else{
				scrollStatus = false;
			}
	    }
	
	    if($('#staffNext').is(':visible')){
		    var scrollValue=($(document).height()-$(this).height())-60;
		    var scrollTopVal=$(this).scrollTop();
		    var serviceCount = $("#activeStaff input[type=checkbox]:checked").size();
		    if(scrollValue < scrollTopVal){
			    $(".black-popup").remove();
		    }else if(scrollTopVal != 0 && $("#selectStaff").length == 0 && serviceCount !=0 && $(".start-popup").length == 0) {
		        $('<div class="start-popup black-popup" id="selectStaffNext"><p>'+pLang['scroll_next_mob']+'</p></div>').insertAfter($("#mainContent"));
		        $( "#selectStaffNext" ).animate({bottom: "85px"},1000);
            }
	    }	
			
	})
	
	$('input').focus(function(){
		$(".ui-footer-fixed").css("top", $(window).height()-70);
		$(".ui-footer-fixed").css("bottom", "auto");
	})
	
	$('input').blur(function(){
		$(".ui-footer-fixed").css("top", '');
		$(".ui-footer-fixed").css("bottom", '');
	}) 
	
	//###################################################################################################
	//######################################  On Start end  #############################################
	//###################################################################################################
	
	
	
	//###################################################################################################
	//######################################  Service section end  ######################################
	//###################################################################################################

	$(".ui-checkbox input[type='checkbox'][name='srv']").change(function(){
		if($("#selectService").length > 0 ) { 
			$( "#selectService" ).remove();
		}
		var serviceCount = $("#activeService input[type=checkbox]:checked").size();
		if(serviceCount == 0){
			$("#selectServiceNext" ).remove();
			$('<div class="start-popup" id="selectService"><p>'+pLang['selectService_mob']+'</p></div>').insertAfter($("#mainContent"));
			$("#selectService" ).animate({bottom: "85px"},1000);
		}else{
			if(scrollStatus){
				$('.start-popup' ).remove();
			}else{
				if($("#selectServiceNext").length == 0 ) {
					$('<div class="start-popup black-popup" id="selectServiceNext"><p>'+pLang['scroll_next_mob']+'</p></div>').insertAfter($("#mainContent"));
					$( "#selectServiceNext" ).animate({bottom: "85px"},1000);
				}
			}
		}
		
	})

	
	$("#serviceNext").click(function(){		
		var serviceCount = $("#activeService input[type=checkbox]:checked").size();
		if(serviceCount == 0){
			if($("#selectService").length == 0 ) {
				$('<div class="start-popup" id="selectService"><p>'+pLang['selectService_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectService" ).animate({bottom: "85px"},1000);
			}else{
				$( "#selectService" ).addClass('animated shake');
				setTimeout(function(){$( "#selectService" ).removeClass('animated shake');}, 1000);
			}
		}else{
			$('.start-popup' ).remove();
			$('.staffContent').show('slow');
			$('.serviceContent').slideUp('slow');
			var stffCount = $("#activeStaff input[type=checkbox]:checked").size();
			if($("#selectStaff").length == 0 && stffCount == 0) {
				$('<div class="start-popup" id="selectStaff"><p>'+pLang['selectEmp_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectStaff" ).animate({bottom: "85px"},1000);
			}
			$('#latestContent').val('');
			$('#latestContent').val('staffContent');
		}
	})
	
	//###################################################################################################
	//###################################### Service section start ######################################
	//###################################################################################################
	
	
	//###################################################################################################
	//###################################### Employee section start #####################################
	//###################################################################################################
	$("#serviceBack").click(function(){
		$('.staffContent').slideUp('slow');
		$('.serviceContent').show('slow');
		$( "#selectStaff" ).remove();
	})
	
	$(".ui-checkbox input[type='checkbox'][name='staff']").change(function(){
		var stffCount = $("#activeStaff input[type=checkbox]:checked").size();
		if(stffCount == 0){
			if($("#selectStaff").length == 0 ) {
				$( "#selectStaffNext" ).remove();
				$('<div class="start-popup" id="selectStaff"><p>'+pLang['selectEmp_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectStaff" ).animate({bottom: "85px"},1000);
			}
		}else{
			if(scrollStatus){
				$('.start-popup' ).remove();
			}else{
				if($("#selectStaffNext").length == 0 ) {
					$( "#selectStaff" ).remove();
					$('<div class="start-popup black-popup" id="selectStaffNext"><p>'+pLang['scroll_next_mob']+'</p></div>').insertAfter($("#mainContent"));
					$( "#selectStaffNext" ).animate({bottom: "85px"},1000);
				}
			}	
		}	
	})	
	
	$("#staffNext").click(function(){
		var stffCount = $("#activeStaff input[type=checkbox]:checked").size();
		if(stffCount == 0){
			if($("#selectStaff").length == 0 ) {
				$('<div class="start-popup" id="selectStaff"><p>'+pLang['selectEmp_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectStaff" ).animate({bottom: "85px"},1000);
			}else{
				$( "#selectStaff" ).addClass('animated shake');
				setTimeout(function(){$( "#selectStaff" ).removeClass('animated shake');}, 1000);
			}
		}else{
			$('.staffContent').slideUp('slow');
			$('.calenderContent').show('slow');
			$(".start-popup").remove();
			if($("#selectCalender").length == 0 && $('#selectedDate').val() == '') {
				$('<div class="start-popup" id="selectCalender"><p>'+pLang['selectDate_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectCalender" ).animate({bottom: "85px"},1000);
			}
			$('#latestContent').val('');
			$('#latestContent').val('calenderContent');
		}
		
		$( ".ui-state-default" ).removeClass('ui-btn-active');
		//$( ".ui-state-default" ).removeClass('ui-btn-up-e');//Yellow marks for current date
	})
	
	
	//###################################################################################################
	//####################################### Employee section end ######################################
	//###################################################################################################

	//###################################################################################################
	//####################################### Calender section Start ####################################
	//###################################################################################################
	$("#mainCalender").datepicker({
						minDate: new Date(),
						changeMonth: false,
						changeYear: false,
					//	inline: true,
						dateFormat: 'dd-mm-yy',
                        onSelect: function(selectedDate) {
										$('#selectedDate').val('');
										$('#selectedDate').val(selectedDate);
										$(".start-popup").remove();
                                  }
			});
	
	
	$("#staffBack").click(function(){
		$('.staffContent').show('slow');
		$('.calenderContent').slideUp('slow');
		$(".start-popup").remove();
	})
	
	
	$('#calenderNext').click(function(){
		if($('#selectedDate').val() == ''){
			if($("#selectCalender").length == 0 ) {
				$('<div class="start-popup" id="selectCalender"><p>'+pLang['selectDate_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectCalender" ).animate({bottom: "85px"},1000);
			}else{
				$( "#selectCalender" ).addClass('animated shake');
				setTimeout(function(){$( "#selectCalender" ).removeClass('animated shake');}, 1000);
			}
		}else{
				$('#latestContent').val('');
				$('#latestContent').val('timeContent');
				mobileAvilableTimeSlot();
		}
	})
	//###################################################################################################
	//####################################### Calender section end ######################################
	//###################################################################################################
	
	
	//###################################################################################################
	//#######################################   Time section end   ######################################
	//###################################################################################################
	$("#calenderBack").click(function(){
		$('.calenderContent').show('slow');
		$('.timeContent').slideUp('slow');
		$(".start-popup").remove();
		$("#timeNext").parent().show();
	})

	$('#timeNext').click(function(){
		if($('#selectedTime').val() == ''){
			if($("#selectTime").length == 0 ) {
				$('<div class="start-popup" id="selectTime"><p>'+pLang['selectTime_mob']+'</p></div>').insertAfter($("#mainContent"));
				$( "#selectTime" ).animate({bottom: "85px"},1000);
			}else{
				$( "#selectTime" ).addClass('animated shake');
				setTimeout(function(){$( "#selectTime" ).removeClass('animated shake');}, 1000);
			}
		}else{
			if($('#isLoginM').val()== ''){
				$(".start-popup").remove();
				newLoginFn();
			}else{
				$(".start-popup").remove();
				hideAllContent();
				$('#latestContent').val('');
				$('#latestContent').val('bookingContent');
				mobileInvoiceFormGenerator();//Go to booking.js
			}
		}
	})
	//###################################################################################################
	//#######################################   Time section end   ######################################
	//###################################################################################################
	
	
	//###################################################################################################
	//#######################################   Booked section end   ####################################
	//###################################################################################################
	$("#timeBack").click(function(){
		hideAllContent()
		mobileAvilableTimeSlot();
	})
	//###################################################################################################
	//#######################################   Booked section end   ####################################
	//###################################################################################################
	
	
	//###################################################################################################
	//##################################   Top navigation part start ####################################
	//###################################################################################################
	$('#scheduleCal').click(function(){
		hideAllContent();
		$(".serviceContent").show('slow');
	})
	$('#aboutCal').click(function(){
		hideAllContent();
		$(".start-popup").remove();
		$(".aboutusContent").show('slow');
	})
	$('#reviewCal').click(function(){
		hideAllContent();
		$(".start-popup").remove();
		$(".reviewContent").show('slow');
	})
	$('#aboutSchedule').click(function(){
		hideAllContent();
		$(".start-popup").remove();
		$(".serviceContent").show();
	})
	//###################################################################################################
	//###################################   Top navigation part end #####################################
	//###################################################################################################
	
	//###################################################################################################
	//##################################   Footer navigation part start #################################
	//###################################################################################################

	$('#homeFoot').click(function(){
		window.location.reload();
	})
	$('#privacyFoot').click(function(){
		hideAllContent();
		$(".topMenul").removeClass("ui-btn-active");
		$(".start-popup").remove();
		$(".privacyContent").show('slow');
	})
	$('#securityFoot').click(function(){
		hideAllContent();
		$(".topMenul").removeClass("ui-btn-active");
		$(".start-popup").remove();
		$(".securityContent").show('slow');
	})
	$('#companyFoot').click(function(){
		hideAllContent();
		$(".topMenul").removeClass("ui-btn-active");
		$(".start-popup").remove();
		$(".companyContent").show('slow');
	})
	
	//###################################################################################################
	//###################################   Footer navigation part end ##################################
	//###################################################################################################
	
});


function hideAllContent(){
	$(".serviceContent").slideUp('slow');
	$(".staffContent").slideUp('slow');
	$(".calenderContent").slideUp('slow');
	$(".timeContent").slideUp('slow');
	$(".loginContent").slideUp('slow');
	$(".aboutusContent").slideUp('slow');
	$(".reviewContent").slideUp('slow');
	$(".privacyContent").slideUp('slow');
	$(".securityContent").slideUp('slow');
	$(".companyContent").slideUp('slow');
	$(".myAppointmentContent").slideUp('slow');
	$(".bookingContent").slideUp('slow');
	$(".forgetPasswordContent").slideUp('slow');
	$('.start-popup' ).remove();
}

function timeContener(){
	$('.timeClass li').click(function(){
		$('.timeClass li').removeClass('activeTime');
		$(this).addClass('activeTime');
		$('#selectedTime').val('');
		$('#selectedTime').val($(this).attr('rel'));
		$(".start-popup").remove();
	})
	var curTim = $('#selectedTime').val();
	if(curTim !=''){
		$("#mAvl_"+curTim).addClass('activeTime');
		$(".start-popup").remove();	
	}		
}

/*****************************/
function changeLanguage(language_id){
    $.ajax({
        type: 'POST',
        url: SITE_URL + "customer/customer/Change_lang_Ajax",
        data: { 'val': language_id },
        success: function (data) {
            location.reload();
        }
    });
}
/*****************************/