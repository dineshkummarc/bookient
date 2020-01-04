
<?php include('timezone_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Time Zone Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add TIMEZONE" />Add Timezone</strong></a>
</div>



<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:22%;">Time Zone Name : </td>
    <td><input type="text" name="timezonename" id="timezonename" value="" style="width:105%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="time_zone_id" id="time_zone_id" value="" />
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
    	<input type="button" name="sub_timezone" id="sub_timezone" value="Add" class="btn-blue" onclick="submit_timezone();" />
        &nbsp;
        <input type="button" name="cancel_timezone" id="cancel_timezone" value="Cancel" class="btn-gray" onclick="cancl_timezone();" />
     </td>
  </tr>
</table>
</form>
</div>
 <div id ="search_list">
            <form name="srch_frm" id="srch_frm" method="post">
                <input type="text" name="srch_txt" id="srch_txt" value=""  class="text_input" /> &nbsp;&nbsp;
                &nbsp;&nbsp;<input type="button" name="srch_country" id="srch_country" value="Search" class="btn-blue" onclick="search_timezone();" /></form>
                &nbsp;&nbsp;&nbsp;<input type="button" name="reset_country" id="reset_country" value="Reset" class="btn-gray" onclick="reset_timezone();" />

             <input type="hidden" name="src_hing_value" id="src_hing_value" value="" />
        </div>
<br/>
<div id="faq_listing">
<?php echo  $all; ?>
</div>
<br /><br />
</div>

