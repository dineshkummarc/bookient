<?php include('staff_manage.js.php'); ?>


<!--div  class="rounded_corner" style="width:80%;margin:10px 50px 10px 50px; "-->
<div class="rounded_corner_full">
<h1 class="headign-main">BLOCK TIMINGS</h1>
<!--################### Date block start ###################-->
<div  class="rounded_corner" style="width:80%;margin:10px 50px 10px 150px; ">
<div class="heading">Block Date</div>
	<form id="form-blok-dt" name="form-blok-dt" method="POST" onsubmit="return false;">
		<table align="center" width="98%" >
			<tr>
				<td colspan="3" align="center"><div id="err_date_to"></div></td>
			</tr>
			<tr>
				<td align="right">Date From</td>
				<td>:</td>
				<td>
					<input type="text" name="date_from" id="date_from" autocomplete="off" class="text-input-staff " readonly="readonly" />
				</td>
			</tr>
			<tr>
				<td align="right">Date To</td>
				<td>:</td>
				<td><input type="text" name="date_to" id="date_to" autocomplete="off"  class="text-input-staff "  readonly="readonly"/></td>
			</tr>
			<tr>
				<td colspan="2"><input type="hidden" name="blk_dt_employee_id" id="blk_dt_employee_id" value="<?php echo  $user_id_staff;?>" /></td>
				<td  align="left"><button class="btn-blue" onclick="AddDateStaff();">Add</button></td>
			</tr>
			<tr>
				<td colspan="3" align="left"><strong style="padding-left:10px;">Blocked Dates Are</strong>:</td>
			</tr>
			<tr>
				<td colspan="3"><div id="bloceddatedisp"></div></td>
			</tr>
		</table>
	</form>

</div>
<!--################### Date block end ###################-->

<!--################### Time block start ###################-->
<div  class="rounded_corner" style="width:80%;margin:10px 50px 10px 150px; ">
<div class="heading">Block Time</div>
<form id="form-blok-time" name="form-blok-time" method="POST" onsubmit="return false;">
	<table align="center" width="100%" >
		<tr>
			<td align="left" colspan="3"></td>
		</tr>
		<tr>
			<td align="right">Time From :</td>
			<td><input type="text" id="timepickerFrom" name="timepickerFrom" value="" class="text-input-staff required"/></td>
		</tr>
		<tr>
			<td align="right">Time To :</td>
			<td><input type="text" id="timepickerTo" name="timepickerTo" value="" class="text-input-staff required"/></td>
		</tr>
		<tr>
			<td align="right">Date :</td>
			<td><input type="text" name="date_of_time_block" id="date_of_time_block" class="text-input-staff required" readonly="readonly" /></td>
		</tr>
		<tr>
	   		<td align="right"></td>
			<td  align="left"><button class="btn-blue" onclick="AddTimingStaff();">Add</button></td>
			<td><input type="hidden" name="blk_time_employee_id" id="blk_time_employee_id" value="<?php echo  $user_id_staff;?>" /></td>
		</tr>
		<tr>
				<td colspan="3" align="left"><strong style="padding-left:10px;">Blocked timings Are</strong>:</td>
			</tr>
			<tr>
				<td colspan="3"><div id="BlockedTimingsDisp"></div></td>
			</tr>
	</table>
</form>
 
<!--#################### Time block end ##################-->





</div>
















