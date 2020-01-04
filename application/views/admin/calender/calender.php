<?php include('calender.js.php'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>asset/admin_js/admin_calender.js"></script>
<script>
$( document ).ready(function() {
$('body').addClass('bodyCalender');
});

window.printItn = function() {

                    var printContent = document.getElementById('main_body_contener');
                    
                    var windowUrl = 'about:blank';
                    var uniqueName = new Date();
                    var windowName = 'Print' + uniqueName.getTime();

        //  you should add all css refrence for your html. something like.

                    var WinPrint= window.open(windowUrl,windowName,'left=300,top=300,right=500,bottom=500,width=1000,height=500');
                    WinPrint.document.write('<'+'html'+'><head><link href="cssreference" rel="stylesheet" type="text/css" /></head><'+'body style="background:none !important"'+'>');
                    WinPrint.document.write(printContent.innerHTML);
                    
                    WinPrint.document.write('<'+'/body'+'><'+'/html'+'>');
                    WinPrint.document.close();
                    WinPrint.focus();
                    WinPrint.print();
                    WinPrint.close();
                    }

</script> 

<div class="top-controler floatLeft">
    <div class="colwidth-top">
        <div id="radioset">
		    <input type="radio" id="calender_day" name="radio" checked="checked">
		    <label for="calender_day"><?php echo $this->global_mod->db_parse($this->lang->line('day_btn'))?></label>
		    <input type="radio" id="calender_week" name="radio" >
		    <label for="calender_week"><?php echo $this->lang->line('week_btn')?></label>
		    <input type="radio" id="calender_month" name="radio">
		    <label for="calender_month"><?php echo $this->lang->line('month_btn')?></label>
		    <input type="radio" id="calender_agenda" class="calender_agenda_view" name="radio">
		    <label for="calender_agenda"><?php echo $this->lang->line('agenda_btn')?></label>
		    <!--input type="radio" id="calender_quick_availability" name="radio">
		    <label for="calender_quick_availability">Quick Availability</label-->
	    </div>
    </div>
    <div class="colwidth-top midiumcol">
	    <button id="calender_pre"><?php echo $this->global_mod->db_parse($this->lang->line('previous_date'))?></button>
	    <strong><span id="cal_show_date"></span></strong>
	    <button id="calender_next"><?php echo $this->global_mod->db_parse($this->lang->line('next_date'))?></button>
	    &nbsp;&nbsp;
	    <button id="calender_today"><?php echo $this->global_mod->db_parse($this->lang->line('today_btn'))?></button>
	    <?php $timeData = $this->global_mod->getTimeZoneDiff();$timdat=explode(':',$timeData[0]['gmt_value'])?>
	    <label style="font-weight: bold;font-size: 16px;color: #2582C0;">(GMT <?php echo ($timeData[0]['gmt_symbol']==1)?'+':'-'; echo $timdat[0].':'.$timdat[1]; ?>)</label>
    </div>
    <div class="colwidth-top rightcol">
	<?php if (in_array(56, $this->global_mod->authArray())){ ?>    
	    <button id="calender_print" onclick="GetPrintData()"><?php echo $this->global_mod->db_parse($this->lang->line('print_btn'))?></button>
	 <?php } ?>  
	    <div id="GetPrint" style="display: none;">
	    	<table width="100%">
	    		<thead>
	    			<tr>
	    				<td align="left" style="font-weight: bold;font-size: 15px;"><?php echo $this->global_mod->db_parse($this->lang->line('select_date'))?></td>
	    				<td align="right" width="50%">
	    					<strong style="cursor: pointer;" class="closeTip" onclick="ClosePrintWindow()">X</strong>
	    				</td>
	    			</tr>
	    			<tr><td><?php echo $this->lang->line('from')?> :</td><td><?php echo $this->global_mod->db_parse($this->lang->line('to'))?> :</td></tr>
	    			<tr>
	    				<td>
	    					<input id="print_from" class="" type="text" readonly="true" name="print_from" value="">
	    				</td>
	    				<td>
	    					<input id="print_to" class="" type="text" readonly="true" name="print_to" value="">
	    				</td>
	    			</tr>
	    			<tr><td colspan="2">&nbsp;</td></tr>
	    			<tr>
	    				<td colspan="2" align="center">
	    					<input type="button" name="Print_btn" value="<?php echo $this->global_mod->db_parse($this->lang->line('print_btn'))?>" style="cursor: pointer;" onclick="printingFunction()"/>
	    				</td>
	    			</tr>
	    			<tr><td colspan="2">&nbsp;</td></tr>
	    		</thead>
	    	</table>
	    </div>
	    <button id="calender_ical">calender_ical</button>
	    <!--button id="calender_stack">Stack</button-->
	    <button id="calender_refresh"><?php echo $this->global_mod->db_parse($this->lang->line('refresh'))?></button>
	    <input type="hidden" id="div_pre_cube" value="<?php echo $this->calender_model->dayInterval(); ?>"/>
	    <input type="hidden" id="width_per_td" value="<?php echo $this->calender_model->dayCellWith(); ?>"/>
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
<td>
	<div id="main_body_contener">
		<div id="main_contener" class="responsive-view" >
		<div id="all_staff_agenda" style="display: none;"></div>
<?php

 		$time_difference	=	$this->calender_model->dayInterval();
	    $current_width		=	$this->calender_model->dayCellWith();

	    $selected_date		=   explode("/",$this->input->post('selected_date'));
	    $current_date		=	$current_date=date("Y-m-d");

        $staff  =   $this->calender_model->getEmployeeList();	

		$booking_array	= $this->calender_model->getSelectedBookingAjax_pr($current_date);
		$minH 			= 60/intval($time_difference);	
		$chkWorkableTimeArr = $this->calender_model->getWorkingTime();
        $local_string_data ='';
        $local_string_data .= '<div class="tabuler-deta"><div class="thead">
                                    <div class="onecolmin" style="width: 40px;"><button id="calender_settings">'.$this->global_mod->db_parse($this->lang->line("settings")).'</button></div>';
        for($s=0;$s<count($staff);$s++){
            $local_string_data .='<div class="onecol"  align="center" style="width: '.$current_width.'px;"  ><div class="relative"><div class="employee_name">'.$staff[$s]['employee_name'];		

			$count_staff_booking	=	$this->calender_model->count_staff_booking($staff[$s]['employee_id'],$current_date);	
			$isStaffBlockDate		=	$this->calender_model->checkingStaffBlockDate($staff[$s]['employee_id'],$current_date);
			$isStaffBlockTime		=	$this->calender_model->checkingStaffBlockTime($staff[$s]['employee_id'],$current_date);
			$checkTime24 		= 	$this->calender_model->checkTime24();
            if($count_staff_booking > 0){
                $local_string_data .='<label class="staffHeadingTbStApphd">'.$count_staff_booking.'</label>';
            }
			if($isStaffBlockDate > 0){			
				$local_string_data .='<img title="Block date" src="'.base_url().'/asset/lock.png">';
			}
			if($isStaffBlockTime > 0){			
				$local_string_data .='<img title="Block time" src="'.base_url().'/asset/lock_time.png">';
			}

            $local_string_data .='</div><button class="calender_week_top" id="caltop_'.$staff[$s]['employee_id'].'" rel="'.$staff[$s]['employee_name'].'">&nbsp;</button>';
            if (in_array(57, $this->global_mod->authArray())){
             $local_string_data .='<button class="calender_block_top" id="calblock_'.$staff[$s]['employee_id'].'" rel="'.$staff[$s]['employee_name'].'">&nbsp;</button>';
             }
              $local_string_data .='</div></div>';
        }
        $local_string_data .='<div class="clear"></div></div><div class="tbody" style="">';
        for($i=0;$i<=23;$i++)
        {
            $local_string_data .='<div class="onerowcolor" style="background-color:';
            $local_string_data .=($i%2)?"":"#D3D3D3";
            @$local_string_data .='" id="scroll_'.$i.'"><div class="bodyonecol">'.$this->calender_model->set_time($i,$checkTime24).'</div>';
            for($s=0;$s<count($staff);$s++){							
                $local_string_data .='<div class="bodypartonecol" style="width: '.$current_width.'px;" >';
                for($j=0;$j<60/$time_difference;$j++){
                    $jj = $j+1;
                    $pieces = explode("@@", $this->calender_model->set_time_ampm_new($i));						
                    $pieces_new = explode("@@", $this->calender_model->set_time_ampm($i,$checkTime24));
                    if(count($booking_array)>0){
                        $ls_booking_val="";
                        $group_no =0;
                        $ind = true;
                        $name = "";
                        $srvDtls_id='';
                        for($b=0;$b<count($booking_array);$b++){
                            $start_min		= ($jj*$time_difference)-($time_difference*1);
                            $start_min		= ($start_min<0)?'00':$start_min;
                            $start_timestamp	= strtotime($pieces[0].':'.($start_min).':00');
                            $end_min		= ($jj*$time_difference)-1;
                            $end_min		= ($end_min<0)?($time_difference-1):$end_min;
                            $end_timestamp		= strtotime($pieces[0].':'.($end_min).':59');
                            $today_timestamp	= strtotime($booking_array[$b]['StrtTim']);
                            if(($booking_array[$b]['employee_id'] == $staff[$s]['employee_id']) && ($today_timestamp >= $start_timestamp) && ($today_timestamp <= $end_timestamp)){
                                if($ind){
                                    $ls_booking_val .='<div id="'.$pieces[0].'_'.($j*$time_difference).'_'.$booking_array[$b]['srvDtls_id'].'_'.$booking_array[$b]['booking_id'].'" class="';
                        if (in_array(54, $this->global_mod->authArray())){            
                                    $ls_booking_val .='drag_inner';
                            }        
                                    $ls_booking_val .=' cont_dat">';
                                    $ls_booking_val .='<h3 class="ui-widget-header">'.$pieces_new[0].':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT)."&nbsp;".$pieces_new[1].'<span class="ui-icon ui-icon-info schedule_booking" style="cursor: pointer;"></span>';
                       if (in_array(58, $this->global_mod->authArray())){            
                                    $ls_booking_val .='<span class="ui-icon ui-icon-circle-triangle-e booking_option" style="cursor: pointer;"></span>';
                                    }
                                    $ls_booking_val .='</h3>';
                                    $pieces = explode(" ", $booking_array[$b]['service_duration']);
                                    $calCu = $minH*intval($pieces[0]);//($minH*intval($pieces[0])) - ((intval($pieces[0])/2)+10);
                                    $ls_booking_val .='<div class="min_max_div" style="height: '.$calCu.'px;">';
                                   
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
                        $chkWorkableTime = $this->calender_model->checkWorkingTime($staff[$s]['employee_id'],$current_date,$currentTime,$chkWorkableTimeArr);
                        if(count($chkWorkableTime)>0){
	                        $ls_text= $ls_text.' workableTime';
                        }
                        $divId = 'dayTim_'.$i.'_'.($j*$time_difference);
                        
                        if($checkTime24[0]['hours_type'] == 0){
							$divTime = date("H:i ",strtotime($i.':'.($j*$time_difference).':00'));
						}else{
							$divTime = date("h:i A",strtotime($i.':'.($j*$time_difference).':00'));
						}			
                        $local_string_data .= '<div class="'.$ls_text.'" id="'.$staff[$s]['employee_id'].'_'.$i.'_'.($j*$time_difference).'">';
                        if($ls_booking_val !=''){
                            if($group_no > 1){
                                $group_text = $this->global_mod->db_parse($this->lang->line("thr_r")).' '.$group_no.' '.$this->global_mod->db_parse($this->lang->line("bking_on_this_tm_slt"));
                                $local_string_data .= '<div class="min_max_div_group"><h3 class="ui-widget-header">'.$pieces_new[0].':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT)."&nbsp;".$pieces_new[1].'</h3><span class="book_cont_group" id="grp-'.substr_replace($srvDtls_id ,"",-1).'"><label>'.$group_text.'</label></span></div>';
                            }else{
                                $group_text = "";
                                $local_string_data .= $ls_booking_val;
                            }
                        }else{
                        		$local_string_data .= '<span id="'.$divId.'" class="timeDayBox">'.$divTime.'</span>' ;
						}
                        $local_string_data .= '</div>';
		            }	
                }					
                $local_string_data .='</div>';
            }			
	        $local_string_data .='<div class="clear"></div></div>';
        }
        $local_string_data .='</div></div>';
        $local_string_data .='
        <div id="up_arrow" onclick="scroll_me_up()"><img src="'.base_url().'/asset/scroll_up.png"></div>
        <div id="down_arrow" onclick="scroll_me_down()"><img src="'.base_url().'/asset/scroll_down.png"></div>';
        echo $local_string_data; 
        
?>
	  </div>
	  </div>
</td>
  </tr>
</table>
</div>

<style>
