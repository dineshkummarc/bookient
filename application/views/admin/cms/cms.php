<?php include('cms.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('content_head')); ?></h1>
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
	margin-left:8px;
	
}
</style>
<div id="tabs">
<ul>
<li><a href="#tabs-1"><?php echo $this->lang->line('cms_option_privacy_policy'); ?></a></li>
<li><a href="#tabs-2"><?php echo $this->lang->line('cms_option_security_info'); ?></a></li>
<li><a href="#tabs-3"><?php echo $this->lang->line('cms_option_company_info'); ?></a></li>
</ul>
<div id="tabs-1">
<h2><?php echo $this->lang->line('cms_head_privacy_policy'); ?></h2>
<p></p>
<textarea class="cms_textarea" id="privacypolicy">
<?php echo $this->global_mod->show_to_control($privacypolicy); ?>
</textarea>
<br>
<p style="padding-top: 3px;"></p>
<p style="margin-left: 5px;"><input class="btn-blue" type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('update_privacy_policy'))?>" onclick="update_info('privacypolicy')"></p>
</div>
<div id="tabs-2">
<h2><?php echo $this->lang->line('cms_head_security_info'); ?></h2>
<p></p>
<textarea class="cms_textarea" id="securityinfo">
<?php echo $this->global_mod->show_to_control($securityinfo); ?>
</textarea>
<br>
<p style="padding-top: 3px;"></p>
<p style="margin-left: 8px;"><input class="btn-blue" type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('update_security_policy'))?>" onclick="update_info('securityinfo')"></p>
</div>
<div id="tabs-3">
<h2><?php echo $this->lang->line('cms_head_company_info'); ?></h2>
<p></p>
<textarea class="cms_textarea" id="companyinfo">
<?php echo $this->global_mod->show_to_control($companyinfo); ?>
</textarea>
<br>
<p style="padding-top: 3px;"></p>
<p style="margin-left: 8px;"><input class="btn-blue" type="button" value="<?php echo $this->global_mod->db_parse($this->lang->line('update_company_policy'))?>" onclick="update_info('companyinfo')"></p>
</div>
</div>
	<!--######################--->
</div>

