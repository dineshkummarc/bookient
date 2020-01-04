<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Approval extends Pardco { 
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/approval_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status){
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id){
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
	}
	public function index(){ 
	     
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_approval',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_approval',$setLanguage);
        }
		/*########End Language#######*/
	  
		//$this->lang->load('admin_approval');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);

		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		//$this->load->view('admin/left',$list);

                $str = '';
                //$str .= ' GROUP BY DATE_FORMAT(booking_date_time,"%Y-%m-%d") ';
                $str .= ' AND srvDtls_booking_status = 2 ';
                $arr = $this->global_mod->mainBookingStoreProReport($str,$starting='');
		$list['show_all_booking']=$arr;
		
		$this->load->view('admin/approval/approval',$list);  
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] = $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	function changeStatusAjax(){
		$booking_id= $this->input->post('booking_id');
		$booking_status= $this->input->post('booking_status');
		$msg=$this->approval_model->changeStatus($booking_id,$booking_status);
		echo $msg;
	}
	function denyAjax(){
            $booking_id= $this->input->post('booking_id');
            $deny_return = $this->approval_model->deny($booking_id);
          
         
          
            /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
            $bookingDetails = $this->approval_model->getBookingDetails($booking_id);
	        $appoStartDate = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_service_start']));
	       
	       
	        $this->load->model('admin/calender_model');
	        $cus_fname = ucfirst($this->calender_model->GetCusInfo($booking_id,2));
	        $cus_lname = ucfirst($this->calender_model->GetCusInfo($booking_id,3));
	        
	        $customerMail = $bookingDetails[0]['user_email'];
	             
	                
	                /////      QUERY TO GET CANCELLATION POLICY STARTS   //////
	                
	                $cancellationPolicyArr = $this->approval_model->getCancellationPolicy();
	                
	                /*****      QUERY TO GET CANCELLATION POLICY ENDS       *****/
	               
	               
	               
	                ###############################################
	                    
	                $business_name = $this->session->userdata('ad_name');    
	                $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
	                $user_email = $this->session->userdata('ladmin_email');
	                
	                
	                $serviceName = $bookingDetails[0]['srvDtls_service_name'];
                    $staffName = $bookingDetails[0]['srvDtls_employee_name'];
	                $unit = $bookingDetails[0]['srvDtls_service_duration_unit'] == 'M' ? 'Min' : 'Hr';
                    $appointmentDetails = 'Service Name : '.$serviceName.'<br />'.'Staff name : '.$staffName.'<br />'.'Service Date : '.$bookingDetails[0]['srvDtls_service_start'].' To '.$bookingDetails[0]['srvDtls_service_end'].'<br />'.'Duration : '.$bookingDetails[0]['srvDtls_service_duration'].' '.$unit.'<br />';
	                $business_phone = $this->session->userdata('ad_businessPhone');
	                
	                $replacerArr = array( '{businessname}'					=> $business_name,
	                					  '{businessaddress}'				=> $busi_address,
	                					  '{businessemail}'					=> $user_email,
	                					  '{AppointmentInfo}'				=> $appointmentDetails,
	                					  '{fname}'							=> $cus_fname,
	                					  '{lname}'							=> $cus_lname,
	                					  '{cancellationpolicy}'			=> nl2br($cancellationPolicyArr[0]['cms_dec']),
	                					  '{businessphone}'					=> $business_phone
	                					  	
	                
	                );

	        #############################################
	       
	       
	        
	        $mail = $this->email_model->sentMail(4, $replacerArr, $customerMail, $user_email);
            echo $deny_return;
        }
    function approveAjax(){
        $booking_id= $this->input->post('booking_id');
        $approve_return = $this->approval_model->approve($booking_id);
        /*****      QUERY TO GET BOOKING DETAILS STARTS     *****/
        
        $bookingDetails = $this->approval_model->getBookingDetails($booking_id);
        $appoStartDate = date('Y-m-d',strtotime($bookingDetails[0]['srvDtls_service_start']));
        
        
        
        
        $this->load->model('admin/calender_model');
        $cus_fname = ucfirst($this->calender_model->GetCusInfo($booking_id,2,'agenda_cancel'));
        $cus_lname = ucfirst($this->calender_model->GetCusInfo($booking_id,3,'agenda_cancel'));
        
        $customerMail = $bookingDetails[0]['user_email'];
             
                
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
                $cancellationMaxTime = $maxTime;   
                
            /*****      QUERY TO GET MAXIMUM CANCELLATION TIME ENDS     *****/
                ###############################################
                    
                $business_name = $this->session->userdata('ad_name');    
                $busi_address = $this->session->userdata('ad_location').' '.$this->session->userdata('ad_region').'<br />'.$this->session->userdata('ad_country').' '.$this->session->userdata('ad_zip');
                $user_email = $this->session->userdata('ladmin_email');
                
                
                $replacerArr = array( '{businessname}'					=> $business_name,
                					  '{businessaddress}'				=> $busi_address,
                					  '{businessemail}'					=> $user_email,
                					  '{appointmentdate}'				=> $appoStartDate,
                					  '{fname}'							=> $cus_fname,
                					  '{lname}'							=> $cus_lname,
                					  '{cancellationpolicy}'			=> nl2br($cancellationPolicyArr[0]['cms_dec']),
                					  '{hoursbeforecancellation}'		=> $cancellationMaxTime	
                
                );

        #############################################
       
        
        $mail = $this->email_model->sentMail(3, $replacerArr, $customerMail, $user_email);
        echo $approve_return;
    }
	function approveAllCheckedBookingAjax(){
            $booking_all_id= $this->input->post('booking_all_id');
            $msg=$this->approval_model->approveAllCheckedBooking($booking_all_id);
            
            echo $msg;
	}
    function appointmentDetailsAjax(){
        $booking_id= $this->input->post('booking_id');
        $show_appointmentDetails =$this->approval_model->appointmentDetails($booking_id);
        echo $show_appointmentDetails;
    }  
    function commonAlert(){
        $local_admin_id = $this->session->userdata('local_admin_id');
        if(isset($local_admin_id)){
            $str = '';
            //$str .= ' GROUP BY DATE_FORMAT(booking_date_time,"%Y-%m-%d") ';
            $str .= ' AND srvDtls_booking_status = 2 ';
            $str .= ' AND srvDtls_service_start > now() ';
            $arr = $this->global_mod->mainBookingStoreProReport($str,$starting='');
            $count = count($arr);
            if($count > 0){
                echo '<table><tr><td>'.$count.' '.$this->lang->line("appo_is_waiting_4_approv").'<br/>'.$this->lang->line("Please").' <a href="http://'.$_SERVER['SERVER_NAME'].'/admin/approval">'.$this->lang->line("click_here").'</a>.</td></tr></table>';
            }
        }
    }

	function findDetails(){
		
		
		echo $this->approval_model->findService().'|(^_^)|'.$this->approval_model->findEmployee().'|(^_^)|'.$this->approval_model->findLocaladminDetails().'|(^_^)|'.$this->approval_model->findBizHours().'|(^_^)|'.$this->approval_model->GetTimeZone();
	}

}