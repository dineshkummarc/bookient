<?php
$rel = array(); 
$cost_arr = array(); 
$counter = 0;   
foreach($creditsCountryCost as $creditsCountryCostVal){
    $rel[$counter] = $creditsCountryCostVal['country_id'].'_'.$creditsCountryCostVal['credit_service_id'];
	$cost_arr[$counter] = $creditsCountryCostVal['cost'];
    $counter++;
} 
?>
<?php include('credit_country_cost.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main">country Credit Cost</h1>
	<br>
	<!-- <div class="save-success"><?php //echo $msg;?></div>-->
<form id="staffSettings" action="" method="POST"><!--<?php //echo base_url(); ?>admin/staff_settings/update_staff_settings	-->
	
		<div id="navWrap">
			<div id="nav">
				<ul>
					<li class="save-success"><?php echo $msg;?></li>
					<li style="float:right;"><input type="hidden" id="credit_id" name="credit_id" value="<?php echo $credit_id; ?>"/><input type="button" class="btn-blue" id="submitVal" value="Save"/></li>
				</ul>
			<br class="clearLeft" />
			</div>
		</div>


	<table class="list-view" border="0" width="98%">		
	    <tr bgcolor="#022157" >
		    <td valign="top" width="33%" style="color:#F3F3F3">Country Name</td>
            <?php
            foreach($serviceTypeArr as $serviceTypeVal){
            ?>
		    	<td valign="top" align="center" style="color:#F3F3F3"><?php echo $serviceTypeVal['title']; ?></td>
            <?php
            }
            ?>
	    </tr>
    <?php foreach($countryArr as $countryVal){ ?>
	    <tr>
		    <td><?php echo $countryVal['country_name']; ?></td>
            <?php foreach($serviceTypeArr as $serviceTypeVal){ ?>
			<?php 
				if(false !== $key = array_search($countryVal['country_id']."_".$serviceTypeVal['credit_service_id'], $rel)){
					$value=$cost_arr[$key];
				} else {
				// do something else
					$value='';
				}
			?>
		    <td align="center"><input type="text" name="<?php echo $countryVal['country_id']; ?>_<?php echo $serviceTypeVal['credit_service_id']; ?>" value="<?php echo $value; ?>" class="each-input" ></td>
            <?php  } ?>
	    </tr>
    <?php } ?>
	    
	</table>
</form>
</div>