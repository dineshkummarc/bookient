<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_login extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->model('staff/staff_login_model');
		
		/*===================LogIn Security Check===================*/
		  $logged_in_Status_staff = $this->session->userdata('logged_in_staff');
		  if($logged_in_Status_staff)
		  {
			  redirect(base_url().'staff/staff_home');
		  }
		/*===================LogIn Security Check===================*/
	}
	
	public function index(){
		if (in_array(33, $this->global_mod->authArray())){	
			$this->load->view('staff/header'); // will modify later
			$this->load->view('staff/staff_login/staff_login');		
			$footer = $this->pardco_model->footer_link();
			$this->load->view('staff/footer',$footer);
		}else{
			$alertData['alertMsg'] = 'You do not have enough privilege for this section.Please contact with your administrator.';
			$this->load->view('admin/upgradeAuth',$alertData);
		}
	}

	public function StaffLogInAjax(){
		$ret = $this->staff_login_model->StaffLogIn();
		echo $ret;
	}
	
	public function home(){    
		$this->load->view('staff/header'); // will modify later
		$this->load->view('staff/staff_home/staff_home');		
		$this->load->view('staff/footer'); // will modify later
	}
}
?>