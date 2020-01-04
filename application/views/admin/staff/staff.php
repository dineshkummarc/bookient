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
	<h1 class="headign-main"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_Information')); ?></h1>

<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>

<!--<span style="color:#F00;"><?php //if(isset($success)) {echo $success;}?></span>-->

<?php
	
if($this->session->userdata('admin_language') == "finnish"){
?>
	<span id="add_new_staff_link" style="width:13%; float: right;" >
<?php	
}else{
?>
	<span id="add_new_staff_link" style="width:10%; float: right;" >
<?php	
}
?>

<a href="javascript:void(0);" onclick="DisplayAddNewStaff() " class="add-customer"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_add_stuffbtn')); ?></a>
</span>
<div id="add_new_staff">
<form id="form-staff" action="<?php echo base_url(); ?>admin/staff/add_staff" method="post" enctype="multipart/form-data">
<h2><?php echo $this->global_mod->db_parse($this->lang->line('Staff_upload_staff_img')); ?> </h2>
<div class="inner-div" style="margin:8px 0 8px 0;">
<table width="85%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" width="17%"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_select_img')); ?></td>
    <td>
        <!--<img id="staffImg" src="<?php //echo base_url(); ?>uploads/staff/noimage.jpg" height="35" style="display:none;" />-->
        <img id="staffImg" src="" height="35" style="display:none;" />

<input type="file" name="userfile" id="userfile" accept="image/*" class="text-input-staff-txtAra" onchange="displayPreview(this.files);" /><span><?php echo $this->global_mod->db_parse($this->lang->line('Staff_img_max_size')); ?></span>
<?php if(isset($error)) {echo $error;}?>
<br/><a id="rem_photo" href="JavaScript:void(0);" onclick="Remove_Pic()" style="display:none;"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_remove_img')); ?></a>
    </td>
  </tr>
</table>
</div>

<h2><?php echo $this->global_mod->db_parse($this->lang->line('Staff_personal_info')); ?></h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_name')); ?></td>
    <td><input type="text" name="employee_name" id="employee_name" autocomplete="off" value="" maxlength="30" class="text-input-staff required"/></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_username')); ?></td>
    <td><input type="text" name="employee_username" id="employee_username" autocomplete="off" value="" maxlength="30" class="text-input-staff required username"/></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_password')); ?></td>
    <td><input type="password" name="employee_password" id="password-1" autocomplete="off" value=""  maxlength="30" class="text-input-staff required password"/>
    </td>
    <td>
    <span id="chan_pas_word" ><input type="checkbox" id="change_pass" name="change_pass" value="0"/> &nbsp;<?php echo $this->global_mod->db_parse($this->lang->line('Staff_chk_change_password')); ?></span>
    </td>
  </tr>
</table>

</div>


<h2><?php echo $this->global_mod->db_parse($this->lang->line('Staff_personal_info')); ?></h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0" >
<?php if (in_array(33, $this->global_mod->authArray())){ ?>
  <tr  style="display: none;" id="staffEmailCont">
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_email_id')); ?></td>
    <td ><input type="text" name="employee_email" id="email" value="" maxlength="30" class="text-input-staff"/> &nbsp;&nbsp;
	</td>
  </tr>
   <tr>
    <td width="20%">&nbsp;</td>
    <td>
	<span style="color:#333">
		<input id="no_empEmail" type="checkbox" name="no_empEmail">
	 	<lable id="no_empEmailContent" ><?php echo $this->global_mod->db_parse($this->lang->line('Staff_chk_login_enabled')); ?> </lable>
	</span>
	</td>
  </tr>
<?php } ?>  
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_mobile')); ?></td>
    <td><input type="text" name="employee_mobile_no" id="employee_mobile_no" autocomplete="off" value="" maxlength="30" class="text-input-staff required mobile_no"/></td>
  </tr>
</table>
</div>

<h2><?php echo $this->global_mod->db_parse($this->lang->line('Staff_other_info')); ?></h2>
<div class="inner-div">
<table width="70%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_description')); ?></td>
    <td><textarea name="employee_description" id="employee_description" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_education')); ?></td>
    <td><textarea name="employee_education" id="employee_education" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_language')); ?></td>
    <td><textarea name="employee_languages" id="employee_languages" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_prof_membership')); ?></td>
    <td><textarea name="employee_membership" id="employee_membership" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_awards')); ?></td>
    <td><textarea name="employee_awards" id="employee_awards" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
    <td><?php echo $this->global_mod->db_parse($this->lang->line('Staff_publications')); ?></td>
    <td><textarea name="employee_publications" id="employee_publications" class="text-input-staff-txtAra"></textarea></td>
  </tr>
  <tr>
  <td>&nbsp; </td>
  <td id="add_update_button" valign=top">
      <input type="button" name="staff_add_btn" id="btn-submit" value="Add" class="btn-blue" style="border: 1px solid #0659A3;display: block; float: left; margin: 0 5px 0 0; min-height: 33px;"> 
      <button type="button" class="btn-gray" onclick="CancelAddNewStaff()"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_cancelbtn')); ?></button></td>
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
<tr><td align="left" colspan="3"><strong style="padding-left:10px;"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_block_dates')); ?></strong></td></tr>

<tr>
<td align="right"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_block_date_form')); ?></td>
<td>:</td>
<td>

<input type="text" name="date_from" id="date_from" autocomplete="off" value="" maxlength="30" class="text-input-staff required" />
</td>
</tr>

<tr>
<td align="right"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_block_date_to')); ?></td>
<td>:</td>
<td><input type="text" name="date_to" id="date_to" autocomplete="off"  class="text-input-staff required" />
<span id="err_date_to" style="color:red"></span>
</td>
</tr>
<tr><td colspan="2"></td>
<td  align="left">
<button onclick="AddDateStaff();" class="btn-blue"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_adddatestaffbtn')); ?></button>
</td></tr>
<input type="hidden" name="blk_dt_employee_id" id="blk_dt_employee_id" value="0" />

<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" align="left"><strong style="padding-left:10px;"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_blockdatesare')); ?></strong>:</td></tr>
<tr><td colspan="3">
<div id="bloceddatedisp"></div>
</td></tr>
</table>

</form>
</div>
<div  class="rounded_corner" style="width:80%;margin:10px 50px 10px 50px; ">
<div id="staff_name_date_time"  class="heading"></div>
<form id="form-blok-time" name="form-blok-time" onsubmit="return false;">
<strong style="padding-left:10PX;"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_block_time_prticulr_dt')); ?></strong>
<table align="center" width="100%" >
	<tr><td align="left" colspan="3"></td></tr>
	<tr>
		<td align="right"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_time_from')); ?>:</td>
		<td><input type="text" id="timepickerFrom" name="timepickerFrom" value="" class="text-input-staff block_slot"/></td>
	</tr>

	<tr>
		<td align="right"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_time_to')); ?>:</td>
		<td><input type="text" id="timepickerTo" name="timepickerTo" value="" class="text-input-staff block_slot"/>
        <span id="err_time_to" style="color:red"></span>
        </td>
	</tr>
	<tr>
		<td align="right"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_date')); ?>:</td>
		<td><input type="text" name="date_of_time_block" id="date_of_time_block" class="text-input-staff block_slot" /></td>
	</tr>
	<tr>
   		<td align="right"></td>
		<td  align="left">
		<button onclick="AddTimingStaff();" class="btn-blue"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_adddatestaffbtn')); ?></button>
		</td>
		<td>
		<input type="hidden" name="blk_time_employee_id" id="blk_time_employee_id" value="0" />
		</td>
	</tr>
</table>

</form>
<strong style="padding-left:10PX;" ><?php echo $this->global_mod->db_parse($this->lang->line('Staff_blocked_timings_are')); ?></strong>
<div id="BlockedTimingsDisp"></div>
</div>

</div>

<table align="center" width="98%" border="0" class="list-view">
<thead>
<!--<tr><td align="left" colspan="7"><strong>All Staff</strong></td></tr>-->
<tr>
<th align="center"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_image')); ?></strong></td>
<th align="left"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_listing_name')); ?></strong></td>
<th align="left"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_username')); ?></strong></td>
<th align="left"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_email_address')); ?></strong></td>
<th align="left"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_listing_mobile')); ?></strong></td>
<th align="center"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_listing_active')); ?></strong></td>
<th align="center" colspan="9" style="width: 22%;"><strong><?php echo $this->global_mod->db_parse($this->lang->line('Staff_listing_actions')); ?></strong></td>
</tr>
</thead>

<?php 
 if(count($staff)>0){
 foreach($staff as $staff_data) { 
?>


<tr>
<td align="center" >
<?php
if($staff_data['employee_image'] == ""){
	$ImgFileNm = "noimage.jpg";
}else{
	$ImgFileNm = $staff_data['employee_image'];
}
$is_active = ($staff_data['is_active'] == 'Y')?$this->global_mod->db_parse($this->lang->line('yes_status')):$this->global_mod->db_parse($this->lang->line('no_status'));
?>

<img src="<?php echo base_url(); ?>uploads/staff/<?php echo $ImgFileNm;?>" height="40" />

</td>
<td align="left"><?php echo $staff_data['employee_name']; ?></td>
<td align="left"><?php echo $staff_data['user_name'];?></td>
<td align="left"><?php echo $staff_data['user_email'];?></td>
<td align="left"><?php echo $staff_data['employee_mobile_no'];?></td>
<td align="center"><?php echo $is_active;?></td>
<td align="center" style="font-size:9px;">
<?php
if($staff_data['is_active'] == 'Y'){
	$DisEnActinDisp = $this->global_mod->db_parse($this->lang->line('disable'));
	$changedStatus = "No";
}else{
	$DisEnActinDisp = $this->global_mod->db_parse($this->lang->line('enable'));
	$changedStatus = "Yes";
}
$employee_id = $staff_data['employee_id'];
?>
<a href="javascript:void(0);" class="change_status" onclick="change_status('<?php echo $changedStatus; ?>','<?php echo $employee_id;?>');"><?php echo $DisEnActinDisp;?></a>
</td>
<td align="center"> | </td>
<?php /*?><td align="center" style="font-size:9px;"><a href="<?php echo base_url(); ?>admin/staff/staff_edit/<?php echo $staff_data['employee_id'];?>">edit</a></td><?php */ ?>


<td align="center" style="font-size:9px;">
<a href="javascript:void(0);" onclick="GetStaffData('<?php echo $employee_id;?>');"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_edit')); ?></a>
</td>

<td align="center"> | </td>
<td align="center" style="font-size:9px;">

<a href="javascript:void(0);" onclick="delete_staff('<?php echo $employee_id;?>');"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_delete')); ?></a>
</td>

<?php if (in_array(73, $this->global_mod->authArray())){ ?>

<td align="center"> | </td>
<td align="center" style="font-size:9px;"><a href="javascript:void(0);" onclick="blockTimingsData('<?php echo $employee_id;?>');"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_block_timing')); ?></a></td>

<?php } ?>


<td align="center"> | </td>
<td align="center" style="font-size:9px;"> <a href="javascript:void(0);" onclick="Send_Password('<?php echo $employee_id;?>');"><?php echo $this->global_mod->db_parse($this->lang->line('Staff_send_password')); ?></a></td>
</tr>


<?php 
 } 
 }else{
?>
    <tr><td colspan="15" align="center"><?php echo $this->global_mod->db_parse($this->lang->line("no_data_found"));?></td></tr>
<?php
 }
?>
</tr>
</table>
<br>
</div>
<!--</table><div id="status"></div><div id="paginate"></div>-->
















