<script type="text/javascript">
    $(document).ready(function () {
        //hiding tab content except first one
        $(".tabContent").not(":first").hide();
        // adding Active class to first selected tab and show 
        $("ul.tabs li:first").addClass("active").show();

        // Click event on tab
        $("ul.tabs li").click(function () {
            // Removing class of Active tab
            $("ul.tabs li.active").removeClass("active");
            // Adding Active class to Clicked tab
            $(this).addClass("active");
            // hiding all the tab contents
            $(".tabContent").hide();
            // showing the clicked tab's content using fading effect
            $($('a', this).attr("href")).fadeIn('slow');

            return false;
        });

        

        $('.cMemberShip u').click(function () {
            $('#SourceShowHide').show();
            $('#chooseYourMembership').hide();
        })

        $(".membershipbt").click(function () {
            lightbox_body();
            var currentId = $(this).attr('for');
			var is_multilocation = $(this).attr('is_multilocation');
            $('.membershipContainer').removeAttr('style');
            $('.AjaxContener').hide();
            $('.planDtsCont').show();
            $(this).parent().parent().css("background-color", "#c5d8f1");
            $(this).parent().hide();
            $.ajax({
                url: SITE_URL + "page/fn_checkLogInAdmin",
                type: "post",
                success: function (result) {
                    //check login start
                    if (result == 0) {
                        window.location.href = SITE_URL + 'admin/login';
                    } else {
                        $.ajax({
                            type: 'POST',
                            data: { 'planId': currentId, 'is_multilocation': is_multilocation },
                            url: BASE_URL + "/admin/membership/planDetails",
                            success: function (datas) {
                                $('#' + currentId).show();
                                $('#' + currentId).html(datas);
                                closeLightbox_body();
                            }
                        });
                    }
                }
            })
        })
    });
	function memberChangePlan() {
            $('#SourceShowHide').hide();
            $('#chooseYourMembership').show();
    }
    function showDetails(package) {
        $('#' + package).show();
    }
    
</script>

<script>
	function showDetailsTier(plan_id,tierprice_id){		
		$('.plan-tireprice-details').hide();
		$('#'+plan_id+'-details-'+tierprice_id).show();	
	}
	function showStaffInput(plan_id){		
		$('#staff_show_'+plan_id).hide();
		$('#staff_input_'+plan_id).show();	
	}
	
	function showMulLocation(plan_id,no_of_location){	
		lightbox_body();	
		$.ajax({
			type: 'POST',
			data: { 'plan_id': plan_id, 'no_of_location': no_of_location },
			url: BASE_URL + "/admin/membership/changeLocation",
			success: function (data) {				
				$('#showBlckPerLocation_'+plan_id).html(data);				
				closeLightbox_body();
			}
		});	
	}
	function showMulBilling(plan_id,billing_cycle){	
		lightbox_body();		
		var staff_per_location	=$('#mulStaff_'+plan_id).val();
		var no_of_location	=$('#mulLocation_'+plan_id).val();	
		$.ajax({
			type: 'POST',
			data: { 'plan_id': plan_id, 'no_of_location': no_of_location ,'billing_cycle': billing_cycle ,'staff_per_location': staff_per_location},
			url: BASE_URL + "/admin/membership/changeBillingCycle",
			success: function (data){				
				$('#show_mul_loc_div_'+plan_id).html(data);				
				closeLightbox_body();
			}
		});	
	}
	function showMulStaff(plan_id,staff_per_location){	
		lightbox_body();	
		var no_of_location	=$('#mulLocation_'+plan_id).val();	
		var billing_cycle	=$('#mulBilling_'+plan_id).val();	
		$.ajax({
            type: 'POST',
            data: { 'plan_id': plan_id, 'no_of_location': no_of_location ,'staff_per_location': staff_per_location ,'billing_cycle': billing_cycle},
            url: BASE_URL + "/admin/membership/changeStaffPerLocation",
            success: function (data) {
				var html = $.trim(data);							
				$('#price_div_'+plan_id).html(html);
				$('#total_div_'+plan_id).html(html);								
				closeLightbox_body();
            }
        });	
	}
	function selectPlan(plan_id,is_multilocation){
		if(is_multilocation ==1){
			var staff_per_location	=	$('#mulStaff_'+plan_id).val();	
			var no_of_location		=	$('#mulLocation_'+plan_id).val();	
			var billing_cycle		=	$('#mulBilling_'+plan_id).val();
			var tierprice_id		=	'';
							
		}
		else{
			var staff_per_location	=	$('#mulStaff_'+plan_id).val();	
			var no_of_location		=	'';	
			var billing_cycle		=	$('#mulBilling_'+plan_id).val();
			var tierprice_id 		= 	$('#packagePrice-'+plan_id).val();
		}
		$.ajax({
            type: 'POST',
            data: { 'plan_id': plan_id, 'no_of_location': no_of_location ,'staff_per_location': staff_per_location ,'billing_cycle': billing_cycle ,'is_multilocation': is_multilocation ,'tierprice_id': tierprice_id},
            url: BASE_URL + "/admin/membership/getCurrentPlanVsNewPlan",
            success: function (data) {
				//alert(data);				
				pr_popup(600);
				$('#front_popup_content').html(data);
				$('#front_popup').css( "position", "fixed" );
				afterCalling();
				 //pr_popup_close()
            }
        });	
		
	}
	
	function afterCalling(){
		$('.payBooking').blur(function(){
			var lsVal = $(this).val();
			if(lsVal !=''){
				$(this).removeAttr('style');
			}else{
				$(this).css('border','1px solid red');
			}
		});
		
		$('.payBookingSelect').change(function(){
			var lsVal = $(this).val();
			if(lsVal !=''){
				$(this).removeAttr('style');
			}else{
				$(this).css('border','1px solid red');
			}
		});
	}
	function validate_name(e)
	{
		var pressedkey = e.keyCode;
                    if (!((pressedkey == 8) 
					|| (pressedkey == 32) 
					|| (pressedkey == 86) 
					|| (pressedkey == 46) 
					|| (pressedkey >= 35 && pressedkey <= 40)
					|| (pressedkey==17)
					|| (pressedkey==18)
					|| (pressedkey==19) 
					|| (pressedkey >= 65 && pressedkey <= 90))) 
					{
                       e.preventDefault();
                    }
    }
	
	function isNumber(event) 
	{
		
		
        if (event.shiftKey) event.preventDefault();
        else {
            var nKeyCode = event.keyCode;
            //Ignore Backspace and Tab keys
            if (nKeyCode == 8 || nKeyCode == 9) return;
            if (nKeyCode < 95) {
                if (nKeyCode < 48 || nKeyCode > 57) event.preventDefault();
            } else {
                if (nKeyCode < 96 || nKeyCode > 105) event.preventDefault();
            }
        } 


		
    }
	function choosePlanMultilocation(plan_id){	
		// form validation start
		 var regex = /^[a-zA-Z]*$/;
		 var regexNm = /^[0-9]*$/;
		 var err=0;
		 var fname =  $('#pay_first_name');
		 if(fname.val() == ''|| !regex.test(fname.val())){
		 	fname.css('border','1px solid red');
		 	err++;
		 }
		 var lname = $('#pay_last_name');
		 if(lname.val() == '' || !regex.test(lname.val()) ){
		 	lname.css('border','1px solid red');
		 	err++;
		 }
		 var cc_type = $('#pay_cardtype');
		 if(cc_type.val() == ''){
		 	cc_type.css('border','1px solid red');
		 	err++;
		 }
		 var cc_number = $('#pay_ccnumber');
		 if(cc_number.val() == '' || !regexNm.test(cc_number.val()) ){
		 	cc_number.css('border','1px solid red');
		 	err++;
		 }
		 var exp_month = $('#pay_month');
		 if(exp_month.val()== ''){
		 	exp_month.css('border','1px solid red');
		 	err++;
		 }
		 var exp_year = $('#pay_year');
		 if(exp_year.val() == ''){
		 	exp_year.css('border','1px solid red');
		 	err++;
		 }
		 var cvv = $('#pay_cvv');
		 
		 if(cvv.val() == '' || (cvv.val().length) !=3 || !regexNm.test(cvv.val()) ){
		 	cvv.css('border','1px solid red');
		 	err++;
		 }
		if(err >0){
			return false;
		}else{
		
		
		pr_popup_close();
		lightbox_body();
		var frmID = '#frm_paymentDetails';
		var params ={};
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
		  params[field.name] = field.value;
		});
		params['staff_per_location']	= $('#mulStaff_'+plan_id).val();
		params['no_of_location']		= $('#mulLocation_'+plan_id).val();
		params['billing_cycle']			= $('#mulBilling_'+plan_id).val();
		params['plan_id']				= plan_id;

		$.ajax({
            type: 'POST',
            data: params,
            url: BASE_URL + "/admin/membership/selectPlanMultilocation",
            success: function (data) {
            	if(data == true){
					location.reload(); 
				}else{		
					closeLightbox_body();
					$('#msg').css( "color", "red" );			
					$('#msg').html("<?php echo $this->lang->line('sry_unable_2_cmplt')?>");
					$('#SourceShowHide').hide();
				}
            }
        });	
		}
		// form validation end
	}
	/*
	function choosePlan(planId) {
		// form validation start
		
		 var regex = /^[a-zA-Z]*$/;
		 var regexNm = /^[0-9]*$/;
		 var err=0;
		 var fname =  $('#pay_first_name');
		 if(fname.val() == ''|| !regex.test(fname.val()) ){
		 	fname.css('border','1px solid red');
		 	err++;
		 }
		 
		 var lname = $('#pay_last_name');
		 if(lname.val() == '' || !regex.test(lname.val()) ){
		 	lname.css('border','1px solid red');
		 	err++;
		 }
		 var cc_type = $('#pay_cardtype');
		 if(cc_type.val() == ''){
		 	cc_type.css('border','1px solid red');
		 	err++;
		 }
		 var cc_number = $('#pay_ccnumber');
		 if(cc_number.val() == '' || !regexNm.test(cc_number.val()) ){
		 	cc_number.css('border','1px solid red');
		 	err++;
		 }
		 var exp_month = $('#pay_month');
		 if(exp_month.val()== ''){
		 	exp_month.css('border','1px solid red');
		 	err++;
		 }
		 var exp_year = $('#pay_year');
		 if(exp_year.val() == ''){
		 	exp_year.css('border','1px solid red');
		 	err++;
		 }
		 var cvv = $('#pay_cvv');
		 if(cvv.val() == '' || (cvv.val().length) !=3 || !regexNm.test(cvv.val()) ){
		 	cvv.css('border','1px solid red');
		 	err++;
		 }
		if(err >0){
			return false;
		}else{
			pr_popup_close();
		    lightbox_body();
		    var frmID = '#frm_paymentDetails';
		    var params ={};
		    var paramsObj = $(frmID).serializeArray();
		    $.each(paramsObj, function(i, field){
		    params[field.name] = field.value;
		 
		    });
		    params['tierprice_id']	= $('#packagePrice-'+planId).val();
		    params['planId']		= planId;
      	    $.ajax({
            type: 'POST',
            data: params,
            url: BASE_URL + "/admin/membership/selectPlan",
            success: function (data) {				
				if(data == true){
				location.reload(); 
				}else{		
					$('#msg').css( "color", "green" );			
					$('#msg').html("Sorry unable to complite payment process.");
					$('#SourceShowHide').hide();
					
				}
            }
        });
		}
		
		// form validation end
		
    }
	*/
		
</script>
<!-- ################Credit section start################## -->
<script>
function showDetails(credit_id){
	$(".credit-id").removeAttr("checked");	
	//$("#credit_id_"+credit_id).removeClass('credit-id');
	$("#credit_id_"+credit_id).prop('checked', true);
	$('.credit-details-tr').hide();	
	$('.purchase-option-tr').hide();
	$('#purchase_option_'+credit_id).show();	
	$('#credit_details_'+credit_id).show();
	getSmsAndCall(credit_id);		
}
</script>
<script>
function changeCountry(country_id,credit_id){
	$(".CountryDdlBox").val(country_id);
	getSmsAndCall(credit_id);	
}
function getSmsAndCall(credit_id){
	var country_id= $('#CountryDdl'+credit_id).val();
	$.ajax({
            type: 'POST',
            data: {'country_id':country_id,'credit_id':credit_id},
            url: BASE_URL + "/admin/membership/getCreditsCountryPrice",
            success: function (data) {
				if( data != 0 ){
					$('#note'+credit_id).show();
					var obj = jQuery.parseJSON(data);						
					if(obj[0].credit_service_id ==1){
						$('#callcharge'+credit_id).html(obj[0].cost);
						$('#creditCallChargeCountry'+credit_id).html(obj[0].country_name);						
					}
					if(obj[0].credit_service_id ==2){
						$('#smscharge'+credit_id).html(obj[0].cost);
						$('#creditSMAChargeCountry'+credit_id).html(obj[0].country_name);						
					}
					if(obj[1].credit_service_id ==1){
						$('#callcharge'+credit_id).html(obj[1].cost);
						$('#creditCallChargeCountry'+credit_id).html(obj[1].country_name);						
					}
					if(obj[1].credit_service_id ==2){
						$('#smscharge'+credit_id).html(obj[1].cost);
						$('#creditSMAChargeCountry'+credit_id).html(obj[1].country_name);						
					}
				}else{				
					$('#note'+credit_id).hide();
					alert('<?php echo $this->lang->line("cl_nd_sms_nt_avil")?>')
				}																		
            }
    });	
}
</script>
<script>
function selectCredit(credit_id){		
	$.ajax({
        type: 'POST',
        data: { 'credit_id': credit_id },
        url: BASE_URL + "/admin/membership/getPaypalInfo",
        success: function (data) {
			//alert(data);				
			pr_popup(600);
			$('#front_popup_content').html(data);
			afterCalling();
			 //pr_popup_close()
        }
    });			
}
</script>
<script>
function closeTheCurrentInstance(){
	var r = confirm("Are you sure to permanently delete your account ?");
	if (r == true){
	lightbox_body();
	$.ajax({
	        type: 'POST',
	        url: BASE_URL + "/admin/membership/closeTheCurrentInstance",
	        success: function (data){
				closeLightbox_body();
				window.location.reload(true);
	        }
	    });	
	} 
}


function chooseCredit(credit_id){	
	// form validation start
	 var regex = /^[a-zA-Z]*$/;
	 var regexNm = /^[0-9]*$/;
	 var err=0;
	 var fname =  $('#pay_first_name');
	 if(fname.val() == ''|| !regex.test(fname.val())){
	 	fname.css('border','1px solid red');
	 	err++;
	 }
	 var lname = $('#pay_last_name');
	 if(lname.val() == '' || !regex.test(lname.val()) ){
	 	lname.css('border','1px solid red');
	 	err++;
	 }
	 var cc_type = $('#pay_cardtype');
	 if(cc_type.val() == ''){
	 	cc_type.css('border','1px solid red');
	 	err++;
	 }
	 var cc_number = $('#pay_ccnumber');
	 if(cc_number.val() == '' || !regexNm.test(cc_number.val()) ){
	 	cc_number.css('border','1px solid red');
	 	err++;
	 }
	 var exp_month = $('#pay_month');
	 if(exp_month.val()== ''){
	 	exp_month.css('border','1px solid red');
	 	err++;
	 }
	 var exp_year = $('#pay_year');
	 if(exp_year.val() == ''){
	 	exp_year.css('border','1px solid red');
	 	err++;
	 }
	 var cvv = $('#pay_cvv');
	 
	 if(cvv.val() == '' || (cvv.val().length) !=3 || !regexNm.test(cvv.val()) ){
	 	cvv.css('border','1px solid red');
	 	err++;
	 }
	if(err >0){
		return false;
	}else{
			
		pr_popup_close();
		lightbox_body();
		var frmID = '#frm_paymentDetails_credits';
		var params ={};
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
		  params[field.name] = field.value;
		});
		params['credit_id']	= credit_id;
		
		$.ajax({
            type: 'POST',
            data: params,
            url: BASE_URL + "/admin/membership/buyCredit",
            success: function (data) {
				closeLightbox_body();
            	if(data == true){
					$('#credits_msg').css( "color", "green" );			
					$('#credits_msg').html("<?php echo $this->lang->line('paymnt_prcs_succ_cmplt')?>");
					$('#SourceShowHide').hide();
				}else{		
					
					$('#credits_msg').css( "color", "red" );			
					$('#credits_msg').html("<img src='"+SITE_URL+"/asset/sorry_admin.png' /> <?php echo $this->lang->line('sry_unable_2_cmplt')?>");
					$('#SourceShowHide').hide();
				}
            }
        });	
	}
	// form validation end
}
</script>

