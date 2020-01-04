<?php include('gcal.js.php'); ?>

<div class="rounded_corner_full">
<h1 class="headign-main">google calendar integration</h1>
    <br>
	<h2>Google login details </h2>
	<form action="" method="POST" onsubmit="return false">
	<table width="80%" style="padding-left:30px">
		<tr>
			<td colspan="2" align="left"> <span id="msgGcal"></<span></span> </td>
		</tr>
		<tr>
			<td> Email </td>
			<td><input class="text-input" type="text" size="50px" value="" name="gcal_email" id="gcal_email"></td>
		</tr>
		<tr>
			<td> Password </td>
			<td><input class="text-input" type="password" size="50px" value="" name="gcal_password" id="gcal_password"></td>
		</tr>
		<tr>
			<td> Start Date </td>
			<td><input class="text-input" type="text" size="50px" value="" readonly="true" name="gcal_startDate" id="gcal_startDate"></td>
		</tr>
		<tr>
			<td> End Date </td>
			<td><input class="text-input" type="text" size="50px" value="" readonly="true" name="gcal_endDate" id="gcal_endDate"></td>
		</tr>
		<tr>
			<td colspan="2"> <input type="button"  class="btn-blue" value="Integrate with calendar" id="integrate_with_calendar"/> </td>
		</tr>
	</table>
	</form>
	<br>
</div>



