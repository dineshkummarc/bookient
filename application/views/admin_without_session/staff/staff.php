<?php include('staff.js.php'); ?>
<?php
if($current_id !=''){
?>
<script>	
	$(document).ready(function() { 
		var current_id= '<?php echo $current_id ?>';
		var type = '<?php echo $type ?>';
		if(type == 'block'){
			blockTimingsData(current_id);
		}
		if(type == 'edit_staff'){
			GetStaffData(current_id);
		}
		
	})
</script>
<?php 
}
?>
<div class="rounded_corner_full">
	<h1 class="headign-main">STAFF INFORMATION</h1>

<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>

<!--<span style="color:#F00;"><?php //if(isset($success)) {echo $success;}?></span>-->


<span id="add_new_staff_link" style="text-align:center;width:100%;" >
	<a href="javascript:void(0);" onclick="DisplayAddNewStaff() " class="add-customer">Add New Staff</a>
</span>
<div id="add_new_staff">
<form id="form-staff" action="<?php echo base_url(); ?>admin/staff/add_staff" method="post" enctype="multipart/form-data">
<h2> Upload Staff image.</h2>
<div class="inner-div" style="margin:8px 0 8px 0;">
<table width="85%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" width="17%">Select image</td>
    <td>
        <!--<img id="staffImg" src="<?php //echo base_url(); ?>uploads/staff/noimage.jpg" height="35" style="display:none;" />-->
        <img id="staffImg" src="" height="35" style="display:none;" />

<input type="file" name="userfile" id="userfile" accept="image/*" class="text-input-staff-txtAra" /><span>(Max. upload size 50 Kb)</span>
<?php if(isset($error)) {echo $error;}?>
<br/><a id="rem_photo" href="JavaScript:void(0);" onclick="Remove_Pic()" style="display:none;">Remove Photo</a>
    </td>
  </tr>
</table>
</div>

<h2>Personal Information</h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%">Staff Name</td>
    <td><input type="text" name="employee_name" id="employee_name" autocomplete="off" value="" maxlength="30" class="text-input-staff required"/></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><input type="text" name="employee_username" id="employee_username" autocomplete="off" value="" maxlength="30" class="text-input-staff required username"/></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="employee_password" id="password-1" autocomplete="off" value=""  maxlength="30" class="text-input-staff required password"/>
    </td>
    <td>
    <span id="chan_pas_word" ><input type="checkbox" id="change_pass" name="change_pass" value="0"/> &nbsp;Check here to Change Password.</span>
    </td>
  </tr>
</table>

</div>


<h2>Personal Information</h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0" >
  <tr  style="display: none;" id="staffEmailCont">
    <td width="20%">Email ID</td>
    <td ><input type="text" name="employee_email" id="email" value="" maxlength="30" class="text-input-staff"/> &nbsp;&nbsp;
	</td>
  </tr>
   <tr>
    <td width="20%">&nbsp;</td>
    <td>
	<span style="color:#333">
		<input id="no_empEmail" type="checkbox" name="no_empEmail">
	 	<lable id="no_empEmailContent" > Click the checkbox if the staff login enable.</lable>
	</span>
	</td>
  </tr>
  <tr>
    <td>Staff Mobile</td>
    <td><input type="text" name="employee_mobile_no" id="employee_mobile_no" autocomplete="off" value="" maxlength="30" class="text-input-staff required mobile_no"/></td>
  </tr>
</table>
</div>

<h2>Other information</h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%">Description</td>
    <td><textarea name="employee_description" id="employee_description" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td>Education</td>
    <td><textarea name="employee_education" id="employee_education" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td>Languages</td>
    <td><textarea name="employee_languages" id="employee_languages" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td>Professional Memberships</td>
    <td><textarea name="employee_membership" id="employee_membership" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td>Awards</td>
    <td><textarea name="employee_awards" id="employee_awards" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td>Publications</td>
    <td><textarea name="employee_publications" id="employee_publications" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
  <td>&nbsp; </td>
  <td id="add_update_button" valign=top">
      <input type="button" name="staff_add_btn" id="btn-submit" value="Add" class="btn-blue" style="border: 1px solid #0659A3;display: block; float: left; margin: 0 5px 0 0; min-height: 33px;"> 
      <button type="button" class="btn-gray" onclick="CancelAddNewStaff()">Cancel</button></td>
  </tr>
</table>

</div>
<input type="hidden" name="employee_id" id="employee_id" value="" />
</form>

</div>


<div id="blockTimings" style="display:none;"><!---->
<div  class="rounded_corner" style="width:80%;margin:10px 50px 10px 50px; ">
<div id="staff_name_date"  class="heading"></div>
<form id="form-blok-dt" name="form-blok-dt" onsubmit="return false;">

<table align="center" width="98%" >
<tr><td align="left" colspan="3"><strong style="padding-left:10px;">Block Dates</strong></td></tr>

<tr>
<td align="right">Date From</td>
<td>:</td>
<td>

<input type="text" name="date_from" id="date_from" autocomplete="off" value="" maxlength="30" class="text-input-staff required" />
</td>
</tr>

<tr>
<td align="right">Date To</td>
<td>:</td>
<td><input type="text" name="date_to" id="date_to" autocomplete="off"  class="text-input-staff required" />
<span id="err_date_to" style="color:red"></span>
</td>
</tr>
<tr><td colspan="2"></td>
<td  align="left">
<button onclick="AddDateStaff();" class="btn-blue">Add</button>
</td></tr>
<input type="hidden" name="blk_dt_employee_id" id="blk_dt_employee_id" value="0" />

<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><strong style="padding-left:10px;">Blocked Dates Are</strong>:</td></tr>
<tr><td colspan="3">
<div id="bloceddatedisp"></div>
</td></tr>
</table>

</form>
</div>
<div  class="rounded_corner" style="width:80%;margin:10px 50px 10px 50px; ">
<div id="staff_name_date_time"  class="heading"></div>
<form id="form-blok-time" name="form-blok-time" onsubmit="return false;">
<strong style="padding-left:10PX;">Block Time on particular date</strong>
<table align="center" width="100%" >
	<tr><td align="left" colspan="3"></td></tr>
	<tr>
		<td align="right">Time From :</td>
		<td><input type="text" id="timepickerFrom" name="timepickerFrom" value="" class="text-input-staff block_slot"/></td>
	</tr>

	<tr>
		<td align="right">Time To :</td>
		<td><input type="text" id="timepickerTo" name="timepickerTo" value="" class="text-input-staff block_slot"/>
        <span id="err_time_to" style="color:red"></span>
        </td>
	</tr>
	<tr>
		<td align="right">Date :</td>
		<td><input type="text" name="date_of_time_block" id="date_of_time_block" class="text-input-staff block_slot" /></td>
	</tr>
	<tr>
   		<td align="right"></td>
		<td  align="left">
		<button onclick="AddTimingStaff();" class="btn-blue">Add</button>
		</td>
		<td>
		<input type="hidden" name="blk_time_employee_id" id="blk_time_employee_id" value="0" />
		</td>
	</tr>
</table>

</form>
<strong style="padding-left:10PX;" >Blocked timings Are:</strong>
<div id="BlockedTimingsDisp"></div>
</div>

</div>



<table align="center" width="100%" border="0" class="super-listing-tabl">
<thead>
<!--<tr><td align="left" colspan="7"><strong>All Staff</strong></td></tr>-->
<tr>
<th align="center" ><strong>Image</strong></td>
<th align="center"><strong>Name</strong></td>
<th align="center"><strong>Username</strong></td>
<th align="center"><strong>Email Address</strong></td>
<th align="center"><strong>Mobile</strong></td>
<th align="center"><strong>Active</strong></td>
<th align="center"><strong>Actions</strong></td>
</tr>
</thead>

<?php foreach($staff as $staff_data) { ?>


<tr>
<td align="center" >
<?php
if($staff_data['employee_image'] == "")
{
	$ImgFileNm = "noimage.jpg";
}
else
{
	$ImgFileNm = $staff_data['employee_image'];
}
?>

<img src="<?php echo base_url(); ?>uploads/staff/<?php echo $ImgFileNm;?>" height="40" />

</td>
<td align="center"><?php echo $staff_data['employee_name'];?></td>
<td align="center"><?php echo $staff_data['user_name'];?></td>
<td align="center"><?php echo $staff_data['user_email'];?></td>
<td align="center"><?php echo $staff_data['employee_mobile_no'];?></td>
<td align="center"><?php echo $staff_data['is_active'];?></td>
<td align="center" width="22%">
<table align="center" width="100%">
<tr>
<td align="center" style="font-size:9px;">

<?php
if($staff_data['is_active'] == 'Y')
{
	$DisEnActinDisp = "Disable";
	$changedStatus = "N";
}
else
{
	$DisEnActinDisp = "Enable";
	$changedStatus = "Y";
}
?>
<?php
$employee_id = $staff_data['employee_id'];


?>
<a href="javascript:void(0);" class="change_status" onclick="change_status('<?php echo $changedStatus; ?>','<?php echo $employee_id;?>');"><?php echo $DisEnActinDisp;?></a>

</td>
<td align="center"> | </td>
<?php /*?><td align="center" style="font-size:9px;"><a href="<?php echo base_url(); ?>admin/staff/staff_edit/<?php echo $staff_data['employee_id'];?>">edit</a></td><?php */?>


<td align="center" style="font-size:9px;">
<a href="javascript:void(0);" onclick="GetStaffData('<?php echo $employee_id;?>');">Edit</a>
</td>

<td align="center"> | </td>
<td align="center" style="font-size:9px;">

<a href="javascript:void(0);" onclick="delete_staff('<?php echo $employee_id;?>');">Delete</a>

</td>
<td align="center"> | </td>
<td align="center" style="font-size:9px;"><a href="javascript:void(0);" onclick="blockTimingsData('<?php echo $employee_id;?>');">Block Timings</a></td>
<td align="center"> | </td>
<td align="center" style="font-size:9px;"> <a href="javascript:void(0);" onclick="Send_Password('<?php echo $employee_id;?>');">Send Password</a></td>
</tr>
</table>
</td>
</tr>


<?php } ?>
</tr>
</table>
<br>
</div>
<!--</table><div id="status"></div><div id="paginate"></div>-->
















