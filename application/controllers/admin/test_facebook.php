<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_facebook extends Pardco {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index() 
	{   
            $this->load->helper('url');
            //$this->load->database();
            //$this->lang->load('prepayment');
            
             $this->load->helper('url');
		$this->load->database();
		//$this->lang->load('prepayment');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('admin/nevigation',$data);
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$this->load->view('admin/left',$list);
		
                $this->load->view('admin/test_facebook/test_facebook');
		
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
			
	}
	
	
	
}