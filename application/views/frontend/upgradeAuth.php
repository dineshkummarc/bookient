<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<head>
<!--<meta charset="utf-8">-->
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
<!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
<meta content="initial-scale=1.6; maximum-scale=1.0; width=device-width;" name="viewport">
<title><?php echo $this->session->userdata('title');?></title>
<link href="<?php echo base_url(); ?>min/?f=asset/front_css/defult_headerFront.css,asset/front_css/rating_star.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>asset/front_image/favicon.ico" type="image/vnd.microsoft.icon" />
<script src="http://code.jquery.com/jquery-1.9.1.js" type="text/javascript"></script>

<script type="text/javascript">
var BASE_URL ="<?php echo site_url(); ?>";
var SITE_URL ="<?php echo base_url(); ?>" ;
</script>

</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" data-twttr-rendered="true">
<div id="dynamic_popup_id">
<div class="wrapper">

<div>
  <hgroup id="header">
    <h1 class="logoCon"><a class="block" title="Pardco" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>images/logo.png" alt="logo" /></a></h1>
    <div class="UserCon">
          </div>
    <div class="clearfix"></div>
  </hgroup>
  <div class="clearfix"></div>
  <nav class="navbar" style="position:relative;">
   <button type="button" class="btn btn-navbar" data-toggle="collapse" >
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
   </button>
   <div class="nav-collpas">
    <ul class="menu" id="lang_log">   
            <li id="menu"><a>&nbsp;</a></li>             
    </ul>
  <div class="clearfix"></div>
    <div id="cus_menu">

    </div>

    </div>
 <div class="clearfix"></div>
  </nav>
  <div class="clearfix"></div>
</div>

<?php if($alertMsg =='maintenance'){ ?>
	<div class="timeBizFront"><img alt="maintenance mode" src="<?php echo base_url(); ?>asset/maintenance.png"></div>
<?php }else{ ?>
	<div class="alertContent"><?php echo $alertMsg; ?></div>
<?php } ?>

<style>

.alertContent{
	background: none repeat scroll 0 0 #f1f1f1;
    border: 10px solid #ccc;
    border-radius: 2em;
    font-size: 2em;
    left: 33%;
    margin: 0 auto;
    padding: 20px;
    position: absolute;
    text-align: center;
    top: 40%;
    width: 33%;
}

.timeBizFront{
	background: none repeat scroll 0 0 #f1f1f1;
    border: 10px solid #ccc;
    border-radius: 2em;
    font-size: 2em;
    left: 33%;
    margin: 0 auto;
    padding: 20px;
    position: absolute;
    text-align: center;
    width: 33%;
}
	
</style>

</div>
<div class="footer">
  <footer class="row">
    <div class="twelve columns">
    	<ul>
        	<li><a>&nbsp;</a></li>
        </ul>
        <p>&copy; Copyright bookient.com 2014. All rights reserved.</p>
   
        <div class="social-icons">
           
        </div>
  
    </div>
  </footer>
</div>
</div>
</body>
</html>
