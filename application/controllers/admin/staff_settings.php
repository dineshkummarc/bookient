<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_settings extends Pardco{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/staff_settings_model');
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
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_staffsetting',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_staffsetting',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
	}

	public function index($succ=''){	
	
		$this->load->view('admin/header');

		$data['menu_right']		= $this->pardco_model->pardco_right_menu();
		$data['menu_left']		= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$data['employeeList']	= $this->staff_settings_model->getEmployeeList();
		if($succ !=''){
			$data['updateSucc']	= $this->lang->line('update_success');
		}else{
			$data['updateSucc']	= '';
		} 
		
		$this->load->view('admin/nevigation',$data);
		$this->load->view('admin/staff_settings/staff_settings', $data);
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	
	public function UpdateStaffSettings(){
        $checkArr = array();
        $i = 0;
        $app_staff_settings_id = '';
        $settingsTableArr = array('logIntoTheSystem','chooseACalendarView','creatCustomer','VerifyCustomerAccount','resetCustomerAccountPassword','inviteCustomerForOnlineScheduling','editCustomerAccount','addTagsToCustomerAccount','readNdEditFAQ','setWorkingTime','setAppointmentStatus','editAppointment','cancelAppointment','viewAppointment','askReviewFromCustomer','exportToGoogleCalendar');
        foreach($_POST as $key=>$val){
            $keyArr = explode("_",$key);
            $settings = $keyArr[0];
            $app_staff_settings_id = $keyArr[1];
            if($app_staff_settings_id == $keyArr[1]){
                $checkArr[$keyArr[1]][$settings] = $val;
                $i++;
            }
        }
        foreach($checkArr as $k=>$v){
            foreach($settingsTableArr as $key_settings=>$val_settings){
                if (!array_key_exists($val_settings, $v)) {
                    $checkArr[$k][$val_settings] = 0;
                }
            }
        }
        $retVal = $this->staff_settings_model->updateSettings($checkArr);
        echo $retVal;
	}

}