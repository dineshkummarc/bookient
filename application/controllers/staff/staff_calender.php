<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_calender extends Pardco {
	  
	public function __construct(){
		parent::__construct();
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

	public function index(){
		$this->load->view('staff/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('staff/nevigation', $data);
		//$data['ServcBkinDtls']	= $this->calender_model->getAllBooking();

		$list['service']=$this->staff_calender_model->getServiceList();
		$this->load->view('staff/staff_calender_left',$list);
		$this->load->view('staff/staff_calender/staff_calender');
		
		//$this->lang->load('admin_calender');
		
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('staff/footer',$footer);
	}
	
	
	


}
