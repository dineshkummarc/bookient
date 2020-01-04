<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Pardco {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('superadmin/login_model');
		
		
		/*===================LogIn Security Check===================*/
		  $logged_in_Status = $this->session->userdata('logged_in');
		  if($logged_in_Status){
			  redirect(base_url().'admin/dashboard');
		  }
		/*===================LogIn Security Check===================*/
	}
	
	public function index(){
	      
		  $this->load->view('superadmin/header');
		  $this->load->view('superadmin/login/login');		
			$footer = $this->pardco_model->footer_link_superadmin();
		//	$this->load->view('superadmin/footer',$footer);
		  
	}

	public function login_ajax(){   
		$user_email	= $this->input->post('user_email');//$_REQUEST['user_name'];
		$password	= $this->input->post('password');//$_REQUEST['user_name'];
		$login_status=$this->login_model->login_check($user_email,$password);
		echo $login_status;
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
