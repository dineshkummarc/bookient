<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calender extends Pardco {
	 
	public function __construct(){
		parent::__construct();
		
		$this->load->model('admin/calender_model');
		/*===================LogIn Security Check===================*/
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
	
		$this->load->view('admin/header');
		
		$data['menu_right']		= $this->pardco_model->pardco_right_menu();
		$data['menu_left']		= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$data['ServcBkinDtls']	= $this->calender_model->getAllBooking();

		$this->load->view('admin/nevigation',$data);
		$list['employee']=$this->calender_model->getEmployeeList();
		$list['service']=$this->calender_model->getServiceList();
		$this->load->view('admin/calender_left',$list);
		$this->load->view('admin/calender/calender');
		
		$footer['link']				= $this->pardco_model->footer_link();
		$footer['languages']		= $this->pardco_model->admin_language();
        $this->load->view('admin/footer',$footer);
	}




}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
