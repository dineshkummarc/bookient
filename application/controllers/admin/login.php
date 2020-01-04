<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Pardco {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/login_model');
			
		/*===================LogIn Security Check===================*/
		  $logged_in_Status = $this->session->userdata('logged_in');
		  if($logged_in_Status)
		  {
			  redirect(base_url().'admin/calender');
		  }
		/*===================LogIn Security Check===================*/
	}
	
	public function index()
	{
		$isSuspended			= $this->global_mod->isSuspended();
		if($isSuspended == 'Y'){
			if($this->login_model->checkResetPassword()== TRUE){
				$this->lang->load('admin_login');
				$this->load->view('admin/header');
				$this->load->view('admin/login/reset_password');
			}else{
				$this->lang->load('admin_login');
				$this->load->view('admin/header');
				$this->load->view('admin/login/login');
			}			
		}else{
			$alertData['alertMsg'] = 'The scheduler is closed. To active the scheduler please contact with administrator.';
			$this->load->view('admin/upgradeAuth',$alertData);
		}
	}
	

	public function emailNotVerified(){
		  $this->load->view('admin/header');
		  $this->load->view('admin/login/email_not_verified');		
		  $this->load->view('admin/footer');
		 
	}
	
	public function login_ajax(){    
            $user_email	= $this->input->post('user_email');
            $password	= $this->input->post('password');
            $login_status=$this->login_model->login_check($user_email,$password);
            echo $login_status;
	}
	
	public function changePassword(){
		$re_pass	= $this->input->post('re_pass');
		$re_nw_pass	= $this->input->post('re_nw_pass');
		$this->login_model->changePassword($re_pass,$re_nw_pass);
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
