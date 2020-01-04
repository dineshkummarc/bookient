<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('dateformat_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Date Format Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add DATE FORMAT" />Add Date Format</strong></a>
</div>

<div id="faq_listing">
<?php echo  $all; ?>
</div>
<br /><br />

<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;">Date Format : </td>
    <td>
        <select name="dateformat" id="dateformat" style="width:200px;margin-left: 65px;">
            <option value="DD/MM/YYYY">DD/MM/YYYY</option>
            <option value="DD/MM/YY">DD/MM/YY</option>
            <option value="MM/DD/YYYY">MM/DD/YYYY</option>
            <option value="MM/DD/YY">MM/DD/YY</option>
            <option value="DD-MM-YY">DD-MM-YY</option>
            <option value="DD-MM-YYYY">DD-MM-YYYY</option>
            <option value="MM-DD-YYYY">MM-DD-YYYY</option>
            <option value="MM-DD-YY">MM-DD-YY</option>
            <option value="YYYY-MM-DD">YYYY-MM-DD</option>
            <option value="YY-MM-DD">YY-MM-DD</option>
            <option value="YY/MM/DD">YY/MM/DD</option>
            <option value="YYYY/MM/DD">YYYY/MM/DD</option>
          </select>

        <span id="qstn_err"></span>
	 <input type="hidden" name="date_format_id" id="date_format_id" value="" />
	</td>
  </tr>

  <tr>
  	<td colspan="2" align="center">
            <br/>
    	<input type="button" name="sub_dateformat" id="sub_dateformat" value="Add" class="btn-blue" onclick=" submit_dateformat()" />
        &nbsp;
        <input type="button" name="cancel_dateformat" id="cancel_dateformat" value="Cancel" class="btn-gray" onclick="cancl_dateformat();" />
     </td>
  </tr>
</table>
</form>
</div>
</div>

