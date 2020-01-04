
<div class="maincontainer">
<div class="navigation">

<ul class="otherNav">
    <li class=""><span style="font:bold 12px Arial, Helvetica, sans-serif; color:#fff; margin:15px 15px 0 0; text-align:right;" id="ddmMyHome">"Welcome ! <?php echo $this->session->userdata('user_name_staff'); ?></span></li>
    <li class=""><a href="<?php echo base_url(); ?>staff/staff_logout">Logout</a></li>
</ul>
<ul class="mainNav">
    <li><a href="<?php echo base_url(); ?>staff/staff_calender">Dashboard</a></li>
    <li class=""><a id="ddmMyHome" href="<?php echo base_url(); ?>staff/staff_home">Profile</a></li>
	<li class=""><a href="javascript:void(0)">Settings</a>
    	<ul>
            <li class=""><a id="ddmMyBusinesshour" href="<?php echo base_url(); ?>staff/business_hour">Business Hour</a></li> 
            <li class=""><a id="ddmMyBlocktimings" href="<?php echo base_url(); ?>staff/staff_manage">Block Timings</a></li>
			<li class=""><a id="ddmMygcal" href="<?php echo base_url(); ?>staff/staff_gcal">Google calendar</a></li> 			
        </ul>
    </li>
<div class="spacer"></div>
</ul>


</div>

</div>