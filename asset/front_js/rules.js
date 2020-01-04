
function fn_bizHours(){
	var objData 	= JSON.parse($("#BookingHours").val());	
	var j=0;
	var ls_services=[];
	$( "#ActiveService input[type=checkbox]" ).each(function( index ) {
		if (this.checked) {
	      	ls_services[j] = $(this).val();
			j++;
	   	 }
	});
	var service = ls_services;	
	var dataArr =[];
	service.forEach(function(serviceArr){
		dataArr.push(objData[serviceArr]);
	})
	
	var finalArr =[];
	dataArr.forEach(function(val){
		finalArr.push(val);	 
	})
	$('#tempBizHr').val(JSON.stringify(finalArr[0]));
}

//Don't dare to touch it(Main ruls start)
function checkRules(bTime){	
	if( fn_dateInArray(bTime) != 0){//fn_dateInArray
				//console.log(fn_secToDateTime(bTime)+'##'+fn_dateInArray(bTime));
			if(fn_staffInDateArr(bTime)!=0){
				//console.log(fn_secToDateTime(bTime)+'##'+fn_staffInDateArr(bTime));
				//if(fn_timeInDateArr(bTime) != 0 || fn_cancelForDuration(bTime) == 0){
				if(fn_cancelForDuration(bTime) != 0){
					//`console.log(fn_secToDateTime(bTime)+'##'+fn_timeInDateArr(bTime)+'##'+fn_cancelForDuration(bTime));
					//console.log(fn_secToDateTime(bTime)+'##'+fn_chkCapacity(bTime));
					if(fn_chkCapacity(bTime)!= 0){
						 return -1;
						// return fn_chkCapacity(bTime);
					}else{
						 return 0;
						//return fn_chkCapacity(bTime);
					}
				}else{
					return 0;
				}
			}else{
				return 0;
			}
	}else{
		return 0;
	}
}
//Don't dare to touch it(Main ruls end)
function overLapBooking(bTime){
	var staff_arr		= get_staff();
	if(staff_arr.length == 1){
		var objData			= fn_dataArray();
		var keyIndex		= fn_dateIndexKey(bTime);
		var service_arr		= get_service();	
		var data_arr		= [];
		var ls_services		= [];
		var counter			= 0;
		var services_duration=0;	
		var j=0;
	
		if($('#overLapBooking_srv').val() == ''){
			$( "#ActiveService input[type=checkbox]" ).each(function( index ) {
			  	ls_services[j] = $(this).val();
				j++;
			});
			$('#overLapBooking_srv').val(JSON.stringify(ls_services));		
			var service = ls_services;
		}else{
			var service = JSON.parse($("#overLapBooking_srv").val());	
		}
	
		if($('#overLapBooking_services_duration').val() == ''){
			$( "#ActiveService input[type=checkbox]" ).each(function( index ) {
				if (this.checked) {
					var duration = $('#duration_'+$(this).val()).val();	
					if(services_duration < duration){
					services_duration = duration;
					}		
			   	 }
			});
			$('#overLapBooking_services_duration').val(services_duration);	
		}else{
			services_duration = $("#overLapBooking_services_duration").val();	
		}

		if(keyIndex != -1){
			if($('#overLapBooking_data_arr').val() == ''){
				service.forEach(function(entry){
					objData[keyIndex].date_datils.filter(function (datas) { 
						if(datas.service == entry){ 
							data_arr.push(objData[keyIndex].date_datils.filter(function (datas) { 
								return datas.service == entry 
								})
							);
						}
					})
				})
				$('#overLapBooking_data_arr').val(JSON.stringify(data_arr));		
			}else{
				data_arr = JSON.parse($("#overLapBooking_data_arr").val());	
			}
		}
		if(service_arr.length == 1){
			data_arr.forEach(function(entry) {
				if(!array_search(entry[0].service,service_arr)){	
				entry[0].service_details.forEach(function(ent) {
					if(array_search(ent.staff,staff_arr)){
						ent.staff_details.forEach(function(stTime) {
							var ls_time_start	= fn_24hrToSec(stTime.srvSrtTimeCal) - (parseInt(services_duration)*60);
							var ls_time_end		= fn_24hrToSec(stTime.srvSrtTimeCal) + (parseInt(stTime.srvDuration)*60);
							if(ls_time_start < fn_secToTime(bTime) && ls_time_end > fn_secToTime(bTime) ){
								counter++;
							}
						})
					}
				})
				}
			})
		}else{
			data_arr.forEach(function(entry) {	
				entry[0].service_details.forEach(function(ent) {
					if(array_search(ent.staff,staff_arr)){
						ent.staff_details.forEach(function(stTime) {
							var ls_time_start	= fn_24hrToSec(stTime.srvSrtTimeCal) - (parseInt(services_duration)*60);
							var ls_time_end		= fn_24hrToSec(stTime.srvSrtTimeCal) + (parseInt(stTime.srvDuration)*60);
							if(ls_time_start < fn_secToTime(bTime) && ls_time_end > fn_secToTime(bTime) ){
								counter++;
							}
						})
					}
				})
			})	
		}
	}else{
		counter =0;
	}	
	return counter;
}

function chk_staffBlockTime(bTime){
	var obj 	= fn_settingsArray();
	var showStaff = obj[0].showStaffCustomers;
	var staffMand = obj[0].staffSelectionMandatory;
	if(showStaff == 0){
		return fn_notAvailableStaffBlocking(bTime);
	}else{
		if( staffMand == 0){
			return fn_notAvailableStaffBlocking(bTime);
		}else{
			return fn_availableStaffBlocking(bTime);
		}		
	}
}
//return available staff blocking
function fn_availableStaffBlocking(bTime){
	// alert(bTime)
	var staff_chk_arr = {}; 
	var staffArr	= get_staff();
	var dataArr 	= fn_staffInterval();
	var staff_id;
	var datavalArr;
	var time_form;
	var time_to;
	
	var flag =false;
	if(staffArr.length == 1){
		var flag_data =0;
		if(dataArr.length == 0){
		flag = true;
		}else{
		dataArr.forEach(function(dataval){
			staff_id = dataval.staff;
			if(staffArr[0]==staff_id){
			    datavalArr = dataval.staff_details;
				datavalArr.forEach(function(timedetails){
					time_form = timedetails.time_form;
					time_to = timedetails.time_to;
					//alert(bTime+'@@'+time_form+'@@'+time_to);
					
				//	console.log(fn_secToDateTime(bTime)+'@@'+fn_secToDateTime(time_form)+'@@'+fn_secToDateTime(time_to));
					if(bTime>=time_form && bTime < time_to){
						flag =false;
						flag_data++;
					 }else{
						flag = true;
					 }
				});
				
			}else{
			   flag = true;
			   flag_data++;
			   staff_chk_arr[staffArr[0]] = false;
			}
			
		});//end loop
		}
	}else{
		var flag_data =0;
		staffArr.forEach(function(sel_staff_id){
			if(dataArr.length > 0){
				dataArr.forEach(function(dataval){
				staff_id = dataval.staff;	
				if(sel_staff_id==staff_id){
				    datavalArr = dataval.staff_details;
					datavalArr.forEach(function(timedetails){
						time_form = timedetails.time_form;
						time_to = timedetails.time_to;
						if(bTime>=time_form && bTime < time_to){
							flag = false;
							flag_data++;
						 }else{
							flag = true;
						 }
					});
				}else{
				   flag = true;
				//   flag_data++;
				   staff_chk_arr[sel_staff_id] = false;
				}				
			}																																		);
			}
		});
	}
	if(flag_data >0){
		return 1;
	}else{
	 	return 0;
	}
}
//return when not available staff blocking
function fn_notAvailableStaffBlocking(bTime){
	var serviceArr	= get_service();
	var dataArr 	= fn_staffInterval();
	var flagData	= 0;
	
	serviceArr.forEach(function(srvArr){ 
		dataArr.forEach(function(dataval){
			serviceArr = dataval.service; 
			if(in_array(srvArr, dataval.service)){
			    datavalArr = dataval.staff_details;
				datavalArr.forEach(function(timedetails){
					time_form = timedetails.time_form;
					time_to = timedetails.time_to;
					if(bTime>=time_form && bTime < time_to){
					
					 }else{
						flagData++;
					 }
				});
			}else{
			  flagData++;
			}				
		});
	});
	
	if(flagData >0){
		return 1;
	}else{
	 	return 0;
	}

}
//return abal time
function fn_staffAdleTime(bTime){
	var availData = fn_staffAblTimInData(bTime);
	//console.log(availData)
	availData.forEach(function(staffArr){
		staffArr.date_details.forEach(function(staffArr1){
		//console.log(staffArr1);
		})
	})
}
//date wise not abl staff
function fn_staffAblTimInData(bTime){
	var dateArr = fn_staffInterval();
	var returnData =[] ;
	dateArr.forEach(function(dateArr){
		if(dateArr.date == fn_secToDate(bTime)){
			returnData.push(dateArr);
		}
	})
		return returnData;
}

function second2Ampm(secs){
	//this section for 12 hours format
	var hours = Math.floor(secs / (60 * 60));
	var divisor_for_minutes = secs % (60 * 60);
	var minutes = Math.floor(divisor_for_minutes / 60);
	var divisor_for_seconds = divisor_for_minutes % 60;
	var seconds = Math.ceil(divisor_for_seconds);
	var ampm	= (hours >= 12)? 'pm' : 'am';
		hours = (hours > 12)? hours -12 : hours;
	    hours = (hours == '0')? 12 : hours;
	var obj =hours+' : '+padLeft(minutes,2)+'  '+ ampm;
	
	return obj;
}

//check staff capacity
function fn_chkCapacity(bTime){	
	var serviceArr	= get_service();
	var result = 0;
	
	if($('#fn_chkCapacity_date').val() == fn_secToDate(bTime)){
		var date_datils = JSON.parse($("#fn_chkCapacity_val").val());
		date_datils.forEach(function(serviceDtl){	
			if(array_search(serviceDtl.service,serviceArr)){			
				serviceDtl.service_details.forEach(function(staffDtls){
					staffDtls.staff_details.forEach(function(details){	
				var ls_time_start	= fn_24hrToSec(details.srvSrtTimeCal) - (parseInt(details.srvDuration)*60);
				var ls_time_end		= fn_24hrToSec(details.srvSrtTimeCal) + (parseInt(details.srvDuration)*60);
				if(ls_time_start < fn_secToTime(bTime) && ls_time_end > fn_secToTime(bTime) ){
					result =result+details.srvQuantity ;
				}	
				})	
					
				})
			}	
		})	
	}else{
		var objData = fn_dataArray();
		var keyArr=array_keys( objData );		
		for( var pr=0; pr < keyArr.length; pr++) {	
			if(objData[pr].date == fn_secToDate(bTime)){
				$('#fn_chkCapacity_val').val(JSON.stringify(objData[pr].date_datils));
				$('#fn_chkCapacity_date').val(fn_secToDate(bTime));	
				objData[pr].date_datils.forEach(function(serviceDtl){	
					if(array_search(serviceDtl.service,serviceArr)){			
						serviceDtl.service_details.forEach(function(staffDtls){
							staffDtls.staff_details.forEach(function(details){	
						var ls_time_start	= fn_24hrToSec(details.srvSrtTimeCal) - (parseInt(details.srvDuration)*60);
						var ls_time_end		= fn_24hrToSec(details.srvSrtTimeCal) + (parseInt(details.srvDuration)*60);
						if(ls_time_start < fn_secToTime(bTime) && ls_time_end > fn_secToTime(bTime) ){
							result =result+details.srvQuantity ;
						}	
						})	
							
						})
					}	
				})	
			}	
		}
	}	

	var services_capacity =0;
	$( "#ActiveService input[type=checkbox]" ).each(function( index ) {
		if (this.checked) {
			var capacity = $('#capcty_'+$(this).val()).val();			
			services_capacity = parseInt(services_capacity) + parseInt(capacity);
	   	 }
	});	

	if(services_capacity <= result){
		return -1;
	}else{
		return 0 ;
	}
}
//return no of booking
function fn_serviceNoOfBooking(bTime,service){
	var bizHrData	= fn_dayWiseBizHr(bTime);
	var ls_data=0;
	bizHrData.forEach(function(entry){
		entry.forEach(function(entry_srv) {
			if(entry_srv.srvName == service){
				ls_data= entry_srv.bookMxBooking;
			}
		})
	})
	return ls_data;
}
//return no of booking
function fn_staffNoOfBooking(bTime,service,staff){
	var bizHrData	= fn_dayWiseBizHr(bTime);
	var ls_data=0;
	bizHrData.forEach(function(entry){
		entry.forEach(function(entry_srv) {
			if(entry_srv.srvName == service){
				entry_srv.srvDtls.forEach(function(entry_staff) {
					if(entry_staff.staffName == staff){
						ls_data= (entry_staff.staffDtls[0].bookMxBooking);
					}
				})
			}
		})
	})
	return ls_data;
}
//check time with duration of booking
function fn_cancelForDuration(bTime){
	var staff_arr	=get_staff();
	var service_arr	=get_service();
	var data_arr	=fn_dataIndateWise(bTime);
	var counter=0;	
//	console.log(data_arr);
	data_arr.forEach(function(entry) {
		if(array_search(entry[0].service,service_arr)){	
		entry[0].service_details.forEach(function(ent) {
			if(array_search(ent.staff,staff_arr)){
				ent.staff_details.forEach(function(stTime) {
					var ls_time_start	= fn_24hrToSec(stTime.srvSrtTimeCal) - (parseInt(stTime.srvDuration)*60);
					var ls_time_end		= fn_24hrToSec(stTime.srvSrtTimeCal) + (parseInt(stTime.srvDuration)*60);
					if(ls_time_start < fn_secToTime(bTime) && ls_time_end > fn_secToTime(bTime) ){
						counter++;
					}
				})
			}
		})
		}
	})
	return counter;
}
//check working time
function chk_staffAvlTime(bTime){
	var obj 			= fn_settingsArray();
	var showStaff 		= obj[0].showStaffCustomers;
	var staffMand 		= obj[0].staffSelectionMandatory;
	
	if(showStaff == 0){
		return fn_notStaffAvlTime(bTime);
	}else{
		if( staffMand == 0){
			return fn_notStaffAvlTime(bTime);
		}else{
			return fn_staffAvlTime(bTime);
		}		
	}
}

function fn_notStaffAvlTime(bTime){
	var bizHrdetails	= JSON.parse($('#tempBizHr').val());
	var serviceArr		= get_service();
	var noOfWeek		= fn_secToDateTime(bTime).getDay();
	var counter			= 0;
	if(noOfWeek ==0){
		noOfWeek=7;
	}
	bizHrdetails.forEach(function(bizLocalObj){
		if(noOfWeek == bizLocalObj.day_id && in_array(bizLocalObj.service_id, serviceArr)){
			var endTimeTmp = fn_24hrToSec(bizLocalObj.time_to)-(parseInt(bizLocalObj.service_duration)*60);
			if(fn_24hrToSec(bizLocalObj.time_from) <= fn_secToTime(bTime) && endTimeTmp >= fn_secToTime(bTime)){
				counter++;	
			}
		}		
	})
	
	if(counter>0){
		return 0;
	}else{
		return -1;
	}	
}

function fn_staffAvlTime(bTime){
	var bizHrdetails	= JSON.parse($('#tempBizHr').val()) ;
	var serviceArr		= get_service();
	var staffArr		= get_staff();
	var noOfWeek		= fn_secToDateTime(bTime).getDay();
	var counter			= 0;

	bizHrdetails.forEach(function(bizLocalObj){

		if(noOfWeek == bizLocalObj.day_id && in_array(bizLocalObj.service_id, serviceArr)&& in_array(bizLocalObj.employee_id, staffArr)){
			var endTimeTmp = fn_24hrToSec(bizLocalObj.time_to)-(parseInt(bizLocalObj.service_duration)*60);
			if(fn_24hrToSec(bizLocalObj.time_from) <= fn_secToTime(bTime) && endTimeTmp >= fn_secToTime(bTime)){
				counter++;
			}
		}
		
	})
	
	if(counter>0){
		return 0;
	}else{
		return -1;
	}	
}


//return biz hr details according to no of day
function fn_dayWiseBizHr(bTime){
	var bizHours	= JSON.parse($('#tempBizHr').val());
	var ls_noOfDay	= fn_noOfDay(bTime);
	var dataSet =[];
	bizHours.forEach(function(entry) {
		if(entry.noOfDay == ls_noOfDay){
			dataSet.push(entry.noOfDay_datils);
		}	
	})
	return dataSet;
}
//check is booking time in array
function fn_timeInDateArr(bTime){
	var staff_arr	=get_staff();
	var service_arr	=get_service();
	var data_arr	=fn_dataIndateWise(bTime);
	var counter =0;	
	data_arr.forEach(function(entry) {
		if(array_search(entry[0].service,service_arr)){	
		entry[0].service_details.forEach(function(ent) {
			if(array_search(ent.staff,staff_arr)){
				ent.staff_details.forEach(function(stTime) {
					if(fn_timeToSecond(stTime.srvEndTime) > fn_secToTime(bTime) && fn_timeToSecond(stTime.srvSrtTime) <= fn_secToTime(bTime)){
						counter++;
					}
				})
			}
		})
		}
	})
	return counter;
}
//convert am/pm time in second
function fn_timeToSecond(timeStr){
    var meridian = timeStr.substr(timeStr.length-2).toLowerCase();;
    var hours =  timeStr.substr(0, timeStr.indexOf(':'));
	var rw_min = timeStr.split(":");
	var minutes = rw_min[1].substr(0, rw_min[1].length - 2);
    if (meridian=='pm'){
        if (hours!=12){
            hours=hours*1+12;
        }else{
            hours = (minutes!='00') ? '0' : '24' ;
        }
    }
	seconds = parseInt(parseInt(hours)*3600) + parseInt(parseInt(minutes)*60);
   return seconds;
}
//check staff is in the arrsy
function fn_staffInDateArr(bTime){

	if($('#fn_staffInDateArr_date').val() == fn_secToDate(bTime)){
		return $('#fn_staffInDateArr_val').val();
	}else{
		var staff_arr	=get_staff();
		var service_arr	=get_service();
		var data_arr	=fn_dataIndateWise(bTime);
		var counter =0;	
		data_arr.forEach(function(entry) {
			if(array_search(entry[0].service,service_arr)){			
				entry[0].service_details.forEach(function(ent) {
					if(array_search(ent.staff,staff_arr)){	
						counter ++;
					}
				})		
			}
		})
		$('#fn_staffInDateArr_date').val(fn_secToDate(bTime));
		$('#fn_staffInDateArr_val').val(counter);
		return counter;
	}	
}

//check the date is in the booking array
function fn_dateInArray(bTime){
	if($('#fn_dateInArray_date').val() == fn_secToDate(bTime)){
		return $('#fn_dateInArray_val').val();
	}else{
		var objData = fn_dataArray();
		var keyArr=array_keys( objData );
		var result = 0;
		for( var pr=0; pr < keyArr.length; pr++) {	
			if(objData[pr].date == fn_secToDate(bTime)){
				result++;
			}
		}
		$('#fn_dateInArray_date').val(fn_secToDate(bTime));
		$('#fn_dateInArray_val').val(result);
		return result;
	}	
}
//Bind service array fron booking array
function fn_dataIndateWise(bTime){
	if($('#fn_dataIndateWise_date').val() == fn_secToDate(bTime)){
		return JSON.parse($('#fn_dataIndateWise_val').val());
	}else{
		var objData = fn_dataArray();
		var keyIndex = fn_dateIndexKey(bTime);
		var service = get_service();
		var dataSet =[];
		if(keyIndex != -1){
			service.forEach(function(entry){
				objData[keyIndex].date_datils.filter(function (datas) { 
					if(datas.service == entry){ 
						dataSet.push(objData[keyIndex].date_datils.filter(function (datas) { 
							return datas.service == entry 
							})
						);
					}
				})
			})
		}
		$('#fn_dataIndateWise_date').val(fn_secToDate(bTime));
		$('#fn_dataIndateWise_val').val(JSON.stringify(dataSet));
		return dataSet;
	}		
}
//return index of date array
function fn_dateIndexKey(bTime){	
	if($('#fn_dateIndexKey_date').val() == fn_secToDate(bTime)){
		return $('#fn_dateIndexKey_val').val();
	}else{
		var objData = fn_dataArray();
		var keyArr=array_keys( objData );
		var result ='#';
		for(entity=0; entity< keyArr.length; entity++) {
			if(objData[entity].date == fn_secToDate(bTime)){
				result = entity;
			}
		}
		if(result == '#'){
			result= -1;
		}
		$('#fn_dateIndexKey_date').val(fn_secToDate(bTime));
		$('#fn_dateIndexKey_val').val(result);
		return result;
	}
}
/****************** Settings And Data ****************/	
function fn_dataArray(){
	var objData = JSON.parse($("#mainDataContener").val());
//	console.log(objData);
//	console.log('@@@@@@@@@@@@@@@@@@@@@@');
	return objData;
}
function fn_settingsArray(){
	var objData = JSON.parse($("#setting_val").val());
	return objData;
}

function fn_staffInterval(){
	var objData = JSON.parse($("#staffIntervalTime").val());
	return objData;
}
/****************** Staff And Service ****************/	
function get_staff(){
	if($('#fn_get_staff').val()==''){		
		var obj 			= fn_settingsArray();
		var showStaff 		= obj[0].showStaffCustomers;
		var staffMand 		= obj[0].staffSelectionMandatory;
		
		if(showStaff == 0){
			$('#fn_get_staff').val(JSON.stringify(fn_notActiveCheckedStaff()));
			return fn_notActiveCheckedStaff();
		}else{
			if( staffMand == 0){
				$('#fn_get_staff').val(JSON.stringify(fn_notActiveCheckedStaff()));
				return fn_notActiveCheckedStaff();
			}else{
				$('#fn_get_staff').val(JSON.stringify(fn_activeCheckedStaff()));
				return fn_activeCheckedStaff();
			}		
		}
	}else{
		return JSON.parse($("#fn_get_staff").val());
	}
	
}
function fn_activeCheckedStaff(){
	var i=0;
	var ls_staff=[];

	$( "#ActiveStaff input[type=checkbox]" ).each(function( index ) {
		if (this.checked) {
	      	ls_staff[i] = $(this).val();
			i++;
	   	 }
	});
	return ls_staff;
}

function fn_notActiveCheckedStaff(){
	var i=0;
	var ls_staff=[];

	$( "#ActiveStaff input[type=checkbox]" ).each(function( index ) {
		
	      	ls_staff[i] = $(this).val();
			i++;
	   	 
	});
	return ls_staff;
}

function get_service(){	
	if($('#fn_get_service').val() ==''){		
		var j=0;
		var ls_services=[];
		$( "#ActiveService input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});
		$('#fn_get_service').val(JSON.stringify(ls_services));	
		return ls_services;
	}else{
		return JSON.parse($("#fn_get_service").val());
	}
}

/******************************* Common function **********************************/

function fn_secToDateTime(bTime){
	var rwStDate	= new Date(new Date(bTime*1000).getFullYear(), new Date(bTime*1000).getMonth(), new Date(bTime*1000).getDate(), new Date(bTime*1000).getHours(), new Date(bTime*1000).getMinutes(), new Date(bTime*1000).getSeconds());
	return rwStDate;
}

function fn_secToDate(bTime){
	var rtDate = $.datepicker.formatDate('dd-mm-yy',fn_secToDateTime(bTime));
	return rtDate;
}

function fn_secToDateFC(bTime){
	var rtDate = $.datepicker.formatDate('yy-mm-dd',fn_secToDateTime(bTime));
	return rtDate;
}

function fn_secToDate_slash(bTime){
	var rtDate = $.datepicker.formatDate('dd/mm/yy',fn_secToDateTime(bTime));
	return rtDate;
}

function fn_secToTime(bTime){
	var rwStDate	= new Date(new Date(bTime*1000).getFullYear(), new Date(bTime*1000).getMonth(), new Date(bTime*1000).getDate());
	var rwStTime	= new Date(rwStDate);
//	var rwStTime1	= new Date($.datepicker.formatDate('yy,mm,dd',rwStDate));
	var ls_sec 		= bTime - rwStTime.getTime()/1000
	return ls_sec;
}

function fn_secToTimeAmPm(bTime){
	var ls_sec	= fn_secToTime(bTime);
	var timeAmPm= secondToAmpm(ls_sec).replace(/\s/g, '');
	return timeAmPm;
}

function fn_noOfDay(bTime){
	switch ($.datepicker.formatDate('D',fn_secToDateTime(bTime))){
				case 'Mon':
					  day_id = 1;
					  break;
				case 'Tue':
					  day_id = 2;
					  break;
				case 'Wed':
					  day_id = 3;
					  break;
				case 'Thu':
					  day_id = 4;
					  break;
				case 'Fri':
					  day_id = 5;
					  break;
				case 'Sat':
					  day_id = 6;
					  break;
				case 'Sun':
					  day_id = 7;
					  break;
				} 
		return day_id;
}

function fn_24hrToSec(ls_time){
	var timeArr	 = ls_time.split(':');
	var inSecond = parseInt(parseInt(timeArr[0])*3600)+parseInt(parseInt(timeArr[1])*60)+parseInt(timeArr[2]);
	return inSecond;
}

function mytempfunction(bTime){
	var bizHrData	= fn_dayWiseBizHr(bTime);
}