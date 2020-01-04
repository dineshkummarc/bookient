<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Home extends Pardco 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('customer/customer_home_model');
		/*===================LogIn Security Check===================*/
		$logged_in_Status_customer = $this->session->userdata('logged_in_customer');
		if(!$logged_in_Status_customer)
		{
		//redirect(base_url().'customer/customer_login');
		}
		/*===================LogIn Security Check===================*/
	}
	
	public function index()
	{
		/*$StaffDetailsArr = $this->staff_home_model->StaffDetails();
		$WorkScheduleArr = $this->staff_home_model->WorkSchedule();
		$ServicesArr = $this->staff_home_model->ServiceDetails();
		$data['services_details'] = $ServicesArr;
		$data['work_details'] = $WorkScheduleArr;
		$data['staff_details'] = $StaffDetailsArr;*/
		$data['user_id_customer'] =  $this->session->userdata('user_id_customer');
		$data['user_name_customer'] =  $this->session->userdata('user_name_customer');
		$this->load->view('admin/header');
		/* modified by MOUMITA on 17-09-2012 */
		//$this->load->view('frontend/nevigation');
		$data['menu']= $this->pardco_model->frontend_menu();
		$this->load->view('frontend/nevigation',$data);
		//$this->load->view('admin/left');
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$this->load->view('admin/left',$list);
		/* modified by MOUMITA on 17-09-2012 */
		$this->load->view('customer/customer_home/customer_home',$data);		
		$this->load->view('admin/footer');
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