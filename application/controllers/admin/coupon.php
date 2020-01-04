<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Coupon extends Pardco 
{
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/business_hour_model');
		$this->load->model('admin/coupon_model');
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
            $this->lang->load('admin_coupon',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_coupon',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
        }
		/*########End Language#######*/
	}
	public function index(){
		$this->load->library('form_validation');
		$this->load->view('admin/header');
		
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
		
		$CategoriesArr = $this->business_hour_model->get_category();
		for($i=0;$i<count($CategoriesArr);$i++){
			$CategoryId = $CategoriesArr[$i]['category_id'];
			$data['category'][$CategoryId]['name'] = $CategoriesArr[$i]['category_name'];
			$data['category'][$CategoryId]['child'] = $this->business_hour_model->get_serv($CategoryId);
		}
		
		$data['staff'] = $this->business_hour_model->get_staff();
		$data['allCoupon'] = $this->coupon_model->getAllCoupn();
		
		$data['business_address'] = $this->coupon_model->address();
		$this->load->view('admin/coupon/coupon', $data);
		
		$footer['link'] = $this->pardco_model->footer_link();
		$footer['languages'] 	= $this->pardco_model->admin_language();
		$this->load->view('admin/footer',$footer);
	}
	public function AddCoupon(){
		
		//echo "<pre>";
		//print_r($_POST);
		//echo "</pre>";
		//exit;
		
		$ReturnData = $this->coupon_model->add_coupon($_POST);	
		//echo $ReturnData;
		
		
		
	}
	public function editCoupon(){
		$coupon_id  =  $this->input->post('coupon_id');
		$ReturnData = $this->coupon_model->edit_coupon($coupon_id);	
		
		$applicbl_services_for = '';
		if(isset($ReturnData['applicbl_services_for']) && $ReturnData['applicbl_services_for'] != 0){
			foreach($ReturnData['applicbl_services_for'] as $val){
				$applicbl_services_for .= $val.',';
			}
			$ReturnData['applicbl_services_for'] = $applicbl_services_for;
		}
		else{
			$ReturnData['applicbl_services_for'] = 0;
		}
		
		$aplcbl_emp = '';
		if(isset($ReturnData['aplcbl_emp']) && $ReturnData['aplcbl_emp'] != 0){
			foreach($ReturnData['aplcbl_emp'] as $val){
				$aplcbl_emp .= $val.',';
			}
			$ReturnData['aplcbl_emp'] = $aplcbl_emp;
		}else{
			$ReturnData['aplcbl_emp'] = 0;
		}
		
		$aplcbl_days_on_week = '';
		if(isset($ReturnData['aplcbl_days_on_week']) && $ReturnData['aplcbl_days_on_week'] != 0){
			foreach($ReturnData['aplcbl_days_on_week'] as $val){
				$aplcbl_days_on_week .= $val.',';
			}
			$ReturnData['aplcbl_days_on_week'] = $aplcbl_days_on_week;
		}else{
			$ReturnData['aplcbl_days_on_week'] = 0;
		}
		$currentDate = date('m/d/y');
		$nextDay = date('m/d/y', strtotime('+1 day'));
		
		if($ReturnData['aplcbl_date_from'] == '01/01/70'){
			$ReturnData['aplcbl_date_from'] = $currentDate;
		}
		if($ReturnData['aplcbl_date_to'] == '01/01/70'){
			$ReturnData['aplcbl_date_to'] = $nextDay;
		}
		
		
	/*	$str = $ReturnData['coupon_id'].'@@'.$ReturnData['local_admin_id'].'@@'.$ReturnData['coupon_type'].'@@'.$ReturnData['discount_amnt_setting'].'@@'.$ReturnData['discount_amnt'].'@@'.$ReturnData['coupon_heading'].'@@'.$ReturnData['coupon_desc'].'@@'.$ReturnData['coupon_img_url'].'@@'.$ReturnData['coupon_works_over'].'@@'.$applicbl_services_for.'@@'.$aplcbl_emp.'@@'.$ReturnData['aplcbl_date_from'].'@@'.$ReturnData['aplcbl_date_to'].'@@'.$ReturnData['aplcbl_hour_from'].'@@'.$ReturnData['aplcbl_hour_to'].'@@'.$aplcbl_days_on_week.'@@'.$ReturnData['coupon_code'].'@@'.$ReturnData['first_time_use_only'].'@@'.$ReturnData['one_time_use_only'].'@@'.$ReturnData['no_of_booking_possible'].'@@'.$ReturnData['date_of_creation'].'@@'.$ReturnData['is_autoPromo'];    */
		
	 $str = $ReturnData['coupon_id'].'@@'.$ReturnData['local_admin_id'].'@@'.$ReturnData['coupon_type'].'@@'.$ReturnData['discount_amnt_setting'].'@@'.$ReturnData['discount_amnt'].'@@'.$ReturnData['coupon_heading'].'@@'.$ReturnData['coupon_desc'].'@@'.$ReturnData['coupon_img_url'].'@@'.$ReturnData['coupon_works_over'].'@@'.$ReturnData['applicbl_services_for'].'@@'.$ReturnData['aplcbl_emp'].'@@'.$ReturnData['aplcbl_date_from'].'@@'.$ReturnData['aplcbl_date_to'].'@@'.$ReturnData['aplcbl_hour_from'].'@@'.$ReturnData['aplcbl_hour_to'].'@@'.$ReturnData['aplcbl_days_on_week'].'@@'.$ReturnData['coupon_code'].'@@'.$ReturnData['first_time_use_only'].'@@'.$ReturnData['one_time_use_only'].'@@'.$ReturnData['no_of_booking_possible'].'@@'.$ReturnData['date_of_creation'].'@@'.$ReturnData['is_autoPromo'];  
	 
		
		echo $str;
		//echo json_encode($ReturnData);
		
	}
	public function GetRandomCode($type){
		$ReturnData = $this->coupon_model->RandomCouponCodeGenaration($type);
		echo $ReturnData;
	}
	public function CheckCode($code){
		$ReturnData = $this->coupon_model->couponexistCheck($code);
		echo $ReturnData;
	}
	public function deleteCoupon($id){
		$affectedRows = $this->coupon_model->delete_coupon($id);
		echo  $affectedRows;
	}
	public function changeStatus($status, $id){
		$affectedRows = $this->coupon_model->status_change($status, $id);
		echo  $affectedRows;
		//redirect('/staff');
	}
	public function showTextServicesAjax(){
		$json_servicesArr = json_decode($_POST['json_servicesArr']);
		$showTextServices = $this->coupon_model->showTextServices($json_servicesArr);
		
		$json_encode_arr= json_encode($showTextServices);
		echo $json_encode_arr;
		
	}
	public function showTextStaffAjax(){
		$json_staffArr = json_decode($_POST['json_staffArr']);
		$showTextstaff = $this->coupon_model->showTextStaff($json_staffArr);
		$json_encode_arr= json_encode($showTextstaff);
		echo $json_encode_arr;
		
	}
	public function shareFacebook(){
		$cuponId	=  $this->input->post('cuponId');
		$cuponType  =  $this->input->post('cuponType');	
		$cuponData  = $this->coupon_model->getCoupnDetails($cuponId);
		
		$str  ='"'.$this->global_mod->show_to_control($cuponData["coupon_heading"]).'" coupon code is"'.$cuponData["coupon_code"].'".'; 
		$str .='This coupon code is valid for  '.$cuponData["discount_amnt"];
		if($cuponData["discount_amnt_setting"] ==1){
		$str .=' % ';	
		}
		if($cuponData["discount_amnt_setting"] ==2){
		$str .=' Rs. ';	
		}
		$str .='off ';
		//if($cuponData["applicbl_services_for"] ==0){
		//$str .='All Services ';	
		//}
		//$str .='with';
		//if($cuponData["aplcbl_emp"] ==0){
		//$str .='All Employees';	
		//}
		//$str .=' for Any Client And Works ';
		
		$str .=' on '.$cuponData["aplcbl_date_from"].' to '.$cuponData["aplcbl_date_to"].' From '.$cuponData["aplcbl_hour_from"].' upto '.$cuponData["aplcbl_hour_to"].'.';
		
	
		
			$this->load->library('facebook'); 
			$user = $this->facebook->getUser();
			if($user){
			
			$ret_obj = $this->facebook->api('/me/feed', 'POST',
			                        array(
			                          'link' => base_url(),
			                          'message' => $str
			                     ));

				echo base_url();

			}else{
				$login_url = $this->facebook->getLoginUrl(array(
				    'redirect_uri' => site_url('page/FacebookPost'), 
				    'scope' => array("email") // permissions here
				));
				echo $login_url;
			}	
			
					
	}
	
	
	public function shareTwitter(){
		$cuponId	=  $this->input->post('cuponId');
		$cuponType  =  $this->input->post('cuponType');
		$cuponData  = $this->coupon_model->getCoupnDetails($cuponId);
		

		$str  ='"'.$this->global_mod->show_to_control($cuponData["coupon_heading"]).'" coupon code is"'.$cuponData["coupon_code"].'".'; 
		$str .='This coupon code is valid for  '.$cuponData["discount_amnt"];
		if($cuponData["discount_amnt_setting"] ==1){
		$str .=' % ';	
		}
		if($cuponData["discount_amnt_setting"] ==2){
		$str .=' Rs. ';	
		}
		$str .='off ';
		//if($cuponData["applicbl_services_for"] ==0){
		//$str .='All Services ';	
		//}
		//$str .='with';
		//if($cuponData["aplcbl_emp"] ==0){
		//$str .='All Employees';	
		//}
		//$str .=' for Any Client And Works ';
		
		$str .=' on '.$cuponData["aplcbl_date_from"].' to '.$cuponData["aplcbl_date_to"].' From '.$cuponData["aplcbl_hour_from"].' upto '.$cuponData["aplcbl_hour_to"].'.';
		
		echo $str;
		 
	}
	
	
	
}
?>