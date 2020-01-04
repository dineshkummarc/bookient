<?php include('staff_settings.js.php'); ?>

<div class="rounded_corner_full">
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_setting')); ?></h1>
	<br>
	<div class="save-success"><?php echo $updateSucc;?></div>
<form id="staffSettings" action="" method="POST"><!--<?php //echo base_url(); ?>admin/staff_settings/update_staff_settings	-->
	<table class="list-view" border="0" cellpadding="0" cellspacing="0" width="98%">
	<tr bgcolor="#022157" >
		<td valign="top" width="10%" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_name')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_login_into')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_choose_cal')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_create_customer')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_verify_cus_ac')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_reset_password')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_online_scheduling')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_edit_cus_ac')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_add_tag')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_readandedit')); ?> </td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_cworking_site')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_setappost')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_edit_appo')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_cancelappo')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_view_appo')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_ask_review')); ?></td>
		<td valign="top" align="center" style="color:#F3F3F3"><?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_exportto_google')); ?></td>
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
		<td align="right" colspan="100"><input type="button" class="btn-blue" id="submitVal" value="<?php echo $this->global_mod->db_parse($this->lang->line('Staffsetting_savebtn')); ?>"/></td>
	</tr>
	</table>
</form>
</div>