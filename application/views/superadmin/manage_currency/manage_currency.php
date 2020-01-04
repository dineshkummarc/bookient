<script type="text/javascript">
function submit_subs(){
	var selectval = $('.design :selected').val();
	var params = {'text': selectval};
	$.ajax({
		type: 'POST',
		url: '<?php echo site_url("superadmin/manage_currency/SaveAjax"); ?>',
		data: params,
		success: function(data){
            location.reload();
		}
	});
}

</script>

<style type="text/css">
design {
    background: none repeat scroll 0 0 #EBEBEB;
    border: 1px solid #D3D3D3;
    border-radius: 5px 5px 5px 5px;
    height: 25px;
    padding: 1px;
    width: 67%;
}
</style>


<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Currency Manager</h1>


<div align="left" style="color:#FF0000; margin-left:500px;" ><?php echo $this->session->flashdata('status_massage'); ?></div>

   <div id="add_faq" style="">
   <div  align="center" style="padding:30px;">
    Currency Type: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $all; ?>

  <br/><br/><br/>
   <input type="button" name="sub_subs" id="sub_subs" value="Add" class="btn-blue"  style="margin-left:0px;"onclick="submit_subs();" />
    </div>
   </div>
</div>