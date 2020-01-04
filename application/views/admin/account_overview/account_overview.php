<?php include('account_overview.js.php'); ?>

<table>
	<tr>
		<td>
			<?php echo $this->lang->line('plan'); ?>: 	  
		</td> 
		<td>
			<?php echo  isset($accountDetails['membership_name'])?$accountDetails['membership_name']:""; ?> <a href="<?php echo base_url(); ?>admin/upgrade_membership"> (Upgrade to premium membership)</a>
		</td>
	</tr>
	<tr>	 
		<td>
			Your billing rate: 
		</td> 
		<td>
			<?php echo  isset($accountDetails['membership_amount'])?$accountDetails['membership_amount']:""; ?>
		</td> 
	</tr>
	<tr>
		<td>
			Last billing:
		</td> 
		<td>
			<?php echo  isset($accountDetails['payment_date'])?$accountDetails['payment_date']:""; ?>
		</td> 
	</tr>
	<tr>
		<td>
			Your next billing: 
		</td> 
		<td>
			<?php echo  isset($accountDetails['next_billing'])?$accountDetails['next_billing']:""; ?>
		</td> 
	</tr>
	<tr>
		<td>
			Bookient member since: 
		</td> 
		<td>
			<?php echo  isset($accountDetails['membership_activation_dt'])?$accountDetails['membership_activation_dt']:""; ?>
		</td> 
	</tr>
</table>	
<br/><br/>
<div class="account-overview" >
	<?php echo  $showAllTransaction; ?>
</div>
