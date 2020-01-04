<?php include('servicecategory.js.php'); ?>
<div class="rounded_corner_full">
<h1 class="headign-main"><?php echo $this->lang->line('servicecategory_main'); ?></h1>
<span id="add_new_link" class="add-items" style="width: 10%; float: right; margin-right: 15px;">
	<a href="javascript:void(0);" onclick="hide_show_tbl();"><strong><?php echo $this->lang->line('servicecategory_addbtn'); ?></strong></a>
</span>



<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:15%;"><?php echo $this->lang->line('servicecategory_catname'); ?></td> 
    <td><input type="text" name="categoryname" id="categoryname" value="" style="width:35%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="category_id" id="category_id" value="" />
	</td>
  </tr> 
  <tr>
      <td>&nbsp;</td>
  	<td  align="left">
    	<input type="button" name="sub_servicecategory" id="sub_servicecategory" value="<?php echo $this->global_mod->db_parse($this->lang->line('add_btn'))?>" class="btn-blue" onclick="submit_servicecategory()" style="padding:3px 8px;" /> 
        &nbsp; 
        <input type="button" name="cancel_servicecategory" id="cancel_servicecategory" value="<?php echo $this->lang->line('servicecategory_cancelbtn'); ?>" class="btn-gray" onclick="cancl_servicecategory();" style="padding:3px 8px;"/>
     </td>
  </tr>
</table>
</form>
</div>




<div id="faq_listing">
<?php //echo  $all; ?>
<table class="list-view" width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <th align="left" width="10%"><?php echo $this->lang->line('servicecategory_slno'); ?></th>
        <th align="left" width="50%"><?php echo $this->lang->line('servicecategory_catname'); ?></th>
        <th align="left" width="20%"><?php echo $this->lang->line('servicecategory_status'); ?></th>
        <th align="left" width="20%" colspan="2"><?php echo $this->lang->line('servicecategory_action'); ?></th>
    </tr>    
<?php
if(count($all)>0){
    foreach($all as $key=>$val){
        $sl_no = $key+1;
        if($val['is_active'] == 'Y') {
            $status = '<span id="replace_status_'.$val["category_id"].'"><img src="'.base_url().'images/tick.png" alt="Active" title="Active" /></span>';
        }else{
            $status = '<span id="replace_status_'.$val["category_id"].'"><img src="'.base_url().'images/close.png" alt="Inactive" title="Inactive" /></span>';
        }
?>
    <tr>
        <td align="left"><?php echo $sl_no;?></td>
        <td align="left"><?php echo $val['category_name'];?></td>
        <td align="left"><a href="javascript:void(0);" onclick="change_status(<?php echo $val["category_id"];?>);"><?php echo $status;?></a></td>
        <td align="left"><a href="javascript:void(0);" onclick="edit_servicecategory(<?php echo $val['category_id'];?>);">
            <img src="<?php echo base_url();?>images/edit.png" alt="Edit" title="Edit" /></a>
        </td>
        <td align="left"><a href="javascript:void(0);" onclick="delete_servicecategory(<?php echo $val['category_id'];?>);">
            <img src="<?php echo base_url();?>images/couponcross.png" alt="Delete" title="Delete" /></a>
        </td>
    </tr>
<?php
    }
}else{
?>
    <tr>
        <td colspan="4" align="center"><?php echo $this->lang->line('servicecategory_norecords'); ?></td>
    </tr>
<?php
}
?>
</table>
</div>
<br /><br />
</div>