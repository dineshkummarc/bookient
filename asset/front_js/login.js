function openLogInForm(bTime){

	var btimeData = {bTime:bTime};
	$.ajax({
		  url: SITE_URL+"page/chkLoginIcon",
		  type: "post",
		  data :btimeData,
		  dataType: "json",
		  success: function(result){ 

			if(result.res){
			 bTime = result.bTime;
	
			str='';
			str+='<div id="login_panel"  class="hide_all">';
			str+='<div class="logintabs">';
			str += result.html;
			str+='</div>';
			str+='<div class="allLoginText">';

			str+='<div id="tab1">';
			str+='<form id="form_login" class="styled" method="post">';
			str+='<fieldset>';
			str+='<ol>';
			str+='<li class="form-row">';
			str+='<div id="msg_t"></div>';
			str+='</li >';
			//str+='<li class="form-row"><label>User Name:</label>';
            str+='<li class="form-row"><div class="input-prepend"><span class="add-on">'+pLang['email']+'</span>';
			str+='<input name="user_name" id="user_name" type="text" class="text-input span4 required email" />';
			str+='</div></li>';
			str+='<li class="form-row"><div class="input-prepend"><span class="add-on">'+pLang['password']+'</span>';
			str+='<input name="password" type="password" id="password" class="text-input span4 required password" />';
			str+='</div></li>';
			str+='<li >';
			str+='<div id="invalid_login" style="color:#990000" class="red" align="center"></div>';
			str+='</li>';
			str+='<li class="form-row">';
			str+='<input type="checkbox" name="remember" id="remember" checked="true" /> '+pLang['remember_me'];
			str+='</li>';
			str+='<li style="text-align:right;">';
			str+='<input type="button" value="'+pLang['signIn']+'" onclick="LogInModal('+bTime+');" class="btn-gray-popup" style="margin-right:10px" />';
			str+='<span id="cancel_btn_id">';
			str+='<input type="button" name="cancel_login_modal" id="cancel_login_modal" value="'+pLang['cancel']+'" onclick="pr_popup_close();" class="btn-gray-popup"/>';
			str+='</span>';
			str+='</li>';
			str+='<li>';
			str+='<input type="button" name="click2" value="'+pLang['fPass']+'" onclick="show_forgotpassword_panel();" class="link-button">'; 
			str+='&nbsp;|&nbsp;'+pLang['firstLang']+' <input type="button" name="click2" value="'+pLang['claickHere']+'" onclick="show_registration_panel('+bTime+');" class="link-button">';
			str+='</li>';
			str+='<div class="clearfix"></div></ol>';
			str+='</fieldset>';
			str+='</form>';
			str+='</div>';


			str+='<div id="tab2">'; 
			str+='<span class="header-txt-fb">'+pLang['faceBookCunnect']+'<br/>';
			str+='<span class="userHelp">'+pLang['faceBookDetails']+' </span>';
			str+='</span>';
			str+='<span class="socialBt">'; 
			//str+='<input type="button" class="fb-button" value="" onclick="redirect_fb('+bTime+');"  />';
			str+='<input type="button" class="fb-button" id="fbButtonh" value="" onclick="FB.login();"  />';
			str+='</span>';
			str+='<input type="hidden"  id="fbDateHolder" value="'+bTime+'"/>';
			str+='<span class="loginbelowmsg"> '+pLang['facePopDetails']+'</span>';
			str+='</div>';


			str+='<div id="tab3">';
			str+='<form name="sub_google" action="" method="post">'; 
			str+='<input type="hidden" name="auth" value="google" />';
			str+='<span class="header-txt-fb">'+pLang['googleCunnect']+'</span>'; 
			str+='<br/>';
			str+='<span class="userHelp"> '+pLang['faceBookDetails']+'</span>';
			str+='<span class="socialBt" style="position:relative;">';
			str+='<img src="'+img_url()+'front_image/google-small.png" style="position:absolute;top:17px;left:2px;" height="24" width="24" />'; 
			str+='<input type="button" name="submit_google" id="submit_google" value="'+pLang['googleLog']+'" class="btn-gray-popup" style="padding:5px 28px;" onclick="redirect_google('+bTime+');" />'; 
			str+='</span>';
			str+='<span class="loginbelowmsg">'+pLang['googlePopDetails']+' </span>';
			str+='</form>'; 
			str+='</div>';     
			str+='</div>';
			str+='</div>';
			str+='</div>';
			
			
			str+='<div id="forgot-password_panel" style="display:none" class="hide_all">';
			str+='<div class="forgot-password-div">';
			str+='<h2 class="text-center"></h2>';
			str+='<form id="form-for_pass" class="styled" action="" method="">';
			str+='<fieldset>';
			str+='<h5 style="font-size:14px;color: #3366FF; font-weight: bold; font-family:Verdana, Geneva, sans-serif">'+pLang['fPass']+'</h5>';
			str+='<ol>';
			str+='<li class="form-row" id="msg_forgot">';
			str+='</li>';
			str+='</ol>';
			
			str+='<ol id="forgot_cont">';
			str+='<li class="form-row">';
			str+='<div class="input-prepend"><span class="add-on">'+pLang['email']+'</span>';
			str+='<input name="user_email" id="user_email_f" type="text" class="text-input span4 required email" />';
			str+='</div>';
			str+='</li>';
			str+='<li class="form-row">';
			str+='<div id="invalid_login" style="color:#990000" class="red" align="center"></div>';
			str+='</li>';
			str+='<li class="button-row">';
			str+='&nbsp;';
			str+='<input type="button" onclick="user_forgot_back()" class="btn-gray-popup" value="Back"/>';
			str+='&nbsp;';
			str+='<input type="button" id="ss" value="'+pLang['mobile_submit']+'" class="btn-gray-popup" onclick="forgot_password();" />';
			str+='</li>';
			str+='</ol>';
			str+='</fieldset>';
			str+='</form>';		
			str+='</div>';

			$('#front_popup_content').html(str);
			logintab('tab1',bTime);	 
					 }
			      }  
    });

}

function user_forgot_back(){
    $('#forgot-password_panel').hide();  
    $('#login_panel').show();  
}

function logintab(tab,bTime){

	if(tab=='tab1'){
		$('#tab1').show();
		$('#tab2').hide();
		$('#tab3').hide();
	}
	if(tab=='tab2'){
		$('#tab1').hide();
		$('#tab2').show();
		$('#tab3').hide();
	}
	if(tab=='tab3'){
		$('#tab1').hide();
		$('#tab2').hide();
		$('#tab3').show();
	}

		//////////////cookie start//////////////
		var remember = $.cookie('remember');
        if (remember == 'true'){
            var email = $.cookie('email');
            var password = $.cookie('password');
            // autofill the fields
            $('#user_name').val(email);
            $('#password').val(password);
        }
		//////////////cookie end/////////////////

	document.onkeypress = function(evt) {
    evt = evt || window.event;
    var charCode = evt.which || evt.keyCode;
    if (charCode == 13) {
        LogInModal(bTime);
		return false;
    }
};
	
}

function OpenBoxLogin(){
		pr_popup(500);
		$('#front_popup_content').html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/></center>');
		openLogInForm();
}
/***********************************************************************************************************/
function newRegistration(){
    $.ajax({
            url: SITE_URL+"page/customer_registration",
               type: "post",
               success: function(result){
                    pr_popup(550);
                    $('#front_popup_content').html(result);
                    check_new_reg_form();
                    }   
          })
}

function check_new_reg_form(){
	//$(".registration-div").niceScroll({styler:"fb",cursorcolor:"#000"});
    $('#cus_countryid_5').change(function(){
        var cuntry_id = $(this).val();
         $.ajax({
            url: SITE_URL+"page/region",
            data:{country_id:cuntry_id},
            type: "post",
            success: function(result){
                $('#nw_region_span').html(result);
                check_new_region_form()
                 }   
          })
    })
$('#user_email').blur(function(){
	var userEmail = $.trim($('#user_email').val());
	var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	if(emailexp.test(userEmail)){
		$.ajax({
        type: 'POST',
        url: SITE_URL+"page/checkingEmail",
        data: {'userEmail':userEmail },
        success: function(dupliUser){
            if($.trim(dupliUser) == 'false'){
				$('#user_email').next().find('br').remove();
				$('#user_email').next().children('span').remove();                         
				$('#user_email').next().append('<br/><span style="color:#FF0000;font-size:10px;">'+pLang['existsPassword']+'<span>');           
            }
			}
		})
	}else{
		if(userEmail !=''){
			$('#user_email').next().find('br').remove();
        	$('#user_email').next().children('span').remove();                         
        	$('#user_email').next().append('<br/><span style="color:#FF0000;font-size:10px;">'+pLang['invalidEmail']+'<span>');
		} 
	}
})   
}

function check_new_region_form(){
    $('#cus_regionid_6').change(function(){
        var reg_id = $(this).val();
         $.ajax({
            url: SITE_URL+"page/city",
            data:{region_id:reg_id},
            type: "post",
            success: function(result){
                $('#nw_city_span').html(result);
                 }   
          })
    })
}

function LogInModal(bTime){
	var $formId = $('#form_login');
	var formAction = $formId.attr('action');
	var $error = $('<span class="error"></span>');
        
        var user_email=$('#user_name').val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
	
	$('.required').focus(function(){
		var $parent = $(this).parent();
		$parent.removeClass('error');
		$('span.error',$parent).fadeOut();
	});
	
	$('li',$formId).removeClass('error');
	$('span.error').remove();							 
	$('.required',$formId).each(function(){
		var inputVal = $(this).val();
		var $parentTag = $(this).parent();
		if(inputVal == ''){
			//$parentTag.addClass('error').append($error.clone().text('Required Field'));
                        $parentTag.append($error.clone().text('Required Field'));
		}
                if($(this).attr('id') == 'user_name') {
                    if (emailReg.test(user_email) == false) {
                        var $parentTag = $(this).parent();
                        $parentTag.append($error.clone().text('Invalid Email'));
                    }
                }
	});	
	
	if($('span.error').length > 0) {
			$('span.error').each(function(){
				var distance = 5;
				var width = $(this).outerWidth();
				var start = width + distance;
				$(this).show().css({
					display: 'block',
					opacity: 0
					//right: -start+'px'
				})
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
			});
	}else{
		////////////cookes start///////////
        if ($('#remember').is(':checked')) {
            var email = $('#user_name').val();
            var password = $('#password').val();

            // set cookies to expire in 14 days
            $.cookie('email', email, { expires: 14 });
            $.cookie('password', password, { expires: 14 });
            $.cookie('remember', true, { expires: 14 });                
        }else{
            // reset cookies 
            $.cookie('email', null);
            $.cookie('password', null);
            $.cookie('remember', null);
        }
			/////////////cookes end//////////////
		var frmID = '#form_login';
		var params ={ 'action' : 'save' };
		var paramsObj = $(frmID).serializeArray();
		$.each(paramsObj, function(i, field){
			params[field.name] = field.value;
		});
		//add by palash start
		if(bTime != ''){
			params['bTime'] 	= bTime;
			params['staffArr'] 	= get_staff();
			params['srvArr'] 	= get_service();
		}
		//add by palash end
		$.ajax({
        type: 'POST',
        url: SITE_URL+"customer/customer_login/CustomerLogInAjax",
        data: params,
        success: function(data){
                if(data !=0){
                    window.location.reload(); 
                }else{  
                    $('#msg_t').html('<label style="color:red;width:166px;">'+pLang['authentication_Failed']+'</label>');
                }
            }
        });
	}
}

function redirect_fb(bTime){
	//add by palash start
	if(bTime != ''){
		var params ={ 'action' : 'fb' };
		params['bTime'] 	= bTime;
		params['staffArr'] 	= get_staff();
		params['srvArr'] 	= get_service();
	}
	//add by palash end
	$.ajax({
	      url: SITE_URL+"customer/customer_login/fn_facebook",
		  data:params,
	      type: "post",
	      success: function(result){
		  		window.location.href=result;
		  }  	
	 });
}

function redirect_google(bTime){
	//add by palash start
	$('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/></center>').insertAfter('#submit_google');
	$("#submit_google").remove();
	if(bTime != ''){
	var params ={ 'action' : 'google' };
	params['bTime'] 	= bTime;
	params['staffArr'] 	= get_staff();
	params['srvArr'] 	= get_service();
	}
	//add by palash end
    $.ajax({
	    url: SITE_URL+"customer/customer_login/fn_google",
	    data:params,
	    type: "post",
	    success: function(result){
		     window.location.href=result;
		  }  	
	 });
}

function show_forgotpassword_panel(){

   // $('.hide_all').hide();
    $('#login_panel').hide();
	$('p').hide();
	$('#forgot-password_panel').show();  
}

function forgot_password(){  
    
	   $('#msg_err_forgot_pass').html("");
	    $('#msg_det').html("");
	var user_name=$('#user_name_f').val();
	var user_email=$('#user_email_f').val();
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	
	
	var $error = $('<span class="error"></span>');
	//alert(user_email);
	$formId = '#form-for_pass';
	$('li',$formId).removeClass('error');
		$('span.error').remove();

		// Validate all inputs with the class "required"
		$('.required',$formId).each(function(){
			var inputVal = $(this).val();
			var $parentTag = $(this).parent();
			
			if(inputVal == ''){
				//$parentTag.addClass('error').append($error.clone().text('Required Field'));
                                $parentTag.append($error.clone().text('Required Field'));
			}
			//email validation
			/* ------------ */
			if($(this).attr('id') == 'user_email_f') {
			   //alert('hello');
			   if (emailReg.test(user_email) == false) {
			    var $parentTag = $(this).parent();
		        $parentTag.append($error.clone().text('Invalid Email'));
			   }
			
			}
		   /* ------------ */
			// Run the email validation using the regex for those input items also having class "email"
			
		});	
		
		
		if ($('span.error').length > 0) {
			
			$('span.error').each(function(){
				
				// Set the distance for the error animation
				var distance = 5;
				
				// Get the error dimensions
				var width = $(this).outerWidth();
				
				// Calculate starting position
				var start = width + distance;
				
				// Set the initial CSS
				$(this).show().css({
					display: 'block',
					opacity: 0,
					right: -start+'px'
				})
				// Animate the error message
				.animate({
					right: -width+'px',
					opacity: 1
				}, 'slow');
				
			});
		}else{
	lightbox('dynamic_popup_id');
	$.ajax({
		type: 'POST',
		datatype:'html',
		url: SITE_URL+"customer/forgot_password/ForgotPasswordAjax",
		data: { 'user_email': user_email },
		dataType: "json",
		success:function(rdata){ 
			closeLightbox();
			$("#msg_forgot").html(rdata.msg);
			if(rdata.html !=''){
				$("#forgot_cont").html(rdata.html);
				resetAfterCall();
			}
		}
	});
   }
}

function resetAfterCall(){
	$("#f_password").blur(function(){
		var f_password	=$("#f_password").val();
		if (f_password == '') {
			$("#f_password").attr('style','background-color:#f4e6e6; border:1px solid red;');
		}else{
			$("#f_password").removeAttr('style');
		}
	})
	$("#f_nwPassword").blur(function(){
		var f_nwPassword	=$("#f_nwPassword").val();
		if (f_nwPassword == '') {
			$("#f_nwPassword").attr('style','background-color:#f4e6e6; border:1px solid red;');
		}else{
			$("#f_nwPassword").removeAttr('style');
		}
	})
	$("#f_re_nwPassword").blur(function(){
		var f_re_nwPassword	=$("#f_re_nwPassword").val();
		if (f_re_nwPassword == '') {
			$("#f_re_nwPassword").attr('style','background-color:#f4e6e6; border:1px solid red;');
		}else{
			$("#f_re_nwPassword").removeAttr('style');
		}
	})
	$("#f_re_nwPassword").blur(function(){
		var f_nwPassword	=$("#f_nwPassword").val();
		var f_re_nwPassword	=$("#f_re_nwPassword").val();
		if (f_re_nwPassword != f_nwPassword) {
			$("#f_re_nwPassword").attr('style','background-color:#f4e6e6; border:1px solid red;');
		}else{
			$("#f_re_nwPassword").removeAttr('style');
		}
	})
}

function customerForgotPass(){
	var error=0;
	var f_password	=$("#f_password").val();
	if (f_password == '') {
		$("#f_password").attr('style','background-color:#f4e6e6; border:1px solid red;');
		error++;
	}
	var f_nwPassword	=$("#f_nwPassword").val();
	if (f_nwPassword == '') {
		$("#f_nwPassword").attr('style','background-color:#f4e6e6; border:1px solid red;');
		error++;
	}
	var f_re_nwPassword	=$("#f_re_nwPassword").val();
	if (f_re_nwPassword == '') {
		$("#f_re_nwPassword").attr('style','background-color:#f4e6e6; border:1px solid red;');
		error++;
	}
	if (f_re_nwPassword != f_nwPassword) {
		$("#f_re_nwPassword").attr('style','background-color:#f4e6e6; border:1px solid red;');
		error++;
	}
	if(error == 0){
		lightbox('dynamic_popup_id');
		$.ajax({
		   type: 'POST',
		   url: SITE_URL+"customer/forgot_password/changePasswoed",
		   dataType: "json",
		   data: {'f_password': f_password, 'f_nwPassword': f_nwPassword},
		   success: function(rdata){ 
		   		closeLightbox();
			    if(rdata.type==1){
			    	pr_popup_close();
					OpenBoxLogin();
				}else if(rdata.type==2){
					$('#forgot_cont').html(rdata.msg);
				}	
			}
		});
	}
}


function show_registration_panel(bTime){
    $.ajax({
       url: SITE_URL+"page/customer_registration",
       type: "post",
	   data:{bTime:bTime},
       success: function(result){
    $('#front_popup_content').html(result);
    }   
  })
}

function OpenBoxReg(){
    pr_popup(500);
    $('#front_popup_content').html(openLogInForm());
    $('#registration_panel').show();
    $('#login_panel').hide();
    $('#forgot-password_panel').hide();
}

function show_login_panel(){
    $('#registration_panel').hide();
    $('#login_panel').show();
    $('#forgot-password_panel').hide();
    logintab('tab1');
}

function SubmitRegDataModal(bTime){
	
    var dupli_user = 0;
    var res = [];
    var url = document.location.href; 
    res = url.split("/");
    var ad_name = res[2].split(".");
	var ppCount =0;
    var errorcode = 0;
    if($.trim($('#cus_fname_2').val())==''){
            $('#cus_fname_2').next().find('br').remove();
            $('#cus_fname_2').next().children('span').remove();                         
            $('#cus_fname_2').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =1;
    }
    
	if($.trim($('#cus_lname_3').val())==''){
            $('#cus_lname_3').next().find('br').remove();
            $('#cus_lname_3').next().children('span').remove();                         
            $('#cus_lname_3').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =2;
    }
   
    if($.trim($('#user_email').val())==''){
            $('#user_email').next().find('br').remove();
            $('#user_email').next().children('span').remove();                         
            $('#user_email').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =3;
    }
	
	if($.trim($('#cus_mob_9').val())==''){
            $('#cus_mob_9').next().find('br').remove();
            $('#cus_mob_9').next().children('span').remove();                         
            $('#cus_mob_9').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =4;
    }
    
    
	if($.trim($('#ori_pass_reg').val())==''){                          
            $('#ori_pass_reg').next().find('br').remove();
            $('#ori_pass_reg').next().children('span').remove();                         
            $('#ori_pass_reg').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =6;
    }
    
	if($.trim($('#conf_pass_reg').val())==''){                          
            $('#conf_pass_reg').next().find('br').remove();
            $('#conf_pass_reg').next().children('span').remove();                         
            $('#conf_pass_reg').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =7;
    }

    if($('#cus_countryid_5').val()==''){                          
            $('#modalBox #cus_countryid_5').next().find('br').remove();
            $('#modalBox #cus_countryid_5').next().children('span').remove();                         
            $('#modalBox #cus_countryid_5').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =8;
    }
   
    if($('#cus_regionid_6').val()==''){                          
            $('#cus_regionid_6').next().find('br').remove();
            $('#cus_regionid_6').next().children('span').remove();                         
            $('#cus_regionid_6').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
            errorcode++; ppCount =9;
    }
    
    if($('#cus_cityid_7').val()==''){                          
        $('#cus_cityid_7').next().find('br').remove();
        $('#cus_cityid_7').next().children('span').remove();                         
        $('#cus_cityid_7').next().append('<br/><span style="color:#FF0000;font-size:10px;">Required Field<span>');           
        errorcode++; ppCount =10;
    }

    //var charexp = /^[a-zA-Z ]+$/;
    var charexp = /^[a-zA-Z䶥ĶŠ]+$/;
    if(!charexp.test($('#cus_fname_2').val())){
            //$('#modalBox #cus_fname_div').html('Only characters are allowed.');
            $('#cus_fname_2').next().find('br').remove();
            $('#cus_fname_2').next().find('span').remove();
            $('#cus_fname_2').next().append('<br/><span style="color:#FF0000;font-size:10px;">Only characters are allowed.<span>'); 
            errorcode++; ppCount =11;
    }        
    
    if(!charexp.test($('#cus_lname_3').val())){			
        $('#cus_lname_3').next().find('br').remove();
        $('#cus_lname_3').next().children('span').remove();                         
        $('#cus_lname_3').next().append('<br/><span style="color:#FF0000;font-size:10px;">Only characters are allowed.<span>');           
        errorcode++; ppCount =12;			
            }
   
    if($.trim($('#cus_mob_9').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_mob_9').val())) {
                $('#cus_mob_9').next().find('br').remove();
                $('#cus_mob_9').next().children('span').remove();   
                $('#cus_mob_9').next().append('<br/><span style="color:#FF0000;font-size:10px;">Mobile has to be Numeric.<span>');           
            errorcode++;   ppCount =13;                      

            }                   
    }
   
    if($.trim($('#cus_phn1_10').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn1_10').val())) {
                $('#cus_phn1_10').next().find('br').remove();
                $('#cus_phn1_10').next().children('span').remove();   
                $('#cus_phn1_10').next().append('<br/><span style="color:#FF0000;font-size:10px;">Phone Number has to be Numeric.<span>');      
            errorcode++; ppCount =14;
            }                   
    }
   
    if($.trim($('#cus_phn2_11').val())!=''){
            var numexp = /^[0-9]+$/;
            if(!numexp.test($('#cus_phn2_11').val())){
                $('#cus_phn2_11').next().find('br').remove();
                $('#cus_phn2_11').next().children('span').remove();   
                $('#cus_phn2_11').next().append('<br/><span style="color:#FF0000;font-size:10px;">Phone Number has to be Numeric.<span>');      
            	errorcode++; ppCount =15;
            }                   
    }
    
    if($.trim($('#cus_zip_8').val())!=''){
        var numexp = /^[0-9]+$/;
        if(!numexp.test($('#cus_zip_8').val())){                             
            $('#cus_zip_8').next().find('br').remove();
            $('#cus_zip_8').next().children('span').remove();   
            $('#cus_zip_8').next().append('<br/><span style="color:#FF0000;font-size:10px;">Zip has to be Numeric.<span>');           
        errorcode++;   ppCount =16;                     
            }                   
    }

    var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
    if(!emailexp.test($('#user_email').val())){                    
        $('#user_email').next().find('br').remove();
        $('#user_email').next().children('span').remove();                         
        $('#user_email').next().append('<br/><span style="color:#FF0000;font-size:10px;">Invalid Email Format.<span>');           
        errorcode++; ppCount =17;                  
    } 
       
    var pass_length = $("#ori_pass_reg").val().length;
    if (pass_length < 6) {
        $('#ori_pass_reg').next().find('br').remove();
        $('#ori_pass_reg').next().children('span').remove();                         
        $('#ori_pass_reg').next().append('<br/><span style="color:#FF0000;font-size:10px;">Password must have atleast 6 characters.<span>');    
        errorcode++; ppCount =18;
    }
    
    if($.trim($('#conf_pass_reg').val()) != $.trim($('#ori_pass_reg').val())){                          
        $('#conf_pass_reg').next().find('br').remove();
        $('#conf_pass_reg').next().children('span').remove();                         
        $('#conf_pass_reg').next().append('<br/><span style="color:#FF0000;font-size:10px;">Confirm Password does not match.<span>');           
        errorcode++; ppCount =19;			
    } 

    if(errorcode > 0){
       return false; 
    }
	var userEmail = $.trim($('#user_email').val());
	         
    $.ajax({
        type: 'POST',
        url: SITE_URL+"page/checkingEmail",
        data: {'userEmail':userEmail },
        success: function(dupliUser){
            if($.trim(dupliUser) == 'false'){
				$('#user_email').next().find('br').remove();
				$('#user_email').next().children('span').remove();                         
				$('#user_email').next().append('<br/><span style="color:#FF0000;font-size:10px;">'+pLang['existEmail']+'<span>');           
				errorcode++;
				return false;
            }else {

                if(errorcode == 0) {
                      var frmID = '#cus_reg';
                      var params ={ 'action' : 'save' };
                      var paramsObj = $(frmID).serializeArray();
                      $.each(paramsObj, function(i, field){
                              params[field.name] = field.value;
                              //alert(field.value);
                      });
					  //add by palash start
						if(bTime != ''){
							params['bTime'] 	= bTime;
							params['staffArr'] 	= get_staff();
							params['srvArr'] 	= get_service();
						}
					 //add by palash end
					  pr_popup(350);
					  $(".btn_close").remove();
					  $("#front_popup_content").html('<center><img border="0" src="'+img_url()+'front_image/small_loader.gif"/><br><lable style="color:#0000FF;font-size:20px;font-weight:bold;">'+pLang['registering']+'....<lable></center>');
                      $.ajax({
                         type: 'POST',
                         url: SITE_URL+"customer/customer_registration/SaveRegistrationAjax",
                         data: params,
                         success: function(data){
						 	if(data == 1){
							//	pr_popup_close_bt()
							}else{
							$("#front_popup_content").html('<center><lable style="color:#196C19;font-size:20px;font-weight:bold;">'+data+'</lable><br><br><br><a href="javascript:void(0);" style="float: right;font-style:	italic;color:#FF0000" onclick="pr_popup_close_bt()"> '+pLang['click_here_continue']+'...</a></center>');	
							}
                         }
                      });
                 }
             }
        }
     });
}

function clr_reg_values(obe8){           
    $(obe8).next().children('span').remove();          
    //$(obe8).next().next('span').html('');	 
}

/*****************************************************************************************************************/
/*$(document).ready(function(){
$(".btn").click(function(){
	$(".nav-collpas").toggle();
	alert('palash')
})
})*/