<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class calender extends Pardco { 
    
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('email_verification_model');

	}
	public function day_row()
	{   
		$this->load->helper('url');
		$this->load->view('main/email_verification/header');
		$Key =$this->email_verification_model->generateKey($user_id);
		$encrypt_username =$this->email_verification_model->encrypt_username('partha');
		$local_admin_id_url = $_SERVER['HTTP_HOST'];
		$this->load->view('main/email_verification/email_verification');
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
		
	}

}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */