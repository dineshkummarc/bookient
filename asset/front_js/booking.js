function bookApp(bTime){
	//alert('I am comming soon..'+fn_secToDateTime(bTime))
	lightbox('dynamic_popup_id');
			$.ajax({
			      url: SITE_URL+"page/fn_checkLogIn",
			      type: "post",
			      success: function(result){
					//check login start
					if(result == 1){
						closeLightbox();
						pr_popup(500);
						$('#front_popup_content').html(openLogInForm(bTime));
						logintab('tab1')
					}else{
						obj = fn_settingsArray();
						//booking option strat
						if(obj[0].enable_system == 0){
							closeLightbox();
							pr_popup(350);
							$('#front_popup_content').html(adminAddressDetails());
						}else{
							if(obj[0].pre_booking_frm == 1 && obj[0].pr_filed_count > 0){
								prBookingForm(bTime);
							}else{
								bookingFormDetails(bTime);
							}	
						}
						//booking option end//
					}
					//check login end
			      }  
    		});
}

function adminAddressDetails(){
	obj = fn_settingsArray();
	str='';
	str+='<table border="0" cellpadding="0" cellspacing="0">';
	str+='<tr>';
	str+='<td>';
	str+=pLang['contactDetails'];
	str+='<br><hr style="width:100%">';
	str+='</td>';
	str+='</tr>'
	str+='<tr>'
	str+='<td>'
	str+=obj[0].address;
	str+='</td>'
	str+='</tr>';
	str+='</table>';
	return str;
}

function prBookingForm(bTime){
	
	var service = get_service();
	var staff = get_staff();
	
	//var bTime1 = returnUTCAndLocaltime_month(bTime);
	var timeDiff = $("#gmtDiff").val();
	
	$.ajax({
	      url: SITE_URL+"page/fn_prBookingForm",
		  data:{bookTime:bTime, service:service, staff:staff, timeDiff:timeDiff},
	      type: "post",
	      success: function(result){
		  		closeLightbox();
		  		if(result != 0){
					pr_popup(450);
					$('#front_popup_content').html(result);
					prBookingFormValidation(bTime);
				}else{
					bookingFormDetails(bTime);
				}
		  		
				
				
		  }  	
	 })
}

function bookingFormDetails(bTime,tmpBookDetails){
	var service = get_service();
	var staff = get_staff();
	//var bTime1 = returnUTCAndLocaltime_month(bTime);
	var timeDiff = $("#gmtDiff").val();
	$.ajax({
	      url: SITE_URL+"page/fn_bookingForm",
		  data:{bookTime:bTime, service:service, staff:staff, timeDiff:timeDiff},
	      type: "post",
	      success: function(result){
		  		closeLightbox();
		  		pr_popup(700);
				$('#front_popup_content').html(result);
				bookingForm(bTime,tmpBookDetails);
				
		  }  	
	 })
}
    
    function Onlynum(value,id){
    	
		 if(value != value.replace(/[^0-9\.]/g, '')){
        	value = value.replace(/[^0-9\.]/g, '');
        	document.getElementById(id).value = value;
       	 }
	}

function prBookingFormValidation(bTime){
	$('#btnPreBookFrm').click(function(){
		var errStr ='';
		var radioCount ='';
		var textCount ='';
		var checkCount ='';
		var selectCount ='';
		var dateCount ='';
		var passwordCount ='';
		var errorCount =0;
		$("#frmGenaretPreBook input:radio,#frmGenaretPreBook input:text, #frmGenaretPreBook input:checkbox,#frmGenaretPreBook input:password, #frmGenaretPreBook select ").each(function(){
		var str=$(this).attr('class');

		if($("#frmGenaretPreBook input:radio:checked").length == 0 && str.indexOf("preBook_radio") !=-1 && str.indexOf("dyimRequer")!=-1){
			var radioName = $(this).attr('name');
			if($("#frmGenaretPreBook input[name='"+radioName+"']:checked").length ==''){
				if(radioCount != radioName){
				errStr+='<label style="color:red;" id="label_'+radioName+'">'+pLang['pleaseSelect']+' '+preBookingFormName(radioName)+'.</label><br>';
				radioCount = radioName; 
				errorCount++;
				}	
			};
		}

		if( $(this).val()=='' && str.indexOf("preBook_text") !=-1 && str.indexOf("dyimRequer")!=-1 && str.indexOf("dymDatepiker")==-1){
			var textName = $(this).attr('name');
			if(textName != textCount){
			errStr+='<label style="color:red;" id="label_'+textName+'">'+pLang['pleaseEnter']+' '+preBookingFormName(textName)+'.</label><br>';
			errorCount++;
			textCount = textName;
			}
		}
		
		if( $(this).val()=='' && str.indexOf("preBook_text") !=-1 && str.indexOf("dyimRequer")!=-1 && str.indexOf("dymDatepiker")>0){
			var textName = $(this).attr('name');
			if(textName != dateCount){
			errStr+='<label style="color:red;" id="label_'+textName+'">'+pLang['pleaseEnter']+' '+preBookingFormName(textName)+'.</label><br>';
			errorCount++;
			dateCount = textName;
			}
		}
		
		if($("#frmGenaretPreBook input:checkbox:checked").length ==0 && str.indexOf("preBook_checkbox") !=-1 && str.indexOf("dyimRequer")!=-1){
			var checkBoxName = $(this).attr('name');
			if(checkBoxName != checkCount){
			errStr+='<label style="color:red;" id="label_'+checkBoxName+'">'+pLang['pleaseSelect']+' '+preBookingFormName(checkBoxName)+'.</label><br>';
			errorCount++;
			checkCount = checkBoxName;
			}
		}
		
		if( $(this).val()=='' && str.indexOf("preBook_passowrd") !=-1 && str.indexOf("dyimRequer")!=-1){
			var passwordName = $(this).attr('name');
			if(passwordName != passwordCount){
			errStr+='<label style="color:red;" id="label_'+passwordName+'">'+pLang['pleaseEnter']+' '+preBookingFormName(passwordName)+'.</label><br>';
			errorCount++;
			passwordCount = passwordName;
			}
		}
		
		if($("#frmGenaretPreBook select option:selected").val() ==-1 && str.indexOf("preBook_select") !=-1 && str.indexOf("dyimRequer")!=-1){
			var selectName = $(this).attr('name');
			if(selectName != selectCount){
			errStr+='<label style="color:red;" id="label_'+selectName+'">'+pLang['pleaseSelect']+' '+preBookingFormName(selectName)+'.</label><br>';
			errorCount++;
			selectCount = selectName;
			}
		}	
		});
		if(errorCount !=0){
			$("#preBookErr").html(errStr);
			return false;
		}else{
			$('<img id="prbookImgLoder" style="padding:0px 100px 0px 0px;" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/> &nbsp;&nbsp;&nbsp;&nbsp;').insertBefore("#btnPreBookFrm");
			$("#btnPreBookFrm").remove();
			var frmID = '#frmGenaretPreBook';
			var params =[];
			
			var paramsObj = $(frmID).serializeArray();
			//console.log(paramsObj);
			//var params ='';
			$.each(paramsObj, function(i, field){
							
				var data = {};
		        data.field_name = field.name;
		        data.field_value = field.value;
		        params.push(data);
		        // Now, positions[iteration_index] = { offset: x, height: y }									  	
			});
			//consol.log(params);
			//var params = JSON.stringify(params); 
			
			$.ajax({
		      url: SITE_URL+"page/fnp_preBookingFormSubmit",
			  data:{'params':params},
		      type: "post",
		      success: function(tmpBookDetails){
				bookingFormDetails(bTime,tmpBookDetails);
				//alert(tmpBookDetails);
			 }  	
		 })
		}
	})
	
	$("#frmGenaretPreBook input:text, #frmGenaretPreBook input:checkbox,#frmGenaretPreBook input:password, #frmGenaretPreBook select ").focus(function(){
		var lsId=$(this).attr('id');
		$("#label_"+lsId).remove();
	})
	$("#frmGenaretPreBook input:radio").click(function(){
		var lsId=$(this).attr('name');
		$("#label_"+lsId).remove();
	})
	
	$('.dymDatepiker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
	});
}

function preBookingFormName(fName){
	 var myArray = fName.split('_');
	 var str='';
	 for(i=1;i<myArray.length;i++){
	 	str +=myArray[i]+' ';
	 }
	 return str;
}

function bookingForm(bTime,tmpBookDetails){
	$('#recurType').change(function(){
		//alert($(this).val());
		//selectedWeekDayTxt
		//$(".ui-dropdownchecklist").remove();
		
		if($(this).val()== 1){
			$('.daily').show();
			$('.week').hide();
			$('.month').hide();
			$('.year').hide();
			$('#nxt_button').hide();
		}	
		if($(this).val()== 2){
			$('.daily').hide();
			$('.week').show();
			$('.month').hide();
			$('.year').hide();
			if($("#ddcl-selectedWeekDayTxt").length ==0){
				$("#selectedWeekDayTxt").dropdownchecklist();
			}
			
			$('#nxt_button').hide();
		}	
		if($(this).val()== 3){
			$('.daily').hide();
			$('.week').hide();
			$('.month').show();
			$('.year').hide();
			$('#nxt_button').hide();
		}
		if($(this).val()== 4){
			$('.daily').hide();
			$('.week').hide();
			$('.month').hide();
			$('.year').show();
			$('#nxt_button').hide();
		}
		if($(this).val()== 0){
			$('.daily').hide();
			$('.week').hide();
			$('.month').hide();
			$('.year').hide();
			$('#nxt_button').show();
		}
		$("#recurEndDt").removeAttr('style');
		$("#recurEndDt_wk").removeAttr('style');
		$("#recurEndDt_month").removeAttr('style');
		$("#recurEndDt_year").removeAttr('style');
		$("#errorCont").html('');
	})
	
	$('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        minDate: fn_secToDateFC(bTime) ,
		maxDate: maxBookingDate(),
        changeYear: true,
		onClose: newBookRecurring
	});	

	//validation 
	$('#nxt_button').click(function(){
		for (var i = 1; i < 400; i++){window.clearInterval(i);}
		var selectionType = $('#recurType').val();
		var error=0;
		
		if(selectionType == 1){
			if($('#recurEndDt').val()==''){
				$("#recurEndDt").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
				error++;
			}
		}
		if(selectionType == 2){
			if($('#recurEndDt_wk').val()==''){
				$("#recurEndDt_wk").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
				error++;
			}
		}
		if(selectionType == 3){
			if($('#recurEndDt_month').val()==''){
				$("#recurEndDt_month").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
				error++;
			}
		}
		if(selectionType == 4){
			if($('#recurEndDt_year').val()==''){
				$("#recurEndDt_year").attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
				error++;
			}
		}
		if(error==0){
		//	var bookingData=$('#tempBookingData').serializeArray();
			var frmID = '#tempBookingData';
			var params ={};
			var paramsObj = $(frmID).serializeArray();
			$.each(paramsObj, function(i, field){
			  params[field.name] = field.value;
			});
			
			var paramsObj = $('#recurringBookingFrm').serializeArray();
			$.each(paramsObj, function(i, field){
			  params[field.name] = field.value;
			});
			
			if($("#errorCont").html() !=''){
				var tempBookingRecurringData=$('#tempBookingRecurringData').serializeArray();
			}
			var ls_booking_counter =$("#serviceCounter").val(); 
			if(ls_booking_counter != 0){
				params['bTime'] =bTime;
				params['tempBookingRecurringData'] =tempBookingRecurringData;	
				$.ajax({
			      url: SITE_URL+"page/fn_paymentBookingForm",
				  data:params,
			      type: "post",
			      success: function(result){
			      	
				  		$('#front_popup_content').html(result);
						paymentBookingChecking(bTime,tmpBookDetails)
				 	 }  	
			 	 })
			}else{
				pr_popup(400);
				$(".btn_close").hide();
				$('#front_popup_content').html('<center style="color:#FF0000;">'+pLang['no_schedule_booking']+'<br><br></center><a href="javascript:void(0);" style="float: right;" onclick="pr_popup_close()">'+pLang['click_continue']+'...</a>');
			}
		}
	})
	
	$('#front_popup_content input[type=text]').focus(function(){$(this).removeAttr('style');});
//	countdown('countdown', 5, 0);
}

function maxBookingDate(){
	var someDate = new Date();
	obj = fn_settingsArray();
	var numberOfDaysToAdd = obj[0].adv_bk_mx_tim;
	someDate.setDate(someDate.getDate() + numberOfDaysToAdd); 
	var dd = someDate.getDate();
	var mm = someDate.getMonth() + 1;
	var y = someDate.getFullYear();
	var someFormattedDate = y+'-'+mm+'-'+dd;

	return someFormattedDate;
}

function paymentBookingChecking(bTime,tmpBookDetails){
	 $("#applyCouponButton").click(function(){
	 	$(".couponMsg").remove();
	 	var couponCode = $('#discountCodeOnBook').val();
		var bookingDetails = $(this).attr('bookingDetails');
		
		if(couponCode != ''){
			apply_coupon(couponCode,bookingDetails);
		}else{
			$('#discountCodeOnBook').attr('style','width:110px; border: 1px solid #FF0000; background: #FFE6E6 !important;');
		}
	 }) 
	 $("#discountCodeOnBook").focus(function(){
		$('#discountCodeOnBook').attr('style','width:110px;');
		$(".couponMsg").remove();
	 })
	 $("#checkout_button").click(function(){
	 if ($('#i_accept').is(':checked')) {
		
			var bookingDataToPay = $('#bookingFormPayment').serializeArray();
			var frmID = '#bookingFormPayment';
			var params ={};
				params ={ 'bTime' : bTime };
			var paramsObj = $(frmID).serializeArray();
			$.each(paramsObj, function(i, field){
			    params[field.name] = field.value;
			});
				params['tmpBookDetails'] =tmpBookDetails;
				
	 		$.ajax({
		      url: SITE_URL+"page/fnp_paymentForm",
			  data:params,
		      type: "post",
		      success: function(result){
				if(result == 1){
					pr_popup(510);
					successBooking(bTime);
				}if(result == 2){
					pr_popup_close();
					$.ajax({
				      url: SITE_URL+"page/socialPromotion",
					  data:{'bTime':bTime},
				      type: "post",
				      success: function(result){
				      		pr_popup(500);
							$('#front_popup_content').html(result);
					  }  	
	 				})
						
				}else{
					pr_popup(500);
					$('#front_popup_content').html(result);
					checkingPaymentForm(bTime)
				}	
			  }  	
		 	})
		
	}else{
   		$('#i_accept_span').attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
	} 
	 })
}

function checkingPaymentForm(bTime){
	$('#front_popup_content input[type=text],select').focus(function(){$(this).removeAttr('style');});
	$('.payBooking').keydown(function(e){var e = e || event;if (e.keyCode == 32) return false;});
	$("#checkout_button").click(function(){
		var error=0;
		$( ".pf_required" ).each(function(  ) {
		var ls_id = $(this).attr('id');
			if(ls_id == 'pay_email'){
				if(validateForm($(this).val())==false){
                $('#'+ls_id).attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
                error++;
            	}
			}
			if( ls_id == 'pay_first_name' || 
				ls_id == 'pay_last_name' || 
				ls_id == 'pay_address1' || 
				ls_id == 'pay_city' || 
				ls_id == 'pay_state' ||
				ls_id == 'pay_cardtype' || 
				ls_id == 'pay_month' || 
				ls_id == 'pay_year' ||
				ls_id == 'pay_countrycode'){
				if($(this).val()==''){
                $('#'+ls_id).attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
                error++;
            	}
			}
			if(	ls_id == 'pay_postcode' ||
				ls_id == 'pay_amount' ||
				ls_id == 'pay_ccnumber'){
				if(isNaN($(this).val())==true || $(this).val()=='' ){
                $('#'+ls_id).attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
                error++;
            	}
			}
			if(	ls_id == 'pay_cvv'){
				if(isNaN($(this).val())==true || $(this).val()=='' || $(this).val().length != 3 ){
                $('#'+ls_id).attr('style','border: 1px solid #FF0000; background: #FFE6E6 !important;');
                error++;
            	}
			}
		});
		if(error == 0){
			pr_popup(200);
			$(".btn_close").remove();
			var ls_array		=$("#returnArr").val();
			var pay_email		=$("#pay_email").val();
			var pay_first_name	=$("#pay_first_name").val();
			var pay_last_name	=$("#pay_last_name").val();
			var pay_address1	=$("#pay_address1").val();
			var pay_address2	=$("#pay_address2").val();
			var pay_city		=$("#pay_city").val();
			var pay_state		=$("#pay_state").val();
			var pay_cardtype	=$("#pay_cardtype").val();
			var pay_month		=$("#pay_month").val();
			var pay_year		=$("#pay_year").val();
			var pay_countrycode =$("#pay_countrycode").val();
			var pay_postcode	=$("#pay_postcode").val();
			var pay_amount		=$("#pay_amount").val();
			var pay_ccnumber	=$("#pay_ccnumber").val();
			var pay_cvv			=$("#pay_cvv").val();
			var pay_phone		=$("#pay_phone").val();
			var pay_tax			=$("#pay_tax").val();
			var pay_sub_amount	=$("#pay_sub_amount").val();
			var lastBookingId	=$("#lastBookingId").val();
			var PayData			=$('#frm_paymentDetails').serializeArray();
			//staffArr =	get_staff();
			//servArr  =	get_service();
			$("#front_popup_content").html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/><br><lable style="color:#000000;font-size:20px;font-weight:bold;">'+pLang['pleaseWait']+'<lable></center>');
	 		$.ajax({
		      url: SITE_URL+"page/fnp_sendToPayment",
			  data:{bTime:bTime,
			  	//	staffArr:staffArr,
				//	servArr:servArr,
					PayData:PayData,
					returnArr:ls_array,
					pay_email:pay_email,
					pay_first_name:pay_first_name,
					pay_last_name:pay_last_name,
					pay_address1:pay_address1,
					pay_address2:pay_address2,
					pay_city:pay_city,
					pay_state:pay_state,
					pay_cardtype:pay_cardtype,
					pay_month:pay_month,
					pay_year:pay_year,
					pay_countrycode:pay_countrycode,
					pay_postcode:pay_postcode,
					pay_amount:pay_amount,
					pay_ccnumber:pay_ccnumber,
					pay_cvv:pay_cvv,
					pay_phone:pay_phone,
					pay_tax:pay_tax,
					lastBookingId:lastBookingId,
					pay_sub_amount:pay_sub_amount},
		      type: "post",
			  dataType: "json",
		      success: function(result){
					pr_popup(500);					
			  		if(result.is_success == 1){
						$('#front_popup_content').html(successBooking(bTime));
					}else{
						$('.btn_close').hide();
						$('#front_popup_content').html('<center style="color:#FF0000;">Sorry !! '+result.msg+'.<br><br><button onclick="pr_popup_close_bt()">'+pLang['close']+'</button></center>');
					}   
			 	 }  	  	
		 	})
		}else{
			return false;
		}
	})
}

function validateForm(emailText){
var pattern = /^[a-zA-Z0-9\-_]+(\.[a-zA-Z0-9\-_]+)*@[a-z0-9]+(\-[a-z0-9]+)*(\.[a-z0-9]+(\-[a-z0-9]+)*)*\.[a-z]{2,4}$/;
if (pattern.test(emailText)){
   return true;
}else{
   return false;
}
}	  

function successBooking(bTime){
	$.ajax({
	      url: SITE_URL+"page/socialPromotion",
		  data:{'bTime':bTime},
	      type: "post",
	      success: function(result){
				$('#front_popup_content').html(result);
		  }  	
	 })
}

function newBookRecurring(){
	$('#nxt_button').hide();
	if($(this).val() != ''){
		$(this).removeAttr('style');
		$("#errorCont").html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/></center>');
		var lsArr={};
			lsArr['recurringType'] = $('#recurType').val();
			
		var ls_name = $(this).attr('name');
		if(ls_name == 'bkDayTill'){
			lsArr['recurringOfDay'] = $('#recurRepEv').val();
			lsArr['tillDateOfDay'] 	= $('#recurEndDt').val();
		}
		if(ls_name == 'bkWeekTill'){
			lsArr['recurringOfDayWeek'] = $('#selectedWeekDayTxt').val();
			lsArr['recurringOfWeek'] 	= $('#recurRepEv_wk').val();
			lsArr['tillDateOfWeek'] 	= $('#recurEndDt_wk').val();
		}
		if(ls_name == 'bkMonthTill'){
			lsArr['recurringOfMonth']	= $('#recurRepEv_month').val();
			lsArr['tillDateOfMonth']	= $('#recurEndDt_month').val();
		}
		if(ls_name == 'bkYearTill'){
			lsArr['recurringOfYear']	= $('#recurRepEv_year').val();
			lsArr['tillDateOfYear']		= $('#recurEndDt_year').val();
		}
		
		var frmID = '#tempBookingData';
		var params ={ 'action' : 'save' };
			params ={ 'recurringData' : lsArr };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
		      params[field.name] = field.value;
		});
			
		$.ajax({
		      url: SITE_URL+"page/fnp_recurringAppointment",
			  data:params,
		      type: "post",
		      success: function(result){
			  	$('#nxt_button').show();
			  	if($.trim(result)!=''){
					$("#errorCont").html('');
					$("#errorCont").html(result);
					afterRecurringAppointmentAjax();
				}else{
					$("#errorCont").html('');
					$("#errorCont").html('<label style="color:#FF2C2C;">'+pLang['unable_recurring_booking']+'</label>');		
				}
			 }  	
		 })
	}	
}

function afterRecurringAppointmentAjax(){
	$(".recurringTable").hide();
	var localShowId = 0;
	$(".recurringDiv").click(function(){
		var idArr = $(this).attr('id').split('_');
		if(localShowId == idArr[1]){
			$("#recurringTable_"+idArr[1]).hide(1000);;
			localShowId = 0;
		}else{
			$(".recurringTable").hide(500);
			$("#recurringTable_"+idArr[1]).show(1000);;
			localShowId = idArr[1];
		}
		
	});
}

function pr_popup_close_bt(){
	 $('#fade , .popup_block').fadeOut(function() {
        $('#fade, .btn_close').remove();  //fade them both out
    });
	location.reload();
    return false;
}

function countdown(element, minutes, seconds) {
    var time = minutes*60 + seconds;
    var interval = setInterval(function() {
       // var el = document.getElementById(element);
        if(time == 0) {
            endTheTimer();
        }
        var minutes = Math.floor( time / 60 );
        if (minutes < 10) minutes = "0" + minutes;
        var seconds = time % 60;
        if (seconds < 10) seconds = "0" + seconds; 
        var text = 'Remaining time '+minutes + ':' + seconds;
        $('#'+element).html(text);
        time--;
    }, 1000);
	return interval;
}

function endTheTimer(){
	params ={ 'action' : 'Deleted' };
	var paramsObj = $('#tempBookingData').serializeArray();
	$.each(paramsObj, function(i, field){
	    params[field.name] = field.value;
	});
	$.ajax({
		      url: SITE_URL+"page/deleteTempData",
			  data:params,
		      type: "post",
		      success: function(result){
			  		pr_popup_close();
			  		location.reload(); 
			 	 }  	
		 	})
}

function pr_popup_close_bt_booking(bTime){
	pr_popup_close();
	lightbox('dynamic_popup_id');
	staffArr	=	get_staff();
	servArr		=	get_service();
	$.ajax({
	      url: SITE_URL+"page/holdAfterBooking",
		  data:{bTime:bTime,staffArr:staffArr,servArr:servArr},
	      type: "post",
	      success: function(result){
		  		if(result == 1){
					closeLightbox();
		  			location.reload();
				} 
		 	 }  	
		 })
	
}

function changePrice(quantity,amount,divId,hId){
	var currentPrice = (quantity*amount).toFixed(2);
	$("#bkPrice_"+divId).html(currentPrice);
	$("#recurringCapacity_"+hId).val(quantity);
}

function removeDayWiseBooking(divId){
	$("#recurringMainDiv_"+divId).remove();
}

function removeTimeWiseBooking(divId,hId){
	$("#perBooking_"+divId).remove();
	$("#recurringCapacity_"+hId).remove();
	$("#recurringDateTime_"+hId).remove();
	$("#recurringSrviceId_"+hId).remove();
	$("#recurringEmployeeId_"+hId).remove();
}

////////////////////////////////////////////////////////////////////////////////
////////////////  Set booking after login or sign in start  ////////////////////
////////////////////////////////////////////////////////////////////////////////
function bookingAfterlogin(){
	if($("#contro_bTime").length > 0){
		var bTime		= $("#contro_bTime").val();
		var staffArr	= $("#contro_staffArr").val().split(",");
		var srvArr		= $("#contro_srvArr").val().split(",");
		holdingCommondata(staffArr,srvArr,bTime);
		bookApp(bTime);
	}
	
	if($("#reg_bTime").length > 0){
		var bTime 		= $("#reg_bTime").val();
		var staffArr 	= $("#reg_staffArr").val().split(",");
		var srvArr 		= $("#reg_srvArr").val().split(",");
		holdingCommondata(staffArr,srvArr,bTime);
		bookApp(bTime);
	}
	
	if($("#hold_bTime").length > 0){
		var bTime 		= $("#hold_bTime").val();
		var staffArr 	= $("#hold_staffArr").val().split(",");
		var srvArr 		= $("#hold_srvArr").val().split(",");
		holdingCommondata(staffArr,srvArr,bTime);
	}			
}

function holdingCommondata(staffArr,srvArr,bTime){
	$("#main_date_calender").datepicker( "setDate", fn_secToDate_slash(bTime));
	srvArr.forEach(function(index) {
			$("#ActiveService #srv_"+index).prop('checked','checked');
	});	
	staffArr.forEach(function(index) {
			$("#ActiveStaff #staff_"+index).prop('checked','checked');
	});
	if($("#service_alert").length > 0){
		$("#service_alert").remove();
	}
	if($("#staff_alert").length > 0){
		$("#staff_alert").remove();
	}
	toDaydata();
}

////////////////////////////////////////////////////////////////////////////////
////////////////  Set booking after login or sign in end  //////////////////////
////////////////////////////////////////////////////////////////////////////////

/******************************************************************************/
/************************* Checking spl dates start ***************************/
/******************************************************************************/

function isBookprivTime(bTime){
	var booktmarr=["1:25am","1:30am","1:35am","2:15am","3:00am","4:35am","2:36pm","3:01pm"];
	//"1:25am,1:30am,1:35am#2:15am,3:00am#4:35am#2:36pm#3:01pm,4:55pm,5:45pm,6:11pm#7:45pm#8:34pm,9:07pm"
	var obj = JSON.parse($("#setting_val").val());
	
	//var myArray = obj[0].calTimeIntervalVariable.split(/[,#]+/).filter(function(e) { return e; });
	if(obj[0].calTimeIntervalVariable.indexOf("#")==-1){
		return 0
	}else{
		var myRwArray = obj[0].calTimeIntervalVariable.split("#");
		for(i=0; i<myRwArray.length;i++){
			var currentRwArr = myRwArray[i].split(",");
			//console.log(myRwArray2);
			//alert(myRwArray.length);
				if(fn_chkArr(currentRwArr,booktmarr) ==0){
					if(inArray( fn_secToTimeAmPm(bTime),currentRwArr)){
						return 0;
					}else{
						return 1;
					}
					break;
				}
		}//for	
		
	}//-1
}
function fn_chkArr(currentRwArr,booktmarr){
	var result=0;
	currentRwArr.forEach(function(entry) {
					if(inArray(entry,booktmarr)){
						result++;
					}
				});
		return result;
}

/******************************************************************************/
/************************** Checking spl dates end ****************************/
/******************************************************************************/

/******************************************************************************/
/************************** Social promotion section **************************/
/******************************************************************************/

function faceToFacebook(){	
	$.ajax({
		url: SITE_URL+"page/FacebookPost",
		data:{'action':'facebook_post'},
		type: "post",
		success: function(result){
			window.location = result;
			return false;
		}  	
	})	
}




function tweetToTwteer(){
$.ajax({
		url: SITE_URL+"page/tweetPost",
		data:{'action':'tweet_post'},
		type: "post",
		success: function(result){
			window.open('https://twitter.com/share?text='+result,'','toolbar=0,status=0,width=626,height=436');
            return false;
		}  	
	})
         
}

!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");

function terms_and_condition_booking(){
	var getTermsCondition_text=$( "#terms_and_condition_show_hdn" ).val();	
	lightbox_terms('wrapper',getTermsCondition_text);
	
}




	
	
function lightbox_terms(DivName,html){
	if(jQuery('#lightbox').size() == 0){
		var theLightbox = jQuery('<div id="lightbox" style="width:450px !important;"/>');
		var theShadow = jQuery('<div id="lightbox-shadow"/>');
		jQuery(theShadow).click(function(e){
			closeLightbox_terms_body();
		});
		if(jQuery("#"+DivName).length==''){
			jQuery('.wrapper').append(theShadow);
			jQuery('.wrapper').append(theLightbox);
		}else{
			jQuery('#'+DivName).append(theShadow);
			jQuery('#'+DivName).append(theLightbox);
		}
	}
	jQuery('#lightbox').empty();
	
	
	var imgUrl= '<div><div class="head_pop"><button style="" onclick="closeLightbox_terms_body()" class="scalable" id="cancelNewGroupDisplay"  type="button" title="Close">Close</button></div><div>'+html+'</div></div>';

	jQuery('#lightbox').append(imgUrl);
	
	
	var maskheight = jQuery(window).height();
    var P_height = (maskheight/2) - (jQuery('#lightbox').height())/2; 
		
	var maskWidth = jQuery(window).width();
    var dialogLeft = (maskWidth/2) - (jQuery('#lightbox').width())/2; 
	
	
	jQuery('#lightbox').css('top', P_height +'px');
	jQuery('#lightbox').css('left', dialogLeft +'px');
	jQuery('#lightbox').show();
	jQuery('#lightbox-shadow').show();
}
function closeLightbox_terms_body(){
	jQuery('#lightbox').remove();
	jQuery('#lightbox-shadow').remove();
	jQuery('#lightbox').empty();
}
