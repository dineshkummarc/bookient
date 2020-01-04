<?php include('staff_settings.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main">Staff Settings</h1>
	<br>
	<div class="save-success"><?php echo $updateSucc;?></div>
<form id="staffSettings" action="" method="POST"><!--<?php //echo base_url(); ?>admin/staff_settings/update_staff_settings	-->
	<table class="list-view" border="0" cellpadding="0" cellspacing="0" width="98%">
	<tr bgcolor="#022157" >
		<td valign="top" width="10%" style="color:#F3F3F3">Name</td>
		<td valign="top" align="center" style="color:#F3F3F3">Log into the system</td>
		<td valign="top" align="center" style="color:#F3F3F3">Choose a calendar view</td>
		<td valign="top" align="center" style="color:#F3F3F3">Creat customer</td>
		<td valign="top" align="center" style="color:#F3F3F3">Verify customer account</td>
		<td valign="top" align="center" style="color:#F3F3F3">Reset customer account password</td>
		<td valign="top" align="center" style="color:#F3F3F3">Invite customer for online scheduling</td>
		<td valign="top" align="center" style="color:#F3F3F3">Edit customer account</td>
		<td valign="top" align="center" style="color:#F3F3F3">Add tags to customer account</td>
		<td valign="top" align="center" style="color:#F3F3F3">Read & edit FAQ </td>
		<td valign="top" align="center" style="color:#F3F3F3">Set working time</td>
		<td valign="top" align="center" style="color:#F3F3F3">Set appointment status</td>
		<td valign="top" align="center" style="color:#F3F3F3">Edit appointment</td>
		<td valign="top" align="center" style="color:#F3F3F3">Cancel appointment</td>
		<td valign="top" align="center" style="color:#F3F3F3">View appointment</td>
		<td valign="top" align="center" style="color:#F3F3F3">Ask review from customer</td>
		<td valign="top" align="center" style="color:#F3F3F3">Export to google calendar</td>
	</tr>
<?php 
	foreach($employeeList AS $employeeListVal){
?>
	<tr>
		<td><?php echo $employeeListVal['employee_name']; ?></td>
		<td align="center"><input type="checkbox" name="logIntoTheSystem_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['logIntoTheSystem']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="chooseACalendarView_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['chooseACalendarView']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="creatCustomer_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['creatCustomer']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="VerifyCustomerAccount_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['VerifyCustomerAccount']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="resetCustomerAccountPassword_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['resetCustomerAccountPassword']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="inviteCustomerForOnlineScheduling_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['inviteCustomerForOnlineScheduling']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="editCustomerAccount_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['editCustomerAccount']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="addTagsToCustomerAccount_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['addTagsToCustomerAccount']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="readNdEditFAQ_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['readNdEditFAQ']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="setWorkingTime_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['setWorkingTime']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="setAppointmentStatus_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['setAppointmentStatus']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="editAppointment_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['editAppointment']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="cancelAppointment_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['cancelAppointment']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="viewAppointment_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['viewAppointment']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="askReviewFromCustomer_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['askReviewFromCustomer']==1?'checked="checked"':'')?>></td>
		<td align="center"><input type="checkbox" name="exportToGoogleCalendar_<?php echo $employeeListVal['app_staff_settings_id']; ?>" value="1" <?php echo ($employeeListVal['exportToGoogleCalendar']==1?'checked="checked"':'')?>></td>
	</tr>
<?php } ?>
	<tr>
		<td align="right" colspan="100"><input type="button" class="btn-blue" id="submitVal" value="Save"/></td>
	</tr>
	</table>
</form>
</div>