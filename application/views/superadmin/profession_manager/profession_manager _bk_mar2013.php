<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('profession_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Profession Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add PROFESSION" />Add Profession</strong></a>
</div>


<br /><br />

<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:18%;">Profession Name : </td> 
    <td><input type="text" name="professionname" id="professionname" value="" style="width:125%;" class="required"/> &nbsp; <span id="qstn_err"  class="error"></span>
	 <input type="hidden" name="profession_id" id="profession_id" value="" />
	</td>
  </tr>
 
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_profession" id="sub_profession" value="Add" class="btn-blue" onclick="submit_profession();" /> 
        &nbsp; 
        <input type="button" name="cancel_profession" id="cancel_profession" value="Cancel" class="btn-gray" onclick="cancl_profession();" />
     </td>
  </tr>
</table>
</form>
</div>
<div id="profession_listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
  <thead><tr>
    <th align="left">Sl.No.</th>
    <th align="left">Profession Name</th>    
    <th align="center">Status</th>
    <th align="center">Edit</th>
	<th align="center">Delete</th>
  </tr></thead>
  
  <?php 
  if(count($all) > 0)
  {
	  foreach($all as $key=>$row) { 
		$sl_no = $key+1;  
  ?>
	  <tr>
		<td align="left"><?php echo $sl_no; ?></td>
		<td align="left"><?php echo $row['profession_name']; ?></td>
		
		<td align="center">
		
		<a href="javascript:void(0);" onclick="change_status('<?php echo $row['profession_id']; ?>');">
        <span id="replace_status_<?php echo $row['profession_id']; ?>">
		<?php if($row['is_active'] == 'Y') { ?>
        <img src="<?php echo base_url(); ?>images/tick.png" alt="Active" title="Active" />
        <?php } else { ?>
        <img src="<?php echo base_url(); ?>images/close.png" alt="Inactive" title="Inactive" />
        <?php } ?>
        </span>
        </a>
        </td>
        <td align="center"><a href="javascript:void(0);" onclick="edit_profession('<?php echo $row['profession_id']; ?>');">
        <img src="<?php echo base_url(); ?>images/edit.png" alt="Edit" title="Edit" />
        </a></td>
        <td align="center"><a href="javascript:void(0);" onclick="del_profession('<?php echo $row['profession_id']; ?>');">
        <img src="<?php echo base_url(); ?>images/trash-delete.gif" alt="Delete" title="Delete" />
        </a></td>
	  </tr>
  <?php 
  	} 
  } else {?>
  <tr><td colspan="4" align="center">No Records Found</td></tr>
  <?php } ?>  
</table><div id="status"></div><div id="paginate"></div>
</div>
</div>

