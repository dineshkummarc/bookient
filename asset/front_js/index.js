$(function () {
    $('#chkAll').click(function (event) {
        var selected = this.checked;
        $('#ActiveStaff input:checkbox').each(function () { this.checked = selected; });
    });
});
function checkMultiStaffSelection(){
	var obj = fn_settingsArray();
	var multiselect	=	obj[0].multipleServicesBooking;
	if(multiselect == 0){
		$("#ActiveService input[type='checkbox'][name='srv']").click(function(){
			var ls_id=$(this).attr('id');
			$("#ActiveService input[type=checkbox]").removeAttr('checked');
			document.getElementById(ls_id).checked = true;
		})
	}
}
function hover_effect_srv_start(id,id_val){
	if ($("#srv_tltip_"+id).length == 0 ) {
        	$('<div id="srv_tltip_'+id+'" class="srv_tltip">'+id_val+'</div>').insertAfter($("#srv_"+id));
    	}
}
function hover_effect_srv_end(id){
	$('#srv_tltip_'+id).remove();
}
function hover_effect_staff_start(id){
    $('#staff_tltip_'+id).show();
}
function hover_effect_staff_end(id){
	$('#staff_tltip_'+id).hide();
}
function check_staff_service(){
	var t =0;
	if($("#ActiveService input[type='checkbox'][name='srv']:checked").length == 0){
		if ($("#service_alert").length == 0 ) {
        	$('<div id="service_alert" class="serv_alt" lang="en">'+pLang.alertService+'</div>').insertAfter($("#tab-container"));
    	}
		t++;
	}
	var obj = fn_settingsArray();
	if($("#ActiveStaff input[type='checkbox'][name='staff']:checked").length == 0 && obj[0].staffSelectionMandatory==1){
		if ($("#staff_alert").length == 0 ) {
        	$('<div id="staff_alert" class="staff_alt" lang="en">'+pLang.alertStaff+'</div>').insertAfter($("#tab-container"));
    	}
		t++;
	}
	return t;
}
//Month
function gntMonthGrd(startDate,endDate){
	for(day=1; day<43; day++){
		var rwStDate	= new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()+(day-1));	
		var stDate = new Date($.datepicker.formatDate('yy,mm,dd',rwStDate));
		var strTime=stDate.getTime()/1000;
		
		var rwEdDate	= new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()+day);
		var edDate = new Date($.datepicker.formatDate('yy,mm,dd',rwEdDate));
		var endTime=edDate.getTime()/1000;
		
		var nowEdDate	= new Date(localAdminTime().getFullYear(), localAdminTime().getMonth(), localAdminTime().getDate()+1);
		var NowDate = new Date($.datepicker.formatDate('yy,mm,dd',nowEdDate));
		var today_current_time = NowDate.getTime()/1000;//current time in second

		if(today_current_time > endTime && advanceBookSecond()>=endTime){
			$("#mth_data_"+day).html('');
		//pr	$("#mth_data_"+day).html('-Booked-');
			$("#mth_data_"+day).html('<lable style="color:#B7B7B7;">-'+pLang['not_Available']+'-</lable>');
			$("#mth_data_"+day).removeClass("app_open");
			$("#mth_data_"+day).removeClass("app_booked");
			$("#mth_data_"+day).addClass("app_booked");
		}else{
			if(endTime<chk_advancebooking() || strTime<chk_advancebooking()){
				if(chk_bookingStartTime(strTime) == 0){
					if(chk_bookingAvable(strTime,endTime) ==0){
						$("#mth_data_"+day).html('');
						$("#mth_data_"+day).html('<lable style="color:#B7B7B7;">-'+pLang['not_Available']+'-</lable>');
						$("#mth_data_"+day).removeClass("app_open");
						$("#mth_data_"+day).removeClass("app_booked");
						$("#mth_data_"+day).addClass("app_booked");
					}else{
						$("#mth_data_"+day).html('');
						$("#mth_data_"+day).html('<lable onclick="showTodaySchedule('+strTime+')">-'+pLang['available']+'-</lable>');
						$("#mth_data_"+day).removeClass("app_open");
						$("#mth_data_"+day).removeClass("app_booked");
						$("#mth_data_"+day).addClass("app_open");
					}
				}else{
					$("#mth_data_"+day).html('');
					$("#mth_data_"+day).html('<lable style="color:#B7B7B7;">-'+pLang['not_Available']+'-</lable>');
					$("#mth_data_"+day).removeClass("app_open");
					$("#mth_data_"+day).removeClass("app_booked");
					$("#mth_data_"+day).addClass("app_booked");
				}
			}else{	
				$("#mth_data_"+day).html('');
				$("#mth_data_"+day).html('<lable onclick="close_advBook()" style="color:#B7B7B7;">-'+pLang['not_Available']+'-</lable>');
				$("#mth_data_"+day).removeClass("app_open");
				$("#mth_data_"+day).removeClass("app_booked");
				$("#mth_data_"+day).addClass("app_open");
			}
		}

	}//end day loop
	$('.startToPlayEnd').hide();
}
//week 
function gntWeekGrd(startDate,endDate){
	var minHeight =0;
	for(day=1; day<8; day++){
		var rwStDate	= new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()+(day-1));	
//old		var stDate = new Date($.datepicker.formatDate('yy,mm,dd',rwStDate));
//old		var strTime=stDate.getTime()/1000;
		var strTime=rwStDate.getTime()/1000;
		var rwEdDate	= new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()+day);
//old		var edDate = new Date($.datepicker.formatDate('yy,mm,dd',rwEdDate));
//old		var endTime=edDate.getTime()/1000;
		var endTime=rwEdDate.getTime()/1000;
		var today_current_time = fn_today_current_time(); //current time in second
		var interval= fn_interval();//settings interval time
		var obj = fn_settingsArray();
		var liCount =0;
		var tmpHeight =0;
		if(obj[0].calTimeIntervalTyp == 3){		
			var myArray = obj[0].calTimeIntervalVariable.split(/[,#]+/).filter(function(e) { return e; });
			//alert(myArray);
			var dat_cont ='<ul>';	
			myArray.forEach(function(entry) {
					var i =timeToSecond(strTime,entry)
				    if(i >= today_current_time && 
						checkRules(returnUTCtime(i))==0 && 
						chk_staffAvlTime(i)==0 && 
						chk_staffBlockTime(i)==0 && 
						chk_bookingStartTime(i)==0 &&
						chk_minBookTime(i)==0 ){
						if(isBookprivTime(returnUTCtime(i))==0){	
							if(advanceBook(i)== 0){
								dat_cont +='<li class="app_open" onclick="bookApp('+returnUTCtime(i)+')">'+secondToAmpm(i-strTime)+'</li>';				
							}else{
								dat_cont +='<li class="disable_advBook" onclick="close_advBook()">'+secondToAmpm(i-strTime)+'</li>';
							}
						}
					}else{
//blocked as pre client //	dat_cont +='<li class="app_booked">'+secondToAmpm(i-strTime)+'</li>';
					}
				});
				dat_cont +='</ul>';
			//alert(timeToSecond(strTime,'09:25am'));
		}else{
			
		var dat_cont ='<ul>';
		for(i=strTime; i<endTime; i++){
			if((i-strTime)%interval==0){
				if(i >= today_current_time){ 
					if(chk_bookingStartTime(i)==0 ){	 
						if(chk_staffAvlTime(i)==0 ){ 
							//if(0==0){
							if(chk_staffBlockTime(i)==0){
								if(chk_minBookTime(i)==0){	
									if(overLapBooking(i)==0){	
										if(checkRules(i)==0){	
											if(advanceBook(i)== 0){
												dat_cont +='<li class="app_open" onclick="bookApp('+returnUTCAndLocaltime(i)+')">'+secondToAmpm(i-strTime)+'</li>';
											}else{
												dat_cont +='<li class="disable_advBook" onclick="close_advBook()">'+secondToAmpm(i-strTime)+'</li>';
											}
											liCount++;
											tmpHeight++;
										}else{
											if(obj[0].show_block_timinig == 1){	
												dat_cont +='<li class="app_booked">'+secondToAmpm(i-strTime)+'</li>';
											}
											liCount++;
										}
									}else{
										if(obj[0].show_block_timinig == 1){	
											dat_cont +='<li class="app_booked">'+secondToAmpm(i-strTime)+'</li>';
										}
										liCount++;
									}
								}else{
									if(obj[0].show_block_timinig == 1){	
										dat_cont +='<li class="app_booked">'+secondToAmpm(i-strTime)+'</li>';
									}
									liCount++;
								}
							}else{
								if(obj[0].show_block_timinig == 1){	
									dat_cont +='<li class="app_booked">'+secondToAmpm(i-strTime)+'</li>';
								}
								liCount++;
							}
						}
					}
				}
			}//end interval
		}//end i loop
			
			if(liCount==0){
				dat_cont +='<li class="notAvailable">-'+pLang['not_Available']+'-</li>';
			}
			if(minHeight < tmpHeight){
				minHeight = tmpHeight;
			}
			dat_cont +='</ul>';
		}//type if
		/*---------display part---------*/
//		console.log(rwStDate);
		$('#data_scroll_'+day).html(dat_cont);
	}//end day loop
	var lsPx=25*minHeight;
	if(lsPx<240){
		lsPx = 388;	
	}
	$('.td_scroll').css('min-height', lsPx+'px');
	weekScroller(lsPx);	
	$(".tabl-scroll").niceScroll({styler:"fb",cursorcolor:"#000"});
	$('.startToPlayEnd').hide();
}
function weekScroller(lsPx){	
	$(".app_open").hover(
		function () {
			$(this).addClass("activLi");
		},
		function () {
			$(this).removeClass("activLi");
		}
	);
	if(lsPx > 388){
		if($('.downArrow').length == 0){
			$('<span class="downArrow">'+pLang["more"]+'</span>').insertAfter(".tabl-scroll");
		}
		if($('.upArrow').length == 0){
		    $('<span class="upArrow" style="display: none;">'+pLang["more"]+'</span>').insertAfter(".tabl-scroll");
		}	
	}

   $('.tabl-scroll').scroll(function(){
      var div = $(this);
      if (div[0].scrollHeight - div.scrollTop() == div.height())
      {
          $(".downArrow").hide();
          $(".upArrow").show();
      }
      else
      {
          $(".downArrow").show();
		  $(".upArrow").hide();
      }
   });
	
	$('.downArrow').click(function(){
		//alert('down');
		var scrollBy = (lsPx/2)+200;
		$('.tabl-scroll').animate({ scrollTop: '+='+scrollBy}, (lsPx-300));
		/*$(".downArrow").hide();
		$(".upArrow").removeAttr('style');	*/
	})
	
	$('.upArrow').click(function(){
		var scrollBy = lsPx;
		$('.tabl-scroll').animate({ scrollTop: '-='+scrollBy}, (lsPx-350));
		$(".downArrow").removeAttr('style');
		$(".upArrow").hide();
	})
}

function timeToSecond(strTime,timeStr){
    var meridian = timeStr.substr(timeStr.length-2).toLowerCase();;
    var hours =  timeStr.substr(0, timeStr.indexOf(':'));
    //var minutes = timeStr.substring(timeStr.indexOf(':')+1, timeStr.indexOf(' '));
	var rw_min = timeStr.split(":");
	var minutes = rw_min[1].substr(0, rw_min[1].length - 2);
    if (meridian=='pm'){
        if (hours!=12){
            hours=hours*1+12;
        }else{
            hours = (minutes!='00') ? '0' : '24' ;
        }
    }
	seconds = parseInt(strTime) + parseInt(parseInt(hours)*3600) + parseInt(parseInt(minutes)*60);

    return seconds;
}
/*#############################################*/
/*########### Month calender start ############*/
/*#############################################*/
function chk_bookingAvable(strTime,endTime){
	var dat_cont =0;
	var interval= fn_interval();
	var today_current_time = fn_today_current_time();
	for(i=strTime; i<endTime; i++){
		if((i)%interval==0){
			if(i >= today_current_time){
				if(checkRules(returnUTCtime(i))==0){
					if(chk_staffAvlTime(i)==0){
						if(chk_staffBlockTime(i)==0){
							if(chk_minBookTime(i)==0){
									dat_cont ++;
							}
						}
					}
				}
			}
		}//end interval
	}//end i loop
	if(dat_cont == 0){
		return 0;
	}else{
		return 1;
	}
}
//genaret day details
function showTodaySchedule(dayInSec){
	pr_popup(500);
	$('#front_popup_content').html(create_table(dayInSec));
}
//create popup table
function create_table(dayInSec){
	var rwStDate	= new Date(new Date(dayInSec*1000).getFullYear(), new Date(dayInSec*1000).getMonth(), new Date(dayInSec*1000).getDate());
	
	var interval= fn_interval();//settings interval time
	var today_current_time = fn_today_current_time(); //current time in second

	var str ='';
		str+='<table border="0" cellpadding="0" cellspacing="0" class="mthp_table">';
		str+='<tr class="mth_header">';
		str+='<td colspan="2" align="left"><b>'+pLang['not_Available_time']+'</b></td>';
		//str+='<td colspan="2" align="right"><span id="mthp_time">'+$.datepicker.formatDate('DD, MM d, yy',rwStDate)+'</span></td>';
        str+='<td colspan="2" align="right"><span id="mthp_time">'+pLang[$.datepicker.formatDate('DD',rwStDate)]+', '+pLang[$.datepicker.formatDate('MM',rwStDate)]+' '+$.datepicker.formatDate('d',rwStDate)+', '+$.datepicker.formatDate('yy',rwStDate)+'</span></td>';
		str+='</tr>';
		str+='<tr class="mthp_body_head">';
		str+='<td align="center">'+pLang['night']+'</td>';
		str+='<td align="center">'+pLang['morning']+'</td>';
		str+='<td align="center">'+pLang['afternoon']+'</td>';
		str+='<td align="center">'+pLang['evening']+'</td>';
		str+='</tr>';
		str+='<tr class="mthp_body">';
		str+='<td><span id="mthp_morning_data">'+fn_mthp_ul_li(dayInSec,interval,today_current_time,0,21600)+'</span></td>';
		str+='<td><span id="mthp_afrenoon_data">'+fn_mthp_ul_li(dayInSec,interval,today_current_time,21600,43200)+'</span></td>';
		str+='<td><span id="mthp_evening_data">'+fn_mthp_ul_li(dayInSec,interval,today_current_time,43200,64800)+'</span></td>';
		str+='<td><span id="mthp_night_data">'+fn_mthp_ul_li(dayInSec,interval,today_current_time,64800,86400)+'</span></td>';
		str+='</tr>';
		str+='<tr class="mthp_footer">';
		str+='<td colspan="4" align="center">'+pLang['click_on_any_slot_to_book_an_appointment']+'</td>';
		str+='</tr>';
		str+='</table>';
	return str;
}
//create popup ul li
function fn_mthp_ul_li(dayInSec,interval,today_current_time,start_tm,end_tm){
	var obj = fn_settingsArray();
	var liCount=0;
	if(obj[0].calTimeIntervalTyp == 3){
		StartLoop = (dayInSec+start_tm);
		endLoop   = (dayInSec+end_tm);
		var myArray = obj[0].calTimeIntervalVariable.split(/[,#]+/).filter(function(e) { return e; });
		var dat_cont ='<ul>';
		for(j=StartLoop; j<endLoop; j++){	
		myArray.forEach(function(entry) {
				var i =timeToSecond(dayInSec,entry)
				if(j==i){
				    if(i >= today_current_time && 
						checkRules(returnUTCtime(i))==0  && 
						chk_staffAvlTime(i)==0 && 
						chk_staffBlockTime(i)==0 && 
						chk_minBookTime(i)==0){
						if(isBookprivTime(returnUTCtime(i))==0){
							if(advanceBook(i)== 0){
								dat_cont +='<li class="app_open" onclick="bookApp('+returnUTCAndLocaltime(i)+')">'+secondToAmpm(i-dayInSec)+'</li>';					//pr modified			dat_cont +='<li class="app_open" onclick="bookApp('+returnUTCAndLocaltime_month(i)+')">'+secondToAmpm(i-dayInSec)+'</li>';
							}else{
								dat_cont +='<li class="disable_advBook" onclick="close_advBook()">'+secondToAmpm(i-dayInSec)+'</li>';
							}
						}
					}else{
//blocked as pre client //	dat_cont +='<li class="app_booked">'+secondToAmpm(i-dayInSec)+'</li>';
					}
				}
			});
			}//end i loop
			dat_cont +='</ul>';		
	}else{
	StartLoop = (dayInSec+start_tm);
	endLoop   = (dayInSec+end_tm);
	var dat_cont ='<ul>';
		for(i=StartLoop; i<endLoop; i++){
			if((i-dayInSec)%interval==0){
				if(i >= today_current_time){  
					if(chk_staffAvlTime(i)==0 ){
						if(chk_staffBlockTime(i)==0){
							if(chk_minBookTime(i)==0){	
								if(overLapBooking(i)==0){	
									if(checkRules(returnUTCtime(i))==0){	
										if(advanceBook(i)== 0){
											dat_cont +='<li class="app_open" onclick="bookApp('+returnUTCAndLocaltime(i)+')">'+secondToAmpm(i-dayInSec)+'</li>';
										}else{
											dat_cont +='<li class="disable_advBook" onclick="close_advBook()">'+secondToAmpm(i-dayInSec)+'</li>';
										}
										liCount++;
									}else{
										if(obj[0].show_block_timinig == 1){	
											dat_cont +='<li class="app_booked">'+secondToAmpm(i-dayInSec)+'</li>';
										}
										liCount++;
									}
								}else{
									if(obj[0].show_block_timinig == 1){	
										dat_cont +='<li class="app_booked">'+secondToAmpm(i-dayInSec)+'</li>';
									}
									liCount++;
								}
							}else{
								if(obj[0].show_block_timinig == 1){	
									dat_cont +='<li class="app_booked">'+secondToAmpm(i-dayInSec)+'</li>';
								}
								liCount++;
							}
						}else{
							if(obj[0].show_block_timinig == 1){	
								dat_cont +='<li class="app_booked">'+secondToAmpm(i-dayInSec)+'</li>';
							}
							liCount++;
						}
					}
				}	
			}//end interval
		}//end i loop
			if(liCount == 0){
			 dat_cont +='<li class="notAvailable">-'+pLang['not_Available']+'-</li>';
			}
		dat_cont +='</ul>';
	}
	return dat_cont;
}
//Month top next button
function fn_month_nxt(){
		$(".firstDayMth").remove();
		var date = $('#main_date_calender').datepicker('getDate');
	 	date.setDate(date.getDate()+42);
		$('#main_date_calender').datepicker('setDate', date); 
		startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() );
    	endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() + 41);
		toDay		= localAdminTime();

		$('#main_date_calender').datepicker('setDate', date);
		
		showMonthDays(startDate,endDate);
		
	if(check_staff_service()==0){
		gntMonthGrd(startDate,endDate);
	}else{
		check_staff_service();
	}
}
//Month top pre button	
function fn_month_pre(){
		$(".firstDayMth").remove();
		var date = $('#main_date_calender').datepicker('getDate');
	 	date.setDate(date.getDate()-42);
		$('#main_date_calender').datepicker('setDate', date); 
		startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() );
    	endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() + 41);
		toDay		= localAdminTime();

		$('#main_date_calender').datepicker('setDate', date);
		
		showMonthDays(startDate,endDate);
		
	if(check_staff_service()==0){
		gntMonthGrd(startDate,endDate);
	}else{
			check_staff_service();
	}
}
//generat week top calender data
function showMonthDays(startDate,endDate){
		var today	=new Date($.datepicker.formatDate('yy,mm,dd',localAdminTime()));
		var gday	=new Date($.datepicker.formatDate('yy,mm,dd',startDate));

		select_date		='';
		if((today.getTime()/1000)<(gday.getTime()/1000)){
			select_date		= '<img src="'+img_url()+'front_image/left.png" id="month_pre" onclick="fn_month_pre()"/>';	
		}
		select_date		+=pLang[$.datepicker.formatDate('MM',startDate)]+' '+$.datepicker.formatDate('dd, yy',startDate)+" <b>"+pLang['to']+"</b> "+pLang[$.datepicker.formatDate('MM',endDate)]+' '+$.datepicker.formatDate('dd, yy',endDate)+'<img src="'+img_url()+'front_image/right.png" id="month_nxt" onclick="fn_month_nxt()"/>';

		$("#top_date_month").html(select_date);
		
		for(i=1;i<43;i++){
			var rowDate	= new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()+(i-1));
			if($.datepicker.formatDate('dd',rowDate) == 01 || i== 1){
				$('<span class="firstDayMth">'+pLang[$.datepicker.formatDate('MM',rowDate)]+'</span>').insertBefore($("#mth_"+i));
			}
		$("#mth_"+i).html('');
		$("#mth_"+i).html(pLang[$.datepicker.formatDate('D',rowDate)]+'&nbsp;'+$.datepicker.formatDate('d',rowDate));
		}
		
}
/*#############################################*/
/*########### Month calender end   ############*/
/*#############################################*/

/*#############################################*/
/*############ Week calender start ############*/
/*#############################################*/
//hidden data to generat week calender data (Dont change)
function startWeek(){
	var obj = fn_settingsArray();
	var utcDay = localAdminTime();
	switch (parseInt(obj[0].calStrtingWeekday)){
				case 1:
					  return_id = utcDay.getUTCDay();
					  break;
				case 2:
					  return_id =0;
					  break;
				case 3:
					  return_id = 1;
					  break;
				} 
		return return_id;
}
function currentDate(){
    var date = localAdminTime();
    startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() );
    endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() + 6);
    $('#main_date_calender').datepicker('setDate', date);

    showWeekDays(startDate,endDate);
    if(check_staff_service()==0){
    gntWeekGrd(startDate,endDate);
    }else{
            check_staff_service();
    }
}
function startWeekDay(){
	var obj = fn_settingsArray();
	if(parseInt(obj[0].calStrtingWeekday) == 1){
		return_id = 0;
	}
	if(parseInt(obj[0].calStrtingWeekday) == 2){
		if($('#hold_bTime').length >0){	
				return_id = new Date().getUTCDay() + (parseInt(new Date(fn_secToDateFC($('#hold_bTime').val())).getUTCDay())-parseInt(new Date().getDay()))	
		}else if($('#reg_bTime').length >0){	
				return_id = new Date().getUTCDay() + (parseInt(new Date(fn_secToDateFC($('#reg_bTime').val())).getUTCDay())-parseInt(new Date().getDay()))	
		}else if($('#contro_bTime').length >0){	
				return_id = new Date().getUTCDay() + (parseInt(new Date(fn_secToDateFC($('#contro_bTime').val())).getUTCDay())-parseInt(new Date().getDay()))	
		}else{
			return_id = new Date().getUTCDay();
		}
	}
	if(parseInt(obj[0].calStrtingWeekday) == 3){
		if($('#hold_bTime').length >0){	
				return_id = new Date().getUTCDay() + (parseInt(new Date(fn_secToDateFC($('#hold_bTime').val())).getUTCDay())-(parseInt(new Date().getDay())+1))	
		}else if($('#reg_bTime').length >0){	
				return_id = new Date().getUTCDay() + (parseInt(new Date(fn_secToDateFC($('#reg_bTime').val())).getUTCDay())-(parseInt(new Date().getDay())+1))	
		}else if($('#contro_bTime').length >0){	
				return_id = new Date().getUTCDay() + (parseInt(new Date(fn_secToDateFC($('#contro_bTime').val())).getUTCDay())-(parseInt(new Date().getDay())+1))	
		}else{
			return_id = new Date().getUTCDay()-1;
		}
	}
		return return_id;
		
}
//generat week top calender data
function showWeekDays(startDate,endDate){
		$(".dateInfoTabl").remove();
		var today	=new Date($.datepicker.formatDate('yy,mm,dd',localAdminTime()));
		var gday	=new Date($.datepicker.formatDate('yy,mm,dd',startDate));

		select_date		='';
		if((today.getTime()/1000)<(gday.getTime()/1000)){
			select_date		= '<img src="'+img_url()+'front_image/left.png" id="week_pre" onclick="fn_week_pre()"/>';	
		}
		select_date		+='<span>'+pLang[$.datepicker.formatDate('MM',startDate)]+' '+$.datepicker.formatDate('dd, yy',startDate)+" <b>"+pLang['to']+"</b> "+pLang[$.datepicker.formatDate('MM',endDate)]+' '+$.datepicker.formatDate('dd, yy',endDate)+'</span><img src="'+img_url()+'front_image/right.png" id="week_nxt" onclick="fn_week_nxt()"/>';
		if((today.getTime()/1000)<(gday.getTime()/1000)){
		select_date		+= '<br><a href="#" onclick="currentDate()">'+pLang.today+'</a>';
		}
		$("#top_date").html(select_date);
		$("#day_1").html('<label lang="en">'+pLang[$.datepicker.formatDate('D',startDate)]+'</label>'+$.datepicker.formatDate('dd.mm.yy',startDate));
		appointmentAlert(startDate,1);
				
		dayCollHeader(startDate,2);
		dayCollHeader(startDate,3);
		dayCollHeader(startDate,4);
		dayCollHeader(startDate,5);
		dayCollHeader(startDate,6);
		dayCollHeader(startDate,7);
}
function dayCollHeader(startDate,day){
	var row	= new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate()+(day-1));
	var lday = ($.datepicker.formatDate('D',row));
	$("#day_"+day).html('<label lang="en">'+pLang[lday]+'</label>'+$.datepicker.formatDate('dd.mm.yy',row));
	appointmentAlert(row,day);
}

//week top next button 
function fn_week_nxt(){
		var date = $('#main_date_calender').datepicker('getDate');
	 	date.setDate(date.getDate()+7);
		$('#main_date_calender').datepicker('setDate', date); 
		startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() );
    	endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() + 6);
		toDay		= localAdminTime();
		$('#main_date_calender').datepicker('setDate', date);
		
		showWeekDays(startDate,endDate);
	if(check_staff_service()==0){
		gntWeekGrd(startDate,endDate);
	}else{
			check_staff_service();
		}
	}
//week top pre button	
function fn_week_pre(){
		var date = $('#main_date_calender').datepicker('getDate');
	 	date.setDate(date.getDate()-7);
		$('#main_date_calender').datepicker('setDate', date); 
		startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() );
    	endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - startWeekDay() + 6);
		toDay		= localAdminTime();
		
		$('#main_date_calender').datepicker('setDate', date);
		
		showWeekDays(startDate,endDate);
		
	if(check_staff_service()==0){
		gntWeekGrd(startDate,endDate);
	}else{
			check_staff_service();
		}
	}
//second to hh:mm:ss
function secondToAmpm(secs){
	var obj = fn_settingsArray();
	if(obj[0].hours_type == 1){
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
	}else{
	//This section for 24 hours format	
	var hours = Math.floor(secs / (60 * 60));
	var divisor_for_minutes = secs % (60 * 60);
	var minutes = Math.floor(divisor_for_minutes / 60);
	var str = "" + hours;
	var pad = "00";
		hours = pad.substring(0, pad.length - str.length) + str;
	var obj = hours+' : '+padLeft(minutes,2);
	}
	return obj;
}
//number padding
function padLeft(nr, n, str){
    return Array(n-String(nr).length+1).join(str||'0')+nr;
}
/*#############################################*/
/*############ Week calender end ##############*/
/*#############################################*/
//////////  default calender start  /////////////
function toDayCalender(){
		$("#main_date_calender" ).datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        minDate: localAdminTime(),
        changeYear: true,
        firstDay: startWeek()
	});			
}
//generat first data(for both week and month)
function toDaydata(){
	
		fn_bizHours();
		LsDate = new Date($("#main_date_calender").datepicker("getDate"));
        startDate = new Date(LsDate.getFullYear(), LsDate.getMonth(), LsDate.getDate()-startWeekDay()  );
        endDate = new Date(LsDate.getFullYear(), LsDate.getMonth(), LsDate.getDate()-startWeekDay()  + 6);
		endDateMonth = new Date(LsDate.getFullYear(), LsDate.getMonth(), LsDate.getDate()-startWeekDay()  + 41);
		
		showWeekDays(startDate,endDate);
		showMonthDays(startDate,endDateMonth);

		if(check_staff_service()==0){
			gntWeekGrd(startDate,endDate);
			gntMonthGrd(startDate,endDateMonth);	
		}else{
			check_staff_service();
		}
}
//generat tab as per requerment
function showTab(){
	var obj = fn_settingsArray();
	switch (parseInt(obj[0].defaultView)){
				case 0:
					  return_id = $('#tab-container').easytabs({defaultTab: "li:nth-of-type(1)"});
					  break;
				case 1:
					  return_id = $('#tab-container').easytabs({defaultTab: "li:nth-of-type(2)"});
					  break;
				case 2:
					  return_id = $('#tab-container').easytabs({defaultTab: "li:nth-of-type(3)"});
					  break;
				} 
		return return_id;
}
// common time interval
function fn_interval(){
	var obj = fn_settingsArray();
	switch (obj[0].calTimeIntervalTyp){
				case 1:
					  var val= parseInt(obj[0].calTimeIntervalVariable)*60;
					  break;
				case 2:
					  var val= parseInt(obj[0].calTimeIntervalVariable)*60;
					  break;
				} 
	return val;
}
//todays time in second
function fn_today_current_time(){
	var val= parseInt(localAdminCurrentTime().getTime()/1000);
	return val;
}
//popup front end
function pr_popup(popWidth) {
	//popWidth --- width of popup
	if ($("#front_popup").length == 0 ) {
        	$('<div id="front_popup" class="popup_block"><span id="front_popup_content"></span></div>').insertAfter($("#tab-container"));
    	}
	var popID = 'front_popup'; //id of popup

    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="pr_popup_close()" src="'+img_url()+'front_image/close_pop.png" class="btn_close" border="0" />');

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
    if($('#countdown').length > 0){
        for (var i = 1; i < 400; i++)
        window.clearInterval(i);
		params ={ 'action' : 'Deleted' };
		var paramsObj = $('#tempBookingData').serializeArray();
		$.each(paramsObj, function(i, field){
		params[field.name] = field.value;
		}); 
		$.ajax({
		    url: SITE_URL+"page/deleteTempData",
		    data:params,
		    type: "post" ,
		    success: function(result){
			  		console.log(result); 
			 	 } 	
		})
    }
	
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    return false;
}
//reset all contener
function fn_contener(){
	$('.firstDayMth').remove();
	$('.mth_data').html('');
	$('.data_scroll').html('');
	$('.notAvailable').remove();
	$('.disable_advBook').remove();
	$('.downArrow').remove();
}
//checking calender start time
function chk_bookingStartTime(currentDate){
	var obj 	= fn_settingsArray();
	var strDate = obj[0].calStrtingDt;
	var dd = $.datepicker.parseDate( "yy-mm-dd", strDate );
	var n = dd.getTime()/1000; 
	if(n<currentDate){
		return 0;
	}else{
		return 1;
	}
	
}
//////////  default calender end  ///////////////
 
/*#############################################*/
/*############ Scroll part start ##############*/
/*#############################################*/
function scroll_me_top(cont_id){
	$('#'+cont_id).animate({ scrollTop: '-=3000px' }, 30000);
}
function scroll_me_down(cont_id){
	$('#'+cont_id).animate({ scrollTop: '+=3000px' }, 30000);
}
function get_contener_id(ls_id){
	switch (ls_id){
				case 'pointer_down_1':
					  return_id = 'data_scroll_1';
					  break;
				case 'pointer_up_1':
					  return_id = 'data_scroll_1';
					  break;
				case 'pointer_down_2':
					  return_id = 'data_scroll_2';
					  break;
				case 'pointer_up_2':
					  return_id = 'data_scroll_2';
					  break;
				case 'pointer_down_3':
					  return_id = 'data_scroll_3';
					  break;
				case 'pointer_up_3':
					  return_id = 'data_scroll_3';
					  break;
				case 'pointer_down_4':
					  return_id = 'data_scroll_4';
					  break;
				case 'pointer_up_4':
					  return_id = 'data_scroll_4';
					  break;
				case 'pointer_down_5':
					  return_id = 'data_scroll_5';
					  break;
				case 'pointer_up_5':
					  return_id = 'data_scroll_5';
					  break;
				case 'pointer_down_6':
					  return_id = 'data_scroll_6';
					  break;
				case 'pointer_up_6':
					  return_id = 'data_scroll_6';
					  break;
				case 'pointer_down_7':
					  return_id = 'data_scroll_7';
					  break;
				case 'pointer_up_7':
					  return_id = 'data_scroll_7';
					  break;
				} 
		return return_id;
}
$(document).ready(function() {
	$('.pointer_down').mouseenter(function(){
		var ls_cont = get_contener_id($(this).attr('id'));
		$('#'+ls_cont).animate({ scrollTop: '-=3000px' }, 30000);
	}).click(function(){
		var ls_cont = get_contener_id($(this).attr('id'));
		$('#'+ls_cont).stop();
		$('#'+ls_cont).animate({ scrollTop: '-=300px' }, 'slow');
		scroll_me_top(ls_cont);
	})
	$('.pointer_down, .pointer_up').mouseleave(function(){
		var ls_cont = get_contener_id($(this).attr('id'));
		$('#'+ls_cont).clearQueue();
		$('#'+ls_cont).stop();
	})

	
	$('.pointer_up').mouseenter(function(){
		var ls_cont = get_contener_id($(this).attr('id'));
		$('#'+ls_cont).animate({ scrollTop: '+=3000px' }, 30000);
	}).click(function(){
		var ls_cont = get_contener_id($(this).attr('id'));
		$('#'+ls_cont).stop();
		$('#'+ls_cont).animate({ scrollTop: '+=300px' }, 'slow');
		scroll_me_down(ls_cont);
	})	
		
});
/*#############################################*/
/*############ Scroll part end ################*/
/*#############################################*/
function lightbox(DivName){
		if($('#lightbox').size() == 0){
			var theLightbox = $('<div id="lightbox"/>');
			var theShadow = $('<div id="lightbox-shadow"/>');
			$(theShadow).click(function(e){
				//closeLightbox();
			});
			if($("#"+DivName).length==''){
				$('.wrapper').append(theShadow);
				$('.wrapper').append(theLightbox);
			}else{
				$('#'+DivName).append(theShadow);
				$('#'+DivName).append(theLightbox);
			}
		}
		$('#lightbox').empty();
		
		$('#lightbox').append('<img border="0" src="'+img_url()+'front_image/big_loader.gif" height="55" width="54" /><br><strong>'+pLang['loading']+'....</strong>');
		
		$('#lightbox').css('top', $(window).scrollTop() + 50 + '%');
		$('#lightbox').show();
		$('#lightbox-shadow').show();
	}	
function closeLightbox(){
		$('#lightbox').remove();
		$('#lightbox-shadow').remove();
		$('#lightbox').empty();
	}
function advanceBook(bTime){
	if(chk_advancebooking()<=bTime){
			return 1;
	}else{
			return 0;
	}
}
function chk_minBookTime(bTime){
	if(advanceBookSecond()<=bTime){
			return 0;
	}else{
			return 1;
	}
}
function chk_advancebooking(){
	var obj = fn_settingsArray();
	var time = (obj[0].advBkMxTim == 0)?1:obj[0].advBkMxTim;
	var nowEdDate	= new Date(localAdminTime().getFullYear(), localAdminTime().getMonth(), localAdminTime().getDate()+1);
	var NowDate = new Date($.datepicker.formatDate('yy,mm,dd',nowEdDate));
	var return_second = NowDate.getTime()/1000 + (86400*(time-1));
	return return_second;
}
function advanceBookSecond(){
	var obj = fn_settingsArray();
	var type = obj[0].advBkMinSetting;
	var time = obj[0].advBkMinTim;
	switch (type){
				case 1:
					var nowEdDate	= new Date(localAdminTime().getFullYear(), localAdminTime().getMonth(), localAdminTime().getDate()+1);
					//var NowDate = new Date($.datepicker.formatDate('yy,mm,dd',nowEdDate));
					var NowDate = new Date(nowEdDate);
					var return_second = NowDate.getTime()/1000 + (86400*time);
					break;
				case 2:
					var return_second = fn_today_current_time()+ (3600*time);
					break;
				case 3:
					var return_second = fn_today_current_time()+ (60*time);
					break;
				} 
		return return_second;
}
function close_advBook(){
	pr_popup(350);
	var rwStDate	= new Date(new Date(chk_advancebooking()*1000).getFullYear(), new Date(chk_advancebooking()*1000).getMonth(), new Date(chk_advancebooking()*1000).getDate());
	var rwStTime	= new Date($.datepicker.formatDate('yy,mm,dd',rwStDate));
	var ls_sec = chk_advancebooking() - rwStTime.getTime()/1000
	var str ='<center>';
		str +=pLang['appointment_can_be_taken_only_till'];	
		str +='<br>';
		str +=$.datepicker.formatDate('d/mm/yy',rwStDate);
		str +=' ';
		str +=secondToAmpm(ls_sec);
		str +='</center>';
	$('#front_popup_content').html(str);
}

/*#############################################*/
/*######## Data collection part start #########*/
/*#############################################*/
function data_collection(){
		lightbox('dynamic_popup_id');
		$.ajax({
			      url: SITE_URL+"page/fn_local_admin_settings",
			      type: "post",
			      success: function(SettingsData){ 
					$('#setting_val').val(SettingsData);
					var objData = JSON.parse(SettingsData);//calender start 
					//console.log(objData[0].calStrtingDt) 
					////////////// Biz hr settings start //////////////
					$.ajax({
					      url: SITE_URL+"page/fn_business_hour_list",
					      type: "post",
					      success: function(bizHours){ 
							$('#BookingHours').val(bizHours); 
							//console.log(bizHours);
							////////////// booking data start //////////////
							$.ajax({
							      url: SITE_URL+"page/fn_booking_details",
							      type: "post",
							     // data:  { name: "John", location: "Boston" },
							      success: function(booking){ 
									$('#mainDataContener').val(booking);
									//////////////////Staff Interval start///////// 
									$.ajax({
									      url: SITE_URL+"page/fn_fetch_block_time",
									      type: "post",
									     // data:  { name: "John", location: "Boston" },
									      success: function(staffinter){ 
											$('#staffIntervalTime').val(staffinter); 
											callFnDetails();
											closeLightbox();
									      }  
						    		});
									////////////////// Staff interval End///////////
							      }  
				    		});
							////////////// booking data end //////////////
					      }  
		    		});
					////////////// Biz hr settings end //////////////
			      }  
    		}); 
	}
function img_url(){
	 imageUrl=SITE_URL+'asset/';
	return imageUrl;
}
function callFnDetails(){
		setInterval('updateTimer()', 1000);
		$('#enableContent').show();
		$('#ActiveService input:checkbox').removeAttr('checked');
		$('#ActiveStaff input:checkbox').removeAttr('checked');
		showTab();
		toDayCalender();
		toDaydata();	
		$("#ActiveService input[type='checkbox'][name='srv']").click(function(){
			$("#service_alert").remove();
			coummonClick()
		})
		$("#ActiveStaff input[type='checkbox'][name='staff']").click(function(){
			$("#staff_alert").remove();
			coummonClick()
		})
		
		$("#ActiveService li a").click(function(){
			var localId = $(this).parent('li').find('input:checkbox').attr('id');
			if ($('#'+localId).is(':checked')) {
				document.getElementById(localId).checked=false;
			} else {
				document.getElementById(localId).checked=true;
			}
			$("#service_alert").remove();
			coummonClick()
		})
		$("#ActiveStaff li a").click(function(){
			var localId = $(this).parent('li').find('input:checkbox').attr('id');
			if ($('#'+localId).is(':checked')) {
				document.getElementById(localId).checked=false;
			} else {
				document.getElementById(localId).checked=true;
			} 
			
			$("#staff_alert").remove();
			coummonClick()
		})
				
		bookingAfterlogin();
		checkMultiStaffSelection();
		callScroll();
		$('.tab').click(function(){
			var localIds = $(this).attr('id');
			if(localIds =='tab_local_week'){
				$("#ascrail2004").show();
			}
			if(localIds =='tab_local_month'){
				$("#ascrail2004").hide();
			}
			if(localIds =='tab_local_review'){
				$("#ascrail2004").hide();
			}
		})	
}

function callScroll(){
	$("#reviews").niceScroll({styler:"fb",cursorcolor:"#000"});
	$("#emp_list").niceScroll({styler:"fb",cursorcolor:"#000"});
	$("#ActiveStaff ul").niceScroll({styler:"fb",cursorcolor:"#000"});
	$("#ActiveService ul").niceScroll({styler:"fb",cursorcolor:"#000"});
}

function coummonClick(){
	fn_contener();
	check_staff_service()
	var obj 	= fn_settingsArray();
	var showStaff = obj[0].showStaffCustomers;
	var staffMand = obj[0].staffSelectionMandatory;

	if($("#ActiveService input[type='checkbox'][name='srv']:checked").length != 0 ){
		if(obj[0].showStaffCustomers == 0){
			$('.startToPlay').show();
		}else{
			if(obj[0].staffSelectionMandatory == 0){
				$('.startToPlay').show();
			}else{
				if($("#ActiveStaff input[type='checkbox'][name='staff']:checked").length != 0){
					$('.startToPlay').show();
				}else{
					$('.startToPlay').hide();
				}
			}
		}
	}else{
		$('.startToPlay').hide();
	}
}	

function updateTimer(){
	var localCount = parseInt($("#contro_padding").val());
	var lastCount = $("#contro_padding").val(localCount+1);
}

function goToCalender(){
$('.tempMyCont').val('');
$('.startToPlay').hide();	
$('.startToPlayEnd').show();
setTimeout(function(){ toDaydata();}, 90);	
}
/*#############################################*/
/*######## Data collection part end ###########*/
/*#############################################*/
$(document).ready(function(){
	data_collection();
})

