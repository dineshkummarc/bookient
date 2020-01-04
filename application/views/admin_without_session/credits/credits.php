<?php include('credits.js.php'); ?>

<div class="rounded_corner">
<div id="mainDiv" >
    <div id="tabContent">
        <h1 class="headign-main"><span id="innerBussinessHeading"><?php echo $this->lang->line('headign-main'); ?></span></h1>
            <div class="inner-div">
                <div class="inner-div">
                   <h2>
                   You have 0 credit(s) in your account. &nbsp; &nbsp; <span id="who_buy_credits_hide"><a href="javascript:void(0)" onclick="who_buy_credits_show();" style="font-size:10px;">Why buy credits?</a></span>
                   <br /><br />
                   <span id="who_buy_credits" style="display:none;">
                    <p style="padding:5px; background-color:#FFC; color:#000;">
                    This is completely optional. We are charging for this service because we pay for every SMS and Call.
                    </p>
                    <br />
                    <ul>
                    <p style="font-size:14px; font-weight:bold;">Your credits will be used for the following:</p>
                    <br />
                    <li>To verify your client we would send him SMS or Call.</li>
                    <li>Text alerts to client prior to appointment to prevent no shows.</li>
                    <li>Text alerts to admin based on rules set in the admin area.</li>
                    <li>Thank you message to client after appointment.</li>
                    </ul>
                    <br />
                    <p style="font-size:14px;">These settings will not work if you do not have sufficient credits.</p>
                   </span>
                   </h2>
                     <div class="inner-div">
                         <div class="spiffyfg">
                            <span style="font-weight:bold;">Payment history</span><br> 
                                <div class="account-overview">
                                <table width="100%" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <th>Date Purchased</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                       <th>Download Receipt</th> 
                                    </tr>
                                    <?php 
									if(count($CreditList) > 0){ 
									foreach($CreditList as $list) {	  
									?>
                                    <tr>
                                        <td><?php echo date('m/d/Y',strtotime($list['date_purchased'])); ?></td>
                                        <!-- //CB#SOG#17-11-2012#PR#S-->
                                        <td><?php echo $this->session->userdata('local_admin_currency_type');  ?>&nbsp;<?php echo $list['amount']; ?></td>
                                         <!-- //CB#SOG#17-11-2012#PR#E-->
                                        <td><?php echo $list['description']; ?></td>
                                       <td><a href="javascript:void(0)" onclick="download_reciept('<?php echo $list['payment_smscall_credit_history_id']; ?>');">Download</a></td> 
                                    </tr>
                                    <?php }
									}
									else { ?>
                                    <tr>
                                        <td colspan="4" align="center"><strong>No Records Found</strong></td>
                                    </tr>
                                    <?php } ?>
                                </table>
                                </div>
                                <span style="font-weight:bold;">Buy Credits</span><br> 
                                <br>
                                <p> Buy now credits for <strong>call verification</strong>, <strong>SMS verification</strong>, <strong>call alerts</strong> and <strong>SMS alerts</strong>. There is no time limit to consume these credits. Plus, the more credits you buy, the more money you'll save. Select the package that best suits your business needs. </p>
                                <table width="98%" cellpadding="0" cellspacing="0" class="list-view">
                                    <tr>
                                        <th width="1%">&nbsp;</th>
                                        <th width="30%">Packages</th>
                                        <th width="20%">Amount</th>
                                        <th width="19%">Credits</th>
                                        <th width="30%">Description</th>
                                    </tr>
                                    
								<?php
                                $TotArray = count($CreditDtls)-1;
                                ?>
                                    
                                <?php foreach($CreditDtls as $key=>$Credits) { ?>
                                    <tr>
                                        <td><input type="radio" name="credit_type" id="credit_type" value="<?php echo $Credits['smscall_dtls_id']; ?>" checked="checked" onclick="OpenInfo('<?php echo $Credits['smscall_dtls_id']; ?>');" /></td>
                                        <td><?php echo $Credits['package_name']; ?></td>
                                 <td><strong><?php echo $this->session->userdata('local_admin_currency_type');  ?>&nbsp;</strong><?php echo $Credits['amount']; ?></td>
                                        <td><?php echo $Credits['credit']; ?></td>
                                        <td><?php echo $Credits['description']; ?></td>
                                    </tr>
                                    <tr <?php if($key != $TotArray){ ?>style="display:none;"<?php } ?> id="tr_<?php echo $Credits['smscall_dtls_id']; ?>" class="info_tr">
                                    <td colspan="5" bgcolor="#CCCCCC" style="font-size:14px; font-style:italic; color:#000;">
                                        1). One call in Finland costs <span id="call_<?php echo $Credits['smscall_dtls_id']; ?>"><?php echo $Credits['call_rate']; ?></span> cents (approx).
                                        <br />
                                        2). One SMS in Finland costs <span id="sms_<?php echo $Credits['smscall_dtls_id']; ?>"><?php echo $Credits['sms_rate']; ?></span> cents (approx).
                                    </td>
                                    </tr>
                                <?php } ?>    
                                </table>
                                <br />
                                <select name="country" id="country" onchange="GetInfo(this.value);">
                                <option value="14" <?php if($country_selected == '14'){ ?> selected="selected" <?php } ?>>Australia</option>
                                <option value="20" <?php if($country_selected == '20'){ ?> selected="selected" <?php } ?>>Belgium</option>
                                <option value="101" <?php if($country_selected == '101'){ ?> selected="selected" <?php } ?>>India</option>
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="button" name="buy_credits" id="buy_credits" value="Buy Credits" class="btn-blue" />
                            </div>
                     </div>
                </div>
             </div>
        </div>
    </div>
</div>