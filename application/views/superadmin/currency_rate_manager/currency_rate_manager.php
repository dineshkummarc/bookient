
<script type="text/javascript" src="<?php echo base_url();?>asset/superAdmin_js/country_rate.js"></script>
<div class="superadmin_rounded_corner">
	<h1 class="headign-main">Currency Rate Manager</h1>
	<br>
	<div class="save-success"><?php //echo $updateSucc;?></div>
     

<form action="<?php echo base_url();?>superadmin/currency_rate_manager/saveCurrency"  method="POST" onsubmit="return reform_chk()">

	<table  cellpadding="0" cellspacing="0" width="98%">
		<tr>
			<?php
				foreach($currency_abbriviation as $val){
					echo '<td>'.$val['currency_abbriviation'].'</td>';
				}
			
			?>
		</tr>
		<tr>
			<?php
			//echo "<pre>";
			//print_r($currency_abbriviation);
				foreach($currency_abbriviation as $val){
			?>	
				<td>
					<input type="text" class="currency_box" name="currency[<?php echo $val['currency_abbriviation']?>]" id="<?php echo $val['currency_abbriviation']?>box" value="<?php echo $val['rate'] ?>"  <?php if($val['currency_name'] == "USD")echo "readonly"?> />
				</td>
			<?php		
				}
			
			?>
		</tr>
		<tr>
			<?php
				foreach($currency_abbriviation as $val){
			?>	
					<td><span style="color:red" id="<?php echo $val['currency_abbriviation']?>box_error"></span></td>
			<?php		
				}
			
			?>
		</tr>
		<tr>
			<td align="right" colspan="<?php echo sizeof($currency_abbriviation)?>"><input type="submit" value="Update" /></td>
		</tr>
	</table>
</form>
</div>