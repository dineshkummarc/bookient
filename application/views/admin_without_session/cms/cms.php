<?php include('cms.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main">content management</h1>
	<!--######################--->
<style>
.ui-tabs-vertical { width: 75em; }
.ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 12em; }
.ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
.ui-tabs-vertical .ui-tabs-nav li a { display:block; }
.ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; border-right-width: 1px; }
.ui-tabs-vertical .ui-tabs-panel { padding: 1em; float: right; width: 60em;}
.cms_textarea{
	width: 50em;
	height: 30em;
}
</style>
<div id="tabs">
<ul>
<li><a href="#tabs-1">Privacy Policy</a></li>
<li><a href="#tabs-2">Security Info</a></li>
<li><a href="#tabs-3">Company Info</a></li>
</ul>
<div id="tabs-1">
<h2>Privacy Policy</h2>
<textarea class="cms_textarea" id="privacypolicy">
<?php echo $privacypolicy; ?>
</textarea>
<br>
<input class="btn-blue" type="button" value="Update privacy policy" onclick="update_info('privacypolicy')">
</div>
<div id="tabs-2">
<h2>Security Info</h2>
<textarea class="cms_textarea" id="securityinfo">
<?php echo $securityinfo; ?>
</textarea>
<br>
<input class="btn-blue" type="button" value="Update security info" onclick="update_info('securityinfo')">
</div>
<div id="tabs-3">
<h2>Company Info</h2>
<textarea class="cms_textarea" id="companyinfo">
<?php echo $companyinfo; ?>
</textarea>
<br>
<input class="btn-blue" type="button" value="Update company info" onclick="update_info('companyinfo')">
</div>
</div>
	<!--######################--->
</div>

