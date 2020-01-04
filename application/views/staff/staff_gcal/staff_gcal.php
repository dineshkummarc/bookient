<?php include('staff_gcal.js.php'); ?>

<div class="rounded_corner_full">
<h1 class="headign-main"><?php echo $this->lang->line('heading_main'); echo' - '; echo $this->session->userdata('user_name_staff');?></h1>
    <br>
	<div class="rounded_corner" style="width:80%; margin:10px 50px 10px 150px">
		<div class="heading"><?php echo $this->lang->line('google_login_details');?></div>
		<form action="" method="POST" onsubmit="return false">
		<table width="80%" style="padding-left:30px">
			<tr>
				<td colspan="2" align="left"> <span id="msgGcal"></<span></span> </td>
			</tr>
			<tr>
				<td> <?php echo $this->lang->line('email');?> </td>
				<td><input class="text-input-staff" type="text" size="50px" value="" name="gcal_email" id="gcal_email"></td>
			</tr>
			<tr>
				<td> <?php echo $this->lang->line('password');?> </td>
				<td><input class="text-input-staff" type="password" size="50px" value="" name="gcal_password" id="gcal_password"></td>
			</tr>
			<tr>
				<td> <?php echo $this->lang->line('start_date');?> </td>
				<td><input class="text-input-staff" type="text" size="50px" value="" readonly="true" name="gcal_startDate" id="gcal_startDate"></td>
			</tr>
			<tr>
				<td> <?php echo $this->lang->line('end_date');?> </td>
				<td><input class="text-input-staff" type="text" size="50px" value="" readonly="true" name="gcal_endDate" id="gcal_endDate"></td>
			</tr>
			<tr>
				<td colspan="2"> <input type="button"  class="btn-blue" value="<?php echo $this->lang->line('integrate_with_cal');?>" id="integrate_with_calendar"/> </td>
			</tr>
		</table>
		</form>
	</div>
	<br>
	<div class="spacer"></div>
	<!--div class="push"></div-->
</div>