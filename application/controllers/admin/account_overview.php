<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_overview extends Pardco { 
     
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin/account_overview_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status)
		  {
			  redirect(base_url().'admin/login');
		  }
		  else
		  {
			  if($user_id_local_admin != $local_admin_id)
			  {
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
	}
	 
	public function index(){   
		$this->lang->load('admin_account_overview');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		
		$list['accountDetails']=$this->account_overview_model->accountDetails();
		$list['showAllTransaction']=$this->account_overview_model->showAllTransaction();
		$this->load->view('admin/account_overview/account_overview',$list);  
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	
	
	function changeStatusAjax() 
	{
		$booking_id		= $this->input->post('booking_id');
		$booking_status	= $this->input->post('booking_status');
		$msg			=$this->account_overview_model->changeStatus($booking_id,$booking_status);
		echo $msg;
	}
	
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */