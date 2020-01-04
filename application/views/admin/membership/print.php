 <?php
 		$billing_cycle =$planArr[0]['billing_cycle'];
		$billing_cycle_display='';
 		if($billing_cycle =="monthly"){
			$billing_cycle_display = 'Monthly(30 days)';
		}
		elseif($billing_cycle =="helf_yearly"){
			$billing_cycle_display = 'Half Yearly(6 Month)';
		}
		elseif($billing_cycle =="yearly"){
			$billing_cycle_display = 'Yearly(12 Month)';
		}
 ?>
<?php 
	$current_url	=	current_url(); 
	$exp			=	explode('.',$current_url);
	//$exp1			=	explode('/',$exp[1]);
	$url			=	$exp[1];
?>
 
 <div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;"><h1 align="center"><?php echo $SuperadminDetails[0]['organisation_name']; ?></h1></div> 
         <h5 align="center">
		 <?php echo $SuperadminDetails[0]['address'] ?>,<?php echo $SuperadminDetails[0]['city_name'] ?>,<?php echo $SuperadminDetails[0]['region_name'] ?>,<?php echo $SuperadminDetails[0]['country_name'] ?>		 
		 </h5> 
       
         <strong>Receipt#<?php  echo $plan_subscription_id  ?></strong><br /> 
         Date: <?php  echo date('n/j/Y g:i:s',strtotime($planArr[0]['subscription_date'])) ?>      
         <strong>Billing Information</strong><br /> 

         <strong>Paid:</strong><?php  echo $planArr[0]['currency_symbol'].$planArr[0]['total_amt']  ?><br /> 
         <hr> 
		 <div style="width:100%"> 
         <div style="float:left; display:block;width:40%;"> 
         <strong>Name</strong><br /><?php  echo $planArr[0]['plan_name']  ?>, <?php  echo $planArr[0]['plan_desc']  ?>, <?php  echo $billing_cycle_display; ?>
         </div><div style="float:left; display:block;width:30%;"> 
         <strong>Membership Valid Till</strong><br /><?php  echo date('d-M-Y',strtotime($planArr[0]['plan_expiry_date'])) ?>
         </div><div style="float:left; display:block; width:30%; text-align:center;"> 
         <strong>Amount</strong><br /><?php  echo $planArr[0]['currency_symbol'].$planArr[0]['total_amt'] ?>
         </div> 
         </div> 
         <hr> 
         <div style="width:100%;float:right;display:block;"> 
         <strong>Total(<?php  echo $planArr[0]['currency_name']  ?>)</strong>: <?php  echo $planArr[0]['currency_symbol'].$planArr[0]['total_amt']; ?>
         </div> 
       
       
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>	
<script type="text/javascript">
	$(document).ready(function(){
		window.print();
	});   
</script>
	