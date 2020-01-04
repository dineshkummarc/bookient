<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('currency_manager.js.php'); ?>

<div class="superadmin_rounded_corner">
  <h1 class="headign-main-superadmin">Currency Manager</h1>
  <div id="add_new_link"  class="margin-adjust"> <a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add CURRENCY" />Add CURRENCY</strong></a> </div>
  <div id="faq_listing">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
      <tr>
        <th align="left">Sl.No.</th>
        <th align="left">Currency Name</th>
        <th align="left">Currency Abbriviation</th>
        <th align="left">Currency Symbol</th>
        <th align="center">Status</th>
        <th colspan="2"  align="center">Action</th>
      </tr>
      <?php 
  if(count($all) > 0)
  {
	  foreach($all as $key=>$row) { 
		$sl_no = $key+1;  
  ?>
      <tr>
        <td align="left"><?php echo $sl_no; ?></td>
        <td align="left"><?php echo $row['currency_name']; ?></td>
        <td align="left"><?php echo $row['currency_abbriviation']; ?></td>
        <td align="left"><?php echo $row['currency_symbol']; ?></td>
        <td align="center"><a href="javascript:void(0);" onclick="change_status('<?php echo $row['currency_id']; ?>');"> <span id="replace_status_<?php echo $row['currency_id']; ?>">
          <?php if($row['is_active'] == 'Y') { ?>
          <img src="<?php echo base_url(); ?>images/tick.png" alt="Active" title="Active" />
          <?php } else { ?>
          <img src="<?php echo base_url(); ?>images/close.png" alt="Inactive" title="Inactive" />
          <?php } ?>
          </span> </a></td>
        <td align="center"><a href="javascript:void(0);" onclick="edit_currency('<?php echo $row['currency_id']; ?>');"> <img src="<?php echo base_url(); ?>images/edit.png" alt="Edit" title="Edit" /> </a></td>
        <td align="center"><a href="javascript:void(0);" onclick="del_currency('<?php echo $row['currency_id']; ?>');"> <img src="<?php echo base_url(); ?>images/trash-delete.gif" alt="Delete" title="Delete" /> </a></td>
      </tr>
      <?php 
  	} 
  } else {?>
      <tr>
        <td colspan="4" align="center">No Records Found</td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <br />
  <br />
  <div id="add_faq" style="display:none;">
    <form name="faq_frm" id="faq_frm" method="post">
      <table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
        <tr>
          <td style="width:28%;"> Currency Name : </td>
          <td><input type="text" name="currencyname" id="currencyname" value="" style="width:105%;" />
            &nbsp; <span id="curname_err"></span>
            <input type="hidden" name="currency_id" id="currency_id" value="" /></td>
        </tr>
        <tr>
          <td style="width:28%;"> Currency Abbriviation : </td>
          <td><input type="text" name="currencyabbriviation" id="currencyabbriviation" value="" style="width:105%;" />
            &nbsp; <span id="currabb_err"></span></td>
        </tr>
        <tr>
          <td style="width:28%;"> Currency Symbol : </td>
          <td><input type="text" name="currencysymbol" id="currencysymbol" value="" style="width:105%;" />
            &nbsp; <span id="currsym_err"></span></td>
        </tr>
        <td colspan="2" align="center"><input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_currency();" />
            &nbsp;
            <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_currency();" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
