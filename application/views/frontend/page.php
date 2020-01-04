<?php
require 'lib/google_connect/openid.php';
?>
<!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
<!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
<?php 
$theme =	$this->page_model->getFrontEndTheme(); 
$minCss = "min/?f=";
$minCss .= "asset/front_css/index.css,";

if($theme[0]['theme'] == 'CS1'){
	$minCss .= "asset/front_css/theme_default.css,";
} 
if($theme[0]['theme'] == 'CS2'){
	$minCss .= "asset/front_css/theme_green.css,";
}
if($theme[0]['theme'] == 'CS3'){
	$minCss .= "asset/front_css/mozo_gray.css,";
}
if($theme[0]['theme'] == 'CS4'){
	$minCss .= "asset/front_css/pol_orange.css,";
}
if($theme[0]['theme'] == 'CCS'){
	include('customCSS.php');
} 
 
if($theme[0]['layout'] == 'L'){
	$minCss .= "asset/front_css/layout_left.css,";
}
if($theme[0]['layout'] == 'R'){
	$minCss .= "asset/front_css/layout_right.css,";
}
if($theme[0]['layout'] == 'T'){
	$minCss .= "asset/front_css/layout_top.css,";
} 
$minCss .= "asset/front_css/popup.css"; 
?>

<link href="<?php echo $minCss; ?>" rel="stylesheet" type="text/css" />

<style>
	.onoffswitch-inner:before {
	content:"<?php echo $this->global_mod->db_parse($this->lang->line('active'));?>";
	padding-left:5px;
	background-color:#0167BB;
	color:#FFF
}
.onoffswitch-inner:after {
	content:"<?php echo $this->global_mod->db_parse($this->lang->line('deleted'));?>";
	padding-right:5px;
	background-color:#EEE;
	color:#999;
	text-align:right
}
</style>
<!--QQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQ-->
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/function.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/json.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/review.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/pr_tabs.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/index.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/rules.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/booking.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/login.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/myAccount.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/coupon.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>asset/front_js/frontFacebook.js"></script>


<!--###########################################################################################################################-->
<!--###########################################################################################################################-->
<!--###########################################################################################################################-->
<!--###########################################################################################################################-->
<div id="main_date_calender" style="display: none;"></div>
<input type="hidden" id="customerLoginId" value="<?php echo $customerLoginId; ?>" />
<input type="hidden" value="0" id="contro_padding" />
<input type="hidden" value="" id="demo_padding" />

<input type="hidden" value="" id="demo_padding7" />
<input type="hidden" id="setting_val" value="" />
<input type="hidden" id="mainDataContener" value="" />
<input type="hidden" id="BookingHours" value="" />
<input type="hidden" id="staffIntervalTime" value=""/>

<!--###########################################################################################################################-->
<!--###########################################################################################################################-->
<?php if($checkFrontendDisplayStatus ==1){ ?>
<?php if(count($employee_list)>0){?>
<?php if(count($service_list)>0){?>
<div class="backgroundchange" id="enableContent" style="display: none;">
  <div class="row default">
    <aside class="four columns">
      <!--###########################################################################################################################-->
      <!--###########################################################################################################################-->
      <div id="ActiveService">
	  	<span> <?php echo $this->global_mod->db_parse($this->lang->line('selectservice'));?>:</span>
        <ul>
        <?php 
        foreach($service_list as $key => $val){
        ?>
          <!--<li onmouseover="hover_effect_srv_start('<?php //echo $val['service_id'];?>','<?php //echo $val['service_name'];?>')" onmouseout="hover_effect_srv_end('<?php //echo $val['service_id'];?>')">-->
          <li>
            <input id="srv_<?php echo $val['service_id'];?>" type="checkbox" value="<?php echo $val['service_id'];?>" name="srv">
            <input id="capcty_<?php echo $val['service_id'];?>" type="hidden" value="<?php echo $val['service_capacity'];?>">
            <input id="duration_<?php echo $val['service_id'];?>" type="hidden" value="<?php echo $val['service_duration_min'];?>">
            <a href="#" style="width: 80%"><?php echo $val['service_name'];?>
            <?php 
            if($local_admin_settings[0]['showServiceTimeDuration'] == 1)
            {
                $service_duration_unit = ($val['service_duration_unit'])=="M"?"Min":"Hour";
                echo $val['service_duration']." ".$service_duration_unit;
            }//
            if($local_admin_settings[0]['showServiceCost'] == 1){
                echo "&nbsp;&nbsp;".$this->session->userdata('local_admin_currency_type')." ".$val['service_cost'];
            }
            ?>	
			</a>
          </li>
          <?php } ?> 
        </ul>
      </div>
      <!--###########################################################################################################################-->
      <!--###########################################################################################################################-->
      <?php if($local_admin_settings[0]['showStaffCustomers']==1){?>
      <div id="ActiveStaff">
	  	<span> <?php echo $this->global_mod->db_parse($this->lang->line('selectstaff'));?>:</span>
        <ul>
		<?php
		if(count($employee_list)>1){
		?>
		<li><input class="chkAll" id="chkAll" type="checkbox" value="" name="staff"><label for="chkAll" style="width: 80%; cursor: pointer;"> &nbsp; <?php echo $this->global_mod->db_parse($this->lang->line('mobile_select_all'));?></label></li>
        <?php
		} 
        foreach($employee_list as $key => $val) {
        ?>
          <li <?php if($local_admin_settings[0]['clientsNameWithReviews']==1){?>onmouseover="hover_effect_staff_start('<?php echo $val['employee_id'];?>')" onmouseout="hover_effect_staff_end('<?php echo $val['employee_id'];?>')"<?php } ?>>
            <input id="staff_<?php echo $val['employee_id'];?>" type="checkbox" value="<?php echo $val['employee_id'];?>" name="staff">
            <?php
            $staffImage = ($val['employee_image'] != "noimage.jpg")?"uploads/staff/".$val['employee_image']:"asset/front_image/staff_img.png";
            $staffImageUrl = base_url().$staffImage;
            ?>
            <div id="staff_tltip_<?php echo $val['employee_id'];?>" class="staff_tltip" style="display: none;"><img src="<?php echo $staffImageUrl;?>" border="0" /></div>
            <a href="#" style="width: 80%"><?php echo $val['employee_name'];?></a>
		</li>
        <?php } ?> 
        </ul>
      </div>
      <?php }else{ ?>
      <div id="ActiveStaff" style="display: none;">
        <ul>
		<?php
        foreach($employee_list as $key => $val) {
        ?>
          <li>
            <input id="staff_<?php echo $val['employee_id'];?>" type="checkbox" value="<?php echo $val['employee_id'];?>" name="staff">
		</li>
        <?php } ?> 
        </ul>
      </div>
      <?php } ?>
    </aside>
    <div class="eight columns">
      <div id="tab-container" class='tab-container'>
        <ul class='etabs'>
          <li class='tab' id="tab_local_week"><a href="#week_tab"><?php echo $this->global_mod->db_parse($this->lang->line('week'));?></a></li>
          <li class='tab' id="tab_local_month"><a href="#month_tab"><?php echo $this->global_mod->db_parse($this->lang->line('month'));?></a></li>
          <li class='tab reviews_tab_map' id="tab_local_review"><a href="#reviews_tab" class="reviews_tab_map"><?php echo $this->global_mod->db_parse($this->lang->line('review'));?></a></li>
	<?php
	if($local_admin_settings[0]['allow_international_users'] == 1){
        $sign_ls  = ($local_admin_settings[0]['gmt_symbol']) == 1?'+':'-';
		$value_ls = explode(":",$local_admin_settings[0]['gmt_value']);
        echo '<div class="text_gmt" id="show_gmt">(GMT'.$sign_ls.$value_ls[0].':'.$value_ls[1].')</div>';
		echo '<input type="hidden" id="gmtDiff" value="'.$sign_ls.$value_ls[0].':'.$value_ls[1].'">';
    }
	?>
        </ul>
        <div class="clearfix"></div>
        <div class='panel-container'>
          <div id="week_tab">
            <!--week conent area start-->
            <div class="tabl-con ">
              <div class="td_header" >
			  	<div id="top_date"></div>
                <?php
                $logo = ($business_logo != "")?"uploads/businesslogo/".$business_logo:"images/defult_logo.png";
                $logoUrl = base_url().$logo;
                ?>
				<div id="logo_contener"><img alt="Logo" src="<?php echo $logoUrl;?>"></div>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
              <div class="tabl-head">
				<?php for($day=1;$day<=7;$day++){?>
			  	<div class="td_week" ><span id="day_<?php echo $day;?>"></span></div>
				<?php } ?>
              </div>
              <div class="tabl-scroll">
			  	<?php for($scroll=1;$scroll<=7;$scroll++){?>
			  	<div class="td_scroll">
                  <div class="data_scroll" id="data_scroll_<?php echo $scroll; ?>"></div>
                </div>
				<?php } ?>
              </div>
              <div class="clearfix"></div>
              <div class="td_footer" ><?php echo $this->global_mod->db_parse($this->lang->line('click'));?></div>
<!--###-->	<div class="startToPlay" style="display: none;" onclick="goToCalender()"><span><?php echo $this->global_mod->db_parse($this->lang->line('clickHear'));?></span></div>
			<div class="startToPlayEnd" style="display: none;" id="chkID"><span id="myID">Please wait</span></div>
            </div>
            <!--week conent area end-->
          </div>
          <div id="month_tab">
            <!--month conent area start-->
            <div class="tabl-con ">
              <div class="td_header" >
			  	<div id="top_date_month"></div>
			  	<div id="logo_contener"><img alt="Logo" src="<?php echo $logoUrl;?>"></div>
				<div class="clear"></div>
			  </div>
              <div class="month_tr">
			  	<?php for($month=1;$month<=7;$month++){?>
			  	<div class="month-cell"><span class="mth_date" id="mth_<?php echo $month;?>"></span> <span class="mth_data" id="mth_data_<?php echo $month;?>"></span></div>
				<?php } ?>
              </div>
              <div class="month_tr">
			  	<?php for($month=8;$month<=14;$month++){?>
			  	<div class="month-cell"><span class="mth_date" id="mth_<?php echo $month;?>"></span> <span class="mth_data" id="mth_data_<?php echo $month;?>"></span></div>
				<?php } ?>
              </div>
              <div class="month_tr">
			  	<?php for($month=15;$month<=21;$month++){?>
			  	<div class="month-cell"><span class="mth_date" id="mth_<?php echo $month;?>"></span> <span class="mth_data" id="mth_data_<?php echo $month;?>"></span></div>
				<?php } ?>
              </div>
              <div class="month_tr">
			  	<?php for($month=22;$month<=28;$month++){?>
			  	<div class="month-cell"><span class="mth_date" id="mth_<?php echo $month;?>"></span> <span class="mth_data" id="mth_data_<?php echo $month;?>"></span></div>
				<?php } ?>
              </div>
              <div class="month_tr">
			  	<?php for($month=29;$month<=35;$month++){?>
			  	<div class="month-cell"><span class="mth_date" id="mth_<?php echo $month;?>"></span> <span class="mth_data" id="mth_data_<?php echo $month;?>"></span></div>
				<?php } ?>
              </div>
              <div class="month_tr">
			  	<?php for($month=36;$month<=42;$month++){?>
			  	<div class="month-cell"><span class="mth_date" id="mth_<?php echo $month;?>"></span> <span class="mth_data" id="mth_data_<?php echo $month;?>"></span></div>
				<?php } ?>
              </div>
              <div class="clearfix"></div>
              <div class="td_footer"><?php echo $this->global_mod->db_parse($this->lang->line('click'));?></div>
              <!--month conent area end-->
<!--###-->			<div class="startToPlay" style="display: none;" onclick="goToCalender()"><span><?php echo $this->global_mod->db_parse($this->lang->line('clickHear'));?></span></div>
            </div>
          </div>
          <div id="reviews_tab">
            <!--reviews conent area start-->
            <div class="review_block">
            <div class="rev_float rev_block50">
            <h2><?php echo $address[0]['business_name']; ?> </h2>
            <br />
            <?php echo $address[0]['business_location']; ?>, 
            <?php echo $address[0]['city_name']; ?>, 
            <?php echo $address[0]['region_name']; ?>,
            <?php echo $address[0]['country_name']; ?><br />
            <?php echo $this->global_mod->db_parse($this->lang->line('mobile_phone_number'))." : ".$address[0]['business_phone']; ?>  <br />			
            <?php echo $this->global_mod->db_parse($this->lang->line('email'))." : ".$local_admin_email; ?>
            </div>  <!-- address block -->
			<!-- map block -->
			
			<?php	
			$long  					= 	$business_location[0]['long'];
			$region_name			=	$business_location[0]['region_name'];	
			$lat					=	$business_location[0]['lat'];	
			$business_zip_code		=	$business_location[0]['business_zip_code'];
			$business_location_p	=	$business_location[0]['business_location'];
			$city_name				=	$business_location[0]['city_name'];	
			$country_name			=	$business_location[0]['country_name'];
			$business_name			=	$business_location[0]['business_name'];	
			?>	
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var geocoder;
  var map;
  function initialize() {
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng('<?php echo $long; ?>','<?php echo $lat; ?>');
			var myOptions = {
			  zoom: 12,
			 zoomControl: true,
			zoomControlOptions: {
			  style: google.maps.ZoomControlStyle.SMALL
			},
			  center: latlng,
			  mapTypeId: google.maps.MapTypeId.ROADMAP 
			}
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			var address = "<?php echo $business_location_p; ?>, <?php echo $city_name; ?>, <?php echo $region_name; ?> <?php echo $business_zip_code; ?>, <?php echo $country_name; ?>";
			/*var address = "62/9 garfa main rood, kolkata, West Bengal 700075, India";*/
			geocoder.geocode( { 'address': address}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
                    draggable:false,
					position: results[0].geometry.location
				});
				google.maps.event.addListener(marker, 'click', function() {
				  infowindow.setContent("<h3><?php echo $business_name; ?></h3><?php echo $business_location_p; ?>,<br /><?php echo $city_name; ?> <?php echo $business_zip_code; ?><br /> <?php echo $region_name; ?>,  <?php echo $country_name; ?>");
				  infowindow.open(map, this);
				});
				infowindow = new google.maps.InfoWindow();
			  }
			});
	  }

	$(document).ready(function(){
		initialize();
		
		$("#tab_local_review").bind( "click", function() {  
			var center = map.getCenter();
    		google.maps.event.trigger(map, 'resize');
    		map.setCenter(center); 
    		
		});
		
		// Handler for .ready() called.
	}); 
</script>
	<div>
		<div id="map_canvas" style="width:300px;height:200px"></div>
	</div>
	
 <br clear="all" />
            <div class="clearfix"></div>

            <div class="rev_float rev_block69">
           		<div class="roundbox" id="reviews" style="height: 280px;">    
            		<h3><?php echo $this->global_mod->db_parse($this->lang->line('review'));?></h3>
        <?php 
        $counter = 0;
        $rating = 0;
        if(count($review_list)>0){
            foreach($review_list as $val){
            ?>
                <div>
                    <div class="rev_float rev_block29">
                        <?php
                        $onStar = $val['rating']; 
                        $rating = $rating + $onStar;
                        $offStar = 5 - $val['rating'];
                        for($i=0;$i<$onStar;$i++){
                        ?>
                            <img src="<?php echo base_url(); ?>asset/front_image/star.png" width="15" height="15" alt="Rating" />
                        <?php
                        }
                        for($j=0;$j<$offStar;$j++){
                        ?>
                            <img src="<?php echo base_url(); ?>asset/front_image/star_off.png" width="15" height="15" alt="Rating" />
                        <?php
                        }
                        ?>
                        <br /> 
                        <?php
                        if($val['user_id'] == ""){
                            echo "Annonymous";
                        }else{
                            echo $val['cus_city'].", <br />".$val['cus_region'].", <br />".$val['cus_country'];
                        }
                        ?>
                    </div>
                    <div class="rev_float rev_block69">
                        <?php echo $val['comments'];?>
                    </div>
                    <div class="clear"></div>
                </div> <hr /><!-- Row -->
            <?php
                $counter++;
            }
        }else{
            echo $this->global_mod->db_parse($this->lang->line('mobile_no_review'));//No reviews has been posted yet.
        }
        ?>
			 
            	</div>
				<div class="roundbox"  id="emp_details_section"  style="height: 280px;display: none;">  
					<div id="review_link">
						<a href="javascript:void(0);" onclick="view_review()" >						
							<h3>Back to review</h3>							
						</a>  
				 	</div>  
					<div class="roundbox" id="emp_details">    
				 	</div>					
			 	</div>
            </div> <!-- left block -->

            <div class="rev_float rev_block2">&nbsp;</div>
            <div class="rev_float rev_block29">
            <?php
            if(count($review_list)>0){
            ?>
                <div class="roundbox">
                <h3>
                    <?php 
                    echo $this->global_mod->db_parse($this->lang->line('mobile_average_rating'));
                    if($counter != 0){
                        echo round($rating/$counter);
                    }else{
                        echo 0;
                    }
                    ?>
                </h3>
                <?php echo $counter.' '.$this->global_mod->db_parse($this->lang->line('mobile_genuine_reviews'));?>
                </div><br/>
            <?php } ?>
                
            <div class="roundbox" style="height: 180px;">
                <h3><?php echo $this->global_mod->db_parse($this->lang->line('mobile_our_employees'));?></h3>
                <div id="emp_list">
                  <?php 
                  foreach($employee_list as $key => $val) {
                  ?>
                      <a href="#" onclick="emp_info(<?php echo $val['employee_id'];?>)"><?php echo $val['employee_name'];?></a><br/>
                      <div id="mainContainerOfStaffDetail_<?php echo $val['employee_id'];?>" style="display:none;">
                        <table class="staffDetailMainTable" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td class="staffDetailInfoTdText" style="vertical-align:top;" colspan="2">
                                    <div class="mainWhiteBoxDiv">
                                        <img class="imageclass staffDetailInfoImg" alt="No Image" src="<?php echo base_url();?>uploads/staff/<?php echo $val['employee_image'];?>" width="225" height="225">
                                        <h1><?php echo $val['employee_name'];?></h1>
                                        <dl>
                                            <dd><?php echo $val['employee_description'];?></dd>
                                        </dl>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            if($val['employee_education'] != "")
                            {
                            ?>
                            <tr>
                                <td class="staffDetailInfoTdText" colspan="2">
                                    <div class="mainWhiteBoxDiv2">
                                        <h4 style="font-weight:bold;">Education:</h4>
                                        <dl>
                                            <dd><?php echo $val['employee_education'];?></dd>
                                        </dl>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                            } 
                            if($val['employee_languages'] != "")
                            {
                            ?>
                            <tr>
                                <td class="staffDetailInfoTdText" colspan="2">
                                    <div class="mainWhiteBoxDiv2">
                                        <h4 style="font-weight:bold;">Language:</h4>
                                        <dl>
                                            <dd><?php echo $val['employee_languages'];?></dd>
                                        </dl>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                            }
                            if($val['employee_membership'] != "")
                            {
                            ?>
                            <tr>
                                <td class="staffDetailInfoTdText" colspan="2">
                                    <div class="mainWhiteBoxDiv2">
                                        <h4 style="font-weight:bold;">Professional Memberships:</h4>
                                        <dl>
                                            <dd><?php echo $val['employee_membership'];?></dd>
                                        </dl>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            if($val['employee_awards'] != "")
                            {
                            ?>
                            <tr>
                                <td class="staffDetailInfoTdText" colspan="2">
                                    <div class="mainWhiteBoxDiv2">
                                        <h4 style="font-weight:bold;">Awards:</h4>
                                        <dl>
                                            <dd><?php echo $val['employee_awards'];?></dd>
                                        </dl>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            }
                            if($val['employee_publications'] != "")
                            {
                            ?>
                            <tr>
                                <td class="staffDetailInfoTdText" colspan="2">
                                    <div class="mainWhiteBoxDiv2">
                                        <h4 style="font-weight:bold;">Publication:</h4>
                                        <dl>
                                            <dd><?php echo $val['employee_publications'];?></dd>
                                        </dl>
                                    </div>
                                </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                      </div>
                  <?php 
                  } 
                  ?>
                </div>
            </div>    
               
            </div> <!-- right block -->
           <div class="clearfix"></div>

            </div>
			
            <!--reviews conent area end-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" value="" id="demo_padding1">
<input type="hidden" value="" id="demo_padding2">
<input type="hidden" value="" id="demo_padding3">
<?php echo $controBookingArr; ?>
<?php echo $regBookingArr; ?>
<?php echo $holdBookingArr; ?>
<input type="hidden" value="" id="demo_padding4">
<input type="hidden" value="" id="demo_padding5">
<input type="hidden" value="" id="demo_padding6">

<input type="hidden" value="" id="demo_padding7">
<input type="hidden" value="" id="demo_padding8">
<input type="hidden" value="" id="demo_padding9">
<input type="hidden" value="" id="tempBizHr">
<input type="hidden" value="" id="demo_padding10">
<input type="hidden" value="" id="demo_padding11">
<input type="hidden" value="" id="demo_padding12">

<input type="hidden" value="" id="demo_padding13">
<input type="hidden" class="tempMyCont" value="" id="fn_get_staff">
<input type="hidden" value="" id="demo_padding14">

<input type="hidden" value="" id="demo_padding15">
<input type="hidden" class="tempMyCont" value="" id="fn_get_service">
<input type="hidden" value="" id="demo_padding16">

<input type="hidden" class="tempMyCont" value="" id="fn_dateIndexKey_val">
<input type="hidden" class="tempMyCont" value="" id="fn_dateIndexKey_date">
<input type="hidden" value="" id="demo_padding17">

<input type="hidden" class="tempMyCont" value="" id="fn_dataIndateWise_val">
<input type="hidden" class="tempMyCont" value="" id="fn_dataIndateWise_date">
<input type="hidden" value="" id="demo_padding18">

<input type="hidden" class="tempMyCont" value="" id="fn_dateInArray_val">
<input type="hidden" class="tempMyCont" value="" id="fn_dateInArray_date">
<input type="hidden" value="" id="demo_padding19">

<input type="hidden" class="tempMyCont" value="" id="fn_staffInDateArr_val">
<input type="hidden" class="tempMyCont" value="" id="fn_staffInDateArr_date">
<input type="hidden" value="" id="demo_padding20">

<input type="hidden" class="tempMyCont" value="" id="fn_chkCapacity_val">
<input type="hidden" class="tempMyCont" value="" id="fn_chkCapacity_date">
<input type="hidden" value="" id="demo_padding21">

<input type="hidden" class="tempMyCont" value="" id="overLapBooking_srv">
<input type="hidden" class="tempMyCont" value="" id="overLapBooking_services_duration">
<input type="hidden" class="tempMyCont" value="" id="overLapBooking_data_arr">
<input type="hidden" value="" id="demo_padding22">


<div class="fb-root" id="fb-root"></div>
<?php }else{ 
	echo 'Please enter atleast one active staff.';
}?>
<?php }else{ 
	echo 'Please enter atleast one active service.';
}?>

<?php }else{
 echo '<div class="timeBizFront"><img alt="maintenance mode" src="'.base_url().'asset/maintenance.png"></div>';

}

 ?>
<!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
<!--@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@-->
