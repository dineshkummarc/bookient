<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Calenderajax extends Pardco {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('GMT');
		$this->load->model('admin/dashboard_model');
		$this->load->model('admin/calender_model');
		$this->load->model('admin/staff_model');
		$this->load->library('pdf/mpdf');
		/*===================LogIn Security Check===================*/
		$this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_calender',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_calender',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		
		
	}
/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				COMMON CALENDER			#####################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/
	public function block_all_staff(){
        $staff		=	$this->pardco_model->employee();
		$current_id	=	$this->input->post('employee_id');
		$local_string	='<br>';
		$local_string	.='<ul>';
		$local_string	.='<li><strong>'.$this->lang->line("slct_staff").' :</strong></li>';   
		foreach($staff as $emp_rows) { 
	        $local_string	.='<li>';
			$local_string	.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	        $local_string	.='<input name="block_staff"';
			if($emp_rows['id'] == $current_id){
			$local_string	.=' checked="checked" disabled="disabled" ';	
			}
			$local_string	.='id="emp_block_'.$emp_rows['id'].'" type="checkbox" value="'.$emp_rows['id'].'" />&nbsp;&nbsp;&nbsp;';
			$local_string	.=$this->global_mod->show_to_control($emp_rows['name']);
			$local_string	.='</li>';
          }
		$local_string	.='</ul>'; 
		echo $local_string;
        }             			
	public function ical_data(){
            $calenderStartDate = gmdate('Y-m-d');
            $calenderEndDate = gmdate('Y-m-d', strtotime("+".NO_OF_DAY." days"));
            $search = ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$calenderStartDate.'" AS date) AND CAST("'.$calenderEndDate.'" AS date)  ';
            $dataArr = $this->global_mod->mainBookingStoreProReport($search);
            
          //  echo "<pre>";
         //   print_r($dataArr);
         //   echo "</pre>";
        //    exit;
            
            $ical ='';	 
            // Build the ics file header So Donot Change(header part start)
            $ical .= 	"BEGIN:VCALENDAR\n";
            $ical .= 	"PRODID:-//hacksw/handcal//NONSGML v1.0//EN\n";
            $ical .= 	"VERSION:2.0\n";
            $ical .= 	"METHOD:PUBLISH\n";
            $ical .= 	"CALSCALE:GREGORIAN\n";
            $ical .= 	"X-CALSTART:".$this->dateToCal(strtotime( $calenderStartDate))."\n";
            $ical .= 	"X-CALEND:".$this->dateToCal(strtotime( $calenderEndDate))."\n";                
            $ical .= 	"X-WR-CALNAME:Bookient\n";
            ########################################################
            foreach($dataArr as $val)
            {
                $customerName = ucfirst($val['cus_fname'])." ".ucfirst($val['cus_lname']);
                $serviceDuration = $val['srvDtls_service_duration'].$val['srvDtls_service_duration_unit'];
                $ical .=    "BEGIN:VEVENT\n";
                $ical .=    "CLASS:PUBLIC\n";
                $ical .=    "CREATED:".$this->dateToCal(strtotime(   $val['booking_date_time']        ))."\n";
                $ical .=    "DESCRIPTION:Client UserName : ".$val['user_email'].", Client Mobile : ".$val['cus_mob']."\n";

                $ical .=    "DTEND:".$this->dateToCal(strtotime(       $val['srvDtls_service_end']      ))."\n";
                //$ical .=  "DTSTAMP:" . time() . "\n";
                $ical .=    "DTSTART:".$this->dateToCal(strtotime( $val['srvDtls_service_start']     ))."\n";
             
                $ical .=    "UID:".microtime()."\n";

				$address = '';
				
				$addressArr = array();
				
				if(isset($val['cus_address']) && !empty($val['cus_address']) ){
				  array_push($addressArr,$val['cus_address']);
				}
				if(isset($val['city_name']) && !empty($val['city_name']) ){
				  array_push($addressArr,$val['city_name']);
				}
				if(isset($val['region_name']) && !empty($val['region_name']) ){
				  array_push($addressArr,$val['region_name']);
				}
				if(isset($val['country_name']) && !empty($val['country_name']) ){
				  array_push($addressArr,$val['cus_address']);
				}
				if( count($addressArr) ){
					$address = implode(', ',$addressArr);
				}
				
				
				
				
                $ical .=    "LOCATION:".$address."\n";
                $ical .=    "PRIORITY:1\n";
                $ical .=    "SEQUENCE:0\n";
                //$ical .=  "URL;VALUE=URI:http://mohawkaustin.com/events/" . $event['id'] . "\n";
                $ical .=    "SUMMARY:".$customerName." : ".$val['srvDtls_service_name']." ".$serviceDuration." by ".$val['srvDtls_employee_name']."\n";
                $ical .=    "TRANSP:OPAQUE\n";

                $ical .=    "X-MICROSOFT-CDO-BUSYSTATUS:BUSY\n";
                $ical .=    "X-MICROSOFT-CDO-IMPORTANCE:2\n";  
                $ical .=    "END:VEVENT\n"; 
            }
            #######################################################
            
            $ical .=        "END:VCALENDAR";
            //set correct content-type-header
            header('Content-type: text/calendar; charset=utf-8');
            //header('Content-Disposition: attachment; filename='.date ("M", strtotime(date("m/d/Y"))).'_Pardco_Events.ics');
            header('Content-Disposition: attachment; filename=Pardco_Events.ics');
            echo $ical;
	}
	public function dateToCal($time) {
		error_reporting(0);
	//	return date('Ymd\This', $time) . 'Z';
		return date('Ymd\This', $time);
	}
/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				DAY CALENDER			#####################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/	
	public function genaret_row(){
	    $time_difference	=	$this->input->post('time_difference');
	    $current_width		=	$this->input->post('width_row');
	    $updateArr =array(
					'day_interval'	=> $time_difference,
					'day_cellwith'	=> $current_width
					 );
	    $this->calender_model->updateCalenderDetails($updateArr);
	    $selected_date		=   explode("/",$this->input->post('selected_date'));
	    $current_date		=	$selected_date[2]."-".$selected_date[1]."-".$selected_date[0];
	    $selected_staff		=	$this->input->post('selected_staff');
	    $selected_services	=	$this->input->post('selected_services');
        if($selected_staff==''){
            $staff = $this->calender_model->getEmployeeList();	
        }else{
            $staff = $this->calender_model->getSelectedEmployee($selected_staff);
        }
		$booking_array = $this->calender_model->getSelectedBookingAjax_pr($current_date,$selected_staff,$selected_services);
		$minH 			= 60/intval($time_difference);
		$chkWorkableTimeArr = $this->calender_model->getWorkingTime();
        $local_string_data ='';
        $local_string_data .= '<div class="tabuler-deta"><div class="thead">
                                    <div class="onecolmin" style="width: 40px;"><button id="calender_settings">'.$this->lang->line("settings").'</button></div>';
        for($s=0;$s<count($staff);$s++){
            $local_string_data .='<div class="onecol"  align="center" style="width: '.$current_width.'px;"  ><div class="relative"><div class="employee_name">'.$staff[$s]['employee_name'];		

			$count_staff_booking	=	$this->calender_model->count_staff_booking($staff[$s]['employee_id'],$current_date,$selected_services);	
			$isStaffBlockDate		=	$this->calender_model->checkingStaffBlockDate($staff[$s]['employee_id'],$current_date);
			$isStaffBlockTime		=	$this->calender_model->checkingStaffBlockTime($staff[$s]['employee_id'],$current_date);
			$checkTime24 			=	$this->calender_model->checkTime24();
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
            $local_string_data .='" id="scroll_'.$i.'"><div class="bodyonecol">'.$this->calender_model->set_time($i,$checkTime24).'</div>';
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
                                    $calCu = $minH*intval($pieces[0]);
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
                       // $divTime = date("h:i A",strtotime($i.':'.($j*$time_difference).':00'));
                       if($checkTime24[0]['hours_type'] == 0){
							$divTime = date("H:i ",strtotime($i.':'.($j*$time_difference).':00'));
						}else{
							$divTime = date("h:i A",strtotime($i.':'.($j*$time_difference).':00'));
						}				
                        $local_string_data .= '<div class="'.$ls_text.'" id="'.$staff[$s]['employee_id'].'_'.$i.'_'.($j*$time_difference).'">';
                        if($ls_booking_val !=''){
                            if($group_no > 1){
                                $group_text = $this->lang->line("thr_r").' '.$group_no.' '.$this->lang->line("bking_on_this_tm_slt");
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
    } 
	public function genaret_row_print(){
     $resultRrr = $this->calender_model->GetAppointments();
     $date_from = $this->input->post('from_date');
     $date_to = $this->input->post('to_date');  

      $str = '<div style="text-align:center; font-size:18px; font-weight:bold; margin:5px 0 12px 0;">'.$this->lang->line("appo_report").' :: '.$this->lang->line("appo_dt_wise_reprt").' '.DATE("dS F, Y", STRTOTIME($date_from)).' to '.DATE("dS F, Y", STRTOTIME($date_to)).'</div>';
      $str .= '<table width="100%" cellspacing="12" border="0" cellpadding="0" style="text-align:center;">
                  <tr>
                        <td width="4%"  style="font-weight:bold;">'.$this->lang->line("sl_no").'</td>
                        <td width="20%" style="font-weight:bold;">'.$this->lang->line("who_booked").'</td>
                        <td width="20%" style="font-weight:bold;">'.$this->lang->line("cntct_info").'</td>
                        <td width="13%" style="font-weight:bold;">'.$this->lang->line("srvice").'</td>
                        <td width="13%" style="font-weight:bold;">'.$this->lang->line("staff").'</td>
                        <td width="20%" style="font-weight:bold;">'.$this->lang->line("appo_date").'</td>
               
                  </tr>';
               
       if(!empty($resultRrr)){
	   		$i = 1;
	   		$seperator = ',';
	   		foreach($resultRrr as $val){
				$str .= '<tr>
							<td width="4%">'.$i.'</td>
							<td width="20%">'.$val['cus_fname'].' '.$val['cus_lname'].'<br />'.$val['user_email'].'<br />'.$this->lang->line("booked_on").' '.$val['booking_date_time'].'</td>
							
							<td width="20%">'.$val['cus_address'].'<br>'.$val['city_name'].' , '.$val['region_name'].' , '.$val['country_name'].'</td>
							
							<td width="13%">'.$val['srvDtls_service_name'].'</td>
							<td width="13%">'.$val['srvDtls_employee_name'].'</td>
							<td width="20%">'.DATE("j F, Y", STRTOTIME($val["srvDtls_service_start"])).'<br />'.date("H:i",strtotime($val["srvDtls_service_start"])).'</td>
						</tr>';
				$i++;		
			}
	   		
	   		
	   }else{
	   		$str .= '<tr><td colspan="6" align="center">'.$this->lang->line("no_data_found").'</td></tr>';
	   }       
      $str .= '</table>';
      echo $str; 
      
    } 
	public function searchCustomer(){
		$searchType	= $this->input->post('search_type');
		$searchKey	= $this->input->post('search_key');
		if($searchType =='global'){
			$customerArr = $this->calender_model->customerGlobalSearch($searchKey);
		}
		if($searchType =='local'){
			$customerArr = $this->calender_model->customerLocalSearch($searchKey);
		}
		$str='<hr width="100%">';
		$str.='<table width="100%" id="customer_radio_chk">';
		if(COUNT($customerArr) > 0){
			$str.='<tr bgcolor="#9FA6AB">';
			$str.='<th width="2%">&nbsp;</th>';
			$str.='<th width="30%" align="left">'.$this->global_mod->db_parse($this->lang->line("name")).'</th>';
			$str.='<th width="50%" align="left">'.$this->global_mod->db_parse($this->lang->line("email")).'</th>';
			$str.='<th width="18%" align="left">'.$this->lang->line("phone").'</th>';
			$str.='</tr>';
			foreach($customerArr AS $arrVal){
				$str.='<tr>'; 
				$str.='<td align="center"><input type="radio" name="ex_customerId" value="'.$arrVal['user_id'].'"></td>';
				$str.='<td align="left">'.$arrVal['cus_fname'].'&nbsp;'.$arrVal['cus_lname'].'</td>';
				$str.='<td align="left">'.$arrVal['user_email'].'</td>';
				$str.='<td align="left">'.$arrVal['cus_mob'].'</td>';
				$str.='</tr>';
			}
			$str.='<tr>';
			$str.='<td colspan="4" align="right">';
			$str.='<input id="exsi_btn_booking" value="'.$this->global_mod->db_parse($this->lang->line("book_now")).'" class="btn-blue" type="button" onclick="return existingCustomerBooking()">';
			$str.='</td>';
			$str.='</tr>';
		}else{
			$str.='<tr>';
			$str.='<td align="center">';
			$str.= $this->global_mod->db_parse($this->lang->line("no_rcrds_2_display"));
			$str.='</td>';
			$str.='</tr>';
		}
		$str.='</table>';
		
		echo $str;
	}	
	public function genaret_day_form(){
	    $type				= $this->input->post('type');
	    if($type == 'day'){
		    $empIdAndTime		= $this->input->post('time_div');
		    $bookingDate		= $this->input->post('selected_date');
		    $empIdAndTimeArr	= explode("_",$empIdAndTime);
		    $employeeId			= $empIdAndTimeArr[0];
		    $bookingTime		= str_pad($empIdAndTimeArr[1],2,'0',STR_PAD_LEFT).':'.str_pad($empIdAndTimeArr[2],2,'0',STR_PAD_LEFT).':00'; 
		    $serviceArr			= $this->input->post('serviceArr'); 
		    $bookingDateTime	= date('Y-m-d H:i:s', strtotime($bookingDate.' '.$bookingTime));
		
		    
	    }
	    if($type == 'week'){
		    $weekTime			= explode("-",$this->input->post('weekTime'));
		    $bookingDate		= $this->input->post('weekDate');
		    $empArr				= $this->input->post('employeeArr');
		    $serviceArr			= $this->input->post('serviceArr');
		    $employeeId			= $empArr[0];
		    $bookingTime		= str_pad($weekTime[0],2,'0',STR_PAD_LEFT).':'.str_pad($weekTime[1],2,'0',STR_PAD_LEFT).':00';  
		    $bookingDateTime	= date('Y-m-d H:i:s', strtotime($bookingDate.' '.$bookingTime));
	    }
		
		$visible = $this -> calender_model -> getShownFields();
		
		$admin_book_always = $this->calender_model->booking_always_allowed($this->session->userdata('local_admin_id'));
		
		if ($admin_book_always) //PARDCO addition for out of business hour booking
		{
			$service = $this -> calender_model -> employeeWiseServiceTwentyFour($employeeId, $this->session->userdata('local_admin_id'));
			$staffArr = array(
				'make_count_work' => '1(^.^)1'
			);
		}		
		else //copy of the original code
		{
			if(is_array($serviceArr) && count($serviceArr)>0){
				$staffArr       =   $this->calender_model->staffWiseBizSchedule($employeeId,$bookingDateTime,$serviceArr);
			}else{
				$staffArr       =   $this->calender_model->staffWiseBizSchedule($employeeId,$bookingDateTime);
			}	
			$service 		=	$this->calender_model->employeeWiseService($staffArr,$bookingDateTime);
		}

		$empBlock 		=	$this->calender_model->employeeWiseBlocking($employeeId,$bookingDateTime);
		
		$ServiceExist 	= $this->calender_model->IsTimeExist($employeeId,$bookingDateTime);
		
		//echo "<pre>";
		//print_r($ServiceExist);
		//echo "</pre>";
		//exit;	
		
	if($ServiceExist == 0){
		$return = $this->calender_model->appoIspossible($employeeId,$bookingDateTime);
		
		//echo "<pre>";
		//print_r($return);
		//echo "</pre>";
		//exit;
		
		if(is_array($return)){
			$service = $this->calender_model->getServiceBytimespan($return);
	    if(COUNT($staffArr) && $service !='' && $empBlock == FALSE){
		    $employee		=	$this->calender_model->employeeDetails($employeeId);
		    $timeZone		=	$this->calender_model->getTimeZone();
            $country		=   $this->calender_model->country();

		    $str='';                
		    $str.='<div id="tabs">';
            $str.='<table border="0" cellpadding="5" cellspacing="5" width="100%">';

            $str.='<tr>';
            $str.='<td align="right" width="30%" valign="top"><label><strong>'.$this->global_mod->db_parse($this->lang->line("booked_date")).':</strong></label></td>';
            $str.='<td align="left">'.date('d/m/Y', strtotime($bookingDate)).'</td>';
            $str.='</tr>';

		    $str.='<tr>';
            $str.='<td align="right" width="30%" valign="top"><label><strong>'.$this->global_mod->db_parse($this->lang->line("booked_time")).':</strong></label></td>';
            $str.='<td align="left">'.$bookingTime.'</td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td align="right" valign="top"><label><strong>'.$this->global_mod->db_parse($this->lang->line("staff")).':</strong></label></td>';
            $str.='<td align="left">'.$employee[0]["employee_name"].'</td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td align="right" valign="top"><label><strong>'.$this->global_mod->db_parse($this->lang->line("srvice")).':</strong></label></td>';
            $str.='<td align="left">';
		    $str.='<select id="appointment_Service" class="ui-spinner ui-widget ui-widget-content ui-corner-all" name="appointment_Service">';
            $str.='<option value="-1">'.$this->global_mod->db_parse($this->lang->line("select_service")).'</option>';
		    $str.=$service;
            $str.='</select>';
            $str.='</td>';
            $str.='</tr>';

		    $str.='<tr id="tr_quantity">';
            $str.='<td align="right" valign="top"><label><strong>'.$this->global_mod->db_parse($this->lang->line("quantity")).':</strong></label></td>';
            $str.='<td align="left">';
		    $str.='<input id="quantity" maxlength="2" class="text ui-widget-content ui-corner-all" type="text" value="1" name="quantity">';
            $str.='</td>';
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td align="right" valign="top"><label><strong>'.$this->global_mod->db_parse($this->lang->line("usr_type")).':</strong></label></td>';
            $str.='<td align="left">';
            $str.='<select id="appointment_userType" class="text_search ui-widget-content ui-corner-all" name="appointment_userType">';
            $str.='<option value="N">'.$this->global_mod->db_parse($this->lang->line("new")).'</option>';
            $str.='<option value="E">'.$this->global_mod->db_parse($this->lang->line("existing")).'</option>';
            $str.='</select>';
            $str.='</td>'; 
            $str.='</tr>';

            $str.='<tr>';
            $str.='<td colspan="2"><hr width="100%"></td>';
            $str.='</tr>';

            $str.='</table>';

		    $str.='<div id="search_appo">';
		    $str.='<form name="dialog_search_form" id="dialog_search_form" action="post">';
		    $str.='<input type="hidden" name="ex_bookingTime" id="ex_bookingTime" value="'.$bookingDateTime.'">';
            $str.='<input type="hidden" name="ex_employeeId" id="ex_employeeId" value="'.$employeeId.'"> ';   
		    $str.='<table border="0" cellpadding="5" cellspacing="5" width="100%">';

		    //$str.='<tr>';
		    //$str.='<td><input type="checkbox" id="chk_global" value="src_global">'.' '.$this->global_mod->db_parse($this->lang->line("globl_srch"));
		    //$str.='<label id="lbl_normal">'.$this->global_mod->db_parse($this->lang->line("existing")).'</label><label  id="lbl_global">'.$this->global_mod->db_parse($this->lang->line("srch_by_email_or_ph")).'</label></td>';
		    //$str.='</tr>';

		    $str.='<tr>';
		    $str.='<td><input type="text" name="search_text" id="search_text" value="" class="text_search ui-widget-content ui-corner-all" /></td>';
		    $str.='</tr>';

		    $str.='<tr>';
		    $str.='<td><input type="button" name="search_submit" onclick="return search_form()" id="search_submit" value="'.$this->global_mod->db_parse($this->lang->line("search_btn")).'" class="btn-blue" /></td>';
		    $str.='</tr>';

		    $str.='<tr>';
		    $str.='<td><div id="search_result_contener">&nbsp;</div></td>';
		    $str.='</tr>';

		    $str.='</table>	';
		    $str.='</form> ';
		    $str.='</div>';

		    $str.='<div id="new_appo">';			
		    $str.='<form name="dialog_booking_form" id="dialog_booking_form" action="post">';
		    $str.='<fieldset>';
		    $str.='<table border="0" cellpadding="5" cellspacing="5" width="100%">';

		    $str.='<tr>';
		    $str.='<td colspan="2"><label style="font-size: 14px;font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("entr_details_below")).'.</label></td>';
		    $str.='</tr>';

		    $str.='<tr' . (((!in_array(2, $visible)) && (!in_array(3, $visible))) ? ' class="ninja"' : '') . '>';
		    $str.='<td align="right" valign="top"><label>'.$this->global_mod->db_parse($this->lang->line("name")).'</label></td>';
		    $str.='<td align="left" nowrap="nowrap">';
			$fields = array();
			if (in_array(2, $visible))
			{
				$fields[] = '<input type="text" name="first_name" maxlength="30" id="first_name" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("first_name")).'" class="text ui-widget-content ui-corner-all"/>';
			}
			else
			{
				$str.='<input class="ninja" type="text" name="first_name" maxlength="30" id="first_name" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("first_name")).'" class="text ui-widget-content ui-corner-all"/>';
			}
			if (in_array(3, $visible))
			{
				$fields[] = '<input type="text" name="last_name" maxlength="20" id="last_name" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("last_name")).'" class="text ui-widget-content ui-corner-all" />';
			}
			else
			{
				$str.='<input type="text" name="last_name" maxlength="20" id="last_name" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("last_name")).'" class="text ui-widget-content ui-corner-all" />';
			}
			$str .= implode('<br>', $fields);
		    $str.='</td>';
		    $str.='</tr>';

		    $str.='<tr' . ((!in_array(1, $visible)) ? ' class="ninja"' : '') . '>';
		    $str.='<td align="right" valign="top"><label>'.$this->global_mod->db_parse($this->lang->line("email")).'</label></td>';
		    $str.='<td align="left" nowrap="nowrap">';
		    $str.='<input type="text" name="email" id="email" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("email")).'" class="text ui-widget-content ui-corner-all" />';
		    $str.='</td>';
		    $str.='</tr>';

		    $str.='<tr' . (((!in_array(9, $visible)) && (!in_array(10, $visible)) && (!in_array(11, $visible))) ? ' class="ninja"' : '') . '>';
		    $str.='<td align="right" valign="top"><label>'.$this->global_mod->db_parse($this->lang->line("phone")).'</label></td>';
		    $str.='<td align="left" nowrap="nowrap">';
			$fields = array();
			if (in_array(9, $visible))
			{
				$fields[] = '<input type="text" name="mobile" maxlength="10" id="mobile" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("mobile")).'" class="text ui-widget-content ui-corner-all" />';
			}
			else
			{
				$str.='<input class="ninja" type="text" name="mobile" maxlength="10" id="mobile" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("mobile")).'" class="text ui-widget-content ui-corner-all" />';
			}
			
			if (in_array(10, $visible))
			{
				$fields[] = '<input type="text" name="home_no" maxlength="10" id="home_no" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("home_no")).'" class="text ui-widget-content ui-corner-all" />';
			}
			else
			{
				$str .= '<input class="ninja" type="text" name="home_no" maxlength="10" id="home_no" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("home_no")).'" class="text ui-widget-content ui-corner-all" />';
			}
			
			if (in_array(11, $visible))
			{
				$fields[] = '<input type="text" name="work_no" maxlength="10" id="work_no" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("work_no")).'" class="text ui-widget-content ui-corner-all" />';
			}
			else
			{
				$str .= '<input class="ninja" type="text" name="work_no" maxlength="10" id="work_no" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("work_no")).'" class="text ui-widget-content ui-corner-all" />';
			}
			$str .= implode('<br>', $fields);
		    $str.='</td>';
		    $str.='</tr>';

		    $str.='<tr' . (((!in_array(4, $visible)) && (!in_array(5, $visible)) && (!in_array(6, $visible)) && 
			(!in_array(7, $visible)) && (!in_array(8, $visible))) ? ' class="ninja"' : '') . '>';
		    $str.='<td align="right" valign="top"><label>'.$this->global_mod->db_parse($this->lang->line("address")).'</label></td>';
		    $str.='<td align="left">';
			
			$fields = array();
			if (in_array(4, $visible))
			{
				$fields[] = '<input type="text" name="address" id="address" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("address")).'" class="text ui-widget-content ui-corner-all" />';
			}
			else
			{
				$str .= '<input class="ninja" type="text" name="address" id="address" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("address")).'" class="text ui-widget-content ui-corner-all" />';
			}
			
			if (in_array(5, $visible))
			{
				$fields[] = '<select onchange="st(this.value)" id="appo_country" name="appo_country" class="text_search ui-widget-content ui-corner-all">' . 
					'<option value="-1" selected="selected">--'.$this->global_mod->db_parse($this->lang->line("slct_country")).'--</option>' . 
					$country . 
					'</select>';
			}
			else
			{
				$str.='<span class="ninja"><select onchange="st(this.value)" id="appo_country" name="appo_country" class="text_search ui-widget-content ui-corner-all">';
				$str.='<option value="-1" selected="selected">--'.$this->global_mod->db_parse($this->lang->line("slct_country")).'--</option>';	
				$str.=$country;
				$str.='</select></span>';
			}
			
			if (in_array(6, $visible))
			{
				$fields[] = '<span id="span_appo_region">' . 
					'<select id="appo_region" name="appo_region" class="text_search ui-widget-content ui-corner-all">' . 
					'<option value="-1" selected="selected">--'.$this->global_mod->db_parse($this->lang->line("select_region")).'--</option>' . 
					'</select></span>';
			}
			else
			{
				$str.='<span id="span_appo_region" class="ninja">';
				$str.='<select id="appo_region" name="appo_region" class="text_search ui-widget-content ui-corner-all">';
				$str.='<option value="-1" selected="selected">--'.$this->global_mod->db_parse($this->lang->line("select_region")).'--</option>';
				$str.='</select>';
				$str.='</span>';
			}
			
			if (in_array(7, $visible))
			{
				$fields[] = $str.='<span id="span_appo_city">' . 
					'<select id="appo_city" name="appo_city" class="text_search ui-widget-content ui-corner-all">' . 
					'<option value="-1"  selected="selected">--'.$this->global_mod->db_parse($this->lang->line("select_city")).'--</option>' . 
					'</select></span>';
			}
			else
			{
				$str.='<span id="span_appo_city">';
				$str.='<select id="appo_city" name="appo_city" class="text_search ui-widget-content ui-corner-all">';
				$str.='<option value="-1"  selected="selected">--'.$this->global_mod->db_parse($this->lang->line("select_city")).'--</option>';
				$str.='</select>';
				$str.='</span>';
			}
			
			if (in_array(8, $visible))
			{
				$fields[] = '<input type="text" maxlength="10" name="pin_code" id="pin_code" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("zip")).'" class="text ui-widget-content ui-corner-all" />';
			}
			else
			{
				$str.='<input class="ninja" type="text" maxlength="10" name="pin_code" id="pin_code" value="" placeholder="'.$this->global_mod->db_parse($this->lang->line("zip")).'" class="text ui-widget-content ui-corner-all" />';
			}
			$str .= implode('<br>', $fields);
		    $str.='</td>';
		    $str.='</tr>';

		    $str.='<tr' . ((!in_array(21, $visible)) ? ' class="ninja"' : '') . '>';
		    $str.='<td align="right" valign="top"><label>'.$this->global_mod->db_parse($this->lang->line("timezone")).':</label></td>';
		    $str.='<td align="left" nowrap="nowrap">';
		    $str.='<select id="appo_timezone" name="appo_timezone" class="text_search ui-widget-content ui-corner-all">';
		    $str.='<option value="-1" selected="selected">---'.$this->global_mod->db_parse($this->lang->line("select_time")).'---</option>';
		    $str.=$timeZone;					
		    $str.='</select>';
		    $str.='</td>';
		    $str.='</tr>';

            $str.='<tr>';
		    $str.='<td align="right" valign="top">&nbsp;</td>';
		    $str.='<td align="left" nowrap="nowrap">';
		    $str.='<input type="hidden" name="nb_bookingTime" id="nb_bookingTime" value="'.$bookingDateTime.'">';
            $str.='<input type="hidden" name="nb_employee_id"  id="nb_employee_id" value="'.$employeeId.'"> '; 
		    $str.='<input type="button" name="book" id="btn-submit_book_" value="'.$this->global_mod->db_parse($this->lang->line("book_now")).'" class="btn-blue" onclick="return booking_form()" />';
		    $str.='</td>';
		    $str.='</tr>';

		    $str.='</table>';
		    $str.='</fieldset>';
		    $str.='</form>';
		    $str.='</div>';

		    $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
		    $str.='<tr>';
		    $str.='<td colspan="2"><hr width="100%"></td>';
		    $str.='</tr>';

		    $str.='<tr>';
		    $str.='<td colspan="2">&nbsp;</td>';
		    $str.='</tr>';	

		    $str.='<tr>';
		    $str.='<td colspan="2"><input type="checkbox" id="client_mail"><label style="font-size: 14px;font-weight: bold;">&nbsp;'.$this->global_mod->db_parse($this->lang->line("snd_mail_2_client")).'</label></td>';
		    $str.='</tr>';

		    $str.='<tr>';
		    $str.='<td colspan="2">&nbsp;</td>';
		    $str.='</tr>';

		    $str.='</table>';
		    $str.='</div>';
		}else{
			$str='';  
			$str.='<span style="float:left; margin-left: 118px; margin-top: 20px;"><img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"></span>';
			$str.='<label style="font-size: 16px; font-weight: bold;  margin-left: 10px; margin-top:36px; float:left;">'.$this->global_mod->db_parse($this->lang->line("sry_no_srvice")).'.</label>'; 
		}
		}else{
			$str='';  
			$str.='<span style="float:left; margin-left: 118px; margin-top: 20px;"><img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"></span>';
			$str.='<label style="font-size: 16px; font-weight: bold;  margin-left: 10px; margin-top:36px; float:left;">'.$this->global_mod->db_parse($this->lang->line("sry_no_srvice")).'.</label>';
		}	
	  }else{
	  	$str='';  
			$str.='<span style="float:left; margin-left: 118px; margin-top: 20px;"><img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"></span>';
			$str.='<label style="font-size: 16px; font-weight: bold;  margin-left: 10px; margin-top:36px; float:left;">'.$this->global_mod->db_parse($this->lang->line("sry_no_srvice")).'.</label>';
	  }	
	  echo $str;
	} 
	
	public function adminNewAppointment(){
		$inputArr['employeeId']		    = $this->input->post('nb_employee_id');
		$inputArr['bookingTime']	    = $this->input->post('nb_bookingTime');
		$inputArr['serviceId']		    = $this->input->post('appointment_Service');
		$inputArr['serviceQuantity']    = $this->input->post('quantity');
		$inputArr['fName']		        = $this->input->post('first_name');
		$inputArr['lName']		        = $this->input->post('last_name');
		$inputArr['email']		        = $this->input->post('email');
		$inputArr['mobileNo']		    = $this->input->post('mobile');
		$inputArr['homeNo']		        = $this->input->post('home_no');
		$inputArr['workNo']		        = $this->input->post('work_no');
		$inputArr['address']		    = $this->input->post('address');
		$inputArr['countryId']		    = $this->input->post('appo_country');
		$inputArr['regionId']		    = $this->input->post('appo_region');
		$inputArr['cityId']		        = $this->input->post('appo_city');
		$inputArr['pinCode']		    = $this->input->post('pin_code');
		$inputArr['timeZoneId']		    = $this->input->post('appo_timezone');
		$inputArr['sendMailClient']	    = $this->input->post('client_mail');
		
	 	$admin_book_always = $this->calender_model->booking_always_allowed($this->session->userdata('local_admin_id'));
	
		//checking booking is possibale ro not
		$employeeArr=array($inputArr['employeeId']);
		$serviceArr=array($inputArr['serviceId']);
	 	$chkArr	= $this->global_mod->checkStaffAvailability($inputArr['bookingTime'],$employeeArr,$serviceArr,$admin_book_always);
		$errStr = '';
		if($chkArr[0][0]['bk_status'] == TRUE){
		    //INSERT DATA IN CUSTOMER TABLE
		//pr    $lastCustomerId = $this->calender_model->adminNewUserInsert($inputArr);
		    $lastCustomerId = $this->calender_model->adminNewCustomerInsert($inputArr);
		    //INSERT DATA IN BOOKING TABLE
		    $bookingResult = $this->calender_model->adminNewBooking($inputArr,$lastCustomerId);
		    if($bookingResult == 1){
			    $errStr .='<span style="display: block; width: 57%; margin: 0px auto;"><img style=" float:left" title="Sorry" src="'.base_url().'/asset/Smile1.png"><label style="float: left; margin-top: 18px; margin-left: 10px;"> '.$this->global_mod->db_parse($this->lang->line("yes_app_bookd")).'.</label><div style="clear:both"></div></span><label style="cursor: pointer; color: #33557C; display: inline-block; float: right; font-weight: bold;" onclick="closeNewAppPopup()">'.$this->global_mod->db_parse($this->lang->line("clk_here_2_cntinu")).'</label>';
		    }else{
			    $errStr .='<span style="display: block; width: 57%; margin: 0px auto;"><img style=" float:left" title="Sorry" src="'.base_url().'/asset/sorry_admin.png"><label style="float: left; margin-top: 18px; margin-left: 10px;"> '.$this->global_mod->db_parse($this->lang->line("sry_tempry_bking_unable")).'.</label><div style="clear:both"></div></span><label style="cursor: pointer; color: #33557C; display: inline-block; float: right; font-weight: bold;" onclick="closeNewAppPopup()">'.$this->global_mod->db_parse($this->lang->line("clk_here_2_cntinu")).'</label>';
		    }
		}else{
			$errStr .='<span style="display: block; width: 57%; margin: 0px auto;"><img style=" float:left" title="Sorry" src="'.base_url().'/asset/sorry_admin.png"><label style="float: left; margin-top: 18px; margin-left: 10px;"> '.$this->global_mod->db_parse($this->lang->line("sry_unable_2_make_booking")).'.</label><div style="clear:both"></div></span><label style="cursor: pointer; color: #33557C; display: inline-block; float: right; font-weight: bold;" onclick="closeNewAppPopup()">'.$this->global_mod->db_parse($this->lang->line("clk_here_2_cntinu")).'</label>';
		}
		echo $errStr;
	}	
	public function adminExistingAppointment(){
		$inputArr['employeeId']		= $this->input->post('ex_employeeId');
		$inputArr['bookingTime']	= $this->input->post('ex_bookingTime');
		$inputArr['serviceId']		= $this->input->post('ex_Service');
		$inputArr['serviceQuantity']= $this->input->post('ex_quantity');
		$inputArr['customerId']		= $this->input->post('ex_customerId');
		$inputArr['sendMailClient']	= $this->input->post('client_mail');
		$inputArr['chk_global']		= $this->input->post('chk_global');
		
		//echo "<pre>";
		//print_r($inputArr);
		//echo "</pre>";
		//exit;
		
		
		$admin_book_always = $this->calender_model->booking_always_allowed($this->session->userdata('local_admin_id'));

		$employeeArr=array($inputArr['employeeId']);
		$serviceArr=array($inputArr['serviceId']);
		$chkArr	= $this->global_mod->checkStaffAvailability($inputArr['bookingTime'],$employeeArr,$serviceArr,$admin_book_always);
		
		//echo "<pre>";
		//print_r($chkArr);
		//exit;
		
		$errStr = '';
		if($chkArr[0][0]['bk_status'] == TRUE){
//2need to check			if($inputArr['serviceQuantity'] < $chkArr[0][0]['remaining_capacity']){
				//INSERT DATA IN BOOKING TABLE
				$bookingResult = $this->calender_model->adminNewBooking($inputArr,$inputArr['customerId']);
				if($inputArr['chk_global'] == TRUE){
						$this->calender_model->adminRelation($inputArr);	
				}
				if($bookingResult == 1){
					$errStr .='<span style="display: block; width: 57%; margin: 0px auto;"><img style=" float:left" title="Sorry" src="'.base_url().'/asset/Smile1.png"><label style="float: left; margin-top: 18px; margin-left: 10px;"> '.$this->global_mod->db_parse($this->lang->line("yes_app_bookd")).'.</label><div style="clear:both"></div></span><label style="cursor: pointer; color: #33557C; display: inline-block; float: right; font-weight: bold;" onclick="closeNewAppPopup()">'.$this->global_mod->db_parse($this->lang->line("clk_here_2_cntinu")).'</label>';
				//$errStr .='done';
				}else{
					$errStr .='<span style="display: block; width: 57%; margin: 0px auto;"><img style=" float:left" title="Sorry" src="'.base_url().'/asset/sorry_admin.png"><label style="float: left; margin-top: 18px; margin-left: 10px;"> '.$this->global_mod->db_parse($this->lang->line("sry_tempry_bking_unable")).'</label><div style="clear:both"></div></span><label style="cursor: pointer; color: #33557C; display: inline-block; float: right; font-weight: bold;" onclick="closeNewAppPopup()">'.$this->global_mod->db_parse($this->lang->line("clk_here_2_cntinu")).'</label>';
				}
				
//2need to check			}else{
//2need to check				$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! You have crossed maximum booking capacity.';
//2need to check			}
		}else{
			$errStr .='<span style="display: block; width: 57%; margin: 0px auto;"><img style=" float:left" title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> <label style="float: left; margin-top: 18px; margin-left: 10px;">'.$this->lang->line("sry_unable_2_make_booking").'. <br/><br/>Error: '.$chkArr[0][0]['bk_msg'].'</label><div style="clear:both"></div></span><label style="cursor: pointer; color: #33557C; display: inline-block; float: right; font-weight: bold;" onclick="closeNewAppPopup()">'.$this->global_mod->db_parse($this->lang->line("clk_here_2_cntinu")).'</label>';
		}
		echo $errStr;
	}	
	public function ajax_check1(){
		$country_id= $this->input->post("id");
		if($country_id != ''){
			$showregion = $this->calender_model->region_ajax_cal($country_id);
		}else{
            $showregion ='<select id="appo_region" name="appo_region" class="text_search ui-widget-content ui-corner-all">
                        	<option value="-1" selected="selected">--Select Region--</option>
                    		</select>';	
        }
		echo $showregion;
	}	
	public function ajax_region_check1() {
		$region_id= $this->input->post("id");
		if($region_id !=''){
			$showcity = $this->calender_model->city_ajax($region_id);
		}else{
			$showcity ='<select id="appo_city" name="appo_city" class="text_search ui-widget-content ui-corner-all">';
			$showcity .= '<option value="-1"  selected="selected">--Select City--</option>';
			$showcity .= '</select>';
		}
		echo $showcity;
	 } 	
	public function day_edit_customer(){
		echo $ls_id	=	$this->input->post('ls_id');
                $custId = explode("_",$ls_id);
                $custmerId = $custId[0];
                $showCustomerDetails=$this->calender_model->selectCustomer($custmerId);
                echo $showCustomerDetails;
	}	
	public function reschedule_Save(){
            $dragDetails	= $this->input->post('dragDetails');
            $dropDatails	= $this->input->post('dropDetails');
            $type		= $this->input->post('dragType');	
            $rescheduleDate	= $this->input->post('reshuDate');	
            $is_mail		= $this->input->post('is_mail');	
            $dropArr		= explode("_",$dropDatails);
            $dropEmployeeId	= $dropArr[0];
            $dropTime		= str_pad($dropArr[1],2,'0',STR_PAD_LEFT).':'.str_pad($dropArr[2],2,'0',STR_PAD_LEFT).':00'; 
            $rescheduleDateTime	= date('Y-m-d H:i:s', strtotime($rescheduleDate.' '.$dropTime));	
            if($type == 'group'){		
                $dragArr	= explode("-",$dragDetails);
                $dragServiceId	= $dragArr[1];
            }
            if($type == 'single'){
                $dragArr	= explode("_",$dragDetails);
                $dragServiceId  = $dragArr[2];
                $bookingId = $dragArr[3];
            }
            
            $GetOldAppo = $this->calender_model->AppoDetails($dragServiceId);
            
            
            $start_time = $this->global_mod->localTimeReturn($GetOldAppo['srvDtls_service_start']);
            $end_time 	= $this->global_mod->localTimeReturn($GetOldAppo['srvDtls_service_end']);
            
            $rescheduling   =   $this->calender_model->adminRescheduleSave($rescheduleDateTime,$dropEmployeeId,$dragServiceId,$is_mail);
            
            if($is_mail == 'on' && $rescheduling != ''){
           
                $old_unit = $GetOldAppo['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
                $OldAppoInfo = 'Service Name : '.$this->global_mod->show_to_control($GetOldAppo['srvDtls_service_name']).'<br />'.'Staff name : '.$this->global_mod->show_to_control($GetOldAppo['srvDtls_employee_name']).'<br />'.'Service Date : '.$start_time.' To '.$end_time.'<br />'.'Duration : '.$GetOldAppo['srvDtls_service_duration'].' '.$old_unit;
                $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
                
                $GetNewAppo = $this->calender_model->AppoDetails($rescheduling);
            	$new_unit = $GetNewAppo['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
        		$start_time = $this->global_mod->localTimeReturn($GetNewAppo['srvDtls_service_start']);
            	$end_time 	= $this->global_mod->localTimeReturn($GetNewAppo['srvDtls_service_end']);						
        		$NewAppoInfo = 'Service Name : '.$this->global_mod->show_to_control($GetNewAppo['srvDtls_service_name']).'<br />'.'Staff name : '.$this->global_mod->show_to_control($GetNewAppo['srvDtls_employee_name']).'<br />'.'Service Date : '.$start_time.' To '.$end_time.'<br />'.'Duration : '.$GetNewAppo['srvDtls_service_duration'].' '.$old_unit;
        								
        								
        								
        	$fname = $this->calender_model->GetCusInfo($dragServiceId,2);
        	$lname = $this->calender_model->GetCusInfo($dragServiceId,3);
        	$this->load->model('admin/Cms_model');
			$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
        								
        	$cancelAppLink = base_url();
        								
        	$replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $fname,
								'{lname}' 					=> $lname,
								'{AppointmentInfo}' 		=> $NewAppoInfo,
								'{OldAppointmentInfo}' 		=> $OldAppoInfo,
								'{businessemail}' 			=> $this->session->userdata('ladmin_email'),
								'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
								'{businessaddress}' 		=> $busi_address,
								'{cancellationpolicy}' 		=> nl2br($cancellationpolicy),
								'{cancelAppLink}'			=> $cancelAppLink
								
								);
			//$toArr		= $this->calender_model->getBusiEmail($dropEmployeeId);	
			$toArr = $this->calender_model->GetUserEmail($bookingId);
			$from		= $this->session->userdata('ladmin_email');	
			
            $this->email_model->sentMail(5,$replacerArr,$toArr,$from);
                
            }
            
            return $rescheduling;
	}	
	public function count_staff_booking($staff_id,$date){
		
		return $staff_id.$date;
	}
	public function schedule_booking_form(){
		$idArr				= explode("_",$this->input->post('srvDetails'));
		$statusList     	= $this->calender_model->appStatusList();
		$bookingDetails		= $this->calender_model->singleBookingDetails($idArr[2]);
		$local_str	= '';
		$local_str	.='<table width="100%" cellspacing="0" cellpadding="0" border="0">';
		$local_str	.='<tr>';
		$local_str	.='<td width="5%"></td>';
		$local_str	.='<td width="15%"></td>';
		$local_str	.='<td width="60%"></td>';
		$local_str	.='<td width="20%"></td>';
		$local_str	.='</tr>';
		$local_str	.='<tr>';
		$local_str	.='<td>&nbsp;</td>';
		$local_str	.='<td colspan="2"><h3>'.$this->lang->line("appo_status").'</h3></td>';
		$local_str	.='<td  align="right"><strong style="cursor: pointer;" class="closeTip" onclick="CloseBlock(\'ScheduleBooking\')">X</strong></td>';
		$local_str	.='</tr>';
		$local_str	.='<tr>';
		$local_str	.='<td colspan="4">&nbsp;</td>';
		$local_str	.='</tr>';
		for($i=0;$i<count($statusList);$i++){
			if($statusList[$i]['statusId']==$bookingDetails[0]['srvDtls_booking_status']){
			    $check = 'checked="checked"';
			}else{
				$check ='';
			}    
			
			if($statusList[$i]['statusValue'] == 'Set Status'){
				$statusList[$i]['statusValue'] = $this->global_mod->db_parse($this->lang->line("set_status"));
			}
			if($statusList[$i]['statusValue'] == 'As scheduled'){
				$statusList[$i]['statusValue'] = $this->global_mod->db_parse($this->lang->line("as_schdul"));
			}
			if($statusList[$i]['statusValue'] == 'Arrived late'){
				$statusList[$i]['statusValue'] = $this->global_mod->db_parse($this->lang->line("arrived_late"));
			}
			if($statusList[$i]['statusValue'] == 'No show'){
				$statusList[$i]['statusValue'] = $this->global_mod->db_parse($this->lang->line("no_show"));
			}
			if($statusList[$i]['statusValue'] == 'Gift Cerificates'){
				$statusList[$i]['statusValue'] = $this->global_mod->db_parse($this->lang->line("gift_cretificates"));
			}
			                  
		$local_str	.='<tr>';
		$local_str	.='<td ></td>';
		$local_str	.='<td ><input type="radio" value="'.$statusList[$i]['statusId'].'" name="statusType" '.$check.'></td>';
		$local_str	.='<td colspan="2" align="left">'.$statusList[$i]['statusValue'].'</td>';
		$local_str	.='</tr>';	
		}
		$local_str	.='<tr>';
		$local_str	.='<td ></td>';
		$local_str	.='<td ><input type="hidden" value="'.$idArr[2].'" name="srvDtlsId" id="srvDtlsId"></td>';
		$local_str	.='<td colspan="2" align="left"><input class="btn-blue" type="button" value="'.$this->global_mod->db_parse($this->lang->line("ok")).'" onclick="booking_option_submit()"></td>';
		$local_str	.='</tr>';
		$local_str	.='</table>';
		echo $local_str;
		
	}	
	public function booking_option_form(){
		$id_time	= $this->input->post('id_time');
		$local_str	= '';
		$local_str	.= '<table width="100%" cellspacing="0" cellpadding="0" border="0" id="appo_option_details">
							<tr>
								<td width="5%"></td>
								<td width="15%"></td>
								<td width="80%"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="font-size: 14px;font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("appo_option")).'</td>
								<td  align="right"></td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="app_option_details(\'Edit\')">- '.$this->global_mod->db_parse($this->lang->line("edit_or_reschdl")).'</a></td>
							</tr>';
		$local_str	.= '			<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="app_option_details(\'Cancel\')">- '.$this->global_mod->db_parse($this->lang->line("cancel_btn")).'</a></td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="app_option_details(\'Client\')">- '.$this->global_mod->db_parse($this->lang->line("client_details")).'</a></td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="app_option_details(\'Order\')">- '.$this->global_mod->db_parse($this->lang->line("ordr_details")).'</a></td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="app_option_details(\'Ask\')">- '.$this->global_mod->db_parse($this->lang->line("ask_review")).'</a></td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								<!-- td><a href="javascript: void(0)" onclick="app_option_details(\'Email\')">- '.$this->global_mod->db_parse($this->lang->line("email_receipt")).'</a></td  -->
							</tr>';
		$local_str	.= 		'</table>
						<input type="hidden" value="'.$id_time.'" name="id_and_time" id="id_and_time">
						<strong style="cursor: pointer;" class="closeTip" onclick="CloseBlock(\'BookingOption\')">X</strong>';
		echo $local_str;
		
	} 
	public function booking_option_submit(){
            $statusId	= $this->input->post('statusId');
            $srvDtlsId	= $this->input->post('srvDtlsId');
            $this->global_mod->changeAppointmentStatus($statusId,$srvDtlsId);
	}
    public function booking_cancel(){
            $this->load->model('admin/approval_model');
            $bookingDetailsId	= $this->input->post('bookingDetailsId');
            $id_email		= $this->input->post('id_email');
            $cancel = $this->global_mod->changeAppointmentStatus(4,$bookingDetailsId);
          	
            if($id_email=='True'){
            	
                /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
                $bookingDetails = $this->calender_model->getBookingDetailsServiceWise($bookingDetailsId);
                
                
                
                $cus_fname = ucfirst($bookingDetails[0]['cus_fname']);
                $cus_lname = ucfirst($bookingDetails[0]['cus_lname']);
                //$service_date = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_status_date']));
                $customerMail = $bookingDetails[0]['user_email'];
                $appointmentDetails = '';
                foreach($bookingDetails as $val)
                {
                    $serviceName 	= $this->global_mod->show_to_control($val['srvDtls_service_name']);
                    $staffName 		= $this->global_mod->show_to_control($val['srvDtls_employee_name']);
                    $service_date 	= date('l, dS F, Y',strtotime($bookingDetails[0]['srvDtls_status_date']));
                   
                    $unit = $val['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
                    $appointmentDetails = 'Service Name : '.$serviceName.'<br />'.'Staff name : '.$staffName.'<br />'.'Service Date : '.$val['srvDtls_service_start'].' To '.$val['srvDtls_service_end'].'<br />'.'Duration : '.$val['srvDtls_service_duration'].' '.$unit.'<br />';
                }
                /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
                /*****      QUERY TO GET BUSINESS DETAILS STARTS        *****/
                $businessDetails 		= $this->approval_model->getBusinessDetails();
                $business_name 			= $this->global_mod->show_to_control($businessDetails[0]['business_name']);
                $business_location 		= $this->global_mod->show_to_control($businessDetails[0]['business_location']);
                $business_description 	= $this->global_mod->show_to_control($businessDetails[0]['business_description']);
                $business_phone 		= $businessDetails[0]['business_phone'];
                $user_email 			= $businessDetails[0]['user_email'];
                
                
                //////      QUERY TO GET BUSINESS DETAILS ENDS      ////////
                
                /////      QUERY TO GET CANCELLATION POLICY STARTS   //////
                
                $cancellationPolicyArr = $this->approval_model->getCancellationPolicy();
                
                /*****      QUERY TO GET CANCELLATION POLICY ENDS       *****/
                /*****      QUERY TO GET MAXIMUM CANCELLATION TIME STARTS       *****/
                
                $maxTimeArr = $this->approval_model->getMaxCancellationTime();
                $maxTime = $maxTimeArr[0]['bkin_can_mx_tim'];
                if($maxTimeArr[0]['bkin_can_setin'] == 1){
                    $maxUnit = "Day(s)";
                }elseif($maxTimeArr[0]['bkin_can_setin'] == 2){
                    $maxUnit = "Hour(s)";
                }else{
                    $maxUnit = "Minute(s)";
                }
                $cancellationMaxTime = $maxTime." ".$maxUnit;   
                
            /*****      QUERY TO GET MAXIMUM CANCELLATION TIME ENDS     *****/
                ###############################################
                    
                $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
                
                $cancelationPolicy = $cancellationPolicyArr[0]['cms_dec'];
                $replacerArr = array( '{businessname}'			=> $business_name,
                					  '{businessaddress}'		=> $busi_address,
                					  '{businessemail}'			=> $user_email,
                					  '{businessphone}'			=> $business_phone,
                					  '{AppointmentInfo}'		=> $appointmentDetails,
                					  '{fname}'					=> $cus_fname,
                					  '{lname}'					=> $cus_lname,
                					  '{cancellationpolicy}'	=> nl2br($cancelationPolicy),
                					  '{additionalinformation}'	=> nl2br($cancelationPolicy),
                					  '{yourphone}'				=> $business_phone,
                					  '{CancellationHour}'		=> $cancellationMaxTime	
                
                );
                
             
                $mail = $this->email_model->sentMail(6, $replacerArr, $customerMail, $user_email);
            }
        }
    public function staffWiseTimeDropDown(){
                   $employeeId		= $this->input->post('staff_id');
                   $serviceId		= $this->input->post('service_id');
                   $bookingDate		= $this->input->post('select_date');
                   $timeDiff		= $this->input->post('time_difference');
                   echo $availableSlot 	= $this->calender_model->availableTimeSlotGenerate($employeeId,$serviceId,$bookingDate,$timeDiff);
            }
    public function make_reschedule(){
                            $data				= array();
                            $bookingDetailsId	= $this->input->post('bookingDetailsId');
                            $serviceId			= $this->input->post('serviceId');
                            $serviceQuantity	= $this->input->post('serviceQuantity');
                            $employeeId			= $this->input->post('employeeId');
                            $bookingDate		= $this->input->post('bookingDate');
                            $bookingTime		= $this->input->post('bookingTime');
                            $bookingDateTime	= date('Y-m-d H:i:s', strtotime($bookingDate.' '.$bookingTime));

                            $checking = $this->calender_model->checkingReschedule($bookingDateTime,$employeeId,$bookingDetailsId);
                            if($checking == TRUE){
                            	
                            		$GetOldAppo = $this->calender_model->AppoDetails($bookingDetailsId);
                            		
                            		
                            		
                                    $save = $this->calender_model->adminRescheduleSave($bookingDateTime,$employeeId,$bookingDetailsId,'',$serviceQuantity);
                                    
                                    
                                    if($save != 0){
                                    	
                                    	
        /////////////////////////////////  Send Mail After Reschedule Section /////////////////////////////////////////////////////                            											
        								//$local_admin_id = $this->session->userdata('local_admin_id');
        								
        								$old_unit = $GetOldAppo['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
        								$start_time = $this->global_mod->localTimeReturn($GetOldAppo['srvDtls_service_start']);
										$end_time = $this->global_mod->localTimeReturn($GetOldAppo['srvDtls_service_end']);
        								
                            			$OldAppoInfo = 'Service Name : '.$this->global_mod->show_to_control($GetOldAppo['srvDtls_service_name']).'<br />'.'Staff name : '.$this->global_mod->show_to_control($GetOldAppo['srvDtls_employee_name']).'<br />'.'Service Date : '.$start_time.' To '.$end_time.'<br />'.'Duration : '.$GetOldAppo['srvDtls_service_duration'].' '.$old_unit;
                            		
                            			$busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
        								
        								$GetNewAppo = $this->calender_model->AppoDetails($save);
        								
        								$new_unit = $GetNewAppo['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
        								$start_time = $this->global_mod->localTimeReturn($GetNewAppo['srvDtls_service_start']);
										$end_time = $this->global_mod->localTimeReturn($GetNewAppo['srvDtls_service_end']);
        								$NewAppoInfo = 'Service Name : '.$this->global_mod->show_to_control($GetNewAppo['srvDtls_service_name']).'<br />'.'Staff name : '.$this->global_mod->show_to_control($GetNewAppo['srvDtls_employee_name']).'<br />'.'Service Date : '.$start_time.' To '.$end_time.'<br />'.'Duration : '.$GetNewAppo['srvDtls_service_duration'].' '.$new_unit;
        								
        								
        								
        								$fname = $this->calender_model->GetCusInfo($bookingDetailsId,2);
        								$lname = $this->calender_model->GetCusInfo($bookingDetailsId,3);
        								
        								
        								
        								$this->load->model('admin/Cms_model');
										$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
        								$cancelPolicy = $this->global_mod->show_to_control($cancellationpolicy);
        								$cancelAppLink = base_url();
        								
        								$replacerArr = array(
														'{businessname}'			=> $this->session->userdata('ad_name'),
														'{fname}' 					=> $this->global_mod->show_to_control($fname),
														'{lname}' 					=> $this->global_mod->show_to_control($lname),
														'{AppointmentInfo}' 		=> $NewAppoInfo,
														'{OldAppointmentInfo}' 		=> $OldAppoInfo,
														'{businessemail}' 			=> $this->session->userdata('ladmin_email'),
														'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
														'{businessaddress}' 		=> $busi_address,
														'{cancellationpolicy}' 		=> nl2br($cancelPolicy),
														'{cancelAppLink}'			=> $cancelAppLink
														
														);
													
										
										$toArr		= $this->calender_model->userEmailAddress($bookingDetailsId);	
										$from		= $this->session->userdata('ladmin_email');	
										
							            $send = $this->email_model->sentMail(5,$replacerArr,$toArr,$from);
        								
        								
        /////////////////////////////////// Send Mail After Reschedule End ///////////////////////////////////////////////////////								
                                    	
                                            echo 1;
                                    }else{
                                            echo '<lebel style="color:red">'.$this->lang->line("sry_unable_2_reschdl").'.</lebel>';
                                    }
                            }else{
                                    echo '<lebel style="color:red">'.$this->lang->line("sry_nt_available_at_this_time").'.</lebel>';
                            }
            }
    public function booking_option_html($type,$details=""){
        if($type=='cancel'){//booking_cancel()
            $local_str	='';	
            $id_time	= $this->input->post('id_time');
            $idArr = explode("_",$id_time);
            $bookingServiceId = $idArr[2];
			$local_str	.='<table width="250px" cellspacing="0" cellpadding="0" border="0">';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td ></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td style="font-size: 14px;font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("cancel_options")).'</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%">&nbsp;</td>';
			$local_str	.='<td ></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td><input type="checkbox" checked="true" id="app_cancel_email">&nbsp;&nbsp;'.$this->global_mod->db_parse($this->lang->line("snd_mail_2_client")).'. </td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%">&nbsp;</td>';
			$local_str	.='<td ></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td align="center"><input class="btn-blue" id="btn_cancel_appo" type="button" value="'.$this->global_mod->db_parse($this->lang->line("submit_btn")).'" onclick="app_cancel_option(\''.$bookingServiceId.'\')"/></td>';
			$local_str	.='</tr>';
			$local_str	.='</table>';
            echo $local_str;
        }
        if($type=='client'){
            $local_str	='';	 							
            $id_time	= $this->input->post('id_time');
            $idArr = explode("_",$id_time);
            $bookingServiceId = $idArr[2];
            $clientDetailsArr = $this->calender_model->customerDetails($bookingServiceId);
            $fname = isset($clientDetailsArr[0]['cus_fname'])?$clientDetailsArr[0]['cus_fname']:'';
            $lname = isset($clientDetailsArr[0]['cus_lname'])?$clientDetailsArr[0]['cus_lname']:'';
            $mob = isset($clientDetailsArr[0]['cus_mob'])?$clientDetailsArr[0]['cus_mob']:'';
            $email = isset($clientDetailsArr[0]['user_email'])?$clientDetailsArr[0]['user_email']:'';
            $city_name = isset($clientDetailsArr[0]['city_name'])?$clientDetailsArr[0]['city_name']:'';
            $region_name = isset($clientDetailsArr[0]['region_name'])?$clientDetailsArr[0]['region_name']:'';
            $country_name = isset($clientDetailsArr[0]['country_name'])?$clientDetailsArr[0]['country_name']:'';
            $notes 			= isset($clientDetailsArr[0]['customer_info'])?$clientDetailsArr[0]['customer_info']:'';
			$local_str	.='<table width="250px" cellspacing="0" cellpadding="0" border="0">';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td ></td>';
			$local_str	.='<td ></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td colspan="2" style="font-size: 14px;font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("usr_details")).'</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%">&nbsp;</td>';
			$local_str	.='<td colspan="2"></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td wdith="20%"><strong>'.$this->global_mod->db_parse($this->lang->line("name")).' : </strong></td>';
			$local_str	.='<td>'.ucfirst($fname).' '.ucfirst($lname).'</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td><strong>'.$this->global_mod->db_parse($this->lang->line("phone")).' : </strong></td>';
			$local_str	.='<td>'.$mob.' </td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td><strong>'.$this->global_mod->db_parse($this->lang->line("email")).' : </strong></td>';
			$local_str	.='<td>'.$email.'</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td><strong>'.$this->global_mod->db_parse($this->lang->line("address")).' : </strong></td>';
			$local_str	.='<td>'.ucfirst($city_name).', '.ucfirst($region_name).', '.ucfirst($country_name).'</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%">&nbsp;</td>';
			$local_str	.='<td colspan="2"></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td width="5%"></td>';
			$local_str	.='<td><strong>'.$this->global_mod->db_parse($this->lang->line("notes")).'</strong></td>';
			$local_str	.='<td align="center">'.$notes.'</td>';
			$local_str	.='</tr>';
			$local_str	.='</table>';
			echo $local_str;
        }
        
        if($type=='order'){
            $idArr = explode("_",$this->input->post('id_time'));
            $bookingId	= $idArr[3];
      
        $bookingServiceDatails		= $this->calender_model->bookingIdWiseBookingDetails($bookingId);
        
        $bookingDatails				= $this->calender_model->bookingIdDetails($bookingId);
        
        $TaxArr = @unserialize($bookingDatails[0]['booking_tax_dtls_arr']);
        
        $str='';						
        $str.='<table width="840px" cellspacing="0" cellpadding="0" border="0">';
        $str.='<tr>';
        $str.='<td colspan="6" bgcolor="#0057A6" style="color: #FFFFFF;font-weight: bold; padding: 3px 0 3px 20px;"> '.$this->global_mod->db_parse($this->lang->line("ordr_details")).' </td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="6" style="padding: 0px 0px 0px 0px;" width="100%">&nbsp;</td>';
        $str.='</tr>';
        $str.='<tr bgcolor="#E8F0FF" style="color: #0057A6;font-weight: bold;">';
        $str.='<td align="left" width="168px">'.$this->global_mod->db_parse($this->lang->line("staff")).'</td>';
        $str.='<td align="left" width="126px">'.$this->global_mod->db_parse($this->lang->line("srvice")).'</td>';
        $str.='<td align="left" width="252px">'.$this->global_mod->db_parse($this->lang->line("time")).'</td>';
        $str.='<td align="left" width="84px">'.$this->global_mod->db_parse($this->lang->line("cost")).' ('.$this->session->userdata("local_admin_currency_type").')</td>';
        $str.='<td colspan="2"  width="210px">&nbsp;</td>';
        $str.='</tr>';
        foreach($bookingServiceDatails as $bookingDatailsVal){
            $str.='<tr>';
            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_employee_name'].'</td>';
            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_service_name'].' ('.$bookingDatailsVal['srvDtls_service_quantity'].')</td>';
            $str.='<td align="left" nowrap="true">'.date("h:i A",strtotime($bookingDatailsVal['srvDtls_service_start'])).' - '.date("h:i A",strtotime($bookingDatailsVal['srvDtls_service_end'])).' ('.date("M d,Y",strtotime($bookingDatailsVal['srvDtls_service_start'])).') </td>';
            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_service_cost'].' X '.$bookingDatailsVal['srvDtls_service_quantity'].' = '.$this->global_mod->currencyFormat($bookingDatailsVal['srvDtls_service_cost']*$bookingDatailsVal['srvDtls_service_quantity']).'</td>';
            $str.='<td colspan="2">&nbsp;</td>';
            $str.='</tr>';
        }
        $str.='<tr>';
        $str.='<td colspan="6" style="border-top:1px dashed #0057A6;height:2px;"  width="100%">&nbsp;</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="2" valign="top">';
        $str.='<table width="290px" cellspacing="0" cellpadding="0" border="0">';
        $str.='<tr>';
        $str.='<td style="font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("some_nots_4_this_appo")).' </td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td><textarea id="order_comment_'.$bookingId.'" style="width: 90%; height:150px;">'.$bookingDatails[0]['booking_comment'].'</textarea></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td><input type="button" id="bt_add_comment__'.$bookingId.'" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("add_cmnt")).'" onclick="bookingCommentAgenda('.$bookingId.')"></td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        
        
        
      if($bookingDatails[0]['cash_register_id'] == ''){
	  	
        $str.='<td colspan="2" valign="top">';
        $str.='<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $str.='<tr>';
        $str.='<td align="left" width="252px">'.$this->global_mod->db_parse($this->lang->line("total_amnt")).' -</td>';
        $str.='<td align="left" width="84px">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("additional_chrges")).' -</td>';
        $str.='<td align="left" id="additnal_chrg">0.00</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("discount")).' -  </td>';
        $str.='<td align="left" id="total_discnt">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_disc_amount']).' </td>';
        $str.='</tr>';
        if(is_array($TaxArr)){
	        foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
	        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
				 $str.='<tr><td align="left">'.$taxName[0].'</td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
			}
		}	
	  	
        $str.='<tr style="border-top:1px solid #0057A6;" width="100%">';
        $str.='<td align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">'.$this->global_mod->db_parse($this->lang->line("total")).' -</td>';
        $str.='<td id="left_total" align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">&nbsp;</td>';
        $str.='<td align="left">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).' '.$this->global_mod->db_parse($this->lang->line("paid")).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">&nbsp;</td>';
        $str.='<td align="left" id="due_td">'.$this->session->userdata("local_admin_currency_type").'000 '.$this->global_mod->db_parse($this->lang->line("due")).'</td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        $str.='<td colspan="2" valign="top">';
        $str.='<table width="100%" cellspacing="2" cellpadding="0" border="0" style="border: 2px dashed #D3D3D3; border-radius: 10px 10px 10px 10px; float: right;margin-right: 0 px;padding: 25px;">';
        $str.='<tr>';
        $str.='<td align="left" width="126px">'.$this->global_mod->db_parse($this->lang->line("payment_mode")).'</td>';
        $str.='<td align="left" width="84px">';
        $str.='<select id="payment_mode" style="width: 80px">';
        $str.='<option value="1">Cash</option>';
        $str.='<option value="2">Credit Card</option>';
        $str.='<option value="3">Check</option>';
        $str.='</select>';
        $str.='</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("amnt_to_pay")).' </td>';
        $str.='<td align="left">'.$this->session->userdata("local_admin_currency_type").'<input type="text" id="booking_sub_total" onblur="CalculateTotal('.$bookingDatails[0]['booking_total_tax'].','.$bookingDatails[0]['booking_grnd_total'].')" style="border: 1px solid #C3D9FF; width:50px;" size="5" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'"></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("additional_chrges")).'  </td>';
        $str.='<td align="left">'.$this->session->userdata("local_admin_currency_type").'<input type="text" id="booking_total_tax" onblur="CalculateTotal('.$bookingDatails[0]['booking_total_tax'].','.$bookingDatails[0]['booking_grnd_total'].')" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="0"></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("discount")).'   </td>';
        $str.='<td align="left">'.$this->session->userdata("local_admin_currency_type").'<input type="text" id="booking_disc_amount" onblur="CalculateTotal('.$bookingDatails[0]['booking_total_tax'].','.$bookingDatails[0]['booking_grnd_total'].')" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_disc_amount']).'"></td>';
        $str.='</tr>';
        $amnt = 0;
        if(is_array($TaxArr)){
	        foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
	        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
				 $str.='<tr><td align="left">'.$taxName[0].'  </td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
			}
		}
       
        $str.='<tr>';
        $str.='<td align="left" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">'.$this->global_mod->db_parse($this->lang->line("total")).'   </td>';
        $str.='<td align="left" id="total_val" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="2"><textarea id="payment_comment" style="width: 100%"></textarea></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="2" align="center"><input type="button" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("save_btn")).'" onclick="SaveAgendaDetails('.$bookingId.','.$bookingDatails[0]['booking_grnd_total'].')">&nbsp;&nbsp;<input type="button" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("save_nd_print")).'" onclick="SavePrintAgenda('.$bookingId.','.$bookingDatails[0]['booking_grnd_total'].')"> </td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        
        
      }else{
      	
      	$str.='<td></td>';
	  	$str.='<td colspan="2" valign="top">';
	  	$str.='<table cellspacing="0" cellpadding="0" width="100%"  border="0">';
	  	$str.='<tr>';
	  	$str.='<td valign="top" >'.$this->global_mod->db_parse($this->lang->line("total_amnt")).' - </td>';
	  	$str.='<td td valign="top">'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'</td>';
	  	$str.='</tr>';
	  	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line("additional_chrges")).' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_additional_charges']).'</td></tr>';
	  	
	  	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line("discount")).' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_discount']).'</td></tr>';
	  	
	  	$total_tax = 0;
	  	$amnt = 0;
	  	
	  	if(is_array($TaxArr)){
			
		 	foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
	        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
				 $str.='<tr><td align="left">'.$taxName[0].'  </td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
				 $total_tax += $amnt;
			}
		}	
	  	
	  	
	  	$str.='<tr><td colspan="2" style="border-bottom:2px dotted #000000;"></td></tr>';
	  	
	  	$paid_total = $bookingDatails[0]['cash_total_amount'] + $total_tax + $bookingDatails[0]['cash_additional_charges'] - $bookingDatails[0]['cash_discount'];
	  	
	  	$str.='<tr><td style="font-weight:bold;">'.$this->global_mod->db_parse($this->lang->line("total")).' - </td><td style="font-weight:bold;">'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($paid_total).'</td></tr>';
	  	$str.='<tr><td colspan="2" style="border-bottom:2px dotted #000000;"></td></tr>';
	  	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line("total")).' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_paid_total']).' (Paid)'.'</td></tr>';
	  	$str.='<tr><td></td><td><a href="javascript:void(0);" onclick="ShowEditedAgendaDetails('.$bookingDatails[0]['cash_register_id'].')">(view)</a></td></tr>';
	  	$due = $bookingDatails[0]['cash_paid_total'] - ($bookingDatails[0]['cash_total_amount']+$total_tax+$bookingDatails[0]['cash_additional_charges']-$bookingDatails[0]['cash_discount']);
	  	$str.='<tr><td></td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($due).' '.$this->global_mod->db_parse($this->lang->line("due")).''.'</td></tr>';
	  	$str.='</table>';
	  	$str.='</td>';
	  }
	  	$str.='</tr>';
	  	$str.='</table>';
        echo $str;
        }    
        
        if($type=='edit'){
            $local_str	='';	
            $id_time	= $this->input->post('id_time');
            $bookDate	= $this->input->post('select_date');
            $idArr = explode("_",$id_time);
            $bookingServiceId = $idArr[2];
            $bookingDetails	= $this->calender_model->singleBookingDetails($bookingServiceId);
            $serviceArr	= $this->calender_model->serviceDetailsFromBooking($bookingServiceId);
            $staffArr	= $this->calender_model->getAvailableStaffOnService($bookingServiceId);
			$local_str	.='<table cellpadding="5" cellspacing="5" border="0" width="250px">';
			$local_str	.='<tr>';
			$local_str	.='<td width="5"></td>';
			$local_str	.='<td width="45"></td>';
			$local_str	.='<td width="50"></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td>&nbsp;</td>';
			$local_str	.='<td colspan="2" align="center" style="font-size: 14px;font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("update_appo")).' </td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td>&nbsp;</td>';
			$local_str	.='<td colspan="2"><span id="re_error"></span></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td></td>';
			$local_str	.='<td> '.$this->global_mod->db_parse($this->lang->line("what")).':</td>';
			$local_str	.='<td><input type="hidden" id="re_serviceId"  value="'.$serviceArr[0]['service_id'].'">'.$serviceArr[0]['service_name'];
			$local_str	.='</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td></td>';
			$local_str	.='<td> '.$this->global_mod->db_parse($this->lang->line("quantity")).':</td>';
			$local_str	.='<td>';
			$local_str	.='<input type="text" id="re_serviceQuantity" style="border: 1px solid #C3D9FF; width:70px;" value="'.$bookingDetails[0]['srvDtls_service_quantity'].'">';
			$local_str	.='</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td></td>';
			$local_str	.='<td>'.$this->global_mod->db_parse($this->lang->line("who")).':</td>';
			$local_str	.='<td>';
			$local_str	.='<select style="width:150px;" name="re_employeeId" id="re_employeeId" onchange="staff_availability(this.value)">';
			foreach($staffArr as $staffVal){
			    if($staffVal[0]['employee_id'] == $bookingDetails[0]['srvDtls_employee_id']){
			        $select = 'selected="selected"';
			    }else{
			        $select = '';
			    }
			    $local_str	.='<option value="'.$staffVal[0]['employee_id'].'" '.$select.'>'.$staffVal[0]['employee_name'].'</option>';
			}
			$local_str	.='</select>';
			$local_str	.='</td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td></td>';
			$local_str	.='<td>'.$this->global_mod->db_parse($this->lang->line("when")).':</td>';
			$local_str	.='<td nowrap="true"><input id="choosen_booking_date" type="text" value="'.$bookDate.'" style="border: 1px solid #C3D9FF; width:70px;" readonly />&nbsp;&nbsp;';
			$local_str	.='<span id="choosen_booking_time_span">';
			$local_str	.='<select id="choosen_booking_time">';
			$local_str	.='<option value="">'.$this->global_mod->db_parse($this->lang->line("select")).'</option>';
			$local_str	.='</select>';
			$local_str	.='</span>';
			$local_str	.='</td>';
			$local_str	.='</tr>';

			
			$local_str	.='<tr>';
			$local_str	.='<td>&nbsp;</td>';
			$local_str	.='<td colspan="2" align="center"></td>';
			$local_str	.='</tr>';
			$local_str	.='<tr>';
			$local_str	.='<td>&nbsp;</td>';
			$local_str	.='<td colspan="2" align="center">';
			$local_str	.='<input id="re_button" type="button" value="'.$this->global_mod->db_parse($this->lang->line("reschedule")).' >>" onclick="make_reschedule(\''.$bookingServiceId.'\')" class="btn-blue"/>';
			$local_str	.='</td>';
			$local_str	.='</tr>';
			$local_str	.='</table>';
			echo $local_str;
        }
        if($type=='aks'){
        	
        	$adminLanguage = $this->session->userdata('admin_language');
        	
        	
            $local_admin_id = $this->session->userdata('local_admin_id');
            $host=$_SERVER['HTTP_HOST'];
            $idArr = explode("_",$this->input->post('id_time'));
             
            
            /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
            $bookingDetails = $this->calender_model->getBookingDetailsServiceWise($idArr[2]);
            
            /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
            #############################################
            $customer_id = $bookingDetails[0]['customer_id'];
            $service_id = $bookingDetails[0]['srvDtls_service_id'];
            $employee_id = $bookingDetails[0]['srvDtls_employee_id'];
            $link = $host.'/customerRate/rating/'.$local_admin_id.'/'.$customer_id.'/'.$service_id.'/'.$employee_id.'/'.$idArr[2].'/'.$adminLanguage;
            
            $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
            
            $this->load->model('admin/Cms_model');
			$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
            $cancelpolicy = $this->global_mod->show_to_control($cancellationpolicy);
            $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $this->global_mod->show_to_control($bookingDetails[0]['cus_fname']),
								'{lname}' 					=> $this->global_mod->show_to_control($bookingDetails[0]['cus_lname']),
								'{appointmentStartDate}'	=> $bookingDetails[0]['srvDtls_service_start'],
								'{businessemail}' 			=> $this->session->userdata('ladmin_email'),
								'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
								'{businessaddress}' 		=> $busi_address,
								'{cancellationpolicy}' 		=> nl2br($cancelpolicy),
								'{clickurl}' 				=> $link
								
								);
            #############################################
            
            $customer_email = $bookingDetails[0]['user_email'];
            $admin_email = $this->session->userdata('ladmin_email');
           
            $mail = $this->email_model->sentMail(9, $replacerArr, $customer_email,$admin_email);
            //$this->report_model->GetReviews();
            $bookingServiceId = $idArr[2];
            echo 'done';   
        }			            
		if($type=='send_mail'){
            $idArr = explode("_",$this->input->post('id_time'));
            $bookingServiceId = $idArr[2];
           	
        
        }
    }
	public function saveComment(){
        $comment			= $this->input->post('comment');
        $serviceDatailsId	= $this->input->post('serviceDatailsId');
        $save_comment       = $this->calender_model->saveComment($serviceDatailsId,$comment);
	}
 	public function staff_setting_option(){
		$staff_id	= $this->input->post('staff_id');
		$local_str	 = '';
		$local_str	.= '<table width="100%" cellspacing="0" cellpadding="0" border="0">';
		$local_str	.= '<tr>';
		$local_str	.= '<td width="5%"></td>';
		$local_str	.= '<td width="15%"></td>';
		$local_str	.= '<td width="80%"></td>';
		$local_str	.= '</tr>';
		$local_str	.= '<tr>';
		$local_str	.= '<td>&nbsp;</td>';
		$local_str	.= '<td nowrap="true"><h3>'.$this->global_mod->db_parse($this->lang->line("staff_setting_optn")).' </h3></td>';
		$local_str	.= '<td  align="right"></td>';
		$local_str	.= '</tr>';
		$local_str	.= '<tr>';
		$local_str	.= '<td colspan="3">&nbsp;</td>';
		$local_str	.= '</tr>';
		$local_str	.= '<tr>';
		$local_str	.= '<td ></td>';
		$local_str	.= '<td ><a href="javascript: void(0)" onclick="reshedule_option_details(\'Working_hours\')">- '.$this->global_mod->db_parse($this->lang->line("st_wrking_hrs")).'</a></td>';
		$local_str	.= '</tr>';
		$local_str	.= '<tr>';
		$local_str	.= '<td ></td>';
		$local_str	.= '<td ><a href="javascript: void(0)" onclick="reshedule_option_details(\'Block\')">- '.$this->global_mod->db_parse($this->lang->line("blk_day_time")).'</a></td>';
		$local_str	.= '</tr>';
		$local_str	.= '<tr>';
		$local_str	.= '<td ></td>';
		$local_str	.= '<td ><a href="javascript: void(0)" onclick="reshedule_option_details(\'Edit_staff\')">- '.$this->global_mod->db_parse($this->lang->line("edit_stf_details")).'</a></td>';
		$local_str	.= '</tr>';
		$local_str	.= '</table>';
		$local_str	.= '<input type="hidden" value="'.$staff_id.'" name="re_staff_id" id="re_staff_id">';
		echo $local_str;
	}
	public function booked_staff_schedule(){
        $block_from             =   $this->input->post('block_from');
        $block_to               =   $this->input->post('block_to');
        $employeeArr	        =   $this->input->post('blockempArr');
		$result = $this->calender_model->adminEmployeeBlocking($block_from,$block_to,$employeeArr);
		echo $result;
    }
	public function getGroupBookingDetails(){
		$bookingId	= $this->input->post('bookingId');
		$idString	= explode("-",$bookingId);
		$idString	= str_replace("_",",",$idString[1]);
		$dataArr = $this->calender_model->grpBookingDetails($idString);
		$str='';
		foreach($dataArr as $valArr){
			$str .= '<div class="reshudl" id="reshudl-'.$valArr['srvDtls_id'].'">';
			$str .= '<label>'.$this->lang->line("title").':</label>'.$valArr['srvDtls_service_name'].' :: '.$valArr['srvDtls_service_description'].'<br>';
			//$str .= '<label>FOR:</label>Palash Roy<br>';
			$str .= '<label>'.$this->lang->line("by").':</label>'.$valArr['srvDtls_employee_name'].'<br>';
			$str .= '<label>'.$this->lang->line("from").':</label>'.date("h:i:s A",strtotime($valArr['srvDtls_service_start'])).'<br>';
			$str .= '<label>'.$this->lang->line("to").':</label>'.date("h:i:s A",strtotime($valArr['srvDtls_service_end'])).'';
			$str .= '<div class="multi_booking"><input class="multi_booking_button booking_option" type="button" onclick="multiBookingDetailsShow('.$valArr['srvDtls_id'].')" value="Menu"></div>';
			$str .= '</div>';
		}
		echo $str;
	}
	public function rescheduleChecking(){
		$dragDetails	= $this->input->post('dragDetails');
		$dropDatails	= $this->input->post('dropDetails');
		$type			= $this->input->post('dragType');
		//$rescheduleDate	= $this->input->post('reschedule');	
        $rescheduleDate	= $this->input->post('reshuDate');	
		$dropArr		= explode("_",$dropDatails);
		$dropEmployeeId	= $dropArr[0];
		$dropTime		= str_pad($dropArr[1],2,'0',STR_PAD_LEFT).':'.str_pad($dropArr[2],2,'0',STR_PAD_LEFT).':00'; 
		$rescheduleDateTime	= date('Y-m-d H:i:s', strtotime($rescheduleDate.' '.$dropTime));	
		if($type == 'group'){		
		    $dragArr		= explode("-",$dragDetails);
		    $dragServiceId	= $dragArr[1];
		}
		if($type == 'single'){
		    $dragArr	= explode("_",$dragDetails);
		    $dragServiceId = $dragArr[2];
		}
		//always return 1/0
		$rescheduleCheck = $this->calender_model->checkingReschedule($rescheduleDateTime,$dropEmployeeId,$dragServiceId);
		$str	 = '';
		if($rescheduleCheck == FALSE){
			$str	.= '<span style="float:left; margin-left: 20px; margin-top: 20px;"><img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"></span>';
			$str	.= '<label style="font-size: 14px; font-weight: bold;  margin-left: 10px; margin-top:36px; float:left;">'.$this->global_mod->db_parse($this->lang->line("sry_unable_2_reschdl")).'.</label>';
			$returnString = '0||@@||'.$str;
		}
		if($rescheduleCheck == TRUE){
			$string =' AND srvDtls_id = "'.$dragServiceId.'"';
			$serviceDetailsArr	= $this->calender_model->mainBookingStorePro($string);
			$srvDetails			= $this->calender_model->serviceDetails($serviceDetailsArr[0]['srvDtls_service_id']);
			$empDetails			= $this->calender_model->employeeDetails($dropEmployeeId);
			$str	.='<table cellspacing="0" width="100%">';
			$str	.='<tr>';
			$str	.='<td>';
			$str	.='<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#C5DDF8">';
			$str	.='<tr>';
			$str	.='<td colspan="2" align="center" bgcolor="#0057A6" style="color: #FFFFFF;"><b>'.$this->global_mod->db_parse($this->lang->line("from")).'<b></td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("staff_name")).' :</td>';
			$str	.='<td align="left">'.$serviceDetailsArr[0]['srvDtls_employee_name'].'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("strt_time")).' :</td>';
			$str	.='<td align="left">'.date("h:i a",strtotime($serviceDetailsArr[0]['srvDtls_service_start'])).'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("end_time")).' :</td>';
			$str	.='<td align="left">'.date("h:i a",strtotime($serviceDetailsArr[0]['srvDtls_service_end'])).'</td>';
			$str	.='</tr>';
			
			$str	.='</table>';
			$str	.='</td>';
			$str	.='<td>';
			$str	.='<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#DFE2E3">';
			$str	.='<tr>';
			$str	.='<td colspan="2" align="center" bgcolor="#0057A6" style="color: #FFFFFF;"><b>'.$this->global_mod->db_parse($this->lang->line("to")).'<b></td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("staff_name")).' :</td>';
			$str	.='<td align="left">'.$empDetails[0]['employee_name'].'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("strt_time")).' :</td>';
			$str	.='<td align="left">'.date("h:i a",strtotime($rescheduleDateTime)).'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("end_time")).' :</td>';
			$endTime = date('Y-m-d H:i:s', strtotime('+'.$srvDetails[0]['service_duration_min'].' minutes', strtotime($rescheduleDateTime)));
			$str	.='<td align="left">'.date("h:i a",strtotime($endTime)).'</td>';
			$str	.='</tr>';
			$str	.='</table>';
			$str	.='</td>';	
			$str	.='</tr>';
			$str	.='</table>';
			$str	.='<br>&nbsp;&nbsp;<input id="isSendMailRs" type="checkbox">';
			$str	.='<label style="font-size: 14px;font-weight: bold;"> '.$this->global_mod->db_parse($this->lang->line("snd_mail_2_client")).'</label>';
			$returnString = '1||@@||'.$str;
		}		
		echo $returnString;
	}
	public function checkDuplicatEmail(){
		$email = $this->input->post('email');
		$returnVal = $this->global_mod->checkDuplicatEmail($email);
		echo $returnVal;
	}
	public function checkDuplicatEmailCustomer(){
		$email = $this->input->post('email');
		$returnVal = $this->global_mod->checkDuplicatEmailCustomer($email);
		echo $returnVal;
	}
 	public function saveOrderDetails(){
		echo '1';
	}
	public function savePrintOrderDetails(){
		echo '1';
	}
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*----------------------------------			MONTH CALENDER 			--------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
 /*-----------------------------------------------------------------------------------------------------------*/
	public function compareDates($d_d1,$d_d2) {
		$ls_val = strtotime($d_d1)- strtotime($d_d2);
		switch ( $ls_val ) {
		    case ($ls_val > 0):
				$result= "true";
				break;
		    case ($ls_val < 0):
				$result= "false";
				break;
		    default:
				$result= "selected";
				break;
		    } # switch
		return $result;
	}
	public function getStaffServiceCnt($date){
        $date_range	=   $this->input->post('date_range');
        $month_staff=   $this->input->post('selected_staff');
        $month_start = $date_range[0];
        $month_end = $date_range[1];
        $booking_array = $this->calender_model->get_month_data_staff_service($month_start, $month_end, $month_staff);
        return  isset($booking_array[$date])?$booking_array[$date]:'';          
    }
	public function getStaffServiceStaff($date){
        $date_range	=   $this->input->post('date_range');
        $month_staff=   $this->input->post('selected_staff');
        $month_start = $date_range[0];
        $month_end = $date_range[1];
        $booking_array = $this->calender_model->get_month_data_staff_id($month_start, $month_end, $month_staff);
        return isset($booking_array[$date])?$booking_array[$date]:'';
    }
	public function monthViewDataDetails($dateArr,$month_staff,$month_service){
		$monthBookingDetails = $this->calender_model->getSelectedBookingAjax_pr_month($dateArr,$month_staff,$month_service);		
		$localString = '';
		if(COUNT($monthBookingDetails)> 0 && !empty($monthBookingDetails)){
		    $counter = 0; 
			foreach($monthBookingDetails as $bookArr){
			    $localString .=	'<span id="month-Data'.$counter.'_';
			    $localString .= date("Y_m_d",strtotime($bookArr['bookDate']));
			    $localString .= '" class="monthData" >';
			    $localString .= $bookArr['empname'];
			    $localString .= ' (';
			    $localString .= $bookArr['bookCount'];
			    $localString .= ') </span>';
			    $counter++;
			}
		}else{
			$localString .=	'';
		}
		return $localString;
	}
	public function genaret_row_month(){

		$date_range		=   $this->input->post('date_range');
		$time			=   $this->input->post('time');
		$month_staff	=   $this->input->post('selected_staff');
		$month_service	=   $this->input->post('selected_service');
		$ls_month		=   date ("m", strtotime($date_range[0]));
		$ls_year		=   date ("Y", strtotime($date_range[0]));
		$ls_todate		=   date("m/d/Y");
		$month_start 	= $date_range[0];
		$month_end 		= $date_range[1];

            switch (date ("D", strtotime($date_range[0]))) {
				case 'Sun':
					$colspan=0;
					break;
				case 'Mon':
					$colspan=1;
					break;
				case 'Tue':
					$colspan=2;
					break;
				case 'Wed':
					$colspan=3;
					break;
				case 'Thu':
					$colspan=4;
					break;
				case 'Fri':
					$colspan=5;
					break;
				case 'Sat':
					$colspan=6;
					break;
            }
            switch (date ("D", strtotime($date_range[1]))) {
				case 'Sun':
					$ls_colspan=6;
					break;
				case 'Mon':
					$ls_colspan=5;
					break;
				case 'Tue':
					$ls_colspan=4;
					break;
				case 'Wed':
					$ls_colspan=3;
					break;
				case 'Thu':
					$ls_colspan=2;
					break;
				case 'Fri':
					$ls_colspan=1;
					break;
				case 'Sat':
					$ls_colspan=0;
					break;
            }
            $total_day_of_the_month= date ("d", strtotime($date_range[1]));
            if($total_day_of_the_month >=30 && $colspan>4){
                    $month_row=6;
            }else{
                    $month_row=5;
            }
            $month_cunter=1;
			$local_string='';
			$local_string.=' <div class="tabuler-deta monthviewtable widthauto"><div class="thead">';
			$local_string.='<div class="onecol col-width" >Sunday</div>';
			$local_string.='<div class="onecol col-width" >Monday</div>';
			$local_string.='<div class="onecol col-width" >Tuesday</div>';
			$local_string.='<div class="onecol col-width" >Wednesday</div>';
			$local_string.='<div class="onecol col-width" >Thursday</div>';
			$local_string.='<div class="onecol col-width" >Friday</div>';
			$local_string.='<div class="onecol col-width" >Saturday</div>';
			$local_string.='</div><div class="clear"></div><div class="tbody">';
            for($i=0;$i<$month_row;$i++){	
                $local_string	.=	'<div class="onerowcolor monthview righttxt">';
                for($j=1;$j<8;$j++){
                    /*#####################checking day start#######################*/
                    if($j==$colspan && $i==0){
                        $local_string	.=	'<div class="bodypartonecol col-width" deta-role="'.$colspan.'">';	
                    }elseif($j>$colspan && $i==0){
                        $local_string	.=	'<div class="bodypartonecol relative col-width" ><div  class="non_drag"';
                        $local_string	.=	(date($ls_month."/".str_pad($month_cunter,2,"0",STR_PAD_LEFT)."/".$ls_year)==date("m/d/Y"))?'style="background-color: #FFF0A5"':'';
                        $local_string	.=	'>';
//pastbooking              if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'<div id="gotoDay_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="gotoDay">';		
//pastbooking               }else{
//pastbooking                   $local_string   .=  '<div class="blocked-class">-Blocked-</div>';	
//pastbooking               }	
                    }elseif($i !=0 && $total_day_of_the_month>= $month_cunter){
                        $local_string	.=  '<div class="bodypartonecol relative col-width" ><div class="non_drag"';
                        $local_string	.=  (date($ls_month."/".str_pad($month_cunter,2,"0",STR_PAD_LEFT)."/".$ls_year)==date("m/d/Y"))?'style="background-color: #FFF0A5"':'';
                        $local_string	.=  '>';
//pastbooking                if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'<div id="month-gotoDay_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="gotoDay">';	
//pastbooking                 }else{
//pastbooking                     $local_string   .=  '<div class="blocked-class">-Blocked-</div>';	
//pastbooking                 }			
                    }
                    /*#####################checking day end#######################*/
                    /*####################Main Content Start#########################*/
                    if($j==$colspan && $i==0 or $j<$colspan && $i==0 or $total_day_of_the_month < $month_cunter){
                        $local_string	.=  '';	//NULL CONTENT
                    }else{
//pastbooking 	         if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            
                            $day = ($month_cunter<10)?"0".$month_cunter:$month_cunter;
                            $mydate = $ls_year."-".$ls_month."-".$day;
							$local_string .='<div class=" withdatebottom monthdate gotoDayStaff" id="month-contener_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" style="cursor: pointer">';
                            $DateTime	= date ("Y", strtotime($date_range[0])).'-'.date ("m", strtotime($date_range[0])).'-'.$month_cunter;
							$dateArr['start']	= date('Y-m-d H:i:s', strtotime($DateTime.' 00:00:00'));
							$dateArr['end']		= date('Y-m-d H:i:s', strtotime($DateTime.' 23:59:59'));
							$dataStr = $this->monthViewDataDetails($dateArr,$month_staff,$month_service);
							if($dataStr == ''){
								$local_string .='<span id="month-Date_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="span_date_gotoDay" >';
								$local_string .=$month_cunter.' '.date ("M", strtotime($date_range[0]));
								//$local_string .='<span class="mthBookCount">03</span>';
								$local_string .='</span>';	//MAIN CONTENT
							}else{
								$local_string .= $dataStr;
								$local_string .='<span id="month-Date_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="span_date_gotoDay ">';
								$local_string .=$month_cunter.' '.date ("M", strtotime($date_range[0]));
								//$local_string .='<span class="mthBookCount">05</span>';
								$local_string .='</span>';
							}
                            $local_string .='</div>';	
//pastbooking 	          }else{
//pastbooking 	              $local_string .='';//BLOCK CONTENT	
//pastbooking 		         }
                    }
                    /*####################Main Content End#########################*/
                    /*#####################checking day start#######################*/		
                    if($j==$colspan && $i==0){
                        $local_string .='</div>';	
                    }elseif($j>$colspan && $i==0){
//pastbooking               if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'</div></div></div>';		
//pastbooking               }else{
//pastbooking                   $local_string   .=	'</div></div>';	
//pastbooking               }
                        $month_cunter++;	
                    }elseif($i !=0 && $total_day_of_the_month>= $month_cunter){
//pastbooking                if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'</div></div></div>';		
//pastbooking                 }else{
//pastbooking                     $local_string   .=	'</div></div>';	
//pastbooking               }
                        $month_cunter++;	
                    }
                    /*#####################checking day end#######################*/
                }
                $local_string	.=  '</div>';	
            }
            $local_string   .='</div></div>';		
            echo $local_string;
	}
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@			WEEK CALENDER 			  @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/  
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
/*@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@*/
	public function dateTimeWiseBooking($dateArr,$weekBookingData,$time_difference,$checkTime24) {
		
		$bookingStatuscolor = array();
		$boolingdata = array();
		$i=0;
		if(count($weekBookingData)>0){
			foreach($weekBookingData AS $val=>$arr){
				if(strtotime($dateArr['start']) <= strtotime($arr['bookStart']) && strtotime($arr['bookStart']) <= strtotime($dateArr['end'])){
					$boolingdata[$i]=$arr;
					
					$i++;
				}
			}
		}
		
		if($checkTime24[0]['hours_type'] == 0){
			$showDate = date("H:i ",strtotime($dateArr['start']));
		}else{
			$showDate = date("h:i A",strtotime($dateArr['start']));
		}		
		//$showDate = date("h:i A",strtotime($dateArr['start']));
		$str = '';
		if(COUNT($boolingdata) == 1){
				$bs=((60/intval($time_difference))*intval($boolingdata[0]['duration']))-20;
				$str .= '<div  class="weekDataContener">';
				$str .= '<h3 class="week-book-header">'.$showDate.'</h3>';
				$str .= '<span class="weekBookCont" style="'.$this->calender_model->calendar_booking_status_style($boolingdata[0]['bookingStatus']).' height: '.$bs.'px;">';
				$str .= '<label class="weekBookContgrd">';
				$str .= '<label>'.$this->global_mod->db_parse($this->lang->line("title")).'</label>';
				$str .= $boolingdata[0]['srvName'];
				$str .= '<br>';
				$str .= '<label>'.$this->global_mod->db_parse($this->lang->line("for")).'</label>';
				$str .= 'Customer Name';
				$str .= '<br>';
				$str .= '<label>'.$this->global_mod->db_parse($this->lang->line("by")).'</label>';
				$str .= $boolingdata[0]['empNme'];
				$str .= '</label>';
				$str .= '</span>';
				$str .= '</div>';
		}
		
		if(COUNT($boolingdata) > 1){
				$str .= '<div  class="weekDataContener">';
				$str .= '<h3 class="week-book-header">'.$showDate.'</h3>';
				$str .= '<span class="weekBookCont" style=" height: 60px;>';
				$str .= '<label class="weekBookContgrd normalWhiteSpace">';
				//$str .= 'Number of '.COUNT($boolingdata).' booking available on this time slot.Click here for details.';
                $str .= $this->lang->line("thr_r").' '.COUNT($boolingdata).' '.$this->global_mod->db_parse($this->lang->line("bking_on_this_time_slot"));
				$str .= '</label>';
				$str .= '</span>';
				$str .= '</div>';
		}

		return $str;          
	}
	public function genaret_row_week(){
            $week_day			=	$this->input->post('date_range');
            $week_staff			=	$this->input->post('selected_staff');
            $week_services		=	$this->input->post('selected_services');
            $time_difference    =	$this->input->post('time_difference');
            $current_width		=	$this->input->post('current_width');
          //  $week_start		=	$week_day[0];
          //  $week_end			=	$week_day[1];
            $weekDArr['start']  =	$week_day[0];
            $weekDArr['end']  	=	$week_day[1];         
            $date_array			=	$this->createDateRangeArray($week_day[0],$week_day[1]);

            $local_string_data	=	'';
            if(empty($week_staff)){
                $local_string_data.='<div class="deta-string">'.$this->global_mod->db_parse($this->lang->line("slct_staff_4rm_left_bar")).'</div>';
            }else{
				$staff = $this->calender_model->getSelectedEmployee($week_staff);
				$weekBookingData =$this->calender_model->getSelectedBookingAjax_weekData($weekDArr,$week_staff,$week_services);
				
				
                $local_string_data = '';
                $local_string_data .= '<div class="marginadj"><div class="tabuler-deta-employee emplouenameHead">'.$staff[0]['employee_name'].'</div></div>
                                            <div class="tabuler-deta"><div class="theadweek"></div>
                <div class="thead">
                    <div class="onecolmin" style="width: 40px;"><button id="calender_settings">'.$this->global_mod->db_parse($this->lang->line("settings")).'</button></div>';
		for($s=0;$s<count($date_array);$s++){
                    $local_string_data .='<div class="onecol" style="width: '.$current_width.'px; background: #C8DAF7;" nowrap="nowrap">'.date("D m/d",strtotime($date_array[$s])).' ';
                    $count_staff_booking	=	$this->calender_model->count_staff_booking($staff[0]['employee_id'],$date_array[$s],$week_services);
                    $isStaffBlockDate		=	$this->calender_model->checkingStaffBlockDate($staff[0]['employee_id'],$date_array[$s]);
                    $isStaffBlockTime		=	$this->calender_model->checkingStaffBlockTime($staff[0]['employee_id'],$date_array[$s]);
                    $checkTime24 			= $this->calender_model->checkTime24();
                    if($count_staff_booking > 0){
                        $local_string_data .='<label class="staffHeadingTbStApphd">'.$count_staff_booking.'</label>';
                    }
                    if($isStaffBlockDate > 0){			
                        $local_string_data .='<img title="Block date" src="'.base_url().'/asset/lock.png">';
                    }
                    if($isStaffBlockTime > 0){			
                        $local_string_data .='<img  title="Block time" src="'.base_url().'/asset/lock_time.png">';
                    }	
                    $local_string_data .='</div>';	
		}
		$local_string_data .='	<div class="clear"></div></div><div class="tbody" >';
                for($i=0;$i<=23;$i++){
                    $local_string_data .='<div style="background-color:';
                    $local_string_data .=($i%2)?"":"#D3D3D3";
                    $local_string_data .='" id="week_scroll_'.$i.'">
                                            <div class="bodyonecol">'.$this->calender_model->set_time($i,$checkTime24).'</div>';
                    for($s=0;$s<count($date_array);$s++){															
                        $local_string_data .='<div class="bodypartonecol" style="width: '.$current_width.'px;">';
                        for($j=1;$j<=60/$time_difference;$j++){
                            $divId = date("d-m-Y",strtotime($date_array[$s])).'@_@'.$i.'-'.($j-1)*$time_difference;
	                       
	                        if($checkTime24[0]['hours_type'] == 0){
								$divTime = date("H:i ",strtotime($i.':'.($j-1)*$time_difference.':00'));
							}else{
								$divTime = date("h:i A",strtotime($i.':'.($j-1)*$time_difference.':00'));
							}
                            $dateArr = array();
                            $minstart = ($j-1)*$time_difference;
                            $minend = ($j*$time_difference)-1;
                            $dateArr['start']	= date('Y-m-d H:i:s', strtotime($date_array[$s].' '.($i.':'.$minstart.':00')));
                            $dateArr['end']	= date('Y-m-d H:i:s', strtotime($date_array[$s].' '.($i.':'.$minend.':59')));	
                          	$nowbookDetails = $this->dateTimeWiseBooking($dateArr,$weekBookingData,$time_difference,$checkTime24);
                        
							
                            if(($nowbookDetails)== ''){
								$local_string_data .= '<div id="'.$divId.'" class="non_drag cont_dat relative">'; 
                                $local_string_data .= '<span id="span-'.$divId.'" class="timeweek">'.$divTime.' Click here to book.</span>';
                                $local_string_data .= '</div>';
                                 
                            }else{
                                $local_string_data .='<div id="'.$divId.'" class="non_drag cont_dat relative">'; 
                                $local_string_data .= $nowbookDetails;
                                $local_string_data .= '</div>';   
                            } 
                        }					
                        $local_string_data .='</div>';
                    }	
                    $local_string_data .='<div class="clear"></div></div>';
		}
                $local_string_data .='</div><div class="clear"></div></div>';
                $local_string_data .='
                <div id="up_arrow" class="weekstaffup" onclick="scroll_me_up()"><img src="'.base_url().'/asset/scroll_up.png"></div>
                <div id="down_arrow" class="weekstaffdown"  onclick="scroll_me_down()"><img src="'.base_url().'/asset/scroll_down.png"></div>';
            }
            echo $local_string_data;
	}	
	public function createDateRangeArray($strDateFrom,$strDateTo){

           $aryRange=array();

           $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
           $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

           if ($iDateTo>=$iDateFrom)
           {
               array_push($aryRange,date('Y-m-d',$iDateFrom));
               while ($iDateFrom<$iDateTo)
               {
                   $iDateFrom+=86400;
                   array_push($aryRange,date('Y-m-d',$iDateFrom));
               }
           }
       return $aryRange;
       }
	public function askAReview(){
        $msg=$this->calender_model->askAReview($this->input->post('email_data'));
        echo $msg;
    }	 
/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				AGENDA			    #########################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/
	public function calenderAgenda(){
		$selectedDate	=	$this->input->post('selected_date');
		$staffArr		=	$this->input->post('selected_staff');
		$serviceArr		=	$this->input->post('ls_services');
		$agendaDateTime	=	date('Y-m-d H:i:s', strtotime($selectedDate.' 00:00:00'));
		$bookingDetails	=	$this->calender_model->getSelectedBookingAjax_pr_agenda($agendaDateTime,$staffArr,$serviceArr);
		$timeString = '';
		$agStr = '';
		
		$agStr.= '<table class="agendaMain">';
		
		if($bookingDetails){
			
			foreach($bookingDetails as $bookingDetailsVal){
	
		//echo '<pre>';
		//print_r($bookingDetailsVal);
		//echo '</pre>';
		//	$agStr.= '<tr>';
		//	$agStr.= '<td>';
		if($timeString != $bookingDetailsVal['bookingTime']){
			$agStr.= '<tr>';
			$agStr.= '<td style="font-size: 16px; font-weight: bold;margin-bottom: 10px;">';
			$agStr.= $bookingDetailsVal['bookingTime'];
			$agStr.= '</td>';
			$agStr.= '</tr>';
		}
			$timeString = $bookingDetailsVal['bookingTime'];	
			$agStr.= '<tr>';
			$agStr.= '<td>';
			$agStr.= '<table class="agendaMainContener">';
			$agStr.= '<tr>';
			$agStr.= '<td colspan="3" align="right">';
			$agStr.= '<div class="dropButton" id="setStatus_'.$bookingDetailsVal['bookingId'].'">'.$this->global_mod->db_parse($this->lang->line("set_status")).'</div>';
			$agStr.= '<ul class="appointmentStatusAppointy" id="appointmentStatusAppointy_'.$bookingDetailsVal['bookingId'].'" style="display: none;">';
			$agStr.= '<li onclick="agendaStatusfunction(\'As_Scheduled\','.$bookingDetailsVal['bookingId'].')">'.$this->global_mod->db_parse($this->lang->line("as_schdul")).'</li>';
			$agStr.= '<li onclick="agendaStatusfunction(\'Arrived_Late\','.$bookingDetailsVal['bookingId'].')">'.$this->global_mod->db_parse($this->lang->line("arrived_late")).'</li>';
			$agStr.= '<li onclick="agendaStatusfunction(\'No_Show\','.$bookingDetailsVal['bookingId'].')">'.$this->global_mod->db_parse($this->lang->line("no_show")).'</li>';
			$agStr.= '<li onclick="agendaStatusfunction(\'Gift_Certificates\','.$bookingDetailsVal['bookingId'].')">'.$this->global_mod->db_parse($this->lang->line("gift_cretificates")).'</li>';
			$agStr.= '<li onclick="agendaStatusfunction(\'Add_Status\','.$bookingDetailsVal['bookingId'].')">'.$this->global_mod->db_parse($this->lang->line("add_status")).'</li>';
			$agStr.= '</ul>';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td>';
			$agStr.= '<div class="BlockContainerInnerPersonal">';
			$agStr.= '<table>';
			$agStr.= '<tr>';
			$agStr.= '<td rowspan="2" width="42px">';
			$agStr.= '<img width="40px" height="40px" src="'.base_url().'/asset/noimage.png" title="User Image">';
			$agStr.= '</td>';
			$agStr.= '<td style="color: #6699FF;font-size: 15px;font-weight: bold;">';
			$agStr.= $bookingDetailsVal['bookingCustomerName']; 
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td><label style="border-bottom: 1px dashed #A2A2A2;font-style: italic;padding: 0;">';
			$agStr.= $bookingDetailsVal['bookingCustomerEmail'];
			$agStr.= '<label></td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td  width="20px" valign="top" align="right">';
			$agStr.= '<img width="15px" height="15px" src="'.base_url().'/asset/call.png" title="Call details">';
			$agStr.= '</td>';
			$agStr.= '<td>';
			$agStr.= $bookingDetailsVal['bookingCustomerPhone'].'(M)';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td width="20px" valign="top" align="right">';
			$agStr.= '<img width="25px" height="25px" src="'.base_url().'/asset/home.png" title="Home address">';
			$agStr.= '</td>';
			$agStr.= '<td>';
			$agStr.= $bookingDetailsVal['bookingCustomerAddress'];
			$agStr.= '</td>';
			$agStr.= '</tr>'; 
			$agStr.= '</table>';
			$agStr.= '</div>';
			$agStr.= '</td>';
			$agStr.= '<td>';
			$agStr.= '<div class="BlockContainerInnerBooking">';
			$agStr.= '<table>';
			$agStr.= '<tr>';
			$agStr.= '<td align="left"> ';
			if($bookingDetailsVal['bookingDetails'][0]['booking_from'] == 1){
			$agStr.= '<img src="'.base_url().'/asset/where.png" title="Book from Computer">&nbsp;&nbsp;';	
			}else{
			$agStr.= '<img src="'.base_url().'/asset/mobile.png" title="Book from Mobile">&nbsp;&nbsp;';	
			}
			if($bookingDetailsVal['bookingDetails'][0]['added_by'] == 1){
			//$agStr.= '<img src="'.base_url().'/asset/who.png" title="Booked By Admin">';	
			$agStr.= '<span style="font-weight:bold">'.$this->global_mod->db_parse($this->lang->line("bookd_by_user")).'</span>';	
			}else{
				if($bookingDetailsVal['bookingDetails'][0]['added_by'] == 2){
					$agStr.= '<span style="font-weight:bold">'.'Booked By Employee'.'</span>';
				}else{
					$agStr.= '<span style="font-weight:bold">'.$this->global_mod->db_parse($this->lang->line("bookd_by_admin")).'</span>';	
				}
			//$agStr.= '<img src="'.base_url().'/asset/who.png" title="Booked By Admin">';	
			
			}
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td align="left" id="agendaCancelAppointmentMsg_'.$bookingDetailsVal['bookingId'].'"> ';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td align="left" > ';
			foreach($bookingDetailsVal['bookingDetails'] as $bookingVal){
			$agStr.= '<label style="border-bottom: 1px dashed #A2A2A2;font-style: italic;padding: 0;color: #56A04B;">';
			$agStr.= $bookingVal['srvDtls_service_name'];
			if($bookingVal['srvDtls_service_quantity'] >1){
			$agStr.= '&nbsp;('.$bookingVal['srvDtls_service_quantity'].')&nbsp;';	
			}
			$agStr.= '&nbsp;by&nbsp;';
			$agStr.= $bookingVal['srvDtls_employee_name'];
			$agStr.= '&nbsp;('.date("h:i A",strtotime($bookingVal['srvDtls_service_start'])).')</label>';
			$color = ($bookingVal['srvDtls_booking_status'] == 4 || $bookingVal['srvDtls_booking_status'] == 5)?"#FF2C2C":"#3370A2";
			$agStr.= '<label style="color: '.$color.';"> &nbsp;Status: '.$this->statusDetails($bookingVal['srvDtls_booking_status']).' </label><br>';
			}
			$agStr.= '</td>';
			$agStr.= '</tr>';
			if($bookingVal['srvDtls_booking_status'] != 4 || $bookingVal['srvDtls_booking_status'] != 5){
			$agStr.= '<tr>';
			$agStr.= '<td align="left" id="agendaCancelAppointment_'.$bookingDetailsVal['bookingId'].'">'; 
			$agStr.= '<span onclick="agendaCancelAppointment('.$bookingDetailsVal['bookingId'].')" style="cursor: pointer;color: #0B85EC;">'.$this->global_mod->db_parse($this->lang->line("cancel_appo")).'</span>';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			}
			$agStr.= '</table>';	
			$agStr.= '</div>';
			$agStr.= '</td>';
			$agStr.= '<td>';
			$agStr.= '<div class="BlockContainerInnerCost">';
			$agStr.= '<table>';
			$agStr.= '<tr>';
			$agStr.= '<td align="right"> ';
			$agStr.= $bookingDetailsVal['bookingGrandTotal'];
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td align="right" id="agendaAskReviewMsg_'.$bookingDetailsVal['bookingId'].'"> ';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td align="right" valign="bottom" id="agendaAskReview_'.$bookingDetailsVal['bookingId'].'" > ';							
			$agStr.= '<span onclick="agendaAskReview('.$bookingDetailsVal['bookingId'].')" style="cursor: pointer;color: #0B85EC;">'.$this->global_mod->db_parse($this->lang->line("ask_review")).'</span>';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '</table>';	
			$agStr.= '</div>';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td colspan="3"><span id="agendaDetails_'.$bookingDetailsVal['bookingId'].'"></span></td>';
			$agStr.= '</tr>';
			$agStr.= '<tr>';
			$agStr.= '<td colspan="3" align="left"><input type="button" class="btn-blue" id="agdDtlId_'.$bookingDetailsVal['bookingId'].'" onclick="agendaDetailsCont('.$bookingDetailsVal['bookingId'].')" value="'.$this->global_mod->db_parse($this->lang->line("show_detail")).'"/></td>';
			$agStr.= '</tr>';
			$agStr.= '</tr>';
			$agStr.= '</table>';
			$agStr.= '</td>';
			$agStr.= '</tr>';
			
			}
		}else{
			$agStr = '<div style="padding-left:400px;padding-top:20px;padding-bottom:20px;font-weight:bold;font-size:24px;border:2px solid #E6E6E6;">'.$this->global_mod->db_parse($this->lang->line("no_agenda_4_today")).'</div>';
		}
		
		$agStr.= '</table>';
		
		
		
		echo $agStr;
	}
	public function statusDetails($statusId){
		switch ($statusId) {
				case 0:
					$colspan='Unapproved';
					break;
				case 1:
					$colspan='Aproved';
					break;
				case 2:
					$colspan='Pending';
					break;
				case 3:
					$colspan='Completed';
					break;
				case 4:
					$colspan='Cancelled by admin';
					break;
				case 5:
					$colspan='Cancelled by user';
					break;
				case 6:
					$colspan='Set Status';
					break;
				case 7:
					$colspan='As scheduled';
					break;
				case 8:
					$colspan='Arrived late';
					break;
				case 9:
					$colspan='No show';
					break;
				case 10:
					$colspan='Gift cerificates';
					break;
				case 16:
					$colspan='Reschedule';
					break;
            }
		return $colspan;
	}
	public function calenderAgendaDetails(){
        $bookingId = $this->input->post('bookingId');
        $bookingServiceDatails		= $this->calender_model->bookingIdWiseBookingDetails($bookingId);
        $bookingDatails				= $this->calender_model->bookingIdDetails($bookingId);
        
        $TaxArr = @@unserialize($bookingDatails[0]['booking_tax_dtls_arr']);
        
        $str='';						
        $str.='<table width="840px" cellspacing="0" cellpadding="0" border="0">';
        $str.='<tr>';
        $str.='<td colspan="6" bgcolor="#0057A6" style="color: #FFFFFF;font-weight: bold; padding: 3px 0 3px 20px;"> '.$this->global_mod->db_parse($this->lang->line("ordr_details")).' </td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="6" style="padding: 0px 0px 0px 0px;" width="100%">&nbsp;</td>';
        $str.='</tr>';
        $str.='<tr bgcolor="#E8F0FF" style="color: #0057A6;font-weight: bold;">';
        $str.='<td align="left" width="168px">'.$this->global_mod->db_parse($this->lang->line("staff")).'</td>';
        $str.='<td align="left" width="126px">'.$this->global_mod->db_parse($this->lang->line("srvice")).'</td>';
        $str.='<td align="left" width="252px">'.$this->global_mod->db_parse($this->lang->line("time")).'</td>';
        $str.='<td align="left" width="84px">'.$this->global_mod->db_parse($this->lang->line("cost")).' ('.$this->session->userdata("local_admin_currency_type").')</td>';
        $str.='<td colspan="2"  width="210px">&nbsp;</td>';
        $str.='</tr>';
        foreach($bookingServiceDatails as $bookingDatailsVal){
            $str.='<tr>';
            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_employee_name'].'</td>';
            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_service_name'].' ('.$bookingDatailsVal['srvDtls_service_quantity'].')</td>';
            $str.='<td align="left" nowrap="true">'.date("h:i A",strtotime($bookingDatailsVal['srvDtls_service_start'])).' - '.date("h:i A",strtotime($bookingDatailsVal['srvDtls_service_end'])).' ('.date("M d,Y",strtotime($bookingDatailsVal['srvDtls_service_start'])).') </td>';
            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_service_cost'].' X '.$bookingDatailsVal['srvDtls_service_quantity'].' = '.$this->global_mod->currencyFormat($bookingDatailsVal['srvDtls_service_cost']*$bookingDatailsVal['srvDtls_service_quantity']).'</td>';
            $str.='<td colspan="2">&nbsp;</td>';
            $str.='</tr>';
        }
        $str.='<tr>';
        $str.='<td colspan="6" style="border-top:1px dashed #0057A6;height:2px;"  width="100%">&nbsp;</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="2" valign="top">';
        $str.='<table width="290px" cellspacing="0" cellpadding="0" border="0">';
        $str.='<tr>';
        $str.='<td style="font-weight: bold;">'.$this->global_mod->db_parse($this->lang->line("some_nots_4_this_appo")).' </td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td><textarea id="order_comment_'.$bookingId.'" style="width: 90%; height:150px;">'.$bookingDatails[0]['booking_comment'].'</textarea></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td><input type="button" id="bt_add_comment__'.$bookingId.'" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("add_cmnt")).'" onclick="bookingCommentAgenda('.$bookingId.')"></td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        
        
        
      if($bookingDatails[0]['cash_register_id'] == ''){
	  	
        $str.='<td colspan="2" valign="top">';
        $str.='<table width="100%" cellspacing="0" cellpadding="0" border="0">';
        $str.='<tr>';
        $str.='<td align="left" width="252px">'.$this->global_mod->db_parse($this->lang->line("total_amnt")).' -</td>';
        $str.='<td align="left" width="84px">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("additional_chrges")).' -</td>';
        $str.='<td align="left" id="additnal_chrg">0.00</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("discount")).' -  </td>';
        $str.='<td align="left" id="total_discnt">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_disc_amount']).' </td>';
        $str.='</tr>';
        if(is_array($TaxArr)){
	        foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
	        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
				 $str.='<tr><td align="left">'.$taxName[0].'</td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
			}
		}	
	  	
        $str.='<tr style="border-top:1px solid #0057A6;" width="100%">';
        $str.='<td align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">'.$this->global_mod->db_parse($this->lang->line("total")).' -</td>';
        $str.='<td id="left_total" align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">&nbsp;</td>';
        $str.='<td align="left">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).' '.$this->global_mod->db_parse($this->lang->line("paid")).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">&nbsp;</td>';
        $str.='<td align="left" id="due_td">'.$this->session->userdata("local_admin_currency_type").'000 '.$this->global_mod->db_parse($this->lang->line("due")).'</td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        $str.='<td colspan="2" valign="top">';
        $str.='<table width="100%" cellspacing="2" cellpadding="0" border="0" style="border: 2px dashed #D3D3D3; border-radius: 10px 10px 10px 10px; float: right;margin-right: 0 px;padding: 25px;">';
        $str.='<tr>';
        $str.='<td align="left" width="126px">'.$this->global_mod->db_parse($this->lang->line("payment_mode")).'</td>';
        $str.='<td align="left" width="84px">';
        $str.='<select id="payment_mode" style="width: 80px">';
        $str.='<option value="1">Cash</option>';
        $str.='<option value="2">Credit Card</option>';
        $str.='<option value="3">Check</option>';
        $str.='</select>';
        $str.='</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("amnt_to_pay")).' </td>';
        $str.='<td align="left">'.$this->session->userdata("local_admin_currency_type").'<input type="text" id="booking_sub_total" onblur="CalculateTotal('.$bookingDatails[0]['booking_total_tax'].','.$bookingDatails[0]['booking_grnd_total'].')" style="border: 1px solid #C3D9FF; width:50px;" size="5" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'"></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("additional_chrges")).'  </td>';
        $str.='<td align="left">'.$this->session->userdata("local_admin_currency_type").'<input type="text" id="booking_total_tax" onblur="CalculateTotal('.$bookingDatails[0]['booking_total_tax'].','.$bookingDatails[0]['booking_grnd_total'].')" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="0"></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line("discount")).'   </td>';
        $str.='<td align="left">'.$this->session->userdata("local_admin_currency_type").'<input type="text" id="booking_disc_amount" onblur="CalculateTotal('.$bookingDatails[0]['booking_total_tax'].','.$bookingDatails[0]['booking_grnd_total'].')" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_disc_amount']).'"></td>';
        $str.='</tr>';
        $amnt = 0;
        if(is_array($TaxArr)){
	        foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
	        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
				 $str.='<tr><td align="left">'.$taxName[0].'  </td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
			}
		}
       
        $str.='<tr>';
        $str.='<td align="left" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">'.$this->global_mod->db_parse($this->lang->line("total")).'   </td>';
        $str.='<td align="left" id="total_val" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="2"><textarea id="payment_comment" style="width: 100%"></textarea></td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td colspan="2" align="center"><input type="button" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("save_btn")).'" onclick="SaveAgendaDetails('.$bookingId.','.$bookingDatails[0]['booking_grnd_total'].')">&nbsp;&nbsp;<input type="button" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("save_nd_print")).'" onclick="SavePrintAgenda('.$bookingId.','.$bookingDatails[0]['booking_grnd_total'].')"> </td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        
        
      }else{
      	
      	$str.='<td></td>';
	  	$str.='<td colspan="2" valign="top">';
	  	$str.='<table cellspacing="0" cellpadding="0" width="100%"  border="0">';
	  	$str.='<tr>';
	  	$str.='<td valign="top" >'.$this->global_mod->db_parse($this->lang->line("total_amnt")).' - </td>';
	  	$str.='<td td valign="top">'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'</td>';
	  	$str.='</tr>';
	  	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line("additional_chrges")).' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_additional_charges']).'</td></tr>';
	  	
	  	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line("discount")).' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_discount']).'</td></tr>';
	  	
	  	$total_tax = 0;
	  	$amnt = 0;
	  	
	  	if(is_array($TaxArr)){
			
		 	foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
	        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
				 $str.='<tr><td align="left">'.$taxName[0].'  </td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
				 $total_tax += $amnt;
			}
		}	
	  	
	  	
	  	$str.='<tr><td colspan="2" style="border-bottom:2px dotted #000000;"></td></tr>';
	  	
	  	$paid_total = $bookingDatails[0]['cash_total_amount'] + $total_tax + $bookingDatails[0]['cash_additional_charges'] - $bookingDatails[0]['cash_discount'];
	  	
	  	$str.='<tr><td style="font-weight:bold;">'.$this->global_mod->db_parse($this->lang->line("total")).' - </td><td style="font-weight:bold;">'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($paid_total).'</td></tr>';
	  	$str.='<tr><td colspan="2" style="border-bottom:2px dotted #000000;"></td></tr>';
	  	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line("total")).' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_paid_total']).' '.$this->global_mod->db_parse($this->lang->line("paid")).''.'</td></tr>';
	  	$str.='<tr><td></td><td><a href="javascript:void(0);" onclick="ShowEditedAgendaDetails('.$bookingDatails[0]['cash_register_id'].')">'.$this->global_mod->db_parse($this->lang->line("view")).'</a></td></tr>';
	  	$due = $bookingDatails[0]['cash_paid_total'] - ($bookingDatails[0]['cash_total_amount']+$total_tax+$bookingDatails[0]['cash_additional_charges']-$bookingDatails[0]['cash_discount']);
	  	$str.='<tr><td></td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($due).' '.$this->global_mod->db_parse($this->lang->line("due")).''.'</td></tr>';
	  	$str.='</table>';
	  	$str.='</td>';
	  }
	  	$str.='</tr>';
	  	$str.='</table>';
        echo $str;
	}
	public function agendaAskReview(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $host=$_SERVER['HTTP_HOST'];
        
            
        $bookingId = $this->input->post('bookId');
        $serviceId = $this->calender_model->getServiceId($bookingId);
        /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
        $bookingDetails = $this->calender_model->getBookingDetailsServiceWise($serviceId);
        
         	$customer_id = $bookingDetails[0]['customer_id'];
            $service_id = $bookingDetails[0]['srvDtls_service_id'];
            $employee_id = $bookingDetails[0]['srvDtls_employee_id'];
            $link = $host.'/customerRate/rating/'.$local_admin_id.'/'.$customer_id.'/'.$service_id.'/'.$employee_id.'/'.$bookingDetails[0]['srvDtls_id'];
            
            $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
            
            $this->load->model('admin/Cms_model');
			$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
            $cancelpolicy = $this->global_mod->show_to_control($cancellationpolicy);
            $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $this->global_mod->show_to_control($bookingDetails[0]['cus_fname']),
								'{lname}' 					=> $this->global_mod->show_to_control($bookingDetails[0]['cus_lname']),
								'{appointmentStartDate}'	=> $bookingDetails[0]['srvDtls_service_start'],
								'{businessemail}' 			=> $this->session->userdata('ladmin_email'),
								'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
								'{businessaddress}' 		=> $busi_address,
								'{cancellationpolicy}' 		=> nl2br($cancelpolicy),
								'{clickurl}' 				=> $link
								
								);
            #############################################
            
            $customer_email = $bookingDetails[0]['user_email'];
            $admin_email = $this->session->userdata('ladmin_email');
           
            $this->email_model->sentMail(9, $replacerArr, $customer_email,$admin_email);
        
           echo 1;
	}
	public function agendaCancelAppointment(){
        $this->load->model('admin/approval_model');
        $bookingId = $this->input->post('bookId');
        $this->calender_model->agendaCancelAppointment($bookingId);
        /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
        $bookingDetails = $this->approval_model->getBookingDetails($bookingId);
        
         		$cus_fname = ucfirst($this->calender_model->GetCusInfo($bookingId,2,'agenda_cancel'));
                $cus_lname = ucfirst($this->calender_model->GetCusInfo($bookingId,3,'agenda_cancel'));
                
                
                //$service_date = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_status_date']));
                $customerMail = $bookingDetails[0]['user_email'];
                $appointmentDetails = '';
                foreach($bookingDetails as $val)
                {
                    $serviceName 	= $this->global_mod->show_to_control($val['srvDtls_service_name']);
                    $staffName 		= $this->global_mod->show_to_control($val['srvDtls_employee_name']);
                  //  $service_date = date('l, dS F, Y',strtotime($bookingDetails[0]['srvDtls_status_date']));
                   
                    $unit = $val['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
                    $appointmentDetails = 'Service Name : '.$serviceName.'<br />'.'Staff name : '.$staffName.'<br />'.'Service Date : '.$val['srvDtls_service_start'].' To '.$val['srvDtls_service_end'].'<br />'.'Duration : '.$val['srvDtls_service_duration'].' '.$unit.'<br />';
                }
                /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
                /*****      QUERY TO GET BUSINESS DETAILS STARTS        *****/
                $businessDetails = $this->approval_model->getBusinessDetails();
                $business_name = $businessDetails[0]['business_name'];
                $business_location = $businessDetails[0]['business_location'];
                $business_description = $businessDetails[0]['business_description'];
                $business_phone = $businessDetails[0]['business_phone'];
                $user_email = $businessDetails[0]['user_email'];
                
                
                //////      QUERY TO GET BUSINESS DETAILS ENDS      ////////
                
                /////      QUERY TO GET CANCELLATION POLICY STARTS   //////
                
                $cancellationPolicyArr = $this->approval_model->getCancellationPolicy();
                
                /*****      QUERY TO GET CANCELLATION POLICY ENDS       *****/
                /*****      QUERY TO GET MAXIMUM CANCELLATION TIME STARTS       *****/
                
                $maxTimeArr = $this->approval_model->getMaxCancellationTime();
                $maxTime = $maxTimeArr[0]['bkin_can_mx_tim'];
                if($maxTimeArr[0]['bkin_can_setin'] == 1){
                    $maxUnit = "Day(s)";
                }elseif($maxTimeArr[0]['bkin_can_setin'] == 2){
                    $maxUnit = "Hour(s)";
                }else{
                    $maxUnit = "Minute(s)";
                }
                $cancellationMaxTime = $maxTime." ".$maxUnit;   
                
            /*****      QUERY TO GET MAXIMUM CANCELLATION TIME ENDS     *****/
                ###############################################
                    
                $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
                
                $cancelpolicy = $this->global_mod->show_to_control($cancellationPolicyArr[0]['cms_dec']);
                $replacerArr = array( '{businessname}'			=> $business_name,
                					  '{businessaddress}'		=> $busi_address,
                					  '{businessemail}'			=> $user_email,
                					  '{businessphone}'			=> $business_phone,
                					  '{AppointmentInfo}'		=> $appointmentDetails,
                					  '{fname}'					=> $this->global_mod->show_to_control($cus_fname),
                					  '{lname}'					=> $this->global_mod->show_to_control($cus_lname),
                					  '{cancellationpolicy}'	=> nl2br($cancelpolicy),
                					  '{additionalinformation}'	=> nl2br($cancelpolicy),
                					  '{yourphone}'				=> $business_phone,
                					  '{CancellationHour}'		=> $cancellationMaxTime	
                
                );
                
                
             
                $this->email_model->sentMail(6, $replacerArr, $customerMail, $user_email);
        		echo 1;
	}
	public function saveCommentAgenda(){
        $comment		= $this->input->post('comment');
        $serviceDatailsId	= $this->input->post('serviceDatailsId');
        $save_comment   	= $this->calender_model->saveCommentAgenda($serviceDatailsId,$comment);
	}
	public function agendaStatusfunction(){
		$bookId = $this->input->post('bookId');
		$type 	= $this->input->post('type');
		if($type == 'As_Scheduled'){$typeId =7 ;}
		if($type == 'Arrived_Late'){$typeId =8 ;}
		if($type == 'No_Show'){$typeId = 9;}
		if($type == 'Gift_Certificates'){$typeId =10 ;}
		if($type == 'Add_Status'){$typeId = 6;}
		$this->calender_model->agendaStatusfunction($bookId,$typeId);
	}
	
	public function SavePayentAgendaDetails(){
		$data['bookingId'] 				= $this->input->post('bookingId');
		$data['payment_mode']			= $this->input->post('payment_mode');
		$data['booking_sub_total']		= $this->input->post('booking_sub_total');
		$data['booking_total_tax']		= $this->input->post('booking_total_tax');
		$data['booking_disc_amount']	= $this->input->post('booking_disc_amount');
		$data['payment_comment'] 		= $this->input->post('payment_comment');
		$data['Paid_total'] 			= $this->input->post('Paid_total'); 
		$print 							= $this->input->post('print'); 
		
		if($print != 'yes'){
			$return = $this->calender_model->SavePayentAgendaDetails($data);
		}else{
			$this->calender_model->SavePayentAgendaDetails($data);
			$bookingServiceDatails		= $this->calender_model->bookingIdWiseBookingDetails($data['bookingId']);
        	$bookingDatails				= $this->calender_model->bookingIdDetails($data['bookingId']);
        
	        $TaxArr = @@unserialize($bookingDatails[0]['booking_tax_dtls_arr']);
	        
	        
	        $str='';						
	        $str.='<table width="840px" cellspacing="0" cellpadding="0" border="0">';
	        $str.='<tr>';
	        $str.='<td colspan="6" bgcolor="#0057A6" style="color: #FFFFFF;font-weight: bold; padding: 3px 0 3px 20px;"> '.$this->lang->line("ordr_details").' </td>';
	        $str.='</tr>';
	        $str.='<tr>';
	        $str.='<td colspan="6" style="padding: 0px 0px 0px 0px;" width="100%">&nbsp;</td>';
	        $str.='</tr>';
	        $str.='<tr bgcolor="#E8F0FF" style="color: #0057A6;font-weight: bold;">';
	        $str.='<td align="left" width="168px">'.$this->lang->line("staff").'</td>';
	        $str.='<td align="left" width="126px">'.$this->lang->line("srvice").'</td>';
	        $str.='<td align="left" width="252px">'.$this->lang->line("time").'</td>';
	        $str.='<td align="left" width="84px">'.$this->lang->line("cost").' ('.$this->session->userdata("local_admin_currency_type").')</td>';
	        $str.='<td colspan="2"  width="210px">&nbsp;</td>';
	        $str.='</tr>';
	        foreach($bookingServiceDatails as $bookingDatailsVal){
	            $str.='<tr>';
	            $str.='<td align="left" nowrap="true">'.$this->global_mod->show_to_control($bookingDatailsVal['srvDtls_employee_name']).'</td>';
	            $str.='<td align="left" nowrap="true">'.$this->global_mod->show_to_control($bookingDatailsVal['srvDtls_service_name']).' ('.$bookingDatailsVal['srvDtls_service_quantity'].')</td>';
	            $str.='<td align="left" nowrap="true">'.date("h:i A",strtotime($bookingDatailsVal['srvDtls_service_start'])).' - '.date("h:i A",strtotime($bookingDatailsVal['srvDtls_service_end'])).' ('.date("M d,Y",strtotime($bookingDatailsVal['srvDtls_service_start'])).') </td>';
	            $str.='<td align="left" nowrap="true">'.$bookingDatailsVal['srvDtls_service_cost'].' X '.$bookingDatailsVal['srvDtls_service_quantity'].' = '.$this->global_mod->currencyFormat($bookingDatailsVal['srvDtls_service_cost']*$bookingDatailsVal['srvDtls_service_quantity']).'</td>';
	            $str.='<td colspan="2">&nbsp;</td>';
	            $str.='</tr>';
	        }
	        $str.='<tr>';
	        $str.='<td colspan="6" style="border-top:1px dashed #0057A6;height:2px;"  width="100%">&nbsp;</td>';
	        $str.='</tr>';
	        $str.='<tr>';
	        $str.='<td colspan="2" valign="top">';
	        $str.='<table width="290px" cellspacing="0" cellpadding="0" border="0">';
	        $str.='<tr>';
	        $str.='<td style="font-weight: bold;">'.$this->lang->line("some_nots_4_this_appo").' </td>';
	        $str.='</tr>';
	        $str.='<tr>';
	        $str.='<td><textarea id="order_comment_'.$data['bookingId'].'" style="width: 90%; height:150px;">'.$this->global_mod->show_to_control($bookingDatails[0]['booking_comment']).'</textarea></td>';
	        $str.='</tr>';
	        $str.='<tr>';
	        $str.='<td><!--input type="button" id="bt_add_comment__'.$data['bookingId'].'" class="time-bt" value="'.$this->global_mod->db_parse($this->lang->line("add_cmnt")).'" onclick="bookingCommentAgenda('.$data['bookingId'].')" --></td>';
	        $str.='</tr>';
	        $str.='</table>';
	        $str.='</td>'; 
	        $str.='<td></td>';
		  	$str.='<td colspan="2" valign="top">';
		  	$str.='<table cellspacing="0" cellpadding="0" width="100%"  border="0">';
		  	$str.='<tr>';
		  	$str.='<td valign="top" >'.$this->lang->line("total_amnt").' - </td>';
		  	$str.='<td td valign="top">'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'</td>';
		  	$str.='</tr>';
		  	$str.='<tr><td>'.$this->lang->line("additional_chrges").' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_additional_charges']).'</td></tr>';
		  	
		  	$str.='<tr><td>'.$this->lang->line("discount").' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_discount']).'</td></tr>';
		  	
		  	$total_tax = 0;
		  	$amnt = 0;
		  	
		  	if(is_array($TaxArr)){
				
			 	foreach($TaxArr as $val){
		        	 $taxName = array_keys($val);
		        	 $amnt = (($bookingDatails[0]['booking_sub_total']*$val[$taxName[0]])/100);
					 $str.='<tr><td align="left">'.$taxName[0].'  </td><td align="left">'.$this->session->userdata("local_admin_currency_type").$amnt.'</td></tr>';
					 $total_tax += $amnt;
				}
			}	
		  	
		  	
		  	$str.='<tr><td colspan="2" style="border-bottom:2px dotted #000000;"></td></tr>';
		  	
		  	$paid_total = $bookingDatails[0]['cash_total_amount'] + $total_tax + $bookingDatails[0]['cash_additional_charges'] - $bookingDatails[0]['cash_discount'];
		  	
		  	$str.='<tr><td style="font-weight:bold;">'.$this->lang->line("total").' - </td><td style="font-weight:bold;">'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($paid_total).'</td></tr>';
		  	$str.='<tr><td colspan="2" style="border-bottom:2px dotted #000000;"></td></tr>';
		  	$str.='<tr><td>'.$this->lang->line("total").' - </td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($bookingDatails[0]['cash_paid_total']).' '.$this->lang->line("paid").''.'</td></tr>';
		  //	$str.='<tr><td></td><td><a href="javascript:void(0);" onclick="ShowEditedAgendaDetails('.$bookingDatails[0]['cash_register_id'].')">(view)</a></td></tr>';
		  	$due = $bookingDatails[0]['cash_paid_total'] - ($bookingDatails[0]['cash_total_amount']+$total_tax+$bookingDatails[0]['cash_additional_charges']-$bookingDatails[0]['cash_discount']);
		  	$str.='<tr><td></td><td>'.$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($due).' '.$this->lang->line("due").''.'</td></tr>';
		  	$str.='</table>';
		  	$str.='</td>';
		  }
		  	$str.='</tr>';
		  	$str.='</table>';
	        echo $str;
		
		
	}
	
	public function ShowEditedAgendaOrderDetails(){
		$cash_register_id = $this->input->post('cash_register_id');
		$Return =  $this->calender_model->ShowPaidDetails($cash_register_id);
		
		$TaxArr = @unserialize($Return['booking_tax_dtls_arr']);
		$total_tax = 0;
		
		if(is_array($TaxArr)){
		 	foreach($TaxArr as $val){
	        	 $taxName = array_keys($val);
				 $total_tax += (($Return['booking_sub_total']*$val[$taxName[0]])/100);
			}
		}	
		
		$paid = $Return['cash_paid_total'];
	
		
		$str = '<table width="100%" style="border:1px solid #DADADA;">';
		$str .= '<thead style="font-weight:bold;">'.$this->global_mod->db_parse($this->lang->line("payment_details")).'</thead>';
		$str .= '<tr><td>';
		$str .= '<table>';
		$str .= '<tr width="100%"  style="background-color:#AABFFF;font-weight:bold;"><td>'.$this->global_mod->db_parse($this->lang->line("paid_head")).'</td><td>'.$this->global_mod->db_parse($this->lang->line("mode")).'</td><td>'.$this->global_mod->db_parse($this->lang->line("discount")).'</td><td>'.$this->global_mod->db_parse($this->lang->line("add_amnt")).'</td><td>'.$this->global_mod->db_parse($this->lang->line("notes")).'</td><td>'.$this->global_mod->db_parse($this->lang->line("actions")).'</td></tr>';
		$str .= '<tr><td valign="top">'.round($paid,2).'</td>';
		$str .= '<td valign="top">';
		if($Return['cash_payment_mode'] == 1)
			$str .= 'Cash';
		if($Return['cash_payment_mode'] == 2)
			$str .= 'Card';
		if($Return['cash_payment_mode'] == 3)
			$str .= 'Cheque';
		$str .= '</td>';
		$str .= '<td valign="top">'.$Return['cash_discount'].'</td>';
		$str.='<td valign="top">'.$Return['cash_additional_charges'].'</td>';
		$str.='<td>';
		$str.=$Return['cash_payment_notes']== NULL? '--------':$this->global_mod->db_parse($Return['cash_payment_notes']).'</td>';
		$str .= '<td valign="top"><a href="javascript:void(0);" onclick="OpenEditWindow('.$Return['cash_register_id'].')">'.$this->global_mod->db_parse($this->lang->line("edit_btn")).'</a> &nbsp; <a href="javascript:void(0);" onclick="DeleteEditData('.$Return['cash_register_id'].','.$Return['booking_id'].')">'.$this->global_mod->db_parse($this->lang->line("delete")).'</a></td>';
		$str .= '</tr>';
		$str .= '</table>';
		$str .= '</td></tr>';
		$str .= '</table>';
		
		echo $str;
	}
	
	public function OpenEditWindow(){
		$cash_register_id = $this->input->post('cash_register_id');
		$return = $this->calender_model->ShowPaidDetails($cash_register_id);
		//print_r($return);
		
		
		$str = '<table width="100%" align="center" style="border:1px solid #DADADA;">';
		$str .= '<thead>'.$this->global_mod->db_parse($this->lang->line("edit_payment_details")).' </thead>';
		$str .= '<tr align="center">';
		$str .= '<td>'.$this->global_mod->db_parse($this->lang->line("payment_mode")).'  </td>';
		$str .= '<td>';
		$str .= '<select name="payment_mode" id="payment_mode">';
		$str .= '<option value="1"';
		if($return['cash_payment_mode'] ==1)
			$str .= 'selected="selected"';
		$str .= '>Cash</option><option value="2"';
		if($return['cash_payment_mode'] ==2)
			$str .= 'selected="selected"';
		$str .= '>Credit Card</option><option value="3"';
		if($return['cash_payment_mode'] ==3)
			$str .= 'selected="selected"';
		$str .= '>Cheque</option>
					</select>
			
				</td>';
		$str .= '</tr>';
		$str .= '<tr align="center"><td>'.$this->global_mod->db_parse($this->lang->line("amnt_paid")).'  </td><td><input type="text" name="amount_paid" id="amount_paid" class="required" value="'.$return['cash_paid_total'].'" size="10px;" /></td></tr>';
		$str .= '<tr align="center"><td>'.$this->global_mod->db_parse($this->lang->line("discount")).'  </td><td><input type="text" name="discount" id="discount" class="required" value="'.$return['cash_discount'].'" size="10px;" /></td></tr>';
		$str .= '<tr align="center"><td>'.$this->global_mod->db_parse($this->lang->line("amnt_added")).'  </td><td><input type="text" name="amount_added" id="amount_added" class="required" value="'.$return['cash_additional_charges'].'" size="10px;" /></td></tr>';
		$str .= '<tr><td colspan="2"><textarea name="payment_note" id="payment_note" cols="30" rows="3" ';
		if($return['cash_payment_notes'] == '')
			$str .= ' placeholder="Payment note"';
		$str .= '>'.$return['cash_payment_notes'].'</textarea></td></tr>';
		$str .= '<tr align="center"><td></td><td><input type="button" name="updatebtn" id="updatebtn" value="'.$this->global_mod->db_parse($this->lang->line("amnt_added")).'" onclick="UpdatePaidDetails('.$cash_register_id.')"  /><input type="hidden" name="booking_bookingId" id="booking_bookingId" value="'.$return['booking_id'].'" /></td></tr>';
		$str .= '</table>';
		echo $str;
		
	}
	
	public function UpdatePaidDetailsController(){
		$cash_register_id 				 = $this->input->post('cash_register_id');
		$data['cash_paid_total'] 		 = $this->input->post('amount_paid');
		$data['cash_discount']  		 = $this->input->post('discount');
		$data['cash_additional_charges'] = $this->input->post('amount_added');
		$data['cash_payment_mode']  	 = $this->input->post('payment_mode');
		$data['cash_payment_notes']		 = $this->input->post('payment_note');
		
		$return = $this->calender_model->UpdatePaidDetailsModel($cash_register_id,$data);
		
	}
	
	public function DeleteCashRegister(){
		$register_id = $this->input->post('cash_register_id');
		echo $return = $this->calender_model->DeleteCashRegisterRow($register_id);
	}
	
	
	
}
