<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Business_hour extends Pardco 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('staff/business_hour_model');
		/*===================LogIn Security Check===================*/
		$logged_in_Status_staff = $this->session->userdata('logged_in_staff');
		if(!$logged_in_Status_staff)
		{
		redirect(base_url().'staff/staff_login');
		}
		/*===================LogIn Security Check===================*/
	}
	
	public function index()
	{
	   
		
			
		$data['staff'] = $this->business_hour_model->get_staff();
		//$data['service'] = $this->business_hour_model->get_service();
		$aaa = $this->business_hour_model->get_category();
		for($i=0;$i<count($aaa);$i++)
		{
			$x = $aaa[$i]['category_id'];
			$data['category'][$x]['name'] = $aaa[$i]['category_name'];
			$data['category'][$x]['child'] = $this->business_hour_model->get_serv($x);
		}

		
		 		
		$this->load->helper('url');
		$this->lang->load('business_hour');
		$this->load->library('form_validation');
		$this->load->view('staff/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('staff/nevigation');
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		//$this->load->view('staff/left',$list);
		
		$this->load->view('staff/business_hour/business_hour', $data);//, $data
		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('staff/footer',$footer);
	}
	
	
	public function add_biz_hour()
	{
		$jsondata = $this->input->post('jsondata');
		$bizHourAdd = $this->business_hour_model->biz_hour_add($jsondata);
		if($bizHourAdd)
		{
			echo "Data Inserted Sucessfully!";
		}
	}
	
	
	
	public function show_biz_hour($employee_id)
	{
	    
		$bizHourAdd = $this->business_hour_model->Employee_biz_hour_details($employee_id);
		//echo'<pre>';print_r($bizHourAdd);exit;
		echo $bizHourAdd;
		
	}
	
	public function del_biz_hour()
	{
		$this->business_hour_model->DeleteBizHours();
	}
	
	public function del_emp_service()
	{
		$this->business_hour_model->DeleteEmpService();
	}
}
?>







