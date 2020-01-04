<?php include('share_link.js.php'); ?>
<form id="form-business" action="" method="post" >
<div class="superadmin_rounded_corner">
	<h1 class="headign-main-superadmin">Share Link Manager</h1>
	<h2 style="color:#000000; font-size:20px; text-decoration:underline; margin-left:350px; margin-top:25px;">Update Your Business Links</h2><br/>
    <div class="inner-div">
        <table style="padding-left:30px" width="80%" class="credit-table" >
          <tr>
            <td>Facebook Link :</td>
            <td><input type="text" name="facebook_link" size="29px" id="facebook_link" value="<?php echo $superadmin_facebook; ?>" class="required"></td>
          </tr>
          <tr>
            <td>YouTube Link :</td>
            <td><input type="text" name="youtube_link" size="29px" id="youtube_link" value="<?php echo $superadmin_youtube; ?>" class="required"></td>
          </tr>
          <tr>
            <td>Google Link :</td>
            <td><input type="text" name="google_link" size="29px" id="google_link" value="<?php echo $superadmin_google; ?>" class="required"></td>
          </tr>
          <tr>
            <td>Twitter Link :</td>
            <td><input type="text" name="twitter_link" size="29px" id="twitter_link" value="<?php echo $superadmin_twitter; ?>" class="required"></td>
          </tr>
          <tr>
            <td>LinkedIn Link :</td>
            <td><input type="text" name="linkedin_link" size="29px" id="linkedin_link" value="<?php echo $superadmin_linkedin; ?>" class="required"></td>
          </tr>
        </table>
    </div>
  	<div style="margin:20px 0 0 0; text-align:center;"><input type="button" name="save_business" value="save"  id="btn-submit1"  class="btn-blue"> 		</div>
</div>

</form> 