<?php include('prepayment.js.php'); ?>

<?php

$pre_pmnt_setting=isset($GenSetting[0]['pre_pmnt_setting'])?($GenSetting[0]['pre_pmnt_setting']):0;
//echo '<pre>';
//print_r($PaymentGatewayArray);
?>


<div class="rounded_corner">
<div id="mainDiv" >
    <div id="tabContent">
    <h1 class="headign-main"><span id="innerBussinessHeading"><?php echo $this->lang->line('headign-main'); ?></span></h1>
    <div class="inner-div">
    <p id="PSPrePaymentDisc">
<?php echo $this->lang->line('heading_line_details'); ?></p>
<br />
 	<h2><?php echo $this->lang->line('prepayment_option_heading'); ?></h2>
    <br />

     <div class="inner-div">   
<span id="PSPrePaymentYesNo"><?php echo $this->lang->line('prepayment_option'); ?></span>
                      
                    
    <span id="bussinessDetailInput"><?php echo $this->lang->line('prepayment_option_accept'); ?></span>
       <br /> 
       <table width="15%" border="0" cellspacing="4" cellpadding="0">
  <tr>
    <td> 
<label for="client_choice_1"><input type="radio" name="client_choice" id="client_choice_1" value="1" onClick="SetLocalAdminPaymentSetting(this.value);" <?php if($pre_pmnt_setting != 0){?> checked="checked" <?php } ?>><?php echo $this->lang->line('prepayment_option_yes'); ?></label></td>
    <td>
 &nbsp; <label for="client_choice_2"><input type="radio" name="client_choice" id="client_choice_2" value="0" onClick="SetLocalAdminPaymentSetting(this.value);" <?php if($pre_pmnt_setting == 0){?> checked="checked" <?php } ?>><?php echo $this->lang->line('prepayment_option_no'); ?></label></td>
  </tr>
</table>
  </div>                         
                        
  <div id="HideShowSec" <?php if($pre_pmnt_setting == 0){?> style="display:none" <?php } ?> >
  
  
   <div class="inner-div">
   <div class="warningMsg">
    <img align="absbottom" src="<?php echo base_url().'/images/exclamation.png' ?>"><?php echo $this->lang->line('prepayment_feature_heading'); ?>	</div>
    </div>
             
                
   <h2><?php echo $this->lang->line('prepayment_charge_cash'); ?></h2>
 <div class="inner-div">
    <div class="spiffyfg">
        <span style="font-weight:bold;"><?php echo $this->lang->line('prepayment_payment_charge'); ?></span><br> <br>
        <form name="amount_frm" id="amount_frm" method="post">
        <label for="service_type_1">
        <input type="radio" name="service_type" id="service_type_1" value="1" <?php if(isset($GenSetting[0]['pre_pmnt_setting']) && $GenSetting[0]['pre_pmnt_setting'] == 1){ ?> checked="checked" <?php } ?>>
        &nbsp; <?php echo $this->lang->line('prepayment_full_ser_amnt'); ?>
        </label>
        <br>
		<br>
        <label for="service_type_2">
        <input type="radio" name="service_type" id="service_type_2" value="2" onclick="SetFocusOn('fixed_amount_val');" <?php if(isset($GenSetting[0]['pre_pmnt_setting']) && $GenSetting[0]['pre_pmnt_setting'] == 2){ ?> checked="checked" <?php } ?>>
        &nbsp; <?php echo $this->lang->line('prepayment_charge'); ?> &nbsp; 
        </label>
        <input type="text" name="fixed_amount_val" id="fixed_amount_val"  style="width:120px !important;"class="fixed_amount_val" onfocus="SetChecked('service_type_2');" value="<?php echo (isset($GenSetting[0]['pre_pmnt_val']) && $GenSetting[0]['pre_pmnt_val'] != 0 && $GenSetting[0]['pre_pmnt_setting'] == 2)?$GenSetting[0]['pre_pmnt_val']:'' ; ?>" onkeypress="return floatnumbersonly(this, event)">
        <?php echo $this->session->userdata('local_admin_currency_type'); ?> <?php echo $this->lang->line('prepayment_fixed_bking_fee'); ?>
        <br />
        <span id="msg_label_2" class="error"></span>
        <br>
        <label for="service_type_3"> 
        <input type="radio" name="service_type" id="service_type_3" value="3"  onclick="SetFocusOn('percent_amount_val');" <?php if(isset($GenSetting[0]['pre_pmnt_setting']) && $GenSetting[0]['pre_pmnt_setting'] == 3){ ?> checked="checked" <?php } ?>>
        &nbsp; <?php echo $this->lang->line('prepayment_charge'); ?> &nbsp;
        </label> 
        <input type="text" name="percent_amount_val" id="percent_amount_val" style="width:120px !important;"  onfocus="SetChecked('service_type_3');" value="<?php  echo (isset($GenSetting[0]['pre_pmnt_val']) && $GenSetting[0]['pre_pmnt_val'] != 0 && $GenSetting[0]['pre_pmnt_setting'] == 3)?$GenSetting[0]['pre_pmnt_val']:'' ; ?>" onkeypress="return floatnumbersonly(this, event)">
        <?php echo $this->lang->line('prepayment_precent_srvce_val'); ?>  
        <br />
        <span id="msg_label_3" class="error"></span><span id="msg_label_1" class="error"></span>
        <br />
        <input type="button" name="save_type" id="save_type" value="<?php echo $this->global_mod->db_parse($this->lang->line('save_btn'))?>" class="btn-blue" onclick="SaveValue();" style="margin:0 0 0 21%;">
        <span class="msg-saved" id="msg_label_0"></span><span id="msg_label_4" class="error"></span>
        </br>
        </form>
    </div>
 </div>
 
  <h2><?php echo $this->lang->line('prepayment_payment_gateway'); ?>  </h2>
 
    <div class="inner-div">
    <div class="spiffyfg">
	<?php foreach($PaymentGatewayArray as $key=>$val) { ?>
    <input type="hidden" name="total_paymentgateway_num" id="total_paymentgateway_num" value="<?php echo $val['num']; ?>" />
    <form name="<?php echo 'amount_frm_'.$key; ?>" id="<?php echo 'amount_frm_'.$key; ?>" method="post">
    <?php foreach($val['detail'] as $key1=>$val1) { ?>
    <input type="hidden" name="payment_gateways_id" id="payment_gateways_id" value="<?php echo $val1['payment_gateways_id']; ?>" />
    <h3 style="font-weight:bold;"><?php echo $val1['payment_gateways_name']; ?></h3>
    <?php echo $this->lang->line('prepayment_enable'); ?> <label for="<?php echo 'payment_gateways_enabled_'.$key; ?>">
	<?php echo $val1['payment_gateways_name']; ?> 
    <input type="checkbox" name="payment_gateways_enabled" id="<?php echo 'payment_gateways_enabled_'.$key; ?>" value="<?php echo $val1['payment_gateways_id']; ?>" <?php if(in_array($val1['payment_gateways_id'],$GenSetting[0]['payment_gateways_enabled'])) { ?> checked="checked" <?php } ?> onclick="check_available(this);" />
    </label>
    <?php } ?>
    
    <table width="100%" cellpadding="0" cellspacing="5">
    <?php foreach($val['fields'] as $key2=>$val2) { 
			 if($val2['payment_gateways_id'] == 1)
			 	//$required = 'required email';
				$required = 'required';
			 else
			 	$required = 'required';
	?>
    <tr>
        <td width="20%"><?php echo $val2['field_name']; ?> : </td>
        <td width="80%"><input type="<?php echo $val2['field_type']; ?>" name="<?php echo $val2['payment_gateways_fields_id']; ?>" id="<?php echo $val2['payment_gateways_fields_id']; ?>"  value="<?php echo $val2['values']; ?>" class="<?php echo $required; ?>" /></td>
    </tr>
    <?php } ?>
    </table>
    <br />
    <input type="button"  name="<?php echo 'save_type_'.$key; ?>" id="<?php echo 'save_type_'.$key; ?>" value="<?php echo $this->lang->line('save_btn')?>" class="btn-blue" style="margin:0 0 0 21%;" onclick="SavePaymentGatewayValue('<?php echo $key; ?>');">
    <span id="<?php echo 'msg_'.$key; ?>"></span>
    
    </form>
    <?php 
    }?>
    </div>
    </div>
<h2><?php echo $this->lang->line('prepayment_tax_details'); ?></h2>
<div class="inner-div">
<div class="spiffyfg">
<span style="font-weight:bold;"><?php echo $this->lang->line('prepayment_tax_appointment'); ?></span><br> <br>
<form name="tax_frm" id="tax_frm" method="post">

 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"> <?php echo $this->lang->line('prepayment_tax'); ?> : </td>
    <td>
     <div id="set_list">
        <select name="tax_cat" id="tax_cat" style="width:auto;">
        <?php foreach($CategoryList as $key=>$val) { ?>
            <option value="<?php echo $val['tax_master_id']; ?>"><?php echo $val['tax_title']; ?></option>
        <?php } ?>
        </select> <a href="javascript:void(0);" onclick="not_in_list_textbox();"><?php echo $this->lang->line('prepayment_not_in_list'); ?></a>
     </div>
    </td>
	<td><span id="show_msg_1"></span></td>
  </tr>
  <tr>
    <td width="20%"><?php echo $this->lang->line('prepayment_percentage'); ?> : </td>
    <td> <input type="text" name="tax_rate" id="tax_rate" width="200" style="width:96px !important;" onkeypress="return floatnumbersonly(this, event)" /> %  </td>
    <td><span id="show_msg_2"></span><span id="show_msg_3"></span></td>
  </tr>
  <tr>
    <td>
     <input type="button" name="save_type" id="save_type" value="<?php echo $this->lang->line('save_btn')?>" class="btn-blue" style="margin:0 0 0 101%;" onclick="SaveTax();">
    </td>
    <td></td>
    <td><span id="show_msg_0"></span><span id="show_msg_4"></span></td>
  </tr>
 </table>

</form>                     
</div>
</div> 
 
 <div class="inner-div" style="padding-left:0px;">

 <div class="account-overview" style="width:99%; ">
    <table width="100%" id="tax_details_tbl" cellpadding="0" cellspacing="5">
        <?php
        if(count($TaxList) > 0){
        ?>
        <tr bgcolor="#ECF3FF">
            <th width="25%" align="left"><?php echo $this->lang->line('prepayment_tax'); ?></th>
            <th width="34%" align="left"><?php echo $this->lang->line('prepayment_percentage'); ?></th>
			<th width="41%" align="left"></th>
        </tr>
        <?php 
        foreach($TaxList as $key=>$val) { 
        ?>
        <tr>
            <td width="25%"><?php echo $val['tax_category']; ?></td>
            <td width="34%"><?php echo $val['tax_rate']; ?></td>
            <td width="41%"><a href="javascript:void(0);" onclick="DeleteTaxRecord('<?php echo $val['tax_local_admin_setting_id']; ?>');"><img align="absbottom" src="<?php echo base_url().'/images/trash.png' ?>"></a></td>
        </tr>
        <?php 
        }
        }else{
        ?>
        <tr>
            <td colspan="3" align="center"><?php echo $this->lang->line("no_recrds_found")?></td>
        </tr>
        <?php
        } 
        ?>
    </table>
 </div>
 </div>
 </div>                  
 </div>
        </div>
    </div>
</div>