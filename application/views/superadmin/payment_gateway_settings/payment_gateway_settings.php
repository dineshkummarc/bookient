<?php include('payment_gateway_settings.js.php'); ?>
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Payment Gateway Settings Manager</h1>
    <div class="inner-div">
    <div class="spiffyfg">
    <form id="form-business">
	<?php foreach($PaymentGatewayArray as $key=>$val) { ?>
    <?php foreach($val['detail'] as $key1=>$val1) { ?>
    <h3 style="font-weight:bold;"><?php echo $val1['payment_gateways_name']; ?></h3>
    <?php } ?>
    
    <table width="100%" cellpadding="0" cellspacing="5">
    <?php foreach($val['fields'] as $key2=>$val2) { 
			 if($val2['payment_gateways_id'] == 1)
			 	$required = 'required email';
			 else
			 	$required = 'required';
	?>
    <tr>
        <td width="20%"><?php echo $val2['field_name']; ?> : </td>
        <td width="80%"><input type="<?php echo $val2['field_type']; ?>" name="<?php echo $val2['payment_gateways_fields_id']; ?>" id="<?php echo $val2['payment_gateways_fields_id']; ?>"  value="<?php echo $val2['values']; ?>" class="<?php echo $required; ?>" /></td>
    </tr>
    <?php } ?>
    </table>
    <?php 
    }?>
    <div style="margin:20px 0 0 0; text-align:center;"><input type="button" name="save_business" value="save"  id="btn-submit1"  class="btn-blue" onclick="SavePaymentGatewayValues();"><br /><span id="msg_span" style="font-size:14px;"></span>
    </div>
    </form>     
	</div>
    </div>
</div>

