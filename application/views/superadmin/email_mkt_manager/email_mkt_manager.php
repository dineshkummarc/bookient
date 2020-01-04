<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('email_mkt_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin"> Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add TIMEZONE" />Add</strong></a>
</div>



<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;">Template Name : </td> 
    <td><input type="text" name="timezonename" id="timezonename" value="" style="width:105%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="eml_mrktn_templt_id" id="eml_mrktn_templt_id" value="" />
	</td>
  </tr>
   <tr>
		<td style="width:18%;">Category Name: &nbsp;</td> 
		<td><div id="country" style="border:none">
        <select name="country_id" id="cus_countryid_5" onchange="status_check();" >
		<?php echo $category; ?>
        </select>
        </div>&nbsp; <span id="con_select_err"></span>
		</td>	
   </tr>
   <tr>
    <td style="width:22%;">Header Content : </td> 
    <td><textarea id="headcont" name="headcont"cols="20" rows="10"></textarea>
    <script type="text/javascript">
        CKEDITOR.replace( 'headcont',
            {
                skin : 'kama',
				height:"200",
				width:"124%"
            });
    </script>    
	</td>
  </tr>
   <tr>
    <td align="left">Header Back Color</td>   
    <td align="left"><input type="text" id="head_bg_color" name="head_bg_color" class="color" readonly="readonly" value="" /></td>
  </tr>
   <tr>
    <td style="width:22%;">Body Content : </td> 
    <td><textarea id="bodycont" name="bodycont"cols="20" rows="10"></textarea>	
         <script type="text/javascript">
        CKEDITOR.replace( 'bodycont',
            {
                skin : 'kama',
				height:"200",
				width:"124%"
            });
    </script> 
	</td>
  </tr>
   <tr>
    <td align="left">Body Back Color</td>   
    <td align="left"><input type="text" id="body_bg_color" name="body_bg_color" class="color" readonly="readonly" value="" /></td>
  </tr>
   <tr>
    <td style="width:22%;">Footer Content : </td> 
    <td><textarea id="footcont" name="footcont"cols="20" rows="10"></textarea>	
        <script type="text/javascript">
        CKEDITOR.replace( 'footcont',
            {
                skin : 'kama',
				height:"200",
				width:"124%"
            });
    </script> 
	</td>
  </tr>
   <tr>
    <td align="left">Footer Back Color</td>   
    <td align="left"><input type="text" id="foot_bg_color" name="foot_bg_color" class="color" readonly="readonly" value="" /></td>
  </tr>
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_timezone" id="sub_timezone" value="Add" class="btn-blue" onclick="submit_timezone();" /> 
        &nbsp; 
        <input type="button" name="cancel_timezone" id="cancel_timezone" value="Cancel" class="btn-gray" onclick="cancl_timezone();" />
     </td>
  </tr>
</table>
</form>
</div>

<div id="faq_listing">
<?php echo  $all; ?>
</div>
<br /><br />
</div>

