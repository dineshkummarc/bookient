<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class import_customers extends Pardco {
	
	 public function __construct(){
        parent::__construct();
		$this->load->model('admin/import_customers_model');
        $this->load->model('admin/customer_model');
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
            $this->lang->load('admin_customer',$default_language);
            $this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_customer',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
    }

	public function index(){
		
        $this->load->view('admin/header');
        //$this->lang->load('admin_customer');

        $data['menu_right']= $this->pardco_model->pardco_right_menu();
        $data['menu_left']= $this->pardco_model->pardco_left_menu();
        $data['pardco_location']= $this->pardco_model->pardco_location();
        $this->load->view('admin/nevigation',$data);

        $list['employee']=$this->pardco_model->employee();
        $list['service']=$this->pardco_model->service();
        //$this->load->view('admin/left',$list);

        $this->load->view('admin/import_customers/import_customers');

        $footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
    }
	
	public function import_customers_ajax()
	{
		if  ((!is_array($_FILES)) 
			|| (!array_key_exists('file-0', $_FILES)) 
			|| (!is_array($_FILES['file-0'])) 
			|| (!array_key_exists('tmp_name', $_FILES['file-0'])))
		{
			trigger_error('Upload failed, TODO!!! someone needs to fix this error message though!', E_USER_ERROR);
		}
		$file = $_FILES['file-0']['tmp_name'];
		$customers = $this->import_customers_model->csv_to_array($file);
		if ($customers === FALSE)
		{
			return ;
		}

		foreach($customers as $k){ 
			$emailId = $k['user_email'];
			$check = $this->global_mod->checkDuplicatEmail($emailId);
			if($check == "true" && !empty($emailId)){
				$this->customer_model->customerAdd($k);
				echo $k;
			}
		}
		@unlink($file);
	}
}
