<?php include('gcal.js.php'); ?>

<div class="rounded_corner_full">
<h1 class="headign-main"><?php echo $this->lang->line('heading_main');?></h1>
    <br>
	<h2><?php echo $this->lang->line('google_login_details');?><?php echo $this->session->userdata('time_difference_gcal')?></h2>
	<form action="" method="POST" onsubmit="return false">
	<table width="80%" style="padding-left:30px">
		<tr>
			<td colspan="2" align="left"> <span id="msgGcal"></<span></span> </td>
		</tr>
		<tr>
			<td> <?php echo $this->lang->line('email');?> </td>
			<td><input class="text-input" type="text" size="50px" value="" name="gcal_email" id="gcal_email"></td>
		</tr>
		<tr>
			<td> <?php echo $this->lang->line('password');?> </td>
			<td><input class="text-input" type="password" size="50px" value="" name="gcal_password" id="gcal_password"></td>
		</tr>
		<tr>
			<td> <?php echo $this->lang->line('start_date');?> </td>
			<td><input class="text-input" type="text" size="50px" value="" readonly="true" name="gcal_startDate" id="gcal_startDate"></td>
		</tr>
		<tr>
			<td> <?php echo $this->lang->line('end_date');?> </td>
			<td><input class="text-input" type="text" size="50px" value="" readonly="true" name="gcal_endDate" id="gcal_endDate"></td>
		</tr>
		<tr>
			<td colspan="2"> <input type="button"  class="btn-blue" value="<?php echo $this->lang->line('integrate_with_cal');?>" id="integrate_with_calendar"/> </td>
		</tr>
	</table>
	</form>
	<br>
</div>



