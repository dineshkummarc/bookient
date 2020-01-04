<?php
$logo = ($business_logo != "")?"uploads/businesslogo/".$business_logo:"images/logo.png";
$logoUrl = base_url().$logo;
?>
<div data-role="header" data-position="fixed" data-transition="none" class="mainHeader" data-theme="b">
	<img class="headerMainLogo" alt="logo" src="<?php echo $logoUrl; ?>">
	<a href="#" onclick="menuFn()" data-transition="flip" data-rel="popup" data-icon="gear" id="mainOption" class="ui-btn-right" data-position-to="window"><?php echo $this->lang->line('mobile_option'); ?></a>
<?php
	if($logged_in_customer == TRUE){
		echo '<div class="headerUser">'.$this->lang->line('Frontend').' ';
	        if(isset($user_name)){
	            print($user_name);
	        }
		echo ' !</div>';
	}
?>
<div class="ui-navbar ui-mini" data-role="navbar" role="navigation" data-iconpos="right">
	<ul>
		<li><a id="scheduleCal" href="#" data-theme="a" class="topMenul ui-btn-active"><?php echo $this->lang->line('mobile_schedule'); ?></a></li>
		<li><a id="aboutCal" href="#" data-theme="a" class="topMenul"><?php echo $this->lang->line('aboutus'); ?></a></li>
		<li><a id="reviewCal" href="#" data-theme="a" class="topMenul"><?php echo $this->lang->line('review'); ?> <?php if(count($review_list)>0){ ?><span class="reviewCounter"><?php echo count($review_list); ?></span><?php } ?></a></li>
	</ul>
</div><!-- /navbar -->
</div><!-- /header -->