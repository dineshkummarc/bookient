<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Servicecategory extends Pardco 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/servicecategory_model');
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
            $this->lang->load('admin_servicecategory',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_servicecategory',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
		
		
	}
	public function index(){
		
		
		$data['all'] = $this->servicecategory_model->GetAllservicecategory();
		
		$this->lang->load('admin_servicecategory');
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		$this->load->view('admin/servicecategory/servicecategory', $data);
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	public function SaveSERVICECATEGORYAjax(){
		$categoryname	= $this->input->post('categoryname');//exit;
		$category_id	= $this->input->post('category_id');
		$save			= $this->servicecategory_model->Saveservicecategory($categoryname,$category_id);
		if($save == 1){
			echo 1;
		}else{
			echo 0;
		}
	}
	public function ChangeStatusSERVICECATEGORYAjax(){
		$this->servicecategory_model->ChangeStatusSERVICECATEGORY();
	}
	public function EditSERVICECATEGORYAjax(){
		$this->servicecategory_model->EditSERVICECATEGORY();
	}
    public function DeleteSERVICECATEGORYAjax(){
		$this->servicecategory_model->DeleteSERVICECATEGORY();
	}
}
?>