<fb:login-button autologoutlink="true"></fb:login-button>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({appId: '444272075674092', status: true, cookie: true, xfbml: true});
  FB.logout(function(response) {
  // user is now logged out
   alert("logged out");
});
  FB.Event.subscribe('auth.sessionChange', function(response) {
    if (response.session) {
      // A user has logged in, and a new cookie has been saved
	  alert("logged in");
    } else {
      // The user has logged out, and the cookie has been cleared
	    alert("logged out");
    }
  });
</script>