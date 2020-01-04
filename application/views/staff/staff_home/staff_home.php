<script type="text/javascript" src="<?php echo base_url(); ?>js/ajaxfileupload.js"></script>
<?php require('staff_home.js.php'); ?>



<style>
#check_err{ color:#F00; }
#radio_err{ color:#F00; }
</style>

<div class="rounded_corner_full">
<h1 class="headign-main">PROFILE</h1>

<!--div class="rightpanel"  id="rightpanel_edit"-->
<span id="staffmsg" style="color:blue; margin-left:400px;"></span>
<form name="frm-staff-profile" id="frm-staff-profile" enctype="multipart/form-data">
<div class="edit-page">
<h2>Upload your image</h2>
<table width="50%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="19%" rowspan="3" align="center" valign="middle"><span id="replace_img"><img src="<?php echo ($staff_details[0]['employee_image'] != '')?base_url().'uploads/staff/'.$staff_details[0]['employee_image']:base_url().'uploads/staff/noImageAvailableBig.gif'; ?>" alt="Image" height="115" width="" /></span></td>
    <td width="81%"><table cellspacing="0" cellpadding="0">
      <tr>
        <td><span id="bussinessDetailBlockHeadingSpanID15"> </span></td>
        <td><div> <span id="adminEditStaffImageDescTxt">Image   file must be less than 50 KB in size and either GIF, JPEG or PNG   format. File will scale automatically to correct ratio if the size would   be large. Uploading a new image would replace the current image, if   present.</span></div></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <input name="employee_image" id="employee_image" accept="image/*" type="file" />
    </td>
    </tr>
</table>

</div>

<div class="edit-page">
<h2> Personal Information </h2>
<table width="50%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="20%" align="right" valign="middle">Name:</td>
    <td width="80%" align="left" valign="middle">
      <input type="text" name="employee_name" id="employee_name" value="<?php echo $staff_details[0]['employee_name']; ?>" class="required" />
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">User Name:</td>
    <td align="left" valign="middle"><input type="text" name="user_name" id="user_name"  value="<?php echo $staff_details[0]['user_name']; ?>" disabled="disabled" /><input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id_staff; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="middle">Password:</td>
    <td align="left" valign="middle"><input type="password" name="password" id="password" value="<?php echo $staff_details[0]['password']; ?>" class="required" /></td>
  </tr>
  </table>

</div>

<div class="edit-page">
<h2> Contact information </h2>
<table width="50%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="20%" align="right" valign="middle">Email:</td>
    <td width="80%" align="left" valign="middle">
      <input type="text" name="user_email" id="user_email" value="<?php echo $staff_details[0]['user_email']; ?>" class="required" />
    </td>
  </tr>
  <tr>
    <td align="right" valign="middle">Phone:</td>
    <td align="left" valign="middle"><input type="text" name="employee_mobile_no" id="employee_mobile_no" value="<?php echo $staff_details[0]['employee_mobile_no']; ?>" class="required" /></td>
  </tr>
  </table>

</div>

<div class="edit-page">
<h2> Other information </h2>
<div id="sel_textarea">
<div class="tabing">
<ul>
<li><a href="#" class="select">Description</a></li>
	
<li><a href="#">Education</a></li>
	
<li><a href="#">Languages</a></li>
	
<li><a href="#">Professional Memberships</a></li>
	
<li><a href="#">Awards</a></li>
	
<li><a href="#">Publications</a></li>
</ul>
</div>
<div class="text-area-bg">
        <textarea cols="40" rows="5" style="display:block" name="employee_description" id="employee_description">
		<?php echo trim($staff_details[0]['employee_description']); ?>
        </textarea>
        <textarea cols="40" rows="5" name="employee_education" id="employee_education">
		<?php echo trim($staff_details[0]['employee_education']); ?>
        </textarea>
        <textarea cols="40" rows="5" name="employee_languages" id="employee_languages">
		<?php echo trim($staff_details[0]['employee_languages']); ?>
        </textarea>
        <textarea cols="40" rows="5" name="employee_membership" id="employee_membership">
		<?php echo trim($staff_details[0]['employee_membership']); ?>
        </textarea>
        <textarea cols="40" rows="5" name="employee_awards" id="employee_awards">
		<?php echo trim($staff_details[0]['employee_awards']); ?>
        </textarea>
        <textarea cols="40" rows="5" name="employee_publications" id="employee_publications">
		<?php echo trim($staff_details[0]['employee_publications']); ?>
        </textarea>
</div>
</div>
</div>

<div class="edit-page">
<table width="20%" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="44%" align="center">
      <input type="button" name="button" id="button" value="Update"  class="btn-blue" onclick="SaveData();"/>
   </td>
    <td width="56%" align="center"><input type="button" name="button2" id="button2" value="Cancel"  class="btn-gray" onclick="reset_page();"/></td>
  </tr>
</table>
</div>
</form>
</div>

<!--/div-->