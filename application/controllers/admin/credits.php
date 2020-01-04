<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Credits extends Pardco {

	public function __construct()
	{
                  parent::__construct();	
                  $this->load->library('MPDF54/mpdf');
                  $this->load->model('admin/credits_model');            
		
		
		/*===================LogIn Security Check===================*/
		  /*$logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status){
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id)
			  {
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
	}
	
	public function index() 
	{   
		$this->lang->load('admin_credits');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		$data['country_selected'] = $this->credits_model->GetCountryLocalAdmin();
		$data['CreditDtls'] = $this->credits_model->GetAllCreditTypes($data['country_selected']);
		$data['CreditList'] = $this->credits_model->GetAllCreditList();

		$this->load->view('admin/credits/credits',$data);
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);        
               
		
	}
	
	public function GetRateInfoAjax()
	{
		$this->credits_model->GetRateInfo();
	}
	
	public function DownloadPdfAjax()
	{               
		$this->credits_model->DownloadPdf();                
	}
	
}