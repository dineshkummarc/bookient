<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class back_to_super extends Pardco { 

	public function __construct()
	{
		parent::__construct();
                $this->load->library('session');
		$this->load->helper('url');
		$this->load->model('admin/back_to_super_model');
		/*===================LogIn Security Check===================*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
	}

	 public function index()
	{   
		
		$this->back_to_super_model->super_admin_dashboard();
	 }
}	

