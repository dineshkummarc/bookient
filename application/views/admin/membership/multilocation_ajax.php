<?php
$package  	= '';
$mulLocArr	=array();
?>
<div <?php echo ($is_multilocation ==0)?'style="display:none;"':''; ?>  >
	<div class="pakageHeading"><?php echo $this->global_mod->db_parse($this->lang->line('slct_locatn'))?> </div>
	<div id="mulLocation_div_<?php echo $plan_id; ?>">
		<select onchange="showMulLocation('<?php echo $plan_id; ?>',this.value)" name="mulLocation" id="mulLocation_<?php echo $plan_id; ?>" >
		<?php 
		$counter=1; 
		foreach($planDetailsArr as $packageArr){
			if($counter !=1){
				if(!in_array($packageArr['no_of_location'], $mulLocrr)){														
		 ?>
				<option value="<?php echo $packageArr['no_of_location']; ?>"><?php echo $packageArr['no_of_location']; ?></option>
		<?php 
				}
			}
			else{
				$fst_location=$packageArr['no_of_location'];
				?>
				<option value="<?php echo $packageArr['no_of_location']; ?>"><?php echo $packageArr['no_of_location']; ?></option>
				<?php
			}
			$mulLocrr[]=$packageArr['no_of_location'];
			$counter=$counter+1;		
		} 		
		?>	
		</select>
	</div>
</div>

<?php 
$staff_per_location		=	0;
$max_staff_per_location	=	0;
$planDetailsArr  		= 	$this->membership_model->getTierBillingCycleByLocation($plan_id,$fst_location);
?>
<div id="showBlckPerLocation_<?php echo $plan_id; ?>">
	<div>
		<div class="pakageHeading"><?php echo $this->global_mod->db_parse($this->lang->line('billing'))?> </div>
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
			<div id="staff_show_<?php echo $plan_id; ?>"><?php echo $max_staff_per_location; ?> <?php echo $this->global_mod->db_parse($this->lang->line('staff_login_allwd'))?>: <a onclick="showStaffInput(<?php echo $plan_id; ?>)" href="javascript:void(0);" ><?php echo $this->global_mod->db_parse($this->lang->line('add_more'))?></a></div>
			<div id="staff_input_<?php echo $plan_id; ?>" style="display: none;">
				<div><?php echo $this->global_mod->db_parse($this->lang->line('no_of_staff_logins'))?>  </div>
				<input type="text" onBlur="showMulStaff('<?php echo $plan_id; ?>',this.value)" name="mulStaff" id="mulStaff_<?php echo $plan_id; ?>" value="<?php echo $max_staff_per_location; ?>" >/<?php echo $this->global_mod->db_parse($this->lang->line('per_location'))?>
				<div><?php echo $max_staff_per_location; ?> <?php echo $this->global_mod->db_parse($this->lang->line('staff_login_allwd'))?> </div>
			</div>
		</div>
	</div>
	<?php					
		$saving = '0.0';							
	?>
	<br/>
	<div id="show_mul_loc_div_<?php echo $plan_id; ?>">
		<table width="100%">
			<tr><td><?php echo $this->global_mod->db_parse($this->lang->line('price'))?> :</td><td>$<span id="price_div_<?php echo $plan_id; ?>"><?php echo number_format($monthlyRate, 2, '.', '') ?></span></td></tr>
			<tr><td><?php echo $this->global_mod->db_parse($this->lang->line('saving'))?> :</td><td>$<span id="saving_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
			<tr><td><?php echo $this->global_mod->db_parse($this->lang->line('promo'))?> : </td><td>$<span id="promo_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
			<tr><td><?php echo $this->global_mod->db_parse($this->lang->line('discount'))?>:</td><td>$<span id="discount_div_<?php echo $plan_id; ?>">0.00</span></td></tr>
			<tr><td colspan="2"><hr style="border-top: dotted 1px;"></td></tr>		
			<tr><td><?php echo $this->global_mod->db_parse($this->lang->line('total'))?> </td><td>$<span id="total_div_<?php echo $plan_id; ?>"><?php echo number_format($monthlyRate, 2, '.', '') ?></span></td></tr>
		</table>
		<div id="pakageTerm" class="membershipTerm"><?php echo $this->global_mod->db_parse($this->lang->line('billed_mnthly'))?></div>
	</div>
</div>
<div id="memberChoosePlan" class="membershipButton" onclick="selectPlan('<?php echo $plan_id; ?>','<?php echo $is_multilocation; ?>')"> <?php echo $this->global_mod->db_parse($this->lang->line('choose'))?> </div>

