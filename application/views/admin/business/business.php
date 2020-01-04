<?php include('business.js.php'); ?>
<div class="rounded_corner_full">
<h1 class="headign-main"><?php echo $this->lang->line('business'); ?></h1>
<div class='save-success'><?php if(isset($success)) {echo $success;}?></div>
<form id="form-business" action="" method="post" enctype="multipart/form-data">
<p style="padding-left:10px; padding-bottom:10px;"><?php echo $this->lang->line('business_personalize'); ?></p>
<h2 ><?php echo $this->lang->line('business_logo'); ?></h2><br/>
<div class="inner-div">
<table style="padding-left:30px" width="100%">
		<tr>
			<td>

                <?php
                                //echo $business_logo;exit;
				if($business_logo != "")
				{
					?> <img id="staffImg" src="<?php echo base_url(); ?>uploads/businesslogo/<?php echo $business_logo; ?>" height="80"  />
                                         <br/><a id="rem_photo" href="JavaScript:void(0);" onclick="Remove_Pic()" ><?php echo $this->lang->line('business_remove_photo'); ?></a>


                                <?php
				}
				else
				{
					?> <img id="staffImg" src="<?php echo base_url(); ?>uploads/businesslogo/noimage.jpg" height="80"  />

                <?php } ?>



				<?php if(isset($error)) {echo $error;}?>
				</td>

                <td><input type="file" name="userfile" id="userfile" accept="image/*" class="text-input-staff-txtAra" /></td>


		</tr>
</table>
<br/>
<?php echo $this->lang->line('business_photo_gallery'); ?>
<br/>
</div>



<h2 ><?php echo $this->lang->line('business_details'); ?></h2><br/><br/>

<div class="inner-div">
	<table style="padding-left:30px" width="80%" class="bussiness-tabl">
		<tr>
			<td>
			<?php echo $this->lang->line('business_name'); ?>
			</td>
			<td>
			<input type="text" name="business_name" class="text-input required" value="<?php echo $business_name; ?>" size="29px">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $this->lang->line('business_description'); ?>
			</td>
			<td>
			<textarea name="business_description" onKeyUp="countChar_des(this)" maxlength="1000" class="text-input required" ><?php echo $business_description; ?></textarea>
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
			<input type="text" name="page_title" class="text-input required" value="<?php echo $page_title; ?>" size="29px">
		    </td>
		</tr>
		<tr>
		    <td>
			</td>
                        <td><?php echo $this->lang->line('business_example'); ?></td>
		</tr>
		<tr>
			<td>
			<?php echo $this->lang->line('business_tag'); ?>
			</td>
			<td>
			 <textarea name="business_tag" onKeyUp="countChar_tag(this)" maxlength="100" class="text-input required"><?php echo $business_tag; ?></textarea>
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
<br/>



<h2 ><?php echo $this->lang->line('business_location_head'); ?></h2><br/>
<div class="inner-div">
<?php echo $this->lang->line('business_location_details'); ?>


   <br/>
	<table style="padding-left:30px" width="80%" class="bussiness-tabl" >
		
		<tr>
			<td>
				<?php echo $this->lang->line('business_country'); ?>
			</td>

            <td>
			<?php echo $country; ?>
            </td>
         </tr>
		<tr>
			<td>
				<?php echo $this->lang->line('business_state'); ?>
			</td>

            <td>
			<?php echo $region; ?>
            </td>
         </tr>
         <tr>
			<td>
				<?php echo $this->lang->line('business_city'); ?>
			</td>
			<td>
				<?php echo $city; ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $this->lang->line('business_location'); ?>
			</td>
			<td>
			<input type="text" name="business_location" class="text-input required" value="<?php echo $business_location; ?>" size="29px">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $this->lang->line('business_zip_code'); ?>
			</td>
			<td>
			<input type="text" name="business_zip_code" id="business_zip_code" class="text-input text-input required business_zip_code" value="<?php echo $business_zip_code; ?>" size="29px">
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $this->lang->line('business_phone'); ?>
			</td>
			<td>
			<input type="text" name="business_phone" maxlength="15" size="29px" class="text-input required" id="business_phone" value="<?php echo $business_phone; ?>">
			</td>
		</tr>

	</table>
<br/>
</div>



<h2 ><?php echo $this->lang->line('business_map'); ?></h2><br/>
<div class="inner-div">
<?php echo $this->lang->line('business_map_details'); ?><br/>

<div id="map_canvas" style="width:50%; height:300px;"></div>
<br/>
</div>


<h2><?php echo $this->lang->line('business_link'); ?></h2><br/>
<div class="inner-div">
<table style="padding-left:30px" width="80%" class="bussiness-tabl">
  <tr>
    <td><?php echo $this->lang->line('business_fblink'); ?> </td>
    <td><input type="text" name="facebook_link" size="29px" id="facebook_link" class="text-input social-link" value="<?php echo $facebook_link; ?>"></td>
  </tr>
  <tr>
    <td><?php echo $this->lang->line('business_tubelink'); ?> </td>
    <td><input type="text" name="youtube_link" size="29px" id="youtube_link" class="text-input social-link" value="<?php echo $youtube_link; ?>"></td>
  </tr>
  <tr>
    <td><?php echo $this->lang->line('business_googlelink'); ?></td>
    <td><input type="text" name="google_link" size="29px" id="google_link" class="text-input social-link" value="<?php echo $google_link; ?>"></td>
  </tr>
  <tr>
    <td><?php echo $this->lang->line('business_twitterlink'); ?> </td>
    <td><input type="text" name="twitter_link" size="29px" id="twitter_link" class="text-input social-link" value="<?php echo $twitter_link; ?>"></td>
  </tr>
  <tr>
    <td><?php echo $this->lang->line('business_linkedinlink'); ?> </td>
    <td><input type="text" name="linkedin_link" size="29px" id="linkedin_link" class="text-input social-link" value="<?php echo $linkedin_link; ?>"></td>
  </tr>
</table>
</div>


<div style="margin:20px; text-align:center;"><p><input type="button" name="save_business" value="<?php echo $this->lang->line('business_savebtn'); ?>" id="btn-submit1" class="btn-blue"></p> </div>
</form>
</div>