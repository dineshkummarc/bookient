<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class credit_country_cost extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('Changestatus');
        $this->load->model('superadmin/credit_country_cost_model');
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

	function index($credit_id='',$succ=false){
        $countryArr 		= $this->credit_country_cost_model->getAllCountry();
        $serviceTypeArr 	= $this->credit_country_cost_model->getAllServiceType();
        $creditsCountryCost = $this->credit_country_cost_model->getAllCreditsCountryCost($credit_id);
        //echo "<pre>";
        //print_r($planFeatureRelationArr);
        //echo "</pre>";		
		if($succ){
			$msg='Data inserted successfully';
		}
		else{
			$msg='';			
		}
	    $data['countryArr'] 				= $countryArr;
        $data['serviceTypeArr'] 			= $serviceTypeArr;
        $data['creditsCountryCost'] 		= $creditsCountryCost;
		$data['credit_id'] 					= $credit_id;
		$data['msg'] 						= $msg;
	    $this->load->view('superadmin/header/header');
        $this->load->view('superadmin/nevigation');
        $this->load->view('superadmin/credit_country_cost/credit_country_cost',$data);
        $footer = $this->pardco_model->footer_link_superadmin();
		$this->load->view('superadmin/footer',$footer);
	}

    function save(){
        $relationArr = $this->input->post();
        $credit_id=$this->credit_country_cost_model->save($relationArr);
		echo $credit_id;
    }
}