<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Service extends Pardco
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/service_model');
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
            $this->lang->load('admin_service',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_service',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
	}
	public function index($success=''){
		
	
	
		$data['category'] = $this->service_model->get_category();
		$data['service'] = $this->service_model->get_service();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->lang->load('admin_service');
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		// <editor-fold>
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('admin/nevigation',$data);
		// <editor-fold>
		if($success !=''){
			$success ="Changes have been successfully saved";		
		}else{
			$success='';
		}
		$data['success'] = $success;
		$this->load->view('admin/service/service', $data);

		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	public function add_service(){
		$this->service_model->set_service();
		//redirect(base_url().'admin/service');
	}
	public function service_status($status, $id){
		$this->service_model->change_service_status($status, $id);
		redirect(base_url().'admin/service');
	}
	public function service_delete($id){
		$this->service_model->delete_service($id);
		redirect(base_url().'admin/service');
	}
	public function service_edit($id){
		$data['service'] = $this->service_model->edit_service($id);
		$this->load->helper('url');
		$this->lang->load('service');
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		$this->load->view('admin/service/edit_service', $data);
		$this->load->view('admin/footer');
	}
	public function update_service($id){
		$this->service_model->service_update($id);
		redirect(base_url().'admin/service');
	}
	public function service_status_ajax(){
		$is_active = $_REQUEST['is_active'];
		$service_id = $_REQUEST['service_id'];
		$service_name = $_REQUEST['service_name'];
		$x = $this->service_model->change_service_status_ajax($is_active,$service_id,$service_name);

		$returnArr = array();
		$returnArr['flag'] =true;
		$returnArr['enadishtml'] = $x['grid'];
		$returnArr['ddd'] = $x['row'];
		echo json_encode($returnArr);
	}
	
	public function service_hide_ajax(){
		$is_active = $_REQUEST['is_active'];
		$service_id = $_REQUEST['service_id'];
		$service_name = $_REQUEST['service_name'];
		$x = $this->service_model->change_service_hide_ajax($is_active,$service_id,$service_name);

		$returnArr = array();
		$returnArr['flag'] =true;
		$returnArr['enadishtml'] = $x['grid'];
		$returnArr['ddd'] = $x['row'];
		echo json_encode($returnArr);
	}
	public function service_delete_ajax(){
		$service_id = $_REQUEST['service_id'];
		$x = $this->service_model->ajax_delete($service_id);

		$data['category'] = $this->service_model->get_category();
		$data['service'] = $this->service_model->get_service();
		$this->load->helper('url');
		$this->lang->load('service');
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		$this->load->view('admin/service/service', $data);
		$this->load->view('admin/footer');
	}
	public function GetServiceDetailsAjax(){
		$this->service_model->GetServiceDetails();
	}
}
?>