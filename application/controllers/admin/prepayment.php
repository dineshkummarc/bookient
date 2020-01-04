<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class PrePayment extends Pardco {
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/prepayment_model');
		
		/*===================LogIn Security Check===================*/
		/*$logged_in_Status = $this->session->userdata('logged_in');
		$local_admin_id = $this->session->userdata('local_admin_id');
		$user_id_local_admin = $this->session->userdata('user_id_local_admin');
		if(!$logged_in_Status){
			redirect(base_url().'admin/login');
		}else{
			if($user_id_local_admin != $local_admin_id){
				$this->session->sess_destroy();
				redirect(base_url());
			}
		}*/
		$this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_prepayment',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_prepayment',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
	}
	public function index(){   
		//$this->lang->load('admin_prepayment');
		$this->load->view('admin/header');
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		$data['GenSetting'] = $this->prepayment_model->LocalAdminSetting();
		$data['PaymentGatewayArray'] = $this->prepayment_model->PaymentGatewayDetails();
		$data['CategoryList'] = $this->prepayment_model->TaxCategoryList();
		$data['TaxList'] = $this->prepayment_model->TaxDetailsList();
		$this->load->view('admin/prepayment/prepayment',$data);
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	public function SetPaymentSettingAjax(){
		$this->prepayment_model->UpdateSetting();
	}
	public function SavePaymentSettingAjax(){
		echo $Return_Val =  $this->prepayment_model->SaveSetting();
	}
	public function SavePaymentGatewayValuesAjax(){
		$RetVal = $this->prepayment_model->SavePaymentGatewayValues();
		echo $RetVal;
	}
	public function SaveTaxValuesAjax(){
		$this->prepayment_model->SaveTaxValues();
	}
	public function SetTaxCategorySelectAjax(){
		$this->prepayment_model->SetTaxCategorySelect();
	}
	public function DeleteTaxDetailsAjax(){
		$this->prepayment_model->DeleteTaxDetails($_REQUEST['id']);
	}
	public function CheckSelectedGatewaysAjax(){
		$local_admin_id = $this->session->userdata('local_admin_id');
		$val = $this->input->post('val');
		$ret = $this->prepayment_model->CheckSelectedGateways($local_admin_id, $val);
		echo $ret;
	}
}