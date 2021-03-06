<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<!--meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" /-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/front_image/favicon.ico" type="image/vnd.microsoft.icon" />
<title>Admin::<?php echo $this->session->userdata('title');?></title>

<!--##################################### ADMIN CSS START #####################################--> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin_css/admin_calender.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin_css/admin_common.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin_css/color_picker_css/colorpicker.css" /> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin_css/rating_star.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin_css/ui.all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/admin_css/jquery-ui.css" />
<!--##################################### ADMIN CSS END #####################################--> 


<!--##################################### ADMIN JS START #####################################--> 
<script src="<?php echo base_url();?>asset/admin_js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/admin_js/min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/ui_js/jquery-1.9.0.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/ui_js/jquery-ui-1.10.0.custom.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/ui_js/jquery-ui-1.10.0.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/admin_js/admin_common.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>asset/admin_js/add_location.js" type="text/javascript"></script>
<script>
var BASE_URL ="<?php echo site_url(); ?>";
var SITE_URL ="<?php echo base_url(); ?>" ;
</script>
<!--script type='text/javascript' src='<?php echo base_url(); ?>asset/admin_js/jquery.weekcalendar.js'></script-->
<script type='text/javascript' src='<?php echo base_url(); ?>asset/admin_js/jquery.multiselect.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>asset/admin_js/utils.js'></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/fck/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/fck/sample.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/jscolor/jscolor.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/color_picker_js/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/rating_star/rating_star_admin.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/ajaxfileupload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/showHide.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/cookie.js"></script>
<!--##################################### ADMIN JS END #####################################--> 

</head>
<body>

<div class="wrapper" id="lightPrBox">
	<div class="maincontainer">
		<!--div class="header">
         <h1 class="logoCon"><a class="block" title="Pardco" href="javascript:void(0);"><img src="<?php echo base_url(); ?>images/logo.png" alt="logo" /></a></h1>                    
	</div-->