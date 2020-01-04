<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_Home extends Pardco 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('staff/staff_home_model');
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
		$this->load->view('staff/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$this->load->view('staff/nevigation', $data);
		
		
		$StaffDetailsArr = $this->staff_home_model->StaffDetails();
		$WorkScheduleArr = $this->staff_home_model->WorkSchedule();
		$ServicesArr = $this->staff_home_model->ServiceDetails();
		$data['services_details'] = $ServicesArr;
		$data['work_details'] = $WorkScheduleArr;
		$data['staff_details'] = $StaffDetailsArr;
		$data['user_id_staff'] =  $this->session->userdata('user_id_staff');
		$data['user_name_staff'] =  $this->session->userdata('user_name_staff');
		
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
	//	$this->load->view('staff/left',$list);
		
		
		$this->load->view('staff/staff_home/staff_home',$data);		
		$footer = $this->pardco_model->footer_link();
		$this->load->view('staff/footer',$footer);
	}
	
	public function StaffSaveDataAjax()
	{
		$error = "";
		$msg = "";
		
		if(isset($_FILES['employee_image']['name']) && $_FILES['employee_image']['name'] != '')
		{
			$ext = explode(".",$_FILES["employee_image"]["name"]);
			$count = count($ext);
			$extn = strtolower($ext[$count-1]);
		
			if(!empty($_FILES['employee_image']['error']))
			{
				switch($_FILES['employee_image']['error'])
				{
					case '1':
						$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
						break;
					case '2':
						$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
						break;
					case '3':
						$error = 'The uploaded file was only partially uploaded';
						break;
					case '6':
						$error = 'Missing a temporary folder';
						break;
					case '7':
						$error = 'Failed to write file to disk';
						break;
					case '8':
						$error = 'File upload stopped by extension';
						break;
					default:
						$error = 'No error code avaiable';
				}
				
				$err = 1;
			}
			else
			{
				if($extn == 'jpg' || $extn == 'png' || $extn == 'jpeg' || $extn == 'bmp')
				{
					$err = 0;
				}
				else
				{
					$error = 'Uploade only images.';
					$err = 1;
				}
			}
			
			if( $err == 0)
			{
				$img_name = time().'_'.$_FILES["employee_image"]["name"];
				$img_store = $_FILES["employee_image"]["name"];
				$target = 'uploads/staff/'.$img_name;
				if(move_uploaded_file($_FILES["employee_image"]["tmp_name"], $target))
				{	
					$msg = $this->staff_home_model->StaffSaveData($img_name,$img_store); 
				}
			}
		}
		else
		{
			$img_name = '';
			$img_store = '';
			$msg = $this->staff_home_model->StaffSaveData($img_name,$img_store);
		}

		echo "{";
		echo				"error: '" . $error . "',\n";
		echo				"msg: '" . $msg . "'\n";
		echo "}";
	}

	public function BizDeleteAjax()
	{
		$this->staff_home_model->BizDelete();
	}
	
	public function UpdateServicesAjax()
	{
		$this->staff_home_model->UpdateServices();
	}
	
	public function GetStaffServiceDetilsAjax()
	{
		$this->staff_home_model->GetStaffServiceDetils();
	}
}
?>