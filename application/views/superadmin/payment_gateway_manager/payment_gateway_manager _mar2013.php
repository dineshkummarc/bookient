
<?php include('payment_gateway_manager.js.php'); ?>
<div class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Payment Gateway Manager</h1>
<div id="add_new_link"  class="margin-adjust">
	<a href="javascript:void(0);" onclick="hide_show_tbl();" class="add-items"><strong><img src="<?php echo base_url(); ?>images/Add-faq.png" alt="" title="Add PAYMENT GATEWAY" />Add Payment Gateway</strong></a>
</div>



<div id="add_faq" style="display:none;">
<form name="faq_frm" id="faq_frm" method="post">
<table width="60%" border="0" cellspacing="0" cellpadding="0" class="credit-table">
  <tr>
    <td style="width:29%;">Payment Gateway Name : </td> 
    <td><input type="text" name="paymentgatewayname" id="paymentgatewayname" value="" style="width:95%;" /> &nbsp; <span id="qstn_err"></span>
	 <input type="hidden" name="payment_gateways_id" id="payment_gateways_id" value="" />
	</td>
  </tr>
  <tr>
   <td style="width:18%;">User Type: &nbsp;</td> 
    <td><select name="payment_gateway" id="payment_gateway" onchange="payment_check();"><?php echo $user_type; ?></select><br/> <span id="utype_select_err"></span>
	</td>
  </tr>
 <!-- <tr>
    <td>Answer : </td>
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
  </tr> -->
  <tr>
  	<td colspan="2" align="center">
    	<input type="button" name="sub_paymentgateway" id="sub_paymentgateway" value="Add" class="btn-blue" onclick=" submit_paymentgateway()" /> 
        &nbsp; 
        <input type="button" name="cancel_paymentgateway" id="cancel_paymentgateway" value="Cancel" class="btn-gray" onclick="cancl_paymentgateway();" />
     </td>
  </tr>
</table>
</form>
</div>

<div id="faq_listing">
<?php echo  $all; ?>
</div>
<br /><br />
</div>

