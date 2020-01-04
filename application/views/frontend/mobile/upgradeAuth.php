<!DOCTYPE html> 
<html>
<head>
	<!--meta charset="utf-8"-->
    <meta charset="iso-8859-15">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>Bookient</title> 
	<link rel="shortcut icon" href="<?php echo base_url();?>asset/front_image/favicon.ico" type="image/vnd.microsoft.icon" />
	<link rel="stylesheet" href="<?php echo base_url();?>asset/mobile_css/jquery.mobile-1.2.1.min.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>asset/mobile_css/jquery.ui.datepicker.mobile.css" /> 
	<link rel="stylesheet" href="<?php echo base_url();?>asset/mobile_css/style.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>asset/mobile_css/lightBox.css" />
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/jquery.mobile-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/mobile_index.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/jQuery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/jquery.ui.datepicker.mobile.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/login.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/lightBox.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/booking.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/mobile_js/reviewAndAppointments.js"></script>

</head> 
<body> 
<div data-role="page"><!-- main contener --><div data-role="header" data-position="fixed" data-transition="none" class="mainHeader" data-theme="b">
	<img class="headerMainLogo" alt="logo" src="<?php echo base_url();?>images/logo.png">

<div class="ui-navbar ui-mini" data-role="navbar" role="navigation" data-iconpos="right">
	<ul>
		<li><a class="topMenul">&nbsp; </a></li>
	</ul>
</div><!-- /navbar -->
</div><!-- /header -->
<div data-role="content" id="mainContent">	
<!--##########################################################################################-->
<!--############################ Mani Content Start ##########################################-->
<!--##########################################################################################-->

<div class="ui-body ui-body-c serviceContent" id="activeService" >	
		<label class="clActiveService" style="text-align: center;"><h2><?php echo $alertMsg; ?></h2></label>	 
</div>

<!--##########################################################################################-->
<!--############################## Mani Content End ##########################################-->
<!--##########################################################################################-->
</div><!-- /content -->

<div data-role="footer" data-position="fixed" data-transition="none" class="mainFooter" data-theme="b">
	<div data-role="navbar" data-iconpos="left">
		<ul>
			<li><a>&nbsp;</a></li>
		</ul>
	</div><!-- /navbar -->
	<h1>&copy; Copyright pardco.com 2012. All rights reserved.</h1>
</div><!-- /footer -->
	
</div><!-- /main contener -->

</body>
</html>