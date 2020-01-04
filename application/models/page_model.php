<?php
//error_reporting(0);
class Page_model extends CI_Model
{
    public $_resultArr = array();
    public $_resultArr1 = array();

    public function secToHour($sec){
        $sec = intval($sec);
        $hour = $sec/3600;
        $time_hr = floor($hour);
        $remaining_hr = $hour - $time_hr;
        $minute = $remaining_hr * 60;
        $time_min = floor($minute);
        $remaining_min = $minute - $time_min;
        $time_sec = round($remaining_min * 60);
        $time = $time_hr.":".$time_min.":".$time_sec;
        return $time;
    }
   
    public function ConvToGmttime($format,$clientTime=''){
        date_default_timezone_set('UTC');
        return $mydate = gmdate($format,$clientTime);
    }
    
    public function getCustomerTimeZone(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('app_time_zone.gmt_symbol,app_time_zone.gmt_value');
        $this->db->from('app_time_zone');
        $this->db->join('app_local_admin', 'app_local_admin.time_zone_id = app_time_zone.time_zone_id');
        $this->db->where('app_local_admin.local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function check_user_email_veri_status(){
       $this->session->userdata('local_admin_id');
       $this->db->select('*');
       $this->db->from('app_password_manager');
       $this->db->where('user_id', $this->session->userdata('local_admin_id'));
       $this->db->where('user_type',3);
       $query = $this->db->get();
       $resEle = $query->result_array();
       $val = $resEle[0]['email_veri_status'];
       return $val;
    }
    
    public function check_view_user_status(){
       $this->session->userdata('local_admin_id');
       $this->db->select('*');
       $this->db->from('app_biz_hours');
       $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
       $query = $this->db->get();
       $NumRows =  $query->num_rows();
       $val = $NumRows > 0 ? 1:0;
       return $val;
    } 
    
    public function checkApp_biz_hours(){
       $this->session->userdata('local_admin_id');
       $this->db->select('*');
       $this->db->from('app_biz_hours');
       $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
       $query = $this->db->get();
       $NumRows =  $query->num_rows();
       $val = $NumRows > 0 ? 1:"Biz Hours Required";
       return $val;
    } 
    
    public function checkBusiness(){
        $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id', $this->session->userdata('local_admin_id'));
        $query = $this->db->get();

        $NumRows =  $query->num_rows();
        $msg='';
        if($NumRows > 0){	  
            $Arr = $query->result_array();
            foreach($Arr as $key=>$val){
                if($val['business_name']==''){
                    $msg="Business Name Required";
                    return $msg;
                    break;
                }
                if($val['business_location']==''){			
                    $msg="Business Location Required";
                    return $msg;
                    break;
                }
                if($val['business_city_id']==''){				
                    $msg="Business city Required";
                    return $msg;
                    break;
                }
                if($val['business_state_id']==''){					
                    $msg="Business State Required";
                    return $msg;
                    break;
                }
                if($val['business_zip_code']==''){					
                    $msg="Business Zip Required";
                    return $msg;
                    break;
                }
            }
            return 1;
        }else{
            $msg="Business Details Required";
            return $msg;
        }
    } 
    
    public function checkFrontendDisplayStatus(){
       
        	$local_admin_id = $this->session->userdata('local_admin_id');
 
            $this->db->select('enable_system');
            $this->db->from('app_local_admin_gen_setting');
            $this->db->where('local_admin_id',$local_admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr[0]['enable_system'];
           
    } 
   
    public function language_listings($local_admin_id){
        $sql = "SELECT al.languages_id,al.languages_name,al.image FROM app_languages AS al, app_local_admin_gen_setting_languages AS als WHERE 
                    al.languages_id = als.languages_id AND
                    als.local_admin_id = '".$local_admin_id."' AND
                    als.status = '1' ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }  
   
    public function CustomerName(){
        $Arr = array();
        if($this->session->userdata('user_id_customer')!= '' ){
            $admin_id = $this->session->userdata('user_id_customer');
            $this->db->select('user_name');
            $this->db->from('app_password_manager');
            $this->db->where('user_id',$admin_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            return $Arr[0]['user_name'];
        }else{
            $out = "";
            return $out;
        }
    } 
   
    public function SelectedLang(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('languages_name,languages_id,image');
        $this->db->from('app_languages');

        $this->db->join('app_local_admin_gen_setting', 'app_languages.languages_id = app_local_admin_gen_setting.default_language_id');
        $this->db->where('local_admin_id',$local_admin_id);

        $query = $this->db->get();
        $Ret_Arr_val = $query->result_array();
        return $Ret_Arr_val;
    }
    
    public function getFrontEndSettings($local_admin_id){
        $this->db->select('app_local_admin_gen_setting.multiple_services_booking,
                           app_local_admin_gen_setting.local_admin_id as adminId,
                           app_local_admin_gen_setting.enable_system,
                           app_local_admin_gen_setting.quantity_appointment_setting,
                           app_local_admin_gen_setting.quantity_appointment,
                           app_local_admin_gen_setting.show_staff_customers,
                           app_local_admin_gen_setting.staff_order,
                           app_local_admin_gen_setting.allow_international_users,
                           app_local_admin_gen_setting.no_of_booking as noOfBooking,
                           app_local_admin_gen_setting.no_of_booking_period as noOfBookingPeriod,
                           app_local_admin_gen_setting.booking_starting_point as bookingStartingPoint,
                           app_local_admin_gen_setting.no_of_booking_period_from as noOfBookingPeriodFrom,
                           app_local_admin_gen_setting.no_of_booking_period_to as noOfBookingPeriodTo,
                           app_local_admin_gen_setting.recurring_appointments as recurringAppointments,
                           app_local_admin_gen_setting.show_service_cost as showServiceCost,
                           app_local_admin_gen_setting.show_service_time_duration as showServiceTimeDuration,
                           app_local_admin_gen_setting.clients_name_with_reviews as clientsNameWithReviews,
                           app_local_admin_gen_setting.detect_client_timezone as detectClientTimezone,
                           app_local_admin_gen_setting.booked_times_striked as bookedTimesStriked,
                           app_local_admin_gen_setting.blocked_times_striked_out as blockedTimesStrikedOut,
                           app_local_admin_gen_setting.default_view as defaultView,
                           app_local_admin_gen_setting.cal_strting_weekday as calStrtingWeekday,
                           app_local_admin_gen_setting.cal_strting_dt as calStrtingDt,
                           app_local_admin_gen_setting.show_staff_customers as showStaffCustomers,
                           app_local_admin_gen_setting.staff_selection_mandatory as staffSelectionMandatory,
                           app_local_admin_gen_setting.cal_time_interval_typ as calTimeIntervalTyp,
                           app_local_admin_gen_setting.cal_time_interval_variable as calTimeIntervalVariable,
                           app_local_admin_gen_setting.adv_bk_mx_tim as advBkMxTim,
                           app_local_admin_gen_setting.adv_bk_min_setting as advBkMinSetting,
                           app_local_admin_gen_setting.pre_booking_frm as pre_booking_frm,
                           app_local_admin_gen_setting.adv_bk_min_tim as advBkMinTim,
                           app_local_admin_gen_setting.pre_pmnt_setting,
                           app_local_admin_gen_setting.aprvl_rqrd_mob_non_verfd_mem,
						   app_local_admin_gen_setting.hours_type,
						   app_local_admin_gen_setting.adv_bk_mx_tim,
						   app_local_admin_gen_setting.show_block_timinig,
                           app_local_admin.time_zone_id,
                           app_time_zone.gmt_symbol,
                           app_time_zone.gmt_value
                        ');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->join('app_local_admin', 'app_local_admin.local_admin_id = app_local_admin_gen_setting.local_admin_id');
        $this->db->join('app_time_zone', 'app_time_zone.time_zone_id = app_local_admin.time_zone_id');
        $this->db->where('app_local_admin_gen_setting.local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    } 

    public function getCancelSettings($local_admin_id){
        $this->db->select('app_local_admin_gen_setting.bkin_can_mx_tim,
                           app_local_admin_gen_setting.bkin_can_setin
                        ');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    } 
   
    public function getFrontEndTheme(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('layout,theme');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    }	   
    
    public function getStaffByService($service_start_dt,$local_admin_id,$service_id,$staff_id){
        $string ='';
        $string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$service_start_dt.'" AS date) AND  srvDtls_booking_status = "2" AND srvDtls_service_id="'.$service_id.'" AND srvDtls_employee_id="'.$staff_id.'"';
        $Arr	=	$this->global_mod->mainBookingStorePro($string);

        $serviceArr = array();
        foreach($Arr as $key=>$val){
            $staff_id = isset($val['srvDtls_employee_id'])?$val['srvDtls_employee_id']:0;
            $booking_id = isset($val['booking_id'])?$val['booking_id']:0;
            $booking_service_id = isset($val['srvDtls_service_id'])?$val['srvDtls_service_id']:0;
            $customer_id = isset($val['customer_id'])?$val['customer_id']:0;
            $service_duration = isset($val['srvDtls_service_duration'])?$val['srvDtls_service_duration']:0;
            $service_name = isset($val['srvDtls_service_name'])?$val['srvDtls_service_name']:0;
            $service_duration_unit = isset($val['srvDtls_service_duration_unit'])?$val['srvDtls_service_duration_unit']:0;
            $service_start_time = isset($val['srvDtls_service_start'])?date("H:i:s",strtotime($val['srvDtls_service_start'])):0;
            $service_end_time = isset($val['srvDtls_service_end'])?date("H:i:s",strtotime($val['srvDtls_service_end'])):0;
            $quantity = isset($val['srvDtls_service_quantity'])?$val['srvDtls_service_quantity']:0;
            
            // $staffArr[$key]['staff'] = $staff_id; 
            $serviceArr[$key]['bookSrvId'] = intval($booking_service_id);
            $serviceArr[$key]['bookId'] = intval($booking_id);
            $serviceArr[$key]['srvId'] = intval($service_id);
            $serviceArr[$key]['custId'] = intval($customer_id);
            $serviceArr[$key]['srvDuration'] = intval($service_duration);
            $serviceArr[$key]['srvName'] = $service_name;
            $serviceArr[$key]['srvDurationUnit'] = $service_duration_unit;
            $serviceArr[$key]['srvSrtTime'] = date("g:ia",strtotime($service_start_time));
            $serviceArr[$key]['srvEndTime'] = date("g:ia",strtotime($service_end_time)); 
            $serviceArr[$key]['srvSrtTimeCal'] = $service_start_time;
            $serviceArr[$key]['srvEndTimeCal'] = $service_end_time;
            $serviceArr[$key]['srvQuantity'] = intval($quantity);
        }
        return $serviceArr;
    }
   
    public function getDistinctStaff($service_start_dt,$local_admin_id,$service_id){
        $starting ='';
        $starting .=' distinct srvDtls_employee_id ';
        $string ='';
        $string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$service_start_dt.'" AS date) AND srvDtls_booking_status = "2" AND srvDtls_service_id="'.$service_id.'"';
        $Arr	=	$this->global_mod->mainBookingStorePro($string,$starting);
        $staffArr = array();
        foreach($Arr as $key=>$val){
            $staff_id = isset($val['srvDtls_employee_id'])?$val['srvDtls_employee_id']:0;
            $staffArr[$key]['staff'] = $staff_id;
            $staffArr[$key]['staff_details'] = $this->getStaffByService($service_start_dt,$local_admin_id,$service_id,$staff_id);     
        }
        return $staffArr;
    }
   
    public function getServiceDtlByDate($service_start_dt,$local_admin_id){
        $starting ='';
        $starting .=' distinct srvDtls_service_id ';
        $string ='';
        $string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = CAST("'.$service_start_dt.'" AS date) AND  srvDtls_booking_status = "2" ORDER BY srvDtls_service_id';
        $Arr	=	$this->global_mod->mainBookingStorePro($string,$starting);
		
        foreach($Arr as $key=>$val){
            $service_id = isset($val['srvDtls_service_id'])?$val['srvDtls_service_id']:0;
            $staffArr = $this->getDistinctStaff($service_start_dt,$local_admin_id,$service_id);
            $ServiceArr[$key]['service'] = $service_id;
            $ServiceArr[$key]['service_details'] = $staffArr;
        }
        return $ServiceArr; 
    }
   	
  	public function getBookingDetails($local_admin_id,$start_date,$end_date){
        $starting ='';
        $starting .=' distinct (DATE_FORMAT(srvDtls_service_start,"%d-%m-%Y")) as  srvDtls_service_start';
        $string ='';
        $string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$start_date.'" AS date) AND CAST("'.$end_date.'" AS date) AND  srvDtls_booking_status = "2" ORDER BY srvDtls_service_start,srvDtls_service_id,srvDtls_employee_id';
        $Arr	=	$this->global_mod->mainBookingStorePro($string,$starting);
        
        $finalArr = array();
        foreach($Arr as $key=>$val){
            $ServiceArr = $this->getServiceDtlByDate(date("Y-m-d",strtotime($val['srvDtls_service_start'])),$local_admin_id);
            $finalArr[$key]['date'] = $val['srvDtls_service_start'];
            $finalArr[$key]['date_datils'] = $ServiceArr;
        }
        return $finalArr;
    }
    
    public function getBookingDetails_mobile($local_admin_id,$start_date,$end_date,$srvArr,$staffArr){
        $starting ='';
        $string ='';
        $string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$start_date.'" AS date) AND CAST("'.$end_date.'" AS date) AND  srvDtls_booking_status = "2" ';
        
        $staffStr = '';
        foreach($staffArr as $val){
            $staffStr .= $val.",";
        }
        $staff = substr_replace($staffStr ,"",-1);

        $serviceStr = '';
        foreach($srvArr as $val){
            $serviceStr .= $val.",";
        }
        $service = substr_replace($serviceStr ,"",-1);
        
		$string .=' AND srvDtls_service_id IN ('.$service.') ';
        $string .=' AND srvDtls_employee_id IN ('.$staff.') ';

        $mainData	=	$this->global_mod->mainBookingStorePro($string,$starting);
        return $mainData;
        exit;
     }   
    
    public function getBookingDetails_rev($local_admin_id,$start_date,$end_date){
        $starting ='';
        $string ='';
        $string .= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") BETWEEN CAST("'.$start_date.'" AS date) AND CAST("'.$end_date.'" AS date) AND  srvDtls_booking_status = "2" ORDER BY srvDtls_service_start,srvDtls_service_id,srvDtls_employee_id';
        $mainData	=	$this->global_mod->mainBookingStorePro($string,$starting);
        $localDate	= 0;
        
        $finalArr = array();
        foreach($mainData as $key=>$val){
        	$lsDate = date("d-m-Y",strtotime($val['srvDtls_service_start']));
        	$key1=0; 
        	if($localDate != $lsDate){
            	$finalArr[$key]['date'] = $lsDate;
            	$localDate = $lsDate;
            	$localService = '';
            	$keySrv_key = 0; 
            	foreach($mainData as $keySrv=>$valSrv){
            		$lsService = $valSrv['srvDtls_service_id'];
            		if($localService != $lsService && $lsDate== date("d-m-Y",strtotime($valSrv['srvDtls_service_start']))){
	            		$finalArr[$key]['date_datils'][$keySrv_key]['service'] = $lsService;
	            		$localService = $lsService;
	            		$localStaff = '';
	            		$keyStaff_key=0;
	            		foreach($mainData as $keyStaff=>$valStaff){
	            			$lsstaff = $valStaff['srvDtls_employee_id'];	            			
	            			if($lsstaff != $localStaff && $lsDate== date("d-m-Y",strtotime($valStaff['srvDtls_service_start'])) && $lsService ==$valStaff['srvDtls_service_id']){
								$finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff'] = $lsstaff;
								$localStaff = $lsstaff;
								$localEmployee = '';
								$keyEmp_key = 0;
								foreach($mainData as $keyEmp=>$valEmp){
									$lsemploy = $valEmp['srvDtls_employee_id'];									
									if($lsemploy != $localEmployee && $lsDate== date("d-m-Y",strtotime($valEmp['srvDtls_service_start'])) && $lsService ==$valEmp['srvDtls_service_id']){
										$staff_id = isset($valEmp['srvDtls_employee_id'])?$valEmp['srvDtls_employee_id']:0;
							            $booking_id = isset($valEmp['booking_id'])?$valEmp['booking_id']:0;
							            $booking_service_id = isset($valEmp['srvDtls_service_id'])?$valEmp['srvDtls_service_id']:0;
							            $customer_id = isset($valEmp['customer_id'])?$valEmp['customer_id']:0;
							            $service_duration = isset($valEmp['srvDtls_service_duration'])?$valEmp['srvDtls_service_duration']:0;
							            $service_name = isset($valEmp['srvDtls_service_name'])?$valEmp['srvDtls_service_name']:0;
							            $service_duration_unit = isset($valEmp['srvDtls_service_duration_unit'])?$valEmp['srvDtls_service_duration_unit']:0;
							            $service_start_time = isset($valEmp['srvDtls_service_start'])?date("H:i:s",strtotime($valEmp['srvDtls_service_start'])):0;
							            $service_end_time = isset($valEmp['srvDtls_service_end'])?date("H:i:s",strtotime($valEmp['srvDtls_service_end'])):0;
							            $quantity = isset($valEmp['srvDtls_service_quantity'])?$valEmp['srvDtls_service_quantity']:0;
							            
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['bookSrvId'] = intval($booking_service_id);
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['bookId'] = intval($booking_id);
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvId'] = intval($lsService);
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['custId'] = intval($customer_id);
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvDuration'] = intval($service_duration);
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvName'] = $service_name;
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvDurationUnit'] = $service_duration_unit;
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvSrtTime'] = date("g:ia",strtotime($service_start_time));
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvEndTime'] = date("g:ia",strtotime($service_end_time)); 
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvSrtTimeCal'] = $service_start_time;
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvEndTimeCal'] = $service_end_time;
							            $finalArr[$key]['date_datils'][$keySrv_key]['service_details'][$keyStaff_key]['staff_details'][$keyEmp_key]['srvQuantity'] = intval($quantity);
										$lsemploy = $localEmployee;
										$keyEmp_key++;		
									}
								}
								$keyStaff_key++; 
	            			}
	            		}
	            		$keySrv_key++;
					}
            	}
			}
        }
        return $finalArr;
        


    }
   
    public function getServiceList($local_admin_id){
    	if(!empty($local_admin_id)){
			
	        $sql = "SELECT 
	                    distinct ser.* 
	                FROM 
	                    app_biz_hours AS abh, 
	                    app_service AS ser 
	                WHERE 
	                    ser.service_id = abh.service_id AND 
	                    ser.is_active = 'Y' AND
	                    ser.is_hide = 'N' AND
	                    abh.local_admin_id = '".$local_admin_id."'";
	        $query = $this->db->query($sql);
	        $Arr = $query->result_array();
	        return $Arr;
        }else{
			return array();
		}
    }
   
    public function getEmployeeList($local_admin_id){
        $sql = "SELECT 
                    distinct ae.* 
                FROM 
                    app_biz_hours AS abh, 
                    app_employee AS ae 
                WHERE 
                    ae.employee_id = abh.employee_id AND 
                    ae.is_active = 'Y' AND 
                    abh.local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
   
    public function getStaffDetails($day_id,$local_admin_id,$service_id,$staff_id){
	 $mainTable = $this->getCovLocalTable($local_admin_id);
          $sql = "SELECT 
                    abh.time_from , 
                    abh.time_to , 
                    ser.service_capacity 
                 FROM 
                    ( ".$mainTable." ) AS abh, 
                    app_service AS ser 
                 WHERE 
                    ser.service_id = abh.service_id AND 
                    abh.day_id = '".$day_id."' AND
                    abh.service_id = '".$service_id."' AND
                    abh.employee_id = '".$staff_id."' AND
                    abh.local_admin_id = '".$local_admin_id."' 
                 ORDER By time_from
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
       
        $serviceArr = array();
        foreach($Arr as $key=>$val)
        {
            $time_from = isset($val['time_from'])?$val['time_from']:0;
            $time_to = isset($val['time_to'])?$val['time_to']:0;
            $service_capacity = isset($val['service_capacity'])?$val['service_capacity']:0;
            
            $serviceArr[$key]['bookStrTime'] = $time_from;
            $serviceArr[$key]['bookEndTime'] = $time_to; 
            //$serviceArr[$key]['bookMxBooking'] = intval($service_capacity); 
        }
        return $serviceArr;
    }
   
    public function getDistinctEmployee($day_id,$local_admin_id,$service_id){
	$mainTable = $this->getCovLocalTable($local_admin_id);
        $sql = "SELECT distinct employee_id FROM ( ".$mainTable." ) as maintable WHERE day_id = '".$day_id."' AND service_id = '".$service_id."' AND local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        $staffArr = array();
        foreach($Arr as $key=>$val){
               $staff_id = isset($val['employee_id'])?$val['employee_id']:0;
               $staffArr[$key]['staffName'] = $staff_id;
               $staffArr[$key]['staffDtls'] = $this->getStaffDetails($day_id,$local_admin_id,$service_id,$staff_id);     
        }
        return $staffArr;
    }
   
    public function getServiceByDay($day_id,$local_admin_id){
        $mainTable = $this->getCovLocalTable($local_admin_id);
        $sql = "SELECT distinct service_id FROM ( ".$mainTable." ) as maintable WHERE 
                   day_id = '".$day_id."' AND 
                   local_admin_id = '".$local_admin_id."' ORDER BY service_id    
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        $ServiceArr = array();
        foreach($Arr as $key=>$val){
            $service_id = isset($val['service_id'])?$val['service_id']:0;
            $staffArr = $this->getDistinctEmployee($day_id,$local_admin_id,$service_id);
            $ser_sql = "SELECT service_capacity FROM app_service WHERE service_id = '".$service_id."'";
            $ser_query = $this->db->query($ser_sql);
            $ser_arr = $ser_query->result_array();
            $ServiceArr[$key]['srvName'] = $service_id;
            $ServiceArr[$key]['bookMxBooking'] = $ser_arr[0]['service_capacity'];
            $ServiceArr[$key]['srvDtls'] = $staffArr;
        }
        return $ServiceArr; 
    }
   
    public function localTimeCalc(){
        $timeDiff = $this->global_mod->gmtDifference(); // -
        $offset = substr($timeDiff,0,1);
        $timeval  = substr($timeDiff,1);
        $timeval  = $this->secToHour($timeval);
        if($offset=='-')
            $timeval  = '-'.$timeval;
        return $timeval;
    }
    
    public function getCovLocalTable($local_admin_id){
        $localTimeDiff = $this->localTimeCalc(); 	
        $sql = "Select biz_hours_id, service_id, local_admin_id, employee_id, 
             if(ADDTIME(time_from,'".$localTimeDiff."')>='24:00:00',ADDTIME( ADDTIME(time_from,'".$localTimeDiff."'),'-24:00:00'), ADDTIME(time_from,'".$localTimeDiff."')) time_from, 
             if(ADDTIME(time_to,'".$localTimeDiff."')>='24:00:00',ADDTIME(ADDTIME(time_to,'".$localTimeDiff."'),'-24:00:00'), ADDTIME(time_to,'".$localTimeDiff."')) time_to, 
             if(ADDTIME(time_from,'".$localTimeDiff."')>='24:00:00',if(day_id=7,1,day_id+1), day_id) day_id from app_biz_hours WHERE local_admin_id = '".$local_admin_id."'";
        return $sql; 
    }
   
    public function getBusinessHourList($local_admin_id){
	$mainTable = $this->getCovLocalTable($local_admin_id);
	$sql = "SELECT distinct day_id FROM ( ".$mainTable." ) as maintable WHERE local_admin_id = '".$local_admin_id."' ORDER BY day_id,service_id,employee_id";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();

        foreach($Arr as $key=>$val){
            $temp_day = $val['day_id'];
            $serviceArr = $this->getServiceByDay($val['day_id'],$local_admin_id);
            $finalArr[$key]['noOfDay'] = intval($val['day_id']);
            $finalArr[$key]['noOfDay_datils'] = $serviceArr;
        }
        return $finalArr;
    }
   
    public function getAdminAddress(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql = "SELECT alm.business_name,alm.business_phone,alm.business_location,ac.city_name,ar.region_name,acon.country_name,alm.business_zip_code 
                FROM 
                    app_local_admin AS alm,
                    app_cities AS ac,
                    app_regions AS ar,
                    app_countries AS acon
                WHERE 
                    alm.local_admin_id = '".$local_admin_id."' AND 
                    ac.city_id = alm.business_city_id AND 
                    ar.region_id = alm.business_state_id AND 
                    acon.country_id = alm.country_id
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function checkStaffFromBizHour($bookTime,$service_id){
        $choosen_time = $this->ConvToGmttime("H:i:s",$bookTime);
        $choosen_day = date("N",$bookTime);
        $sql = "SELECT employee_id  FROM app_biz_hours 
            WHERE 
                day_id = '".$choosen_day."' AND 
                service_id = '".$service_id."' AND 
                time_from <= '".$choosen_time."' AND 
                time_to > '".$choosen_time."'
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
   
    public function getTempBooking($bookTime,$serviceId){
        $choosen_day = date("Y-m-d",$bookTime);
        $choosen_time = date("H:i:s",$bookTime);
        $this->db->select('count(*) as number');
        $this->db->from('app_temp_booking');
        $this->db->where('service_id', $serviceId);
        $this->db->where('booking_date', $choosen_day); 
        $this->db->where('booking_time', $choosen_time); 
        $query = $this->db->get();
        $Arr = $query->result_array();
        $noOfTempBooking = empty($Arr)?0:$Arr[0]['number'];
        return $noOfTempBooking;
    }
    
    public function getNoOfBooking($bookTime,$serviceId){
        $choosen_time = date("Y-m-d H:i:s",$bookTime);
        $sql = "SELECT sum(srvDtls_service_quantity) as number FROM app_booking_service_details  
            WHERE 
                srvDtls_service_id = '".$serviceId."' AND   
                srvDtls_service_start = '".$choosen_time."'
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        $quantity = empty($Arr)?0:$Arr[0]['number'];
        return $quantity;
    }
   
    public function getServiceCapacity($serviceId){
        $sql = "SELECT service_capacity FROM app_service WHERE service_id = '".$serviceId."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['service_capacity'];
    }

    public function getnoOfOtherBooking($serviceId,$scheduledTime,$staffId){
	if (is_array($serviceId))
	{
		$serviceId = $serviceId[0]['service_id'];
	}
	
        $sql = "SELECT 
                    count(*) AS number 
                FROM 
                    app_booking_service_details 
                WHERE 
                    srvDtls_service_id != '".$serviceId."' AND 
                    srvDtls_employee_id = '".$staffId."' AND 
                    srvDtls_service_start <= '".$scheduledTime."' AND 
                    srvDtls_service_end > '".$scheduledTime."' AND 
                    srvDtls_booking_status = 2
                ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['number'];
    }
    
    public function checkStaffFromTemp($bookTime,$employee_id,$serviceId){
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("Y-m-d",$bookTime);
        $sql = "SELECT count(*) as no_staff_in_temp FROM app_temp_booking 
            WHERE 
                staff_id = '".$employee_id."' AND 
                service_id = '".$serviceId."' AND 
                booking_date = '".$choosen_day."' AND 
                booking_time = '".$choosen_time."'
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['no_staff_in_temp'];
    }
   
    public function checkStaffFromBlockDate($bookTime,$employee_id){
        $choosen_day = date("Y-m-d",$bookTime);
        $sql = "SELECT count(*) as no_staff_in_block_date FROM app_staff_unavailable 
            WHERE 
                employee_id = '".$employee_id."' AND 
                block_date LIKE '%".$choosen_day."%'
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['no_staff_in_block_date'];
    }
   
    public function checkStaffFromBlockTime($bookTime,$employee_id){
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("Y-m-d",$bookTime);
        $sql = "SELECT count(*) as no_staff_in_block_time FROM app_staff_unavailable_time 
            WHERE 
                date = '".$choosen_day."' AND 
                employee_id = '".$employee_id."' AND 
                time_form <= '".$choosen_time."' AND 
                time_to > '".$choosen_time."'
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['no_staff_in_block_time'];
    }
     
    public function getCountry(){
        $sql_country = "SELECT country_id,country_name FROM app_countries WHERE is_active = 'Y' ORDER BY country_name";
        $query = $this->db->query($sql_country);
        $countryArr = $query->result_array();
        return $countryArr;
    }
    
    public function getRegion($country_id){
        $sql_reg = "SELECT region_id,region_name FROM app_regions WHERE is_actives = 'Y' AND country_id = '".$country_id."'";
        $query = $this->db->query($sql_reg);
        $regArr = $query->result_array();
        return $regArr;
    }
   
    public function getCity($region_id){
        $sql_city = "SELECT city_id,city_name FROM app_cities WHERE is_active_s = 'Y' AND region_id = '".$region_id."'";
        $query = $this->db->query($sql_city);
        $cityArr = $query->result_array();
        return $cityArr;
    }
    
    public function getTimeZone(){
        $sql_tz = "SELECT time_zone_id,time_zone_name FROM app_time_zone WHERE is_active = 'Y' ORDER BY time_zone_order";
        $query = $this->db->query($sql_tz);
        $tzArr = $query->result_array();
        return $tzArr;
    }
   
    public function getServiceName($serviceArr){
    	
        $noOfService = count($serviceArr);
        $counter = 1;
       	$serList = '';
        if($noOfService > 0 && is_array($serviceArr)){
        	if($noOfService == 1){
				$sign = '=';
			}else{
				$sign = 'in';
				$serList = '(';
			}
        	
			
			
	        foreach($serviceArr as $val){
	            $serList .= $val;
	            if($counter != $noOfService){
	                 $serList .= ",";
	            }
	            $counter++;
	        }
	        if($noOfService != 1){
				$serList .= ')';
			}
			
	        $sql = "SELECT 
							service_id,
							service_name,
							service_cost,
							service_capacity,
							service_duration_min 
					FROM 
							app_service 
					WHERE 
							service_id ".$sign.$serList;
							
	        $query = $this->db->query($sql);
	        $result = $query->result_array();
	        return $result;
        }else{
			return array();
		}
    }
    
    public function getServiceNameList($service){
        $sql = "SELECT service_id,service_name,service_cost,service_capacity,service_duration_min FROM app_service WHERE service_id = '".$service."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
	
    public function getEmployeeName($employee_id,$local_admin_id){
	$sql = "SELECT 
                    employee_name
                FROM 
                    app_employee AS ae 
                WHERE 
                  ae.is_active = 'Y' AND 
			      ae.employee_id = '".$employee_id."' AND 
                  ae.local_admin_id = '".$local_admin_id."'";
				  
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return isset($Arr[0]['employee_name'])?$Arr[0]['employee_name']:'';
    }	
   
    public function insertInTempTable($service,$staff,$time,$bookTime,$customer_id){
    	
    	$sql_city = "DELETE FROM app_temp_booking WHERE DATE_SUB(insert_time,INTERVAL 15 MINUTE)< cast('".gmdate('Y-m-d H:i:s')."' AS date)";
        $this->db->query($sql_city);
    	
        $data = array(
            'service_id' => $service,
            'staff_id' => $staff,
            'booking_date' => date("Y-m-d",$bookTime),
            'booking_time' => $time,
            'customer_id' => $customer_id,
            'delete_time' => date("Y-m-d H:i:s",$bookTime),
            'insert_time' => gmdate("Y-m-d H:i:s")
        );
        $this->db->insert('app_temp_booking', $data); 
        return $this->db->insert_id();
    }
	
    public function genaretTempRecurringId($service,$staff,$bookingTime){	
        $customer_id = $this->session->userdata('user_id_customer');
        $data = array(
            'service_id' => $service,
            'staff_id' => $staff,
            'booking_date' => date("Y-m-d",strtotime($bookingTime)),
            'booking_time' => date("H:i",strtotime($bookingTime)),
            'customer_id' => $customer_id,
            'delete_time' => date("Y-m-d H:i:s",strtotime($bookingTime)),
            'insert_time' => gmdate("Y-m-d H:i:s")
        );
        $this->db->insert('app_temp_booking', $data); 
        return $this->db->insert_id();
    }        
    
    public function GetLocalAdmin(){
        $url = $_SERVER['HTTP_HOST'];
        $url_arr = explode(".",$url);
        $this->db->select('user_id');
        $this->db->from('app_password_manager');
        $this->db->where('user_name', $url_arr[0]);
        $query = $this->db->get();
        $LocalAdminArr = $query->result_array();
        return $LocalAdminArr[0]['user_id'];
    }
    
    public function mod_checkNumberOfBooking($bookTime,$period){
   //     $user_session = $this->session->userdata('user_id_customer');
  //      $user_id = $user_session['user_id_customer'];
         $user_id = $this->session->userdata('user_id_customer');
        $local_admin_id = $this->GetLocalAdmin();
        switch ($period) {
            case 3:
                $type = "day.";
                $where = " AND date_format(booking_date_time,'%Y-%m-%d') = '".date('Y-m-d')."'";
                break;
            case 4:
                $type = "week.";
                $adminSettingsArr = $this->getFrontEndSettings($local_admin_id);
                $startingweekdayfrmadmin = $adminSettingsArr[0]['calStrtingWeekday'];
                if($startingweekdayfrmadmin == 1)//    WEEK START DAY CURRENT DATE
                {
                    $weekstartdate = date("Y-m-d");
                    $weekenddate_timestamp = strtotime($weekstartdate)+6*24*60*60;
                    $weekenddate = date("Y-m-d",$weekenddate_timestamp);
                }
                elseif($startingweekdayfrmadmin == 2)//    WEEK START DAY SUNDAY
                {
                    $weekstartdate_timestamp = strtotime('last Sunday', $bookTime);
                    $weekstartdate = date("Y-m-d",$weekstartdate_timestamp);
                    $weekenddate_timestamp = $weekstartdate_timestamp+6*24*60*60;
                    $weekenddate = date("Y-m-d",$weekenddate_timestamp);
                }
                else// WEEK START DAY MONDAY
                {
                    $weekstartdate_timestamp = strtotime('last monday', $bookTime);
                    $weekstartdate = date("Y-m-d",$weekstartdate_timestamp);
                    $weekenddate_timestamp = $weekstartdate_timestamp+6*24*60*60;
                    $weekenddate = date("Y-m-d",$weekenddate_timestamp);
                }
                //$where = " AND service_start_dt >= '".$weekstartdate."' AND service_start_dt < '".$weekenddate."'";
                $where = " AND date_format(booking_date_time,'%Y-%m-%d') >= '".$weekstartdate."' AND date_format(booking_date_time,'%Y-%m-%d') < '".$weekenddate."'";
                break;
            case 5:
                $type = "month.";
                $month = date("m",$bookTime);
                $year = date("Y",$bookTime);
                $lastdayofmonth = date('t',$bookTime);
                $startdateofmonth = $year."-".$month."-"."01";
                $enddateofmonth = $year."-".$month."-".$lastdayofmonth;
                //$where = " AND service_start_dt >= '".$startdateofmonth."' AND service_start_dt < '".$enddateofmonth."'";
                $where = " AND date_format(booking_date_time,'%Y-%m-%d') >= '".$startdateofmonth."' AND date_format(booking_date_time,'%Y-%m-%d') < '".$enddateofmonth."'";
                break;
            case 6:
                $type = "year.";
                $year = date("Y",$bookTime);
                $startdayofyear = "01-01-".$year;
                $lastdayofyear = "31-12-".$year;
                //$where = " AND service_start_dt >= '".$startdayofyear."' AND service_start_dt < '".$lastdayofyear."'";
                $where = " AND date_format(booking_date_time,'%Y-%m-%d') >= '".$startdayofyear."' AND date_format(booking_date_time,'%Y-%m-%d') < '".$lastdayofyear."'";
                break;
        }
        $sql = "SELECT count(*) AS number
             FROM
                app_booking
             WHERE customer_id = $user_id ".$where."
                ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        $noOfBooking = $Arr[0]['number'];
        return $noOfBooking;
    }
    
    public function getServiceDetails($service_id){
        $this->db->select('*');
        $this->db->from('app_service');
        $this->db->where('service_id', $service_id);
        $query = $this->db->get();
        $serviceDetailsArr = $query->result_array();
        return $serviceDetailsArr;
    }
   
    public function checkTempTable($temp_id){
        $this->db->where('temp_id', $temp_id);
        $this->db->from('app_temp_booking');
        $count = $this->db->count_all_results();
        return $count;
    }
   
    public function saveBookingData($returnArr){
    	
    	
    	$arr = json_decode($returnArr['addtional_data']);
    	
    	//echo "<pre>";
    	//print_r($this->global_mod->db_parse($arr));
    //	echo "</pre>";
    //	exit;
    	
        $success = 0;
        $booking_sub_total = isset($returnArr['subtotal'])?$returnArr['subtotal']:0;
        $currency_id    = $this->session->userdata('local_admin_ses_currency_id');
        $booking_disc_amount =0;
        $booking_disc_coupon_details ='';
        $booking_total_tax = isset($returnArr['taxtotal'])?$returnArr['taxtotal']:0;
        $booking_grnd_total = isset($returnArr['total'])?$returnArr['total']:0;
        $booking_prepayment_amount=0;
        $booking_prepayment_details='';
        $booking_comment ='';
        $booking_is_deleted=0;
        $booking_tax_dtls_arr = serialize( isset($returnArr['tax_details'])?$returnArr['tax_details']:array());

        $local_admin_id = $this->session->userdata('local_admin_id');
        $booking_grnd_total = ($booking_sub_total+$booking_total_tax)-$booking_disc_amount;
        $booking_date_time = gmdate('Y-m-d H:i:s');
        $customer_id = $this->session->userdata('user_id_customer');
        $data_added         = gmdate('Y-m-d H:i:s');
        $date_edited        = gmdate('Y-m-d H:i:s');
		
		$added_by = $this->session->userdata('user_id_customer') != NULL ? 1 : 3 ;
		
        $insert_app_booking = array(
            'local_admin_id'                => $local_admin_id,
            'booking_date_time'             => $booking_date_time,
            'customer_id'                   => $customer_id,
            'currency_id'                   => $currency_id,
            'booking_sub_total'             => $booking_sub_total,
            'booking_disc_amount'           => $booking_disc_amount,
            'booking_disc_coupon_details'   => $booking_disc_coupon_details,
            'booking_total_tax'             => $booking_total_tax,
            'booking_tax_dtls_arr'          => $booking_tax_dtls_arr,
            'booking_grnd_total'            => $booking_grnd_total,
            'booking_prepayment_amount'     => $booking_prepayment_amount,
            'booking_prepayment_details'    => $booking_prepayment_details,
            'booking_comment'               => $booking_comment,
            'added_by'						=> $added_by,
            'booking_from'					=> $returnArr['device_type'],
            'data_added'                    => $data_added,
            'date_edited'                   => $date_edited,
            'booking_is_deleted'            => '0'
        );
        
        $this->db->insert('app_booking', $insert_app_booking);
        $booking_id = $this->db->insert_id();
        
        $item_detailsArr = isset($returnArr['item_details'])?$returnArr['item_details']:array();

        foreach($item_detailsArr as $val){
            $service_id = $val['service_id'];
            $employee_id = $val['service_staff'];
            $service_capacity = $val['service_capacity'];
			$temp_id = ($val['temp_id']=='')? 0: $val['temp_id'] ;
			$service_date = $val['service_date'];
            $service_start_time = $val['service_time'];
            $service_start_timestamp = strtotime($service_start_time);
            //$employee_name
            if($this->checkTempTable($temp_id)>0){
                $serviceDetailsArr = $this->getServiceDetails($service_id);
                $Item_sub_cost = $serviceDetailsArr[0]['service_cost'];
                $service_name = $serviceDetailsArr[0]['service_name'];
                $service_duration = $serviceDetailsArr[0]['service_duration'];
                $service_duration_unit = $serviceDetailsArr[0]['service_duration_unit'];
                $service_description = $serviceDetailsArr[0]['service_description'];
                $service_duration_min = $serviceDetailsArr[0]['service_duration_min'];
                $service_end_timestamp = $service_start_timestamp + $service_duration_min*60;
                $service_end_time = date("H:i:s",$service_end_timestamp);
                
                /*####################*/
                $srvDtls_service_start = $service_date." ".$service_start_time;
                $srvDtls_service_end = $service_date." ".$service_end_time;
                /*####################*/

                $local_admin_id = $this->session->userdata('local_admin_id');
                $this->db->select('time_zone_id');
                $this->db->from('app_local_admin');
                $this->db->where('local_admin_id', $local_admin_id);
                $query = $this->db->get();
                $row = $query->row();
                $time_zone_id=$row->time_zone_id;
                $booking_date_time = date('Y-m-d H:i:s');
                $customer_id = $this->session->userdata('user_id_customer');
                $data_added         = gmdate('Y-m-d H:i:s');
                $date_edited        = gmdate('Y-m-d H:i:s');
                $srvDtls_status_date = gmdate('Y-m-d H:i:s');
                $employee_name = $this->getEmployeeName($employee_id,$local_admin_id);
                $insert_app_booking_service = array(
                    'srvDtls_booking_id'            => $booking_id,
                    'srvDtls_service_id'            => $service_id,
                    'srvDtls_service_name'          => $service_name,//
                    'srvDtls_service_cost'          => $Item_sub_cost,//
                    'srvDtls_service_duration'      => $service_duration,//
                    'srvDtls_service_duration_unit' => $service_duration_unit,//
                    'srvDtls_service_start'         => $srvDtls_service_start,//$service_date
                    'srvDtls_service_end'           => $srvDtls_service_end,//$service_date
                    'srvDtls_employee_id'           => $employee_id,//
                    'srvDtls_employee_name'         => $employee_name,
                    'srvDtls_booking_status'        => 2,
                    'srvDtls_status_date'           => $srvDtls_status_date,
                    'srvDtls_service_quantity'      => $service_capacity,
                    'srvDtls_service_description'   => $service_description//
                );
                $this->db->insert('app_booking_service_details',$insert_app_booking_service);
                $insert_id=$this->db->insert_id();
                if($insert_id > 0)
                {
                    $success++;
                    $this->db->where('temp_id', $temp_id);
                    $this->db->delete('app_temp_booking');
                  //  return 1;
                }
            }
        }
        /*****      QUERY TO CHECK EXISTANCE IN RELATION TABLE STARTS       *****/
        $this->db->where('local_admin_id', $local_admin_id);
        $this->db->where('customer_id', $customer_id);
        $this->db->from('app_customer_admin_relationship');
        $relation_count = $this->db->count_all_results();
        /*****      QUERY TO CHECK EXISTANCE IN RELATION TABLE ENDS     *****/
        /*****      QUERY TO INSERT RELATION TABLE STARTS       *****/
        if($relation_count == 0){
            $insert_app_customer_admin_relationship = array(
                       'local_admin_id'  => $local_admin_id,
                       'customer_id'     => $customer_id
                    );
            $this->db->insert('app_customer_admin_relationship', $insert_app_customer_admin_relationship);
        }
        /*****      QUERY TO INSERT RELATION TABLE ENDS     *****/
        
      if(isset($arr) && !empty($arr)){
	  	 $sql = '';
    	foreach($arr as $val){
			
			$sql .= 'INSERT INTO app_pre_booking_customer_details ';
			$sql .= '(pre_booking_field_name,pre_booking_field_value,customer_id,local_admin_id,booking_id) VALUES ';
			$sql .= '("'.trim($val->postName).'","'.trim($val->postValue).'",'.$customer_id.','.$local_admin_id.','.$booking_id.');';
			$a = $this->db->query($sql);
        	$sql = '';
		}
	  }
		//echo $sql;
		//exit;
    	
        
    	
        if($success > 0){
        	
            return $booking_id;
        }else{
            return 0;
        }
    }
   
    public function getPastBookingData(){
        $customer_id = $this->session->userdata('user_id_customer');
        $str = '';
        $str .= ' AND customer_id = '.$customer_id;
        $str .= ' AND srvDtls_service_start < now()';
        $sql1=$this->global_mod->mainBookingStorePro($str);
        return $sql1;
    }
    
    public function getNextBookingData(){
        $customer_id = $this->session->userdata('user_id_customer');
        $str = '';
        $str .= ' AND customer_id = '.$customer_id;
        $str .= ' AND srvDtls_service_start >= now()';
        $str .= ' AND srvDtls_booking_status != 5';
        $str .= ' AND srvDtls_booking_status != 4';
        $str .= ' ORDER BY srvDtls_service_start DESC';
        $Arr=$this->global_mod->mainBookingStorePro($str);
        return $Arr;
    }
    
    public function dependent($local_admin_id){
        $sql = "SELECT distinct dependent_service_id FROM app_dependency WHERE local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function non_dependent($local_admin_id){
        $sql = "SELECT distinct non_dependent_service_id FROM app_dependency WHERE local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function checkWhetherStaffAvailable($bookTime,$staff,$service){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("N",$bookTime);
        $sql = "SELECT count(*) AS number 
            FROM 
                app_biz_hours 
            WHERE 
                employee_id = '".$staff."' AND 
                service_id = '".$service."' AND 
                day_id = '".$choosen_day."' AND 
                local_admin_id = '".$local_admin_id."' AND 
                time_from <= '".$choosen_time."' AND 
                time_to > '".$choosen_time."'
               ";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr[0]['number'];
    }
   
    public function checkStaffAvailability($bookTime,$serviceId){
        $local_admin_id = $this->GetLocalAdmin();
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("N",$bookTime);
        $sql = "SELECT 
                    count(employee_id) as number 
                FROM 
                    app_biz_hours 
                WHERE 
                    day_id = '".$choosen_day."' AND 
                    local_admin_id = '".$local_admin_id."' AND     
                    service_id = '".$serviceId."' AND 
                    time_from <= '".$choosen_time."' AND 
                    time_to > '".$choosen_time."'
                ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result[0]['number'];
    }
   
    public function getAvailableStaff($bookTime,$serviceId){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("N",$bookTime);
        $sql = "SELECT employee_id 
            FROM 
                app_biz_hours
            WHERE 
                service_id = '".$serviceId."' AND 
                local_admin_id = '".$local_admin_id."' AND     
                day_id = '".$choosen_day."' AND 
                time_from <= '".$choosen_time."' AND 
	        time_to > '".$choosen_time."'
               ";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    
    public function getAvailableStaffDatewise($bookTime,$serviceId){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $choosen_day = date("N",$bookTime);
        $sql = "SELECT employee_id 
            FROM 
                app_biz_hours
            WHERE 
                service_id = '".$serviceId."' AND 
                local_admin_id = '".$local_admin_id."' AND     
                day_id = '".$choosen_day."' 
               ";
        $query = $this->db->query($sql);
        $result = $query->result_array(); 
        return $result;
    }
    
    public function getBusinessHour($bookTime,$employee_id,$serviceId){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("N",$bookTime);
        $array = array(
                        'employee_id' => $employee_id,
                        'service_id' => $serviceId,
                        'day_id' => $choosen_day,
                        'local_admin_id' => $local_admin_id, 
                        'time_from <=' => $choosen_time, 
                        'time_to >' => $choosen_time
                      );
        $this->db->select('employee_id, time_from, time_to');
        $this->db->from('app_biz_hours');
        $this->db->where($array);
        $query = $this->db->get();
        $result = $query->result_array(); 
        /*
        print_r($result);
        */
        if(count($result) > 0)
        {
            $timeFrom = strtotime($result[0]['time_from']);
            $timeTo = strtotime($result[0]['time_to']);
            $workingHour = round(($timeTo - $timeFrom) / 60);
            return $workingHour;
        }
        else
        {
            return 0;
        }
    }
    
    public function getMostFreeStaffTimewise($bookTime){
        $hour = 999999999;
        $employeeArr = $this->getAvailableStaffDatewise($bookTime,$serviceId);
        foreach($employeeArr as $val){
            $workingHour = $this->getBusinessHour($bookTime,$val['employee_id'],$serviceId);
            if($hour > $workingHour && $workingHour != 0){
                $hour = $workingHour;
                $employeeId = $val['employee_id'];
            }
        }
        return $employeeId;        
    }
    
    public function getMostFreeStaffAppointmentwise($bookTime,$serviceArr){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $date = date("Y-m-d",$bookTime);
        $employeeArr = $this->getAvailableStaff($bookTime,$serviceId);
        $count = 999999999;
        foreach($employeeArr as $val){
            $this->db->where('service_start_dt', $date);
            $this->db->where('local_admin_id', $local_admin_id);
            $this->db->where('employee_id',$val['employee_id']);
            $this->db->from('app_booking_service');
            $noOfBooking = $this->db->count_all_results();
            if($count > $noOfBooking){
                $count = $noOfBooking;
                $employee_id = $val['employee_id'];
            }
        }
        return $employee_id;
    }
   
    public function getMostBusyStaffTimewise($bookTime){
        $hour = 0;
        $employeeArr = $this->getAvailableStaffDatewise($bookTime,$serviceId);
        foreach($employeeArr as $val){
            $workingHour = $this->getBusinessHour($bookTime,$val['employee_id'],$serviceId);
            if($hour < $workingHour && $workingHour != 0){
                $hour = $workingHour;
                $employeeId = $val['employee_id'];
            }
        }
        return $employeeId;
    }
    
    public function getMostBusyStaffAppointmentwise($bookTime){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $date = date("Y-m-d",$bookTime);
        $employeeArr = $this->getAvailableStaff($bookTime,$serviceId);
        $count = 0;
        foreach($employeeArr as $val){
            $this->db->where('service_start_dt', $date);
            $this->db->where('local_admin_id', $local_admin_id);
            $this->db->where('employee_id',$val['employee_id']);
            $this->db->from('app_booking_service');
            $noOfBooking = $this->db->count_all_results();
            if($count <= $noOfBooking){
                $count = $noOfBooking;
                $employee_id = $val['employee_id'];
            }
        }
        return $employee_id;
    }
    
    public function getStaffDisplaywise($bookTime){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $employeeArr = $this->getEmployeeList($local_admin_id);
        $choosen_time = date("H:i:s",$bookTime);
        $choosen_day = date("N",$bookTime);
        foreach($employeeArr as $val){
            $sql = "SELECT 
			count(employee_id) as number 
                    FROM 
			app_biz_hours 
	            WHERE 
	                day_id = '".$choosen_day."' AND 
                        employee_id = '".$val['employee_id']."' AND     
                        local_admin_id = '".$local_admin_id."' AND     
	                service_id = '".$staffArrOrServiceId."' AND 
	                time_from <= '".$choosen_time."' AND 
	                time_to > '".$choosen_time."'
	               ";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            if($result[0]['number']==1){
                return $val['employee_id'];
                break;
            }
        }
    }
    
    public function getReviewTabData($local_admin_id){
	    return $local_admin_id;
    }
    
    public function deleteBookingData($returnArr){
        foreach($returnArr as $key=>$val){
            $this->db->where('temp_id', $val);
            $this->db->delete('app_temp_booking'); 
        }
    }
    
    public function getTaxDetails($local_admin_id){
        $sql = "(SELECT b.tax_title tax_title, a.tax_rate tax_rate from app_tax_local_admin a, app_tax_master b Where a.tax_master_id= b.tax_master_id AND a.local_admin_id='".$local_admin_id."' AND a.tax_master_id !=0) 
            UNION
            (SELECT not_in_list_title tax_title , tax_rate tax_rate from app_tax_local_admin  Where local_admin_id='".$local_admin_id."' AND tax_master_id =0)";
        $query = $this->db->query($sql);
        $result = $query->result_array(); 
        return $result;
    }
   
    public function getPaymentGateways($local_admin_id){
        $sql = "SELECT distinct(a.payment_gateways_id), b.payment_gateways_name from app_payment_gateways_values a, app_payment_gateways b
                    where
                    b.payment_gateways_id = a.payment_gateways_id and
                    b.type in (1,2) and 
                    b.status = 1 and
                    a.local_admin_id = '".$local_admin_id."'
                    order by b.payment_gateways_order
        ";
        $query = $this->db->query($sql);
        $result = $query->result_array(); 
        return $result;
    }
	
    public function getLocalAdminEmail(){
        $local_admin_id =  $this->session->userdata('local_admin_id');
        $this->db->select('user_email');
        $this->db->from('app_password_manager');
        $this->db->where('user_id',$local_admin_id);
        $this->db->where('user_type','3');
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr[0]['user_email'];  
    } 
    
    public function getReviewList(){
	$local_admin_id =  $this->session->userdata('local_admin_id');
        $custQry ="Select * from (
        ( SELECT *  FROM app_review WHERE local_admin_id ='".$local_admin_id."' AND is_approve = '1') first_table 

        LEFT JOIN  
        ( SELECT distinct c1.user_id as  user_id,
                c2.local_admin_id as local_admin_id ,
                        c2.customer_id as customer_id ,
                        c1.date_creation as date_inserted,
                        c1.user_email as user_email,

               ( SELECT v1.value
                   FROM app_local_customer_details v1 
                   JOIN app_local_clint_signup_info a1
                     ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_fname'
                  WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
               ) AS cus_fname,

               ( SELECT v1.value
                   FROM app_local_customer_details v1 
                   JOIN app_local_clint_signup_info a1
                     ON a1.sign_upinfo_item_id 	 = v1.sign_upinfo_item_id  AND a1.info_item_name = 'cus_lname'
                  WHERE v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
               ) AS cus_lname,

               ( SELECT ci.city_name
                   FROM app_local_customer_details v1, app_local_clint_signup_info a1, app_cities ci
                   WHERE a1.sign_upinfo_item_id = v1.sign_upinfo_item_id  
                   AND ci.city_id = v1.value 
                   AND a1.info_item_name = 'cus_cityid'
                   AND v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
               ) AS cus_city,

               ( SELECT r1.region_name
                   FROM app_local_customer_details v1, app_local_clint_signup_info a1, app_regions r1
                   WHERE a1.sign_upinfo_item_id = v1.sign_upinfo_item_id 
                   AND r1.region_id = v1.value 
                   AND a1.info_item_name = 'cus_regionid'
                   AND v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
               ) AS cus_region,

               ( SELECT c1.country_name
                   FROM app_local_customer_details v1, app_local_clint_signup_info a1, app_countries c1
                   WHERE a1.sign_upinfo_item_id = v1.sign_upinfo_item_id 
                   AND c1.country_id = v1.value
                   AND a1.info_item_name = 'cus_countryid'
                   AND v1.local_admin_id  = c2.local_admin_id and v1.customer_id =c1.user_id ORDER BY 1 LIMIT 1
               ) AS cus_country

          FROM app_password_manager c1 INNER JOIN
               app_local_customer_details c2 
                   where c1.user_type ='1' and 
                         c1.user_id=c2.customer_id and
                                 c2.local_admin_id  ='".$local_admin_id."'
           ) as maintable ON first_table.posted_by = maintable.customer_id)";

        $query = $this->db->query($custQry);
        $Arr = $query->result_array();
	return $Arr;
    }
    
    public function getStaffByServiceBiz($local_admin_id,$service_id){
        $sql = "SELECT distinct employee_id 
            FROM 
                app_biz_hours 
            WHERE 
                service_id = '".$service_id."' AND 
                local_admin_id = '".$local_admin_id."'";
        $query = $this->db->query($sql);
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function getAllBusinessHour($local_admin_id){
        $this->db->select('biz_hours_id, day_id, time_from, time_to, employee_id, service_id, continuation_id');
        $this->db->from('app_biz_hours');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function returnCoutinuationDetails($continuation_id){
        $this->db->select('biz_hours_id, service_id, employee_id, day_id, time_from, time_to');
        $this->db->from('app_biz_hours');
        $this->db->where('continuation_id',$continuation_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    }
    
    public function getCurrencyFormat($local_admin_id){
        $this->db->select('currency_format_id');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    }

    public function getALLTemplate(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_design_offer');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $NumRowsSi =  $query->num_rows();
        if($NumRowsSi > 0){
            $template =  $query->result_array();
            $template_id=$template[0]['template_id'];
        }else{
            $template_id=1;		
        }		
        $this->db->select('*');
        $this->db->from('app_offer_template');
        $this->db->where('is_active', '1');
        $this->db->where('template_id', $template_id);
        $query = $this->db->get();
        return $template =  $query->result_array();		
    }  
	
    public function getDesignOffer(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('*');
        $this->db->from('app_design_offer');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $NumRowsSi =  $query->num_rows();
        if($NumRowsSi > 0){
            return $template =  $query->result_array();
        }else{
            return $template =  "";			
        }		
    }
	
    public function applyCouponCode($couponCode,$bookingDetails,$booking_grand_total,$grndtotal){
		   
		$bookingDetails 	= 	json_decode(json_encode($bookingDetails), true);
		$today    			= 	gmdate("Y-m-d"); 
		$toTimeGmt    		= 	gmdate("Y-m-d H:i:s"); 
		$local_admin_id 	= 	$this->session->userdata('local_admin_id');
		$cus_id 			= 	$this->session->userdata('user_id_customer');
		$message			=	'';
		$time_difference	=	$this->session->userdata('time_difference');
		//echo $toTime;exit;
	   if (strpos($time_difference,'-') !== false) {	   
	   		$time_difference		=	str_replace("-","",$time_difference);
			$time_difference_arr	=	explode(":",$time_difference);
			$diff					=	($time_difference_arr[0]*60*60)+($time_difference_arr[1]*60)+$time_difference_arr[2];
			$timestamp 				= 	strtotime($toTimeGmt) - $diff ;
			$toTime 				= 	date('H:i:s', $timestamp);
		}
		else{
			//echo $time_difference;exit;
			$time_difference_arr	=	explode(":",$time_difference);
			$diff					=	($time_difference_arr[0]*60*60)+($time_difference_arr[1]*60)+$time_difference_arr[2];
			$timestamp 				= 	strtotime($toTimeGmt) + $diff ;
			$toTime 				= 	date('H:i:s', $timestamp);
			//echo $toTime;exit;
		}
			  
		
	   	$this->db->select('*');
		$this->db->from('app_coupon');
		$this->db->where('coupon_code', $couponCode);
		$this->db->where('local_admin_id', $local_admin_id);
		$this->db->where('status', 1);
		$this->db->where('acitive', 1);		
		$query = $this->db->get();
		$row 		= 	$query->row();
		$NumRows 	=  	$query->num_rows();
		//echo $this->global_mod->localTimeReturn($row->aplcbl_date_to);exit;
		if($NumRows > 0)
		{			
			if($row->coupon_works_over !='0'){
				$coupon_works_over	=	$row->coupon_works_over;							
					if( $booking_grand_total <= $coupon_works_over ){
						$message	.=	"<li>This coupon is only applicable for booking over ".$this->session->userdata('local_admin_currency_type')." ".$this->global_mod->currencyFormat($coupon_works_over)."</li>";
					}
			}		
			
			if($row->applicbl_services_for !='0'){
				$applicbl_services_for_arr	=	unserialize($row->applicbl_services_for);							
				foreach($bookingDetails as $book){
					if(!in_array($book['service_id'],$applicbl_services_for_arr)){
						$message	.=	"<li>This coupon is only applicable for ".$this->applyCouponService($applicbl_services_for_arr)."</li>";
						break;
					}
				}
			}			
			
			if($row->aplcbl_emp !='0'){
				$aplcbl_emp_arr		=	unserialize($row->aplcbl_emp);							
				foreach($bookingDetails as $book){
					if(!in_array($book['service_staff'],$aplcbl_emp_arr)){
						$message	.=	"<li>This coupon is only applicable for ".$this->applyCouponStaff($aplcbl_emp_arr)."</li>";
						break;
					}
				}
			}
			
			/* #######from date#####*/
			if($row->aplcbl_date_from !='0'){			
				$aplcbl_date_from	=	$row->aplcbl_date_from;							
				$test = strtotime($today);
				if ($test < strtotime($aplcbl_date_from)) {
					$message		.=	"<li>This coupon is only applicable from ".date("j F,Y", strtotime($this->global_mod->localTimeReturn($aplcbl_date_from)))."</li>";
				}
			}	
			
			/* #######To date #####*/
			if($row->aplcbl_date_to !='0'){
				$aplcbl_date_to		=	$row->aplcbl_date_to;							
				$test 				= 	strtotime($today);
				if ($test > strtotime($aplcbl_date_to)){
					$message		.=	"<li>This coupon is only applicable upto ".date("j F,Y", strtotime($this->global_mod->localTimeReturn($aplcbl_date_to)))."</li>";
				}
			}
			
			/* #######from time#####*/
			if($row->aplcbl_hour_from !='0'){
				$aplcbl_hour_from	=	$row->aplcbl_hour_from;							
				$test = strtotime($toTime);
				if ($test < strtotime($aplcbl_hour_from)) {
					$message		.=	"<li>This coupon is only applicable from ".date("g:i a", strtotime($aplcbl_hour_from))."</li>";
				}
			}	
			
			/* #######to time#####*/	
			if($row->aplcbl_hour_to !='0'){
				$aplcbl_hour_to	  	=	$row->aplcbl_hour_to;							
				$test 				= 	strtotime($toTime);
				if ($test > strtotime($aplcbl_hour_to)){
					$message		.=	"<li>This coupon is only applicable within ".date("g:i a", strtotime($aplcbl_hour_to))."</li>";
				}
			}							
			
			if($row->aplcbl_days_on_week !='0'){
				$aplcbl_days_on_week_arr		=	unserialize($row->aplcbl_days_on_week);							
				$test 							= 	gmdate('N', strtotime($today));
				if(!in_array($test,$aplcbl_days_on_week_arr)){
					$message					.=	"<li>This coupon is only applicable for ".$this->applyCouponWeekDay($aplcbl_days_on_week_arr)."</li>";
				}
			}	
							
			/*#######Booking dependent#####*/		
			$this->db->select('*');
			$this->db->from('app_booking');
			$this->db->where('customer_id', $cus_id);	
			$query = $this->db->get();
			$Bookingrow 		= 	$query->result_array();
			$BookingNumRows 	=  	$query->num_rows();
	
			if($row->first_time_use_only !='0'){
				if($BookingNumRows != 0)
				{		
					$message	.=	"<li>This coupon is only applicable for first time booking</li>";;			
				}	
			}	
			
			if($row->one_time_use_only !='0'){				
				if($BookingNumRows > 0)
				{							
					foreach($Bookingrow as $book_cus){
						$booking_disc_coupon_details	=	unserialize($book_cus['booking_disc_coupon_details']);
						if($row->coupon_code == $booking_disc_coupon_details['coupon_code']){
							$message	.=	"<li>This coupon is only applicable for one time use</li>";
							break;
						}
					}
				}
			}							
			
			if($row->no_of_booking_possible !='0'){
				if($BookingNumRows > $row->no_of_booking_possible)
				{		
					$message	.=	"<li>This coupon is only applicable for ".$row->no_of_booking_possible." time(s) booking</li>";			
				}	
			}
		}
		else
		{
			$message	=	"<li>Invalid Coupon</li>";
		}
		
					
		if($message !=''){
			$message 				=	"<ul>".$message."</ul>";
			$error 					=	1;
			$coupon_amount			=	0;	
			$total					=	$grndtotal;	
		}
		else{
			$message 				=	"Successfully Applied";
			$error 					=	0;
			if($row->discount_amnt_setting =='1'){
				$coupon_amount		=	($booking_grand_total*$row->discount_amnt)/100;
				$total				=	$grndtotal-$coupon_amount;					
			}
			if($row->discount_amnt_setting =='2'){
				$coupon_amount		=	$row->discount_amnt;
				$total				=	$grndtotal-$coupon_amount;						
			}	
			if($row->discount_amnt_setting =='0'){
				$coupon_amount		=	0;	
				$total				=	$grndtotal;							
			}		
		}
		$return_array =array(
				'msg'				=> 	$message,
				'error' 			=> 	$error,
				'coupon_amount' 	=> 	$this->global_mod->currencyFormat($coupon_amount),
				'total' 			=> 	$this->global_mod->currencyFormat($total),
				'currency_type'		=>	$this->session->userdata('local_admin_currency_type')
		);
		$json_return_array			=	json_encode($return_array);
		return $json_return_array;	  
    }
	public function applyCouponService($applicbl_services_for_arr){	
		$local_admin_id = $this->session->userdata('local_admin_id');	
		$counter=1;
		foreach($applicbl_services_for_arr as $service){
			$this->db->select('service_name');
			$this->db->from('app_service');
			$this->db->where('local_admin_id', $local_admin_id);
			$this->db->where('service_id', $service);	
			$query = $this->db->get();
			$row = $query->row();
			$NumRows =  $query->num_rows();					
			if($NumRows > 0)
			{	
				$service_name_cur = $row->service_name;
				if($counter==1){
					$service_name = $service_name_cur;
				}
				elseif($counter==count($applicbl_services_for_arr)){
					$service_name = $service_name.' and '.$service_name_cur;
				}
				else{
					$service_name = $service_name.', '.$service_name_cur;
				}						
				
				$counter++;
			}			
		}
		return $service_name;
	}
	public function applyCouponStaff($applicbl_services_for_arr){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$counter=1;
		foreach($applicbl_services_for_arr as $staff){
			$this->db->select('employee_name');
			$this->db->from('app_employee');
			$this->db->where('local_admin_id', $local_admin_id);	
			$this->db->where('employee_id', $staff);	
			$query = $this->db->get();
			$row = $query->row();
			$NumRows =  $query->num_rows();					
			if($NumRows > 0)
			{	
				$service_name_cur = $row->employee_name;
				if($counter==1){
					$service_name = $service_name_cur;
				}
				elseif($counter==count($applicbl_services_for_arr)){
					$service_name = $service_name.' and '.$service_name_cur;
				}
				else{
					$service_name = $service_name.', '.$service_name_cur;
				}						
				
				$counter++;
			}			
		}
		return $service_name;

	}
    public function applyCouponWeekDay($aplcbl_days_on_week_arr){
		$counter=1;
		foreach($aplcbl_days_on_week_arr as $week){			
			switch ($week) {			   
			    case 1:
			        $day = "monday";
			        break;
			    case 2:
			        $day = "tuesday";
			        break;
				case 3:
			        $day = "wednesday";
			        break;
			    case 4:
			        $day = "thursday";
			        break; 					
			    case 5:
			        $day = "friday";
			        break;
				case 6:
			        $day = "saturday";
			        break;
			    case 7:
			        $day = "sunday";
			        break;
			}
			if($counter==1){
				$day_name = $day;
			}
			elseif($counter==count($aplcbl_days_on_week_arr)){
					$day_name = $day_name.' and '.$day;
			}
			else{
				$day_name = $day_name.', '.$day;
			}						
			
			$counter++;
		}
		return $day_name;
	}
   
    public function genaretPreBookingForm($services){
    	
        $local_admin_id = $this->session->userdata('local_admin_id');
        $sql = "SELECT *
            FROM 
                app_booking_extra_field
            WHERE
                local_admin_id ='".$local_admin_id."'";
        $query = $this->db->query($sql);
        $mainArr = $query->result_array();
     if(!empty($mainArr)){
	 	
         $exist = 0;
         foreach($mainArr as $Arr){
	  		$serviceIds = unserialize($Arr['services_ids']);
	  		$exist += count(array_intersect($serviceIds, $services));
	 	 }
	 	 if($exist>0){
		 	 $str ='';
		 	 $str.='<form method="POST" id="frmGenaretPreBook">';
		     $str.='<ul class="ulGenaretPreBook">';
		     $str.='<li>';
	         $str.='<h2>'.$this->global_mod->db_parse($this->lang->line('mobile_more_details')).'</h2>';//Some more details 
	         $str.='</li>';
	         $str.='<li id="preBookErr">';
	         $str.='</li>';
	         foreach($mainArr as $mainVal){
	        	
	            $str.='<li>';
	            $str.='<label class="lname">';
	            $str.= $this->global_mod->db_parse($mainVal['field_name']);
	            if($mainVal['is_required'] == 1){
	                $str.='<sup style="color:red;font-size:14px;">*</sup>';	
	            }
	            $str.='</label>';
	            $str.='<label class="lfield">';
	            $str.=$this->genaretFormField($mainVal,'preBook');
	            $str.='</label>';
	            $str.='</li>';
	          //	  $str .= '<input type="hidden" name="'.$mainVal['field_name'].'_id'.'" id="'.$mainVal['field_name'].'_id'.'" value="'.$mainVal['field_id'].'">';
	            
	        }
	        $str.='<li>';
	        $str.='<input type="button" id="btnPreBookFrm" value="'.$this->global_mod->db_parse($this->lang->line('mobile_next')).' >>" style="float:right;margin:0 82px;">';//NEXT
	        $str.='</li>';
	        $str.='</ul>';
	        $str.='</form>';
	        //return $str;
	        echo $str;
		 }
		 else{
		 	echo 0;
		 }
         
         
	 }
    
    }
	
    public function genaretFormField($AttrArray,$prefix){
        $sql = "SELECT *
            FROM 
                app_datatype
            WHERE
                data_type_id ='".$AttrArray['data_type_id']."'";
        $query = $this->db->query($sql);
        $dataArr = $query->result_array();

        $str ='';
        $char_arr = array("-","'","\""," ",",",".",";",":","!","`","@","#","$","%","^","&","*","(",")","+","~","/","?");
        switch ($dataArr[0]['value']) {
            case 'text':
                if($AttrArray['data_type_id']==3){
                        $str.='<input type="text" name="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" id="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" class="'.$prefix.'_text';
                        if($AttrArray['is_required'] == 1){
                        $str.=' dyimRequer ';	
                        }
                        //$str.=' dymDatepiker" value="'.$AttrArray['defult_val'].'" readonly="true">'; 
                        $str.=' dymDatepiker" value="">'; 
                }else{
                        $str.='<input type="text" name="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" id="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" class="'.$prefix.'_text';
                        if($AttrArray['is_required'] == 1){
                        $str.=' dyimRequer ';	
                        }
                        
                        if($AttrArray['data_type_id']== 2){
							$str.=' numberField "';
							$str.=' onkeyup="Onlynum(this.value,this.id)"';
							$str .= '>';
						}else{
							$str .= '">';
						}
                        
                        
                }
                break;
            case 'radio':
                $subArr = $this->genaretFormSubField($AttrArray['field_id']);
                foreach($subArr As $subVal){
                $str.='<label><input type="radio" id="'.$prefix.'_'.str_replace($char_arr, '_', $this->global_mod->db_parse($AttrArray['field_name'])).'_'.$subVal['option_id'].'" name="'.$prefix.'_'.str_replace($char_arr, '_', $this->global_mod->db_parse($AttrArray['field_name'])).'" value="'.$this->global_mod->db_parse($subVal['value']).'"';
                        /*if($subVal['value'] == $AttrArray['defult_val']){
                                $str.=' checked ="checked" ';
                        }*/
                        
                        if($subVal['default_val'] == 1){
                                $str.=' checked ="checked" ';
                        }
                        
                $str.=' class="'.$prefix.'_radio';
                if($AttrArray['is_required'] == 1){
                $str.=' dyimRequer ';	
                }
                $str.='" >&nbsp;'.$this->global_mod->db_parse($subVal['value']).'</label>'.'&nbsp;&nbsp;';
                }
                break;
            case 'select':
                $str.='<select id="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" name="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" class="'.$prefix.'_select';
                if($AttrArray['is_required'] == 1){
                $str.=' dyimRequer ';	
                }
                $str.='" >';
                $str.='<option value="-1"> Select </option>';
                $subArr = $this->genaretFormSubField($AttrArray['field_id']);
                foreach($subArr As $subVal){
                $str.='<option value="'.$subVal['value'].'"';
                      /*  if($subVal['value'] == $AttrArray['defult_val']){
                                $str.=' selected ="selected" ';
                        }*/
                        
                        if($subVal['default_val'] == 1){
                                $str.=' selected ="selected" ';
                        }
                        
                $str.='>'.$this->global_mod->db_parse($subVal['value']).'</option>';
                }
                $str.='</select>'; 
                break;                                         // '.$AttrArray['defult_val'].'
            case 'checkbox':
            	
                $str.='<input type="checkbox" id="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" name="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" value="1"';
              /*  if($AttrArray['defult_val']==1){
                $str.=' checked ="checked" ';
                }*/
                $str.=' class="'.$prefix.'_checkbox';
                if($AttrArray['is_required'] == 1){
                $str.=' dyimRequer ';	
                }
                $str.='">';
                break;
          /*  case 'password':
                $str.='<input type="password" name="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" id="'.$prefix.'_'.str_replace($char_arr, '_', $AttrArray['field_name']).'" class="'.$prefix.'_passowrd';
                if($AttrArray['is_required'] == 1){
                $str.=' dyimRequer ';	
                }
                $str.='" value="'.$AttrArray['defult_val'].'">';
                break;*/
            }
            return $str;
	}
	
    public function genaretFormSubField($mainfrmId){
        $sql = "SELECT *
            FROM 
                app_booking_extra_field_option 
            WHERE
                field_id ='".$mainfrmId."'";
        $query = $this->db->query($sql);
        $dataSubArr = $query->result_array();
        return $dataSubArr;
    }
	
    public function changeAppointmentStatusByCustomer($status,$serviceId){
        $srvDtls_booking_status = ($status == 'yes')?5:2;
        $data = array(
           'srvDtls_booking_status' => $srvDtls_booking_status
        );
        $this->db->where('srvDtls_id', $serviceId);
        $this->db->update('app_booking_service_details', $data);
        return 1;
    }

    public function getBusinessLogo($local_admin_id){
        $this->db->select('business_logo');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        $logo = $Arr[0]['business_logo'];
        return $logo;
    }

    public function getTimeInterval($local_admin_id){
        $this->db->select('cal_time_interval_variable');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        $interval = $Arr[0]['cal_time_interval_variable'];
        return $interval;
    }

    public function getSrvCost($serviceId){
        $this->db->select('service_cost');
        $this->db->from('app_service');
        $this->db->where('service_id',$serviceId);
        $query = $this->db->get();
        $Arr = $query->result_array();
        $service_cost = $Arr[0]['service_cost'];
        return $service_cost;
    }

    public function getEmpName($staff_id){
        if($staff_id != ''){
            $this->db->select('employee_name');
            $this->db->from('app_employee');
            $this->db->where('employee_id',$staff_id);
            $query = $this->db->get();
            $Arr = $query->result_array();
            $employee_name = $Arr[0]['employee_name'];
            return $employee_name;
        }
    }

    public function getBusinessLocation($local_admin_id){
        $this->db->select('*');//app_local_admin.business_location,app_local_admin.business_zip_code,app_countries.app_countries,app_regions.region_name,app_cities.city_name,app_cities.lat,app_cities.long
        $this->db->from('app_local_admin');
        $this->db->join('app_countries', 'app_countries.country_id = app_local_admin.country_id');
        $this->db->join('app_regions', 'app_regions.region_id = app_local_admin.region_id');
        $this->db->join('app_cities', 'app_cities.city_id = app_local_admin.city_id');
        $this->db->where('app_local_admin.local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $Arr = $query->result_array();
        return $Arr;
    }

	public function customerDetailsForSMS(){
		$customerId		= $this->session->userdata('user_id_customer');
		$localAdminId	= $this->session->userdata('local_admin_id');
		
		$this->db->select('value');
		$this->db->from('app_local_customer_details');
		$this->db->where('customer_id',$customerId);
		$this->db->where('local_admin_id',$localAdminId);
		$this->db->where('sign_upinfo_item_id',9);
		$query = $this->db->get();
		$Arr = $query->result_array();
		$customerPhoneNO = $Arr[0]['value'];
		return $customerPhoneNO;
	}
	
	public function customerSMSBody(){
		return 'Enter your text here.';
	}
	
	public function saveSMSdetails($smsSaveArr){
		$this->db->insert('app_sms_data', $smsSaveArr); 
	}
	
	public function updatePayPalReturn($lastRowId,$paymentStatus){
		
		
		$data = array(
		       'payment_status' => $paymentStatus
		    );
		$this->db->where('booking_id', $lastRowId);
		$this->db->update('app_booking', $data); 
		
		
	}

	public function checkMemberShip(){
		$customerId		= $this->session->userdata('user_id_customer');
		$this->db->select('*');
		$this->db->from('app_password_manager');
		$this->db->where('user_id',$customerId);
		$query = $this->db->get();
		$Arr = $query->result_array();
		$emailStatus = $Arr[0]['email_veri_status'];
		return $emailStatus;
	}

	public function staffWiseService($staffId){
		$localAdminId		=	$this->session->userdata('local_admin_id');
		$arr =array();
		$sql = "SELECT DISTINCT service_id
            FROM 
                app_biz_hours
            WHERE
            	local_admin_id ='".$localAdminId."'
            	AND
                employee_id ='".$staffId."'";
        $query = $this->db->query($sql);
        $dataArr = $query->result_array();
        
        foreach($dataArr as $key=>$value){
            $arr[$key]=	$value['service_id'];
        }
        return $arr;
	}
	
	
	public function checkIsVeryfiedMember(){
		
	}
	
	public function CheckIspreForm(){
		$localAdminId	=	$this->session->userdata('local_admin_id');
		
		$query = $this->db->query("SELECT * FROM app_booking_extra_field WHERE local_admin_id = '".$localAdminId."'");
		
		return count($query);
	}
	
	public function GetService_StaffDetails($booking_id){
		$this->db->select('*');
		$this->db->from('app_booking_service_details ');
		$this->db->where('srvDtls_booking_id',$booking_id);
		$query = $this->db->get();
		$Arr = $query->result_array();
		return $Arr;
	}

	public function customPiker(){
		$localAdminId		=	$this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_custom_color_scheme');
		$this->db->where('local_admin_id',$localAdminId);
		$query = $this->db->get();
		$Arr = $query->result_array();
		return $Arr;
	}
	
	public function chkPreBooking(){
		$localAdminId		=	$this->session->userdata('local_admin_id');
		 $sql = "SELECT count(*) AS countVal
            FROM 
                app_booking_extra_field 
            WHERE
                local_admin_id ='".$localAdminId."'";
        $query = $this->db->query($sql);
        $dataSubArr = $query->result_array();
        return $dataSubArr[0]['countVal'];
	}
	
/////////////////////////////////////  Done By Partha Saha        //////////////////////////////////////////////
	
	public function sentAdminSms($booking_id,$Event){
		$localAdminId		=	$this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_local_admin');
		$this->db->where('local_admin_id',$localAdminId);
		$query1 = $this->db->get();
		$localAdmin = $query1->result_array();
				
		$to		=	$localAdmin[0]['mobile_phone'];
		$body="New Booking complete";
		$this->sms_model->sendSms($to,$body,'admin',$Event);
	}
	
	
	
	public function sentStaffSms($booking_id,$Event){
		$this->db->select('*');
		$this->db->from('app_booking_service_details');
		$this->db->where('srvDtls_booking_id',$booking_id);
		$query2 = $this->db->get();
		$staffs = $query2->result_array();
	
		foreach($staffs as $staff){		
			$this->db->select('*');
			$this->db->from('app_employee');
			$this->db->where('employee_id',$staff['srvDtls_employee_id']);
			$query3 	= 	$this->db->get();
			$staff_arr 		= 	$query3->result_array();					
			$to			=	$staff_arr[0]['employee_mobile_no'];
			$body		=	"New booking Complete for your service";
			$this->sms_model->sendSms($to,$body,'staff',$Event);
		}		
	}
	
	public function sentSmsSetting($booking_id){
		
		//echo "<pre>";print_r($this->session->all_userdata());exit;
		//$this->sms_model->sendSms('919903237488',"test");
		//echo "<pre>";print_r($this->session->all_userdata());exit;
	
		$localAdminId		=	$this->session->userdata('local_admin_id');
		$this->db->select('*');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id',$localAdminId);
		$query = $this->db->get();
		$Arr = $query->result_array();
		
		//send sms to client
		$Arr[0]['sms_alrt_bfr_appo'];
		//$Arr[0]['sms_thanks_aftrappo'];
		if($Arr[0]['sms_thanks_aftrappo'] ==1){
		
		
			$this->db->select('*');
			$this->db->from('app_booking');
			$this->db->where('booking_id',$booking_id);
			$query8 = $this->db->get();
			$cus = $query8->result_array();		
			$customer_id =	$cus[0]['customer_id'];
				
				
			$this->db->select('*');
			$this->db->from('app_customer_search');
			$this->db->where('cus_id',$customer_id);
			$query9 = $this->db->get();
			$cus1 = $query9->result_array();
			
			$user_mobile_customer =$cus1[0]['cus_mob'];
			
			$body="Thank you for booking at ".$this->session->userdata('ad_name');
			
			$this->sms_model->sendSms($user_mobile_customer,$body,'user',3);
		}
			
		//send sms to admin
		if($Arr[0]['send_sms_for'] == 2){ //Whenever an appointment requires approval 
			
			$Event = $Arr[0]['send_sms_for'];
			$this->db->select('*');
			$this->db->from('app_booking_service_details');
			$this->db->where('srvDtls_booking_id',$booking_id);
			$query2 = $this->db->get();
			$booking = $query2->result_array();
			foreach($booking as $book){	
				
				if($book['srvDtls_booking_status'] ==2 || $book['srvDtls_booking_status'] ==0){
					if($Arr[0]['sms_alart_to_admin']==1){			
						$this->sentAdminSms($booking_id,$Event);
					}
					if($Arr[0]['sms_alart_to_staff']==1){
						$this->sentStaffSms($booking_id,$Event);							
					}
					break;
					
				}	
			}			
		}
		elseif($Arr[0]['send_sms_for'] == 3){	//Every time an appointment is booked						
			
			$Event = $Arr[0]['send_sms_for'];
			if($Arr[0]['sms_alart_to_admin']==1){			
				$this->sentAdminSms($booking_id,$Event);
			}
			if($Arr[0]['sms_alart_to_staff']==1){
				$this->sentStaffSms($booking_id,$Event);							
			}						
		}	
		 
	}

	public function getTermsCondition($local_admin_id){
		$this->db->select('*');
		$this->db->from('app_cms');
		$this->db->where('cms_type','privacypolicy');
		$this->db->where('local_admin_id', 	$local_admin_id);
		$query2 = $this->db->get();
		$TermsCondition = $query2->result_array();
		return $TermsCondition[0]['cms_dec'];
			
	}
	public function getCancelHour(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('bkin_can_setin,bkin_can_mx_tim');
		$this->db->from('app_local_admin_gen_setting');
		$this->db->where('local_admin_id ',$local_admin_id);
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
		
	}

// Pardco code here.
	function get_show_frontend_header($local_admin_id)
	{
		$sql = 'SELECT `frontend_header` FROM `app_local_admin_gen_setting`
			WHERE `local_admin_id` = ?';
		$query = $this->db->query($sql, array($local_admin_id));
		$result = $query -> result_array();
		return (bool)($result[0]['frontend_header']);
	}
	
	function get_custom_dependency_warning()
	{
		$selected_option_id = array(1, 2);
		if (!count($selected_option_id))
		{
			return '';
		}

		ob_start();
	//var_dump($_POST);
		/*echo '<dl>';
		foreach ($selected_option_id as $key)
		{
			echo '<dt>Service</dt>';
			echo '<dd>Error</dd>';
		}
		echo '</dl>';*/
		$r = ob_get_contents();
		ob_end_clean();
		return $r;
	}
// Here be dragons.
}
?>
