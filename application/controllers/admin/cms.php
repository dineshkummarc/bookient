<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends Pardco { 
     
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
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_cms',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_cms',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
	}
	 
	public function index(){  
	
		
	 
		
		$this->load->view('admin/header');
		
		$data['menu_right']		= $this->pardco_model->pardco_right_menu();
		$data['menu_left']		= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);

		$cms_data['privacypolicy']		= $this->cms_model->getContent('privacypolicy');
		$cms_data['securityinfo']		= $this->cms_model->getContent('securityinfo');
		$cms_data['companyinfo']		= $this->cms_model->getContent('companyinfo');
		$this->load->view('admin/cms/cms',$cms_data);  
		
		$footer['link']				= $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	
	public function updateInfo(){
		$cmsType = $this->input->post('cmsType');
		$comment = $this->input->post('comment');
		$this->cms_model->UpdateContent($cmsType,$comment);
	}
	
	
}	
