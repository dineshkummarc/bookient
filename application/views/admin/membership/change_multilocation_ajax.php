
<?php 
$staff_per_location=0;
$max_staff_per_location=0;
?>
	<div>
		<div class="pakageHeading">Billing </div>
		<div id="Billing_div_<?php echo $plan_id; ?>">
			<select onchange="showMulBilling('<?php echo $plan_id; ?>',this.value)" name="mulBilling" id="mulBilling_<?php echo $plan_id; ?>" >
				<?php foreach($planDetailsArr as $packageArr){ ?>
					<?php 
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
						$selected = ($billing_cycle == "monthly")?" selected":"";
					?>
					<option value="<?php echo $packageArr['billing_cycle']; ?>" <?php echo  $selected; ?> ><?php echo $display_billing_cycle; ?>&nbsp;($<?php echo $packageArr['price']; ?>)  </option>
				<?php } ?>	
			</select>
		</div>
	</div>

	<br/>
	<div>	
		<div id="staff_div_<?php echo $plan_id; ?>">		
			<div id="staff_show_<?php echo $plan_id; ?>"><?php echo $max_staff_per_location; ?> staff logins allowed: <a onclick="showStaffInput(<?php echo $plan_id; ?>)" href="javascript:void(0);" >add more</a></div>
			<div id="staff_input_<?php echo $plan_id; ?>" style="display: none;">
				<div>Number of staff logins  </div>
				<input type="text" onBlur="showMulStaff('<?php echo $plan_id; ?>',this.value)" name="mulStaff" id="mulStaff_<?php echo $plan_id; ?>" value="<?php echo $max_staff_per_location; ?>" >/per location
				<div><?php echo $max_staff_per_location; ?> staff logins allowed </div>
			</div>
		</div>
	</div>
	<?php						
		$saving = '0.0';						
	?>
	<br/>
	<div id="show_mul_loc_div_<?php echo $plan_id; ?>">
		<table width="100%">
			<tr><td>Price :</td><td>$<span id="price_div_<?php echo $plan_id; ?>"><?php echo number_format($monthlyRate, 2, '.', '') ?></span></td></tr>
			<tr><td>Saving :</td><td>$<span id="saving_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
			<tr><td>Promo : </td><td>$<span id="promo_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
			<tr><td>Discount:</td><td>$<span id="discount_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
			<tr><td colspan="2"><hr style="border-top: dotted 1px;"></td></tr>		
			<tr><td>Total </td><td>$<span id="total_div_<?php echo $plan_id; ?>"><?php echo number_format($monthlyRate, 2, '.', '') ?></span></td></tr>
		</table>
		<div id="pakageTerm" class="membershipTerm">Billed Monthly</div>
	</div>


