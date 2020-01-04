<?php include('customerRate.js.php'); ?>
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
<div class="customer-rating-div">
<div align="left"><img src="<?php echo base_url(); ?>uploads/businesslogo/<?php echo $business_data[0]['business_logo']; ?>" width="107" height="90"/></div>
<div class="ratHead">Thank you for rating <?php echo $business_data[0]['business_name']; ?></div>
<div class="subheadRate">Thank you for taking the time to rate our services. Your opinion really does count, so if you have a moment please let us know what you think.</div>
<div class="rateHelp">(Mouseover star and click to rate.)</div>
<div id="rating_form">
<form name="review-form" id="review-form">
	<div class="ratting-box">
		<div class="rat-head">Rating</div>
		</span><input name="my_input" value="3" id="rating_simple1" type="hidden"><span id="rating_show"></span>
        <div class="spacer"></div>
	</div>
	<div>Comments (Optional)</div>
	<textarea name="review_comments" cols="50" rows="5" id="review_comments" onkeyup="countChar_des(this)"> </textarea>
	<div id="charNum_des" class="txtLimit"></div>
	<a onclick="insertFeedback()" class="subLink" href="javascript:void(0);">Submit</a>
	<input name="local_admin_id" value="<?php echo $local_admin_id; ?>" id="local_admin_id" type="hidden">
	<input name="customer_id" value="<?php echo $customer_id; ?>" id="customer_id" type="hidden">
	<input name="service_id" value="<?php echo $service_id; ?>" id="service_id" type="hidden">
	<input name="employee_id" value="<?php echo $employee_id; ?>" id="employee_id" type="hidden">
	<input name="srvDtls_id" value="<?php echo $srvDtls_id; ?>" id="srvDtls_id" type="hidden">
</form>
</div>	
</div>

