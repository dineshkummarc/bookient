<?php include('dashboard.js.php'); ?>
<br /><br />
<div id="admin_listing" class="superadmin_rounded_corner">
<h1 class="headign-main-superadmin">Dashboard</h1>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" class=" super-listing-tabl">
      <tr>
        <th>Sl. No.</th>
        <th style="text-align: left;">Full Name</th>
        <th style="text-align: left;">URL</th>
        <th>Phone No.(Mob.)</th>
        <th>Email Verification</th>
        <th>Status</th>
        <th colspan="3">&nbsp;</th>
      </tr>
      <?php
        foreach($all as $key=>$row)
        {
            $sl = $key+1;
      ?>
      <tr>
        <td align="center"><?php echo $sl; ?></td>
        <td align="left">		
			<?php $local_admin_name=ucfirst($row['first_name']).' '.ucfirst($row['last_name']); ?>
			<?php echo $local_admin_name; ?>		
		</td>
        <td align="left">
        <?php $ls_url = str_replace("admin",$row['user_name'],$_SERVER['HTTP_HOST']); ?>        
        <a href="http://<?php echo $ls_url;?>" target="_blank"><?php echo $ls_url;?></a>     	
       </td>
        <td align="center"><?php echo $row['mobile_phone']; ?></td>
        <td align="center"><?php 
        if($row['is_email_verified'] == 0){
			echo '<label style="color: red; cursor: pointer;" onclick="email_varify('.$row['local_admin_id'].');"> Not Verified</label>';
		}else{
			echo 'Verified';
		}       
        ?></td>
        <td align="center">
            <a href="javascript:void(0);" onclick="change_status('<?php echo $row['local_admin_id']; ?>');">
            <span id="replace_img_<?php echo $row['local_admin_id']; ?>"><img src="<?php echo base_url().'myjs/images/'.$row['is_active_img']; ?>" title="<?php echo $row['is_active_alt']; ?>" /></span>
            </a>
        </td>
        <td align="center" ><a href="javascript:void(0);" onclick="show_update_password_block('<?php echo $row['local_admin_id']; ?>');">Update Password</a></td>
        <td align="center"><a href="javascript:void(0);" onclick="manage_local_admin('<?php echo $row['local_admin_id']; ?>','<?php echo $ls_url;?>');">Manage Local Admin</a></td>
         <td align="center"><label style="color: red; cursor: pointer;" onclick="delete_account('<?php echo $row['local_admin_id']; ?>');"> Delete</label></td>
      </tr>
      <?php } ?>
    </table>
</div>
<br />
<div id="update_password" style="display:none;" align="center">
    <form id="form-chng-pass" action="" method="post">
        <table width="60%" cellpadding="0" cellspacing="0" class="credit-table" style="border-radius: 5px;background:#FFF;border:1px solid #ccc; padding:0 0 10px 0">
            <tr>
                <td colspan="2" align="center"><h1 class="headign-main-superadmin">Update Password</h1></td>
            </tr>
            <tr>
                <td style=" padding:8px 0 3px 30px;">Enter New Password : </td> <td> <input name="new_pass" type="text" id="new_pass" onfocus="focusit();" />&nbsp;<div id="show_error" class="error"></div></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2"> <input type="button" onclick="update_password();" alt="Update Password" value="Update" class="btn-blue" />&nbsp;&nbsp;
                    <input type="button" onclick="update_password_and_mail();" alt="Update Password" value="Update & Mail" class="btn-blue" />&nbsp;&nbsp;
                    <input type="button" onclick="hide_update_password_block();" alt="Cancel" value="Cancel"  class="btn-gray" />&nbsp;&nbsp;
                    <input name="user_id" id="user_id" type="hidden" value="" />
                </td>
            </tr>
        </table>
    </form>
</div>
<br />
<div id="update_details" style="display:none;">
    <form id="form-business" action="" method="post" enctype="multipart/form-data">
    <div class="rounded_corner">
        <p style="padding-left:10px; padding-bottom:10px;">Personalize your business and mark your location on the map.</p>
        <h2>1. Upload your logo</h2><br/>
        <div class="inner-div">
            <table style="padding-left:30px" width="100%">
                <tr>
                    <td>
                         <span id="business_logo"></span>
                        <?php if(isset($error)) {echo $error;} ?>
                        </td>
                        <td><input type="file" name="userfile" id="userfile" accept="image/*" class="text-input-staff-txtAra" /></td>
                </tr>
            </table>
            <br/>
            <?php echo $this->lang->line('business_photo_gallery'); ?>
            <br/>
        </div>
        <h2>2. Update your business details</h2><br/><br/>
        <div class="inner-div">
            <table style="padding-left:30px" width="80%" class="bussiness-tabl">
                <tr>
                    <td>
                    <?php echo $this->lang->line('business_name'); ?>
                    </td>
                    <td>
                    <input type="text" name="business_name" id="business_name" class="text-input required" value="" size="29px">
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php echo $this->lang->line('business_description'); ?>
                    </td>
                    <td>
                    <textarea name="business_description" id="business_description" onKeyUp="countChar_des(this)" maxlength="1000" class="text-input required" >
                    </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    <div id="charNum_des"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php echo $this->lang->line('page_title'); ?>
                    </td>
                    <td>
                    <input type="text" name="page_title" id="page_title" class="text-input required" value="" size="29px">
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    e.g. Beauty Salon in Miami
                    </td>
                </tr>
                <tr>
                    <td>
                    <?php echo $this->lang->line('business_tag'); ?>
                    </td>
                    <td>
                     <textarea name="business_tag" id="business_tag" onKeyUp="countChar_tag(this)" maxlength="100" class="text-input required">
                     </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                    <div id="charNum"></div>
                    </td>
                </tr>
            </table>
        </div>
        <h2>3. Update your Location</h2><br/>
        <div class="inner-div">
            <?php echo $this->lang->line('business_location_details'); ?>
               <br/>
                <table style="padding-left:30px" width="80%" class="bussiness-tabl" >
                    <tr>
                        <td>
                        <?php echo $this->lang->line('business_location'); ?>
                        </td>
                        <td>
                        <input type="text" name="business_location" id="business_location" class="text-input required" value="" size="29px">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <?php echo $this->lang->line('business_city_region'); ?>
                        </td>
                        <td>
                        <span id="region"></span>
                        <br/>
                        <span id="city"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <?php echo $this->lang->line('business_zip_code'); ?>
                        </td>
                        <td>
                        <input type="text" name="business_zip_code" id="business_zip_code" class="text-input text-input required business_zip_code" value="" size="29px">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        <?php echo $this->lang->line('business_phone'); ?>
                        </td>
                        <td>
                        <input type="text" name="business_phone" id="business_phone" maxlength="15" size="29px" class="text-input required"  value="">
                        </td>
                    </tr>
                </table>
            <br/>
        </div>
        <h2>4. Map your Location</h2><br/>
        <div class="inner-div">
			<?php echo $this->lang->line('business_map_details'); ?><br/>
            <div id="map_canvas" style="width:50%; height:300px;"></div>
            <br/>
        </div>
        <h2>5. Add your business link</h2><br/>
        <div class="inner-div">
            <table style="padding-left:30px" width="80%" class="bussiness-tabl">
              <tr>
                <td>Facebook Link : </td>
                <td><input type="text" name="facebook_link" size="29px" id="facebook_link" value=""></td>
              </tr>
              <tr>
                <td>YouTube Link : </td>
                <td><input type="text" name="youtube_link" size="29px" id="youtube_link" value=""></td>
              </tr>
              <tr>
                <td>Google Link : </td>
                <td><input type="text" name="google_link" size="29px" id="google_link" value=""></td>
              </tr>
              <tr>
                <td>Twitter Link : </td>
                <td><input type="text" name="twitter_link" size="29px" id="twitter_link" value=""></td>
              </tr>
              <tr>
                <td>LinkedIn Link : </td>
                <td><input type="text" name="linkedin_link" size="29px" id="linkedin_link" value=""></td>
              </tr>
            </table>
        </div>
    </div>
    <div style="margin:20px 0 0 0; text-align:center;">
    	<input type="button" name="save_business" value="save"  id="btn-submit1"  class="btn-blue">
    </div>
    </form>
</div>
<br />
<br />
<div id="staff_tbl">
</div>