<?php
class Global_mod extends CI_Model {	
	public function gmtDifference(){
		$local_admin_id = $this->session->userdata('local_admin_id');
        $this->db->select('app_time_zone.gmt_symbol,app_time_zone.gmt_value');
        $this->db->from('app_time_zone');
        $this->db->join('app_local_admin', 'app_local_admin.time_zone_id = app_time_zone.time_zone_id');
        $this->db->where('app_local_admin.local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $resultArr = $query->result_array();
		$time_arr = explode(":",$resultArr[0]['gmt_value']);
		$time_sec = intval($time_arr[0])*3600+intval($time_arr[1])*60;
		if($resultArr[0]['gmt_symbol'] == 1){
			return '+'.$time_sec;
		}
		if($resultArr[0]['gmt_symbol'] == 0){
			return '-'.$time_sec;
		}
	}																
	public function gmtToTimeZoneConvert($gmtTime){
		$time_arr = explode(":",$gmtTime);
		$time_sec = intval($time_arr[0])*3600+intval($time_arr[1])*60+intval($time_arr[2]);
		$diff	  = $this->gmtDifference();
		$timeStmp = $time_sec+($diff);
		//$gmtTime;
		if($diff <0){
			$hh	=	(($timeStmp/3600)==0)?'00':($timeStmp/3600);
			$mm =	((($timeStmp%3600)/60)==0)?'00':(($timeStmp%3600)/60);
			$ss =	((($timeStmp%3600)%60)==0)?'00':(($timeStmp%3600)%60);
			return	$hh.':'.$mm.':'.$ss;
		}else{
			if(86400 >$timeStmp){
				//echo "CCC : ".$timeStmp;exit;
				$hh	=	(($timeStmp/3600)==0)?'00':($timeStmp/3600);
				$mm =	((($timeStmp%3600)/60)==0)?'00':(($timeStmp%3600)/60);
				$ss =	((($timeStmp%3600)%60)==0)?'00':(($timeStmp%3600)%60);
                                return	$hh.':'.$mm.':'.$ss;
			}else{
				$hh	=	((($timeStmp-86400)/3600)==0)?'00':(($timeStmp-86400)/3600);
				$mm =	(((($timeStmp-86400)%3600)/60)==0)?'00':((($timeStmp-86400)%3600)/60);
				$ss =	(((($timeStmp-86400)%3600)%60)==0)?'00':((($timeStmp-86400)%3600)%60);
				return	$hh.':'.$mm.':'.$ss;
			}
                }
        }   	                      
	public function getBusinessHourList($myservArr=array(),$mystaffArr=array(),$dayArr=array()){
		$start = '';
		//Employee query start
		if(count($mystaffArr)>0 && is_array($mystaffArr)){
		$start		.= " AND employee_id in (";
			$ls_Emp="";	
			foreach($mystaffArr AS $lsEmp){
	               $ls_Emp	.= $lsEmp.",";
	            }
		$start		.=substr_replace($ls_Emp ,"",-1).")";
		}
		
		//Service query start
		if(count($myservArr)>0 && is_array($myservArr)){
		$start		.= " AND service_id in (";
			$ls_srv="";	
			foreach($myservArr AS $lsEmp){
	               $ls_srv	.= $lsEmp.",";
	            }
		$start		.=substr_replace($ls_srv ,"",-1).")";
		}
		
		//day query start
		if(count($dayArr)>0 && is_array($dayArr)){
		$start		.= " AND day_id in (";
			$ls_day="";	
			foreach($dayArr AS $lsEmp){
	               $ls_day	.= $lsEmp.",";
	            }
		$start		.=substr_replace($ls_day ,"",-1).")";
		}

		$start .= ' ORDER BY day_id,service_id,employee_id,time_from ';
		$bizArr = $this->global_mod->mainBizScheduleFrontend($start);
		
		$dateArr =array();
		$daykey =0;
		$temp_day ='';
		$dateArr = array();
		$temp_service = '';
		$servicekey =0;
		
		$temp_staff = '';
		$staff_key =0;
		$booking_key =0;
		foreach($bizArr as $key=>$bisDetails){
			
			if($temp_day != $bisDetails['day_id'] ){
				$daykey++;
				$dateArr[$daykey-1]['noOfDay'] = $bisDetails['day_id'];
				$temp_day = $bisDetails['day_id'];
				$servicekey=0;	
			}
			
			if($temp_service !=$bisDetails['service_id'] ){
			    $servicekey++;
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1] = array();
				$dateArr[$daykey-1]['noOfDay'] = $bisDetails['day_id'];
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvName'] = $bisDetails['service_id'];
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['bookMxBooking'] = $bisDetails['booking_capacity'];
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['serviceDurationMin'] = $bisDetails['service_duration'];
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvDtls'] = array();
				$temp_service =$bisDetails['service_id'];
				$staff_key =0;
			}
			
			if($temp_staff != $bisDetails['employee_id'] ){
				$staff_key++;			
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvDtls'][$staff_key-1]['staffName'] = $bisDetails['employee_id'];
				$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvDtls'][$staff_key-1]['staffDtls'] = array();
				$temp_staff = $bisDetails['employee_id'];
				$booking_key =0;
			}
			
			$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvDtls'][$staff_key-1]['staffDtls'][$booking_key]['bookStrTime'] =$bisDetails['time_from'];
			$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvDtls'][$staff_key-1]['staffDtls'][$booking_key]['bookEndTime'] =$bisDetails['time_to'];
			$dateArr[$daykey-1]['noOfDay_datils'][$servicekey-1]['srvDtls'][$staff_key-1]['staffDtls'][$booking_key]['biz_hours_id'] =$bisDetails['main_id'];
			
			$booking_key++;		
		}
	
	return $dateArr;
	
	}		       
	public function getBusinessHourListForAdmin($myservArr=array(),$mystaffArr=array(),$dayArr=array()){

		$start = '';
		//Employee query start
		if(count($mystaffArr)>0 && is_array($mystaffArr)){
		$start		.= " AND employee_id in (";
			$ls_Emp="";	
			foreach($mystaffArr AS $lsEmp){
	               $ls_Emp	.= $lsEmp.",";
	            }
		$start		.=substr_replace($ls_Emp ,"",-1).")";
		}
		
		//Service query start
		if(count($myservArr)>0 && is_array($myservArr)){
		$start		.= " AND service_id in (";
			$ls_srv="";	
			foreach($myservArr AS $lsEmp){
	               $ls_srv	.= $lsEmp.",";
	            }
		$start		.=substr_replace($ls_srv ,"",-1).")";
		}
		
			//day query start
		if(count($dayArr)>0 && is_array($dayArr)){
		$start		.= " AND day_id in (";
			$ls_day="";	
			foreach($dayArr AS $lsEmp){
	               $ls_day	.= $lsEmp.",";
	            }
		$start		.=substr_replace($ls_day ,"",-1).")";
		}

		$start .= ' ORDER BY employee_id,service_id,day_id,time_from ';
		$bizArr = $this->global_mod->mainBizScheduleFrontend($start);
		
		return $bizArr;

	}		       
	public function getTimeZoneDiff(){
			$local_admin_id = $this->session->userdata('local_admin_id');
			$Sql = "SELECT 
						app_time_zone.*
					FROM
						app_time_zone ,
						app_local_admin
					WHERE 
						app_local_admin.time_zone_id = app_time_zone.time_zone_id
						AND 
						app_local_admin.local_admin_id =".$local_admin_id;
			$query = $this->db->query($Sql);
			$Arr = $query->result_array();
			return $Arr;		
    }										
	public function mainBookingStorePro($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call bookingDetails('".$local_admin_id."',
									'".$time_difference."',
									'".$string."',
									'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}
	public function mainBookingStoreProForCron($localAdminId,$string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);						 
		$Sql = "call bookingDetailsForCron('".$localAdminId."',
											'".$string."',
											'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}
	public function mainBookingStoreProReport($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call sp_report_booking_details('".$local_admin_id."',
									'".$time_difference."',
									'".$string."',
									'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}	
	public function reviewWiseReportDetails($string='',$starting=''){
		
		 $storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		 $local_admin_id		= $this->session->userdata('local_admin_id');
		 $time_difference	= $this->session->userdata('time_difference');	
							 
		$Sql = "call reviewDetailsReport('".$local_admin_id."',
									'".$time_difference."',
									'".$string."',
									'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;            
	}	
	public function staffBlockingStorePro($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call staffBlockDetailsFront('".$local_admin_id."',
									'".$time_difference."',
									'".$string."',
									'".$starting."')";
									
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}
	public function getAdminAddress($local_admin_id){
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
	public function staffBlockingStoreProAdmin($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		 $Sql = "call staffBlockDetails('".$local_admin_id."',
									'".$time_difference."',
									'".$string."',
									'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}
	public function mainBizSchedule($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call convToLocal('".$local_admin_id."',
								'".$time_difference."',
								'".$string."',
								'".$starting."')";				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();
		return $ResArr;
	}	
	public function mainBizScheduleFrontend($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call mainBizScheduleFrontend('".$local_admin_id."',
								'".$time_difference."',
								'".$string."',
								'".$starting."')";
																				
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();

		return $ResArr;
	}	
	public function Check_local_admin($LocalAdminUserName)
	{
		$sql = 'SELECT `user_id` 
			FROM `app_password_manager`
			WHERE `user_name` = ?
			AND (`user_type` = 3 OR `user_type` = 5)';
		$query = $this -> db -> query($sql, array($LocalAdminUserName));
		$NumLocalAdmin =  $query->num_rows(); 
		if($NumLocalAdmin > 0){
			$UserIdArr =  $query->result_array();
			return $LocalAdminUserId = $UserIdArr[0]['user_id'];
		}else{
			return 0;
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
    public function is_parent(){      
        $local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select('is_parent');
		$this->db->from('app_localadmin_relation');
		$this->db->where('relation_localadmin_id',$local_admin_id);
		$query = $this->db->get();		
		$Ret_Arr_val = $query->result_array();
		if(count($Ret_Arr_val) ==0){
			return 0;
		}else{
			return $Ret_Arr_val[0]['is_parent'];
		}
	}		
	public function getLocalAdminGenSetting($local_admin_id){
		$sql = "";
		$sql .="SELECT 
					currency.currency_symbol AS currency,
					currency.currency_id AS currency_id,
					currency.currency_abbriviation AS abbriviation,
					gmt.gmt_value AS gmt_value,
					gmt.gmt_symbol AS gmt_symbol,
					time.time_format AS time_format,
					date.date_format AS date_format,
					admin.page_title AS title,
					admin.country_id AS ad_country,
					admin.region_id AS ad_region,
					admin.city_id AS ad_cityId,
					admin.first_name AS ad_fname,
					admin.last_name AS ad_lname,
					admin.home_phone AS ad_hphone,
					admin.work_phone AS ad_wphone,
					admin.mobile_phone AS ad_mobile,
					admin.business_logo AS ad_logo,
					admin.business_name AS ad_name,
					admin.business_location AS ad_location,
					admin.business_city_id AS ad_city,
					admin.business_state_id  AS ad_state,
					admin.business_zip_code  AS ad_zip,
					admin.business_phone AS ad_businessPhone,
					admin.facebook_link AS ad_facebook,
					admin.youtube_link AS ad_youtube,
					admin.google_link AS ad_google,
					admin.twitter_link AS ad_twitter,
					admin.linkedin_link AS ad_linkedin,
					ladmin.user_email AS ladmin_email
				
				FROM
					app_local_admin AS admin,
					app_currency AS currency,
					app_time_zone AS gmt,
					app_time_format AS time,
					app_date_format AS date,
					app_password_manager As ladmin
				WHERE
					admin.currency_id = currency.currency_id
					AND
					admin.time_zone_id = gmt.time_zone_id
					AND
					admin.time_format_id = time.time_format_id
					AND
					admin.date_format_id = date.date_format_id
					AND
					admin.local_admin_id = ".$local_admin_id."
					AND
					ladmin.user_id = ".$local_admin_id;
					
                #print($sql); 
		$result=$this->db->query($sql);
		$resultArr = $result->result();
		
		return $resultArr[0];
	}	
	//PARDCO added new variable to check if coming from admin and setting status on booking always, so we can count that old usage doesnt break because of this
	public function checkStaffAvailability($bookDateTime,$employee=array(),$service=array(),$adminBookAlways=FALSE){	
		//echo $bookDateTime.'<br>';
		//print_r($employee);
		//print_r($service);
		//print_r($adminBookAlways);
		//exit;
	
		//get all local admin settings
		$local_admin_settings = $this->localAdminGenSettings();
		//get all employee with order
		if(count($employee)==0){
			$empArr = $this->pardco_model->employee();
			$empArray =array();
			foreach($empArr AS $key=>$val){
				$empArray[$key] =$val['id'];
			}
			$employeeArr = $this->subFn_staffOrdering($bookDateTime,$empArray);
		}else{
			if(count($employee)==1){
				$employeeArr = $employee;
			}else{	
				$empArr = $employee;
				$employeeArr = $this->subFn_staffOrdering($bookDateTime,$empArr);
			}
		}		
		//get service order with Dependency
		if(count($service)>1 && count($service)!= 0){
			if($local_admin_settings[0]['multiple_services_booking']==1){	
				$serviceArr = $this->subFn_dependencyOrdering($service);
			}else{
				$serviceArr = $this->subFn_arrayRandom($service,count($service));
			}
		}else{
				$serviceArr = $service;
		}
		$bookingArray = array();
		//employee loop
		foreach($serviceArr AS $srvKey=>$srvVal){		
			//service loop
			foreach($employeeArr AS $empKey=>$empVal){
				//check biz schedule
				$bizSchedule	= $this->subFn_checkBizSchedule($srvVal,$empVal,$bookDateTime);
				if($bizSchedule[0]['is_present'] == 1 || $adminBookAlways){
					//checking blocking schedule
					$blockSchedule	= $this->subFn_checkBlockSchedule($srvVal,$empVal,$bookDateTime);
					
					if($blockSchedule[0]['is_present'] == 0){
					
						// NOT CHECKING CAPACITY ATM --- This is because of hotfix, capacity was incorrectly giving capacity full
						$bookingArray[$srvKey][$empKey]['bk_status']			= TRUE;	
					
						//checking capacity
						$bookingCapacity	= $this->subFn_checkbookingCapacity($srvVal,$empVal,$bookDateTime);//1
						$serviceCpacity		= $this->serviceDetails($srvVal);
						$empArr				= $this->employeeDetails($empVal);
						if($serviceCpacity[0]['service_capacity'] >= $bookingCapacity[0]['booking_number']){
								$bookingArray[$srvKey][$empKey]['bk_service_id']		= $srvVal;
								$bookingArray[$srvKey][$empKey]['bk_employee_id']		= $empVal;
								$bookingArray[$srvKey][$empKey]['bk_employee_name']		= $empArr[0]['employee_name'];
								$bookingArray[$srvKey][$empKey]['bk_time']				= $bookDateTime;
								$bookingArray[$srvKey][$empKey]['bk_service_name']		= $serviceCpacity[0]['service_name'];
								$bookingArray[$srvKey][$empKey]['bk_service_cost']		= $serviceCpacity[0]['service_cost'];
								$bookingArray[$srvKey][$empKey]['bk_no_cost']			= $serviceCpacity[0]['no_cost'];
								$bookingArray[$srvKey][$empKey]['bk_service_duration']	= $serviceCpacity[0]['service_duration'];
								$bookingArray[$srvKey][$empKey]['bk_service_duration_min'] =$serviceCpacity[0]['service_duration_min'];
								$bookingArray[$srvKey][$empKey]['bk_service_capacity']	= $serviceCpacity[0]['service_capacity'];
								$bookingArray[$srvKey][$empKey]['bk_duration']			= $serviceCpacity[0]['service_duration_min'];
								$bookingArray[$srvKey][$empKey]['bk_status']			= TRUE;	
								$bookingArray[$srvKey][$empKey]['remaining_capacity']	= ($serviceCpacity[0]['service_capacity'] - $bookingCapacity[0]['booking_number']);		
								$bookDateTime = date('Y-m-d H:i:s', strtotime('+'.$serviceCpacity[0]['service_duration_min'].' minutes', strtotime($bookDateTime)));
						break;    
						}else{
							$bookingArray[$srvKey][$empKey]['bk_service_id']		= $srvVal;
							$bookingArray[$srvKey][$empKey]['bk_employee_id']		= $empVal;
							$bookingArray[$srvKey][$empKey]['bk_employee_name']		= $empArr[0]['employee_name'];
							$bookingArray[$srvKey][$empKey]['bk_time']				= $bookDateTime;
							$bookingArray[$srvKey][$empKey]['bk_service_name']		= $serviceCpacity[0]['service_name'];
							$bookingArray[$srvKey][$empKey]['bk_service_cost']		= $serviceCpacity[0]['service_cost'];
							$bookingArray[$srvKey][$empKey]['bk_no_cost']			= $serviceCpacity[0]['no_cost'];
							$bookingArray[$srvKey][$empKey]['bk_service_duration']	= $serviceCpacity[0]['service_duration'];
							$bookingArray[$srvKey][$empKey]['bk_service_duration_min'] =$serviceCpacity[0]['service_duration_min'];
							$bookingArray[$srvKey][$empKey]['bk_service_capacity']	= $serviceCpacity[0]['service_capacity'];
							$bookingArray[$srvKey][$empKey]['bk_duration']			= $serviceCpacity[0]['service_duration_min'];
							$bookingArray[$srvKey][$empKey]['bk_status'] = FALSE;
							$bookingArray[$srvKey][$empKey]['bk_msg'] ='The service unavailable due to capacity';								
						}
					}else{
						$serviceCpacity		= $this->serviceDetails($srvVal);
						$empArr				= $this->employeeDetails($empVal);
						$bookingArray[$srvKey][$empKey]['bk_employee_name']		= $empArr[0]['employee_name'];
						$bookingArray[$srvKey][$empKey]['bk_service_name']		= $serviceCpacity[0]['service_name'];
						$bookingArray[$srvKey][$empKey]['bk_service_cost']		= $serviceCpacity[0]['service_cost'];
						$bookingArray[$srvKey][$empKey]['bk_no_cost']			= $serviceCpacity[0]['no_cost'];
						$bookingArray[$srvKey][$empKey]['bk_service_duration']	= $serviceCpacity[0]['service_duration'];
						$bookingArray[$srvKey][$empKey]['bk_service_duration_min'] =$serviceCpacity[0]['service_duration_min'];
						$bookingArray[$srvKey][$empKey]['bk_service_capacity']	= $serviceCpacity[0]['service_capacity'];
						$bookingArray[$srvKey][$empKey]['bk_duration']			= $serviceCpacity[0]['service_duration_min'];				
						
						$bookingArray[$srvKey][$empKey]['bk_service_id'] =$srvVal;
						$bookingArray[$srvKey][$empKey]['bk_employee_id'] =$empVal;
						$bookingArray[$srvKey][$empKey]['bk_time'] =$bookDateTime;
						$bookingArray[$srvKey][$empKey]['bk_status'] = FALSE;
						$bookingArray[$srvKey][$empKey]['bk_msg'] ='Sorry!! The time is block for this employee';				
					}
				}else{
					$serviceCpacity		= $this->serviceDetails($srvVal);
					$empArr				= $this->employeeDetails($empVal);
					$bookingArray[$srvKey][$empKey]['bk_employee_name']		= $empArr[0]['employee_name'];
					$bookingArray[$srvKey][$empKey]['bk_service_name']		= $serviceCpacity[0]['service_name'];
					$bookingArray[$srvKey][$empKey]['bk_service_cost']		= $serviceCpacity[0]['service_cost'];
					$bookingArray[$srvKey][$empKey]['bk_no_cost']			= $serviceCpacity[0]['no_cost'];
					$bookingArray[$srvKey][$empKey]['bk_service_duration']	= $serviceCpacity[0]['service_duration'];
					$bookingArray[$srvKey][$empKey]['bk_service_duration_min'] =$serviceCpacity[0]['service_duration_min'];
					$bookingArray[$srvKey][$empKey]['bk_service_capacity']	= $serviceCpacity[0]['service_capacity'];
					$bookingArray[$srvKey][$empKey]['bk_duration']			= $serviceCpacity[0]['service_duration_min'];
					
					$bookingArray[$srvKey][$empKey]['bk_service_id'] =$srvVal;
					$bookingArray[$srvKey][$empKey]['bk_employee_id'] =$empVal;
					$bookingArray[$srvKey][$empKey]['bk_time'] =$bookDateTime;
					$bookingArray[$srvKey][$empKey]['bk_status'] = FALSE;
					$bookingArray[$srvKey][$empKey]['bk_msg'] ='Sorry!! There is no schedule for this service';
				}
			}
		}
		return $bookingArray;
	}	
	public function employeeDetails($employee_id){
		$sql = "SELECT 
		            *
		        FROM 
		            app_employee  
		        WHERE 
			      employee_id = ".$employee_id;
				  
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
	}	
	public function subFn_checkStaffAvailabilonTime(){
		$string = '';
		$string .=' AND employee_id ='.$staffId.' AND day_id='.date ("N", strtotime($selectedDate));
		if($sreviceId !=''){
		$string .=' AND service_id IN ('.$sreviceId.')';	
		}
		$returnArr = $this->mainBizSchedule($string);
		return $returnArr;
	}	
	public function subFn_staffOrdering($bookTime,$employeeArr){
		$settings = $this->localAdminGenSettings();
		$empArr	= array();
		if(count($empArr) == 1){
			$empArr = $employeeArr;
		}else{
			if($settings[0]['staff_selection_mandatory'] == 1){
				$empArr = $employeeArr;
			}else{
				switch ($settings[0]['staff_order']){
                    case 1://Most free staff (Timewise)
                        $empArr = $this->subFn_mostFreeStaffTimewise($bookTime,$employeeArr);
                        break;
                    case 2://Most free staff (Appointmentwise)
                        $empArr = $this->subFn_mostFreeStaffAppointmentwise($bookTime,$employeeArr);
                        break;
                    case 3://Most busy staff (Timewise)
                        $empArr = $this->subFn_mostBusyStaffTimewise($bookTime,$employeeArr);
                        break;
                    case 4://Most busy staff (Appointmentwise)
                        $empArr = $this->subFn_mostBusyStaffAppointmentwise($bookTime,$employeeArr);
                        break;
                    case 5://Order in which staff are displayed
                        $empArr = $this->subFn_staffDisplaywise($bookTime,$employeeArr);
                        break;
                }
			}
			
		}
		return $empArr;
	}
	public function subFn_mostFreeStaffTimewise ($bookTime,$employeeArr){
		$startStr	= '';
		$startStr	.= ' AND day_id='.date ("N", strtotime($bookTime));
		$startStr	.= " AND employee_id IN (";
					$ls_Emp="";	
					foreach($employeeArr AS $lsEmp){
			          $ls_Emp	.= $lsEmp.",";
			        }
		$startStr	.=substr_replace($ls_Emp ,"",-1).")";
		$startStr	.= ' GROUP BY employee_id, day_id   ';
		$startStr	.= ' ORDER BY sec ASC ';		
		$end =' employee_id, SUM( TIME_TO_SEC(TIMEDIFF(`time_to`,`time_from`))) as sec  ';
		$result		= $this->mainBizSchedule($startStr,$end);
		$employee = array();
		foreach($result AS $key=>$val){
			$employee[$key] = $val['employee_id'];
		}
		return $employee;
	}
	public function subFn_mostFreeStaffAppointmentwise ($bookTime,$employeeArr){
		$startStr	= '';
		$startStr	.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = DATE_FORMAT(CAST("'.$bookTime.'" AS date),"%Y-%m-%d") ';
		$startStr	.= " AND srvDtls_employee_id IN (";
					$ls_Emp="";	
					foreach($employeeArr AS $lsEmp){
			          $ls_Emp	.= $lsEmp.",";
			        }
		$startStr	.=substr_replace($ls_Emp ,"",-1).")";
		$startStr	.= ' GROUP BY srvDtls_employee_id   ';
		$startStr	.= ' ORDER BY booking_no  ASC ';
		
		
		$end =' count(*) booking_no ,srvDtls_employee_id ';
		
		
		$result		= $this->mainBookingStorePro($startStr,$end);
		$employee = array();
		foreach($result AS $key=>$val){
			$employee[$key] = $val['srvDtls_employee_id'];
		}
		return $employee;
	}	
	public function subFn_mostBusyStaffTimewise ($bookTime,$employeeArr){
		$startStr	= '';
		$startStr	.= ' AND day_id='.date ("N", strtotime($bookTime));
		$startStr	.= " AND employee_id IN (";
					$ls_Emp="";	
					foreach($employeeArr AS $lsEmp){
			          $ls_Emp	.= $lsEmp.",";
			        }
		$startStr	.=substr_replace($ls_Emp ,"",-1).")";
		$startStr	.= ' GROUP BY employee_id, day_id   ';
		$startStr	.= ' ORDER BY sec DESC ';		
		$end =' employee_id, SUM( TIME_TO_SEC(TIMEDIFF(`time_to`,`time_from`))) as sec  ';
		$result		= $this->mainBizSchedule($startStr,$end);
		$employee = array();
		foreach($result AS $key=>$val){
			$employee[$key] = $val['employee_id'];
		}
		return $employee;
		
	}
	public function subFn_mostBusyStaffAppointmentwise($bookTime,$employeeArr){
		$startStr	= '';
		$startStr	.= ' AND DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") = DATE_FORMAT(CAST("'.$bookTime.'" AS date),"%Y-%m-%d") ';
		$startStr	.= " AND srvDtls_employee_id IN (";
					$ls_Emp="";	
					foreach($employeeArr AS $lsEmp){
			          $ls_Emp	.= $lsEmp.",";
			        }
		$startStr	.=substr_replace($ls_Emp ,"",-1).")";
		$startStr	.= ' GROUP BY srvDtls_employee_id   ';
		$startStr	.= ' ORDER BY booking_no  DESC ';
		
		
		$end =' count(*) booking_no ,srvDtls_employee_id ';
		
		
		$result		= $this->mainBookingStorePro($startStr,$end);
		$employee = array();
		foreach($result AS $key=>$val){
			$employee[$key] = $val['srvDtls_employee_id'];
		}
		return $employee;
	}
	public function subFn_staffDisplaywise ($bookTime,$employeeArr){
		return $employeeArr;
	}	
	public function localAdminGenSettings(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$this->db->select(' * ');
        $this->db->from('app_local_admin_gen_setting');
        $this->db->where('local_admin_id', $local_admin_id);
        $query = $this->db->get();
        $resultArr = $query->result_array();
		return 	$resultArr;
	}	
	public function subFn_arrayRandom($arr, $num = 1){
	    shuffle($arr);
	    $r = array();
	    for ($i = 0; $i < $num; $i++) {
	        $r[] = $arr[$i];
	    }
	    return $num == 1 ? $r[0] : $r;
	}
	public function subFn_dependencyOrdering($service){
	
		return $service;	
	}
	public function subFn_checkBizSchedule($srvVal,$empVal,$bookDateTime){
		$start	= '';
		$start	.= ' AND CAST(DATE_FORMAT("'.$bookDateTime.'","%H:%i:%s") AS TIME) BETWEEN CAST(time_from AS TIME) AND CAST(time_to AS TIME) ';
		$start	.= ' AND service_id ="'.$srvVal.'" ';
		$start	.= ' AND employee_id ="'.$empVal.'" ';
		$start	.= ' AND day_id ="'.date ("N", strtotime($bookDateTime)).'" ';
		
		$end	= '';
		$end	.= ' count(*) AS is_present ';
		$result	= $this->mainBizSchedule($start,$end);
		return $result;
	}
	public function subFn_checkBlockSchedule($srvVal,$empVal,$bookDateTime){
		$start	 = '';
		$start	.= ' AND employee_id ='.$empVal;
		$start	.= ' AND CAST(block_date AS DATE) = CAST(DATE_FORMAT("'.$bookDateTime.'","%Y-%m-%d") AS DATE) ';
		$start	.= ' AND is_active ="Y" AND CAST(DATE_FORMAT("'.$bookDateTime.'","%H:%i:%s") AS TIME) BETWEEN CAST(time_form AS TIME) AND CAST(time_to AS TIME) ';

		$end	 = '';
		$end	.= ' COUNT(*) AS is_present ';
		
		$result	= $this->staffBlockingStorePro($start,$end);
		return $result;
	}
	public function subFn_checkbookingCapacity($srvVal,$empVal,$bookDateTime){
		$start	 ='';
		$start	.=' AND srvDtls_service_id ='.$srvVal;
		$start	.=' AND CAST(DATE_FORMAT(srvDtls_service_start,"%Y-%m-%d") AS DATE) = CAST(DATE_FORMAT("'.$bookDateTime.'","%Y-%m-%d") AS DATE) ';
		$start	.=' AND srvDtls_booking_status NOT IN (4,5,16) ';
		$end	 ='';
		$end	.=' COUNT(*) AS booking_number ';
        $result	= $this->mainBookingStorePro($start,$end);
		return $result;
	}
	public function serviceDetails($serviceId){
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');

		$this->db->select(' * ');
		$this->db->from('app_service');
		$this->db->where('service_id', $serviceId);
		$this->db->where('local_admin_id', $local_admin_id);
		$query = $this->db->get();
		$resultArr = $query->result_array();
		return $resultArr;		
		}
	/*####local time to gmt time####*/
	public function gmtTimeReturn($dateTime){
		$dateDiffArr = explode(":",$this->session->userdata('time_difference'));
		if($dateDiffArr[0]>0){
			$minTime = $dateDiffArr[0]*60+ $dateDiffArr[1];
			$timeInMin = $minTime*(-1);
		}else{
			$minTime = $dateDiffArr[0]*60- $dateDiffArr[1];
			$timeInMin = $minTime*(-1);
		}
		$resultTime = date('Y-m-d H:i:s', strtotime($timeInMin.' minute ', strtotime($dateTime)));
		return $resultTime;
	}	
	/*####gmt time to local time####*/
	public function localTimeReturn($dateTime){
		$dateDiffArr = explode(":",$this->session->userdata('time_difference'));
		if($dateDiffArr[0]>0){
			$minTime = $dateDiffArr[0]*60+ $dateDiffArr[1];
		}else{
			$minTime = $dateDiffArr[0]*60- $dateDiffArr[1];
		}
		$resultTime = date('Y-m-d H:i:s', strtotime($minTime.' minute ', strtotime($dateTime)));
		return $resultTime;
	}
	public function checkDuplicatEmail($email){
		$sql = "SELECT 
                    * 
                FROM 
                    app_password_manager 
                WHERE 
					user_email = '".$email."'";
        $query = $this->db->query($sql);
        $resultArr = $query->result_array();
		if(COUNT($resultArr)>0){
			return 'false';
		}else{
			return 'true';
		}	
			
	}
	public function checkDuplicatEmailCustomer($email){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$sql = "SELECT 
	            count(pass.user_id) As user_count
	        FROM 
	            app_password_manager AS pass,
	            app_customer_admin_relationship As rel 
	        WHERE
	        rel.local_admin_id = '".$local_admin_id."'
	        AND
	        rel.customer_id = pass.user_id
	        AND
	        pass.user_type = 1
	        AND
			pass.user_email = '".$email."'";
			$query = $this->db->query($sql);
			$resultArr = $query->result_array();
		
		if($resultArr[0]['user_count'] == 0){
			return 'true';
		}else{
			return 'false';
		}	
			
	}
	public function changeAppointmentStatus($statusId,$srvDtlsId){
        $data = array(
               'srvDtls_booking_status' => $statusId
            );
        $this->db->where('srvDtls_id', $srvDtlsId);
        $this->db->update('app_booking_service_details', $data);
    }	
	public function sendMail($customerMail,$subject,$mail_body,$from){
            $this->load->library('email');
            //$this->email->initialize($config);
            $this->email->from($from);
            $this->email->to($customerMail); 

            $this->email->subject($subject);
            $this->email->message($mail_body);	
            $this->email->set_mailtype("html");
            $this->email->send();
        }  
	public function deleteCustomer(){
            $customerId			= $this->session->userdata('user_id_customer');
            $local_admin_id		= $this->session->userdata('local_admin_id');
            /*****      CODE TO DELETE UPCOMING INTERVIEW STARTS        *****/
            
            $str = '';
            $str .= ' AND customer_id = '.$customerId;
            $str .= ' AND srvDtls_service_start >= now()';
            $Arr = $this->mainBookingStorePro($str);          
            if(isset($Arr)){
				foreach($Arr as $val){
                	$delApp = $this->changeAppointmentStatus(5,$val['srvDtls_id']);
            	}
			} 
            
            /*****      CODE TO DELETE UPCOMING INTERVIEW ENDS      *****/
            /*****      CODE TO DELETE FROM RELATION TABLE STARTS       *****/
			$this->db->where('local_admin_id', $local_admin_id);
			$this->db->where('customer_id', $customerId);
			$this->db->delete('app_customer_admin_relationship'); 
            /*****      CODE TO DELETE FROM RELATION TABLE ENDS     *****/
            $this->session->sess_destroy();
            return 1;
        }
	public function currencyFormat($money){
        $local_admin_id		= $this->session->userdata('local_admin_id');
		$this->db->select('currency_format_id');
        $this->db->from('app_local_admin');
        $this->db->where('local_admin_id',$local_admin_id);
        $query = $this->db->get();
        $currencyFormatArr = $query->result_array();
        $currencyFormat = $currencyFormatArr[0]['currency_format_id'];
        
        $money = number_format($money, 2);
        $moneyArr = explode(".",$money);
        
        $integer_money = $moneyArr[0];
        $float_money = $moneyArr[1];
        
        if($currencyFormat == 1){//XX,XXX.XX
            $returnCurrency = $integer_money.".".$float_money;
        }else{//XX.XXX,XX
            $returnCurrency = $float_money.".".$integer_money;
        }
        return $returnCurrency;
    }
    public function changeAppointmentStatusByCustomer($status,$serviceId){
            $srvDtls_booking_status = ($status == 'yes')?5:2;
            $data = array(
               'srvDtls_booking_status' => $srvDtls_booking_status
            );
            $this->db->where('srvDtls_id', $serviceId);
            $this->db->update('app_booking_service_details', $data);
            
    /////////### Send mail after cancel booking start ###
            
            $local_admin_id = $this->session->userdata('local_admin_id');
            $Appo_Info		= $this->getServiceDetails($serviceId);
	        $unit = $Appo_Info[0]['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
	        $AppointmentInfo = 'Service Name : '.$Appo_Info[0]['srvDtls_service_name'].'<br />'.'Staff name : '.$Appo_Info[0]['srvDtls_employee_name'].'<br />'.'Service Date : '.$Appo_Info[0]['srvDtls_service_start'].' To '.$Appo_Info[0]['srvDtls_service_end'].'<br />'.'Duration : '.$Appo_Info[0]['srvDtls_service_duration'].' '.$unit;
            

            $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
            
            $this->load->model('admin/Cms_model');
			$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
            
            
            $replacerArr = array(
								'{businessname}'			=> $this->session->userdata('ad_name'),
								'{fname}' 					=> $this->session->userdata('user_fname_customer'),
								'{lname}' 					=> $this->session->userdata('user_lname_customer'),
								'{AppointmentInfo}' 		=> $AppointmentInfo,
								'{businessemail}' 			=> $this->session->userdata('local_admin_email'),
								'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
								'{businessaddress}' 		=> $busi_address,
								'{cancellationpolicy}' 		=> nl2br($cancellationpolicy),
								
								);
			$toArr		= $this->session->userdata('user_email_customer');	
			
			$from		= $this->session->userdata('local_admin_email');				
            $this->email_model->sentMail(6,$replacerArr,$toArr,$from);
            //### Send mail after cancel booking end ###
            
            return 1;
        }      
	public function getServiceDetails($serviceId){
		$this->db->select('*');
		$this->db->from('app_booking_service_details');
		$this->db->where('srvDtls_id',$serviceId);
		$query = $this->db->get();
		$Appo_Info = $query->result_array();
		return $Appo_Info;
	}
    /*****      NEED TO BE DELETED      *****/
    public function mainBizSchedule_sr($string='',$starting=''){
		$storedProcedure 	= $this->load->database('stored_procedure', TRUE);
		$local_admin_id		= $this->session->userdata('local_admin_id');
		$time_difference	= $this->session->userdata('time_difference');						 
		$Sql = "call getWorkTime('".$local_admin_id."',
								'".$time_difference."',
								'".$string."',
								'".$starting."')";							
		$ServcBookingList = $storedProcedure->query($Sql);
		$ResArr = $ServcBookingList->result_array();
		return $ResArr;
	}	
	public function show_to_control($input){
		return mb_convert_encoding($input,'HTML-ENTITIES');
	}	
	public function show_to_control_array($input){
		$output = array();
		foreach($input as $key=>$val){
			$output[$key] = mb_convert_encoding($val,'HTML-ENTITIES');
		}
		return $output;
	}	
	public function db_parse($input){
	     
		 if(is_array($input)){
		 	$output = array();
			foreach($input as $k=>$val){
				$output[$k] = mb_convert_encoding($val,'ISO-8859-15','utf-8');
			}
			return $output;
		 }
	    
		return mb_convert_encoding($input,'ISO-8859-15','utf-8');
	}
	public function ConvToClienttime($gmt,$timediff='') {
        if(empty($timediff)){
            $local_admin_id = $this->session->userdata('local_admin_id');
            $settings = $this->page_model->getFrontEndSettings($local_admin_id);
            $gmtSymbol = $settings[0]['gmt_symbol'];
            $gmtValue = $settings[0]['gmt_value'];
            $symbol = ($gmtSymbol==0)?"-":"+";
            $timediff = $symbol.$gmtValue;
        }
        $offset = substr($timediff,0,1);
        //echo $offset;
        $timeval  = substr($timediff,1);
        $timeArr = explode(":", $timeval);
        $addtime = ($timeArr[0]*3600)+($timeArr[1]*60)+$timeArr[2];
        return $localtime = $gmt +  ($offset.$addtime);
    }
	public function authArray(){
		return $this->session->userdata('authKey');
	}
	public function GetLocalAdminAuth($local_admin_id){
		if($local_admin_id != ''){
			
			$sql = "";
			$sql .="SELECT 
						*
					FROM
						app_member_plan_subscription
					WHERE
						is_active = 'Y'
						AND
						local_admin_id = ".$local_admin_id;
							
			$result=$this->db->query($sql);
			$resultArr = $result->result();					
			$feature_array = array();
			if(count($resultArr) > 0){
			$planFuture	= json_decode($resultArr[0]->feature_desc, true);
    		foreach($planFuture as $key=>$planFutureArr){  			
    			$feature_array[$key] = $planFutureArr['feature_id'];
            }
            }
             $auth_array = array(
                                      'authKey'   => $feature_array
                              );
            $this->session->unset_userdata($auth_array);			
			$this->session->set_userdata($auth_array);
			}
		}
	public function GetBusinessDetails($local_admin_id){
		if($local_admin_id != ''){
			$sql = "";
			$sql .="SELECT 
						currency.currency_symbol AS currency,
						currency.currency_id AS currency_id,
						currency.currency_abbriviation AS abbriviation,
						gmt.gmt_value AS gmt_value,
						gmt.gmt_symbol AS gmt_symbol,
						time.time_format AS time_format,
						date.date_format AS date_format,
						admin.page_title AS title,
						admin.country_id AS ad_country,
						admin.region_id AS ad_region,
						admin.city_id AS ad_cityId,
						admin.first_name AS ad_fname,
						admin.last_name AS ad_lname,
						admin.home_phone AS ad_hphone,
						admin.work_phone AS ad_wphone,
						admin.mobile_phone AS ad_mobile,
						admin.business_logo AS ad_logo,
						admin.business_name AS ad_name,
						admin.business_location AS ad_location,
						admin.business_city_id AS ad_city,
						admin.business_state_id  AS ad_state,
						admin.business_zip_code  AS ad_zip,
						admin.business_phone AS ad_businessPhone,
						admin.facebook_link AS ad_facebook,
						admin.youtube_link AS ad_youtube,
						admin.google_link AS ad_google,
						admin.twitter_link AS ad_twitter,
						admin.linkedin_link AS ad_linkedin,
						ladmin.user_email AS ladmin_email
					FROM
						app_local_admin AS admin,
						app_currency AS currency,
						app_time_zone AS gmt,
						app_time_format AS time,
						app_date_format AS date,
						app_password_manager As ladmin
					WHERE
						admin.currency_id = currency.currency_id
						AND
						admin.time_zone_id = gmt.time_zone_id
						AND
						admin.time_format_id = time.time_format_id
						AND
						admin.date_format_id = date.date_format_id
						AND
						admin.local_admin_id = ".$local_admin_id."
						AND
						ladmin.user_id = ".$local_admin_id;
					
		
			$result=$this->db->query($sql);
			$resultArr = $result->result();
			
			if ((is_array($resultArr)) && (array_key_exists(0, $resultArr)))
			{
				$this->session->unset_userdata($resultArr[0]);
				$this->session->set_userdata($resultArr[0]);
			}
		}
	} 

	public function isSuspended(){
		$local_admin_id = $this->session->userdata('local_admin_id');		
	        $sql = "SELECT 
	                    is_active 
	                FROM 
	                    app_local_admin 
	                WHERE 
	                    local_admin_id = ".$local_admin_id ;
	        $query = $this->db->query($sql);
	        $Arr = $query->result_array();
	        
	        
	        return $Arr[0]['is_active'];
	}

	public function checkSession(){
		$logged_in_Status = $this->session->userdata('logged_in');
		$local_admin_id = $this->session->userdata('local_admin_id');
		$user_id_local_admin = $this->session->userdata('user_id_local_admin');
		
		if($this->isSuspended()=='Y')
		{
			if(!$logged_in_Status){
				redirect(base_url().'admin/login');
			}
			else
			{
				if($user_id_local_admin != $local_admin_id)
				{
					$this->session->sess_destroy();
					redirect(base_url());
				}
			}
		}
		else
		{
			$this->session->sess_destroy();
			echo '<script>window.location = "'.base_url().'admin/login";</script>';
		}
	} 
	
	public function locationDetails(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		if($local_admin_id !=''){
		$sql = 'SELECT
				 sub.is_multilocation As is_multilocation ,
				 sub.no_of_location As no_of_location,
				 count(rel.relation_id) AS total_no_location
				FROM
				 app_member_plan_subscription sub
				LEFT JOIN
				 app_localadmin_relation rel
				ON
				 rel.relation_parent_id=sub.local_admin_id
				WHERE
				 sub.local_admin_id="'.$local_admin_id.'"
				AND
				 sub.is_active="Y"
				GROUP BY
				 local_admin_id
			';
			$query = $this->db->query($sql);
			$Arr = $query->result();
			$query = $this->db->query($sql);
			$Arr = $query->result();
			$this->session->unset_userdata($Arr[0]);
			$this->session->set_userdata($Arr[0]);
		}	
	} 
		
	public function checkexistanceforeign(){
		$dataid = $this->input->post('dataid');
		$columnId1 = $this->input->post('columnId1');
		$columnId2 = $this->input->post('columnId2');
			
			$sql = 'SELECT DISTINCT 
									cus.'.$columnId1.', 
									country.'.$columnId2.'
								FROM 
									app_customer_search cus, 
									app_local_admin country
								WHERE 
									cus.'.$columnId1.' ="'.$dataid.'"
								AND 
									country.'.$columnId2.' ="'.$dataid.'"';
									
								
									
	        $query = $this->db->query($sql);
        	$Arr = $query->result_array();
			
			if(isset($Arr)){
				if(count($Arr) == 0){
					echo 1;
				}
				else{
					echo 0;
				}
			}else{
				echo 0;
			}	
	}
	
}
