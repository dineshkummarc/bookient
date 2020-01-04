<?php
$local_admin_id = $this->session->userdata('local_admin_id');
$this->db->select('layout');
$this->db->from('app_local_admin_gen_setting');
$this->db->where('local_admin_id', $local_admin_id);
$LayoutThemeData = $this->db->get();
$DataArr = $LayoutThemeData->row();	
$layout = $DataArr->layout;
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
<meta content="initial-scale=1.6; maximum-scale=1.0; width=device-width;" name="viewport">
<title><?php echo $this->session->userdata('title');?></title>
<link href="<?php echo base_url(); ?>min/?f=asset/front_css/defult_headerFront.css,asset/front_css/rating_star.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/front_image/favicon.ico" type="image/vnd.microsoft.icon" />
<script src="<?php echo base_url();?>asset/front_js/jquery.js" type="text/javascript"></script>

<script type="text/javascript">
var BASE_URL ="<?php echo site_url(); ?>"; 
var SITE_URL ="<?php echo base_url(); ?>";
</script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/rating_star.js"></script>


</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
<div id="dynamic_popup_id">
<div class="wrapper">