<?php include('customerrate.js.php'); ?>
<script>
function countChar_des(val){
	var len = val.value.length;
	if (len >= 2500) {
		val.value = val.value.substring(0, 2500);
	}else {
		$('#charNum_des').text(2500 - len+" characters remaining");
	}
};
</script>
<?php
if($business_data[0]['business_logo']){
	$img_url='uploads/businesslogo/'.$business_data[0]['business_logo']; 
}
else{
	$img_url='images/defult_logo.png'; 
}
?>

<div class="customer-rating-div">
<div align="left"><img src="<?php echo base_url(); ?><?php echo $img_url; ?>" width="107" height="90"/></div>
<div class="ratHead"><?php echo $this->global_mod->show_to_control($this->lang->line('thank_you_for_rating'));?> <?php //echo $this->global_mod->show_to_control($business_data[0]['business_name']); ?></div>
<div class="subheadRate"><?php echo $this->global_mod->db_parse($this->lang->line('thank_you_for_rating_long'));?></div>
<div class="rateHelp">(<?php echo $this->global_mod->db_parse($this->lang->line('mouseover_star_and'));?>)</div>
<div id="rating_form">
<form name="review-form" id="review-form">
	<div class="ratting-box">
		<div class="rat-head"><?php echo $this->global_mod->show_to_control($this->lang->line('rating'));?></div>
		<input name="my_input" value="3" id="rating_simple" type="hidden"><span id="rating_show"></span>
        <div class="spacer"></div>
	</div>
	<div><?php echo $this->global_mod->show_to_control($this->lang->line('comments'));?></div>
	<textarea name="review_comments" cols="50" rows="5" id="review_comments" onkeyup="countChar_des(this)"> </textarea>
	<div id="charNum_des" class="txtLimit"></div>
	<a onclick="insertFeedback()" class="subLink" href="javascript:void(0);"><?php echo $this->global_mod->db_parse($this->lang->line('submit_btn'));?></a>
	<input name="local_admin_id" value="<?php echo $local_admin_id; ?>" id="local_admin_id" type="hidden">
	<input name="customer_id" value="<?php echo $customer_id; ?>" id="customer_id" type="hidden">
	<input name="service_id" value="<?php echo $service_id; ?>" id="service_id" type="hidden">
	<input name="employee_id" value="<?php echo $employee_id; ?>" id="employee_id" type="hidden">
	<input name="srvDtls_id" value="<?php echo $srvDtls_id; ?>" id="srvDtls_id" type="hidden">
</form>
</div>	
</div>