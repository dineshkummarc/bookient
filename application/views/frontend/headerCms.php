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
<!--<meta charset="utf-8">-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta content="initial-scale=1.6; maximum-scale=1.0; width=device-width;" name="viewport">
<title><?php echo $this->session->userdata('title');?></title>
<link href="<?php echo base_url(); ?>asset/front_css/defult_headerFront.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/front_image/favicon.ico" type="image/vnd.microsoft.icon" />
<script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>

<link href="<?php echo base_url(); ?>asset/front_css/index.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/front_css/theme_default.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>asset/front_css/popup.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>asset/front_js/info.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/front_js/login.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>asset/front_js/myAccount.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/front_js/cookie.js"></script>

<script type="text/javascript">
var BASE_URL ="<?php echo site_url(); ?>";
var SITE_URL ="<?php echo base_url(); ?>";
</script>
<script type="text/javascript">
var rev = "fwd";
function titlebar(pos){
	var msg = "<?php echo $this->session->userdata('title');?>";
	var res = "";
	var speed = 200;
	var le = msg.length;
	if(rev == "fwd"){
		if(pos < le){
			pos = pos+1;
			scroll = msg.substr(0,pos);
			document.title = scroll;
			timer = window.setTimeout("titlebar("+pos+")",speed);
		}else{
			rev = "bwd";
			timer = window.setTimeout("titlebar("+pos+")",speed);}
	}else{
		if(pos > 0){
		pos = pos-1;
		var ale = le-pos;
		scrol = msg.substr(ale,le);
		document.title = scrol;
		timer = window.setTimeout("titlebar("+pos+")",speed);
		}else{
		rev = "fwd";
		timer = window.setTimeout("titlebar("+pos+")",speed);
		}
	}
}
titlebar(0);
</script>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
<div id="dynamic_popup_id">
<div class="wrapper">