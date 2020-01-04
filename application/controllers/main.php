<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends Pardco 
{
  	public function __construct()
	{
		parent::__construct();
		//$this->load->model('page_model');
		//$logged_in_Status_customer = $this->session->userdata('logged_in_customer');
		/*===================LogIn Security Check===================*/
		  /*$logged_in_Status_staff = $this->session->userdata('logged_in_staff');
		  if($logged_in_Status_staff)
		  {
			  redirect(base_url().'staff/home');
		  }*/
		/*===================LogIn Security Check===================*/
	}
	public function index()
	{
		$this->lang->load('main');
		$this->load->view('main/registration/header');
		$this->load->view('main/registration/registration');
		$this->load->view('main/registration/footer');
	}
}
