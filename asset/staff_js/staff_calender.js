	$(function(){

	$.noConflict();
	
	 //radio button headding              
	 $( "#radioset" ).buttonset();
	
	//Selected radio lable
	$("#radioset input[name='radio']").removeAttr('checked');
	$("#radioset input[name='radio']").next('label').removeClass('ui-state-active');
	document.getElementById("calender_day").checked=true;
	$('#calender_day').next('label').addClass('ui-state-active');
			
	$("#radioset input[name='radio']").click(function(){
     var ls_id=$(this).attr('id');
	 $("#radioset input[name='radio']").removeAttr('checked');
	 $("#radioset input[name='radio']").next('label').removeClass('ui-state-active');
	 document.getElementById(ls_id).checked=true;
	 $('#'+ls_id).next('label').addClass('ui-state-active');
	 			
	 $("#cal_staff input[type=checkbox]").removeAttr('checked');

	 if(ls_id =="calender_day"){
	 
	 		$( "#calender_datepicker" ).datepicker( "destroy" );
	 		day_datepicker()
			$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
			$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
			
	 		var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
		   	var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time			= $("#div_pre_cube").val();
			
			var select_date		= $.datepicker.formatDate('DD, MM dd, yy',myDate);
            $( "#cal_show_date" ).html(select_date);
										
			main_ajax_day(selected_date,ls_time);
		}
	 
	 if(ls_id =="calender_week"){

			$( "#calender_datepicker" ).datepicker( "destroy" );
			week_datepiker()    
			$('#calender_datepicker .ui-datepicker-calendar tr').bind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
			$('#calender_datepicker .ui-datepicker-calendar tr').bind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
			
			
			var date = new Date($("#calender_datepicker").datepicker("getDate"));
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
						
			var select_date		= $.datepicker.formatDate('dd MM',startDate)+" To "+$.datepicker.formatDate('dd MM, yy',endDate);
            $( "#cal_show_date" ).html(select_date);
			var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);

			main_ajax_week(ls_time);
		}
	 
	 if(ls_id =="calender_month"){
	 	$( "#calender_datepicker" ).datepicker( "destroy" );
		$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
		$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
		
	 	month_datepiker();
		$( "#cal_show_date" ).html($.datepicker.formatDate('MM , yy',new Date()));
			
		var calender_date		= new Date($("#calender_datepicker").datepicker("getDate"));
		var calander_day		= parseInt($.datepicker.formatDate('d',calender_date));
		var total_day			= parseInt(new Date($.datepicker.formatDate('yy',calender_date), $.datepicker.formatDate('m',calender_date), 0).getDate())

		startDate	= new Date(calender_date.getFullYear(), calender_date.getMonth(), calender_date.getDate() - calander_day+1);
        endDate		= new Date(calender_date.getFullYear(), calender_date.getMonth(), calender_date.getDate() 
							+ (total_day-calander_day));
		var ls_time= [];
		ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
		ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);

		main_ajax_month(ls_time);
	
		}	 
	 
	 if(ls_id =="calender_agenda"){
		$( "#calender_datepicker" ).datepicker( "destroy" );
	 		day_datepicker()
			$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
			$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
			
	 		var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
		   	var selected_date	= $.datepicker.formatDate('yy-mm-dd',myDate);
			
			var select_date		= $.datepicker.formatDate('DD, MM dd, yy',myDate);
            $( "#cal_show_date" ).html(select_date);
			
			agendaMainContener(selected_date) 
		}	 
	})
	
	//left bar checkbox
	
	$("#cal_staff input[type=checkbox]").change(function(){
	var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');

		if(val_top_radio=='calender_day'){
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
			var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time			= $("#div_pre_cube").val();
			main_ajax_day(selected_date,ls_time);
		}
		
		if(val_top_radio=='calender_week'){
			var date = new Date($("#calender_datepicker").datepicker("getDate"));
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
			var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
			
			var ls_id=$(this).attr('id');
			$("#cal_staff input[type=checkbox]").removeAttr('checked');
			$('#'+ls_id).attr('checked', 'checked');
			main_ajax_week(ls_time);
		}

		if(val_top_radio=='calender_month'){
			var calender_date		= new Date($("#calender_datepicker").datepicker("getDate"));
			var calander_day		= parseInt($.datepicker.formatDate('d',calender_date));
			var total_day			= parseInt(new Date($.datepicker.formatDate('yy',calender_date), $.datepicker.formatDate('m',calender_date), 0).getDate())

			startDate	= new Date(calender_date.getFullYear(), calender_date.getMonth(), calender_date.getDate() - calander_day+1);
        	endDate		= new Date(calender_date.getFullYear(), calender_date.getMonth(), calender_date.getDate() 
							+ (total_day-calander_day));
				var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);

			main_ajax_month(ls_time);
		}
	
		if(val_top_radio =="calender_agenda"){
		$( "#calender_datepicker" ).datepicker( "destroy" );
	 		day_datepicker()
	 		var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
		   	var selected_date	= $.datepicker.formatDate('yy-mm-dd',myDate);			
			var select_date		= $.datepicker.formatDate('DD, MM dd, yy',myDate);
            $( "#cal_show_date" ).html(select_date);		
			agendaMainContener(selected_date)
		}	
	
	})

	$("#cal_services input[type=checkbox]").change(function(){
	var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');
		
		if(val_top_radio=='calender_day'){
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
			var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time			= $("#div_pre_cube").val();
			main_ajax_day(selected_date,ls_time);
		}
		
		if(val_top_radio=='calender_week'){
			var date = new Date($("#calender_datepicker").datepicker("getDate"));
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
			var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
			main_ajax_week(ls_time);
		}
		
		if(val_top_radio=='calender_month'){
			var calender_date		= new Date($("#calender_datepicker").datepicker("getDate"));
			var calander_day		= parseInt($.datepicker.formatDate('d',calender_date));
			var total_day			= parseInt(new Date($.datepicker.formatDate('yy',calender_date), $.datepicker.formatDate('m',calender_date), 0).getDate())

			startDate	= new Date(calender_date.getFullYear(), calender_date.getMonth(), calender_date.getDate() - calander_day+1);
        	endDate		= new Date(calender_date.getFullYear(), calender_date.getMonth(), calender_date.getDate() 
							+ (total_day-calander_day));
				var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);

			main_ajax_month(ls_time);
		}
		
		if(val_top_radio =="calender_agenda"){
		$( "#calender_datepicker" ).datepicker( "destroy" );
	 		day_datepicker()
	 		var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
		   	var selected_date	= $.datepicker.formatDate('yy-mm-dd',myDate);			
			var select_date		= $.datepicker.formatDate('DD, MM dd, yy',myDate);
            $( "#cal_show_date" ).html(select_date);		
			agendaMainContener(selected_date)
		}		
	})
	
	$( "#calender_pre" ).button({
        text: false,
        icons: {
            primary: "ui-icon-seek-prev"
            }
    }).click(function(){	
		var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');
		
		if(val_top_radio=='calender_day'){
			var date2 = $('#calender_datepicker').datepicker('getDate', '-1d');
			 	date2.setDate(date2.getDate()-1); 
				toDay		= new Date();
				
			if(date2<toDay){
					alert('Sorry We unable to show previous data.');
				}else{
					var date3	= $.datepicker.formatDate('DD, MM dd, yy',date2);
		 			$( "#cal_show_date" ).html(date3);
					$('#calender_datepicker').datepicker('setDate', date2);
					var selected_today	= $.datepicker.formatDate('dd/mm/yy',date2);
					var ls_time	=	$("#div_pre_cube").val();
		        	main_ajax_day(selected_today,ls_time);
				}
		}
		
		if(val_top_radio=='calender_week'){
			
			var date = $('#calender_datepicker').datepicker('getDate', '-6d');
			 	date.setDate(date.getDate()-6); 
				startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            	endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
				toDay		= new Date();
			
			if($("#cal_staff input[type='checkbox'][name='emp']:checked").length > 0){
				if(date<toDay){
					alert('Sorry We unable to show previous data.');
				}else{
					var show_date	= $.datepicker.formatDate('dd MM',startDate)+" To "+$.datepicker.formatDate('dd MM, yy',endDate);
					$( "#cal_show_date" ).html(show_date);
					$('#calender_datepicker').datepicker('setDate', date);
					var ls_time= [];
					ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
					ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
					main_ajax_week(ls_time);
				}
			}else{
				alert('Please select staff from the left bar.');
			}
		}	
		
		if(val_top_radio=='calender_month'){
			
			var now_day			= new Date();
			var month			= $.datepicker.formatDate('m',now_day);
			var year			= $.datepicker.formatDate('yy',now_day);
			var calender_date	= new Date($("#calender_datepicker").datepicker("getDate"));
			var ls_calender_month	= $.datepicker.formatDate('m',calender_date);
			
			if(ls_calender_month==month){
				var total_day		= new Date(year, month-1, 0).getDate();
				var calander_day	= $.datepicker.formatDate('d',calender_date);
				var current_date	= parseInt(total_day)+ parseInt(calander_day)-1 ;

			}else{
				var ls_year			= $.datepicker.formatDate('yy',calender_date);
				var ls_month		= $.datepicker.formatDate('m',calender_date);
				var ls_date			= $.datepicker.formatDate('d',calender_date);
				
				if(ls_date == 1){	
					var current_date	= parseInt(new Date(ls_year, ls_month-1, 0).getDate());
				}else{
					var current_date	= parseInt(new Date(ls_year, ls_month-1, 0).getDate())+ parseInt(ls_date)-1;
				}
			}
			
						
			var date = $('#calender_datepicker').datepicker('getDate', '-'+current_date+'d');
			 	date.setDate(date.getDate()-current_date);
				$('#calender_datepicker').datepicker('setDate', date);
			var	new_date= new Date($("#calender_datepicker").datepicker("getDate"));
				startDate	= new Date(new_date.getFullYear(), new_date.getMonth(), new_date.getDate());
            	endDate		= new Date(new_date.getFullYear(), new_date.getMonth(), new_date.getDate() 
								+ parseInt(new Date($.datepicker.formatDate('yy',new_date), $.datepicker.formatDate('m',new_date), 0).getDate())-1);
			$( "#cal_show_date" ).html($.datepicker.formatDate('MM , yy',new_date));
					var ls_time= [];
					ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
					ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
					main_ajax_month(ls_time);

		}
	
		if(val_top_radio=='calender_agenda'){
		var date2 = $('#calender_datepicker').datepicker('getDate', '-1d');
			 	date2.setDate(date2.getDate()-1); 
				toDay		= new Date();
				
			if(date2<toDay){
					alert('Sorry We unable to show previous data.');
				}else{
					lightbox();
					var date3	= $.datepicker.formatDate('DD, MM dd, yy',date2);
		 			$( "#cal_show_date" ).html(date3);
					$('#calender_datepicker').datepicker('setDate', date2);
					var selected_today	= $.datepicker.formatDate('yy-mm-dd',date2);
		        	agendaMainContener(selected_today);
				}
		}
	
	});
	
	
    $( "#calender_next" ).button({
        text: false,
        icons: {
            primary: "ui-icon-seek-next"
            }
    }).click(function(){
		var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');
		
		if(val_top_radio=='calender_day'){
			var date2 = $('#calender_datepicker').datepicker('getDate', '+1d');
			 	date2.setDate(date2.getDate()+1); 
			var date3	= $.datepicker.formatDate('DD, MM dd, yy',date2);
 			$( "#cal_show_date" ).html(date3);
			$('#calender_datepicker').datepicker('setDate', date2);
			var selected_today	= $.datepicker.formatDate('dd/mm/yy',date2);
			var ls_time	=	$("#div_pre_cube").val();
        	main_ajax_day(selected_today,ls_time);
		}
		
		if(val_top_radio=='calender_week'){
				var date = $('#calender_datepicker').datepicker('getDate', '+6d');
			 	date.setDate(date.getDate()+6); 
				startDate	= new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            	endDate		= new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
			
				var show_date	= $.datepicker.formatDate('dd MM',startDate)+" To "+$.datepicker.formatDate('dd MM, yy',endDate);
				$( "#cal_show_date" ).html(show_date);
				$('#calender_datepicker').datepicker('setDate', date);
				var ls_time= [];
				ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
				ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
				main_ajax_week(ls_time);
		}
	
		if(val_top_radio=='calender_month'){
			
			var now_day				= new Date();
			var month				= parseInt($.datepicker.formatDate('m',now_day));
			var year				= parseInt($.datepicker.formatDate('yy',now_day));
			var calender_date		= new Date($("#calender_datepicker").datepicker("getDate"));
			var ls_calender_month	= parseInt($.datepicker.formatDate('m',calender_date));
			
			if(ls_calender_month==month){
				var total_day		= new Date(year, month, 0).getDate();
				var calander_day	= $.datepicker.formatDate('d',calender_date);
				var current_date	= parseInt(total_day)- parseInt(calander_day)+1 ;

			}else{
				var ls_year			= parseInt($.datepicker.formatDate('yy',calender_date));
				var ls_month		= parseInt($.datepicker.formatDate('m',calender_date));
				var ls_date			= parseInt($.datepicker.formatDate('d',calender_date));
				
				if(ls_date == 1){	
					var current_date	= parseInt(new Date(ls_year, ls_month, 0).getDate());
				}else{
					var current_date	= parseInt(new Date(ls_year, ls_month, 0).getDate())- parseInt(ls_date)+1;
				}
			}
		
			var date = $('#calender_datepicker').datepicker('getDate', '+'+current_date+'d');
			 	date.setDate(date.getDate()+current_date);
				$('#calender_datepicker').datepicker('setDate', date);
			var	new_date= new Date($("#calender_datepicker").datepicker("getDate"));
				startDate	= new Date(new_date.getFullYear(), new_date.getMonth(), new_date.getDate());
            	endDate		= new Date(new_date.getFullYear(), new_date.getMonth(), new_date.getDate() 
								+ parseInt(new Date($.datepicker.formatDate('yy',new_date), $.datepicker.formatDate('m',new_date), 0).getDate())-1);
			$( "#cal_show_date" ).html($.datepicker.formatDate('MM , yy',new_date));					
					var ls_time= [];
					ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
					ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
				
					main_ajax_month(ls_time);

		}
		
		if(val_top_radio=='calender_agenda'){
		lightbox();
		var date2 = $('#calender_datepicker').datepicker('getDate', '+1d');
			 	date2.setDate(date2.getDate()+1); 
			var date3	= $.datepicker.formatDate('DD, MM dd, yy',date2);
 			$( "#cal_show_date" ).html(date3);
			$('#calender_datepicker').datepicker('setDate', date2);
			var selected_today	= $.datepicker.formatDate('yy-mm-dd',date2);
			
			agendaMainContener(selected_today)
		}
	});
	
	$( "#calender_print" ).button({
         label: "Print",
        icons: {
            primary: "ui-icon-print"
            }
    }).click(function(){
		window.print()
	});
	
	$( "#calender_ical" ).button({
        label: "iCal",
        icons: {
            primary: "ui-icon-signal-diag"
            }
    }).click(function(){
		window.location = BASE_URL+"/staff/staff_calender_ajax/ical_data/";
	});

	$( "#calender_stack" ).button({
        text: false,
        icons: {
            primary: "ui-icon-pin-w"
            }
    });

	$( "#calender_refresh" ).button({
        text: false,
        icons: {
            primary: "ui-icon-arrowrefresh-1-w"
            }
    }).click(function(){
		window.location.reload();
	});
	
	$( "#calender_settings" ).button({
        text: false,
        icons: {
            primary: "ui-icon-gear"
            }
    }).click(function() {
	
	if ($("#effect").length == 0 ) {
        $(ls_setting).insertAfter($("#calender_settings"));
    }
		 runEffect();
		 return false;
	});
	
	//all top button
	DatToWeekAndBlock();

})
	

	function SelectAllUser(id){
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'employee_id':id},
					  url:BASE_URL+"/staff/staff_calender_ajax/block_all_staff",
					  success:function(datas){
					   	 $('#span_allstaff').html(''); 
						 $('#span_allstaff').html(datas);
						 closeLightbox();
						}
					});
				}
			//check login end
			}  
		});
		
		
	}
	
	function block_date(){
			$( "#block_from" ).datepicker({
						minDate: new Date(),
						changeMonth: true,
						changeYear: true,
						inline: true,
						numberOfMonths: 1,
						dateFormat: 'dd-mm-yy',
						onClose: function( selectedDate ) {
											$( "#block_to" ).datepicker( "option", "minDate", selectedDate );
											}
			});
			
			$( "#block_to" ).datepicker({
						minDate: new Date(),
						changeMonth: true,
						changeYear: true,
						inline: true,
						numberOfMonths: 1,
						dateFormat: 'dd-mm-yy',
						onClose: function( selectedDate ) {
											$( "#block_from" ).datepicker( "option", "maxDate", selectedDate );
											}
			});
	}
	
	function DatToWeekAndBlock(){
	$( ".calender_week_top" ).button({
        text: false,
        icons: {
            primary: "ui-icon-newwin"
            }
    }).mouseenter(function(){
			$("<div id='remove_me' ><span>See weekly schedule of "+$(this).attr('rel')+"</span></div>").insertAfter($("#"+$(this).attr('id')));
	}).mouseleave(function(){
			$("#remove_me").remove();
	}).click(function(){
			
			$( "#calender_datepicker" ).datepicker( "destroy" );
			week_datepiker()    
			$('#calender_datepicker .ui-datepicker-calendar tr').bind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
			$('#calender_datepicker .ui-datepicker-calendar tr').bind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
			
			var date = new Date($("#calender_datepicker").datepicker("getDate"));
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
						
			var select_date		= $.datepicker.formatDate('dd MM',startDate)+" To "+$.datepicker.formatDate('dd MM, yy',endDate);
            $( "#cal_show_date" ).html(select_date);
			var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
			
			$("#radioset input[name='radio']").removeAttr('checked');
			$("#radioset input[name='radio']").next('label').removeClass('ui-state-active');
	 		$('#calender_week').attr('checked', 'checked');
			$('#calender_week').next('label').addClass('ui-state-active');

			var ls_id=$(this).attr('id').split("_");
			$("#cal_staff input[type=checkbox]").removeAttr('checked');
			$('#cal_staff #emp_'+ls_id[1]).attr('checked', 'checked');
			main_ajax_week(ls_time);	
	});

	$( ".calender_block_top" ).button({
        text: false,
        icons: {
            primary: "ui-icon-cancel"
            }
    }).mouseenter(function(){
			var CurrentDate 	= new Date($("#calender_datepicker").datepicker("getDate"));
			$("<div id='remove_me_blk' ><span>Block "+$.datepicker.formatDate('M dd',CurrentDate)+" for "+$(this).attr('rel')+"</span></div>").insertAfter($("#"+$(this).attr('id')));
	}).mouseleave(function(){
			$("#remove_me_blk").remove();
	}).click(function(){
	var ls_id=$(this).attr('id').split("_");
	var CurrentDate 	= new Date($("#calender_datepicker").datepicker("getDate"));
	var local_string='<table border=\"0\" cellpadding=\"3\" cellspacing=\"3\" width=\"200px\">';
		local_string+='<tr>';
		local_string+='<td align=\"left\" width=\"90px\">';
		local_string+='<h3>Blocak Date</h3>';
		local_string+='</td>';
		local_string+='<td width=\"20px\">&nbsp;</td>';
		local_string+='<td align=\"right\" width=\"90px\">';
		local_string+='<strong style=\"cursor: pointer;\" class="closeTip" onclick=\"CloseBlock(\'TopBlockDiv\')\">X</strong>';
		local_string+='</td>';
		local_string+='</tr><tr>';
		local_string+='<td colspan=\"3\"  align=\"left\">Select Date: </td>';
		local_string+='</tr><tr>';
		local_string+='<td align=\"left\" width=\"90px\">';
		local_string+='<input value=\"'+$.datepicker.formatDate('dd-mm-yy',CurrentDate)+'\" id=\"block_from\" name=\"block_from\" type=\"text\" readonly=\"true\"/>';
		local_string+='</td><td width=\"20px\">';
		local_string+='&nbsp;&nbsp;To&nbsp;&nbsp;';
		local_string+='</td><td align=\"right\" width=\"90px\">';
		local_string+='<input value=\"'+$.datepicker.formatDate('dd-mm-yy',CurrentDate)+'\" readonly=\"true\" type=\"text\" id=\"block_to\" name=\"block_to\"/>';
		local_string+='</td></tr><tr><td  align=\"left\" colspan=\"3\">';
		local_string+='<span id=\"span_allstaff\">';
		local_string+='<a href=\"#\" onclick=\"SelectAllUser('+ls_id[1]+')\">';
		local_string+='Repeat blocking for multiple staff';
		local_string+='</a>';
		local_string+='</span>';
		local_string+='</td></tr>';
		local_string+='<tr><td colspan=\"3\">&nbsp;</td></tr>';
		local_string+='<tr><td class="Tipfooter" colspan=\"3\">';
		local_string+='<input type=\"hidden\" id=\"block_staff_id\" value=\"'+ls_id[1]+'\">';
		local_string+='<input type=\"hidden\" id=\"block_date\" value=\"'+$.datepicker.formatDate('dd-mm-yy',CurrentDate)+'\">';
		local_string+='<input onclick=\"SubmitBlock('+ls_id[1]+')\" id="block_btn_staff" class=\"btn-blue\" type=\"button\" value=\"Block\"/>';
		local_string+='</td></tr></table>';
			
		if ($("#TopBlockDiv").length == 0 ) {
        	$("<div id='TopBlockDiv'><span>"+local_string+"</span></div>").insertAfter($("#"+$(this).attr('id')));
			block_date();
    	}else{
			alert("Opps!! already you have open block menu");
		}
	});
	

	}
	
	function SubmitBlock(empId){
		var block_from 				= $("#block_from").val();
		var block_to 				= $("#block_to").val();
		var i=0;
		var ls_staff=[];
		$( "#span_allstaff input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_staff[i] = $(this).val();
				i++;
		   	 }
		});
		if(ls_staff.length == 0){
			ls_staff[0] = empId;
		}
		$('<img height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>').insertAfter("#block_btn_staff");
		$("#block_btn_staff").remove();
		

		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					////////////////////////////////
					$.ajax({
						  type: 'POST',
						  data: {'block_from':block_from,'block_to':block_to,'blockempArr':ls_staff},
						  url:BASE_URL+"/staff/staff_calender_ajax/booked_staff_schedule",
						  success:function(datas){
						  	CloseBlock('TopBlockDiv');
							After_Reschedule_Ajax() 
							closeLightbox();       
							}
						});
					///////////////////////////////////////////
				}
			//check login end
			}  
		});
	}

	function scroll_me_up(){
	   
	    $('#main_contener').animate({ scrollTop: '-=200px' }, 'slow');
}

	function scroll_me_down(){
		$('#main_contener').animate({scrollTop: '+=200px' }, 'slow');
}
	
	function settings_popup(){
		$( "#calender_settings" ).button({
	        text: false,
	        icons: {
	            primary: "ui-icon-gear"
	            }
	    }).click(function() {
		
		if ($("#effect").length == 0 ) {
	        $(ls_setting).insertAfter($("#calender_settings"));
	    }
			 runEffect();
			 return false;
		});
	}
	
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
		
		$('#lightbox').append('<img src="'+SITE_URL+'/asset/wait_a_min.gif"/><br /><strong>Loading....</strong>');
		
		$('#lightbox').css('top', $(window).scrollTop() + 50 + '%');
		$('#lightbox').show();
		$('#lightbox-shadow').show();
	}
	
	function closeLightbox(){
		$('#lightbox').remove();
		$('#lightbox-shadow').remove();
		$('#lightbox').empty();
	}

	function After_Reschedule_Ajax(){
		var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');

		if(val_top_radio=='calender_day'){
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
			var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time			= $("#div_pre_cube").val();
			main_ajax_day(selected_date,ls_time);
		}
		
		if(val_top_radio=='calender_week'){
			var date = new Date($("#calender_datepicker").datepicker("getDate"));
            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
			var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
			main_ajax_week(ls_time);
		}
	}
	
	function scroll_me(){
			var currentTime = new Date();
			var hours = currentTime.getHours();
			var today = currentTime.getDate()+'/'+(currentTime.getMonth()+1)+'/'+currentTime.getFullYear();
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
			var selected_date	= $.datepicker.formatDate('d/m/yy',myDate);
			
	if(today == selected_date){
		var elem = $('#scroll_'+hours);
		if(elem) {
			$('#main_contener').animate({scrollTop:elem.position().top}, 'slow');
			var i=0;
			for(i=0;i<23;i++){
				if(i<hours){
					$('#scroll_'+i).removeAttr("style");
					$('#scroll_'+i).attr("style", 'background:#D3D3D3');
					$( "#scroll_"+i+" .bodypartonecol" ).each(function( index ) {
						$("#scroll_"+i+" .bodypartonecol div").removeClass("non_drag");
						$("#scroll_"+i+" .bodypartonecol div").addClass("diseable_drag");
						$("#scroll_"+i+" .bodypartonecol div").removeClass("droppable");
						$("#scroll_"+i+" .bodypartonecol div").removeClass("ui-droppable");
					});
				}
			}
			$(elem).removeAttr("style");
			$(elem).attr("style", 'background:#fceeaa')
		}
		}else{
			var elem = $('#scroll_0');
			$('#main_contener').animate({scrollTop:elem.position().top}, 'slow');
		}
}
		



/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				DAY CALENDER			#####################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/
	function day_datepicker(){
	//left panal datepiker 
	var dateToday = new Date(); 
	$( "#calender_datepicker" ).datepicker({
						inline: true,
                        dateFormat: 'dd/mm/yy',
                        changeMonth: true,
                        minDate: dateToday,
                        changeYear: true,
                        beforeShowDay: SplDate,
                        firstDay: 1,
                        onSelect: function(selectedDate) {
                                        var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
                                        var select_date		= $.datepicker.formatDate('DD, MM dd, yy',myDate);
                                        $( "#cal_show_date" ).html(select_date);

                                        var ls_time	=	$("#div_pre_cube").val();
										
										var ls_id=$("#radioset input[name='radio']:checked").attr('id');

										if(ls_id =="calender_day"){
											main_ajax_day(selectedDate,ls_time);
										}
                                        if(ls_id =="calender_agenda"){
											var tempdate		= $.datepicker.formatDate('yy-mm-dd',myDate);
											agendaMainContener(tempdate)
										}
                                  }
		});
}

	$(function() {
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	g_date = date;
	day_datepicker()
	scroll_me();
	drag_div();
	
 //button headding
 	var mydate 	= new Date();
   	var select_date	= $.datepicker.formatDate('DD, MM dd, yy',mydate);
 	$( "#cal_show_date" ).html(select_date);
		
    $( "#calender_today" ).button({
        label: "Today",
        icons: {
            primary: "ui-icon-home"
            }
    }).click(function(){
		
		$( "#calender_datepicker" ).datepicker( "destroy" );
	 		day_datepicker()
		$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
		$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
		
		$("#radioset input[name='radio']").removeAttr('checked');
		$("#radioset input[name='radio']").next('label').removeClass('ui-state-active');
		document.getElementById("calender_day").checked=true;
		$('#calender_day').next('label').addClass('ui-state-active');
		
		$("#cal_staff input[type=checkbox]").removeAttr('checked');
		
		var myDate 			= new Date();
   		var selected_today	= $.datepicker.formatDate('dd/mm/yy',myDate);
		$( "#calender_datepicker" ).datepicker( "setDate", selected_today );
		var select_date	= $.datepicker.formatDate('DD, MM dd, yy',myDate);
 		$( "#cal_show_date" ).html(select_date);
		var ls_time	=	$("#div_pre_cube").val();
        main_ajax_day(selected_today,ls_time);
	});
	

});

//General calender function
	function SplDate(date){
        var day = date.getDay(), Sunday = 0, Monday = 1, Tuesday = 2, Wednesday = 3, Thursday = 4, Friday = 5, Saturday = 6;
      //  var closedDates = [[1, 25, 2013], [1, 28, 2013],[1, 26, 2013]];
		//Highlighted Date
		var highlightDate = new Array();
			highlightDate = $("#Show_all_booking_date").val().split("@@");//id data format 3_22_2013@@3_26_2013
			for (a in highlightDate ) {
					highlightDate[a] = highlightDate[a].split("_");
			}

		var array_length = highlightDate.length 
			
     //   var closedDays = [[Sunday]];//[Sunday], [Wednesday]
		 var closedDays = [];
        for (var i = 0; i < closedDays.length; i++) {
            if (day == closedDays[i][0]) {
                return [false];
            }

        }

        for (i = 0; i < array_length; i++) {
          /*  if (date.getMonth() == closedDates[i][0] - 1 &&
            date.getDate() == closedDates[i][1] &&
            date.getFullYear() == closedDates[i][2]) {
                return [false];
            }
		  */
            if (date.getMonth() == highlightDate[i][0] - 1 &&
            date.getDate() == highlightDate[i][1] &&
            date.getFullYear() == highlightDate[i][2]) {
               return [true,"pard_bk_date"];
            }
        }
        return [true];
    }

var ls_setting='';
	ls_setting+='<div id="effect" style="display: none;background: none repeat scroll 0 0 #CCCCCC; border: 2px solid #000;position: absolute;z-index: 999999;" >';
	ls_setting+='<table border="0" cellpadding="5" cellspacing="8">';
	ls_setting+='<tr>';
	ls_setting+='<td colspan="2" align="center"><strong>Set workable time</strong></td>';
	ls_setting+='</tr><tr>';
	ls_setting+='<td valign="top">Difference: </td>';
	ls_setting+='<td valign="top"><select id="cal_difference"><option value="5">5 </option><option value="10">10 </option><option value="15">15 </option><option  value="20">20 </option><option value="30">30 </option><option value="60" selected="selected">60 </option></select> Min.</td></tr>';
//	ls_setting+='<tr><td valign="top">Set row width: </td><td valign="top"><input type="text" value="150" id="set_row_width" size="3">.px</td></tr>';
	ls_setting+='<tr>';
	ls_setting+='<td align="right"><input class="btn-blue" type="button" onclick="genaret_row();" value="Save"></td>';
	ls_setting+='<td aligen="left"><input class="btn-blue" type="button" onclick="close_ui_popup(\'effect\')" value="Close"></td>';
	ls_setting+='</tr>';
	ls_setting+='</table>';
	ls_setting+='</div>';
var ls_lightbox_day='<div id="day_booking" title="New appointment" style="display: none;"><span id="day_booking_contenar"><img style="padding:0 0 0 250px;" src="'+SITE_URL+'/asset/wait_a_min.gif"/></span></div>';

	$(function(){	
		booking_form_open();
		schedule_booking();
		booking_option();
		group_booking_details();
	})
	
//open booking form
	function booking_form_open(){
		$('.non_drag').click(function(){
		var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
   		var selected_date	= $.datepicker.formatDate('dd-mm-yy',myDate);
		var ls_id			= $(this).attr('id');
		if ($("#day_booking").length == 0 ) {
        	$(ls_lightbox_day).insertAfter($("#main_contener"));
    	}else{
			 $('#day_booking_contenar').html('<img style="padding:0 0 0 250px;" src="'+SITE_URL+'/asset/wait_a_min.gif"/>');
		}
		var ls_services=[];
		var j=0;
		$( "#cal_services input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});
		
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					////////////////////////////////
					$.ajax({
					  type: 'POST',
					  data: {'time_div':ls_id, 'selected_date':selected_date, 'serviceArr':ls_services,'type':'day'},
					  url:BASE_URL+"/staff/staff_calender_ajax/genaret_day_form",
					  success:function(datas){
					   	 $('#day_booking_contenar').html(datas);
						 tab_day();
						}
					});
					///////////////////////////////////////////
				}
			//check login end
			}  
		});


		$( "#day_booking" ).dialog({
				width: 600,
				modal: true,
				show: "blind",
				hide: "explode"
			});
		
		})
	}

// booking schedule icon
	function schedule_booking(){
		$('.schedule_booking').click(function(){
		var CurrentDate 	= 	new Date($("#calender_datepicker").datepicker("getDate"));
		var attach_div_id	=	$(this).parent().parent().attr('id');
		$("#ScheduleBooking").remove();	
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						closeLightbox();
						$("#"+attach_div_id).append("<div id='ScheduleBooking'><span id=\"ScheduleBooking_contenar\"><center><img src='"+SITE_URL+"/asset/wait_a_min.gif'/><br>Loading...</center></span></div>");
						$.ajax({
						  type: 'POST',
						  data: {'srvDetails':attach_div_id},
						  url:BASE_URL+"/staff/staff_calender_ajax/schedule_booking_form",
						  success:function(datas){
						   	 $('#ScheduleBooking_contenar').html('');
							 $('#ScheduleBooking_contenar').html(datas);
						}
						});
					}
				//check login end
				}  
			});
		})
	}
	
	function booking_option_submit(){
		var statusId	=	$('#ScheduleBooking_contenar input:radio[name=statusType]:checked').val();
		var srvDtlsId		=	$('#srvDtlsId').val();
		

		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
						  type: 'POST',
						  data: {'statusId':statusId,'srvDtlsId':srvDtlsId},
						  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_submit",
						  success:function(datas){
						  		$("#ScheduleBooking").remove();
								After_Reschedule_Ajax();
								closeLightbox();
							}
						});
				}
			//check login end
			}  
		});
	}
	
// booking option icon
	function booking_option(){
		$('.booking_option').click(function(){
			var CurrentDate 	= 	new Date($("#calender_datepicker").datepicker("getDate"));
			var attach_div_id	=	$(this).parent().parent().attr('id');
			$("#BookingOption").remove();
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						$("#"+attach_div_id).append("<div id='BookingOption'><span id=\"BookingOption_contenar\"><center><img src='"+SITE_URL+"/asset/wait_a_min.gif'/><br>Loading...</center></span><strong style=\"cursor: pointer;\" class=\"closeTip\" onclick=\"CloseBlock(\'BookingOption\')\">X</strong></div>");
						$.ajax({
						  type: 'POST',
						  data: {'id_time':attach_div_id},
						  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_form",
						  success:function(datas){
						   	 $('#BookingOption_contenar').html('');
							 $('#BookingOption_contenar').html(datas);
							 closeLightbox();
							}
						});
					}
				//check login end
				}  
			});
		})
	}
	
	function app_option_details(type){
		var id_time		=	$('#id_and_time').val();
		
		if(type == 'Cancel'){
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'id_time':id_time},
					  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_html/cancel",
					  success:function(datas){
					   	 $('#BookingOption_contenar').html('');
						 $('#BookingOption_contenar').html(datas);
						}
					});
				}
			//check login end
			}  
		});
		}
		
		if(type == 'Client'){
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						$.ajax({
						  type: 'POST',
						  data: {'id_time':id_time},
						  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_html/client",
						  success:function(datas){
						  	 closeLightbox();
						   	 $('#BookingOption_contenar').html('');
							 $('#BookingOption_contenar').html(datas);
							}
						});
					}
				//check login end
				}  
			});
		}
		
		if(type == 'Order'){
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						$.ajax({
							  type: 'POST',
							  data: {'id_time':id_time},
							  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_html/order",
							  success:function(datas){
							  		closeLightbox();
							  		CloseBlock('BookingOption');
									pr_popup(850)
									$("#front_popup_content").html(datas);
								}
							});
					}
				//check login end
				}  
			});
		}
		
		if(type == 'Edit'){
			var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
        	var select_date		= $.datepicker.formatDate('yy-mm-dd',myDate);
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						$.ajax({
						  type: 'POST',
						  data: {'id_time':id_time,'select_date':select_date},
						  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_html/edit",
						  success:function(datas){
						  	closeLightbox();
						   	 $('#BookingOption_contenar').html('');
							 $('#BookingOption_contenar').html(datas);
							 edit_form_app();
							}
						});
					}
				//check login end
				}  
			});
		}
		
		if(type == 'Ask'){
			if (confirm("An email would be sent to client with a link to review page. Click OK to send.")) {
 				lightbox('TopBlockDiv'); 
				$.ajax({
					url: SITE_URL+"page/fn_checkLogInAdmin_staff",
					type: "post",
					success: function(result){
					//check login start
						if(result == 0){
							window.location.href = SITE_URL+'staff';
						}else{
							$.ajax({
							  type: 'POST',
							  data: {'id_time':id_time},
							  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_html/aks",
							  success:function(datas){
							   	 CloseBlock('BookingOption');
								 closeLightbox();
								}
							});
						}
					//check login end
					}  
				});
   			}
   			return false;
		}
		
		if(type == 'Email'){
			if (confirm("An email would be sent to client. Click OK to send.")) {
				lightbox('TopBlockDiv'); 
				$.ajax({
					url: SITE_URL+"page/fn_checkLogInAdmin_staff",
					type: "post",
					success: function(result){
					//check login start
						if(result == 0){
							window.location.href = SITE_URL+'staff';
						}else{
							$.ajax({
							  type: 'POST',
							  data: {'id_time':id_time},
							  url:BASE_URL+"/staff/staff_calender_ajax/booking_option_html/send_mail",
							  success:function(datas){
							   	 CloseBlock('BookingOption');
								 closeLightbox();
								}
							});
						}
					//check login end
					}  
				});
   			}
   			return false;
		}
		
	}

	function staff_availability(employeeId){
		var serviceId 	= $('#re_serviceId').val();
		var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
        var bookDate	= $.datepicker.formatDate('yy-mm-dd',myDate);
		var timeDiff	=	$("#div_pre_cube").val();
		genaretTime(serviceId,bookDate,employeeId,timeDiff);
	}
	
	function edit_form_app(){
		var dateToday = new Date(); 
		$( "#choosen_booking_date" ).datepicker({
							inline: true,
	                        dateFormat: 'yy-mm-dd',
	                        minDate: dateToday,
	                        firstDay: 1,
	                        onSelect: function(bookDate) {
											var serviceId 	= $('#re_serviceId').val();
											var employeeId 	= $("#re_employeeId").val();
											var timeDiff	= $("#div_pre_cube").val();
	                                        genaretTime(serviceId,bookDate,employeeId,timeDiff);
	                                  }
			});
	
		var serviceId 	= $('#re_serviceId').val();
		var employeeId 	= $("#re_employeeId").val();
		var timeDiff	= $("#div_pre_cube").val();
		var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
        var bookDate	= $.datepicker.formatDate('yy-mm-dd',myDate);
		genaretTime(serviceId,bookDate,employeeId,timeDiff);
	}
	
	function genaretTime(serviceId,bookDate,employeeId,timeDiff){
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'staff_id':employeeId,'select_date':bookDate,'time_difference':timeDiff,'service_id':serviceId},
					  url:BASE_URL+"/staff/staff_calender_ajax/staffWiseTimeDropDown",
					  success:function(datas){
					  	closeLightbox();
					  $('#choosen_booking_time_span').html('');
					  $('#choosen_booking_time_span').html(datas);
						}
					});
				}
			//check login end
			}  
		});		
	}
	
	function make_reschedule(bookingDetailsId){
		var serviceId				= $('#re_serviceId').val();
		var serviceQuantity			= $('#re_serviceQuantity').val();
		var employeeId 				= $('#re_employeeId').val();
		var bookingDate			 	= $('#choosen_booking_date').val();
		var bookingTime			 	= $('#choosen_booking_time').val();
		if(bookingTime ==''){
			$('#choosen_booking_time').attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
		}else{
			$('<img  height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>').insertAfter("#re_button");
			$("#re_button").remove();	
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					closeLightbox();
					$.ajax({
					  type: 'POST',
					  data: {'bookingDetailsId':bookingDetailsId,'serviceId':serviceId,'serviceQuantity':serviceQuantity,'employeeId':employeeId,'bookingDate':bookingDate,'bookingTime':bookingTime},
					  url:BASE_URL+"/staff/staff_calender_ajax/make_reschedule",
					  success:function(datas){
					  	if($.trim(datas) == 1){
							CloseBlock('BookingOption');
							var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
						   	var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
							var ls_time			= $("#div_pre_cube").val();
														
							main_ajax_day(selected_date,ls_time);
						}else{
					   	 $('#re_error').html('');
						 $('#re_error').html(datas);
						 	}
						}
					});
					
				}
			//check login end
			}  
		});
		}
	}
// APPOINTMENT OPTIONS SubmitBlock
	function app_cancel_option(bookingDetailsId){
		var is_email = $('#app_cancel_email').attr('checked') ? "True" : "False";
		
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'bookingDetailsId':bookingDetailsId ,'id_email':is_email},
					  url:BASE_URL+"/staff/staff_calender_ajax/booking_cancel",
					  success:function(datas){
					  	closeLightbox();
					   	 $("#BookingOption").remove();
						 var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
				   	 	 var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
						 var ls_time			= $("#div_pre_cube").val();
						 main_ajax_day(selected_date,ls_time);
						}
					});
				}
			//check login end
			}  
		});
	}
		
// Close all open popup div
	function CloseBlock(blockId){
		$("#"+blockId).remove();
	}
		
//edit customer data
	function edit_day_data(){
		alert('Edit day data');
	}


// drag div Function
	function drag_div(){
	var currentDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
	var reshuDate	= $.datepicker.formatDate('yy-mm-dd',currentDate);
	var DragId='';
	var ls_width=$("#width_per_td").val();	 
	$(".drag_inner").draggable({
				cursor: "move", 
				delay: 400,
				scroll: true, 
				scrollSensitivity: 50, 
				snap: ".droppable",
		//		grid: [ ls_width,70 ],
				revert: "invalid",
				helper: "clone",
				hoverClass: "ui-state-active",
				stop: function(){
					$("#calender_datepicker").removeClass("ondraggingdate");
				},
				start: function () {
								DragId = $( this ).attr("id");
								$("#"+DragId).addClass("droppableout");
								$("#calender_datepicker").addClass("ondraggingdate");
					        	}
				});

    $(".droppable").droppable({
				 accept: ".drag_inner",
				 greedy: true,
				 activeClass: 'droppable-active',
				 hoverClass: 'droppable-hover',
				 drop: function(ev, ui) {
								$("#"+DragId).removeClass("droppableout");
								$("#calender_datepicker").removeClass("ondraggingdate");
								droppedId = $( this ).attr("id");
								lightbox('TopBlockDiv'); 
								$.ajax({
									url: SITE_URL+"page/fn_checkLogInAdmin_staff",
									type: "post",
									success: function(result){
									//check login start
										if(result == 0){
											window.location.href = SITE_URL+'staff';
										}else{
											closeLightbox();
											$.ajax({
										type: 'POST',
										data: {'dragDetails':DragId, 'dropDetails':droppedId,'dragType':'single','reshuDate':reshuDate},
										url:BASE_URL+"/staff/staff_calender_ajax/rescheduleChecking",
										success:function(return_data){
											var retArr = return_data.split('||@@||');
											if ($("#reschedule_div").length == 0 ) {
											$('<div id="reschedule_div"><span id="reschedule_span"></span></div>').appendTo('body');
											} 
											if(retArr[0]==1 ){	
												$('#reschedule_span').html(retArr[1]);
												$( "#reschedule_div" ).dialog({
													modal: true, 
													title: 'Reschedule booking ', 
													autoOpen: true,
							                        width: 500,
													buttons: {
				                            			RESCHEDULE: function () {
														/////Ajax Part Start///
														var ls_isMail=$("#isSendMailRs:checked").val();
														$.ajax({
														type: 'POST',
														data:{'dragDetails':DragId, 'dropDetails':droppedId,'dragType':'single', 'is_mail':ls_isMail,'reshuDate':reshuDate},
														url:BASE_URL+"/staff/staff_calender_ajax/reschedule_Save",
														success:function(return_data){
																if(return_data==1 ){	
																$("#reschedule_div").remove();
																$("#grpBookingDtls").remove();	
																After_Reschedule_Ajax();
																}else{
																$("#reschedule_div").remove();
																$("#grpBookingDtls").remove();
																After_Reschedule_Ajax();
																}
															}
														});
														/////Ajax Part End///
				                            			},
							                            CLOSE: function () {
															close_ui_popup('reschedule_div');
							                                $(this).remove();
							                            }
				                        			},
						                        close: function (event, ui) {
													close_ui_popup('reschedule_div');
						                            $(this).remove();
						                        }
												});
											}
											if(retArr[0]==0 ){	
												$('#reschedule_span').html(retArr[1]);
												$( "#reschedule_div" ).dialog({
													modal: true, 
													title: 'Reschedule booking ', 
													autoOpen: true,
							                        width: 300,
													buttons: {
														CLOSE: function () {
															close_ui_popup('reschedule_div');
							                                $(this).remove();
							                            }
													},
							                        close: function (event, ui) {
														close_ui_popup('reschedule_div');
							                            $(this).remove();
							                        }
												});
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

//day settings on/off
	function runEffect(){
	var options = {};
	$("#effect").toggle( "blind", options, 500 );
	$('#cal_difference').val($("#div_pre_cube").val());
	$('#set_row_width').val($("#width_per_td").val());
};

//day mew genaret html script
	function dayajax(){
		//all top button
		DatToWeekAndBlock();
		scroll_me();
		drag_div();
		settings_popup();
		booking_form_open();
		schedule_booking();
		booking_option();
		group_booking_details();		
	}

//day popup tab Function
	function tab_day(){
	$('#tr_quantity').hide();
	$("#appointment_Service").change(function(){
		var srv_id= $(this).val();
		if(srv_id != -1){
			$('#tr_quantity').show();
			$('#quantity').focus();
		}else{
			$('#tr_quantity').hide();
		}
	})	
				
	$("#tabs input[type=text]").click(function(){
		var ls_id = $(this).attr("id");
		var ls_val = $(this).val();
		if( ls_val == 'First Name' ||
			ls_val == 'Last Name' ||
			ls_val == 'Email' ||
			ls_val == 'Mobile' ||
			ls_val == 'Home No.' ||
			ls_val == 'Work No.' ||
			ls_val == 'Address' ||
			ls_val == 'Zip' ){
				$("#"+ls_id).val('');
			}
		$("#"+ls_id).removeAttr('style');
		$("#"+ls_id).attr('style','border: 1px solid #0736F3; background: #C8DAF7 !important;');
	})
	
	$("#lbl_global").hide();
	$("#chk_global").change(function(){
		if ($('#chk_global').is(':checked')) {
			$("#lbl_global").show();
			$("#lbl_normal").hide();
			$("#search_result_contener").html('');
		}else{
			$("#lbl_global").hide();
			$("#lbl_normal").show();
			$("#search_result_contener").html('');
		} 
	})
	
	$("#tabs select").click(function(){
		var ls_id = $(this).attr("id");
		$("#"+ls_id).removeAttr('style');
		$("#"+ls_id).attr('style','border: 1px solid #0736F3; background: #C8DAF7 !important;');
	})
	$("#tabs select").change(function(){
		var ls_id = $(this).attr("id");
		$("#"+ls_id).removeAttr('style');
	})

	$("#tabs input[type=text], #tabs select").blur(function(){
		var ls_id = $(this).attr("id");
		$("#"+ls_id).removeAttr('style');
		
		if (ls_id=='first_name' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('First Name');
	   	 }
		if (ls_id=='last_name' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('Last Name');
	   	 }
		if (ls_id=='mobile' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('Mobile');
	   	 }
		if (ls_id=='home_no' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('Home No.');
	   	 }
		if (ls_id=='work_no' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('Work No.');
	   	 }
		if (ls_id=='email' && $("#"+ls_id).val()==''){
			$("#"+ls_id).val('Email');
	   	 }else{
		 	var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
			if (!emailexp.test($("#"+ls_id).val()) && ls_id=='email'){
				$("#"+ls_id).attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			}
			if (emailexp.test($("#"+ls_id).val()) && ls_id=='email'){
				var email = $("#"+ls_id).val();
				lightbox('TopBlockDiv'); 
				$.ajax({
					url: SITE_URL+"page/fn_checkLogInAdmin_staff",
					type: "post",
					success: function(result){
					//check login start
						if(result == 0){
							window.location.href = SITE_URL+'staff';
						}else{
							closeLightbox();
							$.ajax({
							   type: 'POST',
							   url:BASE_URL+"/staff/staff_calender_ajax/checkDuplicatEmail",
							   data: {'email':email},
							   success: function(result){
											if($.trim(result) == 'false'){
												$('<br><lable class="errEmail" style="color:#ff0000;" >This emil already used.</lable>').insertAfter('#email');
											}
											if($.trim(result) == 'true'){
												$('.errEmail').remove();
											}
							        }
							});
						}
					//check login end
					}  
				});
			}
		 }
		
		if (ls_id=='pin_code' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('Zip');
	   	 }
		if (ls_id=='address' && $("#"+ls_id).val()=='') {
			$("#"+ls_id).val('Address');
	   	 }
	})

	$('#search_appo').hide();
	$('#new_appo').show();	

	$("#appointment_userType").change(function(){
		var ls_value = $(this).val();
		if(ls_value=='E'){
			$('#search_appo').show();
			$('#new_appo').hide();
		}
		if(ls_value=='N'){
			$('#search_appo').hide();
			$('#new_appo').show();
		}
	})
}

//settings on change 
	function genaret_row(){
	var ls_time	=	$('#cal_difference').val();
	var ls_width	=	$('#set_row_width').val();
	$('#width_per_td').val(ls_width);
	$("#div_pre_cube").val(ls_time);
	
	var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');
		if(val_top_radio=='calender_day'){
			var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
   			var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time		= $("#div_pre_cube").val();
			main_ajax_day(selected_date,ls_time);
		}
		if(val_top_radio=='calender_week'){
			var date = new Date($("#calender_datepicker").datepicker("getDate"));
                        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() );
                        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
			var ls_time= [];
			ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
			ls_time[1]	= $.datepicker.formatDate('yy-mm-dd',endDate);
			main_ajax_week(ls_time);
		}
		
		close_ui_popup('effect');	
}

//close all ui popup
	function close_ui_popup(div_name){
		var options = {};
		$('#'+div_name ).hide( 'explode', options, 800 );
	}
	
	function close_popup(div_name){
		$( '#'+div_name ).dialog( "close" );
		$( '#'+div_name ).remove();
	}

//day main ajax function
	function main_ajax_day(date,interval){
		lightbox();
		var i=0;
		var j=0;
		var ls_staff=[];
		var ls_services=[];
		$( "#cal_staff input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_staff[i] = $(this).val();
				i++;
		   	 }
		});

		$( "#cal_services input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});
		var ls_width = $("#width_per_td").val();
	$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					////////////////////////////////
					$.ajax({
					  type: 'POST',
					  data: {'time_difference':interval, 'selected_date':date, 'selected_staff':ls_staff, 'selected_services':ls_services, 'width_row':ls_width},
					  url:BASE_URL+"/staff/staff_calender_ajax/genaret_row",
					  success:function(datas){
					   	 $('#main_contener').html(''); 
						 $('#main_contener').html(datas);
						 closeLightbox();
						 dayajax();
						}
					});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});
	}

//booking popup form
	function search_form(){
		var ls_key_word = $("#search_text").val();
		if (ls_key_word =='') {
			$("#search_text").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			return false;
	   	 }else{
		 	$('#search_result_contener').html('<center><img src="'+SITE_URL+'/asset/wait_a_min.gif"/><br>Searching..</center>')
		 	if ($('#chk_global').is(':checked')) {
				var search_type = 'global';
			}else{
				var search_type = 'local';
			}
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						$.ajax({
						  type: 'POST',
						  data: {'search_key':ls_key_word ,'search_type':search_type},
						  url:BASE_URL+"/staff/staff_calender_ajax/searchCustomer",
						  success:function(datas){
						   	 $('#search_result_contener').html(datas); 
							 closeLightbox();
							}
						});
						return false;
						
					}
				//check login end
				}  
			});
		 }	
	}
	
	function booking_form(){
		var error = 0;
		
		if ($("#appointment_Service").val()=='-1') {
			$("#appointment_Service").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						

		if ($("#quantity").val()=='') {
			$("#quantity").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		
		if($("#appointment_userType").val()=='N'){	
		if ($("#first_name").val()=='' || $("#first_name").val()=='First Name') {
			$("#first_name").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#last_name").val()=='' || $("#last_name").val()=='Last Name') {
			$("#last_name").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#mobile").val()=='' || $("#mobile").val()=='Mobile') {
			$("#mobile").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#home_no").val()=='' || $("#home_no").val()=='Home No.') {
			$("#home_no").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#work_no").val()=='' || $("#work_no").val()=='Work No.') {
			$("#work_no").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#email").val()=='' || $("#email").val()=='Email') {
			$("#email").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#appo_country").val()=='-1') {
			$("#appo_country").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#appo_region").val()=='-1') {
			$("#appo_region").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#appo_city").val()=='-1') {
			$("#appo_city").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#pin_code").val()=='' || $("#pin_code").val()=='Zip') {
			$("#pin_code").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#appo_timezone").val()=='-1') {
			$("#appo_timezone").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }						
		if ($("#address").val()=='' || $("#address").val()=='Address') {
			$("#address").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
			error++;
	   	 }
		if ($(".errEmail").length != 0){
			error++;
		} 						
	   }
		if(error !=0){
			return false;
		}else{
			$('<img style="padding:0px 0px 0px 100px;" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>').insertAfter("#btn-submit_book");
			$("#btn-submit_book").remove();
            var frmID='#dialog_booking_form';
			var params ={ 'test' : 0 };
			var paramsObj = $(frmID).serializeArray();
			$.each(paramsObj, function(i, field){
				params[field.name] = $.trim(field.value);
			});
			params['quantity'] = $("#quantity").val();
			params['appointment_Service'] = $("#appointment_Service").val();
			if ($('#client_mail').is(':checked')) {
				params['client_mail'] = true;
			}else{
				params['client_mail'] = false;
			}
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
			           $.ajax({
			                   type: 'POST',
			                   url:BASE_URL+"/staff/staff_calender_ajax/adminNewAppointment",
			                   data: params,
			                   success: function(result){
											$('#day_booking_contenar').html(result);
											closeLightbox();
			                        }
			           });
					}
				//check login end
				}  
			});

		}	 
	}
	
	function closeNewAppPopup(){
		$("#day_booking").remove();
		After_Reschedule_Ajax();
	}
	
	function addOrderComment(id){
		var comment = $("#order_comment").val();
		if(comment == ''){
			$("#order_comment").attr('style','border: 1px solid #ff0000; background: #FFD7D7; width: 90%; height:150px; !important;');
		}else{
			$('<img id="img_addOrderComment" style="padding:0px 100px 0px 0px;" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/> &nbsp;&nbsp;&nbsp;&nbsp;').insertBefore("#bt_add_comment");
			$("#bt_add_comment").hide();
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						$.ajax({
						  type: 'POST',
						  data: {'serviceDatailsId':id, 'comment':comment},
						  url:BASE_URL+"/staff/staff_calender_ajax/saveComment",
						  success:function(datas){
							$('#img_addOrderComment').remove();
							$("#bt_add_comment").show();
							closeLightbox();
							}
						});
					}
				//check login end
				}  
			});
		}
	}
	
	function remove_comment(){
		$("#order_comment").removeAttr('style');
	}

	function st(id){
	lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
						type: 'POST',
						data: {'id':id},
						url:BASE_URL+"/staff/staff_calender_ajax/ajax_check1",
						success:function(rdata){ 
							$("#span_appo_region").html(rdata);
							re();
							closeLightbox();
						}
					});
				}
			//check login end
			}  
		});

}

	function re(id){
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
						type: 'POST',
						data: {'id':id},
						url:BASE_URL+"/staff/staff_calender_ajax/ajax_region_check1",
						success:function(rdata){ 
							$("#span_appo_city").html(rdata);
							closeLightbox();
						}
						});
				}
			//check login end
			}  
		});
}

	function existingCustomerBooking(){
	    if ($("#customer_radio_chk input[type=radio]:checked").length > 0) {
			var error = 0;
			if ($("#appointment_Service").val()=='-1') {
				$("#appointment_Service").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
				error++;
			}									
			if ($("#quantity").val()==''){
				$("#quantity").attr('style','border: 1px solid #ff0000; background: #FFD7D7 !important;');
				error++;
			}									
			
			if(error !=0){
				return false;
			}else{
				$('<img style="padding:0px 100px 0px 0px;" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/> &nbsp;&nbsp;&nbsp;&nbsp;').insertBefore("#exsi_btn_booking");
				$("#exsi_btn_booking").remove();
				var frmID='#dialog_search_form';
				var params ={ 'test' : 0 };
				var paramsObj = $(frmID).serializeArray();
				$.each(paramsObj, function(i, field){
					params[field.name] = $.trim(field.value);
				});
				params['ex_quantity'] = $("#quantity").val();
				params['ex_Service'] = $("#appointment_Service").val();
				if ($('#client_mail').is(':checked')) {
					params['client_mail'] = true;
				}else{
					params['client_mail'] = false;
				}
				if ($('#chk_global').is(':checked')) {
					params['chk_global'] = true;
				}else{
					params['chk_global'] = false;
				}
				
			lightbox('TopBlockDiv'); 
			$.ajax({
				url: SITE_URL+"page/fn_checkLogInAdmin_staff",
				type: "post",
				success: function(result){
				//check login start
					if(result == 0){
						window.location.href = SITE_URL+'staff';
					}else{
						////////////////////////////////
						$.ajax({
			                   type: 'POST',
			                   url:BASE_URL+"/staff/staff_calender_ajax/adminExistingAppointment",
			                   data: params,
			                   success: function(result){
											$('#day_booking_contenar').html(result);
											closeLightbox();
			                        }
			           		});
						
						///////////////////////////////////////////
					}
				//check login end
				}  
			});
			}
		}else{
			alert('Please select customer.');
		}
        
 }
 
 	function afterBooking(){
		var val_top_radio = $("#radioset input[type='radio'][name='radio']:checked").attr('id');
		if(val_top_radio=='calender_day'){
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
			var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time			= $("#div_pre_cube").val();
			main_ajax_day(selected_date,ls_time);
		}
	}
 
 //Designer Script
	$(function(){
	var windowouter =$( window).outerWidth("true");
	var righttd =(windowouter - 260);
	
	$(".responsive-view").css({"width": righttd});
	
	$(window).resize(function(){
	 var windowouter =$( window).outerWidth("true");
	var righttd =(windowouter - 260);
	$(".responsive-view").css({"width": righttd});
	 });
	
	$("#main_contener").scroll(function () {
		 var scroll = $(this).scrollTop();
		 var scrollleft = $(this).scrollLeft();		
		 $(".emplouenameHead").css({"left":scrollleft - 2});
		 $(".thead").css({"top":scroll});
		 $(".emplouenameHead").css({"top":scroll - 10});
	});
	
});	



/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				DAY CALENDER			#####################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/


 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*----------------------------------			MONTH CALENDER 			--------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 
 	function month_datepiker(){
			    $('#calender_datepicker').datepicker( {
			        	inline: true,
                        dateFormat: 'dd/mm/yy',
                        changeMonth: true,
                        changeYear: true,
						minDate:daysInMonth()	
			    	});
				}
 
 	function daysInMonth() {
    var now_day	  = new Date();
	var current_date	= $.datepicker.formatDate('d',now_day)-1;
	return -current_date;
}

	function main_ajax_month(ls_date){
	lightbox();
		var i=0;
		var j=0;
		var ls_staff=[];
		var ls_services=[];
		
		$( "#cal_staff input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_staff[i] = $(this).val();
				i++;
		   	 }
		});

		$( "#cal_services input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});
	
		var interval = $("#div_pre_cube").val();
		var width_per_td = $("#width_per_td").val();
		
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
						  type: 'POST',
						  data: {'time_difference':interval,'current_width':width_per_td,'date_range':ls_date, 'selected_staff':ls_staff, 'selected_services':ls_services},
						  url:BASE_URL+"/staff/staff_calender_ajax/genaret_row_month",
						  success:function(datas){
						   	 $('#main_contener').html(''); 
							 $('#main_contener').html(datas);
							 closeLightbox();
							 monthajax();
							}
						});
				}
			//check login end
			}  
		});
}

	function monthajax(){
	
	$(".gotoDay").click(function(event){
			var ls_div_id		=	event.target.id.split("_");
		
		var selector =ls_div_id[0].split("-");	
		if(selector[0]=='month'){
			$( "#calender_datepicker" ).datepicker( "destroy" );
	 		day_datepicker()
			$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
			$('#calender_datepicker .ui-datepicker-calendar tr').unbind('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
			
            $('#calender_datepicker').datepicker("setDate",new Date(ls_div_id[1]+"/"+ls_div_id[2]+"/"+ls_div_id[3]));
			
			$("#radioset input[name='radio']").removeAttr('checked');
			$("#radioset input[name='radio']").next('label').removeClass('ui-state-active');
			$('#calender_day').attr('checked', 'checked');
			$('#calender_day').next('label').addClass('ui-state-active');
			$("#cal_staff input[type=checkbox]").removeAttr('checked');
			$("#cal_services input[type=checkbox]").removeAttr('checked');
			
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
		   	var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
			var ls_time			= $("#div_pre_cube").val();
			
			var select_date		= $.datepicker.formatDate('DD, MM dd, yy',myDate);
            $( "#cal_show_date" ).html(select_date);
										
			main_ajax_day(selected_date,ls_time);
		}
		})
		
}  
  
 	function fn_currentDate(){
 	var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
	var selected_date	= $.datepicker.formatDate('dd/mm/yy',myDate);
	return selected_date;
 }
 
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*----------------------------------			MONTH CALENDER 			--------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 
 
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@			WEEK CALENDER 			  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/  
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
	function week_datepiker(){
				var startDate;
			    var endDate;
				var dateToday = new Date();

			    var selectCurrentWeek = function() {
			        window.setTimeout(function () {
			            $('#calender_datepicker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
			        }, 1);
			    }
				
			    $('#calender_datepicker').datepicker( {
			        	inline: true,
                        dateFormat: 'dd/mm/yy',
                        changeMonth: true,
                        minDate: dateToday,
                        changeYear: true,
                        selectOtherMonths: true,
						showOtherMonths: true,
			        	onSelect: function(dateText, inst) {
				
							var date = $(this).datepicker('getDate');
				            startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
				            endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
						 
						 	var select_date	= $.datepicker.formatDate('dd MM',startDate)+" To "+$.datepicker.formatDate('dd MM, yy',endDate);
	                       	$( "#cal_show_date" ).html(select_date);
							
							var ls_time= [];
							ls_time[0]	= $.datepicker.formatDate('yy-mm-dd',startDate);
							ls_time[1]		= $.datepicker.formatDate('yy-mm-dd',endDate);
							main_ajax_week(ls_time);				
			           
					    	selectCurrentWeek();     
			        },
						beforeShowDay: function(d) {
							var date = $(this).datepicker('getDate');
							startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
							endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
				            
							return [true, startDate <= d && d <= endDate ? "ui-state-active" : ""];
        			}
			    });
}																																													
	function main_ajax_week(ls_date){
		lightbox();
		var j=0;
		var ls_services=[];
		
		$( "#cal_services input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});
	
		var interval = $("#div_pre_cube").val();
		var width_per_td = $("#width_per_td").val();
		 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'time_difference':interval,'current_width':width_per_td,'date_range':ls_date, 'selected_services':ls_services},
					  url:BASE_URL+"/staff/staff_calender_ajax/genaret_row_week",
					  success:function(datas){
					   	 $('#main_contener').html('');
						 closeLightbox(); 
						 $('#main_contener').html(datas);
						 weekajax();
						}
					});
				}
			//check login end
			}  
		});
}																																
	function weekajax(){
	settings_popup();
	scroll_me_week();
	booking_form_open_week()
	
}
	
	function scroll_me_week(){
			var currentTime = new Date();
			var hours = currentTime.getHours();
			var today = currentTime.getDate()+'/'+(currentTime.getMonth()+1)+'/'+currentTime.getFullYear();
			var myDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
			var selected_date	= $.datepicker.formatDate('d/m/yy',myDate);

	if(today == selected_date){
		var elem = $('#week_scroll_'+hours);
		if(elem) {
			$('#main_contener').animate({scrollTop:elem.position().top}, 'slow');
			var i=0;
			for(i=0;i<=23;i++){
				$( "#week_scroll_"+i+" .cont_dat" ).each(function( index ) {
				var weekRowId = $(this).attr('id').split('@_@');
				var today = new Date()						
				var nowEdDate	= new Date(today.getFullYear(), today.getMonth(), today.getDate(), today.getHours(), today.getMinutes());
				var currentSecond = nowEdDate.getTime()/1000;//current time in second		
				var dDate = weekRowId[0].split('-');
				var dTime = weekRowId[1].split('-');
				var rowDateTime	= new Date(dDate[2], dDate[1]-1, dDate[0], dTime[0], dTime[1]);
				var rowSecond = rowDateTime.getTime()/1000;//current row time in second
				if(rowSecond < currentSecond ){
					$(this).removeClass("non_drag");
					$(this).addClass("passedDiv");
					$(this).html("<span class='timeweek'>This time is blocked.</span>");
					$("#week_scroll_"+i+" .bodypartonecol div").removeClass("droppable");
					$("#week_scroll_"+i+" .bodypartonecol div").removeClass("ui-droppable");
					}
				});
			}
		}
		}else{
	//		var elem = $('#scroll_0');
	//		$('#main_contener').animate({scrollTop:elem.position().top}, 'slow');
		}
}
	
	function booking_form_open_week(){
		$('.non_drag').click(function(){
			
		if ($("#day_booking").length == 0 ) {
        	$(ls_lightbox_day).insertAfter($("#main_contener"));
    	}
		var i=0;
		var j=0;
		var ls_empArr=[];
		var ls_srvArr=[];
		
		$("#cal_staff input[type=checkbox]").each(function( index ) {
			if (this.checked) {
		      	ls_empArr[i] = $(this).val();
				i++;
		   	 }
		});

		$("#cal_services input[type=checkbox]").each(function( index ) {
			if (this.checked) {
		      	ls_srvArr[j] = $(this).val();
				j++;
		   	 }
		});
		
		var idVal = $(this).attr('id').split("@_@");
		lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'weekTime':idVal[1], 'weekDate':idVal[0], 'employeeArr':ls_empArr, 'serviceArr':ls_srvArr,'type':'week'},
					  url:BASE_URL+"/staff/staff_calender_ajax/genaret_day_form",
					  success:function(datas){
					   	 $('#day_booking_contenar').html(datas);
						 tab_day();
						 closeLightbox();
						}
					});
					$("#day_booking").dialog({
							width: 600,
							modal: true,
							show: "blind",
							hide: "explode"
						});			
				}
			//check login end
			}  
		});
		})
		
		
	}			
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@			WEEK CALENDER 			  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/

/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ Left Panel Start $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
	function hover_effect_staff_end(id){
		$('#emp_span_'+id).html('');
	}
	
	function hover_effect_staff_start(id){
		$('#emp_span_'+id).html('<img src="'+SITE_URL+'/asset/staff_settings.png" onmouseout="hover_tooltip_end('+id+')" onmouseover="hover_tooltip_start('+id+')" onclick="staff_reshudling_time('+id+')"/>');
		
	}
	
	function hover_tooltip_start(id){
		$("<div id='staff_tooltip' >Click to set availablity or non-availablity</div>").insertAfter($("#emp_span_"+id));
	}
	
	function hover_tooltip_end(id){
		//alert('123')
		$("#staff_tooltip").remove();
	}
	
	function staff_reshudling_time(id){
		if ($("#ReshudlingTime").length == 0 ) {
        		$("<div id='ReshudlingTime'><span id=\"ReshudlingTime_contenar\"><center><img src='"+SITE_URL+"/asset/wait_a_min.gif'/><br>Loading...</center></span><strong style=\"cursor: pointer;\" class=\"closeTip\" onclick=\"CloseBlock(\'ReshudlingTime\'),hover_effect_staff_end(\'"+id+"\')\">X</strong></div>").insertAfter($("#emp_span_"+id));
			}else{
				alert('Oops!! The option already open');
			}
		
lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					$.ajax({
					  type: 'POST',
					  data: {'staff_id':id},
					  url:BASE_URL+"/staff/staff_calender_ajax/staff_setting_option",
					  success:function(datas){
					  	 $('#ReshudlingTime_contenar').html('');
						 $('#ReshudlingTime_contenar').html(datas);
						 closeLightbox();
						}
					});
				}
			//check login end
			}  
		});
	}

	function reshedule_option_details(type){
		var staff_id = $('#re_staff_id').val();
		if(type=='Working_hours'){
			
			window.location.href =BASE_URL+"/../admin/business_hour/index_ajax/"+staff_id;
		}
		if(type=='Block'){
			
			window.location.href =BASE_URL+"/../admin/staff/index_ajax/"+staff_id+"/block";
		}
		if(type=='Edit_staff'){
			
			window.location.href =BASE_URL+"/../admin/staff/index_ajax/"+staff_id+"/edit_staff";
		}
	}
/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$ Left Panel End $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/
/*##############Agenda########*/
	$(document).click(function(ev){
    if( !$(ev.target).hasClass("dropdown_head_class") ){
            $('#custom_dropdown').hide();
            $('#agenda_hdn').val('1');
    }
	$(".show-details").click(function() {
		$(this).hide();
		$(this).next().show();
		$(this).next().next().show();
	});
	$(".hide-details").click(function() {
		$(this).prev().prev().show();
		$(this).hide();
		$(this).prev().hide();		
	});
});

	function showDropdown() {
    if($('#agenda_hdn').val()=='1')
    {
        $('#custom_dropdown').show();
        $('#agenda_hdn').val('0');

    }
    else
    {
        $('#custom_dropdown').hide();
        $('#agenda_hdn').val('1');
    }
}											
												
	function ask_a_review(data){
	//alert(data);
	var cnfrm=confirm('An email would be sent to client with a link to review page. Click OK to send.');
	if(cnfrm){
		lightbox();
		$.ajax({
			  type: 'POST',
			  data: {'email_data':data},
			  url:BASE_URL+"/staff/staff_calender_ajax/askAReview",
			  success:function(datas){
			  	closeLightbox();
				 alert(datas);
			}
		});		
	}
	
	
}																	

/*###########################################################################################################*/
/*########################################## Group admin floting part #######################################*/
/*###########################################################################################################*/
	function group_booking_details(){
	$(".book_cont_group").click(function(){
		var ls_id	= $(this).attr('id');
		var ls_lightbox_day='<div id="grpBookingDtls" title="Booking details" style="display: none;"><span id="grpBookingDtls_contenar"><img src="'+SITE_URL+'/asset/wait_a_min.gif"/><br></span></div>';
		if ($("#grpBookingDtls").length == 0 ) {
        	//$(ls_lightbox_day).insertAfter($("#main_contener"));
			$($("#main_contener")).append(ls_lightbox_day);
    	}
		$.ajax({
		  type: 'POST',
		  data: {'bookingId':ls_id},
		  url:BASE_URL+"/staff/staff_calender_ajax/getGroupBookingDetails",
		  success:function(datas){
		   	 $('#grpBookingDtls_contenar').html(datas);
			 grpBookingDtls_reschedule();
			}
		});
		$( "#grpBookingDtls" ).dialog({
				width: 230,
				show: "blind",
				hide: "explode",
				position:  [5, 360]
			});
		$('#grpBookingDtls').parent().attr("id","group_booking");
	})
}																								

	function grpBookingDtls_reschedule(){

	var currentDate 			= new Date($("#calender_datepicker").datepicker("getDate"));
	var reshuDate	= $.datepicker.formatDate('yy-mm-dd',currentDate);
	var DragId='';
	var ls_width=$("#width_per_td").val();	 
	$(".reshudl").draggable({
				cursor: "move", 
				delay: 400,
				scroll: true, 
				scrollSensitivity: 50, 
				snap: ".droppable",
			//	grid: [ ls_width,70 ],
				revert: "invalid",
				helper: "clone",
				hoverClass: "ui-state-active",
				stop: function(){
					$("#calender_datepicker").removeClass("ondraggingdate");
				},
				start: function () {
								DragId = $( this ).attr("id");
								$("#calender_datepicker").addClass("ondraggingdate");
					        	}
				});

    $(".droppable").droppable({
				 accept: ".reshudl",
				 greedy: true,
				 activeClass: 'droppable-active',
				 hoverClass: 'droppable-hover',
				 drop: function(ev, ui) {
				 				$("#calender_datepicker").removeClass("ondraggingdate");
								droppedId = $( this ).attr("id");
								lightbox('TopBlockDiv'); 
								$.ajax({
									url: SITE_URL+"page/fn_checkLogInAdmin_staff",
									type: "post",
									success: function(result){
									//check login start
										if(result == 0){
											window.location.href = SITE_URL+'staff';
										}else{
											closeLightbox();
											////////////////////////////////
											$.ajax({
										type: 'POST',
										data: {'dragDetails':DragId, 'dropDetails':droppedId,'dragType':'group','reshuDate':reshuDate},
										url:BASE_URL+"/staff/staff_calender_ajax/rescheduleChecking",
										success:function(return_data){
											var retArr = return_data.split('||@@||');
											if ($("#reschedule_div").length == 0 ) {
											$('<div id="reschedule_div"><span id="reschedule_span"></span></div>').appendTo('body');
											} 
											if(retArr[0]==1 ){	
												$('#reschedule_span').html(retArr[1]);
												$( "#reschedule_div" ).dialog({
													modal: true, 
													title: 'Reschedule booking ', 
													autoOpen: true,
							                        width: 500,
													buttons: {
				                            			RESCHEDULE: function () {
														/////Ajax Part Start///
														var ls_isMail=$("#isSendMailRs:checked").val();
														$.ajax({
														type: 'POST',
														data:{'dragDetails':DragId, 'dropDetails':droppedId,'dragType':'group', 'is_mail':ls_isMail,'reshuDate':reshuDate},
														url:BASE_URL+"/staff/staff_calender_ajax/reschedule_Save",
														success:function(return_data){
																if(return_data==1 ){	
																$("#reschedule_div").remove();
																$("#grpBookingDtls").remove();	
																After_Reschedule_Ajax();
																}else{
																$("#reschedule_div").remove();
																$("#grpBookingDtls").remove();
																After_Reschedule_Ajax();
																}
															}
														});
														/////Ajax Part End///
				                            			},
							                            CLOSE: function () {
															close_ui_popup('reschedule_div');
							                                $(this).remove();
							                            }
				                        			},
						                        close: function (event, ui) {
													close_ui_popup('reschedule_div');
						                            $(this).remove();
						                        }
												});
											}
											if(retArr[0]==0 ){	
												$('#reschedule_span').html(retArr[1]);
												$( "#reschedule_div" ).dialog({
													modal: true, 
													title: 'Reschedule booking ', 
													autoOpen: true,
							                        width: 300,
													buttons: {
														CLOSE: function () {
															close_ui_popup('reschedule_div');
							                                $(this).remove();
							                            }
													},
							                        close: function (event, ui) {
														close_ui_popup('reschedule_div');
							                            $(this).remove();
							                        }
												});
											}
											
										}
								});
											
											///////////////////////////////////////////
										}
									//check login end
									}  
								});
								//alert(droppedId);
								
						}
				})
}		



/*###########################################################################################################*/
/*########################################## 		Agenda part		  #######################################*/
/*###########################################################################################################*/
	function changeStatusAgenda(status, booking_service_id){
	//var booking_service_id = $('#booking_service_id').val();
		

lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					////////////////////////////////
					$.ajax({
				type: "POST",
				url:BASE_URL+"admin/dashboard/ajaxStatusChange/"+status+"/"+booking_service_id,
				success: function(rdata) {
					  closeLightbox();                             
					$('#BookingStatusDispAgenda'+booking_service_id).html(rdata);
				}
			});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});
}
	
	function agendaMainContener(selectedDate){
		lightbox();
		var i=0;
		var j=0;
		var ls_staff=[];
		var ls_services=[];
		
		$( "#cal_staff input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_staff[i] = $(this).val();
				i++;
		   	 }
		});

		$( "#cal_services input[type=checkbox]" ).each(function( index ) {
			if (this.checked) {
		      	ls_services[j] = $(this).val();
				j++;
		   	 }
		});
	
		var dataDetails = {'selected_date':selectedDate,'selected_staff':ls_staff, 'selected_services':ls_services};
		
		
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					////////////////////////////////
					$.ajax({
		  type: 'POST',
		  data: dataDetails ,
		  url:BASE_URL+"/staff/staff_calender_ajax/calenderAgenda",
		  success:function(datas){
			$('#main_contener').html(''); 
			$('#main_contener').html(datas);
			closeLightbox();
			scroll_me_up();
			scroll_me_down();
			AfterAjendaAjax();
			}
		});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});

	}
	
	function AfterAjendaAjax(){
		// alert('hi');
		$(".dropButton").mouseenter(function(){
			var ls_id = $(this).attr('id').split('_');
			$('#appointmentStatusAppointy_'+ls_id[1]).show();
		})
		$(".dropButton").mouseleave(function(){
			var ls_id = $(this).attr('id').split('_');
			$('#appointmentStatusAppointy_'+ls_id[1]).hide();
		})
		
		$(".appointmentStatusAppointy").mouseenter(function(){
			var ls_id = $(this).attr('id').split('_');
			$('#appointmentStatusAppointy_'+ls_id[1]).show();
		})
		$(".appointmentStatusAppointy").mouseleave(function(){
			var ls_id = $(this).attr('id').split('_');
			$('#appointmentStatusAppointy_'+ls_id[1]).hide();
		})
	}
	
	function agendaDetailsCont(bookingId){
		if($("#agendaDetails_"+bookingId).html().length == 0){	
			$("#agendaDetails_"+bookingId).html('<img style="padding:0px 0px 0px 250px" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>');
			$.ajax({
				type: 'POST',
				data: {'bookingId':bookingId} ,
				url:BASE_URL+"/staff/staff_calender_ajax/calenderAgendaDetails",
				success:function(datas){
				$("#agendaDetails_"+bookingId).html(datas);
				$("#agdDtlId_"+bookingId).val('Hide Details');
				}
			});
			
		}else{
			$("#agendaDetails_"+bookingId).html('');
			$("#agdDtlId_"+bookingId).val('Show Details');
		}
	}
	
	function agendaStatusfunction(type,bookId){
		if (confirm("Do you wants to change booking status?")) {
       			

				lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					////////////////////////////////
					$.ajax({
				  type: 'POST',
				  data: {'bookId':bookId, 'type':type},
				  url:BASE_URL+"/staff/staff_calender_ajax/agendaStatusfunction",
				  success:function(datas){
					 	var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
						var tempdate		= $.datepicker.formatDate('yy-mm-dd',myDate);
						agendaMainContener(tempdate);
						closeLightbox();	
					}
				});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});

   			}
	}
	
	function agendaAskReview(bookId){
		$('#agendaAskReview_'+bookId).html('');
		$('#agendaAskReview_'+bookId).html('<img height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>');
		if (confirm("An email would be sent to client. Click OK to send.")) {
       			
			lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					closeLightbox();
					////////////////////////////////
					$.ajax({
				  type: 'POST',
				  data: {'bookId':bookId},
				  url:BASE_URL+"/staff/staff_calender_ajax/agendaAskReview",
				  success:function(datas){
				   	 if($.trim(datas) == 1){
					 	$('#agendaAskReviewMsg_'+bookId).html('<span style="color: #0ED62C;">Your email has been sent.</span>');	
					 	$('#agendaAskReview_'+bookId).html('<span onclick="agendaAskReview('+bookId+')" style="cursor: pointer;color: #0B85EC;">Ask a review </span>');	
					 }else{
					 	$('#agendaAskReviewMsg_'+bookId).html('<span style="color: #D74634;">Sorry to send Email.</span>');	
					 	$('#agendaAskReview_'+bookId).html('<span onclick="agendaAskReview('+bookId+')" style="cursor: pointer;color: #0B85EC;">Ask a review </span>');	 
					 }
					}
				});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});

   			}else{
			$('#agendaAskReview_'+bookId).html('<span onclick="agendaAskReview('+bookId+')" style="cursor: pointer;color: #0B85EC;">Ask a review </span>');	
			}
   			return false;
	}
	
	function agendaCancelAppointment(bookId){
		$('#agendaCancelAppointment_'+bookId).html('');
		$('#agendaCancelAppointment_'+bookId).html('<img height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>');
		if (confirm("An email would be sent to client. Click OK to send.")) {
       			
lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					closeLightbox();
					////////////////////////////////
					$.ajax({
				  type: 'POST',
				  data: {'bookId':bookId},
				  url:BASE_URL+"/staff/staff_calender_ajax/agendaCancelAppointment",
				  success:function(datas){
				   	 if($.trim(datas) == 1){
					 	var myDate 		= new Date($("#calender_datepicker").datepicker("getDate"));
						var tempdate		= $.datepicker.formatDate('yy-mm-dd',myDate);
						agendaMainContener(tempdate);	
					 }else{
					 	$('#agendaCancelAppointmentMsg_'+bookId).html('<span style="color: #D74634;">Sorry to Cancel Appointment.</span>');	
					 	$('#agendaCancelAppointment_'+bookId).html('<span onclick="agendaCancelAppointment('+bookId+')" style="cursor: pointer;color: #0B85EC;">Cancel Appointment</span>');	 
					 }
					}
				});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});


   			}else{
			$('#agendaCancelAppointment_'+bookId).html('<span onclick="agendaCancelAppointment('+bookId+')" style="cursor: pointer;color: #0B85EC;">Cancel Appointment</span>');
			}
   			return false;
	}
	
	function bookingCommentAgenda(bookingId){
		var comment = $("#order_comment_"+bookingId).val();
		if(comment == ''){
			$("#order_comment_"+bookingId).attr('style','border: 1px solid #ff0000; background: #FFD7D7; width: 90%; height:150px; !important;');
		}else{
			$('<img id="img_addOrderComment_'+bookingId+'" style="padding:0px 100px 0px 0px;" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/> &nbsp;&nbsp;&nbsp;&nbsp;').insertBefore("#bt_add_comment_"+bookingId);
			$("#bt_add_comment_"+bookingId).hide();
			

lightbox('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin_staff",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'staff';
				}else{
					closeLightbox();
					////////////////////////////////
					$.ajax({
				  type: 'POST',
				  data: {'serviceDatailsId':bookingId, 'comment':comment},
				  url:BASE_URL+"/staff/staff_calender_ajax/saveCommentAgenda",
				  success:function(datas){
					$('#img_addOrderComment_'+bookingId).remove();
					$("#bt_add_comment_"+bookingId).show();
					$("#order_comment_"+bookingId).removeAttr("style");
					$("#order_comment_"+bookingId).attr('style','width: 90%; height:150px;!important;');
					}
				});
					
					///////////////////////////////////////////
				}
			//check login end
			}  
		});
		}
	}
	/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Agenda End @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/																											


