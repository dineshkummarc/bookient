  <table width="100%" border="0" cellspacing="20" cellpadding="0"  class="panelHold" >
  <tr>
    <td align="left" valign="top" class="leftpanelHold" >
        <div class="leftpanel">
    <div align="center" class="calender"> <div id="cont"></div></div>
    <div class="left-drop">
      <ul>
        <h2>Staff</h2>
		<?php foreach($employee as $emp_rows) { ?>
        <li>
		  <span>
          <input name="emp" id="emp_<?php echo $emp_rows['id']; ?>" type="checkbox" value="<?php echo $emp_rows['id']; ?>" onclick="javascript:getCalenderview();" />
          </span>
		  <a href="#"> <?php echo $emp_rows['name']; ?> </a>
		 </li>
         <?php } ?>
      </ul>
    </div>
    <div class="left-drop">
      <ul>
        <h2>Services</h2>
		<?php 
		if(isset($service)){
		foreach($service as $serv_rows) { ?>
        <li><span>
          <input name="services" type="checkbox" value="<?php echo $serv_rows['id']; ?>" onclick="javascript:getCalenderview();" />
          </span><a href="#"> <?php echo $serv_rows['name']; ?> </a></li>
        <?php } 
		}
		?>
      </ul>
    </div>
    <p>&nbsp;</p>
  </div></td>
    <td align="left" valign="top">     
	<div class="left-arrow"><img src="<?php echo base_url(); ?>images/left-arrow.png" width="20" height="40" alt="" /></div>
  
        
        
  