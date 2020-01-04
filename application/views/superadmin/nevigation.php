<div class="maincontainer">
  <div class="navigation">
    <ul class="otherNav">
      <li class=""><span style="font:bold 12px Arial, Helvetica, sans-serif; color:#fff; margin:15px 15px 0 0; text-align:right;" id="ddmMyHome">"Welcome ! <?php echo $this->session->userdata('super_user_name'); ?></span></li>
	  <li class=""><a href="javascript:void(0)">Membership</a>
        <ul>
          <li class=""><a id="ddmMyAccount" href="<?php echo base_url(); ?>superadmin/membership_plan">Membership Plan</a></li>          
          <li class=""><a id="ddmServices" href="<?php echo base_url(); ?>superadmin/membership_feature">Membership Feature</a></li>        
          <li class=""><a id="ddmServices" href="<?php echo base_url(); ?>superadmin/membership_allocation">Membership Allocation</a></li>          		  <li class=""><a id="ddmBusiness" href="<?php echo base_url(); ?>superadmin/credit_manager">Credit Manager</a></li>	
        </ul>
      </li>
      <li class=""><a href="javascript:void(0)">Manager</a>
        <ul>
          <li class=""><a id="ddmMyAccount" href="<?php echo base_url(); ?>superadmin/faq_manager">FAQ Manager</a></li>
          <li class=""><a id="ddmServices" href="<?php echo base_url(); ?>superadmin/membership_plan">Membership/Subscription plan</a></li>
          <!--li class=""><a id="ddmServices" href="<?php echo base_url(); ?>superadmin/share_link">Share Link</a></li-->
          <!--li class=""><a id="ddmPayment"  href="<?php echo base_url(); ?>superadmin/payment_manager">Payment Manager</a></li>-->
          <li class=""><a id="ddmServices" href="<?php echo base_url(); ?>superadmin/profession_manager">Profession Manager</a></li>
          <li class=""><a id="ddmchangepassword" href="<?php echo base_url(); ?>superadmin/change_password">Change Password</a></li>
        </ul>
      </li>
      <li class=""><a href="javascript:void(0)"> Location Manager</a>
        <ul>
          <li class=""><a id="ddmMyCountry" href="<?php echo base_url(); ?>superadmin/country_manager">Country Manager</a></li>
          <li class=""><a id="ddmMyRegion" href="<?php echo base_url(); ?>superadmin/region_manager">Region Manager</a></li>
          <li class=""><a id="ddmMyCity" href="<?php echo base_url(); ?>superadmin/city_manager">City Manager</a></li>
          <li class=""><a id="ddmTax" href="<?php echo base_url(); ?>superadmin/tax_manager">Tax Manager</a></li>
          <li class=""><a id="ddmMyTimeZone" href="<?php echo base_url(); ?>superadmin/timezone_manager">Time Zone Manager</a></li>
          <li class=""><a id="ddmTimeFormat" href="<?php echo base_url(); ?>superadmin/timeformat_manager">Time Format Manager</a></li>
          <li class=""><a id="ddmDateFormat" href="<?php echo base_url(); ?>superadmin/dateformat_manager">Date Format Manager</a></li>
          <li class=""><a id="ddmLanguage" href="<?php echo base_url(); ?>superadmin/language_manager">Language Manager</a></li>
          <li class=""><a id="ddmPayment Gateway" href="<?php echo base_url(); ?>superadmin/payment_gateway_manager">Payment Gateway Manager</a></li>
          <!--li class=""><a id="ddmLoginmethod" href="<?php echo base_url(); ?>superadmin/loginmethod_manager">Login Method Manager</a></li-->
          <li class=""><a id="ddmMyCurrency" href="<?php echo base_url(); ?>superadmin/manage_currency">Currency Manager</a></li>
          <!--li class=""><a id="ddmMyCurrency" href="<?php echo base_url(); ?>superadmin/currency_manager">Currency Manager</a></li-->
        </ul>
      </li>
      <li class=""><a href="javascript:void(0)"> Configuration</a>
        <ul>
          <li class=""><a id="ddmMyCountry" href="<?php echo base_url(); ?>superadmin/currency_rate_manager">Manage Currency Rate</a></li>
        </ul>
      </li>
      <!--li class=""><a id="ddmMashups" href="javascript:void(0)">Mashups</a>
            <ul>
              <li class=""><a id="ddmMashupsFacebook" href="javascript:void(0)">Facebook</a></li>
              <li class=""><a id="ddmMashupsTwitter" href="javascript:void(0)">Twitter</a></li>
              <li class=""><a id="ddmMashupsGoogleCalendar" href="javascript:void(0)">Google Calendar</a></li>
            </ul>
      </li-->
      <li class=""><a href="<?php echo base_url(); ?>superadmin/dashboard/logout">Logout</a></li>
    </ul>
    <ul class="mainNav">
      <li><a href="<?php echo base_url(); ?>superadmin/dashboard">Dashboard</a></li>
      <div class="spacer"></div>
    </ul>
  </div>
</div>