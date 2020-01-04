<script type="text/JavaScript">
    $(document).ready(function () {
        $('input[name="user_name"]').blur(function () {
                var userName = $.trim($('input[name="user_name"]').val());
				var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
				var splChr = 0;
				for (var i = 0; i < $('input[name="user_name"]').val().length; i++) {
					if (iChars.indexOf($('input[name="user_name"]').val().charAt(i)) != -1) {
						splChr++;
					}
				}              
                if (userName == '' || splChr !=0 || userName == 'www' || userName == 'admin' || userName == 'register' || userName == 'pardco'
												 || userName == 'dev' || userName == 'test' || userName == 'testi') {
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
			
		$('input[name="email"]').blur(function () {
                var emailexp = /^[_+.a-z0-9-+]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
                var email = $.trim($('input[name="email"]').val());
                if (email == '' || !emailexp.test(email)) {
                    $('input[name="email"]').addClass('text-input-red');
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

        $('#btn-submit-register').click(function () {
            var pathname = window.location.href.split( '//' );
            var error = 0;
            var other_profession = '';
            var userName = $.trim($('input[name="user_name"]').val());
            var email = $.trim($('input[name="email"]').val());
            var emailexp = /^[_+.a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
            var password1 = $.trim($('input[name="password1"]').val());
            var password2 = $.trim($('input[name="password2"]').val());
            var firstname = $.trim($('input[name="firstname"]').val());
            var lastname = $.trim($('input[name="lastname"]').val());
            var profession = $('select[name="profession"] option:selected').val();
            var country = $('select[name="country"] option:selected').val();

			var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";
			var splChr = 0;
			
			for (var i = 0; i < userName.length; i++) {
				/*if (iChars.indexOf(userName.val().charAt(i)) != -1) {
					splChr++;
				}*/
				
				if (iChars.indexOf(userName.charAt(i)) != -1) {
					splChr++;
				}
			}


            if (userName == '' || splChr !=0 || userName == 'www' || userName == 'admin' || userName == 'register' || userName == 'pardco'
											 || userName == 'dev' || userName == 'test' || userName == 'testi') {
                $('input[name="user_name"]').removeClass('text-input');
                $('input[name="user_name"]').addClass('text-input-red');
                error++;
            }
            if (email == '' || !emailexp.test(email)) {
                $('input[name="email"]').removeClass('text-input');
                $('input[name="email"]').addClass('text-input-red');
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
            	other_profession = $("#other_profession").val();
            	other_profession = $.trim(other_profession);
            	if(other_profession == ''){
            		if($("#other_profession").is(":visible") ){
            			$('#other_profession').addClass('text-input-red');
                		error++;
            		}else{
						$('#profession').addClass('text-input-red');
						error++;
					}
				
				}
            	
            }else{
				$("#other_profession").removeClass('text-input-red');
				$("#other_li").css('display','none');
				
				
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
                                        if(profession == ''){
											profession = $("#other_profession").val();
											
										}
										//lightbox_body();
                                        $.ajax({
                                            type: "post",
                                            url: SITE_URL + "registration/adminRegistration",
                                            data: { 'user_name': userName, 'firstname': firstname, 'lastname': lastname, 'password1': password1, 'email': email, 'profession': profession, 'country': country },
                                            success: function (result) {
                                                if (result == 1) {
                                                	//closeLightbox_body();
                                                    //$('#status_'+serviceId).html('Appointment cancelled successfully');
                                                    window.location.href = 'http://' + userName + '.' + pathname[1] + 'admin/login';
                                                  
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
        // Fade out error message when input field gains focus
		
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
        
        
        $("#otherbtn_prof").click(function(){
        	$('select[name^="profession"] option:selected').attr("selected",null);
        	$("#other_profession").val('');
	    	$("#other_li").toggle();
    	});
        
        
        
        
    });
    
    
    
</script>