<?php
$package = '';
 $package .= '<form id="plan"><div class="pakageHeading">Billing</div>';
	        $package .= '<input type="hidden" name="planId" id="planId" value="'.$planDetailsArr[0]['plan_id'].'">';
	        $package .= '<select name="packagePrice" id="packagePrice-'.$plan_id.'" onchange=showDetailsTier('.$plan_id.',this.value)>';
	        foreach($planDetailsArr as $packageArr){
	            $selected = ($packageArr['billing_cycle'] == "monthly")?" selected":"";
	            $package .= '<option value="'.$packageArr['tierprice_id'].'" '.$selected.'>';//
	            $billing_cycle = ($packageArr['billing_cycle'] == "helf_yearly")?"Half Yearly":$packageArr['billing_cycle'];
	            $package .= ucfirst($billing_cycle)."  &nbsp;($".number_format($packageArr['price'], 2, '.', '').") &nbsp;";
	            $package .= '</option>';
	        }
	        $package .= '</select>';
	        $package .= '<br><br>Apply Coupon';
	        foreach($planDetailsArr as $priceArr){
	            if($priceArr['billing_cycle'] == 'monthly'){
	                $monthlyRate = $priceArr['price'];
	            }
	            if($priceArr['billing_cycle'] == 'helf_yearly'){
	                $helfYearlyRate = $priceArr['price'];
	            }
	            if($priceArr['billing_cycle'] == 'yearly'){
	                $yearlyRate = $priceArr['price'];
	            }
	        }

	        foreach($planDetailsArr as $detailsArr){
	            if($detailsArr['billing_cycle'] == "monthly"){
	                $visibility = 'style="display: block;"';
	            }else{
	                $visibility = 'style="display: none;"';
	            }
	            $package .= '<div class="plan-tireprice-details" id="'.$plan_id.'-details-'.$detailsArr['tierprice_id'].'" '.$visibility.'>';
	            //$package .= 'Price : &nbsp;&nbsp; $'.number_format($detailsArr['price'], 2, '.', '').'<br>';
	            if($detailsArr['billing_cycle'] == 'monthly'){
	               /*
				    $package .= 'Saving : &nbsp;&nbsp; $0.00<br>';
	                $package .= 'Promo : &nbsp;&nbsp; $0.00<br>';
	                $package .= 'Discount : &nbsp;&nbsp; $0.00<br>';
	                $package .= '<hr style="border-top: dotted 1px;" />';					
	                $package .= 'Total &nbsp;&nbsp; $'.number_format($detailsArr['price'], 2, '.', '').'<br>';
					*/
					
					$package .= '<table width="100%">
						<tr><td>Price :</td><td>$<span id="price_div_'.$plan_id.'">'.number_format($detailsArr['price'], 2, '.', '').'</span></td></tr>
						<tr><td>Saving :</td><td>$<span id="saving_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td>Promo : </td><td>$<span id="promo_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td>Discount:</td><td>$<span id="discount_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td colspan="2"><hr style="border-top: dotted 1px;"></td></tr>		
						<tr><td>Total </td><td>$<span id="total_div_'.$plan_id.'">'.number_format($detailsArr['price'], 2, '.', '').'</span></td></tr>
					</table>';
					
					
	            }elseif($detailsArr['billing_cycle'] == 'helf_yearly'){
	                $yearlyRateByMonth = $monthlyRate*12;
	                $yearlyRateByHalf = $helfYearlyRate*2;
	                $savingsHalfYearly = ($yearlyRateByMonth-$yearlyRateByHalf)/2;
					/*
	                $package .= 'Saving : &nbsp;&nbsp; $'.number_format($savingsHalfYearly, 2, '.', '').'<br>';
	                $package .= 'Promo : &nbsp;&nbsp; $0.00<br>';
	                $package .= 'Discount : &nbsp;&nbsp; $0.00<br>';
	                $package .= '<hr style="border-top: dotted 1px;" />';
	                $package .= 'Total &nbsp;&nbsp; $'.number_format($detailsArr['price'], 2, '.', '').'<br>';
					*/
					$package .= '<table width="100%">
						<tr><td>Price :</td><td>$<span id="price_div_'.$plan_id.'">'.number_format($detailsArr['price'], 2, '.', '').'</span></td></tr>
						<tr><td>Saving :</td><td>$<span id="saving_div_'.$plan_id.'">'.$savingsHalfYearly.'</span></td></tr>
						<tr><td>Promo : </td><td>$<span id="promo_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td>Discount:</td><td>$<span id="discount_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td colspan="2"><hr style="border-top: dotted 1px;"></td></tr>		
						<tr><td>Total </td><td>$<span id="total_div_'.$plan_id.'">'.number_format($detailsArr['price'], 2, '.', '').'</span></td></tr>
					</table>';
	            }else{
	                $yearlyRateByMonth = $monthlyRate*12;
	                $savingsYearly = $yearlyRateByMonth-$yearlyRate;
					/*
	                $package .= 'Saving : &nbsp;&nbsp; $'.number_format($savingsYearly, 2, '.', '').'<br>';
	                $package .= 'Promo : &nbsp;&nbsp; $0.00<br>';
	                $package .= 'Discount : &nbsp;&nbsp; $0.00<br>';
	                $package .= '<hr style="border-top: dotted 1px;" />';
	                $package .= 'Total &nbsp;&nbsp; $'.number_format($detailsArr['price'], 2, '.', '').'<br>';
					*/
					$package .= '<table width="100%">
						<tr><td>Price :</td><td>$<span id="price_div_'.$plan_id.'">'.number_format($detailsArr['price'], 2, '.', '').'</span></td></tr>
						<tr><td>Saving :</td><td>$<span id="saving_div_'.$plan_id.'">'.$savingsYearly.'</span></td></tr>
						<tr><td>Promo : </td><td>$<span id="promo_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td>Discount:</td><td>$<span id="discount_div_'.$plan_id.'">0.00</span></td></tr>
						<tr><td colspan="2"><hr style="border-top: dotted 1px;"></td></tr>		
						<tr><td>Total </td><td>$<span id="total_div_'.$plan_id.'">'.number_format($detailsArr['price'], 2, '.', '').'</span></td></tr>
					</table>';
	            }
	            $package .= '<div id="memberChoosePlan" class="membershipButton" onclick="selectPlan('.$plan_id.','.$is_multilocation.')"> Choose </div>';
	            $package .= '</div>';
	        }
			$package .= '</form>';

echo $package;
?>