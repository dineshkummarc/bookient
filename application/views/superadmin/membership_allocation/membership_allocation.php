<?php
$rel = array(); 
$counter = 0;   
foreach($planFeatureRelationArr as $planFeature){
    $rel[$counter] = $planFeature['plan_id'].'_'.$planFeature['feature_id'];
    $counter++;
}   
?>
<?php include('membership_allocation.js.php'); ?>
<div class="rounded_corner_full">
	<h1 class="headign-main">Membership Allocation</h1>
	<br>
	<div class="save-success"><?php //echo $updateSucc;?></div>
<form id="staffSettings" action="" method="POST"><!--<?php //echo base_url(); ?>admin/staff_settings/update_staff_settings	-->
	<table border="0" width="98%" style="margin-bottom:1%; border-color: #ccc; border-radius: 10px; border-right: 1px solid #ccc; border-style: solid; border-width: 1px; margin-left: 1%;">
	    <tr bgcolor="#022157" >
		    <td valign="top" width="3%" style="color:#F3F3F3">&nbsp;</td>
		    <td valign="top" width="80%" style="color:#F3F3F3">Details</td>
            <?php
            //foreach($featureArr as $featureVal){
            foreach($planArr as $planVal){
            ?>
		    <td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->show_to_control($planVal['plan_name']); ?></td>
            <?php
            }
            ?>
	    </tr>
    <?php
    		$INo = 0; 
	    foreach($featureArr as $val=>$featureVal){
	    	$INo++;
    ?>
	    <tr <?php if($val%2 == 0) echo 'bgcolor="#EFF1F2"'; else echo 'bgcolor="#FFFFFF"'; ?>>
	    	<td valign="top" width="3%" ><?php echo $INo; ?>)</td>
		    <td><?php echo $featureVal['feature_name']; ?></td>
            <?php
            foreach($planArr as $planVal){//plan_id___feature_id
            $arr = array('plan_id'=>$planVal['plan_id'],'feature_id'=>$featureVal['feature_id']);
            ?>
		    <td align="center"><input type="checkbox" name="<?php echo $planVal['plan_id']; ?>_<?php echo $featureVal['feature_id']; ?>" value="1" <?php echo ((in_array($planVal['plan_id']."_".$featureVal['feature_id'], $rel))?'checked="checked"':'')?>></td>
            <?php
            }
            ?>
	    </tr>
    <?php } ?>
	    <tr>
		    <td align="right" colspan="100"><input type="button" class="btn-blue" id="submitVal" value="Save"/></td>
	    </tr>
	</table>
</form>
</div>