<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UpgradeAuth extends Pardco {
	 
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/calender_model');
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
            $this->lang->load('admin_calender',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_calender',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
		
	}

	public function index(){
	
				
		$this->load->view('admin/upgradeAuth/header');
		
		$data['menu_right']		= $this->pardco_model->pardco_right_menu();
		$data['menu_left']		= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$data['ServcBkinDtls']	= $this->calender_model->getAllBooking();

		$this->load->view('admin/nevigation',$data);
		
		$this->load->view('admin/upgradeAuth/upgradeAuth');
		
		$footer['link']				= $this->pardco_model->footer_link();
		$footer['languages']		= $this->pardco_model->admin_language();
        $this->load->view('admin/upgradeAuth/footer',$footer);
	}




}

