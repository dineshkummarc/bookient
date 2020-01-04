function menuFn(){
    $.ajax({
        url: SITE_URL + "page/getMobileMenu",
        type: "post",
        success: function (data) {
            pr_popup(200);
            $('#front_popup_content').html(data);
            $('.seLanguage').click(function(){
              $('.language').toggle(); 
            })
        }
    });
}

function pr_popup_close() {
	//When clicking on the close or fade layer...
    $('#fade , .popup_block').fadeOut(function() {
        $('#fade, .btn_close').remove();  //fade them both out
    });
    $('#front_popup').remove();
    return false;
}

function informationFn(){
    newLoginFn();
	$.ajax({
	    url: SITE_URL + "page/getMobileModifyMyInfoHtml",
	    type: "post",
	    success: function (data) {
	        var memInfoArr = jQuery.parseJSON(data);
	        $('#user_id').val(memInfoArr.user_id);
            $('#nw_fname').val(memInfoArr.cus_fname);
	        $('#nw_lname').val(memInfoArr.cus_lname);
	        $('#nw_address').val(memInfoArr.cus_address);
	        $('#nw_mobile').val(memInfoArr.cus_mob);
	        $('#nw_email').val(memInfoArr.user_email);
			$('#regionContener').html(memInfoArr.user_region);
			$("#regionContener").trigger('create');
			$('#cityContener').html(memInfoArr.user_city);
			$("#cityContener").trigger('create');
			$('#nw_country option[value="'+ memInfoArr.cus_countryid +'"]').attr("selected","selected");
			$('#nw_country').selectmenu('refresh');
	        $('#nw_email').attr('readonly', true);
	        //$('.UserLogin').html('Update »');
            $('.UserLogin').html(pLang['mobile_update']+" >>");
	 	    $(".UserLogin").attr("onClick", "updateInfo()");	
	    }
	});
}

function logOutFn(){
    $.ajax({
        type: 'POST',
        url: SITE_URL+"logout",
        success: function(data){
            if(data !=0){
                window.location.reload(); 
            }
        }
    });
}

function existingLoginFn(){
	pr_popup_close()
	hideAllContent();
	$(".customNewLogInContent").hide();
	$(".customLogInContent").show();
	$(".loginContent").show('slow');
	$("#frmExisting input").click(function(){$(this).removeAttr('style');})
}

function newLoginFn(){
	pr_popup_close()
	hideAllContent();
	$(".topMenul").removeClass("ui-btn-active");
	$(".customLogInContent").hide();
	$(".customNewLogInContent").show();
	$(".loginContent").show('slow');
	$("#frmNew input,.ui-btn,#frmNew select").focus(function(){$(this).removeAttr('style');})
	$(".ui-btn,#frmNew select").click(function(){$(this).removeAttr('style');})
	$('#nw_mobile').keyup(function () {
        if (this.value != this.value.replace(/[^0-9\.]/g, '')) {
           this.value = this.value.replace(/[^0-9\.]/g, '');
        }
    });
	checkEmailDuplicate();
}

function imgExistingLoginFn(){
	$(".customNewLogInContent").hide();
	$(".customLogInContent").show();
	$("#frmExisting input,#frmExisting select").click(function(){$(this).removeAttr('style');})
}

function imgNewLoginFn(){
	$(".customLogInContent").hide();
	$(".customNewLogInContent").show();
	$("#frmNew input,.ui-btn,#frmNew select").focus(function(){$(this).removeAttr('style');})
	$(".ui-btn,#frmNew select").click(function(){$(this).removeAttr('style');})
	checkEmailDuplicate();
}

function submitExistingFn(){
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
var error=0;
if($('#ex_email').val()=='' || emailReg.test($('#ex_email').val()) == false){
	$("#ex_email").attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if($('#ex_pass').val()==''){
	$("#ex_pass").attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(error >0){
	return false;
}else{
	var params ={ 'action' : 'save' };
	params['user_name'] = $('#ex_email').val();
	params['password'] = $('#ex_pass').val();
	params['bDate'] 	= $('#selectedDate').val();
	params['bTime'] 	= $('#selectedTime').val();
	params['mobileType']= 'mobile';
	params['contentType']= $('#latestContent').val();
	params['staffArr'] 	= get_staff();
	params['srvArr'] 	= get_service();
	$.ajax({
        type: 'POST',
        url: SITE_URL+"customer/customer_login/CustomerLogInAjax",
        data: params,
        success: function(data){
                if(data !=0){
                    window.location.reload(); 
                }else{  
                    $('#msg_t').html(pLang['authentication_Failed']);
                }
            }
        });
}

}

function mobileForgetPassword(){
	hideAllContent();
	$(".forgetPasswordContent").show();
	$('#fgot_email').focus(function(){
		$(this).removeAttr('style');
	})
	$('#fgot_email').val('');
	$('#msg_fgot_email').html(''); 
}

function facebookFn(){
	$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
	params = {};
	params['bDate'] 	= $('#selectedDate').val();
	params['bTime'] 	= $('#selectedTime').val();
	params['staffArr'] 	= get_staff();
	params['srvArr'] 	= get_service();
	$.ajax({
	      url: SITE_URL+"customer/customer_login/fn_facebook",
		  data:params,
	      type: "post",
	      success: function(result){
		  		window.location.href=result;
		  }  	
	 });
}

function googleFn(){
	$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
	params = {};
	params['bDate'] 	= $('#selectedDate').val();
	params['bTime'] 	= $('#selectedTime').val();
	params['staffArr'] 	= get_staff();
	params['srvArr'] 	= get_service();
    $.ajax({
	    url: SITE_URL+"customer/customer_login/fn_google",
	    data:params,
	    type: "post",
	    success: function(result){
		     window.location.href=result;
		  }  	
	 });
}

function changeCountry(countryId){
	$('#regionContener').html('<img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/loading.GIF">');
	changeRegion()
	$.ajax({
	    url: SITE_URL+"page/mobileRegion/"+countryId,
	    data:{country_id:countryId},
	    type: "post",
	    success: function(result){
	        $('#regionContener').html(result);
			$("#regionContener").trigger('create');
			$("#frmNew input,.ui-btn,#frmNew select").focus(function(){$(this).removeAttr('style');})
			$(".ui-btn,#frmNew select").click(function(){$(this).removeAttr('style');})
	         }   
	  })
}

function changeRegion(regionId){
	$('#cityContener').html('<img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/loading.GIF">');
	$.ajax({
		url: SITE_URL+"page/mobileCity/"+regionId,
		data:{region_id:regionId},
		type: "post",
		success: function(result){
		    $('#cityContener').html(result);
			$("#cityContener").trigger('create');
			$("#frmNew input,.ui-btn,#frmNew select").focus(function(){$(this).removeAttr('style');})
			$(".ui-btn,#frmNew select").click(function(){$(this).removeAttr('style');})
		     }   
	})
}

function checkEmailDuplicate(){
	$('#nw_email').blur(function(){
	$('#errEmailD').remove();
	var userEmail = $.trim($('#nw_email').val());
	var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	if(emailexp.test(userEmail)){
		$.ajax({
        type: 'POST',
        url: SITE_URL+"page/checkingEmail",
        data: {'userEmail':userEmail },
        success: function(dupliUser){
            if($.trim(dupliUser) == 'false'){                        
				$('<span style="color:#FF0000;font-size:10px;" id="errEmailD">'+pLang['existsPassword']+'<span>').insertAfter($('#nw_email'));        
            }
			}
		})
	}else{
		if(userEmail !=''){
			                        
        	$('<span style="color:#FF0000;font-size:10px;" id="errEmailD">'+pLang['invalidEmail']+'<span>').insertAfter($('#nw_email'));
		} 
	}
	})   
}

function submitNewFn(){
var submitText = $('.UserLogin').html();
var nw_fname	= $('#nw_fname');
var nw_lname	= $('#nw_lname');
var nw_address  = $('#nw_address');
var nw_country  = $('#nw_country');
var nw_region	= $('#nw_region');
var nw_city		= $('#nw_city');
var nw_mobile	= $('#nw_mobile');
var nw_email	= $('#nw_email');
var nw_pass		= $('#nw_pass');
var nw_cpass	= $('#nw_cpass');
var error=0;
var ckName = /^[a-zA-Z ]*$/;
if(nw_fname.val()=='' || ckName.test(nw_fname.val()) == false){
	nw_fname.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_lname.val()=='' || ckName.test(nw_lname.val()) == false){
	nw_lname.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_address.val()==''){
	nw_address.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_country.val()==''){
	nw_country.parent().attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_region.val()==''){
	nw_region.parent().attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_city.val()==''){
	nw_city.parent().attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_mobile.val()==''){
	nw_mobile.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if( nw_email.val() == '' || emailReg.test(nw_email.val()) == false){
	nw_email.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if (nw_pass.val() == '') {
    nw_pass.attr('style', 'border: 1px solid #E50000; background: #efcbcb !important;');
    error++;
}
if (nw_cpass.val() == '' || (nw_pass.val() != nw_cpass.val())) {
    nw_cpass.attr('style', 'border: 1px solid #E50000; background: #efcbcb !important;');
    error++;
}

if(error > 0){
	return false;
}else{
params = {};
params['cus_fname_2']	= nw_fname.val();
params['cus_lname_3']	= nw_lname.val();
params['cus_address_4']	= nw_address.val();
params['country_id_5']	= nw_country.val();
params['region_id_6']	= nw_region.val();
params['city_id_7']		= nw_city.val();
params['cus_mob_9']		= nw_mobile.val();
params['user_email']	= nw_email.val();
params['ori_pass']		= nw_pass.val();

params['bDate'] 		= $('#selectedDate').val();
params['bTime'] 		= $('#selectedTime').val();
params['mobileType']	= 'mobile';
params['contentType']	= $('#latestContent').val();
params['staffArr'] 		= get_staff();
params['srvArr'] 		= get_service();
$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
$.ajax({
    type: 'POST',
    url: SITE_URL + "customer/customer_registration/SaveRegistrationAjax",
    data: params,
    success: function (data) {
        window.location.reload();
    }
});
}

}

function updateInfo(){
var submitText	= $('.UserLogin').html();
var user_id		= $('#isLoginM');
var nw_fname	= $('#nw_fname');
var nw_lname	= $('#nw_lname');
var nw_address  = $('#nw_address');
var nw_country  = $('#nw_country');
var nw_region	= $('#nw_region');
var nw_city		= $('#nw_city');
var nw_mobile	= $('#nw_mobile');
var nw_email	= $('#nw_email');
var nw_pass		= $('#nw_pass');
var nw_cpass	= $('#nw_cpass');
var error=0;
var ckName = /^[a-zA-Z ]*$/;
if(nw_fname.val()=='' || ckName.test(nw_fname.val()) == false){
	nw_fname.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_lname.val()=='' || ckName.test(nw_lname.val()) == false){
	nw_lname.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_address.val()==''){
	nw_address.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_country.val()==''){
	nw_country.parent().attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_region.val()==''){
	nw_region.parent().attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_city.val()==''){
	nw_city.parent().attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if(nw_mobile.val()==''){
	nw_mobile.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
if( nw_email.val() == '' || emailReg.test(nw_email.val()) == false){
	nw_email.attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
	error++;
}
if (nw_pass.val() != nw_cpass.val()) {
    nw_cpass.attr('style', 'border: 1px solid #E50000; background: #efcbcb !important;');
    error++;
}
if(error > 0){
	return false;
}else{
params = {};
params['user_id']	    = user_id.val();
params['cus_fname_2']	= nw_fname.val();
params['cus_lname_3']	= nw_lname.val();
params['cus_address_4']	= nw_address.val();
params['country_id_5']	= nw_country.val();
params['region_id_6']	= nw_region.val();
params['city_id_7']		= nw_city.val();
params['cus_mob_9']		= nw_mobile.val();
params['user_email']	= nw_email.val();
params['ori_pass']		= nw_pass.val();

params['bDate'] 		= $('#selectedDate').val();
params['bTime'] 		= $('#selectedTime').val();
params['mobileType']	= 'mobile';
params['contentType']	= $('#latestContent').val();
params['staffArr'] 		= get_staff();
params['srvArr'] 		= get_service();
$( "body" ).append('<div class="loader"><img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/ajax-loader.gif"></div>');
	$.ajax({
	    type: 'POST',
	    url: SITE_URL + "page/updateCustomer",
	    data: params,
	    success: function (data) {
	         window.location.reload();
	    }
	});
}

}

function submitFpassBackFn(){
	hideAllContent();
	$('.loginContent').show();	
}

function submitFpassFn(){
	$('#msg_fgot_email').html(''); 
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	var error=0;
	if($('#fgot_email').val()=='' || emailReg.test($('#fgot_email').val()) == false){
		$("#fgot_email").attr('style','border: 1px solid #E50000; background: #efcbcb !important;');
		error++;
	}
	if(error >0){
		return false;
	}else{
		$('#msg_fgot_email').html('<img alt="Loader" src="'+SITE_URL+'asset/mobile_css/images/send.gif">'); 
		var params ={ 'action' : 'save' };
		params['user_email'] = $('#fgot_email').val();
		$.ajax({
	        type: 'POST',
	        url: SITE_URL+"customer/forgot_password/ForgotPasswordAjax",
	        data: params,
	        success: function(data){
	                if(data ==1){
	                    $('#msg_fgot_email').html('<span style="color:#478406" >'+pLang['chkNewEmail_mob']+'</span>'); 
	                }else{  
	                    $('#msg_fgot_email').html('<span style="color:#FF0000" >'+pLang['authentication_Failed']+'</span>');
	                }
	            }
	        });
	}
}