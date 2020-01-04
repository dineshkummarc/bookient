function addLocation(){
		lightbox_body('TopBlockDiv'); 
		$.ajax({
			url: SITE_URL+"page/fn_checkLogInAdmin",
			type: "post",
			success: function(result){
			//check login start
				if(result == 0){
					window.location.href = SITE_URL+'admin/login';
				}else{
					$.ajax({
						url: SITE_URL+"admin/addlocation/fn_addlocation",
						type: "post",
						success: function(result){
						//check login start
							//alert(result);
							closeLightbox_body();
							pr_popup(450);
							$('#front_popup_content').html(result);
							addLocationCallBack();
						//check login end
						}  
					});
				}
			//check login end
			}  
		});
		
	}
	
function addLocationCallBack(){
	$('input[name="user_name"]').blur(function () {
                var userName = $.trim($('input[name="user_name"]').val());
                if (userName == '') {
                    $('input[name="user_name"]').addClass('text-input-red');
                    $(this).removeClass('text-input');
                } else {
                    $.ajax({
                        url: SITE_URL + "registration/check_user_name_ajax",
                        type: "post",
                        data: { "uname": userName },
                        success: function (res) { 
                            if (res > 0) {
                                var msg = '<font color="red">Username already exists</font>';
                                $("#userErr").html(msg);
                            } else {
                                $("#userErr").html('');
                            }
                        }
                    });
                }
            })

	$('input[name="register-email"]').blur(function () {
                var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
                var email = $.trim($('input[name="register-email"]').val());
                if (email == '' || !emailexp.test(email)) {
                    $('input[name="register-email"]').addClass('text-input-red');
                    $(this).removeClass('text-input');
                } else {
                    $.ajax({
                        url: SITE_URL + "registration/checkEmailAjax",
                        type: "post",
                        data: { "email": email },
                        success: function (res) {
                            if (res > 0) {
                                var msg = '<font color="red">Email already exists</font>';
                                $("#err").html(msg);
                            } else {
                                $("#err").html('');
                            }
                        }
                    });
                }
            })

	$('.required').each(function () {
            //var attrVal = $(this).attr("name");
            $('input[name="password1"]').blur(function () {
                var password1 = $.trim($('input[name="password1"]').val());
                if (password1 == '') {
                    $('input[name="password1"]').addClass('text-input-red');
                    $(this).removeClass('text-input');
                }
            })

            $('input[name="password2"]').blur(function () {
                var password2 = $.trim($('input[name="password2"]').val());
                var password = $.trim($('input[name="password1"]').val());
                if (password2 != password || password2 == '') {
                    $('input[name="password2"]').addClass('text-input-red');
                    $(this).removeClass('text-input');
                }
            })

            $('input[name="firstname"]').blur(function () {
                var firstname = $.trim($('input[name="firstname"]').val());
                if (firstname == '') {
                    $('input[name="firstname"]').addClass('text-input-red');
                    $(this).removeClass('text-input');
                }
            })

            $('input[name="lastname"]').blur(function () {
                var lastname = $.trim($('input[name="lastname"]').val());
                if (lastname == '') {
                    $('input[name="lastname"]').addClass('text-input-red');
                    $(this).removeClass('text-input');
                }
            })

            $('#profession').blur(function () {
                var profession = $('select[name="profession"] option:selected').val();
                if (profession == '') {
                    $('#profession').addClass('text-input-red');
                    
                }
            })

            $('#country').blur(function () {
                var country = $('select[name="country"] option:selected').val();
                if (country == '') {
                    $('#country').addClass('text-input-red');
                    ;
                }
            })
        })

	$('.text-input').focus(function () {
		$(this).removeClass('text-input-red');
		$(this).addClass('text-input');
	});
	$('#profession').focus(function () {
				$(this).removeClass('text-input-red');
	});
	$('#country').focus(function () {
				$(this).removeClass('text-input-red');
	});
			
	 $('#btn-submit-register').click(function () {
	 		
            var pathname = window.location.href.split( '.' );
            var error = 0;
            var userName = $.trim($('input[name="user_name"]').val());
            var email = $.trim($('input[name="register-email"]').val());
            var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
            var password1 = $.trim($('input[name="password1"]').val());
            var password2 = $.trim($('input[name="password2"]').val());
            var firstname = $.trim($('input[name="firstname"]').val());
            var lastname = $.trim($('input[name="lastname"]').val());
            var profession = $('select[name="profession"] option:selected').val();
            var country = $('select[name="country"] option:selected').val();
			var localadmin_id = $.trim($('#localAdmin').val());

            if (userName == '') {
                $('input[name="user_name"]').removeClass('text-input');
                $('input[name="user_name"]').addClass('text-input-red');
                error++;
            }
            if (email == '' || !emailexp.test(email)) {
                $('input[name="register-email"]').removeClass('text-input');
                $('input[name="register-email"]').addClass('text-input-red');
                error++;
            }
            if (password1 == '') {
                $('input[name="password1"]').removeClass('text-input');
                $('input[name="password1"]').addClass('text-input-red');
                error++;
            }
            if (password2 != password1 || password2 == '') {
                $('input[name="password2"]').removeClass('text-input');
                $('input[name="password2"]').addClass('text-input-red');
                error++;
            }
            if (firstname == '') {
                $('input[name="firstname"]').removeClass('text-input');
                $('input[name="firstname"]').addClass('text-input-red');
                error++;
            }
            if (lastname == '') {
                $('input[name="lastname"]').removeClass('text-input');
                $('input[name="lastname"]').addClass('text-input-red');
                error++;
            }
            if (profession == '') {
                $('#profession').addClass('text-input-red');
                error++;
            }
            if (country == '') {
                $('#country').addClass('text-input-red');
                error++;
            }
            if (error == 0) {
                $.ajax({ 
                    url: SITE_URL + "registration/check_user_name_ajax",
                    type: "post",
                    data: { "uname": userName },
                    success: function (res) {
                        if (res > 0) {
                            var msg = '<font color="red">Username already exists</font>';
                            $("#userErr").html(msg);
                        } else {
                            $.ajax({
                                url: SITE_URL + "registration/checkEmailAjax",
                                type: "post",
                                data: { "email": email },
                                success: function (res) {
                                    if (res > 0) {
                                        var msg = '<font color="red">Email already exists</font>';
                                        $("#err").html(msg);
                                    } else {
                                        /************************************************/
                                        $('.button-row').html('');
										$('.button-row').html('<img id="prbookImgLoder" height="25px" src="'+SITE_URL+'asset/wait_a_min.gif"/>');
                                        $.ajax({
                                            type: "post",
                                            url: SITE_URL + "registration/adminRegistration",
                                            data: { 'user_name': userName, 'firstname': firstname, 'lastname': lastname, 'password1': password1, 'email': email, 'profession': profession, 'country': country, 'admin_id': localadmin_id },
                                            success: function (result) {
                                                if (result == 1) {
                                                     window.location.href = 'http://' + userName + '.' + pathname[1] + '.com/admin/login';
                                                    
                                                }
                                            }
                                        })
                                        /************************************************/
                                    }
                                }
                            });
                        }
                    }
                });
            }
        });
}

function goToMemberShip(){
	window.location = SITE_URL+"admin/membership ";
}

function goToSubPage(localid){
	lightbox_body();
	$.ajax({
		type: 'POST',
		data: {'localid':localid},
		url:BASE_URL+"/page/gotolocaladmin",
		success:function(datas){
			closeLightbox_body();
			window.location=datas;
		}
	});	
}