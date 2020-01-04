<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title>Rating</title>
<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php  echo base_url(); ?>css/rating_star.css" />
<script type="text/javascript" src="<?php  echo base_url(); ?>js/rating_star/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="<?php  echo base_url(); ?>js/rating_star/rating_star.js"></script>
</head>
<body>
<div class="wrapper">

<div class="maincontainer">
<div class="header"><a href="#"><img src="<?php echo base_url(); ?>images/logo.png" width="241" height="38" alt="logo" /></a></div>

</div>

<script>
function countChar_des(val){
					var len = val.value.length;
					if (len >= 2500) {
						val.value = val.value.substring(0, 2500);
					}else {
						$('#charNum_des').text(2500 - len+" characters remaining");
					}
};
</script>


