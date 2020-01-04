
<?php include('city_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">City Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add CITY" />Add City</strong></a>
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
    <td style="width:18%;">Region Name: &nbsp;</td>
    <td><div id="region" style="border:none"><select name="region_id" id="cus_regionid_5" onchange="region_change();" ><option value="" >----Region---</option></select></div>&nbsp; <span id="region_select_err"></span>
	</td>
  </tr>
   <tr>
    <td style="width:19%;">City Name: &nbsp; </td>
    <td><input type="text" name="cityname" id="cityname" value="" style="width:105%;" /> &nbsp; <span id="name_err"></span>
	 <input type="hidden" name="city_id" id="city_id" value="" />
	</td>
  </tr>
  <tr>
    <td style="width:18%;">City Key: &nbsp; </td>
    <td><input type="text" name="citykey" id="citykey" value="" style="width:105%;" /> &nbsp; <span id="key_err"></span>

	</td>
  </tr>
  <tr>
    <td style="width:18%;">Lattitude : </td>
    <td><input type="text" name="latt" id="latt" value="" style="width:105%;" /> &nbsp; <span id="latt_err"></span>
	</td>
  </tr>
  <tr>
    <td style="width:18%;">Longitude : </td>
    <td><input type="text" name="longi" id="longi" value="" style="width:105%;" /> &nbsp; <span id="longi_err"></span>
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
                &nbsp;&nbsp;<input type="button" name="srch_country" id="srch_country" value="Search" class="btn-blue" onclick="search_city();" /></form>
                &nbsp;&nbsp;&nbsp;<input type="button" name="reset_country" id="reset_country" value="Reset" class="btn-gray" onclick="reset_city();" />

             <input type="hidden" name="src_hing_value" id="src_hing_value" value="" />
        </div>
<br/>

<div id="faq_listing">
		<?php echo  $all; ?>

    </div>
	<br /><br />
</div>

