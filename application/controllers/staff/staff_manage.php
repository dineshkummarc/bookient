<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_Manage extends Pardco 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('staff/staff_manage_model');
		/*===================LogIn Security Check===================*/
		$logged_in_Status_staff = $this->session->userdata('logged_in_staff');
		if(!$logged_in_Status_staff)
		{
		redirect(base_url().'staff/staff_login');
		}
		/*===================LogIn Security Check===================*/
		
	}
	
	public function index(){
		$this->load->view('staff/header');			
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('staff/nevigation', $data);
		$blk_dt_employee_id = $this->session->userdata('user_id_staff');
		$data['blocked_dates'] = $this->staff_manage_model->fetch_blocked_dates($blk_dt_employee_id);		
		$data['staff'] = $this->staff_manage_model->get_all_staff();
		$data['user_id_staff'] =  $this->session->userdata('user_id_staff');		
		$data['user_name_staff'] =  $this->session->userdata('user_name_staff');		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$this->load->view('staff/staff_manage/staff_manage',$data);		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('staff/footer',$footer);
		
		
	}

	public function add_staff(){
		$returndata =$this->staff_manage_model->do_upload();
		$data['staff'] = $this->staff_manage_model->get_all_staff();
		if(isset($returndata['error'])){
			$data['error'] = $error = $returndata['error'];
			$imgdata['upload_data']['file_name'] = "noimage.jpg";
			$this->staff_manage_model->set_staff($imgdata);
			//$this->load->view('staff', $data);
		}else{
			$imgdata=$returndata['data'];
			if($this->staff_manage_model->set_staff($imgdata))
			{
			 $data['success'] = 'Staff is added successfully';  
			}
		}
		$BaseUrl = base_url();
		redirect($BaseUrl.'staff/staff_manage');
	}

	public function check_user_name_ajax(){
		$uname = $this->input->post('uname');
		$curusrid = $this->input->post('curusrid');
		$returndata = $this->staff_manage_model->check_user_name($uname, $curusrid);
	}
	
	public function staff_delete($id){
		$affectedRows = $this->staff_manage_model->delete_staff($id);
		echo  $affectedRows;
	}

	public function change_status(){
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		$affectedRows = $this->staff_manage_model->status_change($status, $id);
		echo  $affectedRows;
	}

	public function staff_edit($id){
		$data['staff'] = $this->staff_manage_model->get_all_staff();
		$data['staff_info'] = $this->staff_manage_model->edit_staff_data($id);
		$this->load->helper('url');
		$this->lang->load('staff');
		$this->load->library('form_validation');
		$this->load->view('header');
		$this->load->view('edit_staff', $data);
		$this->load->view('footer');
	}

	public function update_staff($id){
		$imageChange = "N";
		$imagefielname =  $_FILES['userfile']['name'];
		if($imagefielname != ""){
			$returndata =$this->staff_manage_model->do_upload();
			if(isset($returndata['error'])){
				$data['error'] = $error = $returndata['error'];
				$imageChange = "N";
			}else{
				$imageChange = "Y";
			}
		}
		$this->staff_manage_model->staff_update($id, $imageChange);
		$BaseUrl = base_url();
		redirect($BaseUrl.'staff/staff_manage');
	}
	
	public function staff_data($id){
		$staff_info = $this->staff_manage_model->edit_staff_data($id);
		$staff_infoSend =  $staff_info[0];
		echo json_encode($staff_infoSend);
	}
	
	public function send_password($id){
		$returnData = $this->staff_manage_model->get_email_pass($id);
		echo $EmailSentStatus = $this->staff_manage_model->sendpasswordViaEmail($returnData);
	}

	public function add_block_date(){
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$blk_dt_employee_id = $this->input->post('blk_dt_employee_id');
		$EmailSentStatus = $this->staff_manage_model->add_block_date_data($date_from, $date_to, $blk_dt_employee_id);
		$SerializeDateInDatabase = $this->staff_manage_model->fetch_blocked_dates($blk_dt_employee_id);
		//print($SerializeDateInDatabase);
		echo '<pre>'; print_r($SerializeDateInDatabase); exit;
	}

	public function show_blocked_dates($blk_dt_employee_id){
		$SerializeDateInDatabase = $this->staff_manage_model->fetch_blocked_dates($blk_dt_employee_id);
		echo $SerializeDateInDatabase;
	}

	public function add_block_time(){
                //echo '<pre>'; print_r($_POST);exit;
		$timepickerFrom = $this->input->post('timepickerFrom');
		$timepickerTo = $this->input->post('timepickerTo');
		$date_of_time_block = $this->input->post('date_of_time_block');
		$blk_time_employee_id = $this->input->post('blk_time_employee_id');
		$EmailSentStatus = $this->staff_manage_model->add_block_time_data($timepickerFrom, $timepickerTo, $date_of_time_block, $blk_time_employee_id);
		$BaseUrl =base_url();
		$HtmlData = $this->staff_manage_model->fetch_blocked_timings($blk_time_employee_id,$EmailSentStatus);
		
		print($HtmlData);
	}

	public function show_blocked_times($blk_dt_employee_id){
                $value = 7;
		$HtmlData = $this->staff_manage_model->fetch_blocked_timings($blk_dt_employee_id,$value);
		echo $HtmlData;
	}
	
	public function delete_block_dt($blk_dt_employee_id, $date){
		$HtmlData = $this->staff_manage_model->blocked_dt_delete($blk_dt_employee_id, $date);
		echo $HtmlData;
	}
	
	public function delete_time_block_data($deletetimeId){
		$HtmlData = $this->staff_manage_model->blocked_time_delete($deletetimeId);
		echo $HtmlData;
	}

}
?>

