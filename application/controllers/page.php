<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Page extends Pardco {
    public function __construct(){
        parent::__construct();
        $this->load->model('page_model');
        $this->load->model('info_model');
        $this->load->model('customer/customer_registration_model');
        $this->load->model('payment_pro_model');
        $this->load->model('customer/customer_model');
        //$this->load->library('facebook_post/Facebook');
        $logged_in_Status_customer = $this->session->userdata('logged_in_customer');  
        $default_language = strtolower($this->session->userdata('default_language_type'));
        
        if($this->session->userdata('selected_lang') == ''){
            $this->lang->load('page',$default_language);
            $this->lang->load('calendar',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('selected_lang'));
            $this->lang->load('page',$setLanguage);
            $this->lang->load('calendar',$setLanguage);
        }
    }	
    
    public function index(){
		$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'Tablet' : 'Phone') : 'Computer');
		$local_admin_id			= $this->customer_registration_model->GetLocalAdmin();
		$isSuspended			= $this->global_mod->isSuspended();
        $default_language = strtolower($this->session->userdata('default_language_type'));
        if($this->session->userdata('selected_lang') == ''){
            $this->lang->load('page',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('selected_lang'));
            $this->lang->load('page',$setLanguage);
        }
	$data['show_header'] = $this -> page_model -> get_show_frontend_header($local_admin_id);
         
		if($detect->isMobile()== FALSE ){
		//########################## This part only for computer start ##########################
        $data['menu']							= $this->pardco_model->frontend_menu();
        $data['logged_in_customer']             = $this->session->userdata('logged_in_customer');
        $check_bus_hour							= $this->page_model->check_view_user_status();
        $check_user_email_veri                  = $this->page_model->check_user_email_veri_status();
        $data['checkFrontendDisplayStatus']     = $this->page_model->checkFrontendDisplayStatus();
        $data['lang_list']			            = $this->page_model->language_listings($local_admin_id);
        $data['user_name']			            = $this->page_model->CustomerName();
        $data['Ret_Arr_val']                    = $this->page_model->SelectedLang();
        $data['service_list']                   = $this->page_model->getServiceList($local_admin_id);
        $data['employee_list']                  = $this->page_model->getEmployeeList($local_admin_id);
        $data['business_logo']                  = $this->page_model->getBusinessLogo($local_admin_id);
        $data['local_admin_settings']           = $this->page_model->getFrontEndSettings($local_admin_id);
        $data['address']						= $this->page_model->getAdminAddress();
        $data['local_admin_email']              = $this->page_model->getLocalAdminEmail();
        $customerLoginId						= $this->session->userdata('user_id_customer');
        $data['review_list']                    = $this->page_model->getReviewList(); //array('rating'=>2, 'rating_desc'=>'hello');
        $data['business_location']              = $this->page_model->getBusinessLocation($local_admin_id);
        if($customerLoginId !=''){
            $data['customerLoginId'] = $customerLoginId;
        }else{
            $data['customerLoginId'] = 0;
        }	
	 //############################# For Holding data after loging or booking start############################# 
	 
	 $booking_bTime = $this->session->userdata('bTime');
	 if($booking_bTime !=''){
        $staffArr = $this->session->userdata('staffArr');
			
        if(count($staffArr)>0){
            $booking_staffArr = implode(",", $this-> session-> userdata('staffArr'));
        }else{
            $booking_staffArr = "";
        }
        $booking_srvArr = implode(",", $this-> session-> userdata('srvArr'));
        $secStr = '';
        $secStr .= '<input type="hidden" value="'.$booking_bTime.'" id="contro_bTime">';
        $secStr .= '<input type="hidden" value="'.$booking_staffArr.'" id="contro_staffArr">';
        $secStr .= '<input type="hidden" value="'.$booking_srvArr.'" id="contro_srvArr">';
        $secStr .= '';
        $data['controBookingArr'] = $secStr;
        $set_user_data = array(
                                'bTime'		=> '',
                                'staffArr'	=> '',
                                'srvArr'	=> ''
                                );
        $this->session->set_userdata($set_user_data); 
	 }else{
        $data['controBookingArr'] = '';
	 }
	 
	 $registration_bTime = $this-> session-> userdata('reg_bTime');
	 if($registration_bTime !=''){
        $regStaffArr = $this->session->userdata('reg_staffArr');
        if(count($regStaffArr)>0){
            $registration_staffArr = implode(",", $this-> session-> userdata('reg_staffArr'));
        }else{
            $registration_staffArr = "";
        }
		$registration_srvArr = implode(",", $this-> session-> userdata('reg_srvArr'));
	 	$secStr = '';
		$secStr .= '<input type="hidden" value="'.$registration_bTime.'" id="reg_bTime">';
		$secStr .= '<input type="hidden" value="'.$registration_staffArr.'" id="reg_staffArr">';
		$secStr .= '<input type="hidden" value="'.$registration_srvArr.'" id="reg_srvArr">';
		$secStr .= '';
	 	$data['regBookingArr'] = $secStr;
		$set_user_data = array(
            'reg_bTime'		=> '',
            'reg_staffArr'	=> '',
            'reg_srvArr'	=> ''
		);
      	$this->session->set_userdata($set_user_data); 
	 }else{
	 	$data['regBookingArr'] ='';
	 }
	 
	 $hold_bTime = $this-> session-> userdata('hold_bTime');
	 if($hold_bTime !=''){
        $holdStaffArr = $this->session->userdata('hold_staffArr');
        if(count($holdStaffArr)>0){
		    $hold_staffArr = implode(",", $this-> session-> userdata('hold_staffArr'));
        }else{
            $hold_staffArr = "";
        }
		$hold_srvArr = implode(",", $this-> session-> userdata('hold_srvArr'));
	 	$secStr = '';
		$secStr .= '<input type="hidden" value="'.$hold_bTime.'" id="hold_bTime">';
		$secStr .= '<input type="hidden" value="'.$hold_staffArr.'" id="hold_staffArr">';
		$secStr .= '<input type="hidden" value="'.$hold_srvArr.'" id="hold_srvArr">';
		$secStr .= '';
	 	$data['holdBookingArr'] = $secStr;
		$set_user_data = array(
                                'hold_bTime'	=> '',
                                'hold_staffArr'	=> '',
                                'hold_srvArr'	=> ''
		            	      );
      	$this->session->set_userdata($set_user_data); 
	 }else{
	 	$data['holdBookingArr'] ='';
	 }
	  //############################# For Holding data after loging or booking end #############################
      $dateArr = $this->dateRange();    
      $start_date = $dateArr['start_date'];
      $end_date = $dateArr['end_date'];

      $footer = $this->pardco_model->footer_link_frontend();
    		if($isSuspended == 'Y'){
    			if($data['checkFrontendDisplayStatus'] == 1 ){
    				if(count($data['employee_list'])>0){
						if(count($data['service_list'])>0){
							if($check_bus_hour && $check_user_email_veri != 0){
								$this->load->view('frontend/header');
								$this->load->view('frontend/nevigation',$data);	
								$this->load->view('frontend/page', $data);
								$this->load->view('frontend/footer',$footer);
							}else{
								$alertData['alertMsg'] = 'Please check business hour from admin or email activation link to activate the scheduler.';
								$this->load->view('frontend/upgradeAuth',$alertData);
							}
						}else{
							$alertData['alertMsg'] = 'Please enter at least one active service to activate the scheduler.';
							$this->load->view('frontend/upgradeAuth',$alertData);
						}
					}else{
						$alertData['alertMsg'] = 'Please enter at least one active staff to activate the scheduler.';
						$this->load->view('frontend/upgradeAuth',$alertData);
					}
				}else{
					$alertData['alertMsg'] = 'maintenance';
					$this->load->view('frontend/upgradeAuth',$alertData);
				}	
			}else{
				$alertData['alertMsg'] = 'The scheduler is closed by administrator.';
				$this->load->view('frontend/upgradeAuth',$alertData);
			}
	
		//########################## This part only for computer part end ########################## 
		}else{
		//########################## This part only for tablet & Mobile start ##########################

            $data_nav['review_list']                = $this->page_model->getReviewList();
			$data_nav['logged_in_customer']			= $this->session->userdata('logged_in_customer');
            $data_nav['business_logo']              = $this->page_model->getBusinessLogo($local_admin_id);
            $data_nav['user_name']                  = $this->page_model->CustomerName();
            if($data_nav['logged_in_customer'] == 1){
                $data_nav['pastDataArr'] = $this->page_model->getPastBookingData();
                $data_nav['nextDataArr'] = $this->page_model->getNextBookingData();
            }
            $data['country']                        = $this->page_model->getCountry();
			$data['service_list']                   = $this->page_model->getServiceList($local_admin_id);
        	$data['employee_list']                  = $this->page_model->getEmployeeList($local_admin_id);
			$data['local_admin_settings']           = $this->page_model->getFrontEndSettings($local_admin_id);
            $data['review_list']                    = $this->page_model->getReviewList();
            $data['address']						= $this->page_model->getAdminAddress();
            $data['local_admin_email']              = $this->page_model->getLocalAdminEmail();
            $data['settings']                       = $this->mobileLocalAdminSettings();
             $data['checkFrontendDisplayStatus']     = $this->page_model->checkFrontendDisplayStatus();
             $check_bus_hour							= $this->page_model->check_view_user_status();
        $check_user_email_veri                  = $this->page_model->check_user_email_veri_status();
        $data['checkFrontendDisplayStatus']     = $this->page_model->checkFrontendDisplayStatus();
        $data['lang_list']			            = $this->page_model->language_listings($local_admin_id);
        $data['user_name']			            = $this->page_model->CustomerName();
        $data['Ret_Arr_val']                    = $this->page_model->SelectedLang();
        $data['service_list']                   = $this->page_model->getServiceList($local_admin_id);
        $data['employee_list']                  = $this->page_model->getEmployeeList($local_admin_id);


			if($isSuspended == 'Y'){
    			if($data['checkFrontendDisplayStatus'] == 1 ){
    				if(count($data['employee_list'])>0){
						if(count($data['service_list'])>0){
							if($check_bus_hour && $check_user_email_veri != 0){
								$this->load->view('frontend/mobile/header');
								$this->load->view('frontend/mobile/nevigation',$data_nav);
								$this->load->view('frontend/mobile/page',$data );
								$this->load->view('frontend/mobile/footer');
							}else{
								$alertData['alertMsg'] = 'Please check business hour from admin or email activation link to activate the scheduler.';
								$this->load->view('frontend/mobile/upgradeAuth',$alertData);
							}
						}else{
							$alertData['alertMsg'] = 'Please enter at least one active service to activate the scheduler.';
							$this->load->view('frontend/mobile/upgradeAuth',$alertData);
						}
					}else{
						$alertData['alertMsg'] = 'Please enter at least one active staff to activate the scheduler.';
						$this->load->view('frontend/mobile/upgradeAuth',$alertData);
					}
				}else{
					$alertData['alertMsg'] = 'maintenance';
					$this->load->view('frontend/mobile/upgradeAuth',$alertData);
				}	
			}else{
				$alertData['alertMsg'] = 'The scheduler is closed by administrator.';
				$this->load->view('frontend/mobile/upgradeAuth',$alertData);
			}
		//########################## This part only for tablet & Mobile end ##########################
		}
    }
    //get list of options in mobile theme
    
    public function getMobileMenu(){
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $lang_list = $this->page_model->language_listings($local_admin_id);
        $str = '';
        $str .= '<div id="popup_name">';
        $str .= '<ul class="popupMainMenu">';
        $str .= '<li class="seLanguage">'.$this->global_mod->db_parse($this->lang->line('mobile_select_language')).'</li>';
        foreach($lang_list as $language){
            $str .= '<li class="language" onclick="changeLanguage('.$language['languages_id'].')"><img src="/uploads/language/'.$language['image'].'" alt="" class="ui-li-icon">'.$language['languages_name'].'</li>';
        }
        $logged_in_customer = $this->session->userdata('logged_in_customer');
        if($logged_in_customer == TRUE){
            $str .= '<li class="popMenu" onclick="appointmentsFn()"><a href="#">'.$this->global_mod->db_parse($this->lang->line('myappo')).'</a></li>';
		    $str .= '<li class="popMenu" onclick="informationFn()"><a href="#">'.$this->global_mod->db_parse($this->lang->line('modifymyinfo')).'</a></li>';
            $str .= '<li class="popMenu" onclick="logOutFn()"><a href="#">'.$this->global_mod->db_parse($this->lang->line('logout')).'</a></li>';
        }else{
            $str .= '<li class="popMenu" onclick="existingLoginFn()"><a href="#">'.$this->global_mod->db_parse($this->lang->line('login')).'</a></li>';
		    $str .= '<li class="popMenu" onclick="newLoginFn()"><a href="#">'.$this->global_mod->db_parse($this->lang->line('newuser')).'</a></li>';
        }
        $str .= '</ul></div>';
        echo $str; 
    }
    //get currency format
    
    public function currencyFormat($money){
        $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $currencyFormatArr = $this->page_model->getCurrencyFormat($local_admin_id);
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
  
    public function dateRange($start_date='',$end_date=''){
        $start_dt=($start_date=='')?date("Y-m-d"):$start_date;
        $day = 30;
        $startdatetimestamp = strtotime($start_dt);
        $enddatetimestamp = $startdatetimestamp + $day*24*60*60;
        $end_date = date("Y-m-d", $enddatetimestamp);
        $dateArr['start_date'] = $start_dt;
        $dateArr['end_date'] = $end_date;
        return $dateArr;
    }        
    //fetching block time
    
    public function fn_fetch_block_time(){
    	$local_admin_id			=	$this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings	=	$this->page_model->getFrontEndSettings($local_admin_id);
    	$showStaff 				= 	intval($local_admin_settings[0]['showStaffCustomers']);
        $staffMandatory			=	intval($local_admin_settings[0]['staffSelectionMandatory']);
		if($showStaff == 0){
			return $this->notAvailableStaffBlockTiming();
		}else{
			if( $staffMandatory == 0){
				return $this->notAvailableStaffBlockTiming();
			}else{
				return $this->availableStaffBlockTiming();
			}
		}
    }
    
    public function notAvailableStaffBlockTiming(){
		$dateArr = $this->dateRange();    
        $start_date = $dateArr['start_date'];
        $end_date = $dateArr['end_date'];
        $pieces = explode(":",$this->session->userdata('time_difference_sp')); 
		$timeDiff	= $pieces[0]*3600+$pieces[1]*60;
		$sign		= ($this->session->userdata('symbol_sp')==1)?'+':'-';
		
		$sql ="Select conver_epoc(".$timeDiff.",'".$sign."') diffTime";
		$query = $this->db->query($sql);
        $Arr = $query->result_array();
		$diffTime = isset($Arr[0]['diffTime'])?$Arr[0]['diffTime']:0;
		$select ="*, UNIX_TIMESTAMP(cast( concat(cast(block_date as CHAR),\' \',cast(time_form as char) ) as DATETIME))-".$diffTime." epoch_block_from_time,
 UNIX_TIMESTAMP(cast( concat(cast(block_date as CHAR),\' \',cast(time_to as char) ) as DATETIME))-".$diffTime."  epoch_block_from_to";
        $str = '';
        $str .= ' AND DATE_FORMAT(block_date,"%Y-%m-%d") BETWEEN CAST("'.$start_date.'" AS date) AND CAST("'.$end_date.'" AS date)';
        $str .= ' AND is_active = "Y"';
        $block_time_arr = $this->global_mod->staffBlockingStorePro($str,$select);
        $return_arr = array();
        $previousDate = '';
        $previousStaff = '';
        $cnt =0;
        $s =0;
		$date_cnt =0;
		$staff_cnt =0;
        $finalArr = array();
        foreach($block_time_arr as $key=>$val){
		
			if($previousStaff != $val['employee_id']){
				$return_arr[$staff_cnt]['staff']			= $val['employee_id'];
				$return_arr[$staff_cnt]['service']			=$this->page_model->staffWiseService($val['employee_id']);
				$return_arr[$staff_cnt]['staff_details']	= array();
				$previousStaff 								= $val['employee_id'];
				$old_staff_cnt 								= $staff_cnt;
				$cnt =0;
				$staff_cnt++;
			}
		
		    $return_arr[$old_staff_cnt]['staff_details'][$cnt]['time_form'] = $val['epoch_block_from_time'];
		    $return_arr[$old_staff_cnt]['staff_details'][$cnt]['time_to'] 	= $val['epoch_block_from_to'];
		
		     $cnt++;
        }  
        
        echo json_encode(array_values($return_arr));	
     }
   
    public function availableStaffBlockTiming(){
		$dateArr = $this->dateRange();    
        $start_date = $dateArr['start_date'];
        $end_date = $dateArr['end_date'];
        $pieces = explode(":",$this->session->userdata('time_difference_sp')); 
		$timeDiff	= $pieces[0]*3600+$pieces[1]*60;
		$sign		= ($this->session->userdata('symbol_sp')==1)?'+':'-';
		
		
		$sql ="Select conver_epoc(".$timeDiff.",'".$sign."') diffTime";
		$query = $this->db->query($sql);
        $Arr = $query->result_array();
		
		$diffTime = isset($Arr[0]['diffTime'])?$Arr[0]['diffTime']:0;
		
		$select ="*, UNIX_TIMESTAMP(cast( concat(cast(block_date as CHAR),\' \',cast(time_form as char) ) as DATETIME))-".$diffTime." epoch_block_from_time,
 UNIX_TIMESTAMP(cast( concat(cast(block_date as CHAR),\' \',cast(time_to as char) ) as DATETIME))-".$diffTime."  epoch_block_from_to";
        $str = '';
        $str .= ' AND DATE_FORMAT(block_date,"%Y-%m-%d") BETWEEN CAST("'.$start_date.'" AS date) AND CAST("'.$end_date.'" AS date)';
        $str .= ' AND is_active = "Y"';
        $block_time_arr = $this->global_mod->staffBlockingStorePro($str,$select);
        $return_arr = array();
        $previousDate = '';
        $previousStaff = '';
        $cnt =0;
        $s =0;
		$date_cnt =0;
		$staff_cnt =0;
        $finalArr = array();
        foreach($block_time_arr as $key=>$val){
		
			if($previousStaff != $val['employee_id']){

				$return_arr[$staff_cnt]['staff'] = $val['employee_id'];
				$return_arr[$staff_cnt]['staff_details'] = array();
				$previousStaff = $val['employee_id'];
				$old_staff_cnt = $staff_cnt;
				$cnt =0;
				$staff_cnt++;
			}
		
		    $return_arr[$old_staff_cnt]['staff_details'][$cnt]['time_form'] = $val['epoch_block_from_time'];
		    $return_arr[$old_staff_cnt]['staff_details'][$cnt]['time_to'] = $val['epoch_block_from_to'];
		
		     $cnt++;
        }
		
        echo json_encode(array_values($return_arr));
	}
    
    //getting local admin settings
    
    public function fn_local_admin_settings(){
        $settings = array();
        $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
        $settings['adminId'] = intval($local_admin_settings[0]['adminId']);
        $settings['multipleServicesBooking'] = intval($local_admin_settings[0]['multiple_services_booking']);
        $settings['enable_system'] = intval($local_admin_settings[0]['enable_system']);
        $settings['noOfBooking'] = intval($local_admin_settings[0]['noOfBooking']);
        $settings['noOfBookingPeriod'] = intval($local_admin_settings[0]['noOfBookingPeriod']);
        $settings['bookingStartingPoint'] = $local_admin_settings[0]['bookingStartingPoint'];
        $settings['noOfBookingPeriodFrom'] = $local_admin_settings[0]['noOfBookingPeriodFrom'];
        $settings['noOfBookingPeriodTo'] = $local_admin_settings[0]['noOfBookingPeriodTo'];
        $settings['recurringAppointments'] = intval($local_admin_settings[0]['recurringAppointments']);
        $settings['showServiceCost'] = intval($local_admin_settings[0]['showServiceCost']);
        $settings['showServiceTimeDuration'] = intval($local_admin_settings[0]['showServiceTimeDuration']);
        $settings['clientsNameWithReviews'] = intval($local_admin_settings[0]['clientsNameWithReviews']);
        $settings['detectClientTimezone'] = intval($local_admin_settings[0]['detectClientTimezone']);
        $settings['bookedTimesStriked'] = intval($local_admin_settings[0]['bookedTimesStriked']);
        $settings['blockedTimesStrikedOut'] = intval($local_admin_settings[0]['blockedTimesStrikedOut']);
        $settings['defaultView'] = intval($local_admin_settings[0]['defaultView']);
        $settings['calStrtingWeekday'] = intval($local_admin_settings[0]['calStrtingWeekday']);
        $settings['calStrtingDt'] = $local_admin_settings[0]['calStrtingDt'];
        $settings['showStaffCustomers'] = intval($local_admin_settings[0]['showStaffCustomers']);
        $settings['staffSelectionMandatory'] = intval($local_admin_settings[0]['staffSelectionMandatory']);
        $settings['calTimeIntervalTyp'] = intval($local_admin_settings[0]['calTimeIntervalTyp']);
        $settings['calTimeIntervalVariable'] = intval($local_admin_settings[0]['calTimeIntervalVariable']);
        $settings['advBkMxTim'] = intval($local_admin_settings[0]['advBkMxTim']);
        $settings['advBkMinSetting'] = intval($local_admin_settings[0]['advBkMinSetting']);
        $settings['advBkMinTim'] = intval($local_admin_settings[0]['advBkMinTim']);
		//$settings['advBkMinTim'] = intval($local_admin_settings[0]['advBkMinTim']);
        $settings['pre_booking_frm'] = intval($local_admin_settings[0]['pre_booking_frm']);
        $settings['gmtSymbol'] = intval($local_admin_settings[0]['gmt_symbol']);
        $settings['gmtValue'] = $local_admin_settings[0]['gmt_value'];
		$settings['internationalUsers'] = $local_admin_settings[0]['allow_international_users'];
		$settings['hours_type'] = intval($local_admin_settings[0]['hours_type']);
		$settings['show_block_timinig'] = intval($local_admin_settings[0]['show_block_timinig']);
		$settings['adv_bk_mx_tim'] = intval($local_admin_settings[0]['adv_bk_mx_tim']);
        $settings['currentDate'] = gmdate("d-m-Y");
        $settings['currentTime'] = gmdate("H-i-s");
		$settings['pre_pmnt_setting'] = intval($local_admin_settings[0]['pre_pmnt_setting']);

        $settings['pr_filed_count'] = $this->page_model->chkPreBooking();
        
        echo json_encode(array($settings));
    }  
    //getting booking details
    
    public function fn_booking_details(){
        $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $dateArr = $this->dateRange();    
        $start_date = $dateArr['start_date'];
        $end_date = $dateArr['end_date'];
        //$local_admin_settings = $this->page_model->getBookingDetails($local_admin_id,$start_date,$end_date);
        $local_admin_settings = $this->page_model->getBookingDetails_rev($local_admin_id,$start_date,$end_date);
       
       //	echo '<pre>';
       // print_r($local_admin_settings);
      //  echo '</pre>';
      //*  ########### PROBLEM MAY ARISE WITHIN THIS SECTION   #######################
        $sett_ser = serialize(array_values($local_admin_settings));
        $value = mb_check_encoding($sett_ser, 'UTF-8') ? $sett_ser : utf8_encode($sett_ser);
        $value = preg_replace( '!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $value );
        $value = preg_replace( '/;n;/', ';N;', $value );
        $new_local_admin_settings = unserialize($value);
        echo json_encode($new_local_admin_settings);
       // ########### PROBLEM MAY ARISE WITHIN THIS SECTION    #######################*/
    }
    //checking whether user is logged in or not
    
    public function fn_checkLogIn() {
		$user_data = $this->session->userdata('user_id_customer');
		if($user_data != ''){
			echo 0;
		}else{
			echo 1;
		}
    }
    //checking service dependency
    
    public function checkServiceDependency($serviceArr){
        $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $dependencyArr = array();
        $nonDependencyArr = array();
        $finalDepArr = array();
        sort($serviceArr);
        $non_dep_array = $this->page_model->non_dependent($local_admin_id);
        $dep_array = $this->page_model->dependent($local_admin_id);
        foreach($dep_array as $val_dep){
            array_push($dependencyArr, $val_dep['dependent_service_id']);
        }
        foreach($non_dep_array as $val_non_dep){
            array_push($nonDependencyArr, $val_non_dep['non_dependent_service_id']);
        }
        sort($dependencyArr);
        sort($nonDependencyArr);
        foreach($serviceArr as $val_final){
            if(count($finalDepArr)==0){
                array_push($finalDepArr,$val_final);
            }else{
                if(in_array($val_final,$nonDependencyArr)){
                    array_unshift($finalDepArr, $val_final);
                }else if(in_array($val_final,$dependencyArr)){
                    array_push($finalDepArr,$val_final);
                }else{//  IF SERVICE IS NOT PRESENT IN ANY ARRAY
                    array_push($finalDepArr,$val_final);
                }
            }
        }
        return $finalDepArr;
    }
    //checking staff availability
    
    public function checkWhetherStaffAvailable($bookTime,$val){
        $availablity = $this->page_model->checkStaffAvailability($bookTime,$val);
        return $availablity;
    }
    //gmt to local time
    
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
    //fetching business time 
       
    public function getStaffFromBizHour($bookTime,$service_id){
        $staffFromBizHour = $this->page_model->checkStaffFromBizHour($bookTime,$service_id);
        return $staffFromBizHour;
    }
    
    public function fn_bookingForm(){
		date_default_timezone_set('GMT');
        $bookTime = $this->input->post('bookTime');
        $timeDiff =  $this->input->post('timeDiff');         
        $serviceArr = $this->input->post('service');
        $staffArr = $this->input->post('staff');
        $admin_settings = $this->fnp_localAdminSettings();
        
        if($admin_settings[0]['noOfBooking']== 0){	//    NO RESTRICTION ON BOOKING NUMBER
            $mainHtml = $this->fnp_htmlGenerator($bookTime,$serviceArr,$staffArr);
            echo $mainHtml;
        }else{//    RESTRICTION ON BOOKING NUMBER
            if($this->fup_checkNumberOfBooking($bookTime)==0){//    IF BOOKING NUMBER DOES NOT EXCEED RESTRICTION
                $mainHtml = $this->fnp_htmlGenerator($bookTime,$serviceArr,$staffArr);
                echo $mainHtml;
            }else{//    IF BOOKING NUMBER EXCEEDS RESTRICTION
                $errorHtml = $this->fnp_maxAttpHtmlGenerator();
                echo $errorHtml;
            }
        }
       
    }
   
    public function fn_prBookingForm(){
    	$services = $this->input->post('service');
    
    	
		$local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
        
		if($local_admin_settings[0]['pre_booking_frm']==1){
			$this->page_model->genaretPreBookingForm($services);
		}else{
			
		}			
    }
	
	function fnp_preBookingFormSubmit(){
		
		$postArr = $this->input->post('params');
		
		$arr1=array();
		foreach($postArr as $val){
		

			$arr1[$val['field_name']]=$val['field_value'];
		}
				
		$postArr=$arr1;
		$arr=array();
		$count=0;
		$localArr=array();
		foreach($postArr As $postElm=>$postVal){
			//echo $postElm.'<br>';
			$nameArr=explode('_', $postElm);
			$name ='';
			for($i=1;$i<count($nameArr);$i++){
				$name.=$nameArr[$i].' ';
			}
			$localArr[$count]['postName']=$name;
			$localArr[$count]['postValue']=$postVal;
			
			//$arr[$count]=$name."^#@#@#^".$postVal;
			$count++;
		}
		
		//$ret=implode('~#@#@#~',$arr);
		//echo $ret;
		echo json_encode($localArr);		
	}
   
    public function chooseStaffFrmArr($staffArr,$bookTime){
        $noOfStaff = count($staffArr);
        if($noOfStaff > 0){
            foreach($noOfEmpFromBizHourArr as $val){
                $noOfEmpFromTemp = $this->page_model->checkStaffFromTemp($bookTime,$val['employee_id']); //  CHECK FROM TEMP TABLE
                if($noOfEmpFromTemp == 0){
                    /*$noOfEmpFromBlockDate = $this->page_model->checkStaffFromBlockDate($bookTime,$val['employee_id']);
                    if($noOfEmpFromBlockDate == 0)
                    {*/
                        $noOfEmpFromBlockTime = $this->page_model->checkStaffFromBlockTime($bookTime,$val['employee_id']); //  CHECK FROM TEMP TABLE
                        if($noOfEmpFromBlockTime == 0){
                            $staffAvailable++;
                            array_push($staffArr,$val['employee_id']);
                        }
                    //}
                }
            }
        }
    }
    
    public function fnp_bookingAppointment(){
        $bookingData = $this->input->post('bookingData');
        $totRow = count($bookingData);
        $no_of_row = $totRow/5;
        $j=1;
        $returnArr = array();
        for( $i=0; $i<=$no_of_row;$i++){           
           foreach($bookingData as $val){ 
                $chk_val = $val['name'];
                if( $chk_val == 'service_time_'.$i  ){
                  $returnArr[$i]['service_time'] =  $val['value'];
                }
                if( $chk_val == 'service_date_'.$i  ){
                  $returnArr[$i]['service_date'] =  $val['value'];
                }
                if( $chk_val == 'service_id_'.$i  ){
                  $returnArr[$i]['service_id']  =  $val['value'];
                }
                if(  $chk_val == 'service_staff_'.$i  ){
                  $returnArr[$i]['service_staff']  =  $val['value'];
                }
                if( $chk_val == 'temp_id_'.$i  ){
                  $returnArr[$i]['temp_id']  =  $val['value'];
                }
                if( $chk_val == 'service_capacity_'.$i  ){
                  $returnArr[$i]['service_capacity'] =  $val['value'];
                }               
           }           
        }
        $insert = $this->page_model->saveBookingData($returnArr);
        if($insert == 1){
            echo 1;
        }else{
            echo 0;
		}
    }
    
    public function checkBusinessHour($time,$service_id,$staff_id,$dayId){
        $str ='';
        $str .=' AND employee_id = '.$staff_id;
        $str .=' AND day_id = '.$dayId;
        $str .=' AND service_id = '.$service_id;
        $str .=' AND CAST("'.$time.'" AS TIME) >= time_from ';
        $str .=' AND CAST("'.$time.'" AS TIME) < time_to ';
        $data = $this->global_mod->mainBizSchedule($str);
        /*if(count($data))
        {
            print_r($data);
        }*/
    }
   
    public function fnp_dynamicHtml($time,$service_name,$service_id,$staff_id,$loop,$bookTime){	
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);

        $admin_settings = $this->fnp_localAdminSettings();
        $dateOfBooking = date("Y-m-d",$bookTime);
        $str='';
        $str.='<tr>';
        $str.='<td align="left" width="70%"><b>'.$service_name.'</b></td>';
        $str.='<td align="left" width="15%">';
        /*#########################################*/
        /*###### CHECK TIME IN BUSINESS HOUR ######*/
        /*#########################################*/
        $dayId = date("N",$bookTime);
        $this->checkBusinessHour($time,$service_id,$staff_id,$dayId);
        /*#########################################*/
        /*###### CHECK TIME IN BUSINESS HOUR ######*/
        /*#########################################*/
        $timeArr = explode(":",$time);
        $timeSec = ($timeArr[0]*3600)+($timeArr[1]*60);
        if($local_admin_settings[0]['hours_type'] == 1){
            $str.='@ '.date("g:i a",$this->ConvToClienttime($timeSec));
        }else{
            $str.='@ '.date("H:i",$this->ConvToClienttime($timeSec));
        }
        $str.='<input type="hidden" name="service_time_'.$loop.'" value="'.$time.'">';
        $str.='<input type="hidden" name="service_date_'.$loop.'" value="'.$dateOfBooking.'">';
        $str.='<input type="hidden" name="service_id_'.$loop.'" value="'.$service_id.'">';
        $str.='<input type="hidden" name="service_staff_'.$loop.'" value="'.$staff_id.'">';
        $temp_insert_id = $this->fnp_insertInTempTable($service_id,$staff_id,$time,$bookTime);
        $str.='<input type="hidden" name="temp_id_'.$loop.'" value="'.$temp_insert_id.'">';
        $str.='</td>';
        if($admin_settings[0]['quantity_appointment_setting'] == 1){
            $str.='<td align="left" width="15%">';
            $str.='<select name="service_capacity_'.$loop.'">';
            $ls_capacity = $this->fnp_maxCapacityOfService($service_id,$bookTime);
            for($i=1; $i<=$ls_capacity; $i++){
                $str.='<option value="'.$i.'"> '.$i.' '.ucfirst($admin_settings[0]['quantity_appointment']).' </option>';
            }
            $str.='</select>';
            $str.='</td>';
        }else{
            $str.='<td align="left" width="15%">';
            $str.='<input type="hidden" name="service_capacity_'.$loop.'" value="1">';
            $str.='</td>';
	}
        $str.='</tr>';
        return $str;
    }
    //insert in temp table
    public function fnp_insertInTempTable($service,$staff,$time,$bookTime){
                $customer_id = $this->session->userdata('user_id_customer');
                //$customer_id = $user_data['user_id_customer'];
				$insertId = $this->page_model->insertInTempTable($service,$staff,$time,$bookTime,$customer_id);
                return $insertId;
	}
    //return staff details for service
    public function fnp_detailsOfStaff($staffArrOrServiceId,$bookTime,$service){
            $staff = 0;
            $admin_settings = $this->fnp_localAdminSettings();
            if(is_array($staffArrOrServiceId)) {//Now it holds staff array
                if(is_array($service)){//echo "ARRAY";
                    $serviceId = $service['service_id'];
                }else{//echo "NUMBER";
                    $serviceId = $service;
                }
                foreach($staffArrOrServiceId as $val){//echo "<br>".$serviceId."_".$val."-".
                    $count = $this->page_model->checkWhetherStaffAvailable($bookTime,$val,$serviceId);
                    if($count == 1){
                        $staff = $val;
                        break;
                    }else{
                        $staff = 0;
                    }
                }
                return $staff;//exit;
            }else{//now it holds service id
                switch ($admin_settings[0]['staff_order']) {
                    case 1://Most free staff (Timewise)
                        $staffId = $this->page_model->getMostFreeStaffTimewise($bookTime,$staffArrOrServiceId);
                        return $staffId;
                        break;
                    case 2://Most free staff (Appointmentwise)
                        $staffId = $this->page_model->getMostFreeStaffAppointmentwise($bookTime,$staffArrOrServiceId);
                        return $staffId;
                        break;
                    case 3://Most busy staff (Timewise)
                        $staffId = $this->page_model->getMostBusyStaffTimewise($bookTime,$staffArrOrServiceId);
                        return $staffId;
                        break;
                    case 4://Most busy staff (Appointmentwise)
                        $staffId = $this->page_model->getMostBusyStaffAppointmentwise($bookTime,$staffArrOrServiceId);
                        return $staffId;
                        break;
                    case 5://Order in which staff are displayed
                        $staffId = $this->page_model->getStaffDisplaywise($bookTime,$staffArrOrServiceId);
                        return $staffId;
                        break;
                }
            }	
	}
    //check is available or not
    public function fnp_chkStaffAvailable($serviceId,$bookTime){
        $staffAvailable = 0;
        $staffArr = array();
        $noOfEmpFromBizHourArr = $this->page_model->checkStaffFromBizHour($bookTime,$serviceId); //  CHECK FROM BUSINESS HOUR TABLE
        $noOfEmpFromBizHour = count($noOfEmpFromBizHourArr);
        if($noOfEmpFromBizHour > 0){
            // if data found  in bissness hr table
            foreach($noOfEmpFromBizHourArr as $val){
                $noOfOtherBooking = $this->fn_noOfOtherBooking($serviceId,$bookTime,$val['employee_id']);// CHECK WHETHER STAFF HAS ANOTHER BOOKING ON THE SAME TIME
                
                
                if($noOfOtherBooking == 0){
                    $noOfEmpFromTemp = $this->page_model->checkStaffFromTemp($bookTime,$val['employee_id'],$serviceId); //  CHECK FROM TEMP TABLE
                    
                 
                    if($noOfEmpFromTemp == 0){
                        $noOfEmpFromBlockDate = $this->page_model->checkStaffFromBlockDate($bookTime,$val['employee_id']);
                        
                        
                        if($noOfEmpFromBlockDate == 0){
                            $noOfEmpFromBlockTime = $this->page_model->checkStaffFromBlockTime($bookTime,$val['employee_id']); //  CHECK FROM TEMP TABLE
                            if($noOfEmpFromBlockTime == 0){
                                /********************************/
                                $noOfMaxCapacity = $this->fnp_maxCapacityOfService($serviceId,$bookTime);// CHECK NUMBER OF MAXIMUM CAPACITY
                                if($noOfMaxCapacity > 0){
                                /********************************/
                                    $staffAvailable++;
                                    array_push($staffArr,$val['employee_id']);
                                /********************************/
                                }
                                /********************************/
                            }
                        }
                    }
                }
            }
        }
        if($staffAvailable == 0){
            return -1;
        }else{
            return 0;
        }
    }
    //check whether staff has another on the same time
    public function fn_noOfOtherBooking($serviceId,$bookTime,$staffId){
        $scheduledTime = date('Y-m-d H:i:s',$bookTime);
        $noOfOtherBooking = $this->page_model->getnoOfOtherBooking($serviceId,$scheduledTime,$staffId);
        return $noOfOtherBooking;
    }
    //check maximum capacity
    public function fnp_maxCapacityOfService($serviceId,$bookTime){
            $serviceCapacity = $this->page_model->getServiceCapacity($serviceId);
            $noOfBooking = $this->page_model->getNoOfBooking($bookTime,$serviceId);
            $capacity = $serviceCapacity-$noOfBooking;
            return $capacity;
		//return 10;
	}
    //check limit of attmp of booking
    public function fup_checkNumberOfBooking($bookTime){
		$admin_settings = $this->fnp_localAdminSettings();
		$local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
		$intervalType=$admin_settings[0]['noOfBookingPeriod'];//1 = unlimited; 2-> not allowed; 3->daily; 4->weekly; 5->monthly; 6->yearly; 7-> fixed date
		$noOfBooking =$this->page_model->mod_checkNumberOfBooking($bookTime,$intervalType);
		if($noOfBooking>=$admin_settings[0]['noOfBooking']){
			return -1;
		}else{
			return 0;
		}
	}
    //if corss max number of booking
    public function fnp_maxAttpHtmlGenerator(){
		$admin_settings = $this->fnp_localAdminSettings();
		switch ($admin_settings[0]['noOfBookingPeriod']) {
                    case 3:
                        $type = "day.";
                        break;
                    case 4:
                        $type = "week.";
                        break;
                    case 5:
                        $type = "month.";
                        break;
                    case 6:
                        $type = "year.";
                        break;
		}

		$str='<center style="color:#FF0000;">';
		$str.='<b>Sorry!!&nbsp;&nbsp;</b>';
		$str.='You have crossed maximum attamp of booking for this ';
		$str.=$type;
		$str.='</center>';
		return $str;
	}
    //local admin settings
    public function fnp_localAdminSettings(){
		$local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
		$ls_settings = $this->page_model->getFrontEndSettings($local_admin_id);
		return $ls_settings;
	}
    //dynamic html part
    public function fnp_generatServiceSchedule($bookTime,$serviceArr,$staffArr){
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);

        $str='';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="book_det_staff">';
        $service_counter = count($serviceArr);
        if($service_counter > 1){ // IF MORE THAN ONE SERVICE IS SELECTED
            $finalDepArr = $this->checkServiceDependency($serviceArr);//    ERROR IN THIS SECTION
            $finalArrCounter = count($finalDepArr);
            $serviceCounter=0;
            $j=0;
            foreach($finalDepArr as $val){
                $available = $this->checkWhetherStaffAvailable($bookTime,$val);//$val=service	
                if($available > 0){//   SERVICE IS AVAILABLE ON SELECTED DAY AND TIME
                    $serviceDep = $this->page_model->getServiceNameList($val);
                    if($this->fnp_chkStaffAvailable($serviceDep[0]['service_id'],$bookTime)==0){				
                        if($j==0){
                            $timestamp = $bookTime;
                            $time = date("H:i",$bookTime);
                        }else{
                            $timestamp = $end_time;
                            $time = date("H:i",$end_time);
                        }
                        if(count($staffArr) > 0 && is_array($staffArr)){
                            $staffDetails = $this->fnp_detailsOfStaff($staffArr,$bookTime,$val);
                        }else{
                            $staffDetails = $this->fnp_detailsOfStaff($serviceDep[0]['service_id'],$bookTime,$val);
                        }
                       
                        $str.=$this->fnp_dynamicHtml($time,$serviceDep[0]['service_name'],$serviceDep[0]['service_id'],$staffDetails,$serviceCounter,$bookTime);
                        $serviceCounter++;
                        $j++;
                        $service_duration_min = $serviceDep[0]['service_duration_min'];
                        $end_time = $timestamp + 60*$service_duration_min;				
                    }else{
                        $serviceDep = $this->page_model->getServiceNameList($val);
                        $str.='<tr>';
                        $str.='<td align="left" width="70%"><b>'.$serviceDep[0]['service_name'].'</b></td>';
                        $str.='<td align="left" colspan="2" width="30%" style="color:#FF0000;">Service is not available due to staff interference.</td>';
                        $str.='</tr>';
                    }		
                }else{//  SERVICE IS NOT AVAILABLE ON SELECTED DATE AND TIME
                    $serviceDep = $this->page_model->getServiceNameList($val);
                    $str.='<tr>';
                    $str.='<td align="left" width="70%"><b>'.$serviceDep[0]['service_name'].'</b></td>';
                    $str.='<td align="left" colspan="2" width="30%" style="color:#FF0000;">Service is not available on this time.</td>';
                    $str.='</tr>';
                }
            }
            $str.='<input type="hidden" id="serviceCounter" name="counter" value="'.$j.'">';
        }else{//    IF ONLY ONE SERVICE IS SELECTED
            $service = $this->page_model->getServiceName($serviceArr);
            $serviceDep = $this->input->post('service');
            $j=0;
            foreach($service as $val){	
		        if($this->fnp_chkStaffAvailable($val['service_id'],$bookTime)==0){ 
                    $time= date("H:i",$bookTime);
                    if(count($staffArr) > 0 && is_array($staffArr)){
                        $newStaffArr = array();
                        foreach($staffArr as $row){
                            $noOfOtherBooking = $this->fn_noOfOtherBooking($service,$bookTime,$row);// CHECK WHETHER STAFF HAS ANOTHER BOOKING ON THE SAME TIME
                            
                            if($noOfOtherBooking == 0){
                                array_push($newStaffArr,$row);
                               
                            }
                            $staffDetails = $this->fnp_detailsOfStaff($newStaffArr,$bookTime,$val);
                        } 
                        $staffDetails = $this->fnp_detailsOfStaff($staffArr,$bookTime,$val);
                    }else{ 
                        $staffDetails = $this->fnp_detailsOfStaff($serviceDep[0],$bookTime,$val);
                    }
                    if($staffDetails != 0){
                        $str.= $this->fnp_dynamicHtml($time,$val['service_name'],$val['service_id'],$staffDetails,0,$bookTime);
                    $j++;
                    }else{
                        $serviceDep = $this->page_model->getServiceNameList($val['service_id']);
                        $str.='<tr>';
                        $str.='<td align="left" width="70%"><b>'.$serviceDep[0]['service_name'].'</b></td>';
                        $str.='<td align="left" colspan="2" width="30%" style="color:#FF0000;">Service is not available due to staff interference.</td>';
                        $str.='</tr>';
                    }
                }else{
                    $serviceDep = $this->page_model->getServiceNameList($val['service_id']);
                    $str.='<tr>';
                    $str.='<td align="left" width="70%"><b>'.$serviceDep[0]['service_name'].'</b></td>';
                    $str.='<td align="left" colspan="2" width="30%" style="color:#FF0000;">Service is not available due to staff interference.</td>';
                    $str.='</tr>';
                }    
            }
            $str.='<input type="hidden" id="serviceCounter" name="counter" value="'.$j.'">';
        }
        $str.='</table>';

        return $str;
	}
    //static html part
    public function fnp_htmlGenerator($bookTime,$serviceArr,$staffArr){
		$str='';
        $str.='<div class="popScroll">';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="bookung_tab">';
        $str.='<tr class="booking_tab_row_top">';
        $str.='<td>';
		$str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
		$str.='<tr>';
		$str.='<td align="left"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_order_summary')).'</b></td>';//Order Summary
		$str.='<td align="right"><b><div id="countdown"></div></b></td>';
		$str.='<tr>';
		$str.='</table>';
		$str.='</td>';
        $str.='</tr>';
        $str.='<tr>';
        $str.='<td align="left">'.$this->global_mod->db_parse($this->lang->line(date("F",$bookTime))).' '.date("d",$bookTime).', '.date("Y",$bookTime).' ('.$this->global_mod->db_parse($this->lang->line(date("l",$bookTime))).')<hr style="width:100%;"></td>';
        $str.='</tr>';
        $str.='<tr><td>';
		//dynamic table part start
		
		$str.='<form id="tempBookingData" method="post">';
		$str.=$this->fnp_generatServiceSchedule($bookTime,$serviceArr,$staffArr);// ERROR IN THIS SECTION
		$str.=$this->page_model->get_custom_dependency_warning();
       	$str.='</form>';
		
		//dynamic table part end
		$str.='</td></tr>';
        //Check Admin settings is recurring abl
		$admin_settings = $this->fnp_localAdminSettings();
		if($admin_settings[0]['recurringAppointments'] == 1){
		$str.='<tr><td>';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="book_tim_det">';

        $str.='<tr>';
        $str.='<td colspan="3">'.$this->global_mod->db_parse($this->lang->line('mobile_recurring_booking')).'</td>';//Repeat this booking on other days.
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td>';
        $str.='<select name="bkType" id="recurType" class="dropp panel-1">';
        $str.='<option selected="selected" value="0"> '.$this->global_mod->db_parse($this->lang->line('mobile_no_repeat')).'  </option>';//No Repeat
        $str.='<option value="1"> '.$this->global_mod->db_parse($this->lang->line('mobile_daily')).' </option>';//Daily
        $str.='<option value="2"> '.$this->global_mod->db_parse($this->lang->line('mobile_weekly')).' </option>';//Weekly
        $str.='<option value="3"> '.$this->global_mod->db_parse($this->lang->line('mobile_monthly')).' </option>';//Monthly
        $str.='<option value="4"> '.$this->global_mod->db_parse($this->lang->line('mobile_yearly')).' </option>';//Yearly
        $str.='</select>';
        $str.='</td>';
        $str.='<td id="option1">';
        //day start
        $str.='<span class="daily" style="display: none;"><select name="bkDayNo" id="recurRepEv" class="dropp panel-2">';
        $str.='<option selected="selected" value="1">'.$this->global_mod->db_parse($this->lang->line('mobile_everyday')).'</option>';//Every Day
        $str.='<option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_day')).'</option>';//Every alternate Day
        for($i=3;$i<=30;$i++){
            $str.='<option value="'.$i.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$i.' '.$this->global_mod->db_parse($this->lang->line('mobile_day')).'</option>';
        }
        $str.='</select></span>';
        //day end
        //week start
        $dayArr[0] = $this->global_mod->db_parse($this->lang->line('cal_sunday'));//Sunday
        $dayArr[1] = $this->global_mod->db_parse($this->lang->line('cal_monday'));//Monday
        $dayArr[2] = $this->global_mod->db_parse($this->lang->line('cal_tuesday'));//Tuesday
        $dayArr[3] = $this->global_mod->db_parse($this->lang->line('cal_wednesday'));//Wednesday
        $dayArr[4] = $this->global_mod->db_parse($this->lang->line('cal_thursday'));//Thursday
        $dayArr[5] = $this->global_mod->db_parse($this->lang->line('cal_friday'));//Friday
        $dayArr[6] = $this->global_mod->db_parse($this->lang->line('cal_saturday'));//Saturday
        $day = date("w",$bookTime);
        $opt = ' selected="selected"';
        $none = '';
        $str.='<span class="week" style="display: none;"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_on')).'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="bkWeekDayNo" id="selectedWeekDayTxt" multiple="multiple" class="dropp panel-2">';
        for($i=0;$i<=6;$i++){
            $str.='<option value="'.$i.'"';
            $str.=($day==$i)?$opt:$none;
            $str.='>'.$dayArr[$i].'</option>';
        }
        $str.='</select></span>';
        //week end
        //month start
        $str.='<span class="month" style="display: none;"><select name="bkMonthNo" id="recurRepEv_month" class="dropp panel-2">';
        $str.='<option selected="selected" value="1">'.$this->global_mod->db_parse($this->lang->line('mobile_everymonth')).'</option>';//Every Month
        $str.='<option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_month')).'</option>';//Every alternate Month
        for($i=3;$i<=30;$i++){
            $str.='<option value="'.$i.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$i.' '.$this->global_mod->db_parse($this->lang->line('mobile_month')).'</option>';
        }
        $str.='</select></span>';
        //month end
        //year start
        $str.='<span class="year" style="display: none;"><select name="bkYearNo" id="recurRepEv_year" class="dropp panel-2">';
        $str.='<option selected="selected" value="1">'.$this->global_mod->db_parse($this->lang->line('mobile_everyyear')).'</option>';//Every Year
        $str.='<option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_year')).'</option>';//Every alternate Year
        for($i=3;$i<=30;$i++){
            $str.='<option value="'.$i.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$i.' '.$this->global_mod->db_parse($this->lang->line('mobile_year')).'</option>';
        }
        $str.='</select></span>';
        //year end
        $str.='</td>';
        $str.='<td id="option2">';
        //day start
        $str.='<span class="daily" style="display: none;"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_till')).'</b> &nbsp;&nbsp;<input name="bkDayTill" type="text" size="14" value="" id="recurEndDt" class="datepicker"></span>';
        //day end
        //week start
        $str.='<span class="week" style="display: none;"><select name="bkWeekNo" id="recurRepEv_wk" class="dropp panel-2">';
        $str.='<option selected="selected" value="1">'.$this->global_mod->db_parse($this->lang->line('mobile_everyweek')).'</option>';//Every Week
        $str.='<option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_week')).'</option>';//Every alternate Week
        for($i=3;$i<=30;$i++){
            $str.='<option value="'.$i.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$i.' '.$this->global_mod->db_parse($this->lang->line('mobile_week')).'</option>';
        }
        $str.='</select></span>';
        //week end
        //month start
        $str.='<span class="month" style="display: none;"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_till')).'</b>&nbsp;&nbsp;<input type="text" name="bkMonthTill" size="14" value="" id="recurEndDt_month" class="datepicker"></span>';
        //month end
        //year start
        $str.='<span class="year" style="display: none;"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_till')).'</b>&nbsp;&nbsp;<input name="bkYearTill" type="text" size="14" value="" id="recurEndDt_year" class="datepicker"></span>';
        //year end
        $str.='</td>';
        $str.='</tr>';

        $str.='<tr>';
        $str.='<td id="option3">';
        //week start
        $str.='<span class="week" style="display: none;">&nbsp;</span>';
        //week end
        $str.='</td>';
        $str.='<td id="option4">';
        //week strat
        $str.='<span class="week" style="display: none;"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_till')).'</b>&nbsp;&nbsp;<input name="bkWeekTill" type="text" size="14" value="" id="recurEndDt_wk" class="datepicker"></span>';
        //week end
        $str.='</td>';
        $str.='<td id="option5">';

        $str.='</td>';
        $str.='</tr>';

        $str.='</table>';
        $str.='</td></tr>';
		
		$str.='<tr class="booking_tab_row_footer">';
        $str.='<td align="left"><form id="tempBookingRecurringData" method="post"><span id="errorCont"></span></form></td>';
        $str.='</tr>';
		}//end admin checking
		
		
        $str.='<tr class="booking_tab_row_footer">';
        $str.='<td align="right"><button id="nxt_button">'.$this->global_mod->db_parse($this->lang->line('mobile_next')).' >></button></td>';//Next
        $str.='</tr>';
        $str.='<tr>';

        $str.='</table>';
		$str.='</div>';
		return $str;
	}
	//delete data from temp table after booking
    public function deleteTempData(){
            $counter	= $this->input->post('counter');
            $returnArr	= array();
            for( $i=0; $i<$counter;$i++){           
                $returnArr[$i]		= $this->input->post('temp_id_'.$i);
            }
           
            $delete = $this->page_model->deleteBookingData($returnArr);	
	}
    //recurring appoointment
    public function fnp_recurringAppointment(){
        $bookArr = array();
		$counter		= $this->input->post('counter');
		$recurringArr	= $this->input->post('recurringData');
		$localStr = '';		
		if($recurringArr['recurringType'] == 1 ){
			$recurringLastDate	= $recurringArr['tillDateOfDay'];
			$loopCounter		= $recurringArr['recurringOfDay'];
		}
		if($recurringArr['recurringType'] == 2 ){
			$recurringLastDate	= $recurringArr['tillDateOfWeek'];
			$recurringDayArr	= $recurringArr['recurringOfDayWeek'];
			$loopCounter		= $recurringArr['recurringOfWeek']*7;
		}
		if($recurringArr['recurringType'] == 3 ){
			$recurringLastDate	= $recurringArr['tillDateOfMonth'];
			$loopCounter		= $recurringArr['recurringOfMonth']*30;
		}
		if($recurringArr['recurringType'] == 4 ){
			$recurringLastDate	= $recurringArr['tillDateOfYear'];
			$loopCounter		= $recurringArr['recurringOfYear']*356;
		}
		$lastBookDate = $this->input->post('service_date_0');
		if(strtotime($recurringLastDate)>strtotime($lastBookDate)){
		    $difference = abs(strtotime($recurringLastDate) - strtotime($lastBookDate));
		    $noOfDay = floor($difference/(60*60*24));
		    for($i=0; $i <= $noOfDay; ($i+=intval($loopCounter))){
		        if($i!=0){
		            $bookDate = date('Y-m-d',strtotime($lastBookDate) + (24*3600*$i));
			        $bookArr[$i-1]['bookDateShow'] = $bookDate;
			        $bookArr[$i-1]['bookingDataArr'] = array();
			        for($book=0; $book<$counter; $book++){
				        $bookTime					= $this->input->post('service_time_'.$book);
				        $bookArr[$i-1]['bookingDataArr'][$book]['dateTime']	= $this->global_mod->localTimeReturn(date('Y-m-d H:i:s', strtotime($bookDate.' '.$bookTime)));
				        $bookArr[$i-1]['bookingDataArr'][$book]['service']	= $this->input->post('service_id_'.$book);
				        $bookArr[$i-1]['bookingDataArr'][$book]['employee']	= $this->input->post('service_staff_'.$book);
				        $bookArr[$i-1]['bookingDataArr'][$book]['quantity']	= $this->input->post('service_capacity_'.$book);
			        }
			    }//
		    }
		
		    $localStr.=$this->recurringAppointmentHtml($bookArr);
		}else{
		    $localStr.= 'Please select grater then your booking date.';
		}
		echo $localStr;
	}
	//recurring appointment html
    public function recurringAppointmentHtml($bookArr){
        $bookArrCounter = count($bookArr);
		$admin_settings = $this->fnp_localAdminSettings();
		$str ='';
		$pCount =0;
		$str .='<form id="recurringBookingFrm" method="post">';
        if($bookArrCounter != 0){
		    foreach($bookArr as $bookVal){
		        $str.='<div id="recurringMainDiv_'.date("ymd",strtotime($bookVal['bookDateShow'])).'">';	
		        $str.='<div class="recurringDiv" id="recurringDiv_'.date("ymd",strtotime($bookVal['bookDateShow'])).'">';						//
		
		        $chkBookingCounter = 0;
		        foreach($bookVal['bookingDataArr'] as $bookChildVal){
			        $chkBookingArr = $this->global_mod->checkStaffAvailability($bookChildVal['dateTime'],array($bookChildVal['employee']),array($bookChildVal['service']));
			        if($chkBookingArr[0][0]['bk_status'] == TRUE){
				        $chkBookingCounter ++;
			        }
		        }
		        $str.='<Span class="recurringSpanLeft ';
		        if(count($bookVal['bookingDataArr']) != $chkBookingCounter ){
			        $str.=' recurringFalse';
		        }
		        $str.='">';
		        $str.=date("M d, Y (l)",strtotime($bookVal['bookDateShow']));
		        $str.='</Span>';
		        $str.='<Span class="recurringSpanCenter">';
		        $str.='<label>TIME CHANGE</label> or <label style=" cursor:pointer;" onclick="removeDayWiseBooking('.date("ymd",strtotime($bookVal['bookDateShow'])).')">REMOVE</label>';
		        $str.='</Span>';
		        if(count($bookVal['bookingDataArr']) == $chkBookingCounter ){
			        $str.='<Span class="recurringSpanRight recurringTrue">';
			        $str.='-AVAILABLE-';
			        $str.='</Span>';
		        }else{
			        $str.='<Span class="recurringSpanRight recurringFalse">';
			        $str.='-Not Availabel-';
			        $str.='</Span>';	
		        }
		        $str.='</div>';
		        $str.='<ul class="recurringTable" id="recurringTable_'.date("ymd",strtotime($bookVal['bookDateShow'])).'">';
		        $str.='<li>';
		        foreach($bookVal['bookingDataArr'] as $bookChildVal){
			        $chkBooking = $this->global_mod->checkStaffAvailability($bookChildVal['dateTime'],array($bookChildVal['employee']),array($bookChildVal['service']));

			        $localId =date("ymdhi",strtotime($chkBooking[0][0]['bk_time']));								
			        $str.='<ul id="perBooking_'.$localId.'">';
			        $str.='<li>';
			        $str.=$chkBooking[0][0]['bk_service_name'];
			        $str.='<br>';
			        if($chkBooking[0][0]['bk_status'] == TRUE){
				        $str.='<label class="recurringTrue">-Available-</label>';
			        }else{
				        $str.='<label class="recurringFalse">-Not Available-</label>';
			        }
			
			        $str.='<label style="color:#548BB8; cursor:pointer;" onclick="removeTimeWiseBooking('.$localId.','.$pCount.')">  Remove</label>';
			        $str.='</li>';
			        $str.='<li>';
			        $str.=$chkBooking[0][0]['bk_employee_name'];
			        $str.='</li>';
			        $str.='<li>';
			        if($chkBooking[0][0]['bk_status'] == TRUE){
				        $str.='<label class="recurringTrue">';
				        $str.='@ '.date("h:i A",strtotime($chkBooking[0][0]['bk_time']));
				        $str.='</label>';
			        }else{
				        $str.='<label class="recurringFalse">';
				        $str.='@ '.date("h:i A",strtotime($chkBooking[0][0]['bk_time']));
				        $str.='</label>';
			        }
			        $str.='</li>';
			        $str.='<li>';
			        $str.='<select class="recurringDropp" onchange="changePrice(this.value,'.$chkBooking[0][0]['bk_service_cost'].','.$localId.','.$pCount.')">';
			        for($i=1;$i<=$chkBooking[0][0]['bk_service_capacity'];$i++){
	                    $str.='<option value="'.$i;
			            if($bookChildVal['quantity'] == $i){
			                $str.=' selected="selected" ';	
			            }
			            $str.='">'.$i.' '.ucfirst($admin_settings[0]['quantity_appointment']).'</option>';
			        }
			        $str.='</select>';
			        $str.='</li>';
			        $str.='<li>';
			        $str.=$this->session->userdata('local_admin_currency_type').' ';
			        $str.='<label id="bkPrice_'.$localId.'">';
			        $str.=$this->global_mod->currencyFormat($chkBooking[0][0]['bk_service_cost']*$bookChildVal['quantity']);
			        $str.='<label>';
			        $str.='</li>';
			        $str.='</ul>';
			
			        if(count($bookVal['bookingDataArr']) == $chkBookingCounter ){
			            $str .='<input type="hidden" id="recurringCapacity_'.$pCount.'" name="recurringCapacity_'.$pCount.'" value="'.$bookChildVal['quantity'].'">';
			            $str .='<input type="hidden" id="recurringDateTime_'.$pCount.'" name="recurringDateTime_'.$pCount.'" value="'.$chkBooking[0][0]['bk_time'].'">';
			            $str .='<input type="hidden" id="recurringSrviceId_'.$pCount.'" name="recurringSrviceId_'.$pCount.'" value="'.$chkBooking[0][0]['bk_service_id'].'">';
			            $str .='<input type="hidden" id="recurringEmployeeId_'.$pCount.'" name="recurringEmployeeId_'.$pCount.'" value="'.$chkBooking[0][0]['bk_employee_id'].'">';
			
			            $tempId = $this->page_model->genaretTempRecurringId($chkBooking[0][0]['bk_service_id'],$chkBooking[0][0]['bk_employee_id'],$chkBooking[0][0]['bk_time']);
			            $str .='<input type="hidden" id="recurringTempId_'.$pCount.'" name="recurringTempId_'.$pCount.'" value="'.$tempId.'">';
			            $pCount++;
			        }	
		        }
		        $str.='</li>';
		        $str.='</ul>';
		        $str.='</div>';
		    }
        }else{
            $str .= $this->global_mod->db_parse($this->lang->line('mobile_no_recurring'));//'There are no recurring reservations for the selected period.';
        }
		$str .='<input type="hidden" name="recurringCounter" value="'.$pCount.'">';
		$str .='</form>';
		return $str;
	}
    //changing upcoming appointment status
    public function changeAppointmentStatus(){
        $status = $this->input->post('status');
        $serviceId = $this->input->post('serviceId');
        $result = $this->global_mod->changeAppointmentStatusByCustomer($status,$serviceId);
        echo $result;
    }
    //getting previous and upcoming appointment details
    public function fnp_myAppoinmentDetails(){
        $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
        $max_cancel_settings = $this->page_model->getCancelSettings($local_admin_id);
        $cancellationAmount = $max_cancel_settings[0]['bkin_can_mx_tim'];
        $cancellationUnit = $max_cancel_settings[0]['bkin_can_setin'];
        if($cancellationUnit == 1){
            $cancellationUnitSecond = 3600*24;
        }elseif($cancellationUnit == 2){
            $cancellationUnitSecond = 3600;
        }
        $totalAdvanceCancellationTime = $cancellationAmount * $cancellationUnitSecond;

        $login_customer_id = $this->session->userdata('user_id_customer');
        if($login_customer_id != ''){
            $pastDataArr = $this->page_model->getPastBookingData();
            $nextDataArr = $this->page_model->getNextBookingData();	
            if(count($nextDataArr)==0){
                $str1='<table border="0" width="100%" cellpadding="0" cellspacing="0">';
                $str1.='<tr>';
                $str1.='<td align="center">';
                $str1.='-- '.$this->global_mod->db_parse($this->lang->line('mobile_no_records')).' -- ';
                $str1.='</td>';
                $str1.='</tr>';
                $str1.='</table>';
            }else{//    UPCOMING BOOKINGS
                $date = "";
                $str1='<table border="0" width="100%" cellpadding="0" cellspacing="0">';
                $str1.='<input type="hidden" name="counter" id="counter" value="0" />';
                foreach($nextDataArr as $val){
                    $srvDtls_service_start = $val['srvDtls_service_start'];
                    $serviceDateArr = explode(" ",$srvDtls_service_start);
                    $serviceDate = $serviceDateArr[0];
                    $serviceTime = $serviceDate." ".$serviceDateArr[1];
                    $serviceTimestamp = strtotime($serviceTime);
                    $cancellationPossibleTime = $serviceTimestamp - $totalAdvanceCancellationTime;
                    $remainingTime = $cancellationPossibleTime - time();

                    if($date != $serviceDate){
                        $str1.='<tr style="background:#0167BB;"><td align="left"><lable style="color:#FFFFFF;font:15px bold;">'.date("d",strtotime($serviceDate)).' '.$this->global_mod->db_parse($this->lang->line(date("F",strtotime($serviceDate)))).', '.date("Y",strtotime($serviceDate)).'</lable></td></tr>';
                    }
                    $str1.='<tr>';
                    $str1.='<td nowrap="nowrap"><lable style="font-size:12px;float:left;">';
                    $str1.=$val['srvDtls_service_name'];//change here
				    $str1.='&nbsp;( ';
				    $str1.=$val['srvDtls_employee_name'];//change here
				    $str1.=' )&nbsp;';
                    $str1.='</lable>';
				    $str1.='<div id="status_'.$val['srvDtls_id'].'" style="float:right;">';
				    $str1.='<div class="onoffswitch" onchange="setStatus(\'yes\','.$val['srvDtls_id'].')">';
				    $str1.='<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch_'.$val['srvDtls_id'].'" checked>';
                    if($remainingTime > 0){
				        $str1.='<label class="onoffswitch-label" for="myonoffswitch_'.$val['srvDtls_id'].'">';
				        $str1.='<div class="onoffswitch-inner"></div>';
				        $str1.='<div class="onoffswitch-switch"></div>';
				        $str1.='</label>';
                    }
				    $str1.='</div>'; 
				    $str1.='</div>';
				    $str1.='<br><lable style="color:#A0A0A0; font-size:11px;">';
                    $time_gmt = strtotime($serviceDateArr[1]);
                    if($local_admin_settings[0]['hours_type'] == 1){
                        $appointmentTime = date("g:i a",$time_gmt);
                    }else{
                        $appointmentTime = date("G:i",$time_gmt);
                    }
                    $str1.=$this->global_mod->db_parse($this->lang->line('mobile_at')).' '.$appointmentTime;//change here
                    $str1.='&nbsp;&nbsp;&nbsp;';
                    $str1.='('.$val['srvDtls_service_duration'].' '.$this->global_mod->db_parse($this->lang->line('mobile_mins')).'.)';//change here
                    $str1.='</lable>';
                    $str1.='</td>';
                    $str1.='</tr>';
                    $date = $serviceDate;
                }
                $str1.='</table>';
            }

            if(count($pastDataArr)==0){
                $str2='<table border="0" width="100%" cellpadding="0" cellspacing="0">';
                $str2.='<tr>';
                $str2.='<td align="center">';
                $str2.='-- '.$this->global_mod->db_parse($this->lang->line('mobile_no_records')).' -- ';
                $str2.='</td>';
                $str2.='</tr>';
                $str2.='</table>';
            }else{//    PREVIOUS BOOKINGS
                $date = "";
                $str2='<table border="0" width="100%" cellpadding="0" cellspacing="0">';
                foreach($pastDataArr as $val){
                    $srvDtls_service_start = $val['srvDtls_service_start'];
                    $serviceDateArr = explode(" ",$srvDtls_service_start);
                    $serviceDate = $serviceDateArr[0];
                    if($date != $serviceDate){
                        $str2.='<tr style="background:#0167BB;"><td align="left"><lable style="color:#FFFFFF;font:15px bold;">'.date("d",strtotime($serviceDate)).' '.$this->global_mod->db_parse($this->lang->line(date("F",strtotime($serviceDate)))).', '.date("Y",strtotime($serviceDate)).'</lable></td></tr>';
                    }
                    $str2.='<tr >';
                    $str2.='<td align="left"><lable style="font-size:12px;">';
                    $str2.=$val['srvDtls_service_name'];//change here
				    $str2.='&nbsp;( ';
				    $str2.=$val['srvDtls_employee_name'];//change here
				    $str2.=' )&nbsp;';
                    $str2.='</lable><br><lable style="color:#A0A0A0; font-size:11px;">';
                    $time_gmt = strtotime($serviceDateArr[1]);
                    //$time_local_admin = $this->ConvToClienttime($time_gmt);
                    if($local_admin_settings[0]['hours_type'] == 1){
                        $appointmentTime = date("g:i a",$time_gmt);
                    }else{
                        $appointmentTime = date("H:i",$time_gmt);
                    }
                    $str2.=$this->global_mod->db_parse($this->lang->line('mobile_at')).' '.$appointmentTime;//change here
                    $str2.='&nbsp;&nbsp;&nbsp;';
                    $str2.='('.$val['srvDtls_service_duration'].' '.$this->global_mod->db_parse($this->lang->line('mobile_mins')).'.)';//change here
                    $str2.='</lable></td>';
                    $str2.='</tr>';
                    $date = $serviceDate;
                }
                $str2.='</table>';
            }
        }else{
            $str1='<table border="0" width="100%" cellpadding="0" cellspacing="0">';
            $str1.='<tr>';
            $str1.='<td align="center">';
            $str1.=$this->global_mod->db_parse($this->lang->line('mobile_login_again'));
            $str1.='</td>';
            $str1.='</tr>';
            $str1.='</table>';

            $str2='<table border="0" width="100%" cellpadding="0" cellspacing="0">';
            $str2.='<tr>';
            $str2.='<td align="center">';
            $str2.=$this->global_mod->db_parse($this->lang->line('mobile_login_again'));
            $str2.='</td>';
            $str2.='</tr>';
            $str2.='</table>';
        }
        echo $str1.'|(^_^)|'.$str2;
	}	 
	
    public function fn_paymentBookingForm(){
    	
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
		 $getTermsCondition= $this->page_model->getTermsCondition($local_admin_id);
        
      //  echo "<pre>";
     //   echo $this->input->post('recurringCounter');
       // print_r($_POST);
       
     //   echo "</pre>";
     //   exit;
	
        $time_difference_gcal = $this->session->userdata('time_difference_gcal');
        $timeSign = substr($time_difference_gcal,0,1);
        $timeDifferenceArr = explode(":",$time_difference_gcal);
        $timeDifferenceSecond = (substr($timeDifferenceArr[0],1)*3600) + ($timeDifferenceArr[1]*60);

		$local_admin_id = $this->session->userdata('local_admin_id');
        $bookTime = $this->input->post('bTime');
        $counter = $this->input->post('counter');
		for($i=0;$i<$counter;$i++){
            $returnArr[$i]['service_time'] 	=  $this->input->post('service_time_'.$i);
            $returnArr[$i]['service_date'] 	=  $this->input->post('service_date_'.$i);
            $returnArr[$i]['booking_date']	=  $this->input->post('service_date_'.$i);
            $returnArr[$i]['service_id']	=  $this->input->post('service_id_'.$i);
            $returnArr[$i]['service_staff']	=  $this->input->post('service_staff_'.$i);
            $returnArr[$i]['temp_id']		=  $this->input->post('temp_id_'.$i);
            $returnArr[$i]['service_capacity']	=  $this->input->post('service_capacity_'.$i);
		}
		
		
		
		///////////////////////   Done by Soumya adak /////////////////////////////////////////////////
		if(isset($_POST['tempBookingRecurringData'])){
			
		$totaldata = count($_POST['tempBookingRecurringData']);
		$recurringCounter = $_POST['tempBookingRecurringData'][$totaldata-1]['value'];
		
		$l = 0;
		$k = 5;
		$m = 1;
		$serid = 2;
		$sersrtaff = 3;
		$tempId = 4;
		$capacity = 0;
		$localDateTime = 0;
		$loop = 0;
		for($i=0;$i<$recurringCounter;$i++){
			for($j=$l;$j<$k;$j++){
				if($j == $m){
					$localDateTime = $_POST['tempBookingRecurringData'][$j]['value'];
					$returnArr[($i+$counter)]['service_time']       =  date("H:i",strtotime($localDateTime));
           			$returnArr[($i+$counter)]['service_date']       =  date("Y-m-d",strtotime($localDateTime));
            		$returnArr[($i+$counter)]['booking_date']       =  date("Y-m-d",strtotime($localDateTime));
					$m = $m + 5;
				}
				if($j == $serid){
					$returnArr[($i+$counter)]['service_id']			= $_POST['tempBookingRecurringData'][$j]['value'];
					$serid = $serid + 5;
				}
				if($j == $sersrtaff){
					$returnArr[($i+$counter)]['service_staff']		= $_POST['tempBookingRecurringData'][$j]['value'];
					$sersrtaff = $sersrtaff + 5;
				}
				if($j == $tempId){
					$returnArr[($i+$counter)]['temp_id']			= $_POST['tempBookingRecurringData'][$j]['value'];
					$tempId = $tempId + 5;
				}
				
				if($loop == 0){
					if($j == 0){
						$returnArr[($i+$counter)]['service_capacity'] 	= $_POST['tempBookingRecurringData'][$capacity]['value'];
						$capacity = $capacity + 5;
					}
				}else{
					if($j-1 == $capacity){
						$returnArr[($i+$counter)]['service_capacity'] 	= $_POST['tempBookingRecurringData'][$capacity]['value'];
						$capacity = $capacity + 5;
					}
				}
				$loop++;
			
			}
			$loop++;
			$l = $j+1;
			$k = $k+5;
		//	$temp_insert_id = $this->fnp_insertInTempTable($returnArr[($i+$counter)]['service_id'],$returnArr[($i+$counter)]['service_staff'],date("H:i",strtotime($localDateTime)),$bookTime);
			
		}
		
	}	
	//	print_r($returnArr);
	//	echo "</pre>";
	//	exit;
		
		///////////////////////// End of Soumya adak  ////////////////////////////////////////////
		
		
	/*	$recurringCounter = $this->input->post('recurringCounter');
		for($i=0;$i<$recurringCounter;$i++){
            $localDateTime = $this->input->post('recurringDateTime_'.$i);
            $returnArr[($i+$counter)]['service_time']       =  date("H:i",strtotime($localDateTime));
            $returnArr[($i+$counter)]['service_date']       =  date("Y-m-d",strtotime($localDateTime));
            $returnArr[($i+$counter)]['booking_date']       =  date("Y-m-d",strtotime($localDateTime));
            $returnArr[($i+$counter)]['service_id']         =  $this->input->post('recurringSrviceId_'.$i);
            $returnArr[($i+$counter)]['service_staff']      =  $this->input->post('recurringEmployeeId_'.$i);
            $returnArr[($i+$counter)]['temp_id']            =  $this->input->post('recurringTempId_'.$i);
            $returnArr[($i+$counter)]['service_capacity']   =  $this->input->post('recurringCapacity_'.$i);
            ###############################################################
            
            $temp_insert_id = $this->fnp_insertInTempTable($this->input->post('recurringSrviceId_'.$i),$this->input->post('recurringEmployeeId_'.$i),date("H:i",strtotime($localDateTime)),$bookTime);
            //$str.='<input type="hidden" name="temp_id_'.$loop.'" value="'.$temp_insert_id.'">';
            ###############################################################
		}*/
		
		$j=1;
        $str='';
        $str.='<div class="popScroll">';
        $str.='<form name="bookingFormPayment" id="bookingFormPayment" method="post" onsubmit="return false;">';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="bookung_tab">';
        $str.='<tr class="booking_tab_row_top">';
        $str.='<td>';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
        $str.='<tr>';
        $str.='<td align="left"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_book')).'</b></td>';//Book Your Appointment
        $str.='<td align="right">&nbsp;</td>';
        $str.='<tr>';
        $str.='</table>';
        $str.='</td>';
        $str.='</tr>';
		$str.='<tr>';
        $str.='<td>';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
        $str.='<tr class="payheader">';
        $str.='<td width="45%" class="paytdf"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_service_name')).'</b></td>';//Service Name
        $str.='<td width="16%" class="paytdf"></td>';//Time
        $str.='<td width="5%" class="paytdf" align="center"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_unit')).'</b></td>';//Unit
        $str.='<td width="17%" class="paytdf" align="right"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_unit_cost')).'</b></td>';//Unit Cost
        $str.='<td width="17%" class="paytdf" align="right"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_total')).'</b></td>';//Total
        $str.='</tr>';	
        $grandTotal = 0;
		$hDate = 0;
		//echo "<pre>";print_r($returnArr);echo "</pre>";
		$json_encode_arr=json_encode($returnArr);
		
		//echo "<pre>";
	//	print_r($returnArr);
	//	echo "</pre>";
	//	exit;
		
		
        foreach($returnArr as $val){ 
        	$totalCost = 0;
            $serviceDetailsArr = $this->page_model->getServiceDetails($val['service_id']);
            $totalCost = $val['service_capacity']*$serviceDetailsArr[0]['service_cost'];
            $totalCost = round($totalCost,2);
            $grandTotal = $grandTotal + $totalCost;

            if($timeSign == '+'){
                if($local_admin_settings[0]['hours_type'] == 1){
                    $newtime = date("g:i a",strtotime($val['service_time'])-$timeDifferenceSecond);
                }else{
                    $newtime = date("H:i",strtotime($val['service_time'])-$timeDifferenceSecond);
                }
                //$newtime = date("H:i",strtotime($val['service_time'])-$timeDifferenceSecond);
            }else{
                if($local_admin_settings[0]['hours_type'] == 1){
                    $newtime = date("g:i a",strtotime($val['service_time'])+$timeDifferenceSecond);
                }else{
                    $newtime = date("H:i",strtotime($val['service_time'])+$timeDifferenceSecond);
                }
                //$newtime = date("H:i",strtotime($val['service_time'])+$timeDifferenceSecond);
            }

			if($hDate != strtotime($val['booking_date'])){
			    $str.='<tr>';
                //$str.='<td align="left">'.$this->lang->line(date("F",$bookTime)).' '.date("d",$bookTime).', '.date("Y",$bookTime).' ('.$this->lang->line(date("l",$bookTime)).')<hr style="width:100%;"></td>';
        	    //$str.='<td align="left" colspan="4"><b style="font-weight:bold;font-size:13px;">'.date("F d, Y (l)",strtotime($val['booking_date'])).'</b><hr style="width:100%;"></td>';
                $str.='<td align="left" colspan="5"><b style="font-weight:bold;font-size:13px;">'.$this->global_mod->db_parse($this->lang->line(date("F",strtotime($val['booking_date'])))).' '.date("d",strtotime($val['booking_date'])).', '.date("Y",strtotime($val['booking_date'])).' ('.$this->global_mod->db_parse($this->lang->line(date("l",strtotime($val['booking_date'])))).') </b><hr style="width:100%;"></td>';//'.$this->lang->line('mobile_on').' '.$newtime.'
        	    $str.='</tr>';
			}
			
			$service_cost = (float)$serviceDetailsArr[0]['service_cost'];
			$cost = $service_cost >0 ? $service_cost : '';
			
            $str.='<tr>';
            $str.='<td>'.$serviceDetailsArr[0]['service_name'].'</td>';
            $str.='<td>@ '.$newtime.'</td>';
            $str.='<td align="center">';
            if($cost >0 && $local_admin_settings[0]['quantity_appointment_setting'] == 1)
            	$str .= $val['service_capacity'];
            $str .= '</td>';
            
            $str.='<td align="right">';
            if($cost != '' && $local_admin_settings[0]['quantity_appointment_setting'] == 1){
				$str .= $this->session->userdata('local_admin_currency_type')." ".$cost;
			}
            $str.='</td>';
            $str.='<td align="right">';
            if($totalCost >0){
				$str .= $this->session->userdata('local_admin_currency_type')." ".$totalCost;
			}
            $str .= '</td>';
            $str.='</tr>';
            $str.='<input type="hidden" name="service_time_'.$j.'" value="'.$val['service_time'].'">';
            $str.='<input type="hidden" name="service_date_'.$j.'" value="'.$val['service_date'].'">';
            $str.='<input type="hidden" name="service_id_'.$j.'" value="'.$val['service_id'].'">';
            $str.='<input type="hidden" name="service_staff_'.$j.'" value="'.$val['service_staff'].'">';
            $str.='<input type="hidden" name="temp_id_'.$j.'" value="'.$val['temp_id'].'">';
            $str.='<input type="hidden" name="service_capacity_'.$j.'" value="'.$val['service_capacity'].'">';
            $j++;
			$hDate = strtotime($val['booking_date']);
        }
		$str.='<input type="hidden" name="serviceCounter" value="'.$j.'">';
        $grandTotal = round($grandTotal,2); 
        $str.='</table>';
        $str.='</td>';
        $str.='</tr>';
	$str.='<tr>';
        $str.='<td><hr style="width:100%;"></td>';
        $str.='</tr>';
	$str.='<tr>';
        $str.='<td>';
        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
       if($grandTotal >0){
	 
        $str.='<tr style="font-weight:bold;font-size:15px;">';
        $str.='<td colspan="3" align="right"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_sub_total')).'</b></td>';//SubTotal
        $str.='<td width="25%" align="right">'.$this->session->userdata('local_admin_currency_type')." ".$grandTotal.'</td>';
        $str.='</tr>';
        
       } 
        $totalTax = 0;
        $taxDetailsArr = $this->page_model->getTaxDetails($local_admin_id);
		$li_counter=0;
        foreach($taxDetailsArr as $val){
            $str.='<tr>';    
            $str.='<td colspan="3" align="right"><b>';
            if($grandTotal >0){
				$str .= $val['tax_title'].'('.$val['tax_rate'].'%)';
			}
            $str .= '</b></td>';
			$str.='<input type="hidden" name="tax_name_'.$li_counter.'" value="'.$val['tax_title'].'"><input type="hidden" name="tax_value_'.$li_counter.'" value="'.$val['tax_rate'].'">';
            $tax = ($grandTotal*$val['tax_rate'])/100;
            $tax = round($tax,2);
            $totalTax = $totalTax + $tax;
            $str.='<td width="25%" align="right">';
           if($grandTotal >0){
		   		$str .= $this->session->userdata('local_admin_currency_type')." ".$tax;
		   } 
            $str .= '</td>';
            $str.='</tr>';
			$li_counter++;
        }
        $finalTotal = $grandTotal + $totalTax;
        $finalTotal = round($finalTotal,2); 
		
		$str.='<tr style="font-size:15px;display:none;" id="discount_coupon_tr">';
		$str.='<td colspan="3" align="right">Discount</td>';//GrandTotal
        $str.='<input type="hidden"  id="discount_coupon" name="discount_coupon" value="">';
        $str.='<td width="25%" align="right" id="discount_coupon_td"></td>';
		$str.='</tr>';
        $str.='<tr style="font-weight:bold;font-size:15px;">';
        $str.='<td colspan="3" align="right"><b>';
        if($finalTotal >0){
			$str .= $this->global_mod->db_parse($this->lang->line('mobile_grand_total'));
		}
        $str .= '</b></td>';//GrandTotal
        $str.='<input type="hidden" name="tax_counter" value="'.$li_counter.'">';
        $str.='<td width="25%" align="right" id="final_total_td">';
        if($finalTotal >0){
			$str .= $this->session->userdata('local_admin_currency_type')." ".$finalTotal;
		}
        $str .= '</td>';
        $str.='</tr>';
        $str.='</table>';
        $str.='</td>';
        $str.='</tr>';
	$local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
        
        if($local_admin_settings[0]['pre_pmnt_setting'] !=0){
            $str.='<tr>';
            $str.='<td>';
            $paymentGatewayssArr = $this->page_model->getPaymentGateways($local_admin_id);
            if(count($paymentGatewayssArr)==1){
                if($finalTotal >0){
                	$str.='<lable style="font-weight:bold;font-size:20px;">';
					$str .= 'Pay with '.$paymentGatewayssArr[0]['payment_gateways_name'];
					$str .= '</lable>';
				}
                
            }else{
               if($finalTotal >0){
			   		$str.='<lable style="font-weight:bold;font-size:20px;">Please select your payment option:</lable>';
	                foreach($paymentGatewayssArr as $val){
	                    $str.='<ul>';
	                    $str.='<li>&nbsp;&nbsp;<input type="radio" name="paytype">&nbsp;&nbsp;'.$val['payment_gateways_name'].'</li>';
	                    $str.='</ul>';
	                }
			   }
            }
            $str.='</td>';	
            $str.='</tr>';
	    }
		if($finalTotal >0){
			$str.='<tr>';
	        $str.='<td>';
	        $str.='<lable style="font-weight:bold;font-size:13px;">'.$this->global_mod->db_parse($this->lang->line('mobile_discount_coupon')).'</lable> <input type="text" id="discountCodeOnBook" style="width:110px">&nbsp;&nbsp;';
			$str.='<button id="applyCouponButton" bookingDetails=\''.$json_encode_arr.'\'>'.$this->global_mod->db_parse($this->lang->line('mobile_apply')).'</button>';//Apply
	        $str.='</td>';	
	        $str.='</tr>';
		}
		$str.='<tr>';
        $str.='<td>';
        $str.='<span id="i_accept_span"><input type="checkbox" id="i_accept">&nbsp;&nbsp;'.$this->global_mod->db_parse($this->lang->line('mobile_terms')).'<span onclick="terms_and_condition_booking()" id="terms_and_condition_booking" ><a href="javascript:void(0);">'.$this->global_mod->db_parse($this->lang->line('mobile_terms_text')).'</a></span><lable style="color:Red; font-size:20px;">*</lable></span><div id="terms_and_condition_show" style="display:none;">'.$getTermsCondition.'</div><input type="hidden" id="terms_and_condition_show_hdn" value="'.$getTermsCondition.'">';
        $str.='</td>';	
        $str.='</tr>';
        $str.='<input type="hidden" name="subtotal" id="subtotal" value="'.$grandTotal.'">';
        $str.='<input type="hidden" name="taxtotal" id="taxtotal" value="'.$totalTax.'">';
        $str.='<input type="hidden" name="total" id="total" value="'.$finalTotal.'">';
		$str.='<input type="hidden" name="for_coupon_total" id="for_coupon_total" value="'.$finalTotal.'">';
	    $str.='<tr class="booking_tab_row_footer">';
        $str.='<td align="right"><button id="checkout_button">'.$this->global_mod->db_parse($this->lang->line('mobile_submit')).'</button></td>';//Submit
        $str.='</tr>';
        $str.='</table>';
        $str.='</form>';
        $str.='</div>';
        echo $str;
    }
    //holding data after booking
    public function holdAfterBooking(){
		$set_user_data = array(
						'hold_bTime'	=> $this->input->post('bTime'),
						'hold_staffArr'	=> $this->input->post('staffArr'),
						'hold_srvArr'	=> $this->input->post('servArr')
                );
         $this->session->set_userdata($set_user_data);
		echo 1; 
	}
	//getting customer own information
    public function getModifyMyInfoHtml(){
		$country = $this->page_model->getCountry();
        $timezone = $this->page_model->getTimeZone();
        $login_customer_id = $this->session->userdata('user_id_customer');
        $str='';
        if($login_customer_id != ''){
            $customerData = $this->customer_model->LoadCustomerById($login_customer_id);
           // echo "<pre>";
           // print_r($customerData);
           // exit;
            
            $cus_fname = isset($customerData['cus_fname'])?$customerData['cus_fname']:'';
            $cus_lname = isset($customerData['cus_lname'])?$customerData['cus_lname']:'';
            $cus_mob = isset($customerData['cus_mob'])?$customerData['cus_mob']:'';
            $cus_phn1 = isset($customerData['cus_phn1'])?$customerData['cus_phn1']:'';
            $cus_phn2 = isset($customerData['cus_phn2'])?$customerData['cus_phn2']:'';
            $cus_address = isset($customerData['cus_address'])?$customerData['cus_address']:'';
            $cus_countryid = isset($customerData['cus_countryid'])?$customerData['cus_countryid']:0;
            $cus_regionid  = isset($customerData['cus_regionid'])?$customerData['cus_regionid']:0;
            $region = $this->page_model->getRegion($cus_countryid);
            $cityArr = $this->page_model->getCity($cus_regionid);
            $customer_zip  = isset($customerData['customer_zip'])?$customerData['customer_zip']:'';
            $time_zone_id  = isset($customerData['time_zone_id'])?$customerData['time_zone_id']:'';
            $user_email    = isset($customerData['user_email'])?$customerData['user_email']:'';
            $user_id    = isset($customerData['user_id'])?$customerData['user_id']:'';
        
            $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
            $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
	        $aprvl_rqrd_mob_non_verfd_mem = $local_admin_settings[0]['aprvl_rqrd_mob_non_verfd_mem'];	
            
            
            $edit_setting = $this->customer_model->GetEditSetting();
           
           
            
	        $str.='<div id="registration_panel" class="hide_all">';
	        
            $str.='<div class="registration-div">';
            
            $str.='<form method="post" action="" name="cus_reg" id="cus_reg">';
            
            $str.='<table width="100%" cellpadding="0" cellspacing="0" border="0" class="registration-tabl">';
            
            if(isset($customerData['email_veri_status']) == 0 && $aprvl_rqrd_mob_non_verfd_mem == 1){
                $str.='<tr><td colspan="2"><span style="color:#FF0000;font-size:14px;font-weight:700;margin:0 0 0 -10px;">'.$this->global_mod->db_parse($this->lang->line('mobile_acc_not_verified')).'</span></td></tr>';
            }
            $str.='<tr><td colspan="2"><span class="point">'.$this->global_mod->db_parse($this->lang->line('mobile_acc_info_record')).'</span></td></tr>';
            
            if(in_array(2, $edit_setting)){
           		$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_first_name')).':</td><td><input type="text" name="cus_fname_2" id="cus_fname_2" value="'.$cus_fname.'" onfocus="clr_reg_values(this);" class="required"/><sup>*</sup></td></tr>';
            }
            
            if(in_array(3, $edit_setting)){
            	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_last_name')).':</td><td><input type="text" name="cus_lname_3" id="cus_lname_3" value="'.$cus_lname.'" onfocus="clr_reg_values(this);" class="required"/><sup>*</sup></td></tr>';
            }
            
	   		if(in_array(9, $edit_setting)){
	   			$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_mobile')).':</td><td><input type="text" name="cus_mob_9" id="cus_mob_9" onfocus="clr_reg_values(this);" value="'.$cus_mob.'" /><span id="cus_phn1_10_div" class="required_div"></span>';
            
            	$str.='</td></tr>';
	   		}
	   		
	   		if(in_array(10, $edit_setting)){
	   			 $str.='<tr><td valign="top">'.$this->global_mod->db_parse($this->lang->line('mobile_phone1')).':</td><td><input type="text" name="cus_phn1_10" value="'.$cus_phn1.'" id="cus_phn1_10" onfocus="clr_reg_values(this);" />';
            
           		 $str.='<span id="cus_phn1_10_div" class="required_div" ></span></td></tr>';
	   		}
	   		
	   		if(in_array(11, $edit_setting)){
	   			$str.='<tr><td valign="top">'.$this->global_mod->db_parse($this->lang->line('mobile_phone2')).':</td><td><input type="text" name="cus_phn2_11" id="cus_phn2_11" value="'.$cus_phn2.'"  onfocus="clr_reg_values(this);" />';
            
            	$str.='<span id="cus_phn1_10_div" class="required_div" ></span></td></tr>';
	   		}
	   		
            if(in_array(4, $edit_setting)){
            	$str.='<tr><td valign="top">'.$this->global_mod->db_parse($this->lang->line('mobile_address')).':</td><td><textarea name="cus_address_4" id="cus_address_4">'.$cus_address.'</textarea>';
            
            	$str.='<span id="cus_address_4_div" class="required_div" ></span></td></tr>';
            }
            
            if(in_array(5,$edit_setting)){
				$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_country')).':</td><td valign="top">';  //$country;  
            	$str.='<select id="cus_countryid_5" name="country_id_5">';
            	$str.='<option value="0">'.$this->global_mod->db_parse($this->lang->line('mobile_select_country')).'</option>';//Select..
	            foreach($country as $val){
	                $sel='';
	                if($cus_countryid==$val['country_id'])
	                    $sel = 'selected=selected';
	                $str.='<option '.$sel.' value='.$val['country_id'].' >'.$val['country_name'].'</option>';
	            }
            	$str.='</select>';
            	$str.='<span id="cus_countryid_5_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
			}
            
            if(in_array(6,$edit_setting)){
            	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_region')).':</td><td>';//echo  $region;  
            	$str.='<span id="nw_region_span"><select id="cus_regionid_6" name="region_id_6">';
            	$str.='<option value="0">'.$this->global_mod->db_parse($this->lang->line('pleaseSelect')).'..</option>';
		
	            foreach($region as $val){
	                $sel='';
	                if($cus_regionid==$val['region_id'])
	                    $sel = 'selected=selected';		 
	                $str.='<option '.$sel.' value='.$val['region_id'].' >'.$val['region_name'].'</option>';
	            }
	        	$str.='</select></span>';
            	$str.='<span id="cus_regionid_6_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
            }
            
            if(in_array(7,$edit_setting)){
            	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_city')).':</td><td valign="top">';//echo  $city; 
           		$str.='<span id="nw_city_span"><select id="cus_cityid_7" name="city_id_7">';
            	$str.='<option value="0">'.$this->global_mod->db_parse($this->lang->line('pleaseSelect')).'..</option>';
		
		        foreach($cityArr as $val){
	                $sel='';
	                if($cus_regionid==$val['city_id'])
	                    $sel = 'selected=selected';	 
	                $str.='<option '.$sel.' value='.$val['city_id'].' >'.$val['city_name'].'</option>';
	            }
            	$str.='</select></span>';
		
            	$str.='<span id="cus_cityid_7_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
            }
            
            if(in_array(8,$edit_setting)){
            	$str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_zip')).' : </td><td><input id="cus_zip_8" type="text" name="cus_zip_8" value="'.$customer_zip.'"  onfocus="clr_reg_values(this);"/><span id="cus_phn1_10_div" class="required_div"></span></td></tr>';
            }
            
            if(in_array(21,$edit_setting)){
            	$str.='<tr><td>Time Zone:</td><td>';// echo  $time_zone; 
            	$str.='<select id="cus_time_zone_id_21" name="time_zone_id_21">';
            	$str.='<option value="0">Select..</option>';
	            foreach($timezone as $val){
	                $sel='';
	                if($time_zone_id==$val['time_zone_id'])
	                    $sel = 'selected=selected';
	                $str.='<option '.$sel.'  value='.$val['time_zone_id'].'>'.$val['time_zone_name'].'</option>';
	            }
	            $str.='</select>';
	            $str.='<span id="cus_time_zone_id_21_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
            }
            
            
            
            //$str.='<tr><td colspan="2"><span class="point"> 2. Select an Email Id and password </span><sup>*</sup></td></tr>';
	  
            $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('email')).':</td><td><input type="text" name="user_email_update" id="user_email_update" value="'.$user_email.'" class="required" onfocus="" readonly="" /><sup>*</sup></td></tr>';
            //$str.='<tr><td>User Name:</td><td><input type="text" name="user_name" id="user_name_reg" value="" class="required" onfocus="clr_reg_values(this);" /><sup>*</sup></td></tr>';
            $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('password')).':</td><td><input type="password"  value="" id="ori_pass_reg" name="ori_pass" class="required"  onfocus="clear_fields(this.id);"/><span id="ori_ps_err"></span></td></tr>';
            
            $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_confirm_password')).':</td><td><input type="password"  id="conf_pass_reg" name="conf_pass" value="" class="required" onfocus="clear_fields(this.id);" /><span id="conf_ps_err"></span></td></tr>';
            $str.='<tr><td></td><td><input type="button" name="sub_reg" id="sub_reg" value="'.$this->global_mod->db_parse($this->lang->line('mobile_update')).'" onclick="updateCustomerInfo();" class="btn-gray-popup" />&nbsp; &nbsp;<input type="button" name="cancel_info" value="'.$this->global_mod->db_parse($this->lang->line('cancel')).'" onclick="pr_popup_close();" class="btn-gray-popup" />&nbsp; &nbsp; &nbsp; &nbsp; <span id="delText" onclick="showCondition()" style="cursor:pointer;">'.$this->global_mod->db_parse($this->lang->line('mobile_delete_account')).'</span></td></tr>';
            $str .= '<input type="hidden" name="user_id" id="user_id" value="'.$user_id.'" />';
	        ##############################################################################################
            $str.='<tr id="terms" style="display:none;"><td></td><td colspan="2">
                <table align="left">
                    <tr>
                        <td colspan="2">
                            <input type="checkbox" value="1" id="accept" />
                            <span>'.$this->global_mod->db_parse($this->lang->line('mobile_booking_deleted')).'</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" name="sub_reg" id="sub_reg" value="'.$this->global_mod->db_parse($this->lang->line('mobile_delete_account')).'" onclick="deleteAccount();" class="btn-gray-popup" />
                        </td>
                        <td>
                            <input type="button" name="cancel_info" value="'.$this->global_mod->db_parse($this->lang->line('cancel')).'" onclick="cancelDelete();" class="btn-gray-popup" />
                        </td>
                    </tr>
                </table>
            </td></tr>';
            ##############################################################################################
            $str.='</form></div></div>'; 
        }else{
            $str.='<div id="registration_panel" class="hide_all">';
            $str.='<div class="registration-div">';
            $str.='<form method="post" action="" name="cus_reg" id="cus_reg">';
            $str.='<table width="100%" cellpadding="0" cellspacing="0" border="0" class="registration-tabl">';
            $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_login_again'));
            $str.='</td></tr></table>';
            $str.='</form></div></div>';
        }
        echo $str;
        
    }
    
	//update customer information
    public function updateCustomer(){
		$insert_list = array();
		$insert_list = $_REQUEST;
		$insert_list['local_admin_id'] = $this->session->userdata('local_admin_id');
		$this->customer_registration_model->UpdateCustomerData($insert_list);
	}
    //creating payment form
    public function fnp_paymentForm(){
        $bookTime = $this->input->post('bTime');
		$final_return = array();
        $returnArr = array();
		$taxArr = array();
		
		$serviceCounter = $this->input->post('serviceCounter');
		for($i=0;$i<$serviceCounter;$i++){
				$returnArr[$i]['service_time'] 		=  $this->input->post('service_time_'.$i);
				$returnArr[$i]['service_date'] 		=  $this->input->post('service_date_'.$i);
				$returnArr[$i]['service_id']		=  $this->input->post('service_id_'.$i);
				$returnArr[$i]['service_staff']		=  $this->input->post('service_staff_'.$i);
				$returnArr[$i]['temp_id']			=  $this->input->post('temp_id_'.$i);
				$returnArr[$i]['service_capacity']	=  $this->input->post('service_capacity_'.$i);
		}
		$tax_counter = $this->input->post('tax_counter');
		for($j=0;$j<$tax_counter;$j++){
				$name	= $this->input->post('tax_name_'.$j);
				$val	= $this->input->post('tax_value_'.$j); 
				$taxArr[$j][$name] 		=  $val;
		}
				$final_return['subtotal']		= $this->input->post('subtotal');
				$final_return['taxtotal']		= $this->input->post('taxtotal');
				$final_return['total']			= $this->input->post('total');
				$final_return['item_details'] 	= $returnArr;
       			$final_return['tax_details'] 	= $taxArr;
       			$final_return['addtional_data'] = $this->input->post('tmpBookDetails');
       	
       
       	$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 3 : 2) : 1);
		$final_return['device_type']	= $deviceType;
                        
		$insert = $this->page_model->saveBookingData($final_return);
				
		if($this->input->post('total') >0){
		      
			 	$finalTotal		= $this->input->post('total');
				$subtotal		= $this->input->post('subtotal');
				$taxtotal		= $this->input->post('taxtotal');
				
				//$local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
				
				$local_admin_id	= $this->session->userdata('local_admin_id');
		        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
		        
				if($local_admin_settings[0]['pre_pmnt_setting'] !=0){
		        $str='';
		        $str.='<form name="frm_paymentDetails" id="frm_paymentDetails" method="post" onsubmit="return false;">';        
		        $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%" class="bookung_tab">';
		        $str.='<tr class="booking_tab_row_top">';
		        $str.='<td align="left"><b>'.$this->global_mod->db_parse($this->lang->line('mobile_payment_details')).' :</b></td>';//Payment details
		        $str.='</tr>';
		        $str.='<tr>';
		        $str.='<td align="left">'.date("F d, Y (l)",$bookTime).'<hr style="width:100%;"></td>';
		        $str.='</tr>';
		        $str.='<tr>';
		        $str.='<td>';
		            $str.='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_first_name')).':<label style="color:#FF0000">*</label></td>';//First Name
		            $str.='<td width="60%" align="left"><input value="citytech" name="pay_first_name" id="pay_first_name" type="text" class="payBooking pf_required"/></td>';
		            $str.='</tr>';

		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_last_name')).':<label style="color:#FF0000">*</label></td>';//Last Name
		            $str.='<td width="60%" align="left"><input value="software" name="pay_last_name" id="pay_last_name" type="text" class="payBooking pf_required"/></td>';
		            $str.='</tr>';
		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_amount')).':<label style="color:#FF0000">*</label></td>';//Amount
		            $str.='<td width="60%" align="left"><input name="pay_amount" id="pay_amount" type="text" class="payBooking pf_required" readonly value="'.$finalTotal.'" /></td>';
		            $str.='</tr>';

		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_cc_type')).':<label style="color:#FF0000">*</label></td>';//CC Type
		            $str.='<td width="60%" align="left">';
		                    $str.='<select id="pay_cardtype" name="pay_cardtype" class="payBooking_select pf_required">';
		                    $str.='<option value="">Select Card</option>';
		                    $str.='<option value="Visa">Visa</option>';
		                    $str.='<option value="MasterCard">MasterCard</option>';
		                    $str.='<option value="Discover">Discover</option>';
		                    $str.='<option value="Amex">American Express</option>';
		                    $str.='</select>';
		            $str.='</td>';
		            $str.='</tr>';

		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_creditcard_number')).':<label style="color:#FF0000">*</label></td>';//Creditcard Number
		            $str.='<td width="60%" align="left"><input value="" name="pay_ccnumber" id="pay_ccnumber" type="text" class="payBooking pf_required"/></td>';
		            $str.='</tr>';

		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_expiry_date')).':<label style="color:#FF0000">*</label></td>';//Expiry Date
		            $str.='<td width="60%" align="left">';
		                    $str.='<select id="pay_month" name="pay_month" class="payBooking_select_sm pf_required">';
		                    $str.='<option value="">'.$this->global_mod->db_parse($this->lang->line('mobile_select_month')).'</option>';//Select Month
		                    $str.='<option value="1">'.$this->global_mod->db_parse($this->lang->line('cal_jan')).'</option>';//Jan
		                    $str.='<option value="2">'.$this->global_mod->db_parse($this->lang->line('cal_feb')).'</option>';//Feb
		                    $str.='<option value="3">'.$this->global_mod->db_parse($this->lang->line('cal_mar')).'</option>';//Mar
		                    $str.='<option value="4">'.$this->global_mod->db_parse($this->lang->line('cal_apr')).'</option>';//Apr
		                    $str.='<option value="5">'.$this->global_mod->db_parse($this->lang->line('cal_may')).'</option>';//May
		                    $str.='<option value="6">'.$this->global_mod->db_parse($this->lang->line('cal_jun')).'</option>';//Jun
		                    $str.='<option value="7">'.$this->global_mod->db_parse($this->lang->line('cal_jul')).'</option>';//Jul
		                    $str.='<option value="8">'.$this->global_mod->db_parse($this->lang->line('cal_aug')).'</option>';//Aug
		                    $str.='<option value="9">'.$this->global_mod->db_parse($this->lang->line('cal_sep')).'</option>';//Sep
		                    $str.='<option value="10">'.$this->global_mod->db_parse($this->lang->line('cal_oct')).'</option>';//Oct
		                    $str.='<option value="11">'.$this->global_mod->db_parse($this->lang->line('cal_nov')).'</option>';//Nov
		                    $str.='<option value="12">'.$this->global_mod->db_parse($this->lang->line('cal_dec')).'</option>';//Dec
		                    $str.='</select> &nbsp;&nbsp;';
		                    $str.='<select id="pay_year" name="pay_year" class="payBooking_select_sm pf_required">';
		                    $str.='<option value="">'.$this->global_mod->db_parse($this->lang->line('mobile_select_year')).'</option>';//Select Year
		                    for($y=date('Y');$y<date('Y')+18;$y++){
		                        $str.='<option value="'.$y.'">'.$y.'</option>';
		                    }
		                    $str.='</select>';
		            $str.='</td>';
		            $str.='</tr>';

		            $str.='<tr>';
		            $str.='<td width="40%" align="left">'.$this->global_mod->db_parse($this->lang->line('mobile_cvv')).':<label style="color:#FF0000">*</label></td>';//CVV
		            $str.='<td width="60%" align="left"><input value="" name="pay_cvv" id="pay_cvv" type="text" class="payBooking pf_required"/></td>';
		            $str.='</tr>';


		            $str.='</table>';
		            $str.='</td>';	
		    $str.='</tr>';
		            $str.='<tr class="booking_tab_row_footer">';
		    $str.='<td align="right"><button id="checkout_button">'.$this->global_mod->db_parse($this->lang->line('mobile_payment')).'</button></td>';//Payment
		    $str.='</tr>';
		            $str.='</table>'; 
		            
		    $data=serialize($returnArr); 
		  $encoded=htmlentities($data);        
		            
		    $str.='<input type="hidden" name="pay_sub_amount" id="pay_sub_amount" value="'.number_format($subtotal,2).'">';
		    $str.='<input type="hidden" name="pay_tax" id="pay_tax" value="'.number_format($taxtotal,2).'">';
		    $str.='<input type="hidden" name="pay_amount" id="pay_amount" value="'.number_format($finalTotal,2).'">';        
		    $str.='<input type="hidden" name="returnArr" id="returnArr" value="'.$encoded.'">';
		    $str.='<input type="hidden" name="lastBookingId" id="lastBookingId" value="'.$insert.'">';           
		            
		    $str.='</form>'; 
		            echo $str;
			}else{
					$this->page_model->updatePayPalReturn($insert,3);
					$this->checkMemberShip($insert);
		            echo 1;
			}
		}else{
			 $this->page_model->updatePayPalReturn($insert,4);
			 echo 2;
		}	
   }
    //payment procedure
     public function fnp_sendToPayment(){
			$dataArrIn['pay_cardtype']		= $this->input->post('pay_cardtype');
			$dataArrIn['pay_ccnumber']		= $this->input->post('pay_ccnumber');
			$dataArrIn['pay_month']			= $this->input->post('pay_month');
			$dataArrIn['pay_year']			= $this->input->post('pay_year');
			$dataArrIn['pay_cvv']			= $this->input->post('pay_cvv');
			$dataArrIn['pay_first_name']	= $this->input->post('pay_first_name');
			$dataArrIn['pay_last_name']		= $this->input->post('pay_last_name');
			$dataArrIn['pay_amount']		= $this->input->post('pay_amount');
			$dataArrIn['lastBookingId']		= $this->input->post('lastBookingId');
			$dataArrIn['returnArr']			= $this->input->post('returnArr');

		/*	$dataArrOut['bTime']			= $this->input->post('pay_address1');
			$dataArrOut['staffArr']			= $this->input->post('pay_address1');
			$dataArrOut['srvArr']			= $this->input->post('pay_address1');
		*/

			$datInaArr['cardType']			= $this->input->post('pay_cardtype');
			$datInaArr['cardNumber']		= $this->input->post('pay_ccnumber');
			$datInaArr['cardMonth']			= $this->input->post('pay_month');
			$datInaArr['cardYear']			= $this->input->post('pay_year');
			$datInaArr['cardCVV']			= $this->input->post('pay_cvv');
			$datInaArr['fname']				= $this->input->post('pay_first_name');
			$datInaArr['lname']				= $this->input->post('pay_last_name');
			$datInaArr['PayAmount']			= $this->input->post('pay_amount');
			$dataOut						= $this->input->post('lastBookingId');
    		
    		$set_user_data = array('new_booking'  => $this->input->post('lastBookingId'));
            $this->session->set_userdata($set_user_data);   

			$returnPapal = $this->global_payment_mod->sendToPaymentViaPaypal($datInaArr,$dataOut);
			
			if($returnPapal['msg']=='success'){
				$this->page_model->updatePayPalReturn($returnPapal['return'],1);///update database 
				$this->fn_afterBooking($dataArrIn['lastBookingId']);//send sms and Mail
				$return = array(
                    'is_success'=>1
                );
			}else{
				//$this->page_model->updatePayPalReturn($returnPapal['return']); 
				$return = array(
                    'is_success'=>1
                );
			}
			echo json_encode($return);
    }
    
    
    //customer registration
    public function customer_registration(){
	    $ls_bTime = $this->input->post('bTime');
        $country = $this->page_model->getCountry();
        $timezone = $this->page_model->getTimeZone();
        /*****      GET ALLOWED REGISTRATION INFORMATION STARTS     *****/
        $local_admin_id = $this->session->userdata('local_admin_id');
		$regInfo =	$this->customer_registration_model->checkRegistrationInformation($local_admin_id);
		
		
		
        /*****      GET ALLOWED REGISTRATION INFORMATION ENDS       *****/
        $str='';
        $str.='<div id="registration_panel" class="hide_all">';
        $str.='<div class="registration-div">';
        $str.='<form method="post" action="" name="cus_reg" id="cus_reg" onsubmit="return false;">';
        $str.='<table width="100%" cellpadding="0" cellspacing="0" border="0" class="registration-tabl">';
        $str.='<tr><td colspan="2"><span class="point"> 1. '.$this->global_mod->db_parse($this->lang->line('mobile_tell_yourself')).' </span></td></tr>';
        $str.='<input type="hidden" name="self_registration" id="self_registration" value="1" />';//HIDDEN FIELD TO TRACK SELF REGISTRATION
        if (in_array(2, $regInfo)){
            $str.='<tr><td>';
            $str.=$this->global_mod->db_parse($this->lang->line('mobile_first_name')).':';//First Name:
            $str.='</td><td>';
            $str.='<input type="text" name="cus_fname_2" id="cus_fname_2" value="" onfocus="clr_reg_values(this);" class="required"/>';
            $str.='<sup>*</sup></td></tr>';
        }
        if (in_array(3, $regInfo)){
            $str.='<tr><td>';
            $str.=$this->global_mod->db_parse($this->lang->line('mobile_last_name')).':';//Last Name
            $str.='</td><td>';
            $str.='<input type="text" name="cus_lname_3" id="cus_lname_3" value="" onfocus="clr_reg_values(this);" class="required"/>';
            $str.='<sup>*</sup></td></tr>';
        }
        if (in_array(9, $regInfo)){
            $str.='<tr><td>';
            $str.=$this->global_mod->db_parse($this->lang->line('mobile_mobile')).':';//Mobile
            $str.='</td><td>';
            $str.='<input type="text" name="cus_mob_9" id="cus_mob_9" onfocus="clr_reg_values(this);" value="" maxlength="10" class="required"/>';
            //$str.='<span id="cus_phn1_10_div" class="required_div"></span>';
            $str.='<sup>*</sup></td></tr>';
        }
        if (in_array(10, $regInfo)){
            $str.='<tr><td valign="top">';
            $str.=$this->global_mod->db_parse($this->lang->line('mobile_phone1')).':';//Phone1
            $str.='</td><td>';
            $str.='<input type="text" name="cus_phn1_10" id="cus_phn1_10" onfocus="clr_reg_values(this);"  maxlength="10"/>';
            $str.='<span id="cus_phn1_10_div" class="required_div" ></span></td></tr>';
            $str.='<tr><td valign="top">';
        }
        if (in_array(11, $regInfo)){
            $str.=$this->global_mod->db_parse($this->lang->line('mobile_phone2')).':';//Phone2
            $str.='</td><td>';
            $str.='<input type="text" name="cus_phn2_11" id="cus_phn2_11" onfocus="clr_reg_values(this);" maxlength="10"/>';
            $str.='<span id="cus_phn1_10_div" class="required_div" ></span></td></tr>';
        }
        if (in_array(4, $regInfo)){
            $str.='<tr><td valign="top">';
            $str.=$this->global_mod->db_parse($this->lang->line('mobile_address')).':';//Address
            $str.='</td><td>';
            $str.='<textarea name="cus_address_4" id="cus_address_4"></textarea>';
            $str.='<span id="cus_address_4_div" class="required_div"></span></td></tr>';
        }
        $str.='<tr><td>';
        $str.=$this->global_mod->db_parse($this->lang->line('mobile_country')).':';//Country
        $str.='</td><td valign="top">';  //$country;  
        $str.='<select id="cus_countryid_5" name="country_id_5">';
        $str.='<option value="0">'.$this->global_mod->db_parse($this->lang->line('mobile_select_country')).'</option>';//Select Country
        foreach($country as $val){
            $str.='<option value='.$val['country_id'].'>'.$val['country_name'].'</option>';
        }
        $str.='</select>';
        $str.='<span id="cus_countryid_5_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
        $str.='<tr><td>';
        $str.=$this->global_mod->db_parse($this->lang->line('mobile_region')).':';//Region
        $str.='</td><td>';//echo  $region;  
        $str.='<span id="nw_region_span"><select id="cus_regionid_6" name="region_id_6">';
        $str.='<option value="0">'.$this->global_mod->db_parse($this->lang->line('mobile_select_region')).'</option>';//Select Region
        $str.='</select></span>';
        $str.='<span id="cus_regionid_6_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
        $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_city')).':</td><td valign="top">';//echo  $city; 
        $str.='<span id="nw_city_span"><select id="cus_cityid_7" name="city_id_7">';
        $str.='<option value="0">'.$this->global_mod->db_parse($this->lang->line('mobile_select_city')).'</option>';//Select City
        $str.='</select></span>';
        $str.='<span id="cus_cityid_7_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
        $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_zip')).' : </td><td><input id="cus_zip_8" type="text" name="cus_zip_8"  onfocus="clr_reg_values(this);"/><span id="cus_phn1_10_div" class="required_div"></span></td></tr>';
        if (in_array(21, $regInfo)){
            $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_time_zone')).':</td><td>';// echo  $time_zone; 
            $str.='<select id="cus_time_zone_id_21" name="time_zone_id_21">';
            $str.='<option value="">'.$this->global_mod->db_parse($this->lang->line('pleaseSelect')).'..</option>';
            foreach($timezone as $val){
            $str.='<option value='.$val['time_zone_id'].'>'.$val['time_zone_name'].'</option>';
            }
            $str.='</select></tr>';
        }
        //$str.='<span id="cus_time_zone_id_21_div" style="color:#CC0000;" class="required_div"></span></td></tr>';
        $str.='<tr><td colspan="2"><span class="point"> 2. '.$this->global_mod->db_parse($this->lang->line('mobile_email_password')).' </span><sup>*</sup></td></tr>';
        $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('email')).':</td><td><input type="text" name="user_email" id="user_email" value="" class="required" onfocus="clr_reg_values(this);" /><sup>*</sup></td></tr>';
        // $str.='<tr><td>User Name:</td><td><input type="text" name="user_name" id="user_name_reg" value="" class="required" onfocus="clr_reg_values(this);"  /><sup>*</sup></td></tr>';
        $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('password')).':</td><td><input type="password"  value="" id="ori_pass_reg" name="ori_pass" class="required"  onfocus="clr_reg_values(this);"/><sup>*</sup></td></tr>';
        $str.='<tr><td>'.$this->global_mod->db_parse($this->lang->line('mobile_confirm_password')).':</td><td><input type="password"  id="conf_pass_reg" name="conf_pass" value="" class="required" onfocus="clr_reg_values(this);" /><sup>*</sup></td></tr>';
        $str.='<tr><td>&nbsp;</td><td><input type="button" name="sub_reg" id="sub_reg" value="'.$this->global_mod->db_parse($this->lang->line('mobile_register')).'" onclick="SubmitRegDataModal('.$ls_bTime.');" class="btn-gray-popup" /></td></tr>';
        //$str.='<tr><td colspan="2" style="padding-left:100px;">Already have an account?';
        //$str.='<input type="button" class="link-button" onclick="show_login_panel();" value="login here"></td></tr></table>';
        $str.='</form></div></div>';
        echo $str;
    }
    //getting region list
    public function region(){
        $country = $this->input->post('country_id');
        $str = '';
        $region = $this->page_model->getRegion($country);
        $str.='<select id="cus_regionid_6" name="region_id_6">';
        $str.='<option value="0">Select Region</option>';
        foreach($region as $val){
            $str.='<option value='.$val['region_id'].'>'.$val['region_name'].'</option>';
        }
        $str.='</select>';
        echo $str;
    }
    //getting city list
    public function city(){
        $region = $this->input->post('region_id');
        $str = '';
        $city = $this->page_model->getCity($region);
        $str.='<select id="cus_cityid_7" name="city_id_7">';
        $str.='<option value="0">Select City</option>';
        foreach($city as $val){
            $str.='<option value='.$val['city_id'].'>'.$val['city_name'].'</option>';
        }
        $str.='</select>';
        echo $str;
    
	}
    //getting login icons
    public function chkLoginIcon(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$login_id =	$this->customer_registration_model->chkLogin($local_admin_id);
		$str = '';
		$str .='<ul id="clickme-ul">';
		if (in_array(1, $login_id)){	
			$str .= '<li onclick="logintab(\'tab1\')" id="pardco"> <img src="'.base_url().'asset/front_image/padco-icon.png"/></li>';
		}
		if (in_array(2, $login_id)){
			$str .= '<li onclick="logintab(\'tab2\')" id="fbk"><img src="'.base_url().'asset/front_image/facebook-icon.png"/></li>';
		}
		if (in_array(4, $login_id)){
			$str .= '<li onclick="logintab(\'tab3\')" id="google"><img src="'.base_url().'asset/front_image/google-tab.png"/></li>';
		}
		$str .='</ul>';
		$bTime = isset($_REQUEST['bTime'])?$_REQUEST['bTime']:'';	
		$arr = array('html'=>$str,'res'=>true,'bTime'=>$bTime);
		echo json_encode($arr);
		exit;	
	}
	//getting business hour list
    public function fn_business_hour_list(){
		$start = ' ORDER BY day_id,service_id,employee_id,time_from ';
		$bizArr = $this->global_mod->mainBizScheduleFrontend($start);
		
		$tmp = array();

		foreach($bizArr as $arg){
			$tmp[$arg['service_id']][] = array(
			                                  'service_id'			=> $arg['service_id'],
			                                  'local_admin_id'		=> $arg['local_admin_id'],
			                                  'employee_id'			=> $arg['employee_id'],
			                                  'day_id'				=> $arg['day_id'],
			                                  'time_from'			=> $arg['time_from'],
			                                  'time_to'				=> $arg['time_to'],
			                                  'booking_capacity'	=> $arg['booking_capacity'],
			                                  'service_duration'	=> $arg['service_duration'],
			                                  'main_id'				=> $arg['main_id']
			                                  );
		}
	echo json_encode($tmp);	
    }
    //deleting customer account    
    public function deleteAccount(){
        $del = $this->global_mod->deleteCustomer();
        if($del == 1){
            echo 1;
        }else{
            echo 0;
        }
    }    
    //checking capasity of booking
	public function checkingBookingCapacity(){
		$local_admin_id =  $this->session->userdata('local_admin_id');
		$serviceArr = $this->page_model->getServiceList($local_admin_id);
		$dataArr = array();
		$i=0;
		foreach($serviceArr AS $serviceVal){
			$start	= ' AND srvDtls_service_id='.$serviceVal['service_id'];
			$end	= ' COUNT(*) AS totalBooking ';
			$booking = $this->global_mod->mainBookingStorePro($start,$end);
			$dataArr[$i]['serviceId']			= $serviceVal['service_id'];
			$dataArr[$i]['totalCapacity']		= $serviceVal['service_capacity'];
			$dataArr[$i]['totalBooking']		= $booking[0]['totalBooking'];
			$dataArr[$i]['remainingCapacity']	= ($dataArr[$i]['totalCapacity']-$dataArr[$i]['totalBooking']);
			$i++;
		}
		return $dataArr;
	}
	
	public function socialPromotion(){
		$bTime		= $this->input->post('bTime');
		$template	= $this->page_model->getALLTemplate(); 
		$design		= $this->page_model->getDesignOffer();
		
		$str	 = '';
		$str	.= '<div class="socialBlockOuter" id="socialBlockOuter" style="width: 500px;border: 4px solid #ccc;">';
		$str	.= $template[0]['template_body'];
		$str	.= '</div>';
		$str	.= '<div  style="background:#CCCCFF; border-radius:5px; -webkit-border-radius:5px;  -moz-border-radius:5px; padding:10px 20px; margin-top:20px;">';
		$str	.= '<lable style="font-size:15px;">Cancellation Policy</lable></br>';
		$str	.= '<lable style="font-size:10px; text-align:justify;">We understand that special circumstances are unavoidable and a cancellation may be necessary. Please call us at +1234567890 during regular business hours to cancel or reschedule your appointments. Remember, any cancellation and/or rescheduling can be done 24hrs. prior to your appointment.</lable>';
		$str	.= '</div>';
		$str	.= '<script type="text/javascript">';
		$str	.= '$(document).ready(function(){';
		$str	.= 'var fb_link ="http://facebook.com";';
		$str	.= 'var tw_link="http://twitter.com";';
		if(count($design) > 0){
		    $str	.= '$("#bgColor").val("'.$design[0]["background_color"].'");';
		    $str	.= '$("#borColor").val("'.$design[0]["border_color"].'");';
		    $str	.= '$("#titleColor").val("'.$design[0]["title_color"].'");';
		    $str	.= '$("#descColor").val("'.$design[0]["description_color"].'");';
		    $str	.= '$("#ImageRepeat").val("'.$design[0]["repeat"].'");';
		    $str	.= '$("#ImagePosition").val("'.$design[0]["position"].'");';
		    $str	.= '$("#NewPromotionTitle").val("'.$design[0]["title"].'");';
		    $str	.= '$("#NewPromotionDescription").val("'.$design[0]["description"].'");';
		    $str	.= '$(".SocialHead").html("'.$design[0]["title"].'");';
		    $str	.= '$(".SocialDes").html("'.$design[0]["description"].'");';
		    $str	.= '$(".socialBlockOuter").css("backgroundColor", "'.$design[0]["background_color"].'");';
		    $str	.= '$(".socialBlockOuter").css("border-color", "'.$design[0]["border_color"].'");';
		    $str	.= '$(".SocialHead").css("color","'.$design[0]["title_color"].'");';
		    $str	.= '$(".SocialDes").css("color","'.$design[0]["description_color"].'");';
		    $str	.= 'var NewPromotionImage="'.$design[0]["image_path"].'";';
		    $str	.= 'var ImagePosition="'.$design[0]["position"].'";';
		    $str	.= 'var ImageRepeat="'.$design[0]["repeat"].'";';
		    $str	.= '$(".socialInner").css("background-image", "url("+NewPromotionImage+")");';
		    $str	.= '$(".socialInner").css("background-position", ImagePosition);';
		    $str	.= '$(".socialInner").css("background-repeat", ImageRepeat);';		
		    $str	.= '$(".tw_link").attr("href", fb_link);';
		    $str	.= '$(".fb_link").attr("href",tw_link);';
		}
		$str	.= '})';
		$str	.= '</script>';
		$str	.= '<a href="javascript:void(0);" style="float: right;" onclick="pr_popup_close_bt_booking('.$bTime.')"> '.$this->global_mod->db_parse($this->lang->line('click_continue')).'...</a>';
	    echo $str;
	}
    //checking duplicate email
	public function checkingEmail(){
		$email = $this->input->post('userEmail');
		$count = $this->global_mod->checkDuplicatEmailCustomer($email);
		echo $count;
	}
    //apply discount coupon
	public function fnp_applyCouponCode(){
		$couponCode = trim($this->input->post('couponCode'));
		$bookingDetails= json_decode($this->input->post('bookingDetails'));	
		$booking_grand_total= trim($this->input->post('booking_grand_total'));	
		$total= trim($this->input->post('total'));	
		
		$couponDetailsArr = $this->page_model->applyCouponCode($couponCode,$bookingDetails,$booking_grand_total,$total);

		echo $couponDetailsArr;
		
	}
    //get service cost
    public function getServiceCost($serviceId){
        $serviceCost = $this->page_model->getSrvCost($serviceId);
        return $serviceCost;
    }
    //get employee name
    public function getEmployeeName($staff_id){
        $employeeName = $this->page_model->getEmpName($staff_id);
        return $employeeName;
    }
    //get customer own information for mobile
    public function getMobileModifyMyInfoHtml(){
		$country = $this->page_model->getCountry();
        $timezone = $this->page_model->getTimeZone();
        $login_customer_id = $this->session->userdata('user_id_customer');
        $customerData = array();
        $customerDataArr = $this->customer_model->mobileLoadCustomerById($login_customer_id);

        foreach ($customerDataArr as $row){
			    $customerData['user_id'] = isset($row->user_id)?$row->user_id:'';
				$customerData['cus_fname'] = isset($row->cus_fname)?$row->cus_fname:'';
				$customerData['cus_lname'] = isset($row->cus_lname)?$row->cus_lname:'';
			    $customerData['cus_mob']  = isset($row->cus_mob)?$row->cus_mob:'';
				$customerData['cus_phn1'] = isset($row->cus_phn1)?$row->cus_phn1:'';
				$customerData['cus_phn2'] = isset($row->cus_phn2)?$row->cus_phn2:'';
				$customerData['cus_address'] = isset($row->cus_address)?$row->cus_address:'';
				$customerData['cus_countryid'] = isset($row->cus_countryid)?$row->cus_countryid:0;
                $cus_countryid = isset($row->cus_countryid)?$row->cus_countryid:0;
                $cus_regionid = isset($row->cus_regionid)?$row->cus_regionid:0;
                $cus_cityid = isset($row->cus_cityid)?$row->cus_cityid:0;
                $customerData['user_region'] = $this->mobileRegion($cus_countryid,$cus_regionid);
                $customerData['user_city'] = $this->mobileCity($cus_regionid,$cus_cityid);
				$customerData['customer_zip'] = isset($row->customer_zip)?$row->customer_zip:'';
				$customerData['time_zone_id'] = isset($row->time_zone_id)?$row->time_zone_id:'';
				$customerData['user_email'] = isset($row->user_email)?$row->user_email:'';
				$customerData['email_veri_status'] = isset($row->email_veri_status )?$row->email_veri_status :'';
				
			}
        $str=json_encode($customerData);
        echo $str;
    }

    public function mobile_availBookingTime(){
       /* $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);

        date_default_timezone_set('GMT');
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $timeInterval = $this->page_model->getTimeInterval($local_admin_id);

        $bDate = $this->input->post('bDate');
        $staffArr = $this->input->post('staffArr');
        $srvArr = $this->input->post('srvArr');

        $dayId = date('N',strtotime($bDate));

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

        $str ='';
        $str .=' AND employee_id IN ('.$staff.') ';
        $str .=' AND service_id IN ('.$service.') ';
        $str .=' AND day_id = '.$dayId;
        $str .= ' ORDER BY day_id,service_id,employee_id,time_from ';
		$bizArr = $this->global_mod->mainBizScheduleFrontend($str);

        $hourCount = count($bizArr);
        $hourRemainder = $hourCount%2;
        $hourResult = $hourCount/2;

        $min = PHP_INT_MAX;
        $max = 0;
        foreach ($bizArr as $value) {
            $min = min($min, strtotime($value['time_from']));
            $max = max($max, strtotime($value['time_to']));
        }

        $string = '';
        if($hourCount > 0){
            $counter = 1;
            for($i=strtotime('00:00:00');$i<=strtotime('23:59:59');$i=$i+($timeInterval*60)){
                if($i > $min && $i <= $max){
                    $bookingDateArr = explode("-",$bDate);
                    $bookingDate = $bookingDateArr[2]."-".$bookingDateArr[1]."-".$bookingDateArr[0];
                    $bookingDatetime = $bookingDate." ".date('H:i:s',$i);//echo "<br><br>LOCAL : ".

                    $gmt = $this->global_mod->gmtTimeReturn(date('H:i:s',strtotime($bookingDatetime)));
                    ###############################################
                    $gmtDateArr = explode(" ",$gmt);
                    if($gmtDateArr[0] < date('Y-m-d')){
                        //echo "HHH";
                        $bookingDate = date('Y-m-d', strtotime($bookingDate . ' - 1 day'));
                    }elseif($gmtDateArr[0] > date('Y-m-d')){
                        //echo "TTT";
                        $bookingDate = date('Y-m-d', strtotime($bookingDate . ' + 1 day'));
                    }
                    //echo "<br>GMT DATE : ".$bookingDate;
                    $gmtTime = $bookingDate." ".$gmtDateArr[1];//echo "<br>GMT : ".
                    ###############################################
                    $gmtTimestamp = strtotime($gmtTime);

                    if($local_admin_settings[0]['hours_type'] == 1){
                        $appointmentTime = date("g:i a",$i);
                    }else{
                        $appointmentTime = date("H:i",$i);
                    }

                    if($counter%2 == 1){
                        $string .= '<div class="ui-block-a timeClass"><ul>';
                        $string .= '<li id="mAvl_'.$gmtTimestamp.'" rel="'.$gmtTimestamp.'"><span></span>'.$appointmentTime.'</li>';//date('H:i',$i)
                        $string .= '</ul></div>';
                    }elseif($counter%2 == 0){
                        $string .= '<div class="ui-block-b timeClass"><ul>';
                        $string .= '<li id="mAvl_'.$gmtTimestamp.'" rel="'.$gmtTimestamp.'"><span></span>'.$appointmentTime.'</li>';//date('H:i',$i)
                        $string .= '</ul></div>';
                    }
                    $counter++;
                }
            }
        }
        echo $string;*/
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
		$timeInterval	= $local_admin_settings[0]['calTimeIntervalVariable'];
		$bDate			= $this->input->post('bDate');
        $staffArr		= $this->input->post('staffArr');
        $srvArr			= $this->input->post('srvArr');
        $dayId			= date('N',strtotime($bDate));

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

        $str ='';
        $str .=' AND employee_id IN ('.$staff.') ';
        $str .=' AND service_id IN ('.$service.') ';
        $str .=' AND day_id = '.$dayId;
        $str .= ' ORDER BY day_id,service_id,employee_id,time_from ';
		$bizArr = $this->global_mod->mainBizScheduleFrontend($str);
        $hourCount = count($bizArr);
        $hourRemainder = $hourCount%2;
        $hourResult = $hourCount/2;

        $min		= PHP_INT_MAX;
        $max		= 0;
        $maxTime	= 0;
        $maxCapacity= 0;
        foreach ($bizArr as $value) {
            $min		= min($min, strtotime($value['time_from']));
            $max		= max($max, strtotime($value['time_to']));
            $maxTime	= max($maxTime,$value['service_duration']);
            $maxCapacity= $maxCapacity+$value['booking_capacity'];
        }

        $start_date = date('Y-m-d',strtotime($bDate)).'<br>';
        $end_date = date('Y-m-d',strtotime($bDate));
        $bookiengDetails = $this->page_model->getBookingDetails_mobile($local_admin_id,$start_date,$end_date,$srvArr,$staffArr);
        $string = '';
        if($hourCount > 0){
            $counter = 1;
            for($i=$min;$i<=$max-($maxTime*60);$i=$i+($timeInterval*60)){
            	$isPresent =0;
            	foreach($bookiengDetails as $bookiengArr){
            		if((strtotime(date('H:i:s',strtotime($bookiengArr['srvDtls_service_start'])))-($maxTime*60))< $i AND $i <strtotime(date('H:i:s',strtotime($bookiengArr['srvDtls_service_end'])))){
            			$isPresent = $isPresent + $bookiengArr['srvDtls_service_quantity'];
                    }
                }
               /*######### Printing data start ########*/
               if($isPresent >= $maxCapacity){
                    // Pr_start //
					if($local_admin_settings[0]['show_block_timinig'] == 1){
                    $bookingDateArr = explode("-",$bDate);
                    $bookingDate = $bookingDateArr[2]."-".$bookingDateArr[1]."-".$bookingDateArr[0];
                    $bookingDatetime = $bookingDate." ".date('H:i:s',$i);
                    $gmt = $this->global_mod->gmtTimeReturn(date('H:i:s',strtotime($bookingDatetime)));
                    $gmtDateArr = explode(" ",$gmt);
                    if($gmtDateArr[0] < date('Y-m-d')){
                        $bookingDate = date('Y-m-d', strtotime($bookingDate . ' - 1 day'));
                    }elseif($gmtDateArr[0] > date('Y-m-d')){
                        $bookingDate = date('Y-m-d', strtotime($bookingDate . ' + 1 day'));
                    }
                    $gmtTime = $bookingDate." ".$gmtDateArr[1];
                    $gmtTimestamp = strtotime($gmtTime);
						if($local_admin_settings[0]['hours_type'] == 1){
	                        $appointmentTime = date("g:i a",$i);
	                    }else{
	                        $appointmentTime = date("H:i",$i);
	                    }
                    if($counter%2 == 1){
                        $string .= '<div class="ui-block-a inactiveTimeClass"><ul>';
                        $string .= '<li id="mAvl_'.$gmtTimestamp.'" rel="'.$gmtTimestamp.'" style="color: red;"><span></span>'.$appointmentTime.'</li>';
                        $string .= '</ul></div>';
                    }elseif($counter%2 == 0){
                        $string .= '<div class="ui-block-b inactiveTimeClass"><ul>';
                        $string .= '<li id="mAvl_'.$gmtTimestamp.'" rel="'.$gmtTimestamp.'" style="color: red;"><span></span>'.$appointmentTime.'</li>';
                        $string .= '</ul></div>';
                    }
                    $counter++;
                    }
                    /// Pr end ///
                    }else{
					// Pr_start //
                    $bookingDateArr = explode("-",$bDate);
                    $bookingDate = $bookingDateArr[2]."-".$bookingDateArr[1]."-".$bookingDateArr[0];
                    $bookingDatetime = $bookingDate." ".date('H:i:s',$i);
                    $gmt = $this->global_mod->gmtTimeReturn(date('H:i:s',strtotime($bookingDatetime)));
                    $gmtDateArr = explode(" ",$gmt);
                    if($gmtDateArr[0] < date('Y-m-d')){
                        $bookingDate = date('Y-m-d', strtotime($bookingDate . ' - 1 day'));
                    }elseif($gmtDateArr[0] > date('Y-m-d')){
                        $bookingDate = date('Y-m-d', strtotime($bookingDate . ' + 1 day'));
                    }
                    $gmtTime = $bookingDate." ".$gmtDateArr[1];
                    $gmtTimestamp = strtotime($gmtTime);
						if($local_admin_settings[0]['hours_type'] == 1){
	                        $appointmentTime = date("g:i a",$i);
	                    }else{
	                        $appointmentTime = date("H:i",$i);
	                    }
                    if($counter%2 == 1){
                        $string .= '<div class="ui-block-a timeClass"><ul>';
                        $string .= '<li id="mAvl_'.$gmtTimestamp.'" rel="'.$gmtTimestamp.'"><span></span>'.$appointmentTime.'</li>';//date('H:i',$i)
                        $string .= '</ul></div>';
                    }elseif($counter%2 == 0){
                        $string .= '<div class="ui-block-b timeClass"><ul>';
                        $string .= '<li id="mAvl_'.$gmtTimestamp.'" rel="'.$gmtTimestamp.'"><span></span>'.$appointmentTime.'</li>';//date('H:i',$i)
                        $string .= '</ul></div>';
                    }
                    $counter++;
                    /// Pr end ///	
					}
                /*######### Printing data end ########*/    
            }
        }
        echo $string;
        
        
    }

    public function fnp_dynamicHtmlMobile($time,$service_name,$service_id,$staff_id,$loop,$bookTime){	
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);

        $total = $this->session->userdata('total');
        $admin_settings = $this->fnp_localAdminSettings();
        $dateOfBooking = date("Y-m-d",$bookTime);
        $str='';
        $str.='<li>';
        $str.='<div><h4>'.$service_name.'</h4>';
        if($staff_id != 0){
            $str.='<p>'.$this->global_mod->db_parse($this->lang->line('mobile_with')).' '.$this->getEmployeeName($staff_id).'</p>';
        }
        $str.='</div>';
        if($staff_id != 0){//taru by soumya
            $str.='<div class="clBook">';
            /*#########################################*/
            /*###### CHECK TIME IN BUSINESS HOUR ######*/
            /*#########################################*/
            $dayId = date("N",$bookTime);
            $this->checkBusinessHour($time,$service_id,$staff_id,$dayId);
            /*#########################################*/
            /*###### CHECK TIME IN BUSINESS HOUR ######*/
            /*#########################################*/
            $timeArr = explode(":",$time);
            $timeSec = ($timeArr[0]*3600)+($timeArr[1]*60);
            if($local_admin_settings[0]['hours_type'] == 1){
                $str .= '@ '.date("g:i a",$this->ConvToClienttime($timeSec));
            }else{
                $str .= '@ '.date("H:i",$this->ConvToClienttime($timeSec));
            }

            $str.='<input type="hidden" name="service_time_'.$loop.'" value="'.$time.'">';
            $str.='<input type="hidden" name="service_date_'.$loop.'" value="'.$dateOfBooking.'">';
            $str.='<input type="hidden" name="service_id_'.$loop.'" value="'.$service_id.'">';
            $str.='<input type="hidden" name="service_staff_'.$loop.'" value="'.$staff_id.'">';
            $temp_insert_id = $this->fnp_insertInTempTable($service_id,$staff_id,$time,$bookTime);
            $str.='<input type="hidden" name="temp_id_'.$loop.'" value="'.$temp_insert_id.'">';
            $str.='</div>';
            if($admin_settings[0]['quantity_appointment_setting'] == 1){
                $str.='<div class="clSelectBook">';
                $str.='<select name="service_capacity_'.$loop.'" data-mini="true">';
                $ls_capacity = $this->fnp_maxCapacityOfService($service_id,$bookTime);
                for($i=1; $i<=$ls_capacity; $i++){
                    $str.='<option value="'.$i.'"> '.$i.' '.ucfirst($admin_settings[0]['quantity_appointment']).' </option>';
                }
                $str.='</select>';
                $str.='</div>';
                $str.='<div class="clBook">';
                $cost = $this->getServiceCost($service_id);
                $total = $total + $cost;
                $this->session->set_userdata('total', $total);
                $str.=$this->session->userdata('local_admin_currency_type').$cost;
                $str.='</div>';
            }else{
                $str.='<div class="clSelectBook">';
                $str.='<input type="hidden" name="service_capacity_'.$loop.'" value="1">';
                $str.='</div>';
	        }
            $str.='</li>';
        }else{//taru by soumya
            $str.='<div class="clBook" style="color:#FF0000;">Service is not available due to staff unavailability.</div><div class="clSelectBook"></div><div class="clBook"></div>';
        }
        return $str;
    }

    public function recurringAppointmentHtmlMobile($bookArr){
        $total = $this->session->userdata('total');
		$admin_settings = $this->fnp_localAdminSettings();
		$str ='';
		$pCount =0;

		foreach($bookArr as $bookVal){

		    $chkBookingCounter = 0;
		    foreach($bookVal['bookingDataArr'] as $bookChildVal){
			    $chkBookingArr = $this->global_mod->checkStaffAvailability($bookChildVal['dateTime'],array($bookChildVal['employee']),array($bookChildVal['service']));
			    if($chkBookingArr[0][0]['bk_status'] == TRUE){
				    $chkBookingCounter ++;
			    }
		    }
		    if(count($bookVal['bookingDataArr']) == $chkBookingCounter ){
                $str.='<div data-role="collapsible" data-collapsed="true"><h2>';
		        $str.=date("M d, Y (l)",strtotime($bookVal['bookDateShow']));
		        $str.='</h2>';
		        foreach($bookVal['bookingDataArr'] as $bookChildVal){
			        $chkBooking = $this->global_mod->checkStaffAvailability($bookChildVal['dateTime'],array($bookChildVal['employee']),array($bookChildVal['service']));
			        $localId =date("ymdhi",strtotime($chkBooking[0][0]['bk_time']));	
                						
			        $str.='<ul data-role="listview" data-split-icon="gear" data-split-theme="d" class="bookingDetl">';
                    $str.='<li>';
                    $str.='<div>';
			        $str.='<h4 style="white-space: inherit !important;">'.$chkBooking[0][0]['bk_service_name'].'</h4>';
                    $str.='<p style="white-space: inherit !important;">With '.$chkBooking[0][0]['bk_employee_name'].'</p>';
                    $str.='</div>';
                    $str.='<div class="clBook">';
                    if($chkBooking[0][0]['bk_status'] == TRUE){
				        $str.='@ '.date("h:i A",strtotime($chkBooking[0][0]['bk_time']));
			        }else{
				        $str.='@ '.date("h:i A",strtotime($chkBooking[0][0]['bk_time']));
			        }
                    $str.='</div>';

                    $str.='<div class="clSelectBook">';
                    $str.='<select data-mini="true" onchange="changePrice(this.value,'.$chkBooking[0][0]['bk_service_cost'].','.$localId.','.$pCount.')">';
			        for($i=1;$i<$chkBooking[0][0]['bk_service_capacity'];$i++){
	                    $str.='<option value="'.$i;
			            if($bookChildVal['quantity'] == $i){
			                $str.=' selected="selected" ';	
			            }
			            $str.='">'.$i.' '.ucfirst($admin_settings[0]['quantity_appointment']).'</option>';
			        }
			        $str.='</select>';
                    $str.='</div>'; 
                    $str.='<div class="clBook">';
                    $recurringTotal = $chkBooking[0][0]['bk_service_cost']*$bookChildVal['quantity'];
                    $total = $total + $recurringTotal;
                    $this->session->set_userdata('total', $total);
                    $str.=$this->session->userdata('local_admin_currency_type').$this->global_mod->currencyFormat($chkBooking[0][0]['bk_service_cost']*$bookChildVal['quantity']);
                    $str.='</div>';
			        $str.='</li>';

                    #############################
			        $str.='</ul>';
			    
			        if(count($bookVal['bookingDataArr']) == $chkBookingCounter ){
			            $str .='<input type="hidden" id="recurringCapacity_'.$pCount.'" name="recurringCapacity_'.$pCount.'" value="'.$bookChildVal['quantity'].'">';
			            $str .='<input type="hidden" id="recurringDateTime_'.$pCount.'" name="recurringDateTime_'.$pCount.'" value="'.$chkBooking[0][0]['bk_time'].'">';
			            $str .='<input type="hidden" id="recurringSrviceId_'.$pCount.'" name="recurringSrviceId_'.$pCount.'" value="'.$chkBooking[0][0]['bk_service_id'].'">';
			            $str .='<input type="hidden" id="recurringEmployeeId_'.$pCount.'" name="recurringEmployeeId_'.$pCount.'" value="'.$chkBooking[0][0]['bk_employee_id'].'">';
			
			            $tempId = $this->page_model->genaretTempRecurringId($chkBooking[0][0]['bk_service_id'],$chkBooking[0][0]['bk_employee_id'],$chkBooking[0][0]['bk_time']);
			            $str .='<input type="hidden" id="recurringTempId_'.$pCount.'" name="recurringTempId_'.$pCount.'" value="'.$tempId.'">';
			
			            $pCount++;
			        }	
		        }
				$str.='</div>';
		    }else{
			    /*$str.='<Span class="recurringSpanRight recurringFalse">';
			    $str.='-Not Availabel-';
			    $str.='</Span>';*/	
		    }
		}
		$str .='<input type="hidden" name="recurringCounter" value="'.$pCount.'">';
        
		//$str .='</form>';
		return $str;
	}

    public function mobile_genaratBookingInvoicAndRepBooking(){
        $local_admin_id	= $this->customer_registration_model->GetLocalAdmin();
        $this->session->set_userdata('total', 0);
        date_default_timezone_set('GMT');
        $bDate = $this->input->post('bDate');
        $mbTime = $this->input->post('bTime');
        $staffArr = $this->input->post('staffArr');
        $serviceArr = $this->input->post('srvArr');

        $html = '<span class="SmallTopBook">'.$this->global_mod->db_parse($this->lang->line('mobile_book_not_confirmed')).'</span>';//This order is not confirmed yet. Click on the "Book Now" button to book it.
        $html .= '<div data-role="collapsible-set" data-theme="b" data-content-theme="d">
              <div data-role="collapsible" data-collapsed="false">
               <h2>'.$this->global_mod->db_parse($this->lang->line(date("F",strtotime($bDate)))).' '.date("d",strtotime($bDate)).', '.date("Y",strtotime($bDate)).' ('.$this->global_mod->db_parse($this->lang->line(date("l",strtotime($bDate)))).')</h2>
               <ul data-role="listview" data-split-icon="gear" data-split-theme="d" class="bookingDetl">';
        //$html .= '<form ';
        $service_counter = count($serviceArr);

		
        if($service_counter > 1){// IF MORE THAN ONE SERVICE IS SELECTED
            $finalDepArr = $this->checkServiceDependency($serviceArr);//    ERROR IN THIS SECTION
			
            $finalArrCounter = count($finalDepArr);
            $serviceCounter=0;
            $j=0;
            foreach($finalDepArr as $val){

                $available = $this->checkWhetherStaffAvailable($mbTime,$val);//$val=service
		
                if($available > 0){//   SERVICE IS AVAILABLE ON SELECTED DAY AND TIME
                    $serviceDep = $this->page_model->getServiceNameList($val);
                    if($this->fnp_chkStaffAvailable($serviceDep[0]['service_id'],$mbTime)==0){//error in this function return=>fnp_chkStaffAvailable				
                        if($j==0){
                            $timestamp = $mbTime;
                            $time = date("H:i",$mbTime);
                        }else{
                            $timestamp = $end_time;
                            $time = date("H:i",$end_time);
                        }
                        if(count($staffArr) > 0 && is_array($staffArr)){
                            $staffDetails = $this->fnp_detailsOfStaff($staffArr,$mbTime,$val);
                        }else{
                            $staffDetails = $this->fnp_detailsOfStaff($serviceDep[0]['service_id'],$mbTime,$val);
                        }
                        $html.=$this->fnp_dynamicHtmlMobile($time,$serviceDep[0]['service_name'],$serviceDep[0]['service_id'],$staffDetails,$serviceCounter,$mbTime);
						
											
						$bookingDetailsArrForCoupon[$serviceCounter]['service_time'] 	=	$time;
						$bookingDetailsArrForCoupon[$serviceCounter]['service_date'] 	=	date("Y-m-d",$mbTime);;
						$bookingDetailsArrForCoupon[$serviceCounter]['service_id'] 	 	=	$serviceDep[0]['service_id'];
						$bookingDetailsArrForCoupon[$serviceCounter]['service_staff'] 	=	$staffDetails;
											
						
                        $serviceCounter++;
                        $j++;
                        $service_duration_min = $serviceDep[0]['service_duration_min'];
                        $end_time = $timestamp + 60*$service_duration_min;				
                    }else{
                        $serviceDep = $this->page_model->getServiceNameList($val);
                        $html.='<li>';
                        $html.='<div><h4 style="white-space: inherit !important;">'.$serviceDep[0]['service_name'].'</h4></div>';
                        $html.='<div class="clBook" style="color:#FF0000;">Service is not available due to staff unavailability.</div><div class="clSelectBook"></div><div class="clBook"></div>';
                        $html.='</li>';
                    }		
                }else{//  SERVICE IS NOT AVAILABLE ON SELECTED DATE AND TIME
                    $serviceDep = $this->page_model->getServiceNameList($val);
                    $html.='<li>';
                    $html.='<div><h4 style="white-space: inherit !important;">'.$serviceDep[0]['service_name'].'</h4></div>';
                    $html.='<div class="clBook" style="color:#FF0000;">Service is not available on this time.</div><div class="clSelectBook"></div><div class="clBook"></div>';
                    $html.='</li>';
                }
            }
            $html.='<input type="hidden" id="serviceCounter" name="counter" value="'.$j.'">';
        }else{//    IF ONLY ONE SERVICE IS SELECTED
           
			$service = $this->page_model->getServiceName($serviceArr);
            $serviceDep = $this->input->post('service');
            $j=0;

            foreach($service as $val){	
		if($this->fnp_chkStaffAvailable($val['service_id'],$mbTime)==0){  
                    $time= date("H:i",$mbTime);
                    if(count($staffArr) > 0 && is_array($staffArr)){ 
                        $staffDetails = $this->fnp_detailsOfStaff($staffArr,$mbTime,$val);
                    }else{ 
                        $staffDetails = $this->fnp_detailsOfStaff($serviceDep[0],$bTime,$val);
                    }
                    $html.= $this->fnp_dynamicHtmlMobile($time,$val['service_name'],$val['service_id'],$staffDetails,0,$mbTime);
					$bookingDetailsArrForCoupon[0]['service_time'] 	=	$time;
					$bookingDetailsArrForCoupon[0]['service_date'] 	=	date("Y-m-d",$mbTime);;
					$bookingDetailsArrForCoupon[0]['service_id'] 	 	=	$val['service_id'];
					$bookingDetailsArrForCoupon[0]['service_staff'] 	=	$staffDetails;
                    $j++;
                }else{
                    $serviceDep = $this->page_model->getServiceNameList($val['service_id']);
                    $html .= '<li>
                         <div><h4>'.$serviceDep[0]['service_name'].'</h4></div>
                         <div class="clBook" style="color:#FF0000;">Service is not available due to staff time conflict.</div>
                         <div class="clSelectBook"></div>     
                         <div class="clBook"></div> 
                        </li>';
                }    
            }
            $html.='<input type="hidden" id="serviceCounter" name="counter" value="'.$j.'">';
        }
		 $json_encode_arr =json_encode($bookingDetailsArrForCoupon);

        /*****      CODE FOR RECURRING BOOKING STARTS        *****/
        $counter = count($serviceArr);
        $repetType = $this->input->post('repetType');
        $selectedDate = $this->input->post('selectedDate');
        $repetMode = $this->input->post('repetMode');
        $extraInfo = $this->input->post('extraInfo');	
		if($repetType == 'day'){
			$recurringLastDate	= $selectedDate;
			$loopCounter		= $repetMode;
		}
        $lastBookDate = $this->input->post('bDate');
        if($repetType != ''){
            if(strtotime($recurringLastDate)>strtotime($lastBookDate)){
		        $difference = abs(strtotime($recurringLastDate) - strtotime($lastBookDate));
		        $noOfDay = floor($difference/(60*60*24));
		        for($i=0; $i <= $noOfDay; ($i+=intval($loopCounter))){
		            if($i!=0){
		                $bookDate = date('Y-m-d',strtotime($lastBookDate) + (24*3600*$i));
			            $bookArr[$i-1]['bookDateShow'] = $bookDate;
			            $bookArr[$i-1]['bookingDataArr'] = array();
			            for($book=0; $book<$counter; $book++){
				            $bookTime					= $this->input->post('service_time_'.$book);
				            $bookArr[$i-1]['bookingDataArr'][$book]['dateTime']	= $this->global_mod->localTimeReturn(date('Y-m-d H:i:s', strtotime($bookDate.' '.$bookTime)));
				            $bookArr[$i-1]['bookingDataArr'][$book]['service']	= $this->input->post('service_id_'.$book);
				            $bookArr[$i-1]['bookingDataArr'][$book]['employee']	= $this->input->post('service_staff_'.$book);
				            $bookArr[$i-1]['bookingDataArr'][$book]['quantity']	= $this->input->post('service_capacity_'.$book);
			            }
			        }//
		        }

		        $html.=$this->recurringAppointmentHtmlMobile($bookArr);
		    }else{
		        $html.= 'Please select grater then your booking date.';
		    }
        }
        /*****      CODE FOR RECURRING BOOKING ENDS     *****/

        $html .= '</ul>
              </div>
            </div>';
        //repit booking
        $html .= '<div class="reptBook">'.$this->global_mod->db_parse($this->lang->line('mobile_recurring_booking')).'<br>
            <select class="repSelect" id="repSelect" data-mini="true">
             <option value="0" selected="selected">'.$this->global_mod->db_parse($this->lang->line('mobile_no_repeat')).'</option>
             <option value="1">'.$this->global_mod->db_parse($this->lang->line('mobile_daily')).'</option>
             <option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_weekly')).'</option>
             <option value="3">'.$this->global_mod->db_parse($this->lang->line('mobile_monthly')).'</option>
             <option value="4">'.$this->global_mod->db_parse($this->lang->line('mobile_yearly')).'</option>
            </select>';

        $html .='<div class="repCont" id="dailyCont" style="display: none">
            <select class="repSelect" data-mini="true" id="daySelectRep">
             <option value="1" selected="selected">'.$this->global_mod->db_parse($this->lang->line('mobile_everyday')).'</option>
             <option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_day')).'</option>';
              for($d=3;$d<31;$d++){ 
        $html .='<option value="'.$d.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$d.' '.$this->global_mod->db_parse($this->lang->line('mobile_day')).'</option>';
              } 
         $html .= '</select>
            <input type="text" class="repDatepicker" id="dayPicker" placeholder="'.$this->global_mod->db_parse($this->lang->line('mobile_select_date')).'" data-mini="true" />
            </div>

            <div class="repCont" id="weekCont" style="display: none">
            
            <div data-role="fieldcontain" data-mini="true" class="dayOfWeek">
            <fieldset data-role="controlgroup" data-type="horizontal" data-mini="true">
             <input type="checkbox" name="sun" id="sun" />
             <label for="sun">'.$this->global_mod->db_parse($this->lang->line('cal_sun')).'</label>

             <input type="checkbox" name="mon" id="mon"/>
             <label for="mon">'.$this->global_mod->db_parse($this->lang->line('cal_mon')).'</label>

             <input type="checkbox" name="tus" id="tus"/>
             <label for="tus">'.$this->global_mod->db_parse($this->lang->line('cal_tue')).'</label> 
 
             <input type="checkbox" name="wed" id="wed"/>
             <label for="wed">'.$this->global_mod->db_parse($this->lang->line('cal_wed')).'</label> 
 
             <input type="checkbox" name="thu" id="thu"/>
             <label for="thu">'.$this->global_mod->db_parse($this->lang->line('cal_thu')).'</label> 
 
             <input type="checkbox" name="fri" id="fri"/>
             <label for="fri">'.$this->global_mod->db_parse($this->lang->line('cal_fri')).'</label> 
 
             <input type="checkbox" name="sat" id="sat"/>
             <label for="sat">'.$this->global_mod->db_parse($this->lang->line('cal_sat')).'</label>    
            </fieldset>
            </div>

            <select class="repSelect" data-mini="true" id="weekSelectRep">
             <option value="1" selected="selected">'.$this->global_mod->db_parse($this->lang->line('mobile_everyweek')).'</option>
             <option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_week')).'</option>';
             for($w=3;$w<31;$w++){ 
         $html .='<option value="'.$w.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$w.' '.$this->global_mod->db_parse($this->lang->line('mobile_week')).'</option>';
              } 
          $html .='</select>
            <input type="text" class="repDatepicker" id="weekPicker" placeholder="'.$this->global_mod->db_parse($this->lang->line('mobile_select_date')).'" data-mini="true" />
            </div>

            <div class="repCont" id="monthCont" style="display: none">
            <select class="repSelect" data-mini="true" id="monthSelectRep">
             <option value="1" selected="selected">'.$this->global_mod->db_parse($this->lang->line('mobile_everymonth')).'</option>
             <option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_month')).'</option>';
            for($m=3;$m<31;$m++){ 
       $html .='<option value="'.$m.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$m.' '.$this->global_mod->db_parse($this->lang->line('mobile_month')).'</option>';
             }
        $html .='</select>
            <input type="text" class="repDatepicker" id="monthPicker" placeholder="'.$this->global_mod->db_parse($this->lang->line('mobile_select_date')).'" data-mini="true" />
            </div>

            <div class="repCont" id="yearCont" style="display: none">
            <select class="repSelect" data-mini="true" id="yearSelectRep">
             <option value="1" selected="selected">'.$this->global_mod->db_parse($this->lang->line('mobile_everyyear')).'</option>
             <option value="2">'.$this->global_mod->db_parse($this->lang->line('mobile_every_alternate_year')).'</option>';
             for($y=3;$y<31;$y++){
        $html .='<option value="'.$y.'">'.$this->global_mod->db_parse($this->lang->line('mobile_every')).' '.$y.' '.$this->global_mod->db_parse($this->lang->line('mobile_year')).'</option>';
            } 
        $html .='</select>
            <input type="text" class="repDatepicker" id="yearPicker" placeholder="'.$this->global_mod->db_parse($this->lang->line('mobile_select_date')).'" data-mini="true" />
            </div>
            </div>';

        // cupon section
      $html .='<div class="cuponBook">
              <span id="dicsShow"> '.$this->global_mod->db_parse($this->lang->line('mobile_discount_coupon')).' </span>
             <span id="dicsHide" style="display: none;">
               <span>'.$this->global_mod->db_parse($this->lang->line('mobile_enter_code')).' :</span>
               <input type="text" id="discuntValue" data-mini="true"/>
               <input type="button" bookingDetails=\''.$json_encode_arr.'\' value="'.$this->global_mod->db_parse($this->lang->line('mobile_apply')).'" data-mini="true" id="discuntValueBtn"/>
             </span>
			 <div id="coupon_msg_mobile"  style="clear: both;"></div>
            </div>';
        //invoice section
     $taxDetailsArr = $this->page_model->getTaxDetails($local_admin_id);
     $grandTotal = $this->session->userdata('total');
     $html .='<div class="ui-body ui-body-b invoicCont">
             <ul>
              <li>
               <span>'.$this->global_mod->db_parse($this->lang->line('mobile_total')).':</span>
               <span>'.$this->session->userdata('local_admin_currency_type').$this->session->userdata('total').'</span>
              </li>';
    $li_counter=0;
    $totalTax = 0;
    foreach($taxDetailsArr as $val){
        $html.='<li>';    
        $html.='<span>'.ucfirst($val['tax_title']).'('.$val['tax_rate'].'%)</span>';
		$html.='<input type="hidden" name="tax_name_'.$li_counter.'" value="'.$val['tax_title'].'"><input type="hidden" name="tax_value_'.$li_counter.'" value="'.$val['tax_rate'].'">';
        $tax = ($grandTotal*$val['tax_rate'])/100;
        $tax = round($tax,2);
        $totalTax = $totalTax + $tax;
        $html.='<span>'.$this->session->userdata('local_admin_currency_type')." ".$this->currencyFormat($tax).'</span>';
        $html.='</li>';
		$li_counter++;
    }//taxtotal
    $finalTotal = $grandTotal + $totalTax;
    $finalTotal = round($finalTotal,2); 
    
    $html.='<input type="hidden" name="subtotal" id="subtotal" value="'.$grandTotal.'">';
    $html.='<input type="hidden" name="taxtotal" value="'.$totalTax.'">';
    $html.='<input type="hidden" name="total" id="total" value="'.$finalTotal.'">';
	 $html.='<input type="hidden" name="for_coupon_total" id="for_coupon_total" value="'.$finalTotal.'">';
    $html.='<input type="hidden" name="tax_counter" value="'.$li_counter.'">';
	
	 $html .='<li id="discount_coupon_tr" style="display:none;">
               <span>Discount:</span>
               <span id="discount_coupon_td"></span>
              </li>';
    $html .='<li class="grndInVo">
               <span>'.$this->global_mod->db_parse($this->lang->line('mobile_grand_total')).':</span>
               <span id="final_total_td">'.$this->session->userdata('local_admin_currency_type')." ".$this->currencyFormat($finalTotal).'</span>
              </li>
             </ul>   
            </div>';
        //pay mode section
      $html .='<div class="payCont ui-body-e" data-mini="true" style="display: none"> 
            <fieldset data-role="controlgroup" data-mini="true">
             <legend>'.$this->global_mod->db_parse($this->lang->line('mobile_pay_option')).'</legend>
                  <input type="radio" name="payMood" data-theme="d" data-mini="true" id="notNow" value="notNow" checked="checked" />
                  <label data-mini="true" for="notNow"><img src="'.base_url().'asset/mobile_css/images/pay-later.png"/></label>

                  <input type="radio" name="payMood" data-theme="d" data-mini="true" id="payPal" value="payPal"  />
                  <label data-mini="true" for="payPal"><img src="'.base_url().'asset/mobile_css/images/paypal.png"/></label>
            </fieldset>
            </div>';
        // terms section
      $html .='<div class="accepyBook">
              <input type="checkbox" id="termsConditions" /><span> '.$this->global_mod->db_parse($this->lang->line('mobile_terms')).'<label style="color: red;">*</label></span>
            </div>';
        echo $html;
    }

    public function mobileLocalAdminSettings(){
        $settings = array();
        $local_admin_id = $this->customer_registration_model->GetLocalAdmin();
        $local_admin_settings = $this->page_model->getFrontEndSettings($local_admin_id);
        $settings['adminId'] = intval($local_admin_settings[0]['adminId']);
        $settings['multipleServicesBooking'] = intval($local_admin_settings[0]['multiple_services_booking']);
        $settings['enable_system'] = intval($local_admin_settings[0]['enable_system']);
        $settings['noOfBooking'] = intval($local_admin_settings[0]['noOfBooking']);
        $settings['noOfBookingPeriod'] = intval($local_admin_settings[0]['noOfBookingPeriod']);
        $settings['bookingStartingPoint'] = $local_admin_settings[0]['bookingStartingPoint'];
        $settings['noOfBookingPeriodFrom'] = $local_admin_settings[0]['noOfBookingPeriodFrom'];
        $settings['noOfBookingPeriodTo'] = $local_admin_settings[0]['noOfBookingPeriodTo'];
        $settings['recurringAppointments'] = intval($local_admin_settings[0]['recurringAppointments']);
        $settings['showServiceCost'] = intval($local_admin_settings[0]['showServiceCost']);
        $settings['showServiceTimeDuration'] = intval($local_admin_settings[0]['showServiceTimeDuration']);
        $settings['clientsNameWithReviews'] = intval($local_admin_settings[0]['clientsNameWithReviews']);
        $settings['detectClientTimezone'] = intval($local_admin_settings[0]['detectClientTimezone']);
        $settings['bookedTimesStriked'] = intval($local_admin_settings[0]['bookedTimesStriked']);
        $settings['blockedTimesStrikedOut'] = intval($local_admin_settings[0]['blockedTimesStrikedOut']);
        $settings['defaultView'] = intval($local_admin_settings[0]['defaultView']);
        $settings['calStrtingWeekday'] = intval($local_admin_settings[0]['calStrtingWeekday']);
        $settings['calStrtingDt'] = $local_admin_settings[0]['calStrtingDt'];
        $settings['showStaffCustomers'] = intval($local_admin_settings[0]['showStaffCustomers']);
        $settings['staffSelectionMandatory'] = intval($local_admin_settings[0]['staffSelectionMandatory']);
        $settings['calTimeIntervalTyp'] = intval($local_admin_settings[0]['calTimeIntervalTyp']);
        $settings['calTimeIntervalVariable'] = intval($local_admin_settings[0]['calTimeIntervalVariable']);
        $settings['advBkMxTim'] = intval($local_admin_settings[0]['advBkMxTim']);
        $settings['advBkMinSetting'] = intval($local_admin_settings[0]['advBkMinSetting']);
        $settings['advBkMinTim'] = intval($local_admin_settings[0]['advBkMinTim']);
  $settings['advBkMinTim'] = intval($local_admin_settings[0]['advBkMinTim']);
        $settings['pre_booking_frm'] = intval($local_admin_settings[0]['pre_booking_frm']);
        $settings['gmtSymbol'] = intval($local_admin_settings[0]['gmt_symbol']);
        $settings['gmtValue'] = $local_admin_settings[0]['gmt_value'];
  $settings['internationalUsers'] = $local_admin_settings[0]['allow_international_users'];
  $settings['hours_type'] = intval($local_admin_settings[0]['hours_type']);
  $settings['adv_bk_mx_tim'] = intval($local_admin_settings[0]['adv_bk_mx_tim']);
        $settings['currentDate'] = gmdate("d-m-Y");
        $settings['currentTime'] = gmdate("H-i-s");
  $settings['pre_pmnt_setting'] = intval($local_admin_settings[0]['pre_pmnt_setting']);
        if($local_admin_settings[0]['enable_system'] == 0){//    IF BOOKING IS DISABLED FROM ADMIN PANEL
            $address = $this->page_model->getAdminAddress($local_admin_id);
            $addr = $address[0]['business_name']."<br>".$address[0]['business_location']."<br>".$address[0]['city_name']."<br>".$address[0]['region_name']."<br>".$address[0]['country_name']."<br>".$address[0]['business_zip_code'];
            $settings['address'] = $addr;
        }
        return $settings;
    }

    public function mobile_BookingDisCupon(){
        echo "test";
    }
    //save booking in mobile
    public function mobileSaveBooking(){
        $bookTime = $this->input->post('bTime');
		$final_return = array();
        $returnArr = array();
		$taxArr = array();
		
		$serviceCounter = $this->input->post('counter');
		for($i=0;$i<$serviceCounter;$i++){
		    $returnArr[$i]['service_time'] 		=  $this->input->post('service_time_'.$i);
		    $returnArr[$i]['service_date'] 		=  $this->input->post('service_date_'.$i);
		    $returnArr[$i]['service_id']		=  $this->input->post('service_id_'.$i);
		    $returnArr[$i]['service_staff']		=  $this->input->post('service_staff_'.$i);
		    $returnArr[$i]['temp_id']			=  $this->input->post('temp_id_'.$i);
		    $returnArr[$i]['service_capacity']	=  $this->input->post('service_capacity_'.$i);
		}
		$tax_counter = $this->input->post('tax_counter');
		for($j=0;$j<$tax_counter;$j++){
			$name	= $this->input->post('tax_name_'.$j);
			$val	= $this->input->post('tax_value_'.$j); 
			$taxArr[$j][$name] 		=  $val;
		}
		$final_return['subtotal']		= $this->input->post('subtotal');
		$final_return['taxtotal']		= $this->input->post('taxtotal');
		$final_return['total']			= $this->input->post('total');
		$final_return['item_details'] 	= $returnArr;
       	$final_return['tax_details'] 	= $taxArr;     
       	
       	$detect = new Mobile_Detect;
		$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 3 : 2) : 1);
       	
       	$final_return['device_type'] 	= $deviceType;     
		$insert = $this->page_model->saveBookingData($final_return);
        if($insert == 1){
            echo 1;
        }else{
            echo 0;
        }
    }
    //getting region list for mobile
    public function mobileRegion($country='',$regionId=''){
        $str = '';
        $str.='<select class="customSelectBox" name="nw_region" id="nw_region" onchange="changeRegion(this.value)">';
        $str.='<option value="">Select Region</option>';
        if($country != ''){
            $region = $this->page_model->getRegion($country);
            foreach($region as $val){
                if($val['region_id'] == $regionId){
                    $selectedRegion = ' selected';
                }else{
                    $selectedRegion = '';
                }
                $str.='<option value='.$val['region_id'].$selectedRegion.'>'.$val['region_name'].'</option>';
            }
        }
        $str.='</select>';
        if($regionId == ''){
            echo $str;
        }else{
            return $str;
        }
    }
    //getting city list for mobile
    public function mobileCity($region='',$cityId=''){
        $str = '';
        $str.='<select class="customSelectBox" name="nw_city" id="nw_city">';
        $str.='<option value="">Select City</option>';
        if($region != ''){
            $city = $this->page_model->getCity($region);
            foreach($city as $val){
                if($val['city_id'] == $cityId){
                    $selectedCity = ' selected';
                }else{
                    $selectedCity = '';
                }
                $str.='<option value='.$val['city_id'].$selectedCity.'>'.$val['city_name'].'</option>';
            }
        }
        $str.='</select>';
        if($cityId == ''){
            echo $str;
        }else{
            return $str;
        }
	}
    
    public function fn_checkLogInAdmin() {
        $logged_in_Status = $this->session->userdata('logged_in');
        if(!$logged_in_Status){
            echo 0;
        }else{
            echo 1;
        }
    }

	public function fn_checkLogInAdmin_staff() {

        $logged_in_Status = $this->session->userdata('logged_in_staff');
        if(!$logged_in_Status){
            echo 0;
        }else{
            echo 1;
        }
    }

    public function fn_checkLogInSuperAdmin(){
        $logged_in_Status = $this->session->userdata('super_logged_in');
        if(!$logged_in_Status){
            echo 0;
        }else{
            echo 1;
        }
    }

	public function gotolocaladmin(){
		$local_id = $this->input->post('localid');
		$user_name = $this->pardco_model->gotolocaladminueser($local_id);
		$url = $_SERVER['HTTP_HOST'];
		$url_arr = explode(".",$url);
		$admin_url = 'http://'.$user_name.'.'.$url_arr[1].'.com/admin';
		//echo'<script>window.location="'.$admin_url.'";</script>';
		echo $admin_url;
	}

	public function fn_afterBooking($booking_id){
		/* Send SMS after booking start */
/*		$customerMobile = $this->page_model->customerDetailsForSMS();
		$smsBody		= $this->page_model->customerSMSBody();
		$returnArr = $this->sms_model->sendSms($customerMobile,$smsBody);
		$localAdminId	= $this->session->userdata('local_admin_id');
		$smsSaveArr = array(
           'message_id'			=> $returnArr['msg'],
           'message_type' 		=> $returnArr['type'],
           'local_admin_id' 	=> $localAdminId,
           'msg_sent_date_time' => date("Y-m-d H:i:s"),
           'sent_to' 			=> 'user',
           'phone_no' 			=> $customerMobile,
           'message' 			=> $smsBody,
           'event' 				=> 'After_booking'
        );
		$this->page_model->saveSMSdetails($smsSaveArr);	
		
		/// Send SMS after booking end     //////	
	
	*/
		
		/* Send MAIL after booking Start*/	
			$local_admin_id = $this->session->userdata('local_admin_id');
			$Appo_Info		= $this->page_model->GetService_StaffDetails($booking_id);
			
			
			
			$unit = $Appo_Info[0]['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
			$start_time = $this->global_mod->localTimeReturn($Appo_Info[0]['srvDtls_service_start']);
            $end_time 	= $this->global_mod->localTimeReturn($Appo_Info[0]['srvDtls_service_end']);
			$AppointmentInfo = 'Service Name : '.$Appo_Info[0]['srvDtls_service_name'].'<br />'.'Staff name : '.$Appo_Info[0]['srvDtls_employee_name'].'<br />'.'Service Date : '.$start_time.' To '.$end_time.'<br />'.'Duration : '.$Appo_Info[0]['srvDtls_service_duration'].' '.$unit;


			$busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');

			$this->load->model('admin/Cms_model');
			$cancellationpolicy = $this->Cms_model->getContent('privacypolicy');
			
			
			$return = $this->page_model->getCancelHour(); 
			
			if($return[0]['bkin_can_setin'] == 1){
				$tag = 'day(s)';
			}
			if($return[0]['bkin_can_setin'] == 2){
				$tag = 'hour(s)';
			}
			if($return[0]['bkin_can_setin'] == 3){
				$tag = 'min(s)';
			}
			
			$cancelHour = $return[0]['bkin_can_mx_tim'].' '.$tag;
			
			$replacerArr = array(
						'{businessname}'			=> $this->session->userdata('ad_name'),
						'{fname}' 					=> $this->session->userdata('user_fname_customer'),
						'{lname}' 					=> $this->session->userdata('user_lname_customer'),
						'{appointmentdate}'			=> $start_time,
						'{AppointmentInfo}' 		=> $AppointmentInfo,
						'{businessemail}' 			=> $this->session->userdata('local_admin_email'),
						'{businessphone}' 			=> $this->session->userdata('ad_businessPhone'),
						'{businessaddress}' 		=> $busi_address,
						'{cancellationpolicy}' 		=> nl2br($cancellationpolicy),
						'{hoursbeforecancellation}'	=> $cancelHour
						
						
			);

			$toArr		= $this->session->userdata('user_email_customer');	

			$from		= $this->session->userdata('local_admin_email');
		
		
							
		$this->email_model->sentMail(1,$replacerArr,$toArr,$from);
		$this->page_model->sentSmsSetting($booking_id);
		/* Send MAIL after booking end*/	
	}

	public function checkMemberShip($invoiceId){
		$veryfyStatus = $this->page_model->checkIsVeryfiedMember();
		if($veryfyStatus == 1){
			$this->page_model->updatePayPalReturn($invoiceId);
			
		}else{
			/* Non approve customer action not done (21/02/2014) */
		}
	}
	
	
	public function FacebookPost(){
			$this->load->library('facebook'); 
			$user = $this->facebook->getUser();
			if($user){
			$new_booking = $this->session->userdata('new_booking');
			$Appo_Info		= $this->page_model->GetService_StaffDetails($new_booking);
			$unit = $Appo_Info[0]['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
			$start_time = $this->global_mod->localTimeReturn($Appo_Info[0]['srvDtls_service_start']);
			$end_time 	= $this->global_mod->localTimeReturn($Appo_Info[0]['srvDtls_service_end']);
			$AppointmentInfo = 'Service Name : '.$Appo_Info[0]['srvDtls_service_name'].' , '.'Staff name : '.$Appo_Info[0]['srvDtls_employee_name'].' , '.'Service Date : '.$start_time.' To '.$end_time.' , '.'Duration : '.$Appo_Info[0]['srvDtls_service_duration'].' '.$unit;

			$ret_obj = $this->facebook->api('/me/feed', 'POST',
			                        array(
			                          'link' => base_url(),
			                          'message' => $AppointmentInfo
			                     ));

				echo base_url();

			}else{
				$login_url = $this->facebook->getLoginUrl(array(
				    'redirect_uri' => site_url('page/FacebookPost'), 
				    'scope' => array("email") // permissions here
				));
				echo $login_url;
			}	
	}
	
	
	

	


}
