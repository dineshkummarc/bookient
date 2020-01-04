<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upgrade_membership extends Pardco { 
     
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('admin/upgrade_membership_model');
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
		$this->lang->load('admin_upgrade_membership');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$this->load->view('admin/left',$list);
		
		$list['showAllMembershipType']=$this->upgrade_membership_model->showAllMembershipType();
		$this->load->view('admin/upgrade_membership/upgrade_membership',$list);  
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	
	
	function featureDetailsAjax() 
	{
		$membership_type_id		=$this->input->post('membership_type_id');
		$featureDetails			=$this->upgrade_membership_model->featureDetails($membership_type_id);
		echo $featureDetails;
	}
	
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */