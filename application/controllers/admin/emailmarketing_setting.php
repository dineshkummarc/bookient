<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Emailmarketing_setting extends Pardco
{
	public function __construct(){ 
		parent::__construct();
		$this->load->model('admin/autopromotion_model');
		$this->load->model('admin/Emailmarketing_setting_model');
		
		/*===================LogIn Security Check===================*/
		  /*$logged_in_Status = $this->session->userdata('logged_in');
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
            $this->lang->load('admin_emailmarketingsetting',$default_language);
			$this->lang->load('admin_global',$default_language);
        }else{
            $setLanguage = strtolower($this->session->userdata('admin_language'));
            $this->lang->load('admin_emailmarketingsetting',$setLanguage);
            $this->lang->load('admin_global',$setLanguage);
            
        }
		/*########End Language#######*/	
	}
	
	public function index(){		
		
		$this->load->view('admin/header');
		$data['menu_right']= $this->pardco_model->pardco_right_menu();
		$data['menu_left']= $this->pardco_model->pardco_left_menu();
		$data['pardco_location']= $this->pardco_model->pardco_location();
		$this->load->view('admin/nevigation',$data);
				
		$dataArr['EmailCategory']= $this->Emailmarketing_setting_model->GetEmailCategory();
		
		$dataArr['CustomerType']= $this->Emailmarketing_setting_model->GetCustomerGroup();
		$dataArr['allsetting']= $this->Emailmarketing_setting_model->allEmailSetting();
		$this->load->view('admin/emailmarketing_setting/emailmarketing_setting', $dataArr);
	} 
	
	
	public function GetTemplate(){
		$return = $this->Emailmarketing_setting_model->GetTemplateModel();
		$tempCatId = $this->input->post('tempCatId');
		
		if(is_array($return) && !empty($return)){
			$str = '';
			$str .= '<select class="cWith" id="Template" name="Template">';
			foreach($return as $val){
				$str .= '<option value="'.$val['app_emlmrktn_tem_id'].'"';
				if($tempCatId == $val['app_emlmrktn_tem_id']){
					$str .= 'selected=""';
				}
				$str .= '>';
				$str .= $val['app_emlmrktn_tem_subject'];
				$str .= '</option>';
			}
			$str .= '</select>';
		}
		else{
			$url = base_url().'admin/email_mktg';
			$str  = 'No Template available for this category.<a href="'.$url.'">Create New Template</a>';
		}
		echo $str;
	}
	
	public function GetAllcustomers(){
		$return = $this->Emailmarketing_setting_model->GetAllcustomersModel();
		$CustomerIds = $this->input->post('CustomerIds');
		
		
		if(is_array($return)){
			$str = '<ul>';
			if(count($return)>1){
				$str .= '<li><input type="checkbox" name="customer_name" id="customer_name" value="0" onchange="SelectAll()"/> Select all </li>';
			}
			foreach($return as $CusArr){
				$str .= '<li><input type="checkbox" id="chk_box_'.$CusArr["cus_id"].'" value="'.$CusArr["cus_id"].'" onchange="ClearParent()"';
				if(is_array($CustomerIds)){
					$key = array_search($CusArr["cus_id"],$CustomerIds);
					if($key != NULL){
						$str .= ' checked=""';
					}
				}
				
				
				$str .= '  /> &nbsp;'.$CusArr["cus_fname"].' '.$CusArr['cus_lname'].'</li>';
			} 
			$str.= '</ul>';
		}else{
			$str = 1;
		}	
		echo $str;
	}
	
	public function savepromo(){
		$localAdminId = $this->session->userdata('local_admin_id');
		
		$insertData['emlmrktn_cat_id'] = $this->input->post('Emailcategory'); 
		$insertData['app_emlmrktn_tem_id'] = $this->input->post('Template'); 
		$insertData['customertype_id'] = $this->input->post('Customer_type'); 
		$insertData['customer_ids'] = json_encode($this->input->post('CusArr')); 
		$insertData['date_added'] = date("Y-m-d H:i:s"); 
		$insertData['emlmrktn_localadmin '] = $localAdminId;
		$id = $this->input->post('settingId');
		$return = $this->Emailmarketing_setting_model->saveSetting($id,$insertData);   
		
		echo $return;
		
		
	}

	public function GetDataForEdit(){
		$data = $this->Emailmarketing_setting_model->GetDataById();
		
		$a = json_encode($data);
		echo $a;
	}
	
	
	
	
	
	
	public function promoTypeWiseOffer(){
		$cuponsType = $this->input->post('promoType');
		$allCupon = $this->autopromotion_model->allCuponDetails($cuponsType);
				$str ='';
		if(count($allCupon)>0){
				$str.='<select class="required" style="width:37%;" name="cuponName" id="cuponName">';
			foreach($allCupon as $allCuponArr){ 
				$str.='<option value="'.$allCuponArr["coupon_id"].'">'.$allCuponArr["coupon_heading"].'</option>'; 
			}
				$str.='</select>';	
		}else{
				$str.='<span style="width:37%; color:red"> Sorry There is no coupon found</span>';
		}

		echo $str;
	}

	
	
	/*public function GetDataForEdit(){
		$return = $this->autopromotion_model->FetchDataById();
		
		$Offer = $return[1];
		
		$str = '<span id="linkContener"><select class="required cWith" name="cuponName" id="cuponName">';		
					
		
		
		
		foreach($Offer as $val){
			$str .= '<option value="'.$val['coupon_id'].'"';
			if($val['coupon_id'] == $return[0]['auto_promo_linkid']){
				$str .= ' selected="" ';
			}
			$str .= '>'.$val['coupon_heading'].'</option>';
		}
		
		$str .= '</select></span> Or <a href="<?php echo base_url(); ?>admin/coupon">Add New offer</a>';
				
		$return[0]['offerbox'] = $str;
		$a = json_encode($return);
		echo $a;
		
		
	}*/
	
	public function DeleteSetting(){
		$settingId = $this->input->post('settingId');
		$reutrn = $this->autopromotion_model->DeleteSetting($settingId);
		echo $return;
	}
	
	

}
?>