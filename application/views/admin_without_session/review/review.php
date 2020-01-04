
<?php include('review.js.php'); ?>
 <!-- //CB#SOG#29-11-2012#PR#S-->
<?php


//echo '<pre>';print_r($all);exit;
?>


<script type="text/javascript">
	var maxLength=500;
	function charLimit(el) {
		if (el.value.length > maxLength) return false;
		return true;
	}
	function characterCount(el) {
		var charCount = document.getElementById('charCount');
		if (el.value.length > maxLength) el.value = el.value.substring(0,maxLength);
		if (charCount) charCount.innerHTML = maxLength - el.value.length;
		return true;
	}
</script>



<div style="padding-left:250px;padding-top:50px;width:60%">
<div style="padding-left:250px; width:60%">
<img id="staffImg" src="<?php echo base_url(); ?>uploads/businesslogo/<?php echo $all[1]; ?>" height="80"  />
</div>

<form action="" method="post" name="frm_appointment" id="frm_appointment">
<h1>
<?php echo $this->lang->line('msg'); ?>

</h1>
<hr/>
<br/>
<h4>
Thank you for taking time to rate our services.Your opinion really does count, so if you have a moment please let us know what you think. 
</h4>
<br/><br/>
<label >
Comments (Optional)
</label><br/>
<textarea name="comments" id="comments" onKeyPress="return charLimit(this)" onKeyUp="return characterCount(this)"  rows="8" cols="40"></textarea>


<p><strong><span id="charCount">500</span></strong> more characters remaining for comment.</p>
<input type="hidden" name="urlNumber" id="urlNumber" value="<?php echo $all[0]; ?>" />
<br/><br/>
<input id="submit" class="btn-blue" type="button" onclick="subbmit_comments()" value="Submit" name="Submit">

</form>
<?php


?>

    <div id="show_result">
    </div>
</div>
<!-- //CB#SOG#29-11-2012#PR#S-->