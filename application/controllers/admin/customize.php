<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customize extends Pardco{
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/customize_model');
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
            $this->lang->load('admin_customize',$default_language);
            $this->lang->load('admin_global',$default_language);
            
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_customize',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
            
        }
		/*########End Language#######*/
    }
    
	public function index($success=''){
		
		
		
	
        //$this->lang->load('admin_rules');
        $this->load->library('form_validation');
        $this->load->view('admin/header');

       
		if(isset($_REQUEST['ImageButton2'])){
			$postData=$this->input->post();

			$this->customize_model->save($postData);
		}

        if($success !=''){
            $success = $this->lang->line("success_save");		
        }else{
            $success='';
        }
        $data['success']			= $success;
        $data['menu_right']			= $this->pardco_model->pardco_right_menu();
        $data['menu_left']			= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']	= $this->pardco_model->pardco_location();
        $data['pre_booking_data']	= $this->customize_model->getPreBookingData();
        $data['all_data']			= $this->customize_model->getCustomize();
        $data['All_Data_Type']		= $this->customize_model->getAllDataType();
        $data['AllServices']		= $this->customize_model->getServices();
        $data['AllField']			= $this->customize_model->getAllField();
        $data['language_list']		= $this->customize_model->getLanguageList();
        
     ///   echo "<pre>";
     //   print_r($this->session->all_userdata());
    //    echo "</pre>";
    //    exit;
        
        
        $data['default_language']	= $this->customize_model->getDefaultLanguage();
        
        $dataEmail['language']		= $this->getLocalLanguage();
        $dataEmail['local_admin_id']= $this->session->userdata('local_admin_id');
        $data['getEmailOption']		= $this->customize_model->getEmailOption($dataEmail);
        
        
     /*   echo "<pre>";
        echo $defaultLanguage = $this->session->userdata('default_language_type');
        echo "</br>";
        print_r($data['getEmailOption']);
        echo "</pre>";
        exit;
        */
        
        $this->load->view('admin/nevigation',$data);
        $this->load->view('admin/customize/customize', $data);// $data

        $footer['link']				= $this->pardco_model->footer_link();
		$footer['languages']		= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }

    public function mailFormat(){
        $lang = array('customize_language'=>$this->input->post('langId'));
        $this->session->set_userdata($lang);
        echo 1;
    }
	/*
    public function ajaxSave(){
        $saveId 		= $this->input->post('saveId');
		$subject		= $this->input->post('subject');
		$msg_body		= $this->input->post('msg_body');
        $language_id	= $this->input->post('language_id');
        $temp_id		= $this->input->post('temp_id');
        $this->customize_model->getMsgSave($saveId,$subject,$msg_body,$language_id,$temp_id);
    }*/
	
	public function ajaxServices(){
        $data = $this->customize_model->getServices();
        echo json_encode($data);
    }
	
	public function ajaxDataType(){
        $data = $this->customize_model->getAllDataType();
        echo json_encode($data);
    }
	
	public function preBookingFormShowHide(){
		$option = $this->input->post('option');
		$returnVal = $this->customize_model->pre_BookingFormShowHide($option);
		echo $returnVal; 
	}

    public function saveCustomizeData(){
		echo "test";
        exit;
    }
    
    public function saveMailData(){
    	
		//$data['language']			= $this->getLocalLanguage();
		$data['mail_subject']		= $_REQUEST['mail_subject'];
		$data['mail_body']			= $_REQUEST['mail_body'];
		$data['msg_id']				= $this->input->post('msg_id');
		$data['local_admin_id']		= $this->session->userdata('local_admin_id');
		$data['language_id']		= $this->input->post('mail_language');
		
		echo $this->customize_model->saveMailDetails($data);
		
		
	}
	public function getLocalLanguage(){
		$allSession				= $this->session->all_userdata();
		if (in_array("customize_language", array_keys($allSession))) {
			$language		= $this->session->userdata('customize_language');
		}else{
			$language		= 1;
		}
		return $language;
	}
	
	public function GetEmailTemplateByLanguage(){
		$this->customize_model->GetByLanguage();
	}
	
	
	
	
	
	public function saveCustomizeformData(){
		
		$data['local_admin_id'] 	= $this->session->userdata('local_admin_id');
		$data['data_type_id'] 		= $this->input->post('fld_datatype');
		$data['field_name'] 		= $this->input->post('field_name');
		$serviceArr = $this->input->post('service_code');
		
		if($serviceArr[0] == 0){
			$services = $this->customize_model->getServices();
			
			$serArr = array();
			foreach($services as $val){
				array_push($serArr,$val['service_id']);
			}
			$data['services_ids'] 	= serialize($serArr);
		}else{
			$data['services_ids'] 	= serialize($this->input->post('service_code'));
		}
		
		//$data['services_ids'] 		= serialize($this->input->post('service_code'));
		$data['is_required'] 		= $this->input->post('requreValue');
		
		$data['data_option'] 		= $this->input->post('data_option');
		$data['default_val'] 		= $this->input->post('default_val');
		
		echo $this->customize_model->SavecusomizeForm($data);
		
	}
	
	public function saveCustomizeformDataEdit(){
		$data['local_admin_id'] = $this->session->userdata('local_admin_id');
		$data['field_id'] = $this->input->post('field_id');
		$data['data_type_id'] = $this->input->post('data_type_id');
		$data['field_name'] = $this->input->post('field_name');
		$serviceArr = $this->input->post('services_ids');
		
		if($serviceArr[0] == 0){
			$services = $this->customize_model->getServices();
			
			$serArr = array();
			foreach($services as $val){
				array_push($serArr,$val['service_id']);
			}
			$data['services_ids'] 	= serialize($serArr);
		}else{
			$data['services_ids'] 	= serialize($this->input->post('services_ids'));
		}
		$data['is_required'] = $this->input->post('is_required');
		$data['value'] = $this->input->post('value');
		$data['default_val'] = $this->input->post('default_val');
		
		echo $this->customize_model->SavecusomizeFormEdit($data);
	}
	
	
	public function saveCustomizeformDelete(){
		$del_id = $this->input->post('id');
		echo $this->customize_model->DelcusomizeForm($del_id);
	}
	
}
?>