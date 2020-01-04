<script type='text/javascript'>
        jQuery.extend({
        stringify  : function stringify(obj) {         
        if ("JSON" in window) {
            return JSON.stringify(obj);
        }
        var t = typeof (obj);
        if (t != "object" || obj === null) {
            if (t == "string") obj = '"' + obj + '"';
            return String(obj);
        } else {
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


var g_date;
	$(document).ready(function() {
            
            	var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
                
		
	  $('#calendar').fullCalendar({
		 dayClick: function(date, allDay, jsEvent, view) {
			//	$('#calendar').fullCalendar('nextsevenday');
                        g_date = date;
                        $('#exixtingEvent').hide();
                        $('#newBooking').show();
                        
                        $('.openmodalbox').trigger('click');
			},
			eventClick: function(event, element) {
			var bookingServiceIdPass = event.booking_service_id;
			$('#booking_service_id').val(bookingServiceIdPass);
                        var bookingIdPass = event.booking_id;
                        $('#booking_id').val(bookingIdPass);
			
			var event_Start=String(event.start);
			var event_Start1 = event_Start.split("GMT");
			$('#new_user').hide();
			$('#service_name').html(event.service_name);
			$('#srvcDesc').html(event.srvcDesc);
			
			$('#service_cost').html(event.service_cost);
			$('#employee_name').html(event.employee_name);
			$('#cust_name').html(event.cust_name);
			
			$('#cus_address').html(event.cus_address);
			$('#cus_zip').html(event.cus_zip);
			$('#cus_mob').html(event.cus_mob);
			$('#booking_date_time').html(event.booking_date_time);
			
			$('#BookingStatusDisp').html(event.BookingStatusDisp);
			$('#eventStart').html(event_Start1[0]);
			$('#service_duration').html(event.service_duration);
                        
                        $('#exixtingEvent').show();
                        $('#newBooking').hide();
			$('.openmodalbox').trigger('click');
			//alert(event.booking_date_time)
			  
			},
			header: {
                            right: '',
                            center: 'prev,title,next,today',
                            left: 'agendaDay,month,agendaWeek,basicDay'
			},
			editable: false,
			events: [
                            <?php
                            foreach($ServcBkinDtls as $IndiServDtls)
                            {
                                $ResourceId = rand(1,7);
                                $booking_service_id     = $IndiServDtls['booking_service_id'];
                                $StartDt		= $IndiServDtls['service_start_dt'];
                                $EndDt                  = $IndiServDtls['service_end_dt'];
                                $StrtTim 		= $IndiServDtls['service_start_time'];
                                $EndtTim 		= $IndiServDtls['service_end_time'];
                                $service_name           = $IndiServDtls['service_name'];
                                $srvcDesc		= $IndiServDtls['service_description'];
                                $local_admin_id         = $IndiServDtls['local_admin_id'];
                                $booking_id             = $IndiServDtls['booking_id'];
                                $service_id             = $IndiServDtls['service_id'];
                                $service_cost           = $IndiServDtls['service_cost'];
                                $employee_id            = $IndiServDtls['employee_id'];
                                $cust_name		= $IndiServDtls['cust_name']; 
                                $employee_name          = $IndiServDtls['employee_name'];
                                $cus_address            = $IndiServDtls['cus_address']; 
                                $cus_zip		= $IndiServDtls['cus_zip']; 
                                $cus_mob		= $IndiServDtls['cus_mob'];
                                $booking_date_time	= $IndiServDtls['booking_date_time']; 
                                $service_duration	= $IndiServDtls['service_duration'];
                                $service_duration_unit	= $IndiServDtls['service_duration_unit'];

                                $booking_status= $IndiServDtls['booking_status'];
                                if($booking_status == 0) 	{$BookingStatusDisp = "unapproved";}
                                elseif($booking_status == 1)   {$BookingStatusDisp = "aproved";}
                                elseif($booking_status == 2)   {$BookingStatusDisp = "pending";}
                                elseif($booking_status == 3)   {$BookingStatusDisp = "Cmpleted";}
                                elseif($booking_status == 4)   {$BookingStatusDisp = "canceledByAdmin";}
                                elseif($booking_status == 5)   {$BookingStatusDisp = "CancelledByUser";}

                                $ExplodeArrStartDate = explode("-",$StartDt);
                                $StartDateY = $ExplodeArrStartDate[0];
                                $StartDateM = $ExplodeArrStartDate[1]-1;
                                $StartDateD = $ExplodeArrStartDate[2];

                                $ExplodeArrEndDate = explode("-",$EndDt);
                                $EndDateY 	= $ExplodeArrEndDate[0];
                                $EndDateM 	= $ExplodeArrEndDate[1]-1;
                                $EndDateD 	= $ExplodeArrEndDate[2];

                                $ExplodeArrStrtTim = explode(":",$StrtTim);
                                $StrtTimH 	= $ExplodeArrStrtTim[0];
                                $StrtTimM 	= $ExplodeArrStrtTim[1];
                                $StrtTimS 	= $ExplodeArrStrtTim[2];

                                $ExplodeArrEndtTim = explode(":",$EndtTim);
                                $EndtTimH 	= $ExplodeArrEndtTim[0];
                                $EndtTimM 	= $ExplodeArrEndtTim[1];
                                $EndtTimS 	= $ExplodeArrEndtTim[2];
                                ?>
                                {
                                    booking_service_id: <?php echo $booking_service_id;?>,
                                    local_admin_id: <?php echo $local_admin_id;?>, 
                                    booking_id: <?php echo $booking_id;?>, 
                                    service_id: <?php echo $service_id;?>, 
                                    service_cost: <?php echo $service_cost;?>,
                                    cust_name: '<?php echo $cust_name;?>',

                                    cus_address: '<?php echo $cus_address;?>',
                                    cus_zip: '<?php echo $cus_zip;?>',
                                    cus_mob: '<?php echo $cus_mob;?>',
                                    booking_date_time: '<?php echo $booking_date_time;?>',

                                    employee_name: '<?php echo $employee_name;?>',
                                    BookingStatusDisp: '<?php echo $BookingStatusDisp;?>',
                                    service_duration: '<?php echo $service_duration;?> <?php echo $service_duration_unit;?>',
                                    booking_status: <?php echo $booking_status;?>, 
                                    title: '<?php echo $service_name." :: ".$srvcDesc." ; FOR: ".$cust_name." ; BY: ".$employee_name." ; FROM: ".$StrtTim." ; TO: ".$EndtTim; ?>',
                                    service_name: '<?php echo $service_name;?>',
                                    srvcDesc: '<?php echo $srvcDesc;?>',
                                    start: new Date(<?php echo $StartDateY;?>,  <?php echo $StartDateM;?>,  <?php echo $StartDateD;?>,  <?php echo $StrtTimH;?>,  <?php echo $StrtTimM;?>),
                                    end: new Date(<?php echo $EndDateY;?>,  <?php echo $EndDateM;?>,  <?php echo $EndDateD;?>,  <?php echo $EndtTimH;?>,  <?php echo $EndtTimM;?>),
                                    allDay: false

                                },
                        <?php }  ?>
                                /*{
					title: 'All Day Event Sandi',
					start: new Date(2012, 11, 25, 16, 0),
					allDay: false
				},
				{
					title: 'Long Event',
					start: new Date(y, m, d-5),
					end: new Date(y, m, d-1)
				}*/
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
				  checkRange : function(date, cal) {
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
function changeStatus(status)
{
	var booking_service_id = $('#booking_service_id').val();
	$.ajax({
			url: "<?php echo base_url(); ?>admin/dashboard/ajaxStatusChange/"+status+"/"+booking_service_id,
			type: "POST",
			success: function(rdata) {
				//alert(rdata);
				$('#modalBox #BookingStatusDisp').html(rdata);
			}
		});
}
 //]]>
</script>




<script type="text/javascript">//<![CDATA[
function changeStatusAgenda(status, booking_service_id)
{
	//var booking_service_id = $('#booking_service_id').val();
	$.ajax({
			url: "<?php echo base_url(); ?>admin/dashboard/ajaxStatusChange/"+status+"/"+booking_service_id,
			type: "POST",
			success: function(rdata) {
				                               
				$('#BookingStatusDispAgenda'+booking_service_id).html(rdata);
			}
		});
}
 //]]>
</script>




<script type="text/javascript">//<![CDATA[
Calendar.setup({
cont          : "cont",
fdow          : 1,
selectionType : Calendar.SEL_MULTIPLE,
onSelect      : function() {
	var count = this.selection.countDays();
	if(count == 1) {
		var date = this.selection.get()[0];
		date = Calendar.intToDate(date);
		y = Calendar.printDate(date, "%Y");
		m = Calendar.printDate(date, "%m")*1;
		d =  Calendar.printDate(date, "%d");
		  $('#calendar').fullCalendar('gotoDate',y,m-1,d );
	} 
	else 
	{
		/*$("calendar-info").innerHTML = Calendar.formatString(
			"${count:no date|one date|two dates|# dates} selected",
			{ count: count }
		);*/
	}
},
checkRange    : function(date, cal) {
	  alert("Date " + date + " cannot be selected");
}
});
	  
function getCalenderview(){
	empvalArr = new Array();
	$("input:checkbox[name=emp]:checked").each(function()
	{
		var value1= $(this).val();
		empvalArr.push(value1);
	});
	servicesArr = new Array();
	$("input:checkbox[name=services]:checked").each(function()
	{
		var value2= $(this).val();
		servicesArr.push(value2);
	});
	var json_empvalArr = JSON.stringify(empvalArr, null, 2);
	var json_servicesArr = JSON.stringify(servicesArr, null, 2);
	
	
	$.ajax({
			type: 'POST',
			datatype:'json',
			url:"<?php echo site_url('admin/dashboard/calenderViewAjax'); ?>",
			data:"json_empvalArr="+json_empvalArr+"&json_servicesArr="+json_servicesArr,
			success:function(html)
			{ 
					var newdata =  eval('[' + html + ']');
					//alert(newdata);
					var date = new Date();
					var d = date.getDate();
					var m = date.getMonth();
					var y = date.getFullYear();
					 //callback(events);
				    $('#calendar').fullCalendar('removeEvents');
       			    $('#calendar').fullCalendar('addEventSource',newdata);
			}
		});
	
	
	
	   /*var d = $('#calendar').fullCalendar('getDate');*/
	//alert(json_empvalArr);
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
    var cus_fname_2     =$("#modalBox #cus_fname_2").val();
    var cus_lname_3     =$("#modalBox #cus_lname_3").val();
    var cus_mob_9       =$("#modalBox #cus_mob_9").val();
    var cus_phn1_10     =$("#modalBox #cus_phn1_10").val();
    var cus_phn2_11     =$("#modalBox #cus_phn2_11").val();
    var cus_address_4   =$("#modalBox #cus_address_4").val();
    var user_email      =$("#modalBox #user_email_p").val();


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
            url:"<?php echo site_url('admin/dashboard/ajaxNewCustomerRegis'); ?>",
            data:"cus_fname_2="+cus_fname_2+"&cus_lname_3="+cus_lname_3+"&user_email="+cus_mob_9+"&cus_mob_9="+user_email+"&cus_phn1_10="+cus_phn1_10+"&cus_phn2_11="+cus_phn2_11+"&cus_address_4="+cus_address_4,
            success:function(rdata)
            { 
                     var newReg_cust_id  = $.trim(rdata);
                     $('#modalBox  #userregismodule').hide();
                     var input = String(g_date);
                     var input = String(g_date);
                     var parts = input.split(" ");
                     var output1 = '';
                     var output2 = '';

                     output1 = parts[1]+ '-' +parts[2]+ '-' +parts[3];
                     output2 = parts[4];

                     if(output2 == "00:00:00")
                     {
                         var timeavailable = 0;
                     }
                     else
                     {
                         var timeavailable = 1;
                     }

                     $.ajax({
                              url: "<?php echo base_url(); ?>admin/dashboard/ajaxnwlyRegstrdExistingUsers/"+newReg_cust_id+"/"+timeavailable,
                              type: "POST",
                              success: function(rdata) {
                                     // alert(rdata);
                                      $('#modalBox #bookingModule').html(rdata);
                              }
                      });
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


<script>
function ajxCall()
{
    var input = String(g_date);
    var input = String(g_date);
    var parts = input.split(" ");
    var output1 = '';
    var output2 = '';
            
    output1 = parts[1]+ '-' +parts[2]+ '-' +parts[3];
    output2 = parts[4];
    
    if(output2 == "00:00:00")
    {
        var timeavailable = 0;
    }
    else
    {
        var timeavailable = 1;
    }
    
   
    var searchKey = $('#modalBox #serachkey').val();
    
    if(searchKey == null || searchKey == "")
        {
            alert("Please Enterr Search Key");
            return false;
        }
 
   $.ajax({
            url: "<?php echo base_url(); ?>admin/dashboard/ajaxExistingUsers/"+searchKey+"/"+timeavailable,
            type: "POST",
            success: function(rdata) {
                   // alert(rdata);
                    $('#modalBox #DispStaffArea').html(rdata);
            }
    });
   
}
</script>


<script>
function ajxCallForBookingAdmin()
{
    if($("input[name=customer_id]:checked").length != 1 || $("input[name=employee_id]:checked").length != 1 || $("input[name=service_id]:checked").length != 1) {
        alert("Please select one option from each section");
    }
    else
        {
            var input = String(g_date);
            var parts = input.split(" ");
            var output1 = '';
            var output2 = '';
            
            output1 = parts[1]+ '-' +parts[2]+ '-' +parts[3];
            output2 = parts[4];
            var bookingDate =  output1;           
            if(output2 == "00:00:00")
            {
                var TimeSlot = $('#modalBox #timeslot').val();
            }
            else
            {
                var TimeSlot = output2;
            }
                       
            var customer_id = $("input[name=customer_id]:checked").val();
            var employee_id = $("input[name=employee_id]:checked").val();
            var service_id  = $("input[name=service_id]:checked").val();
              
            $.ajax({
                url: "<?php echo base_url(); ?>admin/dashboard/ajaxAdminBookingInsert/"+customer_id+"/"+employee_id+"/"+service_id+"/"+bookingDate+"/"+TimeSlot,
                type: "POST",
                success: function(rdata) {
                          if(rdata == 1)
                            {
                                var retrurnstr = '<br /><br />Booking has been recoreded sucesfully<br />';
                                $.ajax({
                                        type: 'POST',
                                        datatype:'json',
                                        url:"<?php echo site_url('admin/dashboard/calenderViewAjaxrepopulate'); ?>",
                                        data:"",
                                        success:function(html)
                                        { 
                                            var newdata =  eval('[' + html + ']');
                                            var date = new Date();
                                            var d = date.getDate();
                                            var m = date.getMonth();
                                            var y = date.getFullYear();
                                            $('#calendar').fullCalendar('removeEvents');
                                            $('#calendar').fullCalendar('addEventSource',newdata);
                                        }
                                });
                            }
                            else
                            {
                                var retrurnstr = '<br /><br />There is some error, processing your request, please try after some time<br />';
                            }
                            $('#modalBox #DispStaffArea').html(retrurnstr);
                }
            });
          }
 }
</script>


<script>
function deleteThisBooking()
{
    if(confirm('are you sure, You want to delete this Booking?'))
    {
        var booking_id = $('#booking_id').val();
        $.ajax({
                url: "<?php echo base_url(); ?>admin/dashboard/ajaxDeleteThisBooking/"+booking_id,
                type: "POST",
                success: function(rdata) {
                    //alert('>>>>>>>>>'+rdata+'<<<<<<<<<<<<<<');
                    if(rdata == 1)
                    {
                            alert('Booking has been deleted sucessfully');
                            $.ajax({
                                    type: 'POST',
                                    datatype:'json',
                                    url:"<?php echo site_url('admin/dashboard/calenderViewAjaxrepopulate'); ?>",
                                    data:"",
                                    success:function(html)
                                    { 
                                        var newdata =  eval('[' + html + ']');
                                        var date = new Date();
                                        var d = date.getDate();
                                        var m = date.getMonth();
                                        var y = date.getFullYear();
                                        $('#calendar').fullCalendar('removeEvents');
                                        $('#calendar').fullCalendar('addEventSource',newdata);
                                    }
                           });
                    }
                    else
                    {
                            alert('There is some error, processing your request, please try after some time');
                    }
                }
            });
         }
}
</script>





<script>
function deleteThisBookingAgenda(booking_service_id)
{
    if(confirm('are you sure, You want to delete this Booking?'))
    {
        //var booking_id = $('#booking_id').val();
        
        
        
        $.ajax({
                url: "<?php echo base_url(); ?>admin/dashboard/ajaxDeleteAgendaBooking/"+booking_service_id,
                type: "POST",
                success: function(rdata) {
                    //alert('>>>>>>>>>'+rdata+'<<<<<<<<<<<<<<');
                    if(rdata == 1)
                    {
                            $('#tr'+booking_service_id).html("");
                    }
                    else
                    {
                            alert('There is some error, processing your request, please try after some time');
                    }
                }
            });  
         }
}
</script>


<script>
    function ask_review(id)
{
	//alert(id);
	var r = confirm('Are you sure you want to ask for review ?');
	if(r == true)
	{
		$.ajax({
			url: "<?php echo base_url(); ?>admin/appointment_report/Ask_ReviewAjax/",
			type: "POST",
			data: {b_s_id: id},
			success: function(msg) {
				
				if (msg == 1) 
				{
					alert('Email sent sucessfully!');
				} 
				else 
				{
					alert('There is some error processing your request');
				}
				
			}
		});
	}
	
}
    
    </script>
    
    
    
<script>
function fullevent()
{
//var events = [];
var events = $('#calendar').fullCalendar('clientEvents');


 resultArr = new Array;
 resultArr['start'] = new Array();
 resultArr['title'] = new Array();

for(k in events){
  resultArr['start'].push(events[k].start);
  resultArr['title'].push(events[k].title);
}


//window.location.href="home.php?p=merchant&msg='.$msg.'"
var jObject={};
// var jObject['start']={};
 for(i in resultArr)
 {
	jObject[i] = resultArr[i];
 }
 jObject= $.stringify(jObject);
 //alert(jObject);
 
 
 
$.ajax({
    
	
	  type: 'POST',
	  datatype:'html',
	 
          url: "<?php echo base_url(); ?>admin/dashboard/allevents",
	  data:"events="+jObject,
       success:function(rdata)
        { 
         alert("webcal:<?php echo base_url(); ?>application/ical/test1.ics");
        //window.open("webcal:<?php echo base_url(); ?>application/ical/test1.ics");
        
         window.open("webcal://aritra.pardco.com/application/ical/test.ics")
        
       // aritra.pardco.com/admin/dashboard
		//alert(rdata);
		
		
		}
	

	});

		/*for(i in events){
			alert(events[i].start);
		}*/
//alert(events);
} 
</script>




<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />

