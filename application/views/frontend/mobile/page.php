<div data-role="content" id="mainContent">	
<?php //echo '<pre>'; print_r($this-> session-> all_userdata()); echo '</pre>'; ?>
<?php if($settings['enable_system'] == 1){ ?>
<!--##########################################################################################-->
<!--############################ Mani Content Start ##########################################-->
<!--##########################################################################################-->
	
<!--@@@@@@@@@@@@@@@@@@@@@@@@@	Service Part Start			@@@@@@@@@@@@@@@@@@@@@@@@@-->
<div class="ui-body ui-body-c serviceContent" id="activeService" style="display: none">
	<h3><?php echo $this->lang->line('selectservice');?> :</h3>	
	<?php 
		foreach($service_list as $key => $val){
	?>
	<label class="clActiveService">
	<input id="srv_<?php echo $val['service_id'];?>" type="checkbox" value="<?php echo $val['service_id'];?>" name="srv">
	<?php 
	echo $val['service_name'];
	if($local_admin_settings[0]['showServiceTimeDuration'] == 1){
	    $service_duration_unit = ($val['service_duration_unit'])=="M"?"Min":"Hour";
	    echo "&nbsp;".$val['service_duration']." ".$service_duration_unit;
	}
	if($local_admin_settings[0]['showServiceCost'] == 1){
	    echo "&nbsp;&nbsp;".$this->session->userdata('local_admin_currency_type')." ".$val['service_cost'];
	}
	?>	
	</label>
	<?php } ?> 
</div>
<div class="serviceContent" style="display: none"> 
	<input type="button" id="serviceNext" value="<?php echo $this->lang->line('mobile_next');?>" data-theme="a" data-icon="forward" data-iconpos="right"/>
</div>
<!--@@@@@@@@@@@@@@@@@@@@@@@@@	Service Part End			@@@@@@@@@@@@@@@@@@@@@@@@@-->


<!--$$$$$$$$$$$$$$$$$$$$$$$$$	Employee Part Start			$$$$$$$$$$$$$$$$$$$$$$$$$-->
	<?php if($local_admin_settings[0]['showStaffCustomers']==1){?>
<div class="ui-body ui-body-c staffContent" id="activeStaff" style="display: none">
		<h3><?php echo $this->lang->line('selectstaff');?> :</h3>
	<?php 
    	foreach($employee_list as $key => $val) {
    ?>
	      <label class="clActiveStaff">
	        <input id="staff_<?php echo $val['employee_id'];?>" type="checkbox" value="<?php echo $val['employee_id'];?>" name="staff">
	<?php 
		echo $val['employee_name'];
	?>
		</label>
    <?php } ?> 
</div>	  
<div class="ui-grid-a staffContent" style="display: none">
	<div class="ui-block-a"><button type="button" data-theme="a" id="serviceBack" data-icon="back" data-iconpos="left"><?php echo $this->lang->line('mobile_back');?></button></div>
	<div class="ui-block-b"><button type="button" data-theme="a" id="staffNext" data-icon="forward" data-iconpos="right"><?php echo $this->lang->line('mobile_next');?></button></div>
</div>
      <?php } ?>
<!--$$$$$$$$$$$$$$$$$$$$$$$$$	Employee Part End			$$$$$$$$$$$$$$$$$$$$$$$$$-->


<!--%%%%%%%%%%%%%%%%%%%%%%%%%	Calender Part Start			%%%%%%%%%%%%%%%%%%%%%%%%%-->
<div class="ui-body ui-body-c calenderContent" style="display: none">
<h3><?php echo $this->lang->line('mobile_select_date');?></h3>
<div id="mainCalender"></div>
</div>
<div class="ui-grid-a calenderContent" style="display: none">
	<input type="hidden" id="selectedDate" value=""/>
	<div class="ui-block-a"><button type="button" data-theme="a" id="staffBack" data-icon="back" data-iconpos="left"><?php echo $this->lang->line('mobile_back');?></button></div>
	<div class="ui-block-b"><button type="button" data-theme="a" id="calenderNext" data-icon="forward" data-iconpos="right"><?php echo $this->lang->line('mobile_next');?></button>
	</div>
</div>
<!--%%%%%%%%%%%%%%%%%%%%%%%%%	Calender Part End			%%%%%%%%%%%%%%%%%%%%%%%%%-->


<!--(((((((((((((((((((((((((	Time Part Start				)))))))))))))))))))))))))-->
<div class="ui-body ui-body-c timeContent" style="display: none">
<h3><?php echo $this->lang->line('mobile_select_time');?></h3>
<div class="ui-grid-b" id="curTimeSlot">
</div>
</div>
<div class="ui-grid-a timeContent" style="display: none">
	<input type="hidden" id="selectedTime" value=""/>
	<div class="ui-block-a"><button type="button" data-theme="a" id="calenderBack" data-icon="back" data-iconpos="left"><?php echo $this->lang->line('mobile_back');?></button></div>
	<div class="ui-block-b"><button type="button" data-theme="a" id="timeNext" data-icon="forward" data-iconpos="right"><?php echo $this->lang->line('mobile_next');?></button></div>
</div>
<!--(((((((((((((((((((((((((	Time Part End				)))))))))))))))))))))))))-->


<!--HHHHHHHHHHHHHHHHHHHHHHHHH	Booking Part Start			HHHHHHHHHHHHHHHHHHHHHHHHH-->
<div class="ui-body ui-body-c bookingContent" style="display: none">
<h3><?php echo $this->lang->line('mobile_order_summary');?></h3>
<form id="bookingShowFrm">
<div id="inVoisCont"></div>
</form>
</div>
<div class="ui-grid-a bookingContent" style="display: none">
	<div class="ui-block-a"><button type="button" data-theme="a" id="timeBack" data-icon="back" data-iconpos="left"><?php echo $this->lang->line('mobile_back');?></button></div>
	<div class="ui-block-b"><button type="button" data-theme="e" id="booked" data-icon="forward" data-iconpos="right"><?php echo $this->lang->line('mobile_book_now');?></button></div>
</div>
<!--HHHHHHHHHHHHHHHHHHHHHHHHH	Booking Part End			HHHHHHHHHHHHHHHHHHHHHHHHH-->

<!--{{{{{{{{{{{{{{{{{{{{{{{{{	Login Part Start			{{{{{{{{{{{{{{{{{{{{{{{{{-->
<div class="ui-body ui-body-c loginContent" style="display: none">
<h3><?php echo $this->lang->line('mobile_user_login');?></h3>
<div class="userTypeContent">
	<div class="existingContent" onclick="imgExistingLoginFn()">
		<img src="/asset/mobile_css/images/existing.png">
		<span><?php echo $this->lang->line('mobile_existing_user');?></span>
	</div>
	<div class="newContent" onclick="imgNewLoginFn()">
		<img src="/asset/mobile_css/images/new.png">
		<span><?php echo $this->lang->line('mobile_new_user');?></span>
	</div>
	<div class="clear"></div>
	<div> -<?php echo $this->lang->line('mobile_or');?>- </div>
	<div> <?php echo $this->lang->line('mobile_quick_book');?> </div>
	<div class="red_color" id="msg_t"></div>
	<div class="quickContent">
		<ul>
			<li><a href="#" onclick="facebookFn();"><img src="/asset/mobile_css/images/fb.png">FACEBOOK</a></button></li>
			<li><a href="#" onclick="googleFn();"><img src="/asset/mobile_css/images/google.png">GOOGLE</a></li>
		</ul>
	</div>
	<div class="customLogInContent" style="display: none">
		<form id="frmExisting">
		<ul class="customLogIn">
			<li><input type="email" placeholder="<?php echo $this->lang->line('mobile_email');?>" id="ex_email" name="ex_email" class="customTextBox"></li>
			<li><input type="password" placeholder="<?php echo $this->lang->line('mobile_password');?>" class="customTextBox" id="ex_pass" name="ex_pass"></li>
			<li>&nbsp;</li>
			<li class="UserLogin" onclick="submitExistingFn()"><?php echo $this->lang->line('login');?> >></li>
		</ul>
		</form>
	</div>
	<div class="customNewLogInContent" style="display: none">
		<form id="frmNew">
		<ul>
			<li><input type="text" placeholder="<?php echo $this->lang->line('mobile_first_name');?>" name="nw_fname" id="nw_fname" class="customTextBox "></li>
			<li><input type="text" placeholder="<?php echo $this->lang->line('mobile_last_name');?>" name="nw_lname" id="nw_lname" class="customTextBox "></li>
			<li><input type="text" placeholder="<?php echo $this->lang->line('mobile_address');?>" class="customTextBox" id="nw_address" name="nw_address"></li>
			<li>
                <select class="customSelectBox" name="nw_country" id="nw_country" onchange="changeCountry(this.value)">
                    <option value="">-<?php echo $this->lang->line('mobile_select_country');?>- </option>
                    <?php
                    foreach($country as $val)
                    {
                    ?>
                        <option value="<?php echo $val['country_id'];?>"><?php echo $val['country_name'];?></option>
                    <?php
                    }
                    ?>
                </select>
            </li>
			<li id="regionContener">
                <select class="customSelectBox" name="nw_region" id="nw_region" onchange="changeRegion(this.value)">
                    <option value="">-<?php echo $this->lang->line('mobile_select_region');?>- </option>
                </select>
            </li>
			<li id="cityContener">
                <select class="customSelectBox" name="nw_city" id="nw_city">
                    <option value="">-<?php echo $this->lang->line('mobile_select_city');?>- </option>
                </select>
            </li>
			<li><input type="text" placeholder="<?php echo $this->lang->line('mobile_mobile');?>" class="customTextBox" id="nw_mobile" name="nw_mobile"></li>
			<li><input type="email" placeholder="<?php echo $this->lang->line('mobile_email');?>" class="customTextBox" id="nw_email" name="nw_email"></li>
			<li><input type="password" placeholder="<?php echo $this->lang->line('mobile_password');?>" class="customTextBox" id="nw_pass" name="nw_pass"></li>
			<li><input type="password" placeholder="<?php echo $this->lang->line('mobile_confirm_password');?>" class="customTextBox" id="nw_cpass" name="nw_cpass"></li>
			<li>&nbsp;</li>
			<li class="UserLogin" onclick="submitNewFn()"><?php echo $this->lang->line('mobile_register');?> >></li>
		</ul>
		</form>
	</div>
	<div class="logInOption">
		<ul>
			<li><?php echo $this->lang->line('mobile_forgot_password');?>? <span onclick="mobileForgetPassword()" style="cursor: pointer; color: #0512fa;"><?php echo $this->lang->line('mobile_click_here');?></span></li>
			<li><?php echo $this->lang->line('mobile_first_user');?>? <span style="cursor: pointer; color: #0512fa;" onclick="newLoginFn()"><?php echo $this->lang->line('mobile_click_here');?></span></li>
		</ul>
	</div>
</div>
</div>
<!--{{{{{{{{{{{{{{{{{{{{{{{{{	Login Part End				{{{{{{{{{{{{{{{{{{{{{{{{{-->


<!--8888888888888888888888888	About us Part End			8888888888888888888888888 -->
<div class="ui-body ui-body-c aboutusContent" style="display: none">
<h3><?php echo $this->lang->line('aboutus');?></h3>
	<div class="ui-body ui-body-b">
		<h2><?php echo $address[0]['business_name']; ?></h3> 
		<p>
			<?php echo $address[0]['business_location']; ?>, 
			<?php echo $address[0]['city_name']; ?>, 
			<?php echo $address[0]['region_name']; ?>,
			<?php echo $address[0]['country_name']; ?>
		</p>
		<p><?php echo $this->lang->line('mobile_call');?>: <?php echo $address[0]['business_phone']; ?></p>
		<p><?php echo $this->lang->line('mobile_contact_email');?>: <?php echo $local_admin_email; ?></p>
		<button data-theme="e" id="aboutSchedule"><?php echo $this->lang->line('mobile_schedule_now');?></button>			
	</div>
	<br>
	<div class="ui-body ui-body-b">
		<!--img alt="map" src="asset/mobile_css/images/map.png"-->
		<iframe id="iframe" width="300" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=15+Broad+Street,+New+York,+NY,+United+States&amp;aq=1&amp;oq=15+&amp;sll=37.09024,-95.712891&amp;sspn=47.885545,107.138672&amp;ie=UTF8&amp;hq=&amp;hnear=15+Broad+St,+New+York,+10005&amp;t=m&amp;z=14&amp;ll=40.706252,-74.010694&amp;output=embed"></iframe>			
	</div>
</div>
<!--8888888888888888888888888	About us Part End 			8888888888888888888888888 -->


<!--MMMMMMMMMMMMMMMMMMMMMMMMM	Review Part start			MMMMMMMMMMMMMMMMMMMMMMMMM-->
<div class="ui-body ui-body-c reviewContent" style="display: none">
<h3><?php echo $this->lang->line('review');?></h3>
	<ul data-role="listview" data-split-icon="gear" data-split-theme="d" class="reviewOfCustomer">
				
 <?php 
        $counter = 0;
        $rating = 0;
        if(count($review_list)>0){
            foreach($review_list as $val){
 ?>	
		<li>
			<h4>
			<?php
		        if($val['user_id'] == ""){
		            echo "Annonymous";
		        }else{
		            echo $val['cus_fname']." ".$val['cus_lname'];
		        }
		    ?> 
				<!--span class="reviewBad">Bad</span><span class="reviewExcellent">Excellent</span><span class="reviewGood">Good</span-->
			</h4>
			<?php
		        if($val['user_id'] != ""){
		            echo '<p>'.$val['cus_city'].", <br />".$val['cus_region'].", <br />".$val['cus_country'].'</p>';
		        }
		    ?> 
			<p>
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
			<?php }
			if(trim($val['comments']) !=''){
			 ?>
			</p>
			<p style="color: #669900; font-weight: bold;">Reply</p>
			<hr width="100%"/>
			<p><?php echo $val['comments'];?></p>
		<?php }?>					
		</li>
<?php 
	        $counter++;
	    }
	}else{ 
?>
            <li><h4><?php echo $this->lang->line('mobile_no_review');?></h4></li>
<?php } ?>		
	</ul>

</div>
<!--MMMMMMMMMMMMMMMMMMMMMMMMM	Review Part end				MMMMMMMMMMMMMMMMMMMMMMMMM-->


<!--WWWWWWWWWWWWWWWWWWWWWWWWW	Privacy Policy Part Start	WWWWWWWWWWWWWWWWWWWWWWWWW-->
<div class="ui-body ui-body-c privacyContent" style="display: none">
<h3><?php echo $this->lang->line('privacy');?></h3>
<P>
	<?php echo $this->info_model->getContent('privacypolicy');?>

</P>
</div>
<!--WWWWWWWWWWWWWWWWWWWWWWWWW	Privacy Policy Part End		WWWWWWWWWWWWWWWWWWWWWWWWW-->


<!--QQQQQQQQQQQQQQQQQQQQQQQQQ	Security Info Part Start	QQQQQQQQQQQQQQQQQQQQQQQQQ-->
<div class="ui-body ui-body-c securityContent" style="display: none">
<h3><?php echo $this->lang->line('security');?></h3>
<P>
	<?php echo $this->info_model->getContent('securityinfo');?>
</P>
</div>
<!--QQQQQQQQQQQQQQQQQQQQQQQQQ	Security Info Part End		QQQQQQQQQQQQQQQQQQQQQQQQQ-->


<!--BBBBBBBBBBBBBBBBBBBBBBBBB	Company Info Part Start		BBBBBBBBBBBBBBBBBBBBBBBBB-->
<div class="ui-body ui-body-c companyContent" style="display: none">
<h3><?php echo $this->lang->line('cinfo');?></h3>
<P>
	<?php echo $this->info_model->getContent('companyinfo');?>
</P>
</div>
<!--BBBBBBBBBBBBBBBBBBBBBBBBB	Company Info Part End		BBBBBBBBBBBBBBBBBBBBBBBBB-->


<!--XXXXXXXXXXXXXXXXXXXXXXXXX My Appointments part start 	XXXXXXXXXXXXXXXXXXXXXXXXX-->
<div class="ui-body ui-body-c myAppointmentContent" style="display: none">
<h3><?php echo $this->lang->line('myappo');?></h3>
	<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
	<?php
	if($this-> session-> userdata('user_id_customer') != ''){
	    $pastDataArr = $this->page_model->getPastBookingData();
        $nextDataArr = $this->page_model->getNextBookingData();

        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
	?>
		<div data-role="collapsible" data-collapsed="false">
			<h2><?php echo $this->lang->line('mobile_coming_appo');?></h2>
			<ul data-role="listview" data-split-icon="gear" data-split-theme="d" class="upBooking">
				<?php if(count($nextDataArr)==0){ ?>
                <li><h4> -- <?php echo $this->lang->line('mobile_no_records');?> -- </h4></li>
            	<?php }else{ ?>
				<?php $date = ""; ?>
                <input type="hidden" name="counter" id="counter" value="0" />
                <?php 
				foreach($nextDataArr as $val){
                    $srvDtls_service_start = $val['srvDtls_service_start'];
                    $serviceDateArr = explode(" ",$srvDtls_service_start);
                    $serviceDate = $serviceDateArr[0];
                    if($date != $serviceDate){
				?>
                        <li class="bookingDateHighlight">
                            <h4><?php echo date("d",strtotime($serviceDate))." ".$this->lang->line(date("F",strtotime($serviceDate))).", ".date("Y",strtotime($serviceDate)); ?></h4>
                        </li>
                <?php } ?>
						<li>
							<h4><?php echo $val['srvDtls_service_name']; ?></h4>
							<?php
						    $time_gmt = strtotime($serviceDateArr[1]);
                            if($local_admin_settings[0]['hours_type'] == 1){
                                $appointmentTime = date("g:i a",$time_gmt);
                            }else{
                                $appointmentTime = date("H:i",$time_gmt);
                            }
							?>
							<p><?php echo $this->lang->line('mobile_at')." ".$appointmentTime; ?>   (<?php echo $val['srvDtls_service_duration']." ".$this->lang->line('mobile_mins');?>)</p>
							<label id="status_<?php echo $val['srvDtls_id']; ?>" style="float: right;margin-top: -50px;">					
							<button  id="mobAppOffOnswitch_<?php echo $val['srvDtls_id']; ?>" onclick="mobileSetStatus('yes','<?php echo $val['srvDtls_id'];?>')" data-role="button" data-icon="delete" data-iconpos="right" data-mini="true" data-inline="true"><?php echo $this->lang->line('mobile_delete');?></button>
							</label>
						</li>
				<?php 
				$date = $serviceDate;
				} }
				?>
			</ul>
		</div>
		<div data-role="collapsible">
			<h2><?php echo $this->lang->line('mobile_past_appo');?></h2>
			<ul data-role="listview" data-split-icon="gear" data-split-theme="d" class="pastBooking">
			<?php  if(count($pastDataArr)==0){ ?>
				<li><h4> -- <?php echo $this->lang->line('mobile_no_records');?> -- </h4></li>
			<?php }else{ 			
			$date = "";
            foreach($pastDataArr as $val){
                $srvDtls_service_start = $val['srvDtls_service_start'];
                $serviceDateArr = explode(" ",$srvDtls_service_start);
                $serviceDate = $serviceDateArr[0];
                    if($date != $serviceDate){ ?>
						<li class="bookingDateHighlight">
                            <h4><?php echo date("d",strtotime($serviceDate))." ".$this->lang->line(date("F",strtotime($serviceDate))).", ".date("Y",strtotime($serviceDate)); ?></h4>
                        </li>
              <?php  } ?>
				<li>
					<h4><?php echo $val['srvDtls_service_name'] ; ?></h4>
					<?php 
                    $time_gmt = strtotime($serviceDateArr[1]); 
                    if($local_admin_settings[0]['hours_type'] == 1){
                        $appointmentTime = date("g:i a",$time_gmt);
                    }else{
                        $appointmentTime = date("H:i",$time_gmt);
                    }
                    ?>
					<p><?php echo $this->lang->line('mobile_at')." ".$appointmentTime; ?>   (<?php echo $val['srvDtls_service_duration']." ".$this->lang->line('mobile_mins'); ?>)</p>					
				</li>
          <?php  
		  	$date = $serviceDate;    
				} 
			} 
			?>
			</ul>
		</div>	
	<?php } ?>
	</div>
</div>
<!--XXXXXXXXXXXXXXXXXXXXXXXXX My Appointments part end 		XXXXXXXXXXXXXXXXXXXXXXXXX-->

<!--BBBBBBBBBBBBBBBBBBBBBBBBB	Forget Password Part Start		BBBBBBBBBBBBBBBBBBBBBBBBB-->
<div class="ui-body ui-body-c forgetPasswordContent" style="display: none">
<h3><?php echo $this->lang->line('mobile_forgot_password');?></h3>
<div class="forgetPassLogInOption">
<div id="msg_fgot_email"> </div>
<ul>
	<li><input type="email" placeholder="<?php echo $this->lang->line('mobile_email');?>" class="customTextBox" id="fgot_email" name="fgot_email"></li>
	<li><span class="submitFpassBack" onclick="submitFpassBackFn()"><< <?php echo $this->lang->line('mobile_back');?></span> &nbsp;&nbsp;<span class="submitFpass" onclick="submitFpassFn()"><?php echo $this->lang->line('mobile_submit');?> >></span></li>
</ul>
</div>
</div>
<!--BBBBBBBBBBBBBBBBBBBBBBBBB	Forget Password Part End		BBBBBBBBBBBBBBBBBBBBBBBBB-->
<?php }else{ ?>
<div class="ui-body ui-body-b">
<h4>Booking system temporarily unavailable .</h4>
</div>
<?php } ?>
<!--##########################################################################################-->
<!--############################## Mani Content End ##########################################-->
<!--##########################################################################################-->
</div><!-- /content -->


<!--##########################################################################################-->
<!--############################## Additional Content Start ##################################-->
<!--##########################################################################################-->
<input type="hidden" name="isLoginM" id="isLoginM" value="<?php echo $this-> session-> userdata('user_id_customer'); ?>"/>
<input type="hidden" name="maxBookingPeriodM" id="maxBookingPeriodM" value="<?php echo $settings['adv_bk_mx_tim']; ?>"/>
<input type="hidden" name="prePayM" id="prePayM" value="<?php echo $settings['pre_pmnt_setting']; ?>"/>
<input type="hidden" name="internationalUsersM" id="internationalUsersM" value="<?php echo $settings['internationalUsers']; ?>"/>
<input type="hidden" name="multipleServicesBookingM" id="multipleServicesBookingM" value="<?php echo $settings['multipleServicesBooking']; ?>"/>
<input type="hidden" name="srvArrMSec" id="srvArrMSec" value="<?php echo  $this-> session-> userdata('srvArrM'); ?>"/>
<input type="hidden" name="staffArrMSec" id="staffArrMSec" value="<?php echo $this-> session-> userdata('staffArrM'); ?>"/>
<input type="hidden" name="dateMSec" id="dateMSec" value="<?php echo $this-> session-> userdata('bDateM'); ?>"/>
<input type="hidden" name="timeMSec" id="timeMSec" value="<?php echo $this-> session-> userdata('bTimeM'); ?>"/>
<input type="hidden" name="latestContent" id="latestContent" value="<?php echo $this-> session-> userdata('latestContentM'); ?>"/>
<?php
$this-> session-> set_userdata('srvArrM');
$this-> session-> set_userdata('staffArrM');
$this-> session-> set_userdata('bDateM');
$this-> session-> set_userdata('bTimeM');
$this-> session-> set_userdata('latestContentM');
?>
<!--##########################################################################################-->
<!--############################## Additional Content End ####################################-->
<!--##########################################################################################-->


