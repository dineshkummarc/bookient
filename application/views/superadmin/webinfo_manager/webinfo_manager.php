<script type="text/javascript" src="<?php echo base_url(); ?>js/fck/ckeditor.js"></script>
<script src="<?php echo base_url(); ?>js/fck/sample.js" type="text/javascript"></script>
<?php include('webinfo_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Webinfo Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add FAQ" />Add Item</strong></a>
</div>




<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:18%;">Name : </td>
    <td><input type="text" name="question" id="question" value="" style="width:125%;" class="required"/> &nbsp; <span id="qstn_err" class="error"></span></td>
  </tr>
  <tr>
    <td>Content : </td>
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
  </tr>
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_faq" id="sub_faq" value="Add" class="btn-blue" onclick="submit_faq();" /> 
        &nbsp; 
        <input type="button" name="cancel_faq" id="cancel_faq" value="Cancel" class="btn-gray" onclick="cancl_faq();" />
     </td>
  </tr>
</table>
</form>
</div>



<div id="faq_listing">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="super-listing-tabl">
 <thead> <tr>
    <th align="left">Sl.No.</th>
    <th align="left">Name</th>
    <th align="left">Content</th>
   <!-- <th align="center">Status</th>-->
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
                

                <!-- //CB#SOG#9-1-2013#PR#S-->
		<td align="left"><?php echo $sl_no; ?></td>
                 <?php 
                   
                    $f_ques =  $row['name'];
                ?>
		<td align="left"><?php echo $f_ques; ?></td>
                <?php 
                    $val = str_replace("&nbsp;",'',strip_tags($row['content']));
                    $f_ans = (strlen($val)>20) ? substr($val,0,20).'...' : $val;
                ?>
		<td align="left"><?php echo $f_ans;  ?></td>
                <!-- //CB#SOG#9-1-2013#PR#E-->
		<!--<td align="center">
		<a href="javascript:void(0);" onclick="change_status('<?php echo $row['faq_id']; ?>');">
        <span id="replace_status_<?php echo $row['faq_id']; ?>">
		<?php if($row['is_active'] == 'Y') { ?>
        <img src="<?php echo base_url(); ?>images/tick.png" alt="Active" title="Active" />
        <?php } else { ?>
        <img src="<?php echo base_url(); ?>images/close.png" alt="Inactive" title="Inactive" />
        <?php } ?>
        </span>
        </a>
        </td>-->
        <td align="center"><a href="javascript:void(0);" onclick="edit_faq('<?php echo $row['id']; ?>');">
        <img src="<?php echo base_url(); ?>images/edit.png" alt="Edit" title="Edit" />
        </a></td>
        <td align="center"><a href="javascript:void(0);" onclick="del_faq('<?php echo $row['id']; ?>');">
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

