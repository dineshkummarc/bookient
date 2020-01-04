<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_Password extends Pardco {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/forgot_password_model');
		$this->load->library('session');

		
		/*===================LogIn Security Check===================*/
//		  $logged_in_Status = $this->session->userdata('logged_in');
//		  if($logged_in_Status)
//		  {
//			  redirect(base_url().'admin/dashboard');
//		  }
		/*===================LogIn Security Check===================*/
	}
	
	public function index()
	{
		$this->load->view('superadmin/header');
		
		$this->load->view('superadmin/forgot_password/forgot_password');		
		
		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
	}
	
	public function ForgotPasswordAjax()
	{
		$this->forgot_password_model->ForgotPassword();
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
