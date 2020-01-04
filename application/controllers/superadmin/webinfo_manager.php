<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class webinfo_manager extends Pardco {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/webinfo_manager_model');
		/*===================LogIn Security Check===================*/
		  $logged_in_Status = $this->session->userdata('super_logged_in');
		  if(!$logged_in_Status)
		  {
			  redirect(base_url().'superadmin/login');
		  }
		/*===================LogIn Security Check===================*/
	}
	
	public function index()
	{
		$this->load->helper('url');
		$this->load->database();
		
		$this->load->view('superadmin/header');
		$this->load->view('superadmin/nevigation');
		$data['all'] = $this->webinfo_manager_model->GetAllFAQ();
		$this->load->view('superadmin/webinfo_manager/webinfo_manager',$data);		
		
		//$footer = $this->pardco_model->footer_link();
		//$this->load->view('admin/footer',$footer);
		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
		
		$this->load->library('session');
	}
	
	public function SaveFAQAjax()
	{
		$this->webinfo_manager_model->SaveFAQ();
	}
	
	public function DelFAQAjax()
	{
		$this->webinfo_manager_model->DelFAQ();
	}
	/*
	public function ChangeStatusFAQAjax()
	{
		$this->faq_manager_model->ChangeStatusFAQ();
	}
	*/
	public function EditFAQAjax()
	{
		$this->webinfo_manager_model->EditFAQ();
	}
         
     
}