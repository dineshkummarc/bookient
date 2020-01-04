<?php
include_once("config.php");
//destroy facebook session if user clicks reset
if(isset($_GET["reset"]) && $_GET["reset"]==1)
{
	$facebook->destroySession();
	header("Location: ".$homeurl);
}

if(!$fbuser)
{
		$fbuser = null;
		$loginUrl = $facebook->getLoginUrl(array('redirect_uri'=>$homeurl,'scope'=>$fbPermissions));
		echo '<a href="'.$loginUrl.'"><img src="images/facebook-login.png"></a>'; 
		
}else{

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Post Photos to User Profile</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="fbpagewrapper">
<div id="fbpageform" class="pageform">
<form action="process.php" method="post" enctype="multipart/form-data" name="form" id="form">
<h1>Post Photos to User Profile</h1>
<p> The image will be posted on your profile wall! <a href="?reset=1">Reset User Session</a>.</p>
<label>Pages
<span class="small">Select a Page</span>
</label>
<input type="file" name="pictureFile" id="pictureFile">
<label>Message
<span class="small">Write something to post!</span>
</label>
<textarea name="message"></textarea>
<button type="submit" class="button" id="submit_button">Post Picture</button>
<div class="spacer"></div>
</form>
</div>
</div>

</body>
</html>
<?php
}
?>

</body>
</html>
