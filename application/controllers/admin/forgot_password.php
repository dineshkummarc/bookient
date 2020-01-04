<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_Password extends Pardco {

	
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/forgot_password_model');
		$this->load->library('session');
	}
	
	public function index()
	{
		$this->load->view('admin/header');
		
		$this->load->view('admin/forgot_password/forgot_password');		
		$this->lang->load('admin_forgot_password');
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	
	public function ForgotPasswordAjax()
	{
		$this->forgot_password_model->ForgotPassword();
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
