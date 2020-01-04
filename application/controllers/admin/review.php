<?php 
//CB#SOG#28-11-2012#PR#S
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Review extends Pardco 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('admin/review_model');
	}
	
	public function index()
	{
		//echo $result = $this->report_model->CheckValidMinBooking();
		$this->load->helper('url');
		$this->lang->load('admin_review');
		
		//$this->load->model('admin/review_model');
		
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		//$this->load->view('admin/nevigation',$data);
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		//$this->load->view('admin/left',$list);
		
		$data['all'] = $this->review_model->GetALL();
		$this->load->view('admin/review/review',$data);
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
		
		
	}
	
	public function getReportsAjax()
	{
		$this->review_model->GetReports();
	}
	
	//CB#SOG#28-11-2012#PR#E
}
?>

