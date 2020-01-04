<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff extends Pardco
{
	public function __construct(){ 
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('admin/staff_model');
		/*===================LogIn Security Check===================*/
		 /* $logged_in_Status = $this->session->userdata('logged_in');
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
            $this->lang->load('admin_staff',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_staff',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
		
		
	}
	public function index($success=''){		
		
		$data['staff'] = $this->staff_model->get_all_staff();

		//$this->lang->load('admin_staff');
		$this->load->library('form_validation');
		$this->load->view('admin/header');

		$data['current_id'] ='';
		$data['type'] = '';
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);

		if($success =='succ'){
			$success = $this->lang->line('update_success');
		}else if($success =='noimg'){
			$success='<font style="color:red">'.$this->lang->line('img_upload_error').'</font>';
		}else{
			$success='';
		}
		$data['success'] = $success;

		$this->load->view('admin/staff/staff', $data);

		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	} 
	/*##############################Palash Roy(Coming from ajax)####################################*/
	public function index_ajax($current_id='',$type=''){
		$data['staff'] = $this->staff_model->get_all_staff();
		$data['current_id'] = $current_id;
		$data['type'] = $type;
		$this->load->helper('url');

		$this->lang->load('admin_staff');
		$this->load->library('form_validation');
		$this->load->view('admin/header');

		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('admin/nevigation',$data);

		$this->load->view('admin/staff/staff', $data);

		$footer = $this->pardco_model->footer_link();
		$this->load->view('admin/footer',$footer);
	}
	/*##############################Palash Roy(Coming from ajax)####################################*/
	public function add_staff(){
		
		$returndata =$this->staff_model->do_upload();
		
		$data['staff'] = $this->staff_model->get_all_staff();
		$BaseUrl = base_url();
		if(isset($returndata['error'])){
			$data['error'] = $error = $returndata['error'];
			$imgdata['upload_data']['file_name'] = "noimage.jpg";
			$this->staff_model->set_staff($imgdata);
            $imagefielname =  $_FILES['userfile']['name'];
            if($imagefielname != ""){
                redirect($BaseUrl.'admin/staff/index/noimg');
            }else{
                redirect($BaseUrl.'admin/staff/index/succ');
            }
		}else{
			$imgdata=$returndata['data'];
			if($this->staff_model->set_staff($imgdata)){
				 $data['success'] = $this->lang->line('add_staff_succ');
				 redirect($BaseUrl.'admin/staff/index/succ');
			}
		}
		//$this->load->view('footer');	
	}
	public function check_user_name_ajax(){
		$uname = $this->input->post('uname');
		$curusrid = $this->input->post('curusrid');
		$returndata = $this->staff_model->check_user_name($uname, $curusrid);
	}
	public function staff_delete($id){
		$affectedRows = $this->staff_model->delete_staff($id);
		echo  $affectedRows;
		//redirect('/admin/staff');
	}
	public function change_status(){
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		
		$affectedRows = $this->staff_model->status_change($status, $id);
		echo  $affectedRows;
		//redirect('/staff');
	}
	public function staff_edit($id){
		$data['staff'] = $this->staff_model->get_all_staff();
		$data['staff_info'] = $this->staff_model->edit_staff_data($id);
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
			$returndata =$this->staff_model->do_upload();
			if(isset($returndata['error'])){
				$data['error'] = $error = $returndata['error'];
				$imageChange = "N";
			}else{
				$imageChange = "Y";
			}
		}
		$this->staff_model->staff_update($id, $imageChange);
		$BaseUrl = base_url();
		redirect($BaseUrl.'admin/staff/index/succ');
	}
	public function staff_data($id){
		$staff_info = $this->staff_model->edit_staff_data($id);
		$staff_infoSend =  $staff_info[0];
		//echo json_encode($staff_infoSend);
        ########### PROBLEM MAY ARISE WITHIN THIS SECTION   #######################
        $return_ser = serialize($staff_infoSend);
        $value = mb_check_encoding($return_ser, 'UTF-8') ? $return_ser : utf8_encode($return_ser);
        $value = preg_replace( '!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $value );
        $value = preg_replace( '/;n;/', ';N;', $value );
        $new_return = unserialize($value);
        echo json_encode($new_return);
        ########### PROBLEM MAY ARISE WITHIN THIS SECTION    #######################
	}
	public function send_password($id){
		$returnData = $this->staff_model->get_email_pass($id);
		echo $EmailSentStatus = $this->staff_model->sendpasswordViaEmail($returnData);
		//redirect('/staff');
	}
	public function add_block_date(){
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $blk_dt_employee_id = $this->input->post('blk_dt_employee_id');
        $EmailSentStatus = $this->staff_model->add_block_date_data($date_from, $date_to, $blk_dt_employee_id);
        //$BaseUrl =base_url();
        //redirect($BaseUrl.'admin/staff');
	}
	public function show_blocked_dates($blk_dt_employee_id){
        $SerializeDateInDatabase = $this->staff_model->fetch_blocked_dates($blk_dt_employee_id);
        echo $SerializeDateInDatabase;
	}
	public function add_block_time(){
		$timepickerFrom = $this->input->post('timepickerFrom');
		$timepickerTo = $this->input->post('timepickerTo');
		$date_of_time_block = $this->input->post('date_of_time_block');
		$blk_time_employee_id = $this->input->post('blk_time_employee_id');
		$EmailSentStatus = $this->staff_model->add_block_time_data($timepickerFrom, $timepickerTo, $date_of_time_block, $blk_time_employee_id);
		$BaseUrl =base_url();
		//redirect($BaseUrl.'admin/staff');
	}
	public function show_blocked_times($blk_dt_employee_id){
		$HtmlData = $this->staff_model->fetch_blocked_timings($blk_dt_employee_id);
		echo $HtmlData;
	}
	public function delete_block_dt($blk_dt_employee_id, $date){
		$HtmlData = $this->staff_model->blocked_dt_delete($blk_dt_employee_id, $date);
		echo $HtmlData;
	}
	public function delete_time_block_data($deletetimeId){
		$HtmlData = $this->staff_model->blocked_time_delete($deletetimeId);
		echo $HtmlData;
	}
    //CB#SOG#5-3-2013#PR#S
    public function Remove_pic(){
		$eid = $this->input->post('empl_Id');
        $val = $this->staff_model->remove_the_pic($eid);
        echo $val;
	}
    //CB#SOG#5-3-2013#PR#E
}
?>