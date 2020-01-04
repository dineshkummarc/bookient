<?php include('look_feel.js.php'); ?>

<div class="rounded_corner_full" style="overflow:hidden;">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('headign-main')); ?></h1>
 <blockquote style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_head_details')); ?></blockquote>
 <br/>

 <!-- Custom calendar part begin TODO div height issue-->

<div style="float: right; width:450px; padding-bottom:15px;"> 
	<a style="font-weight: bold;font-size: 16px;color: #2582C0;" href="javascript:void(0);" onclick="showCalendarTheme();"><?php echo $this->global_mod->db_parse($this->lang->line('crte_own_status_clr'));?></a> <br/>

	<div id="showCalendarTheme" style="display:none;">
	<form id="frm_calendar" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="frm_theme" method="post">
	<table  style="border:1PX solid #4D4D4D; color:#404040;" bgcolor="#B9BCBF">
	  
	  <tr>
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('approved_clr_upper'));?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="approved_color" name="approved_color" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr style="border-bottom:dashed; border-width: 1px;">
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('approved_clr_lower'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="approved_color_L" name="approved_color_L" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr>
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('pnding_clr_upper'));?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="pending_color" name="pending_color" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr style="border-bottom:dashed; border-width: 1px;">
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('pnding_clr_lower'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="pending_color_L" name="pending_color_L" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr>
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('no_show_color_upper'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="noshow_color" name="noshow_color" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr style="border-bottom:dashed; border-width: 1px;">
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('no_show_color_lower'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="noshow_color_L" name="noshow_color_L" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr>
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('arrived_lt_color_upper'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="late_color" name="late_color" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr style="border-bottom:dashed; border-width: 1px;">
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('arrived_lt_color_lower'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="late_color_L" name="late_color_L" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr>
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('arrived_schdl_clr_upper'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="scheduled_color" name="scheduled_color" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr style="border-bottom:dashed; border-width: 1px;">
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('arrived_schdl_clr_lower'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="scheduled_color_L" name="scheduled_color_L" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr>
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('unknown_clr_uper_debug'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="unknown_color" name="unknown_color" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr style="border-bottom:dashed; border-width: 1px;">
		<td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('unknown_clr_lower_debug'))?></td>
		<td align="center"><strong>:</strong></td>
		<td align="right">
			<input type="text" id="unknown_color_L" name="unknown_color_L" class="color" readonly="readonly" value="" /></td>
	  </tr>
	  <tr>
		<td align="center" colspan="3">
		<input type="button" onclick="cal_reset();" value="Default colors" /> <!-- TODO: tarkista toiminta -->
		</td>
	  </tr>
	  <tr>
		<td align="center" colspan="3">
		<input type="button" onclick="cal_save();" value="<?php echo $this->lang->line('look_theme_savebtn'); ?>" />
		<input type="button" onclick="cal_cancel();" value="<?php echo $this->lang->line('look_theme_cancelbtn'); ?>" />
		</td>
	  </tr>
	</table>
	</form>
	</div>
</div>


<div style='padding: 20px 0 0 50px;'> 	
<label style="font-weight: bold;font-size: 13px;"><?php echo $this->global_mod->db_parse($this->lang->line('look_calendar_header')); ?></label> <br/>
<input type="radio" name="header" id="header" value="1" onclick="select_header(this.value)" <?php echo ($showHeader=="1")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_calendar_show')); ?>&nbsp;&nbsp;<br> 
<input type="radio" name="header" id="header" value="0" onclick="select_header(this.value)" <?php echo ($showHeader=="0")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_calendar_hide')); ?>&nbsp;&nbsp;<br>  

 <br/>
<label style="font-weight: bold;font-size: 13px;"><?php echo $this->global_mod->db_parse($this->lang->line('look_calender_layout')); ?></label> <br/>
<input type="radio" name="layout" id="layout" value="L" onclick="select_layout(this.value)" <?php echo ($showLayout=="L")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_calender_layout_left')); ?>&nbsp;&nbsp;<br> 
<input type="radio" name="layout" id="layout" value="R" onclick="select_layout(this.value)" <?php echo ($showLayout=="R")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_calender_layout_right')); ?>&nbsp;&nbsp;<br>  
<input type="radio" name="layout" id="layout" value="T" onclick="select_layout(this.value)" <?php echo ($showLayout=="T")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_calender_layout_top')); ?>&nbsp;&nbsp; 

 <br/><br/>
<label style="font-weight: bold;font-size: 13px;"><?php echo $this->global_mod->db_parse($this->lang->line('look_calender_theme')); ?> </label> <br/>
<input type="radio" name="theme" id="theme" value="CS1" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS1")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_default')); ?>&nbsp;&nbsp;<br> 
<input type="radio" name="theme" id="theme" value="CS2" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS2")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_green')); ?>&nbsp;&nbsp;<br>  
<input type="radio" name="theme" id="theme" value="CS3" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS3")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_gray')); ?>&nbsp;&nbsp;<br> 
<input type="radio" name="theme" id="theme" value="CS4" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS4")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_orange')); ?>&nbsp;&nbsp;<br> 
<input type="radio" name="theme" id="theme" value="CCS" onclick="select_theme(this.value)" <?php echo ($showtheme=="CCS")?'checked="checked"':'' ?> />&nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_custom')); ?>&nbsp;&nbsp;<br><br>
<a style="font-weight: bold;font-size: 16px;color: #2582C0;" href="javascript:void(0);" onclick="showCustomTheme();"><?php echo $this->global_mod->db_parse($this->lang->line('look_theme_create')); ?></a>
<br />
</div>



<!-- Custom color part start -->


<div id="showCustomTheme" style="display:none;padding: 20px 0 0 50px; margin: 0px 0px 15px 0px;">
<form id="frm_theme" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="frm_theme" method="post">
<table width="30%" style="border:1PX solid #4D4D4D; color:#404040;" bgcolor="#B9BCBF">
  
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('look_theme_bgcolor'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="background_color" name="background_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('stf_srvc_panel_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="staffServicePanel_color" name="staffServicePanel_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('stf_tooltip_colr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="staffToolTip_color" name="staffToolTip_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('srvc_tltip_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="serviceTooltip_color" name="serviceTooltip_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('tab_backgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="tabBG_color" name="tabBG_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('active_tab_bckgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="activTabBG_color" name="activTabBG_color" class="color" readonly="readonly" value="" /></td>
  </tr>
   <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('tab_cntnt_bckgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="tabContentBGColor_color" name="tabContentBGColor_color" class="color" readonly="readonly" value="" /></td>
  </tr>
   <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('tab_header_bckgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="tabHeaderBGColor_color" name="tabHeaderBGColor_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('wk_cal_bckgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="weekCalBGColor_color" name="weekCalBGColor_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('wk_cal_fnt_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="weekCalfont_color" name="weekCalfont_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('btn_bckgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="btnBGColor_color" name="btnBGColor_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left"><?php echo $this->global_mod->db_parse($this->lang->line('active_btn_bckgrnd_clr'))?></td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="btnAcountBGColor_color" name="btnAcountBGColor_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="center" colspan="3">
    <input type="button" onclick="save();" value="<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_savebtn')); ?>" />
    <input type="button" onclick="cancel();" value="<?php echo $this->global_mod->db_parse($this->lang->line('look_theme_cancelbtn')); ?>" />
    </td>
  </tr>
</table>
</form>
</div>

<!-- Custom color part end -->



</div>

