function OpenBoxAppointmentsInfo(){
	app_popup(600);
	$("#front_popup_content").html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/></center>');
	$.ajax({
	      url: SITE_URL+"page/fnp_myAppoinmentDetails",
	      type: "post",
	      success: function(result){
				$('#front_popup_content').html('');
				$('#front_popup_content').html(appointmentHtml(result));
				$('#appoContainer').easytabs({defaultTab: "li:nth-of-type(1)"});
		 	 }  	
		 })
}

function appointmentHtml(result){
		var ls_data = result.split("|(^_^)|");
		var str='';
		str+='<div id="appoContainer" class="tab-container">';
		str+='<ul class="etabs">';
		str+='<li class="tab"><a href="#upcomingAppo">'+pLang['upcoming_appointments']+' </a></li>';
		str+='<li class="tab"><a href="#pastAppo">'+pLang['past_appointments']+' </a></li>';
		str+='</ul>';
		str+='<div class="panel-container">';
		str+='<div id="upcomingAppo">';
		//<!--Upcoming Appointments conent area start-->
		str+=ls_data[0];
		//<!--Upcoming Appointments conent area end-->
		str+='</div>';
		str+='<div id="pastAppo">';
		//<!--Past Appointments conent area start-->
		str+=ls_data[1];
		//<!--Past Appointments conent area end-->
		str+='</div>';
		str+='</div>';
		return str;
}
	
function OpenBoxmodifyInfo(){
	pr_popup(550);
		
	$("#front_popup_content").html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/></center>');
	
		$.ajax({
			      url: SITE_URL+"page/getModifyMyInfoHtml",
			      type: "post",
			      success: function(result){ 
					$("#front_popup_content").html(result);
					check_new_reg_form();
			      }  
    		});
}

	function clear_fields(id){
		
		var value = $("#"+id).val();
		if($.trim(value) != ''){
			$('#'+id).next('span').empty();
			
		}
		
		
	}


function updateCustomerInfo(){

    var dupli_user = 0;
    var user_name = $.trim($('#user_name_reg').val());
    var res = [];
    var url = document.location.href; 
    res = url.split("/");
    var ad_name = res[2].split(".");
	
    var errorcode = 0;
    if($('#cus_fname_2').length > 0){
	    if($.trim($('#cus_fname_2').val())==''){
	            $('#cus_fname_2').next().find('br').remove();
	            $('#cus_fname_2').next().children('span').remove();                         
	            $('#cus_fname_2').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
	            errorcode = 1;
	    }
	}    
    
    if($('#cus_lname_3').length > 0){
		if($.trim($('#cus_lname_3').val())==''){
	            $('#cus_lname_3').next().find('br').remove();
	            $('#cus_lname_3').next().children('span').remove();                         
	            $('#cus_lname_3').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
	            errorcode = 1;
	    }
	}    
  
  
    if($('#cus_countryid_5').val()==''){  
    		alert("Hi");                        
            $('#modalBox #cus_countryid_5').next().find('br').remove();
            $('#modalBox #cus_countryid_5').next().children('span').remove();                         
            $('#modalBox #cus_countryid_5').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode = 1;
    }
   
    if($('#cus_regionid_6').val()==''){                          
            $('#cus_regionid_6').next().find('br').remove();
            $('#cus_regionid_6').next().children('span').remove();                         
            $('#cus_regionid_6').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode = 1;
    }
    
	if($('#cus_cityid_7').val()==''){                          
            $('#cus_cityid_7').next().find('br').remove();
            $('#cus_cityid_7').next().children('span').remove();                         
            $('#cus_cityid_7').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode = 1;
    }
  
    if($('#cus_time_zone_id_21').val()==''){                      
            $('#cus_time_zone_id_21').next().find('br').remove();
            $('#cus_time_zone_id_21').next().children('span').remove();                    
            $('#cus_time_zone_id_21').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode = 1;
    }            

    //var charexp = /^[a-zA-Z ]+$/;
    var charexp = /^[a-zA-ZäöåÄöÅ ]+$/;
    if(!charexp.test($('#cus_fname_2').val())){
            //$('#modalBox #cus_fname_div').html('Only characters are allowed.');
            $('#cus_fname_2').next().find('br').remove();
            $('#cus_fname_2').next().find('span').remove();
            $('#cus_fname_2').next().append('<br/><span style="color:#FF0000;font-size:10px;">Only characters are allowed.<span>'); 
            errorcode = 1;
    }        
    
	if(!charexp.test($('#cus_lname_3').val())){			
            $('#cus_lname_3').next().find('br').remove();
            $('#cus_lname_3').next().children('span').remove();                         
            $('#cus_lname_3').next().append('<br/><span style="color:#FF0000;font-size:10px;">Only characters are allowed.<span>');           
            errorcode = 1;			
    }
   
    if($.trim($('#cus_mob_9').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_mob_9').val())) {
                $('#cus_mob_9').next().find('br').remove();
                $('#cus_mob_9').next().children('span').remove();   
                $('#cus_mob_9').next().append('<br/><span style="color:#FF0000;font-size:10px;">Mobile has to be Numeric.<span>');           
            errorcode = 1;                        

            }                   
    }
   
    if($.trim($('#cus_phn1_10').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn1_10').val())) {
                $('#cus_phn1_10').next().find('br').remove();
                $('#cus_phn1_10').next().children('span').remove();   
                $('#cus_phn1_10').next().append('<br/><span style="color:#FF0000;font-size:10px;">Phone Number has to be Numeric.<span>');      
            errorcode = 1;
            }                   
    }
   
    if($.trim($('#cus_phn2_11').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn2_11').val())){
                $('#cus_phn2_11').next().find('br').remove();
                $('#cus_phn2_11').next().children('span').remove();   
                $('#cus_phn2_11').next().append('<br/><span style="color:#FF0000;font-size:10px;">Phone Number has to be Numeric.<span>');      
            	errorcode = 1;
            }                   
    }
    
	if($.trim($('#cus_zip_8').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_zip_8').val())){                             
                $('#cus_zip_8').next().find('br').remove();
                $('#cus_zip_8').next().children('span').remove();   
                $('#cus_zip_8').next().append('<br/><span style="color:#FF0000;font-size:10px;">Zip has to be Numeric.<span>');           
            errorcode = 1;                       
            }                   
    }

  
	var ori_pass_reg = $("#ori_pass_reg").val();
	ori_pass_reg = $.trim(ori_pass_reg);
	var conf_pass_reg = $("#conf_pass_reg").val();
	conf_pass_reg = $.trim(conf_pass_reg);
	
	if(ori_pass_reg != '' && conf_pass_reg != ''){
		if(ori_pass_reg.length < 6){
			$("#ori_ps_err").css('color','#FF0000');
			$("#ori_ps_err").css('font-size','10px');
			$("#ori_ps_err").html('<br />Password must have atleast 6 characters.');
			errorcode = 1;
		}
		
		if(ori_pass_reg != conf_pass_reg){
			$("#conf_ps_err").css('color','#FF0000');
			$("#conf_ps_err").css('font-size','10px');
			$("#conf_ps_err").html('<br />Confirm Password does not match.');
			errorcode = 1;
		}
		
	}
	
	
	
	if(errorcode > 0){
       return false; 
    }           
   
    
       if(errorcode == 0) {
                      var frmID = '#cus_reg';
                      var params ={ 'action' : 'save' };
                      var paramsObj = $(frmID).serializeArray();
                      $.each(paramsObj, function(i, field){
                              params[field.name] = field.value;
                              //alert(field.value);
                      });
					  pr_popup(350);
					  $(".btn_close").remove();
					  $("#front_popup_content").html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/><br><lable style="color:#0000FF;font-size:20px;font-weight:bold;">Updating....<lable></center>');
					 
                      $.ajax({
                         type: 'POST',
                         url: SITE_URL+"page/updateCustomer",
                         data: params,
                         success: function(data){
						 	$("#front_popup_content").html('<center><lable style="color:#196C19;font-size:20px;font-weight:bold;">'+data+'</lable><br><br><br><a href="javascript:void(0);" style="float: right;font-style:	italic;color:#FF0000" onclick="pr_popup_close()"> click here to continue...</a></center>');
                          
                         }
                      });
      }
            
}

function showCondition(){
    $("#terms").show(1000);
    $("#terms").animate(1000);
    $("#delText").hide();
	$("#terms table td span").removeAttr("style");
	$(".registration-div").animate({ scrollTop: 300 }, "slow");
}
function cancelDelete(){
    $("#terms").hide(1000);
    $("#delText").show();
    $("#terms table td span").removeClass("del");
}
function deleteAccount(){
    //var params ={ 'action' : 'save' };
    if ($('#accept').is(":checked")){
        $.ajax({
            type: "post",
            url: SITE_URL+"page/deleteAccount",
            //data: params,
            success: function(result){
                if(result == 1){
                    alert("Account has been deleted successfully");
                    //window.location(SITE_URL+"logout");
                    location.reload();
                }
            }  	
        })
    }else{
        $("#terms table td span").addClass("del");
		$("#terms table td span").attr("style","color:#FF0000");
    }
}

/*########################################*/
function setStatus(status,serviceId){
    var didConfirm = confirm(pLang['mobile_are_you_sure']);/*Are you sure to cancel?*/
    if (didConfirm == true) {
        var hidden = $("#counter").val();
        hidden++;
        $('#counter').val(hidden);
        $.ajax({
            type: "post",
            url: SITE_URL+"page/changeAppointmentStatus",
            data: { 'status' : status, 'serviceId' : serviceId },
            success: function(result){
                if($.trim(result) == 1){
                    $('#status_'+serviceId).html(pLang['mobile_cancelled_successfully']);/*Appointment cancelled successfully*/
                }
            }  	
        })
    }else{
        $('#status_'+serviceId).html('<div class="onoffswitch" onchange="setStatus(\'yes\','+serviceId+')"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch_'+serviceId+'" checked><label class="onoffswitch-label" for="myonoffswitch_'+serviceId+'"><div class="onoffswitch-inner"></div><div class="onoffswitch-switch"></div></label></div>');
    }
}
/*########################################*/
function app_popup_close() {
    if($('#countdown').length > 0){
        for (var i = 1; i < 400; i++)
        window.clearInterval(i);
        var bookingData=$('#tempBookingData').serializeArray();
	$.ajax({
                url: SITE_URL+"page/deleteTempData",
                data:{bookingData:bookingData},
                type: "post" 	
		})
    }
	
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function () {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    var hidden = $("#counter").val();
    if(hidden > 0){
        location.reload();
    }
    return false;
}
function app_popup(popWidth) {
	//popWidth --- width of popup
	if ($("#front_popup").length == 0 ) {
        	$('<div id="front_popup" class="popup_block"><span id="front_popup_content"></span></div>').insertAfter($("#tab-container"));
    	}
	var popID = 'front_popup'; //id of popup

    $('#' + popID).fadeIn().css({ 'width': Number( popWidth ) }).prepend('<img onclick="app_popup_close()" src="'+img_url()+'front_image/close_pop.png" class="btn_close" border="0" />');

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