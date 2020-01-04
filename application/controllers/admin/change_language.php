<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class change_language extends Pardco { 
     
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin/cms_model');
		
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status			= $this->session->userdata('logged_in');
		  $local_admin_id			= $this->session->userdata('local_admin_id');
		  $user_id_local_admin		= $this->session->userdata('user_id_local_admin');
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
	 
	public function index($language){   
		$this->session->set_userdata('admin_language', $language);		
		$current_lang =  $this->session->userdata('admin_language');
		if(empty($current_lang))
		  $current_lang = 'english';
				
		$current_url=$this->session->userdata('current_url');
		redirect($current_url);
	}
	
}	
