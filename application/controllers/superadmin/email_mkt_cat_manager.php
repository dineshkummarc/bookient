<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class email_mkt_cat_manager extends Pardco {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/email_mkt_cat_manager_model');
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
		$data['all'] = $this->email_mkt_cat_manager_model->GetAllCategory(); 
		$this->load->view('superadmin/email_mkt_cat_manager/email_mkt_cat_manager',$data);		
		
		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
		
		$this->load->library('session');
	}
	
	public function SaveTIMEZONEAjax()
	{
		$this->email_mkt_cat_manager_model->SaveTIMEZONE();
		$return=$this->email_mkt_cat_manager_model->GetAllCategory();
		echo $return;
	}
	/*
	public function DelTIMEZONEAjax()
	{
		$this->timezone_manager_model->DelTIMEZONE();
		$return=$this->timezone_manager_model->GetAllTIMEZONE();
		echo $return;
		
	}
	
	public function ChangeStatusTIMEZONEAjax()
	{
		$this->timezone_manager_model->ChangeStatusTIMEZONE();
	}
	*/
	public function EditTIMEZONEAjax()
	{
		$this->email_mkt_cat_manager_model->EditTIMEZONE();
	}
	

}