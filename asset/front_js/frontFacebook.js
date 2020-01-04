window.fbAsyncInit = function() {
  FB.init({
    appId      : '444272075674092',
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  });


  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') {
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
      FB.login();
    } else {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 
  function testAPI() {
	$('.socialBt').html('<img src="'+SITE_URL+'/asset/wait_a_min.gif"/>');
	$('.btn_close').hide();
	
    FB.api('/me', function(response) {
	//	params['first_name'] 	= response.first_name;
	//	params['last_name'] 	= response.last_name;
	if($('#customerLoginId').val() == 0){

		var user_nm = response.username;
		$.ajax({
		  url: SITE_URL+"customer/customer_login/Other_fn",
		  data:{fbuid : user_nm},
		  type: "post",
		  success: function(result){
		  	if(result == 0){
				str='<ol>';
				str+='<li class="form-row"><div class="input-prepend"><span class="add-on">'+pLang['email']+'</span>';
				str+='<input name="user_name_fb" id="user_name_fb" type="text" class="text-input span4 required email" />';
				str+='</div></li>';
				str+='<li><input type="button" value="  GO  " onclick="facebooklogin_nnw(\''+response.first_name+'\',\''+response.last_name+'\',\''+response.username+'\');" class="btn-gray-popup" style="margin-right:-247px"></li>';
				str+='</ol>';
		$('.socialBt').html(str);
			}else{
				facebooklogin_now(response.first_name,response.last_name,response.username);
			}
		  }  	
		});
		}
	});
	
  }

	function facebooklogin_nnw(fname,lname,username){
  	var params ={ 'action' : 'fb' };
  	var email = $('#user_name_fb').val();
	var emailexp = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/;
	if (!emailexp.test(email) || email==''){
		$("#user_name_fb").attr('style','border: 1px solid #FF0000; background: #E9C5C5 !important;');
	}else{
		params['email'] = email;
		params['first_name'] 	= fname;
		params['last_name'] 	= lname;
		params['username'] 		= username;
		//add by palash start
		var bTime = $('#fbDateHolder').val();
		if(bTime != ''){
			params['bTime'] 	= bTime;
			params['staffArr'] 	= get_staff();
			params['srvArr'] 	= get_service();
		}
	//	console.log(params);
		//add by palash end
		$.ajax({
		      url: SITE_URL+"customer/customer_login/fn_facebook",
			  data:params,
		      type: "post",
		      success: function(result){
			  		window.location.href=SITE_URL;
			  }  	
		 });
	}  	
  }

	function facebooklogin_now(fname,lname,userName){
  	var params ={ 'action' : 'fb' };
		params['userName'] = userName;
		params['first_name'] 	= fname;
		params['last_name'] 	= lname;
		//add by palash start
		var bTime = $('#fbDateHolder').val();
		if(bTime != ''){
			params['bTime'] 	= bTime;
			params['staffArr'] 	= get_staff();
			params['srvArr'] 	= get_service();
		}
		//add by palash end
		$.ajax({
		      url: SITE_URL+"customer/customer_login/fn_facebook_now",
			  data:params,
		      type: "post",
		      success: function(result){
			  		window.location.href=SITE_URL;
			  }  	
		 });  	
  }





