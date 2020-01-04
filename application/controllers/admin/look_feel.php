<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Look_feel extends Pardco { 
     
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('admin/look_feel_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status			= $this->session->userdata('logged_in');
		  $local_admin_id			= $this->session->userdata('local_admin_id');
		  $user_id_local_admin		= $this->session->userdata('user_id_local_admin');
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
            $this->lang->load('admin_look_feel',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_look_feel',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
	}
	 
	public function index(){  
	
		
	
	 
		
		//$this->lang->load('admin_look_feel');
		$this->load->view('admin/header');
		
		$data['menu_right']		= $this->pardco_model->pardco_right_menu();
		$data['menu_left']		= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);


		$list['showHeader']		= $this->look_feel_model->showHeader();
		$list['showLayout']		= $this->look_feel_model->showLayout();
		$list['showtheme']		= $this->look_feel_model->showTheme();
		$this->load->view('admin/look_feel/look_feel',$list);  
		
		$footer['link']				= $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	
	function selectHeaderAjax()
	{
		$value= $this->input->post('value');
		$msg=$this->look_feel_model->selectHeader($value);
		echo $msg;
	}
	
	function selectLayoutAjax() 
	{
		$value= $this->input->post('value');
		$msg=$this->look_feel_model->selectLayout($value);
		echo $msg;
	}
	 
	function selectThemeAjax() 
        {
            $value= $this->input->post('value');
            $msg=$this->look_feel_model->selectTheme($value);
            echo $msg;
        }
	 
	public function saveThemeAjax()
	{
		$insert_list		= array();
		$insert_list		= json_decode($_REQUEST['value']);
		$msg				= $this->look_feel_model->saveThemeData($insert_list);
		echo $msg;
	}
	
	public function saveCalendarAjax()
	{
		$insert_list		= array();
		$insert_list		= json_decode($_REQUEST['value']);
		$msg				= $this->look_feel_model->saveCalendarData($insert_list);
		echo $msg;
	}
	
	public function resetCalendarAjax()
	{
		$msg				= $this->look_feel_model->resetCalendarData($insert_list);
		echo $msg;
	}
	
	public function showCustomThemeAjax()
	{
		$arr				= $this->look_feel_model->showCustomTheme();
		$ard_decode			= json_encode($arr);
		echo $ard_decode;
	}
	
	public function showCalendarThemeAjax()
	{
		$arr				= $this->look_feel_model->showCalendarTheme();
		$ard_decode			= json_encode($arr);
		echo $ard_decode;
	}
}	

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
