<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('timeformat_manager.js.php'); ?>
<div id="records_listing">
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Time Format Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<!--<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php //echo base_url(); ?>images/Add-faq.png" alt="" title="Add TIME FORMAT" />Add Time Format</strong></a>-->
</div>

<div id="faq_listing" style="padding:30px;">
<?php echo  $all; ?>
</div>
<br /><br />

<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;">Time Format : </td>
    <td><input type="text" name="timeformat" id="timeformat" value="" style="width:105%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="time_format_id" id="time_format_id" value="" />
	</td>
  </tr>
 <!-- <tr>
    <td>Answer : </td>
    <td><textarea cols="80" id="answer" name="answer" rows="10"></textarea> &nbsp; <span id="ans_err"></span>
    <script type="text/javascript">
        CKEDITOR.replace( 'answer',
            {
                skin : 'kama',
				height:"200",
				width:"124%"
            });
    </script>
    <input type="hidden" name="faq_id" id="faq_id" value="" />
    </td>
  </tr> -->
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_timeformat" id="sub_timeformat" value="Add" class="btn-blue" onclick=" submit_timeformat()" />
        &nbsp;
        <input type="button" name="cancel_timeformat" id="cancel_timeformat" value="Cancel" class="btn-gray" onclick="cancl_timeformat();" />
     </td>
  </tr>
</table>
</form>
</div>
</div>
</div>

