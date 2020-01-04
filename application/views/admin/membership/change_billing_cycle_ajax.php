<?php 
$staff_per_location=0;
$max_staff_per_location=0;
	foreach($planDetailsArr as $packageArr){ 	
			if($staff_per_location < $packageArr['staff_per_location']){
				$max_staff_per_location=$packageArr['staff_per_location']; 
			}
			$staff_per_location=$packageArr['staff_per_location'];											
			$billing_cycle =$packageArr['billing_cycle'];					
			if($billing_cycle =="monthly"){	
				$monthlyRate 	= $packageArr['price'];			
				$display_billing_cycle="Monthly";		
			}
			elseif($billing_cycle =="helf_yearly"){
				$helfYearlyRate = $packageArr['price'];			
				$display_billing_cycle="Half Yearly";						
			}
			elseif($billing_cycle =="yearly"){
				$yearlyRate 	= $packageArr['price'];
				$display_billing_cycle="Yearly";					
			}
			if($billing_cycle_frm_ajax ==$packageArr['billing_cycle']){	
				$additional_cost_staff	= $packageArr['additional_cost_location'];		
			}
	}	
	$extra_staff		= 	$staff_per_location_ajax - $max_staff_per_location;
	if($extra_staff >0){
		$extra_price	=	$additional_cost_staff * $extra_staff;
	}
	else{
		$extra_price	= 0;
	}		
	
								
	if($billing_cycle_frm_ajax =="monthly"){	
		$saving 				= '0.0';		
		$price					= $monthlyRate + $extra_price;
		$billed					= "Monthly";
	}
	elseif($billing_cycle_frm_ajax =="helf_yearly"){
		$price					= $helfYearlyRate + $extra_price;
		$yearlyRateByMonth 		= $monthlyRate*12;
		$yearlyRateByHalf 		= $helfYearlyRate*2;
		$saving 				= ($yearlyRateByMonth-$yearlyRateByHalf)/2;	
		$billed					= "Six Monthly";					
	}
	elseif($billing_cycle_frm_ajax =="yearly"){
		$price					= $yearlyRate +$extra_price;
		$yearlyRateByMonth 		= $monthlyRate*12;
		$saving 				= $yearlyRateByMonth-$yearlyRate;	
		$billed					= "Yearly";				
	}			
?>
<table width="100%">
	<tr><td>Price :</td><td>$<span id="price_div_<?php echo $plan_id; ?>"><?php echo number_format($price, 2, '.', ''); ?></span></td></tr>
	<tr><td>Saving :</td><td>$<span id="saving_div_<?php echo $plan_id; ?>"><?php echo number_format($saving, 2, '.', '') ?></span></td></tr>
	<tr><td>Promo : </td><td>$<span id="promo_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
	<tr><td>Discount:</td><td>$<span id="discount_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
	<tr><td colspan="2"><hr style="border-top: dotted 1px;"></td></tr>		
	<tr><td>Total </td><td>$<span id="total_div_<?php echo $plan_id; ?>"><?php echo number_format($price, 2, '.', '') ?></span></td></tr>
</table>
<div id="pakageTerm" class="membershipTerm">Billed <?php echo $billed; ?></div>



