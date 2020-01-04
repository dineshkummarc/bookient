<div id="detacontain"><div id="out">
    <div class="leftpanelHoldcalender" >
	<div class="leftpanel">
    <div align="center" class="calender"> <div id="calender_datepicker" ></div></div>
    <div class="left-drop">

    <h2 class="left-droph2">Services</h2>
      <ul  id="cal_services">         
<?php 
		if(count($service)>0){
		foreach($service as $serv_rows) { 
?>
        <li><span>
          <input name="services" id="srv_<?php echo $serv_rows['service_id']; ?>" type="checkbox" value="<?php /*echo $serv_rows['name'];*/echo $serv_rows['service_id']; ?>" />
          </span><a href="#"> <?php echo $serv_rows['service_name']; ?> </a></li>
<?php 	} 
		}else{
?>
		<li>Sorry, You have no Service.</li>
<?php	
		}
?>
        </ul>
    </div>
    <p>&nbsp;</p>
  </div></div>
    <div class="content-divdeta">
	<div class="left-arrow"><img src="<?php echo base_url(); ?>images/left-arrow.png" width="20" height="40" alt="" /></div>