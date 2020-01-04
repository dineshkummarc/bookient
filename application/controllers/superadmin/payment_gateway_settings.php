<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_gateway_settings extends Pardco {  

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('superadmin/payment_gateway_settings_model');
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
		$this->lang->load('business');
		$this->load->view('admin/header');

		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('superadmin/nevigation');
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$list['PaymentGatewayArray']=$this->payment_gateway_settings_model->PaymentGatewayDetails();
		
		$this->load->view('superadmin/payment_gateway_settings/payment_gateway_settings',$list);	
		
		$footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
	 }
	 
	 public function SavePaymentGatewayValuesAjax()
	 {
		 $ret = $this->payment_gateway_settings_model->SavePaymentGatewayValues();
		 echo $ret;
	 }
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */