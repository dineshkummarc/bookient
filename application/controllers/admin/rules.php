<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rules extends Pardco 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/rules_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
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
            $this->lang->load('admin_rules',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_rules',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
	}
	
	public function index($success=''){
	
	
		$data['clint_signup_info_arr'] = $this->rules_model->get_clint_signup_info();
		$data['clint_edit_info_arr'] = $this->rules_model->get_clint_edit_info();
		$data['admin_user_show_field_info_arr'] = $this->rules_model->get_admin_user_show_field_info();
		
		
		$data['language_list_arr'] = $this->rules_model->get_language_list();
		$data['login_types_arr'] = $this->rules_model->get_login_types();
		$data['local_admin_id'] = $this->session->userdata('local_admin_id');
		$data['SettingData'] = $this->rules_model->select_from_db();
		$data['staffOrder'] = $this->rules_model->staffOrder();
			
		//$this->lang->load('admin_rules');
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$data['allSmsCountry']= $this->rules_model->getAllSmsCountry();
		$data['local_admin_country']= $this->rules_model->get_local_admin_country();
		$data['getSmsRate']= $this->rules_model->getSmsRate();
		
		
		
		$this->load->view('admin/nevigation',$data);
		
		if($success !=''){
			$success = $this->lang->line('update_success');		
		}else{
			$success='';
		}
		$data['success'] = $success;
		$this->load->view('admin/rules/rules', $data);//, $data
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	
	public function add_biz_hour(){
		$jsondata = $this->input->post('jsondata');
		$bizHourAdd = $this->business_hour_model->biz_hour_add($jsondata);
		if($bizHourAdd){
			echo $this->lang->line("data_insrted_success");
		}
	}
	
	public function add_rules(){
		$bizHourAdd = $this->rules_model->rules_add();
		redirect(base_url().'admin/rules/index/success');
	}
	public function showRate(){
		$country_id =$this->input->post('country_id');
		$SmsRate = $this->rules_model->getSmsRate($country_id);
		echo $SmsRate;
	}
	
}
?>
