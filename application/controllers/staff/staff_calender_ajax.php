<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class staff_calender_ajax extends Pardco {
	  
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('GMT');
		
		$this->load->model('staff/staff_calender_model');
		/*===================LogIn Security Check===================*/
		$localAdminId 	= $this->session->userdata('local_admin_id');
		$logInStatus 	= $this->session->userdata('logged_in_staff');
		$userTyps 		= $this->session->userdata('user_type_staff');
		$logInUser 		= $this->session->userdata('user_id_staff');
		if($logInStatus != 1 && $userTyps !=2){
			$this->session->sess_destroy();
			redirect(base_url().'staff');
		}
		/*===================LogIn Security Check===================*/
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
		$local_string	.='<li><strong>Select staff :</strong></li>';   
		foreach($staff as $emp_rows) { 
	        $local_string	.='<li>';
			$local_string	.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	        $local_string	.='<input name="block_staff"';
			if($emp_rows['id'] == $current_id){
			$local_string	.=' checked="checked" disabled="disabled" ';	
			}
			$local_string	.='id="emp_block_'.$emp_rows['id'].'" type="checkbox" value="'.$emp_rows['id'].'" />&nbsp;&nbsp;&nbsp;';
			$local_string	.=$emp_rows['name'];
			$local_string	.='</li>';
          }
		$local_string	.='</ul>'; 
		echo $local_string;
        }			
	
	public function dateToCal($time) {
		error_reporting(0);
	return date('Ymd\This', $time) . 'Z';
	}
/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				DAY CALENDER			#####################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/	
	
	public function genaret_row(){
			$time_difference	=	$this->input->post('time_difference');
			$current_width		=	$this->input->post('width_row');
			$selected_date		=   explode("/",$this->input->post('selected_date'));
			$current_date		=	$selected_date[2]."-".$selected_date[1]."-".$selected_date[0];
			$selected_staff		=	$this->input->post('selected_staff');
			$selected_services	=	$this->input->post('selected_services');
            if($selected_staff==''){
                $staff = $this->staff_calender_model->getEmployeeList();
				
            }else{
                $staff = $this->staff_calender_model->getSelectedEmployee($selected_staff);

            }
			$booking_array = $this->staff_calender_model->getSelectedBookingAjax_pr($current_date,$selected_staff,$selected_services);
			$chkWorkableTimeArr = $this->staff_calender_model->getWorkingTime();
            $local_string_data ='';
            $local_string_data .= ' <div class="tabuler-deta"><div class="thead">
                                       <div class="onecolmin" style="width: 40px;"><button id="calender_settings">Settings</button></div>';
            for($s=0;$s<count($staff);$s++){								
                $local_string_data .='<div class="onecol"  align="center" ><div class="relative"><div class="employee_name">'.$staff[$s]['employee_name'];		

				$count_staff_booking	=	$this->staff_calender_model->count_staff_booking($staff[$s]['employee_id'],$current_date,$selected_services);	
				$isStaffBlockDate		=	$this->staff_calender_model->checkingStaffBlockDate($staff[$s]['employee_id'],$current_date);
				$isStaffBlockTime		=	$this->staff_calender_model->checkingStaffBlockTime($staff[$s]['employee_id'],$current_date);
                if($count_staff_booking > 0){
                    $local_string_data .='<label class="staffHeadingTbStApphd">'.$count_staff_booking.'</label>';
                }
				if($isStaffBlockDate > 0){			
					$local_string_data .='<img title="Block date" src="'.base_url().'/asset/lock.png">';
				}
				if($isStaffBlockTime > 0){			
					$local_string_data .='<img  title="Block time" src="'.base_url().'/asset/lock_time.png">';
				}

                $local_string_data .='</div><button class="calender_week_top" id="caltop_'.$staff[$s]['employee_id'].'" rel="'.$staff[$s]['employee_name'].'">&nbsp;</button><button class="calender_block_top" id="calblock_'.$staff[$s]['employee_id'].'" rel="'.$staff[$s]['employee_name'].'">&nbsp;</button></div></div>';
            }
            $local_string_data .='<div class="clear"></div></div><div class="tbody" style="">';
            for($i=0;$i<=23;$i++)
            {
                $local_string_data .='<div class="onerowcolor" style="background-color:';
                $local_string_data .=($i%2)?"":"#D3D3D3";
                $local_string_data .='" id="scroll_'.$i.'">
                               <div class="bodyonecol">'.$this->staff_calender_model->set_time($i).'</div>';
                for($s=0;$s<count($staff);$s++){							
                    $local_string_data .='<div class="bodypartonecol" >';
                    for($j=0;$j<60/$time_difference;$j++){
                        $jj = $j+1;
                        $pieces = explode("@@", $this->staff_calender_model->set_time_ampm_new($i));						
                        $pieces_new = explode("@@", $this->staff_calender_model->set_time_ampm($i));
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
                                        $ls_booking_val .='<div id="'.$pieces[0].'_'.($j*$time_difference).'_'.$booking_array[$b]['srvDtls_id'].'" class="drag_inner cont_dat">';
                                        $ls_booking_val .='<h3 class="ui-widget-header">'.$pieces_new[0].':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT)."&nbsp;".$pieces_new[1].'<span class="ui-icon ui-icon-info schedule_booking" style="cursor: pointer;"></span><span class="ui-icon ui-icon-circle-triangle-e booking_option" style="cursor: pointer;"></span></h3>';
                                        $ls_booking_val .='<div class="min_max_div">';
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
		$chkWorkableTime = $this->staff_calender_model->checkWorkingTime($staff[$s]['employee_id'],$current_date,$currentTime, $chkWorkableTimeArr);
		if(count($chkWorkableTime)>0){
		$ls_text= $ls_text.' workableTime';
		}				
        $local_string_data .= '<div class="'.$ls_text.'" id="'.$staff[$s]['employee_id'].'_'.$i.'_'.($j*$time_difference).'">';
                            if($ls_booking_val !=''){
                                if($group_no > 1){
                                    $group_text = 'Number of '.$group_no.' booking available on this time slot.Click here for details.';
                                    $local_string_data .= '<div class="min_max_div_group"><h3 class="ui-widget-header">'.$pieces_new[0].':'.str_pad($j*$time_difference,2,"0",STR_PAD_LEFT)."&nbsp;".$pieces_new[1].'</h3><span class="book_cont_group" id="grp-'.substr_replace($srvDtls_id ,"",-1).'"><label>'.$group_text.'</label></span></div>';
                                }else{
                                    $group_text = "";
                                    $local_string_data .= $ls_booking_val;
                                }
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
	public function searchCustomer(){
		$searchType	= $this->input->post('search_type');
		$searchKey	= $this->input->post('search_key');
		if($searchType =='global'){
			$customerArr = $this->staff_calender_model->customerGlobalSearch($searchKey);
		}
		if($searchType =='local'){
			$customerArr = $this->staff_calender_model->customerLocalSearch($searchKey);
		}
		$str='<hr width="100%">';
		$str.='<table width="100%" id="customer_radio_chk">';
		if(COUNT($customerArr) > 0){
			$str.='<tr bgcolor="#9FA6AB">';
			$str.='<th width="2%">&nbsp;</th>';
			$str.='<th width="30%" align="left">Name</th>';
			$str.='<th width="50%" align="left">Email</th>';
			$str.='<th width="18%" align="left">Phone</th>';
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
			$str.='<input id="exsi_btn_booking" value="BOOK NOW" class="btn-blue" type="button" onclick="return existingCustomerBooking()">';
			$str.='</td>';
			$str.='</tr>';
		}else{
			$str.='<tr>';
			$str.='<td align="center">';
			$str.='No Records to Display';
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
			$empArr				= array($this->session->userdata('user_id_staff'));//$this->input->post('employeeArr');
			$serviceArr			= $this->input->post('serviceArr');
			$employeeId			= $empArr[0];
			$bookingTime		= str_pad($weekTime[0],2,'0',STR_PAD_LEFT).':'.str_pad($weekTime[1],2,'0',STR_PAD_LEFT).':00';  
			$bookingDateTime	= date('Y-m-d H:i:s', strtotime($bookingDate.' '.$bookingTime));
			}
			if(is_array($serviceArr) && count($serviceArr)>0){

				$staffArr       =   $this->staff_calender_model->staffWiseBizSchedule($employeeId,$bookingDateTime,$serviceArr);
			}else{
				$staffArr       =   $this->staff_calender_model->staffWiseBizSchedule($employeeId,$bookingDateTime);
			}	
				$service 		=	$this->staff_calender_model->employeeWiseService($staffArr,$bookingDateTime);
				$empBlock 		=	$this->staff_calender_model->employeeWiseBlocking($employeeId,$bookingDateTime);
			if(COUNT($staffArr) && $service !='' && $empBlock == FALSE){
				$employee		=	$this->staff_calender_model->employeeDetails($employeeId);
				$timeZone		=	$this->staff_calender_model->getTimeZone();
                $country		=   $this->staff_calender_model->country();

		$str='';                
		$str.='<div id="tabs">';
        $str.='<table border="0" cellpadding="5" cellspacing="5" width="100%">';
        $str.='<tr>';
        $str.='<td align="right" width="30%" valign="top"><label><strong>Booked Date:</strong></label></td>';
        $str.='<td align="left">'.date('d/m/Y', strtotime($bookingDate)).'</td>';
        $str.='</tr>';
		$str.='<tr>';
        $str.='<td align="right" width="30%" valign="top"><label><strong>Booked Time:</strong></label></td>';
        $str.='<td align="left">'.$bookingTime.'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="right" valign="top"><label><strong>Staff:</strong></label></td>';
        $str.='<td align="left">'.$employee[0]["employee_name"].'</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="right" valign="top"><label><strong>Service:</strong></label></td>';
        $str.='<td align="left">';
		$str.='<select id="appointment_Service" class="ui-spinner ui-widget ui-widget-content ui-corner-all" name="appointment_Service">';
        $str.='<option value="-1">Select Service</option>';
		$str.=$service;
        $str.='</select>';
        $str.='</td>';
        $str.='</tr>';
		$str.='<tr id="tr_quantity">';
        $str.='<td align="right" valign="top"><label><strong>Quantity:</strong></label></td>';
        $str.='<td align="left">';
		$str.='<input id="quantity" maxlength="2" class="text ui-widget-content ui-corner-all" type="text" value="" name="quantity">';
        $str.='</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="right" valign="top"><label><strong>User type:</strong></label></td>';
        $str.='<td align="left">';
        $str.='<select id="appointment_userType" class="text_search ui-widget-content ui-corner-all" name="appointment_userType">';
        $str.='<option value="N">New</option>';
        $str.='<option value="E">Existing</option>';
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
		$str.='<tr>';
		$str.='<td><input type="checkbox" id="chk_global" value="src_global"> Global Search';
		$str.='<label id="lbl_normal">Search by First name or Last name or Email or Phone</label><label  id="lbl_global">Search by Email or Phone</label></td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td><input type="text" name="search_text" id="search_text" value="" class="text_search ui-widget-content ui-corner-all" /></td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td><input type="button" name="search_submit" onclick="return search_form()" id="search_submit" value="Search" class="btn-blue" /></td>';
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
		$str.='<td colspan="2"><lable style="font-size: 14px;font-weight: bold;">Enter details below for new customer.</lable></td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td align="right" valign="top"><label>Name</label></td>';
		$str.='<td align="left" nowrap="nowrap">';
		$str.='<input type="text" name="first_name" maxlength="30" id="first_name" value="First Name" class="text ui-widget-content ui-corner-all"/><br>';
		$str.='<input type="text" name="last_name" maxlength="20" id="last_name" value="Last Name" class="text ui-widget-content ui-corner-all" />';
		$str.='</td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td align="right" valign="top"><label>Email</label></td>';
		$str.='<td align="left" nowrap="nowrap">';
		$str.='<input type="text" name="email" id="email" value="Email" class="text ui-widget-content ui-corner-all" />';
		$str.='</td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td align="right" valign="top"><label>Phone</label></td>';
		$str.='<td align="left" nowrap="nowrap">';
		$str.='<input type="text" name="mobile" maxlength="10" id="mobile" value="Mobile" class="text ui-widget-content ui-corner-all" /><br>';
		$str.='<input type="text" name="home_no" maxlength="10" id="home_no" value="Home No." class="text ui-widget-content ui-corner-all" /><br>';
		$str.='<input type="text" name="work_no" maxlength="10" id="work_no" value="Work No." class="text ui-widget-content ui-corner-all" />';
		$str.='</td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td align="right" valign="top"><label>Address</label></td>';
		$str.='<td align="left">';
		$str.='<input type="text" name="address" id="address" value="Address" class="text ui-widget-content ui-corner-all" />';
		$str.='<select onchange="st(this.value)" id="appo_country" name="appo_country" class="text_search ui-widget-content ui-corner-all">';
		$str.='<option value="-1" selected="selected">--Select Country--</option>';
								
		$str.=$country;				
		$str.='</select><br>';
		$str.='<span id="span_appo_region">';
		$str.='<select id="appo_region" name="appo_region" class="text_search ui-widget-content ui-corner-all">';
		$str.='<option value="-1" selected="selected">--Select Region--</option>';

		$str.='</select>';
		$str.='</span><br>';
		$str.='<span id="span_appo_city">';
		$str.='<select id="appo_city" name="appo_city" class="text_search ui-widget-content ui-corner-all">';
		$str.='<option value="-1"  selected="selected">--Select City--</option>';
		$str.='	</select>';
		$str.='</span>';
		$str.='<input type="text" maxlength="10" name="pin_code" id="pin_code" value="Zip" class="text ui-widget-content ui-corner-all" />';
		$str.='</td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td align="right" valign="top"><label>Timezone:</label></td>';
		$str.='<td align="left" nowrap="nowrap">';
		$str.='<select id="appo_timezone" name="appo_timezone" class="text_search ui-widget-content ui-corner-all">';
		$str.='<option value="-1" selected="selected">---Select Time---</option>';
		$str.=$timeZone;					
		$str.='</select>';
		$str.='</td>';
		$str.='</tr>';
        $str.='<tr>';
		$str.='<td align="right" valign="top">&nbsp;</td>';
		$str.='<td align="left" nowrap="nowrap">';
		$str.='<input type="hidden" name="nb_bookingTime" id="nb_bookingTime" value="'.$bookingDateTime.'">';
        $str.='<input type="hidden" name="nb_employee_id"  id="nb_employee_id" value="'.$employeeId.'"> '; 
		$str.='<input type="button" name="book" id="btn-submit_book" value="Book Now" class="btn-blue" onclick="return booking_form()" />';
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
		$str.='<td colspan="2"><input type="checkbox" id="client_mail"><lable style="font-size: 14px;font-weight: bold;">&nbsp;Send email to client</lable></td>';
		$str.='</tr>';
		$str.='<tr>';
		$str.='<td colspan="2">&nbsp;</td>';
		$str.='</tr>';
//		$str.='<tr>';
//		$str.='<td colspan="2">To book multiple services switch to <a herf="#">advance view</a></td>';
//		$str.='</tr>';
		$str.='</table>';
		$str.='</div>';
		}else{
			$str='';  
			$str	.= '<span style="float:left; margin-left: 118px; margin-top: 20px;"><img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"></span>';
			$str	.= '<lable style="font-size: 16px; font-weight: bold;  margin-left: 10px; margin-top:36px; float:left;">Sorry!! There is no service at this time.</lable>'; 
		}
		echo $str;	
	} 
	public function adminNewAppointment(){
		$inputArr['employeeId']		= $this->input->post('nb_employee_id');
		$inputArr['bookingTime']	= $this->input->post('nb_bookingTime');
		$inputArr['serviceId']		= $this->input->post('appointment_Service');
		$inputArr['serviceQuantity']    = $this->input->post('quantity');
		$inputArr['fName']		= $this->input->post('first_name');
		$inputArr['lName']		= $this->input->post('last_name');
		$inputArr['email']		= $this->input->post('email');
		$inputArr['mobileNo']		= $this->input->post('mobile');
		$inputArr['homeNo']		= $this->input->post('home_no');
		$inputArr['workNo']		= $this->input->post('work_no');
		$inputArr['address']		= $this->input->post('address');
		$inputArr['countryId']		= $this->input->post('appo_country');
		$inputArr['regionId']		= $this->input->post('appo_region');
		$inputArr['cityId']		= $this->input->post('appo_city');
		$inputArr['pinCode']		= $this->input->post('pin_code');
		$inputArr['timeZoneId']		= $this->input->post('appo_timezone');
		$inputArr['sendMailClient']	= $this->input->post('client_mail');
		//checking booking is possibale ro not
		$employeeArr=array($inputArr['employeeId']);
		$serviceArr=array($inputArr['serviceId']);
		$chkArr	= $this->global_mod->checkStaffAvailability($inputArr['bookingTime'],$employeeArr,$serviceArr);
		
		$errStr = '';
		if($chkArr[0][0]['bk_status'] == TRUE){
			if($inputArr['serviceQuantity'] < $chkArr[0][0]['remaining_capacity']){
				//INSERT DATA IN CUSTOMER TABLE
				$lastCustomerId = $this->staff_calender_model->adminNewUserInsert($inputArr);
				//INSERT DATA IN BOOKING TABLE
				$bookingResult = $this->staff_calender_model->adminNewBooking($inputArr,$lastCustomerId);
				if($bookingResult == 1){
					$errStr .='<img title="Sorry" src="'.base_url().'/asset/Smile1.png"> Yes! Your Appointment booked.<br><br><label style="cursor: pointer" onclick="closeNewAppPopup()">click here to continue</label>';
				}else{
					$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! Temporary booking unable.';
				}
				
			}else{
				$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! You have crossed maximum booking capacity.';
			}
		}else{
			$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! Unable to make booking.';
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
		$employeeArr=array($inputArr['employeeId']);
		$serviceArr=array($inputArr['serviceId']);
		$chkArr	= $this->global_mod->checkStaffAvailability($inputArr['bookingTime'],$employeeArr,$serviceArr);
		$errStr = '';
		if($chkArr[0][0]['bk_status'] == TRUE){
			if($inputArr['serviceQuantity'] < $chkArr[0][0]['remaining_capacity']){
				//INSERT DATA IN BOOKING TABLE
				$bookingResult = $this->staff_calender_model->adminNewBooking($inputArr,$inputArr['customerId']);
				if($inputArr['chk_global'] == TRUE){
						$this->staff_calender_model->adminRelation($inputArr);	
				}
				if($bookingResult == 1){
					$errStr .='<img title="Happy" src="'.base_url().'/asset/Smile1.png"> Yes! Your Appointment booked.<br><br><label style="cursor: pointer" onclick="closeNewAppPopup()">click here to continue</label>';
				}else{
					$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! Temporary booking unable.';
				}
				
			}else{
				$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! You have crossed maximum booking capacity.';
			}
		}else{
			$errStr .='<img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"> Sorry! Unable to make booking.';
		}
		echo $errStr;
	}	
	public function ajax_check1(){
		$country_id= $this->input->post("id");
		if($country_id != ''){
			$showregion = $this->staff_calender_model->region_ajax_cal($country_id);
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
			$showcity = $this->staff_calender_model->city_ajax($region_id);
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
                $showCustomerDetails=$this->staff_calender_model->selectCustomer($custmerId);
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
            }
            /*****      QUERY TO GET CANCELLATION POLICY STARTS     *****/
            $cancellationPolicyArr = $this->staff_calender_model->getCancellationPolicy();
            /*****      QUERY TO GET CANCELLATION POLICY ENDS       *****/
            /*****      QUERY TO GET BUSINESS DETAILS STARTS        *****/
            $businessDetails = $this->staff_calender_model->getBusinessDetails();
            $business_name = $businessDetails[0]['business_name'];
            $business_location = $businessDetails[0]['business_location'];
            $business_phone = $businessDetails[0]['business_phone'];
            $user_email = $businessDetails[0]['user_email'];
            /*****      QUERY TO GET BUSINESS DETAILS ENDS      *****/
            /*****      QUERY TO GET MAXIMUM CANCELLATION TIME STARTS       *****/
            $maxTimeArr = $this->staff_calender_model->getMaxCancellationTime();
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
            /*****      CODE FOR MAIL SENDING STARTS        *****/
            if($is_mail == 'on'){
                $string =' AND srvDtls_id = "'.$dragServiceId.'"';
                $serviceDetailsArr = $this->staff_calender_model->mainBookingStorePro($string);
                /*echo "<pre>";
                print_r($serviceDetailsArr);
                echo "</pre>";exit;*/
                $srvDetails = $this->staff_calender_model->serviceDetails($serviceDetailsArr[0]['srvDtls_service_id']);
		$empDetails = $this->staff_calender_model->employeeDetails($dropEmployeeId);
                $customerDetailsArr = $this->staff_calender_model->customerDetails($serviceDetailsArr[0]['srvDtls_id']);
                $customerMail = $customerDetailsArr[0]['user_email'];
                $cus_fname = $customerDetailsArr[0]['cus_fname'];
                $cus_lname = $customerDetailsArr[0]['cus_lname'];
                
                $previousBookingData = '';
                $previousBookingData .= 'Booking Date &#58; '.date('Y-m-d',strtotime($serviceDetailsArr[0]['srvDtls_service_start']));
                $previousBookingData .= '<br>Service Name &#58; '.$serviceDetailsArr[0]['srvDtls_service_name'];
                $previousBookingData .= '<br>Staff Name &#58; '.$serviceDetailsArr[0]['srvDtls_employee_name'];
                $previousBookingData .= '<br>Start Time &#58; '.date('H&#58;i&#58; a',strtotime($serviceDetailsArr[0]['srvDtls_service_start']));
                $previousBookingData .= '<br>End Time &#58; '.date('H&#58;i&#58; a',strtotime($serviceDetailsArr[0]['srvDtls_service_end']));
                
                $newBookingData = '';
                $newBookingData .= 'Booking Date &#58; '.date('Y-m-d',strtotime($this->input->post('reshuDate')));
                $newBookingData .= '<br>Service Name &#58; '.$serviceDetailsArr[0]['srvDtls_service_name'];
                $newBookingData .= '<br>Staff Name &#58; '.$empDetails[0]['employee_name'];
                $newBookingData .= '<br>Start Time &#58; '.date("h&#58;i a",strtotime($rescheduleDateTime));
                $endTime = date('Y-m-d H:i:s', strtotime('+'.$srvDetails[0]['service_duration_min'].' minutes', strtotime($rescheduleDateTime)));
                $newBookingData .= '<br>End Time &#58; '.date("h&#58;i a",strtotime($endTime));
                ########################################
                $replacerArr = array();
                $replacerArr[0] = "{fname}:".$cus_fname;
                $replacerArr[1] = "{lname}:".$cus_lname;
                $replacerArr[2] = "{businessname}:".$business_name;
                $replacerArr[3] = "{businessaddress}:".$business_location;
                $replacerArr[4] = "{businessemail}:".$user_email;
                $replacerArr[5] = "{businessphone}:".$business_phone;
                $replacerArr[6] = "{cancellationpolicy}:".$cancellationPolicyArr[0]['cancellation_policy'];
                $replacerArr[7] = "{additionalinformation}:".$cancellationPolicyArr[0]['additional_info'];
                $replacerArr[8] = "{yourphone}:".$business_phone;
                $replacerArr[9] = "{CancellationHour}:".$cancellationMaxTime;
                $replacerArr[10] = "{hoursbeforecancellation}:".$cancellationMaxTime;
                $replacerArr[11] = "{OldAppointmentInfo}:".$previousBookingData;
                $replacerArr[12] = "{AppointmentInfo}:".$newBookingData;
                ########################################
                $mail = $this->email_model->sentMail(4, $replacerArr, $customerMail, $user_email);
            }
            $rescheduling   =   $this->staff_calender_model->adminRescheduleSave($rescheduleDateTime,$dropEmployeeId,$dragServiceId,$is_mail);
            /*****      CODE FOR MAIL SENDING ENDS      *****/
            return $rescheduling;
	}	
	public function count_staff_booking($staff_id,$date){
		
		return $staff_id.$date;
	}
	public function schedule_booking_form(){
		$idArr				= explode("_",$this->input->post('srvDetails'));
		$statusList     	= $this->staff_calender_model->appStatusList();
		$bookingDetails		= $this->staff_calender_model->singleBookingDetails($idArr[2]);
		$local_str	= '';
		$local_str	.= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="5%"></td>
								<td width="15%"></td>
								<td width="60%"></td>
								<td width="20%"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td colspan="2"><h3>Appointment Status</h3></td>
								<td  align="right"><strong style="cursor: pointer;" class="closeTip" onclick="CloseBlock(\'ScheduleBooking\')">X</strong></td>
							</tr>
							<tr>
								<td colspan="4">&nbsp;</td>
							</tr>';
                for($i=0;$i<count($statusList);$i++){
                    if($statusList[$i]['statusId']==$bookingDetails[0]['srvDtls_booking_status']){
                        $check = 'checked="checked"';
                    }else{
						$check ='';
					}
                       
                    $local_str	.= '			<tr>
								<td ></td>
								<td ><input type="radio" value="'.$statusList[$i]['statusId'].'" name="statusType" '.$check.'></td>
								<td colspan="2" align="left">'.$statusList[$i]['statusValue'].'</td>
							</tr>';	
                }
		$local_str	.= '			<tr>
								<td ></td>
								<td ><input type="hidden" value="'.$idArr[2].'" name="srvDtlsId" id="srvDtlsId"></td>
								<td colspan="2" align="left"><input class="btn-blue" type="button" value="OK" onclick="booking_option_submit()"></td>
							</tr>
						</table>';
		echo $local_str;
		
	}	
	public function booking_option_form(){
		$id_time	= $this->input->post('id_time');
		$local_str	= '';
		$local_str	.= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="5%"></td>
								<td width="15%"></td>
								<td width="80%"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td><h3>APPOINTMENT OPTIONS</h3></td>
								<td align="right"></td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td></td>
								<td><a href="javascript: void(0)" onclick="app_option_details(\'Edit\')">- Edit/Reschedule</a></td>
							</tr>';
		$local_str	.= '	<tr>
								<td></td>
								<td><a href="javascript: void(0)" onclick="app_option_details(\'Cancel\')">- Cancel</a></td>
							</tr>
							<tr>
								<td></td>
								<td><a href="javascript: void(0)" onclick="app_option_details(\'Client\')">- Client Details</a></td>
							</tr>
							<tr>
								<td></td>
								<td><a href="javascript: void(0)" onclick="app_option_details(\'Order\')">- Order Details</a></td>
							</tr>
							<tr>
								<td></td>
								<td><a href="javascript: void(0)" onclick="app_option_details(\'Ask\')">- Ask a review</a></td>
							</tr>
							<tr>
								<td></td>
								<td><a href="javascript: void(0)" onclick="app_option_details(\'Email\')">- Email Receipt</a></td>
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
                $bookingDetails = $this->staff_calender_model->getBookingDetailsServiceWise($bookingDetailsId);
                $cus_fname = ucfirst($bookingDetails[0]['cus_fname']);
                $cus_lname = ucfirst($bookingDetails[0]['cus_lname']);
                //$service_date = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_status_date']));
                $customerMail = $bookingDetails[0]['user_email'];
                $appointmentDetails = '';
                foreach($bookingDetails as $val)
                {
                    $serviceName = $val['srvDtls_service_name'];
                    $staffName = $val['srvDtls_employee_name'];
                    $service_date = date('l, dS F, Y',strtotime($bookingDetails[0]['srvDtls_status_date']));
                    $appointmentDetails .= $serviceName.' by '.$staffName.' on '.$service_date.'<br/>';
                }
                /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
                /*****      QUERY TO GET BUSINESS DETAILS STARTS        *****/
                $businessDetails = $this->approval_model->getBusinessDetails();
                $business_name = $businessDetails[0]['business_name'];
                $business_location = $businessDetails[0]['business_location'];
                $business_description = $businessDetails[0]['business_description'];
                $business_phone = $businessDetails[0]['business_phone'];
                $user_email = $businessDetails[0]['user_email'];
                /*****      QUERY TO GET BUSINESS DETAILS ENDS      *****/
                /*****      QUERY TO GET CANCELLATION POLICY STARTS     *****/
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
                $replacerArr = array();
                $replacerArr[0] = "{businessname}:".$business_name;
                $replacerArr[1] = "{businessaddress}:".$business_location;
                $replacerArr[2] = "{businessemail}:".$user_email;
                $replacerArr[3] = "{businessphone}:".$business_phone;
                $replacerArr[4] = "{AppointmentInfo}:".$appointmentDetails;
                $replacerArr[5] = "{fname}:".$cus_fname;
                $replacerArr[6] = "{lname}:".$cus_lname;
                $replacerArr[7] = "{cancellationpolicy}:".$cancellationPolicyArr[0]['cancellation_policy'];
                $replacerArr[8] = "{additionalinformation}:".$cancellationPolicyArr[0]['additional_info'];
                $replacerArr[9] = "{yourphone}:".$business_phone;
                $replacerArr[10] = "{CancellationHour}:".$cancellationMaxTime;
                ###############################################
                $mail = $this->email_model->sentMail(7, $replacerArr, $customerMail, $user_email);
            }
        }
    public function staffWiseTimeDropDown(){
                   $employeeId		= $this->input->post('staff_id');
                   $serviceId		= $this->input->post('service_id');
                   $bookingDate		= $this->input->post('select_date');
                   $timeDiff		= $this->input->post('time_difference');
                   echo $availableSlot 	= $this->staff_calender_model->availableTimeSlotGenerate($employeeId,$serviceId,$bookingDate,$timeDiff);
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

                            $checking = $this->staff_calender_model->checkingReschedule($bookingDateTime,$employeeId,$bookingDetailsId);
                            if($checking == TRUE){
                                    $save = $this->staff_calender_model->adminRescheduleSave($bookingDateTime,$employeeId,$bookingDetailsId,'',$serviceQuantity);
                                    if($save == 1){
                                            echo 1;
                                    }else{
                                            echo '<lebel style="color:red">Sorry unable to reschedule.</lebel>';
                                    }
                            }else{
                                    echo '<lebel style="color:red">Sorry!! Not available at this time.</lebel>';
                            }
            }
    public function booking_option_html($type,$details=""){
        if($type=='cancel'){//booking_cancel()
            $local_str	='';	
            $id_time	= $this->input->post('id_time');
            $idArr = explode("_",$id_time);
            $bookingServiceId = $idArr[2];
            $local_str	.='<table width="250px" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td width="5%"></td>
                                    <td ></td>
                                </tr>
                                <tr>
                                    <td width="5%"></td>
                                    <td style="font-size: 14px;font-weight: bold;">Cancel Options</td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td ></td>
                                </tr>
                                <tr>
                                    <td width="5%"></td>
                                    <td><input type="checkbox" checked="true" id="app_cancel_email">&nbsp;&nbsp;Send email to client. </td>
                                </tr>
                                <tr>
                                    <td width="5%">&nbsp;</td>
                                    <td ></td>
                                </tr>
                                <tr>
                                    <td width="5%"></td>
                                    <td align="center"><input class="btn-blue" type="button" value="Submit" onclick="app_cancel_option(\''.$bookingServiceId.'\')"/></td>
                                </tr>
                        </table>';
            echo $local_str;
        }
        if($type=='client'){
                $local_str	='';	 							
                $id_time	= $this->input->post('id_time');
                $idArr = explode("_",$id_time);
                $bookingServiceId = $idArr[2];


                                            $clientDetailsArr = $this->staff_calender_model->customerDetails($bookingServiceId);

                $fname = isset($clientDetailsArr[0]['cus_fname'])?$clientDetailsArr[0]['cus_fname']:'';
                $lname = isset($clientDetailsArr[0]['cus_lname'])?$clientDetailsArr[0]['cus_lname']:'';
                $mob = isset($clientDetailsArr[0]['cus_mob'])?$clientDetailsArr[0]['cus_mob']:'';
                $email = isset($clientDetailsArr[0]['user_email'])?$clientDetailsArr[0]['user_email']:'';
                $city_name = isset($clientDetailsArr[0]['city_name'])?$clientDetailsArr[0]['city_name']:'';
                $region_name = isset($clientDetailsArr[0]['region_name'])?$clientDetailsArr[0]['region_name']:'';
                $country_name = isset($clientDetailsArr[0]['country_name'])?$clientDetailsArr[0]['country_name']:'';
                $local_str	.='<table width="250px" cellspacing="0" cellpadding="0" border="0">
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td ></td>
                                                        <td ></td>
                                                </tr>
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td colspan="2" style="font-size: 14px;font-weight: bold;">User Details</td>
                                                </tr>
                                                <tr>
                                                        <td width="5%">&nbsp;</td>
                                                        <td colspan="2"></td>
                                                </tr>
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td wdith="20%"><strong>Name : </strong></td>
                                                        <td>'.ucfirst($fname).' '.ucfirst($lname).'</td>
                                                </tr>
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td><strong>Phone : </strong></td>
                                                        <td>'.$mob.' </td>
                                                </tr>
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td><strong>Email : </strong></td>
                                                        <td>'.$email.'</td>
                                                </tr>
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td><strong>Address : </strong></td>
                                                        <td>'.ucfirst($city_name).', '.ucfirst($region_name).', '.ucfirst($country_name).'</td>
                                                </tr>
                                                <tr>
                                                        <td width="5%">&nbsp;</td>
                                                        <td colspan="2"></td>
                                                </tr>
                                                <tr>
                                                        <td width="5%"></td>
                                                        <td><strong>Notes</strong></td>
                                                        <td align="center"></td>
                                                </tr>
                                        </table>';
                echo $local_str;
        }
        if($type=='order'){

    $idArr				= explode("_",$this->input->post('id_time'));
    $bookingServiceId	= $idArr[2];
    $bookingDatails		= $this->staff_calender_model->singleBookingDetails($bookingServiceId);
    $str='';						
    $str.='<table width="840px" cellspacing="0" cellpadding="0" border="0">';
    $str.='<tr>';
    $str.='<td colspan="6" bgcolor="#0057A6" style="color: #FFFFFF;font-weight: bold; padding: 3px 0 3px 20px;"> Order Details </td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td colspan="6" style="padding: 0px 0px 0px 0px;" width="100%">&nbsp;</td>';
    $str.='</tr>';
    $str.='<tr bgcolor="#E8F0FF" style="color: #0057A6;font-weight: bold;">';
    $str.='<td align="left" width="168px">Staff</td>';
    $str.='<td align="left" width="126px">Service</td>';
    $str.='<td align="left" width="252px">Time</td>';
    $str.='<td align="left" width="84px">Cost (Rs.)</td>';
    $str.='<td colspan="2"  width="210px">&nbsp;</td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">'.$bookingDatails[0]['srvDtls_employee_name'].'</td>';
    $str.='<td align="left">'.$bookingDatails[0]['srvDtls_service_name'].'</td>';
    $str.='<td align="left">'.date("h:i a",strtotime($bookingDatails[0]['srvDtls_service_start'])).' - '.date("h:i a",strtotime($bookingDatails[0]['srvDtls_service_end'])).' ('.date("M d,Y",strtotime($bookingDatails[0]['srvDtls_service_start'])).') </td>';
    $str.='<td align="left">'.$bookingDatails[0]['srvDtls_service_cost'].' X '.$bookingDatails[0]['srvDtls_service_quantity'].'</td>';
    $str.='<td colspan="2">&nbsp;</td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td colspan="6" style="border-top:1px dashed #0057A6;" width="100%">&nbsp;</td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td colspan="2" valign="top">';
    $str.='<table width="290px" cellspacing="0" cellpadding="0" border="0">';
    $str.='<tr>';
    $str.='<td style="font-weight: bold;">Some notes for this Appointment </td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td><textarea id="order_comment" style="width: 90%; height:150px;">'.$bookingDatails[0]['srvDtls_service_description'].' </textarea></td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td><input type="button" id="bt_add_comment" class="time-bt" value="Add Comment" onclick="addOrderComment('.$bookingServiceId.')"></td>';
    $str.='</tr>';
    $str.='</table>';
    $str.='</td>';
    $str.='<td colspan="2" valign="top">';
    $str.='<table width="100%" cellspacing="0" cellpadding="0" border="0">';
    $str.='<tr>';
    $str.='<td align="left" width="252px">Total Amount -</td>';
    $str.='<td align="left" width="84px">'.$bookingDatails[0]['booking_sub_total'].' </td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">Additional Charges -</td>';
    $str.='<td align="left">'.$bookingDatails[0]['booking_total_tax'].' </td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">Discount -  </td>';
    $str.='<td align="left">'.$bookingDatails[0]['booking_disc_amount'].' </td>';
    $str.='</tr>';
    $str.='<tr style="border-top:1px solid #0057A6;" width="100%">';
    $str.='<td align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">Total -</td>';
    $str.='<td align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">'.$bookingDatails[0]['booking_grnd_total'].' </td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">&nbsp;</td>';
    $str.='<td align="left">'.$bookingDatails[0]['booking_grnd_total'].' (Total)</td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">&nbsp;</td>';
    $str.='<td align="left">Rs.120 (Due)</td>';
    $str.='</tr>';
    $str.='</table>';
    $str.='</td>';
    $str.='<td colspan="2" valign="top">';
    $str.='<table width="100%" cellspacing="2" cellpadding="0" border="0" style="border: 2px dashed #D3D3D3; border-radius: 10px 10px 10px 10px; float: right;margin-right: 0 px;padding: 25px;">';
    $str.='<tr>';
    $str.='<td align="left" width="126px">Payment mode</td>';
    $str.='<td align="left" width="84px">';
    $str.='<select style="width: 80px">';
    $str.='<option>Cash</option>';
    $str.='<option>Credit Card</option>';
    $str.='<option>Check</option>';
    $str.='</select>';
    $str.='</td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">Amount to pay </td>';
    $str.='<td align="left">Rs.<input type="text" style="border: 1px solid #C3D9FF; width:50px;" size="5" value="'.$bookingDatails[0]['booking_sub_total'].'"></td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">Additional Charges  </td>';
    $str.='<td align="left">Rs.<input type="text" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="'.$bookingDatails[0]['booking_total_tax'].'"></td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left">Discount   </td>';
    $str.='<td align="left">Rs.<input type="text" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="'.$bookingDatails[0]['booking_disc_amount'].'"></td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td align="left" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">Total   </td>';
    $str.='<td align="left" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">Rs.'.$bookingDatails[0]['booking_grnd_total'].'</td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td colspan="2"><textarea style="width: 100%"></textarea></td>';
    $str.='</tr>';
    $str.='<tr>';
    $str.='<td colspan="2" align="center"><input type="button" class="time-bt" value="Save">&nbsp;&nbsp;<input type="button" class="time-bt" value="Save and Print"> </td>';
    $str.='</tr>';
    $str.='</table>';
    $str.='</td>';
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
            $bookingDetails	= $this->staff_calender_model->singleBookingDetails($bookingServiceId);
            $serviceArr	= $this->staff_calender_model->serviceDetailsFromBooking($bookingServiceId);
            $staffArr	= $this->staff_calender_model->getAvailableStaffOnService($bookingServiceId);
            $local_str	.='<table cellpadding="5" cellspacing="5" border="0" width="250px">
                <tr>
                    <td width="5"></td>
                    <td width="45"></td>
                    <td width="50"></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2" align="center" style="font-size: 14px;font-weight: bold;">Update appointment </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><span id="re_error"></span></td>
                </tr>
                <tr>
                    <td></td>
                    <td> What:</td>
                    <td><input type="hidden" id="re_serviceId"  value="'.$serviceArr[0]['service_id'].'">
                        '.$serviceArr[0]['service_name'].'
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td> Quantity:</td>
                    <td>
                        <input type="text" id="re_serviceQuantity" style="border: 1px solid #C3D9FF; width:70px;" value="'.$bookingDetails[0]['srvDtls_service_quantity'].'">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Who:</td>
                    <td>
                        <select style="width:150px;" name="re_employeeId" id="re_employeeId" onchange="staff_availability(this.value)">';
            foreach($staffArr as $staffVal){
                    if($staffVal[0]['employee_id'] == $bookingDetails[0]['srvDtls_employee_id']){
                        $select = 'selected="selected"';
                    }else{
                        $select = '';
                    }
                    $local_str	.='<option value="'.$staffVal[0]['employee_id'].'" '.$select.'>'.$staffVal[0]['employee_name'].'</option>';
            }
            $local_str	.='</select>
            </td>
            </tr>
            <tr>
                <td></td>
                <td>When:</td>
                <td nowrap="true"><input id="choosen_booking_date" type="text" value="'.$bookDate.'" style="border: 1px solid #C3D9FF; width:70px;" readonly />&nbsp;&nbsp;
                    <span id="choosen_booking_time_span">
                        <select id="choosen_booking_time">
                        <option value=""> Select </option>
                        </select>
                    </span>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" align="center"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" align="center">
                    <input id="re_button"  type="button" value="Reschedule »" onclick="make_reschedule(\''.$bookingServiceId.'\')" class="btn-blue"/>
                </td>
            </tr>
            </table>';
            echo $local_str;
        }
        if($type=='aks'){
            $local_admin_id = $this->session->userdata('local_admin_id');
            $host=$_SERVER['HTTP_HOST'];
            $idArr = explode("_",$this->input->post('id_time'));
                
            $this->db->select('user_email,user_name');
            $this->db->from('app_password_manager');
            $this->db->where('user_type', '3'); 
            $this->db->where('user_id', $local_admin_id);
            $query = $this->db->get();
            $user_email =  $query->result_array();
                
            /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
            $bookingDetails = $this->staff_calender_model->getBookingDetailsServiceWise($idArr[2]);
            $cus_fname = ucfirst($bookingDetails[0]['cus_fname']);
            $cus_lname = ucfirst($bookingDetails[0]['cus_lname']);
            $employee_id = $bookingDetails[0]['srvDtls_employee_id'];
            $service_id = $bookingDetails[0]['srvDtls_service_id'];
            $customer_id = $bookingDetails[0]['customer_id'];
            $service_start_time = $bookingDetails[0]['srvDtls_service_start'];
            $customer_email = $bookingDetails[0]['user_email'];
            /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
            #############################################
            $link = $host.'/customerRate/rating/'.$local_admin_id.'/'.$customer_id.'/'.$service_id.'/'.$employee_id.'/'.$idArr[2];
            $replacerArr = array();
            $replacerArr[0] = "{fname}:".ucfirst($cus_fname);
            $replacerArr[1] = "{lname}:".ucfirst($cus_lname);
            $replacerArr[2] = "{appointmentStartDate}:".$service_start_time;
            $replacerArr[3] = "{rateBusiness}:".$link;
            $replacerArr[4] = "{businessemail}:".$user_email[0]["user_email"];
            #############################################
            $mail = $this->email_model->sentMail(3, $replacerArr, $customer_email, $user_email[0]["user_email"]);
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
                $save_comment   = $this->staff_calender_model->saveComment($serviceDatailsId,$comment);
	}
 	public function staff_setting_option(){
		$staff_id	= $this->input->post('staff_id');
		$local_str	= '';
		$local_str	.= '<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tr>
								<td width="5%"></td>
								<td width="15%"></td>
								<td width="80%"></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td nowrap="true"><h3>STAFF SETTING OPTIONS </h3></td>
								<td  align="right"></td>
							</tr>
							<tr>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="reshedule_option_details(\'Working_hours\')">- Set working hours</a></td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="reshedule_option_details(\'Block\')">- Block Day/Time</a></td>
							</tr>
							<tr>
								<td ></td>
								<td ><a href="javascript: void(0)" onclick="reshedule_option_details(\'Edit_staff\')">- Edit staff details</a></td>
							</tr>
						</table>
						<input type="hidden" value="'.$staff_id.'" name="re_staff_id" id="re_staff_id">';
		echo $local_str;
	}
	public function booked_staff_schedule(){
            $block_from             =   $this->input->post('block_from');
            $block_to               =   $this->input->post('block_to');
            $employeeArr	        =   $this->input->post('blockempArr');
			$result = $this->staff_calender_model->adminEmployeeBlocking($block_from,$block_to,$employeeArr);
			echo $result;
        }
	public function getGroupBookingDetails(){
		$bookingId	= $this->input->post('bookingId');
		$idString	= explode("-",$bookingId);
		$idString	= str_replace("_",",",$idString[1]);
		$dataArr = $this->staff_calender_model->grpBookingDetails($idString);
		$str='';
		foreach($dataArr as $valArr){
			$str .= '<div class="reshudl" id="reshudl-'.$valArr['srvDtls_id'].'">';
			$str .= '<label>Title:</label>'.$valArr['srvDtls_service_name'].' :: '.$valArr['srvDtls_service_description'].'<br>';
			$str .= '<label>FOR:</label>Palash Roy<br>';
			$str .= '<label>BY:</label>'.$valArr['srvDtls_employee_name'].'<br>';
			$str .= '<label>FROM:</label>'.date("h:i:s A",strtotime($valArr['srvDtls_service_start'])).'<br>';
			$str .= '<label>TO:</label>'.date("h:i:s A",strtotime($valArr['srvDtls_service_end'])).'';
			$str .= '</div>';
		}
		echo $str;
	}
	public function rescheduleChecking(){
		$dragDetails	= $this->input->post('dragDetails');
		$dropDatails	= $this->input->post('dropDetails');
		$type			= $this->input->post('dragType');
		$rescheduleDate	= $this->input->post('reschedule');	
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
		$rescheduleCheck = $this->staff_calender_model->checkingReschedule($rescheduleDateTime,$dropEmployeeId,$dragServiceId);
		
		$str	 = '';
		if($rescheduleCheck == FALSE){
			$str	.= '<span style="float:left; margin-left: 20px; margin-top: 20px;"><img title="Sorry" src="'.base_url().'/asset/sorry_admin.png"></span>';
			$str	.= '<lable style="font-size: 14px; font-weight: bold;  margin-left: 10px; margin-top:36px; float:left;">Sorry unable to reschedule.</lable>';
			$returnString = '0||@@||'.$str;
		}
		if($rescheduleCheck == TRUE){
			$string =' AND srvDtls_id = "'.$dragServiceId.'"';
			$serviceDetailsArr	= $this->staff_calender_model->mainBookingStorePro($string);
			$srvDetails			= $this->staff_calender_model->serviceDetails($serviceDetailsArr[0]['srvDtls_service_id']);
			$empDetails			= $this->staff_calender_model->employeeDetails($dropEmployeeId);
			$str	.='<table cellspacing="0" width="100%">';
			$str	.='<tr>';
			$str	.='<td>';
			$str	.='<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#C5DDF8">';
			$str	.='<tr>';
			$str	.='<td colspan="2" align="center" bgcolor="#0057A6" style="color: #FFFFFF;"><b>FROM<b></td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">Staff name :</td>';
			$str	.='<td align="left">'.$serviceDetailsArr[0]['srvDtls_employee_name'].'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">Start time :</td>';
			$str	.='<td align="left">'.date("h:i a",strtotime($serviceDetailsArr[0]['srvDtls_service_start'])).'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">End time :</td>';
			$str	.='<td align="left">'.date("h:i a",strtotime($serviceDetailsArr[0]['srvDtls_service_end'])).'</td>';
			$str	.='</tr>';
			
			$str	.='</table>';
			$str	.='</td>';
			$str	.='<td>';
			$str	.='<table cellpadding="0" cellspacing="0" width="100%" bgcolor="#DFE2E3">';
			$str	.='<tr>';
			$str	.='<td colspan="2" align="center" bgcolor="#0057A6" style="color: #FFFFFF;"><b>TO<b></td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">Staff name :</td>';
			$str	.='<td align="left">'.$empDetails[0]['employee_name'].'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">Start time :</td>';
			$str	.='<td align="left">'.date("h:i a",strtotime($rescheduleDateTime)).'</td>';
			$str	.='</tr>';
			$str	.='<tr>';
			$str	.='<td align="left">End time :</td>';
			$endTime = date('Y-m-d H:i:s', strtotime('+'.$srvDetails[0]['service_duration_min'].' minutes', strtotime($rescheduleDateTime)));
			$str	.='<td align="left">'.date("h:i a",strtotime($endTime)).'</td>';
			$str	.='</tr>';
			$str	.='</table>';
			$str	.='</td>';	
			$str	.='</tr>';
			$str	.='</table>';
			$str	.='<br>&nbsp;&nbsp;<input id="isSendMailRs" type="checkbox">';
			$str	.='<lable style="font-size: 14px;font-weight: bold;"> Send email to client</lable>';
			
			$returnString = '1||@@||'.$str;
		}		
		echo $returnString;
	}
	public function checkDuplicatEmail(){
		$email = $this->input->post('email');
		$returnVal = $this->global_mod->checkDuplicatEmail($email);
		echo $returnVal;
	}



	public function ical_data(){
            $calenderStartDate = date('Y-m-d');
            $calenderEndDate = date('Y-m-d', strtotime("+".NO_OF_DAY." days"));
            $search = ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$calenderStartDate.'" AS date) AND CAST("'.$calenderEndDate.'" AS date)  AND srvDtls_employee_id='.$this-> session-> userdata('user_id_staff');
            $dataArr = $this->global_mod->mainBookingStoreProReport($search);
			
            $ical ='';	 
            // Build the ics file header So Donot Change(header part start)
            $ical .= 	"BEGIN:VCALENDAR\n";
            $ical .= 	"PRODID:-//hacksw/handcal//NONSGML v1.0//EN\n";
            $ical .= 	"VERSION:2.0\n";
            $ical .= 	"METHOD:PUBLISH\n";
            $ical .= 	"CALSCALE:GREGORIAN\n";
            $ical .= 	"X-CALSTART:".$this->dateToCal(strtotime($calenderStartDate))."\n";
            $ical .= 	"X-CALEND:".$this->dateToCal(strtotime($calenderEndDate))."\n";                
            $ical .= 	"X-WR-CALNAME:Bookient\n";
            ########################################################
            foreach($dataArr as $val)
            {
                $customerName = ucfirst($val['cus_fname'])." ".ucfirst($val['cus_lname']);
                $serviceDuration = $val['srvDtls_service_duration'].$val['srvDtls_service_duration_unit'];
                $ical .=    "BEGIN:VEVENT\n";
                $ical .=    "CLASS:PUBLIC\n";
                $ical .=    "CREATED:".$this->dateToCal(strtotime($val['booking_date_time']))."\n";
                $ical .=    "DESCRIPTION:Client UserName : ".$val['user_email'].", Client Mobile : ".$val['cus_mob']."\n";

                $ical .=    "DTEND:".$this->dateToCal(strtotime($val['srvDtls_service_end']))."\n";
                //$ical .=  "DTSTAMP:" . time() . "\n";
                $ical .=    "DTSTART:".$this->dateToCal(strtotime($val['srvDtls_service_start']))."\n";
                $ical .=    "UID:".microtime()."\n";

                $ical .=    "LOCATION:".$val['cus_address'].", ".$val['city_name'].", ".$val['region_name'].", ".$val['country_name']."\n";
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
            /****       CB#SR#02-03-2013#PR#S     *****/
            $month_start = $date_range[0];
            $month_end = $date_range[1];
            $booking_array = $this->staff_calender_model->get_month_data_staff_service($month_start, $month_end, $month_staff);
            /*echo "<pre>";
            print_r($booking_array);
            echo "</pre>";*/
            return  isset($booking_array[$date])?$booking_array[$date]:'';          
        }
	public function getStaffServiceStaff($date){
            $date_range	=   $this->input->post('date_range');
            $month_staff=   $this->input->post('selected_staff');
            $month_start = $date_range[0];
            $month_end = $date_range[1];
            $booking_array = $this->staff_calender_model->get_month_data_staff_id($month_start, $month_end, $month_staff);
            return isset($booking_array[$date])?$booking_array[$date]:'';
            
        }
	public function monthViewDataDetails($dateArr,$month_staff,$month_service){
		$monthBookingDetails = $this->staff_calender_model->getSelectedBookingAjax_pr_month($dateArr,$month_staff,$month_service);		
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
		$month_staff	=   array($this->session->userdata('user_id_staff'));
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
            $local_string=' <div class="tabuler-deta monthviewtable widthauto"><div class="thead">
                                <div class="onecol col-width" >Sunday</div>
                                <div class="onecol col-width" >Monday</div>
                                <div class="onecol col-width" >Tuesday</div>
                                <div class="onecol col-width" >Wednesday</div>
                                <div class="onecol col-width" >Thursday</div>
                                <div class="onecol col-width" >Friday</div>
                                <div class="onecol col-width" >Saturday</div>
                            </div><div class="clear"></div><div class="tbody">';
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
                        if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'<div id="gotoDay_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="gotoDay">';		
                        }else{
                            $local_string   .=  '<div class="blocked-class">-Blocked-</div>';	
                        }	
                    }elseif($i !=0 && $total_day_of_the_month>= $month_cunter){
                        $local_string	.=  '<div class="bodypartonecol relative col-width" ><div class="non_drag"';
                        $local_string	.=  (date($ls_month."/".str_pad($month_cunter,2,"0",STR_PAD_LEFT)."/".$ls_year)==date("m/d/Y"))?'style="background-color: #FFF0A5"':'';
                        $local_string	.=  '>';
                        if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'<div id="month-gotoDay_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="gotoDay">';	
                        }else{
                            $local_string   .=  '<div class="blocked-class">-Blocked-</div>';	
                        }			
                    }
                    /*#####################checking day end#######################*/
                    /*####################Main Content Start#########################*/
                    if($j==$colspan && $i==0 or $j<$colspan && $i==0 or $total_day_of_the_month < $month_cunter){
                        $local_string	.=  '';	//NULL CONTENT
                    }else{
                        if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            
                            $day = ($month_cunter<10)?"0".$month_cunter:$month_cunter;
                            $mydate = $ls_year."-".$ls_month."-".$day;
							$local_string .='<div class=" withdatebottom monthdate gotoDayStaff" id="month-contener_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" style="cursor: pointer">';
                            $DateTime	= date ("Y", strtotime($date_range[0])).'-'.date ("m", strtotime($date_range[0])).'-'.$month_cunter;
							$dateArr['start']	= date('Y-m-d H:i:s', strtotime($DateTime.' 00:00:00'));
							$dateArr['end']		= date('Y-m-d H:i:s', strtotime($DateTime.' 23:59:59'));
							$dataStr = $this->monthViewDataDetails($dateArr,$month_staff,$month_service);
							if($dataStr == ''){
								$local_string .='<span id="month-Date_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="span_date_gotoDay" >'.$month_cunter.' '.date ("M", strtotime($date_range[0])).'</span>';	//MAIN CONTENT
							}else{
								$local_string .= $dataStr;
								$local_string .='<span id="month-Date_'.$ls_month.'_'.$month_cunter.'_'.$ls_year.'" class="span_date_gotoDay ">'.$month_cunter.' '.date ("M", strtotime($date_range[0])).'</span>';
							}
                            $local_string .='</div>';	
                        }else{
                            $local_string .='';//BLOCK CONTENT	
                        }
                    }
                    /*####################Main Content End#########################*/
                    /*#####################checking day start#######################*/		
                    if($j==$colspan && $i==0){
                        $local_string .='</div>';	
                    }elseif($j>$colspan && $i==0){
                        if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'</div></div></div>';		
                        }else{
                            $local_string   .=	'</div></div>';	
                        }
                        $month_cunter++;	
                    }elseif($i !=0 && $total_day_of_the_month>= $month_cunter){
                        if($this->compareDates(date($ls_month."/".$month_cunter."/".$ls_year),date("m/d/Y")) == "true"){
                            $local_string   .=	'</div></div></div>';		
                        }else{
                            $local_string   .=	'</div></div>';	
                        }
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
	public function dateTimeWiseBooking($dateArr,$empArr,$srvArr) {
		$boolingdata =$this->staff_calender_model->getSelectedBookingAjax_pr_week($dateArr,$empArr,$srvArr);
		$showDate = date("h:i A",strtotime($dateArr['start']));
		$str = '';
		if(COUNT($boolingdata) == 1 && !empty($boolingdata)){
				$str .= '<div  class="weekDataContener">';
				$str .= '<h3 class="week-book-header">'.$showDate.'</h3>';
				$str .= '<span class="weekBookCont">';
				$str .= '<lable class="weekBookContgrd">';
				$str .= '<label>Title</label>';
				$str .= $boolingdata[0]['srvName'];
				$str .= '<br>';
				$str .= '<label>FOR</label>';
				$str .= 'Customer Name';
				$str .= '<br>';
				$str .= '<label>BY</label>';
				$str .= $boolingdata[0]['empNme'];
				$str .= '<br>';
				$str .= '<label>FROM</label>';
				$str .= date("h:i A",strtotime($boolingdata[0]['bookStart']));
				$str .= '<br>';
				$str .= '<label>TO</label>';
				$str .= date("h:i A",strtotime($boolingdata[0]['bookEnd']));
				$str .= '<br>';
				$str .= '</lable>';
				$str .= '</span>';
				$str .= '</div>';
		}
		
		if(COUNT($boolingdata) > 1 && !empty($boolingdata)){
				$str .= '<div  class="weekDataContener">';
				$str .= '<h3 class="week-book-header">'.$showDate.'</h3>';
				$str .= '<span class="weekBookCont">';
				$str .= '<lable class="weekBookContgrd normalWhiteSpace">';
				$str .= 'Number of '.COUNT($boolingdata).' booking available on this time slot.Click here for details.';
				$str .= '</lable>';
				$str .= '</span>';
				$str .= '</div>';
		}

		return $str;          
	}
	public function genaret_row_week(){
            $week_day		=	$this->input->post('date_range');
            $week_staff		=	array($this->session->userdata('user_id_staff'));
            $week_services	=	$this->input->post('selected_services');
            $time_difference=	$this->input->post('time_difference');
            $current_width	=	178;//$this->input->post('current_width');
            $week_start		=	$week_day[0];
            $week_end		=	$week_day[1];           
            $date_array		=	$this->createDateRangeArray($week_day[0],$week_day[1]);
            $local_string_data	=	'';

		$staff = $this->staff_calender_model->getSelectedEmployee($week_staff);
				
                $local_string_data = '';
                $local_string_data .= '<div class="marginadj"><div class="tabuler-deta-employee emplouenameHead">'.$staff[0]['employee_name'].'</div></div>
                                            <div class="tabuler-deta"><div class="theadweek"></div>
                <div class="thead">
                    <div class="onecolmin" style="width: 40px;"><button id="calender_settings">Settings</button></div>';
		for($s=0;$s<count($date_array);$s++){
                    $local_string_data .='<div class="onecol" style="width: '.$current_width.'px; background: #C8DAF7;" nowrap="nowrap">'.date("D m/d",strtotime($date_array[$s])).' ';
                    $count_staff_booking	=	$this->staff_calender_model->count_staff_booking($staff[0]['employee_id'],$date_array[$s],$week_services);
                    $isStaffBlockDate		=	$this->staff_calender_model->checkingStaffBlockDate($staff[0]['employee_id'],$date_array[$s]);
                    $isStaffBlockTime		=	$this->staff_calender_model->checkingStaffBlockTime($staff[0]['employee_id'],$date_array[$s]);
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
                                            <div class="bodyonecol">'.$this->staff_calender_model->set_time($i).'</div>';
                    for($s=0;$s<count($date_array);$s++){															
                        $local_string_data .='<div class="bodypartonecol" style="width: '.$current_width.'px;">';
                        for($j=1;$j<=60/$time_difference;$j++){
                            $divId = date("d-m-Y",strtotime($date_array[$s])).'@_@'.$i.'-'.($j-1)*$time_difference;
                            $divTime = date("h:i A",strtotime($i.':'.($j-1)*$time_difference.':00'));
                            $dateArr = array();
                            $minstart = ($j-1)*$time_difference;
                            $minend = ($j*$time_difference)-1;
                            $dateArr['start']	= date('Y-m-d H:i:s', strtotime($date_array[$s].' '.($i.':'.$minstart.':00')));
                            $dateArr['end']	= date('Y-m-d H:i:s', strtotime($date_array[$s].' '.($i.':'.$minend.':59')));	
                            $nowbookDetails = $this->dateTimeWiseBooking($dateArr,$week_staff,$week_services);
							
                            if(($nowbookDetails)== ''){
								$local_string_data .= '<div id="'.$divId.'" class="non_drag cont_dat relative">'; 
                                $local_string_data .= '<span id="span-'.$divId.'" class="timeweek">'.$divTime.' Click here to book.</span>';
                                $local_string_data .= '</div>';
                                 
                            }else{
                               // $local_string_data .='<div id="'.$divId.'" class="cont_dat relative">'; 
                                $local_string_data .= $nowbookDetails;
                               // $local_string_data .= '</div>';   
                            } 
                        }					
                        $local_string_data .='</div>';
                    }	
                    $local_string_data .='<div class="clear"></div></div>';
		}
                $local_string_data .='</div><div class="clear"></div></div>';
               /* $local_string_data .='
                <div id="up_arrow" class="weekstaffup" onclick="scroll_me_up()"><img src="'.base_url().'/asset/scroll_up.png"></div>
                <div id="down_arrow" class="weekstaffdown"  onclick="scroll_me_down()"><img src="'.base_url().'/asset/scroll_down.png"></div>';*/
    
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
            $msg=$this->staff_calender_model->askAReview($this->input->post('email_data'));
            echo $msg;
        }
	 
/*###############################################################################################################*/
/*###############################################################################################################*/
/*#####################################				AGENDA			#####################################*/
/*###############################################################################################################*/
/*###############################################################################################################*/
	public function calenderAgenda(){
		$selectedDate	=	$this->input->post('selected_date');
		$staffArr = array( $this->session->userdata('user_id_staff') );
		$serviceArr		=	$this->input->post('ls_services');
		$agendaDateTime	=	date('Y-m-d H:i:s', strtotime($selectedDate.' 00:00:00'));
		$bookingDetails	=	$this->staff_calender_model->getSelectedBookingAjax_pr_agenda($agendaDateTime,$staffArr,$serviceArr);
		$timeString = '';
		$agStr = '';
		$agStr.= '<table class="agendaMain">';
foreach($bookingDetails as $bookingDetailsVal){
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
		$agStr.= '<div class="dropButton" id="setStatus_'.$bookingDetailsVal['bookingId'].'">Set Status</div>';
		$agStr.= '<ul class="appointmentStatusAppointy" id="appointmentStatusAppointy_'.$bookingDetailsVal['bookingId'].'" style="display: none;">';
		$agStr.= '<li onclick="agendaStatusfunction(\'As_Scheduled\','.$bookingDetailsVal['bookingId'].')">As Scheduled</li>';
		$agStr.= '<li onclick="agendaStatusfunction(\'Arrived_Late\','.$bookingDetailsVal['bookingId'].')">Arrived Late</li>';
		$agStr.= '<li onclick="agendaStatusfunction(\'No_Show\','.$bookingDetailsVal['bookingId'].')">No Show</li>';
		$agStr.= '<li onclick="agendaStatusfunction(\'Gift_Certificates\','.$bookingDetailsVal['bookingId'].')">Gift Certificates</li>';
		$agStr.= '<li onclick="agendaStatusfunction(\'Add_Status\','.$bookingDetailsVal['bookingId'].')">Add Status</li>';
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
		$agStr.= '<td><lable style="border-bottom: 1px dashed #A2A2A2;font-style: italic;padding: 0;">';
		$agStr.= $bookingDetailsVal['bookingCustomerEmail'];
		$agStr.= '<lable></td>';
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
		$agStr.= $this->global_mod->show_to_control($bookingDetailsVal['bookingCustomerAddress']);
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
		
		if($bookingDetailsVal['bookingDetails'][0]['added_by'] == 2){
			//$agStr.= '<img src="'.base_url().'/asset/who.png" title="Booked By Admin">';	
			$agStr.= '<span style="font-weight:bold">'.'Booked By Employee'.'</span>';	
		}else{
			if($bookingDetailsVal['bookingDetails'][0]['added_by'] == 1){
				$agStr.= '<span style="font-weight:bold">'.'Booked By User'.'</span>';
			}
			else{
				$agStr.= '<span style="font-weight:bold">'.'Booked By Admin'.'</span>';	
			}
			//$agStr.= '<img src="'.base_url().'/asset/who.png" title="Booked By Admin">';	
			
		}
		//$agStr.= '<img src="'.base_url().'/asset/where.png" title="Book from Computer">&nbsp;&nbsp;';
		//$agStr.= '<img src="'.base_url().'/asset/who.png" title="Booked By Admin">';
		$agStr.= '</td>';
		$agStr.= '</tr>';
		$agStr.= '<tr>';
		$agStr.= '<td align="left" id="agendaCancelAppointmentMsg_'.$bookingDetailsVal['bookingId'].'"> ';
		$agStr.= '</td>';
		$agStr.= '</tr>';
		$agStr.= '<tr>';
		$agStr.= '<td align="left" > ';
		foreach($bookingDetailsVal['bookingDetails'] as $bookingVal){
		$agStr.= '<lable style="border-bottom: 1px dashed #A2A2A2;font-style: italic;padding: 0;color: #56A04B;">';
		$agStr.= $bookingVal['srvDtls_service_name'];
		if($bookingVal['srvDtls_service_quantity'] >1){
		$agStr.= '&nbsp;('.$bookingVal['srvDtls_service_quantity'].')&nbsp;';	
		}
		$agStr.= '&nbsp;by&nbsp;';
		$agStr.= $bookingVal['srvDtls_employee_name'];
		$agStr.= '&nbsp;('.date("h:i A",strtotime($bookingVal['srvDtls_service_start'])).')</lable>';
		$color = ($bookingVal['srvDtls_booking_status'] == 4 || $bookingVal['srvDtls_booking_status'] == 5)?"#FF2C2C":"#3370A2";
		$agStr.= '<lable style="color: '.$color.';"> &nbsp;Status: '.$this->statusDetails($bookingVal['srvDtls_booking_status']).' </lable><br>';
		}
		$agStr.= '</td>';
		$agStr.= '</tr>';
		if($bookingVal['srvDtls_booking_status'] != 4 || $bookingVal['srvDtls_booking_status'] != 5){
		$agStr.= '<tr>';
		$agStr.= '<td align="left" id="agendaCancelAppointment_'.$bookingDetailsVal['bookingId'].'">'; 
		$agStr.= '<span onclick="agendaCancelAppointment('.$bookingDetailsVal['bookingId'].')" style="cursor: pointer;color: #0B85EC;">Cancel Appointment</span>';
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
		$agStr.= '<span onclick="agendaAskReview('.$bookingDetailsVal['bookingId'].')" style="cursor: pointer;color: #0B85EC;">Ask a review </span>';
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
		$agStr.= '<td colspan="3" align="left"><input type="button" class="btn-blue" id="agdDtlId_'.$bookingDetailsVal['bookingId'].'" onclick="agendaDetailsCont('.$bookingDetailsVal['bookingId'].')" value="Show Detail"/></td>';
		$agStr.= '</tr>';
		$agStr.= '</tr>';
		$agStr.= '</table>';
		$agStr.= '</td>';
		$agStr.= '</tr>';
		
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
$bookingServiceDatails		= $this->staff_calender_model->bookingIdWiseBookingDetails($bookingId);
$bookingDatails				= $this->staff_calender_model->bookingIdDetails($bookingId);
$str='';						
$str.='<table width="840px" cellspacing="0" cellpadding="0" border="0">';
$str.='<tr>';
$str.='<td colspan="6" bgcolor="#0057A6" style="color: #FFFFFF;font-weight: bold; padding: 3px 0 3px 20px;"> Order Details </td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td colspan="6" style="padding: 0px 0px 0px 0px;" width="100%">&nbsp;</td>';
$str.='</tr>';
$str.='<tr bgcolor="#E8F0FF" style="color: #0057A6;font-weight: bold;">';
$str.='<td align="left" width="168px">Staff</td>';
$str.='<td align="left" width="126px">Service</td>';
$str.='<td align="left" width="252px">Time</td>';
$str.='<td align="left" width="84px">Cost (Rs.)</td>';
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
$str.='<td style="font-weight: bold;">Some notes for this Appointment </td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td><textarea id="order_comment_'.$bookingId.'" style="width: 90%; height:150px;">'.$bookingDatails[0]['booking_comment'].'</textarea></td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td><input type="button" id="bt_add_comment__'.$bookingId.'" class="time-bt" value="Add Comment" onclick="bookingCommentAgenda('.$bookingId.')"></td>';
$str.='</tr>';
$str.='</table>';
$str.='</td>';
$str.='<td colspan="2" valign="top">';
$str.='<table width="100%" cellspacing="0" cellpadding="0" border="0">';
$str.='<tr>';
$str.='<td align="left" width="252px">Total Amount -</td>';
$str.='<td align="left" width="84px">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'</td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">Additional Charges -</td>';
$str.='<td align="left">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_total_tax']).' </td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">Discount -  </td>';
$str.='<td align="left">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_disc_amount']).' </td>';
$str.='</tr>';
$str.='<tr style="border-top:1px solid #0057A6;" width="100%">';
$str.='<td align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">Total -</td>';
$str.='<td align="left" style="border-top:1px solid #0057A6; border-bottom:1px solid #0057A6;">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).'</td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">&nbsp;</td>';
$str.='<td align="left">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).' (Total)</td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">&nbsp;</td>';
$str.='<td align="left">Rs.000 (Due)</td>';
$str.='</tr>';
$str.='</table>';
$str.='</td>';
$str.='<td colspan="2" valign="top">';
$str.='<table width="100%" cellspacing="2" cellpadding="0" border="0" style="border: 2px dashed #D3D3D3; border-radius: 10px 10px 10px 10px; float: right;margin-right: 0 px;padding: 25px;">';
$str.='<tr>';
$str.='<td align="left" width="126px">Payment mode</td>';
$str.='<td align="left" width="84px">';
$str.='<select style="width: 80px">';
$str.='<option>Cash</option>';
$str.='<option>Credit Card</option>';
$str.='<option>Check</option>';
$str.='</select>';
$str.='</td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">Amount to pay </td>';
$str.='<td align="left">Rs.<input type="text" style="border: 1px solid #C3D9FF; width:50px;" size="5" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_sub_total']).'"></td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">Additional Charges  </td>';
$str.='<td align="left">Rs.<input type="text" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_total_tax']).'"></td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left">Discount   </td>';
$str.='<td align="left">Rs.<input type="text" size="5" style="border: 1px solid #C3D9FF; width:50px;" value="'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_disc_amount']).'"></td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td align="left" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">Total   </td>';
$str.='<td align="left" style="border-top:1px dotted #0057A6; font-weight: bold; border-bottom:1px dotted #0057A6;">'.$this->global_mod->currencyFormat($bookingDatails[0]['booking_grnd_total']).'</td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td colspan="2"><textarea style="width: 100%"></textarea></td>';
$str.='</tr>';
$str.='<tr>';
$str.='<td colspan="2" align="center"><input type="button" class="time-bt" value="Save">&nbsp;&nbsp;<input type="button" class="time-bt" value="Save and Print"> </td>';
$str.='</tr>';
$str.='</table>';
$str.='</td>';
$str.='</tr>';
$str.='</table>';

echo $str;
                    
	}
	public function agendaAskReview(){
            $local_admin_id = $this->session->userdata('local_admin_id');
            $host=$_SERVER['HTTP_HOST'];
            
            $this->db->select('user_email,user_name');
            $this->db->from('app_password_manager');
            $this->db->where('user_type', '3'); 
            $this->db->where('user_id', $local_admin_id);
            $query = $this->db->get();
            $user_email =  $query->result_array();
            
            $bookingId = $this->input->post('bookId');
            $serviceId = $this->staff_calender_model->getServiceId($bookingId);
            /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
            $bookingDetails = $this->staff_calender_model->getBookingDetailsServiceWise($serviceId);
            $cus_fname = ucfirst($bookingDetails[0]['cus_fname']);
            $cus_lname = ucfirst($bookingDetails[0]['cus_lname']);
            $employee_id = $bookingDetails[0]['srvDtls_employee_id'];
            $service_id = $bookingDetails[0]['srvDtls_service_id'];
            $customer_id = $bookingDetails[0]['customer_id'];
            $service_start_time = $bookingDetails[0]['srvDtls_service_start'];
            $customer_email = $bookingDetails[0]['user_email'];
            /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
            #############################################
            $link = $host.'/customerRate/rating/'.$local_admin_id.'/'.$customer_id.'/'.$service_id.'/'.$employee_id.'/'.$serviceId;
            $replacerArr = array();
            $replacerArr[0] = "{fname}:".ucfirst($cus_fname);
            $replacerArr[1] = "{lname}:".ucfirst($cus_lname);
            $replacerArr[2] = "{appointmentStartDate}:".$service_start_time;
            $replacerArr[3] = "{rateBusiness}:".$link;
            $replacerArr[4] = "{businessemail}:".$user_email[0]["user_email"];
            #############################################
            echo $mail = $this->email_model->sentMail(3, $replacerArr, $customer_email, $user_email[0]["user_email"]);
            //echo 1;
	}
	public function agendaCancelAppointment(){
            $this->load->model('admin/approval_model');
            $bookingId = $this->input->post('bookId');
            $this->staff_calender_model->agendaCancelAppointment($bookingId);
            /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
            $bookingDetails = $this->approval_model->getBookingDetails($bookingId);
            $cus_fname = $bookingDetails[0]['cus_fname'];
            $cus_lname = $bookingDetails[0]['cus_lname'];
            //$service_date = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_status_date']));
            $customerMail = $bookingDetails[0]['user_email'];
            $appointmentDetails = '';
            foreach($bookingDetails as $val)
            {
                $serviceName = $val['srvDtls_service_name'];
                $staffName = $val['srvDtls_employee_name'];
                $service_date = date('l, dS F, Y h:i A',strtotime($bookingDetails[0]['srvDtls_status_date']));
                $appointmentDetails .= $serviceName.' by '.$staffName.' on '.$service_date.'<br/>';
            }
            /*****      QUERY TO GET BOOKING DETAILS ENDS       *****/
            /*****      QUERY TO GET BUSINESS DETAILS STARTS        *****/
            $businessDetails = $this->approval_model->getBusinessDetails();
            $business_name = $businessDetails[0]['business_name'];
            $business_location = $businessDetails[0]['business_location'];
            $business_description = $businessDetails[0]['business_description'];
            $business_phone = $businessDetails[0]['business_phone'];
            $user_email = $businessDetails[0]['user_email'];
            /*****      QUERY TO GET BUSINESS DETAILS ENDS      *****/
            /*****      QUERY TO GET CANCELLATION POLICY STARTS     *****/
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
            #############################################
            $replacerArr = array();
            $replacerArr[0] = "{fname}:".$cus_fname;
            $replacerArr[1] = "{lname}:".$cus_lname;
            $replacerArr[2] = "{businessname}:".$business_name;
            $replacerArr[3] = "{businessaddress}:".$business_location;
            $replacerArr[4] = "{additionalinformation}:".$business_description;
            $replacerArr[5] = "{businessemail}:".$user_email;
            $replacerArr[6] = "{AppointmentInfo}:".$appointmentDetails;
            $replacerArr[7] = "{businessphone}:".$business_phone;
            $replacerArr[8] = "{cancellationpolicy}:".$cancellationPolicyArr[0]['cancellation_policy'];
            $replacerArr[9] = "{additionalinformation}:".$cancellationPolicyArr[0]['additional_info'];
            $replacerArr[10] = "{yourphone}:".$business_phone;
            $replacerArr[11] = "{CancellationHour}:".$cancellationMaxTime;
            #############################################
            echo $mail = $this->email_model->sentMail(8, $replacerArr, $customerMail, $user_email);
            //echo 1;
	}
	public function saveCommentAgenda(){
        $comment		= $this->input->post('comment');
        $serviceDatailsId	= $this->input->post('serviceDatailsId');
        $save_comment   	= $this->staff_calender_model->saveCommentAgenda($serviceDatailsId,$comment);
	}
	public function agendaStatusfunction(){
		$bookId = $this->input->post('bookId');
		$type 	= $this->input->post('type');
		if($type == 'As_Scheduled'){$typeId =7 ;}
		if($type == 'Arrived_Late'){$typeId =8 ;}
		if($type == 'No_Show'){$typeId = 9;}
		if($type == 'Gift_Certificates'){$typeId =10 ;}
		if($type == 'Add_Status'){$typeId = 6;}
		$this->staff_calender_model->agendaStatusfunction($bookId,$typeId);
	}
}
