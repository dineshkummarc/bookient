<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgot_Password extends Pardco {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer/forgot_password_model');		
		
	}
	
	public function index()
	{
		$this->load->view('admin/header');
		
		//$this->load->view('customer/forgot_password/forgot_password');		
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	
	public function ForgotPasswordAjax()
	{
		return $this->forgot_password_model->ForgotPassword();
	}
	
	public function changePasswoed(){
		$re_pass	= $this->input->post('f_password');
		$re_nw_pass	= $this->input->post('f_nwPassword');
		return $this->forgot_password_model->changePassword($re_pass,$re_nw_pass);
	}
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
