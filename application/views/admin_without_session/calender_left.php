<div id="detacontain"><div id="out">
    <div class="leftpanelHoldcalender" >
	<div class="leftpanel">
    <div align="center" class="calender"> <div id="calender_datepicker" ></div></div>
    <div class="left-drop">
     <h2 class="left-droph2">Staff</h2>
      <ul id="cal_staff">
	  <?php
	 /* echo '<pre>';
		print_r($service);
		echo '</pre>';
		exit;*/
	  ?>       
		<?php foreach($employee as $emp_rows) { ?>
        <li onmouseout="hover_effect_staff_end('<?php echo $emp_rows['employee_id']; ?>')" onmouseover="hover_effect_staff_start('<?php echo $emp_rows['employee_id']; ?>')">
		  <span>
          <input name="emp" id="emp_<?php echo $emp_rows['employee_id']; ?>" type="checkbox" value="<?php /*echo $emp_rows['name'];*/ echo $emp_rows['employee_id']; ?>" />
          </span>
		  <a href="#"> <?php echo $emp_rows['employee_name']; ?> </a>
		  <span id="emp_span_<?php echo $emp_rows['employee_id']; ?>" class="staff_class_img"></span>
		 </li>
         <?php } ?>
      </ul>
    </div>
    <div class="left-drop">
    <h2 class="left-droph2">Services</h2>
      <ul  id="cal_services">         
		<?php 
		//CB#SOG#17-11-2012#PR#S
		if(isset($service)){
		foreach($service as $serv_rows) { ?>
        <li><span>
          <input name="services" id="srv_<?php echo $serv_rows['service_id']; ?>" type="checkbox" value="<?php /*echo $serv_rows['name'];*/echo $serv_rows['service_id']; ?>" />
          </span><a href="#"> <?php echo $serv_rows['service_name']; ?> </a></li>
        <?php } 
		}
		//CB#SOG#17-11-2012#PR#E 
		?>
        </ul>
    </div>
    <p>&nbsp;</p>
  </div></div>
    <div class="content-divdeta">
	<div class="left-arrow"><img src="<?php echo base_url(); ?>images/left-arrow.png" width="20" height="40" alt="" /></div>