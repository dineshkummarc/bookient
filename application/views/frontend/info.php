<div class="cms_content">
<div class="cms_headding">
<?php 
if($cms_type=='privacypolicy'){
	echo 'Privacy Policy';
}
if($cms_type=='companyinfo'){
	echo 'Company Info';
}
if($cms_type=='securityinfo'){
	echo 'Security Info';
}
?>
</div>
<div class="cms_data">
<?php echo nl2br($cms_data);?>
</div>
</div>