<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cancelaccount extends Pardco 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/cancelaccount_model');
	}
	
	public function index()
	{
		$this->lang->load('admin_cancelaccount');
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		
		
		$this->load->view('admin/cancelaccount/cancelaccount');		
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}	
	
	public function ChangeAdminStatusAjax()
	{		
		$this->cancelaccount_model->Changeadminstatus();		
	}

	
}
?>

