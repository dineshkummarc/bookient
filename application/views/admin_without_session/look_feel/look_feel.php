<?php include('look_feel.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main">LOOK & FEEL</h1>
 <blockquote style="font-size: 15px;">&nbsp;&nbsp;&nbsp;&nbsp;We have pre-set some themes for you. You can select or create the theme of your booking system based on your corporate colors.</blockquote>
 <br/>

<div style='padding: 20px 0 0 50px;'> 	
<label style="font-weight: bold;font-size: 13px;">1. Select the Layout for your calendar.</label> <br/>
<input type="radio" name="layout" id="layout" value="L" onclick="select_layout(this.value)" <?php echo ($showLayout=="L")?'checked="checked"':'' ?> />&nbsp;Left bar layout&nbsp;&nbsp;<br> 
<input type="radio" name="layout" id="layout" value="R" onclick="select_layout(this.value)" <?php echo ($showLayout=="R")?'checked="checked"':'' ?> />&nbsp;Right layout&nbsp;&nbsp;<br>  
<input type="radio" name="layout" id="layout" value="T" onclick="select_layout(this.value)" <?php echo ($showLayout=="T")?'checked="checked"':'' ?> />&nbsp;Top layout&nbsp;&nbsp; 

 <br/><br/>
<label style="font-weight: bold;font-size: 13px;">2. Select a Theme for your calendar. </label> <br/>
<input type="radio" name="theme" id="theme" value="CS1" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS1")?'checked="checked"':'' ?> />&nbsp;Default Theme&nbsp;&nbsp;<br> 
<input type="radio" name="theme" id="theme" value="CS2" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS2")?'checked="checked"':'' ?> />&nbsp;Sweet Green&nbsp;&nbsp;<br>  
<input type="radio" name="theme" id="theme" value="CS3" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS3")?'checked="checked"':'' ?> />&nbsp;Mozo-Gray&nbsp;&nbsp;<br> 
<input type="radio" name="theme" id="theme" value="CS4" onclick="select_theme(this.value)" <?php echo ($showtheme=="CS4")?'checked="checked"':'' ?> />&nbsp;Pol-Orange&nbsp;&nbsp;<br> 
<input type="radio" name="theme" id="theme" value="CCS" onclick="select_theme(this.value)" <?php echo ($showtheme=="CCS")?'checked="checked"':'' ?> />&nbsp;Use custom theme&nbsp;&nbsp;<br><br>
<a style="font-weight: bold;font-size: 16px;color: #2582C0;" href="javascript:void(0);" onclick="showCustomTheme();">Create your own theme</a>
<br />
</div>
<div id="showCustomTheme" style="display:none;">
<form id="frm_theme" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="frm_theme" method="post">
<table width="30%" style="border:1PX solid #4D4D4D; color:#404040;" bgcolor="#B9BCBF">
 <!--tr>
    <td align="left">Theme Name</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="theme_name" name="theme_name" /></td>
  </tr-->
  <tr>
    <td align="left">Background Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right">
        <input type="text" id="background_color" name="background_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
    <td align="left">Aside Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"> <input type="text" id="aside_color" name="aside_color" class="color" readonly="readonly" value="" style="background-color: #FF0000;" /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Block Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_blok_color" name="content_panel_blok_color" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Block Background Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_blok_bg_color" name="content_panel_blok_bg_color" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Tab Hover Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="tab_hover_color" name="tab_hover_color" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Outer Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_outer_color" name="content_panel_outer_color"  class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Head Background Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_head_bg_col" name="content_panel_head_bg_col" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Head Border Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_head_brdr_color" name="content_panel_head_brdr_color" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Bottom Background Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_btm_bg_color" name="content_panel_btm_bg_color" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="left">Content Panel Bottom Border Color</td>
    <td align="center"><strong>:</strong></td>
    <td align="right"><input type="text" id="content_panel_btm_brdr_color" name="content_panel_btm_brdr_color" class="color" readonly="readonly" value=""  /></td>
  </tr>
  <tr>
    <td align="center" colspan="3">
    <input type="button" onclick="save();" value="Save" />
    <input type="button" onclick="cancel();" value="Cancel" />
    </td>
  </tr>
</table>
</form></div>
</div>

