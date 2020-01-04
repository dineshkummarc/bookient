<?php include('calender.js.php'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/admin_calender.js"></script>
<script>
$( document ).ready(function() {
$('body').addClass('bodyCalender');
});
</script> 
<div class="top-controler floatLeft">
    <div class="colwidth-top">
        <div id="radioset">
		    <input type="radio" id="calender_day" name="radio" checked="checked">
		    <label for="calender_day">Day</label>
		    <input type="radio" id="calender_week" name="radio" >
		    <label for="calender_week">Week</label>
		    <input type="radio" id="calender_month" name="radio">
		    <label for="calender_month">Month</label>
		    <input type="radio" id="calender_agenda" class="calender_agenda_view" name="radio">
		    <label for="calender_agenda">Agenda</label>
		    <!--input type="radio" id="calender_quick_availability" name="radio">
		    <label for="calender_quick_availability">Quick Availability</label-->
	    </div>
    </div>
    <div class="colwidth-top midiumcol">
	    <button id="calender_pre">Previous Date</button>
	    <strong><span id="cal_show_date"></span></strong>
	    <button id="calender_next">Next Date</button>
	    &nbsp;&nbsp;
	    <button id="calender_today">Today</button>
	    <?php $timeData = $this->global_mod->getTimeZoneDiff();$timdat=explode(':',$timeData[0]['gmt_value'])?>
	    <label style="font-weight: bold;font-size: 16px;color: #2582C0;">(GMT <?php echo ($timeData[0]['gmt_symbol']==1)?'+':'-'; echo $timdat[0].':'.$timdat[1]; ?>)</label>
    </div>
    <div class="colwidth-top rightcol">
	    <button id="calender_print">Print</button>
	    <button id="calender_ical">calender_ical</button>
	    <!--button id="calender_stack">Stack</button-->
	    <button id="calender_refresh">Refresh</button>
	    <input type="hidden" id="div_pre_cube" value="60"/>
	    <input type="hidden" id="width_per_td" value="250"/>
    </div>
    <input type="hidden" id="Show_all_booking_date" value="<?php echo $my_array =$this->calender_model->service_date();?>"/>
    <div style="clear:both"></div>
</div>
<div class="floatLeft">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td><div id="main_body_contener">
		<div id="main_contener" class="responsive-view" >
		<div id="all_staff_agenda" style="display: none;"></div>
		  <div class="tabuler-deta">
			<div class="thead">
			  <div style="position: relative; width: 40px;" class="onecolmin">
				<button id="calender_settings">Settings</button>
			  </div>
<?php
	$staff  =   $this->calender_model->getEmployeeList();
	$current_date=date("Y-m-d");
	$booking_array = $this->calender_model->getSelectedBookingAjax_pr($current_date);
	$WorkableTimArr = $this->calender_model->getWorkingTime();
	for($s=0;$s<count($staff);$s++){
?>
			  <div class="onecol" style="width: 250px;">
				<div class="relative"><div class="employee_name"><?php echo $staff[$s]['employee_name']; ?>
<?php
		$count_staff_booking	=	$this->calender_model->count_staff_booking($staff[$s]['employee_id'],$current_date);
		$isStaffBlockDate		=	$this->calender_model->checkingStaffBlockDate($staff[$s]['employee_id'],$current_date);
		$isStaffBlockTime		=	$this->calender_model->checkingStaffBlockTime($staff[$s]['employee_id'],$current_date);
    if($count_staff_booking > 0){
?>
					<label class="staffHeadingTbStApphd"><?php echo $count_staff_booking; ?></label>
<?php
	}
if($isStaffBlockDate > 0){
?>				
					<img title="Block date" src="<?php echo base_url(); ?>/asset/lock.png">
<?php
	}
if($isStaffBlockTime > 0){
?>				
					<img  title="Block time" src="<?php echo base_url(); ?>/asset/lock_time.png">
<?php
	}
?>
					</div>
				  <button class="calender_week_top" id="caltop_<?php echo $staff[$s]['employee_id']; ?>" rel="<?php echo $staff[$s]['employee_name']; ?>">&nbsp;</button>
				  <button class="calender_block_top" id="calblock_<?php echo $staff[$s]['employee_id']; ?>" rel="<?php echo $staff[$s]['employee_name']; ?>">&nbsp;</button>
				</div>
			  </div>
			  <?php
	}
?>
			  <div class="clear"></div>
			</div>
			<div class="clear"></div>
			<div class="tbody" style="">
			  <?php 
	for($i=0;$i<=23;$i++){
?>
			<div class="onerowcolor" style="background:<?php echo  ($i%2)?'':'#e9e9e9';?>" id="scroll_<?php echo $i; ?>">
			  <div class="bodyonecol"><span style="color:#446688; "><?php echo $this->calender_model->set_time($i);?></span></div>
			  <?php 
		   for($s=0;$s<count($staff);$s++){
?>
			  <div class="bodypartonecol" style="width: 250px;">
				<?php
		$time_difference=60;
		for($j=0;$j<60/$time_difference;$j++){
			$pieces = explode("@@", $this->calender_model->set_time_ampm_new($i));
			$pieces_new = explode("@@", $this->calender_model->set_time_ampm($i));
		if(count($booking_array)>0){
			$ls_booking_val="";
			$group_no =0;
            $ind = true;
            $name = "";
			$srvDtls_id='';
			for($b=0;$b<count($booking_array);$b++){	
                $start_timestamp	= strtotime($pieces[0].':00:00');
                $end_timestamp		= strtotime($pieces[0].':59:59');
                $today_timestamp	= strtotime($booking_array[$b]['StrtTim']);
                if(($booking_array[$b]['employee_id']==$staff[$s]['employee_id'])&&($start_timestamp<=$today_timestamp)&&($end_timestamp>=$today_timestamp)){
                    if($ind){
                        $ls_booking_val .= '<div id="'.$pieces[0].'_'.($j*$time_difference).'_'.$booking_array[$b]['srvDtls_id'].'" class="drag_inner cont_dat">';
                        $ls_booking_val .= '<h3 class="ui-widget-header">'.$pieces_new[0].':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT)."&nbsp;".$pieces[1].'<span class="ui-icon ui-icon-info schedule_booking" style="cursor: pointer;"></span><span class="ui-icon ui-icon-circle-triangle-e booking_option" style="cursor: pointer;"></span></h3>';
                        $ls_booking_val .= '<div class="min_max_div">';
                        $ls_booking_val .= $booking_array[$b]['booked'];
                        $ls_booking_val .= '</div></div>';
                        $ind= false;
                    }
                    $group_no++;
                    $name = $b;
                    $srvDtls_id .=$booking_array[$b]['srvDtls_id'].'_';						
                }
			}
			
			$ls_text = ($ls_booking_val !='')?'drag droppable':'non_drag droppable';
			$currentTime = str_pad($i,2,"0",STR_PAD_LEFT).':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT).':00';
			$chkWorkableTime = $this->calender_model->checkWorkingTime($staff[$s]['employee_id'],$current_date,$currentTime, $WorkableTimArr);
			if(count($chkWorkableTime)>0){
				$ls_text= $ls_text.' workableTime';
			}
			echo '<div class="'.$ls_text.'" id="'.$staff[$s]['employee_id'].'_'.$i.'_'.($j*$time_difference).'">';
			
		    if($ls_booking_val !=''){
				if($group_no > 1){
				    $group_text = 'Number of '.$group_no.' booking available on this time slot.Click here for details.';
				    echo  '<div class="min_max_div_group nastedgrd"><h3 class="ui-widget-header">'.$pieces_new[0].':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT)."&nbsp;".$pieces_new[1].'</h3><span class="book_cont_group" id="grp-'.substr_replace($srvDtls_id ,"",-1).'"><label>'.$group_text.'</label></span></div>';
				}else{
				    $group_text = "";
				    echo $ls_booking_val;
				}
			}
			echo '</div>';
			}	
		}
?>
			  </div>
<?php
	}
?><div class="clear"></div>
			</div>
<?php 
	}
?>
		  </div>
		</div>
		<div id="up_arrow" onclick="scroll_me_up()"><img src="<?php echo base_url(); ?>/asset/scroll_up.png"></div>
		<div id="down_arrow" onclick="scroll_me_down()"><img src="<?php echo base_url(); ?>/asset/scroll_down.png"></div>
	  </div>
	  </div></td>
  </tr>
</table>
</div>