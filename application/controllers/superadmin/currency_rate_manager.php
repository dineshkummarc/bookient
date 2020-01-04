<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class currency_rate_manager extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->library('Changestatus');
        $this->load->model('superadmin/currency_rate_manager_model');
		
		/*===================LogIn Security Check===================*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		$logged_in_Status = $this->session->userdata('super_logged_in');
		if(!$logged_in_Status)
		{
			redirect(base_url().'superadmin/login');
		}
		/*===================LogIn Security Check===================*/
	}

	function index(){
		$data['currency_abbriviation'] = $this->currency_rate_manager_model->getCurrencyname();
		//$data['currency_rate'] = $this->currency_rate_manager_model->fetCurrencyValue();
		
		/*foreach($data['currency_rate'] as $val){
			array_push($data['currency_abbriviation'],$val);
		}*/
		
		//echo "<pre>";
		
	//	print_r($data['currency_abbriviation']);
		//print_r($data['currency_rate']);
	//	exit;
		
		
	    $this->load->view('superadmin/header/header');
        $this->load->view('superadmin/nevigation');
        $this->load->view('superadmin/currency_rate_manager/currency_rate_manager',$data);
        $footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
	}
	
	
	function saveCurrency(){
		$currency = $this->input->post('currency');
		if(!empty($currency)){
			$this->currency_rate_manager_model->TrancateTable();
		}
		
		foreach($currency as $key=>$val){
			if($val != ""){
				$this->currency_rate_manager_model->saveCurrency($key,$val);
			}
		}
		
		redirect(base_url().'superadmin/currency_rate_manager/');
		
	}
}