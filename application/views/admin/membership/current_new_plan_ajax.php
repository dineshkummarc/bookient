<?php 
	$staff_per_location_check=0;
	$max_staff_per_location=0;
	$newDate1 = date('Y-m-d');
	//echo "<pre>";print_r($newPlanTierDetailsArr);exit;
	//if($is_multilocation == 1){
		foreach($newPlanTierDetailsArr as $packageArr){ 
			if($staff_per_location_check < $packageArr['staff_per_location']){
				$max_staff_per_location=$packageArr['staff_per_location']; 
			}
			$staff_per_location_check = $packageArr['staff_per_location'];
								
			if($packageArr['billing_cycle'] =="monthly"){	
				$monthlyRate 	= $packageArr['price'];	
					
			}
			elseif($packageArr['billing_cycle'] =="helf_yearly"){
				$helfYearlyRate = $packageArr['price'];
										
			}
			elseif($packageArr['billing_cycle'] =="yearly"){
				$yearlyRate 	= $packageArr['price'];
						
			}
			if($billing_cycle ==$packageArr['billing_cycle']){	
				$additional_cost_staff	= $packageArr['additional_cost_location'];		
			}

		}	
		$extra_staff		= 	$staff_per_location - $max_staff_per_location;
		if($extra_staff >0){
			$extra_price	=	$additional_cost_staff * $extra_staff;
		}
		else{
			$extra_price	= 0;
		}	
		if($billing_cycle =="monthly"){	
			$saving 				= '0.0';		
			$price					= $monthlyRate + $extra_price;
			$newDate = date("M d,Y", strtotime($newDate1 ." +1 month") );
			$display_billing_cycle	= "Monthly";	
		}
		elseif($billing_cycle =="helf_yearly"){
			$price					= $helfYearlyRate + $extra_price;
			$yearlyRateByMonth 		= $monthlyRate*12;
			$yearlyRateByHalf 		= $helfYearlyRate*2;
			$saving 				= ($yearlyRateByMonth-$yearlyRateByHalf)/2;
			$newDate 				= date("M d,Y", strtotime($newDate1 ." +6 month") );	
			$display_billing_cycle	= "Half Yearly";					
		}
		elseif($billing_cycle =="yearly"){
			$price					= $yearlyRate +$extra_price;
			$yearlyRateByMonth 		= $monthlyRate*12;
			$saving 				= $yearlyRateByMonth-$yearlyRate;
			$newDate 				= date("M d,Y", strtotime($newDate1 ." +12 month") );	
			$display_billing_cycle  = "Yearly";				
		}
		/*
	}
	else{	
		$price=$newPlanTierDetailsArr[0]['price'];	
		//$single_plan_id = $newPlanTierDetailsArr[0]['plan_id'];
		
		//print_r($newPlanTierDetailsArr);
		//exit;
		
		$billing_cycle=	$newPlanTierDetailsArr[0]['billing_cycle'];	
		if($billing_cycle =="monthly"){			
			$newDate = date("M d,Y", strtotime($newDate1 ." +1 month") );
			$display_billing_cycle="Monthly";
		}
		elseif($billing_cycle =="helf_yearly"){
			$newDate 				= date("M d,Y", strtotime($newDate1 ." +6 month") );	
			$display_billing_cycle	= "Half Yearly";					
		}
		elseif($billing_cycle =="yearly"){
			$newDate 				= date("M d,Y", strtotime($newDate1 ." +12 month") );	
			$display_billing_cycle  = "Yearly";				
		}		
	}	
	*/
?>
<script>
	$(".pamentRadios").change(function(){
		$('#paymentPaypal').toggle();
		$('#pay_first_name').focus();
	})
</script>
<style>
	#pay_cvv{
		width:28%;
	}
</style>
<div id="choosePaymentOption">
<div class="compareMembershipMainDiv">
    <div class="compareHeading">
        <?php echo $this->global_mod->db_parse($this->lang->line('confrm_subscrptn_chnge'))?>
    </div>
    <div style="clear: both;"></div>
    <div style="width: 100%">
    <div class="membershipDetailComparefrom">
        <div class="compareHeadingSub">
            <?php echo $this->global_mod->db_parse($this->lang->line('from'))?>
        </div>
        <div class="comparePoints">
            <ul>			
                <li>
                <?php if($currentPlanDetailsArr[0]['is_multilocation'] ==1){ ?>
				<?php $cur_details=$this->membership_model->getPlanDetails($currentPlanDetailsArr[0]['plan_id']); ?>
					 <?php echo $cur_details[0]['plan_name']; ?>(<?php echo $currentPlanDetailsArr[0]['no_of_location']; ?>) <?php echo $this->global_mod->db_parse($this->lang->line('membershp'))?>
				<?php }else{ ?>	
					<?php echo $cur_details[0]['plan_name']; ?> <?php echo $this->global_mod->db_parse($this->lang->line('membershp'))?>			
				<?php } ?>	
                </li>               
                <li>
				<?php
                    if($currentPlanDetailsArr[0]['billing_cycle'] =="monthly"){			
						$display_billing_cycle_cur="Monthly";
					}
					elseif($currentPlanDetailsArr[0]['billing_cycle'] =="helf_yearly"){
						$display_billing_cycle_cur	= "Half Yearly";					
					}
					elseif($currentPlanDetailsArr[0]['billing_cycle'] =="yearly"){
						$display_billing_cycle_cur  = "Yearly";				
					}	
				?>
					<?php echo $display_billing_cycle_cur; ?> <?php echo $this->global_mod->db_parse($this->lang->line('plan'))?>
                </li>   
				<?php if($currentPlanDetailsArr[0]['is_multilocation'] ==1){ ?>             
                <li>
					<?php echo $currentPlanDetailsArr[0]['staff_per_location']; ?> <?php echo $this->global_mod->db_parse($this->lang->line('staff_login_include'))?>
                </li>
				<li> 
					<?php echo $this->global_mod->db_parse($this->lang->line('addtionl_staff_login'))?>:<?php echo $currentPlanDetailsArr[0]['extra_staff']; ?>   
				</li>        
                <li>
					<?php echo $this->global_mod->db_parse($this->lang->line('location'))?>: <?php echo $currentPlanDetailsArr[0]['no_of_location']; ?>
                </li>
				<?php } ?>                
                <li>                    
                    <?php echo $this->global_mod->db_parse($this->lang->line('next_billing'))?>: $<?php echo $currentPlanDetailsArr[0]['total_amt']; ?> (<?php echo date("M d,Y", strtotime($currentPlanDetailsArr[0]['plan_expiry_date']) ); ?>)                   
                </li>                
            </ul>
        </div>
    </div>
    <div class="membershipDetailCompareto">
        <div class="compareHeadingSub">
            <?php echo $this->lang->line('to')?>
        </div>
        <div class="comparePoints">
            <ul>
                <li>
				<?php if($is_multilocation ==1){ ?>
					 <?php echo $newPlanDetailsArr[0]['plan_name']; ?>(<?php echo $no_of_location; ?>) <?php echo $this->global_mod->db_parse($this->lang->line('membershp'))?>
				<?php }else{ ?>	
					<?php echo $newPlanDetailsArr[0]['plan_name']; ?> <?php echo $this->global_mod->db_parse($this->lang->line('membershp'))?>			
				<?php } ?>	
                </li>
                <li>
				
                   <?php echo $display_billing_cycle; ?> <?php echo $this->global_mod->db_parse($this->lang->line('plan'))?>
                </li>    											
				
				            
                <li>				
					<?php echo $max_staff_per_location; ?> <?php echo $this->global_mod->db_parse($this->lang->line('staff_login_include'))?>					
                </li>               
				<?php 										
					if($extra_staff >0){
				?>
				<li>
					<?php echo $this->global_mod->db_parse($this->lang->line('addtionl_staff_login'))?>:
					<?php echo $extra_staff; ?>
				</li> 
					<?php } ?> 
					<?php  if($is_multilocation ==1){ ?>                           
                <li>
					<?php echo $this->global_mod->db_parse($this->lang->line('location'))?>: <?php echo $no_of_location; ?>
                </li>               
               <?php } ?>			   			   			   
			   <li>   
				<?php
					
					?>                
                    <?php echo $this->global_mod->db_parse($this->lang->line('next_billing'))?>: $<?php echo $price; ?> (<?php echo $newDate; ?>)                    
                </li>               
                           
            </ul>
        </div>
    </div>
    </div>
    <div style="clear: both;"></div>
    <div class="radioContener">
    	<input name="paymentType" class="pamentRadios" type="radio"/>&nbsp; <?php echo $this->global_mod->db_parse($this->lang->line('paypal'))?>
    	<!-- /	 <input name="paymentType" class="pamentRadios" type="radio"/>DotNet -->
    </div>
    <div style="clear: both;"></div>
    <div style="display: none" id="paymentPaypal">
    <?php
    $str='';
        $str.='<form name="frm_paymentDetails" id="frm_paymentDetails" method="post" onsubmit="return false;">';        
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="bookung_tab">';
        $str.='<tr class="booking_tab_row_top">';
        $str.='<td align="left"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_payment_details')).' :</b></td>';//Payment details
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left"><hr style="width:100%;"></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td>';
            $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_first_name')).':<label style="color:#FF0000">*</label></td>';//First Name
            $str.='<td width="60%" align="left"><input value="" tabindex="1" name="pay_first_name" id="pay_first_name" type="text" class="payBooking pf_required" /></td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_last_name')).':<label style="color:#FF0000">*</label></td>';//Last Name
            $str.='<td width="60%" align="left"><input value="" tabindex="2" name="pay_last_name" id="pay_last_name" type="text" class="payBooking pf_required" /></td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_amount')).':<label style="color:#FF0000">*</label></td>';//Amount
            $str.='<td width="60%" align="left"><input name="pay_amount" tabindex="3" id="pay_amount" type="text" class="payBooking pf_required" readonly value="'.$price.'" /></td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_cc_type')).':<label style="color:#FF0000">*</label></td>';//CC Type
            $str.='<td width="60%" align="left">';
                    $str.='<select id="pay_cardtype" tabindex="4" name="pay_cardtype" class="payBookingSelect payBooking_select pf_required">';
                    $str.='<option value="">Select Card</option>';
                    $str.='<option value="Visa">Visa</option>';
                    $str.='<option value="MasterCard">MasterCard</option>';
                    $str.='<option value="Discover">Discover</option>';
                    $str.='<option value="Amex">American Express</option>';
                    $str.='</select>';
            $str.='</td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_creditcard_number')).':<label style="color:#FF0000">*</label></td>';//Creditcard Number
            $str.='<td width="60%" align="left"><input value="" tabindex="5" name="pay_ccnumber" id="pay_ccnumber" type="text" class="payBooking pf_required" onkeydown="isNumber(event)"/></td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_expiry_date')).':<label style="color:#FF0000">*</label></td>';//Expiry Date
            $str.='<td width="60%" align="left">';
                    $str.='<select id="pay_month" name="pay_month" tabindex="6"class="payBookingSelect payBooking_select_sm pf_required">';
                    $str.='<option value="">'.$this->global_mod->db_parse($this->lang->line('mobile_select_month')).'</option>';//Select Month
                    $str.='<option value="1">'.$this->global_mod->db_parse($this->lang->line('cal_jan')).'</option>';//Jan
                    $str.='<option value="2">'.$this->global_mod->db_parse($this->lang->line('cal_feb')).'</option>';//Feb
                    $str.='<option value="3">'.$this->global_mod->db_parse($this->lang->line('cal_mar')).'</option>';//Mar
                    $str.='<option value="4">'.$this->global_mod->db_parse($this->lang->line('cal_apr')).'</option>';//Apr
                    $str.='<option value="5">'.$this->global_mod->db_parse($this->lang->line('cal_may')).'</option>';//May
                    $str.='<option value="6">'.$this->global_mod->db_parse($this->lang->line('cal_jun')).'</option>';//Jun
                    $str.='<option value="7">'.$this->global_mod->db_parse($this->lang->line('cal_jul')).'</option>';//Jul
                    $str.='<option value="8">'.$this->global_mod->db_parse($this->lang->line('cal_aug')).'</option>';//Aug
                    $str.='<option value="9">'.$this->global_mod->db_parse($this->lang->line('cal_sep')).'</option>';//Sep
                    $str.='<option value="10">'.$this->global_mod->db_parse($this->lang->line('cal_oct')).'</option>';//Oct
                    $str.='<option value="11">'.$this->global_mod->db_parse($this->lang->line('cal_nov')).'</option>';//Nov
                    $str.='<option value="12">'.$this->global_mod->db_parse($this->lang->line('cal_dec')).'</option>';//Dec
                    $str.='</select> &nbsp;&nbsp;';
                    $str.='<select id="pay_year" name="pay_year"  tabindex="7" class="payBookingSelect payBooking_select_sm pf_required">';
                    $str.='<option value="">'.$this->global_mod->db_parse($this->lang->line('mobile_select_year')).'</option>';//Select Year
                    for($y=date('Y');$y<date('Y')+18;$y++){
                        $str.='<option value="'.$y.'">'.$y.'</option>';
                    }
                    $str.='</select>';
            $str.='</td>';
            $str.='</tr>';
            $str.='<tr>';
            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_cvv')).':<label style="color:#FF0000">*</label></td>';//CVV
            $str.='<td width="60%" align="left"><input value="" tabindex="8" name="pay_cvv" id="pay_cvv" type="text" class="payBooking pf_required" maxlength="3" onkeydown="isNumber(event)"/></td>';
            $str.='</tr>';
            $str.='</table>';
            $str.='</td>';	
    		$str.='</tr>';
            $str.='<tr class="booking_tab_row_footer">';
    $str.='<td align="center">';
    
   	//if($is_multilocation == 1){ 
	$str.='<div onclick="choosePlanMultilocation('.$plan_id.')" tabindex="9" style="margin-left: 180px; text-align: center; margin-top: 20px;" class="membershipButton">Update</div>';
	/*}else{
	$str.='<div onclick="choosePlanMultilocation('.$plan_id.')" style="margin-left: 180px; text-align: center; margin-top: 20px;" class="membershipButton">Update</div>';
	}*/
	$str.='</td>';//Payment
    $str.='</tr>';
            $str.='</table>';          
            
    $str.='</form>'; 
            echo $str;
    ?>
    </div>
</div>
</div>