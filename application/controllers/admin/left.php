<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Left extends Pardco {

	 
	 public function __construct() 
	{
		parent::__construct();
		
		$this->load->model('admin/left_model');
		/*===================LogIn Security Check===================*/
		  /*$logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status){
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id){
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
	}
	public function index()
	{
		$this->load->model('admin/left_model');
		$employee=$this->left_model->employee();
		$list['employee']=$employee;
		$service=$this->left_model->service();
		$list['service']=$service;
		$this->load->view('admin/left');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */