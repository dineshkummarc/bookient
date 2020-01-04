<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dependency extends Pardco { 
    
	public function __construct(){
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('admin/dependency_model');
		$this->load->model('admin/left_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
		  $local_admin_id = $this->session->userdata('local_admin_id');
		  $user_id_local_admin = $this->session->userdata('user_id_local_admin');
		  if(!$logged_in_Status)
		  {
			  redirect(base_url().'admin/login');
		  }else{
			  if($user_id_local_admin != $local_admin_id)
			  {
				  $this->session->sess_destroy();
				  redirect(base_url());
			  }
		  }*/
		  $this->global_mod->checkSession();
		/*===================LogIn Security Check===================*/
		
		/*########Start Language #######*/
		$default_language = 'english'; // it should be local admin language
		if($this->session->userdata('admin_language') == ''){
            $this->lang->load('admin_depemdency',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_depemdency',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
	}
	 
	public function index(){
	
		
		//$this->lang->load('admin_depemdency');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		$list['showDependency'] =$this->dependency_model->select_from_db();
		$list['showCustomDependency'] = $this -> dependency_model -> select_custom_from_db();
		$list['service']=$this->dependency_model->service();
		$list['nonDependenctService']=$this->dependency_model->nonDependenctService();
		
		$list['MultipleServicesBooking']=$this->dependency_model->selectMultipleServicesBooking();
		
		
		
		$this->load->view('admin/dependency/dependency',$list);	
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	
	
	function disabledCheckAjax(){
		$nonDependentId	= $this->input->post('option_value');
		if($nonDependentId !=''){
			$dependent_services=$this->dependency_model->returnAjax($nonDependentId);
			echo $dependent_services;
		}else{
		    echo "no";
		}
    }
	
	function insert_to_db_Ajax(){
		$is_dependent	= $this->input->post('value_dependent');

		if(!empty($is_dependent)){
			$value_dependent		= $this->input->post('value_dependent');
			$value_dependentOn		= $this->input->post('value_dependentOn');
			$dependent_services		=$this->dependency_model->insert_to_db($value_dependent,$value_dependentOn);
			$dependent_services1	=$this->dependency_model->select_from_db();
			echo $dependent_services1;
		}else{
		    echo "no";
		}
     }
	 
	 function insert_custom_to_db_Ajax(){
		$values = $this -> input -> post(); 
		if ($values === FALSE)
		{
			return ;
		}
		$local_admin_fields = $this -> dependency_model -> get_local_admin_field_ids();
		$fields = array();
		foreach($values as $key => $value)
		{
			//do some changes: drop data that is in wrong format, and make sure the id belongs to logged in local admin
			// Check for form keys; note, this could be slow on real large form
			if (!preg_match('/^option_field_message_(?P<id>[0-9]+)$/', $key, $matches))
			{
				continue;
			}
			$field_id = $matches['id'];
			
			// Check field id belongs to the logged in admin
			if (!in_array($field_id, $local_admin_fields))
			{
				continue;
			}
			
			$fields[$field_id] = $value;
		}
		$this->dependency_model->insert_custom_to_db($fields);
     }
     
	function chk_staffCounter(){
			$staffCount = $this->dependency_model->countStaff();
		echo $staffCount;
	}
	 
	function deleteDependencyAjax(){

		if(!empty($_REQUEST['del_id'])){
			$del_id= $_REQUEST['del_id'];
		    $successfully_del=$this->dependency_model->deleteDependency($del_id);
			$dependent_services1 =$this->dependency_model->select_from_db();
			echo $dependent_services1;
		}else{
		    echo "no";
		}
     }
	 
	function displayOption(){
            $displayOption = $this->input->post('display');
            $successfully_del=$this->dependency_model->multipleServicesBooking($displayOption);
            echo $successfully_del;
        }
	
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
