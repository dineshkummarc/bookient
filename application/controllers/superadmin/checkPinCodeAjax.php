<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class checkPinCodeAjax extends Pardco {

	
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
	
	function checkPinCodeAjaxFunction()
	{
		$pincode = $_REQUEST['pincode'];
		if($pincode == "1234")
		{
			echo 1;
			
		}
		else
		{
			echo 0;
		}
	}
	
	
}


/* End of file Basic.php */
/* Location: ./application/controllers/blog.php */
