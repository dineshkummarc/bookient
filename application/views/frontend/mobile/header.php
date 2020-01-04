<!DOCTYPE html> 
<html>
<head>
	<!--meta charset="utf-8"-->
    <meta charset="iso-8859-15">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title><?php echo $this->session->userdata('title');?></title> 
	<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/front_image/favicon.ico" type="image/vnd.microsoft.icon" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/mobile_css/jquery.mobile-1.2.1.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/mobile_css/jquery.ui.datepicker.mobile.css" /> 
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/mobile_css/style.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/mobile_css/lightBox.css" />
	<?php include('language.php');?>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/jquery.mobile-1.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/mobile_index.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/jQuery.ui.datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/jquery.ui.datepicker.mobile.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/login.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/lightBox.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/booking.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>asset/mobile_js/reviewAndAppointments.js"></script>
	<script type="text/javascript">
	var BASE_URL ="<?php echo site_url(); ?>";
	var SITE_URL ="<?php echo base_url(); ?>";
	</script>
</head> 
<body> 
<div data-role="page"><!-- main contener -->