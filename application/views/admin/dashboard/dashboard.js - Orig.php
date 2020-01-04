<script type='text/javascript'>
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



	$(document).ready(function() {
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
		 dayClick: function(ev) {
        		
			//	$('#calendar').fullCalendar('nextsevenday');
				
   			 },
			 eventClick: function(event, element) {
			 //alert(event.end);
			  		
			  var event_Start=String(event.start);
			  //String(object)
			  //alert(String(event.start));
			   var event_Start1 = event_Start.split("GMT");
				 //alert(event_Start1[0]); // price
				 // data[1] // qty
				 //$('#popupContact').html(data[0]);
			  $('#new_user').hide();
			  $('#eventTitle').html(event.title);
			  $('#eventStart').html(event_Start1[0]);
			  $('.openmodalbox').trigger('click');
			  
			},
			header: {
				right: '',
				center: 'prev,title,next,today',
				left: 'agendaDay,month,pardcoAgenda,agendaSevenDay'
			},
		
			editable: true,
		 			
			events: [
				{
					title: 'All Day Event',
					start: new Date(y, m, 1)
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-1)
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d-3, 16, 0),
					allDay: false
				},
				{
					id: 999,
					title: 'Repeating Event',
					start: new Date(y, m, d+4, 16, 0),
					allDay: false
				},
				{
					title: 'Meeting',
					start: new Date(y, m, d, 10, 30),
					allDay: false
				},
				{
					title: 'Lunch',
					start: new Date(y, m, d, 12, 0),
					end: new Date(y, m, d, 14, 0),
					allDay: false
				},
				{
					title: 'Birthday Party',
					start: new Date(y, m, d+1, 19, 0),
					end: new Date(y, m, d+1, 22, 30),
					allDay: false
				}
				
			]
		});
		
		
		
		
		$('.fc-button-prev').click(function(){
	  			//alert($('fc-state-active').children().find('span').html());
				 var d = $('#calendar').fullCalendar('getDate');
				 $("#cont").html('');
				  //alert(d);
				 
			//alert("The current date of the calendar is " + d);
				
				var DATE_INFO = {
								  20120807: { klass: "SandiEvent1", tooltip: "That was yesterday" },
								  20120808: { klass: "highlight", tooltip: "And this is TODAY" }
								};

								function getDateInfo(date, wantsClassName) {
								  var as_number = Calendar.dateToInt(date);
								  /*if (String(as_number).indexOf("0308") == 4) {
									// my birthday :-p
									return { klass: "birthday", tooltip: "Happy birthday dear me!" };
								  }
								  if (as_number >= 20090518 && as_number <= 20090524)
									return {
									  klass   : "highlight2",
									  tooltip : "<div style='text-align: center'>%Y/%m/%d (%A)" +
												"<br />In the green week</div>" // formatted by printDate
									};*/
								  return DATE_INFO[as_number];
								};

								var cal = Calendar.setup({
								  cont     : "cont",
								  fdow     : 1,
								  date     : d,
								  dateInfo : getDateInfo, // pass our getDateInfo function
								  selectionType : Calendar.SEL_MULTIPLE,
											  /*disabled      : function(date) {
													  // disable all dates between 5 and 15 every month
													  return (date.getDate() >= 5 &&
															  date.getDate() <= 15);
											  },*/
											   onSelect      : function() {
											 
													var count = this.selection.countDays();
													if (count == 1) {
														var date = this.selection.get()[0];
														date = Calendar.intToDate(date);
														//date = Calendar.printDate(date, "%A, %B %d, %Y");
														
														y = Calendar.printDate(date, "%Y");
														m = Calendar.printDate(date, "%m")*1;
														d =  Calendar.printDate(date, "%d");
														//var myyear =  Calendar.printDate(date, "%Y")
														 //$('#calendar').fullCalendar('next');
														//alert(m-1);
														  $('#calendar').fullCalendar('gotoDate',y,m-1,d );
														//$("calendar-info").innerHTML = date;
													} else {
														/*$("calendar-info").innerHTML = Calendar.formatString(
															"${count:no date|one date|two dates|# dates} selected",
															{ count: count }
														);*/
													}
											},
								
											  // checkRange: true, // if you simply want to disallow selection but not display anything
								
											  checkRange    : function(date, cal) {
													  // if you pass a function, it gets called and receives the first date that
													  // disallowed the selection, and the calendar object.
													  alert("Date " + date + " cannot be selected");
											  }
									  });
				
	  });
	  
	  
	  
	  
	  
	  $('.fc-button-next').click(function(){
	  			//alert($('fc-state-active').children().find('span').html());
				 var d = $('#calendar').fullCalendar('getDate');
				$("#cont").html('');
				 //alert(d);
 Calendar.setup({
				  cont     : "cont",
  				  date     : d,
				  fdow          : 1,
				  selectionType : Calendar.SEL_MULTIPLE,
				  /*disabled      : function(date) {
						  // disable all dates between 5 and 15 every month
						  return (date.getDate() >= 5 &&
								  date.getDate() <= 15);
				  },*/
				   onSelect      : function() {
				 
						var count = this.selection.countDays();
						if (count == 1) {
							var date = this.selection.get()[0];
							date = Calendar.intToDate(date);
							//date = Calendar.printDate(date, "%A, %B %d, %Y");
							
							y = Calendar.printDate(date, "%Y");
							m = Calendar.printDate(date, "%m")*1;
							d =  Calendar.printDate(date, "%d");
							//var myyear =  Calendar.printDate(date, "%Y")
							 //$('#calendar').fullCalendar('next');
							//alert(m-1);
							  $('#calendar').fullCalendar('gotoDate',y,m-1,d );
							//$("calendar-info").innerHTML = date;
						} else {
							/*$("calendar-info").innerHTML = Calendar.formatString(
								"${count:no date|one date|two dates|# dates} selected",
								{ count: count }
							);*/
						}
				},
				  // checkRange: true, // if you simply want to disallow selection but not display anything
				  checkRange    : function(date, cal) {
						  // if you pass a function, it gets called and receives the first date that
						  // disallowed the selection, and the calendar object.
						  alert("Date " + date + " cannot be selected");
				  }
		  });
				
	  });
	  
	  
	  $('.fc-button-today').click(function(){
	  			//alert($('fc-state-active').children().find('span').html());
				 var d = $('#calendar').fullCalendar('getDate');
				 //alert(d);
				$("#cont").html('');
				
				 Calendar.setup({
				  cont     : "cont",
  				  date     : d,
				  fdow          : 1,
				  selectionType : Calendar.SEL_MULTIPLE,
				  /*disabled      : function(date) {
						  // disable all dates between 5 and 15 every month
						  return (date.getDate() >= 5 &&
								  date.getDate() <= 15);
				  },*/
				   onSelect      : function() {
				 
						var count = this.selection.countDays();
						if (count == 1) {
							var date = this.selection.get()[0];
							date = Calendar.intToDate(date);
							//date = Calendar.printDate(date, "%A, %B %d, %Y");
							
							y = Calendar.printDate(date, "%Y");
							m = Calendar.printDate(date, "%m")*1;
							d =  Calendar.printDate(date, "%d");
							//var myyear =  Calendar.printDate(date, "%Y")
							 //$('#calendar').fullCalendar('next');
							//alert(m-1);
							  $('#calendar').fullCalendar('gotoDate',y,m-1,d );
							//$("calendar-info").innerHTML = date;
						} else {
							/*$("calendar-info").innerHTML = Calendar.formatString(
								"${count:no date|one date|two dates|# dates} selected",
								{ count: count }
							);*/
						}
				},
				  // checkRange: true, // if you simply want to disallow selection but not display anything
				  checkRange    : function(date, cal) {
						  // if you pass a function, it gets called and receives the first date that
						  // disallowed the selection, and the calendar object.
						  alert("Date " + date + " cannot be selected");
				  }
		  });
				
	  });
	  
		
	});
	

</script>

<script type="text/javascript">//<![CDATA[
Calendar.setup({
cont          : "cont",
fdow          : 1,
selectionType : Calendar.SEL_MULTIPLE,
/*disabled      : function(date) {
	  // disable all dates between 5 and 15 every month
	  return (date.getDate() >= 5 &&
			  date.getDate() <= 15);
},*/
onSelect      : function() {
	var count = this.selection.countDays();
	if(count == 1) {
		var date = this.selection.get()[0];
		date = Calendar.intToDate(date);
		//date = Calendar.printDate(date, "%A, %B %d, %Y");
		
		y = Calendar.printDate(date, "%Y");
		m = Calendar.printDate(date, "%m")*1;
		d =  Calendar.printDate(date, "%d");
		//var myyear =  Calendar.printDate(date, "%Y")
		 //$('#calendar').fullCalendar('next');
		//alert(m-1);
		  $('#calendar').fullCalendar('gotoDate',y,m-1,d );
		//$("calendar-info").innerHTML = date;
	} 
	else 
	{
		/*$("calendar-info").innerHTML = Calendar.formatString(
			"${count:no date|one date|two dates|# dates} selected",
			{ count: count }
		);*/
	}
},

// checkRange: true, // if you simply want to disallow selection but not display anything

checkRange    : function(date, cal) {
	  // if you pass a function, it gets called and receives the first date that
	  // disallowed the selection, and the calendar object.
	  alert("Date " + date + " cannot be selected");
}
});
	  
function getCalenderview(){
	empvalArr = new Array();
	$("input:checkbox[name=emp[]]:checked").each(function()
	{
		
		var value1= $(this).val();
		empvalArr.push(value1);
	 
	});
	
	servicesArr = new Array();
	$("input:checkbox[name=services[]]:checked").each(function()
	{
		
		var value1= $(this).val();
		servicesArr.push(value1);
	 
	});
	   var d = $('#calendar').fullCalendar('getDate');
	alert("The current date of the calendar is " + d);

//alert(servicesArr.join(','));
}
    //]]>
</script>


<script>
function st(id)
{
	$.ajax({
	type: 'POST',
	datatype:'html',
	url:"<?php echo site_url('admin/ajax_check1'); ?>",
	data:"id="+id,
	success:function(rdata)
	{ 
		var data = rdata.split("@@@");
		//$("#modalboxContent").html(rdata);
		//$("#modalboxContent").show();
		$("#modalBox #cus_regionid_6").html(data[0]);
		$("#modalBox #cus_cityid_7").html(data[1]);
		//document.getElementById('region_id_div111').innerHTML='hhhhh';
		//$("#region_id1").html(rdata);
	}
	
	
	});
}
function re(id){
//alert("hi");
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/ajax_region_check1'); ?>",
		data:"id="+id,
		success:function(rdata)
		{ 
			$("#modalBox #cus_cityid_7").html(rdata);
		}
	});
}
</script>
<script>
function existing_user()
{
	$("#modalBox #new_user").hide();
	$("#modalBox #existing_user").show();
}
function new_user()
{
	$("#modalBox #new_user").show();
	$("#modalBox #existing_user").hide();
}
</script>
<script>
function global_search_f(value)
{
	$("#modalBox #search").html("Search by Email or Phone");
}
</script>
<script>

function submit1(){
var cus_fname_2=$("#modalBox #cus_fname_2").val();
var cus_lname_3=$("#modalBox #cus_lname_3").val();
var user_email=$("#modalBox #user_email_p").val();
var cus_phn1_10=$("#modalBox #cus_phn1_10").val();
//alert(cus_phn1_10);
var cus_address_4=$("#modalBox #cus_address_4").val();
//alert(cus_address_4);
var cus_countryid_5=$("#modalBox #cus_countryid_5").val();
var cus_regionid_6=$("#modalBox #cus_regionid_6").val();
var cus_cityid_7=$("#modalBox #cus_cityid_7").val();
var cus_zip_8=$("#modalBox #cus_zip_8").val();
var time_zone_id_21=$("#modalBox #time_zone_id_21").val();

//alert(cus_countryid_5);
     $('#modalBox .required').focus(function(){
     $("#modalBox .required_div").html(" ");
     });

    if(cus_fname_2 == "First Name" || cus_fname_2 == "" ){
		
		$("#modalBox #cus_fname_div").html("Required Field");
	}
	else
	{
	    var ajax_send1=true;
	}
	if(cus_lname_3 == "Last Name" || cus_lname_3 == "" ){
		
		$("#modalBox #cus_fname_div").html("Required Field");
	}
	else
	{
	    var ajax_send2=true;
	}
	if(user_email == ""){
		
		$("#modalBox #user_email_p_div").html("Required Field");
	} 
	
	else
 
		 {
		 
		 var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		  if( !emailReg.test( user_email ) ) {
			
				$("#modalBox #user_email_p_div").html("Enter a valid Email");
				
		  }
		  else
	      {
	      var ajax_send3=true;
	      }
	 }
	
if(ajax_send1==true && ajax_send2==true && ajax_send3==true ){

$.ajax({
	  type: 'POST',
	  datatype:'html',
	  url:"<?php echo site_url('admin/customer_book_ajax'); ?>",
	  data:"cus_fname_2="+cus_fname_2+"&cus_lname_3="+cus_lname_3+"&user_email="+user_email+"&cus_phn1_10="+cus_phn1_10+"&cus_address_4="+cus_address_4+"&cus_countryid_5="+cus_countryid_5+"&cus_regionid_6="+cus_regionid_6+"&cus_cityid_7="+cus_cityid_7+"&cus_zip_8="+cus_zip_8+"&time_zone_id_21="+time_zone_id_21,
       success:function(rdata)
        { 
		 alert(rdata);
		}
	});
	}
}

   

</script>
<script>
function fullevent()
{
	var events = $('#calendar').fullCalendar('clientEvents');
	resultArr = new Array;
	resultArr['start'] = new Array();
	resultArr['title'] = new Array();
	
	for(k in events){
	resultArr['start'].push(events[k].start);
	resultArr['title'].push(events[k].title);
	}
	var jObject={};
	for(i in resultArr)
	{
		jObject[i] = resultArr[i];
	}
	jObject= $.stringify(jObject);
	//alert(jObject);
	$.ajax({
		type: 'POST',
		datatype:'html',
		url:"<?php echo site_url('admin/allevents'); ?>",
		data:"events="+jObject,
		success:function(rdata)
		{ 
		window.open("webcal://citytech.magento.com/partha_sandy_appointment/application/ical/test1.ics")
		}
	});
} 
</script>