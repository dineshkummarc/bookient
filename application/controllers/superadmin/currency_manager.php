<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class currency_manager extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/currency_manager_model');
		/*===================LogIn Security Check===================*/      
		$logged_in_Status = $this->session->userdata('super_logged_in');
		if(!$logged_in_Status){
			redirect(base_url().'superadmin/login');
		}
		/*===================LogIn Security Check===================*/
	}

	public function index(){
		$this->load->helper('url');
		$this->load->database();

		$this->load->view('superadmin/header');
		$this->load->view('superadmin/nevigation');
		$data['all'] = $this->currency_manager_model->GetAllCURRENCY();
		$this->load->view('superadmin/currency_manager/currency_manager',$data);

		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);

		$this->load->library('session');
	}

	public function SaveCURRENCYAjax(){
		$this->currency_manager_model->SaveCURRENCY();
	}

	public function DelCURRENCYAjax(){
		$this->currency_manager_model->DelCURRENCY();
	}

	public function ChangeStatusCURRENCYAjax(){
		$this->currency_manager_model->ChangeStatusCURRENCY();
	}

	public function EditCURRENCYAjax(){
		$this->currency_manager_model->EditCURRENCY();
	}/**/
}