


<?php include('region_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Region Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add REGION" />Add Region</strong></a>
</div>



<div id="add_faq" style="display:none;">
	<form name="faq_frm" id="faq_frm" method="post">
	<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
	  <tr>
		<td style="width:18%;">Country Name: &nbsp;</td>
		<td><div id="country" style="border:none"><?php echo $country; ?></div>&nbsp; <span id="con_select_err"></span>
		</td>
	  </tr>
	  <tr>
		<td style="width:18%;">Region Name : </td>
		<td><input type="text" name="regionname" id="regionname" value="" style="width:125%;" /> &nbsp; <span id="name_err"></span>
		 <input type="hidden" name="region_id" id="region_id" value="" />
		</td>
	  </tr>
	  <tr>
		<td style="width:18%;">Region Code : </td>
		<td><input type="text" name="regioncode" id="regioncode" value="" style="width:125%;" /> &nbsp; <span id="code_err"></span>

		</td>
	  </tr>
	   <tr>
		<td colspan="2" align="center">
			<input type="button" name="sub_region" id="sub_region" value="Add" class="btn-blue" onclick="submit_region();" />
			&nbsp;
			<input type="button" name="cancel_region" id="cancel_region" value="Cancel" class="btn-gray" onclick="cancl_region();" />
		 </td>
	  </tr>
	</table>
	</form>
</div>

 <div id ="search_list">
            <form name="srch_frm" id="srch_frm" method="post">
                <input type="text" name="srch_txt" id="srch_txt" value=""  class="text_input" /> &nbsp;&nbsp;

                &nbsp;&nbsp;<input type="button" name="srch_country" id="srch_country" value="Search" class="btn-blue" onclick="search_region();" /></form>
                &nbsp;&nbsp;&nbsp;<input type="button" name="reset_country" id="reset_country" value="Reset" class="btn-gray" onclick="reset_region();" />

             <input type="hidden" name="src_hing_value" id="src_hing_value" value="" />
        </div>
<br/>
<div id="faq_listing">
		<?php echo  $all; ?>

    </div>
	<br /><br />

</div>

