<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_Registration extends Pardco 
{
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('customer/customer_registration_model');

	}	
	public function index(){
		$local_admin_id = $this->customer_registration_model->GetLocalAdmin();
		$this->load->view('admin/header');

		$data['menu']= $this->pardco_model->frontend_menu();
		$this->load->view('frontend/nevigation',$data);
		$list['employee']=$this->pardco_model->employee();
		$list['service']=$this->pardco_model->service();
		$this->load->view('admin/left',$list);
		
		$data['country'] = $this->customer_registration_model->country($local_admin_id);
		$data['city'] = $this->customer_registration_model->city($local_admin_id);
		$data['region'] = $this->customer_registration_model->region($local_admin_id);
		$data['time_zone'] = $this->customer_registration_model->time_zone($local_admin_id);
		$data['checkFieldstatus'] = $this->customer_registration_model->checkFieldstatus($local_admin_id);
		
		$this->load->view('customer/customer_registration/customer_registration',$data);		
		$this->load->view('admin/footer');
	}
	public function SaveRegistrationAjax(){
		$insert_list = array();
		$insert_list = $_REQUEST;
		$insert_list['local_admin_id'] = $this->customer_registration_model->GetLocalAdmin();
		$this->customer_registration_model->SaveRegistrationData($insert_list);
	}
    public function Check_UserAjax(){
        $this->customer_registration_model->Check_User();
    }
	public function StaffSaveDataAjax(){
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
    public function BizDeleteAjax(){
		$this->staff_home_model->BizDelete();
	}
	public function UpdateServicesAjax(){
		$this->staff_home_model->UpdateServices();
	}
	public function GetStaffServiceDetilsAjax(){
		$this->staff_home_model->GetStaffServiceDetils();
	}
	public function find_custom_RegionAjax(){	
		$country_id=$this->input->post('country_id');
		$region=$this->customer_registration_model->changeregion($country_id);
		//echo '<pre>';print_r($region);exit;			
		echo $region;
	}
	public function find_custom_CityAjax(){
		$region_id=$this->input->post('region_id');
		$city=$this->customer_registration_model->changecity($region_id);
		//echo '<pre>';print_r($region);exit;			
		echo $city;	
	}
}
?>