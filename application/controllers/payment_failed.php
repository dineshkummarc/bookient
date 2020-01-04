<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment_failed extends Pardco {

	public function __construct(){
        parent::__construct();
        $this->load->model('payment_failed_model');
		$this->load->model('page_model');
        /*$this->load->model('info_model');
        $this->load->model('customer/customer_registration_model');
        $this->load->model('payment_pro_model');
        $this->load->model('customer/customer_model');*/
        //$this->load->library('facebook_post/Facebook');
        $logged_in_Status_customer = $this->session->userdata('logged_in_customer');  
        $default_language = strtolower($this->session->userdata('default_language_type'));
        
        if($this->session->userdata('selected_lang') == ''){
            $this->lang->load('page',$default_language);
            $this->lang->load('calendar',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('selected_lang'));
            $this->lang->load('page',$setLanguage);
            $this->lang->load('calendar',$setLanguage);
        }
		$data['template']=$this->page_model->getALLTemplate();
		$data['design']=$this->page_model->getDesignOffer();
		$data['bTime']=$this->input->post('bTime');
		$this->load->view('frontend/payment_failed', $data);
    }	
	
	public function index(){

	}
}


?>