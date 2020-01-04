


<?php include('country_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Country Manager</h1>
    <div id="add_new_link"  class="margin-adjust">
        <a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add COUNTRY" />Add Country</strong></a>
    </div>


    <div id="add_faq" style="display:none;">
    <form name="faq_frm" id="faq_frm" method="post">
    <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
      <tr>
        <td style="width:22%;">Country Name : </td>
        <td><input type="text" name="countryname" id="countryname" value="" style="width:105%;" class="required" /> &nbsp; <span id="qstn_err"></span>
         <input type="hidden" name="country_id" id="country_id" value="" />
        </td>
      </tr>

      <tr>
        <td colspan="2" align="center">
            <input type="button" name="sub_country" id="sub_country" value="Add" class="btn-blue" onclick="submit_country();" />
            &nbsp;
            <input type="button" name="cancel_country" id="cancel_country" value="Cancel" class="btn-gray" onclick="cancl_country();" />
         </td>
      </tr>
    </table>
    </form>
    </div>

        <div id ="search_list">
            <form name="srch_frm" id="srch_frm" method="post">
                <input type="text" name="srch_txt" id="srch_txt" value=""  class="text_input" />
                  &nbsp;&nbsp;<input type="button" name="srch_country" id="srch_country" value="Search" class="btn-blue" onclick="search_country();" /></form>
                 &nbsp;&nbsp;&nbsp;<input type="button" name="reset_country" id="reset_country" value="Reset" class="btn-gray" onclick="reset_country();" />

             <input type="hidden" name="src_hing_value" id="src_hing_value" value="" />
        </div>

    <div id="faq_listing">
		<?php echo  $all; ?>

    </div>
	<br /><br />


</div>


